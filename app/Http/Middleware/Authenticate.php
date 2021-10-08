<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {

            if ($request->is('customer') || $request->is('customer/*')) {
                return route('customer.login');
            }

            if ($request->is('dealer') || $request->is('dealer/*')) {
                return route('dealer.login');
            }

            if ($request->is('user') || $request->is('user/*')) {
                return route('user.login');
            }

            abort(404);
        }
    }
}
