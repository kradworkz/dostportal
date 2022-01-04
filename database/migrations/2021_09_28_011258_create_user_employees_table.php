<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_employees', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->smallIncrements('id');
            $table->smallInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('position_id')->unsigned()->index();
            $table->foreign('position_id')->references('id')->on('list_positions')->onDelete('cascade');
            $table->tinyInteger('department_id')->unsigned()->index();
            $table->foreign('department_id')->references('id')->on('dropdowns')->onDelete('cascade');
            $table->tinyInteger('status_id')->unsigned()->index();
            $table->foreign('status_id')->references('id')->on('dropdowns')->onDelete('cascade');
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
        Schema::dropIfExists('user_employees');
    }
}
