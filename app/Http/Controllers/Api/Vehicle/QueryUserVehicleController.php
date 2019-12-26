<?php

namespace App\Http\Controllers\Api\Vehicle;

use Illuminate\Http\Request;
use App\Models\Vehicle\Vehicle;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Repositories\Api\Auth\UserRepository;
use App\Repositories\Api\Vehicle\VehicleRepository;
use App\Http\Controllers\Api\BaseResponseController;
use App\Http\Resources\Vehicle\QueryUserVehicleResource;
use App\Http\Resources\Vehicle\QueryUserVehicleResourceCollection;
use App\Http\Resources\Vehicle\VehicleCategoryResource;
use App\Repositories\Api\Vehicle\VehicleCategoryRepository;

/**
 * Class QueryUserVehicleController
 */
class QueryUserVehicleController extends BaseResponseController
{
    protected $vehicleRepository;
    protected $userRepository;

    public function __construct(VehicleRepository $vehicleRepository, UserRepository $userRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $vehicles = QueryBuilder::for(Vehicle::class)
            ->defaultSort('id')
            ->allowedSorts('id', 'price')
            ->allowedFilters(AllowedFilter::exact('status'))
            ->allowedIncludes(['category'])
            ->where('user_id', auth()->user()->id)
            ->paginate(($request->per_page) ?? 15);

        return new QueryUserVehicleResourceCollection($vehicles);
    }
}
