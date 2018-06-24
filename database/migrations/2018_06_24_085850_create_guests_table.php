<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('house_id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('telegram')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            $table->foreign('house_id')->references('id')->on('house')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
