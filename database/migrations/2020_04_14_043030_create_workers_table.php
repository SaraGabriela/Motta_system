<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_del_trabajador');
            $table->string('documento_indentificacion');
            $table->string('banco');
            $table->string('cussp');
            $table->string('cuenta_sueldo');
            $table->string('cuenta_interbancaria')->nullable();
            $table->string('cuenta_viaticos');
            $table->dateTime('fecha_de_ingreso');
            $table->integer('total_dias_pagado');
            $table->dateTime('fecha_de_cese')->nullable();

            $table->timestamps();

            $table->softDeletes();
            $table->index(['deleted_at']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
