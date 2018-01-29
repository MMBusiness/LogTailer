<?php

namespace Mikromike\LogTailer;

use Illuminate\Support\Facades\Route;

trait Test {

    public static function Init()
    {
        Route::get('/test', function(){
            return view('logtailer/jihuu');
        //  die('Route works from package! namespace Mikromike\LogTailer');
        });
    }

}
