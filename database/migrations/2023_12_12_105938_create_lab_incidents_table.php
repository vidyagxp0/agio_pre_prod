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
        Schema::create('lab_incidents', function (Blueprint $table) {
            $table->id();
            $table->integer('record')->nullable();
            $table->string('form_type')->nullable();
            $table->string('division_id')->nullable();
            // $table->integer('initiator_id')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->string('division_code')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('due_date')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('parent_type')->nullable();
            $table->string('short_desc')->nullable();
            $table->string('severity_level2')->nullable();
            $table->string('Initiator_Group')->nullable();
            $table->longtext('Incident_Category_others')->nullable();

            $table->string('initiator_group_code')->nullable();
            $table->string('Other_Ref')->nullable();
            // $table->string('due_date')->nullable();
            $table->date('effect_check_date')->nullable();
            $table->date('occurance_date')->nullable();
            $table->string('due_date_extension')->nullable();
            $table->integer('assign_to')->nullable();
            $table->string('Incident_Category')->nullable();
            $table->string('Invocation_Type')->nullable();
            $table->text('Initial_Attachment')->nullable();
            $table->text('Incident_Details')->nullable();
            $table->text('Document_Details')->nullable();
            $table->text('Instrument_Details')->nullable();
            $table->text('Involved_Personnel')->nullable();
            $table->text('Product_Details')->nullable();
            $table->text('Supervisor_Review_Comments')->nullable();
            $table->text('Attachments')->nullable();
            $table->text('Cancelation_Remarks')->nullable();
            $table->text('Inv_Attachment')->nullable();
            $table->text('Investigation_Details')->nullable();
            $table->text('Action_Taken')->nullable();
            $table->text('Root_Cause')->nullable();
            $table->text('Currective_Action')->nullable();
            $table->text('Preventive_Action')->nullable();
            $table->text('Corrective_Preventive_Action')->nullable();
            $table->text('CAPA_Attachment')->nullable();
            $table->text('QA_Review_Comments')->nullable();
            $table->text('QA_Head_Attachment')->nullable();
            $table->longtext('QA_Head')->nullable();
            $table->text('Effectiveness_Check')->nullable();
            $table->date('effectivess_check_creation_date')->nullable();
            $table->text('Incident_Type')->nullable();
            $table->longtext('Conclusion')->nullable();
            $table->text('status')->nullable();
            $table->integer('stage')->nullable();

            $table->text('submitted_by')->nullable();
            $table->text('verification_complete_completed_by')->nullable();
            $table->text('preliminary_completed_by')->nullable();
            $table->text('inv_andCAPA_review_comp_by')->nullable();
            $table->text('qA_review_completed_by')->nullable();
            $table->text('qA_head_approval_completed_by')->nullable();
            $table->text('assesment_completed_by')->nullable();
            $table->text('closure_completed_by')->nullable();
            $table->text('extended_inv_complete_by')->nullable();
            $table->text('closure_completed_on')->nullable();
            $table->text('comment')->nullable();
            $table->text('cancelled_by')->nullable();
            $table->text('submitted_on')->nullable();
            $table->text('verification_completed_on')->nullable();
            $table->text('assesment_completed_on')->nullable();
            $table->text('extended_inv_complete_on')->nullable();
            $table->text('verification_complete_comment')->nullable();
            $table->text('all_activities_completed_comment')->nullable();
            $table->text('no_assignable_cause_comment')->nullable();
            $table->text('extended_inv_comment')->nullable();
            $table->text('solution_validation_comment')->nullable();
            $table->text('assessment_comment')->nullable();
            $table->text('all_action_approved_comment')->nullable();
            $table->text('pending_approval_comment')->nullable();
            $table->text('closure_comment')->nullable();
            $table->text('cancell_comment')->nullable();
            $table->text('all_actiion_approved_by')->nullable();
            $table->text('all_actiion_approved_on')->nullable();
            $table->text('preliminary_completed_on')->nullable();
            $table->text('inv_andCAPA_review_comp_on')->nullable();
            $table->text('qA_review_completed_on')->nullable();
            $table->text('qA_head_approval_completed_on')->nullable();
            $table->text('review_completed_by')->nullable();
            $table->text('review_completed_on')->nullable();
            $table->text('all_activities_completed_by')->nullable();
            $table->text('all_activities_completed_on')->nullable();
          
            // new added -- General Information

            $table->longtext('incident_involved_others_gi')->nullable();
            $table->longtext('description_incidence_gi')->nullable();
            $table->longtext('stage_stage_gi')->nullable();
            $table->longtext('incident_stability_cond_gi')->nullable();
            $table->text('incident_interval_others_gi')->nullable();
            $table->text('test_gi')->nullable();
            $table->text('date_gi')->nullable();
            $table->text('incident_date_analysis_gi')->nullable();
            $table->text('incident_specification_no_gi')->nullable();
            $table->text('incident_stp_no_gi')->nullable();
            $table->text('Incident_name_analyst_no_gi')->nullable();
            $table->text('incident_date_incidence_gi')->nullable();
            $table->text('analyst_sign_date_gi')->nullable();
            $table->text('section_sign_date_gi')->nullable();
            $table->longtext('attachments_gi')->nullable();
            // $table->longtext('section_sign_date_gi')->nullable();

            //new added --Immediate Actions
            $table->text('preliminary_completed_comment')->nullable();
            $table->text('no_assignable_cause_by')->nullable();
            $table->text('no_assignable_cause_on')->nullable();
            $table->longtext('immediate_action_ia')->nullable();
            $table->text('immediate_date_ia')->nullable();
            $table->text('section_date_ia')->nullable();
            $table->longtext('details_investigation_ia')->nullable();
            $table->longtext('proposed_correctivei_ia')->nullable();
            $table->longtext('repeat_analysis_plan_ia')->nullable();
            $table->longtext('result_of_repeat_analysis_ia')->nullable();
            $table->longtext('corrective_and_preventive_action_ia')->nullable();
            $table->text('capa_number_im')->nullable();
            $table->longtext('investigation_summary_ia')->nullable();
            $table->text('type_incidence_ia')->nullable();
            $table->longtext('attachments_ia')->nullable();
            // Extension
            $table->longtext('reasoon_for_extension_e')->nullable();
            $table->longtext('extension_date_e')->nullable();
            $table->text('extension_date_fe')->nullable();
            $table->text('extension_date_initiator')->nullable();
            $table->longtext('reasoon_for_extension_esc')->nullable();
            $table->text('extension_date_esc')->nullable();
            $table->text('extension_date_idsc')->nullable();
            $table->longtext('reasoon_for_extension_tc')->nullable();
            $table->text('extension_date__tc')->nullable();
            $table->text('extension_date_idtc')->nullable();
            $table->longtext('extension_attachments_e')->nullable();
            


            




            // $table->string('cancelled_by')->nullable();
            $table->string('cancelled_on')->nullable();
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
        Schema::dropIfExists('lab_incidents');
    }
};
