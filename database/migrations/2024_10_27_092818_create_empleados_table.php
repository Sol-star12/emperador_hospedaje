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
        Schema::create('empleados', function (Blueprint $table) {
            $table->integer('idEmpleado', true);
            $table->integer('idusuario')->unique('idusuario');
            $table->char('dni', 8);
            $table->string('nombre', 40);
            $table->string('apellido', 40);
            $table->char('telefono', 9);
            $table->date('fNacimiento');
            $table->string('direccion', 50);
            $table->binary('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
