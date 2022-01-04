<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_groups', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->tinyIncrements('id');
            $table->string('name');
            $table->string('acronym');
            $table->string('type');
            $table->string('address')->default('n/a');
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
        Schema::dropIfExists('list_groups');
    }
}
