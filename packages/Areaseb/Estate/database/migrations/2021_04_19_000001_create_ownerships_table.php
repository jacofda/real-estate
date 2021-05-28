<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ownerships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ownership_id')->unsigned()->index();
            $table->foreign('ownership_id')->references('id')->on('property_ownerships')->onDelete('cascade');
            $table->text('description');
            $table->string('type');
            $table->text('other_owners');
            $table->string('document_origin');
            $table->text('neighbors');
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
        Schema::dropIfExists('ownerships');
    }
}
