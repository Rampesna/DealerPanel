<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDealerUser
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
        if ($request->header('_auth_type') != 'DealerUser') {
            return response()->json([
                'message' => 'Invalid _auth_type',
                'error' => true,
                'code' => 400,
                'response' => null
            ], 400);
        }

        $dealerUser = \App\Models\DealerUser::where('api_token', $request->header('_token'))->first();

        if (!$dealerUser) {
            return response()->json([
                'message' => 'Invalid _token',
                'error' => true,
                'code' => 400,
                'response' => null
            ], 400);
        }

        $request->merge([
            'dealerUser' => $dealerUser
        ]);

        return $next($request);
    }
}
