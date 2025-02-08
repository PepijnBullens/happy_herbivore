<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;

class ImageController extends Controller
{
    public function popularProductImages() {
        $productController = new ProductController();
        $products = $productController->popularProducts(5);

        $images = [];
    
        foreach ($products as $product) {
            if ($product->image) {
                $images[] = [
                    'path' => $product->image->path,
                    'alt' => $product->image->alt,
                ];
            }
        }

        return $images;
    }

    public function categoryBasedOnTime() {
        $categories = [
            'Breakfast' => ['06:00', '11:00'],
            'Lunch & Dinner' => ['17:00', '22:00'],
            'Drinks' => ['22:00', '06:00'],
        ];

        $currentTime = now()->format('H:i');

        foreach ($categories as $category => $times) {
            if ($currentTime >= $times[0] && $currentTime <= $times[1]) {
                return $category;
            }
        }
    }

    public function index() {
        if(null !== session('orderType')) {
            return to_route('products.chooseOrder', ['category' => $this->categoryBasedOnTime()]);
        }

        return Inertia::render('Welcome/Welcome', [
            'language' => session('language', 'english'),
            'images' => $this->popularProductImages(),
        ]);
    }
    
    public function orderType() {
        if(null !== session('orderType')) {
            return to_route('products.chooseOrder');
        }
        
        return Inertia::render('Welcome/OrderType', [
            'language' => session('language', 'english'),
            'images' => $this->popularProductImages(),
        ]);
    }
}
