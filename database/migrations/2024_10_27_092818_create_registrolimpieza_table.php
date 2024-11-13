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
        Schema::create('registrolimpieza', function (Blueprint $table) {
            $table->integer('idLimpiezaHabitacion', true);
            $table->integer('idhabitacion');
            $table->integer('idempleado')->index('idempleado');
            $table->date('fecha_Limpieza');
            $table->string('estado', 20);

            $table->unique(['idhabitacion', 'idempleado'], 'idhabitacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrolimpieza');
    }
};
