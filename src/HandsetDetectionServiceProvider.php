<?php

namespace HandsetDetection\Laravel51LTS;

use Illuminate\Support\ServiceProvider;
use HandsetDetection;

class HandsetDetectionServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Set up the publishing of configuration
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/handsetdetection.php' => config_path('handsetdetection.php')
        ]);
    }

    /**
     * Register the HandsetDetection Instance to be set up with the config.
     * Then, the IoC-container can be used to get a HandsetDetection\HD4 instance ready for use.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('HandsetDetection', function($app) {
            $config = $app['config']['handsetdetection'];
            return new HD4($config);
        });
    }
}