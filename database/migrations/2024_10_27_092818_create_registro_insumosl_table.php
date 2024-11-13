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
        Schema::create('registro_insumosl', function (Blueprint $table) {
            $table->integer('idregistroLimpieza');
            $table->integer('idinsumo')->index('idinsumo');
            $table->integer('cantidad');

            $table->primary(['idregistroLimpieza', 'idinsumo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_insumosl');
    }
};
