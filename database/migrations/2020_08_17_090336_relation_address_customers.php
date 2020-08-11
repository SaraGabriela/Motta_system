<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationAddressCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_addresses', function(Blueprint $table) {
            if (!Schema::hasColumn('customer_addresses', 'id_customers')) {
                $table->integer('id_customers')->unsigned()->nullable();
                $table->foreign('id_customers')->references('id')->on('manifest_customers')->onDelete('cascade');
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
