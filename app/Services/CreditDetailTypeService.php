<?php

namespace App\Services;

use App\Models\CreditDetailType;
use App\Traits\Response;

class CreditDetailTypeService
{
    use Response;

    public function index()
    {
        $creditDetailTypes = CreditDetailType::all();

        return $this->success('Credit detail types', $creditDetailTypes);
    }
}
