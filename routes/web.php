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

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('/extra-pages')->group(function()
{
    Route::get('/{page}','ExtraPagesController@page')->name("extra");
});

Route::resource('/products','ProductsController')->parameters(['product'=>'id'])->except(['create']);

Route::prefix('/products')->group(function()
{
    Route::any('/json/{function}','ProductsController@json');
    Route::any('/json/{function}/{id}','ProductsController@json');
});

Route::prefix('/admin')->name('admin.')->group(function()
{
    Route::get('/login','AdminController@login')->name('login');
    Route::post('/login','AdminController@request_login')->name('req_login');
    Route::get('/logout','AdminController@logout')->name('logout');
});
Route::resource('/admin', 'AdminController');
