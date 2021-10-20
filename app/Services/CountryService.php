<?php

namespace App\Services;

use App\Models\Country;
use App\Traits\Response;

class CountryService
{
    use Response;

    public function index()
    {
        return $this->success('Countries', Country::all());
    }
}
