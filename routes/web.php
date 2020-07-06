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

Route::get('/', 'AppController@index')->name('front.index');

Route::get('/login', 'AuthController@login')->name('auth.login');
Route::post('/login', 'AuthController@doLogin')->name('auth.do.login');
Route::get('/register', 'AuthController@register')->name('auth.register');
Route::get('/logout', 'AuthController@logout')->name('auth.logout');

Route::prefix('admin')
    ->namespace('admin')
    ->name('admin.')
    ->middleware('is.admin')
    ->group(function() {

    Route::get('/', function() {
        return redirect()->route('admin.dashboard.index');
    });

    Route::resource('dashboard', 'DashboardController')->except([
        'delete',
        'update',
    ]);

    Route::post('user/destroy', 'UserController@destroy')->name('user.destroy');
    Route::post('user/update', 'UserController@update')->name('user.update');
    Route::resource('user', 'UserController')->except([
        'destroy',
        'update',
    ]);
});