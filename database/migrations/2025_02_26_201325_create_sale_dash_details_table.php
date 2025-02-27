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
        Schema::create('sale_dash_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('slug');
            $table->integer('qtn');
            $table->decimal('sell_price', 10, 2);
            $table->string('productImage')->nullable();
            $table->string('category')->nullable();
            $table->string('sku')->nullable();
            $table->string('color')->nullable();
            $table->unsignedBigInteger('order_dash_id');
            $table->string('hex')->nullable();
            $table->string('src')->nullable();
            $table->foreign('order_dash_id')->references('id')->on('sale_dash_orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_dash_details');
    }
};
