<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_vehicles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->tinyIncrements('id');
            $table->string('name');
            $table->string('plate');
            $table->string('destination');
            $table->tinyInteger('group_id')->unsigned()->index();
            $table->foreign('group_id')->references('id')->on('list_groups')->onDelete('cascade');
            $table->smallInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('is_available')->default(1);
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
        Schema::dropIfExists('list_vehicles');
    }
}
