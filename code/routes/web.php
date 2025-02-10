<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Inertia\Inertia;

Route::get('/', [ImageController::class, 'index'])->name('images.index');

Route::get('/choose-order', function () {
    $imageController = new ImageController();
    return to_route('products.chooseOrder', ['category' => $imageController->categoryBasedOnTime()]);
});
Route::get('/choose-order/{category}', [ProductController::class, 'chooseOrder'])->name('products.chooseOrder');
Route::get('/add-to-order/{id}/{quantity}', [ProductController::class, 'addToOrder'])->name('products.addToOrder');

Route::get('/your-order', [OrderController::class, 'yourOrder'])->name('order.yourOrder');

Route::get('/payment', [OrderController::class, 'payment'])->name('order.payment');

Route::get('/finished-order', [OrderController::class, 'finishedOrder'])->name('order.finishedOrder');

// api routes
Route::get('/reset-order', [ProductController::class, 'resetOrder'])->name('products.resetOrder');
Route::get('/set-language/{language}', [ProductController::class, 'setLanguage'])->name('products.setLanguage');
Route::get('/set-order-type/{orderType}', [ProductController::class, 'setOrderType'])->name('products.setOrderType');
Route::get('/update-quantity/{id}/{quantity}', [ProductController::class, 'updateQuantity'])->name('products.updateQuantity');