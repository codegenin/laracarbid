<?php

namespace App\Repositories\Api\Page;

use App\Repositories\BaseRepository;
use App\Models\Page\Page;

/**
 * Class PageRepository.
 */
class PageRepository extends BaseRepository
{
    /**
     * PageRepository constructor.
     *
     * @param  Page  $model
     */
    public function __construct(Page $model)
    {
        $this->model = $model;
    }
}
