<?php

namespace App\Models\Auth\Traits\Relationship;

use App\Models\Auth\SocialAccount;
use App\Models\Auth\PasswordHistory;
use App\Models\Auth\UserProfile;
use App\Models\Vehicle\Vehicle;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->hasMany(PasswordHistory::class);
    }

    /**
     * @return mixed
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
