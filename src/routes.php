<?php

Route::get('logger', function(){
	echo 'Hello from the logger package!, Looks like view has registered correctly at src/LogTailerServiceProvider.php';
});
Route::get('/foobar', function () {
    return view('LogTailer::layout.home');
});
