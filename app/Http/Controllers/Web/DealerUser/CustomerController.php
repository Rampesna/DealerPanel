<?php

namespace App\Http\Controllers\Web\DealerUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('dealerUser.pages.customer.index.index');
    }

    /**
     * @param Request $request
     */
    public function show(Request $request)
    {
        try {
            return view('dealerUser.pages.customer.show.' . $request->tab . '.index', [
                'id' => $request->id,
                'tab' => $request->tab,
            ]);
        } catch (\Exception $exception) {
            abort(404);
        }
    }
}
