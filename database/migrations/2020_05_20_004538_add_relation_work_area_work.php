<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationWorkAreaWork extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('worker_area_work', function(Blueprint $table) {
            if (!Schema::hasColumn('worker_area_work', 'area_worker_id')) {
                $table->integer('area_worker_id')->unsigned()->nullable();
                $table->foreign('area_worker_id')->references('id')->on('area_workers')->onDelete('cascade');
                }

            if (!Schema::hasColumn('worker_area_work', 'worker_id')) {
                $table->integer('worker_id')->unsigned()->nullable();
                $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade');
                }
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
