<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\General\Province\IndexRequest;
use App\Services\ProvinceService;

class ProvinceController extends Controller
{
    private $provinceService;

    public function __construct()
    {
        $this->provinceService = new ProvinceService;
    }

    public function index(IndexRequest $request)
    {
        return $this->provinceService->index($request->country_id);
    }
}
