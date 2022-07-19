<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
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



Route::get('{lang}/categories', [CategoryController::class, 'index']);

Route::get('{lang}/categories/{category}', [CategoryController::class, 'show']);

Route::get('{lang}/categories/{category}/products/{product}', [ProductController::class, 'index']);

Route::get('{lang}/categories/{category}/products/{product}/{sku}', [ProductController::class, 'show']);
