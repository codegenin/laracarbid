<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Resources\User\ProfileResource;
use App\Repositories\Api\Auth\UserRepository;
use App\Http\Controllers\Api\BaseResponseController;

class UploadAvatarController extends BaseResponseController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        auth()->user()->addMediaFromRequest('file')
            ->preservingOriginal()
            ->toMediaCollection('avatars');

        return $this->responseWithSuccess(__('api.messages.response_success'));
    }
}
