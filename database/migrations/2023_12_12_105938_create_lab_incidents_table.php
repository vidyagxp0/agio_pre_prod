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
            $table->string('Effectiveness_Check')->nullable();
            $table->date('effectivess_check_creation_date')->nullable();
            $table->string('Incident_Type')->nullable();
            $table->longtext('Conclusion')->nullable();
            $table->string('status')->nullable();
            $table->integer('stage')->nullable();

            $table->string('submitted_by')->nullable();
            $table->string('incident_review_completed_by')->nullable();
            $table->string('investigation_completed_by')->nullable();
            $table->string('inv_andCAPA_review_comp_by')->nullable();
            $table->string('qA_review_completed_by')->nullable();
            $table->string('qA_head_approval_completed_by')->nullable();
            $table->string('cancelled_by')->nullable();

            $table->string('submitted_on')->nullable();
            $table->string('incident_review_completed_on')->nullable();
            $table->string('investigation_completed_on')->nullable();
            $table->string('inv_andCAPA_review_comp_on')->nullable();
            $table->string('qA_review_completed_on')->nullable();
            $table->string('qA_head_approval_completed_on')->nullable();
            $table->string('review_completed_by')->nullable();
            $table->string('review_completed_on')->nullable();
            $table->string('all_activities_completed_by')->nullable();
            $table->string('all_activities_completed_on')->nullable();
          
            // new added -- General Information

            $table->longtext('incident_involved_others_gi')->nullable();
            $table->longtext('description_incidence_gi')->nullable();
            $table->longtext('stage_stage_gi')->nullable();
            $table->longtext('incident_stability_cond_gi')->nullable();
            $table->string('incident_interval_others_gi')->nullable();
            $table->string('test_gi')->nullable();
            $table->string('date_gi')->nullable();
            $table->string('incident_date_analysis_gi')->nullable();
            $table->string('incident_specification_no_gi')->nullable();
            $table->string('incident_stp_no_gi')->nullable();
            $table->string('Incident_name_analyst_no_gi')->nullable();
            $table->string('incident_date_incidence_gi')->nullable();
            $table->string('analyst_sign_date_gi')->nullable();
            $table->string('section_sign_date_gi')->nullable();
            $table->longtext('attachments_gi')->nullable();
            // $table->longtext('section_sign_date_gi')->nullable();

            //new added --Immediate Actions

            $table->longtext('immediate_action_ia')->nullable();
            $table->string('immediate_date_ia')->nullable();
            $table->string('section_date_ia')->nullable();
            $table->longtext('details_investigation_ia')->nullable();
            $table->longtext('proposed_correctivei_ia')->nullable();
            $table->longtext('repeat_analysis_plan_ia')->nullable();
            $table->longtext('result_of_repeat_analysis_ia')->nullable();
            $table->longtext('corrective_and_preventive_action_ia')->nullable();
            $table->string('capa_number_im')->nullable();
            $table->longtext('investigation_summary_ia')->nullable();
            $table->string('type_incidence_ia')->nullable();
            $table->longtext('attachments_ia')->nullable();
            // Extension
            $table->longtext('reasoon_for_extension_e')->nullable();
            $table->longtext('extension_date_e')->nullable();
            $table->string('extension_date_fe')->nullable();
            $table->string('extension_date_initiator')->nullable();
            $table->longtext('reasoon_for_extension_esc')->nullable();
            $table->string('extension_date_esc')->nullable();
            $table->string('extension_date_idsc')->nullable();
            $table->longtext('reasoon_for_extension_tc')->nullable();
            $table->string('extension_date__tc')->nullable();
            $table->string('extension_date_idtc')->nullable();
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
