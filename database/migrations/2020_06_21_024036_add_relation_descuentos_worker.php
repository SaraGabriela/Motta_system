<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationDescuentosWorker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('descuentos', function(Blueprint $table) {
            if (!Schema::hasColumn('descuentos', 'worker_id')) {
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
        Schema::table('descuentos', function(Blueprint $table) {
        });
    }
}
