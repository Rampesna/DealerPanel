<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\General\District\IndexRequest;
use App\Services\DistrictService;

class DistrictController extends Controller
{
    private $districtService;

    public function __construct()
    {
        $this->districtService = new DistrictService;
    }

    public function index(IndexRequest $request)
    {
        return $this->districtService->index($request->province_id);
    }
}
