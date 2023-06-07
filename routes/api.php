<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/** Mapping route API categories */
Route::get('categories', [CategoryController::class, 'index'])->name('api.category.index');
Route::post('category', [CategoryController::class, 'store'])->name('api.category.store');
Route::get('category/{category}', [CategoryController::class, 'show'])->name('api.category.show');
Route::put('category/{category}', [CategoryController::class, 'update'])->name('api.category.update');
Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('api.category.destroy');

/** Mapping route API products */
Route::get('products', [ProductController::class, 'index'])->name('api.product.index');
Route::post('product', [ProductController::class, 'store'])->name('api.product.store');
Route::get('product/{product}', [ProductController::class, 'show'])->name('api.product.show');
Route::put('product/{product}', [ProductController::class, 'update'])->name('api.product.update');
Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('api.product.destroy');

/** Mapping route API images */
Route::get('images', [ImageController::class, 'index'])->name('api.image.index');
Route::post('images', [ImageController::class, 'store'])->name('api.image.store');
Route::get('image/{image}', [ImageController::class, 'show'])->name('api.image.show');
Route::put('image/{image}', [ImageController::class, 'update'])->name('api.image.update');
Route::delete('image/{image}', [ImageController::class, 'destroy'])->name('api.image.destroy');
