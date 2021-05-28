<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned()->index();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->tinyInteger('contract_id')->unsigned()->nullable();
            $table->text('areas')->nullable();
            $table->text('tags')->nullable();
            $table->decimal('sell_price_from', 8,2)->nullable();
            $table->decimal('sell_price_to', 8,2)->nullable();
            $table->decimal('rent_price_from', 8,2)->nullable();
            $table->decimal('rent_price_to', 8,2)->nullable();
            $table->mediumInteger('surface_from')->nullable();
            $table->mediumInteger('surface_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preferences');
    }
}
