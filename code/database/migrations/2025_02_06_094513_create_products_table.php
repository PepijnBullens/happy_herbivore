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
            $table->text('description_dutch');
            $table->string('name_english');
            $table->text('description_english');
            $table->string('name_german');
            $table->text('description_german');
            $table->decimal('price', 10, 2);
            $table->string('kcal');
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
