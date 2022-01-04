<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_statuses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->json('seened_by');
            $table->smallInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status_id')->unsigned()->index();
            $table->foreign('status_id')->references('id')->on('dropdowns')->onDelete('cascade');
            $table->integer('travel_id')->unsigned()->index();
            $table->foreign('travel_id')->references('id')->on('travels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travel_statuses');
    }
}
