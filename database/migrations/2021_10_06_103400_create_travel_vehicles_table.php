<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_vehicles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('is_seened')->default(0);
            $table->tinyInteger('vehicle_id')->unsigned()->index();
            $table->foreign('vehicle_id')->references('id')->on('list_vehicles')->onDelete('cascade');
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
        Schema::dropIfExists('travel_vehicles');
    }
}
