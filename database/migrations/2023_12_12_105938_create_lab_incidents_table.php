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


            //System Suitability Failure Incidence
            $table->longText('instrument_involved_SSFI')->nullable();
            $table->string('stage_SSFI')->nullable();
            $table->string('stability_condition_SSFI')->nullable();
            $table->string('interval_SSFI')->nullable();
            $table->string('test_SSFI')->nullable();
            $table->string('date_of_analysis_SSFI')->nullable();
            $table->string('specification_number_SSFI')->nullable();
            $table->string('stp_number_SSFI')->nullable();
            $table->string('name_of_analyst_SSFI')->nullable();
            $table->string('date_of_incidence_SSFI')->nullable();
            $table->string('qc_reviewer_SSFI')->nullable();
            $table->longText('description_of_incidence_SSFI')->nullable();
            $table->longText('detail_investigation_SSFI')->nullable();
            $table->longText('proposed_corrective_action_SSFI')->nullable();
            $table->longText('root_cause_SSFI')->nullable();
            $table->longText('incident_summary_SSFI')->nullable();
            $table->string('investigator_qc_SSFI')->nullable();
            $table->string('reviewed_by_qc_SSFI')->nullable();
            $table->longText('file_attachment_SSFI')->nullable();

            //Closure
            $table->string('closure_of_incident_closure')->nullable();
            $table->string('affected_documents_closed_closure')->nullable();
            $table->string('qc_head_remark_closure')->nullable();
            $table->string('qc_head_closure')->nullable();
            $table->longText('qa_head_remark_closure')->nullable();
            $table->longText('file_attachment_closure')->nullable();








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
