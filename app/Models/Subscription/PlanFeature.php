<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Builder;
use Rinvex\Subscriptions\Models\PlanFeature as RinvexPlanFeature;
use Spatie\EloquentSortable\SortableTrait;

class PlanFeature extends RinvexPlanFeature
{
    use SortableTrait;

    public $sortable = [
        'order_column_name'  => 'sort_order'
    ];

    public static function bootCacheableEloquent(): void
    {
    }

    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }
}
