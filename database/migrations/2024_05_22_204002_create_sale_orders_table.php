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
        Schema::create('sale_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status',['CREATE','PAID','CANCEL','TRACKING','DONE']);
            $table->decimal('total', 8, 2);
            $table->string('name');
            $table->string('last_name');
            $table->string('business')->nullable();
            $table->string('document_type');
            $table->string('dni');
            $table->string('country');
            $table->string('address');
            $table->string('reference')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('district');
            $table->string('zip_code')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_orders');
    }
};
