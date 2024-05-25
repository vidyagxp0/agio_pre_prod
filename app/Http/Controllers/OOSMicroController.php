<?php

namespace App\Http\Controllers;

use App\Models\OOS_micro;
use App\Models\RoleGroup;
use App\Models\OOS_Micro_audit_trial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RecordNumber;
use App\Models\User;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Helpers;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;


class OOSMicroController extends Controller
{
    public function index()
    {
        return view('frontend.OOS_Micro.oos_micro');
    }

     public function store(Request $request){
        //dd($request->all());

        $micro = new OOS_micro();
        $micro->form_type = "OOS_Micro";
        $micro->record = ((RecordNumber::first()->value('counter')) + 1);
        $micro->initiator_id = Auth::user()->id;
        $micro->division_id = $request->division_id;
        $micro->division_code = $request->division_code;
        $micro->intiation_date = $request->intiation_date;
        $micro->due_date = $request->due_date;
        $micro->severity_level_gi = $request->severity_level_gi;
        $micro->initiator_group_gi = $request->initiator_group_gi;
        $micro->initiator_group_code_gi = $request->initiator_group_code_gi;
        $micro->initiated_through_gi = $request->initiated_through_gi;
        $micro->if_others_gi = $request->if_others_gi;
        $micro->is_repeat_gi = $request->is_repeat_gi;
        $micro->repeat_nature_gi = $request->repeat_nature_gi;
        $micro->nature_of_change_gi = $request->nature_of_change_gi;
        $micro->deviation_occured_on_gi = $request->deviation_occured_on_gi;
        $micro->description_gi = $request->description_gi;
        $micro->status = "Opened";




        if (!empty($request->initial_attachment_gi)) {
            $files = [];
            if ($request->hasfile('initial_attachment_gi')) {
                foreach ($request->file('initial_attachment_gi') as $file) {
                    $name = $request->name . '-initial_attachment_gi' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->initial_attachment_gi = $files;
        }


        $micro->source_document_type_gi = $request->source_document_type_gi;
        $micro->reference_system_document_gi = implode(',', $request->reference_system_document_gi);
        $micro->reference_document_gi = implode(',', $request->reference_document_gi);
        $micro->sample_type_gi = $request->sample_type_gi;
        $micro->product_material_name_gi = $request->product_material_name_gi;
        $micro->market_gi = $request->market_gi;
        $micro->customer_gi = $request->customer_gi;

        // preliminary lab investigation
        $micro->comments_pli = implode(',', $request->comments_pli);
        $micro->field_alert_required_pli = $request->field_alert_required_pli;
        $micro->field_alert_ref_no_pli = implode(',', $request->field_alert_ref_no_pli);
        $micro->justify_if_no_field_alert_pli = implode(',', $request->justify_if_no_field_alert_pli);
        $micro->verification_analysis_required_pli = $request->verification_analysis_required_pli;
        $micro->verification_analysis_ref_pli = implode(',', $request->verification_analysis_ref_pli);
        $micro->analyst_interview_req_pli = $request->analyst_interview_req_pli;
        $micro->analyst_interview_ref_pli = implode(',', $request->analyst_interview_ref_pli);
        $micro->justify_if_no_analyst_int_pli = implode(',', $request->justify_if_no_analyst_int_pli);
        $micro->phase_i_investigation_required_pli = $request->phase_i_investigation_required_pli;
        $micro->phase_i_investigation_pli = $request->phase_i_investigation_pli;
        $micro->phase_i_investigation_ref_pli = implode(',', $request->phase_i_investigation_ref_pli);



        if (!empty($request->file_attachments_pli)) {
            $files = [];
            if ($request->hasfile('file_attachments_pli')) {
                foreach ($request->file('file_attachments_pli') as $file) {
                    $name = $request->name . '-file_attachments_pli' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->file_attachments_pli = $files;
        }
        // preliminary lab inv Conclution
        $micro->summary_of_prelim_investiga_plic = implode(',', $request->summary_of_prelim_investiga_plic);
        $micro->root_cause_identified_plic = $request->root_cause_identified_plic;
        $micro->oos_category_root_cause_ident_plic = $request->oos_category_root_cause_ident_plic;
        $micro->oos_category_others_plic = implode(',', $request->oos_category_others_plic);
        $micro->root_cause_details_plic = implode(',', $request->root_cause_details_plic);
        $micro->oos_category_root_cause_plic = implode(',', $request->oos_category_root_cause_plic);
        $micro->recommended_actions_required_plic = $request->recommended_actions_required_plic;
        $micro->recommended_actions_reference_plic = implode(',', $request->recommended_actions_reference_plic);
        $micro->capa_required_plic = $request->capa_required_plic;
        $micro->reference_capa_no_plic = $request->reference_capa_no_plic;
        $micro->delay_justification_for_pi_plic = implode(',', $request->delay_justification_for_pi_plic);

        if (!empty($request->supporting_attachment_plic)) {
            $files = [];
            if ($request->hasfile('supporting_attachment_plic')) {
                foreach ($request->file('supporting_attachment_plic') as $file) {
                    $name = $request->name . '-supporting_attachment_plic' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->supporting_attachment_plic = $files;
        }
        // preliminary lab invst  Review
        $micro->review_comments_plir = implode(',', $request->review_comments_plir);
        $micro->phase_ii_inv_required_plir = $request->phase_ii_inv_required_plir;

        if (!empty($request->supporting_attachments_plir)) {
            $files = [];
            if ($request->hasfile('supporting_attachments_plir')) {
                foreach ($request->file('supporting_attachments_plir') as $file) {
                    $name = $request->name . '-supporting_attachments_plir' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->supporting_attachments_plir = $files;
        }

        // checklist investigation of bacteria endotoxin test

        if (!empty($request->attachment_details_cibet)) {
            $files = [];
            if ($request->hasfile('attachment_details_cibet')) {
                foreach ($request->file('attachment_details_cibet') as $file) {
                    $name = $request->name . '-attachment_details_cibet' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->attachment_details_cibet = $files;
        }

        //checklist investigation of sterility

        if (!empty($request->attachment_details_cis)) {
            $files = [];
            if ($request->hasfile('attachment_details_cis')) {
                foreach ($request->file('attachment_details_cis') as $file) {
                    $name = $request->name . '-attachment_details_cis' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->attachment_details_cis = $files;
        }

        //checklist investigation of microbial limit bioburden and water test

        if (!empty($request->attachment_details_cimlbwt)) {
            $files = [];
            if ($request->hasfile('attachment_details_cimlbwt')) {
                foreach ($request->file('attachment_details_cimlbwt') as $file) {
                    $name = $request->name . '-attachment_details_cimlbwt' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->attachment_details_cimlbwt = $files;
        }

        //checklist investigation of microbial assay

        if (!empty($request->attachment_details_cima)) {
            $files = [];
            if ($request->hasfile('attachment_details_cima')) {
                foreach ($request->file('attachment_details_cima') as $file) {
                    $name = $request->name . '-attachment_details_cima' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->attachment_details_cima = $files;
        }

        //checklist investigation of environmental monitoring

        if (!empty($request->attachment_details_ciem)) {
            $files = [];
            if ($request->hasfile('attachment_details_ciem')) {
                foreach ($request->file('attachment_details_ciem') as $file) {
                    $name = $request->name . '-attachment_details_ciem' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->attachment_details_ciem = $files;
        }

        //checklist investigation of media suitability test

        if (!empty($request->attachment_details_cimst)) {
            $files = [];
            if ($request->hasfile('attachment_details_cimst')) {
                foreach ($request->file('attachment_details_cimst') as $file) {
                    $name = $request->name . '-attachment_details_cimst' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->attachment_details_cimst = $files;
        }
        // phase ii investigation
        $micro->qa_approver_comments_piii = implode(',', $request->delay_justification_for_pi_plic);
        $micro->manufact_invest_required_piii = $request->manufact_invest_required_piii;
        $micro->manufacturing_invest_type_piii = $request->manufacturing_invest_type_piii;
        $micro->manufacturing_invst_ref_piii = $request->manufacturing_invst_ref_piii;
        $micro->re_sampling_required_piii = $request->re_sampling_required_piii;
        $micro->audit_comments_piii = $request->audit_comments_piii;
        $micro->re_sampling_ref_no_piii = $request->re_sampling_ref_no_piii;
        $micro->hypo_exp_required_piii = $request->hypo_exp_required_piii;
        $micro->hypo_exp_reference_piii = $request->hypo_exp_reference_piii;

        if (!empty($request->attachment_piii)) {
            $files = [];
            if ($request->hasfile('attachment_piii')) {
                foreach ($request->file('attachment_piii') as $file) {
                    $name = $request->name . '-attachment_piii' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->attachment_piii = $files;
        }

        // Phase ii QC Review
        $micro->summary_of_exp_hyp_piiqcr = implode(',', $request->summary_of_exp_hyp_piiqcr);
        $micro->summary_mfg_investigation_piiqcr = implode(',', $request->summary_mfg_investigation_piiqcr);
        $micro->root_casue_identified_piiqcr = $request->root_casue_identified_piiqcr;
        $micro->oos_category_reason_identified_piiqcr = $request->oos_category_reason_identified_piiqcr;
        $micro->others_oos_category_piiqcr = $request->others_oos_category_piiqcr;
        $micro->details_of_root_cause_piiqcr = implode(',', $request->details_of_root_cause_piiqcr);
        $micro->impact_assessment_piiqcr = implode(',', $request->impact_assessment_piiqcr);
        $micro->recommended_action_required_piiqcr = $request->recommended_action_required_piiqcr;
        $micro->recommended_action_reference_piiqcr = $request->recommended_action_reference_piiqcr ;
        $micro->investi_required_piiqcr = $request->investi_required_piiqcr;
        $micro->invest_ref_piiqcr = $request->invest_ref_piiqcr;

        if (!empty($request->attachments_piiqcr)) {
            $files = [];
            if ($request->hasfile('attachments_piiqcr')) {
                foreach ($request->file('attachments_piiqcr') as $file) {
                    $name = $request->name . '-attachments_piiqcr' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->attachments_piiqcr = $files;
        }
        // Additional testing proposal

        $micro->review_comment_atp = $request->review_comment_atp;
        $micro->additional_test_proposal_atp = $request->additional_test_proposal_atp;
        $micro->additional_test_reference_atp = $request->additional_test_reference_atp;
        $micro->any_other_actions_required_atp = $request->any_other_actions_required_atp;
        $micro->action_task_reference_atp = $request->action_task_reference_atp;
        if (!empty($request->additional_testing_attachment_atp)) {
            $files = [];
            if ($request->hasfile('additional_testing_attachment_atp')) {
                foreach ($request->file('additional_testing_attachment_atp') as $file) {
                    $name = $request->name . '-additional_testing_attachment_atp' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->additional_testing_attachment_atp = $files;
        }

        // oos conclusion
        $micro->conclusion_comments_oosc = $request->conclusion_comments_oosc;
        $micro->specification_limit_oosc = $request->specification_limit_oosc;
        $micro->results_to_be_reported_oosc = $request->results_to_be_reported_oosc;
        $micro->final_reportable_results_oosc = $request->final_reportable_results_oosc;
        $micro->justifi_for_averaging_results_oosc = $request->justifi_for_averaging_results_oosc;
        $micro->oos_stands_oosc = $request->oos_stands_oosc;
        $micro->capa_req_oosc = $request->capa_req_oosc;
        $micro->capa_ref_no_oosc = $request->capa_ref_no_oosc;
        $micro->justify_if_capa_not_required_oosc = $request->justify_if_capa_not_required_oosc;
        $micro->action_plan_req_oosc = $request->action_plan_req_oosc;
        $micro->action_plan_ref_oosc = $request->action_plan_ref_oosc;
        $micro->justification_for_delay_oosc = $request->justification_for_delay_oosc;

        if (!empty($request->attachments_if_any_oosc)) {
            $files = [];
            if ($request->hasfile('attachments_if_any_oosc')) {
                foreach ($request->file('attachments_if_any_oosc') as $file) {
                    $name = $request->name . '-attachments_if_any_oosc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->attachments_if_any_oosc = $files;
        }

        //oos conclusion review
        $micro->conclusion_review_comments_ocr = $request->conclusion_review_comments_ocr;
        $micro->action_taken_on_affec_batch_ocr = $request->action_taken_on_affec_batch_ocr;
        $micro->capa_req_ocr = $request->capa_req_ocr;
        $micro->capa_refer_ocr = $request->capa_refer_ocr;
        $micro->required_action_plan_ocr = $request->required_action_plan_ocr;
        $micro->required_action_task_ocr = $request->required_action_task_ocr;
        $micro->action_task_reference_ocr = $request->action_task_reference_ocr;
        $micro->risk_assessment_req_ocr = $request->risk_assessment_req_ocr;
        $micro->risk_assessment_ref_ocr = $request->risk_assessment_ref_ocr;
        $micro->justify_if_no_risk_assessment_ocr = $request->justify_if_no_risk_assessment_ocr;

        if (!empty($request->conclusion_attachment_ocr)) {
            $files = [];
            if ($request->hasfile('conclusion_attachment_ocr')) {
                foreach ($request->file('conclusion_attachment_ocr') as $file) {
                    $name = $request->name . '-conclusion_attachment_ocr' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->conclusion_attachment_ocr = $files;
        }

        $micro->qa_approver_ocr = $request->qa_approver_ocr;
        //OOS CQ Review
        $micro->capa_required_OOS_CQ = $request->capa_required_OOS_CQ;
        $micro->ref_action_plan_OOS_CQ = $request->ref_action_plan_OOS_CQ;
        $micro->reference_of_capa_OOS_CQ = $request->reference_of_capa_OOS_CQ;
        $micro->cq_review_comments_OOS_CQ = $request->cq_review_comments_OOS_CQ;
        $micro->action_plan_requirement_OOS_CQ = $request->action_plan_requirement_OOS_CQ;

        if (!empty($request->cq_attachment_OOS_CQ)) {
            $files = [];
            if ($request->hasfile('cq_attachment_OOS_CQ')) {
                foreach ($request->file('cq_attachment_OOS_CQ') as $file) {
                    $name = $request->name . '-cq_attachment_OOS_CQ' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->cq_attachment_OOS_CQ = $files;
        }

        //Batch Disposition
        $micro->oos_category_BI = $request->oos_category_BI;
        $micro->others_BI = $request->others_BI;
        $micro->material_batch_release_BI = $request->material_batch_release_BI;
        $micro->other_action_BI = $request->other_action_BI;
        $micro->field_alert_reference_BI = $request->field_alert_reference_BI;
        $micro->other_parameter_result_BI = $request->other_parameter_result_BI;
        $micro->trend_of_previous_batches_BI = $request->trend_of_previous_batches_BI;
        $micro->stability_data_BI = $request->stability_data_BI;
        $micro->process_validation_data_BI = $request->process_validation_data_BI;
        $micro->method_validation_BI = $request->method_validation_BI;
        $micro->any_market_complaints_BI = $request->any_market_complaints_BI;
        $micro->statistical_evaluation_BI = $request->statistical_evaluation_BI;
        $micro->risk_analysis_for_disposition_BI = $request->risk_analysis_for_disposition_BI;
        $micro->conclusion_BI = $request->conclusion_BI;
        $micro->phase_III_inves_required_BI = $request->phase_III_inves_required_BI;
        $micro->phase_III_inves_reference_BI = $request->phase_III_inves_reference_BI;
        $micro->justify_for_delay_BI = $request->justify_for_delay_BI;

        if (!empty($request->disposition_attachment_BI)) {
            $files = [];
            if ($request->hasfile('disposition_attachment_BI')) {
                foreach ($request->file('disposition_attachment_BI') as $file) {
                    $name = $request->name . '-disposition_attachment_BI' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->disposition_attachment_BI = $files;
        }

        //re open
        $micro->reopen_request = $request->reopen_request;

        if (!empty($request->reopen_attachment)) {
            $files = [];
            if ($request->hasfile('reopen_attachment')) {
                foreach ($request->file('reopen_attachment') as $file) {
                    $name = $request->name . '-reopen_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $micro->reopen_attachment = $files;
        }
        $micro->save();
        //dd($micro);

            ////////Audit Trail///////////////////////

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();

        // dd($micro->status);
        if(!empty($micro->division_code)){
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Division Code';
            $history->previous = "Null";
            $history->current = $micro->division_code;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        }

        // if (!empty($micro->division_id)) {
        //     $history = new OOS_Micro_audit_trial();
        //     $history->OOS_micro_id = $micro->id;
        //     $history->activity_type = 'Division Id';
        //     $history->previous = "Null";
        //     $history->current = $micro->division_id;
        //     $history->comment = "NA";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $micro->status;
        //     $history->save();
        // }


        if (!empty($micro->intiation_date)) {
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = "Null";
            $history->current = $micro->intiation_date;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }

        if (!empty($micro->initiator_group_gi)) {
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Initiator Group';
            $history->previous = "Null";
            $history->current = $micro->initiator_group_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }

        if(!empty($micro->initiator_group_code_gi)){
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Initiator Group Code';
            $history->previous = "Null";
            $history->current = $micro->initiator_group_code_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        }

        if(!empty($micro->initiated_through_gi)){
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Initiated Through ?';
            $history->previous = "Null";
            $history->current = $micro->initiated_through_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        }

        if(!empty($micro->is_repeat_gi)){
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Is Repeat ?';
            $history->previous = "Null";
            $history->current = $micro->is_repeat_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        } if(!empty($micro->repeat_nature_gi)){
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = "Null";
            $history->current = $micro->repeat_nature_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        } if(!empty($micro->nature_of_change_gi)){
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Nature of Change';
            $history->previous = "Null";
            $history->current = $micro->nature_of_change_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        } if(!empty($micro->deviation_occured_on_gi)){
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Deviation Occured On';
            $history->previous = "Null";
            $history->current = $micro->deviation_occured_on_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        }
        if (!empty($micro->description_gi)) {
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Description';
            $history->previous = "Null";
            $history->current = $micro->description_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }

        if (!empty($micro->source_document_type_gi)) {
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Source Document Type';
            $history->previous = "Null";
            $history->current = $micro->source_document_type_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }

        if (!empty($micro->reference_system_document_gi)) {
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Reference System Document';
            $history->previous = "Null";
            $history->current = $micro->reference_system_document_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }
        if (!empty($micro->reference_document_gi)) {
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Reference Document';
            $history->previous = "Null";
            $history->current = $micro->reference_document_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }
        if (!empty($micro->sample_type_gi)) {
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type ='Sample Type';
            $history->previous = "Null";
            $history->current = $micro->sample_type_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }
        if (!empty($micro->product_material_name_gi)) {
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Product/Material Name';
            $history->previous = "Null";
            $history->current = $micro->product_material_name_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }
        if (!empty($micro->market_gi)) {
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Market';
            $history->previous = "Null";
            $history->current = $micro->market_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }


        if (!empty($micro->due_date)) {
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current = $micro->due_date;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }

        if(!empty($micro->severity_level_gi)){
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Severity Level';
            $history->previous = "Null";
            $history->current = $micro->severity_level_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        }

        if (!empty($micro->customer_gi)) {
            $history = new OOS_Micro_audit_trial();
            $history->OOS_micro_id = $micro->id;
            $history->activity_type = 'Customer';
            $history->previous = "Null";
            $history->current = $micro->customer_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }


        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
     }

       public function edit($id){

            $micro_data = OOS_micro::find($id);
            // dd($micro_data);
            return view('frontend.OOS_Micro.oos_micro_view',compact('micro_data'));
       }
        public function update(Request $request, $id){

            $lastDocument = OOS_micro::find($id);
            $micro = OOS_micro::find($id);
            $micro->form_type = "OOS_Micro";
            $micro->record = ((RecordNumber::first()->value('counter')) + 1);
            $micro->initiator_id = Auth::user()->id;
            $micro->division_id = $request->division_id;
            $micro->division_code = $request->division_code;
            $micro->intiation_date = $request->intiation_date;
            $micro->due_date = $request->due_date;
            $micro->severity_level_gi = $request->severity_level_gi;
            $micro->initiator_group_gi = $request->initiator_group_gi;
            $micro->initiator_group_code_gi = $request->initiator_group_code_gi;
            $micro->initiated_through_gi = $request->initiated_through_gi;
            $micro->if_others_gi = $request->if_others_gi;
            $micro->is_repeat_gi = $request->is_repeat_gi;
            $micro->repeat_nature_gi = $request->repeat_nature_gi;
            $micro->nature_of_change_gi = $request->nature_of_change_gi;
            $micro->deviation_occured_on_gi = $request->deviation_occured_on_gi;
            $micro->description_gi = $request->description_gi;

            if (!empty($request->initial_attachment_gi)) {
                $files = [];
                if ($request->hasfile('initial_attachment_gi')) {
                    foreach ($request->file('initial_attachment_gi') as $file) {
                        $name = $request->name . '-initial_attachment_gi' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->initial_attachment_gi = $files;
            }


            $micro->source_document_type_gi = $request->source_document_type_gi;
            $micro->reference_system_document_gi = implode(',', $request->reference_system_document_gi);
            $micro->reference_document_gi = implode(',', $request->reference_document_gi);
            $micro->sample_type_gi = $request->sample_type_gi;
            $micro->product_material_name_gi = $request->product_material_name_gi;
            $micro->market_gi = $request->market_gi;
            $micro->customer_gi = $request->customer_gi;

             // preliminary lab investigation
            $micro->comments_pli = implode(',', $request->comments_pli);
            $micro->field_alert_required_pli = $request->field_alert_required_pli;
            $micro->field_alert_ref_no_pli = implode(',', $request->field_alert_ref_no_pli);
            $micro->justify_if_no_field_alert_pli = implode(',', $request->justify_if_no_field_alert_pli);
            $micro->verification_analysis_required_pli = $request->verification_analysis_required_pli;
            $micro->verification_analysis_ref_pli = implode(',', $request->verification_analysis_ref_pli);
            $micro->analyst_interview_req_pli = $request->analyst_interview_req_pli;
            $micro->analyst_interview_ref_pli = implode(',', $request->analyst_interview_ref_pli);
            $micro->justify_if_no_analyst_int_pli = implode(',', $request->justify_if_no_analyst_int_pli);
            $micro->phase_i_investigation_required_pli = $request->phase_i_investigation_required_pli;
            $micro->phase_i_investigation_pli = $request->phase_i_investigation_pli;
            $micro->phase_i_investigation_ref_pli = implode(',', $request->phase_i_investigation_ref_pli);



            if (!empty($request->file_attachments_pli)) {
                $files = [];
                if ($request->hasfile('file_attachments_pli')) {
                    foreach ($request->file('file_attachments_pli') as $file) {
                        $name = $request->name . '-file_attachments_pli' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->file_attachments_pli = $files;
            }
            // preliminary lab inv Conclution
            $micro->summary_of_prelim_investiga_plic = implode(',', $request->summary_of_prelim_investiga_plic);
            $micro->root_cause_identified_plic = $request->root_cause_identified_plic;
            $micro->oos_category_root_cause_ident_plic = $request->oos_category_root_cause_ident_plic;
            $micro->oos_category_others_plic = implode(',', $request->oos_category_others_plic);
            $micro->root_cause_details_plic = implode(',', $request->root_cause_details_plic);
            $micro->oos_category_root_cause_plic = implode(',', $request->oos_category_root_cause_plic);
            $micro->recommended_actions_required_plic = $request->recommended_actions_required_plic;
            $micro->recommended_actions_reference_plic = implode(',', $request->recommended_actions_reference_plic);
            $micro->capa_required_plic = $request->capa_required_plic;
            $micro->reference_capa_no_plic = $request->reference_capa_no_plic;
            $micro->delay_justification_for_pi_plic = implode(',', $request->delay_justification_for_pi_plic);

            if (!empty($request->supporting_attachment_plic)) {
                $files = [];
                if ($request->hasfile('supporting_attachment_plic')) {
                    foreach ($request->file('supporting_attachment_plic') as $file) {
                        $name = $request->name . '-supporting_attachment_plic' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->supporting_attachment_plic = $files;
            }

             // preliminary lab invst  Review
            $micro->review_comments_plir = implode(',', $request->review_comments_plir);
            $micro->phase_ii_inv_required_plir = $request->phase_ii_inv_required_plir;

            if (!empty($request->supporting_attachments_plir)) {
                $files = [];
                if ($request->hasfile('supporting_attachments_plir')) {
                    foreach ($request->file('supporting_attachments_plir') as $file) {
                        $name = $request->name . '-supporting_attachments_plir' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->supporting_attachments_plir = $files;
            }

            // checklist investigation of bacteria endotoxin test

            if (!empty($request->attachment_details_cibet)) {
                $files = [];
                if ($request->hasfile('attachment_details_cibet')) {
                    foreach ($request->file('attachment_details_cibet') as $file) {
                        $name = $request->name . '-attachment_details_cibet' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->attachment_details_cibet = $files;
            }
            //checklist investigation of sterility

            if (!empty($request->attachment_details_cis)) {
                $files = [];
                if ($request->hasfile('attachment_details_cis')) {
                    foreach ($request->file('attachment_details_cis') as $file) {
                        $name = $request->name . '-attachment_details_cis' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->attachment_details_cis = $files;
            }

            //checklist investigation of microbial limit bioburden and water test

            if (!empty($request->attachment_details_cimlbwt)) {
                $files = [];
                if ($request->hasfile('attachment_details_cimlbwt')) {
                    foreach ($request->file('attachment_details_cimlbwt') as $file) {
                        $name = $request->name . '-attachment_details_cimlbwt' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->attachment_details_cimlbwt = $files;
            }

            //checklist investigation of microbial assay

            if (!empty($request->attachment_details_cima)) {
                $files = [];
                if ($request->hasfile('attachment_details_cima')) {
                    foreach ($request->file('attachment_details_cima') as $file) {
                        $name = $request->name . '-attachment_details_cima' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->attachment_details_cima = $files;
            }

            //checklist investigation of environmental monitoring

            if (!empty($request->attachment_details_ciem)) {
                $files = [];
                if ($request->hasfile('attachment_details_ciem')) {
                    foreach ($request->file('attachment_details_ciem') as $file) {
                        $name = $request->name . '-attachment_details_ciem' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->attachment_details_ciem = $files;
            }

            //checklist investigation of media suitability test

            if (!empty($request->attachment_details_cimst)) {
                $files = [];
                if ($request->hasfile('attachment_details_cimst')) {
                    foreach ($request->file('attachment_details_cimst') as $file) {
                        $name = $request->name . '-attachment_details_cimst' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->attachment_details_cimst = $files;
            }
            // phase ii investigation
            $micro->qa_approver_comments_piii = implode(',', $request->delay_justification_for_pi_plic);
            $micro->manufact_invest_required_piii = $request->manufact_invest_required_piii;
            $micro->manufacturing_invest_type_piii = $request->manufacturing_invest_type_piii;
            $micro->manufacturing_invst_ref_piii = $request->manufacturing_invst_ref_piii;
            $micro->re_sampling_required_piii = $request->re_sampling_required_piii;
            $micro->audit_comments_piii = $request->audit_comments_piii;
            $micro->re_sampling_ref_no_piii = $request->re_sampling_ref_no_piii;
            $micro->hypo_exp_required_piii = $request->hypo_exp_required_piii;
            $micro->hypo_exp_reference_piii = $request->hypo_exp_reference_piii;

            if (!empty($request->attachment_piii)) {
                $files = [];
                if ($request->hasfile('attachment_piii')) {
                    foreach ($request->file('attachment_piii') as $file) {
                        $name = $request->name . '-attachment_piii' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->attachment_piii = $files;
            }
            // Phase ii QC Review
            $micro->summary_of_exp_hyp_piiqcr = implode(',', $request->summary_of_exp_hyp_piiqcr);
            $micro->summary_mfg_investigation_piiqcr = implode(',', $request->summary_mfg_investigation_piiqcr);
            $micro->root_casue_identified_piiqcr = $request->root_casue_identified_piiqcr;
            $micro->oos_category_reason_identified_piiqcr = $request->oos_category_reason_identified_piiqcr;
            $micro->others_oos_category_piiqcr = $request->others_oos_category_piiqcr;
            $micro->details_of_root_cause_piiqcr = implode(',', $request->details_of_root_cause_piiqcr);
            $micro->impact_assessment_piiqcr = $request->impact_assessment_piiqcr;
            $micro->recommended_action_required_piiqcr = $request->recommended_action_required_piiqcr;
            $micro->recommended_action_reference_piiqcr = $request->recommended_action_reference_piiqcr;
            $micro->investi_required_piiqcr = $request->investi_required_piiqcr;
            $micro->invest_ref_piiqcr = $request->invest_ref_piiqcr;

            if (!empty($request->attachments_piiqcr)) {
                $files = [];
                if ($request->hasfile('attachments_piiqcr')) {
                    foreach ($request->file('attachments_piiqcr') as $file) {
                        $name = $request->name . '-attachments_piiqcr' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->attachments_piiqcr = $files;
            }
            // Additional testing proposal

            $micro->review_comment_atp = $request->review_comment_atp;
            $micro->additional_test_proposal_atp = $request->additional_test_proposal_atp;
            $micro->additional_test_reference_atp = $request->additional_test_reference_atp;
            $micro->any_other_actions_required_atp = $request->any_other_actions_required_atp;
            $micro->action_task_reference_atp = $request->action_task_reference_atp;

            if (!empty($request->additional_testing_attachment_atp)) {
                $files = [];
                if ($request->hasfile('additional_testing_attachment_atp')) {
                    foreach ($request->file('additional_testing_attachment_atp') as $file) {
                        $name = $request->name . '-additional_testing_attachment_atp' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->additional_testing_attachment_atp = $files;
            }

            // oos conclusion
            $micro->conclusion_comments_oosc = $request->conclusion_comments_oosc;
            $micro->specification_limit_oosc = $request->specification_limit_oosc;
            $micro->results_to_be_reported_oosc = $request->results_to_be_reported_oosc;
            $micro->final_reportable_results_oosc = $request->final_reportable_results_oosc;
            $micro->justifi_for_averaging_results_oosc = $request->justifi_for_averaging_results_oosc;
            $micro->oos_stands_oosc = $request->oos_stands_oosc;
            $micro->capa_req_oosc = $request->capa_req_oosc;
            $micro->capa_ref_no_oosc = $request->capa_ref_no_oosc;
            $micro->justify_if_capa_not_required_oosc = $request->justify_if_capa_not_required_oosc;
            $micro->action_plan_req_oosc = $request->action_plan_req_oosc;
            $micro->action_plan_ref_oosc = $request->action_plan_ref_oosc;
            $micro->justification_for_delay_oosc = $request->justification_for_delay_oosc;

            if (!empty($request->attachments_if_any_oosc)) {
                $files = [];
                if ($request->hasfile('attachments_if_any_oosc')) {
                    foreach ($request->file('attachments_if_any_oosc') as $file) {
                        $name = $request->name . '-attachments_if_any_oosc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->attachments_if_any_oosc = $files;
            }

            //oos conclusion review
            $micro->conclusion_review_comments_ocr = $request->conclusion_review_comments_ocr;
            $micro->action_taken_on_affec_batch_ocr = $request->action_taken_on_affec_batch_ocr;
            $micro->capa_req_ocr = $request->capa_req_ocr;
            $micro->capa_refer_ocr = $request->capa_refer_ocr;
            $micro->required_action_plan_ocr = $request->required_action_plan_ocr;
            $micro->required_action_task_ocr = $request->required_action_task_ocr;
            $micro->action_task_reference_ocr = $request->action_task_reference_ocr;
            $micro->risk_assessment_req_ocr = $request->risk_assessment_req_ocr;
            $micro->risk_assessment_ref_ocr = $request->risk_assessment_ref_ocr;
            $micro->justify_if_no_risk_assessment_ocr = $request->justify_if_no_risk_assessment_ocr;

            if (!empty($request->conclusion_attachment_ocr)) {
                $files = [];
                if ($request->hasfile('conclusion_attachment_ocr')) {
                    foreach ($request->file('conclusion_attachment_ocr') as $file) {
                        $name = $request->name . '-conclusion_attachment_ocr' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->conclusion_attachment_ocr = $files;
            }

            $micro->qa_approver_ocr = $request->qa_approver_ocr;

            //OOS CQ Review
            $micro->capa_required_OOS_CQ = $request->capa_required_OOS_CQ;
            $micro->ref_action_plan_OOS_CQ = $request->ref_action_plan_OOS_CQ;
            $micro->reference_of_capa_OOS_CQ = $request->reference_of_capa_OOS_CQ;
            $micro->cq_review_comments_OOS_CQ = $request->cq_review_comments_OOS_CQ;
            $micro->action_plan_requirement_OOS_CQ = $request->action_plan_requirement_OOS_CQ;

            if (!empty($request->cq_attachment_OOS_CQ)) {
                $files = [];
                if ($request->hasfile('cq_attachment_OOS_CQ')) {
                    foreach ($request->file('cq_attachment_OOS_CQ') as $file) {
                        $name = $request->name . '-cq_attachment_OOS_CQ' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->cq_attachment_OOS_CQ = $files;
            }

            //Batch Disposition
            $micro->oos_category_BI = $request->oos_category_BI;
            $micro->others_BI = $request->others_BI;
            $micro->material_batch_release_BI = $request->material_batch_release_BI;
            $micro->other_action_BI = $request->other_action_BI;
            $micro->field_alert_reference_BI = $request->field_alert_reference_BI;
            $micro->other_parameter_result_BI = $request->other_parameter_result_BI;
            $micro->trend_of_previous_batches_BI = $request->trend_of_previous_batches_BI;
            $micro->stability_data_BI = $request->stability_data_BI;
            $micro->process_validation_data_BI = $request->process_validation_data_BI;
            $micro->method_validation_BI = $request->method_validation_BI;
            $micro->any_market_complaints_BI = $request->any_market_complaints_BI;
            $micro->statistical_evaluation_BI = $request->statistical_evaluation_BI;
            $micro->risk_analysis_for_disposition_BI = $request->risk_analysis_for_disposition_BI;
            $micro->conclusion_BI = $request->conclusion_BI;
            $micro->phase_III_inves_required_BI = $request->phase_III_inves_required_BI;
            $micro->phase_III_inves_reference_BI = $request->phase_III_inves_reference_BI;
            $micro->justify_for_delay_BI = $request->justify_for_delay_BI;

            if (!empty($request->disposition_attachment_BI)) {
                $files = [];
                if ($request->hasfile('disposition_attachment_BI')) {
                    foreach ($request->file('disposition_attachment_BI') as $file) {
                        $name = $request->name . '-disposition_attachment_BI' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->disposition_attachment_BI = $files;
            }

            //re open
            $micro->reopen_request = $request->reopen_request;

            if (!empty($request->reopen_attachment)) {
                $files = [];
                if ($request->hasfile('reopen_attachment')) {
                    foreach ($request->file('reopen_attachment') as $file) {
                        $name = $request->name . '-reopen_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $micro->reopen_attachment = $files;
            }
                $micro->save();
                $micro->update();

                toastr()->success("Record is updated Successfully");
                return redirect(url('rcms/qms-dashboard'));

////////////---------------Audit Trail Update-------------------------------/////////////////


           if($lastDocument->division_code != $micro->division_code || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Division Code';
            $history->previous = $lastDocument->division_code;
            $history->current = $micro->division_code;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if($lastDocument->intiation_date != $micro->intiation_date || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Initiation Date';
            $history->previous = $lastDocument->intiation_date;
            $history->current = $micro->intiation_date;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
         if($lastDocument->due_date != $micro->due_date || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Due Date';
            $history->previous = $lastDocument->due_date;
            $history->current = $micro->due_date;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
         if($lastDocument->severity_level_gi != $micro->severity_level_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Severity Level';
            $history->previous = $lastDocument->severity_level_gi;
            $history->current = $micro->severity_level_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->initiator_group_gi != $micro->initiator_group_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Initiator Group';
            $history->previous = $lastDocument->initiator_group_gi;
            $history->current = $micro->initiator_group_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
         if($lastDocument->initiator_group_code_gi != $micro->initiator_group_code_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Initiator Group Code';
            $history->previous = $lastDocument->initiator_group_code_gi;
            $history->current = $micro->initiator_group_code_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->initiated_through_gi != $micro->initiated_through_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Initiated Through';
            $history->previous = $lastDocument->initiated_through_gi;
            $history->current = $micro->initiated_through_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->if_others_gi != $micro->if_others_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'If Others';
            $history->previous = $lastDocument->if_others_gi;
            $history->current = $micro->if_others_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->is_repeat_gi != $micro->is_repeat_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Is Repeat ?';
            $history->previous = $lastDocument->is_repeat_gi;
            $history->current = $micro->is_repeat_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->repeat_nature_gi != $micro->repeat_nature_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = $lastDocument->repeat_nature_gi;
            $history->current = $micro->repeat_nature_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->nature_of_change_gi != $micro->nature_of_change_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Nature of Change';
            $history->previous = $lastDocument->nature_of_change_gi;
            $history->current = $micro->nature_of_change_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
         if($lastDocument->deviation_occured_on_gi != $micro->deviation_occured_on_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Deviation Occured On';
            $history->previous = $lastDocument->deviation_occured_on_gi;
            $history->current = $micro->deviation_occured_on_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        // $array = [
        //     "description_gi" => "Description"
        // ];

        // foreach ($array as $index => $val) {
        //     $request
        // }
        if($lastDocument->description_gi != $micro->description_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Description';
            $history->previous = $lastDocument->description_gi;
            $history->current = $micro->description_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
         if($lastDocument->source_document_type_gi != $micro->source_document_type_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Source Document Type';
            $history->previous = $lastDocument->source_document_type_gi;
            $history->current = $micro->source_document_type_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->reference_document_gi != $micro->reference_document_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Reference Document';
            $history->previous = $lastDocument->reference_document_gi;
            $history->current = $micro->reference_document_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if($lastDocument->sample_type_gi != $micro->sample_type_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Sample Type';
            $history->previous = $lastDocument->sample_type_gi;
            $history->current = $micro->sample_type_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->product_material_name_gi != $micro->product_material_name_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Product/Material Name';
            $history->previous = $lastDocument->product_material_name_gi;
            $history->current = $micro->product_material_name_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->market_gi != $micro->market_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Market';
            $history->previous = $lastDocument->market_gi;
            $history->current = $micro->market_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->customer_gi != $micro->customer_gi || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Customer';
            $history->previous = $lastDocument->customer_gi;
            $history->current = $micro->customer_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
 //  Preliminary Lab Investigation

 $Preliminary_Lab_Investigation = [
    'comments_pli' => 'Comments',
    'field_alert_required_pli' => 'Field Alert Required',
    'field_alert_ref_no_pli' => 'Field Alert Ref.No.',
    'justify_if_no_field_alert_pli' => 'Justify if no Field Alert',
    'verification_analysis_required_pli' => 'Verification Analysis Required',
    'verification_analysis_ref_pli' => 'Verification Analysis Ref.',
    'analyst_interview_req_pli' => 'Analyst Interview Req.',
    'analyst_interview_ref_pli' => 'Analyst Interview Ref.',
    'justify_if_no_analyst_int_pli' => 'Justify if no Analyst Int.',
    'phase_i_investigation_required_pli' => 'Phase I Investigation Required',
    'phase_i_investigation_pli' => 'Phase I Investigation ',
    'phase_i_investigation_ref_pli' => 'Phase I Investigation Ref.',
];
    foreach ($Preliminary_Lab_Investigation as $key => $value){

         if($lastDocument->$key != $micro->$key || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = $value;
            $history->previous = $lastDocument->$key;
            $history->current = $micro->$key;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
    }

//Preliminary lab investigation conclusion
$Preliminary_Lab_Investigation_Conclusion = [
    'summary_of_prelim_investiga_plic' => 'Summary of Prelim.Investigation',
    'root_cause_identified_plic' => 'Root Cause Identified',
    'oos_category_root_cause_ident_plic' => 'OOS Category-Root Cause Ident.',
    'oos_category_others_plic' => 'OOS Category(Others)',
    'root_cause_details_plic' => 'Root Cause Details',
    'oos_category_root_cause_plic' => 'OOS Category-Root Cause Ident.',
    'recommended_actions_required_plic' => 'Recommended Actions Required?',
    'recommended_actions_reference_plic' => 'Recommended Actions Reference',
    'capa_required_plic' => 'CAPA Required',
    'reference_capa_no_plic' => 'Reference CAPA No.',
    'delay_justification_for_pi_plic' => 'Delay Justification for P.I.',
];
    foreach($Preliminary_Lab_Investigation_Conclusion as $key => $value){
        if($lastDocument->$key != $micro->$key || !empty($request->comment)){
            $history =  new OOS_Micro_audit_trial();
            $history->OOS_micro_id =$id;
            $history->activity_type = $value;
            $history->previous = $lastDocument->$key;
            $history->current = $micro->$key;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
    }

//Preliminary lab invst review

$Preliminary_lab_invst_review = [
    'review_comments_plir' => 'Review Comments',
    'phase_ii_inv_required_plir' => 'Phase II Inv. Required?',
];

foreach($Preliminary_lab_invst_review as $key => $value){
    if($lastDocument->$key != $micro->$key || !empty($request->comment)){
        $history =  new OOS_Micro_audit_trial();
        $history->OOS_micro_id =$id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current = $micro->$key;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->save();
    }
}

//Phase II Investigation
$Phase_II_Investigation = [
    'qa_approver_comments_piii' => 'QA Approver Comments',
    'manufact_invest_required_piii' => 'Manufact. Invest. Required?',
    'manufacturing_invest_type_piii' => 'Manufacturing Invest. Type',
    'manufacturing_invst_ref_piii' => 'Manufacturing Invst. Ref.',
    're_sampling_required_piii' => 'Re-sampling Required?',
    'audit_comments_piii' => 'Audit Comments',
    're_sampling_ref_no_piii' => 'Re-sampling Ref. No.',
    'hypo_exp_required_piii' => 'Hypo/Exp.Required',
    'hypo_exp_reference_piii' => 'Hypo/Exp. Reference',
];

foreach($Phase_II_Investigation as $key => $value ){
    if($lastDocument->$key != $micro->$key || !empty($request->comment)){
        $history =  new OOS_Micro_audit_trial();
        $history->OOS_micro_id =$id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current = $micro->$key;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->save();
    }
}

//Phase II QC REview

$Phase_II_QC_Review = [
    'summary_of_exp_hyp_piiqcr' => 'Summary of Exp./Hyp.',
    'summary_mfg_investigation_piiqcr' => 'Summary Mfg.Investigation',
    'root_casue_identified_piiqcr' => 'Root Cause Identified',
    'oos_category_reason_identified_piiqcr' => 'OOS Category-Reason Identified',
    'others_oos_category_piiqcr' => 'Others (OOS category)',
    'details_of_root_cause_piiqcr' => 'Details of Root Cause',
    'impact_assessment_piiqcr' =>'Impact Assessment',
    'recommended_action_required_piiqcr' => 'Recommended Action Required?',
    'recommended_action_reference_piiqcr' => 'Recommended Action Reference',
    'investi_required_piiqcr' => 'Invest.Required',
    'invest_ref_piiqcr' => 'Invest ref.',
];

foreach($Phase_II_QC_Review as $key => $value){

    if($lastDocument->$key != $micro->$key || !empty($request->comment)){
        $history =  new OOS_Micro_audit_trial();
        $history->OOS_micro_id =$id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current = $micro->$key;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->save();
    }
}

// Additional testing Proposal

$Additional_Testing_Proposal = [
    'review_comment_atp' => 'Review Comment',
    'additional_test_proposal_atp' => 'Additional Test Proposal',
    'additional_test_reference_atp' => 'Additional Test Reference',
    'any_other_actions_required_atp' => 'Any Other Actions Required',
    'action_task_reference_atp' => 'Action Task Reference',
];
foreach($Additional_Testing_Proposal as $key => $value){

    if($lastDocument->$key != $micro->$key || !empty($request->comment)){
        $history =  new OOS_Micro_audit_trial();
        $history->OOS_micro_id =$id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current = $micro->$key;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->save();
    }
}

$OOS_Conclusion = [
    "conclusion_comments_oosc" => 'Conclusion Comments',
    "specification_limit_oosc" => 'Specification Limit',
    "results_to_be_reported_oosc" => 'Results to be Reported',
    "final_reportable_results_oosc" => 'Final Reportable Results',
    "justifi_for_averaging_results_oosc" => 'Justifi. for Averaging Results',
    "oos_stands_oosc" => 'OOS Stands',
    "capa_req_oosc" => 'CAPA Req.',
    "capa_ref_no_oosc" => 'CAPA Ref No.',
    "justify_if_capa_not_required_oosc" => 'Justify if CAPA not required',
    "action_plan_req_oosc" => 'Action Plan Req.',
    "action_plan_ref_oosc" => 'Action Plan Ref.',
    "justification_for_delay_oosc" => 'Justification for Delay',
];

foreach($OOS_Conclusion as $key => $value){
    if($lastDocument->$key != $micro->$key || !empty($request->comment)){
        $history =  new OOS_Micro_audit_trial();
        $history->OOS_micro_id =$id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current = $micro->$key;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->save();
    }
}

//OOS_Conclusion_Review

$OOS_Conclusion_Review = [
    "conclusion_review_comments_ocr" => 'Conclusion Review Comments',
    "action_taken_on_affec_batch_ocr" => 'Action Taken on Affec.batch',
    "capa_req_ocr" => 'CAPA Req.?',
    "capa_refer_ocr" => 'CAPA Refer.',
    "required_action_plan_ocr" => 'Required Action Plan?',
    "required_action_task_ocr" => 'Required Action Task?',
    "action_task_reference_ocr" => 'Action Task Reference',
    "risk_assessment_req_ocr" => 'Risk Assessment Req?',
    "risk_assessment_ref_ocr" => 'Risk Assessment Ref.',
    "justify_if_no_risk_assessment_ocr" => 'Justify if no risk Assessment',
    "qa_approver_ocr" => 'CQ Approver',
];
foreach($OOS_Conclusion_Review as $key => $value){

    if($lastDocument->$key != $micro->$key || !empty($request->comment)){
        $history =  new OOS_Micro_audit_trial();
        $history->OOS_micro_id =$id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current = $micro->$key;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->save();
    }
}
//OOS CQ Review

$OOS_CQ_Review = [
    "capa_required_OOS_CQ" => 'CAPA required?',
    "ref_action_plan_OOS_CQ" => 'Ref Action Plan',
    "reference_of_capa_OOS_CQ" => 'Reference of CAPA',
    "cq_review_comments_OOS_CQ" => 'CQ Review Comments',
    "action_plan_requirement_OOS_CQ" => 'Action plan requirement?',
];
foreach($OOS_CQ_Review as $key => $value){

    if($lastDocument->$key != $micro->$key || !empty($request->comment)){
        $history =  new OOS_Micro_audit_trial();
        $history->OOS_micro_id =$id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current = $micro->$key;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->save();
    }
}
//  Batch Disposition
        $batchDisposition = [
            'others_BI' => 'Others',
            'oos_category_BI' => 'OOS Category',
            'material_batch_release_BI' => 'Material/Batch Release',
            'other_action_BI' => 'Other Action (Specify)',
            'field_alert_reference_BI' => 'Field Alert Reference',
            'other_parameter_result_BI' => 'Other Parameters Results',
            'trend_of_previous_batches_BI' => 'Trend of Previous Batches',
            'stability_data_BI' => 'Stability Data',
            'process_validation_data_BI' => 'Process Validation Data',
            'method_validation_BI' => 'Method Validation',
            'any_market_complaints_BI' => 'Any Market Complaints',
            'statistical_evaluation_BI' => 'Statistical Evaluation',
            'risk_analysis_for_disposition_BI' => 'Risk Analysis for Disposition',
            'conclusion_BI' => 'Conclusion',
            'phase_III_inves_required_BI' => 'Phase-III Inves.Required?',
            'phase_III_inves_reference_BI' => 'Phase-III Inves.Reference',
            'justify_for_delay_BI' => 'Justify for Delay in Activity',
            'reopen_request'=> 'Other Action (Specify)',
        ];

        foreach ($batchDisposition as $key => $value) {

            if($lastDocument->$key != $micro->$key || !empty($request->comment)){
                $history =  new OOS_Micro_audit_trial();
                $history->OOS_micro_id =$id;
                $history->activity_type = $value;
                $history->previous = $lastDocument->$key;
                $history->current = $micro->$key;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
        }
            }


    public function auditReport($id)
    {
        $doc = OOS_micro::find($id);
        if (!empty($doc)) {
            // $data->Product_Details = CapaGrid::where('capa_id', $id)->where('type', "Product_Details")->first();
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.OOS_Micro.oos_micro_auditReport', compact('doc'))
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                ]);
            $pdf->setPaper('A4');
            $pdf->render();
            $canvas = $pdf->getDomPDF()->getCanvas();
            $height = $canvas->get_height();
            $width = $canvas->get_width();
            $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');
            $canvas->page_text($width / 4, $height / 2, $doc->status, null, 25, [0, 0, 0], 2, 6, -20);
            return $pdf->stream('CAPA' . $id . '.pdf');
        }
    }

    public static function singleReport($id)
    {
        $data = OOS_micro::find($id);
        if (!empty($data)) {
            //  $data->Product_Details = CapaGrid::where('capa_id', $id)->where('type', "Product_Details")->first();
            // $data->Instruments_Details = CapaGrid::where('capa_id', $id)->where('type', "Instruments_Details")->first();
            // $data->Material_Details = CapaGrid::where('capa_id', $id)->where('type', "Material_Details")->first();
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.OOS_Micro.oos_micro_single_report', compact('data'))
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                ]);
            $pdf->setPaper('A4');
            $pdf->render();
            $canvas = $pdf->getDomPDF()->getCanvas();
            $height = $canvas->get_height();
            $width = $canvas->get_width();
            $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');
            $canvas->page_text($width / 4, $height / 2, $data->status, null, 25, [0, 0, 0], 2, 6, -20);
            return $pdf->stream('CAPA' . $id . '.pdf');
        }
    }





}
