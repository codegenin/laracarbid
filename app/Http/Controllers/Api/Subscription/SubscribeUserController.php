<?php

namespace App\Http\Controllers\Api\Subscription;

use App\Models\Subscription\Plan;
use App\Http\Controllers\Api\BaseResponseController;
use App\Repositories\Api\Subscription\PlanRepository;
use App\Http\Requests\Api\Subscription\SubscribeUserRequest;

/**
 * Class SubscribeUserController
 */
class SubscribeUserController extends BaseResponseController
{
    protected $planRepository;

    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    public function index(SubscribeUserRequest $request)
    {
        // Check if subscribe
        if (count(auth()->user()->subscriptions) <= 0) {
            $plan = $this->planRepository->getById($request->plan_id);
            auth()->user()->newSubscription($plan->name, $plan);

            return $this->responseWithSuccess(
                __('api.subscription.subscribe_success')
            );
        }

        return $this->responseWithError(__('api.subscription.subscribe_already'));
    }
}
