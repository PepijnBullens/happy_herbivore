<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;

class ImageController extends Controller
{
    public function popularProductImages($amount) {
        $productController = new ProductController();
        $products = $productController->popularProducts($amount);

        $images = [];
    
        foreach ($products as $product) {
            if ($product['path']) {
                $images[] = [
                    'path' => $product['path'],
                    'alt' => $product['alt'],
                ];
            }
        }

        return $images;
    }

    public function categoryBasedOnTime() {
        $categories = [
            'Breakfast' => ['06:00', '11:00'],
            'Lunch & Dinner' => ['11:00', '17:00'],
            'Drinks' => ['22:00', '06:00'],
        ];

        $currentTime = now()->format('H:i');

        foreach ($categories as $category => $times) {
            if ($times[0] < $times[1]) {
                if ($currentTime >= $times[0] && $currentTime < $times[1]) {
                    return $category;
                }
            } else {
                if ($currentTime >= $times[0] || $currentTime < $times[1]) {
                    return $category;
                }
            }
        }

        return 'Breakfast';
    }

    public function index() {
        if(null !== session('orderType')) {
            return to_route('products.chooseOrder', ['category' => $this->categoryBasedOnTime()]);
        }

        return Inertia::render('Welcome/Welcome', [
            'language' => session('language', 'english'),
            'images' => $this->popularProductImages(5),
        ]);
    }
    
    public function orderType() {
        if(null !== session('orderType')) {
            return to_route('products.chooseOrder');
        }
        
        return Inertia::render('Welcome/OrderType', [
            'language' => session('language', 'english'),
            'images' => $this->popularProductImages(5),
        ]);
    }
}
