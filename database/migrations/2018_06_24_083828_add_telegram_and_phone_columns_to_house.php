<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTelegramAndPhoneColumnsToHouse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('houses', function (Blueprint $table) {
		    $table->dropColumn('owner');
		    $table->string('owner_phone')->nullable();
		    $table->string('owner_telegram')->nullable();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('houses', function (Blueprint $table) {
		    $table->dropColumn('owner_phone');
		    $table->dropColumn('owner_telegram');
		    $table->string('owner');
	    });
    }
}
