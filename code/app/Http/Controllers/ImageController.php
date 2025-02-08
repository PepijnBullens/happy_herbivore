<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\OrderStatus;
use App\Models\OrderContent;
use App\Models\Product;

class ImageController extends Controller
{
    public function popularProductImages() {
            // Get the 5 most ordered products
            $bestSellingProducts = OrderContent::select('product_id', OrderContent::raw('SUM(product_quantity) as total_quantity'))
                ->groupBy('product_id')
                ->orderByDesc('total_quantity')
                ->limit(5)
                ->get();
        
            $products = collect(); // Initialize $products as a collection
        
            // If we have best selling products
            if ($bestSellingProducts->isNotEmpty()) {
                $products = Product::with('image')
                    ->whereIn('id', $bestSellingProducts->pluck('product_id'))
                    ->get();
            }
        
            // If we have less than 5 best-selling products, fill up with random products
            if ($products->count() < 5) {
                $remainingCount = 5 - $products->count();
                $randomProducts = Product::with('image')
                    ->whereNotIn('id', $products->pluck('id')->toArray())
                    ->inRandomOrder()
                    ->limit($remainingCount)
                    ->get();
                
                $products = $products->merge($randomProducts);
            }
        
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

    public function index() {
        if(null !== session('orderType')) {
            return to_route('products.chooseOrder');
        }

        return Inertia::render('Welcome/Welcome', [
            'language' => session('language', 'en'),
            'images' => $this->popularProductImages(),
        ]);
    }
    
    public function orderType() {
        if(null !== session('orderType')) {
            return to_route('products.chooseOrder');
        }
        
        return Inertia::render('Welcome/OrderType', [
            'language' => session('language', 'en'),
            'images' => $this->popularProductImages(),
        ]);
    }
}
