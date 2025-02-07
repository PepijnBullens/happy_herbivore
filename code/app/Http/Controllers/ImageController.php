<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\OrderStatus;
use App\Models\OrderContent;
use App\Models\Product;

class ImageController extends Controller
{
    public function index() {
        // Get the 5 most ordered products
        $bestSellingProducts = OrderContent::select('product_id', OrderContent::raw('SUM(product_quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();
    
        $products = collect(); // Initialize $products as a collection
    
        // If we have best selling products
        if ($bestSellingProducts->isNotEmpty()) {
            $products = Product::with('image') // This will eager load the image relationship
                ->whereIn('id', $bestSellingProducts->pluck('product_id'))
                ->get();
        }
    
        // If we have less than 5 best-selling products, fill up with random products
        if ($products->count() < 5) {
            $remainingCount = 5 - $products->count();
            $randomProducts = Product::with('image') // Eager load images for random products too
                ->whereNotIn('id', $products->pluck('id')->toArray())
                ->inRandomOrder()
                ->limit($remainingCount)
                ->get();
            
            // Merge the random products into the $products collection
            $products = $products->merge($randomProducts);
        }
    
        // Prepare image data
        $images = [];
    
        foreach ($products as $product) {
            // Check if product has an associated image
            if ($product->image) {
                $images[] = [
                    'path' => $product->image->path, // Assuming the 'path' field is in the 'images' table
                    'alt' => $product->image->alt,   // Assuming the 'alt' field is in the 'images' table
                ];
            }
        }
    
        return Inertia::render('Welcome', [
            'language' => session('language', 'en'),
            'products' => $products,
            'images' => $images, // Return images alongside products
        ]);
    }
    
    
}
