<?php

namespace App\Http\Controllers\Api\Subscription;

use App\Http\Controllers\Api\BaseResponseController;
use App\Repositories\Api\Subscription\PlanRepository;

/**
 * Class ListPlanController
 */
class ListPlanController extends BaseResponseController
{
    protected $planRepository;

    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    public function index()
    {
        $plans = $this->planRepository->all();

        return $this->responseWithSuccess(
            __('api.messages.response_success'),
            $plans
        );
    }
}
