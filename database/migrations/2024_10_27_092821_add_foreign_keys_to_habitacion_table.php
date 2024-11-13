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
        Schema::table('habitacion', function (Blueprint $table) {
            $table->foreign(['iddetalle'], 'habitacion_ibfk_1')->references(['idDetalle'])->on('detalle')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['idtipoHabitacion'], 'habitacion_ibfk_2')->references(['idTipoHabitacion'])->on('tipo_habitacion')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('habitacion', function (Blueprint $table) {
            $table->dropForeign('habitacion_ibfk_1');
            $table->dropForeign('habitacion_ibfk_2');
        });
    }
};
