<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Builder;
use Rinvex\Subscriptions\Models\Plan as RinvexPlan;
use Spatie\EloquentSortable\SortableTrait;

class Plan extends RinvexPlan
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
