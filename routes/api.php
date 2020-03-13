<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 * Routes for Users
 */
Route::resource('users', 'User\UserController', ['except' => ['create','edit']]);
/**
 * Routes for Categories
 */
Route::resource('categories', 'Category\CategoryController', ['except' => ['create','edit']]);
/**
 * Routes for Brands
 */
Route::resource('brands', 'Brand\BrandController', ['except' => ['create','edit']]);
/**
 * Routes for Products
 */
Route::resource('products', 'Product\ProductController', ['except' => ['create','edit']]);
