<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('contract_id')->unsigned()->index();
            $table->foreign('contract_id')->references('id')->on('property_contracts');
            $table->integer('type_id')->unsigned()->index();
            $table->foreign('type_id')->references('id')->on('property_types');
            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('property_tags');
            $table->integer('calendar_id')->unsigned()->nullable();
            // $table->foreign('calendar_id')->references('id')->on('calendars');
            $table->integer('area_id')->unsigned()->nullable();
            // $table->foreign('area_id')->references('id')->on('property_areas');
            $table->integer('city_id')->unsigned();

            $table->string('rif')->nullable();
            $table->string('address')->nullable();
            $table->boolean('show_address')->nullable();
            $table->boolean('show_price')->nullable();

            $table->string('name_it')->nullable();
            $table->string('name_en')->nullable();
            $table->text('desc_it')->nullable();
            $table->text('desc_en')->nullable();
            $table->text('short_desc_it')->nullable();
            $table->text('short_desc_en')->nullable();

            $table->string('state')->nullable();
            $table->string('heating')->nullable();
            $table->string('energy_class')->nullable();

            $table->tinyInteger('floor')->unsigned()->nullable();
            $table->tinyInteger('n_bathrooms')->unsigned()->nullable();
            $table->tinyInteger('n_bedrooms')->unsigned()->nullable();
            $table->tinyInteger('n_garages')->unsigned()->nullable();
            $table->tinyInteger('n_floors')->unsigned()->nullable();

            $table->smallInteger('surface')->unsigned()->nullable();
            $table->mediumInteger('land_surface')->unsigned()->nullable();
            $table->smallInteger('garden_surface')->unsigned()->nullable();

            $table->float('sell_price', 10, 2)->nullable();
            $table->float('rent_price', 10, 2)->nullable();
            $table->tinyInteger('rent_period')->nullable();
            $table->float('condo_expenses', 10,2)->nullable();

            $table->string('lat')->nullable();
            $table->string('lng')->nullable();

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
        Schema::dropIfExists('properties');
    }
}
