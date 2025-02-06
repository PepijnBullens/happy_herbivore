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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->references('id')->on('categories');
            $table->string('name_dutch');
            $table->text('description_dutch')->nullable();
            $table->string('name_english');
            $table->text('description_english')->nullable();
            $table->string('name_german');
            $table->text('description_german')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('kcal');
            $table->boolean('with_dip')->default(false);
            $table->json('extra_choices')->nullable();
            $table->boolean('available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
