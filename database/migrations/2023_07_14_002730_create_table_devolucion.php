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
        Schema::create('prestamo_devolucion', function (Blueprint $table) {
            $table->id();
            $table->string('foto_devolucion');
            $table->string('encargado_recibe');
            $table->string('nota_devuelve');
            $table->string('firma_devolucion');
            $table->string('nombre_devuelve');
            $table->unsignedBigInteger('id_prestamo');

            $table->foreign('id_prestamo')->references('id')->on('prestamos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestamo_devolucion', function (Blueprint $table) {

        });
    }
};
