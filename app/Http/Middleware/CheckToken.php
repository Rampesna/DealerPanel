<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $authType)
    {
        if (!$request->header('_token')) {
            return response()->json([
                'message' => '_token is required on header',
                'error' => true,
                'code' => 400,
                'response' => null
            ]);
        }

        if (!$request->header('_auth_type')) {
            return response()->json([
                'message' => '_auth_type is required on header',
                'error' => true,
                'code' => 400,
                'response' => null
            ]);
        }

        if ($request->header('_auth_type') != $authType) {
            return response()->json([
                'message' => 'Invalid _auth_type',
                'error' => true,
                'code' => 400,
                'response' => null
            ]);
        }

        $model = 'App\\Models\\' . ucwords($authType);
        $dealer = $model::where('api_token', $request->header('_token'))->first();

        if (!$dealer) {
            return response()->json([
                'message' => 'Invalid _token',
                'error' => true,
                'code' => 400,
                'response' => null
            ]);
        }

        $request->merge([
            'dealer' => $dealer
        ]);

        return $next($request);
    }
}
