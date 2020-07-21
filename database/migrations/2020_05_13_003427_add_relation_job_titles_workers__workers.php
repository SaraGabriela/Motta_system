<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationJobTitlesWorkersWorkers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_titles_workers', function(Blueprint $table) {
            if (!Schema::hasColumn('job_titles_workers', 'job_title_id')) {
                $table->integer('job_title_id')->unsigned()->nullable();
                $table->foreign('job_title_id')->references('id')->on('job_titles')->onDelete('cascade');
                }
            if (!Schema::hasColumn('job_titles_workers', 'worker_id')) {
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
