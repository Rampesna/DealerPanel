<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckHeaderAuthType
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
//        if (!$request->header('_auth_type')) {
//            return response()->json([
//                'message' => '_auth_type required on header',
//                'error' => true,
//                'code' => 400,
//                'response' => null
//            ], 400);
//        }

        return $next($request);
    }
}
