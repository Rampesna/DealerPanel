<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\CreditDetailTypeService;

class CreditDetailTypeController extends Controller
{
    private $creditDetailTypeService;

    public function __construct()
    {
        $this->creditDetailTypeService = new CreditDetailTypeService;
    }

    public function index()
    {
        return $this->creditDetailTypeService->index();
    }
}
