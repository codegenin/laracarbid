<?php

namespace App\Http\Controllers\Api\User;

use App\Repositories\Api\Auth\UserRepository;
use App\Http\Controllers\Api\BaseResponseController;
use App\Http\Resources\User\ProfileResource;

class ProfileController extends BaseResponseController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $this->responseWithSuccess(__('api.messages.response_success'), new ProfileResource(auth()->user()));
    }
}
