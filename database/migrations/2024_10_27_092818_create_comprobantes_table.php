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
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->integer('idFactura', true);
            $table->integer('idempleado');
            $table->integer('idalquiler');
            $table->date('fecha');
            $table->integer('idtipopago')->index('idtipopago');
            $table->string('tipoComprobante', 40);

            $table->unique(['idempleado', 'idalquiler', 'idtipopago'], 'idempleado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprobantes');
    }
};
