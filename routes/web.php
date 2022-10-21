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

Auth::routes();

Route::middleware('auth') // il nostro "carabiniere con i baffoni" che ci autorizzera o meno a passare in base a se sei loggato o meno
        ->namespace('Admin') // ovvero cerco nella cartella Admin di Controllers
        ->name('admin.') // tutte le rotte inizieranno con il nome di admin.
        ->prefix('admin')  // ovvero tutte le rotte avranno /admin come inziio
        ->group(function () {
            Route::get('/', 'HomeController@index')->name('home');
            Route::resource('posts', 'PostController');
            Route::resource('categories', 'CategoryController');
            Route::resource('tags', 'TagController');


            Route::get('posts/restore/{post}', 'PostController@restore')->name('posts.restore');

            Route::delete('posts/deleteCover/{post}', 'PostController@deleteCover')->name('posts.deleteCover');
        });


Route::get('{any?}', function() {
    return view('guest.home');
})->where('any', '.*');
