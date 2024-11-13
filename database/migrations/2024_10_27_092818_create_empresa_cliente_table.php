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
        Schema::create('empresa_cliente', function (Blueprint $table) {
            $table->integer('idEmpresa');
            $table->integer('idAlquiler')->index('idalquiler');

            $table->index(['idEmpresa', 'idAlquiler'], 'idempresa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa_cliente');
    }
};
