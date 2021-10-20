<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\General\Country\IndexRequest;
use App\Services\CountryService;

class CountryController extends Controller
{
    private $countryService;

    public function __construct()
    {
        $this->countryService = new CountryService;
    }

    public function index(IndexRequest $request)
    {
        return $this->countryService->index();
    }
}
