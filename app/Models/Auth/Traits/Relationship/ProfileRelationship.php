<?php

namespace App\Models\Auth\Traits\Relationship;

use App\Models\Auth\User;

/**
 * Class ProfileRelationship.
 */
trait ProfileRelationship
{
    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
