<?php

namespace App\Http\Controllers\Api\Vehicle;

use App\Http\Controllers\Api\BaseResponseController;
use App\Http\Resources\Vehicle\VehicleCategoryResource;
use App\Repositories\Api\Vehicle\VehicleCategoryRepository;

/**
 * Class ListedVehicleController
 */
class ListedVehicleController extends BaseResponseController
{
    protected $categoryRepository;

    public function __construct(VehicleCategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->where('active', 1)->orderBy('order')->get();

        return $this->responseWithSuccess(
            __('api.messages.response_success'),
            VehicleCategoryResource::collection($categories)
        );
    }
}
