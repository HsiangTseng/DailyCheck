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
    return view('dashboard.frontend.new_index');

});

Route::match(['post','get'], '/Home', function () {
    return view('dashboard.frontend.Home');
})->name('Home');

Route::match(['post','get'],'/Workspace', function () {
    return view('dashboard.frontend.workspace');
})->name('Workspace');

Route::get('/EditStock', function () {
    return view('dashboard.frontend.EditStock');
})->name('EditStock');

Route::post('/EditStock', 'StockController@editStockList');



//-------------About account like Login or Register-------------
Route::get('/Login', function () {
    return view('dashboard.frontend.login');
})->name('Login');

Route::post('/Login', 'UserController@loginProcess');

Route::get('/Register', function () {
    return view('dashboard.frontend.Register');
});

Route::post('/Register', 'UserController@registerProcess');


Route::get('/WrongUser', function () {
    return view('dashboard.frontend.wronguser');
})->name('WrongUser');
//-------------About account like Login or Register-------------




//-------------Function or Ajax-------------
Route::post('/PostGetPrice', 'StockController@getPrice');
Route::post('/PostGetName', 'StockController@getName');


