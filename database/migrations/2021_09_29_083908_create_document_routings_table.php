<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentRoutingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_routings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('is_seen_to')->default(0);
            $table->boolean('is_seen_from')->default(0);
            $table->boolean('is_completed')->default(0);
            $table->boolean('is_required')->default(0);
            $table->boolean('is_action')->default(0);
            $table->smallInteger('route_to')->unsigned()->index();
            $table->foreign('route_to')->references('id')->on('users')->onDelete('cascade');
            $table->integer('document_id')->unsigned()->index();
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
            $table->datetime('seened')->nullable();
            $table->datetime('completed')->nullable();
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
        Schema::dropIfExists('document_routings');
    }
}
