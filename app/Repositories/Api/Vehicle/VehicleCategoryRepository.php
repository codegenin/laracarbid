<?php

namespace App\Repositories\Api\Vehicle;

use App\Models\Vehicle\VehicleCategory;
use App\Repositories\BaseRepository;

/**
 * Class VehicleCategoryRepository.
 */
class VehicleCategoryRepository extends BaseRepository
{
    /**
     * CategoryRepository constructor.
     *
     * @param  VehicleCategory  $model
     */
    public function __construct(VehicleCategory $model)
    {
        $this->model = $model;
    }
}
