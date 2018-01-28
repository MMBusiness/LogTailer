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
        $this->registerViews();
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
             $this->loadViewsFrom(__DIR__.'/Views', 'LogTailer');

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

     /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/user');  // DESTANATION ->
        $sourcePath = __DIR__.'/Views';
        $this->publishes([
            $sourcePath => $viewPath
        ],'views');
      //  $this->loadViewsFrom(array_merge(array_map(function ($path) {
      //      return $path . '/modules/user';
      //  }, \Config::get('view.paths')), [$sourcePath]), 'user');
    }


    public function provides()
 {
     return ['command.tail'];
 }

}
