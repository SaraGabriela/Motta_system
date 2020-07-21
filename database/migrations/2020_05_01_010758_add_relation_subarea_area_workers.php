<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationSubareaAreaWorkers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subarea_area_workers', function(Blueprint $table) {
            if (!Schema::hasColumn('subarea_area_workers', 'subarea_worker_id')) {
                $table->integer('subarea_worker_id')->unsigned()->nullable();
                $table->foreign('subarea_worker_id')->references('id')->on('subarea_workers')->onDelete('cascade');
                }
            if (!Schema::hasColumn('subarea_area_workers', 'area_worker_id')) {
                $table->integer('area_worker_id')->unsigned()->nullable();
                $table->foreign('area_worker_id')->references('id')->on('area_workers')->onDelete('cascade');
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
        Schema::table('subarea_area_workers', function(Blueprint $table) {
            
        });
    }
}
