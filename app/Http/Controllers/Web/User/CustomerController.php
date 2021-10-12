<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('user.pages.customer.index.index');
    }

    public function show(Request $request)
    {
        try {
            return view('user.pages.customer.show.' . $request->tab . '.index', [
                'id' => $request->id,
                'tab' => $request->tab,
            ]);
        } catch (\Exception $exception) {
            abort(404);
        }
    }
}
