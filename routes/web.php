<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagesController;
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
    return view('welcome');
});


//Auth::routes();
Auth::routes(['verify' => true]);
//Route::get('/home', 'HomeController@index')->middleware('verified');
//Route::get('/', 'PagesController@index');
Route::get('/', 'App\Http\Controllers\PostsController@index');
Route::get('/about', 'App\Http\Controllers\PagesController@about');
Route::get('/type0', 'App\Http\Controllers\PostsController@type0');
Route::get('/type1', 'App\Http\Controllers\PostsController@type1');
Route::get('/type2', 'App\Http\Controllers\PostsController@type2');

//Route::get('/services', 'PagesController@services');
//Route::post('follow/{user}', 'FollowsController@store');

Route::resource('posts', 'App\Http\Controllers\PostsController');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware('verified');
//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/profile/{user}', 'App\Http\Controllers\ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'App\Http\Controllers\ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'App\Http\Controllers\ProfilesController@update')->name('profile.update');

Route::resource('cart', 'App\Http\Controllers\CartController');
Route::delete('emptyCart', 'App\Http\Controllers\CartController@emptyCart');

