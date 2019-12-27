<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Events\Api\Auth\UserLoggedOut;
use App\Http\Resources\User\ProfileResource;
use App\Repositories\Api\Auth\UserRepository;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Controllers\Api\BaseResponseController;

class UpdateUserController extends BaseResponseController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(UpdateUserRequest $request)
    {
        $response = $this->userRepository->update(auth()->user()->id, $request->all());

        // E-mail/SMS address was updated, user has to reconfirm
        if (is_array($response) && $response['email_changed']) {

            // Laravel specific logic
            $request->user()->token()->revoke(); // Revoke token
            $request->user()->token()->delete(); // Delete token, just in case cant be revoke

            // Fire event, Log out user
            event(new UserLoggedOut($request->user()));

            return $this->responseWithSuccess(__('api.messages.user.confirm_needed'));
        }

        return $this->responseWithSuccess(__('api.messages.response_success'));
    }
}
