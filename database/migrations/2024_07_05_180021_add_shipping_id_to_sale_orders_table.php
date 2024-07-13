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
        Schema::table('sale_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('shipping_id')->nullable();
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sale_orders', function (Blueprint $table) {
            $table->dropForeign(['shipping_id']);
            $table->dropColumn('shipping_id');
        });
    }
};
