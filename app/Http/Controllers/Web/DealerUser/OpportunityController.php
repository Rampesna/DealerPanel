<?php

namespace App\Http\Controllers\Web\DealerUser;

use App\Http\Controllers\Controller;

class OpportunityController extends Controller
{
    public function index()
    {
        return view('dealerUser.pages.opportunity.index');
    }
}
