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
            $table->text('risk_factor_1')->nullable(); // Serialized array of risk factors
            $table->text('problem_cause_1')->nullable(); // Serialized array of problem causes
            $table->text('existing_risk_control_1')->nullable(); // Serialized array of existing risk controls
            $table->text('initial_severity_1')->nullable(); // Serialized array of initial severity
            $table->text('initial_probability_1')->nullable(); // Serialized array of initial probability
            $table->text('initial_detectability_1')->nullable(); // Serialized array of initial detectability
            $table->text('initial_rpn_1')->nullable(); // Serialized array of initial RPN values
            $table->text('risk_control_measure_1')->nullable(); // Serialized array of risk control measures
            $table->text('residual_severity_1')->nullable(); // Serialized array of residual severity
            $table->text('residual_probability_1')->nullable(); // Serialized array of residual probability
            $table->text('residual_detectability_1')->nullable(); // Serialized array of residual detectability
            $table->text('residual_rpn_1')->nullable(); // Serialized array of residual RPN values
            $table->text('risk_acceptance_1')->nullable(); // Serialized array of risk acceptance values
            $table->text('mitigation_proposal_1')->nullable(); // Serialized array of mitigation proposals
            $table->text('risk_acceptance3')->nullable();
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
