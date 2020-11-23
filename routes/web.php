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


Route::get('/', 'TypeController@getAll');

Route::get('/product/search' , 'ProductController@search');
Route::get('/product/detail/{id}' , 'ProductController@getById');

// Route::get('/login', 'AuthController@showLoginForm');
// Route::post('/login',  'AuthController@login');
// Route::get('/logout',  'AuthController@logout');
// Route::get('/register', 'AuthController@showRegisterForm');
// Route::post('/register', 'AuthController@register');

Auth::routes();

