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

Route::get('/', 'Pages@show');
Route::get('items/{id}', 'Pages@items');
Route::get('showitem/{id}', 'Pages@showitem');
Route::get('showsearchget/{result}', 'Pages@showSearchGet');

Route::post('showsearch', 'Pages@showSearch');
Route::get('contact', 'Pages@contact');
Route::post('addcontact', 'Pages@addcontact');

//cart
Route::get('addcart/{id?}', 'ItemsController@addCart');
Route::get('addcartsearch/{id}/{result}', 'ItemsController@addCartSearch');
Route::get('showcart/{userid}', 'ItemsController@showcart');
Route::get('deletecart/{id}/{userid}', 'ItemsController@deletecart');
Route::get('deleteallcartuser/{userid}', 'ItemsController@deleteAllCartUser');

Route::post('updatecart', 'ItemsController@updateCart');


//order
Route::get('addorder/{userid}', 'ItemsController@addorder');
Route::get('showorder/{userid}', 'ItemsController@showorder');

Route::get('ajaxshow/{id}', 'ItemsController@ajaxshow');

//
Route::get('home', 'HomeController@index')->name('home');

//Auth
Auth::routes();

Route::get('logout', function () {
    Session::flush();
    Auth::logout();
    return Redirect::to("login");
});
