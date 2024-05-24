<?php

namespace App\Http\Controllers;

use App\Models\OOS_micro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RecordNumber;


class OOSMicroController extends Controller
{
    public function index()
    {


        $old_record = OOS_micro::select('id', 'division_id', 'record')->get();
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);


        return view('frontend.OOS_Micro.oos_micro',compact('old_record','record_number','old_record'));
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
        //$micro->save();
        //return "test";
        // phase ii investigation
        $micro->qa_approver_comments_piii = $request->qa_approver_comments_piii;
        $micro->manufact_invest_required_piii = $request->manufact_invest_required_piii;
        $micro->manufacturing_invest_type_piii = implode(',', $request->manufacturing_invest_type_piii);
        $micro->manufacturing_invst_ref_piii = implode(',', $request->manufacturing_invst_ref_piii);
        $micro->re_sampling_required_piii = $request->re_sampling_required_piii;
        $micro->audit_comments_piii = $request->audit_comments_piii;
        $micro->re_sampling_ref_no_piii = implode(',', $request->re_sampling_ref_no_piii);
        $micro->hypo_exp_required_piii = $request->hypo_exp_required_piii;
        $micro->hypo_exp_reference_piii = implode(',', $request->hypo_exp_reference_piii);

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
        $micro->recommended_action_reference_piiqcr = implode(',', $request->recommended_action_reference_piiqcr);
        $micro->investi_required_piiqcr = $request->investi_required_piiqcr;
        $micro->invest_ref_piiqcr = implode(',', $request->invest_ref_piiqcr); 

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
        $micro->additional_test_reference_atp = implode(',', $request->additional_test_reference_atp);
        $micro->any_other_actions_required_atp = $request->any_other_actions_required_atp;
        $micro->action_task_reference_atp = implode(',', $request->action_task_reference_atp);
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
        $micro->capa_ref_no_oosc = implode(',', $request->capa_ref_no_oosc);
        $micro->justify_if_capa_not_required_oosc = $request->justify_if_capa_not_required_oosc;
        $micro->action_plan_req_oosc = $request->action_plan_req_oosc;
        $micro->action_plan_ref_oosc = implode(',', $request->action_plan_ref_oosc);
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
        $micro->capa_refer_ocr = implode(',', $request->capa_refer_ocr);
        $micro->required_action_plan_ocr = $request->required_action_plan_ocr;
        $micro->required_action_task_ocr = $request->required_action_task_ocr;
        $micro->action_task_reference_ocr = implode(',', $request->action_task_reference_ocr);
        $micro->risk_assessment_req_ocr = $request->risk_assessment_req_ocr;
        $micro->risk_assessment_ref_ocr = implode(',', $request->risk_assessment_ref_ocr);
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
        $micro->field_alert_reference_BI = implode(',', $request->field_alert_reference_BI);
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
        $micro->phase_III_inves_reference_BI = implode(',', $request->phase_III_inves_reference_BI);
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
        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
     }

       public function edit($id){

            $micro_data = OOS_micro::find($id);
            // dd($micro_data);
            $old_record = OOS_micro::select('id', 'division_id', 'record')->get();
            $record_number = ((RecordNumber::first()->value('counter')) + 1);
            $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            return view('frontend.OOS_Micro.oos_micro_view',compact('micro_data','record_number','old_record'));
       }
        public function update(Request $request, $id){

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
            $micro->qa_approver_comments_piii = $request->qa_approver_comments_piii;
            $micro->manufact_invest_required_piii = $request->manufact_invest_required_piii;
            $micro->manufacturing_invest_type_piii = implode(',', $request->manufacturing_invest_type_piii);
            $micro->manufacturing_invst_ref_piii = implode(',', $request->manufacturing_invst_ref_piii);
            $micro->re_sampling_required_piii = $request->re_sampling_required_piii;
            $micro->audit_comments_piii = $request->audit_comments_piii;
            $micro->re_sampling_ref_no_piii = implode(',', $request->re_sampling_ref_no_piii);
            $micro->hypo_exp_required_piii = $request->hypo_exp_required_piii;
            $micro->hypo_exp_reference_piii = implode(',', $request->hypo_exp_reference_piii);

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
            $micro->recommended_action_reference_piiqcr = implode(',', $request->recommended_action_reference_piiqcr);
            $micro->investi_required_piiqcr = $request->investi_required_piiqcr;
            $micro->invest_ref_piiqcr = implode(',', $request->invest_ref_piiqcr);

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
            $micro->additional_test_reference_atp = implode(',', $request->additional_test_reference_atp);
            $micro->any_other_actions_required_atp = $request->any_other_actions_required_atp;
            $micro->action_task_reference_atp = implode(',', $request->action_task_reference_atp);

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
            $micro->capa_ref_no_oosc = implode(',', $request->capa_ref_no_oosc);
            $micro->justify_if_capa_not_required_oosc = $request->justify_if_capa_not_required_oosc;
            $micro->action_plan_req_oosc = $request->action_plan_req_oosc;
            $micro->action_plan_ref_oosc = implode(',', $request->action_plan_ref_oosc);
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
            $micro->capa_refer_ocr = implode(',', $request->capa_refer_ocr);
            $micro->required_action_plan_ocr = $request->required_action_plan_ocr;
            $micro->required_action_task_ocr = $request->required_action_task_ocr;
            $micro->action_task_reference_ocr = implode(',', $request->action_task_reference_ocr);
            $micro->risk_assessment_req_ocr = $request->risk_assessment_req_ocr;
            $micro->risk_assessment_ref_ocr = implode(',', $request->risk_assessment_ref_ocr);
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
            $micro->field_alert_reference_BI = implode(',', $request->field_alert_reference_BI);
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
            $micro->phase_III_inves_reference_BI = implode(',', $request->phase_III_inves_reference_BI);
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

                toastr()->success("Record is updated Successfully");
                return redirect(url('rcms/qms-dashboard'));
            }


}
