<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('route_slip',30)->unique();
            $table->string('subject');
            $table->text('remarks');
            $table->json('keywords');
            $table->json('actions');
            $table->boolean('is_incoming')->default(0);
            $table->boolean('is_completed')->default(0);
            $table->boolean('is_status')->default(0);
            $table->smallInteger('sender_id')->unsigned()->index();
            $table->foreign('sender_id')->references('id')->on('listings')->onDelete('cascade');
            $table->smallInteger('company_id')->unsigned()->index();
            $table->foreign('company_id')->references('id')->on('listings')->onDelete('cascade');
            $table->tinyInteger('type_id')->unsigned()->index();
            $table->foreign('type_id')->references('id')->on('dropdowns')->onDelete('cascade');
            $table->smallInteger('routed_by')->unsigned()->index()->nullable();
            $table->foreign('routed_by')->references('id')->on('users')->onDelete('cascade');
            $table->smallInteger('encoded_by')->unsigned()->index();
            $table->foreign('encoded_by')->references('id')->on('users')->onDelete('cascade');
            $table->date('document');
            $table->date('received');
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
        Schema::dropIfExists('documents');
    }
}
