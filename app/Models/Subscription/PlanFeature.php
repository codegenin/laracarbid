<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Builder;
use Rinvex\Subscriptions\Models\PlanFeature as RinvexPlanFeature;

class PlanFeature extends RinvexPlanFeature
{
    public static function bootCacheableEloquent(): void
    {
    }

    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }
}
