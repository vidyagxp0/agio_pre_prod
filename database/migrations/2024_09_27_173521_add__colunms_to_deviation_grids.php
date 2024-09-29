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
             $table->longText('risk_factor')->nullable();
            $table->longText('risk_element')->nullable();
            $table->longText('problem_cause')->nullable();
            $table->longText('existing_risk_control')->nullable();
            $table->longText('initial_severity')->nullable();
            $table->longText('initial_detectability')->nullable();
            $table->longText('initial_probability')->nullable();
            $table->longText('initial_rpn')->nullable();
            $table->longText('risk_acceptance')->nullable();
            $table->longText('risk_control_measure')->nullable();
            $table->longText('residual_severity')->nullable();
            $table->longText('residual_probability')->nullable();
            $table->longText('residual_detectability')->nullable();
            $table->longText('residual_rpn')->nullable();
            $table->longText('risk_acceptance2')->nullable();
            $table->longText('mitigation_proposal')->nullable();
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
