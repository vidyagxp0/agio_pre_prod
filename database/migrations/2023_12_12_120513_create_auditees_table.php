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
        Schema::create('auditees', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            // $table->integer('initiator_id')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->string('division_id')->nullable();
            $table->string('division_code')->nullable();
            $table->string('initiator_group_code')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('form_type')->nullable();

            $table->integer('record')->nullable();
           // $table->integer('parent_id')->nullable();
            //$table->string('parent_type')->nullable();
            $table->integer('assign_to')->nullable();
            $table->string('Initiator_Group')->nullable();
            $table->text('short_description')->nullable();
            $table->string('audit_type')->nullable();
            $table->text('if_other')->nullable();
            $table->text('initiated_through')->nullable();
            $table->text('initiated_if_other')->nullable();
            $table->text('others')->nullable();
            $table->text('repeat')->nullable();
            $table->text('repeat_nature')->nullable();
            $table->text('initial_comments')->nullable();
            $table->text('severity_level')->nullable();
            $table->string('due_date')->nullable();
            $table->string('audit_start_date')->nullable();
            $table->string('audit_end_date')->nullable();
            $table->string('external_agencies')->nullable();
            //<!-- ------------------------------- -->
            $table->longText('inv_attachment')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->text('audit_agenda')->nullable();
            //$table->text('Facility')->nullable();
            //$table->text('Group')->nullable();
            $table->text('material_name')->nullable();
            $table->text('if_comments')->nullable();
            // -------------------------
            $table->string('lead_auditor')->nullable();
            $table->longText('file_attachment')->nullable();
            $table->text('Audit_team')->nullable();
            $table->text('Auditee')->nullable();
            $table->text('Auditor_Details')->nullable();
            $table->text('External_Auditing_Agency')->nullable();
            $table->text('Relevant_Guidelines')->nullable();
            $table->text('QA_Comments')->nullable();
            $table->text('file_attachment_guideline')->nullable();
            $table->text('Audit_Category')->nullable();
            $table->text('Supplier_Details')->nullable();
            $table->text('Supplier_Site')->nullable();
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
            $table->string('audit_details_summary_by')->nullable();
            $table->string('audit_details_summary_on')->nullable();
            $table->string('audit_details_summary_on_comment')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->string('cancelled_on')->nullable();
            // $table->string('cancelled_on_comment')->nullable();
            $table->string('summary_and_response_com_by')->nullable();
            $table->string('summary_and_response_com_on')->nullable();
            $table->string('summary_and_response_com_on_comment')->nullable();
            $table->string('cft_review_not_req_by')->nullable();
            $table->string('cft_review_not_req_on')->nullable();
            $table->string('cft_review_not_req_on_comment')->nullable();
            $table->string('more_info_req_by')->nullable();
            $table->string('more_info_req_on')->nullable();
            $table->string('more_info_req_on_comment')->nullable();
            $table->string('cft_review_complete_by')->nullable();
            $table->string('cft_review_complete_on')->nullable();
            $table->string('cft_review_complete_comment')->nullable();
            $table->string('more_info_req_crc_by')->nullable();
            $table->string('more_info_req_crc_on')->nullable();
            $table->string('more_info_req_crc_on_comment')->nullable();
            $table->string('approval_complete_by')->nullable();
            $table->string('approval_complete_on')->nullable();
            $table->string('approval_complete_on_comment')->nullable();
            $table->string('send_to_opened_by')->nullable();
            $table->string('send_to_opened_on')->nullable();
            $table->string('send_to_opened_comment')->nullable();
            
            
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
        Schema::dropIfExists('auditees');
    }
};
