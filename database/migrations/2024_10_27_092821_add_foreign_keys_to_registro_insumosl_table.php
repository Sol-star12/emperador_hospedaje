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
        Schema::table('registro_insumosl', function (Blueprint $table) {
            $table->foreign(['idinsumo'], 'registro_insumosl_ibfk_1')->references(['idIInsumo'])->on('insumos_limpieza')->onUpdate('cascade')->onDelete('no action');
            $table->foreign(['idregistroLimpieza'], 'registro_insumosl_ibfk_2')->references(['idLimpiezaHabitacion'])->on('registrolimpieza')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registro_insumosl', function (Blueprint $table) {
            $table->dropForeign('registro_insumosl_ibfk_1');
            $table->dropForeign('registro_insumosl_ibfk_2');
        });
    }
};
