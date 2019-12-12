<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Carbon;
use App\Events\Api\Auth\UserRegistered;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Repositories\Api\Auth\UserRepository;
use App\Http\Controllers\Api\BaseResponseController;

/**
 * Class RegisterController.
 */
class RegisterController extends BaseResponseController
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param RegisterRequest $request
     *
     * @throws \Throwable
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(RegisterRequest $request)
    {
        abort_unless(config('access.registration'), 404);

        $user = $this->userRepository->create($request->all());

        // If the user must confirm their email or their account requires approval,
        // create the account but don't log them in.
        if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
            event(new UserRegistered($user));

            return $this->responseWithSuccess(config('access.users.requires_approval') ?
                __('exceptions.Api.auth.confirmation.created_pending') : __('exceptions.Api.auth.confirmation.created_confirm'));
        }

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        event(new UserRegistered($user));

        return $this->responseWithSuccess(__('auth.login_successful'), [
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
}
