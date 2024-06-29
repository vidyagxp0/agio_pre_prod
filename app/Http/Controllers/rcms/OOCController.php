<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\OOC_Grid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use App\Models\User;
use App\Models\OutOfCalibration;
use App\Models\OOCAuditTrail;
use App\Models\RoleGroup;
use App\Models\RecordNumber;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use App\Models\Capa;
use App\Models\OpenStage;



class OOCController extends Controller
{
    public function index()
    {
        $record_number = RecordNumber::first();
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        return view('frontend.OOC.out_of_calibration',compact('due_date', 'record_number'));
    }


    public function create(request $request)
    {
        if (!$request->description_ooc) {
            toastr()->info("Short Description is required");
            return redirect()->back();
        }
        $data = new OutOfCalibration();
        $data->form_type = 'Out Of Calibration';
        $data->record = ((RecordNumber::first()->value('counter')) + 1);
        $data->initiator_id = Auth::user()->id;
        $data->division_id = $request->division_id;
        $data->description_ooc = $request->description_ooc;
        $data->assign_to = $request->assign_to;
        $data->due_date = $request->due_date;
        $data->Initiator_Group= $request->Initiator_Group;
        $data->intiation_date = $request->intiation_date;
        $data->initiator_group_code= $request->initiator_group_code;
        $data->initiated_through = $request->initiated_through;
        $data->initiated_if_other= $request->initiated_if_other;
        $data->is_repeat_ooc= $request->is_repeat_ooc;
        $data->Repeat_Nature= $request->Repeat_Nature;
        $data->ooc_due_date= $request->ooc_due_date;
        $data->Delay_Justification_for_Reporting= $request->Delay_Justification_for_Reporting;
        $data->HOD_Remarks = $request->HOD_Remarks;
        // $data->attachments_hod_ooc = $request->attachments_hod_ooc;
        $data->Immediate_Action_ooc = $request->Immediate_Action_ooc;
        $data->Preliminary_Investigation_ooc = $request->Preliminary_Investigation_ooc;
        $data->qa_comments_ooc = $request->qa_comments_ooc;
        $data->qa_comments_description_ooc = $request->qa_comments_description_ooc;
        if($request->has('is_repeat_assingable_ooc')) {
            
            $data->is_repeat_assingable_ooc = $request->is_repeat_assingable_ooc;
        }
        
        $data->protocol_based_study_hypthesis_study_ooc = $request->protocol_based_study_hypthesis_study_ooc;
        $data->justification_for_protocol_study_hypothesis_study_ooc = $request->justification_for_protocol_study_hypothesis_study_ooc;
        $data->plan_of_protocol_study_hypothesis_study = $request->plan_of_protocol_study_hypothesis_study;
        $data->conclusion_of_protocol_based_study_hypothesis_study_ooc = $request->conclusion_of_protocol_based_study_hypothesis_study_ooc;
        $data->analysis_remarks_stage_ooc = $request->analysis_remarks_stage_ooc;
        $data->calibration_results_stage_ooc = $request->calibration_results_stage_ooc;
        $data->is_repeat_result_naturey_ooc = $request->is_repeat_result_naturey_ooc;
        $data->review_of_calibration_results_of_analyst_ooc = $request->review_of_calibration_results_of_analyst_ooc;
        $data->results_criteria_stage_ooc = $request->results_criteria_stage_ooc;
        $data->is_repeat_stae_ooc = $request->is_repeat_stae_ooc;
        $data->qa_comments_stage_ooc = $request->qa_comments_stage_ooc;
        $data->additional_remarks_stage_ooc = $request->additional_remarks_stage_ooc;
        $data->is_repeat_stageii_ooc = $request->is_repeat_stageii_ooc;
        $data->is_repeat_stage_instrument_ooc = $request->is_repeat_stage_instrument_ooc;
        $data->is_repeat_proposed_stage_ooc = $request->is_repeat_proposed_stage_ooc;
        $data->is_repeat_compiled_stageii_ooc = $request->is_repeat_compiled_stageii_ooc;
        $data->is_repeat_realease_stageii_ooc = $request->is_repeat_realease_stageii_ooc;
        $data->initiated_throug_stageii_ooc = $request->initiated_throug_stageii_ooc;
        $data->initiated_through_stageii_ooc = $request->initiated_through_stageii_ooc;
        $data->is_repeat_reanalysis_stageii_ooc = $request->is_repeat_reanalysis_stageii_ooc;
        $data->initiated_through_stageii_cause_failure_ooc = $request->initiated_through_stageii_cause_failure_ooc;
        $data->is_repeat_capas_ooc = $request->is_repeat_capas_ooc;
        $data->initiated_through_capas_ooc = $request->initiated_through_capas_ooc;
        $data->initiated_through_capa_prevent_ooc = $request->initiated_through_capa_prevent_ooc;
        $data->initiated_through_capa_corrective_ooc = $request->initiated_through_capa_corrective_ooc;
        $data->initiated_through_capa_ooc = $request->initiated_through_capa_ooc;
        $data->short_description_closure_ooc = $request->short_description_closure_ooc;
        $data->document_code_closure_ooc = $request->document_code_closure_ooc;
        $data->remarks_closure_ooc = $request->remarks_closure_ooc;
        $data->initiated_through_closure_ooc = $request->initiated_through_closure_ooc;
        $data->initiated_through_hodreview_ooc = $request->initiated_through_hodreview_ooc;
        $data->initiated_through_rootcause_ooc = $request->initiated_through_rootcause_ooc;
        $data->initiated_through_impact_closure_ooc = $request->initiated_through_impact_closure_ooc;
        $data->status = 'Opened';
        $data->stage = 1;


        if (!empty($request->initial_attachment_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_ooc')) {
                foreach ($request->file('initial_attachment_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_ooc = json_encode($files);
        }
        if (!empty($request->initial_attachment_stageii_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_stageii_ooc')) {
                foreach ($request->file('initial_attachment_stageii_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_stageii_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_stageii_ooc = json_encode($files);
        }
        if (!empty($request->attachments_hod_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_hod_ooc')) {
                foreach ($request->file('attachments_hod_ooc') as $file) {
                    $name = $request->name . 'attachments_hod_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->attachments_hod_ooc = json_encode($files);
        }

        if (!empty($request->attachments_stage_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_stage_ooc')) {
                foreach ($request->file('attachments_stage_ooc') as $file) {
                    $name = $request->name . 'attachments_stage_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->attachments_stage_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_hodreview_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_hodreview_ooc')) {
                foreach ($request->file('initial_attachment_hodreview_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_hodreview_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_hodreview_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_closure_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_closure_ooc')) {
                foreach ($request->file('initial_attachment_closure_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_closure_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_closure_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_capa_post_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_capa_post_ooc')) {
                foreach ($request->file('initial_attachment_capa_post_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_capa_post_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_capa_post_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_capa_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_capa_ooc')) {
                foreach ($request->file('initial_attachment_capa_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_capa_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_capa_ooc = json_encode($files);
        }


        $data->save();
        


        // ====================counter===================//
        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();

        //===================counter=======================//

        //=========================================================Audit Trail Create ===========================================================================================//

        if(!empty($data->initiated_if_other)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'If Other';
            $history->previous = "Null";
            $history->current = $data->initiated_if_other;
            $history->comment = "No Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }
        if(!empty($data->initiated_through_capas_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Initiated Through';
            $history->previous = "Null";
            $history->current = $data->initiated_through_capas_ooc;
            $history->comment = "No Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }


        if(!empty($data->is_repeat_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Is Repeat';
            $history->previous = "Null";
            $history->current = $data->is_repeat_ooc;
            $history->comment = "No Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if(!empty($data->initial_attachment_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Initial Attachment';
            $history->previous = "Null";
            $history->current = $data->initial_attachment_ooc;
            $history->comment = "No Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }


        if(!empty($data->ooc_due_date)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'OOC Logged Date';
            $history->previous = "Null";
            $history->current = $data->ooc_due_date;
            $history->comment = "No Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }
        if(!empty($data->assign_to)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'OOC Logged By';
            $history->previous = "Null";
            $history->current = $data->assign_to;
            $history->comment = "No Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }


        if(!empty($data->Repeat_Nature)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = "Null";
            $history->current = $data->Repeat_Nature;
            $history->comment = "No Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }
        if(!empty($data->description_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Short Description ';
            $history->previous = "Null";
            $history->current = $data->description_ooc;
            $history->comment = "No Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }
        if(!empty($data->due_date)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current = $data->due_date;
            $history->comment = "No Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }


        if(!empty($data->Initiator_Group)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Initiator Group';
            $history->previous = "Null";
            $history->current = $data->Initiator_Group;
            $history->comment = "No Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }



        if(!empty($data->Delay_Justification_for_Reporting)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Delay Justification for Reporting';
            $history->previous = "Null";
            $history->current = $data->Delay_Justification_for_Reporting;
            $history->comment = "No Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }







        $oocGrid = $data->id;
        // if($request->has('instrumentDetail')){
        if (!empty($request->instrumentdetails)) {
        $instrumentDetail = OOC_Grid::where(['ooc_id' => $oocGrid, 'identifier' => 'Instrument Details'])->firstOrNew();
        $instrumentDetail->ooc_id = $oocGrid;
        $instrumentDetail->identifier = 'Instrument Details';
        $instrumentDetail->data = $request->instrumentdetails;
        $instrumentDetail->save();
        }

    //    if($request->has('oocevoluation')){
        if (!empty($request->instrumentdetails)) {

        $oocevaluation = OOC_Grid::where(['ooc_id'=>$oocGrid,'identifier'=>'OOC Evaluation'])->firstOrNew();
        $oocevaluation->ooc_id = $oocGrid;
        $oocevaluation->identifier = 'OOC Evaluation';
        $oocevaluation->data = $request->oocevoluation;
        $oocevaluation->save();
        }




        // HOD SuperVision Review

        // HOD Remarks
if(!empty($data->HOD_Remarks)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'HOD Remarks';
    $history->previous = "Null";
    $history->current = $data->HOD_Remarks;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

// HOD Attachment
if(!empty($data->attachments_hod_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'HOD Attachment';
    $history->previous = "Null";
    $history->current = json_encode($data->attachments_hod_ooc);
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

// Immediate Action
if(!empty($data->Immediate_Action_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Immediate Action';
    $history->previous = "Null";
    $history->current = $data->Immediate_Action_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

// Preliminary Investigation
if(!empty($data->Preliminary_Investigation_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Preliminary Investigation';
    $history->previous = "Null";
    $history->current = $data->Preliminary_Investigation_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}


// OOC EVALUATION
if (!empty($data->qa_comments_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Evaluation Remarks';
    $history->previous = "Null";
    $history->current = $data->qa_comments_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->qa_comments_description_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Description of Cause for OOC Results';
    $history->previous = "Null";
    $history->current = $data->qa_comments_description_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

// if (!empty($data->is_repeat_assingable_ooc)) {
//     $history = new OOCAuditTrail();
//     $history->ooc_id = $data->id;
//     $history->activity_type = 'Assignable Root Cause Found';
//     $history->previous = "Null";
//     $history->current = $data->is_repeat_assingable_ooc;
//     $history->comment = "Not Applicable";
//     $history->user_id = Auth::user()->id;
//     $history->user_name = Auth::user()->name;
//     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
//     $history->origin_state = $data->status;
//     $history->change_to = "Opened";
//     $history->change_from = "Initiator";
//     $history->action_name = "Create";
//     $history->save();
// }

if (!empty($data->protocol_based_study_hypthesis_study_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Protocol Based Study/Hypothesis Study';
    $history->previous = "Null";
    $history->current = $data->protocol_based_study_hypthesis_study_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->justification_for_protocol_study_hypothesis_study_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Justification for Protocol Study/Hypothesis Study';
    $history->previous = "Null";
    $history->current = $data->justification_for_protocol_study_hypothesis_study_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->plan_of_protocol_study_hypothesis_study)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Plan of Protocol Study/Hypothesis Study';
    $history->previous = "Null";
    $history->current = $data->plan_of_protocol_study_hypothesis_study;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->conclusion_of_protocol_based_study_hypothesis_study_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Conclusion of Protocol Based Study/Hypothesis Study';
    $history->previous = "Null";
    $history->current = $data->conclusion_of_protocol_based_study_hypothesis_study_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

// STAGE-I

if (!empty($data->analysis_remarks_stage_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Analyst Remarks';
    $history->previous = "Null";
    $history->current = $data->analysis_remarks_stage_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->calibration_results_stage_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Calibration Results';
    $history->previous = "Null";
    $history->current = $data->calibration_results_stage_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->is_repeat_result_naturey_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Results Nature';
    $history->previous = "Null";
    $history->current = $data->is_repeat_result_naturey_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->review_of_calibration_results_of_analyst_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Review of Calibration Results of Analyst';
    $history->previous = "Null";
    $history->current = $data->review_of_calibration_results_of_analyst_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->attachments_stage_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Stage I Attachment';
    $history->previous = "Null";
    $history->current = json_encode($data->attachments_stage_ooc);
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->results_criteria_stage_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Results Criteria';
    $history->previous = "Null";
    $history->current = $data->results_criteria_stage_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->is_repeat_stae_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Invalidated & Validated';
    $history->previous = "Null";
    $history->current = $data->is_repeat_stae_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->additional_remarks_stage_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Additional Remarks';
    $history->previous = "Null";
    $history->current = $data->additional_remarks_stage_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}
// STAGEII
if (!empty($data->initial_attachment_stageii_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Initial Attachment Stage II';
    $history->previous = "Null";
    $history->current = $data->initial_attachment_stageii_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

// if (!empty($data->is_repeat_stageii_ooc)) {
//     $history = new OOCAuditTrail();
//     $history->ooc_id = $data->id;
//     $history->activity_type = 'Rectification by Service Engineer required';
//     $history->previous = "Null";
//     $history->current = $data->is_repeat_stageii_ooc;
//     $history->comment = "Not Applicable";
//     $history->user_id = Auth::user()->id;
//     $history->user_name = Auth::user()->name;
//     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
//     $history->origin_state = $data->status;
//     $history->change_to = "Opened";
//     $history->change_from = "Initiator";
//     $history->action_name = "Create";
//     $history->save();
// }

// if (!empty($data->is_repeat_stage_instrument_ooc)) {
//     $history = new OOCAuditTrail();
//     $history->ooc_id = $data->id;
//     $history->activity_type = 'Is Repeat Stage Instrument';
//     $history->previous = "Null";
//     $history->current = $data->is_repeat_stage_instrument_ooc;
//     $history->comment = "Not Applicable";
//     $history->user_id = Auth::user()->id;
//     $history->user_name = Auth::user()->name;
//     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
//     $history->origin_state = $data->status;
//     $history->change_to = "Opened";
//     $history->change_from = "Initiator";
//     $history->action_name = "Create";
//     $history->save();
// }

if (!empty($data->is_repeat_proposed_stage_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Is Repeat Proposed Stage';
    $history->previous = "Null";
    $history->current = $data->is_repeat_proposed_stage_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->is_repeat_compiled_stageii_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Is Repeat Compiled Stage II';
    $history->previous = "Null";
    $history->current = $data->is_repeat_compiled_stageii_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->is_repeat_realease_stageii_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Is Repeat Release Stage II';
    $history->previous = "Null";
    $history->current = $data->is_repeat_realease_stageii_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->is_repeat_reanalysis_stageii_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Is Repeat Reanalysis Stage II';
    $history->previous = "Null";
    $history->current = $data->is_repeat_reanalysis_stageii_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->initiated_through_stageii_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Initiated Through Stage II';
    $history->previous = "Null";
    $history->current = $data->initiated_through_stageii_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->initiated_through_stageii_cause_failure_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Initiated Through Stage II Cause Failure';
    $history->previous = "Null";
    $history->current = $data->initiated_through_stageii_cause_failure_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}
if (!empty($data->is_repeat_capas_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'CAPA Type';
    $history->previous = "Null";
    $history->current = $data->is_repeat_capas_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}
if (!empty($data->initiated_throug_stageii_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Initiated Through Stage II';
    $history->previous = "Null";
    $history->current = $data->initiated_throug_stageii_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}
if (!empty($data->initial_attachment_capa_post_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Initiatal Attachment ';
    $history->previous = "Null";
    $history->current = $data->initial_attachment_capa_post_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}
if (!empty($data->initiated_through_capa_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'CAPA Post Implementation Comments';
    $history->previous = "Null";
    $history->current = $data->initiated_through_capa_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}
if (!empty($data->initial_attachment_capa_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Details of Equipment Rectification Attachment';
    $history->previous = "Null";
    $history->current = $data->initial_attachment_capa_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}
if (!empty($data->initiated_through_capa_corrective_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Corrective & Preventive Action';
    $history->previous = "Null";
    $history->current = $data->initiated_through_capa_corrective_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->initiated_through_capa_prevent_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Preventive Action';
    $history->previous = "Null";
    $history->current = $data->initiated_through_capa_prevent_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}
if (!empty($data->initiated_through_capas_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Corrective Action';
    $history->previous = "Null";
    $history->current = $data->initiated_through_capas_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->is_repeat_capas_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'CAPA Type';
    $history->previous = "Null";
    $history->current = $data->is_repeat_capas_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}
// Closure Fields
if (!empty($data->short_description_closure_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Closure Comments';
    $history->previous = "Null";
    $history->current = $data->short_description_closure_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->initial_attachment_closure_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Details of Equipment Rectification';
    $history->previous = "Null";
    $history->current = $data->initial_attachment_closure_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->document_code_closure_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Document Code';
    $history->previous = "Null";
    $history->current = $data->document_code_closure_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->remarks_closure_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Remarks';
    $history->previous = "Null";
    $history->current = $data->remarks_closure_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

if (!empty($data->initiated_through_closure_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Immediate Corrective Action';
    $history->previous = "Null";
    $history->current = $data->initiated_through_closure_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}
// Immediate Corrective Action
if (!empty($data->initiated_through_closure_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Immediate Corrective Action';
    $history->previous = "Null";
    $history->current = $data->initiated_through_closure_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

// HOD Remarks
if (!empty($data->initiated_through_hodreview_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'HOD Remarks';
    $history->previous = "Null";
    $history->current = $data->initiated_through_hodreview_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

// HOD Attachment
if (!empty($data->initial_attachment_hodreview_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'HOD Attachment';
    $history->previous = "Null";
    $history->current = $data->initial_attachment_hodreview_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

// Root Cause Analysis
if (!empty($data->initiated_through_rootcause_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Root Cause Analysis';
    $history->previous = "Null";
    $history->current = $data->initiated_through_rootcause_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}

// Impact Assessment
if (!empty($data->initiated_through_impact_closure_ooc)) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $data->id;
    $history->activity_type = 'Impact Assessment';
    $history->previous = "Null";
    $history->current = $data->initiated_through_impact_closure_ooc;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $data->status;
    $history->change_to = "Opened";
    $history->change_from = "Initiator";
    $history->action_name = "Create";
    $history->save();
}







        toastr()->success('Record is created Successfully');

        return redirect('rcms/qms-dashboard');


        // return $data;

    }

    public function OutofCalibrationShow($id){

        $ooc = OutOfCalibration::where('id', $id)->first();
        $ooc->record = str_pad($ooc->record, 4, '0', STR_PAD_LEFT);
        $ooc->assign_to_name = User::where('id', $ooc->assign_id)->value('name');
        $ooc->initiator_name = User::where('id', $ooc->initiator_id)->value('name');

        $oocgrid = OOC_Grid::where('ooc_id',$id)->first();
        $oocEvolution = OOC_Grid::where(['ooc_id'=>$id, 'identifier'=>'OOC Evaluation'])->first();
        // foreach ($oocgrid->data as $oogrid)
        // {
        //     return $oogrid;
        // }

        return view('frontend.OOC.ooc_view' , compact('ooc','oocgrid','oocEvolution'));
    }

    public function updateOutOfCalibration(Request $request,$id )
    {
        // $validatedData = $request->validate([
        //     'due_date' => 'required|date',
        //     'ooc_due_date' => 'required|date',
        //     // other validations...
        // ]);

        if (!$request->description_ooc) {
            toastr()->info("Short Description is required");
            return redirect()->back()->withInput();
        }
        $lastDocumentOoc = OutOfCalibration::find($id);
        $ooc = OutOfCalibration::find($id);
        $lastDocumentOocs = $ooc->replicate();
        $ooc->initiator_id = Auth::user()->id;
        $ooc->intiation_date = $request->intiation_date;
        $ooc->assign_to = $request->assign_to;
        $ooc->due_date = $request->due_date;
        // $ooc->due_date = $validatedData['due_date'];
        $ooc->description_ooc = $request->description_ooc;
        $ooc->Initiator_Group= $request->Initiator_Group;
        $ooc->initiator_group_code= $request->initiator_group_code;
        $ooc->initiated_through = $request->initiated_through;
        $ooc->initiated_if_other= $request->initiated_if_other;
        $ooc->is_repeat_ooc= $request->is_repeat_ooc;
        $ooc->Repeat_Nature= $request->Repeat_Nature;
        $ooc->ooc_due_date= $request->ooc_due_date;
        // $ooc->ooc_due_date = $validatedData['ooc_due_date'];
        $ooc->Delay_Justification_for_Reporting= $request->Delay_Justification_for_Reporting;
        $ooc->HOD_Remarks = $request->HOD_Remarks;
        // $ooc->attachments_hod_ooc = $request->attachments_hod_ooc;
        $ooc->Immediate_Action_ooc = $request->Immediate_Action_ooc;
        $ooc->Preliminary_Investigation_ooc = $request->Preliminary_Investigation_ooc;
        $ooc->qa_comments_ooc = $request->qa_comments_ooc;
        $ooc->qa_comments_description_ooc = $request->qa_comments_description_ooc;
        $ooc->is_repeat_assingable_ooc = $request->is_repeat_assingable_ooc;
        $ooc->protocol_based_study_hypthesis_study_ooc = $request->protocol_based_study_hypthesis_study_ooc;
        $ooc->justification_for_protocol_study_hypothesis_study_ooc = $request->justification_for_protocol_study_hypothesis_study_ooc;
        $ooc->plan_of_protocol_study_hypothesis_study = $request->plan_of_protocol_study_hypothesis_study;
        $ooc->conclusion_of_protocol_based_study_hypothesis_study_ooc = $request->conclusion_of_protocol_based_study_hypothesis_study_ooc;
        $ooc->analysis_remarks_stage_ooc = $request->analysis_remarks_stage_ooc;
        $ooc->calibration_results_stage_ooc = $request->calibration_results_stage_ooc;
        $ooc->is_repeat_result_naturey_ooc = $request->is_repeat_result_naturey_ooc;
        $ooc->review_of_calibration_results_of_analyst_ooc = $request->review_of_calibration_results_of_analyst_ooc;
        $ooc->results_criteria_stage_ooc = $request->results_criteria_stage_ooc;
        $ooc->is_repeat_stae_ooc = $request->is_repeat_stae_ooc;
        $ooc->qa_comments_stage_ooc = $request->qa_comments_stage_ooc;
        $ooc->additional_remarks_stage_ooc = $request->additional_remarks_stage_ooc;
        $ooc->is_repeat_stageii_ooc = $request->is_repeat_stageii_ooc;
        $ooc->is_repeat_stage_instrument_ooc = $request->is_repeat_stage_instrument_ooc;
        $ooc->is_repeat_proposed_stage_ooc = $request->is_repeat_proposed_stage_ooc;
        // $ooc->initial_attachment_stageii_ooc = $request->initial_attachment_stageii_ooc;
        $ooc->is_repeat_compiled_stageii_ooc = $request->is_repeat_compiled_stageii_ooc;
        $ooc->is_repeat_realease_stageii_ooc = $request->is_repeat_realease_stageii_ooc;
        $ooc->initiated_throug_stageii_ooc = $request->initiated_throug_stageii_ooc;
        $ooc->initiated_through_stageii_ooc = $request->initiated_through_stageii_ooc;
        $ooc->is_repeat_reanalysis_stageii_ooc = $request->is_repeat_reanalysis_stageii_ooc;
        $ooc->initiated_through_stageii_cause_failure_ooc = $request->initiated_through_stageii_cause_failure_ooc;
        $ooc->is_repeat_capas_ooc = $request->is_repeat_capas_ooc;
        $ooc->initiated_through_capas_ooc = $request->initiated_through_capas_ooc;
        $ooc->initiated_through_capa_prevent_ooc = $request->initiated_through_capa_prevent_ooc;
        $ooc->initiated_through_capa_corrective_ooc = $request->initiated_through_capa_corrective_ooc;
        $ooc->initiated_through_capa_ooc = $request->initiated_through_capa_ooc;
        $ooc->short_description_closure_ooc = $request->short_description_closure_ooc;
        $ooc->document_code_closure_ooc = $request->document_code_closure_ooc;
        $ooc->remarks_closure_ooc = $request->remarks_closure_ooc;
        $ooc->initiated_through_closure_ooc = $request->initiated_through_closure_ooc;
        $ooc->initiated_through_hodreview_ooc = $request->initiated_through_hodreview_ooc;
        $ooc->initiated_through_rootcause_ooc = $request->initiated_through_rootcause_ooc;
        $ooc->initiated_through_impact_closure_ooc = $request->initiated_through_impact_closure_ooc;



        if (!empty($request->initial_attachment_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_ooc')) {
                foreach ($request->file('initial_attachment_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_ooc = json_encode($files);
        }
        if (!empty($request->initial_attachment_stageii_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_stageii_ooc')) {
                foreach ($request->file('initial_attachment_stageii_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_stageii_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_stageii_ooc = json_encode($files);
        }
        if (!empty($request->attachments_hod_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_hod_ooc')) {
                foreach ($request->file('attachments_hod_ooc') as $file) {
                    $name = $request->name . 'attachments_hod_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->attachments_hod_ooc = json_encode($files);
        }

        if (!empty($request->attachments_stage_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_stage_ooc')) {
                foreach ($request->file('attachments_stage_ooc') as $file) {
                    $name = $request->name . 'attachments_stage_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->attachments_stage_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_hodreview_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_hodreview_ooc')) {
                foreach ($request->file('initial_attachment_hodreview_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_hodreview_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_hodreview_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_closure_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_closure_ooc')) {
                foreach ($request->file('initial_attachment_closure_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_closure_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_closure_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_capa_post_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_capa_post_ooc')) {
                foreach ($request->file('initial_attachment_capa_post_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_capa_post_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_capa_post_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_capa_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_capa_ooc')) {
                foreach ($request->file('initial_attachment_capa_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_capa_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_capa_ooc = json_encode($files);
        }


//=======================================================Audit Trail======================================================//
if ($lastDocumentOoc->initiated_if_other != $ooc->initiated_if_other) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'If Other';
    $history->previous = $lastDocumentOoc->initiated_if_other;
    $history->current = $ooc->initiated_if_other;
    $history->comment = $request->initiated_if_other_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
    
}

if ($lastDocumentOoc->initiated_through_capas_ooc != $ooc->initiated_through_capas_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Corrective Action';
    $history->previous = $lastDocumentOoc->initiated_through_capas_ooc;
    $history->current = $ooc->initiated_through_capas_ooc;
    $history->comment = $request->initiated_through_capas_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
    
}
if ($lastDocumentOoc->initiated_through_capa_prevent_ooc != $ooc->initiated_through_capa_prevent_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Preventive Action';
    $history->previous = $lastDocumentOoc->initiated_through_capa_prevent_ooc;
    $history->current = $ooc->initiated_through_capa_prevent_ooc;
    $history->comment = $request->initiated_through_capa_prevent_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
    
}
if ($lastDocumentOoc->initiated_through_capa_corrective_ooc != $ooc->initiated_through_capa_corrective_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Corrective & Preventive Action';
    $history->previous = $lastDocumentOoc->initiated_through_capa_corrective_ooc;
    $history->current = $ooc->initiated_through_capa_corrective_ooc;
    $history->comment = $request->initiated_through_capa_corrective_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
    
}
if ($lastDocumentOoc->initial_attachment_capa_ooc != $ooc->initial_attachment_capa_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Details of Equipment Rectification Attachment';
    $history->previous = $lastDocumentOoc->initial_attachment_capa_ooc;
    $history->current = $ooc->initial_attachment_capa_ooc;
    $history->comment = $request->initial_attachment_capa_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
    
}

if ($lastDocumentOoc->initial_attachment_capa_post_ooc != $ooc->initial_attachment_capa_post_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'CAPA Post Implementation Attachement';
    $history->previous = $lastDocumentOoc->initial_attachment_capa_post_ooc;
    $history->current = $ooc->initial_attachment_capa_post_ooc;
    $history->comment = $request->initial_attachment_capa_post_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
    
}
if ($lastDocumentOoc->is_repeat_capas_ooc != $ooc->is_repeat_capas_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Is Repeat';
    $history->previous = $lastDocumentOoc->is_repeat_capas_ooc;
    $history->current = $ooc->is_repeat_capas_ooc;
    $history->comment = $request->is_repeat_capas_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
    
}

if ($lastDocumentOoc->initial_attachment_ooc != $ooc->initial_attachment_ooc ) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Intial Attachment';
    $history->previous = $lastDocumentOoc->initial_attachment_ooc;
    $history->current = $ooc->initial_attachment_ooc;
    $history->comment = $request->initial_attachment_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();

}

if ($lastDocumentOoc->ooc_due_date != $ooc->ooc_due_date ) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'OOC Logged Date';
    $history->previous = $lastDocumentOoc->ooc_due_date;
    $history->current = $ooc->ooc_due_date;
    $history->comment = $request->ooc_due_date_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();

}

if ($lastDocumentOoc->is_repeat_ooc != $ooc->is_repeat_ooc ) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Is Repeat';
    $history->previous = $lastDocumentOoc->is_repeat_ooc;
    $history->current = $ooc->is_repeat_ooc;
    $history->comment = $request->is_repeat_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();

}


if ($lastDocumentOoc->Repeat_Nature != $ooc->Repeat_Nature) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Repeat Nature';
    $history->previous = $lastDocumentOoc->Repeat_Nature;
    $history->current = $ooc->Repeat_Nature;
    $history->comment = $request->Repeat_Nature_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}


if ($lastDocumentOoc->description_ooc != $ooc->description_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Short Description';
    $history->previous = $lastDocumentOoc->description_ooc;
    $history->current = $ooc->description_ooc;
    $history->comment = $request->description_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}



if ($lastDocumentOoc->due_date != $ooc->due_date) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Due Date';
    $history->previous = $lastDocumentOoc->due_date;
    $history->current = $ooc->due_date;
    $history->comment = $request->due_date_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}
$department = [
    'CQA' => 'Corporate Quality Assurance',
    'QAB' => 'Quality Assurance Biopharma',
    'CQC' => 'Central Quality Control',
    'PSG' => 'Plasma Sourcing Group',
    'CS' => 'Central Stores',
    'ITG' => 'Information Technology Group',
    'MM' => 'Molecular Medicine',
    'CL' => 'Central Laboratory',
    'TT' => 'Tech Team',
    'QA' => 'Quality Assurance',
    'QM' => 'Quality Management',
    'IA' => 'IT Administration',
    'ACC' => 'Accounting',
    'LOG' => 'Logistics',
    'SM' => 'Senior Management',
    'BA' => 'Business Administration',
];

$lastInitiatorGroupFullForm = isset($department[$lastDocumentOoc->Initiator_Group]) ? $department[$lastDocumentOoc->Initiator_Group] : $lastDocumentOoc->Initiator_Group;
$currentInitiatorGroupFullForm = isset($department[$ooc->Initiator_Group]) ? $department[$ooc->Initiator_Group] : $ooc->Initiator_Group;


if ($lastDocumentOoc->Initiator_Group != $ooc->Initiator_Group) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Initiator Group';
    $history->previous = $lastInitiatorGroupFullForm;
    $history->current = $currentInitiatorGroupFullForm;
    $history->comment = $request->Initiator_Group_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}
if ($lastDocumentOoc->Delay_Justification_for_Reporting != $ooc->Delay_Justification_for_Reporting ) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Delay Justfication for Reporting';
    $history->previous = $lastDocumentOoc->Delay_Justification_for_Reporting;
    $history->current = $ooc->Delay_Justification_for_Reporting;
    $history->comment = $request->Delay_Justification_for_Reporting_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}


// Check and log changes for HOD Remarks
if ($lastDocumentOoc->HOD_Remarks != $ooc->HOD_Remarks) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'HOD Remarks';
    $history->previous = $lastDocumentOoc->HOD_Remarks;
    $history->current = $ooc->HOD_Remarks;
    $history->comment = 'Updated HOD Remarks';
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

// Check and log changes for HOD Attachment
if ($lastDocumentOoc->attachments_hod_ooc != $ooc->attachments_hod_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'HOD Attachment';
    $history->previous = json_encode($lastDocumentOoc->attachments_hod_ooc);
    $history->current = json_encode($ooc->attachments_hod_ooc);
    $history->comment = 'Updated HOD Attachment';
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

// Check and log changes for Immediate Action
if ($lastDocumentOoc->Immediate_Action_ooc != $ooc->Immediate_Action_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Immediate Action';
    $history->previous = $lastDocumentOoc->Immediate_Action_ooc;
    $history->current = $ooc->Immediate_Action_ooc;
    $history->comment = 'Updated Immediate Action';
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

// Check and log changes for Preliminary Investigation
if ($lastDocumentOoc->Preliminary_Investigation_ooc != $ooc->Preliminary_Investigation_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Preliminary Investigation';
    $history->previous = $lastDocumentOoc->Preliminary_Investigation_ooc;
    $history->current = $ooc->Preliminary_Investigation_ooc;
    $history->comment = 'Updated Preliminary Investigation';
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

// OOC Evaluation
// Check and log changes for Evaluation Remarks
if ($lastDocumentOoc->qa_comments_ooc != $ooc->qa_comments_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Evaluation Remarks';
    $history->previous = $lastDocumentOoc->qa_comments_ooc;
    $history->current = $ooc->qa_comments_ooc;
    $history->comment = 'Updated Evaluation Remarks';
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

// Check and log changes for Description of Cause for OOC Results
if ($lastDocumentOoc->qa_comments_description_ooc != $ooc->qa_comments_description_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Description of Cause for OOC Results';
    $history->previous = $lastDocumentOoc->qa_comments_description_ooc;
    $history->current = $ooc->qa_comments_description_ooc;
    $history->comment = 'Updated Description of Cause for OOC Results';
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}


if ($lastDocumentOoc->is_repeat_assingable_ooc != $ooc->is_repeat_assingable_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Assignable Root Cause Found';
    $history->previous = $lastDocumentOoc->is_repeat_assingable_ooc;
    $history->current = $ooc->is_repeat_assingable_ooc;
    $history->comment = $request->is_repeat_assingable_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}
if ($lastDocumentOoc->protocol_based_study_hypthesis_study_ooc != $ooc->protocol_based_study_hypthesis_study_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Protocol Based Study/Hypothesis Study ';
    $history->previous = $lastDocumentOoc->protocol_based_study_hypthesis_study_ooc;
    $history->current = $ooc->protocol_based_study_hypthesis_study_ooc;
    $history->comment = $request->protocol_based_study_hypthesis_study_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

// Check and log changes for Justification for Protocol Study/Hypothesis Study
if ($lastDocumentOoc->justification_for_protocol_study_hypothesis_study_ooc != $ooc->justification_for_protocol_study_hypothesis_study_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Justification for Protocol Study/Hypothesis Study';
    $history->previous = $lastDocumentOoc->justification_for_protocol_study_hypothesis_study_ooc;
    $history->current = $ooc->justification_for_protocol_study_hypothesis_study_ooc;
    $history->comment = $request->justification_for_protocol_study_hypothesis_study_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

// Check and log changes for Plan of Protocol Study/Hypothesis Study
if ($lastDocumentOoc->plan_of_protocol_study_hypothesis_study != $ooc->plan_of_protocol_study_hypothesis_study) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Plan of Protocol Study/Hypothesis Study';
    $history->previous = $lastDocumentOoc->plan_of_protocol_study_hypothesis_study;
    $history->current = $ooc->plan_of_protocol_study_hypothesis_study;
    $history->comment = $request->plan_of_protocol_study_hypothesis_study_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

// Check and log changes for Conclusion of Protocol Based Study/Hypothesis Study
if ($lastDocumentOoc->conclusion_of_protocol_based_study_hypothesis_study_ooc != $ooc->conclusion_of_protocol_based_study_hypothesis_study_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Conclusion of Protocol Based Study/Hypothesis Study';
    $history->previous = $lastDocumentOoc->conclusion_of_protocol_based_study_hypothesis_study_ooc;
    $history->current = $ooc->conclusion_of_protocol_based_study_hypothesis_study_ooc;
    $history->comment = $request->conclusion_of_protocol_based_study_hypothesis_study_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}


// stage i

if ($lastDocumentOoc->analysis_remarks_stage_ooc != $ooc->analysis_remarks_stage_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Analyst Remarks';
    $history->previous = $lastDocumentOoc->analysis_remarks_stage_ooc;
    $history->current = $ooc->analysis_remarks_stage_ooc;
    $history->comment = $request->analysis_remarks_stage_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->calibration_results_stage_ooc != $ooc->calibration_results_stage_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Calibration Results';
    $history->previous = $lastDocumentOoc->calibration_results_stage_ooc;
    $history->current = $ooc->calibration_results_stage_ooc;
    $history->comment = $request->calibration_results_stage_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->review_of_calibration_results_of_analyst_ooc != $ooc->review_of_calibration_results_of_analyst_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Review of Calibration Results of Analyst';
    $history->previous = $lastDocumentOoc->review_of_calibration_results_of_analyst_ooc;
    $history->current = $ooc->review_of_calibration_results_of_analyst_ooc;
    $history->comment = $request->review_of_calibration_results_of_analyst_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->results_criteria_stage_ooc != $ooc->results_criteria_stage_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Results Criteria';
    $history->previous = $lastDocumentOoc->results_criteria_stage_ooc;
    $history->current = $ooc->results_criteria_stage_ooc;
    $history->comment = 'Updated Results Criteria';
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}
if ($lastDocumentOoc->is_repeat_result_naturey_ooc != $ooc->is_repeat_result_naturey_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Results Naturey';
    $history->previous = $lastDocumentOoc->is_repeat_result_naturey_ooc;
    $history->current = $ooc->is_repeat_result_naturey_ooc;
    $history->comment = 'Updated Results Naturey';
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->review_of_calibration_results_of_analyst_ooc != $ooc->review_of_calibration_results_of_analyst_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Review of Calibration Results of Analyst';
    $history->previous = $lastDocumentOoc->review_of_calibration_results_of_analyst_ooc;
    $history->current = $ooc->review_of_calibration_results_of_analyst_ooc;
    $history->comment = 'Updated Review of Calibration Results of Analyst';
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}
if ($lastDocumentOoc->additional_remarks_stage_ooc != $ooc->additional_remarks_stage_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Additional Remarks (if any)';
    $history->previous = $lastDocumentOoc->additional_remarks_stage_ooc;
    $history->current = $ooc->additional_remarks_stage_ooc;
    $history->comment = 'Updated Additional Remarks';
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->attachments_stage_ooc != $ooc->attachments_stage_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Stage I Attachment';
    $history->previous = $lastDocumentOoc->attachments_stage_ooc;
    $history->current = $ooc->attachments_stage_ooc;
    $history->comment = 'Updated Stage I Attachment';
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}
if ($lastDocumentOoc->is_repeat_stae_ooc != $ooc->is_repeat_stae_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Invalidated & Validated';
    $history->previous = $lastDocumentOoc->is_repeat_stae_ooc;
    $history->current = $ooc->is_repeat_stae_ooc;
    $history->comment = $request->is_repeat_stae_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

// if ($lastDocumentOoc->is_repeat_stageii_ooc != $ooc->is_repeat_stageii_ooc) {
//     $history = new OOCAuditTrail();
//     $history->ooc_id = $id;
//     $history->activity_type = 'Rectification by Service Engineer required';
//     $history->previous = $lastDocumentOoc->is_repeat_stageii_ooc;
//     $history->current = $ooc->is_repeat_stageii_ooc;
//     $history->comment = $request->is_repeat_stageii_ooc_comment;
//     $history->user_id = Auth::user()->id;
//     $history->user_name = Auth::user()->name;
//     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
//     $history->origin_state = $lastDocumentOoc->status;
//     $history->change_to = "Not Applicable";
//     $history->change_from = $lastDocumentOoc->status;
//     // $history->action_name = "Update";
//     $history->save();
    
// }

if ($lastDocumentOoc->is_repeat_stage_instrument_ooc != $ooc->is_repeat_stage_instrument_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Instrument is Out of Order';
    $history->previous = $lastDocumentOoc->is_repeat_stage_instrument_ooc;
    $history->current = $ooc->is_repeat_stage_instrument_ooc;
    $history->comment = $request->is_repeat_stage_instrument_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}


if ($lastDocumentOoc->is_repeat_proposed_stage_ooc != $ooc->is_repeat_proposed_stage_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Proposed By';
    $history->previous = $lastDocumentOoc->is_repeat_proposed_stage_ooc;
    $history->current = $ooc->is_repeat_proposed_stage_ooc;
    $history->comment = $request->is_repeat_proposed_stage_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->is_repeat_compiled_stageii_ooc != $ooc->is_repeat_compiled_stageii_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Compiled by';
    $history->previous = $lastDocumentOoc->is_repeat_compiled_stageii_ooc;
    $history->current = $ooc->is_repeat_compiled_stageii_ooc;
    $history->comment = $request->is_repeat_compiled_stageii_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->is_repeat_realease_stageii_ooc != $ooc->is_repeat_realease_stageii_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Release of Instrument for usage';
    $history->previous = $lastDocumentOoc->is_repeat_realease_stageii_ooc;
    $history->current = $ooc->is_repeat_realease_stageii_ooc;
    $history->comment = $request->is_repeat_realease_stageii_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->is_repeat_reanalysis_stageii_ooc != $ooc->is_repeat_reanalysis_stageii_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Result of Reanalysis';
    $history->previous = $lastDocumentOoc->is_repeat_reanalysis_stageii_ooc;
    $history->current = $ooc->is_repeat_reanalysis_stageii_ooc;
    $history->comment = $request->is_repeat_reanalysis_stageii_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->initiated_throug_stageii_ooc != $ooc->initiated_throug_stageii_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Impact Assessment at Stage II';
    $history->previous = $lastDocumentOoc->initiated_throug_stageii_ooc;
    $history->current = $ooc->initiated_throug_stageii_ooc;
    $history->comment = $request->initiated_throug_stageii_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->initiated_through_stageii_ooc != $ooc->initiated_through_stageii_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Details of Impact Evaluation';
    $history->previous = $lastDocumentOoc->initiated_through_stageii_ooc;
    $history->current = $ooc->initiated_through_stageii_ooc;
    $history->comment = $request->initiated_through_stageii_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}
if ($lastDocumentOoc->initiated_through_stageii_cause_failure_ooc != $ooc->initiated_through_stageii_cause_failure_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Cause for failure';
    $history->previous = $lastDocumentOoc->initiated_through_stageii_cause_failure_ooc;
    $history->current = $ooc->initiated_through_stageii_cause_failure_ooc;
    $history->comment = $request->initiated_through_stageii_cause_failure_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->initial_attachment_stageii_ooc != $ooc->initial_attachment_stageii_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Details of Equipment Rectification Attachment';
    $history->previous = json_encode($lastDocumentOoc->initial_attachment_stageii_ooc);
    $history->current = json_encode($ooc->initial_attachment_stageii_ooc);
    $history->comment = $request->initial_attachment_stageii_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}

// Closure Fields
if ($lastDocumentOoc->short_description_closure_ooc != $ooc->short_description_closure_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Closure Comments';
    $history->previous = $lastDocumentOoc->short_description_closure_ooc;
    $history->current = $ooc->short_description_closure_ooc;
    $history->comment = $request->short_description_closure_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->initial_attachment_closure_ooc != $ooc->initial_attachment_closure_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Details of Equipment Rectification';
    $history->previous = $lastDocumentOoc->initial_attachment_closure_ooc;
    $history->current = $ooc->initial_attachment_closure_ooc;
    $history->comment = $request->initial_attachment_closure_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->document_code_closure_ooc != $ooc->document_code_closure_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Document Code';
    $history->previous = $lastDocumentOoc->document_code_closure_ooc;
    $history->current = $ooc->document_code_closure_ooc;
    $history->comment = $request->document_code_closure_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->remarks_closure_ooc != $ooc->remarks_closure_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Remarks';
    $history->previous = $lastDocumentOoc->remarks_closure_ooc;
    $history->current = $ooc->remarks_closure_ooc;
    $history->comment = $request->remarks_closure_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->initiated_through_closure_ooc != $ooc->initiated_through_closure_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Immediate Corrective Action';
    $history->previous = $lastDocumentOoc->initiated_through_closure_ooc;
    $history->current = $ooc->initiated_through_closure_ooc;
    $history->comment = $request->initiated_through_closure_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->initiated_through_hodreview_ooc != $ooc->initiated_through_hodreview_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'HOD Remarks';
    $history->previous = $lastDocumentOoc->initiated_through_hodreview_ooc;
    $history->current = $ooc->initiated_through_hodreview_ooc;
    $history->comment = $request->initiated_through_hodreview_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->initial_attachment_hodreview_ooc != $ooc->initial_attachment_hodreview_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'HOD Attachment';
    $history->previous = $lastDocumentOoc->initial_attachment_hodreview_ooc;
    $history->current = $ooc->initial_attachment_hodreview_ooc;
    $history->comment = $request->initial_attachment_hodreview_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->initiated_through_rootcause_ooc != $ooc->initiated_through_rootcause_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Root Cause Analysis';
    $history->previous = $lastDocumentOoc->initiated_through_rootcause_ooc;
    $history->current = $ooc->initiated_through_rootcause_ooc;
    $history->comment = $request->initiated_through_rootcause_ooc_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}

if ($lastDocumentOoc->initiated_through_impact_closure_ooc != $ooc->initiated_through_impact_closure_ooc) {
    $history = new OOCAuditTrail();
    $history->ooc_id = $id;
    $history->activity_type = 'Impact Assessment';
    $history->previous = $lastDocumentOoc->initiated_through_impact_closure_ooc;
    $history->current = $ooc->initiated_through_impact_closure_ooc;
    $history->comment = $request->initiated_through_impact_closure_ooc;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocumentOoc->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocumentOoc->status;
    // $history->action_name = "Update";
    $history->save();
}










// =============================================Update Grid ================================//
$oocGrid = $ooc->id;
// if($request->has('instrumentDetail')){
if (!empty($request->instrumentdetails)) {
$instrumentDetail = OOC_Grid::where(['ooc_id' => $oocGrid, 'identifier' => 'Instrument Details'])->firstOrNew();
$instrumentDetail->ooc_id = $oocGrid;
$instrumentDetail->identifier = 'Instrument Details';
$instrumentDetail->data = $request->instrumentdetails;
$instrumentDetail->save();
}

//    if($request->has('oocevoluation')){
if (!empty($request->instrumentdetails)) {

$oocevaluation = OOC_Grid::where(['ooc_id'=>$oocGrid,'identifier'=>'OOC Evaluation'])->firstOrNew();
$oocevaluation->ooc_id = $oocGrid;
$oocevaluation->identifier = 'OOC Evaluation';
$oocevaluation->data = $request->oocevoluation;
$oocevaluation->save();
}




//==============================================Update Grid ================================//













        toastr()->success('Record is updated Successfully');
        $ooc->update();
        // dd($ooc);

        $oocGrid = $ooc->id;
        $instrumentDetail = OOC_Grid::where(['ooc_id' => $oocGrid, 'identifier' => 'Instrument Details'])->firstOrNew();
        $instrumentDetail->ooc_id = $oocGrid;
        $instrumentDetail->identifier = 'Instrument Details';
        $instrumentDetail->data = $request->instrumentdetails;
        $instrumentDetail->save();





        //=====================Second Grid ===========================//






        //=====================Second Grid ===========================//


        return back();

    }


    private function generateResponseKey($question) {
        return str_replace(' ', '_', strtolower($question)) . '_response';
    }

    private function generateRemarkKey($question) {
        return str_replace(' ', '_', strtolower($question)) . '_remark';
    }

    public function OOCStateChange(Request $request,$id)
            {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $oocchange = OutOfCalibration::find($id);
            $lastDocumentOOC =  OutOfCalibration::find($id);
            // $ooc =  OutOfCalibration::find($id);

            if ($oocchange->stage == 1) {
                $oocchange->stage = "2";
                $oocchange->submitted_by = Auth::user()->name;
                $oocchange->submitted_on = Carbon::now()->format('d-M-Y');
                $oocchange->comment =$request->comment;
                $oocchange->status = "Pending Initial Assessment & Lab Investigation";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocumentOOC->submitted_by;
                $history->current = $oocchange->submitted_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Pending Incident Verification";
                $history->change_from = $lastDocumentOOC->status;
                $history->action_name = 'Submit';
                $history->stage='Submit';
                $history->save();

                $oocchange->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($oocchange->stage == 2) {
                $oocchange->stage = "3";
                $oocchange->initial_phase_i_investigation_completed_by= Auth::user()->name;
                $oocchange->initial_phase_i_investigation_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->initial_phase_i_investigation_comment =$request->comment;
                $oocchange->status = "Pending Initial Assessment & Lab Investigation";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocumentOOC->initial_phase_i_investigation_completed_by;
                $history->current = $oocchange->initial_phase_i_investigation_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Pending Initial Assessment & Lab Investigation";
                $history->change_from = $lastDocumentOOC->status;
                $history->stage='Initial Phase I Investigation';
                $history->action_name = 'Initial Phase I Investigation';
                $history->save();

                $oocchange->update();
                toastr()->success('Document Sent');
                return back();
            }
            

            if ($oocchange->stage == 3) {
                $oocchange->stage = "4";
                $oocchange->assignable_cause_f_completed_by= Auth::user()->name;
                $oocchange->assignable_cause_f_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->assignable_cause_f_completed_comment =$request->comment;
                $oocchange->status = "Under Stage I Correction";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocumentOOC->assignable_cause_f_completed_by;
                $history->current = $oocchange->assignable_cause_f_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Under Stage I Correction";
                $history->change_from = $lastDocumentOOC->status;
                $history->stage='Assignable Cause Found';
                $history->action_name = 'Assignable Cause Found';
                $history->save();

                $oocchange->update();
                toastr()->success('Document Sent');
                return back();
            }


            if ($oocchange->stage == 4) {
                $oocchange->stage = "12";
                $oocchange->correction_completed_by= Auth::user()->name;
                $oocchange->correction_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->correction_completed_comment =$request->comment;
                $oocchange->status = "To Pending Final Approval";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocumentOOC->correction_completed_by;
                $history->current = $oocchange->correction_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "To Pending Final Approval";
                $history->change_from = $lastDocumentOOC->status;
                $history->stage='Correction Completed';
                $history->action_name = 'Correction Completed';
                $history->save();

                $oocchange->update();
                toastr()->success('Document Sent');
                return back();
            }


            if ($oocchange->stage == 5) {
                $oocchange->stage = "7";
                $oocchange->obvious_r_n_completed_by= Auth::user()->name;
                $oocchange->obvious_r_n_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->cause_i_ncompleted_comment =$request->comment;
                $oocchange->status = "Under Stage II B Investigation";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocumentOOC->obvious_r_n_completed_by;
                $history->current = $oocchange->obvious_r_n_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Under Stage II B Investigation";
                $history->action_name = "Under Stage II B Investigation";
                $history->change_from = $lastDocumentOOC->status;
                $history->stage='Obvious Results Not Found';
                $history->save();

                $oocchange->update();
                toastr()->success('Document Sent');

                return back();
            }
            if ($oocchange->stage == 8) {
                $oocchange->stage = "12";
                $oocchange->correction_r_completed_by= Auth::user()->name;
                $oocchange->correction_r_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->correction_r_ncompleted_comment =$request->comment;
                $oocchange->status = "To Pending Final Approval";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocumentOOC->correction_r_completed_by;
                $history->current = $oocchange->correction_r_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "To Pending Final Approval";
                $history->action_name = "To Pending Final Approval";
                $history->change_from = $lastDocumentOOC->status;
                $history->stage='Correction Complete';
                $history->save();

                $oocchange->update();
                toastr()->success('Document Sent');

                return back();
            }
            if ($oocchange->stage == 7) {
                $oocchange->stage = "10";
                $oocchange->cause_i_completed_by= Auth::user()->name;
                $oocchange->cause_i_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->cause_i_ncompleted_comment =$request->comment;
                $oocchange->status = "Under Stage II A Correction";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocumentOOC->cause_i_completed_by;
                $history->current = $oocchange->cause_i_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Under Stage II A Correction";
                $history->action_name = "Under Stage II A Correction";
                $history->change_from = $lastDocumentOOC->status;
                $history->stage='Cause Identification';
                $history->save();

                $oocchange->update();
                toastr()->success('Document Sent');

                return back();
            }
            if ($oocchange->stage == 10) {
                $oocchange->stage = "12";
                $oocchange->correction_ooc_completed_by= Auth::user()->name;
                $oocchange->correction_ooc_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->correction_ooc_comment =$request->comment;
                $oocchange->status = "Peding Final Approval";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocumentOOC->correction_ooc_completed_by;
                $history->current = $oocchange->correction_ooc_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Peding Final Approval";
                $history->action_name = "Peding Final Approval";
                $history->change_from = $lastDocumentOOC->status;
                $history->stage='Correction Complete';
                $history->save();

                $oocchange->update();
                toastr()->success('Document Sent');

                return back();
            }
            if ($oocchange->stage == 12) {
                $oocchange->stage = "13";
                $oocchange->approved_ooc_completed_by= Auth::user()->name;
                $oocchange->approved_ooc_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->approved_ooc_comment =$request->comment;
                $oocchange->status = "Closed-Done";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocumentOOC->approved_ooc_completed_by;
                $history->current = $oocchange->approved_ooc_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Closed-Done";
                $history->action_name = "Closed-Done";
                $history->change_from = $lastDocumentOOC->status;
                $history->stage='Approved';
                $history->save();

                $oocchange->update();
                toastr()->success('Document Sent');

                return back();
            }






        }
        else {
            toastr()->error('E-signature Not match');
            return back();
        }

            }
public function OOCStateChangetwo(Request $request , $id){

   if( $request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)){
        $oocchange = OutOfCalibration::find($id);
        $lastDocumentOOC =  OutOfCalibration::find($id);
        $ooc =  OutOfCalibration::find($id);

        if ($oocchange->stage == 3) {
            $oocchange->stage = "5";
            $oocchange->assignable_cause_f_n_completed_by= Auth::user()->name;
            $oocchange->assignable_cause_f_n_completed_on = Carbon::now()->format('d-M-Y');
            $oocchange->assignable_cause_f__ncompleted_comment =$request->comment;
            $oocchange->status = "Under Stage II A Investigation";
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = $lastDocumentOOC->assignable_cause_f_n_completed_by;
            $history->current = $oocchange->assignable_cause_f_n_completed_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOOC->status;
            $history->change_to = "Under Stage II A Investigation";
            $history->change_from = $lastDocumentOOC->status;
            $history->stage='Assignable Cause Not Found';
            $history->save();

            $oocchange->update();
            toastr()->success('Document Sent');

            return back();
        }





        if ($oocchange->stage == 4) {
            $oocchange->stage = "5";
            $oocchange->cause_f_completed_by= Auth::user()->name;
            $oocchange->cause_f_completed_on = Carbon::now()->format('d-M-Y');
            $oocchange->cause_f_completed_comment =$request->comment;
            $oocchange->status = "Under Stage II A Investigation";
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = $lastDocumentOOC->cause_f_completed_by;
            $history->current = $oocchange->cause_f_completed_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOOC->status;
            $history->change_to = "Under Stage II A Investigation";
            $history->change_from = $lastDocumentOOC->status;
            $history->stage='Cause Failed';
            $history->save();

            $oocchange->update();
            toastr()->success('Document Sent');
            return redirect()->back();
        }

        if ($oocchange->stage == 5) {
            $oocchange->stage = "8";
            $oocchange->obvious_r_completed_by= Auth::user()->name;
            $oocchange->obvious_r_completed_on = Carbon::now()->format('d-M-Y');
            $oocchange->obvious_r_ncompleted_comment =$request->comment;
            $oocchange->status = "Under Stage II A Correction";
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = $lastDocumentOOC->obvious_r_completed_by;
            $history->current = $oocchange->obvious_r_completed_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOOC->status;
            $history->change_to = "Under Stage II A Correction";
            $history->change_from = $lastDocumentOOC->status;
            $history->stage='Obvious Results Found';
            $history->save();

            $oocchange->update();
            toastr()->success('Document Sent');

            return back();
        }

        if ($oocchange->stage == 7) {
            $oocchange->stage = "11";
            $oocchange->cause_n_i_completed_by= Auth::user()->name;
            $oocchange->cause_n_i_completed_on = Carbon::now()->format('d-M-Y');
            $oocchange->cause_n_i_completed_comment =$request->comment;
            $oocchange->status = "Discussion With Manufacturing QA";
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = $lastDocumentOOC->cause_n_i_completed_by;
            $history->current = $oocchange->cause_n_i_completed_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOOC->status;
            $history->change_to = "Discussion With Manufacturing QA";
            $history->change_from = $lastDocumentOOC->status;
            $history->stage='Cause Not Identified';
            $history->save();

            $oocchange->update();
            toastr()->success('Document Sent');

            return back();
        }

        if ($oocchange->stage == 11) {
            $oocchange->stage = "12";
            $oocchange->qareview_ooc_completed_by= Auth::user()->name;
            $oocchange->qareview_ooc_completed_on = Carbon::now()->format('d-M-Y');
            $oocchange->qareview_ooc_comment =$request->comment;
            $oocchange->status = "Peding Final Approval";
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = $lastDocumentOOC->qareview_ooc_completed_by;
            $history->current = $oocchange->qareview_ooc_completed_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOOC->status;
            $history->change_to = "Peding Final Approval";
            $history->change_from = $lastDocumentOOC->status;
            $history->stage='QA Review Complete';
            $history->save();

            $oocchange->update();
            toastr()->success('Document Sent');

            return back();
        }



    }
    else {
        toastr()->error('E-signature Not match');
        return back();
    }

}
public function RejectoocStateChange(Request $request, $id)
{
    if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
        $ooc = OutOfCalibration::find($id);


        if ($ooc->stage == 2) {
            $ooc->stage = "1";
            $ooc->status = "Opened";
            $ooc->update();
            toastr()->success('Document Sent');
            return back();
        }

        if ($ooc->stage == 3) {
            $ooc->stage = "2";
            $ooc->status = "Pending Initial Assessment & Lab Investigation";
            $ooc->update();
            toastr()->success('Document Sent');
            return back();
        }
        if ($ooc->stage == 8) {
            $ooc->stage = "7";
            $ooc->status = "Under Stage II B Investigation";
            $ooc->update();
            toastr()->success('Document Sent');
            return back();
        }
}
else {
    toastr()->error('E-signature Not match');
    return back();
}
}






public function OOCAuditTrial($id){
    $auditrecord = OutOfCalibration::find($id);
    $audit = OOCAuditTrail::where('ooc_id',$id)->orderByDesc('id')->paginate();
    $today = Carbon::now()->format('d-m-y');
    $document = OOCAuditTrail::where('ooc_id',$id)->first();
    $auditrecord->initiator = User::where('id',$auditrecord->initiator_id)->value('name');

    return view('frontend.OOC.audit-trail',compact('audit','document','today','auditrecord'));


}
    public function OOCStateCancel(Request $request , $id){
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $ooc = OutOfCalibration::find($id);

            $ooc->stage = "0";
            $ooc->status = "Closed - Cancelled";
            $ooc->cancelled_by = Auth::user()->name;
            $ooc->cancelled_on = Carbon::now()->format('d-M-Y');
            $ooc->cancell_comment =$request->comment;
            $ooc->update();
            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }

    }
    public function OOCChildRoot(Request $request ,$id)
    {
        $cc = OutOfCalibration::find($id);
               $cft = [];
               $parent_id = $id;
               $parent_type = "Capa";
               $old_record = Capa::select('id', 'division_id', 'record')->get();
               $record_number = ((RecordNumber::first()->value('counter')) + 1);
               $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
               $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
               $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
               $currentDate = Carbon::now();
               $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
               $parent_initiator_id = $id;


               $formattedDate = $currentDate->addDays(30);
               $due_date = $formattedDate->format('d-M-Y');
               $oocOpen = OpenStage::find(1);
               if (!empty($oocOpen->cft)) $cft = explode(',', $oocOpen->cft);


               if ($request->revision == "capa-child") {
                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                return view('frontend.forms.capa', compact('record_number', 'due_date', 'parent_id', 'parent_type', 'old_record', 'cft'));
                }

               if ($request->revision == "Action-Item") {
                   $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                   return view('frontend.forms.action-item', compact('record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));
               }



    }
    public function oo_c_capa_child(Request $request ,$id)
    {
        $cc = OutOfCalibration::find($id);
               $cft = [];
               $parent_id = $id;
               $parent_type = "Capa";
               $currentDate = Carbon::now();
               $formattedDate = $currentDate->addDays(30);
               $due_date= $formattedDate->format('d-M-Y');
               $old_record = Capa::select('id', 'division_id', 'record')->get();
               $record_number = ((RecordNumber::first()->value('counter')) + 1);
               $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
               $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
               $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
               $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
               $parent_initiator_id = $id;


               $formattedDate = $currentDate->addDays(30);
               $due_date = $formattedDate->format('d-M-Y');
               $oocOpen = OpenStage::find(1);
               if (!empty($oocOpen->cft)) $cft = explode(',', $oocOpen->cft);


               if ($request->revision == "extension-child") {
                    $parent_due_date = "";
                    $parent_id = $id;
                    $parent_name = $request->parent_name;
                    if ($request->due_date) {
                   $parent_due_date = $request->due_date;
                                             }


                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                return view('frontend.forms.extension', compact('parent_id', 'parent_name', 'record_number', 'parent_due_date'));

            }

               if ($request->revision == "risk-Item") {
                   $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                   return view('frontend.forms.risk-management', compact('record_number', 'due_date', 'parent_id','old_record', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));

               }
    }

    public function auditDetailsooc($id){

        $detail = OOCAuditTrail::find($id);

        $detail_data = OOCAuditTrail::where('activity_type', $detail->activity_type)->where('ooc_id', $detail->ooc_id)->latest()->get();

        $doc = OOCAuditTrail::where('id', $detail->ooc_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);

        return view('frontend.OOC.audit-trial-inner', compact('detail', 'doc', 'detail_data'));


    }
    public function auditReportooc($id)
    {
        $doc = OutOfCalibration::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $data = OOCAuditTrail::where('ooc_id', $id)->get();


            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.OOC.auditReport', compact('data', 'doc'))
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
            return $pdf->stream('OOC-AuditTrial' . $id . '.pdf');
        }

    }



    public function singleReports(Request $request, $id){
        $ooc = OutOfCalibration::where('id', $id)->first();
        $ooc->record = str_pad($ooc->record, 4, '0', STR_PAD_LEFT);
        $ooc->assign_to_name = User::where('id', $ooc->assign_id)->value('name');
        $ooc->initiator_name = User::where('id', $ooc->initiator_id)->value('name');
        $data = OutOfCalibration::find($id);
        $oocgrid = OOC_Grid::where('ooc_id',$id)->first();
        $oocevolution = OOC_Grid::where(['ooc_id'=>$id, 'identifier'=>'OOC Evaluation'])->first();
        if (!empty($data)) {

            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.OOC.ooc_singleReport', compact('data','oocgrid','oocevolution','ooc'))
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
            return $pdf->stream('OOC' . $id . '.pdf');
        }
    }

}
