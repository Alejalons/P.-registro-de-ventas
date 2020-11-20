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
    return view('auth.login');
});


Auth::routes();
Route::resource('user', App\Http\Controllers\UserController::class);
Route::get('/home', [App\Http\Controllers\SaleController::class, 'index'])->name('home');
Route::resource('sale', App\Http\Controllers\SaleController::class);
Route::get('search_ajax', App\Http\Controllers\SaleController::class.'@selectSearch');
Route::get('price_ajax', App\Http\Controllers\SaleController::class.'@insertPrice');

// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
