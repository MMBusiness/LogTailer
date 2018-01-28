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
      //  $this->registerConfig();
      //  $this->registerViews();
       //$configPath = __DIR__.'/Config/config.php';
       //$this->publishes([$configPath => config_path('config.php')], 'config');

        // delicated route file for packages
     include __DIR__.'/routes.php';   // ok
     // - first the published/overwritten views (in case they have any changes)
     $this->loadViewsFrom(resource_path('views/vendor/LogTailer'), '');
      $this->loadViewsFrom(realpath(__DIR__.'./Views'), 'LogTailer');
    //
    //  $this->loadViewsFrom(__DIR__ . './views', 'logtailer');   // does not register
      $this->publishes([
        __DIR__ . './Views' => base_path('resources/views/vendor/LogTailer')
      ], 'views');

      // publish config file
       $this->publishes([__DIR__.'/Config' => config_path()], 'config');

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
             $this->loadViewsFrom(__DIR__.'/Views', 'LogTailer');
    }

     //protected function registerConfig()
    // {
    //     $this->publishes([
    //         __DIR__.'/Config/config.php' => config_path('user.php'),
    //     ], 'config');
    //     $this->mergeConfigFrom(
    //         __DIR__.'/Config/config.php', 'user'
      //   );
    // }

     /**
     * Register views.
     *
     * @return void
     */
    //public function registerViews()
    //{
    //    $viewPath = resource_path('views/modules/user');  // DESTANATION ->
    //    $sourcePath = __DIR__.'/Views';
    //    $this->publishes([
    //        $sourcePath => $viewPath
    //    ],'views');
      //  $this->loadViewsFrom(array_merge(array_map(function ($path) {
      //      return $path . '/modules/user';
      //  }, \Config::get('view.paths')), [$sourcePath]), 'user');
  //  }


    public function provides()
 {
     return ['command.tail'];
 }

}
