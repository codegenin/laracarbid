<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Relationship\ProfileRelationship;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use ProfileRelationship;

    protected $guarded = [];
}
