<?php

namespace App\Http\Controllers\Api\Faq;

use App\Repositories\Api\Faq\FaqRepository;
use App\Http\Controllers\Api\BaseResponseController;

class ListQuestionsController extends BaseResponseController
{
    protected $faqRepository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function index()
    {
        $questions = $this->faqRepository
            ->orderBy('order')->get();

        return $this->responseWithSuccess(__('string.general.success'), $questions);
    }
}
