<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckHeaderToken
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
//        if (!$request->header('_token')) {
//            return response()->json([
//                'message' => '_token required on header',
//                'error' => true,
//                'code' => 400,
//                'response' => null
//            ], 400);
//        }

        return $next($request);
    }
}
