<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => false]);

Route::get('/admin', 'Admin\HomeController@index')->middleware('auth')->name('admin.home');

//amministrazione
Route::middleware('auth')
    ->prefix('admin') //ulr iniziale
    ->namespace('Admin') //controller folder
    ->name('admin.') // aggiunge al nome
    ->group(function () {

        // Admin
        Route::get('/', 'HomeController@index')->name('home');

        // Posts
        Route::resource('posts', 'PostController');

        Route::get('/{any}', function () { //qualunque cosa crivo dopo /admin mi manda alla 404
            abort('404');
        })->where('any', '.*');
    });

Route::get('/{any?}', function () { //qualunque cosa mi manda in guest home
    return view('guest.home');
})->where('any', '.*');
