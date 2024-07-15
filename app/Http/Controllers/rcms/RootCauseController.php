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
        $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = str_pad($record, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        return view("frontend.forms.root-cause-analysis", compact('due_date', 'record'));
    }
    public function root_store(Request $request)
    { 

    //  dd($request->all());

        $lastDocument='Null';
        if (!$request->short_description) {
           toastr()->error("Short description is required");
             return redirect()->back();
        }
        $root = new RootCauseAnalysis();
        $root->form_type = "Root-cause-analysis"; 
        $root->parent_id = $request->parent_id;
        $root->parent_type = $request->parent_type;
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
        // $root->department = $request->department;
        $root->department = implode(',', $request->departments);
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
      
        
        //observation changes
        $root->objective = $request->objective;
        $root->scope = $request->scope;
        $root->problem_statement_rca = $request->problem_statement_rca;
        $root->requirement = $request->requirement;
        $root->immediate_action = $request->immediate_action;
        $root->investigation_team = $request->investigation_team;
        $root->investigation_tool = $request->investigation_tool;
        $root->root_cause = $request->root_cause;

        $root->impact_risk_assessment = $request->impact_risk_assessment;
        $root->capa = $request->capa;
        $root->root_cause_description_rca = $request->root_cause_description_rca;
        $root->investigation_summary_rca = $request->investigation_summary_rca;
     
        $root->qa_reviewer = $request->qa_reviewer;

        if (!empty($request->root_cause_initial_attachment_rca)) {
            $files = [];
            if ($request->hasfile('root_cause_initial_attachment_rca')) {
                foreach ($request->file('root_cause_initial_attachment_rca') as $file) {
                    $name = $request->name . 'root_cause_initial_attachment_rca' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $root->root_cause_initial_attachment_rca = json_encode($files);
        }


        $root->status = 'Opened';
        $root->stage = 1;
        $root->save();
        // -------------------------------------------------------
        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();
        

  
    if(!empty($request->initiator_Group))
    {
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
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }
    if(!empty($request->short_description))
    {
      

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
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }
    if(!empty($request->severity_level))
    {
      
        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Sevrity Level';
        $history->previous = "Null";
        $history->current =   $root->severity_level;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
            $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }
    if(!empty($request->assign_to))
    {
      

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
        $history->change_to =   "Opened";
            $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }


    if(!empty($request->qa_reviewer))
    {
      

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        
        $history->activity_type = 'QA Reviewer';
        $history->previous = "Null";
        $history->current = $root->qa_reviewer;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
            $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }
    if(!empty($request->due_date))
    {
      $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Due Date';
        $history->previous = "Null";
        $history->current =  $root->due_date;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }
     if(!empty($request->initiated_through))
    {
        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Initiated Through';
        $history->previous = "Null";
        $history->current =  $root->initiated_through;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }
    if(!empty($request->initiated_if_other))
    {
      $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Others';
        $history->previous = "Null";
        $history->current =  $root->initiated_if_other;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }
    if(!empty($request->Type))
    {
        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Type';
        $history->previous = "Null";
        $history->current =  $root->Type;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }
    if(!empty($request->priority_level))
    {
        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Priority-Level';
        $history->previous = "Null";
        $history->current =  $root->priority_level;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }
    if(!empty($request->department))
    {
      

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Department';
        $history->previous = "Null";
        $history->current =   $root->department;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }
    if(!empty($request->description))
    {


        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Description';
        $history->previous = "Null";
        $history->current =  $root->description;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }
    if(!empty($request->comments))
    {

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Comments';
        $history->previous = "Null";
        $history->current =  $root->comments;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }
    if(!empty($request->root_cause_initial_attachment))
    {
    


        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Initial Attachment';
        $history->previous = "Null";
        $history->current =  empty($root->root_cause_initial_attachment) ? null:$root->root_cause_initial_attachment;
  
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }


    //-------------------------------investigation tab--------------------------------------
    if(!empty($request->related_url))
    {


        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Related URL';
        $history->previous = "Null";
        $history->current =  $root->related_url;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }





    if(!empty($request->objective))
    {


        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Objective';
        $history->previous = "Null";
        $history->current =  $root->objective;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }


    if(!empty($request->scope))
    {


        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Scope';
        $history->previous = "Null";
        $history->current =  $root->scope;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }

    if(!empty($request->problem_statement_rca))
    {


        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Problem Statement';
        $history->previous = "Null";
        $history->current =  $root->problem_statement_rca;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }

    if(!empty($request->requirement))
    {


        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Requirement';
        $history->previous = "Null";
        $history->current =  $root->requirement;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }

    if(!empty($request->immediate_action))
    {


        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Immediate Action';
        $history->previous = "Null";
        $history->current =  $root->immediate_action;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }

    if(!empty($request->investigation_team))
    {


        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Investigation Team';
        $history->previous = "Null";
        $history->current =  $root->investigation_team;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }

    if(!empty($request->root_cause))
    {


        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Root Cause';
        $history->previous = "Null";
        $history->current =  $root->root_cause;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }




    if(!empty($request->capa))
    {


        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'CAPA';
        $history->previous = "Null";
        $history->current =  $root->capa;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }


    if(!empty($request->root_cause_description_rca))
    {


        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Root Cause Description';
        $history->previous = "Null";
        $history->current =  $root->root_cause_description_rca;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }



    if(!empty($request->investigation_summary_rca))
    {


        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Investigation Summary';
        $history->previous = "Null";
        $history->current =  $root->investigation_summary_rca;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }


    if(!empty($request->impact_risk_assessment))
    {


        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Impact/Risk Assessment';
        $history->previous = "Null";
        $history->current =  $root->impact_risk_assessment;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();
    }


    if(!empty($request->root_cause_initial_attachment_rca))
    {

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Investigation Attachment';
        $history->previous = "Null";
        $history->current =  $root->root_cause_initial_attachment_rca;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();

    }
    //-------------------------------investigation tab End-------------------------------------
    

    $lastDocument = RootAuditTrial::where('root_id', $root->id)->orderBy('created_at', 'desc')->first();

  if ($lastDocument->root_cause_methodology != $root->root_cause_methodology|| !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Root Cause Methodology';
        $history->previous = $lastDocument->root_cause_methodology;
        $history->current = $root->root_cause_methodology;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     

        $history->save();
    }
  

    if(!empty($request->root_cause_description))
    {

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Root Cause Description';
        $history->previous = "Null";
        $history->current =  $root->root_cause_description;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();

    }


    if(!empty($request->investigation_summary))
    {

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Investigation Summary';
        $history->previous = "Null";
        $history->current =  $root->investigation_summary;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();

    }


    if(!empty($request->cft_comments_new))
    {

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Final Comments';
        $history->previous = "Null";
        $history->current =  $root->cft_comments_new;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();

    }


    if(!empty($request->cft_attchament_new))
    {

        $history = new RootAuditTrial();
        $history->root_id = $root->id;
        $history->activity_type = 'Final Attachment';
        $history->previous = "Null";
        $history->current =  $root->cft_attchament_new;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $root->status;
        $history->change_to =   "Opened";
       $history->change_from = "Initiation";
        $history->action_name = 'Create';
     
        $history->save();

    }







    // $fields = ['measurement', 'materials', 'methods', 'environment', 'manpower', 'machine'];
    // foreach ($fields as $field) {
    //     if (!empty($request->$field)) {
    //         $root->$field = serialize($request->$field);
    //     }
    // }
    // foreach ($fields as $field) {
    //     if (!empty($request->$field)) {
    //         $history = new RootAuditTrial();
    //         $history->root_id = $root->id;
    //         $history->activity_type = ucfirst($field);
    //         $history->previous = "Null";
    //         $history->current = serialize($request->$field);
    //         $history->comment = "NA";
    //         $history->user_id = Auth::user()->id;
    //         $history->user_name = Auth::user()->name;
    //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    //         $history->origin_state = $root->status;
    //         $history->change_to = "Opened";
    //         $history->change_from = "Initiation";
    //         $history->action_name = 'Create';
    //         $history->save();
    //     }
    // }


        $fields =['what_will_be','what_will_not_be','what_rationable','where_will_be','where_will_not_be','where_rationable','when_will_be','when_will_not_be','when_rationable','coverage_will_be','coverage_will_not_be','coverage_rationable','who_will_be','who_will_not_be','who_rationable'];


        foreach ($fields as $field) {
            if (!empty($request->$field)) {
                $history = new RootAuditTrial();
                $history->root_id = $root->id;
                $history->activity_type = ucfirst($field);
                $history->previous = "Null";
                $history->current = serialize($request->$field);
                $history->comment = "NA";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $root->status;
                $history->change_to = "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->save();
            }
        }





    //--------------------------------------------------------------------------
// $lastDocument = RootAuditTrial::where('root_id', $root->id)->orderBy('created_at', 'desc')->first();
    

// $failure_mode_grid = [
//     'risk_factor' => 'Risk Factor',
//     'risk_element' => 'Risk element',
//     'problem_cause' => 'Probable cause of risk element',
//     'existing_risk_control' => 'Existing Risk Controls',
//     'initial_severity' => 'Initial Severity',
//     'initial_probability' => 'Initial Probability',
//     'initial_detectability' => 'Initial Detectability',
//     'initial_rpn' => 'Initial RPN',
//     'risk_acceptance' => 'Risk Acceptance',
//     'risk_control_measure' => 'Proposed Additional Risk control measure',
//     'residual_severity' => 'Residual Severity',
//     'residual_probability' => 'Residual Probability',
//     'residual_detectability' => 'Residual Detectability',
//     'residual_rpn' => 'Residual RPN',
//     'risk_acceptance2' => 'Risk Acceptance',
//     'mitigation_proposal' => 'Mitigation proposal',
// ];

// foreach ($failure_mode_grid as $key => $value) {
//     if (!empty($request->$key)) {
//         $currentValue = $request->$key;

//         // If the current value is an array, convert it to a comma-separated string
//         if (is_array($currentValue)) {
//             $currentValue = implode(', ', $currentValue);
//         }

//         // Get previous value from the last document
//         $previousValue = !empty($lastDocument->$key) ? $lastDocument->$key : '';

//         // Compare the values, if same and no comment, don't save
//         if ($previousValue != $currentValue || !empty($request->comment)) {
//             $history = new RootAuditTrial();
//             $history->root_id = $root->id;
//             $history->activity_type = $value;
//             $history->previous = $previousValue; // Store the previous value
//             $history->current = $currentValue;
//             $history->comment = "NA"; // Add comment if required
//             $history->user_id = Auth::user()->id;
//             $history->user_name = Auth::user()->name;
//             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
//             $history->origin_state = $root->status;
//             $history->change_to = "Opened";
//            $history->change_from = "Initiation";
//             $history->action_name = 'Create';

//             $history->save();
//         }
//     }
// }
  
//     $root_case_grid = [
//         'Root_Cause_Category' => ' Root Cause Category',
//         'Root_Cause_Sub_Category' => 'Root Cause Sub Category',
//         'Probability' => 'Probability',
//         'Remarks' => 'Remarks',
        
//     ];
    
//     foreach ($root_case_grid as $key => $value) {
//         if (!empty($request->$key)) {
//             $currentValue = $request->$key;
    
//             // If the current value is an array, convert it to a comma-separated string
//             if (is_array($currentValue)) {
//                 $currentValue = implode(', ', $currentValue);
//             }
    
//             // Get previous value from the last document
//             $previousValue = !empty($lastDocument->$key) ? $lastDocument->$key : '';
    
//             // Compare the values, if same and no comment, don't save
//             if ($previousValue != $currentValue || !empty($request->comment)) {
//                 $history = new RootAuditTrial();
//                 $history->root_id = $root->id;
//                 $history->activity_type = $value;
//                 $history->previous = $previousValue; // Store the previous value
//                 $history->current = $currentValue;
//                 $history->comment = "NA"; // Add comment if required
//                 $history->user_id = Auth::user()->id;
//                 $history->user_name = Auth::user()->name;
//                 $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
//                 $history->origin_state = $root->status;
//                 $history->change_to = "Opened";
//                $history->change_from = "Initiation";
//                 $history->action_name = 'Create';
    
//                 $history->save();
//             }
//         }
//     }
  
    
//    // $lastDocument = RootAuditTrial::where('root_id', $root->id)->orderBy('created_at', 'desc')->first();

//     $Fishbone_or_ishikawa_diagram = [
//         'measurement' => 'Measurement',
//         'materials' => 'Materials ',
//         'methods' => 'Methods ',
//         'environment' => 'Environment ',
//         'manpower' => 'Manpower ',
//         'machine' => 'Machine ',
//         'problem_statement' => 'Problem Statement ',
//     ];
    
//     foreach ($Fishbone_or_ishikawa_diagram as $key => $value) {
//         if (!empty($request->$key)) {
//             $currentValue = $request->$key;
    
//             // If the current value is an array, convert it to a comma-separated string
//             if (is_array($currentValue)) {
//                 $currentValue = implode(', ', $currentValue);
//             }
    
//             // Get previous value from the last document
//             $previousValue = !empty($lastDocument->$key) ? $lastDocument->$key : '';
    
//             // Compare the values, if same and no comment, don't save
//             if ($previousValue != $currentValue || !empty($request->comment)) {
//                 $history = new RootAuditTrial();
//                 $history->root_id = $root->id;
//                 $history->activity_type = $value;
//                 $history->previous = $previousValue; // Store the previous value
//                 $history->current = $currentValue;
//                 $history->comment = "NA"; // Add comment if required
//                 $history->user_id = Auth::user()->id;
//                 $history->user_name = Auth::user()->name;
//                 $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
//                 $history->origin_state = $root->status;
//                 $history->change_to = "Opened";
//                $history->change_from = "Initiation";
//                 $history->action_name = 'Create';
    
//                 $history->save();
//             }
//         }
//     }
    


    
//     $why_why_chart  = [
//         'why_problem_statement' => 'Problem Statement',
//         'why_1' => ' Why 1',
//         'why_2' => '  Why 2',
//         'why_3' => '  Why 3',
//         'why_4' => '  Why 4',
//         'why_5' => '  Why 5',
//         'why_root_cause' => 'Root Cause',
//     ];
//     foreach ($why_why_chart as $key => $value) {
//         if (!empty($request->$key)) {
//             $currentValue = $request->$key;
    
//             // If the current value is an array, convert it to a comma-separated string
//             if (is_array($currentValue)) {
//                 $currentValue = implode(', ', $currentValue);
//             }
    
//             // Get previous value from the last document
//             $previousValue = !empty($lastDocument->$key) ? $lastDocument->$key : '';
    
//             // Compare the values, if same and no comment, don't save
//             if ($previousValue != $currentValue || !empty($request->comment)) {
//                 $history = new RootAuditTrial();
//                 $history->root_id = $root->id;
//                 $history->activity_type = $value;
//                 $history->previous = $previousValue; // Store the previous value
//                 $history->current = $currentValue;
//                 $history->comment = "NA"; // Add comment if required
//                 $history->user_id = Auth::user()->id;
//                 $history->user_name = Auth::user()->name;
//                 $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
//                 $history->origin_state = $root->status;
//                 $history->change_to = "Opened";
//                $history->change_from = "Initiation";
//                 $history->action_name = 'Create';
    
//                 $history->save();
//             }
//         }
//     }
  

//     $is_is_not_analysis  = [
//         'what_will_be' => ' What / Will Be',
//         'what_will_not_be' => 'what / Will Not Be',
//         'what_rationable' => 'what / Rational',

//         'where_will_be' => ' Where / Will Be',
//         'where_will_not_be' => ' Where / Will Not Be',
//         'where_rationable' => ' Where / Rational',

//         'when_will_be' => ' When / Will Be',
//         'when_will_not_be' => 'When / Will Not Be ',
//         'when_rationable' => 'When / Retional ',

//         'coverage_will_be' => 'Coverage / Will Be',
//         'coverage_will_not_be' => 'Coverage / Will Not Be',
//         'coverage_rationable' => 'Coverage / Retional',

//         'who_will_be' => 'Who / will Be ',
//         'who_will_not_be' => 'Who / Will Not Be',
//         'who_rationable' => ' Who / Retional',
//     ];
    
//     foreach ($is_is_not_analysis as $key => $value) {
//         if (!empty($request->$key)) {
//             $currentValue = $request->$key;
    
//             // If the current value is an array, convert it to a comma-separated string
//             if (is_array($currentValue)) {
//                 $currentValue = implode(', ', $currentValue);
//             }
    
//             // Get previous value from the last document
//             $previousValue = !empty($lastDocument->$key) ? $lastDocument->$key : '';
    
//             // Compare the values, if same and no comment, don't save
//             if ($previousValue != $currentValue || !empty($request->comment)) {
//                 $history = new RootAuditTrial();
//                 $history->root_id = $root->id;
//                 $history->activity_type = $value;
//                 $history->previous = $previousValue; // Store the previous value
//                 $history->current = $currentValue;
//                 $history->comment = "NA"; // Add comment if required
//                 $history->user_id = Auth::user()->id;
//                 $history->user_name = Auth::user()->name;
//                 $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
//                 $history->origin_state = $root->status;
//                 $history->change_to = "Opened";
//                $history->change_from = "Initiation";
//                 $history->action_name = 'Create';
    
//                 $history->save();
//             }
//         }
//     }
   
        // $history = new RootAuditTrial();
        // $history->root_id = $root->id;
        // $history->activity_type = 'Sample Types';
        // $history->previous = "Null";
        // $history->current = $root->Sample_Types;
        // $history->comment = "NA";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $root->status;
        // $history->change_to =   "Opened";
        // $history->change_from = "Initiator";
        // $history->action_name = 'Create';
     
        // $history->save();
 

        // $history = new RootAuditTrial();
        // $history->root_id = $root->id;
        // $history->activity_type = 'Investigators';
        // $history->previous = "Null";
        // $history->current = $root->investigators;
        // $history->comment = "NA";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $root->status;
        // $history->change_to =   "Opened";
        // $history->change_from = "Initiator";
        // $history->action_name = 'Create';
     
        // $history->save();

        // $history = new RootAuditTrial();
        // $history->root_id = $root->id;
        // $history->activity_type = 'Attachments';
        // $history->previous = "Null";
        // $history->current = empty($root->cft_attchament_new) ? null : $root->cft_attchament_new;
        // $history->comment = "NA";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $root->status;
        // $history->change_to =   "Opened";
        // $history->change_from = "Initiator";
        // $history->action_name = 'Create';
     
        // $history->save();

        // $history = new RootAuditTrial();
        // $history->root_id = $root->id;
        // $history->activity_type = 'Comments';
        // $history->previous = "Null";
        // $history->current = $root->comments;
        // $history->comment = "NA";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $root->status;
        // $history->change_to =   "Opened";
        // $history->change_from = "Initiator";
        // $history->action_name = 'Create';
     
        // $history->save();

        // $history = new RootAuditTrial();
        // $history->root_id = $root->id;
        // $history->activity_type = 'Lab Inv Concl';
        // $history->previous = "Null";
        // $history->current = $root->lab_inv_concl;
        // $history->comment = "NA";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $root->status;
        // $history->change_to =   "Opened";
        // $history->change_from = "Initiator";
        // $history->action_name = 'Create';
     
        // $history->save();

        // $history = new RootAuditTrial();
        // $history->root_id = $root->id;
        // $history->activity_type = 'lab Inv Attach';
        // $history->previous = "Null";
        // $history->current = $root->lab_inv_attach;
        // $history->comment = "NA";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $root->status;
        // $history->change_to =   "Opened";
        // $history->change_from = "Initiator";
        // $history->action_name = 'Create';
     
        // $history->save();

        // $history = new RootAuditTrial();
        // $history->root_id = $root->id;
        // $history->activity_type = 'Qc Head Comments';
        // $history->previous = "Null";
        // $history->current = $root->qc_head_comments;
        // $history->comment = "NA";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $root->status;
        // $history->change_to =   "Opened";
        // $history->change_from = "Initiator";
        // $history->action_name = 'Create';
     
        // $history->save();

        // $history = new RootAuditTrial();
        // $history->root_id = $root->id;
        // $history->activity_type = 'Inv Attach';
        // $history->previous = "Null";
        // $history->current = $root->inv_attach;
        // $history->comment = "NA";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $root->status;
        // $history->change_to =   "Opened";
        // $history->change_from = "Initiator";
        // $history->action_name = 'Create';
     
        // $history->save();

        // if (!empty($root->due_date)) {
        // $history = new RootAuditTrial();
        // $history->root_id = $root->id;
        // $history->activity_type = 'Due Date';
        // $history->previous = "Null";
        // $history->current = $root->due_date;
        // $history->comment = "NA";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $root->status;
        // $history->change_to =   "Opened";
        // $history->change_from = "Initiator";
        // $history->action_name = 'Create';
     
        // $history->save();

        // }
        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }




    public function root_update(Request $request, $id)



    {
       //       dd($request->all());

        
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
        $root->due_date =  $request->filled('due_date')  ? $request->due_date : $root->due_date;
        $root->severity_level= $request->severity_level;
        $root->Type= ($request->Type);
        $root->priority_level = ($request->priority_level);
        // $root->department = ($request->department);
        $root->department = implode(',', $request->departments);
        $root->description = ($request->description);
        $root->investigation_summary = ($request->investigation_summary);
        $root->root_cause_description = ($request->root_cause_description);
        $root->cft_comments_new = ($request->cft_comments_new);
       
         $root->investigators = ($request->investigators);
        $root->related_url = ($request->related_url);
        // $root->investigators = implode(',', $request->investigators);
        $root->root_cause_methodology = implode(',', $request->root_cause_methodology);

       // dd($root->root_cause_methodology);
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
         
        //observation changes
        $root->objective = $request->objective;
        $root->scope = $request->scope;
        $root->problem_statement_rca = $request->problem_statement_rca;
        $root->requirement = $request->requirement;
        $root->immediate_action = $request->immediate_action;
        $root->investigation_team = $request->investigation_team;
        $root->investigation_tool = $request->investigation_tool;
        $root->root_cause = $request->root_cause;

        $root->impact_risk_assessment = $request->impact_risk_assessment;
        $root->capa = $request->capa;
        $root->root_cause_description_rca = $request->root_cause_description_rca;
        $root->investigation_summary_rca = $request->investigation_summary_rca;
       
        $root->qa_reviewer = $request->qa_reviewer;

        if (!empty($request->root_cause_initial_attachment_rca)) {
            $files = [];
            if ($request->hasfile('root_cause_initial_attachment_rca')) {
                foreach ($request->file('root_cause_initial_attachment_rca') as $file) {
                    $name = $request->name . 'root_cause_initial_attachment_rca' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $root->root_cause_initial_attachment_rca = json_encode($files);
        }



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

        


    
        if ($lastDocument->initiator_Group != $root->initiator_Group || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Initiator Group';
            $history->previous = $lastDocument->initiator_Group;
            $history->current = $root->initiator_Group;
            $history->comment = $request->comment;  
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
                if (is_null($lastDocument->initiator_Group) || $lastDocument->initiator_Group === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

         
            $history->save();
        }
        if ($lastDocument->short_description != $root->short_description || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastDocument->short_description;
            $history->current = $root->short_description;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
                if (is_null($lastDocument->short_description) || $lastDocument->short_description === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

           

            $history->save();
        }


        if ($lastDocument->description != $root->description || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Description';
            $history->previous = $lastDocument->description;
            $history->current = $root->description;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
                if (is_null($lastDocument->description) || $lastDocument->description === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

           

            $history->save();
        }


        if ($lastDocument->assign_to != $root->assign_to || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Assign Id';
            $history->previous = $lastDocument->assign_to;
            $history->current = $root->assign_to;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
                if (is_null($lastDocument->assign_to) || $lastDocument->assign_to === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

           

            $history->save();
        }


        if ($lastDocument->qa_reviewer != $root->qa_reviewer || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'QA Reviewer';
            $history->previous = $lastDocument->qa_reviewer;
            $history->current = $root->qa_reviewer;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
                if (is_null($lastDocument->qa_reviewer) || $lastDocument->qa_reviewer === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

           

            $history->save();
        }


        if ($lastDocument->severity_level != $root->severity_level || !empty ($request->comment)) {
            // return 'history';
            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Sevrity Level';
            $history->previous =  $lastDocument->severity_level;
            $history->current = $root->severity_level;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
                if (is_null($lastDocument->severity_level) || $lastDocument->severity_level === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();

        
        }


        if ($lastDocument->due_date != $root->due_date || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Due Date';
            $history->previous = $lastDocument->due_date;
            $history->current = $root->due_date;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
                if (is_null($lastDocument->due_date) || $lastDocument->due_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

           

            $history->save();
        }

     //---------------------------------------------------------------------------

     if ($lastDocument->initiated_through != $root->initiated_through || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Initiated Through';
        $history->previous = $lastDocument->initiated_through;
        $history->current = $root->initiated_through;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->initiated_through) || $lastDocument->initiated_through === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

       

        $history->save();
    }




     if ($lastDocument->initiated_if_other != $root->initiated_if_other || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Others';
        $history->previous = $lastDocument->initiated_if_other;
        $history->current = $root->initiated_if_other;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->initiated_if_other) || $lastDocument->initiated_if_other === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

       

        $history->save();
    }


    


     if ($lastDocument->Type != $root->Type || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Type';
        $history->previous = $lastDocument->Type;
        $history->current = $root->Type;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Type) || $lastDocument->Type === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

       

        $history->save();
    }

    
    if ($lastDocument->priority_level != $root->priority_level|| !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Priority-Level';
        $history->previous = $lastDocument->priority_level;
        $history->current = $root->priority_level;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->priority_level) || $lastDocument->priority_level === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

       

        $history->save();
    }

    if ($lastDocument->department != $root->department|| !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Departments';
        $history->previous = $lastDocument->department;
        $history->current = $root->department;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->department) || $lastDocument->department === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

       

        $history->save();

    }   
    

    
    if ($lastDocument->root_cause_initial_attachment != $root->root_cause_initial_attachment|| !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Initial Attachment';
        $history->previous = $lastDocument->root_cause_initial_attachment;
        $history->current = $root->root_cause_initial_attachment;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->root_cause_initial_attachment) || $lastDocument->root_cause_initial_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

       

        $history->save();

    }   
    if ($lastDocument->related_url != $root->related_url|| !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Related URL';
        $history->previous = $lastDocument->related_url;
        $history->current = $root->related_url;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->related_url) || $lastDocument->related_url === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

       

        $history->save();
    }

    if ($lastDocument->root_cause_methodology != $root->root_cause_methodology|| !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Root Cause Methodology';
        $history->previous = $lastDocument->root_cause_methodology;
        $history->current = $root->root_cause_methodology;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->root_cause_methodology) || $lastDocument->root_cause_methodology === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

       

        $history->save();
    }


    
    if ($lastDocument->root_cause_description != $root->root_cause_description|| !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Root Cause Description';
        $history->previous = $lastDocument->root_cause_description;
        $history->current = $root->root_cause_description;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->root_cause_description) || $lastDocument->root_cause_description === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

       

        $history->save();
    }



    
    if ($lastDocument->investigation_summary != $root->investigation_summary|| !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Investigation Summary';
        $history->previous = $lastDocument->investigation_summary;
        $history->current = $root->investigation_summary;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->investigation_summary) || $lastDocument->investigation_summary === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

       

        $history->save();
    }


    if ($lastDocument->cft_comments_new != $root->cft_comments_new|| !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Final Comment';
        $history->previous = $lastDocument->cft_comments_new;
        $history->current = $root->cft_comments_new;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->cft_comments_new) || $lastDocument->cft_comments_new === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

       

        $history->save();
    }
    if ($lastDocument->cft_attchament_new != $root->cft_attchament_new|| !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Final Attachment';
        $history->previous = $lastDocument->cft_attchament_new;
        $history->current = $root->cft_attchament_new;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->cft_attchament_new) || $lastDocument->cft_attchament_new === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

       

        $history->save();
    }

    if ($lastDocument->cft_attchament_new != $root->cft_attchament_new|| !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Final Attachment';
        $history->previous = $lastDocument->cft_attchament_new;
        $history->current = $root->cft_attchament_new;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->cft_attchament_new) || $lastDocument->cft_attchament_new === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

       

        $history->save();
    }


    if ($lastDocument->root_cause_initial_attachment_rca != $root->root_cause_initial_attachment_rca|| !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Investigation Attachment';
        $history->previous = $lastDocument->root_cause_initial_attachment_rca;
        $history->current = $root->root_cause_initial_attachment_rca;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->root_cause_initial_attachment_rca) || $lastDocument->root_cause_initial_attachment_rca === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

       

        $history->save();
    }



    if ($lastDocument->objective != $root->objective || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Objective';
        $history->previous = $lastDocument->objective;
        $history->current = $root->objective;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->objective) || $lastDocument->objective === '') {
            $history->action_name = "New";
        } else {
            $history->action_name = "Update";
        }

       

        $history->save();
    }





    

    if ($lastDocument->scope != $root->scope || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Scope';
        $history->previous = $lastDocument->scope;
        $history->current = $root->scope;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->scope) || $lastDocument->scope === '') {
            $history->action_name = "New";
        } else {
            $history->action_name = "Update";
        }

       

        $history->save();
    }



    

    if ($lastDocument->problem_statement_rca != $root->problem_statement_rca || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Problem Statement of Investigation';
        $history->previous = $lastDocument->problem_statement_rca;
        $history->current = $root->problem_statement_rca;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->problem_statement_rca) || $lastDocument->problem_statement_rca === '') {
            $history->action_name = "New";
        } else {
            $history->action_name = "Update";
        }

       

        $history->save();
    }

    

    if ($lastDocument->requirement != $root->requirement || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Requirement';
        $history->previous = $lastDocument->requirement;
        $history->current = $root->requirement;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->requirement) || $lastDocument->requirement === '') {
            $history->action_name = "New";
        } else {
            $history->action_name = "Update";
        }

       

        $history->save();
    }

    

    if ($lastDocument->immediate_action != $root->immediate_action || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Immediate Action';
        $history->previous = $lastDocument->immediate_action;
        $history->current = $root->immediate_action;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->immediate_action) || $lastDocument->immediate_action === '') {
            $history->action_name = "New";
        } else {
            $history->action_name = "Update";
        }

       

        $history->save();
    }

    

    if ($lastDocument->investigation_team != $root->investigation_team || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Investigation Team';
        $history->previous = $lastDocument->investigation_team;
        $history->current = $root->investigation_team;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->investigation_team) || $lastDocument->investigation_team === '') {
            $history->action_name = "New";
        } else {
            $history->action_name = "Update";
        }

       

        $history->save();
    }


    
    if ($lastDocument->investigation_tool != $root->investigation_tool || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Investigation Tool';
        $history->previous = $lastDocument->investigation_tool;
        $history->current = $root->investigation_tool;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->investigation_tool) || $lastDocument->investigation_tool === '') {
            $history->action_name = "New";
        } else {
            $history->action_name = "Update";
        }

       

        $history->save();
    }

    
    if ($lastDocument->root_cause != $root->root_cause || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Root Cause';
        $history->previous = $lastDocument->root_cause;
        $history->current = $root->root_cause;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->root_cause) || $lastDocument->root_cause === '') {
            $history->action_name = "New";
        } else {
            $history->action_name = "Update";
        }

       

        $history->save();
    }


    
    if ($lastDocument->impact_risk_assessment != $root->impact_risk_assessment || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Impact / Risk Assessment';
        $history->previous = $lastDocument->impact_risk_assessment;
        $history->current = $root->impact_risk_assessment;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->impact_risk_assessment) || $lastDocument->impact_risk_assessment === '') {
            $history->action_name = "New";
        } else {
            $history->action_name = "Update";
        }

       

        $history->save();
    }




    
    if ($lastDocument->capa != $root->capa || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Capa';
        $history->previous = $lastDocument->capa;
        $history->current = $root->capa;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->capa) || $lastDocument->capa === '') {
            $history->action_name = "New";
        } else {
            $history->action_name = "Update";
        }

       

        $history->save();
    }

    
    if ($lastDocument->root_cause_description_rca != $root->root_cause_description_rca || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Root Cause Description';
        $history->previous = $lastDocument->root_cause_description_rca;
        $history->current = $root->root_cause_description_rca;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->root_cause_description_rca) || $lastDocument->root_cause_description_rca === '') {
            $history->action_name = "New";
        } else {
            $history->action_name = "Update";
        }

       

        $history->save();
    }

    
    if ($lastDocument->investigation_summary_rca != $root->investigation_summary_rca || !empty($request->comment)) {

        $history = new RootAuditTrial();
        $history->root_id = $id;
        $history->activity_type = 'Investigation Summary';
        $history->previous = $lastDocument->investigation_summary_rca;
        $history->current = $root->investigation_summary_rca;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->investigation_summary_rca) || $lastDocument->investigation_summary_rca === '') {
            $history->action_name = "New";
        } else {
            $history->action_name = "Update";
        }

       

        $history->save();
    }



    
    $fields = [
        'what_will_be', 'what_will_not_be', 'what_rationable',
        'where_will_be', 'where_will_not_be', 'where_rationable',
        'when_will_be', 'when_will_not_be', 'when_rationable',
        'coverage_will_be', 'coverage_will_not_be', 'coverage_rationable',
        'who_will_be', 'who_will_not_be', 'who_rationable'
    ];
    
    foreach ($fields as $field) {
        if ($lastDocument->$field != $root->$field || !empty($request->comment)) {
            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = ucfirst(str_replace('_', ' ', $field));
            $history->previous = $lastDocument->$field;
            $history->current = $root->$field;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            
            if (is_null($lastDocument->$field) || $lastDocument->$field === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
    }
    




    $fields = ['measurement', 'materials', 'methods', 'environment', 'manpower', 'machine', 'problem_statement'];
    foreach ($fields as $field) {
        if (!empty($request->$field)) {
            $root->$field = is_array($request->$field) ? serialize($request->$field) : $request->$field;
    
            if ($lastDocument->$field != $root->$field || !empty($request->comment)) {
                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = ucfirst($field);
                $history->previous = $lastDocument->$field;
                $history->current = $root->$field;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Not Applicable";
                $history->change_from = $lastDocument->status;
                $history->action_name = is_null($lastDocument->$field) || $lastDocument->$field === '' ? "New" : "Update";
                $history->save();
            }
        }
    }
    
    $fields = ['Root_Cause_Category', 'Root_Cause_Sub_Category', 'Probability', 'Remarks', 'why_problem_statement', 'why_1', 'why_2', 'why_3', 'why_4','why_5'];
    foreach ($fields as $field) {
        if (!empty($request->$field)) {
            $root->$field = is_array($request->$field) ? serialize($request->$field) : $request->$field;
    
            if ($lastDocument->$field != $root->$field || !empty($request->comment)) {
                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = ucfirst(str_replace('_', ' ', $field));
                $history->previous = $lastDocument->$field;
                $history->current = $root->$field;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Not Applicable";
                $history->change_from = $lastDocument->status;
                $history->action_name = is_null($lastDocument->$field) || $lastDocument->$field === '' ? "New" : "Update";
                $history->save();
            }
        }
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
                $root->submitted_by= Auth::user()->name;
                $root->submitted_on= Carbon::now()->format('d-M-Y');
                $root->comments_new1 = $request->comment;

                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous ="";
                $history->current = $root->submitted_by;
                $history->comment = $request->comment;
                $history->action = 'Acknowledge';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Investigation in Progress";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Update';
                $history->stage = 'Investigation in Progress';
              
                

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
                $root->status = 'Pending QA Review';
                $root->submitted_by = Auth::user()->name;
                $root->submitted_on = Carbon::now()->format('d-M-Y');
                $root->qa_comments_new = $request->comment;

                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous ="QA Review Complete";
                $history->current = $root->submitted_by;
                $history->comment = $request->comment;
                $history->action = 'submit';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Pending QA Review";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Update';
                $history->stage = 'Pending QA Review';
              
                $history->save();
                $root->update();
                toastr()->success('Document Sent');
                return back();
            }



            
            // if ($root->stage == 3) {
            //     $root->stage = "4";
            //     $root->status = "Pending  Review";
            //     $root->submitted_by = Auth::user()->name;
            //     $root->submitted_on = Carbon::now()->format('d-M-Y');



            //     $history = new RootAuditTrial();
            //     $history->root_id = $id;
            //     $history->activity_type = 'Activity Log';
            //     $history->previous ="Pending QA Review";
            //     $history->current = $root->submitted_by;
            //     $history->comment = $request->comment;
            //     $history->action = 'QA Review Complete';
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocument->status;
            //     $history->change_to =   "Not Applicable";
            //     $history->change_from = $lastDocument->status;
            //     $history->action_name = 'Update';
            //     $history->stage = 'Pending QA Review';
            //     $history->save();
            //     $root->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            
            // if ($root->stage == 4) {
            //     $root->stage = "5";
            //     $root->status = 'Pending QA Review';

            //     $root->submitted_by = Auth::user()->name;
            //     $root->submitted_on = Carbon::now()->format('d-M-Y');

            //     $history = new RootAuditTrial();
            //     $history->root_id = $id;
            //     $history->activity_type = 'Activity Log';
            //     $history->previous ="Pending QA Review";
            //     $history->current = $root->submitted_by;
            //     $history->comment = $request->comment;
            //     $history->action = 'Approved';
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocument->status;
            //     $history->change_to =   "Not Applicable";
            //     $history->change_from = $lastDocument->status;
            //     $history->action_name = 'Update';
            //     $history->stage = 'Pending QA Review';
              
            //     $history->save();








            //     $root->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            if ($root->stage == 3) {
                $root->stage = "6";
                $root->status = "Close-Done";
                $root->submitted_by = Auth::user()->name;
                $root->submitted_on = Carbon::now()->format('d-M-Y');
                $root->comment_3 = $request->comment;

                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "QA Review Complete";
                $history->current = $root->submitted_by;
                $history->action = 'QA Review Complete';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Close-Done";
                $history->change_from = $lastDocument->status;
                $history->stage='QA Review Complete';
                $history->save();

                $root->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($root->stage == 5) {
                $root->stage = "6";
                $root->status = "Closed -Done";
                $root->evaluation_complete_by = Auth::user()->name;
                $root->evaluation_complete_on = Carbon::now()->format('d-M-Y');
             

                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocument->submitted_by;
                $history->current = $root->evaluation_complete_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->action = 'QA Review Complete';
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                // $history->origin_state = $lastDocument->status;
                $history->change_to =   "Close-Done";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Update';
               // $history->stage = 'Completed';
              
               
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
            $root->cancel_comment = $request->comment;

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Activity Log';
            // $history->previous = $lastDocument->cancelled_by;
            $history->previous = "";
            $history->current = $root->cancelled_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->action = "Cancel";
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->origin_state = $lastDocument->status;
             $history->change_to =   "Closed-Cancelled";
             $history->change_from = $lastDocument->status;
              
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
           // $root = RootCauseAnalysis::find($id);
            $lastDocument =  RootCauseAnalysis::find($id);

            if ($capa->stage == 3) {
                $capa->stage = "2";
                $capa->status = "Investigation in Progress";

                $capa->qA_review_complete_by = Auth::user()->name;
                $capa->qA_review_complete_on = Carbon::now()->format('d-M-Y');
                $capa->reject_1 = $request->comment;

                

                    $history = new RootAuditTrial();    
                    $history->root_id = $id;
                    $history->previous = "";
                    $history->activity_type = 'Activity Log';
                   // $history->previous = $lastDocument->qA_review_complete_by;
                    $history->current = $capa->qA_review_complete_by;
                    $history->comment = $request->comment;
                    $history->action  = "More Information Required";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Investigation in Progress";
                    $history->change_from = $lastDocument->status;
                    $history->action_name = 'Update';
                    $history->stage='Investigation in Progress';
                    $history->save();



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

                $capa->qA_review_complete_by = Auth::user()->name;
                $capa->qA_review_complete_on = Carbon::now()->format('d-M-Y');
                    $history = new RootAuditTrial();    
                    $history->root_id = $id;
                    $history->previous = "";
                    $history->activity_type = 'Activity Log';
                   // $history->previous = $lastDocument->qA_review_complete_by;
                    $history->current = $capa->qA_review_complete_by;
                    $history->comment = $request->comment;
                    $history->action  = "More Information Required";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Investigation in Progress";
                    $history->change_from = $lastDocument->status;
                    $history->action_name = 'Update';
                    $history->stage='Investigation in Progress';
                    $history->save();



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
        $audit = RootAuditTrial::where('root_id', $id)->orderByDESC('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = RootCauseAnalysis::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');

        return view("frontend.root-cause-analysis.new_root_AuditTrail", compact('audit', 'document', 'today'));
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
           // $audit = RootAuditTrial::where('root_id', $id)->orderByDESC('id')->get();
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
