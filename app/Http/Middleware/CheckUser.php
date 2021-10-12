<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUser
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
        if ($request->header('_auth_type') != 'User') {
            return response()->json([
                'message' => 'Invalid _auth_type',
                'error' => true,
                'code' => 400,
                'response' => null
            ], 400);
        }

        $user = \App\Models\User::where('api_token', $request->header('_token'))->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid _token',
                'error' => true,
                'code' => 400,
                'response' => null
            ], 400);
        }

        $request->merge([
            'user' => $user
        ]);

        return $next($request);
    }
}
