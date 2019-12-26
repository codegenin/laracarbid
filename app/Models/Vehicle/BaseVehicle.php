<?php

namespace App\Models\Vehicle;

use Altek\Accountant\Contracts\Recordable;
use Altek\Accountant\Recordable as RecordableTrait;
use Altek\Eventually\Eventually;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseVehicle extends Model implements Recordable
{
    use Uuid,
        SoftDeletes,
        Eventually,
        RecordableTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = ['auctioned_at'];
}
