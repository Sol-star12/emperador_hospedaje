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
        Schema::create('alquiler', function (Blueprint $table) {
            $table->integer('idAlquiler', true);
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->float('totalPago');
            $table->integer('idhabitacion');
            $table->integer('idcliente')->index('idcliente');
            $table->double('reserva');

            $table->unique(['idhabitacion', 'idcliente'], 'idhabitacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquiler');
    }
};
