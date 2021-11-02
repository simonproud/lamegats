<?php

namespace SimonProud\Lamegats;

use Illuminate\Support\ServiceProvider;
use SimonProud\Lamegats\Facades\Lamegats;

class LamegatsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('vats.php'),
            ], 'config');

        }
        if ($this->app->runningInConsole()) {
            // Export the migration
            if (! class_exists('CreateLamegatsVatsTables')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/vats_systems.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_lamegats_vats_tables.php'),
                    // you can add any number of migrations here
                ], 'migrations');
            }
        }
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'vats');

        $this->app->make('SimonProud\Lamegats\Controllers\ATSController');
        $this->app->bind('lamegats', function($app) {
            return new Lamegats();
        });

    }
}
