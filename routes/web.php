<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

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
// All Access 
Route::get('/', 'TypeController@index');

Route::get('/product/add' , 'ProductController@showCreateProduct');
Route::post('/product/add' , 'ProductController@create')->name('product.add');
Route::get('/product/search' , 'ProductController@search');
Route::get('/product/detail/{id}' , 'ProductController@getById');

// Admin Access
Route::get('/type', 'TypeController@showCreateType');
Route::post('/type', 'TypeController@create');

Route::get('/type/edit', 'TypeController@showEditType');
Route::put('/type/edit/{id}', 'TypeController@editTypeName')->name('type.edit_name');

Route::delete('/type/delete/{id}', 'TypeController@delete')->name('type.delete');;

// Member Access
// cart