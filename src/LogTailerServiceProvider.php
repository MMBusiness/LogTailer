<?php

namespace Mikromike\LogTailer;

use Illuminate\Support\ServiceProvider;

class LogTailerServiceProvider extends ServiceProvider
{
/**
  * Indicates if loading of the provider is deferred.
  *
  * @var bool
  */
 protected $defer = true;




    public function boot()
    { //

        // delicated route file for packages
     include __DIR__.'/routes.php';   // ok
     // - first the published/overwritten views (in case they have any changes)
   $this->loadViewsFrom(resource_path('/views/LogTailer'), '');
    $this->loadViewsFrom(realpath(__DIR__.'/Views'), 'LogTailer');

    $this->publishes([
        __DIR__ . '/Views' => base_path('resources/views/vendor/LogTailer')
      ], 'views');

      // publish config file
       $this->publishes([__DIR__.'/Config' => config_path()], 'config');

    }


      // second way not yet actived

//      {
//       $this->publishes([
//           __DIR__.'/config/tail.php' => config_path('tail.php'),
//       ], 'config');
//   }


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


    // test second option whatis different than above
//    {
//    $this->app['command.tail'] = $this->app->share(
  //      function ($app) {
  //          return new TailCommand();
  //      }
  //  );
  //  $this->commands('command.tail');
//}


    public function provides()
 {
     return ['command.tail'];
 }

}
