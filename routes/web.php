<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', 'TestController@index');


Route::get('/html-output/{viewName}', 'ServiceController@viewReport');


Route::post('/service/print/report', 'ServiceController@print');
Route::post('/service/print/shipping', 'ServiceController@printShipping');