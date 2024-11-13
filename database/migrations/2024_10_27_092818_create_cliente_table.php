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
        Schema::create('cliente', function (Blueprint $table) {
            $table->integer('idCliente', true);
            $table->char('dni', 8);
            $table->integer('nombre');
            $table->string('apellido', 90);
            $table->char('telefono', 9);
            $table->string('correo', 90);
            $table->enum('tipoCliente', ['Empresa', 'Natural']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
