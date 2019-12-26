<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Builder;
use Rinvex\Subscriptions\Models\PlanSubscriptionUsage as RinvexPlanSubscriptionUsage;

class PlanSubscriptionUsage extends RinvexPlanSubscriptionUsage
{
    public static function bootCacheableEloquent(): void
    {
    }

    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }
}
