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
        Schema::table('out_of_calibrations', function (Blueprint $table) {
            
            $table->longText('details_of_instrument_out_of_order')->nullable();
            $table->longText('justification_for_recalibration')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('out_of_calibrations', function (Blueprint $table) {
            //
        });
    }
};