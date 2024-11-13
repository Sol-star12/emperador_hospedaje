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
        Schema::table('comprobantes', function (Blueprint $table) {
            $table->foreign(['idtipopago'], 'comprobantes_ibfk_1')->references(['idTipoPago'])->on('tipo_pago')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['idempleado'], 'comprobantes_ibfk_2')->references(['idEmpleado'])->on('empleados')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comprobantes', function (Blueprint $table) {
            $table->dropForeign('comprobantes_ibfk_1');
            $table->dropForeign('comprobantes_ibfk_2');
        });
    }
};
