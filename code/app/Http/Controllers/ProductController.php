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
    public function popularProducts($amount)
    {
        $bestSellingProducts = OrderContent::select('product_id', OrderContent::raw('SUM(product_quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit($amount)
            ->get();

        $products = Product::with('image')
            ->whereIn('id', $bestSellingProducts->pluck('product_id'))
            ->get()
            ->sortByDesc(function ($product) use ($bestSellingProducts) {
                return $bestSellingProducts->firstWhere('product_id', $product->id)->total_quantity ?? 0;
            })->values()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->{'name_' . session('language', 'english')},
                    'kcal' => $product->kcal,
                    'price' => $product->price,
                    'path' => $product->image ? asset('storage/' . $product->image->path) : null,
                    'alt' => $product->image ? $product->image->alt : null,
                    'description' => $product->{'description_' . session('language', 'english')},
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
        if (!in_array($language, ['english', 'dutch', 'german'])) {
            return response()->json(['error' => 'Invalid language']);
        }

        session(['language' => $language]);

        return response()->json(['language' => $language]);
    }

    public function setOrderType($orderType)
    {
        if (!in_array($orderType, ['Eat Here', 'Take Away'])) {
            return response()->json(['error' => 'Invalid order type']);
        }

        session(['orderType' => $orderType]);

        return response()->json(['orderType' => $orderType]);
    }

    public function resetOrder()
    {
        session()->forget('orderType');
        session()->forget('order');

        return to_route('images.index');
    }

    private function calculateTotalPrice()
    {
        $order = session('order', []);

        $totalPrice = 0;

        foreach ($order as $id => $orderItem) {
            $product = Product::find($id);

            if ($product) {
                $totalPrice += $product->price * $orderItem['quantity'];
            }
        }

        return $totalPrice;
    }

    public function addToOrder($id, $quantity = 1)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found']);
        }

        $order = session('order', []);

        if (array_key_exists($id, $order)) {
            $order[$id]['quantity'] += $quantity;
        } else {
            $order[$id] = [
                "quantity" => $quantity,
            ];
        }

        session(['order' => $order]);

        return response()->json(['order' => $order, 'totalPrice' => $this->calculateTotalPrice()]);
    }

    public function chooseOrder($category)
    {
        if (null === session('orderType')) {
            return to_route('images.index');
        }


        if (in_array($category, Category::pluck('name_english')->toArray()) || in_array($category, Category::pluck('name_dutch')->toArray()) || in_array($category, Category::pluck('name_german')->toArray())) {
            $language = session('language', 'english');

            if (!in_array($category, Category::pluck('name_' . $language)->toArray())) {
                $categoryInstance = Category::where('name_english', $category)
                    ->orWhere('name_dutch', $category)
                    ->orWhere('name_german', $category)
                    ->first();

                if ($categoryInstance) {
                    $category = $categoryInstance->{'name_' . $language};
                } else {
                    return to_route('images.index');
                }
            }

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
                    $query->where('name_english', $category)
                        ->orWhere('name_dutch', $category)
                        ->orWhere('name_german', $category);
                })
                ->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->{'name_' . session('language', 'english')},
                        'kcal' => $product->kcal,
                        'price' => $product->price,
                        'path' => $product->image ? asset('storage/' . $product->image->path) : null,
                        'alt' => $product->image ? $product->image->alt : null,
                        'description' => $product->{'description_' . session('language', 'english')},
                    ];
                });

            return Inertia::render('ChooseOrder/ChooseOrder', [
                'language' => $language,
                'categories' => $categories,
                'category' => $category,
                'popular' => $popular,
                'products' => $products,
                'totalPrice' => $this->calculateTotalPrice(),
            ]);
        } else {
            return to_route('images.index');
        }
    }

    public function yourOrder() {
        if(null === session('orderType')) {
            return to_route('images.index');
        }

        $order = session('order', []);
        $language = session('language', 'english');
        $orderType = session('orderType') === 'Eat Here' ? ($language === 'english' ? 'Eat Here' : ($language === 'dutch' ? 'Hier Eten' : 'Hier Essen')) : ($language === 'english' ? 'Take Away' : ($language === 'dutch' ? 'Afhalen' : 'Abheben'));
        
        $orderWithInformation = [];
        foreach($order as $id => $quantity) {
            $product = Product::with('image')->find($id);

            if($product) {
                $orderWithInformation[] = [
                    'id' => $product->id,
                    'name' => $product->{'name_' . session('language', 'english')},
                    'totalPrice' => $product->price,
                    'path' => $product->image ? asset('storage/' . $product->image->path) : null,
                    'alt' => $product->image ? $product->image->alt : null,
                    'quantity' => $quantity["quantity"],
                ];
            }
        }

        return Inertia::render('YourOrder/YourOrder', [
            'language' => session('language', 'english'),
            'order' => $orderWithInformation,
            'totalPrice' => $this->calculateTotalPrice(),
            'orderType' => $orderType,
        ]);
    }

    public function updateQuantity($id, $quantity) {
        $product = Product::find($id);

        if(!$product) {
            return response()->json(['error' => 'Product not found']);
        }

        $order = session('order', []);

        if(array_key_exists($id, $order)) {
            if($quantity == 0) {
                unset($order[$id]);
            } else {
                $order[$id]['quantity'] = $quantity;
            }
        }

        session(['order' => $order]);

        return response()->json(['order' => $order]);
    }

    public function payment()
    {
        return Inertia::render('Payment/Payment', [
            'language' => session('language', 'english'),
        ]);
    }
}
