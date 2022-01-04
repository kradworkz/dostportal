<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_positions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->tinyIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->tinyInteger('salary_id')->unsigned()->index();
            $table->foreign('salary_id')->references('id')->on('dropdowns')->onDelete('cascade');
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
        Schema::dropIfExists('list_positions');
    }
}
