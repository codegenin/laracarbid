<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Carbon;
use App\Events\Api\Auth\UserRegistered;
use App\Repositories\Api\Auth\UserRepository;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\Auth\TokenResponseResource;
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

        $tokenResult = $user->createToken('Personal Access Token');

        event(new UserRegistered($user));

        return $this->responseWithSuccess(__('api.register.confirmation.created'));
    }
}
