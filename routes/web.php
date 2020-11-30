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
Route::middleware(['auth'])->group( function () {
    Route::middleware(['role:admin|member'])->group( function () {
        Route::get(RouteServiceProvider::PRODUCT . '/detail/{id}' , 'ProductController@getById');
    });
    
    Route::middleware(['role:admin'])->group( function(){
        Route::get(RouteServiceProvider::PRODUCT . '/add' , 'ProductController@showCreateProduct');
        Route::post(RouteServiceProvider::PRODUCT . '/add' , 'ProductController@create')->name('product.add');
        Route::get(RouteServiceProvider::PRODUCT . '/edit/{id}' , 'ProductController@showEditProduct');
        Route::put(RouteServiceProvider::PRODUCT . '/edit/{id}' , 'ProductController@edit')->name('product.edit');
        
        Route::delete(RouteServiceProvider::PRODUCT . '/delete/{id}' , 'ProductController@delete')->name('product.delete');
        Route::get(RouteServiceProvider::TYPE , 'TypeController@showCreateType');
        Route::post(RouteServiceProvider::TYPE , 'TypeController@create');
        
        Route::get(RouteServiceProvider::TYPE . '/edit', 'TypeController@showEditType');
        Route::put(RouteServiceProvider::TYPE . '/edit/{id}', 'TypeController@editTypeName')->name('type.edit_name');
        
        Route::delete(RouteServiceProvider::TYPE . '/delete/{id}', 'TypeController@delete')->name('type.delete');
    });
    
    Route::middleware(['role:member'])->group( function(){
        Route::get(RouteServiceProvider::CART , 'CartController@getAll');
        Route::post(RouteServiceProvider::CART . '/add/{product_id}' , 'CartController@create');
    });
});