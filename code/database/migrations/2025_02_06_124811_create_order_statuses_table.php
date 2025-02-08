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
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->references('id')->on('orders');
            $table->dateTime('order_started')->nullable();
            $table->dateTime('order_successful')->nullable();
            $table->dateTime('order_preparing')->nullable();
            $table->dateTime('order_ready')->nullable();
            $table->dateTime('order_picked_up')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_statuses');
    }
};
