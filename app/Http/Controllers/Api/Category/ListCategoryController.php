<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Api\BaseResponseController;
use App\Http\Resources\Category\CategoryResource;
use App\Repositories\Api\Vehicle\CategoryRepository;

/**
 * Class ListCategoryController
 */
class ListCategoryController extends BaseResponseController
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->where('active', 1)->orderBy('order')->get();

        return $this->responseWithSuccess(
            __('api.messages.response_success'),
            CategoryResource::collection($categories)
        );
    }
}
