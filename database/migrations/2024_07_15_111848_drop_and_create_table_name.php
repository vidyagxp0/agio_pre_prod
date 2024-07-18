<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
       Schema::dropIfExists('o_o_s__micros');
       Schema::create('o_o_s__micros', function (Blueprint $table) {
        $table->id();
        $table->integer('record')->nullable();
        $table->string('form_type')->nullable();
        $table->string('division_id')->nullable();
        $table->integer('initiator_id')->nullable();
        $table->string('intiation_date')->nullable();
        $table->string('due_date')->nullable();
        $table->longText('description_gi')->nullable();
        $table->string('severity_level_gi')->nullable();
        $table->string('initiator_Group')->nullable();
        $table->string('initiator_group_code')->nullable();
        $table->text('initiated_through')->nullable();
        $table->longText('if_others_gi')->nullable();
        $table->string('is_repeat_gi')->nullable();
        $table->longText('repeat_nature_gi')->nullable();
        $table->string('nature_of_change_gi')->nullable();
        $table->string('deviation_occured_on_gi')->nullable();
        $table->longText('initial_attachment_gi')->nullable();
        $table->string('source_document_type_gi')->nullable();
        $table->longText('reference_system_document_gi')->nullable();
        $table->longText('reference_document_gi')->nullable();
        $table->text('sample_type_gi')->nullable();
        $table->text('product_material_name_gi')->nullable();
        $table->text('market_gi')->nullable();
        $table->text('customer_gi')->nullable();

        // preliminary lab investigation
        $table->longText('comments_pli')->nullable();
        $table->string('field_alert_required_pli')->nullable();
        $table->string('field_alert_ref_no_pli')->nullable();
        $table->longText('justify_if_no_field_alert_pli')->nullable();
        $table->string('verification_analysis_required_pli')->nullable();
        $table->longText('verification_analysis_ref_pli')->nullable();
        $table->string('analyst_interview_req_pli')->nullable();
        $table->longText('analyst_interview_ref_pli')->nullable();
        $table->longText('justify_if_no_analyst_int_pli')->nullable();
        $table->string('phase_i_investigation_required_pli')->nullable();
        $table->string('phase_i_investigation_pli')->nullable();
        $table->longText('phase_i_investigation_ref_pli')->nullable();
        $table->longText('file_attachments_pli')->nullable();

        // preliminary lab inv Conclusion
        $table->longText('summary_of_prelim_investiga_plic')->nullable();
        $table->string('root_cause_identified_plic')->nullable();
        $table->string('oos_category_root_cause_ident_plic')->nullable();
        $table->longText('oos_category_others_plic')->nullable();
        $table->longText('root_cause_details_plic')->nullable();
        $table->longText('oos_category_root_cause_plic')->nullable();
        $table->string('recommended_actions_required_plic')->nullable();
        $table->longText('recommended_actions_reference_plic')->nullable();
        $table->string('capa_required_plic')->nullable();
        $table->string('reference_capa_no_plic')->nullable();
        $table->longText('delay_justification_for_pi_plic')->nullable();
        $table->longText('supporting_attachment_plic')->nullable();

        // preliminary lab invst  Review
        $table->longText('review_comments_plir')->nullable();
        $table->string('phase_ii_inv_required_plir')->nullable();
        $table->longText('supporting_attachments_plir')->nullable();

        // checklist investigation of bacteria endotoxin test
        $table->longtext('attachment_details_cibet')->nullable();
        //checklist investigation of sterility
        $table->longtext('attachment_details_cis')->nullable();
        //checklist investigation of microbial limit bioburden and water test
        $table->longtext('attachment_details_cimlbwt')->nullable();
        //checklist investigation of microbial assay
        $table->longtext('attachment_details_cima')->nullable();
        //checklist investigation of environmental monitoring
        $table->longtext('attachment_details_ciem')->nullable();
        //checklist investigation of media suitability test
        $table->longtext('attachment_details_cimst')->nullable();

        // phase ii investigation
        $table->longText('qa_approver_comments_piii')->nullable();
        $table->longText('reason_manufacturing_piii')->nullable(); 
        $table->string('manufact_invest_required_piii')->nullable();
        $table->longText('manufacturing_invest_type_piii')->nullable();
        $table->longText('manufacturing_invst_ref_piii')->nullable();
        $table->string('re_sampling_required_piii')->nullable();
        $table->longText('audit_comments_piii')->nullable();
        $table->longText('re_sampling_ref_no_piii')->nullable();
        $table->string('hypo_exp_required_piii')->nullable();
        $table->longText('hypo_exp_reference_piii')->nullable();
        $table->longText('attachment_piii')->nullable();

        // Phase ii QC Review
        $table->longText('summary_of_exp_hyp_piiqcr')->nullable();
        $table->longText('summary_mfg_investigation_piiqcr')->nullable();
        $table->string('root_casue_identified_piiqcr')->nullable();
        $table->string('oos_category_reason_identified_piiqcr')->nullable();
        $table->longText('others_oos_category_piiqcr')->nullable();
        $table->longText('details_of_root_cause_piiqcr')->nullable();
        $table->longText('impact_assessment_piiqcr')->nullable();
        $table->string('recommended_action_required_piiqcr')->nullable();
        $table->longText('recommended_action_reference_piiqcr')->nullable();
        $table->string('investi_required_piiqcr')->nullable();
        $table->longText('invest_ref_piiqcr')->nullable();
        $table->longText('attachments_piiqcr')->nullable();

        // Additional testing proposal
        $table->longText('review_comment_atp')->nullable();
        $table->string('additional_test_proposal_atp')->nullable();
        $table->longText('additional_test_reference_atp')->nullable();
        $table->string('any_other_actions_required_atp')->nullable();
        $table->longText('action_task_reference_atp')->nullable();
        $table->longText('additional_testing_attachment_atp')->nullable();

        //oos conclusion
        $table->longText('conclusion_comments_oosc')->nullable();
        $table->longText('specification_limit_oosc')->nullable();
        $table->string('results_to_be_reported_oosc')->nullable();
        $table->longText('final_reportable_results_oosc')->nullable();
        $table->longText('justifi_for_averaging_results_oosc')->nullable();
        $table->string('oos_stands_oosc')->nullable();
        $table->string('capa_req_oosc')->nullable();
        $table->longText('capa_ref_no_oosc')->nullable();
        $table->longText('justify_if_capa_not_required_oosc')->nullable();
        $table->string('action_plan_req_oosc')->nullable();
        $table->longText('action_plan_ref_oosc')->nullable();
        $table->longText('justification_for_delay_oosc')->nullable();
        $table->longText('attachments_if_any_oosc')->nullable();

        //oos conclusion review
        $table->longtext('conclusion_review_comments_ocr')->nullable();
        $table->longtext('action_taken_on_affec_batch_ocr')->nullable();
        $table->string('capa_req_ocr')->nullable();
        $table->longtext('capa_refer_ocr')->nullable();
        $table->string('required_action_plan_ocr')->nullable();
        $table->string('required_action_task_ocr')->nullable();
        $table->longtext('action_task_reference_ocr')->nullable();
        $table->string('risk_assessment_req_ocr')->nullable();
        $table->longtext('risk_assessment_ref_ocr')->nullable();
        $table->longtext('justify_if_no_risk_assessment_ocr')->nullable();
        $table->longtext('conclusion_attachment_ocr')->nullable();
        $table->string('qa_approver_ocr')->nullable();

        //OOS CQ Review
        $table->string('capa_required_OOS_CQ')->nullable();
        $table->string('ref_action_plan_OOS_CQ')->nullable();
        $table->string('reference_of_capa_OOS_CQ')->nullable();
        $table->longText('cq_review_comments_OOS_CQ')->nullable();
        $table->longText('action_plan_requirement_OOS_CQ')->nullable();
        $table->longText('cq_attachment_OOS_CQ')->nullable();

        //Batch Disposition
        $table->string('oos_category_BI')->nullable();
        $table->string('others_BI')->nullable();
        $table->string('material_batch_release_BI')->nullable();
        $table->longText('other_action_BI')->nullable();
        $table->string('field_alert_reference_BI')->nullable();
        $table->longText('other_parameter_result_BI')->nullable();
        $table->longText('trend_of_previous_batches_BI')->nullable();
        $table->longText('stability_data_BI')->nullable();
        $table->longText('process_validation_data_BI')->nullable();
        $table->longText('method_validation_BI')->nullable();
        $table->longText('any_market_complaints_BI')->nullable();
        $table->longText('statistical_evaluation_BI')->nullable();
        $table->longText('risk_analysis_for_disposition_BI')->nullable();
        $table->longText('conclusion_BI')->nullable();
        $table->string('phase_III_inves_required_BI')->nullable();
        $table->longText('phase_III_inves_reference_BI')->nullable();
        $table->longText('justify_for_delay_BI')->nullable();
        $table->longText('disposition_attachment_BI')->nullable();
        $table->longText('reopen_approval_comments')->nullable();
        $table->longText('addendum_review_comments')->nullable();
        // $table->longText('reopen_approval_comments')->nullable();
        
        //REOpen
        $table->string('reopen_request')->nullable();
        $table->longText('reopen_attachment')->nullable();
        $table->text('status')->nullable();
        $table->text('stage')->nullable();
        $table->text('date_open')->nullable();
        $table->text('date_close')->nullable();
        $table->text('type')->nullable();
        $table->text('parent_record')->nullable();
        $table->text('Description_Deviation')->nullable();

        // extra field add by sonali
        $table->text('action_task_required')->nullable(); 
        $table->text('action_task_reference_no')->nullable();
        $table->text('addi_testing_ref')->nullable(); 
        $table->text('investigation_ref')->nullable();
        $table->text('hypo_exp_ref')->nullable(); 
        $table->longtext('verification_comments')->nullable(); 
        
        // attechment
        $table->longtext('ua_approval_attachment')->nullable();
        $table->longtext('ua_Execution_attachments')->nullable();
        $table->longtext('uar_required_attachment')->nullable();
        $table->longtext('uav_verification_attachment')->nullable(); 
        $table->longtext('impact_assessment_piiqc')->nullable();
        
        //Extras
        $table->text('initiator_group_gi')->nullable();
        $table->text('initiator_group_code_gi')->nullable();
        $table->text('initiated_through_gi')->nullable();
         // ======= addextrafield 11july24 ========
         $table->longtext('oos_observed_on')->nullable();
         $table->longtext('delay_justification')->nullable();
         $table->longtext('oos_reported_date')->nullable();
         $table->longtext('immediate_action')->nullable();
         $table->longtext('oos_details_obvious_error')->nullable();
         
        //====== workflow start stage 9july extra field add ===========
        // ============  stage1 to stage2 ========
        $table->text('completed_by_submit')->nullable();
        $table->text('completed_on_submit')->nullable();
        $table->text('comment_submit')->nullable();
        // ============  stage1 to stage0 ========
        $table->text('cancelled_by')->nullable();
        $table->text('cancelled_on')->nullable();
        $table->text('comment_cancle')->nullable();
        // ========== stage2 to stage3 ========
        $table->text('completed_by_pending_initial_assessment')->nullable();
        $table->text('completed_on_pending_initial_assessment')->nullable();
        $table->text('comment_pending_initial_assessment')->nullable();
        // ============ stage3 to stage4 ========
        $table->text('completed_by_assignable_cause_found')->nullable();
        $table->text('completed_on_assignable_cause_found')->nullable();
        $table->text('comment_assignable_cause_found')->nullable();
        // =========== stage4 to stage13 ===========
        $table->text('completed_by_correction_completed')->nullable();
        $table->text('completed_on_correction_completed')->nullable();
        $table->text('comment_correction_completed')->nullable();
        // stage3 to stage5
        $table->text('completed_by_assignable_cause_not_found')->nullable();
        $table->text('completed_on_assignable_cause_not_found')->nullable();
        $table->text('comment_assignable_cause_not_found')->nullable();
        // stage5 to stage6
        $table->text('completed_by_proposed_hypothesis_experiment')->nullable();
        $table->text('completed_on_proposed_hypothesis_experiment')->nullable();
        $table->text('comment_proposed_hypothesis_experiment')->nullable();
        // stage6 to stage7
        $table->text('completed_by_obvious_error_found')->nullable();
        $table->text('completed_on_obvious_error_found')->nullable();
        $table->text('comment_obvious_error_found')->nullable();
        // stage7 to stage13
        $table->text('completed_by_repeat_analysis_completed')->nullable();
        $table->text('completed_on_repeat_analysis_completed')->nullable();
        $table->text('comment_repeat_analysis_completed')->nullable();
       // stage6 to stage8 
       $table->text('completed_by_no_assignable_cause_found')->nullable();
       $table->text('completed_on_no_assignable_cause_found')->nullable();
       $table->text('comment_no_assignable_cause_found')->nullable();
        // ===========  stage8 to stage9 
       $table->text('completed_by_full_scale_investigation')->nullable();
       $table->text('completed_on_full_scale_investigation')->nullable();
       $table->text('comment_full_scale_investigation')->nullable();
        // ===========  stage9 to stage10
       $table->text('completed_by_assignable_manufacturing_defect')->nullable();
       $table->text('completed_on_assignable_manufacturing_defect')->nullable();
       $table->text('comment_assignable_manufacturing_defect')->nullable();
       //  ===========  stage9 to stage11 =========== 
       $table->text('completed_by_no_assignable_manufacturing_defect')->nullable();
       $table->text('completed_on_no_assignable_manufacturing_defect')->nullable();
       $table->text('comment_no_assignable_manufacturing_defect')->nullable();
       // ===========  stage10 to stage12 =========== 
       $table->text('completed_by_phaseII_correction_complete')->nullable();
       $table->text('completed_on_phaseII_correction_complete')->nullable();
       $table->text('comment_phaseII_correction_complete')->nullable();
       // ============= stage10 to stage13  =========
       $table->text('completed_by_phaseIIA_correction_inconclusive')->nullable();
       $table->text('completed_on_phaseIIA_correction_inconclusive')->nullable();
       $table->text('comment_phaseIIA_correction_inconclusive')->nullable(); 
       // ===========  stage11 to stage12 =========== 
       $table->text('completed_by_retesting_resampling')->nullable();
       $table->text('completed_on_retesting_resampling')->nullable();
       $table->text('comment_retesting_resampling')->nullable();
       // ============= stage11 to stage13  =========
       $table->text('completed_by_phaseIIB_correction_inconclusive')->nullable();
       $table->text('completed_on_phaseIIB_correction_inconclusive')->nullable();
       $table->text('comment_phaseIIB_correction_inconclusive')->nullable(); 
       // =========== stage12 to 13 ===========
       $table->text('completed_by_final_approval')->nullable();
       $table->text('completed_on_final_approval')->nullable();
       $table->text('comment_final_approval')->nullable(); 
       // ===========  stage13 to 14 =========== 
        $table->text('completed_by_approval_completed')->nullable();
        $table->text('completed_on_approval_completed')->nullable();
        $table->text('comment_approval_completed')->nullable();
        // ======== childs ===============
        $table->text('Capachild')->nullable();
        $table->text('actionchild')->nullable();
        $table->text('Rootchild')->nullable();
        $table->timestamps();
    });

    }
    
    public function down()
    {
        Schema::dropIfExists('o_o_s__micros');

    }
};
