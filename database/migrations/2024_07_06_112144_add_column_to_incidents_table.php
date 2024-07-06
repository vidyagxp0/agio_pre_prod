<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incidents', function (Blueprint $table) {
            $table->text('instrument_name')->after('equipment_name')->nullable();
            $table->text('facility_name')->after('instrument_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incidents', function (Blueprint $table) {
            $table->dropColumn('instrument_name')->after('equipment_name')->nullable();
            $table->dropColumn('facility_name')->after('instrument_name')->nullable();
        });
    }
};
