<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSheetIdFieldToPropertyViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_views', function (Blueprint $table) {
            $table->unsignedInteger('sheet_id')->nullable()->after('client_id');
            $table->foreign('sheet_id')->references('id')->on('sheets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_views', function (Blueprint $table) {
            $table->dropForeign(['sheet_id']);
            $table->dropColumn('sheet_id');
        });
    }
}
