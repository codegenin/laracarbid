<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;

class VehicleCategory extends Model
{
    use SortableTrait;

    public $sortable = [
        'order_column_name'  => 'sort_order'
    ];
}
