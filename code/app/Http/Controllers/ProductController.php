<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\OrderContent;
use App\Models\Product;
use App\Models\Image;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function popularProducts($amount)
    {
        // Get the best selling products
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

        // If there are not enough best selling products, add random products
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

    public function addToOrder($id, $quantity = 1)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found']);
        }

        $order = session('order.orderContent', []);

        // Check if the product is already in the order
        if (array_key_exists($id, $order)) {
            $order[$id]['quantity'] += $quantity;
        } else {
            $order[$id] = [
                "quantity" => $quantity,
            ];
        }

        session(['order.orderContent' => $order]);

        $orderController = new OrderController();
        return response()->json(['order' => $order, 'totalPrice' => $orderController->calculateTotalPrice()]);
    }

    public function chooseOrder($category)
    {
        // Check if there is an order type in the session
        if (null === session('orderType')) {
            return to_route('images.index');
        }

        // Check if the category is in the database
        if (in_array($category, Category::pluck('name_english')->toArray()) || in_array($category, Category::pluck('name_dutch')->toArray()) || in_array($category, Category::pluck('name_german')->toArray())) {
            $language = session('language', 'english');

            // Check if the category is in the database
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


            // Create a new order if there is no order in the session
            if(!session('order')) {
                $order = Order::create([
                    'pickup_number' => Order::max('pickup_number') > 99 ? 1 : Order::max('pickup_number') + 1,
                ]);

                $status = orderStatus::create([
                    'order_id' => $order->id,
                    'order_started' => now(),
                ]);

                session(['order' => [
                    'orderId' => $order->id,
                    'orderStatusId' => $status->id,
                    'orderContent' => [],
                    'orderStatus' => 'order_started',
                ]]);
            }

            // Get all categories
            $categories = Category::with('image')->get()->map(function ($category) use ($language) {
                return [
                    'id' => $category->id,
                    'name' => $category->{'name_' . $language},
                    'path' => $category->image ? asset('storage/' . $category->image->path) : null,
                    'alt' => $category->image ? $category->image->alt : null,
                ];
            });

            $popular = $this->popularProducts(4);

            // Get all products from the category
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

            $orderController = new OrderController();

            return Inertia::render('ChooseOrder/ChooseOrder', [
                'language' => $language,
                'categories' => $categories,
                'category' => $category,
                'popular' => $popular,
                'products' => $products,
                'totalPrice' => $orderController->calculateTotalPrice(),
            ]);
        } else {
            return to_route('images.index');
        }
    }

    public function updateQuantity($id, $quantity) {
        $product = Product::find($id);

        if(!$product) {
            return response()->json(['error' => 'Product not found']);
        }

        $order = session('order.orderContent', []);

        // Check if the product is already in the order
        if(array_key_exists($id, $order)) {
            if($quantity == 0) {
                unset($order['orderContent'][$id]);
            } else {
                $order['orderContent'][$id]['quantity'] = $quantity;
            }
        }

        session(['order' => $order]);

        return response()->json(['order' => $order]);
    }

    public function analytics()
    {
        $orderData = [];

        for ($i = 0; $i <= 30; $i++) {
            $date = today()->subDays($i)->toDateString();
            $orderData[$date] = [
                'totalOrders' => Order::whereDate('created_at', $date)->count(),
                'totalRevenue' => OrderContent::whereHas('order', function ($query) use ($date) {
                    $query->whereDate('created_at', $date);
                })->join('products', 'order_contents.product_id', '=', 'products.id')
                ->sum(DB::raw('order_contents.product_quantity * products.price')),
                'averageOrderPrice' => number_format(OrderContent::whereHas('order', function ($query) use ($date) {
                    $query->whereDate('created_at', $date);
                })->join('products', 'order_contents.product_id', '=', 'products.id')->avg('products.price'), 2),
                'averageOrderTime' => Order::whereDate('orders.created_at', $date)
                    ->join('order_statuses', 'orders.id', '=', 'order_statuses.order_id')
                    ->avg(DB::raw('TIME_TO_SEC(TIMEDIFF(order_statuses.order_picked_up, order_statuses.order_started))')),
                'mostPopularProduct' => OrderContent::whereHas('order', function ($query) use ($date) {
                    $query->whereDate('created_at', $date);
                })->join('products', 'order_contents.product_id', '=', 'products.id')
                ->select('products.name_english', OrderContent::raw('SUM(order_contents.product_quantity) as total_quantity'))
                ->groupBy('products.name_english')
                ->orderByDesc('total_quantity')
                ->first()
            ];
        }
    
        return Inertia::render('Analytics/Analytics', [
            'orderData' => $orderData,
        ]);
    }
    
}
