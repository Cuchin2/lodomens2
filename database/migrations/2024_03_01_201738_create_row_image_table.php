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
        Schema::create('row_image', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('row_id');
            $table->unsignedBigInteger('image_id');
            $table->foreign('row_id')->references('id')->on('rows')->onDelete('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('row_image');
    }
};
