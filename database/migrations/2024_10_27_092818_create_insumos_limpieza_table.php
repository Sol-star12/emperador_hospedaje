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
        Schema::create('insumos_limpieza', function (Blueprint $table) {
            $table->integer('idIInsumo', true);
            $table->integer('idcategoria')->unique('idcategoria');
            $table->string('nombre', 50);
            $table->string('descripcion');
            $table->tinyInteger('stock');
            $table->string('unidadMedida', 20);
            $table->double('stockMinimo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insumos_limpieza');
    }
};
