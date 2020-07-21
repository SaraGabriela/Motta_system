<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsistencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->increments('id');
            $table->float('dias_vacaciones')->nullable();
            $table->float('permiso_a_cta_horas_extra')->nullable();
            $table->float('descanso_medico')->nullable();
            $table->float('subsidio_essalud')->nullable();
            $table->float('p_sin_goce')->nullable();
            $table->float('memoran')->nullable();
            $table->float('horas_extra_25')->nullable();
            $table->float('horas_extra_35')->nullable();
            $table->float('horas_extra_100')->nullable();
            
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
        //
    }
}
