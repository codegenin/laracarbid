<?php

namespace App\Repositories\Api\Faq;

use App\Models\Faq\Faq;
use App\Repositories\BaseRepository;

/**
 * Class FaqRepository.
 */
class FaqRepository extends BaseRepository
{
    /**
     * FaqReposistory constructor.
     *
     * @param  Faq  $model
     */
    public function __construct(Faq $model)
    {
        $this->model = $model;
    }
}
