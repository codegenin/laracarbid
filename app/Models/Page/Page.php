<?php

namespace App\Models\Page;

use Altek\Accountant\Contracts\Recordable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Altek\Accountant\Recordable as RecordableTrait;
use Altek\Eventually\Eventually;
use Spatie\EloquentSortable\SortableTrait;

class Page extends Model implements Recordable
{
    use HasSlug,
        Eventually,
        RecordableTrait,
        SortableTrait;

    public $sortable = [
        'order_column_name'  => 'sort_order'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
