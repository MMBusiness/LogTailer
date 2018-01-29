<?php

namespace Mikromike\LogTailer;

use Illuminate\Support\Facades\Route;

trait Test {

    public static function Init()
    {
        Route::get('/test', function(){
            return view('vendor/logtailer/jihuu');
        //  die('Route works from package! namespace Mikromike\LogTailer');
        });
    }

}
