<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePensions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pensions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->string('fecha')->nullable();
            $table->float('obligatorio')->nullable();
            $table->float('seguro')->nullable();
            $table->float('variable')->nullable();
            $table->binary('estado')->nullable();

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
        Schema::dropIfExists('pensions');
    }
}
