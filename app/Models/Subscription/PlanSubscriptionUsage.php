<?php

namespace App\Models\Subscription;

use Altek\Accountant\Contracts\Recordable;
use Illuminate\Database\Eloquent\Builder;
use Rinvex\Subscriptions\Models\PlanSubscriptionUsage as RinvexPlanSubscriptionUsage;
use Altek\Accountant\Recordable as RecordableTrait;
use Altek\Eventually\Eventually;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanSubscriptionUsage extends RinvexPlanSubscriptionUsage implements Recordable
{
    use Eventually,
        RecordableTrait,
        SoftDeletes;

    public static function bootCacheableEloquent(): void
    {
    }

    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }
}
