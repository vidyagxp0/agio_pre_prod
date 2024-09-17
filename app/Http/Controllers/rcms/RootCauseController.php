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
use App\Models\Capa;
use App\Models\OpenStage;
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
        $record = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        return view("frontend.forms.root-cause-analysis", compact('due_date', 'record_number'));
    }

    public function root_store(Request $request)
    {

        //  dd($request->all());

        $lastDocument = 'Null';
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
        $root->short_description = ($request->short_description);
        $root->assigned_to = $request->assigned_to;
        $root->assign_to = $request->assign_to;
        $root->root_cause_description = $request->root_cause_description;
        $root->due_date = $request->due_date;
        $root->cft_comments_new = $request->cft_comments_new;
        $root->hod_final_comments = $request->hod_final_comments;
        $root->qa_final_comments = $request->qa_final_comments;
        $root->qah_final_comments = $request->qah_final_comments;
        $root->hod_comments = $request->hod_comments;
        $root->Type = $request->Type;

        $root->investigators = $request->investigators;
        // $root->investigators = implode(',', $request->investigators);
        $root->initiated_through = $request->initiated_through;
        $root->initiated_if_other = $request->initiated_if_other;
        $root->department = $request->department;
        // $root->department = implode(',', $request->departments);
        $root->description = ($request->description);
        $root->comments = ($request->comments);
        $root->related_url = ($request->related_url);
        $root->root_cause_methodology = implode(',', $request->root_cause_methodology);
        //Fishbone or Ishikawa Diagram
        if (!empty($request->measurement)) {
            $root->measurement = serialize($request->measurement);
        }
        if (!empty($request->materials)) {
            $root->materials = serialize($request->materials);
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
        if (!empty($request->methods)) {
            $root->methods = serialize($request->methods);
        }
        $root->problem_statement = ($request->problem_statement);
        // Why-Why Chart (Launch Instruction) Problem Statement
        if (!empty($request->why_problem_statement)) {
            $root->why_problem_statement = $request->why_problem_statement;
        }
        if (!empty($request->why_1)) {
            $root->why_1 = serialize($request->why_1);
        }
        if (!empty($request->why_2)) {
            $root->why_2 = serialize($request->why_2);
        }
        if (!empty($request->why_3)) {
            $root->why_3 = serialize($request->why_3);
        }
        if (!empty($request->why_4)) {
            $root->why_4 = serialize($request->why_4);
        }
        if (!empty($request->why_5)) {
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

        if (!empty($request->Root_Cause_Category)) {
            $root->Root_Cause_Category = serialize($request->Root_Cause_Category);
        }
        if (!empty($request->Root_Cause_Sub_Category)) {
            $root->Root_Cause_Sub_Category = serialize($request->Root_Cause_Sub_Category);
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

        // Inference

        if (!empty($request->inference_type)) {
            $root->inference_type = serialize($request->inference_type);
        }
        if (!empty($request->inference_remarks)) {
            $root->inference_remarks = serialize($request->inference_remarks);
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
        $root->investigation_team = implode(',', $request->investigation_team);
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
        if (!empty($request->qah_final_attachments)) {
            $files = [];
            if ($request->hasfile('qah_final_attachments')) {
                foreach ($request->file('qah_final_attachments') as $file) {
                    $name = $request->name . 'qah_final_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $root->qah_final_attachments = json_encode($files);
        }
        if (!empty($request->hod_attachments)) {
            $files = [];
            if ($request->hasfile('hod_attachments')) {
                foreach ($request->file('hod_attachments') as $file) {
                    $name = $request->name . 'hod_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $root->hod_attachments = json_encode($files);
        }
        if (!empty($request->hod_final_attachments)) {
            $files = [];
            if ($request->hasfile('hod_final_attachments')) {
                foreach ($request->file('hod_final_attachments') as $file) {
                    $name = $request->name . 'hod_final_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $root->hod_final_attachments = json_encode($files);
        }
        if (!empty($request->qa_final_attachments)) {
            $files = [];
            if ($request->hasfile('qa_final_attachments')) {
                foreach ($request->file('qa_final_attachments') as $file) {
                    $name = $request->name . 'qa_final_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $root->qa_final_attachments = json_encode($files);
        }


        $root->status = 'Opened';
        $root->stage = 1;
        $root->save();
        // -------------------------------------------------------
        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);

        $record->update();




        if (!empty($root->record)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Record Number';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName(session()->get('division')) . "/RCA/" . Helpers::year($root->created_at) . "/" . str_pad($root->record, 4, '0', STR_PAD_LEFT);
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

        if (!empty($request->division_code)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Site/Location Code';
            $history->previous = "Null";
            $history->current = $root->division_code;
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

        if (!empty($request->originator_id)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = $request->originator_id;
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

        if (!empty($request->intiation_date)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Date Of Initiation';
            $history->previous = "Null";
            $history->current =  Helpers::getdateFormat($request->intiation_date);
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

        if (!empty($request->initiator_group_code)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Initiator Department Code';
            $history->previous = "Null";
            $history->current = $root->initiator_group_code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->initiator_Group)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Initiator Department';
            $history->previous = "Null";
            $history->current = $root->initiator_Group;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->short_description)) {
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

        // if (!empty($request->severity_level)) {
        //     $history = new RootAuditTrial();
        //     $history->root_id = $root->id;
        //     $history->activity_type = 'Severity Level';
        //     $history->previous = "Null";
        //     $history->current =   $root->severity_level;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $root->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->save();
        // }

        if (!empty($request->assign_to)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Responsible department Head';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($root->assign_to);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->qa_reviewer)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'QA Reviewer';
            $history->previous = "Null";
            $history->current =  Helpers::getInitiatorName($root->qa_reviewer);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->due_date)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current =  Helpers::getdateFormat($root->due_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->initiated_through)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Initiated Through';
            $history->previous = "Null";
            $history->current =  $root->initiated_through;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->initiated_if_other)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Others';
            $history->previous = "Null";
            $history->current =  $root->initiated_if_other;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->Type)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Type';
            $history->previous = "Null";
            $history->current =  $root->Type;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->priority_level)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Priority-Level';
            $history->previous = "Null";
            $history->current =  $root->priority_level;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->department)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Responsible Department';
            $history->previous = "Null";
            $history->current =   $root->department;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->description)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Description';
            $history->previous = "Null";
            $history->current =  $root->description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->comments)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Comments';
            $history->previous = "Null";
            $history->current =  $root->comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->root_cause_initial_attachment)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Initial Attachment';
            $history->previous = "Null";
            $history->current =  empty($root->root_cause_initial_attachment) ? null : $root->root_cause_initial_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->objective)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Objective';
            $history->previous = "Null";
            $history->current =  $root->objective;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->scope)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Scope';
            $history->previous = "Null";
            $history->current =  $root->scope;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->problem_statement_rca)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Problem Statement';
            $history->previous = "Null";
            $history->current =  $root->problem_statement_rca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->requirement)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Background';
            $history->previous = "Null";
            $history->current =  $root->requirement;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->immediate_action)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Immediate Action';
            $history->previous = "Null";
            $history->current =  $root->immediate_action;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->investigation_team)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Investigation Team';
            $history->previous = "Null";
            $history->current =  $root->investigation_team;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->related_url)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Related URL';
            $history->previous = "Null";
            $history->current =  $root->related_url;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }


        $lastDocument = RootAuditTrial::where('root_id', $root->id)->orderBy('created_at', 'desc')->first();

        if ($lastDocument->root_cause_methodology != $root->root_cause_methodology || !empty($request->comment)) {

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

        if (!empty($request->cft_comments_new)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'QA Review Comments';
            $history->previous = "Null";
            $history->current =  $root->cft_comments_new;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->cft_attchament_new)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'QA Review Attachment';
            $history->previous = "Null";
            $history->current =  $root->cft_attchament_new;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->root_cause)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Root Cause';
            $history->previous = "Null";
            $history->current =  $root->root_cause;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->impact_risk_assessment)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Impact / Risk Assessment';
            $history->previous = "Null";
            $history->current =  $root->impact_risk_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->capa)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'CAPA';
            $history->previous = "Null";
            $history->current =  $root->capa;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->root_cause_description_rca)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Root Cause Description';
            $history->previous = "Null";
            $history->current =  $root->root_cause_description_rca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->investigation_summary_rca)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Investigation Summary';
            $history->previous = "Null";
            $history->current =  $root->investigation_summary_rca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->root_cause_initial_attachment_rca)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'Investigation Attachment';
            $history->previous = "Null";
            $history->current =  $root->root_cause_initial_attachment_rca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->hod_final_comments)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'HOD Final Review Comments';
            $history->previous = "Null";
            $history->current =  $root->hod_final_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        // if(!empty($request->Inference))
        // {

        //     $history = new RootAuditTrial();
        //     $history->root_id = $root->id;
        //     $history->activity_type = 'Inference';
        //     $history->previous = "Null";
        //     $history->current =  $root->Inference;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $root->status;
        //     $history->change_to =   "Opened";
        //    $history->change_from = "Initiation";
        //     $history->action_name = 'Create';

        //     $history->save();

        // }

        if (!empty($request->hod_final_attachments)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'HOD Final Review Attachment';
            $history->previous = "Null";
            $history->current =  $root->hod_final_attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->qa_final_comments)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'QA Final Review Comments';
            $history->previous = "Null";
            $history->current =  $root->qa_final_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->qa_final_attachments)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'QA Final Review Attachment';
            $history->previous = "Null";
            $history->current =  $root->qa_final_attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->qah_final_comments)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'QAH/CQAH Final Approval Comment ';
            $history->previous = "Null";
            $history->current =  $root->qah_final_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }  if (!empty($request->hod_comments)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'HOD Review Comment ';
            $history->previous = "Null";
            $history->current =  $root->hod_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->qah_final_attachments)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'QAH/CQAH Final Approval Attachments';
            $history->previous = "Null";
            $history->current =  $root->qah_final_attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($request->hod_attachments)) {
            $history = new RootAuditTrial();
            $history->root_id = $root->id;
            $history->activity_type = 'HOD Review Attachments';
            $history->previous = "Null";
            $history->current =  $root->hod_attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $root->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
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
        //                   $history->comment = "Not Applicable"; // Add comment if required
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
        //                       $history->comment = "Not Applicable"; // Add comment if required
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
        //                       $history->comment = "Not Applicable"; // Add comment if required
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
        //                       $history->comment = "Not Applicable"; // Add comment if required
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
        //                       $history->comment = "Not Applicable"; // Add comment if required
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
        //       $history->comment = "Not Applicable";
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
        //       $history->comment = "Not Applicable";
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
        //       $history->comment = "Not Applicable";
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
        //       $history->comment = "Not Applicable";
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
        //       $history->comment = "Not Applicable";
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
        //       $history->comment = "Not Applicable";
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
        //       $history->comment = "Not Applicable";
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
        //       $history->comment = "Not Applicable";
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
        //       $history->comment = "Not Applicable";
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

    //  dd(root_update);

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
        $root->severity_level = $request->severity_level;
        $root->Type = ($request->Type);
        $root->priority_level = ($request->priority_level);
        $root->department = ($request->department);
        // $root->department = implode(',', $request->departments);
        $root->description = ($request->description);
        $root->investigation_summary = ($request->investigation_summary);
        $root->root_cause_description = ($request->root_cause_description);
        $root->cft_comments_new = ($request->cft_comments_new);
        $root->hod_final_comments = $request->hod_final_comments;
        $root->qa_final_comments = $request->qa_final_comments;
        $root->qah_final_comments = $request->qah_final_comments;
        $root->hod_comments = $request->hod_comments;
        $root->initiator_group_code = $request->initiator_group_code;

        $root->investigators = ($request->investigators);
        $root->related_url = ($request->related_url);
        // $root->investigators = implode(',', $request->investigators);
        $root->root_cause_methodology = implode(',', $request->root_cause_methodology);

        // dd($root->root_cause_methodology);
        // $root->country = ($request->country);
        $root->assign_to = $request->assign_to;
        $root->Sample_Types = $request->Sample_Types;

        // Root Cause +
        if (!empty($request->Root_Cause_Category)) {
            $root->Root_Cause_Category = serialize($request->Root_Cause_Category);
        }
        if (!empty($request->Root_Cause_Sub_Category)) {
            $root->Root_Cause_Sub_Category = serialize($request->Root_Cause_Sub_Category);
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
        if (!empty($request->why_1)) {
            $root->why_1 = serialize($request->why_1);
        }
        if (!empty($request->why_2)) {
            $root->why_2 = serialize($request->why_2);
        }
        if (!empty($request->why_3)) {
            $root->why_3 = serialize($request->why_3);
        }
        if (!empty($request->why_4)) {
            $root->why_4 = serialize($request->why_4);
        }
        if (!empty($request->why_5)) {
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
        $root->investigation_team = implode(',', $request->investigation_team);
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
        if (!empty($request->qah_final_attachments)) {
            $files = [];
            if ($request->hasfile('qah_final_attachments')) {
                foreach ($request->file('qah_final_attachments') as $file) {
                    $name = $request->name . 'qah_final_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $root->qah_final_attachments = json_encode($files);
        }
        if (!empty($request->hod_attachments)) {
            $files = [];
            if ($request->hasfile('hod_attachments')) {
                foreach ($request->file('hod_attachments') as $file) {
                    $name = $request->name . 'hod_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $root->hod_attachments = json_encode($files);
        }
        if (!empty($request->hod_final_attachments)) {
            $files = [];
            if ($request->hasfile('hod_final_attachments')) {
                foreach ($request->file('hod_final_attachments') as $file) {
                    $name = $request->name . 'hod_final_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $root->hod_final_attachments = json_encode($files);
        }
        if (!empty($request->qa_final_attachments)) {
            $files = [];
            if ($request->hasfile('qa_final_attachments')) {
                foreach ($request->file('qa_final_attachments') as $file) {
                    $name = $request->name . 'qa_final_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $root->qa_final_attachments = json_encode($files);
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

        // Inference

        if (!empty($request->inference_type)) {
            $root->inference_type = serialize($request->inference_type);
        }
        if (!empty($request->inference_remarks)) {
            $root->inference_remarks = serialize($request->inference_remarks);
        }




        $root->update();





        if ($lastDocument->initiator_Group != $root->initiator_Group || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Initiator Department';
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

        if ($lastDocument->initiator_group_code != $root->initiator_group_code || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Initiator Department Code';
            $history->previous = $lastDocument->initiator_group_code;
            $history->current = $root->initiator_group_code;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->initiator_group_code) || $lastDocument->initiator_group_code === '') {
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

        // if ($lastDocument->severity_level != $root->severity_level || !empty($request->comment)) {

        //     $history = new RootAuditTrial();
        //     $history->root_id = $id;
        //     $history->activity_type = 'Severity Level';
        //     $history->previous =  $lastDocument->severity_level;
        //     $history->current = $root->severity_level;
        //     $history->comment = $request->comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->severity_level) || $lastDocument->severity_level === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        if ($lastDocument->assign_to != $root->assign_to || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Responsible department Head';
            $history->previous = Helpers::getInitiatorName($root->assign_to);
            $history->current = Helpers::getInitiatorName($root->assign_to);
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
            $history->previous = Helpers::getInitiatorName($lastDocument->qa_reviewer);
            $history->current = Helpers::getInitiatorName($root->qa_reviewer);
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

        if ($lastDocument->due_date != $root->due_date || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Due Date';
            $history->previous = Helpers::getdateFormat($lastDocument->due_date);
            $history->current = Helpers::getdateFormat($root->due_date);
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

        if ($lastDocument->department != $root->department || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Responsible Department';
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

        //---------------------------------------------------------------------------

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

        if ($lastDocument->comments != $root->comments || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Comments';
            $history->previous = $lastDocument->comments;
            $history->current = $root->comments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->comments) || $lastDocument->comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->root_cause_initial_attachment != $root->root_cause_initial_attachment || !empty($request->comment)) {

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

        if ($lastDocument->related_url != $root->related_url || !empty($request->comment)) {

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
            $history->activity_type = 'Problem Statement';
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
            $history->activity_type = 'Background';
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

        if ($lastDocument->root_cause_methodology != $root->root_cause_methodology || !empty($request->comment)) {

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

        if ($lastDocument->cft_comments_new != $root->cft_comments_new || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'QA Review Comments';
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

        if ($lastDocument->cft_attchament_new != $root->cft_attchament_new || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'QA Review Attachment';
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
            $history->activity_type = 'CAPA';
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

        if ($lastDocument->root_cause_initial_attachment_rca != $root->root_cause_initial_attachment_rca || !empty($request->comment)) {

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

        // if ($lastDocument->root_cause_description != $root->root_cause_description|| !empty($request->comment)) {

        //     $history = new RootAuditTrial();
        //     $history->root_id = $id;
        //     $history->activity_type = 'Root Cause Description';
        //     $history->previous = $lastDocument->root_cause_description;
        //     $history->current = $root->root_cause_description;
        //     $history->comment = $request->comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //         if (is_null($lastDocument->root_cause_description) || $lastDocument->root_cause_description === '') {
        //             $history->action_name = "New";
        //         } else {
        //             $history->action_name = "Update";
        //         }
        //     $history->save();
        // }

        // if ($lastDocument->investigation_summary != $root->investigation_summary|| !empty($request->comment)) {

        //     $history = new RootAuditTrial();
        //     $history->root_id = $id;
        //     $history->activity_type = 'Investigation Summary';
        //     $history->previous = $lastDocument->investigation_summary;
        //     $history->current = $root->investigation_summary;
        //     $history->comment = $request->comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //         if (is_null($lastDocument->investigation_summary) || $lastDocument->investigation_summary === '') {
        //             $history->action_name = "New";
        //         } else {
        //             $history->action_name = "Update";
        //         }
        //     $history->save();
        // }

        // if ($lastDocument->cft_attchament_new != $root->cft_attchament_new|| !empty($request->comment)) {

        //     $history = new RootAuditTrial();
        //     $history->root_id = $id;
        //     $history->activity_type = 'Final Attachment';
        //     $history->previous = $lastDocument->cft_attchament_new;
        //     $history->current = $root->cft_attchament_new;
        //     $history->comment = $request->comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //         if (is_null($lastDocument->cft_attchament_new) || $lastDocument->cft_attchament_new === '') {
        //             $history->action_name = "New";
        //         } else {
        //             $history->action_name = "Update";
        //         }
        //     $history->save();
        // }

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


        if ($lastDocument->hod_final_comments != $root->hod_final_comments || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'HOD Final Review Comments';
            $history->previous = $lastDocument->hod_final_comments;
            $history->current = $root->hod_final_comments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->hod_final_comments) || $lastDocument->hod_final_comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->hod_final_attachments != $root->hod_final_attachments || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'HOD Final Review Attachment';
            $history->previous = $lastDocument->hod_final_attachments;
            $history->current = $root->hod_final_attachments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->hod_final_attachments) || $lastDocument->hod_final_attachments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->qa_final_comments != $root->qa_final_comments || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'QA Final Final Comments';
            $history->previous = $lastDocument->qa_final_comments;
            $history->current = $root->qa_final_comments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->qa_final_comments) || $lastDocument->qa_final_comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->qa_final_attachments != $root->qa_final_attachments || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'QA Final Review Attachment';
            $history->previous = $lastDocument->qa_final_attachments;
            $history->current = $root->qa_final_attachments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->qa_final_attachments) || $lastDocument->qa_final_attachments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->qah_final_comments != $root->qah_final_comments || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'QAH/CQAH Final Approval Comment';
            $history->previous = $lastDocument->qah_final_comments;
            $history->current = $root->qah_final_comments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->qah_final_comments) || $lastDocument->qah_final_comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastDocument->hod_comments != $root->hod_comments || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'HOD Review Comment ';
            $history->previous = $lastDocument->hod_comments;
            $history->current = $root->hod_comments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->hod_comments) || $lastDocument->hod_comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastDocument->qah_final_attachments != $root->qah_final_attachments || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'QAH/CQAH Final Approval Attachments';
            $history->previous = $lastDocument->qah_final_attachments;
            $history->current = $root->qah_final_attachments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->qah_final_attachments) || $lastDocument->qah_final_attachments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastDocument->hod_attachments != $root->hod_attachments || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'HOD Review Attachments';
            $history->previous = $lastDocument->hod_attachments;
            $history->current = $root->hod_attachments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->hod_attachments) || $lastDocument->hod_attachments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // $lastDocument = RootAuditTrial::where('root_id', $root->id)->orderBy('created_at', 'desc')->first();

        // $Fishbone_or_ishikawa_diagram = [
        //     'measurement' => 'Measurement ',
        //     'materials' => 'Materials ',
        //     'methods' => 'Methods ',
        //     'environment' => 'Environment ',
        //     'manpower' => 'Manpower ',
        //     'machine' => 'Machine',
        //     'problem_statement' => 'Problem Statement ',
        // ];

        // foreach ($Fishbone_or_ishikawa_diagram as $key => $value) {
        //     // Get the current value from the request
        //     $currentValue = !empty($request->$key) ? (is_array($request->$key) ? implode(', ', $request->$key) : $request->$key) : '';

        //     // Get the previous value from the last document
        //     if ($lastDocument) {
        //         $previousValue = !empty($lastDocument->$key) ? (is_array($lastDocument->$key) ? implode(', ', $lastDocument->$key) : $lastDocument->$key) : '';
        //     } else {
        //         $previousValue = '';
        //     }

        //     // Only proceed if current value is not empty and different from previous value or comment is provided
        //     if ($currentValue !== '' && ($previousValue != $currentValue || !empty($request->comment))) {
        //         $history = new RootAuditTrial();
        //         $history->root_id = $root->id;
        //         $history->activity_type = $value;
        //         $history->previous = $previousValue;
        //         $history->current = $currentValue;
        //         $history->comment = !empty($request->comment) ? $request->comment : 'NA';
        //         $history->user_id = Auth::user()->id;
        //         $history->user_name = Auth::user()->name;
        //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //         $history->origin_state = $lastDocument ? $lastDocument->status : '';
        //         $history->change_to = 'Opened';
        //         $history->change_from = $lastDocument ? $lastDocument->status : 'Initiator';
        //         $history->action_name = 'Create';

        //         $history->save();
        //     }
        // }


        //     $lastDocument = RootAuditTrial::where('root_id', $root->id)->orderBy('created_at', 'desc')->first();

        // $why_why_chart = [
        //     'why_problem_statement' => 'Problem Statement',
        //     'why_1' => 'Why 1',
        //     'why_2' => 'Why 2',
        //     'why_3' => 'Why 3',
        //     'why_4' => 'Why 4',
        //     'why_5' => 'Why 5',
        //     'why_root_cause' => 'Root Cause',
        // ];

        // foreach ($why_why_chart as $key => $value) {
        //     // Get the current value from the request
        //     $currentValue = !empty($request->$key) ? (is_array($request->$key) ? implode(', ', $request->$key) : $request->$key) : '';

        //     // Get the previous value from the last document
        //     if ($lastDocument) {
        //         $previousValue = !empty($lastDocument->$key) ? (is_array($lastDocument->$key) ? implode(', ', $lastDocument->$key) : $lastDocument->$key) : '';
        //     } else {
        //         $previousValue = '';
        //     }

        //     // Only proceed if current value is not empty and different from previous value or comment is provided
        //     if ($currentValue !== '' && ($previousValue != $currentValue || !empty($request->comment))) {
        //         $history = new RootAuditTrial();
        //         $history->root_id = $root->id;
        //         $history->activity_type = $value;
        //         $history->previous = $previousValue;
        //         $history->current = $currentValue;
        //         $history->comment = !empty($request->comment) ? $request->comment : 'NA';
        //         $history->user_id = Auth::user()->id;
        //         $history->user_name = Auth::user()->name;
        //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //         $history->origin_state = $lastDocument ? $lastDocument->status : '';
        //         $history->change_to = 'Not Applicable';
        //         $history->change_from = $lastDocument ? $lastDocument->status : 'Initiator';
        //         $history->action_name = 'Update';

        //         $history->save();
        //     }
        // }



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
        //         // Get the current and previous values
        //         $currentValue = !empty($request->$key) ? (is_array($request->$key) ? implode(', ', $request->$key) : $request->$key) : '';
        //         $previousValue = !empty($lastDocument->$key) ? (is_array($lastDocument->$key) ? implode(', ', $lastDocument->$key) : $lastDocument->$key) : '';

        //         // Compare the values
        //         if ($previousValue != $currentValue || !empty($request->comment)) {
        //             $history = new RootAuditTrial();
        //             $history->root_id = $id;
        //             $history->activity_type = $value;
        //             $history->previous = $previousValue;
        //             $history->current = $currentValue;
        //             $history->comment = $request->comment;
        //             $history->user_id = Auth::user()->id;
        //             $history->user_name = Auth::user()->name;
        //             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //             $history->origin_state = $lastDocument->status;
        //             $history->change_to = "Not Applicable";
        //             $history->change_from = $lastDocument->status;
        //             $history->action_name = 'Update';

        //             $history->save();
        //         }
        //     }



        //     $lastDocument = RootAuditTrial::where('root_id', $root->id)->orderBy('created_at', 'desc')->first();

        //     $root_case_grid = [
        //         'Root_Cause_Category' => 'Root Cause Category',
        //         'Root_Cause_Sub_Category' => 'Root Cause Sub Category',
        //         'Probability' => 'Probability',
        //         'Remarks' => 'Remarks',
        //     ];

        //     foreach ($root_case_grid as $key => $value) {
        //         // Get the current value from the request
        //         $currentValue = !empty($request->$key) ? (is_array($request->$key) ? implode(', ', $request->$key) : $request->$key) : '';

        //         // Get the previous value from the last document
        //         if ($lastDocument) {
        //             $previousValue = !empty($lastDocument->$key) ? (is_array($lastDocument->$key) ? implode(', ', $lastDocument->$key) : $lastDocument->$key) : '';
        //         } else {
        //             $previousValue = '';
        //         }

        //         // Only proceed if current value is not empty and different from previous value or comment is provided
        //         if ($currentValue !== '' && ($previousValue != $currentValue || !empty($request->comment))) {
        //             $history = new RootAuditTrial();
        //             $history->root_id = $root->id;
        //             $history->activity_type = $value;
        //             $history->previous = $previousValue;
        //             $history->current = $currentValue;
        //             $history->comment = !empty($request->comment) ? $request->comment : 'NA';
        //             $history->user_id = Auth::user()->id;
        //             $history->user_name = Auth::user()->name;
        //             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //             $history->origin_state = $lastDocument ? $lastDocument->status : '';
        //             $history->change_to = 'Not Applicable';
        //             $history->change_from = $lastDocument ? $lastDocument->status : 'Initiator';
        //             $history->action_name = 'Update';

        //             $history->save();
        //         }
        //     }




        //     $failure_mode_grid = [
        //         'risk_factor' => 'Risk Factor',
        //         'risk_element' => 'Risk element',
        //         'problem_cause' => 'Probable cause of risk element',
        //         'existing_risk_control' => 'Existing Risk Controls',
        //         'initial_severity' => 'Initial Severity',
        //         'initial_probability' => 'Initial Probability',
        //         'initial_detectability' => 'Initial Detectability',
        //         'initial_rpn' => 'Initial RPN',
        //         'risk_acceptance' => 'Risk Acceptance',
        //         'risk_control_measure' => 'Proposed Additional Risk control measure',
        //         'residual_severity' => 'Residual Severity',
        //         'residual_probability' => 'Residual Probability',
        //         'residual_detectability' => 'Residual Detectability',
        //         'residual_rpn' => 'Residual RPN',
        //         'risk_acceptance2' => 'Risk Acceptance',
        //         'mitigation_proposal' => 'Mitigation proposal',
        //     ];

        //     foreach ($failure_mode_grid as $key => $value) {
        //         // Get the current and previous values
        //         $currentValue = !empty($request->$key) ? (is_array($request->$key) ? implode(', ', $request->$key) : $request->$key) : '';
        //         $previousValue = !empty($lastDocument->$key) ? (is_array($lastDocument->$key) ? implode(', ', $lastDocument->$key) : $lastDocument->$key) : '';

        //         // Compare the values
        //         if ($previousValue != $currentValue || !empty($request->comment)) {
        //             $history = new RootAuditTrial();
        //             $history->root_id = $id;
        //             $history->activity_type = $value;
        //             $history->previous = $previousValue;
        //             $history->current = $currentValue;
        //             $history->comment = $request->comment;
        //             $history->user_id = Auth::user()->id;
        //             $history->user_name = Auth::user()->name;
        //             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //             $history->origin_state = $lastDocument->status;
        //             $history->change_to = "Not Applicable";
        //             $history->change_from = $lastDocument->status;
        //             $history->action_name = 'Update';

        //             $history->save();
        //         }
        //     }



        //---------------------------------------------------------------
        // if ($lastDocument->investigators != $root->investigators || !empty($request->comment)) {

        //     $history = new RootAuditTrial();
        //     $history->root_id = $id;
        //     $history->activity_type = 'Investigators';
        //     $history->previous = $lastDocument->investigators;
        //     $history->current = $root->investigators;
        //     $history->comment = $request->investigators_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = 'Update';


        //     $history->save();
        // }
        // if ($lastDocument->cft_attchament_new != $root->cft_attchament_new || !empty($request->comment)) {

        //     $history = new RootAuditTrial();
        //     $history->root_id = $id;
        //     $history->activity_type = 'Attachments';
        //     $history->previous = $lastDocument->attachments;
        //     $history->current = $root->attachments;
        //     $history->comment = $request->attachments_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = 'Update';


        //     $history->save();
        // }
        // if ($lastDocument->comments != $root->comments || !empty($request->comment)) {

        //     $history = new RootAuditTrial();
        //     $history->root_id = $id;
        //     $history->activity_type = 'Comments';
        //     $history->previous = $lastDocument->comments;
        //     $history->current = $root->comments;
        //     $history->comment = $request->comments_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = 'Update';


        //     $history->save();
        // }
        // if ($lastDocument->lab_inv_concl != $root->lab_inv_concl || !empty($request->comment)) {

        //     $history = new RootAuditTrial();
        //     $history->root_id = $id;
        //     $history->activity_type = 'Lab Inv Concl';
        //     $history->previous = $lastDocument->lab_inv_concl;
        //     $history->current = $root->lab_inv_concl;
        //     $history->comment = $request->lab_inv_concl_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = 'Update';


        //     $history->save();
        // }
        // if ($lastDocument->lab_inv_attach != $root->lab_inv_attach || !empty($request->comment)) {

        //     $history = new RootAuditTrial();
        //     $history->root_id = $id;
        //     $history->activity_type = 'lab Inv Attach';
        //     $history->previous = $lastDocument->lab_inv_attach;
        //     $history->current = $root->lab_inv_attach;
        //     $history->comment = $request->lab_inv_attach_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = 'Update';


        //     $history->save();
        // }
        // if ($lastDocument->qc_head_comments != $root->qc_head_comments || !empty($request->comment)) {

        //     $history = new RootAuditTrial();
        //     $history->root_id = $id;
        //     $history->activity_type = 'Qc Head Comments';
        //     $history->previous = $lastDocument->qc_head_comments;
        //     $history->current = $root->qc_head_comments;
        //     $history->comment = $request->qc_head_comments_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = 'Update';


        //     $history->save();
        // }
        // if ($lastDocument->inv_attach != $root->inv_attach || !empty($request->comment)) {

        //     $history = new RootAuditTrial();
        //     $history->root_id = $id;
        //     $history->activity_type = 'Inv Attach';
        //     $history->previous = $lastDocument->inv_attach;
        //     $history->current = $root->inv_attach;
        //     $history->comment = $request->inv_attach_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = 'Update';


        //     $history->save();
        // }
        // if ($lastDocument->due_date != $root->due_date || !empty($request->comment)) {

        //     $history = new RootAuditTrial();
        //     $history->root_id = $id;
        //     $history->activity_type = 'Due Date';
        //     $history->previous = $lastDocument->due_date;
        //     $history->current = $root->due_date;
        //     $history->comment = $request->due_date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = 'Update';


        //     $history->save();
        // }
        // if ($lastDocument->due_date != $root->due_date || !empty($request->comment)) {

        //     $history = new RootAuditTrial();
        //     $history->root_id = $id;
        //     $history->activity_type = 'Due Date';
        //     $history->previous = $lastDocument->due_date;
        //     $history->current = $root->due_date;
        //     $history->comment = $request->due_date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = 'Update';


        //     $history->save();
        // }
        toastr()->success("Record is update Successfully");
        return back();
    }
    public function root_show($id)
    {
        $data = RootCauseAnalysis::find($id);
        if (empty($data)) {
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
                $root->status = 'HOD Review';
                $root->acknowledge_by = Auth::user()->name;
                $root->acknowledge_on = Carbon::now()->format('d-M-Y');
                $root->ack_comments = $request->comment;

                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'Acknowledge By ,Acknowledge On';
                $history->previous = "Opened";
                $history->current = $root->acknowledge_by;
                $history->comment = $request->comment;
                $history->action = 'Acknowledge';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "HOD Review";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Update';

                $history->stage = 'HOD Review';
                if (is_null($lastDocument->acknowledge_by) || $lastDocument->acknowledge_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->acknowledge_by . ' , ' . $lastDocument->acknowledge_on;
                }
                $history->current = $root->acknowledge_by . ' , ' . $root->acknowledge_on;
                if (is_null($lastDocument->acknowledge_by) || $lastDocument->acknowledge_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getHodUserList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "Acknowledge", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: Acknowledge Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }


                $root->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($root->stage == 2) {
                $root->stage = "3";
                $root->status = 'Initial QA/CQA Review';
                $root->HOD_Review_Complete_By = Auth::user()->name;
                $root->HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $root->HOD_Review_Complete_Comment = $request->comment;

                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'HOD Review Complete By,HOD Review Complete On';
                $history->previous = "HOD Review";
                $history->current = $root->HOD_Review_Complete_By;
                $history->comment = $request->comment;
                $history->action = 'HOD Review Complete';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Initial QA/CQA Review";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Update';
                $history->stage = 'Initial QA/CQA Review';
                if (is_null($lastDocument->HOD_Review_Complete_By) || $lastDocument->HOD_Review_Complete_By === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->HOD_Review_Complete_By . ' , ' . $lastDocument->HOD_Review_Complete_On;
                }
                $history->current = $root->HOD_Review_Complete_By . ' , ' . $root->HOD_Review_Complete_On;
                if (is_null($lastDocument->HOD_Review_Complete_By) || $lastDocument->HOD_Review_Complete_By === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getQAUserList($root->division_id);

                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "HOD Review Complete", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Review Complete Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }

                //     $list = Helpers::getCQAUsersList($root->division_id);

                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "HOD Review Complete", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Review Complete Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }

                $root->update();
                toastr()->success('Document Sent');
                return back();
            }



            if ($root->stage == 3) {
                $root->stage = "4";
                $root->status = "Investigation in Progress";
                $root->QQQA_Review_Complete_By = Auth::user()->name;
                $root->QQQA_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $root->QAQQ_Review_Complete_comment = $request->comment;

                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'QA Review Complete By,QA Review Complete On';
                $history->previous = "Initial QA/CQA Review";
                $history->current = $root->QQQA_Review_Complete_By;
                $history->comment = $request->comment;
                $history->action = 'QA Review Complete';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Investigation in Progress";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Update';
                $history->stage = 'Investigation in Progress';
                if (is_null($lastDocument->QQQA_Review_Complete_By) || $lastDocument->QQQA_Review_Complete_By === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->QQQA_Review_Complete_By . ' , ' . $lastDocument->QQQA_Review_Complete_On;
                }
                $history->current = $root->QQQA_Review_Complete_By . ' , ' . $root->QQQA_Review_Complete_On;
                if (is_null($lastDocument->QQQA_Review_Complete_By) || $lastDocument->QQQA_Review_Complete_By === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }


                $history->save();


                // $list = Helpers::getInitiatorUserList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "QA Review Complete", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA Review Complete Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }


                $root->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($root->stage == 4) {
                $root->stage = "5";
                $root->status = 'HOD Final Review';
                $root->submitted_by = Auth::user()->name;
                $root->submitted_on = Carbon::now()->format('d-M-Y');
                $root->qa_comments_new = $request->comment;

                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'Submited By,Submited On';
                $history->previous = "Investigation in Progress";
                $history->current = $root->submitted_by;
                $history->comment = $request->comment;
                $history->action = 'Submit';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "HOD Final Review";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Update';
                $history->stage = 'HOD Final Review';
                if (is_null($lastDocument->submitted_by) || $lastDocument->submitted_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->submitted_by . ' , ' . $lastDocument->submitted_on;
                }
                $history->current = $root->submitted_by . ' , ' . $root->submitted_on;
                if (is_null($lastDocument->submitted_by) || $lastDocument->submitted_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getHodUserList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "Submit", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: Submit Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }


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
            if ($root->stage == 5) {
                $root->stage = "6";
                $root->status = "Final QA/CQA Review";
                $root->HOD_Final_Review_Complete_By = Auth::user()->name;
                $root->HOD_Final_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $root->HOD_Final_Review_Complete_Comment = $request->comment;

                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'HOD Final Review Complete By,HOD Final Review Complete On';
                $history->previous = "HOD Final Review";
                $history->current = $root->HOD_Final_Review_Complete_By;
                $history->action = 'HOD Final Review Complete';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Final QA/CQA Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Final QA/CQA Review';
                $history->action_name = 'Update';
                if (is_null($lastDocument->HOD_Final_Review_Complete_By) || $lastDocument->HOD_Final_Review_Complete_By === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->HOD_Final_Review_Complete_By . ' , ' . $lastDocument->HOD_Final_Review_Complete_On;
                }
                $history->current = $root->HOD_Final_Review_Complete_By . ' , ' . $root->HOD_Final_Review_Complete_On;
                if (is_null($lastDocument->HOD_Final_Review_Complete_By) || $lastDocument->HOD_Final_Review_Complete_By === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getQAUserList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "HOD Final Review Complete", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Final Review Complete Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }

                //     $list = Helpers::getCQAUsersList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "HOD Final Review Complete", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Final Review Complete Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }

                $root->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($root->stage == 6) {
                $root->stage = "7";
                $root->status = "QAH/CQAH Final Review";
                $root->Final_QA_Review_Complete_By = Auth::user()->name;
                $root->Final_QA_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $root->Final_QA_Review_Complete_Comment = $request->comment;


                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'Final QA/CQA Review Complete By,Final QA/CQA Review Complete ON';
                // $history->previous = $lastDocument;
                $history->current = $root->Final_QA_Review_Complete_By;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->action = 'Final QA/CQA Review Complete';
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to =   "QAH/CQAH Final Review";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Update';

                $history->stage = 'QAH/CQAH Final Review';
                if (is_null($lastDocument->Final_QA_Review_Complete_By) || $lastDocument->Final_QA_Review_Complete_By === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->Final_QA_Review_Complete_By . ' , ' . $lastDocument->Final_QA_Review_Complete_On;
                }
                $history->current = $root->Final_QA_Review_Complete_By . ' , ' . $root->Final_QA_Review_Complete_On;
                if (is_null($lastDocument->Final_QA_Review_Complete_By) || $lastDocument->Final_QA_Review_Complete_By === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getQAHeadUserList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "Final QA/CQA Review Complete", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: Final QA/CQA Review Complete Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }

                // $list = Helpers::getCQAHeadUsersList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "Final QA/CQA Review Complete", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: Final QA/CQA Review Complete Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }

                $root->update();
                toastr()->success('Document Sent');
                return back();
            }


            if ($root->stage == 7) {
                $root->stage = "8";
                $root->status = "Closed - Done";
                $root->evaluation_complete_by = Auth::user()->name;
                $root->evaluation_complete_on = Carbon::now()->format('d-M-Y');
                $root->evalution_Closure_comment = $request->comment;
                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->activity_type = 'QAH/CQAH Closure By,QAH/CQAH Closure On';
                $history->previous = $lastDocument->submitted_by;
                $history->current = $root->evaluation_complete_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->action = 'QAH/CQAH Closure';
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                // $history->origin_state = $lastDocument->status;
                $history->change_to =   "Closed - Done";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Update';
                // $history->stage = 'Completed';


                $history->stage = 'Closed - Done';
                if (is_null($lastDocument->evaluation_complete_by) || $lastDocument->evaluation_complete_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->evaluation_complete_by . ' , ' . $lastDocument->evaluation_complete_on;
                }
                $history->current = $root->evaluation_complete_by . ' , ' . $root->evaluation_complete_on;
                if (is_null($lastDocument->evaluation_complete_by) || $lastDocument->evaluation_complete_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getQAUserList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "QAH/CQAH Closure", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: QAH/CQAH Closure Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }

                //     $list = Helpers::getInitiatorUserList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "QAH/CQAH Closure", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: QAH/CQAH Closure Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }

                //     $list = Helpers::getHodUserList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "QAH/CQAH Closure", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: QAH/CQAH Closure Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }


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
            $history->activity_type = 'Cancelled By,Cancelled On';
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

            $history->stage = 'Cancelled ';
            if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                $history->previous = "";
            } else {
                $history->previous = $lastDocument->cancelled_by . ' , ' . $lastDocument->cancelled_on;
            }
            $history->current = $root->cancelled_by . ' , ' . $root->cancelled_on;
            if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                $history->action_name = 'New';
            } else {
                $history->action_name = 'Update';
            }
            $history->save();

            // $list = Helpers::getQAUserList($root->division_id);
            //         foreach ($list as $u) {
            //             // if($u->q_m_s_divisions_id == $root->division_id){
            //                 $email = Helpers::getUserEmail($u->user_id);
            //                     if ($email !== null) {
            //                     Mail::send(
            //                         'mail.view-mail',
            //                         ['data' => $root, 'site'=>"RCA", 'history' => "Cancel", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //                         function ($message) use ($email, $root) {
            //                             $message->to($email)
            //                             ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: Cancel Performed");
            //                         }
            //                     );
            //                 }
            //             // }
            //         }

            // $list = Helpers::getHodUserList($root->division_id);
            //         foreach ($list as $u) {
            //             // if($u->q_m_s_divisions_id == $root->division_id){
            //                 $email = Helpers::getUserEmail($u->user_id);
            //                     if ($email !== null) {
            //                     Mail::send(
            //                         'mail.view-mail',
            //                         ['data' => $root, 'site'=>"RCA", 'history' => "Cancel", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //                         function ($message) use ($email, $root) {
            //                             $message->to($email)
            //                             ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: Cancel Performed");
            //                         }
            //                     );
            //                 }
            //             // }
            //         }


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
            $root = RootCauseAnalysis::find($id);
            // $root = RootCauseAnalysis::find($id);
            $lastDocument =  RootCauseAnalysis::find($id);

            if ($root->stage == 2) {
                $root->stage = "1";
                $root->status = "Opened";

                $root->More_Info_ack_by = Auth::user()->name;
                $root->More_Info_ack_on = Carbon::now()->format('d-M-Y');
                $root->More_Info_ack_comment = $request->comment;

                // $capa->cft_comments_new = $request->comment;

                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->previous = "Not Applicable";
                $history->activity_type = 'Not Applicable';
                $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->action  = "More Information Required";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Opened";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Not Applicable";
                $history->stage = 'Opened';
                // if (is_null($lastDocument->More_Info_ack_by) || $lastDocument->More_Info_ack_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->More_Info_ack_by . ' , ' . $lastDocument->More_Info_ack_on;
                // }
                // $history->current = $capa->More_Info_ack_by . ' , ' . $capa->More_Info_ack_on;
                // if (is_null($lastDocument->More_Info_ack_by) || $lastDocument->More_Info_ack_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name ="Not Applicable";
                // }
                $history->save();

                // $list = Helpers::getInitiatorUserList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "More Info Required", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }



                $root->update();


                toastr()->success('Document Sent');
                return back();
            }

            if ($root->stage == 3) {
                $root->stage = "2";
                $root->status = "HOD Review";

                $root->More_Info_hrc_by = Auth::user()->name;
                $root->More_Info_hrc_on = Carbon::now()->format('d-M-Y');
                $root->More_Info_hrc_comment = $request->comment;

                // $capa->cft_comments_new = $request->comment;

                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->previous = "Not Applicable";
                $history->activity_type = 'Not Applicable';
                // $history->previous = $lastDocument->More_Info_hrc_by;
                $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->action  = "More Information Required";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "HOD Review";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Not Applicable";
                $history->stage = 'HOD Review';
                // if (is_null($lastDocument->More_Info_hrc_by) || $lastDocument->More_Info_hrc_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->More_Info_hrc_by . ' , ' . $lastDocument->More_Info_hrc_on;
                // }
                // $history->current = $capa->More_Info_hrc_by . ' , ' . $capa->More_Info_hrc_on;
                // if (is_null($lastDocument->More_Info_hrc_by) || $lastDocument->More_Info_hrc_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name ="Not Applicable";
                // }
                $history->save();

                // $list = Helpers::getHodUserList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "More Info Required", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }



                $root->update();


                toastr()->success('Document Sent');
                return back();
            }
            if ($root->stage == 4) {
                $root->stage = "3";
                $root->status = "Initial QA/CQA Review";

                $root->More_Info_qac_by = Auth::user()->name;
                $root->More_Info_qac_on = Carbon::now()->format('d-M-Y');
                $root->More_Info_qac_comment = $request->comment;

                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->previous = "Not Applicable";
                $history->activity_type = 'Not Applicable';
                // $history->previous = $lastDocument->More_Info_qac_by;
                $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->action  = "More Information Required";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Initial QA/CQA Review";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Not Applicable";
                $history->stage = 'Initial QA/CQA Review';
                // if (is_null($lastDocument->More_Info_qac_by) || $lastDocument->More_Info_qac_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->More_Info_qac_by . ' , ' . $lastDocument->More_Info_qac_on;
                // }
                // $history->current = $capa->More_Info_qac_by . ' , ' . $capa->More_Info_qac_on;
                // if (is_null($lastDocument->More_Info_qac_by) || $lastDocument->More_Info_qac_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name ="Not Applicable";
                // }
                $history->save();

                // $list = Helpers::getQAUserList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "More Info Required", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }

                //     $list = Helpers::getCQAUsersList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "More Info Required", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }



                $root->update();

                toastr()->success('Document Sent');
                return back();
            }
            if ($root->stage == 5) {
                $root->stage = "4";
                $root->status = "Investigation in Progress";

                $root->More_Info_sub_by = Auth::user()->name;
                $root->More_Info_sub_on = Carbon::now()->format('d-M-Y');
                $root->More_Info_sub_comment = $request->comment;

                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->previous = "Not Applicable";
                $history->activity_type = 'Not Applicable';
                // $history->previous = $lastDocument->More_Info_sub_by;
                $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->action  = "More Information Required";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Investigation in Progress";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Not Applicable";
                $history->stage = 'Investigation in Progress';
                // if (is_null($lastDocument->More_Info_sub_by) || $lastDocument->More_Info_sub_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->More_Info_sub_by . ' , ' . $lastDocument->More_Info_sub_on;
                // }
                // $history->current = $capa->More_Info_sub_by . ' , ' . $capa->More_Info_sub_on;
                // if (is_null($lastDocument->More_Info_sub_by) || $lastDocument->More_Info_sub_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name ="Not Applicable";
                // }
                $history->save();

                // $list = Helpers::getInitiatorUserList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "More Info Required", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }



                $root->update();

                toastr()->success('Document Sent');
                return back();
            }
            if ($root->stage == 6) {
                $root->stage = "5";
                $root->status = "HOD Final Review";

                $root->More_Info_hfr_by = Auth::user()->name;
                $root->More_Info_hfr_on = Carbon::now()->format('d-M-Y');
                $root->More_Info_hfr_comment = $request->comment;

                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->previous = "Not Applicable";
                $history->activity_type = 'Not Applicable';
                // $history->previous = $lastDocument->More_Info_hfr_by;
                $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->action  = "More Information Required";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "HOD Final Review";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Not Applicable";
                $history->stage = 'HOD Final Review';
                // if (is_null($lastDocument->More_Info_hfr_by) || $lastDocument->More_Info_hfr_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->More_Info_hfr_by . ' , ' . $lastDocument->More_Info_hfr_on;
                // }
                // $history->current = $capa->More_Info_hfr_by . ' , ' . $capa->More_Info_hfr_on;
                // if (is_null($lastDocument->More_Info_hfr_by) || $lastDocument->More_Info_hfr_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name ="Not Applicable";
                // }
                $history->save();

                // $list = Helpers::getHodUserList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "More Info Required", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }



                $root->update();

                toastr()->success('Document Sent');
                return back();
            }
            if ($root->stage == 7) {
                $root->stage = "6";
                $root->status = "Final QA/CQA Review";

                $root->qA_review_complete_by = Auth::user()->name;
                $root->qA_review_complete_on = Carbon::now()->format('d-M-Y');
                $root->qA_review_complete_comment = $request->comment;
                $history = new RootAuditTrial();
                $history->root_id = $id;
                $history->previous = "Not Applicable";
                $history->activity_type = 'Not Applicable';
                // $history->previous = $lastDocument->qA_review_complete_by;
                $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->action  = "More Information Required";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Final QA/CQA Review";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Not Applicable";
                $history->stage = 'Final QA/CQA Review';
                // if (is_null($lastDocument->qA_review_complete_by) || $lastDocument->qA_review_complete_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->qA_review_complete_by . ' , ' . $lastDocument->qA_review_complete_on;
                // }
                // $history->current = $capa->qA_review_complete_by . ' , ' . $capa->qA_review_complete_on;
                // if (is_null($lastDocument->qA_review_complete_by) || $lastDocument->qA_review_complete_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name ="Not Applicable";
                // }
                $history->save();

                // $list = Helpers::getQAUserList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "More Info Required", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }

                //     $list = Helpers::getCQAUsersList($root->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $root->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $root, 'site'=>"RCA", 'history' => "More Info Required", 'process' => 'Root Cause Analysis', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $root) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Root Cause Analysis, Record #" . str_pad($root->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required Performed");
                //                     }
                //                 );
                //             }
                //         // }
                //     }



                $root->update();

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
    public function child_r_c_a(Request $request, $id)
    {
        $parent_id = $id;
        $parent_initiator_id = RootCauseAnalysis::where('id', $id)->value('initiator_id');
        $parent_type = "Action-Item";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $parent_record = $record_number;
        $currentDate = Carbon::now();
        $parent_intiation_date = $currentDate;
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $old_record = RootCauseAnalysis::select('id', 'division_id', 'record')->get();
        $record = $record_number;
        return view('frontend.action-item.action-item', compact('parent_intiation_date', 'parent_initiator_id', 'parent_record', 'record', 'due_date', 'parent_id', 'parent_type', 'old_record'));
    }
    public function RCAChildRoot(Request $request, $id)
    {
        $cc = RootCauseAnalysis::find($id);
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
            $record = $record_number;
            $old_records = $old_record;
            $relatedRecords = Helpers::getAllRelatedRecords();
            return view('frontend.forms.capa', compact('record_number', 'due_date', 'parent_id', 'parent_type', 'old_records', 'cft', 'relatedRecords'));
        }

        if ($request->revision == "Action-Item") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.forms.action-item', compact('record_number', 'due_date', 'parent_id', 'parent_type', 'parent_intiation_date', 'parent_record', 'parent_initiator_id'));
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
