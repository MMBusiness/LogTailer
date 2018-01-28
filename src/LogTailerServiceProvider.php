<?php

namespace Mikromike\LogTailer;

use Illuminate\Support\ServiceProvider;

class LogTailerServiceProvider extends ServiceProvider
{

    public function boot()
    { //

        // delicated route file for packages
     include __DIR__.'/routes.php';   // ok
     // - first the published/overwritten views (in case they have any changes)
   $this->loadViewsFrom(resource_path('views/vendor/LogTailer'), '');
    $this->loadViewsFrom(realpath(__DIR__.'Views'), 'LogTailer');

    $this->publishes([
        __DIR__ . 'Views' => base_path('resources/views/vendor/LogTailer')
      ], 'views');

      // publish config file
       $this->publishes([__DIR__.'/Config' => config_path()], 'config');

    }

    public function register()
    {
      // Console command
      if ($this->app->runningInConsole()) {
                 $this->commands([
                     TailCommand::class,
                 ]);
             }
           // register Blade view path
             $this->loadViewsFrom(__DIR__.'/Views', 'LogTailer');
    }


    public function provides()
 {
     return ['command.tail'];
 }

}
