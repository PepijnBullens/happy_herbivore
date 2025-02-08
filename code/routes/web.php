<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use Inertia\Inertia;

Route::get('/', [ImageController::class, 'index'])->name('images.index');

Route::get('/choose-order', function () {
    $imageController = new ImageController();
    return to_route('products.chooseOrder', ['category' => $imageController->categoryBasedOnTime()]);
});

Route::get('/choose-order/{category}', [ProductController::class, 'chooseOrder'])->name('products.chooseOrder');

Route::get('/remove-order-type', [ProductController::class, 'removeOrderType'])->name('products.removeOrderType');


Route::get('/set-language/{language}', [ProductController::class, 'setLanguage'])->name('products.setLanguage');
Route::get('/set-order-type/{orderType}', [ProductController::class, 'setOrderType'])->name('products.setOrderType');