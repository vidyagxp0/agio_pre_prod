<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OOS;
use App\Models\User;
use App\Models\RoleGroup;
use App\Models\Oosgrids;
use App\Models\OosAuditTrial;
use App\Services\OOSService;
use App\Models\RecordNumber;
use App\Models\Division;
use App\Models\QMSDivision;
use App\Models\Extension;
use Carbon\Carbon;
use Error;
use Helpers;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;



class OOSController extends Controller
{
    public function index()
    {
        $cft = [];

        $old_record = OOS::select('id', 'division_id', 'record_number')->get();
        
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        
        $division = QMSDivision::where('name', Helpers::getDivisionName(session()->get('division')))->first();
        
        if ($division) {
            $last_oos = OOS::where('division_id', $division->id)->latest()->first();
            if ($last_oos) {
                $record_number = $last_oos->record_number ? str_pad($last_oos->record_number + 1, 4, '0', STR_PAD_LEFT) : '0001';
                
            } else {
                $record_number = '0001';
            }
        }

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date= $formattedDate->format('Y-m-d');
        // $changeControl = OpenStage::find(1);
        //  if(!empty($changeControl->cft)) $cft = explode(',', $changeControl->cft);
        return view("frontend.OOS.oos_form", compact('due_date', 'record_number', 'old_record', 'cft'));

    }
    
    public function store(Request $request)
    { 
        
        $res = Helpers::getDefaultResponse();

        try {
            
            $oos_record = OOSService::create_oss($request);

            if ($oos_record['status'] == 'error')
            {
                throw new Error($oos_record['message']);
            } 

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
            info('Error in OOSController@store', [
                'message' => $e->getMessage()
            ]);
        }

        return redirect()->route('qms.dashboard');
    }


    public static function show($id)
    {
        $cft = [];
        $revised_date = "";
        $data = OOS::find($id);

        $old_record = OOS::select('id', 'division_id', 'record_number')->get();
        // $revised_date = Extension::where('parent_id', $id)->where('parent_type', "OOS Chemical")->value('revised_date');
        $data->record_number = str_pad($data->record_number, 4, '0', STR_PAD_LEFT);
        
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');

        $info_product_materials = $data->grids()->where('identifier', 'info_product_material')->first();
        $details_stabilities = $data->grids()->where('identifier', 'details_stability')->first();
        $oos_details = $data->grids()->where('identifier', 'oos_detail')->first();
        $checklist_lab_invs = $data->grids()->where('identifier', 'checklist_lab_inv')->first();
        $oos_capas = $data->grids()->where('identifier', 'oos_capa')->first();
        $phase_two_invs = $data->grids()->where('identifier', 'phase_two_inv')->first();
        $oos_conclusions = $data->grids()->where('identifier', 'oos_conclusion')->first();
        $oos_conclusion_reviews = $data->grids()->where('identifier', 'oos_conclusion_review')->first();
        return view('frontend.OOS.oos_form_view', 
        compact('data', 'old_record','revised_date','cft' , 'info_product_materials', 'details_stabilities', 'oos_details', 'checklist_lab_invs', 'oos_capas', 'phase_two_invs', 'oos_conclusions', 'oos_conclusion_reviews'));

    }

