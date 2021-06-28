<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPropertySheetIdFieldToPropertyViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_views', function (Blueprint $table) {
            $table->unsignedInteger('property_sheet_id')->nullable()->after('client_id');
            $table->foreign('property_sheet_id')->references('id')->on('property_sheets');
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
            $table->dropForeign(['property_sheet_id']);
            $table->dropColumn('property_sheet_id');
        });
    }
}
