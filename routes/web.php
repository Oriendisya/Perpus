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

    Route::get('user/datatable', 'UserController@datatable')->name('user.datatable');
    Route::get('user/destroy/{id}', 'UserController@destroy')->name('user.destroy');
    Route::post('user/update/{id}', 'UserController@update')->name('user.update');
    Route::resource('user', 'UserController')->except([
        'destroy',
        'update',
    ]);

    Route::get('book/datatable', 'BookController@datatable')->name('book.datatable');
    Route::get('book/destroy/{id}', 'BookController@destroy')->name('book.destroy');
    Route::post('book/update/{id}', 'BookController@update')->name('book.update');
    Route::resource('book', 'BookController')->except([
        'destroy',
        'update',
    ]);
});