<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Localization\Providers;

use App\Packages\Localization\Localization;
use Illuminate\Support\ServiceProvider;

class LocalizationProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Localization::class, function($app) {
            return new Localization($app);
        });

        $this->app->alias(Localization::class, 'localization');
    }
}
