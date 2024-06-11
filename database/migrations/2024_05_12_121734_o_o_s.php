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
        Schema::create('o_o_s', function (Blueprint $table) {
            $table->id();
            $table->integer('initiator_id')->nullable();
            $table->string('division_id')->nullable();
            $table->string('record_number')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('initiator')->nullable();
            $table->string('initiator_group')->nullable();
            $table->string('initiator_group_code')->nullable();
            $table->string('due_date')->nullable();
            $table->string('severity_level_gi')->nullable();
            $table->text('initiated_through_gi')->nullable();
            $table->text('if_others_gi')->nullable();
            $table->longText('is_repeat_gi')->nullable();
            $table->longText('repeat_nature_gi')->nullable();
            $table->string('nature_of_change_gi')->nullable();
            $table->string('deviation_occured_on_gi')->nullable();
            $table->longText('description_gi')->nullable();
            $table->longText('initial_attachment_gi')->nullable();
            $table->longText('reference_system_document_gi')->nullable();
            $table->longText('source_document_type_gi')->nullable();
            $table->longText('reference_document')->nullable();
            $table->text('sample_type_gi')->nullable();
            $table->text('product_material_name_gi')->nullable();
            $table->text('market_gi')->nullable();
            $table->text('customer_gi')->nullable();
            // preliminary lab investigation
            $table->longText('Comments_plidata')->nullable();
            $table->string('field_alert_required')->nullable();
            $table->longText('field_alert_ref_no_pli')->nullable();
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
            $table->longText('file_attachments_pII')->nullable();

            
            // preliminary lab inv Conclution
            $table->longText('summary_of_prelim_investiga_plic')->nullable();
            $table->string('root_cause_identified_plic')->nullable();
            $table->string('oos_category_root_cause_ident_plic')->nullable();
            $table->longText('oos_category_others_plic')->nullable();
            $table->longText('root_cause_details_plic')->nullable();
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
            // phase ii investigation
             $table->longText('qa_approver_comments_piii')->nullable();
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
             $table->longText('file_attachments_if_any_ooscattach')->nullable();
             
             $table->string('oos_stands_oosc')->nullable();
             $table->string('capa_req_oosc')->nullable();
             $table->longText('capa_ref_no_oosc')->nullable();
             $table->longText('justify_if_capa_not_required_oosc')->nullable();
             $table->string('action_plan_req_oosc')->nullable();
             $table->longText('action_plan_ref_oosc')->nullable();
             $table->longText('justification_for_delay_oosc')->nullable();
             $table->longText('attachments_if_any_oosc')->nullable();
            //  ashish
            $table->longtext('conclusion_review_comments_ocr')->nullable();
            $table->longtext('action_taken_on_affec_batch_ocr')->nullable();
            $table->text('capa_req_ocr')->nullable();
            $table->longtext('capa_refer_ocr')->nullable();
            $table->longtext('req_action_plan_ocr')->nullable();
            $table->text('req_action_task_ocr')->nullable();
            $table->longtext('action_task_reference_ocr')->nullable();
            $table->text('risk_assessment_req_ocr')->nullable();
            $table->longtext('justify_if_no_risk_assessment_ocr')->nullable();
            $table->text('conclusion_attachment_ocr')->nullable();
            $table->text('cq_review_comments_ocqr')->nullable();
            $table->text('capa_required_ocqr')->nullable();
            $table->text('reference_of_capa_ocqr')->nullable();
            $table->longtext('action_plan_requirement_ocqr')->nullable();
            $table->text('ref_action_plan_ocqr')->nullable();
            $table->longtext('cq_attachment_ocqr')->nullable();
            $table->longtext('cq_approver')->nullable();
            $table->text('oos_category_bd')->nullable();
            $table->text('others_bd')->nullable();
            $table->text('material_batch_release_bd')->nullable();
            $table->longtext('other_action_bd')->nullable();
            $table->text('field_alert_reference_bd')->nullable();
            $table->longtext('other_parameters_results_bd')->nullable();
            $table->longtext('trend_of_previous_batches_bd')->nullable();
            $table->longtext('stability_data_bd')->nullable();
            $table->longtext('process_validation_data_bd')->nullable();
            $table->longtext('method_validation_bd')->nullable();
            $table->longtext('any_market_complaints_bd')->nullable();
            $table->longtext('statistical_evaluation_bd')->nullable();
            $table->longtext('risk_analysis_disposition_bd')->nullable();
            $table->longtext('conclusion_bd')->nullable();
            $table->text('phase_inves_required_bd')->nullable();
            $table->longtext('phase_inves_reference_bd')->nullable();
            $table->longtext('justify_for_delay_in_activity_bd')->nullable();
            $table->longtext('disposition_attachment_bd')->nullable();
            $table->longtext('other_action_specify_ro')->nullable();
            $table->longtext('reopen_attachment_ro')->nullable();
            $table->longtext('reopen_approval_comments_uaa')->nullable();
            $table->longtext('addendum_attachment_uaa')->nullable();
            $table->text('execution_comments_uae')->nullable();
            $table->text('action_task_required_uae')->nullable();
            $table->longtext('action_task_reference_no_uae')->nullable();
            $table->text('addi_testing_req_uae')->nullable();
            $table->longtext('Addi_testing_ref_uae')->nullable();
            $table->text('investigation_req_uae')->nullable();
            $table->longtext('investigation_ref_uae')->nullable();
            $table->text('hypo_exp_req_uae')->nullable();
            $table->longtext('hypo_exp_ref_uae')->nullable();
            $table->longtext('addendum_attachments_uae')->nullable();
            $table->longtext('addendum_review_comments_uar')->nullable();
            $table->longtext('required_attachment_uar')->nullable();
            $table->longtext('verification_comments_uav')->nullable();
            $table->longtext('verification_attachment_uar')->nullable();
            
            $table->text('stage')->nullable();
            $table->text('status')->nullable();
            $table->text('date_open')->nullable();
            $table->text('date_close')->nullable();
            $table->text('type')->nullable();
            $table->text('parent_record')->nullable();
            $table->text('Description_Deviation')->nullable();

            // workflow start stage 
            $table->text('cancelled_by')->nullable();
            $table->text('cancelled_on')->nullable();
            $table->text('comment_cancle')->nullable();
            $table->text('completed_by_pending_initial_assessment')->nullable();
            $table->text('completed_on_pending_initial_assessment')->nullable();
            $table->text('comment_pending_initial_assessment')->nullable();
            $table->text('completed_by_under_phaseI_investigation')->nullable();
            $table->text('completed_on_under_phaseI_investigation')->nullable();
            $table->text('comment_under_phaseI_investigation')->nullable();
            $table->text('completed_by_under_phaseIB_investigation')->nullable();
            $table->text('completed_on_under_phaseIB_investigation')->nullable();
            $table->text('comment_under_phaseIB_investigation')->nullable();
            $table->text('completed_by_under_phaseI_correction')->nullable();
            $table->text('completed_on_under_phaseI_correction')->nullable();
            $table->text('comment_under_phaseI_correction')->nullable();
            $table->text('completed_by_under_hypothesis')->nullable();
            $table->text('completed_on_under_hypothesis')->nullable();
            $table->text('comment_under_hypothesis')->nullable();
            $table->text('completed_by_under_repeat_analysis')->nullable();
            $table->text('completed_on_under_repeat_analysis')->nullable();
            $table->text('comment_under_repeat_analysis')->nullable();
            $table->text('completed_by_under_phaseII_investigation')->nullable();
            $table->text('completed_on_under_phaseII_investigation')->nullable();
            $table->text('comment_under_phaseII_investigation')->nullable();
            $table->text('completed_by_under_manufacturing_investigation_phaseIIA')->nullable();
            $table->text('completed_on_under_manufacturing_investigation_phaseIIA')->nullable();
            $table->text('comment_under_manufacturing_investigation_phaseIIA')->nullable();
            $table->text('completed_by_under_phaseIIA_correction')->nullable();
            $table->text('completed_on_under_phaseIIA_correction')->nullable();
            $table->text('comment_under_phaseIIA_correction')->nullable();
            $table->text('completed_by_under_phaseIIB_additional_lab_investigation')->nullable();
            $table->text('completed_on_under_phaseIIB_additional_lab_investigation')->nullable();
            $table->text('comment_under_phaseIIB_additional_lab_investigation')->nullable();
            $table->text('completed_by_under_batch_disposition')->nullable();
            $table->text('completed_on_under_batch_disposition')->nullable();
            $table->text('comment_under_batch_disposition')->nullable();
            $table->text('completed_by_under_phaseIII_investigation')->nullable();
            $table->text('completed_on_under_phaseIII_investigation')->nullable();
            $table->text('comment_under_phaseIII_investigation')->nullable();
            $table->text('completed_by_approval_completed')->nullable();
            $table->text('completed_on_approval_completed')->nullable();
            $table->text('comment_approval_completed')->nullable();
            $table->text('completed_by_close_done')->nullable();
            $table->text('completed_on_close_done')->nullable();
            $table->text('comment_close_done')->nullable();
            $table->softDeletes();
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
        //
    }
};
