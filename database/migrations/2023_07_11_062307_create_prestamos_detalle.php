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
        Schema::create('detalleprestamos', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('id_prestamo');
            $table->integer('id_articulo');
            $table->string('descripcion_articulo');
            $table->timestamps();
           
            
            $table->foreign('id_prestamo')->references('id')->on('prestamos')->onDelete('cascade');
            $table->foreign('id_articulo')->references('id_articulo')->on('articulos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleprestamos');
    }
};
