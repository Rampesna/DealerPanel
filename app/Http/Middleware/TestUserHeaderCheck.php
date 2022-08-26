<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TestUserHeaderCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return response()->json([
            'headers' => [
                '_token' => $request->header('_token'),
                '_auth_type' => $request->header('_auth_type')
            ],
            'data' => $request->all()
        ]);
    }
}
