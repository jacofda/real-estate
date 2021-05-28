<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('pos')->nullable();
            $table->string('nome');
            $table->string('cognome');
            $table->string('cellulare')->nullable();
            $table->string('email')->nullable();

            $table->string('indirizzo')->nullable();
            $table->string('cap', 10)->nullable();
            $table->string('citta')->nullable();
            $table->string('provincia')->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->char('nazione', 2)->default('IT');
            $table->char('lingua', 2)->default('it');

            $table->boolean('subscribed')->default(true);
            $table->boolean('requested_unsubscribed')->default(false);
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('client_id')->unsigned()->index();
            $table->foreign('client_id')->references('id')->on('clients');

            $table->string('origin')->nullable();
            $table->boolean('primary')->defaut(false);

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
        Schema::dropIfExists('contacts');
    }
}
