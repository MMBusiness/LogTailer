<?php

namespace Mikromike\LogTailer;

use Illuminate\Support\Facades\Route;

trait Test {

    public static function Init()
    {
        Route::get('/test', function(){
            return view('vendor/LogTailer/welcome');
        //  die('Route works from package! namespace Mikromike\LogTailer');
        });
    }

}
