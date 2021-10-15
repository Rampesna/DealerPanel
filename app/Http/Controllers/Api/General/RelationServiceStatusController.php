<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\General\CustomerServiceStatus\IndexRequest;
use App\Services\RelationServiceStatusService;

class RelationServiceStatusController extends Controller
{
    private $relationServiceStatusService;

    public function __construct()
    {
        $this->relationServiceStatusService = new RelationServiceStatusService;
    }

    public function index(IndexRequest $request)
    {
        return $this->relationServiceStatusService->index();
    }
}
