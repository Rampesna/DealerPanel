<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMethod
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $methods)
    {
        if (checkMethod($request->method(), explode('|', $methods)) === 0) {
            return response()->json([
                'message' => 'Method not allowed. Allowed methods: ' . $methods,
                'error' => false,
                'code' => 405,
                'response' => null
            ], 405);
        }
        return $next($request);
    }
}
