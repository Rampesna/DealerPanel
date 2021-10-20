<?php

namespace App\Services;

use App\Models\Province;
use App\Traits\Response;

class ProvinceService
{
    use Response;

    /**
     * @param int $country_id
     */
    public function index(
        $country_id
    )
    {
        return $this->success('Provinces', Province::where('country_id', $country_id)->get());
    }
}
