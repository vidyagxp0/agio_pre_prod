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
        Schema::create('o_o_s__micros', function (Blueprint $table) {
            $table->id();
            $table->integer('initiator_id_gi')->nullable();
            $table->string('record_number_gi')->nullable();
            $table->string('division_id_gi')->nullable();
            $table->string('initiator_gi')->nullable();
            $table->string('intiation_date_gi')->nullable();
            $table->string('due_date_gi')->nullable();
            $table->string('severity_level_gi')->nullable();
            $table->string('initiator_group_gi')->nullable();
            $table->string('initiator_group_code_gi')->nullable();
            $table->text('initiated_through_gi')->nullable();
            $table->text('if_others_gi')->nullable();
            $table->longText('is_repeat_gi')->nullable();
            $table->longText('repeat_nature_gi')->nullable();
            $table->string('nature_of_change_gi')->nullable();
            $table->string('deviation_occured_on_gi')->nullable();
            $table->longText('description_gi')->nullable();
            $table->longText('initial_attachment_gi')->nullable();
            $table->longText('source_document_type_gi')->nullable();
            $table->longText('reference_system_document_gi')->nullable();
            $table->longText('reference_document_gi')->nullable();
            $table->text('sample_type_gi')->nullable();
            $table->text('product_material_name_gi')->nullable();
            $table->text('market_gi')->nullable();
            $table->text('customer_gi')->nullable();

            // preliminary lab investigation
            $table->longText('Comments_pli')->nullable();
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

            // preliminary lab inv Conclution
            $table->longText('summary_of_prelim_investiga_plic')->nullable();
            $table->string('root_cause_identified_plic')->nullable();
            $table->string('oos_category_root_cause_ident_plic')->nullable();
            $table->longText('oos_category_others_plic')->nullable();
            $table->longText('root_cause_details_plic')->nullable();
            $table->longText('oos_category_root_cause_ident_plic')->nullable();
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
            $table->longtext('attachment_details_cis');

            //checklist investigation of microbial limit bioburden and water test
            $table->longtext('attachment_details_cimlbwt');

            //checklist investigation of microbial assay
            $table->longtext('attachment_details_cima');

            //checklist investigation of environmental monitoring
            $table->longtext('attachment_details_ciem');

            //checklist investigation of media suitability test
            $table->longtext('attachment_details_cimst');

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
            $table->string('qa_approver_ocr');
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
        Schema::dropIfExists('o_o_s__micros');
    }
};
