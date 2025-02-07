<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;

Route::get('/', [ImageController::class, 'index'])->name('images.index');

Route::get('/set-language/{language}', [ProductController::class, 'setLanguage'])->name('products.setLanguage');