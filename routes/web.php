<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/test', 'TestController@index');

Route::post('/service/print/report', 'ServiceController@print');
Route::post('/service/print/shipping', 'ServiceController@printShipping');