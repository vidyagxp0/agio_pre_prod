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
        Schema::table('deviation_grids', function (Blueprint $table) {
            $table->longText('andrisk_factor')->nullable();
            $table->longText('andrisk_element')->nullable();
            $table->longText('andproblem_cause')->nullable();
            $table->longText('andexisting_risk_control')->nullable();
            $table->longText('andinitial_severity')->nullable();
            $table->longText('andinitial_detectability')->nullable();
            $table->longText('andinitial_probability')->nullable();
            $table->longText('andinitial_rpn')->nullable();
            $table->longText('andrisk_acceptance')->nullable();
            $table->longText('andrisk_control_measure')->nullable();
            $table->longText('andresidual_severity')->nullable();
            $table->longText('andresidual_probability')->nullable();
            $table->longText('andresidual_detectability')->nullable();
            $table->longText('andresidual_rpn')->nullable();
            $table->longText('andrisk_acceptance2')->nullable();
            $table->longText('andmitigation_proposal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deviation_grids', function (Blueprint $table) {
            //
        });
    }
};
