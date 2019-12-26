<?php

namespace App\Repositories\Api\Subscription;

use App\Models\Subscription\Plan;
use App\Repositories\BaseRepository;

/**
 * Class PlanRepository.
 */
class PlanRepository extends BaseRepository
{
    /**
     * PageRepository constructor.
     *
     * @param  Plan  $model
     */
    public function __construct(Plan $model)
    {
        $this->model = $model;
    }
}
