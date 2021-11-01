<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('user.pages.report.index.index');
    }

    public function show(Request $request)
    {
        try {
            return view('user.pages.report.reports.' . $request->report . '.index');
        } catch (\Exception $exception) {
            abort(404);
        }
    }
}
