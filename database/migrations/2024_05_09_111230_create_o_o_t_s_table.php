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
        Schema::create('o_o_t_s', function (Blueprint $table) {
            $table->id();
            $table->integer('initiator_id')->nullable();
            $table->string('division_id')->nullable();
            $table->string('record_number')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('initiator_group')->nullable();
            $table->string('initiator_group_code')->nullable();
            $table->date('due_date')->nullable();
            $table->string('severity_level')->nullable();
            

            $table->longtext('initiated_through')->nullable();
            $table->string('if_others')->nullable();
            $table->longtext('is_repeat')->nullable();
            $table->longtext('repeat_nature')->nullable();
            $table->longtext('closure_attachment')->nullable();
            $table->date('deviation_occured_on')->nullable();
            $table->longtext('description_closure_attachment')->nullable();
            $table->text('initial_attachment')->nullable();
            $table->string('source_document')->nullable();
            $table->longtext('reference_record')->nullable();
            $table->longtext('reference_document')->nullable();
            $table->string('product_material_name')->nullable();
            $table->text('grade_typeofwater')->nullable();
            $table->text('sample_locationpoint')->nullable();
            $table->text('market')->nullable();
            $table->string('customer')->nullable();
            // ------------------------grid----------------
            $table->text('analyst_name')->nullable();
            $table->longtext('sample_type')->nullable();
            $table->text('others_specify')->nullable();
            $table->longtext('stability_for')->nullable();
            // ------------------------grid----------------
            $table->text('specification_procedure_no')->nullable();
            $table->text('specification_limit')->nullable();
            // grid
            $table->longtext('gi_attachment')->nullable();
             // tab 2 under preliminary lab 
            $table->longtext('upl_comments')->nullable();
            $table->text('verification_analysis_required')->nullable();
            $table->longtext('upl_refrence_record')->nullable();
            $table->text('upl_anlyst_interview')->nullable();
            $table->longtext('analyst_interview_ref')->nullable();
            //grid
            $table->longtext('justi_if_no_analyst')->nullable();
            $table->text('phase_invest_required')->nullable();
            $table->text('phase_investigation')->nullable();
            $table->longtext('phase_invest_ref')->nullable();
            $table->longtext('upli_attachment')->nullable();
       
            //table 3
            $table->longtext('summary_preliminary_investigation')->nullable();
            $table->text('root_cause_identified')->nullable();
            $table->text('oot_category_root')->nullable();
            $table->longtext('soot_category')->nullable();
            $table->longtext('root_cause_details')->nullable();
            $table->longtext('impact_of_root_cause')->nullable();
            $table->longtext('recommended_action_req')->nullable();
            $table->longtext('recommend_action_refre')->nullable();
            $table->string('capa_required')->nullable();
            $table->longtext('capa_refrence_no')->nullable();
            $table->longtext('delay_justification')->nullable();
            $table->longtext('conclusionattachment[')->nullable();

            //tab 4
            $table->longtext('review_comment')->nullable();
            //grid
            $table->string('capa_review')->nullable();
            $table->longtext('capa_refrence_review')->nullable();
            $table->longtext('plir_attachment')->nullable();

            //tab5
            $table->longtext('qa_approver_report')->nullable();
            $table->text('manufacture_invest')->nullable();
            $table->longtext('manufacturing_invest')->nullable();
            $table->longtext('manufacturing_invest_ref')->nullable();
            $table->string('re_sampling_required')->nullable();
            $table->longtext('re_sampling_ref_no')->nullable();
            $table->text('hypo_required')->nullable();
            $table->longtext('hypo_expo_ref')->nullable();
            $table->longtext('phase_inv_attachment')->nullable();
            //tab 6
            $table->longtext('summary_ofexp')->nullable();
            $table->text('summary_manuf_invest')->nullable();
            $table->text('root_cause_qcreview')->nullable();
            $table->text('oot_category_qcreview')->nullable();
            $table->text('ott_category_others')->nullable();
            $table->longtext('qcroot_details')->nullable();
            $table->longtext('qcreview_impactassessment')->nullable();
            $table->text('qcr_recommend_action')->nullable();
            $table->longtext('qcr_action_refrence')->nullable();
            $table->text('qcr_investigation_req')->nullable();
            $table->longtext('qcr_invest_refrence')->nullable();
            $table->longtext('qcr_justify_required')->nullable();
            $table->longtext('qcr_attachment')->nullable();

            //tab7
            $table->longtext('atp_review_comment')->nullable();
            $table->text('atp_add_test_proposal')->nullable();
            $table->longtext('atp_add_test_ref')->nullable();
            $table->text('atp_any_action_req')->nullable();
            $table->longtext('atp_action_task_ref')->nullable();
            $table->longtext('atp_attachment')->nullable();
            //tab8
              //OOT Conclusion
              $table->longtext('summary_of_OOT_test_results_oot_c')->nullable();
              $table->string('trend_limit_oot_c')->nullable();
              $table->longtext('oot_stands_oot_c')->nullable();
              $table->string('result_to_be_reported_oot_c')->nullable();
              $table->longtext('reporting_results_oot_c')->nullable();
              $table->string('capa_required_oot_c')->nullable();
              $table->longtext('capa_reference_no_oot_c')->nullable();
              $table->string('action_plan_required_oot_c')->nullable();
              $table->longtext('action_plan_reference_oot_c')->nullable();
              $table->longtext('justification_for_delay_oot_c')->nullable();
              $table->longtext('attachment_if_any_oot_c')->nullable();
   
               //OOT Conclusion Review
               $table->longtext('conclusion_review_comments_oot_cr')->nullable();
               $table->string('capa_required_oot_cr')->nullable();
               $table->longtext('capa_reference_oot_cr')->nullable();
               $table->string('required_action_plan_oot_cr')->nullable();
               $table->longtext('reference_record_plan_oot_cr')->nullable();
               $table->string('action_task_required_oot_cr')->nullable();
               $table->longtext('action_task_reference_oot_cr')->nullable();
               $table->string('risk_assessment_required_oot_cr')->nullable();
               $table->longtext('risk_assessment_reference_oot_cr')->nullable();
               $table->longtext('file_attachment_oot_cr')->nullable();
               $table->longtext('cq_approver_oot_cr')->nullable();
   
   
   
   
               //OOT CQ Review
               $table->longtext('cq_review_comments_oot_cq_r')->nullable();
               $table->string('capa_requirement_oot_cq_r')->nullable();
               $table->longtext('reference_of_capa_oot_cq_r')->nullable();
               $table->string('action_plan_requirement_oot_cq_r')->nullable();
               $table->longtext('reference_action_plan_oot_cq_r')->nullable();
               $table->longtext('qa_attachment_oot_cq_r')->nullable();
   
                //Batch Disposition
               $table->longtext('disposition_comments_bd')->nullable();
               $table->string('oot_category_bd')->nullable();
               $table->text('others_bd')->nullable();
               $table->string('material_batch_release_bd')->nullable();
               $table->longtext('conclusion_bd')->nullable();
               $table->longtext('justify_for_delay_in_activity_bd')->nullable();
               $table->longtext('file_attachment_bd')->nullable();
   
               //RE-Open
               $table->longtext('reason_for_reopen_re')->nullable();
               $table->longtext('reopen_attachment_re')->nullable();
   
               //Under Addendum Approval
               $table->longtext('approval_comments_uaa')->nullable();
               $table->longtext('approval_attachment_uaa')->nullable();
   
               //Under Addendum Execution
               $table->longtext('execution_comments_uae')->nullable();
               $table->string('action_task_required_uae')->nullable();
               $table->longtext('action_task_reference_uae')->nullable();
               $table->string('add_testing_required_uae')->nullable();
               $table->longtext('add_testing_reference_uae')->nullable();
               $table->string('investigation_requirement_uae')->nullable();
               $table->text('investigation_reference_uae')->nullable();
               $table->text('hypothesis_experiment_requirement_uae')->nullable();
               $table->text('hypothesis_experiment_reference_uae')->nullable();
               $table->text('any_attachment_uae')->nullable();
   
   
   
               //Under Addendum Review
               $table->longtext('addendum_review_comments_uar')->nullable();
               $table->longtext('required_attachment_uar')->nullable();
   
               //under Addendum Verification
               $table->longtext('verification_comments_uav')->nullable();
               $table->longtext('verification_attachment_uav')->nullable();
            






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
        Schema::dropIfExists('o_o_t_s');
    }
};
