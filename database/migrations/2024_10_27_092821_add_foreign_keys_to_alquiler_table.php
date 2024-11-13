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
        Schema::table('alquiler', function (Blueprint $table) {
            $table->foreign(['idhabitacion'], 'alquiler_ibfk_1')->references(['idHabitacion'])->on('habitacion')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['idcliente'], 'alquiler_ibfk_2')->references(['idCliente'])->on('cliente')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alquiler', function (Blueprint $table) {
            $table->dropForeign('alquiler_ibfk_1');
            $table->dropForeign('alquiler_ibfk_2');
        });
    }
};
