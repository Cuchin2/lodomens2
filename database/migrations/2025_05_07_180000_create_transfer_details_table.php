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
        Schema::create('transfer_details', function (Blueprint $table) {
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
            $table->string('hex')->nullable();
            $table->string('src')->nullable();
            $table->unsignedBigInteger('transfer_id');
            $table->foreign('transfer_id')->references('id')->on('transfers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_details');
    }
};
