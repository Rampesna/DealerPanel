<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\General\SupportRequestCategory\IndexRequest;
use App\Services\SupportRequestCategoryService;

class SupportRequestCategoryController extends Controller
{
    private $supportRequestCategoryService;

    public function __construct()
    {
        $this->supportRequestCategoryService = new SupportRequestCategoryService;
    }

    public function index(IndexRequest $request)
    {
        return $this->supportRequestCategoryService->index($request->type);
    }
}
