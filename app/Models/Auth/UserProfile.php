<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Relationship\ProfileRelationship;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use ProfileRelationship;

    protected $guarded = [];
}
