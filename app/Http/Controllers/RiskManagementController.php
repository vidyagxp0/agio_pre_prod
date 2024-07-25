<?php

namespace App\Http\Controllers;

use App\Models\RecordNumber;
use App\Models\RiskAuditTrail;
use App\Models\RiskManagement;
use App\Models\RiskAssesmentGrid;
use App\Models\RoleGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

use PDF;
use Helpers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;

class RiskManagementController extends Controller
{

    public function risk()
    {
        $old_record = RiskManagement::select('id', 'division_id', 'record')->get();
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');


        return view("frontend.forms.risk-management", compact('due_date', 'record_number', 'old_record'));
    }

    public function store(Request $request)
    {
        // return dd($request);
        // return $request;



        if (!$request->short_description) {
            toastr()->info("Short Description is required");
            return redirect()->back()->withInput();
        }
        // return $request;
        $data = new RiskManagement();
        $data->form_type = "risk-assesment";
        $data->division_id = $request->division_id;
        $data->division_code = $request->division_code;
        //$data->record_number = $request->record_number;
        $data->record = ((RecordNumber::first()->value('counter')) + 1);
        $data->initiator_id = Auth::user()->id;
        $data->short_description = $request->short_description;
        $data->intiation_date = $request->intiation_date;
        $data->open_date = $request->open_date;
        $data->assign_to = $request->assign_to;
        $data->due_date = $request->due_date;
        $data->Initiator_Group = $request->Initiator_Group;
        $data->initiator_group_code = $request->initiator_group_code;
       // $data->departments = implode(',', $request->departments);

       $data->departments = is_array($request->departments) ? implode(',', $request->departments) : '';

        // $data->team_members = implode(',', $request->team_members);
        $data->source_of_risk = $request->source_of_risk;
        $data->source_of_risk2 = $request->source_of_risk2;
        $data->type = $request->type;
        $data->priority_level = $request->priority_level;
        $data->zone = $request->zone;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->city = $request->city;
        $data->description = $request->description;
        $data->severity2_level = $request->severity2_level;
        $data->comments = $request->comments;
       // $data->departments2 = implode(',', $request->departments2);
       $data->departments2 = is_array($request->departments2) ? implode(',', $request->departments2) : '';
 
       $data->site_name = $request->site_name;
        $data->building = $request->building;
        $data->floor = $request->floor;
        $data->room = $request->room;
        $data->related_record = json_encode($request->related_record);
        $data->duration = $request->duration;
        $data->hazard = $request->hazard;
        $data->room2 = $request->room2;
        $data->regulatory_climate = $request->regulatory_climate;
        $data->Number_of_employees = $request->Number_of_employees;
        $data->risk_management_strategy = $request->risk_management_strategy;
        $data->estimated_man_hours = $request->estimated_man_hours;
        $data->schedule_start_date1 = $request->schedule_start_date1;
        $data->schedule_end_date1 = $request->schedule_end_date1;
        $data->estimated_cost = $request->estimated_cost;
        $data->currency = $request->currency;
        $data->root_cause_methodology = is_array($request->root_cause_methodology) ? implode(',', $request->root_cause_methodology) : '';
       
        $data->risk_level = $request->input('risk_level');
        $data->risk_level_2 = $request->input('risk_level_2');
        $data->purpose = $request->input('purpose');
        $data->scope = $request->input('scope');
        $data->reason_for_revision = $request->input('reason_for_revision');
        $data->Brief_description = $request->input('Brief_description');
        $data->document_used_risk = $request->input('document_used_risk');
        $data->risk_level3 = $request->input('risk_level3');

       
        // $data->risk_level = serialize($request->input('risk_level'));
        // $data->risk_level_2 = serialize($request->input('risk_level_2'));
        // $data->purpose = serialize($request->input('purpose'));
        // $data->scope = serialize($request->input('scope'));
        // $data->reason_for_revision = serialize($request->input('reason_for_revision'));
        // $data->Brief_description = serialize($request->input('Brief_description'));
        // $data->document_used_risk = serialize($request->input('document_used_risk'));
        // $data->risk_level3 = serialize($request->input('risk_level3'));

       
        // $data->root_cause_methodology = implode(',', $request->root_cause_methodology);
        // $data->measurement = json_encode($request->measurement);
        // $data->materials = json_encode($request->materials);
        // $data->methods = json_encode($request->methods);
        // $data->environment = json_encode($request->environment);
        //$data->manpower = json_encode($request->manpower);
        //$data->machine = json_encode($request->machine);
        //$data->problem_statement1 = ($request->problem_statement1);
        // $data->why_problem_statement = $request->why_problem_statement;
        // $data->why_1 = json_encode($request->why_1);
        // $data->why_2 = json_encode($request->why_2);
        // $data->why_3 = json_encode($request->why_3);
        // $data->why_4 = json_encode($request->why_4);
        // $data->why_5 = json_encode($request->why_5);
        // $data->root_cause = $request->root_cause;
        // $data->what_will_be = $request->what_will_be;
        // $data->what_will_not_be = $request->what_will_not_be;
        // $data->what_rationable = $request->what_rationable;
        // $data->where_will_be = $request->where_will_be;
        // $data->where_will_not_be = $request->where_will_not_be;
        // $data->where_rationable = $request->where_rationable;
        // $data->when_will_be = $request->when_will_be;
        // $data->when_will_not_be = $request->when_will_not_be;
        // $data->when_rationable = $request->when_rationable;
        // $data->coverage_will_be = $request->coverage_will_be;
        // $data->coverage_will_not_be = $request->coverage_will_not_be;
        // $data->coverage_rationable = $request->coverage_rationable;
        // $data->who_will_be = $request->who_will_be;
        // $data->who_will_not_be = $request->who_will_not_be;
        // $data->who_rationable = $request->who_rationable;
        // $data->training_require = $request->training_require;
        $data->justification = $request->justification;
        $data->cost_of_risk = $request->cost_of_risk;
        $data->environmental_impact = $request->environmental_impact;
        $data->public_perception_impact = $request->public_perception_impact;
        $data->calculated_risk = $request->calculated_risk;
        $data->impacted_objects = $request->impacted_objects;
        $data->severity_rate = $request->severity_rate;
        $data->occurrence = $request->occurrence;
        $data->detection = $request->detection;
        $data->detection2 = $request->detection2;
        $data->rpn = $request->rpn;
        //  return $data;
        $data->residual_risk = $request->residual_risk;
        $data->residual_risk_impact = $request->residual_risk_impact;
        $data->residual_risk_probability = $request->residual_risk_probability;
        $data->analysisN2 = $request->analysisN2;
        $data->analysisRPN2 = $request->analysisRPN2;
        $data->rpn2 = $request->rpn2;
        $data->comments2 = $request->comments2;
        $data->root_cause_description = $request->root_cause_description;
        $data->investigation_summary = $request->investigation_summary;
        $data->mitigation_required = $request->mitigation_required;
        $data->mitigation_plan = $request->mitigation_plan;
        $data->mitigation_due_date = $request->mitigation_due_date;
        $data->mitigation_status = $request->mitigation_status;
        $data->mitigation_status_comments = $request->mitigation_status_comments;
        $data->impact = $request->impact;
        $data->criticality = $request->criticality;
        $data->impact_analysis = $request->impact_analysis;
        $data->risk_analysis = $request->risk_analysis;
        $data->due_date_extension = $request->due_date_extension;
        // $data->initial_rpn = $request->initial_rpn;
        //$data->severity = $request->severity;
        //$data->occurance = $request->occurance;
       // $data->refrence_record =  implode(',', $request->refrence_record);
       $data->refrence_record = is_array($request->refrence_record) ? implode(',', $request->refrence_record) : '';
      
      
      
      
       if (!empty($request->risk_attachment)) {
        $files = [];
        if ($request->hasfile('risk_attachment')) {
            foreach ($request->file('risk_attachment') as $file) {
                $name = $request->name . 'risk_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] = $name;
            }
        }


        $data->risk_attachment = json_encode($files);
    }


        if (!empty($request->reference)) {
            $files = [];
            if ($request->hasfile('reference')) {
                foreach ($request->file('reference') as $file) {
                    $name = $request->name . 'reference' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $data->reference = json_encode($files);
        }
        $data->status = 'Opened';
        $data->stage = 1;
        // return $data;
        $data->save();

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();



        // -----------grid=------
        $data1 = new RiskAssesmentGrid();

        
        $data1->risk_id = $data->id;
        $data1->type = "effect_analysis";
        if (!empty($request->risk_factor)) {
            $data1->risk_factor = serialize($request->risk_factor);
        }
        if (!empty($request->risk_element)) {
            $data1->risk_element = serialize($request->risk_element);
        }
        if (!empty($request->problem_cause)) {
            $data1->problem_cause = serialize($request->problem_cause);
        }
        if (!empty($request->existing_risk_control)) {
            $data1->existing_risk_control = serialize($request->existing_risk_control);
        }
        if (!empty($request->initial_severity)) {
            $data1->initial_severity = serialize($request->initial_severity);
        }
        if (!empty($request->initial_detectability)) {
            $data1->initial_detectability = serialize($request->initial_detectability);
        }
        if (!empty($request->initial_probability)) {
            $data1->initial_probability = serialize($request->initial_probability);
        }
        if (!empty($request->initial_rpn)) {
            $data1->initial_rpn = serialize($request->initial_rpn);
        }
        if (!empty($request->risk_acceptance)) {
            $data1->risk_acceptance = serialize($request->risk_acceptance);
        }
        if (!empty($request->risk_control_measure)) {
            $data1->risk_control_measure = serialize($request->risk_control_measure);
        }
        if (!empty($request->residual_severity)) {
            $data1->residual_severity = serialize($request->residual_severity);
        }
        if (!empty($request->residual_probability)) {
            $data1->residual_probability = serialize($request->residual_probability);
        }
        if (!empty($request->residual_detectability)) {
            $data1->residual_detectability = serialize($request->residual_detectability);
        }
        if (!empty($request->residual_rpn)) {
            $data1->residual_rpn = serialize($request->residual_rpn);
        }
        
        if (!empty($request->risk_acceptance2)) {
            $data1->risk_acceptance2 = serialize($request->risk_acceptance2);
        }
        if (!empty($request->mitigation_proposal)) {
            $data1->mitigation_proposal = serialize($request->mitigation_proposal);
        }

        $data1->save();

        // ---------------------------------------
        $data2 = new RiskAssesmentGrid();
        $data2->risk_id = $data->id;
        $data2->type = "fishbone";

        if (!empty($request->measurement)) {
            $data2->measurement = serialize($request->measurement);
        }
        if (!empty($request->materials)) {
            $data2->materials = serialize($request->materials);
        }
        if (!empty($request->methods)) {
            $data2->methods = serialize($request->methods);
        }
        if (!empty($request->environment)) {
            $data2->environment = serialize($request->environment);
        }
        if (!empty($request->manpower)) {
            $data2->manpower = serialize($request->manpower);
        }
        
        if (!empty($request->machine)) {
            $data2->machine = serialize($request->machine);
        }
        
        if (!empty($request->problem_statement)) {
            $data2->problem_statement = $request->problem_statement;
        }
        $data2->save();
        // =-------------------------------

        $data3 = new RiskAssesmentGrid();
        $data3->risk_id = $data->id;
        $data3->type = "why_chart";
        if (!empty($request->why_problem_statement)) {
            $data3->why_problem_statement = $request->why_problem_statement;
        }
        if (!empty($request->why_1)) {
            $data3->why_1 = serialize($request->why_1);
        }
        if (!empty($request->why_2)) {
            $data3->why_2 = serialize($request->why_2);
        }
        if (!empty($request->why_3)) {
            $data3->why_3 = serialize($request->why_3);
        }
        if (!empty($request->why_4)) {
            $data3->why_4 = serialize($request->why_4);
        }
       
        if (!empty($request->why_5)) {
            $data3->why_5 = serialize($request->why_5);
        }
    //    dd($request->why_root_cause);
        if (!empty($request->why_root_cause)) {
            $data3->why_root_cause = $request->why_root_cause;
        }
        
        $data3->save();

        // --------------------------------------------
        $data4 = new RiskAssesmentGrid();
        $data4->risk_id = $data->id;
        $data4->type = "what_who_where";
        if (!empty($request->what_will_be)) {
            $data4->what_will_be = $request->what_will_be;
        }
        if (!empty($request->what_will_not_be)) {
            $data4->what_will_not_be = $request->what_will_not_be;
        }
        if (!empty($request->what_rationable)) {
            $data4->what_rationable = $request->what_rationable;
        }
        if (!empty($request->where_will_be)) {
            $data4->where_will_be = $request->where_will_be;
        }
        if (!empty($request->where_will_not_be)) {
            $data4->where_will_not_be = $request->where_will_not_be;
        }
        if (!empty($request->where_rationable)) {
            $data4->where_rationable = $request->where_rationable;
        }
        if (!empty($request->coverage_will_be)) {
            $data4->coverage_will_be = $request->coverage_will_be;
        }
        if (!empty($request->coverage_will_not_be)) {
            $data4->coverage_will_not_be = $request->coverage_will_not_be;
        }
        if (!empty($request->coverage_rationable)) {
            $data4->coverage_rationable = $request->coverage_rationable;
        }
        if (!empty($request->who_will_be)) {
            $data4->who_will_be = $request->who_will_be;
        }
        if (!empty($request->who_will_not_be)) {
            $data4->who_will_not_be = $request->who_will_not_be;
        }
        if (!empty($request->who_rationable)) {
            $data4->who_rationable = $request->who_rationable;
        } if (!empty($request->when_will_be)) {
            $data4->when_will_be = $request->when_will_be;
        }
         if (!empty($request->when_will_not_be)) {
            $data4->when_will_not_be = $request->when_will_not_be;
        }
         if (!empty($request->when_rationable)) {
            $data4->when_rationable = $request->when_rationable;
        }
        $data4->save();


        $data5 = new RiskAssesmentGrid();
        $data5->risk_id = $data->id;
        $data5->type = "Action_Plan";

        if (!empty($request->action)) {
            $data5->action = serialize($request->action);
        }
        if (!empty($request->responsible)) {
            $data5->responsible = serialize($request->responsible);
        }
        if (!empty($request->deadline)) {
            $data5->deadline = serialize($request->deadline);
        }
        if (!empty($request->item_static)) {
            $data5->item_static = serialize($request->item_static);
        }

        $data5->save();

        $data6 = new RiskAssesmentGrid();
        $data6->risk_id = $data->id;
        $data6->type = "Mitigation_Plan_Details";

        if (!empty($request->mitigation_steps)) {
            $data6->mitigation_steps = serialize($request->mitigation_steps);
        }
        if (!empty($request->deadline2)) {
            $data6->deadline2 = serialize($request->deadline2);
        }
        if (!empty($request->responsible_person)) {
            $data6->responsible_person = serialize($request->responsible_person);
        }
        if (!empty($request->status)) {
            $data6->status = serialize($request->status);
        }
        if (!empty($request->remark)) {
            $data6->remark = serialize($request->remark);
        }

        $data6->save();
        // ------------------------------------------------



        // $lastDocument = RiskAuditTrail::where('risk_id', $data->id)->orderBy('created_at', 'desc')->first();
    

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
        //             $history = new RiskAuditTrail();
        //             $history->risk_id = $data->id;
        //             $history->activity_type = $value;
        //             $history->previous = $previousValue; // Store the previous value
        //             $history->current = $currentValue;
        //             $history->comment = "Not Applicable"; // Add comment if required
        //             $history->user_id = Auth::user()->id;
        //             $history->user_name = Auth::user()->name;
        //             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //             $history->origin_state = $data->status;
        //             $history->change_to = "Opened";
        //             $history->change_from = "Initiation";
        //             $history->action_name = 'Create';
        
        //             $history->save();
        //         }
        //     }
        // }
        


        // $Fishbone_or_ishikawa_diagram = [
        //     'measurement' => 'Measurement',
        //     'materials' => 'Materials ',
        //     'methods' => 'Methods ',
        //     'environment' => 'Environment ',
        //     'manpower' => 'Manpower ',
        //     'machine' => 'Machine ',
        //     'problem_statement' => 'Problem Statement ',
        // ];
        
        // foreach ($Fishbone_or_ishikawa_diagram as $key => $value) {
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
        //             $history = new RiskAuditTrail();
        //             $history->risk_id = $data->id;
        //             $history->activity_type = $value;
        //             $history->previous = $previousValue; // Store the previous value
        //             $history->current = $currentValue;
        //             $history->comment = "Not Applicable"; // Add comment if required
        //             $history->user_id = Auth::user()->id;
        //             $history->user_name = Auth::user()->name;
        //             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //             $history->origin_state = $data->status;
        //             $history->change_to = "Opened";
        //      $history->change_from = "Initiation";
        //             $history->action_name = 'Create';
        
        //             $history->save();
        //         }
        //     }
        // }
        
    















        if (!empty($data->short_description)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $data->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }


        if (!empty($data->purpose)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Purpose';
            $history->previous = "Null";
            $history->current = $data->purpose;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }


        if (!empty($data->scope)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Scope';
            $history->previous = "Null";
            $history->current = $data->scope;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }
        if (!empty($data->reason_for_revision)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Reason for Revision';
            $history->previous = "Null";
            $history->current = $data->reason_for_revision;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }
        if (!empty($data->Brief_description)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Brief Description / Procedure';
            $history->previous = "Null";
            $history->current = $data->Brief_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }
        if (!empty($data->document_used_risk)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Documents Used for Risk Management';
            $history->previous = "Null";
            $history->current = $data->document_used_risk;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }


        if (!empty($data->open_date)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Open Date';
            $history->previous = "Null";
            $history->current = $data->open_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->assign_to)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Assign Id';
            $history->previous = "Null";
            $history->current = $data->assign_to;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->departments)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Departments';
            $history->previous = "Null";
            $history->current = $data->departments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        // if (!empty($data->team_members)) {
        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $data->id;
        //     $history->activity_type = 'Team Members';
        //     $history->previous = "Null";
        //     $history->current = $data->team_members;
        //     $history->comment = "NA";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->save();
        // }

        if (!empty($data->source_of_risk)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Source of Risk/Opportunity';
            $history->previous = "Null";
            $history->current = $data->source_of_risk;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->type)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Type';
            $history->previous = "Null";
            $history->current = $data->type;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->priority_level)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Priority Level';
            $history->previous = "Null";
            $history->current = $data->priority_level;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->zone)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Zone';
            $history->previous = "Null";
            $history->current = $data->zone;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->country)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Country';
            $history->previous = "Null";
            $history->current = $data->country;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->state)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'State/District';
            $history->previous = "Null";
            $history->current = $data->state;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->city)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'City';
            $history->previous = "Null";
            $history->current = $data->city;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->description)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Risk/Opportunity Description';
            $history->previous = "Null";
            $history->current = $data->description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->comments)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Risk/Opportunity Comments';
            $history->previous = "Null";
            $history->current = $data->comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->departments2)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Departments2';
            $history->previous = "Null";
            $history->current = $data->departments2;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->site_name)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Site Name';
            $history->previous = "Null";
            $history->current = $data->site_name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->building)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Building';
            $history->previous = "Null";
            $history->current = $data->building;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->floor)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Floor';
            $history->previous = "Null";
            $history->current = $data->floor;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->room)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Room';
            $history->previous = "Null";
            $history->current = $data->room;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->duration)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Duration';
            $history->previous = "Null";
            $history->current = $data->duration;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->hazard)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Hazard';
            $history->previous = "Null";
            $history->current = $data->hazard;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->room2)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Room2';
            $history->previous = "Null";
            $history->current = $data->room2;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->regulatory_climate)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Regulatory Climate';
            $history->previous = "Null";
            $history->current = $data->regulatory_climate;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->Number_of_employees)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Number Of Employees';
            $history->previous = "Null";
            $history->current = $data->Number_of_employees;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        // if (!empty($internalAudit->refrence_record)) {
        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $data->id;
        //     $history->activity_type = 'Reference Recores';
        //     $history->previous = "Null";
        //     $history->current = $data->refrence_record;
        //     $history->comment = "NA";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->save();
        // }

        if (!empty($data->risk_management_strategy)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Risk Management Strategy';
            $history->previous = "Null";
            $history->current = $data->risk_management_strategy;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }


        if (!empty($data->schedule_start_date1)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Scheduled Start Date';
            $history->previous = "Null";
            $history->current = $data->schedule_start_date1;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }
        if (!empty($data->schedule_end_date1)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Scheduled End Date';
            $history->previous = "Null";
            $history->current = $data->schedule_end_date1;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
           $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->estimated_man_hours)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Estimated  man  Hours';
            $history->previous = "Null";
            $history->current = $data->estimated_man_hours;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->estimated_cost)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Estimated Cost';
            $history->previous = "Null";
            $history->current = $data->estimated_cost;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->currency)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Currency';
            $history->previous = "Null";
            $history->current = $data->currency;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->training_require)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Training Require';
            $history->previous = "Null";
            $history->current = $data->training_require;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->justification)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Justification / Rationale';
            $history->previous = "Null";
            $history->current = $data->justification;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->reference)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Reference';
            $history->previous = "Null";
            $history->current = $data->reference;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->cost_of_risk)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Cost Of Risk';
            $history->previous = "Null";
            $history->current = $data->cost_of_risk;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->environmental_impact)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Environmental Impact';
            $history->previous = "Null";
            $history->current = $data->environmental_impact;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->public_perception_impact)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Public Perception Impact';
            $history->previous = "Null";
            $history->current = $data->public_perception_impact;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->calculated_risk)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Calculated Risk';
            $history->previous = "Null";
            $history->current = $data->calculated_risk;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
           $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->impacted_objects)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Impacted Objects';
            $history->previous = "Null";
            $history->current = $data->impacted_objects;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->severity_rate)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Severity Rate';
            $history->previous = "Null";
            $history->current = $data->severity_rate;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->occurrence)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Occurrence';
            $history->previous = "Null";
            $history->current = $data->occurrence;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->detection)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Detection';
            $history->previous = "Null";
            $history->current = $data->detection;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->rpn)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Rpn';
            $history->previous = "Null";
            $history->current = $data->rpn;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->residual_risk)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Residual Risk';
            $history->previous = "Null";
            $history->current = $data->residual_risk;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->residual_risk_impact)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Residual Risk Impact';
            $history->previous = "Null";
            $history->current = $data->residual_risk_impact;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->residual_risk_probability)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Residual Risk Probability';
            $history->previous = "Null";
            $history->current = $data->residual_risk_probability;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
             $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }


        
        if (!empty($data->detection2)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Residual Detection';
            $history->previous = "Null";
            $history->current = $data->detection2;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
             $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }


        
        if (!empty($data->rpn2)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Residual RPN';
            $history->previous = "Null";
            $history->current = $data->rpn2;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
             $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }

        if (!empty($data->comments2)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Comments2';
            $history->previous = "Null";
            $history->current = $data->comments2;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
         $history->change_from = "Initiation";
            $history->action_name = 'Create';
         
            $history->save();
        }
