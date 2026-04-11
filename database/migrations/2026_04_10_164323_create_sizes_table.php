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
    Schema::create('sizes', function (Blueprint $table) {
        $table->id();
        $table->string('name');        // Ej: "S", "M", "38", "40"
        $table->string('type')->nullable(); // Opcional: 'letter', 'number', 'shoe'
        $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();

        // Una misma marca no puede tener dos tallas con el mismo nombre
        $table->unique(['name', 'brand_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};
