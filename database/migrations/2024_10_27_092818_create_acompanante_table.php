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
        Schema::create('acompanante', function (Blueprint $table) {
            $table->integer('idalquiler')->unique('idalquiler');
            $table->char('dni', 8);
            $table->string('nombre');
            $table->string('apellido');
            $table->char('telefono', 9);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acompanante');
    }
};
