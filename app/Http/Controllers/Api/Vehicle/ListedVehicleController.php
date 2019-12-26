<?php

namespace App\Http\Controllers\Api\Vehicle;

use App\Http\Controllers\Api\BaseResponseController;
use App\Http\Resources\Vehicle\VehicleCategoryResource;
use App\Repositories\Api\Vehicle\VehicleCategoryRepository;
use App\Repositories\Api\Vehicle\VehicleRepository;

/**
 * Class ListedVehicleController
 */
class ListedVehicleController extends BaseResponseController
{
    protected $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function index()
    {
        $vehicles = auth()->user()->vehicles;

        return $this->responseWithSuccess(
            __('api.messages.response_success'),
            $vehicles
        );
    }
}
