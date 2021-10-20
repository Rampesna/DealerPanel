<?php

namespace App\Services;

use App\Models\District;
use App\Traits\Response;

class DistrictService
{
    use Response;

    /**
     * @param int $province_id
     */
    public function index(
        $province_id
    )
    {
        return $this->success('Districts', District::where('province_id', $province_id)->get());
    }
}
