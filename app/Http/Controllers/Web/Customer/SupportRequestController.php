<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportRequestController extends Controller
{
    public function index()
    {
        return view('customer.pages.supportRequest.index.index');
    }

    public function show(Request $request)
    {
        return view('customer.pages.supportRequest.show.index', [
            'id' => $request->id
        ]);
    }
}
