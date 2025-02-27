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
        Schema::create('sale_dash_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['cancelado', 'entregado']);
            $table->string('currency');
            $table->decimal('total', 10, 2);
            $table->string('name');
            $table->string('phone');
            $table->string('dni');
            $table->foreign('user_id')->references('id')->on('users'); // Asumiendo que tienes una tabla 'users'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_dash_orders');
    }
};
