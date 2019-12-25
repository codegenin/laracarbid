<?php

namespace App\Http\Controllers\Api\Plan;

use App\Http\Controllers\Api\BaseResponseController;

/**
 * Class ListPlanController
 */
class ListPlanController extends BaseResponseController
{
    public function index()
    {
        $plans = app('rinvex.subscriptions.plan')->all();

        return $this->responseWithSuccess(
            __('api.messages.response_success'),
            $plans
        );
    }
}
