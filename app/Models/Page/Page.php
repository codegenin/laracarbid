<?php

namespace App\Models\Page;

use Altek\Accountant\Contracts\Recordable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Altek\Accountant\Recordable as RecordableTrait;
use Altek\Eventually\Eventually;

class Page extends Model implements Recordable
{
    use HasSlug, Eventually, RecordableTrait;

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