//-----------------------------------------------------------------------------------




            if (!empty($data->mitigation_required)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Mitigation Required';
                $history->previous = "Null";
                $history->current = $data->mitigation_required;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to =   "Opened";
         $history->change_from = "Initiation";
                $history->action_name = 'Create';
            
                $history->save();
            }
            if (!empty($data->mitigation_plan)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Mitigation Plan';
                $history->previous = "Null";
                $history->current = $data->mitigation_plan;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to =   "Opened";
         $history->change_from = "Initiation";
                $history->action_name = 'Create';
            
                $history->save();
            }
            if (!empty($data->mitigation_due_date)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Scheduled End Date';
                $history->previous = "Null";
                $history->current = $data->mitigation_due_date;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to =   "Opened";
         $history->change_from = "Initiation";
                $history->action_name = 'Create';
            
                $history->save();
            }


            if (!empty($data->mitigation_status)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Status of Mitigation';
                $history->previous = "Null";
                $history->current = $data->mitigation_status;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to =   "Opened";
         $history->change_from = "Initiation";
                $history->action_name = 'Create';
             
                $history->save();
            }
            if (!empty($data->mitigation_status_comments)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Mitigation Status Comments';
                $history->previous = "Null";
                $history->current = $data->mitigation_status_comments;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to =   "Opened";
         $history->change_from = "Initiation";
                $history->action_name = 'Create';
             
                $history->save();
            }
    //------------

    

  
            if (!empty($data->impact)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Impact';
                $history->previous = "Null";
                $history->current = $data->impact;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            
                $history->save();
            }
            if (!empty ($data->criticality)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Criticality';
                $history->previous = "Null";
                $history->current = $data->criticality;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to =   "Opened";
         $history->change_from = "Initiation";
                $history->action_name = 'Create';
            
                $history->save();
            }
            if (!empty($data->impact_analysis)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Impact Analysis';
                $history->previous = "Null";
                $history->current = $data->impact_analysis;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to =   "Opened";
         $history->change_from = "Initiation";
                $history->action_name = 'Create';
            
                $history->save();
            }


            if (!empty($data->risk_analysis)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Risk Analysis';
                $history->previous = "Null";
                $history->current = $data->risk_analysis;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to =   "Opened";
         $history->change_from = "Initiation";
                $history->action_name = 'Create';
            
                $history->save();
            }
            if (!empty($data->due_date_extension)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Due Date Extension Justification';
                $history->previous = "Null";
                $history->current = $data->due_date_extension;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to =   "Opened";
                 $history->change_from = "Initiation";
                $history->action_name = 'Create';
            
                $history->save();
            }



            if (!empty($data->refrence_record)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Reference Record';
                $history->previous = "Null";
                $history->current = $data->refrence_record;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to =   "Opened";
           $history->change_from = "Initiation";
                $history->action_name = 'Create';
            
                $history->save();
            }



            if (!empty($data->reference)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Work Group Attachments';
                $history->previous = "Null";
                $history->current = $data->reference;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to =   "Opened";
               $history->change_from = "Initiation";
                $history->action_name = 'Create';
            
                $history->save();
            }




            
    // $why_why_chart  = [
    //     'why_problem_statement' => 'Problem Statement',
    //     'why_1' => ' Why 1',
    //     'why_2' => '  Why 2',
    //     'why_3' => '  Why 3',
    //     'why_4' => '  Why 4',
    //     'why_5' => '  Why 5',
    //     'why_root_cause' => 'Root Cause',
    // ];
    // foreach ($why_why_chart as $key => $value) {
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
    //             $history = new RiskAuditTrail();
    //             $history->risk_id = $data->id;
    //             $history->activity_type = $value;
    //             $history->previous = $previousValue; // Store the previous value
    //             $history->current = $currentValue;
    //             $history->comment = "Not Applicable"; // Add comment if required
    //             $history->user_id = Auth::user()->id;
    //             $history->user_name = Auth::user()->name;
    //             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    //             $history->origin_state = $data->status;
    //             $history->change_to = "Opened";
    //        $history->change_from = "Initiation";
    //             $history->action_name = 'Create';
    
    //             $history->save();
    //         }
    //     }
    // }
  

    // $is_is_not_analysis  = [
    //     'what_will_be' => ' What / Will Be',
    //     'what_will_not_be' => 'what / Will Not Be',
    //     'what_rationable' => 'what / Rational',

    //     'where_will_be' => ' Where / Will Be',
    //     'where_will_not_be' => ' Where / Will Not Be',
    //     'where_rationable' => ' Where / Rational',

    //     'when_will_be' => ' When / Will Be',
    //     'when_will_not_be' => 'When / Will Not Be ',
    //     'when_rationable' => 'When / Retional ',

    //     'coverage_will_be' => 'Coverage / Will Be',
    //     'coverage_will_not_be' => 'Coverage / Will Not Be',
    //     'coverage_rationable' => 'Coverage / Retional',

    //     'who_will_be' => 'Who / will Be ',
    //     'who_will_not_be' => 'Who / Will Not Be',
    //     'who_rationable' => ' Who / Retional',
    // ];
    
    // foreach ($is_is_not_analysis as $key => $value) {
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
    //             $history = new RiskAuditTrail();
    //             $history->risk_id = $data->id;
    //             $history->activity_type = $value;
    //             $history->previous = $previousValue; // Store the previous value
    //             $history->current = $currentValue;
    //             $history->comment = "Not Applicable"; // Add comment if required
    //             $history->user_id = Auth::user()->id;
    //             $history->user_name = Auth::user()->name;
    //             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    //             $history->origin_state = $data->status;
    //             $history->change_to = "Opened";
    //         $history->change_from = "Initiation";
    //             $history->action_name = 'Create';
    
    //             $history->save();
    //         }



            
    //     }
    // }
   
            
        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }
    public function riskUpdate(Request $request, $id)
    {

        if (!$request->short_description) {
            toastr()->info("Short Description is required");
            return redirect()->back()->withInput();
        }

        $lastDocument =  RiskManagement::find($id);
        $data =  RiskManagement::find($id);
        $data->division_code = $request->division_code;
        //$data->record_number = $request->record_number;
        $data->short_description = $request->short_description;
        $data->open_date = $request->open_date;
        $data->assign_to = $request->assign_to;
        $data->due_date = $request->due_date;
        $data->Initiator_Group = $request->Initiator_Group;
        $data->initiator_group_code = $request->initiator_group_code;
      //  $data->departments = implode(',', $request->departments);

       $data->departments = is_array($request->departments) ? implode(',', $request->departments) : '';

        // $data->team_members = implode(',', $request->team_members);
        $data->source_of_risk = $request->source_of_risk;
        $data->source_of_risk2 = $request->source_of_risk2;
        $data->type = $request->type;
        $data->priority_level = $request->priority_level;
        $data->zone = $request->zone;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->city = $request->city;
        $data->description = $request->description;
        $data->severity2_level = $request->severity2_level;
        $data->comments = $request->comments;
        
       // $data->departments2 = implode(',', $request->departments2);
       $data->departments2 = is_array($request->departments2) ? implode(',', $request->departments2) : '';
 
       
       $data->risk_level = $request->input('risk_level');
       $data->risk_level_2 = $request->input('risk_level_2');
       $data->purpose = $request->input('purpose');
       $data->scope = $request->input('scope');
       $data->reason_for_revision = $request->input('reason_for_revision');
       $data->Brief_description = $request->input('Brief_description');
       $data->document_used_risk = $request->input('document_used_risk');
       $data->risk_level3 = $request->input('risk_level3');

      



       $data->site_name = $request->site_name;
        $data->building = $request->building;
        $data->floor = $request->floor;
        $data->room = $request->room;
        $data->related_record = json_encode($request->related_record);
        $data->duration = $request->duration;
        $data->hazard = $request->hazard;
        $data->room2 = $request->room2;
        $data->regulatory_climate = $request->regulatory_climate;
        $data->Number_of_employees = $request->Number_of_employees;
        $data->risk_management_strategy = $request->risk_management_strategy;
        $data->estimated_man_hours = $request->estimated_man_hours;
        $data->schedule_start_date1 = $request->schedule_start_date1;
        $data->schedule_end_date1 = $request->schedule_end_date1;
        $data->estimated_cost = $request->estimated_cost;
        $data->currency = $request->currency;
        $data->root_cause_methodology = is_array($request->root_cause_methodology) ? implode(',', $request->root_cause_methodology) : '';

        //$data->root_cause_methodology = implode(',', $request->root_cause_methodology);
        //$data->training_require = $request->training_require;
        $data->justification = $request->justification;
        $data->cost_of_risk = $request->cost_of_risk;
        $data->environmental_impact = $request->environmental_impact;
        $data->public_perception_impact = $request->public_perception_impact;
        $data->calculated_risk = $request->calculated_risk;
        $data->impacted_objects = $request->impacted_objects;
        $data->severity_rate = $request->severity_rate;
        $data->occurrence = $request->occurrence;
        $data->detection = $request->detection;
        $data->detection2 = $request->detection2;
        $data->rpn = $request->rpn;
        $data->residual_risk = $request->residual_risk;
        $data->residual_risk_impact = $request->residual_risk_impact;
        $data->residual_risk_probability = $request->residual_risk_probability;
        $data->analysisN2 = $request->analysisN2;
        $data->analysisRPN2 = $request->analysisRPN2;
        $data->rpn2 = $request->rpn2;
        $data->comments2 = $request->comments2;
        $data->root_cause_description = $request->root_cause_description;
        $data->investigation_summary = $request->investigation_summary;
        $data->mitigation_required = $request->mitigation_required;
        $data->mitigation_plan = $request->mitigation_plan;
        $data->mitigation_due_date = $request->mitigation_due_date;
        $data->mitigation_status = $request->mitigation_status;
        $data->mitigation_status_comments = $request->mitigation_status_comments;
        $data->impact = $request->impact;
        $data->criticality = $request->criticality;
        $data->impact_analysis = $request->impact_analysis;
        $data->risk_analysis = $request->risk_analysis;
        $data->due_date_extension = $request->due_date_extension;
        //$data->severity = $request->severity;
        //$data->occurance = $request->occurance;
        //$data->refrence_record =  implode(',', $request->refrence_record);
        $data->refrence_record = is_array($request->refrence_record) ? implode(',', $request->refrence_record) : '';


        if (!empty($request->reference)) {
            $files = [];
            if ($request->hasfile('reference')) {
                foreach ($request->file('reference') as $file) {
                    $name = $request->name . 'reference' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $data->reference = json_encode($files);
        }


        if (!empty($request->risk_attachment)) {
            $files = [];
            if ($request->hasfile('risk_attachment')) {
                foreach ($request->file('risk_attachment') as $file) {
                    $name = $request->name . 'risk_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $data->risk_attachment = json_encode($files);
        }
        // return $data;
        $data->update();
             // -----------grid=------
            //  $data1 = new RiskAssesmentGrid();
            //  $data1->risk_id = $data->id;
            //  $data1->type = "effect_analysis";
        
            
             $data1 = RiskAssesmentGrid::where('risk_id', $data->id)->where('type', 'effect_analysis')->first();

             // Serialize and update the data, ensuring that we always update the fields
             $data1->risk_factor = serialize($request->risk_factor ?? []);
             $data1->risk_element = serialize($request->risk_element ?? []);
             $data1->problem_cause = serialize($request->problem_cause ?? []);
             $data1->existing_risk_control = serialize($request->existing_risk_control ?? []);
             $data1->initial_severity = serialize($request->initial_severity ?? []);
             $data1->initial_detectability = serialize($request->initial_detectability ?? []);
             $data1->initial_probability = serialize($request->initial_probability ?? []);
             $data1->initial_rpn = serialize($request->initial_rpn ?? []);
             $data1->risk_control_measure = serialize($request->risk_control_measure ?? []);
             $data1->residual_severity = serialize($request->residual_severity ?? []);
             $data1->residual_probability = serialize($request->residual_probability ?? []);
             $data1->residual_detectability = serialize($request->residual_detectability ?? []);
             $data1->residual_rpn = serialize($request->residual_rpn ?? []);
             $data1->risk_acceptance = serialize($request->risk_acceptance ?? []);
             $data1->risk_acceptance2 = serialize($request->risk_acceptance2 ?? []);
             $data1->mitigation_proposal = serialize($request->mitigation_proposal ?? []);
             
             $data1->save();
             
             // ---------------------------------------
            //  $data2 = new RiskAssesmentGrid();
            //  $data2->risk_id = $data->id;
            //  $data2->type = "fishbone";
                 $data2 = RiskAssesmentGrid::where('risk_id',$data->id)->where('type','fishbone')->first();
                
             if (!empty($request->measurement)) {
                 $data2->measurement = serialize($request->measurement);
             }
             if (!empty($request->materials)) {
                 $data2->materials = serialize($request->materials);
             }
             if (!empty($request->methods)) {
                 $data2->methods = serialize($request->methods);
             }
             if (!empty($request->environment)) {
                 $data2->environment = serialize($request->environment);
             }
             if (!empty($request->manpower)) {
                 $data2->manpower = serialize($request->manpower);
             }
             if (!empty($request->machine)) {
                 $data2->machine = serialize($request->machine);
             }
             if (!empty($request->problem_statement)) {
                 $data2->problem_statement = $request->problem_statement;
             }
             $data2->save();
             // =-------------------------------
               $data3 = RiskAssesmentGrid::where('risk_id',$data->id)->where('type','why_chart')->first();
            //  $data3 = new RiskAssesmentGrid();
            //  $data3->risk_id = $data->id;
            //  $data3->type = "why_chart";
           
                
                if (!empty($request->why_problem_statement)) {
                    $data3->why_problem_statement = $request->why_problem_statement;
                }
                if (!empty($request->why_1)) {
                    $data3->why_1 = serialize($request->why_1);
                }
                if (!empty($request->why_2)) {
                    $data3->why_2 = serialize($request->why_2);
                }
                if (!empty($request->why_3)) {
                    $data3->why_3 = serialize($request->why_3);
                }
                if (!empty($request->why_4)) {
                    $data3->why_4 = serialize($request->why_4);
                }
                if (!empty($request->why_5)) {
                    $data3->why_5 = serialize($request->why_5);
                }
                if (!empty($request->why_root_cause)) {
                    $data3->why_root_cause = $request->why_root_cause;
                }


                $data3->save();
        
             // --------------------------------------------
            //  $data4 = new RiskAssesmentGrid();
            //  $data4->risk_id = $data->id;
            //  $data4->type = "what_who_where";
              $data4 = RiskAssesmentGrid::where('risk_id',$data->id)->where('type','what_who_where')->first();
              
             if (!empty($request->what_will_be)) {
                 $data4->what_will_be = $request->what_will_be;
             }
             if (!empty($request->what_will_not_be)) {
                 $data4->what_will_not_be = $request->what_will_not_be;
             }
             if (!empty($request->what_rationable)) {
                 $data4->what_rationable = $request->what_rationable;
             }
             if (!empty($request->where_will_be)) {
                 $data4->where_will_be = $request->where_will_be;
             }
             if (!empty($request->where_will_not_be)) {
                 $data4->where_will_not_be = $request->where_will_not_be;
             }
             if (!empty($request->where_rationable)) {
                 $data4->where_rationable = $request->where_rationable;
             }
             if (!empty($request->coverage_will_be)) {
                 $data4->coverage_will_be = $request->coverage_will_be;
             }
             if (!empty($request->coverage_will_not_be)) {
                 $data4->coverage_will_not_be = $request->coverage_will_not_be;
             }
             if (!empty($request->coverage_rationable)) {
                 $data4->coverage_rationable = $request->coverage_rationable;
             }
             if (!empty($request->who_will_be)) {
                 $data4->who_will_be = $request->who_will_be;
             }
             if (!empty($request->who_will_not_be)) {
                 $data4->who_will_not_be = $request->who_will_not_be;
             }
             if (!empty($request->who_rationable)) {
                 $data4->who_rationable = $request->who_rationable;
             } if (!empty($request->when_will_be)) {
                 $data4->when_will_be = $request->when_will_be;
             }
              if (!empty($request->when_will_not_be)) {
                 $data4->when_will_not_be = $request->when_will_not_be;
             }
              if (!empty($request->when_rationable)) {
                 $data4->when_rationable = $request->when_rationable;
             }
             $data4->save();
     
            $data5 = RiskAssesmentGrid::where('risk_id',$data->id)->where('type','Action_Plan')->first();
            //  $data5 = new RiskAssesmentGrid();
            //  $data5->risk_id = $data->id;
            //  $data5->type = "Action_Plan";
                   
             if (!empty($request->action)) {
                 $data5->action = serialize($request->action);
             }
             if (!empty($request->responsible)) {
                 $data5->responsible = serialize($request->responsible);
             }
             if (!empty($request->deadline)) {
                 $data5->deadline = serialize($request->deadline);
             }
             if (!empty($request->item_static)) {
                 $data5->item_static = serialize($request->item_static);
             }
     
             $data5->save();
     
            //  $data6 = new RiskAssesmentGrid();
            //  $data6->risk_id = $data->id;
            //  $data6->type = "Mitigation_Plan_Details";
              $data6 = RiskAssesmentGrid::where('risk_id',$data->id)->where('type','Mitigation_Plan_Details')->first();
             if (!empty($request->mitigation_steps)) {
                 $data6->mitigation_steps = serialize($request->mitigation_steps);
             }
             if (!empty($request->deadline2)) {
                 $data6->deadline2 = serialize($request->deadline2);
             }
             if (!empty($request->responsible_person)) {
                 $data6->responsible_person = serialize($request->responsible_person);
             }
             if (!empty($request->status)) {
                 $data6->status = serialize($request->status);
             }
             if (!empty($request->remark)) {
                 $data6->remark = serialize($request->remark);
             }
     
             $data6->save();

         
        
            //$lastDocumentdata =  RiskManagement::find($id);


            // Short Description
            if ($lastDocument->short_description != $data->short_description) {
                $history = new RiskAuditTrail();

        
            $history->risk_id = $data->id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastDocument->short_description;
            $history->current = $data->short_description;
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
          //  dd($history);
            $history->save();
            }
      
            
 


            if ($lastDocument->purpose != $data->purpose) {
                $history = new RiskAuditTrail();

        
            $history->risk_id = $data->id;
            $history->activity_type = 'Purpose';
            $history->previous = $lastDocument->purpose;
            $history->current = $data->purpose;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->purpose) || $lastDocument->purpose === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
          //  dd($history);
            $history->save();
            }


            if ($lastDocument->scope != $data->scope) {
                $history = new RiskAuditTrail();

        
            $history->risk_id = $data->id;
            $history->activity_type = 'Scope';
            $history->previous = $lastDocument->scope;
            $history->current = $data->scope;
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
          //  dd($history);
            $history->save();
            }



            if ($lastDocument->reason_for_revision != $data->reason_for_revision) {
                $history = new RiskAuditTrail();

        
            $history->risk_id = $data->id;
            $history->activity_type = 'Reason for Revision';
            $history->previous = $lastDocument->reason_for_revision;
            $history->current = $data->reason_for_revision;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->reason_for_revision) || $lastDocument->reason_for_revision === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
          //  dd($history);
            $history->save();
            }



            if ($lastDocument->Brief_description != $data->Brief_description) {
                $history = new RiskAuditTrail();

        
            $history->risk_id = $data->id;
            $history->activity_type = 'Brief Description / Procedure';
            $history->previous = $lastDocument->Brief_description;
            $history->current = $data->Brief_description;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Brief_description) || $lastDocument->Brief_description === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
          //  dd($history);
            $history->save();
            }

            if ($lastDocument->document_used_risk != $data->document_used_risk) {
                $history = new RiskAuditTrail();

        
            $history->risk_id = $data->id;
            $history->activity_type = 'Documents Used for Risk Management';
            $history->previous = $lastDocument->document_used_risk;
            $history->current = $data->document_used_risk;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->document_used_risk) || $lastDocument->document_used_risk === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
          //  dd($history);
            $history->save();
            }

        if ($lastDocument->open_date != $data->open_date || !empty($request->open_date_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Open Date';
            $history->previous = $lastDocument->open_date;
            $history->current = $data->open_date;
            $history->comment = $request->open_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->open_date) || $lastDocument->open_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
      
          if ($lastDocument->severity2_level != $data->severity2_level || !empty($request->comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Severity Level';
            $history->previous = $lastDocument->severity2_level;
            $history->current = $data['severity2_level'];
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->severity2_level) || $lastDocument->severity2_level === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }

        if ($lastDocument->assign_to != $data->assign_to || !empty($request->assign_id_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Assign Id';
            $history->previous = $lastDocument->assign_to;
            $history->current = $data->assign_to;
            $history->comment = $request->assign_id_comment;
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

        if ($lastDocument->departments != $data->departments || !empty($request->departments_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Deparments';
            $history->previous = $lastDocument->departments;
            $history->current = $data->departments;
            $history->comment = $request->departments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->departments) || $lastDocument->departments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }

        // if ($lastDocument->team_members != $data->team_members || !empty($request->team_members_comment)) {

        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Team Members';
        //     $history->previous = $lastDocument->team_members;
        //     $history->current = $data->team_members;
        //     $history->comment = $request->team_members_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }

        if ($lastDocument->source_of_risk != $data->source_of_risk) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Source of Risk/Opportunity';
            $history->previous = $lastDocument->source_of_risk;
            $history->current = $data->source_of_risk;
            $history->comment = $request->source_of_risk_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->source_of_risk) || $lastDocument->source_of_risk === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }

        if ((!empty($data['type']) && $lastDocument->type != $data['type']) || !empty($request->type_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Type';
            $history->previous = $lastDocument->type;
            $history->current = $data['type'];
            $history->comment = $request->type_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->type) || $lastDocument->type === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }

        if ($lastDocument->priority_level != $data->priority_level || !empty($request->priority_level_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Priority Level';
            $history->previous = $lastDocument->priority_level;
            $history->current = $data->priority_level;
            $history->comment = $request->priority_level_comment;
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

        if ($lastDocument->zone != $data->zone || !empty($request->zone_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Zone';
            $history->previous = $lastDocument->zone;
            $history->current = $data->zone;
            $history->comment = $request->zone_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->zone) || $lastDocument->zone === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }

        if ($lastDocument->country != $data->country || !empty($request->country_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Country';
            $history->previous = $lastDocument->country;
            $history->current = $data->country;
            $history->comment = $request->country_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->country) || $lastDocument->country === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }

        if ($lastDocument->state != $data->state || !empty($request->state_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'State/District';
            $history->previous = $lastDocument->state;
            $history->current = $data->state;
            $history->comment = $request->state_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->state) || $lastDocument->state === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->city != $data->city || !empty($request->city_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'City';
            $history->previous = $lastDocument->city;
            $history->current = $data->city;
            $history->comment = $request->city_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->city) || $lastDocument->city === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }

        if ($lastDocument->description != $data->description || !empty($request->description_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Risk/Opportunity Description';
            $history->previous = $lastDocument->description;
            $history->current = $data->description;
            $history->comment = $request->description_comment;
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

        if ($lastDocument->comments != $data->comments || !empty($request->comments_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Risk/Opportunity Comments';
            $history->previous = $lastDocument->comments;
            $history->current = $data->comments;
            $history->comment = $request->comments_comment;
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
        if ($lastDocument->departments2 != $data->departments2 || !empty($request->departments2_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Departments2';
            $history->previous = $lastDocument->departments2;
            $history->current = $data->departments2;
            $history->comment = $request->departments2_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->departments2) || $lastDocument->departments2 === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->site_name != $data->site_name || !empty($request->site_name_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Site Name';
            $history->previous = $lastDocument->site_name;
            $history->current = $data->site_name;
            $history->comment = $request->site_name_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->site_name) || $lastDocument->site_name === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->building != $data->building || !empty($request->building_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Building';
            $history->previous = $lastDocument->building;
            $history->current = $data->building;
            $history->comment = $request->building_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->building) || $lastDocument->building === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->floor != $data->floor || !empty($request->floor_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Floor';
            $history->previous = $lastDocument->floor;
            $history->current = $data->floor;
            $history->comment = $request->floor_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->floor) || $lastDocument->floor === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->room != $data->room || !empty($request->room_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Room';
            $history->previous = $lastDocument->room;
            $history->current = $data->room;
            $history->comment = $request->room_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->room) || $lastDocument->room === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->duration != $data->duration || !empty($request->duration_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Duration';
            $history->previous = $lastDocument->duration;
            $history->current = $data->duration;
            $history->comment = $request->duration_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->duration) || $lastDocument->duration === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->hazard != $data->hazard || !empty($request->hazard_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Hazard';
            $history->previous = $lastDocument->hazard;
            $history->current = $data->hazard;
            $history->comment = $request->hazard_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->hazard) || $lastDocument->hazard === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->room2 != $data->room2 || !empty($request->room2_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Room2';
            $history->previous = $lastDocument->room2;
            $history->current = $data->room2;
            $history->comment = $request->room2_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->room2) || $lastDocument->room2 === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->regulatory_climate != $data->regulatory_climate || !empty($request->regulatory_climate_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Regulatory Climate';
            $history->previous = $lastDocument->regulatory_climate;
            $history->current = $data->regulatory_climate;
            $history->comment = $request->regulatory_climate_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->regulatory_climate) || $lastDocument->regulatory_climate === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->Number_of_employees != $data->Number_of_employees || !empty($request->Number_of_employees_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Number Of Employees';
            $history->previous = $lastDocument->Number_of_employees;
            $history->current = $data->Number_of_employees;
            $history->comment = $request->Number_of_employees_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->Number_of_employees) || $lastDocument->Number_of_employees === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        // if ($lastDocument->refrence_record != $data->refrence_record || !empty($request->refrence_record_comment)) {

        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Reference Recores';
        //     $history->previous = $lastDocument->refrence_record;
        //     $history->current = $data->refrence_record;
        //     $history->comment = $request->refrence_record_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }

        if ($lastDocument->risk_management_strategy != $data->risk_management_strategy || !empty($request->risk_management_strategy_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Risk Management Strategy';
            $history->previous = $lastDocument->risk_management_strategy;
            $history->current = $data->risk_management_strategy;
            $history->comment = $request->risk_management_strategy_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->risk_management_strategy) || $lastDocument->risk_management_strategy === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }


        if ($lastDocument->schedule_start_date1 != $data->schedule_start_date1 || !empty($request->comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Scheduled Start Date';
            $history->previous = $lastDocument->schedule_start_date1;
            $history->current = $data->schedule_start_date1;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->schedule_start_date1) || $lastDocument->schedule_start_date1 === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }


        if ($lastDocument->schedule_end_date1 != $data->schedule_end_date1 || !empty($request->comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Scheduled End Date';
            $history->previous = $lastDocument->schedule_end_date1;
            $history->current = $data->schedule_end_date1;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->schedule_end_date1) || $lastDocument->schedule_end_date1 === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }


        if ($lastDocument->estimated_man_hours != $data->estimated_man_hours || !empty($request->estimated_man_hours_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Estimated  man  Hours';
            $history->previous = $lastDocument->estimated_man_hours;
            $history->current = $data->estimated_man_hours;
            $history->comment = $request->estimated_man_hours_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->estimated_man_hours) || $lastDocument->estimated_man_hours === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->estimated_cost != $data->estimated_cost || !empty($request->estimated_cost_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Estimated Cost';
            $history->previous = $lastDocument->estimated_cost;
            $history->current = $data->estimated_cost;
            $history->comment = $request->estimated_cost_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->estimated_cost) || $lastDocument->estimated_cost === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->currency != $data->currency || !empty($request->currency_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Currency';
            $history->previous = $lastDocument->currency;
            $history->current = $data->currency;
            $history->comment = $request->currency_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->currency) || $lastDocument->currency === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->training_require != $data->training_require || !empty($request->training_require_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Training Require';
            $history->previous = $lastDocument->training_require;
            $history->current = $data->training_require;
            $history->comment = $request->training_require_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->training_require) || $lastDocument->training_require === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->justification != $data->justification || !empty($request->justification_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Justification / Rationale';
            $history->previous = $lastDocument->justification;
            $history->current = $data->justification;
            $history->comment = $request->justification_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->justification) || $lastDocument->justification === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->reference != $data->reference || !empty($request->reference_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Reference';
            $history->previous = $lastDocument->reference;
            $history->current = $data->reference;
            $history->comment = $request->reference_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->reference) || $lastDocument->reference === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->cost_of_risk != $data->cost_of_risk || !empty($request->cost_of_risk_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Cost Of Risk';
            $history->previous = $lastDocument->cost_of_risk;
            $history->current = $data->cost_of_risk;
            $history->comment = $request->cost_of_risk_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->cost_of_risk) || $lastDocument->cost_of_risk === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->environmental_impact != $data->environmental_impact || !empty($request->environmental_impact_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Environmental Impact';
            $history->previous = $lastDocument->environmental_impact;
            $history->current = $data->environmental_impact;
            $history->comment = $request->environmental_impact_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->environmental_impact) || $lastDocument->environmental_impact === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->public_perception_impact != $data->public_perception_impact || !empty($request->public_perception_impact_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Public Perception Impact';
            $history->previous = $lastDocument->public_perception_impact;
            $history->current = $data->public_perception_impact;
            $history->comment = $request->public_perception_impact_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->public_perception_impact) || $lastDocument->public_perception_impact === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->calculated_risk != $data->calculated_risk || !empty($request->calculated_risk_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Calculated Risk';
            $history->previous = $lastDocument->calculated_risk;
            $history->current = $data->calculated_risk;
            $history->comment = $request->calculated_risk_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->calculated_risk) || $lastDocument->calculated_risk === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->impacted_objects != $data->impacted_objects || !empty($request->impacted_objects_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Impacted Objects';
            $history->previous = $lastDocument->impacted_objects;
            $history->current = $data->impacted_objects;
            $history->comment = $request->impacted_objects_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->impacted_objects) || $lastDocument->impacted_objects === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->severity_rate != $data->severity_rate || !empty($request->severity_rate_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Severity Rate';
            $history->previous = $lastDocument->severity_rate;
            $history->current = $data->severity_rate;
            $history->comment = $request->severity_rate_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->severity_rate) || $lastDocument->severity_rate === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->occurrence != $data->occurrence || !empty($request->occurrence_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Occurrence';
            $history->previous = $lastDocument->occurrence;
            $history->current = $data->occurrence;
            $history->comment = $request->occurrence_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->occurrence) || $lastDocument->occurrence === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->detection != $data->detection || !empty($request->detection_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Detection';
            $history->previous = $lastDocument->detection;
            $history->current = $data->detection;
            $history->comment = $request->detection_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->detection) || $lastDocument->detection === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->rpn != $data->rpn || !empty($request->rpn_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Rpn';
            $history->previous = $lastDocument->rpn;
            $history->current = $data->rpn;
            $history->comment = $request->rpn_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->rpn) || $lastDocument->rpn === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->residual_risk != $data->residual_risk || !empty($request->residual_risk_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Residual Risk';
            $history->previous = $lastDocument->residual_risk;
            $history->current = $data->residual_risk;
            $history->comment = $request->residual_risk_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->residual_risk) || $lastDocument->residual_risk === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->residual_risk_impact != $data->residual_risk_impact || !empty($request->residual_risk_impact_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Residual Risk Impact';
            $history->previous = $lastDocument->residual_risk_impact;
            $history->current = $data->residual_risk_impact;
            $history->comment = $request->residual_risk_impact_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->residual_risk_impact) || $lastDocument->residual_risk_impact === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->residual_risk_probability != $data->residual_risk_probability || !empty($request->residual_risk_probability_comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Residual Risk Probability';
            $history->previous = $lastDocument->residual_risk_probability;
            $history->current = $data->residual_risk_probability;
            $history->comment = $request->residual_risk_probability_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->residual_risk_probability) || $lastDocument->residual_risk_probability === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }



        if ($lastDocument->detection2 != $data->detection2 || !empty($request->comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Residual Detection';
            $history->previous = $lastDocument->detection2;
            $history->current = $data->detection2;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->detection2) || $lastDocument->detection2 === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }


        if ($lastDocument->rpn2 != $data->rpn2 || !empty($request->comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Residual RPN';
            $history->previous = $lastDocument->rpn2;
            $history->current = $data->rpn2;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->rpn2) || $lastDocument->rpn2 === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
        if ($lastDocument->comments2 != $data->comments2 || !empty($request->comment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Comments2';
            $history->previous = $lastDocument->comments2;
            $history->current = $data->comments2;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
           if (is_null($lastDocument->comments2) || $lastDocument->comments2 === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
           
            $history->save();
        }
    //--------------------------------------------------------------------------------------



                if ($lastDocument->mitigation_required != $data->mitigation_required || !empty($request->comment)) {

                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'Mitigation Required';
                    $history->previous = $lastDocument->mitigation_required;
                    $history->current = $data->mitigation_required;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Not Applicable";
                    $history->change_from = $lastDocument->status;
                   if (is_null($lastDocument->mitigation_required) || $lastDocument->mitigation_required === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                        
                            $history->save();
                }


                if ($lastDocument->mitigation_plan != $data->mitigation_plan || !empty($request->comment)) {

                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'Mitigation Plan';
                    $history->previous = $lastDocument->mitigation_plan;
                    $history->current = $data->mitigation_plan;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Not Applicable";
                    $history->change_from = $lastDocument->status;
                   if (is_null($lastDocument->mitigation_plan) || $lastDocument->mitigation_plan === '') {
                   $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                        
                            $history->save();
                }


                if ($lastDocument->mitigation_due_date != $data->mitigation_due_date || !empty($request->comment)) {

                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'Scheduled End Date';
                    $history->previous = $lastDocument->mitigation_due_date;
                    $history->current = $data->mitigation_due_date;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Not Applicable";
                    $history->change_from = $lastDocument->status;
                   if (is_null($lastDocument->mitigation_due_date) || $lastDocument->mitigation_due_date === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                
                    $history->save();
                }
              // Ensure lastDocument is fetched
                 //   $lastDocument = RiskAuditTrail::where('risk_id', $id)->orderBy('created_at', 'desc')->first();

                    // Define the current and previous values for mitigation_status
                    $currentMitigationStatus = !empty($data->mitigation_status) ? $data->mitigation_status : null;
                    $previousMitigationStatus = !empty($lastDocument->mitigation_status) ? $lastDocument->mitigation_status : null;

                    // Check if there are changes to save
                    if (!empty($currentMitigationStatus) && ($previousMitigationStatus != $currentMitigationStatus || !empty($request->comment))) {
                        $history = new RiskAuditTrail();
                        $history->risk_id = $id;
                        $history->activity_type = 'Status of Mitigation';
                        $history->previous = $previousMitigationStatus;
                        $history->current = $currentMitigationStatus;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to = "Not Applicable";
                        $history->change_from = $lastDocument->status;
                       if (is_null($lastDocument->currentMitigationStatus) || $lastDocument->currentMitigationStatus === '') {
                            $history->action_name = "New";
                        } else {
                            $history->action_name = "Update";
                        }

                        $history->save();
                    }

                if ($lastDocument->mitigation_status_comments != $data->mitigation_status_comments || !empty($request->comment)) {

                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'Mitigation Status Comments';
                    $history->previous = $lastDocument->mitigation_status_comments;
                    $history->current = $data->mitigation_status_comments;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Not Applicable";
                    $history->change_from = $lastDocument->status;
                   if (is_null($lastDocument->mitigation_status_comments) || $lastDocument->mitigation_status_comments === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                        
                            $history->save();
                }
                if ((!empty($data['impact']) && $lastDocument->impact != $data['impact']) || !empty($request->comment)) {
                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'Impact';
                    $history->previous = $lastDocument->impact;
                    $history->current = $data['impact'];
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to = "Not Applicable";
                    $history->change_from = $lastDocument->status;
                   if (is_null($lastDocument->impact) || $lastDocument->impact === '') {
                         $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    
                    $history->save();
                }
                if (!empty($data->criticality) && ($lastDocument->criticality != $data->criticality || !empty($request->comment))) {

                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'Criticality';
                    $history->previous = $lastDocument->criticality;
                    $history->current = $data->criticality;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to = "Not Applicable";
                    $history->change_from = $lastDocument->status;
                   if (is_null($lastDocument->criticality) || $lastDocument->criticality === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                
                    $history->save();
                }
                
                if ($lastDocument->impact_analysis != $data->impact_analysis || !empty($request->comment)) {

                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'Impact Analysis';
                    $history->previous = $lastDocument->impact_analysis;
                    $history->current = $data->impact_analysis;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Not Applicable";
                    $history->change_from = $lastDocument->status;
                   if (is_null($lastDocument->impact_analysis) || $lastDocument->impact_analysis === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
                
                    $history->save();
                }
                if ($lastDocument->risk_analysis != $data->risk_analysis || !empty($request->comment)) {

                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'Risk Analysis';
                    $history->previous = $lastDocument->risk_analysis;
                    $history->current = $data->risk_analysis;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Not Applicable";
                    $history->change_from = $lastDocument->status;
                   if (is_null($lastDocument->risk_analysis) || $lastDocument->risk_analysis === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
                
                    $history->save();
                }

                if ($lastDocument->refrence_record != $data->refrence_record || !empty($request->comment)) {

                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'Refrence Record';
                    $history->previous = $lastDocument->refrence_record;
                    $history->current = $data->refrence_record;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Not Applicable";
                    $history->change_from = $lastDocument->status;
                   if (is_null($lastDocument->refrence_record) || $lastDocument->refrence_record === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
                
                    $history->save();
                }
           
           
                if ($lastDocument->due_date_extension != $data->due_date_extension || !empty($request->comment)) {
                  
                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'Due Date Extension Justification';
                    $history->previous = $lastDocument->due_date_extension;
                    $history->current = $data->due_date_extension;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Not Applicable";
                    $history->change_from = $lastDocument->status;
                   if (is_null($lastDocument->due_date_extension) || $lastDocument->due_date_extension === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
                
                    $history->save();
                }

               // return $history->previous;

                if ($lastDocument->reference != $data->reference || !empty($request->comment)) {

                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'Work Group Attachments';
                    $history->previous = $lastDocument->reference;
                    $history->current = $data->reference;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Not Applicable";
                    $history->change_from = $lastDocument->status;
                   if (is_null($lastDocument->reference) || $lastDocument->reference === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
                
                    $history->save();
                }
//------------------------grid data store start---------------------------------------------------
        
 
            // $lastDocumentdata =  RiskAssesmentGrid::find($id);
            // $data =  RiskAssesmentGrid::find($id);

            // if ($lastDocumentdata->why_problem_statement != $data->why_problem_statement || !empty($request->comment)) {

            //     $history = new RiskAuditTrail();
            //     $history->risk_id = $id;
            //     $history->activity_type = 'Why Why Chart Problem Statement ';
            //     $history->previous = $lastDocumentdata->why_problem_statement;
            //     $history->current = $data->why_problem_statement;
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocumentdata->status;
            //     $history->change_to =   "Not Applicable";
            //     $history->change_from = $lastDocumentdata->status;
            //     $history->action_name = 'Update';

            //     $history->save();
            // }

            // if ($lastDocumentdata->why_1 != $data->why_1 || !empty($request->comment)) {

            //     $history = new RiskAuditTrail();
            //     $history->risk_id = $id;
            //     $history->activity_type = 'Why 1';
            //     $history->previous = $lastDocumentdata->why_1;
            //     $history->current = $data->why_1;
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocumentdata->status;
            //     $history->change_to =   "Not Applicable";
            //     $history->change_from = $lastDocumentdata->status;
            //     $history->action_name = 'Update';

            //     $history->save();
            // }
            // if ($lastDocumentdata->why_2 != $data->why_2 || !empty($request->comment)) {

            //     $history = new RiskAuditTrail();
            //     $history->risk_id = $id;
            //     $history->activity_type = 'why 2';
            //     $history->previous = $lastDocumentdata->why_2;
            //     $history->current = $data->why_2;
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocumentdata->status;
            //     $history->change_to =   "Not Applicable";
            //     $history->change_from = $lastDocumentdata->status;
            //     $history->action_name = 'Update';

            //     $history->save();
            // }
            // if ($lastDocumentdata->why_3 != $data->why_3 || !empty($request->comment)) {

            //     $history = new RiskAuditTrail();
            //     $history->risk_id = $id;
            //     $history->activity_type = 'why 3';
            //     $history->previous = $lastDocumentdata->why_3;
            //     $history->current = $data->why_3;
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocumentdata->status;
            //     $history->change_to =   "Not Applicable";
            //     $history->change_from = $lastDocumentdata->status;
            //     $history->action_name = 'Update';

            //     $history->save();
            // }
            // if ($lastDocumentdata->why_4 != $data->why_4 || !empty($request->comment)) {

            //     $history = new RiskAuditTrail();
            //     $history->risk_id = $id;
            //     $history->activity_type = 'Why 4';
            //     $history->previous = $lastDocumentdata->why_4;
            //     $history->current = $data->why_4;
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocumentdata->status;
            //     $history->change_to =   "Not Applicable";
            //     $history->change_from = $lastDocumentdata->status;
            //     $history->action_name = 'Update';

            //     $history->save();
            // }
            // if ($lastDocumentdata->why_5 != $data->why_5 || !empty($request->comment)) {

            //     $history = new RiskAuditTrail();
            //     $history->risk_id = $id;
            //     $history->activity_type = 'Why 5';
            //     $history->previous = $lastDocumentdata->why_5;
            //     $history->current = $data->why_5;
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocumentdata->status;
            //     $history->change_to =   "Not Applicable";
            //     $history->change_from = $lastDocumentdata->status;
            //     $history->action_name = 'Update';

            //     $history->save();
            // }


    

            // Find the current and previous data
            // $lastDocument = RiskAssesmentGrid::find($id);
            // $data = RiskAssesmentGrid::find($id);
            
            // // Get the last audit trail record for this risk_id
            // $lastAuditTrail = RiskAuditTrail::where('risk_id', $data->id)
            //     ->orderBy('created_at', 'desc')
            //     ->first();
            
            // // Define the fields for audit trail
            // $failure_mode_grid = [
            //     'risk_factor' => 'Risk Factor',
            //     'risk_element' => 'Risk Element',
            //     'problem_cause' => 'Probable Cause of Risk Element',
            //     'existing_risk_control' => 'Existing Risk Controls',
            //     'initial_severity' => 'Initial Severity',
            //     'initial_probability' => 'Initial Probability',
            //     'initial_detectability' => 'Initial Detectability',
            //     'initial_rpn' => 'Initial RPN',
            //     'risk_acceptance' => 'Risk Acceptance',
            //     'risk_control_measure' => 'Proposed Additional Risk Control Measure',
            //     'residual_severity' => 'Residual Severity',
            //     'residual_probability' => 'Residual Probability',
            //     'residual_detectability' => 'Residual Detectability',
            //     'residual_rpn' => 'Residual RPN',
            //     'risk_acceptance2' => 'Risk Acceptance',
            //     'mitigation_proposal' => 'Mitigation Proposal',
            // ];
            
            // foreach ($failure_mode_grid as $key => $value) {
            //     // Get the current and previous values
            //     $currentValue = $request->input($key, '');
            //     $previousValue = $lastDocument->$key ?? '';
            
            //     // Convert arrays to strings if necessary
            //     if (is_array($currentValue)) {
            //         $currentValue = implode(', ', $currentValue);
            //     }
            
            //     if (is_array($previousValue)) {
            //         $previousValue = implode(', ', $previousValue);
            //     }
            
            //     // Check if the value has changed or there's a comment
            //     if ($previousValue !== $currentValue || $request->filled('comment')) {
            //         $history = new RiskAuditTrail();
            //         $history->risk_id = $data3->id;
            //         $history->activity_type = $value;
            //         $history->previous = $previousValue;
            //         $history->current = $currentValue;
            //         $history->comment = $request->input('comment', '');
            //         $history->user_id = Auth::id();
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $previousValue; // Double-check if this field is correct
            //         $history->change_to = "Not Applicable"; // Verify if this value is appropriate
            //         $history->change_from = $previousValue; // Verify if this value is appropriate
            //         $history->action_name = 'Update';
            
            //         $history->save();
            //     }
            // }
            

            // $lastDocumentdata = RiskAuditTrail::where('risk_id', $data->id)->orderBy('created_at', 'desc')->first();

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
            //     if ($lastDocumentdata) {
            //         $previousValue = !empty($lastDocumentdata->$key) ? (is_array($lastDocumentdata->$key) ? implode(', ', $lastDocumentdata->$key) : $lastDocumentdata->$key) : '';
            //     } else {
            //         $previousValue = '';
            //     }
            
            //     // Only proceed if current value is not empty and different from previous value or comment is provided
            //     if ($currentValue !== '' && ($previousValue != $currentValue || !empty($request->comment))) {
            //         $history = new RiskAuditTrail();
            //         $history->risk_id = $data->id;
            //         $history->activity_type = $value;
            //         $history->previous = $previousValue;
            //         $history->current = $currentValue;
            //         $history->comment = !empty($request->comment) ? $request->comment : 'NA';
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state =$previousValue;
            //         $history->change_to = "Not Applicable";
            //         $history->change_from =$previousValue;
            //         $history->action_name = 'Update';
            
            //         $history->save();
            //     }
            // }
            
        
//------------------------grid data store End------------------------------------------------------------

        //         $lastDocumentgrid = RiskAuditTrail::where('risk_id', $data->id)->orderBy('created_at', 'desc')->first();

        //         $why_why_chart = [
        //             'why_problem_statement' => 'Problem Statement',
        //             'why_1' => 'Why 1',
        //             'why_2' => 'Why 2',
        //             'why_3' => 'Why 3',
        //             'why_4' => 'Why 4',
        //             'why_5' => 'Why 5',
        //             'why_root_cause' => 'Root Cause',
        //         ];
               
        //         foreach ($why_why_chart as $key => $value){  
        //              // Get the current value from the request
        //             $currentValue = !empty($request->$key) ? (is_array($request->$key) ? implode(', ', $request->$key) : $request->$key) : '';
           
        //             // Initialize previous value
        //             $previousValue = '';
                
        //             if ($lastDocumentgrid) {
        //                 // Check if the key exists in the last document and assign the previous value
        //                 if (!empty($lastDocumentgrid->$key)) {
        //                     $previousValue = (is_array(unserialize($lastDocumentgrid->$key)) ? implode(', ', unserialize($lastDocumentgrid->$key)) : $lastDocumentgrid->$key);
        //                 }
        //             }
                
        //             // Check if previous and current values are not empty and different, or if a comment is provided
        //             if ($currentValue !== '' && ($previousValue !== $currentValue || !empty($request->comment))) {
        //                 $history = new RiskAuditTrail();
        //                 $history->risk_id = $data->id;
        //                 $history->activity_type = $value;
        //                 $history->previous = $previousValue;
        //                 $history->current = $currentValue;
        //                 $history->comment = $request->comment;
        //                 $history->user_id = Auth::user()->id;
        //                 $history->user_name = Auth::user()->name;
        //                 $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //                 $history->origin_state = $lastDocumentgrid->status ?? 'Unknown';
        //                 $history->change_to = "Not Applicable";
        //                 $history->change_from = $lastDocumentgrid->status ?? 'Unknown';
        //                if (is_null($lastDocument->departments) || $lastDocument->departments === '') {
               // $history->action_name = "New";
            //} else {
             //   $history->action_name = "Update";
            //}
                
        //                 $history->save();
        //             }
        //         }
                
   
   
        //         $lastDocument2 = RiskAuditTrail::where('risk_id', $data->id)->orderBy('created_at', 'desc')->first();

      
        // $is_is_not_analysis  = [
        //     'what_will_be' => ' What / Will Be',
        //     'what_will_not_be' => 'what / Will Not Be',
        //     'what_rationable' => 'what / Rational',
    
        //     'where_will_be' => ' Where / Will Be',
        //     'where_will_not_be' => ' Where / Will Not Be',
        //     'where_rationable' => ' Where / Rational',
    
        //     'when_will_be' => ' When / Will Be',
        //     'when_will_not_be' => 'When / Will Not Be ',
        //     'when_rationable' => 'When / Retional ',
    
        //     'coverage_will_be' => 'Coverage / Will Be',
        //     'coverage_will_not_be' => 'Coverage / Will Not Be',
        //     'coverage_rationable' => 'Coverage / Retional',
    
        //     'who_will_be' => 'Who / will Be ',
        //     'who_will_not_be' => 'Who / Will Not Be',
        //     'who_rationable' => ' Who / Retional',
        // ];
        
        // foreach ($is_is_not_analysis as $key => $value) {

        //   //  return dd($value);
        //     // Get the current and previous values
        //     $currentValue = !empty($request->$key) ? (is_array($request->$key) ? implode(', ', $request->$key) : $request->$key) : '';
        //     $previousValue = !empty($lastDocument2->$key) ? (is_array($lastDocument2->$key) ? implode(', ', $lastDocument2->$key) : $lastDocument2->$key) : '';
        
        //     // Compare the values
        //     if ($previousValue != $currentValue || !empty($request->comment)) {
        //         $history = new RiskAuditTrail();
        //         $history->risk_id = $data->id;
        //         $history->activity_type = $value;
        //         $history->previous = unserialize($data5->$key);
        //         $history->current = $currentValue;
        //         $history->comment = $request->comment;
        //         $history->user_id = Auth::user()->id;
        //         $history->user_name = Auth::user()->name;
        //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //         $history->origin_state = $lastDocument2->status;
        //         $history->change_to = "Not Applicable";
        //         $history->change_from = $lastDocument2->status;
        //         $history->action_name = 'Update';
        
        //         $history->save();
        //     }
        // }
        
    

        toastr()->success("Record is update Successfully");
        return redirect()->back();
    }

    public function show($id)
    {
        $data = RiskManagement::find($id);
        $old_record = RiskManagement::select('id', 'division_id', 'record')->get();
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_to)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $riskEffectAnalysis = RiskAssesmentGrid::where('risk_id',$id)->where('type',"effect_analysis")->first();
        $fishbone = RiskAssesmentGrid::where('risk_id',$id)->where('type',"fishbone")->first();
        $whyChart = RiskAssesmentGrid::where('risk_id',$id)->where('type',"why_chart")->first();
        $what_who_where = RiskAssesmentGrid::where('risk_id',$id)->where('type',"what_who_where")->first();
        $action_plan = RiskAssesmentGrid::where('risk_id',$id)->where('type',"Action_Plan")->first();
        $mitigation_plan_details = RiskAssesmentGrid::where('risk_id',$id)->where('type',"Mitigation_Plan_Details")->first();

        return view('frontend.riskAssesment.view', compact('data','riskEffectAnalysis','fishbone','whyChart','what_who_where', 'old_record', 'action_plan', 'mitigation_plan_details'));
    }


    public function riskAssesmentStateChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = RiskManagement::find($id);
            $lastDocument =  RiskManagement::find($id);
            $data =  RiskManagement::find($id);


            if ($changeControl->stage == 1) {
                $changeControl->stage = "2";
                $changeControl->status = 'Risk Analysis & Work Group Assignment';
                $changeControl->submitted_by = Auth::user()->name;
                $changeControl->submitted_on = Carbon::now()->format('d-M-Y');
                $changeControl->submit_comment =$request->comment;

                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->submitted_by;
                $history->comment = $request->comment;
                $history->action = 'Submit';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Risk Analysis & Work Group Assignment";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Submit';
                $history->stage = 'Risk Analysis & Work Group Assignment';
                $history->save();

                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 2) {
                $changeControl->stage = "3";
                $changeControl->status = 'Risk Processing & Action Plan';
                $changeControl->evaluated_by = Auth::user()->name;
                $changeControl->evaluated_on = Carbon::now()->format('d-M-Y');
                $changeControl->evaluation_complete_comment =$request->comment;

                
                $history = new RiskAuditTrail();
                
                $history->risk_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->evaluated_by;
                $history->comment = $request->comment;
                $history->action = 'Evaluation Complete';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Risk Processing & Action Plan";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Update";
                $history->stage = 'Risk Processing & Action Plan';
               
                $history->save();
            //     $list = Helpers::getWorkGroupUserList();
            //     foreach ($list as $u) {
            //         if($u->q_m_s_divisions_id == $changeControl->division_id){
            //             $email = Helpers::getInitiatorEmail($u->user_id);
            //              if ($email !== null) {
                      
            //               Mail::send(
            //                   'mail.view-mail',
            //                    ['data' => $changeControl],
            //                 function ($message) use ($email) {
            //                     $message->to($email)
            //                         ->subject("Document is Send By".Auth::user()->name);
            //                 }
            //               );
            //             }
            //      } 
            //   }
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 3) {
                $changeControl->stage = "4";
                $changeControl->status = 'Pending HOD Approval';

                $changeControl->evaluated_by = Auth::user()->name;
                $changeControl->evaluated_on = Carbon::now()->format('d-M-Y');
                $changeControl->action_plan_complete_comment =$request->comment;
  
                
                $history = new RiskAuditTrail();
                
                $history->risk_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->evaluated_by;
                $history->comment = $request->comment;
                $history->action = 'Action Plan Complete';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Pending HOD Approval";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Update";
                $history->stage = 'Pending HOD Approval';
               
                $history->save();
            // 
            //     $list = Helpers::getHodUserList();
            //     foreach ($list as $u) {
            //         if($u->q_m_s_divisions_id == $changeControl->division_id){
            //             $email = Helpers::getInitiatorEmail($u->user_id);
            //              if ($email !== null) {
                      
            //               Mail::send(
            //                   'mail.view-mail',
            //                    ['data' => $changeControl],
            //                 function ($message) use ($email) {
            //                     $message->to($email)
            //                         ->subject("Document is Send By".Auth::user()->name);
            //                 }
            //               );
            //             }
            //      } 
            //   }
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 4) {
                $changeControl->stage = "5";
                $changeControl->status = 'Actions Items in Progress';
                $changeControl->plan_approved_by = Auth::user()->name;
                $changeControl->plan_approved_on = Carbon::now()->format('d-M-Y');
                $changeControl->action_plan_approved_comment =$request->comment;

                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->plan_approved_by;
                $history->comment = $request->comment;
                $history->action = 'Action Plan Approved';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Actions Items in Progress";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Update";
                $history->stage = 'Actions Items in Progress';
                $history->save();
            //     $list = Helpers::getQAHeadUserList();
            //     foreach ($list as $u) {
            //         if($u->q_m_s_divisions_id == $changeControl->division_id){
            //             $email = Helpers::getInitiatorEmail($u->user_id);
            //              if ($email !== null) {
                      
            //               Mail::send(
            //                   'mail.view-mail',
            //                    ['data' => $changeControl],
            //                 function ($message) use ($email) {
            //                     $message->to($email)
            //                         ->subject("Document is Send By".Auth::user()->name);
            //                 }
            //               );
            //             }
            //      } 
            //   }
                $changeControl->update();

                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 5) {
                $changeControl->stage = "6";
                $changeControl->status = 'Residual Risk Evaluation';
                $changeControl->plan_approved_by = Auth::user()->name;
                $changeControl->plan_approved_on = Carbon::now()->format('d-M-Y');
                $changeControl->all_actions_completed_comment = $request->comment;


                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->plan_approved_by;
                $history->comment = $request->comment;
                $history->action = 'All Action Completed';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Residual Risk Evaluation";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Update";
                $history->stage = 'Residual Risk Evaluation';
                $history->save();
            //     $list = Helpers::getHodUserList();
            //     foreach ($list as $u) {
            //         if($u->q_m_s_divisions_id == $changeControl->division_id){
            //             $email = Helpers::getInitiatorEmail($u->user_id);
            //              if ($email !== null) {
                      
            //               Mail::send(
            //                   'mail.view-mail',
            //                    ['data' => $changeControl],
            //                 function ($message) use ($email) {
            //                     $message->to($email)
            //                         ->subject("Document is Send By".Auth::user()->name);
            //                 }
            //               );
            //             }
            //      } 
            //   }
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changeControl->stage == 6) {
                $changeControl->stage = "7";
                $changeControl->status = 'Closed - Done';
                $changeControl->risk_analysis_completed_by = Auth::user()->name;
                $changeControl->risk_analysis_completed_on = Carbon::now()->format('d-M-Y');
                $changeControl->risk_eveluation_comment =$request->comment;

                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->risk_analysis_completed_by;
                $history->comment = $request->comment;
                $history->action = 'All Action Completed Completed';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Close-Done";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Update";
                $history->stage = 'Close-Done';
                 $history->save();
                
                
                $changeControl->update();

                
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function RejectStateChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = RiskManagement::find($id);
            $lastDocument =  RiskManagement::find($id);
            $data =  RiskManagement::find($id);



            if ($changeControl->stage == 1) {
                $changeControl->stage = "0";
                $changeControl->status = "Closed - Cancelled";
                $changeControl->cancelled_by = Auth::user()->name;
                $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
                $changeControl->cancel_comment =$request->comment;

              
                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changeControl->cancelled_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='Cancelled';
                $history->save();
                
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 2) {
                $changeControl->stage = "1";
                $changeControl->status = "Opened";

                $changeControl->cancelled_by = Auth::user()->name;
                $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_actions_needed_1 =$request->comment;

                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->cancelled_by;
                $history->comment = $request->comment;
                $history->action  = "More Information Required";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Opened";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Update";
                $history->stage='Cancelled';
                $history->save();

                $changeControl->cancelled_by = Auth::user()->name;
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 3) {
                $changeControl->stage = "2";
                $changeControl->status = "Risk Analysis & Work Group Assignment";

                $changeControl->cancelled_by = Auth::user()->name;
                $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_actions_needed_2 =$request->comment;

                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->cancelled_by;
                $history->comment = $request->comment;
                $history->action  = "More Information Required";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Risk Analysis & Work Group Assignment";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Update";
                $history->stage='Cancelled';
                $history->save();

                
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 4) {
                $changeControl->stage = "3";
                $changeControl->status = "Risk Processing & Action Plan";

                $changeControl->cancelled_by = Auth::user()->name;
                $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_actions_needed_3 =$request->comment;

                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->cancelled_by;
                $history->comment = $request->comment;
                $history->action  = "Reject Action Plan";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Risk Processing & Action Plan";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Update";
                $history->stage='Cancelled';
                $history->save();

                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            
            if ($changeControl->stage == 5) {
                $changeControl->stage = "4";
                $changeControl->status = "Pending HOD Approval";

                $changeControl->cancelled_by = Auth::user()->name;
                $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_actions_needed_4  = $request->comment;

                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->cancelled_by;
                $history->comment = $request->comment;
                $history->action  = " Reject Action Plan ";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Pending HOD Approval";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Update";
                $history->stage='Cancelled';
                $history->save();
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 6) {
                $changeControl->stage = "5";
                $changeControl->status = "Actions Items in Progress";

                $changeControl->cancelled_by = Auth::user()->name;
                $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_actions_needed_5 =$request->comment;

                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->cancelled_by;
                $history->comment = $request->comment;
                $history->action  = " Reject Action Plan ";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Actions Items in Progress";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Update";
                $history->stage='Cancelled';
                $history->save();
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }



    public function riskAuditTrial($id)
    {
        //$audit = RiskAuditTrail::where('risk_id', $id)->orderByDESC('id')->get()->unique('activity_type');
        $audit = RiskAuditTrail::where('risk_id', $id)->orderByDesc('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = RiskManagement::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');


        //dd($audit);
        return view("frontend.riskAssesment.new_audit_trail", compact('audit', 'document', 'today'));
    }


    // public function riskAuditTrial($id)
    // {
    //     $audit = RiskAuditTrail::where('risk_id', $id)->orderByDESC('id')->get()->unique('activity_type');
    //     $today = Carbon::now()->format('d-m-y');
    //     $document = RiskManagement::where('id', $id)->first();
    //     $document->initiator = User::where('id', $document->initiator_id)->value('name');


    //     //dd($audit);
    //     return view("frontend.riskAssesment.audit-trail", compact('audit', 'document', 'today'));
    // }

    public function auditDetailsrisk($id)
    {

        $detail = RiskAuditTrail::find($id);

        $detail_data = RiskAuditTrail::where('activity_type', $detail->activity_type)->where('risk_id', $detail->risk_id)->latest()->get();

        $doc = RiskManagement::where('id', $detail->risk_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);
        return view("frontend.riskAssesment.audit-trial-inner", compact('detail', 'doc', 'detail_data'));
    }

    public static function singleReport($id)
    {
        $data = RiskManagement::find($id);
       // dd($data);
        if (!empty($data)) {
            $users = User::all();
            $riskgrdfishbone = RiskAssesmentGrid::where('risk_id', $data->id)->where('type','fishbone')->first();
            $failure_mode = RiskAssesmentGrid::where('risk_id', $data->id)->where('type','effect_analysis')->first();
            $riskgrdwhy_chart = RiskAssesmentGrid::where('risk_id', $data->id)->where('type','why_chart')->first();
            $riskgrdwhat_who_where = RiskAssesmentGrid::where('risk_id', $data->id)->where('type','what_who_where')->first();
            $action_plan = RiskAssesmentGrid::where('risk_id',$id)->where('type',"Action_Plan")->first();
            $mitigation = RiskAssesmentGrid::where('risk_id',$data->id)->where('type','Mitigation_Plan_Details')->first();
         
            // dd($riskgrdwhat_who_where);
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.riskAssesment.singleReport', compact('data','riskgrdfishbone','riskgrdwhy_chart','riskgrdwhat_who_where','failure_mode','action_plan','users','mitigation'))
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
            return $pdf->stream('Risk-assesment' . $id . '.pdf');
        }
    }

    public static function auditReport($id)
    {
        $doc = RiskManagement::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $data = RiskAuditTrail::where('risk_id', $id)->get();
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.riskAssesment.auditReport', compact('data', 'doc'))
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
            return $pdf->stream('Risk-Audit-Trial' . $id . '.pdf');
        }
    }

    public function child(Request $request, $id)
    {
        $parent_id = $id;
        $parent_type = "Action-Item";
        $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = str_pad($record, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $parent_record = RiskManagement::where('id', $id)->value('record');
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_division_id = RiskManagement::where('id', $id)->value('division_id');
        $parent_initiator_id = RiskManagement::where('id', $id)->value('initiator_id');
        $parent_intiation_date = RiskManagement::where('id', $id)->value('intiation_date');
        $parent_short_description = RiskManagement::where('id', $id)->value('short_description');
        $old_record = RiskManagement::select('id', 'division_id', 'record')->get();

        return view('frontend.action-item.action-item', compact('parent_id', 'parent_type', 'record', 'currentDate', 'formattedDate', 'due_date', 'parent_record', 'parent_record', 'parent_division_id', 'parent_initiator_id', 'parent_intiation_date', 'parent_short_description','old_record'));
    }
}
