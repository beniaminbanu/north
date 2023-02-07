<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing\Providers;

use App\Packages\Localization\Facades\Localization;
use App\Packages\Sluggable\Routing\Sluggable;
use Illuminate\Support\ServiceProvider;

class SluggableProvider extends ServiceProvider
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
        $this->app->singleton(Sluggable::class, function($app) {
            return new Sluggable($app, Localization::getCurrentLocale());
        });

        $this->app->alias(Sluggable::class, 'sluggable');
    }
}
