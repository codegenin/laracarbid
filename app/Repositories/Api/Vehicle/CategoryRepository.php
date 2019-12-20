<?php

namespace App\Repositories\Api\Vehicle;

use App\Models\Vehicle\Category;
use App\Repositories\BaseRepository;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BaseRepository
{
    /**
     * CategoryRepository constructor.
     *
     * @param  Category  $model
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}
