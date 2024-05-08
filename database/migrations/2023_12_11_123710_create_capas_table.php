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
            $table->string('capa_related_record')->nullable();
            // $table->string('reference_record')->nullable();
            $table->longText('initial_observation')->nullable();
            $table->string('interim_containnment')->nullable();
            $table->longText('containment_comments')->nullable();
            $table->string('capa_attachment')->nullable();
            $table->longText('capa_qa_comments')->nullable();
            $table->longText('capa_qa_comments2')->nullable();
            $table->text('Microbiology_new')->nullable();
            // $table->text('Microbiology_Person')->nullable();
            $table->text('goup_review')->nullable();
            $table->text('Production_new')->nullable();
            $table->text('Production_Person')->nullable();
            $table->text('Quality_Approver')->nullable();
            $table->text('Quality_Approver_Person')->nullable();
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
            $table->longText('corrective_action')->nullable();
            $table->longText('preventive_action')->nullable();
            $table->longText('supervisor_review_comments')->nullable();
            $table->longText('qa_review')->nullable();
            $table->text('effectiveness')->nullable();
            $table->string('effect_check')->nullable();
            $table->date('effect_check_date')->nullable();
            $table->text('closure_attachment')->nullable();
            $table->string('rejected_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('completed_by')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->string('qa_more_info_required_by')->nullable();
            $table->string('plan_approved_by')->nullable();
            $table->string('plan_proposed_by')->nullable();

            $table->string('plan_proposed_on')->nullable();
            $table->string('Plan_approved_on')->nullable();
            $table->string('qa_more_info_required_on')->nullable();
            $table->string('cancelled_on')->nullable();
            $table->string('completed_on')->nullable();
            $table->string('approved_on')->nullable();
            $table->string('rejected_on')->nullable();
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
