<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;

Route::get('/', [ImageController::class, 'index'])->name('images.index');
Route::get('/choose-order', [ProductController::class, 'chooseOrder'])->name('products.chooseOrder');
Route::get('/remove-order-type', [ProductController::class, 'removeOrderType'])->name('products.removeOrderType');


Route::get('/set-language/{language}', [ProductController::class, 'setLanguage'])->name('products.setLanguage');
Route::get('/set-order-type/{orderType}', [ProductController::class, 'setOrderType'])->name('products.setOrderType');