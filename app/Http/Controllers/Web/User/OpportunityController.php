<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class OpportunityController extends Controller
{
    public function index()
    {
        return view('user.pages.opportunity.index');
    }
}
