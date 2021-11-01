<?php

namespace App\Http\Controllers\Web\DealerUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DealerController extends Controller
{
    public function index()
    {
        return view('dealerUser.pages.dealer.index.index');
    }

    public function show(Request $request)
    {
        try {
            return view('dealerUser.pages.dealer.show.' . $request->tab . '.index', [
                'id' => $request->id,
                'tab' => $request->tab,
            ]);
        } catch (\Exception $exception) {
            abort(404);
        }
    }
}
