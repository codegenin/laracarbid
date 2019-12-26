<?php

namespace App\Models\Vehicle;

use App\Models\Vehicle\Traits\Relationship\VehicleCategoryRelationship;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends BaseVehicle
{
    use VehicleCategoryRelationship;
}
