<?php

namespace App\Http\Controllers\Web\DealerUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportRequestController extends Controller
{
    public function index()
    {
        return view('dealerUser.pages.supportRequest.index.index');
    }

    public function show(Request $request)
    {
        return view('dealerUser.pages.supportRequest.show.index', [
            'id' => $request->id
        ]);
    }
}
