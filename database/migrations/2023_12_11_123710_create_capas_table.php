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
        Schema::create('capas', function (Blueprint $table) {
            $table->id();
            $table->integer('record')->nullable();
            $table->string('form_type')->nullable();
            $table->string('division_id')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->string('division_code')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('due_date')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('parent_type')->nullable();
            $table->string('general_initiator_group')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('problem_description')->nullable();
            $table->longText('initiated_through')->nullable();
            $table->text('initiated_through_req')->nullable();
            $table->text('repeat')->nullable();
            $table->longText('repeat_nature')->nullable();
            $table->text('Effectiveness_checker')->nullable();
            $table->text('effective_check_plan')->nullable();
            $table->longText('due_date_extension')->nullable();
            $table->text('capa_type')->nullable();
            $table->integer('assign_to')->nullable();
            $table->string('initiator_group_code')->nullable();
            $table->string('severity_level_form')->nullable();
            $table->text('cft_comments_form')->nullable();
            $table->text('qa_comments_new')->nullable();
             $table->text('designee_comments_new')->nullable();
             $table->text('Warehouse_comments_new')->nullable();
             $table->text('Engineering_comments_new')->nullable();
            $table->text('Instrumentation_comments_new')->nullable();
            $table->text('Validation_comments_new')->nullable();
            $table->text('Others_comments_new')->nullable();
            $table->text('Group_comments_new')->nullable();
            $table->string('cft_attchament_new')->nullable();
            $table->string('group_attachments_new')->nullable();
            $table->longText('details_new')->nullable();
          
            $table->string('capa_team')->nullable();
            $table->text('initiator_Group')->nullable();
            $table->longText('capa_related_record')->nullable();
            // $table->string('reference_record')->nullable();
            $table->longText('initial_observation')->nullable();
            $table->string('interim_containnment')->nullable();
            $table->longText('containment_comments')->nullable();
            $table->longText('capa_attachment')->nullable();
            $table->longText('capa_qa_comments')->nullable();
            $table->longText('capa_qa_comments2')->nullable();
            $table->text('Microbiology_new')->nullable();
            // $table->text('Microbiology_Person')->nullable();
            $table->longText('goup_review')->nullable();
            $table->longText('Production_new')->nullable();
            $table->longText('Production_Person')->nullable();
            $table->longText('Quality_Approver')->nullable();
            $table->longText('Quality_Approver_Person')->nullable();
            $table->text('bd_domestic')->nullable();
            $table->text('Bd_Person')->nullable();
            $table->string('additional_attachments')->nullable();
            
            $table->string('project_details_application')->nullable();
            $table->text('project_initiator_group')->nullable();
            $table->string('site_number')->nullable();
            $table->string('subject_number')->nullable();
            $table->string('subject_initials')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('general_deviation')->nullable();
            $table->Text('corrective_action')->nullable();
            $table->Text('preventive_action')->nullable();
            $table->Text('supervisor_review_comments')->nullable();
            $table->Text('qa_review')->nullable();
            $table->text('effectiveness')->nullable();
            $table->string('effect_check')->nullable();
            $table->date('effect_check_date')->nullable();
            $table->longText('closure_attachment')->nullable();
            $table->text('plan_proposed_by')->nullable();
            $table->string('plan_proposed_on')->nullable();
            $table->string('comment')->nullable();
            $table->text('cancelled_by')->nullable();
            $table->string('cancelled_on')->nullable();
            $table->string('cancel_comment')->nullable();
            $table->text('hod_review_completed_by')->nullable();
            $table->string('hod_review_completed_on')->nullable();
            $table->text('hod_comment')->nullable();
            $table->text('more_info_required_by')->nullable();
            $table->string('more_info_required_on')->nullable();
            $table->text('hod_comment1')->nullable();
            $table->text('qa_review_completed_by')->nullable();
            $table->string('qa_review_completed_on')->nullable();
            $table->text('qa_comment')->nullable();
            $table->text('qa_more_info_required_by')->nullable();
            $table->string('qa_more_info_required_on')->nullable();
            $table->text('qa_commenta')->nullable();
            $table->text('approved_by')->nullable();
            $table->string('approved_on')->nullable();
            $table->string('approved_comment')->nullable();
            $table->text('app_more_info_required_by')->nullable();
            $table->string('app_more_info_required_on')->nullable();
            $table->text('app_comment')->nullable();
            $table->text('completed_by')->nullable();
            $table->string('completed_on')->nullable();
            $table->text('com_comment')->nullable();
            $table->text('com_more_info_required_by')->nullable();
            $table->string('com_more_info_required_on')->nullable();
            $table->text('com_comment1')->nullable();
            $table->text('hod_final_review_completed_by')->nullable();
            $table->string('hod_final_review_completed_on')->nullable();
            $table->text('final_comment')->nullable();
            $table->text('hod_more_info_required_by')->nullable();
            $table->string('hod_more_info_required_on')->nullable();
            $table->text('final_hod_comment')->nullable();
            $table->text('qa_closure_review_completed_by')->nullable();
            $table->string('qa_closure_review_completed_on')->nullable();
            $table->text('qa_closure_comment')->nullable();
            $table->text('closure_more_info_required_by')->nullable();
            $table->string('closure_qa_more_info_required_on')->nullable();
            $table->text('closure_qa_comment')->nullable();
            $table->string('qah_approval_completed_on')->nullable();
            $table->string('qah_approval_completed_by')->nullable();
            $table->text('qah_comment')->nullable();
            $table->text('qah_more_info_required_by')->nullable();
            $table->string('qah_more_info_required_on')->nullable();
            $table->text('qah_comment1')->nullable();
            $table->string('status')->nullable();
            $table->integer('stage')->nullable();
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
        Schema::dropIfExists('capas');
    }
};
