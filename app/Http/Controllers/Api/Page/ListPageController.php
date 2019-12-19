<?php

namespace App\Http\Controllers\Api\Page;

use App\Http\Controllers\Api\BaseResponseController;
use App\Repositories\Api\Page\PageRepository;

class ListPageController extends BaseResponseController
{
    protected $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function index()
    {
        $pages = $this->pageRepository
            ->orderBy('order')->get();

        return $this->responseWithSuccess(__('string.general.success'), $pages);
    }
}
