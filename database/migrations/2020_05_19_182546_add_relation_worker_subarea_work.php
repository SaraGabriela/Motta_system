<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationWorkerSubareaWork extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('worker_subarea_work', function(Blueprint $table) {
            if (!Schema::hasColumn('worker_subarea_work', 'subarea_worker_id')) {
                $table->integer('subarea_worker_id')->unsigned()->nullable();
                $table->foreign('subarea_worker_id')->references('id')->on('subarea_workers')->onDelete('cascade');
                }

            if (!Schema::hasColumn('worker_subarea_work', 'worker_id')) {
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