    public function update(Request $request, $id)
    {
        // if (!$request->short_description) {
        //     toastr()->error("Short description is required");
        //     return redirect()->back();
        // }
        $lastOosRecod = OOS::findOrFail($id);
        if(!empty($lastOosRecod))
            {
                    // ==========general===========
                if (!empty($request->description_gi)){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->change_to =   "Not Applicable";
                    $history->change_from = $lastOosRecod->status;
                    $history->action_name = 'Update';
                    $history->previous = $lastOosRecod->description_gi;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Short Description';
                    $history->current = $request->description_gi;
                    $history->save();
                }
                if (!empty($request->initiator_Group)){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->change_to =   "Not Applicable";
                    $history->change_from = $lastOosRecod->status;
                    $history->action_name = 'Update';
                    $history->previous = $lastOosRecod->initiator_Group;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'initiator Group';
                    $history->current = $request->initiator_Group;
                    $history->save();
                }
                if (!empty($request->initiator_group_code)){
                    $history->previous = $lastOosRecod->initiator_group_code;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Initiator Group Code';
                    $history->current = $request->initiator_group_code;
                    $history->save();
                }
                if (!empty($request->if_others_gi)){
                    $history->previous = $lastOosRecod->if_others_gi;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'If Others';
                    $history->current = $request->if_others_gi;
                    $history->save();
                }
                if (!empty($request->is_repeat_gi)){
                    $history->previous = $lastOosRecod->is_repeat_gi;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Is Repeat';
                    $history->current = $request->is_repeat_gi;
                    $history->save();
                }
                if (!empty($request->repeat_nature_gi)){
                    $history->previous = $lastOosRecod->repeat_nature_gi;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Nature Of Change';
                    $history->current = $request->nature_of_change_gi;
                    $history->save();
                }
                if (!empty($request->deviation_occured_on_gi)){
                    $history->previous = $lastOosRecod->deviation_occured_on_gi;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Deviation Occured On';
                    $history->current = $request->deviation_occured_on_gi;
                    $history->save();
                }
                if (!empty($request->source_document_type_gi)){
                    $history->previous = $lastOosRecod->source_document_type_gi;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Source Document Type';
                    $history->current = $request->source_document_type_gi;
                    $history->save();
                }
                if (!empty($request->reference_system_document_gi)){
                    $history->previous = $lastOosRecod->source_document_type_gi;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Reference System Document';
                    $history->current = $request->reference_system_document_gi;
                    $history->save();
                }
                if (!empty($request->reference_document)){
                    $history->previous = $lastOosRecod->reference_document;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Reference Document';
                    $history->current = $request->reference_document;
                    $history->save();
                }
                if (!empty($request->sample_type_gi)){
                    $history->previous = $lastOosRecod->sample_type_gi;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Sample Type';
                    $history->current = $request->sample_type_gi;
                    $history->save();
                }
                if (!empty($request->product_material_name_gi)){
                    $history->previous = $lastOosRecod->product_material_name_gi;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Product / Material Name';
                    $history->current = $request->product_material_name_gi;
                    $history->save();
                }
                if (!empty($request->market_gi)){
                    $history->previous = $lastOosRecod->market_gi;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Market';
                    $history->current = $request->market_gi;
                    $history->save();
                }
                if (!empty($request->customer_gi)){
                    $history->previous = $lastOosRecod->customer_gi;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Customer';
                    $history->current = $request->customer_gi;
                    $history->save();
                }
                // TapII
                if (!empty($request->Comments_plidata)){
                    $history->previous = $lastOosRecod->Comments_plidata;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Comments Plidata';
                    $history->current = $oos->Comments_plidata;
                    $history->save();
                }
                if (!empty($request->justify_if_no_field_alert_pli)){
                    $history->previous = $lastOosRecod->justify_if_no_field_alert_pli;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Justify If No Field Alert Pli';
                    $history->current = $oos->justify_if_no_field_alert_pli;
                    $history->save();
                }
                if (!empty($request->justify_if_no_analyst_int_pli)){
                    $history->previous = $lastOosRecod->justify_if_no_analyst_int_pli;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Justify if no Analyst Int';
                    $history->current = $request->justify_if_no_analyst_int_pli;
                    $history->save();
                }
                if (!empty($request->phase_i_investigation_pli)){
                    $history->previous = $lastOosRecod->phase_i_investigation_pli;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Phase I Investigation';
                    $history->current = $request->phase_i_investigation_pli;
                    $history->save();
                }
                if (!empty($request->phase_i_investigation_ref_pli)){
                    $history->previous = $lastOosRecod->phase_i_investigation_ref_pli;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Phase I Investigation Ref';
                    $history->current = $request->phase_i_investigation_ref_pli;
                    $history->save();
                }
                // TapIV
                if (!empty($request->summary_of_prelim_investiga_plic)){
                    $history->previous = $lastOosRecod->summary_of_prelim_investiga_plic;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Summary of Preliminary Investigation';
                    $history->current = $request->summary_of_prelim_investiga_plic;
                    $history->save();
                }
                if (!empty($request->root_cause_identified_plic)){
                    $history->previous = $lastOosRecod->root_cause_identified_plic;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Root Cause Identified';
                    $history->current = $request->root_cause_identified_plic;
                    $history->save();
                }
                if (!empty($request->oos_category_root_cause_ident_plic)){
                    $history->previous = $lastOosRecod->oos_category_root_cause_ident_plic;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'OOS Category-Root Cause Ident';
                    $history->current = $request->oos_category_root_cause_ident_plic;
                    $history->save();
                }
                if (!empty($request->oos_category_others_plic)){
                    $history->previous = $lastOosRecod->oos_category_others_plic;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'OOS Category Others';
                    $history->current = $request->oos_category_others_plic;
                    $history->save();
                }
                if (!empty($request->root_cause_details_plic)){
                    $history->previous = $lastOosRecod->root_cause_details_plic;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Root Cause Details';
                    $history->current = $request->root_cause_details_plic;
                    $history->save();
                }
                if (!empty($request->oos_category_others_plic)){
                    $history->previous = $lastOosRecod->oos_category_others_plic;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'OOS Category-Root Cause Ident';
                    $history->current = $request->oos_category_others_plic;
                    $history->save();
                }
                if (!empty($request->capa_required_plic)){
                    $history->previous = $lastOosRecod->capa_required_plic;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'CAPA Required';
                    $history->current = $request->capa_required_plic;
                    $history->save();
                }
                if (!empty($request->reference_capa_no_plic)){
                    $history->previous = $lastOosRecod->reference_capa_no_plic;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Reference CAPA No';
                    $history->current = $request->reference_capa_no_plic;
                    $history->save();
                }
                if (!empty($request->delay_justification_for_pi_plic)){
                    $history->previous = $lastOosRecod->delay_justification_for_pi_plic;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Delay Justification for Preliminary Investigation';
                    $history->current = $request->delay_justification_for_pi_plic;
                    $history->save();
                }
                // TapV5
                if (!empty($request->review_comments_plir)){
                    $history->previous = $lastOosRecod->review_comments_plir;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Review Comments';
                    $history->current = $request->review_comments_plir;
                    $history->save();
                }
                if (!empty($request->phase_ii_inv_required_plir)){
                    $history->previous = $lastOosRecod->phase_ii_inv_required_plir;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Phase II Inv. Required';
                    $history->current = $request->phase_ii_inv_required_plir;
                    $history->save();
                }
                // TapVI6
                if (!empty($request->qa_approver_comments_piii)){
                    $history->previous = $lastOosRecod->qa_approver_comments_piii;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'QA Approver Comments';
                    $history->current = $request->qa_approver_comments_piii;
                    $history->save();
                }
                if (!empty($request->qa_approver_comments_piii)){
                    $history->previous = $lastOosRecod->qa_approver_comments_piii;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Manufact. Invest. Required?';
                    $history->current = $request->qa_approver_comments_piii;
                    $history->save();
                }
                if (!empty($request->manufact_invest_required_piii)){
                    $history->previous = $lastOosRecod->manufact_invest_required_piii;
                    $history->comment = "Not Applicable";
                    $history->activity_type = ' Manufacturing Invest. Type';
                    $history->current = $request->manufact_invest_required_piii;
                    $history->save();
                }
                if (!empty($request->manufacturing_invest_type_piii)){
                    $history->previous = $lastOosRecod->manufacturing_invest_type_piii;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'manufacturing_invest_type_piii';
                    $history->current = $request->manufacturing_invest_type_piii;
                    $history->save();
                } 
                if (!empty($request->audit_comments_piii)){
                    $history->previous = $lastOosRecod->audit_comments_piii;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Audit Comments';
                    $history->current = $request->audit_comments_piii;
                    $history->save();
                }
                if (!empty($request->hypo_exp_required_piii)){
                    $history->previous = $lastOosRecod->hypo_exp_required_piii;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Hypo/Exp. Required';
                    $history->current = $request->hypo_exp_required_piii;
                    $history->save();
                }
                if (!empty($request->hypo_exp_reference_piii)){
                    $history->previous = $lastOosRecod->hypo_exp_reference_piii;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Hypo/Exp. Reference';
                    $history->current = $request->hypo_exp_reference_piii;
                    $history->save();
                }
                // TapVIII8
                if (!empty($request->summary_of_exp_hyp_piiqcr)){
                    $history->previous = $lastOosRecod->summary_of_exp_hyp_piiqcr;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Summary of Exp./Hyp.';
                    $history->current = $request->summary_of_exp_hyp_piiqcr;
                    $history->save();
                }
                if (!empty($request->summary_mfg_investigation_piiqcr)){
                    $history->previous = $lastOosRecod->summary_mfg_investigation_piiqcr;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Summary Mfg. Investigation';
                    $history->current = $request->summary_mfg_investigation_piiqcr;
                    $history->save();
                }
                if (!empty($request->root_casue_identified_piiqcr)){
                    $history->previous = $lastOosRecod->root_casue_identified_piiqcr;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Root Casue Identified';
                    $history->current = $request->root_casue_identified_piiqcr;
                    $history->save();
                }
                if (!empty($request->oos_category_reason_identified_piiqcr)){
                    $history->previous = $lastOosRecod->oos_category_reason_identified_piiqcr;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'OOS Category-Reason identified';
                    $history->current = $request->oos_category_reason_identified_piiqcr;
                    $history->save();
                }
                
                if (!empty($request->others_oos_category_piiqcr)){
                    $history->previous = $lastOosRecod->others_oos_category_piiqcr;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Others (OOS category)';
                    $history->current = $request->others_oos_category_piiqcr;
                    $history->save();
                }
                if (!empty($request->details_of_root_cause_piiqcr)){
                    $history->previous = $lastOosRecod->details_of_root_cause_piiqcr;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Details of Root Cause';
                    $history->current = $request->details_of_root_cause_piiqcr;
                    $history->save();
                }
                if (!empty($request->impact_assessment_piiqcr)){
                    $history->previous = $lastOosRecod->impact_assessment_piiqcr;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'Impact Assessment.';
                    $history->current = $request->impact_assessment_piiqcr;
                    $history->save();
                }
                
                if (!empty($request->review_comment_atp)){
                    $history->previous = $lastOosRecod->review_comment_atp;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'review_comment_atp.';
                    $history->current = $request->review_comment_atp;
                    $history->save();
                }
                
                
                if (!empty($request->additional_test_proposal_atp)){
                    $history->previous = $lastOosRecod->additional_test_proposal_atp;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'additional_test_proposal_atp.';
                    $history->current = $request->additional_test_proposal_atp;
                    $history->save();
                }
                if (!empty($request->additional_test_reference_atp)){
                    $history->previous = $lastOosRecod->additional_test_reference_atp;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'additional_test_reference_atp.';
                    $history->current = $request->additional_test_reference_atp;
                    $history->save();
                }
                if (!empty($request->any_other_actions_required_atp)){
                    $history->previous = $lastOosRecod->any_other_actions_required_atp;
                    $history->comment = "Not Applicable";
                    $history->activity_type = 'any_other_actions_required_atp.';
                    $history->current = $request->any_other_actions_required_atp;
                    $history->save();
                }
                 
                

            }
        $res = Helpers::getDefaultResponse();

        try {
            
            $oos_record = OOSService::update_oss($request,$id);

            if ($oos_record['status'] == 'error')
            {
                throw new Error($oos_record['message']);
            } 

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
            info('Error in OOSController@store', [
                'message' => $e->getMessage()
            ]);
        }

        return redirect()->route('qms.dashboard');
        
        
    }

