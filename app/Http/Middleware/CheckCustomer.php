<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCustomer
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
//        if ($request->header('_auth_type') != 'Customer') {
//            return response()->json([
//                'message' => 'Invalid _auth_type',
//                'error' => true,
//                'code' => 400,
//                'response' => null
//            ], 400);
//        }

        $customer = \App\Models\Customer::where('api_token', $request->header('_token'))->first();

//        if (!$customer) {
//            return response()->json([
//                'message' => 'Invalid _token',
//                'error' => true,
//                'code' => 400,
//                'response' => null
//            ], 400);
//        }

        $request->merge([
            'customer' => $customer
        ]);

        return $next($request);
    }
}
