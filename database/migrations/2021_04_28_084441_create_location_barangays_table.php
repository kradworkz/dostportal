<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationBarangaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_barangays', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->smallIncrements('id');
            $table->string('name');
            $table->smallInteger('municipality_id')->unsigned()->index();
            $table->foreign('municipality_id')->references('id')->on('location_municipalities')->onDelete('cascade');
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
        Schema::dropIfExists('location_barangays');
    }
}