    public function send_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changestage = OOS::find($id);
            $lastDocument = OOS::find($id);
            if ($changestage->stage == 1) {
                $changestage->stage = "2";
                $changestage->status = "Pending Initial Assessment & LabIncident";
                $changestage->completed_by_pending_initial_assessment = Auth::user()->name;
                $changestage->completed_on_pending_initial_assessment = Carbon::now()->format('d-M-Y');
                $changestage->comment_pending_initial_assessment = $request->comment;
                                $history = new OosAuditTrial();
                                $history->oos_id = $id;
                                $history->activity_type = 'Activity Log';
                                $history->current = $changestage->completed_by_pending_initial_assessment;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->id;
                                $history->user_name = Auth::user()->name;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = "Completed";
                                $history->save();
                            //     $list = Helpers::getLeadAuditeeUserList();
                            //     foreach ($list as $u) {
                            //         if($u->q_m_s_divisions_id == $changestage->division_id){
                            //             $email = Helpers::getInitiatorEmail($u->user_id);
                            //              if ($email !== null) {
                                      
                            //               Mail::send(
                            //                   'mail.view-mail',
                            //                    ['data' => $changestage],
                            //                 function ($message) use ($email) {
                            //                     $message->to($email)
                            //                         ->subject("Document sent ".Auth::user()->name);
                            //                 }
                            //               );
                            //             }
                            //      } 
                            //   }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 2) {
                $changestage->stage = "3";
                $changestage->status = "Under Phase I investigation";
                $changestage->completed_by_under_phaseI_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseI_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseI_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIB_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Lab Supervisor";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 3) {
                $changestage->stage = "5";
                $changestage->status = "Under Phase I b Investigation";
                $changestage->completed_by_under_phaseIB_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseIB_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseIB_investigation = $request->comment;
                            $history = new OosAuditTrial();
                            $history->oos_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changestage->completed_by_under_phaseIB_investigation;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Lab Supervisor";
                            $history->save();
                        
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 5) {
                $changestage->stage = "6";
                $changestage->status = "Under Hypothesis Experient";
                $changestage->completed_by_under_hypothesis = Auth::user()->name;
                $changestage->completed_on_under_hypothesis = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_hypothesis = $request->comment;

                $history = new OosAuditTrial();
                $history->oos_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->completed_by_under_hypothesis;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Final Approval";
                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 6) {
                $changestage->stage = "8";
                $changestage->status = "under phase II Investigation";
                $changestage->completed_by_under_phaseII_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseII_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseII_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseII_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Under Phase II investigation";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 8) {
                $changestage->stage = "9";
                $changestage->status = "under Manufacturing Investigation phase II a";
                $changestage->completed_by_under_manufacturing_investigation_phaseIIA = Auth::user()->name;
                $changestage->completed_on_under_manufacturing_investigation_phaseIIA = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_manufacturing_investigation_phaseIIA = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_manufacturing_investigation_phaseIIA;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Under Manufacturing Phase II b Additional Lab Investigation";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 9) {
                $changestage->stage = "11";
                $changestage->status = "Under phase II b Additional Lab Investigation";
                $changestage->completed_by_under_phaseIIB_additional_lab_investigation= Auth::user()->name;
                $changestage->completed_on_under_phaseIIB_additional_lab_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseIIB_additional_lab_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_manufacturing_investigation_phaseIIA;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Under Manufacturing Phase II b Additional Lab Investigation";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 11) {
                $changestage->stage = "13";
                $changestage->status = "Under phase III Investigation";
                $changestage->completed_by_under_phaseIII_investigation= Auth::user()->name;
                $changestage->completed_on_under_phaseIII_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseIII_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIII_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Under Manufacturing Phase II b Additional Lab Investigation";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 13) {
                $changestage->stage = "14";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;

                $history = new OosAuditTrial();
                $history->oos_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->completed_by_under_phaseIII_investigation;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Approval Completed";
                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
           
            if ($changestage->stage == 14) {
                $changestage->stage = "15";
                $changestage->status = "Close-Done";
                $changestage->completed_by_close_done= Auth::user()->name;
                $changestage->completed_on_close_done = Carbon::now()->format('d-M-Y');
                $changestage->comment_close_done = $request->comment;
                
                $history = new OosAuditTrial();
                $history->oos_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->completed_by_under_phaseIII_investigation;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Close-Done";
                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
    // ========== requestmoreinfo_back_stage ==============
    public function requestmoreinfo_back_stage(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changestage = OOS::find($id);
            $lastDocument = OOS::find($id);
            if ($changestage->stage == 2) {
                $changestage->stage = "1";
                $changestage->status = "Opened";
                $changestage->completed_by_pending_initial_assessment = Auth::user()->name;
                $changestage->completed_on_pending_initial_assessment = Carbon::now()->format('d-M-Y');
                $changestage->comment_pending_initial_assessment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_pending_initial_assessment;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Completed";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 3) {
                $changestage->stage = "2";
                $changestage->status = "Pending Initial Assessment & Lab Incident";
                $changestage->completed_by_under_phaseI_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseI_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseI_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIB_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Lab Supervisor";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 4) {
                $changestage->stage = "3";
                $changestage->status = "Under Phase I Investigation";
                $changestage->completed_by_under_phaseI_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseI_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseI_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIB_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Lab Supervisor";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 5) {
                $changestage->stage = "3";
                $changestage->status = "Under Phase I b Investigation";
                $changestage->status = "Under Phase I Investigation";
                $changestage->completed_by_under_phaseI_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseI_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseI_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIB_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Lab Supervisor";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 6) {
                $changestage->stage = "5";
                $changestage->status = "Under Hypothesis Experient";
                $changestage->completed_by_under_hypothesis = Auth::user()->name;
                $changestage->completed_on_under_hypothesis = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_hypothesis = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_hypothesis;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Final Approval";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 8) {
                $changestage->stage = "6";
                $changestage->status = "Under Hypothesis Experiment";
                $changestage->completed_by_under_phaseII_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseII_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseII_investigation = $request->comment;
                
                $history = new OosAuditTrial();
                $history->oos_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->completed_by_under_phaseII_investigation;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Under Phase II investigation";
                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 9) {
                $changestage->stage = "8";
                $changestage->status = "under phase II Investigation";
                $changestage->completed_by_under_manufacturing_investigation_phaseIIA = Auth::user()->name;
                $changestage->completed_on_under_manufacturing_investigation_phaseIIA = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_manufacturing_investigation_phaseIIA = $request->comment;
                
                $history = new OosAuditTrial();
                $history->oos_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->completed_by_under_manufacturing_investigation_phaseIIA;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Under Manufacturing Phase II b Additional Lab Investigation";
                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 11) {
                $changestage->stage = "9";
                $changestage->status = "Under Manufacturing Phase II b Additional Lab Investigation";
                $changestage->completed_by_under_phaseIIB_additional_lab_investigation= Auth::user()->name;
                $changestage->completed_on_under_phaseIIB_additional_lab_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseIIB_additional_lab_investigation = $request->comment;
                
                $history = new OosAuditTrial();
                $history->oos_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->completed_by_under_manufacturing_investigation_phaseIIA;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Under Manufacturing Phase II b Additional Lab Investigation";
                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 13) {
                $changestage->stage = "11";
                $changestage->status = "Under phase II b Additional Lab Investigation";
                $changestage->completed_by_under_phaseIII_investigation= Auth::user()->name;
                $changestage->completed_on_under_phaseIII_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseIII_investigation = $request->comment;
                
                $history = new OosAuditTrial();
                $history->oos_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->completed_by_under_phaseIII_investigation;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Under Manufacturing Phase II b Additional Lab Investigation";
                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 14) {
                $changestage->stage = "13";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIII_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Approval Completed";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function assignable_send_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changestage = OOS::find($id);
            $lastDocument = OOS::find($id);
            if ($changestage->stage == 3) {
                $changestage->stage = "4";
                $changestage->status = "Under Phase I Correction";
                $changestage->completed_by_under_phaseI_correction= Auth::user()->name;
                $changestage->completed_on_under_phaseI_correction = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseI_correction = $request->comment;
                            $history = new OosAuditTrial();
                            $history->oos_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changestage->completed_by_under_phaseI_correction;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Lab Supervisor";
                            $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 4) {
                $changestage->stage = "14";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIII_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Approval Completed";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 6) {
                $changestage->stage = "7";
                $changestage->status = "Under Repeat Analysis";
                $changestage->completed_by_under_repeat_analysis= Auth::user()->name;
                $changestage->completed_on_under_repeat_analysis = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_repeat_analysis = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_repeat_analysis;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Under Repeat Analysis";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 7) {
                $changestage->stage = "14";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIII_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Approval Completed";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 9) {
                $changestage->stage = "10";
                $changestage->status = "Under PhaseIIA Correction";
                $changestage->completed_by_under_phaseIIA_correction= Auth::user()->name;
                $changestage->completed_on_under_phaseIIA_correction = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseIIA_correction = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIIA_correction;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Approval Completed";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 10) {
                $changestage->stage = "12";
                $changestage->status = "Under Batch Disposition";
                $changestage->completed_by_under_batch_disposition= Auth::user()->name;
                $changestage->completed_on_under_batch_disposition = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_batch_disposition = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_batch_disposition;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Approval Completed";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 11) {
                $changestage->stage = "12";
                $changestage->status = "Under Batch Disposition";
                $changestage->completed_by_under_batch_disposition= Auth::user()->name;
                $changestage->completed_on_under_batch_disposition = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_batch_disposition = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_batch_disposition;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Approval Completed";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 12) {
                $changestage->stage = "14";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIII_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Approval Completed";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
    public function cancel_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $data = OOS::find($id);
            $lastDocument = OOS::find($id);
            $data->stage = "0";
            $data->status = "Closed-Cancelled";
            $data->cancelled_by = Auth::user()->name;
            $data->cancelled_on = Carbon::now()->format('d-M-Y');
            $data->comment_cancle = $request->comment;

                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous ="";
                    $history->current = $data->cancelled_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state =  $data->status;
                    $history->stage = 'Cancelled';
                    $history->save();
            $data->update();
            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function reject_stage(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $capa = Capa::find($id);
            $lastDocument = Capa::find($id);


            if ($capa->stage == 2) {
                $capa->stage = "1";
                $capa->status = "Opened";
                $capa->update();
                $history = new CapaHistory();
                $history->type = "Capa";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $capa->stage;
                $history->status = "Opened";
                // $list = Helpers::getInitiatorUserList();
                // foreach ($list as $u) {
                //     if($u->q_m_s_divisions_id == $capa->division_id){
                //     $email = Helpers::getInitiatorEmail($u->user_id);
                //     if ($email !== null) {
                       
                //         Mail::send(
                //             'mail.view-mail',
                //             ['data' => $capa],
                //             function ($message) use ($email) {
                //                 $message->to($email)
                //                     ->subject("More Info Required ".Auth::user()->name);
                //             }
                //         );
                //       }
                //     } 
                // }
                $history->save();

                toastr()->success('Document Sent');
                return back();
            }
            if ($capa->stage == 3) {
                $capa->stage = "2";
                $capa->status = "Pending CAPA Plan";
                $capa->qa_more_info_required_by = Auth::user()->name;
                $capa->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                        $history = new CapaAuditTrial();
                        $history->capa_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->current = $capa->qa_more_info_required_by;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->stage = 'Qa More Info Required';
                        $history->save();   
                $capa->update();
                $history = new CapaHistory();
                $history->type = "Capa";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $capa->stage;
                $history->status = "Pending CAPA Plan<";
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    // public function cancel_record(Request $request, $id)
    // {
    //     $oos_record = OOS::find($id);
    // }

    public function AuditTrial($id)
    {
        $audit = OosAuditTrial::where('oos_id', $id)->orderByDesc('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = OOS::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
        // dd($document);
        return view('frontend.OOS.comps.audit-trial', compact('audit', 'document', 'today'));
    }

    public function auditDetails($id)
    {

        $detail = OosAuditTrial::find($id);

        $detail_data = OosAuditTrial::where('activity_type', $detail->activity_type)->where('oos_id', $detail->id)->latest()->get();

        $doc = OOS::where('id', $detail->oos_id)->first();
        

        $doc->origiator_name = User::find($doc->initiator_id);
        
        return view('frontend.OOS.comps.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
    }
    public static function auditReport($id)
    {
        $doc = OOS::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $data = OOSAuditTrial::where('oos_id', $id)->get();
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.oos.comps.auditReport', compact('data', 'doc'))
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
            return $pdf->stream('OOS-Audit' . $id . '.pdf');
        }
    }
    
    public static function singleReport($id)
    {
        $data = OOS::find($id);
        if (!empty($data)) {
            $data->info_product_materials = $data->grids()->where('identifier', 'info_product_material')->first();
            $data->details_stabilities = $data->grids()->where('identifier', 'details_stability')->first();
            $data->oos_details = $data->grids()->where('identifier', 'oos_detail')->first();
            $data->checklist_lab_invs = $data->grids()->where('identifier', 'checklist_lab_inv')->first();
            $data->oos_capas = $data->grids()->where('identifier', 'oos_capa')->first();
            $data->phase_two_invs = $data->grids()->where('identifier', 'phase_two_inv')->first();
            $data->oos_conclusions = $data->grids()->where('identifier', 'oos_conclusion')->first();
            $data->oos_conclusion_reviews = $data->grids()->where('identifier', 'oos_conclusion_review')->first();
    
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.OOS.comps.singleReport', compact('data'))
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
            return $pdf->stream('OOS Cemical' . $id . '.pdf');
        }
    }
    
    
}
