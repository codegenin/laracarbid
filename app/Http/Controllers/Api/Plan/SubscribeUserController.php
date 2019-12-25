<?php

namespace App\Http\Controllers\Api\Plan;

use App\Http\Controllers\Api\BaseResponseController;
use App\Http\Requests\Api\Plan\SubscribeUserRequest;

/**
 * Class SubscribeUserController
 */
class SubscribeUserController extends BaseResponseController
{
    public function index(SubscribeUserRequest $request)
    {
        $user = auth()->user();

        // Check if subscribe
        if (count($user->subscriptions) <= 0) {
            $plan = app('rinvex.subscriptions.plan')->find($request->plan_id);
            $user->newSubscription('main', $plan);

            return $this->responseWithSuccess(
                __('api.subscription.response_success')
            );
        }

        return $this->responseWithError(__('api.subscription.response_error'));
    }
}
