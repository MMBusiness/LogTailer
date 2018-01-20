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
    public function boot()
    {
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


        //
        // register our controller file  ?? WHY ??
   // $this->app->make('Mikromike\LogTailer\Controllers\');
   $this->loadViewsFrom(__DIR__.'/views', 'LogTailer');

    }

    public function provides()
 {
     return ['command.tail'];
 }

}
