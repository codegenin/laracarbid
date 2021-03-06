<?php

namespace App\Http\Controllers\Api\User;

use App\Repositories\Api\Auth\UserRepository;
use App\Http\Controllers\Api\BaseResponseController;
use App\Http\Requests\Api\User\SetLocaleRequest;

class SetLocaleController extends BaseResponseController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(SetLocaleRequest $request)
    {
        $this->userRepository->updateLocale($request->locale);
        return $this->responseWithSuccess(__('api.messages.response_success'));
    }
}
