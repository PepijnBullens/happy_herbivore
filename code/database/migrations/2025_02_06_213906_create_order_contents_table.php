<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_contents', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->references('id')->on('orders');
            $table->integer('product_id')->references('id')->on('products');
            $table->integer('product_quantity');
            $table->integer('with_dip')->references('id')->on('products')->nullable();
            $table->json('extra_choices')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_contents');
    }
};
