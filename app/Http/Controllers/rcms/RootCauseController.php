<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\RecordNumber;
use App\Models\RootAuditTrial;
use App\Models\RoleGroup;
use App\Models\RiskAssesmentGrid;
use App\Models\RootCauseAnalysis;
use App\Models\RootCauseAnalysesGrid;
use App\Models\RootCauseAnalysisHistory;
use App\Models\User;
use Helpers;
use Illuminate\Support\Facades\Mail;
use App\Models\RootcauseAnalysisDocDetails;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

 class RootCauseController extends Controller
{
    public function rootcause()
    {
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        return view("frontend.forms.root-cause-analysis", compact('due_date', 'record_number'));
    }
    public function root_store(Request $request)
    { 
        if (!$request->short_description) {
           toastr()->error("Short description is required");
             return redirect()->back();
        }
        $root = new RootCauseAnalysis();
        $root->form_type = "Root-cause-analysis"; 
        $openState->parent_id = $request->parent_id;
        $openState->parent_type = $request->parent_type;
        $root->originator_id = $request->originator_id;
        $root->date_opened = $request->date_opened;
        $root->division_id = $request->division_id;
        $root->priority_level = $request->priority_level;
        $root->severity_level = $request->severity_level;
        $root->short_description =($request->short_description);
        $root->assigned_to = $request->assigned_to;
        $root->assign_to = $request->assign_to;
        $root->root_cause_description = $request->root_cause_description;
        $root->due_date = $request->due_date;
        $root->cft_comments_new = $request->cft_comments_new;
         $root->Type= $request->Type;
        
         $root->investigators = $request->investigators;
        // $root->investigators = implode(',', $request->investigators);
        $root->initiated_through = $request->initiated_through;
        $root->initiated_if_other = $request->initiated_if_other;
        $root->department = $request->department;
        $root->description = ($request->description);
        $root->comments = ($request->comments);
        $root->related_url = ($request->related_url);
        $root->root_cause_methodology = implode(',', $request->root_cause_methodology);
        //Fishbone or Ishikawa Diagram 
        if (!empty($request->measurement  )) {
            $root->measurement = serialize($request->measurement);
        }
        if (!empty($request->materials  )) {
            $root->materials = serialize($request->materials);
        }
        if (!empty($request->environment  )) {
            $root->environment = serialize($request->environment);
        }
        if (!empty($request->manpower  )) {
            $root->manpower = serialize($request->manpower);
        }
        if (!empty($request->machine  )) {
            $root->machine = serialize($request->machine);
        }
        if (!empty($request->methods)) {
            $root->methods = serialize($request->methods);
        }
        $root->problem_statement = ($request->problem_statement);
        // Why-Why Chart (Launch Instruction) Problem Statement 
        if (!empty($request->why_problem_statement)) {
            $root->why_problem_statement = $request->why_problem_statement;
        }
        if (!empty($request->why_1  )) {
            $root->why_1 = serialize($request->why_1);
        }
        if (!empty($request->why_2  )) {
            $root->why_2 = serialize($request->why_2);
        }
        if (!empty($request->why_3  )) {
            $root->why_3 = serialize($request->why_3);
        }
        if (!empty($request->why_4 )) {
            $root->why_4 = serialize($request->why_4);
        }
        if (!empty($request->why_5  )) {
            $root->why_5 = serialize($request->why_5);
        }
        if (!empty($request->why_root_cause)) {
            $root->why_root_cause = $request->why_root_cause;
        }

        // Is/Is Not Analysis (Launch Instruction)
        $root->what_will_be = ($request->what_will_be);
        $root->what_will_not_be = ($request->what_will_not_be);
        $root->what_rationable = ($request->what_rationable);

        $root->where_will_be = ($request->where_will_be);
        $root->where_will_not_be = ($request->where_will_not_be);
        $root->where_rationable = ($request->where_rationable);

        $root->when_will_be = ($request->when_will_be);
        $root->when_will_not_be = ($request->when_will_not_be);
        $root->when_rationable = ($request->when_rationable);

        $root->coverage_will_be = ($request->coverage_will_be);
        $root->coverage_will_not_be = ($request->coverage_will_not_be);
        $root->coverage_rationable = ($request->coverage_rationable);

        $root->who_will_be = ($request->who_will_be);
        $root->who_will_not_be = ($request->who_will_not_be);
        $root->who_rationable = ($request->who_rationable);
        
        $root->investigation_summary = ($request->investigation_summary);
        // $root->zone = ($request->zone);
        // $root->country = ($request->country);
        // $root->state = ($request->state);
        // $root->city = ($request->city);
        $root->submitted_by = ($request->submitted_by);

        if (!empty($request->Root_Cause_Category  )) {
            $root->Root_Cause_Category = serialize($request->Root_Cause_Category);
        }
        if (!empty($request->Root_Cause_Sub_Category)) {
            $root->Root_Cause_Sub_Category= serialize($request->Root_Cause_Sub_Category);
        }
        if (!empty($request->Probability)) {
            $root->Probability = serialize($request->Probability);
        }
        if (!empty($request->Remarks)) {
            $root->Remarks = serialize($request->Remarks);
        }

        if (!empty($request->initial_rpn)) {
            $root->initial_rpn = serialize($root->initial_rpn);
        }

        $root->record = ((RecordNumber::first()->value('counter')) + 1);
        $root->initiator_id = Auth::user()->id;
        $root->division_code = $request->division_code;
        $root->intiation_date = $request->intiation_date;
        $root->initiator_Group = $request->initiator_Group;
        $root->initiator_group_code = $request->initiator_group_code;
        $root->short_description = $request->short_description;
        $root->due_date = $request->due_date;
        $root->assign_to = $request->assign_to;
        $root->Sample_Types = $request->Sample_Types;
        if (!empty($request->root_cause_initial_attachment)) {
            $files = [];
            if ($request->hasfile('root_cause_initial_attachment')) {
                foreach ($request->file('root_cause_initial_attachment') as $file) {
                    $name = $request->name . 'root_cause_initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $root->root_cause_initial_attachment = json_encode($files);
        }
        if (!empty($request->cft_attchament_new)) {
            $files = [];
            if ($request->hasfile('cft_attchament_new')) {
                foreach ($request->file('cft_attchament_new') as $file) {
                    $name = $request->name . 'cft_attchament_new' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $root->cft_attchament_new = json_encode($files);
        }
        
        //Failure Mode and Effect Analysis+

        if (!empty($request->risk_factor)) {
            $root->risk_factor = serialize($request->risk_factor);
        }
        if (!empty($request->risk_element)) {
            $root->risk_element = serialize($request->risk_element);
        }
        if (!empty($request->problem_cause)) {
            $root->problem_cause = serialize($request->problem_cause);
        }
        if (!empty($request->existing_risk_control)) {
            $root->existing_risk_control = serialize($request->existing_risk_control);
        }
        if (!empty($request->initial_severity)) {
            $root->initial_severity = serialize($request->initial_severity);
        }
        if (!empty($request->initial_detectability)) {
            $root->initial_detectability = serialize($request->initial_detectability);
        }
        if (!empty($request->initial_probability)) {
            $root->initial_probability = serialize($request->initial_probability);
        }
        if (!empty($request->initial_rpn)) {
            $root->initial_rpn = serialize($request->initial_rpn);
        }
        if (!empty($request->risk_acceptance)) {
            $root->risk_acceptance = serialize($request->risk_acceptance);
        }
        if (!empty($request->risk_control_measure)) {
            $root->risk_control_measure = serialize($request->risk_control_measure);
        }
        if (!empty($request->residual_severity)) {
            $root->residual_severity = serialize($request->residual_severity);
        }
        if (!empty($request->residual_probability)) {
            $root->residual_probability = serialize($request->residual_probability);
        }
        if (!empty($request->residual_detectability)) {
            $root->residual_detectability = serialize($request->residual_detectability);
        }
        if (!empty($request->residual_rpn)) {
            $root->residual_rpn = serialize($request->residual_rpn);
        }
        if (!empty($request->risk_acceptance2)) {
            $root->risk_acceptance2 = serialize($request->risk_acceptance2);
        }
        if (!empty($request->mitigation_proposal)) {
            $root->mitigation_proposal = serialize($request->mitigation_proposal);
        }

        $root->status = 'Opened';
        $root->stage = 1;
        $root->save();
        // -------------------------------------------------------
        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();
        
        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Division Code';
        $history->previous = "Null";
        $history->current = $root->division_code;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->save();

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Initiator Group';
        $history->previous = "Null";
        $history->current = $root->initiator_Group;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->save();

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Short Description';
        $history->previous = "Null";
        $history->current = $root->short_description;
        $history->comment = "Null";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->save();

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Assign Id';
        $history->previous = "Null";
        $history->current = $root->assign_to;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->save();

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Sample Types';
        $history->previous = "Null";
        $history->current = $root->Sample_Types;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->save();
 

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Investigators';
        $history->previous = "Null";
        $history->current = $root->investigators;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->save();

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Attachments';
        $history->previous = "Null";
        $history->current = empty($root->cft_attchament_new) ? null : $root->cft_attchament_new;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->save();

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Comments';
        $history->previous = "Null";
        $history->current = $root->comments;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->save();

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Lab Inv Concl';
        $history->previous = "Null";
        $history->current = $root->lab_inv_concl;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->save();

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'lab Inv Attach';
        $history->previous = "Null";
        $history->current = $root->lab_inv_attach;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->save();

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Qc Head Comments';
        $history->previous = "Null";
        $history->current = $root->qc_head_comments;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->save();

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Inv Attach';
        $history->previous = "Null";
        $history->current = $root->inv_attach;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->save();

        if (!empty($root->due_date)) {
        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Due Date';
        $history->previous = "Null";
        $history->current = $root->due_date;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->save();

        }
        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }
    public function root_update(Request $request, $id)
    {
        if (!$request->short_description) {
            toastr()->error("Short description is required");
            return redirect()->back();
        }
        $lastDocument =  RootCauseAnalysis::find($id);
        $root =  RootCauseAnalysis::find($id);
        $root->initiator_Group = $request->initiator_Group;
        $root->initiated_through = $request->initiated_through;
        $root->initiated_if_other = ($request->initiated_if_other);
        $root->short_description = $request->short_description;
        $root->due_date = $request->due_date;
        $root->severity_level= $request->severity_level;
        $root->Type= ($request->Type);
        $root->priority_level = ($request->priority_level);
        $root->department = ($request->department);
        $root->description = ($request->description);
        $root->investigation_summary = ($request->investigation_summary);
        $root->root_cause_description = ($request->root_cause_description);
        $root->cft_comments_new = ($request->cft_comments_new);
       
         $root->investigators = ($request->investigators);
        $root->related_url = ($request->related_url);
        // $root->investigators = implode(',', $request->investigators);
        $root->root_cause_methodology = implode(',', $request->root_cause_methodology);
        // $root->country = ($request->country);
        $root->assign_to = $request->assign_to;
        $root->Sample_Types = $request->Sample_Types;
         
        // Root Cause +
        if (!empty($request->Root_Cause_Category  )) {
            $root->Root_Cause_Category = serialize($request->Root_Cause_Category);
        }
        if (!empty($request->Root_Cause_Sub_Category)) {
            $root->Root_Cause_Sub_Category= serialize($request->Root_Cause_Sub_Category);
        }
        if (!empty($request->Probability)) {
            $root->Probability = serialize($request->Probability);
        }
        if (!empty($request->Remarks)) {
            $root->Remarks = serialize($request->Remarks);
        }
        if (!empty($request->why_problem_statement)) {
            $root->why_problem_statement = $request->why_problem_statement;
        } 
        if (!empty($request->why_1  )) {
            $root->why_1 = serialize($request->why_1);
        }
        if (!empty($request->why_2  )) {
            $root->why_2 = serialize($request->why_2);
        }
        if (!empty($request->why_3  )) {
            $root->why_3 = serialize($request->why_3);
        }
        if (!empty($request->why_4 )) {
            $root->why_4 = serialize($request->why_4);
        }
        if (!empty($request->why_5  )) {
            $root->why_5 = serialize($request->why_5);
        }
        if (!empty($request->why_root_cause)) {
            $root->why_root_cause = $request->why_root_cause;
        }

         // Is/Is Not Analysis (Launch Instruction)
         $root->what_will_be = ($request->what_will_be);
         $root->what_will_not_be = ($request->what_will_not_be);
         $root->what_rationable = ($request->what_rationable);
 
         $root->where_will_be = ($request->where_will_be);
         $root->where_will_not_be = ($request->where_will_not_be);
         $root->where_rationable = ($request->where_rationable);
 
         $root->when_will_be = ($request->when_will_be);
         $root->when_will_not_be = ($request->when_will_not_be);
         $root->when_rationable = ($request->when_rationable);
 
         $root->coverage_will_be = ($request->coverage_will_be);
         $root->coverage_will_not_be = ($request->coverage_will_not_be);
         $root->coverage_rationable = ($request->coverage_rationable);
 
         $root->who_will_be = ($request->who_will_be);
         $root->who_will_not_be = ($request->who_will_not_be);
         $root->who_rationable = ($request->who_rationable);
         
        if (!empty($request->root_cause_initial_attachment)) {
            $files = [];
            if ($request->hasfile('root_cause_initial_attachment')) {
                foreach ($request->file('root_cause_initial_attachment') as $file) {
                    $name = $request->name . 'root_cause_initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $root->root_cause_initial_attachment = json_encode($files);
        }

        if (!empty($request->cft_attchament_new)) {
            $files = [];
            if ($request->hasfile('cft_attchament_new')) {
                foreach ($request->file('cft_attchament_new') as $file) {
                    $name = $request->name . 'cft_attchament_new' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $root->cft_attchament_new = json_encode($files);
        }

        
        // $root->investigators = json_encode($request->investigators);
        $root->submitted_by = $request->submitted_by;
        
        $root->comments = $request->comments;
        $root->lab_inv_concl = $request->lab_inv_concl;
        //Failure Mode and Effect Analysis+

        if (!empty($request->risk_factor)) {
            $root->risk_factor = serialize($request->risk_factor);
        }
        if (!empty($request->risk_element)) {
            $root->risk_element = serialize($request->risk_element);
        }
        if (!empty($request->problem_cause)) {
            $root->problem_cause = serialize($request->problem_cause);
        }
        if (!empty($request->existing_risk_control)) {
            $root->existing_risk_control = serialize($request->existing_risk_control);
        }
        if (!empty($request->initial_severity)) {
            $root->initial_severity = serialize($request->initial_severity);
        }
        if (!empty($request->initial_detectability)) {
            $root->initial_detectability = serialize($request->initial_detectability);
        }
        if (!empty($request->initial_probability)) {
            $root->initial_probability = serialize($request->initial_probability);
        }
        if (!empty($request->initial_rpn)) {
            $root->initial_rpn = serialize($request->initial_rpn);
        }
        if (!empty($request->risk_acceptance)) {
            $root->risk_acceptance = serialize($request->risk_acceptance);
        }
        if (!empty($request->risk_control_measure)) {
            $root->risk_control_measure = serialize($request->risk_control_measure);
        }
        if (!empty($request->residual_severity)) {
            $root->residual_severity = serialize($request->residual_severity);
        }
        if (!empty($request->residual_probability)) {
            $root->residual_probability = serialize($request->residual_probability);
        }
        if (!empty($request->residual_detectability)) {
            $root->residual_detectability = serialize($request->residual_detectability);
        }
        if (!empty($request->residual_rpn)) {
            $root->residual_rpn = serialize($request->residual_rpn);
        }
        if (!empty($request->risk_acceptance2)) {
            $root->risk_acceptance2 = serialize($request->risk_acceptance2);
        }
        if (!empty($request->mitigation_proposal)) {
            $root->mitigation_proposal = serialize($request->mitigation_proposal);
        }

        // Fishbone or Ishikawa Diagram +  (Launch Instruction)

        if (!empty($request->measurement)) {
            $root->measurement = serialize($request->measurement);
        }
        if (!empty($request->materials)) {
            $root->materials = serialize($request->materials);
        }
        if (!empty($request->methods)) {
            $root->methods = serialize($request->methods);
        }
        if (!empty($request->environment)) {
            $root->environment = serialize($request->environment);
        }
        if (!empty($request->manpower)) {
            $root->manpower = serialize($request->manpower);
        }
        if (!empty($request->machine)) {
            $root->machine = serialize($request->machine);
        }
        if (!empty($request->problem_statement)) {
            $root->problem_statement = $request->problem_statement;
        }
        $root->update(); 

        if ($lastDocument->division_code != $root->division_code || !empty($request->division_code_comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Division Code';
            $history->previous = $lastDocument->division_code;
            $history->current = $root->division_code;
            $history->comment = $request->division_code_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->initiator_Group != $root->initiator_Group || !empty($request->initiator_Group_comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Initiator Group';
            $history->previous = $lastDocument->initiator_Group;
            $history->current = $root->initiator_Group;
            $history->comment = $request->initiator_Group_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->short_description != $root->short_description || !empty($request->short_description_comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastDocument->short_description;
            $history->current = $root->short_description;
            $history->comment = $request->short_description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->assign_to != $root->assign_to || !empty($request->assign_to_comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Assign Id';
            $history->previous = $lastDocument->assign_to;
            $history->current = $root->assign_to;
            $history->comment = $request->assign_to_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Sample_Types != $root->Sample_Types || !empty($request->Sample_Types_comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Sample Types';
            $history->previous = $lastDocument->Sample_Types;
            $history->current = $root->Sample_Types;
            $history->comment = $request->Sample_Types_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->investigators != $root->investigators || !empty($request->investigators_comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Investigators';
            $history->previous = $lastDocument->investigators;
            $history->current = $root->investigators;
            $history->comment = $request->investigators_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->cft_attchament_new != $root->cft_attchament_new || !empty($request->cft_attchament_new)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Attachments';
            $history->previous = $lastDocument->attachments;
            $history->current = $root->attachments;
            $history->comment = $request->attachments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->comments != $root->comments || !empty($request->comments_comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Comments';
            $history->previous = $lastDocument->comments;
            $history->current = $root->comments;
            $history->comment = $request->comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->lab_inv_concl != $root->lab_inv_concl || !empty($request->lab_inv_concl_comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Lab Inv Concl';
            $history->previous = $lastDocument->lab_inv_concl;
            $history->current = $root->lab_inv_concl;
            $history->comment = $request->lab_inv_concl_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->lab_inv_attach != $root->lab_inv_attach || !empty($request->lab_inv_attach_comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'lab Inv Attach';
            $history->previous = $lastDocument->lab_inv_attach;
            $history->current = $root->lab_inv_attach;
            $history->comment = $request->lab_inv_attach_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->qc_head_comments != $root->qc_head_comments || !empty($request->qc_head_comments_comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Qc Head Comments';
            $history->previous = $lastDocument->qc_head_comments;
            $history->current = $root->qc_head_comments;
            $history->comment = $request->qc_head_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->inv_attach != $root->inv_attach || !empty($request->inv_attachcomment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Inv Attach';
            $history->previous = $lastDocument->inv_attach;
            $history->current = $root->inv_attach;
            $history->comment = $request->inv_attach_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->due_date != $root->due_date || !empty($request->due_date_comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Due Date';
            $history->previous = $lastDocument->due_date;
            $history->current = $root->due_date;
            $history->comment = $request->due_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->due_date != $root->due_date || !empty($request->due_date_comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Due Date';
            $history->previous = $lastDocument->due_date;
            $history->current = $root->due_date;
            $history->comment = $request->due_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        toastr()->success("Record is update Successfully");
        return back();
    }
    public function root_show($id)
    {
        $data = RootCauseAnalysis::find($id);
        if(empty($data)) {
            toastr()->error('Invalid ID.');
            return back();
        }
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_to)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
          return view('frontend.root-cause-analysis.root_cause_analysisView', compact(
            'data'
        ));
    }

    public function root_send_stage(Request $request, $id)
    {


        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $root = RootCauseAnalysis::find($id);
            $lastDocument =  RootCauseAnalysis::find($id);

            if ($root->stage == 1) {
                $root->stage = "2";
                $root->status = "Investigation in Progress";
                $root->acknowledge_by= Auth::user()->name;
                $root->acknowledge_on= Carbon::now()->format('d-M-Y');
                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocument->acknowledge_by;
                $history->current = $root->acknowledge_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='Acknowledge';

                $history->save();
            //     $list = Helpers::getQAUserList();
            //     foreach ($list as $u) {
            //         if($u->q_m_s_divisions_id == $root->division_id){
            //             $email = Helpers::getInitiatorEmail($u->user_id);
            //              if ($email !== null) {
                        
                      
            //               Mail::send(
            //                   'mail.view-mail',
            //                    ['data' => $root],
            //                 function ($message) use ($email) {
            //                     $message->to($email)
            //                         ->subject("Document sent ".Auth::user()->name);
            //                 }
            //               );
            //             }
            //      } 
            //   }
                $root->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($root->stage == 2) {
                $root->stage = "3";
                $root->status = 'Pending Group Review Discussion';
                $root->submitted_by = Auth::user()->name;
                $root->submitted_on = Carbon::now()->format('d-M-Y');
                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocument->submitted_by;
                $history->current = $root->submitted_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='Submited';

                $history->save();
                $root->update();
                toastr()->success('Document Sent');
                return back();
            }
            // if ($root->stage == 3) {
            //     $root->stage = "4";
            //     $root->status = "Pending Group Review";
            //     $root->report_result_by = Auth::user()->name;
            //     $root->report_result_on = Carbon::now()->format('d-M-Y');
            //     $root->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            if ($root->stage == 4) {
                $root->stage = "5";
                $root->status = 'Pending QA Review';
                $root->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($root->stage == 3) {
                $root->stage = "6";
                $root->status = "Closed - Done";
                $root->qA_review_complete_by = Auth::user()->name;
                $root->qA_review_complete_on = Carbon::now()->format('d-M-Y');
                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocument->qA_review_complete_by;
                $history->current = $root->qA_review_complete_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='QA Review Complete';
                $history->save();

                $root->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($root->stage == 5) {
                $root->stage = "6";
                $root->status = "Closed - Done";
                $root->evaluation_complete_by = Auth::user()->name;
                $root->evaluation_complete_on = Carbon::now()->format('d-M-Y');
                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocument->evaluation_complete_by;
                $history->current = $root->evaluation_complete_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                // $history->origin_state = $lastDocument->status;
                $history->stage='Completed';
                $history->save();
                $root->update();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function root_Cancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $root = RootCauseAnalysis::find($id);
            $lastDocument =  RootCauseAnalysis::find($id);
            $data =  RootCauseAnalysis::find($id);

            $root->stage = "0";
            $root->status = "Closed-Cancelled";
            $root->cancelled_by = Auth::user()->name;
            $root->cancelled_on = Carbon::now()->format('d-M-Y');
            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Activity Log';
            // $history->previous = $lastDocument->cancelled_by;
            $history->current = $root->cancelled_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->origin_state = $lastDocument->status;
            $history->stage='Cancelled ';
            $history->save();
        //     $list = Helpers::getQAUserList();
        //     foreach ($list as $u) {
        //         if($u->q_m_s_divisions_id == $root->division_id){
        //             $email = Helpers::getInitiatorEmail($u->user_id);
        //              if ($email !== null) {
                  
        //               Mail::send(
        //                   'mail.view-mail',
        //                    ['data' => $root],
        //                 function ($message) use ($email) {
        //                     $message->to($email)
        //                         ->subject("Document sent ".Auth::user()->name);
        //                 }
        //               );
        //             }
        //      } 
        //   }
            $root->update();
            $history = new RootCauseAnalysisHistory();
            $history->type = "Root Cause Analysis";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $root->stage;
            $history->status = $root->status;
            $history->save();
            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function root_reject(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $capa = RootCauseAnalysis::find($id);

            if ($capa->stage == 3) {
                $capa->stage = "2";
                $capa->status = "Investigation in Progress";
                $capa->update();

                toastr()->success('Document Sent');
                return back();
            }
            if ($capa->stage == 5) {
                $capa->stage = "2";
                $capa->status = "Investigation in Progress";
                $capa->update();

                toastr()->success('Document Sent');
                return back();
            }
            if ($capa->stage == 4) {
                $capa->stage = "2";
                $capa->status = "Investigation in Progress";
                $capa->update();

                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function rootAuditTrial($id)
    {
        $audit = RootAuditTrial::where('root_id', $id)->orderByDESC('id')->get()->unique('activity_type');
        $today = Carbon::now()->format('d-m-y');
        $document = RootCauseAnalysis::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');

        return view("frontend.root-cause-analysis.root-audit-trail", compact('audit', 'document', 'today'));
    }

    public function auditDetailsroot($id)
    {

        $detail = RootAuditTrial::find($id);

        $detail_data = RootAuditTrial::where('activity_type', $detail->activity_type)->where('root_id', $detail->root_id)->latest()->get();

        $doc = RootCauseAnalysis::where('id', $detail->root_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);
        return view("frontend.root-cause-analysis.root-audit-trial-inner", compact('detail', 'doc', 'detail_data'));
    }

    public static function singleReport($id)
    {    
        $data = RootCauseAnalysis::find($id);
        if (!empty($data)) {
            $data->originator_id = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.root-cause-analysis.singleReport', compact('data'))
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
            return $pdf->stream('Root-cause' . $id . '.pdf');
        }
    }

    public static function auditReport($id)
    {
        $doc = RootCauseAnalysis::find($id);
        if (!empty($doc)) {
            $doc->originator_id = User::where('id', $doc->initiator_id)->value('name');
            $data = RootAuditTrial::where('root_id', $id)->get();
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.root-cause-analysis.auditReport', compact('data', 'doc'))
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
            return $pdf->stream('Root-Audit' . $id . '.pdf');
        }
    }
}
