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
        Schema::create('internal_audits', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            // $table->integer('initiator_id')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->string('division_id')->nullable();
            $table->string('division_code')->nullable();
            $table->string('initiator_group_code')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('form_type')->nullable();
            $table->string('due_date')->nullable();
            $table->string('audit_schedule_start_date')->nullable();
            $table->string('audit_schedule_end_date')->nullable();
           // $table->string('record_number')->nullable();
            $table->string('external_agencies')->nullable();
            $table->string('severity_level_form')->nullable();
             $table->integer('assign_to')->nullable();
 
             $table->integer('record')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('parent_type')->nullable();
            // $table->integer('assigend')->nullable();
            $table->string('Initiator_Group')->nullable();
            $table->text('short_description')->nullable();
            $table->string('audit_type')->nullable();
            $table->text('if_other')->nullable();
            // $table->text('external_others')->nullable();
            $table->string('initiated_through')->nullable();
            $table->text('initiated_if_other')->nullable();
            $table->text('repeat')->nullable();
            $table->text('repeat_nature')->nullable();
            $table->text('initial_comments')->nullable();
            // $table->string('due_date')->nullable();
            $table->string('audit_start_date')->nullable();
            $table->string('audit_end_date')->nullable();
            //<!-- ------------------------------- -->
            $table->longText('inv_attachment')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->text('audit_agenda')->nullable();
            $table->text('Others')->nullable();
            // $table->text('Facility')->nullable();
            //$table->text('Group')->nullable();
            $table->text('material_name')->nullable();
            $table->text('if_comments')->nullable();
            $table->string('lead_auditor')->nullable();
            // -------------------------
            $table->longText('file_attachment')->nullable();
            $table->text('Audit_team')->nullable();
            $table->text('Auditee')->nullable();
            $table->text('Auditor_Details')->nullable();
            $table->text('External_Auditing_Agency')->nullable();
            $table->text('Relevant_Guideline')->nullable();
            $table->text('QA_Comments')->nullable();
            $table->text('file_attachment_guideline')->nullable();
            $table->text('Audit_Category')->nullable();
            $table->text('Supplier_Details')->nullable();
            $table->text('Supplier_Site')->nullable();
            $table->text('refrence_record')->nullable();

            
            $table->text('Comments')->nullable();
            $table->longText('Audit_file')->nullable();
            $table->text('Audit_Comments1')->nullable();
            $table->text('Remarks')->nullable();
            $table->longText('report_file')->nullable();
            $table->text('Reference_Recores1')->nullable();
            $table->text('Reference_Recores2')->nullable();
            $table->longText('myfile')->nullable();
            $table->text('Audit_Comments2')->nullable();
            $table->text('due_date_extension')->nullable();
            $table->string('status')->nullable();
            $table->integer('stage')->nullable();
            $table->string('audit_schedule_by')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->string('audit_preparation_completed_by')->nullable();
            $table->string('audit_mgr_more_info_reqd_by')->nullable();
            $table->string('rejected_on')->nullable();
            $table->string('rejected_by')->nullable();
            $table->string('audit_observation_submitted_by')->nullable();
            $table->string('audit_lead_more_info_reqd_by')->nullable();
            $table->string('audit_response_completed_by')->nullable();
            $table->string('response_feedback_verified_by')->nullable();
            $table->string('audit_schedule_on')->nullable();
            $table->string('cancelled_on')->nullable();
            $table->string('audit_preparation_completed_on')->nullable();
            $table->string('audit_mgr_more_info_reqd_on')->nullable();
            $table->string('audit_observation_submitted_on')->nullable();
            $table->string('audit_lead_more_info_reqd_on')->nullable();
            $table->string('audit_response_completed_on')->nullable();
            $table->string('response_feedback_verified_on')->nullable();
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
        Schema::dropIfExists('internal_audits');
    }
};
