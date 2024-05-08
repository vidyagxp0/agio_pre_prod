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
        Schema::create('risk_management', function (Blueprint $table) {
            $table->id();
            $table->string('form_type')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->string('division_id')->nullable();
            $table->string('division_code')->nullable();
            //$table->string('record_number')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('Initiator_Group')->nullable();
            $table->string('initiator_group_code')->nullable();
            $table->string('due_date')->nullable();
            $table->integer('record')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('parent_type')->nullable();
            $table->longtext('short_description')->nullable();
            $table->string('open_date')->nullable();
            $table->string('assign_to')->nullable();
            $table->string('departments')->nullable();
            $table->string('team_members')->nullable();
            $table->string('source_of_risk')->nullable();
            $table->string('type')->nullable();
            $table->string('priority_level')->nullable();
            $table->string('zone')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->longtext('description')->nullable();
            $table->longtext('comments')->nullable();
            $table->string('severity2_level')->nullable();
            $table->longtext('departments2')->nullable();
            $table->longtext('source_of_risk2')->nullable();
            $table->longtext('site_name')->nullable();
            $table->longtext('building')->nullable();
            $table->longtext('floor')->nullable();
            $table->longtext('room')->nullable();
            $table->longtext('related_record')->nullable();
            $table->longtext('duration')->nullable();
            $table->string('hazard')->nullable();
            $table->string('room2')->nullable();
            $table->string('regulatory_climate')->nullable();
            $table->string('Number_of_employees')->nullable();
            $table->string('risk_management_strategy')->nullable();
            $table->string('schedule_start_date1')->nullable();
            $table->string('schedule_end_date1')->nullable();
            $table->string('estimated_man_hours')->nullable();
            $table->string('estimated_cost')->nullable();
            $table->string('currency')->nullable();
            //$table->string('team_members2')->nullable();
            //$table->string('training_require')->nullable();
            $table->longtext('justification')->nullable();
            $table->longtext('reference')->nullable();
            $table->longtext('root_cause_methodology')->nullable();
            // $table->text('measurement')->nullable();
            // $table->string('materials')->nullable();
            // $table->string('methods')->nullable();
            // $table->string('environment')->nullable();
            //$table->string('manpower')->nullable();
            //$table->string('machine')->nullable();
            //$table->string('problem_statement1')->nullable();
            // $table->text('why_problem_statement')->nullable();
            // $table->text('why_1')->nullable();
            // $table->text('why_2')->nullable();
            // $table->text('why_3')->nullable();
            // $table->text('why_4')->nullable();
            // $table->text('why_5')->nullable();
            // $table->text('root_cause')->nullable();
            // $table->text('what_will_be')->nullable();
            // $table->text('what_will_not_be')->nullable();
            // $table->text('what_rationable')->nullable();
            // $table->text('where_will_be')->nullable();
            // $table->text('where_will_not_be')->nullable();
            // $table->text('where_rationable')->nullable();
            // $table->text('when_will_be')->nullable();
            // $table->text('when_will_not_be')->nullable();
            // $table->text('when_rationable')->nullable();
            // $table->text('coverage_will_be')->nullable();
            // $table->text('coverage_will_not_be')->nullable();
            // $table->text('coverage_rationable')->nullable();
            // $table->text('who_will_be')->nullable();
            // $table->text('who_will_not_be')->nullable();
            // $table->text('who_rationable')->nullable();
            $table->text('cost_of_risk')->nullable();
            $table->text('environmental_impact')->nullable();
            $table->text('public_perception_impact')->nullable();
            $table->text('calculated_risk')->nullable();
            $table->text('impacted_objects')->nullable();
            $table->text('severity_rate')->nullable();
            $table->string('occurrence')->nullable();
            $table->string('detection')->nullable();
            $table->string('detection2')->nullable();
            $table->string('rpn')->nullable();
            $table->longtext('residual_risk')->nullable();
            $table->string('residual_risk_impact')->nullable();
            $table->string('residual_risk_probability')->nullable();
            $table->string('analysisN2')->nullable();
            $table->string('analysisRPN2')->nullable();
            $table->string('rpn2')->nullable();
            $table->longtext('comments2')->nullable();
            $table->longtext('investigation_summary')->nullable();
            $table->longtext('root_cause_description')->nullable();
            $table->string('refrence_record')->nullable();
            $table->string('mitigation_required')->nullable();
            $table->longtext('mitigation_plan')->nullable();
            $table->text('mitigation_due_date')->nullable();
            $table->longtext('mitigation_status')->nullable();
            $table->longtext('mitigation_status_comments')->nullable();
            $table->string('impact')->nullable();
            $table->string('criticality')->nullable();
            $table->longtext('impact_analysis')->nullable();
            $table->text('risk_analysis')->nullable();
            $table->longtext('due_date_extension')->nullable();
            //$table->text('severity')->nullable();
            //$table->text('occurance')->nullable();
            $table->text('initial_rpn')->nullable();
            $table->string('status')->nullable();
            $table->integer('stage')->nullable();
            $table->string('submitted_by')->nullable();
            $table->string('evaluated_by')->nullable();           
            $table->string('plan_approved_by')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->string('cancelled_on')->nullable();
            $table->string('all_actions_completed_by')->nullable();
            $table->string('all_actions_completed_on')->nullable();
            $table->string('risk_analysis_completed_by')->nullable();
            $table->string('submitted_on')->nullable();
            $table->string('evaluated_on')->nullable();
            $table->string('plan_approved_on')->nullable();
            $table->string('risk_analysis_completed_on')->nullable();
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
        Schema::dropIfExists('risk_management');
    }
};
