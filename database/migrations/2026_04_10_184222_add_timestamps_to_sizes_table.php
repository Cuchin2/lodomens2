<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sizes', function (Blueprint $table) {
            $table->timestamps(); // Añade created_at y updated_at
        });
    }

    public function down(): void
    {
    Schema::table('sizes', function (Blueprint $table) {
        $table->timestamp('created_at')->nullable()->default(now());
        $table->timestamp('updated_at')->nullable()->default(now());
    });
    }
};
