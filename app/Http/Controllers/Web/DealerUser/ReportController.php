<?php

namespace App\Http\Controllers\Web\DealerUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('dealerUser.pages.report.index.index');
    }

    public function show(Request $request)
    {
        try {
            return view('dealerUser.pages.report.reports.' . $request->report . '.index');
        } catch (\Exception $exception) {
            abort(404);
        }
    }
}
