<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationPensionsPensionsWorkers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pensions', function(Blueprint $table) {
            if (!Schema::hasColumn('pensions', 'worker_id')) {
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
