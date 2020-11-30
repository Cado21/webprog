<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Providers\RouteServiceProvider;
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

Route::get(RouteServiceProvider::HOME, 'TypeController@index');
Route::get(RouteServiceProvider::SEARCH , 'ProductController@search');
Route::middleware(['role:admin|member'])->group( function () {
    Route::get('/product/detail/{id}' , 'ProductController@getById');
});

Route::middleware(['role:admin'])->group( function(){
    Route::get('/product/add' , 'ProductController@showCreateProduct');
    Route::post('/product/add' , 'ProductController@create')->name('product.add');
    
    Route::get('/product/edit/{id}' , 'ProductController@showEditProduct');
    Route::put('/product/edit/{id}' , 'ProductController@edit')->name('product.edit');
    
    Route::delete('/product/delete/{id}' , 'ProductController@delete')->name('product.delete');
    Route::get('/type', 'TypeController@showCreateType');
    Route::post('/type', 'TypeController@create');
    
    Route::get('/type/edit', 'TypeController@showEditType');
    Route::put('/type/edit/{id}', 'TypeController@editTypeName')->name('type.edit_name');
    
    Route::delete('/type/delete/{id}', 'TypeController@delete')->name('type.delete');
});

Route::middleware(['role:member'])->group( function(){

});
