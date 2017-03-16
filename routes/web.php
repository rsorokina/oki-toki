<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //Session::forget('dashboard');
    return view('dashboard');
});


Route::get('/news', function () {
    return view('widgets.news');
});

Route::get('/bar', function () {
    return view('widgets.bar');
});


Route::post('/set-dashboard', function () {
    Session::put('dashboard', Request::input('dashboard'));
    return Response::json(['dashboard'=> Session::get('dashboard')]);
});

Route::get('/get-dashboard', function () {
    return Response::json(['dashboard'=> Session::get('dashboard')]);
});
