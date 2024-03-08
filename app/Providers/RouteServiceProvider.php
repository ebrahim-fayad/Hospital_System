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
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = 'user/dashboard';
    public const ADMIN = 'admin/dashboard';
    public const DOCTOR = 'doctor/dashboard';
    public const RayEmployee = 'ray_employee/dashboard';
    public const LaboratoryEmployee = 'laboratory_employee/dashboard';
    public const PATIENT = 'patient/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
            Route::middleware('web')
                ->group(base_path('routes/Backend.php'));
            Route::middleware('web')
                ->group(base_path('routes/doctor.php'));
            Route::middleware('web')
                ->group(base_path('routes/ray_employee.php'));
            Route::middleware('web')
                ->group(base_path('routes/laboratory_employee.php'));
            Route::middleware('web')
                ->group(base_path('routes/patient.php'));
        });
    }
}
