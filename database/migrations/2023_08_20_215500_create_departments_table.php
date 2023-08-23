<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // Puedes agregar más columnas según tus necesidades
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
