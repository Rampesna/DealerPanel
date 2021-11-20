<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api/v1/general')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/v1/general.php'));

            Route::prefix('api/v1/customer')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/v1/customer.php'));

            Route::prefix('api/v1/dealerUser')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/v1/dealerUser.php'));

            Route::prefix('api/v1/user')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/v1/user.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->prefix('customer')
                ->group(base_path('routes/customer.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->prefix('dealerUser')
                ->group(base_path('routes/dealerUser.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->prefix('user')
                ->group(base_path('routes/user.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::none();
//            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
