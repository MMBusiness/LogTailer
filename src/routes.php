<?php

Route::get('logger', function(){
	echo 'Hello from the logger package!, Looks like view has registered correctly at src/LogTailerServiceProvider.php';
});
Route::get('/pub', function () {
    return view('index');
});
