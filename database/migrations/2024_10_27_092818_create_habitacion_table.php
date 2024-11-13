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
        Schema::create('habitacion', function (Blueprint $table) {
            $table->integer('idHabitacion', true);
            $table->integer('idtipoHabitacion');
            $table->integer('iddetalle')->index('iddetalle');
            $table->string('estado', 20);
            $table->string('estadoLimpieza', 20);
            $table->unique(['idtipoHabitacion', 'iddetalle'], 'idtipohabitacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitacion');
    }
};
