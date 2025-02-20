<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    // Show the order index page
    public function index() {
        $orders = Order::with('orderContents')->get();

        return Inertia::render('Order/Index', [
            'language' => session('language', 'english'),
            'initialOrders' => $orders,
        ]);
    }

    public function calculateTotalPrice()
    {
        $order = session('order.orderContent', []);

        $totalPrice = 0;

        foreach ($order as $id => $orderItem) {
            $product = Product::find($id);

            if ($product) {
                $totalPrice += $product->price * $orderItem['quantity'];
            }
        }

        return $totalPrice;
    }

    public function yourOrder() {
        if(null === session('orderType')) {
            return to_route('images.index');
        }

        // Get the order information
        $order = session('order.orderContent', []);
        $language = session('language', 'english');
        $orderType = session('orderType') === 'Eat Here' ? ($language === 'english' ? 'Eat Here' : ($language === 'dutch' ? 'Hier Eten' : 'Hier Essen')) : ($language === 'english' ? 'Take Away' : ($language === 'dutch' ? 'Afhalen' : 'Abheben'));
        
        // Get the products with the order information
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

        return Inertia::render('Order/YourOrder', [
            'language' => session('language', 'english'),
            'order' => $orderWithInformation,
            'totalPrice' => $this->calculateTotalPrice(),
            'orderType' => $orderType,
        ]);
    }

    public function payment()
    {
        session(['order.orderStatus' => 'payment']);

        return Inertia::render('Order/Payment', [
            'language' => session('language', 'english'),
        ]);
    }

    // Finish the order
    public function finishedOrder() {
        if(null === session('order.orderStatus')) {
            return to_route('images.index');
        }

        // Check if the order status is payment
        if(session('order.orderStatus') !== 'payment') {
            return to_route('order.yourOrder');
        } else {
            $order = Order::find(session('order.orderId'));

            if(!$order) {
                return to_route('images.index');
            }

            foreach(session('order.orderContent') as $productId => $quantity) {
                $order->orderContents()->create([
                    'product_id' => $productId,
                    'product_quantity' => $quantity['quantity'],
                ]);
            }

            $orderStatus = OrderStatus::where('order_id', $order->id)->where('id', session('order.orderStatusId'))->first();

            if(!$orderStatus) {
                return to_route('images.index');
            } else {
                $orderStatus->update([
                    'order_successful' => now(),
                ]);
            }

            $pickupNumber = $order->pickup_number;

            session()->forget('order');
            session()->forget('orderType');
        
            return Inertia::render('Order/FinishedOrder', [
                'language' => session('language', 'english'),
                'pickupNumber' => $pickupNumber,
            ]);
        }
    }
}
