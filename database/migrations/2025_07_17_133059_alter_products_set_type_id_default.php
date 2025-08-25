<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Actualizar registros existentes con NULL
        DB::table('products')
            ->whereNull('type_id')
            ->update(['type_id' => 1]);

        // Quitar la restricción de clave foránea temporalmente
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
        });

        // Modificar la columna para que tenga DEFAULT 1 y sea NOT NULL
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->default(1)->change();
        });

        // Restaurar la restricción de clave foránea
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Quitar la restricción de clave foránea temporalmente
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
        });

        // Revertir: hacer nullable y quitar el valor por defecto
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable()->default(null)->change();
        });

        // Restaurar la restricción de clave foránea
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }
};
