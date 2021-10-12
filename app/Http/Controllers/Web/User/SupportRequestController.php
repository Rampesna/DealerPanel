<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportRequestController extends Controller
{
    public function index()
    {
        return view('user.pages.supportRequest.index.index');
    }

    public function show(Request $request)
    {
        return view('user.pages.supportRequest.show.index', [
            'id' => $request->id
        ]);
    }
}
