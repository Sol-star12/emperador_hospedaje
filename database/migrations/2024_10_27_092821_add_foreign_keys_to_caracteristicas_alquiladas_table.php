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
        Schema::table('caracteristicas_alquiladas', function (Blueprint $table) {
            $table->foreign(['idcaracteristica'], 'caracteristicas_alquiladas_ibfk_1')->references(['idCaracteristica'])->on('caracteristicas')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['idalquiler'], 'caracteristicas_alquiladas_ibfk_2')->references(['idAlquiler'])->on('alquiler')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('caracteristicas_alquiladas', function (Blueprint $table) {
            $table->dropForeign('caracteristicas_alquiladas_ibfk_1');
            $table->dropForeign('caracteristicas_alquiladas_ibfk_2');
        });
    }
};
