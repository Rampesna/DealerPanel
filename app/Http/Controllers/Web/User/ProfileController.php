<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;


class ProfileController extends Controller
{
    public function index()
    {
        return view('user.pages.profile.index');
    }
}
