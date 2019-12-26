<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Builder;
use Rinvex\Subscriptions\Models\Plan as RinvexPlan;

class Plan extends RinvexPlan
{
    public static function bootCacheableEloquent(): void
    {
    }

    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }
}
