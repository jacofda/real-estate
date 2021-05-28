<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');

            $table->string('rag_soc');
            $table->string('address');
            $table->string('zip');
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->char('nation', 2)->default('IT');
            $table->char('lang', 2)->default('it');
            $table->boolean('private')->default(0);

            $table->string('pec')->nullable();
            $table->string('piva')->nullable();
            $table->string('cf')->nullable();
            $table->string('sdi')->nullable();

            $table->boolean('active')->default(1);

            $table->string('phone')->nullable();

            $table->string('email')->nullable();


            $table->integer('sector_id')->nullable();
            $table->integer('type_id')->unsigned()->index();
            $table->foreign('type_id')->references('id')->on('client_types');
            $table->text('note')->nullable();

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
        Schema::dropIfExists('clients');
    }
}
