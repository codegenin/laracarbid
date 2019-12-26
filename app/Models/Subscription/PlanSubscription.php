<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Builder;
use Rinvex\Subscriptions\Models\PlanSubscription as RinvexPlanSubscription;

class PlanSubscription extends RinvexPlanSubscription
{

    public static function bootCacheableEloquent(): void
    {
    }

    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }
}
