<?php

namespace App\Repositories\Api\Vehicle;

use App\Models\Vehicle\Vehicle;
use App\Repositories\BaseRepository;
use App\Exceptions\ApiResponseException;

/**
 * Class VehicleRepository.
 */
class VehicleRepository extends BaseRepository
{
    /**
     * CategoryRepository constructor.
     *
     * @param  Vehicle  $model
     */
    public function __construct(Vehicle $model)
    {
        $this->model = $model;
    }

    /**
     * Find vehicles by status
     *
     * @param $status
     * @return void
     */
    public function findVehiclesByStatus($status)
    {
        return $this->model->where('status', $status)
            ->where('user_id', auth()->user()->id)
            ->get();
    }
}
