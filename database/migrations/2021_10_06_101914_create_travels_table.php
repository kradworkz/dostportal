<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('is_vehicle');
            $table->string('code',30)->unique();
            $table->json('information');
            $table->string('destination');
            $table->smallInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status_id')->unsigned()->index();
            $table->foreign('status_id')->references('id')->on('dropdowns')->onDelete('cascade');
            $table->tinyInteger('mode_id')->unsigned()->index();
            $table->foreign('mode_id')->references('id')->on('dropdowns')->onDelete('cascade');
            $table->boolean('is_seened')->default(0);
            $table->datetime('seened_at')->nullable();
            $table->datetime('start_at');
            $table->datetime('end_at');
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
        Schema::dropIfExists('travels');
    }
}
