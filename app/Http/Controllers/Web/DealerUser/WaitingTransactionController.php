<?php

namespace App\Http\Controllers\Web\DealerUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WaitingTransactionController extends Controller
{
    public function show(Request $request)
    {
        try {
            return view('dealerUser.pages.waitingTransaction.' . $request->tab . '.index', [
                'tab' => $request->tab
            ]);
        } catch (\Exception $exception) {
            abort(404);
        }
    }
}
