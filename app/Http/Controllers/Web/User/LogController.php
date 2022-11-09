<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        return view('user.pages.log.index.index');
    }
}
