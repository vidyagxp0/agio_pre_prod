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
        Schema::create('out_of_calibrations', function (Blueprint $table) {
            $table->id();
            $table->integer('record')->nullable();
            $table->integer('assign_to')->nullable();
            $table->string('form_type')->nullable();
            $table->string('division_id')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->string('division_code')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('due_date')->nullable();
            $table->string('Initiator_Group')->nullable();
            $table->string('initiator_group_code')->nullable();
            $table->text('initiated_through')->nullable();
            $table->longText('initiated_if_other')->nullable();
            $table->text('is_repeat_ooc')->nullable();
            $table->longText('Repeat_Nature')->nullable();
            $table->longText('description_ooc')->nullable();
            $table->longText('initial_attachment_ooc')->nullable();
            $table->date('ooc_due_date')->nullable();
            $table->longText('Delay_Justification_for_Reporting')->nullable();
            $table->longText('HOD_Remarks')->nullable();
            $table->longText('attachments_hod_ooc')->nullable();
            $table->longText('Immediate_Action_ooc')->nullable();
            $table->longText('Preliminary_Investigation_ooc')->nullable();
            $table->longText('qa_comments_ooc')->nullable();
            $table->longText('qa_comments_description_ooc')->nullable();
            $table->longText('is_repeat_assingable_ooc')->nullable();
            $table->longText('protocol_based_study_hypthesis_study_ooc')->nullable();
            $table->longText('justification_for_protocol_study_hypothesis_study_ooc')->nullable();
            $table->longText('plan_of_protocol_study_hypothesis_study')->nullable();
            $table->longText('conclusion_of_protocol_based_study_hypothesis_study_ooc')->nullable();
            $table->longtext('analysis_remarks_stage_ooc')->nullable();
            $table->longtext('calibration_results_stage_ooc')->nullable();
            $table->string('is_repeat_result_naturey_ooc')->nullable();
            $table->longText('review_of_calibration_results_of_analyst_ooc')->nullable();
            $table->longtext('attachments_stage_ooc')->nullable(); // Consider storing file paths or other relevant information here
            $table->longtext('results_criteria_stage_ooc')->nullable();
            $table->string('is_repeat_stae_ooc')->nullable();
            $table->longText('qa_comments_stage_ooc')->nullable();
            $table->longText('additional_remarks_stage_ooc')->nullable();
            $table->text('is_repeat_stageii_ooc')->nullable();
            $table->text('is_repeat_stage_instrument_ooc')->nullable();
            $table->text('is_repeat_proposed_stage_ooc')->nullable();
            $table->longText('initial_attachment_stageii_ooc')->nullable(); // Consider storing file paths or other relevant information here
            $table->text('is_repeat_compiled_stageii_ooc')->nullable();
            $table->text('is_repeat_realease_stageii_ooc')->nullable();
            $table->text('initiated_throug_stageii_ooc')->nullable();
            $table->text('initiated_through_stageii_ooc')->nullable();
            $table->text('is_repeat_reanalysis_stageii_ooc')->nullable();
            $table->text('initiated_through_stageii_cause_failure_ooc')->nullable();
            $table->text('is_repeat_capas_ooc')->nullable();
            $table->longText('initiated_through_capas_ooc')->nullable();
            $table->longText('initiated_through_capa_prevent_ooc')->nullable();
            $table->longText('initiated_through_capa_corrective_ooc')->nullable();
            $table->longText('initial_attachment_capa_ooc')->nullable();
            $table->longText('initiated_through_capa_ooc')->nullable();
            $table->longText('initial_attachment_capa_post_ooc')->nullable();
            $table->text('short_description_closure_ooc')->nullable();
            $table->longText('initial_attachment_closure_ooc')->nullable();
            $table->string('document_code_closure_ooc')->nullable();
            $table->string('remarks_closure_ooc')->nullable();
            $table->longText('initiated_through_closure_ooc')->nullable();
            $table->longText('initiated_through_hodreview_ooc')->nullable();
            $table->longText('initial_attachment_hodreview_ooc')->nullable();
            $table->longText('initiated_through_rootcause_ooc')->nullable();
            $table->longText('initiated_through_impact_closure_ooc')->nullable();
            $table->text('stage')->nullable();
            $table->text('status')->nullable();
            $table->text('submitted_by')->nullable();
            $table->text('submitted_on')->nullable();
            $table->text('comment')->nullable();
            $table->text('change_to')->nullable();
            $table->text('change_from')->nullable();
            $table->text('action_name')->nullable();
            $table->text('action')->nullable();
            $table->text('initial_phase_i_investigation_comment')->nullable();
            $table->integer('parent_id')->nullable();
            $table->text('parent_type')->nullable();
            

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
        Schema::dropIfExists('out_of_calibrations');
    }
};
