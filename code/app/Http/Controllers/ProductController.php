<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\OrderContent;
use App\Models\Product;
use App\Models\Image;

class ProductController extends Controller
{
    public function popularProducts($amount) {
        $bestSellingProducts = OrderContent::select('product_id', OrderContent::raw('SUM(product_quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit($amount)
            ->get();
    
        $products = Product::with('image')
            ->whereIn('id', $bestSellingProducts->pluck('product_id'))
            ->get()
            ->sortByDesc(function($product) use ($bestSellingProducts) {
                return $bestSellingProducts->firstWhere('product_id', $product->id)->total_quantity ?? 0;
            })->values()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->{'name_' . session('language')},
                    'kcal' => $product->kcal,
                    'price' => $product->price,
                    'path' => $product->image ? asset('storage/' . $product->image->path) : null,
                    'alt' => $product->image ? $product->image->alt : null,
                ];
            });
    
        if ($products->count() < $amount) {
            $remainingCount = $amount - $products->count();
            $randomProducts = Product::with('image')
                ->whereNotIn('id', $products->pluck('id')->toArray())
                ->inRandomOrder()
                ->limit($remainingCount)
                ->get();
            
            $products = $products->merge($randomProducts);
        }
    
        return $products;
    }
    

    public function setLanguage($language)
    {
        if(!in_array($language, ['english', 'dutch', 'german'])) {
            return response()->json(['error' => 'Invalid language']);
        }

        session(['language' => $language]);

        return response()->json(['language' => $language]);
    }

    public function setOrderType($orderType)
    {
        if(!in_array($orderType, ['eatHere', 'takeAway'])) {
            return response()->json(['error' => 'Invalid order type']);
        }

        session(['orderType' => $orderType]);

        return response()->json(['orderType' => $orderType]);
    }

    public function removeOrderType()
    {
        session()->forget('orderType');

        return to_route('images.index');
    }

    public function chooseOrder($category) {
        if (null === session('orderType')) {
            return to_route('images.index');
        }

        if(!in_array($category, Category::pluck('name_english')->toArray())) {
            return to_route('images.index');
        }

        $language = session('language');
        
        $categories = Category::with('image')->get()->map(function ($category) use ($language) {
            return [
                'id' => $category->id,
                'name' => $category->{'name_' . $language},
                'path' => $category->image ? asset('storage/' . $category->image->path) : null,
                'alt' => $category->image ? $category->image->alt : null,
            ];
        });

        $popular = $this->popularProducts(4);

        $products = Product::with('image')
            ->whereHas('category', function ($query) use ($category) {
                $query->where('name_english', $category);
            })
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->{'name_' . session('language')},
                    'kcal' => $product->kcal,
                    'price' => $product->price,
                    'path' => $product->image ? asset('storage/' . $product->image->path) : null,
                    'alt' => $product->image ? $product->image->alt : null,
                ];
            });

        return Inertia::render('ChooseOrder/ChooseOrder', [
            'language' => session('language'),
            'categories' => $categories,
            'category' => $category,
            'popular' => $popular,
            'products' => $products,
        ]);
    }
}
