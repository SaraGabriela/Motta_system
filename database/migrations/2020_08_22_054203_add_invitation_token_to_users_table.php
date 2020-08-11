<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInvitationTokenToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('invitation_token')->nullable();
            if (!Schema::hasColumn('users', 'manifest_customers_id')) {
                $table->integer('manifest_customers_id')->unsigned()->nullable();
                $table->foreign('manifest_customers_id')->references('id')->on('manifest_customers')->onDelete('cascade');
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
