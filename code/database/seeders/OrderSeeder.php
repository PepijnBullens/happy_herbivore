<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\OrderContent;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order = Order::create([
            'pickup_number' => 1,
        ]);

        OrderStatus::create([
            'order_id' => $order->id,
            'order_started' => now(),
            'order_successful' => null,
            'order_preparing' => null,
            'order_ready' => null,
            'order_picked_up' => null,
        ]);

        for($i = 1; $i <= 10; $i++) {
            OrderContent::create([
                'order_id' => $order->id,
                'product_id' => Product::inRandomOrder()->first()->id,
                'product_quantity' => random_int(1, 5),
                'with_dip' => random_int(1, 2) === 1 ? optional(Product::whereHas('category', function($query) {
                    $query->where('name_english', 'dip');
                })->inRandomOrder()->first())->id : null,
                'extra_choices' => random_int(1, 2) === 1 ? json_encode([
                    'Spicy Paprika',
                ]) : (random_int(1, 2) === 1 ? json_encode([
                    'Herb Seasoning',
                ]) : null),
            ]);
        }

        $order = Order::create([
            'pickup_number' => 2,
        ]);

        // Create related order status
        OrderStatus::create([
            'order_id' => $order->id,
            'order_started' => now(),
            'order_successful' => null,
            'order_preparing' => null,
            'order_ready' => null,
            'order_picked_up' => null,
        ]);

        OrderContent::create([
            'order_id' => $order->id,
            'product_id' => Product::where('name_english', 'Roasted Chickpeas')->first()->id,
            'product_quantity' => 1000,            
        ]);
    }
}
