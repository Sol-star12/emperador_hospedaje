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
        Schema::table('roles_permisos', function (Blueprint $table) {
            $table->foreign(['idrol'], 'roles_permisos_ibfk_1')->references(['idRol'])->on('rol')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['idpermiso'], 'roles_permisos_ibfk_2')->references(['idPermiso'])->on('permisos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles_permisos', function (Blueprint $table) {
            $table->dropForeign('roles_permisos_ibfk_1');
            $table->dropForeign('roles_permisos_ibfk_2');
        });
    }
};
