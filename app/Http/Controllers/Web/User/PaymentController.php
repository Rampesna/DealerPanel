<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        return view('user.pages.payment.index.index');
    }
}
