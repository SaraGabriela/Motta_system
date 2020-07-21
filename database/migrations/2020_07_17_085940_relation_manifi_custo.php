<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationManifiCusto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manifests', function(Blueprint $table) {
            if (!Schema::hasColumn('manifests', 'id_user')) {
                $table->integer('id_user')->unsigned()->nullable();
                $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
                }

            if (!Schema::hasColumn('manifests', 'id_customer')) {
                $table->integer('id_customer')->unsigned()->nullable();
                $table->foreign('id_customer')->references('id')->on('customer_addresses')->onDelete('cascade');
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
