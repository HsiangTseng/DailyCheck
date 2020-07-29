<?php

use Illuminate\Support\Facades\Route;

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
    return view('dashboard.frontend.index');

});

Route::get('/Home', function () {
    return view('dashboard.frontend.Home');

});

Route::get('/workspace', function () {
    return view('dashboard.frontend.workspace');

});

Route::get('/Login', function () {
    return view('dashboard.frontend.login');

});

Route::get('/WrongUser', function () {
    return view('dashboard.frontend.wronguser');

});


Route::post('/check_login', 'UserController@check_account');
Route::get('/check_api', 'StockController@index');
Route::get('CheckPrice/{name?}', function ($name = null) {
    return $name;
});
