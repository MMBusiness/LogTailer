<?php

namespace Mikromike\LogTailer;

use Illuminate\Support\ServiceProvider;

class LogTailerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
     /**
         * Boot the application events.
         *
         * @return void
         */


    public function boot()
    { //
        $this->registerConfig();
        // delicated route file for packages
        include __DIR__.'/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      // Console command
      if ($this->app->runningInConsole()) {
                 $this->commands([
                     TailCommand::class,
                 ]);
             }


             // register Blade view path
             $this->loadViewsFrom(__DIR__.'/views', 'LogTailer');

    }

    protected function registerConfig()
     {
         $this->publishes([
             __DIR__.'/Config/config.php' => config_path('user.php'),
         ], 'config');
         $this->mergeConfigFrom(
             __DIR__.'/Config/config.php', 'user'
         );
     }


    public function provides()
 {
     return ['command.tail'];
 }

}
