<?php

namespace App\Models\Faq;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;

class FAQ extends Model
{
    use SortableTrait;

    protected $table = 'faqs';

    public $sortable = [
        'order_column_name'  => 'sort_order'
    ];
}
