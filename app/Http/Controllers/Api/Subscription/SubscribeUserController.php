<?php

namespace App\Http\Controllers\Api\Subscription;

use App\Models\Subscription\Plan;
use App\Http\Controllers\Api\BaseResponseController;
use App\Repositories\Api\Subscription\PlanRepository;
use App\Http\Requests\Api\Subscription\SubscribeUserRequest;
use App\Models\Subscription\PlanSubscription;

/**
 * Class SubscribeUserController
 */
class SubscribeUserController extends BaseResponseController
{
    protected $planRepository;
    protected $planSubscription;

    public function __construct(PlanRepository $planRepository, PlanSubscription $planSubscription)
    {
        $this->planRepository = $planRepository;
        $this->planSubscription = $planSubscription;
    }

    public function index(SubscribeUserRequest $request)
    {
        // @todo Add payment gateway here

        $plan = $this->planRepository->getById($request->plan_id);

        // Checks if user is subscribe to same plan
        if (!auth()->user()->subscribedTo($request->plan_id)) {
            auth()->user()->newSubscription($plan->name, $plan);
            return $this->responseWithSuccess(
                __('api.subscription.subscribe_success')
            );
        }

        return $this->responseWithSuccess(
            __('api.subscription.subscribe_already')
        );
    }
}
