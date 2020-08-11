<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationCustomerSectors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manifest_customers', function(Blueprint $table) {
            if (!Schema::hasColumn('manifest_customers', 'id_sector')) {
                $table->integer('id_sector')->unsigned()->nullable();
                $table->foreign('id_sector')->references('id')->on('sectors')->onDelete('cascade');
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
