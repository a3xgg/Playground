<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
		protected $namespace = 'App\Http\Controllers';
		
		protected $browser = 'App\Http\Controllers\Browser';

		protected $admin = 'App\Http\Controllers\Admin';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        // $this->mapApiRoutes();

				$this->mapWebRoutes();
				
				$this->mapAdminRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
			Route::middleware('web')
				->name('browser.')
				->domain(env('APP_URL'))
				->namespace($this->browser)
				->group(base_path('routes/browser/web.php'));
		}
		
		protected function mapAdminRoutes() {
			Route::middleware('web')
				->name('admin.')
				->domain('admin.' . env('DOMAIN_NAME'))
				->namespace($this->admin)
        ->group(base_path('routes/admin/web.php'));
        
			Route::middleware('api')
				->prefix('admin/api/')
				->name('admin.api.')
				->namespace($this->admin)
				->group(base_path('routes/admin/api.php'));
		}

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    // protected function mapApiRoutes()
    // {
    //     Route::prefix('api')
    //          ->middleware('api')
    //          ->namespace($this->namespace)
    //          ->group(base_path('routes/api.php'));
    // }
}
