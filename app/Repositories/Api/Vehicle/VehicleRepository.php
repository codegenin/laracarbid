<?php

namespace App\Repositories\Api\Vehicle;

use App\Models\Vehicle\Vehicle;
use App\Repositories\BaseRepository;

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
}
