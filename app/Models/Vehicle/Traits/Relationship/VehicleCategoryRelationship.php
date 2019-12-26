<?php

namespace App\Models\Vehicle\Traits\Relationship;

use App\Models\Vehicle\VehicleCategory;

/**
 * Class VehicleCategoryRelationship.
 */
trait VehicleCategoryRelationship
{
    public function category()
    {
        return $this->belongsTo(VehicleCategory::class);
    }
}
