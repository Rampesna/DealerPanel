<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class BatchTransactionController extends Controller
{
    public function index()
    {
        return view('user.pages.batchTransaction.index');
    }
}
