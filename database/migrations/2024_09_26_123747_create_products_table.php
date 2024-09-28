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
            $table->uuid('id')->primary();
            $table->string('product_name', 150); // Product_name (varchar 150) NotNull
            $table->string('category', 100); // Category (varchar 100) NotNull
            $table->decimal('price', 8, 2); // Price (numeric) NotNull
            $table->float('discount')->nullable(); // Discount (float) Null
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
