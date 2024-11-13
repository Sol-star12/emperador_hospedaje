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
        Schema::table('acompanante', function (Blueprint $table) {
            $table->foreign(['idalquiler'], 'acompanante_ibfk_1')->references(['idAlquiler'])->on('alquiler')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acompanante', function (Blueprint $table) {
            $table->dropForeign('acompanante_ibfk_1');
        });
    }
};
