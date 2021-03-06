<?php

namespace App\Http\Controllers\Api\Auth;

use App\Repositories\Api\Auth\UserRepository;
use App\Http\Resources\Auth\TokenResponseResource;
use App\Http\Controllers\Api\BaseResponseController;
use App\Http\Requests\Api\Auth\ConfirmAccountRequest;
use App\Http\Requests\Api\Auth\ConfirmResendRequest;
use App\Notifications\Api\Auth\UserNeedsConfirmation;

/**
 * Class ConfirmAccountController.
 */
class ConfirmAccountController extends BaseResponseController
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ConfirmAccountController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param $token
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function confirm(ConfirmAccountRequest $request)
    {
        $user        = $this->user->confirm($request->code);

        $tokenResult = $user->createToken('Personal Access Token');

        return $this->responseWithSuccess(
            __('exceptions.api.auth.confirmation.created_successful'),
            new TokenResponseResource($tokenResult)
        );
    }


    /**
     * @param $request
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function sendConfirmation(ConfirmResendRequest $request)
    {
        $user = $this->user->findByMobile($request->mobile);

        if ($user->isConfirmed()) {
            return $this->responseWithError(__('exceptions.api.auth.confirmation.already_confirmed'));
        }

        $user->notify(new UserNeedsConfirmation($user->confirmation_code));

        return $this->responseWithSuccess(__('exceptions.api.auth.confirmation.created_confirm'));
    }
}
