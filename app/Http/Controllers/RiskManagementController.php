<?php

namespace App\Http\Controllers;

use App\Models\RecordNumber;
use App\Models\RiskAuditTrail;
use App\Models\RiskManagement;
use App\Models\RiskAssesmentGrid;
use App\Models\RoleGroup;
use App\Models\User;
use App\Models\RiskManagmentCft;
use App\Models\RiskAssesmentCftResponce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use App\Models\RootCauseAnalysis;
use App\Models\Extension;
use App\Models\RiskAssessment;
use App\Models\CC;
use App\Models\AuditReviewersDetails;
use PDF;
use Helpers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;



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
        $cft = User::get();
        $pre = CC::all();

        return view("frontend.forms.risk-management", compact('due_date','cft', 'pre', 'record_number', 'old_record'));
    }

    public function store(Request $request)
    {
        // return dd($request);
        // return $request;
        $form_progress = null;

        if (!$request->short_description) {
            toastr()->info("Short Description is required");
            return redirect()->back()->withInput();
        }
        // return $request;
        $data = new RiskManagement();
        $data->form_type = "risk-assesment";
        $data->division_id = $request->division_id;
        $data->division_code = $request->division_code;
        $data->form_progress = isset($form_progress) ? $form_progress : null;
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
        $data->source_of_risk = $request->source_of_risk;
        // $data->other_type = $request->other_type;
        // $data->other_source_of_risk = $request->other_source_of_risk;
        if ($request->input('source_of_risk') == 'Other') {
            $data->other_source_of_risk = $request->input('other_source_of_risk');
        } else {
            $data->other_source_of_risk = null; // or handle it accordingly
        }

        if ($request->input('type') == 'Other_data') {
            $data->other_type = $request->input('other_type');
        } else {
            $data->other_type = null; // or handle it accordingly
        }
       // $data->departments = implode(',', $request->departments);

        $data->departments = is_array($request->departments) ? implode(',', $request->departments) : '';

        // $data->team_members = implode(',', $request->team_members);
        $data->source_of_risk2 = $request->source_of_risk2;
        $data->type = $request->type;
        $data->priority_level = $request->priority_level;
        $data->zone = $request->zone;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->city = $request->city;
        // $data->description = $request->description;
        $data->severity2_level = $request->severity2_level;
        // $data->comments = $request->comments;
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
        $data->other_root_cause_methodology = $request->other_root_cause_methodology;

        // $data->risk_level = $request->input('risk_level');
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
        $data->qa_cqa_comments = $request->qa_cqa_comments;
        $data->qa_cqa_head_comm= $request->qa_cqa_head_comm;
        $data->assign_department = $request->assign_department;
        $data->r_a_conclussion = $request->r_a_conclussion;
        $data->hod_des_rev_comm = $request->hod_des_rev_comm;
        // $data->reviewer_person_value = $request->reviewer_person_value;

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


        if (!empty($request->risk_ana_attach)) {
            $files = [];
            if ($request->hasfile('risk_ana_attach')) {
                foreach ($request->file('risk_ana_attach') as $file) {
                    $name = $request->name . 'risk_ana_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->risk_ana_attach = json_encode($files);
        }

        // if (!empty($request->risk_ana_attach)) {
        //     $files = [];
        //     if ($request->hasfile('risk_ana_attach')) {
        //         foreach ($request->file('risk_ana_attach') as $file) {
        //             $name = $request->name . 'risk_ana_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $data->risk_ana_attach = json_encode($files);
        // }

        if (!empty($request->hod_design_attach)) {
            $files = [];
            if ($request->hasfile('hod_design_attach')) {
                foreach ($request->file('hod_design_attach') as $file) {
                    $name = $request->name . 'hod_design_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->hod_design_attach = json_encode($files);
        }

        // dd($data->risk_attachment);

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
        //  return $data;
        $data->save();


        /* CFT Data Feilds Start */

        $Cft = new RiskManagmentCft();
        $Cft->risk_id = $data->id;
        $Cft->Production_Review = $request->Production_Review;
        $Cft->Production_person = $request->Production_person;
        $Cft->Production_assessment = $request->Production_assessment;
        $Cft->Production_feedback = $request->Production_feedback;
        $Cft->production_on = $request->production_on;
        $Cft->production_by = $request->production_by;

        $Cft->Production_Table_Review = $request->Production_Table_Review;
        $Cft->Production_Table_Person = $request->Production_Table_Person;
        $Cft->Production_Table_Assessment = $request->Production_Table_Assessment;
        $Cft->Production_Table_Feedback = $request->Production_Table_Feedback;
        $Cft->Production_Table_By = $request->Production_Table_By;
        $Cft->Production_Table_On = $request->Production_Table_On;

        $Cft->Production_Injection_Review = $request->Production_Injection_Review;
        $Cft->Production_Injection_Person = $request->Production_Injection_Person;
        $Cft->Production_Injection_Assessment = $request->Production_Injection_Assessment;
        $Cft->Production_Injection_Feedback = $request->Production_Injection_Feedback;
        $Cft->Production_Injection_By = $request->Production_Injection_By;
        $Cft->Production_Injection_On = $request->Production_Injection_On;

        $Cft->ProductionLiquid_Review = $request->ProductionLiquid_Review;
        $Cft->ProductionLiquid_person = $request->ProductionLiquid_person;
        $Cft->ProductionLiquid_assessment = $request->ProductionLiquid_assessment;
        $Cft->ProductionLiquid_feedback = $request->ProductionLiquid_feedback;
        $Cft->ProductionLiquid_by = $request->ProductionLiquid_by;
        $Cft->ProductionLiquid_on = $request->ProductionLiquid_on;

        $Cft->Store_Review = $request->Store_Review;
        $Cft->Store_person = $request->Store_person;
        $Cft->Store_assessment = $request->Store_assessment;
        $Cft->Store_feedback = $request->Store_feedback;
        $Cft->Store_by = $request->Store_by;
        $Cft->Store_on = $request->Store_on;

        $Cft->RegulatoryAffair_Review = $request->RegulatoryAffair_Review;
        $Cft->RegulatoryAffair_person = $request->RegulatoryAffair_person;
        $Cft->RegulatoryAffair_assessment = $request->RegulatoryAffair_assessment;
        $Cft->RegulatoryAffair_feedback = $request->RegulatoryAffair_feedback;
        $Cft->Store_by = $request->RegulatoryAffair_by;
        $Cft->Store_on = $request->StoRegulatoryAffair_onre_on;

        $Cft->ResearchDevelopment_Review = $request->ResearchDevelopment_Review;
        $Cft->ResearchDevelopment_person = $request->ResearchDevelopment_person;
        $Cft->ResearchDevelopment_assessment = $request->ResearchDevelopment_assessment;
        $Cft->ResearchDevelopment_feedback   = $request->ResearchDevelopment_feedback;
        $Cft->ResearchDevelopment_by = $request->ResearchDevelopment_by;
        $Cft->ResearchDevelopment_on = $request->SResearchDevelopment_ontore_on;

        $Cft->Microbiology_Review = $request->Microbiology_Review;
        $Cft->Microbiology_person = $request->Microbiology_person;
        $Cft->Microbiology_assessment = $request->Microbiology_assessment;
        $Cft->Microbiology_feedback   = $request->Microbiology_feedback;
        $Cft->Microbiology_by = $request->Microbiology_by;
        $Cft->Microbiology_on = $request->Microbiology_on;


        $Cft->Quality_review = $request->Quality_review;
        $Cft->Quality_Control_Person = $request->Quality_Control_Person;
        $Cft->Quality_Control_assessment = $request->Quality_Control_assessment;
        $Cft->Quality_Control_feedback = $request->Quality_Control_feedback;
        $Cft->Quality_Control_by = $request->Quality_Control_by;
        $Cft->Quality_Control_on = $request->Quality_Control_on;

        $Cft->Quality_Assurance_Review = $request->Quality_Assurance_Review;
        $Cft->QualityAssurance_person = $request->QualityAssurance_person;
        $Cft->QualityAssurance_assessment = $request->QualityAssurance_assessment;
        $Cft->QualityAssurance_feedback = $request->QualityAssurance_feedback;
        $Cft->QualityAssurance_by = $request->QualityAssurance_by;
        $Cft->QualityAssurance_on = $request->QualityAssurance_on;

        $Cft->Engineering_review = $request->Engineering_review;
        $Cft->Engineering_person = $request->Engineering_person;
        $Cft->Engineering_assessment = $request->Engineering_assessment;
        $Cft->Engineering_feedback = $request->Engineering_feedback;
        $Cft->Engineering_by = $request->Engineering_by;
        $Cft->Engineering_on = $request->Engineering_on;

        $Cft->Analytical_Development_review = $request->Analytical_Development_review;
        $Cft->Analytical_Development_person = $request->Analytical_Development_person;
        $Cft->Analytical_Development_assessment = $request->Analytical_Development_assessment;
        $Cft->Analytical_Development_feedback = $request->Analytical_Development_feedback;
        $Cft->Analytical_Development_by = $request->Analytical_Development_by;
        $Cft->Analytical_Development_on = $request->Analytical_Development_on;

        $Cft->Kilo_Lab_review = $request->Kilo_Lab_review;
        $Cft->Kilo_Lab_person = $request->Kilo_Lab_person;
        $Cft->Kilo_Lab_assessment = $request->Kilo_Lab_assessment;
        $Cft->Kilo_Lab_feedback = $request->Kilo_Lab_feedback;
        $Cft->Kilo_Lab_attachment_by = $request->Kilo_Lab_attachment_by;
        $Cft->Kilo_Lab_attachment_on = $request->Kilo_Lab_attachment_on;

        $Cft->Technology_transfer_review = $request->Technology_transfer_review;
        $Cft->Technology_transfer_person = $request->Technology_transfer_person;
        $Cft->Technology_transfer_assessment = $request->Technology_transfer_assessment;
        $Cft->Technology_transfer_feedback = $request->Technology_transfer_feedback;
        $Cft->Technology_transfer_by = $request->Technology_transfer_by;
        $Cft->Technology_transfer_on = $request->Technology_transfer_on;

        $Cft->Environment_Health_review = $request->Environment_Health_review;
        $Cft->Environment_Health_Safety_person = $request->Environment_Health_Safety_person;
        $Cft->Health_Safety_assessment = $request->Health_Safety_assessment;
        $Cft->Health_Safety_feedback = $request->Health_Safety_feedback;
        $Cft->Environment_Health_Safety_by = $request->Environment_Health_Safety_by;
        $Cft->Environment_Health_Safety_on = $request->Environment_Health_Safety_on;

        $Cft->Human_Resource_review = $request->Human_Resource_review;
        $Cft->Human_Resource_person = $request->Human_Resource_person;
        $Cft->Human_Resource_assessment = $request->Human_Resource_assessment;
        $Cft->Human_Resource_feedback = $request->Human_Resource_feedback;
        $Cft->Human_Resource_by = $request->Human_Resource_by;
        $Cft->Human_Resource_on = $request->Human_Resource_on;

        $Cft->CorporateQualityAssurance_Review = $request->CorporateQualityAssurance_Review;
        $Cft->CorporateQualityAssurance_person = $request->CorporateQualityAssurance_person;
        $Cft->CorporateQualityAssurance_assessment = $request->CorporateQualityAssurance_assessment;
        $Cft->CorporateQualityAssurance_feedback = $request->CorporateQualityAssurance_feedback;
        $Cft->CorporateQualityAssurance_by = $request->CorporateQualityAssurance_by;
        $Cft->CorporateQualityAssurance_on = $request->CorporateQualityAssurance_on;

        $Cft->Information_Technology_review = $request->Information_Technology_review;
        $Cft->Information_Technology_person = $request->Information_Technology_person;
        $Cft->Information_Technology_assessment = $request->Information_Technology_assessment;
        $Cft->Information_Technology_feedback = $request->Information_Technology_feedback;
        $Cft->Information_Technology_by = $request->Information_Technology_by;
        $Cft->Information_Technology_on = $request->Information_Technology_on;

        $Cft->Project_management_review = $request->Project_management_review;
        $Cft->Project_management_person = $request->Project_management_person;
        $Cft->Project_management_assessment = $request->Project_management_assessment;
        $Cft->Project_management_feedback = $request->Project_management_feedback;
        $Cft->Project_management_by = $request->Project_management_by;
        $Cft->Project_management_on = $request->Project_management_on;

        $Cft->Other1_review = $request->Other1_review;
        $Cft->Other1_person = $request->Other1_person;
        $Cft->Other1_Department_person = $request->Other1_Department_person;
        $Cft->Other1_assessment = $request->Other1_assessment;
        $Cft->Other1_feedback = $request->Other1_feedback;
        $Cft->Other1_by = $request->Other1_by;
        $Cft->Other1_on = $request->Other1_on;

        $Cft->Other2_review = $request->Other2_review;
        $Cft->Other2_person = $request->Other2_person;
        $Cft->Other2_Department_person = $request->Other2_Department_person;
        $Cft->Other2_Assessment = $request->Other2_Assessment;
        $Cft->Other2_feedback = $request->Other2_feedback;
        $Cft->Other2_by = $request->Other2_by;
        $Cft->Other2_on = $request->Other2_on;

        $Cft->Other3_review = $request->Other3_review;
        $Cft->Other3_person = $request->Other3_person;
        $Cft->Other3_Department_person = $request->Other3_Department_person;
        $Cft->Other3_Assessment = $request->Other3_Assessment;
        $Cft->Other3_feedback = $request->Other3_feedback;
        $Cft->Other3_by = $request->Other3_by;
        $Cft->Other3_on = $request->Other3_on;

        $Cft->Other4_review = $request->Other4_review;
        $Cft->Other4_person = $request->Other4_person;
        $Cft->Other4_Department_person = $request->Other4_Department_person;
        $Cft->Other4_Assessment = $request->Other4_Assessment;
        $Cft->Other4_feedback = $request->Other4_feedback;
        $Cft->Other4_by = $request->Other4_by;
        $Cft->Other4_on = $request->Other4_on;

        $Cft->Other5_review = $request->Other5_review;
        $Cft->Other5_person = $request->Other5_person;
        $Cft->Other5_Department_person = $request->Other5_Department_person;
        $Cft->Other5_Assessment = $request->Other5_Assessment;
        $Cft->Other5_feedback = $request->Other5_feedback;
        $Cft->Other5_by = $request->Other5_by;
        $Cft->Other5_on = $request->Other5_on;

        if (!empty($request->production_attachment)) {
            $files = [];
            if ($request->hasfile('production_attachment')) {
                foreach ($request->file('production_attachment') as $file) {
                    $name = $request->name . 'production_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->production_attachment = json_encode($files);
        }
        if (!empty($request->Warehouse_attachment)) {
            $files = [];
            if ($request->hasfile('Warehouse_attachment')) {
                foreach ($request->file('Warehouse_attachment') as $file) {
                    $name = $request->name . 'Warehouse_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $Cft->Warehouse_attachment = json_encode($files);
        }
        if (!empty($request->Quality_Control_attachment)) {
            $files = [];
            if ($request->hasfile('Quality_Control_attachment')) {
                foreach ($request->file('Quality_Control_attachment') as $file) {
                    $name = $request->name . 'Quality_Control_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $Cft->Quality_Control_attachment = json_encode($files);
        }
        if (!empty($request->Quality_Assurance_attachment)) {
            $files = [];
            if ($request->hasfile('Quality_Assurance_attachment')) {
                foreach ($request->file('Quality_Assurance_attachment') as $file) {
                    $name = $request->name . 'Quality_Assurance_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $Cft->Quality_Assurance_attachment = json_encode($files);
        }
        if (!empty($request->Engineering_attachment)) {
            $files = [];
            if ($request->hasfile('Engineering_attachment')) {
                foreach ($request->file('Engineering_attachment') as $file) {
                    $name = $request->name . 'Engineering_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $Cft->Engineering_attachment = json_encode($files);
        }
        if (!empty($request->Analytical_Development_attachment)) {
            $files = [];
            if ($request->hasfile('Analytical_Development_attachment')) {
                foreach ($request->file('Analytical_Development_attachment') as $file) {
                    $name = $request->name . 'Analytical_Development_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $Cft->Analytical_Development_attachment = json_encode($files);
        }
        if (!empty($request->Kilo_Lab_attachment)) {
            $files = [];
            if ($request->hasfile('Kilo_Lab_attachment')) {
                foreach ($request->file('Kilo_Lab_attachment') as $file) {
                    $name = $request->name . 'Kilo_Lab_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $Cft->Kilo_Lab_attachment = json_encode($files);
        }
        if (!empty($request->Technology_transfer_attachment)) {
            $files = [];
            if ($request->hasfile('Technology_transfer_attachment')) {
                foreach ($request->file('Technology_transfer_attachment') as $file) {
                    $name = $request->name . 'Technology_transfer_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $Cft->Technology_transfer_attachment = json_encode($files);
        }
        if (!empty($request->Environment_Health_Safety_attachment)) {
            $files = [];
            if ($request->hasfile('Environment_Health_Safety_attachment')) {
                foreach ($request->file('Environment_Health_Safety_attachment') as $file) {
                    $name = $request->name . 'Environment_Health_Safety_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $Cft->Environment_Health_Safety_attachment = json_encode($files);
        }
        if (!empty($request->Human_Resource_attachment)) {
            $files = [];
            if ($request->hasfile('Human_Resource_attachment')) {
                foreach ($request->file('Human_Resource_attachment') as $file) {
                    $name = $request->name . 'Human_Resource_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $Cft->Human_Resource_attachment = json_encode($files);
        }

        if (!empty($request->Information_Technology_attachment)) {
            $files = [];
            if ($request->hasfile('Information_Technology_attachment')) {
                foreach ($request->file('Information_Technology_attachment') as $file) {
                    $name = $request->name . 'Information_Technology_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $Cft->Information_Technology_attachment = json_encode($files);
        }
        if (!empty($request->Project_management_attachment)) {
            $files = [];
            if ($request->hasfile('Project_management_attachment')) {
                foreach ($request->file('Project_management_attachment') as $file) {
                    $name = $request->name . 'Project_management_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $Cft->Project_management_attachment = json_encode($files);
        }

        if (!empty($request->CorporateQualityAssurance_attachment)) {
            $files = [];
            if ($request->hasfile('CorporateQualityAssurance_attachment')) {
                foreach ($request->file('CorporateQualityAssurance_attachment') as $file) {
                    $name = $request->name . 'CorporateQualityAssurance_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $Cft->CorporateQualityAssurance_attachment = json_encode($files);
        }
        if (!empty($request->Other1_attachment)) {
            $files = [];
            if ($request->hasfile('Other1_attachment')) {
                foreach ($request->file('Other1_attachment') as $file) {
                    $name = $request->name . 'Other1_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $Cft->Other1_attachment = json_encode($files);
        }
        if (!empty($request->Other2_attachment)) {
            $files = [];
            if ($request->hasfile('Other2_attachment')) {
                foreach ($request->file('Other2_attachment') as $file) {
                    $name = $request->name . 'Other2_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $Cft->Other2_attachment = json_encode($files);
        }
        if (!empty($request->Other3_attachment)) {
            $files = [];
            if ($request->hasfile('Other3_attachment')) {
                foreach ($request->file('Other3_attachment') as $file) {
                    $name = $request->name . 'Other3_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Other3_attachment = json_encode($files);
        }
        if (!empty($request->Other4_attachment)) {
            $files = [];
            if ($request->hasfile('Other4_attachment')) {
                foreach ($request->file('Other4_attachment') as $file) {
                    $name = $request->name . 'Other4_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Other4_attachment = json_encode($files);
        }
        if (!empty($request->Other5_attachment)) {
            $files = [];
            if ($request->hasfile('Other5_attachment')) {
                foreach ($request->file('Other5_attachment') as $file) {
                    $name = $request->name . 'Other5_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Other5_attachment = json_encode($files);
        }

        if (!empty($request->qa_cqa_attachments)) {
            $files = [];
            if ($request->hasfile('qa_cqa_attachments')) {
                foreach ($request->file('qa_cqa_attachments') as $file) {
                    $name = $request->name . 'qa_cqa_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->qa_cqa_attachments = json_encode($files);
        }

        if (!empty($request->qa_cqa_head_attach)) {
            $files = [];
            if ($request->hasfile('qa_cqa_head_attach')) {
                foreach ($request->file('qa_cqa_head_attach') as $file) {
                    $name = $request->name . 'qa_cqa_head_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->qa_cqa_head_attach = json_encode($files);
        }

        $Cft->save();


        /* CFT Fields Ends */

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
        }
        if (!empty($request->when_will_be)) {
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

        if (!empty($data->record)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Record Number';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName($data->division_id). '/RA/'. Helpers::year($data->created). '/'.str_pad($data->record, 4, '0', STR_PAD_LEFT);
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

        if (!empty($data->division_id)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Site/Location Code';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName($data->division_id);
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

        if (!empty($data->initiator_id)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($data->initiator_id);
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

        if (!empty($data->intiation_date)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Date Of Initiation';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($data->intiation_date);
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

        if (!empty($data->Initiator_Group)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Initiator Department';
            $history->previous = "Null";
            $history->current = Helpers::getFullDepartmentName($data->Initiator_Group);
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

        if (!empty($data->initiator_group_code)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Initiator Department Code';
            $history->previous = "Null";
            $history->current =$data->initiator_group_code;
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

        if (!empty($data->other_source_of_risk)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Other(Sourec Of Risk Opportunity)';
            $history->previous = "Null";
            $history->current = $data->other_source_of_risk;
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

        if (!empty($data->other_type)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Other(Type)';
            $history->previous = "Null";
            $history->current = $data->other_type;
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

        // if (!empty($data->due_date)) {
        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $data->id;
        //     $history->activity_type = 'Due Date';
        //     $history->previous = "Null";
        //     $history->current = Helpers::getdateFormat($data->due_date);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->save();
        // }


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

        if (!empty($data->risk_attachment)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Initial Attachment';
            $history->previous = "Null";
            $history->current = $data->risk_attachment;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";

            $history->save();
            }

            if (!empty($data->root_cause_methodology)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Root Cause Methodology';
                $history->previous = "Null";
                $history->current = $data->root_cause_methodology;
                $history->comment = "NA";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to= "Opened";
                $history->change_from= "Initiation";
                $history->action_name="Create";

                $history->save();
            }

            if (!empty($data->other_root_cause_methodology)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Other(Root Cause Methodology)';
                $history->previous = "Null";
                $history->current = $data->other_root_cause_methodology;
                $history->comment = "NA";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to= "Opened";
                $history->change_from= "Initiation";
                $history->action_name="Create";

                $history->save();
            }

            if (!empty($data->investigation_summary)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Risk Assessment Summary';
                $history->previous = "Null";
                $history->current = $data->investigation_summary;
                $history->comment = "NA";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to= "Opened";
                $history->change_from= "Initiation";
                $history->action_name="Create";

                $history->save();
            }

            if (!empty($data->r_a_conclussion)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Risk Assessment Conclusion';
                $history->previous = "Null";
                $history->current = $data->r_a_conclussion;
                $history->comment = "NA";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to= "Opened";
                $history->change_from= "Initiation";
                $history->action_name="Create";

                $history->save();
            }


            // if (!empty($data->severity_rate)) {
            //     $history = new RiskAuditTrail();
            //     $history->risk_id = $data->id;
            //     $history->activity_type = 'Severity Rate';
            //     $history->previous = "Null";
            //     $history->current = $data->severity_rate;
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $data->status;
            //     $history->change_to =   "Opened";
            //     $history->change_from = "Initiation";
            //     $history->action_name = 'Create';

            //     $history->save();
            // }


            // if (!empty($data->occurrence)) {
            //     $history = new RiskAuditTrail();
            //     $history->risk_id = $data->id;
            //     $history->activity_type = 'Occurrence';
            //     $history->previous = "Null";
            //     $history->current = $data->occurrence;
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $data->status;
            //     $history->change_to =   "Opened";
            //     $history->change_from = "Initiation";
            //     $history->action_name = 'Create';

            //     $history->save();
            // }


            // if (!empty($data->detection)) {
            //     $history = new RiskAuditTrail();
            //     $history->risk_id = $data->id;
            //     $history->activity_type = 'Detection';
            //     $history->previous = "Null";
            //     $history->current = $data->detection;
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $data->status;
            //     $history->change_to =   "Opened";
            //     $history->change_from = "Initiation";
            //     $history->action_name = 'Create';
            //     $history->save();
            // }


            // if (!empty($data->rpn)) {
            //     $history = new RiskAuditTrail();
            //     $history->risk_id = $data->id;
            //     $history->activity_type = 'Rpn';
            //     $history->previous = "Null";
            //     $history->current = $data->rpn;
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $data->status;
            //     $history->change_to =   "Opened";
            //     $history->change_from = "Initiation";
            //     $history->action_name = 'Create';

            //     $history->save();
            // }


            if (!empty($data->risk_ana_attach)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'Attachments';
                $history->previous = "Null";
                $history->current = $data->risk_ana_attach;
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

            if (!empty($data->reviewer_person_value)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'CFT Reviewer Selection';
                $history->previous = "Null";
                $history->current = $data->reviewer_person_value;
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

            // if (!empty($data->hod_des_rev_comm)) {
            //     $history = new RiskAuditTrail();
            //     $history->risk_id = $data->id;
            //     $history->activity_type = 'HOD/Designee Review Comment';
            //     $history->previous = "Null";
            //     $history->current = $data->hod_des_rev_comm;
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $data->status;
            //     $history->change_to =   "Opened";
            //     $history->change_from = "Initiation";
            //     $history->action_name = 'Create';

            //     $history->save();
            // }

            if (!empty($data->hod_des_rev_comm)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'HOD Designee Review Comment';
                $history->previous = "Null";
                $history->current = $data->hod_des_rev_comm;
                $history->comment = "NA";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to= "Opened";
                $history->change_from= "Initiation";
                $history->action_name="Create";

                $history->save();
            }

            if (!empty($data->hod_design_attach)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'HOD/Designee Review Attachment';
                $history->previous = "Null";
                $history->current = $data->hod_design_attach;
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

            if (!empty($data->qa_cqa_comments)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'QA/CQA Review Comment';
                $history->previous = "Null";
                $history->current = $data->qa_cqa_comments;
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

            if (!empty($data->qa_cqa_attachments)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'CQA/QA Review Attachment';
                $history->previous = "Null";
                $history->current = $data->qa_cqa_attachments;
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

            if (!empty($data->qa_cqa_head_comm)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'QA/CQA Head Approval Comment';
                $history->previous = "Null";
                $history->current = $data->qa_cqa_head_comm;
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

            if (!empty($data->qa_cqa_head_attach)) {
                $history = new RiskAuditTrail();
                $history->risk_id = $data->id;
                $history->activity_type = 'QA/CQA Head Attachment';
                $history->previous = "Null";
                $history->current = $data->qa_cqa_head_attach;
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

        // if (!empty($data->open_date)) {
        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $data->id;
        //     $history->activity_type = 'Open Date';
        //     $history->previous = "Null";
        //     $history->current = $data->open_date;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->save();
        // }

        // if (!empty($data->assign_to)) {
        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $data->id;
        //     $history->activity_type = 'Assign Id';
        //     $history->previous = "Null";
        //     $history->current = $data->assign_to;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->save();
        // }

        // if (!empty($data->departments)) {
        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $data->id;
        //     $history->activity_type = 'Departments';
        //     $history->previous = "Null";
        //     $history->current = $data->departments;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';

        //     $history->save();
        // }

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

        // if (!empty($data->description)) {
        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $data->id;
        //     $history->activity_type = 'Risk/Opportunity Description';
        //     $history->previous = "Null";
        //     $history->current = $data->description;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';

        //     $history->save();
        // }

        // if (!empty($data->comments)) {
        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $data->id;
        //     $history->activity_type = 'Risk/Opportunity Comments';
        //     $history->previous = "Null";
        //     $history->current = $data->comments;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';

        //     $history->save();
        // }

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
        if (!empty($data->criticality)) {
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
        $form_progress = null;

        $lastDocument =  RiskManagement::find($id);
        $data =  RiskManagement::find($id);
        $lastCft = RiskManagmentCft::where('risk_id', $data->id)->first();
        if (!$request->short_description) {
            toastr()->info("Short Description is required");
            return redirect()->back()->withInput();
        }

        $data->division_code = $request->division_code;
        //$data->record_number = $request->record_number;
        $data->short_description = $request->short_description;
        $data->open_date = $request->open_date;
        $data->assign_to = $request->assign_to;
        $data->due_date = $request->due_date;
        $data->Initiator_Group = $request->Initiator_Group;
        $data->initiator_group_code = $request->initiator_group_code;
        //$data->departments = implode(',', $request->departments);
        $data->departments = is_array($request->departments) ? implode(',', $request->departments) : '';
        //$data->team_members = implode(',', $request->team_members);
        $data->source_of_risk = $request->source_of_risk;

        // $data->other_type = $request->other_type;
        // $data->other_source_of_risk = $request->other_source_of_risk;

        if ($request->input('source_of_risk') == 'Other') {
            $data->other_source_of_risk = $request->input('other_source_of_risk');
        } else {
            $data->other_source_of_risk = null;
        }

        if ($request->input('type') == 'Other_data') {
            $data->other_type = $request->input('other_type');
        } else {
            $data->other_type = null;
        }

        $data->source_of_risk2 = $request->source_of_risk2;
        $data->type = $request->type;
        $data->priority_level = $request->priority_level;

        $data->zone = $request->zone;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->city = $request->city;
        // $data->description = $request->description;
        $data->severity2_level = $request->severity2_level;
        // $data->comments = $request->comments;
        // $data->departments2 = implode(',', $request->departments2);
        $data->departments2 = is_array($request->departments2) ? implode(',', $request->departments2) : '';
        // $data->risk_level = $request->input('risk_level');
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
        // $data->root_cause_methodology = implode(',', $request->root_cause_methodology);
        $data->other_root_cause_methodology = $request->other_root_cause_methodology;
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
        $data->qa_cqa_comments = $request->qa_cqa_comments;
        $data->qa_cqa_head_comm= $request->qa_cqa_head_comm;
        $data->assign_department = $request->assign_department;
        $data->r_a_conclussion = $request->r_a_conclussion;
        $data->hod_des_rev_comm = $request->hod_des_rev_comm;
        // $data->reviewer_person_value = $request->reviewer_person_value;
        if (is_array($request->reviewer_person_value)) {
            $data->reviewer_person_value = implode(',', $request->reviewer_person_value);
        } else {
            $data->reviewer_person_value = $request->reviewer_person_value;
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


        if (!empty($request->risk_ana_attach)) {
            $files = [];
            if ($request->hasfile('risk_ana_attach')) {
                foreach ($request->file('risk_ana_attach') as $file) {
                    $name = $request->name . 'risk_ana_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $data->risk_ana_attach = json_encode($files);
        }

        // if (!empty($request->risk_ana_attach)) {
        //     $files = [];
        //     if ($request->hasfile('risk_ana_attach')) {
        //         foreach ($request->file('risk_ana_attach') as $file) {
        //             $name = $request->name . 'risk_ana_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }

        //     $data->risk_ana_attach = json_encode($files);
        // }

        if (!empty($request->hod_design_attach)) {
            $files = [];
            if ($request->hasfile('hod_design_attach')) {
                foreach ($request->file('hod_design_attach') as $file) {
                    $name = $request->name . 'hod_design_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $data->hod_design_attach = json_encode($files);
        }

        if ($request->hasFile('qa_cqa_attachments')) {
            $files = [];
            foreach ($request->file('qa_cqa_attachments') as $file) {
                $name = $request->name . '_qa_cqa_attachments_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/'), $name);
                $files[] = $name;
            }
            $data->qa_cqa_attachments = json_encode($files);
        }

        $data->fill($request->except('qa_cqa_head_attach'));if ($request->hasFile('qa_cqa_head_attach')) {
            $files = [];
            foreach ($request->file('qa_cqa_head_attach') as $file) {
                $name = $request->name . '_qa_cqa_head_attach_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/'), $name);
                $files[] = $name;
            }
            $data->qa_cqa_head_attach = json_encode($files);
        }
        $data->fill($request->except('qa_cqa_head_attach'));
        // return $data;

        // -----------grid=------
        //  $data1 = new RiskAssesmentGrid();
        //  $data1->risk_id = $data->id;
        //  $data1->type = "effect_analysis";


        if ($data->stage == 2 || $data->stage == 3) {

            // if (!$form_progress) {
            //     $form_progress = 'cft';
            // }


            $Cft = RiskManagmentCft::withoutTrashed()->where('risk_id', $id)->first();
            if ($Cft && $data->stage == 3) {
                $Cft->Production_Review = $request->Production_Review == null ? $Cft->Production_Review : $request->Production_Review;
                $Cft->Production_person = $request->Production_person == null ? $Cft->Production_person : $request->Production_person;
                $Cft->Production_Table_Review = $request->Production_Table_Review == null ? $Cft->Production_Table_Review : $request->Production_Table_Review;
                $Cft->Production_Table_Person = $request->Production_Table_Person == null ? $Cft->Production_Table_Person : $request->Production_Table_Person;
                $Cft->Warehouse_review = $request->Warehouse_review == null ? $Cft->Warehouse_review : $request->Warehouse_review;
                $Cft->Warehouse_notification = $request->Warehouse_notification == null ? $Cft->Warehouse_notification : $request->Warehouse_notification;
                $Cft->Quality_review = $request->Quality_review == null ? $Cft->Quality_review : $request->Quality_review;;
                $Cft->Quality_Control_Person = $request->Quality_Control_Person == null ? $Cft->Quality_Control_Person : $request->Quality_Control_Person;
                $Cft->Quality_Assurance_Review = $request->Quality_Assurance_Review == null ? $Cft->Quality_Assurance_Review : $request->Quality_Assurance_Review;
                $Cft->QualityAssurance_person = $request->QualityAssurance_person == null ? $Cft->QualityAssurance_person : $request->QualityAssurance_person;

                $Cft->ProductionLiquid_Review = $request->ProductionLiquid_Review == null ? $Cft->ProductionLiquid_Review : $request->ProductionLiquid_Review;
                $Cft->ProductionLiquid_person = $request->ProductionLiquid_person == null ? $Cft->ProductionLiquid_person : $request->ProductionLiquid_person;



                $Cft->Production_Injection_Review = $request->Production_Injection_Review == null ? $Cft->Production_Injection_Review : $request->Production_Injection_Review;
                $Cft->Production_Injection_Person = $request->Production_Injection_Person == null ? $Cft->Production_Injection_Person : $request->Production_Injection_Person;

                $Cft->Microbiology_Review = $request->Microbiology_Review == null ? $Cft->Microbiology_Review : $request->Microbiology_Review;
                $Cft->Microbiology_person = $request->Microbiology_person == null ? $Cft->Microbiology_person : $request->Microbiology_person;

                $Cft->ResearchDevelopment_Review = $request->ResearchDevelopment_Review == null ? $Cft->ResearchDevelopment_Review : $request->ResearchDevelopment_Review;
                $Cft->ResearchDevelopment_person = $request->ResearchDevelopment_person == null ? $Cft->ResearchDevelopment_person : $request->ResearchDevelopment_person;


                $Cft->Engineering_review = $request->Engineering_review == null ? $Cft->Engineering_review : $request->Engineering_review;
                $Cft->Engineering_person = $request->Engineering_person == null ? $Cft->Engineering_person : $request->Engineering_person;

                $Cft->RegulatoryAffair_Review = $request->RegulatoryAffair_Review == null ? $Cft->RegulatoryAffair_Review : $request->RegulatoryAffair_Review;
                $Cft->RegulatoryAffair_person = $request->RegulatoryAffair_person == null ? $Cft->RegulatoryAffair_person : $request->RegulatoryAffair_person;

                $Cft->Analytical_Development_review = $request->Analytical_Development_review == null ? $Cft->Analytical_Development_review : $request->Analytical_Development_review;
                $Cft->Analytical_Development_person = $request->Analytical_Development_person == null ? $Cft->Analytical_Development_person : $request->Analytical_Development_person;
                $Cft->Kilo_Lab_review = $request->Kilo_Lab_review == null ? $Cft->Kilo_Lab_review : $request->Kilo_Lab_review;
                $Cft->Kilo_Lab_person = $request->Kilo_Lab_person == null ? $Cft->Kilo_Lab_person : $request->Kilo_Lab_person;
                $Cft->Technology_transfer_review = $request->Technology_transfer_review == null ? $Cft->Technology_transfer_review : $request->Technology_transfer_review;
                $Cft->Technology_transfer_person = $request->Technology_transfer_person == null ? $Cft->Technology_transfer_person : $request->Technology_transfer_person;
                $Cft->Environment_Health_review = $request->Environment_Health_review == null ? $Cft->Environment_Health_review : $request->Environment_Health_review;
                $Cft->Environment_Health_Safety_person = $request->Environment_Health_Safety_person == null ? $Cft->Environment_Health_Safety_person : $request->Environment_Health_Safety_person;
                $Cft->ContractGiver_Review = $request->ContractGiver_Review == null ? $Cft->ContractGiver_Review : $request->ContractGiver_Review;
                $Cft->ContractGiver_person = $request->ContractGiver_person == null ? $Cft->ContractGiver_person : $request->ContractGiver_person;
                $Cft->Human_Resource_review = $request->Human_Resource_review == null ? $Cft->Human_Resource_review : $request->Human_Resource_review;
                $Cft->Human_Resource_person = $request->Human_Resource_person == null ? $Cft->Human_Resource_person : $request->Human_Resource_person;
                $Cft->CorporateQualityAssurance_Review = $request->CorporateQualityAssurance_Review == null ? $Cft->CorporateQualityAssurance_Review : $request->CorporateQualityAssurance_Review;
                $Cft->CorporateQualityAssurance_person = $request->CorporateQualityAssurance_person == null ? $Cft->CorporateQualityAssurance_person : $request->CorporateQualityAssurance_person;
                $Cft->Store_Review = $request->Store_Review == null ? $Cft->Store_Review : $request->Store_Review;
                $Cft->Store_person = $request->Store_person == null ? $Cft->Store_person : $request->Store_person;
                $Cft->Project_management_review = $request->Project_management_review == null ? $Cft->Project_management_review : $request->Project_management_review;
                $Cft->Project_management_person = $request->Project_management_person == null ? $Cft->Project_management_person : $request->Project_management_person;
                $Cft->Information_Technology_review = $request->Information_Technology_review == null ? $Cft->Information_Technology_review : $request->Information_Technology_review;
                $Cft->Information_Technology_person = $request->Information_Technology_person == null ? $Cft->Information_Technology_person : $request->Information_Technology_person;
                $Cft->Other1_review = $request->Other1_review  == null ? $Cft->Other1_review : $request->Other1_review;
                $Cft->Other1_person = $request->Other1_person  == null ? $Cft->Other1_person : $request->Other1_person;
                $Cft->Other1_Department_person = $request->Other1_Department_person  == null ? $Cft->Other1_Department_person : $request->Other1_Department_person;
                $Cft->Other2_review = $request->Other2_review  == null ? $Cft->Other2_review : $request->Other2_review;
                $Cft->Other2_person = $request->Other2_person  == null ? $Cft->Other2_person : $request->Other2_person;
                $Cft->Other2_Department_person = $request->Other2_Department_person  == null ? $Cft->Other2_Department_person : $request->Other2_Department_person;
                $Cft->Other3_review = $request->Other3_review  == null ? $Cft->Other3_review : $request->Other3_review;
                $Cft->Other3_person = $request->Other3_person  == null ? $Cft->Other3_person : $request->Other3_person;
                $Cft->Other3_Department_person = $request->Other3_Department_person  == null ? $Cft->Other3_Department_person : $request->Other3_Department_person;
                $Cft->Other4_review = $request->Other4_review  == null ? $Cft->Other4_review : $request->Other4_review;
                $Cft->Other4_person = $request->Other4_person  == null ? $Cft->Other4_person : $request->Other4_person;
                $Cft->Other4_Department_person = $request->Other4_Department_person  == null ? $Cft->Other4_Department_person : $request->Other4_Department_person;
                $Cft->Other5_review = $request->Other5_review  == null ? $Cft->Other5_review : $request->Other5_review;
                $Cft->Other5_person = $request->Other5_person  == null ? $Cft->Other5_person : $request->Other5_person;
                $Cft->Other5_Department_person = $request->Other5_Department_person  == null ? $Cft->Other5_Department_person : $request->Other5_Department_person;
            } else {
                $Cft->Production_Review = $request->Production_Review;
                $Cft->Production_person = $request->Production_person;
                $Cft->Production_Table_Review = $request->Production_Table_Review;
                $Cft->Production_Table_Person = $request->Production_Table_Person;
                $Cft->Production_Injection_Review = $request->Production_Injection_Review;
                $Cft->Production_Injection_Person = $request->Production_Injection_Person;
                $Cft->Warehouse_review = $request->Warehouse_review;
                $Cft->Warehouse_notification = $request->Warehouse_notification;
                $Cft->Quality_review = $request->Quality_review;
                $Cft->Quality_Control_Person = $request->Quality_Control_Person;
                $Cft->Quality_Assurance_Review = $request->Quality_Assurance_Review;
                $Cft->QualityAssurance_person = $request->QualityAssurance_person;
                $Cft->ProductionLiquid_Review = $request->ProductionLiquid_Review;
                $Cft->ProductionLiquid_person = $request->ProductionLiquid_person;
                $Cft->Microbiology_Review = $request->Microbiology_Review;
                $Cft->Microbiology_person = $request->ProductionLiquid_person;
                $Cft->Engineering_review = $request->Engineering_review;
                $Cft->Engineering_person = $request->Engineering_person;
                $Cft->RegulatoryAffair_Review = $request->RegulatoryAffair_Review;
                $Cft->RegulatoryAffair_person = $request->RegulatoryAffair_person;
                $Cft->Analytical_Development_review = $request->Analytical_Development_review;
                $Cft->Analytical_Development_person = $request->Analytical_Development_person;
                $Cft->Kilo_Lab_review = $request->Kilo_Lab_review;
                $Cft->Kilo_Lab_person = $request->Kilo_Lab_person;
                $Cft->Technology_transfer_review = $request->Technology_transfer_review;
                $Cft->Technology_transfer_person = $request->Technology_transfer_person;
                $Cft->Environment_Health_review = $request->Environment_Health_review;
                $Cft->Environment_Health_Safety_person = $request->Environment_Health_Safety_person;
                $Cft->ContractGiver_Review = $request->ContractGiver_Review;
                $Cft->ContractGiver_person = $request->ContractGiver_person;
                $Cft->Human_Resource_review = $request->Human_Resource_review;
                $Cft->Human_Resource_person = $request->Human_Resource_person;
                $Cft->CorporateQualityAssurance_Review = $request->CorporateQualityAssurance_Review;
                $Cft->CorporateQualityAssurance_person = $request->CorporateQualityAssurance_person;
                $Cft->Store_Review = $request->Store_Review;
                $Cft->Store_person = $request->Store_person;
                $Cft->Project_management_review = $request->Project_management_review;
                $Cft->Project_management_person = $request->Project_management_person;
                $Cft->ResearchDevelopment_Review = $request->ResearchDevelopment_Review;
                $Cft->ResearchDevelopment_person = $request->ResearchDevelopment_person;
                $Cft->Information_Technology_review = $request->Information_Technology_review;
                $Cft->Information_Technology_person = $request->Information_Technology_person;
                $Cft->Other1_review = $request->Other1_review;
                $Cft->Other1_person = $request->Other1_person;
                $Cft->Other1_Department_person = $request->Other1_Department_person;
                $Cft->Other2_review = $request->Other2_review;
                $Cft->Other2_person = $request->Other2_person;
                $Cft->Other2_Department_person = $request->Other2_Department_person;
                $Cft->Other3_review = $request->Other3_review;
                $Cft->Other3_person = $request->Other3_person;
                $Cft->Other3_Department_person = $request->Other3_Department_person;
                $Cft->Other4_review = $request->Other4_review;
                $Cft->Other4_person = $request->Other4_person;
                $Cft->Other4_Department_person = $request->Other4_Department_person;
                $Cft->Other5_review = $request->Other5_review;
                $Cft->Other5_person = $request->Other5_person;
                $Cft->Other5_Department_person = $request->Other5_Department_person;
            }
            $Cft->Production_assessment = $request->Production_assessment;
            $Cft->Production_Table_Assessment = $request->Production_Table_Assessment;
            $Cft->Production_Table_Feedback = $request->Production_Table_Feedback;
            $Cft->Production_feedback = $request->Production_feedback;
            $Cft->Warehouse_assessment = $request->Warehouse_assessment;
            $Cft->Warehouse_feedback = $request->Warehouse_feedback;
            $Cft->Production_Injection_Assessment = $request->Production_Injection_Assessment;
            $Cft->Production_Injection_Feedback = $request->Production_Injection_Feedback;
            $Cft->Quality_Control_assessment = $request->Quality_Control_assessment;
            $Cft->Quality_Control_feedback = $request->Quality_Control_feedback;
            $Cft->QualityAssurance_assessment = $request->QualityAssurance_assessment;
            $Cft->QualityAssurance_feedback = $request->QualityAssurance_feedback;

            $Cft->ProductionLiquid_assessment = $request->ProductionLiquid_assessment;
            $Cft->ProductionLiquid_feedback = $request->ProductionLiquid_feedback;
            $Cft->Microbiology_assessment = $request->Microbiology_assessment;
            $Cft->Microbiology_feedback = $request->Microbiology_feedback;
            $Cft->Engineering_assessment = $request->Engineering_assessment;
            $Cft->Engineering_feedback = $request->Engineering_feedback;
            $Cft->RegulatoryAffair_assessment = $request->RegulatoryAffair_assessment;
            $Cft->RegulatoryAffair_feedback = $request->RegulatoryAffair_feedback;
            $Cft->Analytical_Development_assessment = $request->Analytical_Development_assessment;
            $Cft->Analytical_Development_feedback = $request->Analytical_Development_feedback;
            $Cft->Kilo_Lab_assessment = $request->Kilo_Lab_assessment;
            $Cft->Kilo_Lab_feedback = $request->Kilo_Lab_feedback;
            $Cft->Technology_transfer_assessment = $request->Technology_transfer_assessment;
            $Cft->Technology_transfer_feedback = $request->Technology_transfer_feedback;
            $Cft->Health_Safety_assessment = $request->Health_Safety_assessment;
            $Cft->Health_Safety_feedback = $request->Health_Safety_feedback;
            $Cft->ContractGiver_assessment = $request->Health_Safety_assessment;
            $Cft->ContractGiver_feedback = $request->ContractGiver_feedback;
            $Cft->Human_Resource_assessment = $request->Human_Resource_assessment;
            $Cft->Human_Resource_feedback = $request->Human_Resource_feedback;
            $Cft->Information_Technology_assessment = $request->Information_Technology_assessment;
            $Cft->Information_Technology_feedback = $request->Information_Technology_feedback;
            $Cft->ResearchDevelopment_assessment = $request->ResearchDevelopment_assessment;
            $Cft->ResearchDevelopment_feedback = $request->ResearchDevelopment_feedback;
            $Cft->Project_management_assessment = $request->Project_management_assessment;
            $Cft->Project_management_feedback = $request->Project_management_feedback;
            $Cft->Other1_assessment = $request->Other1_assessment;
            $Cft->Other1_feedback = $request->Other1_feedback;
            $Cft->Other2_Assessment = $request->Other2_Assessment;
            $Cft->Other2_feedback = $request->Other2_feedback;
            $Cft->Other3_Assessment = $request->Other3_Assessment;
            $Cft->Other3_feedback = $request->Other3_feedback;
            $Cft->Other4_Assessment = $request->Other4_Assessment;
            $Cft->Other4_feedback = $request->Other4_feedback;
            $Cft->Other5_Assessment = $request->Other5_Assessment;
            $Cft->Other5_feedback = $request->Other5_feedback;
            $Cft->CorporateQualityAssurance_assessment = $request->CorporateQualityAssurance_assessment;
            $Cft->CorporateQualityAssurance_feedback = $request->CorporateQualityAssurance_feedback;
            $Cft->Store_assessment = $request->Store_assessment;
            $Cft->Store_feedback = $request->Store_feedback;
            $Cft->RegulatoryAffair_assessment = $request->RegulatoryAffair_assessment;
            $Cft->RegulatoryAffair_feedback = $request->RegulatoryAffair_feedback;


            if (!empty($request->Production_Table_Attachment)) {
                $files = [];
                if ($request->hasfile('Production_Table_Attachment')) {
                    foreach ($request->file('Production_Table_Attachment') as $file) {
                        $name = $request->name . 'Production_Table_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->Production_Table_Attachment = json_encode($files);
            }
            if (!empty($request->Production_Injection_Attachment)) {
                $files = [];
                if ($request->hasfile('Production_Injection_Attachment')) {
                    foreach ($request->file('Production_Injection_Attachment') as $file) {
                        $name = $request->name . 'Production_Injection_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->Production_Injection_Attachment = json_encode($files);
            }
            if (!empty($request->Quality_Control_attachment)) {
                $files = [];
                if ($request->hasfile('Quality_Control_attachment')) {
                    foreach ($request->file('Quality_Control_attachment') as $file) {
                        $name = $request->name . 'Quality_Control_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->Quality_Control_attachment = json_encode($files);
            }
            if (!empty($request->Quality_Assurance_attachment)) {
                $files = [];
                if ($request->hasfile('Quality_Assurance_attachment')) {
                    foreach ($request->file('Quality_Assurance_attachment') as $file) {
                        $name = $request->name . 'Quality_Assurance_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $Cft->Quality_Assurance_attachment = json_encode($files);
            }
            if (!empty($request->Engineering_attachment)) {
                $files = [];
                if ($request->hasfile('Engineering_attachment')) {
                    foreach ($request->file('Engineering_attachment') as $file) {
                        $name = $request->name . 'Engineering_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $Cft->Engineering_attachment = json_encode($files);
            }
            if (!empty($request->Analytical_Development_attachment)) {
                $files = [];
                if ($request->hasfile('Analytical_Development_attachment')) {
                    foreach ($request->file('Analytical_Development_attachment') as $file) {
                        $name = $request->name . 'Analytical_Development_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->Analytical_Development_attachment = json_encode($files);
            }
            if (!empty($request->Kilo_Lab_attachment)) {
                $files = [];
                if ($request->hasfile('Kilo_Lab_attachment')) {
                    foreach ($request->file('Kilo_Lab_attachment') as $file) {
                        $name = $request->name . 'Kilo_Lab_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->Kilo_Lab_attachment = json_encode($files);
            }
            if (!empty($request->Technology_transfer_attachment)) {
                $files = [];
                if ($request->hasfile('Technology_transfer_attachment')) {
                    foreach ($request->file('Technology_transfer_attachment') as $file) {
                        $name = $request->name . 'Technology_transfer_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->Technology_transfer_attachment = json_encode($files);
            }
            if (!empty($request->Environment_Health_Safety_attachment)) {
                $files = [];
                if ($request->hasfile('Environment_Health_Safety_attachment')) {
                    foreach ($request->file('Environment_Health_Safety_attachment') as $file) {
                        $name = $request->name . 'Environment_Health_Safety_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->Environment_Health_Safety_attachment = json_encode($files);
            }
            if (!empty($request->Human_Resource_attachment)) {
                $files = [];
                if ($request->hasfile('Human_Resource_attachment')) {
                    foreach ($request->file('Human_Resource_attachment') as $file) {
                        $name = $request->name . 'Human_Resource_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->Human_Resource_attachment = json_encode($files);
            }
            if (!empty($request->Information_Technology_attachment)) {
                $files = [];
                if ($request->hasfile('Information_Technology_attachment')) {
                    foreach ($request->file('Information_Technology_attachment') as $file) {
                        $name = $request->name . 'Information_Technology_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->Information_Technology_attachment = json_encode($files);
            }
            if (!empty($request->Project_management_attachment)) {
                $files = [];
                if ($request->hasfile('Project_management_attachment')) {
                    foreach ($request->file('Project_management_attachment') as $file) {
                        $name = $request->name . 'Project_management_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->Project_management_attachment = json_encode($files);
            }

            if (!empty($request->CorporateQualityAssurance_attachment)) {
                $files = [];
                if ($request->hasfile('CorporateQualityAssurance_attachment')) {
                    foreach ($request->file('CorporateQualityAssurance_attachment') as $file) {
                        $name = $request->name . 'CorporateQualityAssurance_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->CorporateQualityAssurance_attachment = json_encode($files);
            }

            if (!empty($request->ProductionLiquid_attachment)) {
                $files = [];
                if ($request->hasfile('ProductionLiquid_attachment')) {
                    foreach ($request->file('ProductionLiquid_attachment') as $file) {
                        $name = $request->name . 'ProductionLiquid_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->ProductionLiquid_attachment = json_encode($files);
            }

            if (!empty($request->Microbiology_attachment)) {
                $files = [];
                if ($request->hasfile('Microbiology_attachment')) {
                    foreach ($request->file('Microbiology_attachment') as $file) {
                        $name = $request->name . 'Microbiology_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->Microbiology_attachment = json_encode($files);
            }

            if (!empty($request->ContractGiver_attachment)) {
                $files = [];
                if ($request->hasfile('ContractGiver_attachment')) {
                    foreach ($request->file('ContractGiver_attachment') as $file) {
                        $name = $request->name . 'ContractGiver_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->ContractGiver_attachment = json_encode($files);
            }

            if (!empty($request->Store_attachment)) {
                $files = [];
                if ($request->hasfile('Store_attachment')) {
                    foreach ($request->file('Store_attachment') as $file) {
                        $name = $request->name . 'Store_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->Store_attachment = json_encode($files);
            }

            if (!empty($request->ResearchDevelopment_attachment)) {
                $files = [];
                if ($request->hasfile('ResearchDevelopment_attachment')) {
                    foreach ($request->file('ResearchDevelopment_attachment') as $file) {
                        $name = $request->name . 'ResearchDevelopment_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->ResearchDevelopment_attachment = json_encode($files);
            }

            if (!empty($request->RegulatoryAffair_attachment)) {
                $files = [];
                if ($request->hasfile('RegulatoryAffair_attachment')) {
                    foreach ($request->file('RegulatoryAffair_attachment') as $file) {
                        $name = $request->name . 'RegulatoryAffair_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->RegulatoryAffair_attachment = json_encode($files);
            }
            if (!empty($request->Other1_attachment)) {
                $files = [];
                if ($request->hasfile('Other1_attachment')) {
                    foreach ($request->file('Other1_attachment') as $file) {
                        $name = $request->name . 'Other1_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }


                $Cft->Other1_attachment = json_encode($files);
            }
            if (!empty($request->Other2_attachment)) {
                $files = [];
                if ($request->hasfile('Other2_attachment')) {
                    foreach ($request->file('Other2_attachment') as $file) {
                        $name = $request->name . 'Other2_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->Other2_attachment = json_encode($files);
            }
            if (!empty($request->Other3_attachment)) {
                $files = [];
                if ($request->hasfile('Other3_attachment')) {
                    foreach ($request->file('Other3_attachment') as $file) {
                        $name = $request->name . 'Other3_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $Cft->Other3_attachment = json_encode($files);
            }
            if (!empty($request->Other4_attachment)) {
                $files = [];
                if ($request->hasfile('Other4_attachment')) {
                    foreach ($request->file('Other4_attachment') as $file) {
                        $name = $request->name . 'Other4_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $Cft->Other4_attachment = json_encode($files);
            }
            if (!empty($request->Other5_attachment)) {
                $files = [];
                if ($request->hasfile('Other5_attachment')) {
                    foreach ($request->file('Other5_attachment') as $file) {
                        $name = $request->name . 'Other5_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }


                $Cft->Other5_attachment = json_encode($files);
            }

            $Cft->save();

            $IsCFTRequired = RiskAssesmentCftResponce::withoutTrashed()->where(['is_required' => 1, 'risk_id' => $id])->latest()->first();
            $cftUsers = DB::table('risk_managment_cfts')->where(['risk_id' => $id])->first();
            // Define the column names
            $columns = ['Production_person', 'Production_Table_Person', 'Production_Injection_Person', 'ResearchDevelopment_person', 'Human_Resource_person', 'CorporateQualityAssurance_person', 'Store_person', 'Quality_Control_Person', 'QualityAssurance_person', 'RegulatoryAffair_person', 'ProductionLiquid_person', 'Microbiology_person', 'Engineering_person', 'Environment_Health_Safety_person', 'Analytical_Development_person', 'Other1_person', 'Other2_person', 'Other3_person', 'Other4_person', 'Other5_person', 'Kilo_Lab_person', 'Technology_transfer_person', 'Information_Technology_person', 'Project_management_person'];

            // $columns = ['Production_person', 'Production_Table_Person', 'Production_Injection_Person', 'Warehouse_notification', 'Quality_Control_Person', 'QualityAssurance_person', 'Engineering_person', 'Analytical_Development_person', 'Kilo_Lab_person', 'Technology_transfer_person', 'Environment_Health_Safety_person', 'Other1_person', 'Other2_person', 'Other3_person', 'Other4_person', 'Other5_person', 'Human_Resource_person', 'Information_Technology_person', 'Project_management_person'];

            // Initialize an array to store the values
            $valuesArray = [];

            foreach ($columns as $index => $column) {
                $value = $cftUsers->$column;
                // Check if the value is not null and not equal to 0
                if ($value != null && $value != 0) {
                    $valuesArray[] = $value;
                }
            }
            // Remove duplicates from the array
            $valuesArray = array_unique($valuesArray);

            // Convert the array to a re-indexed array
            $valuesArray = array_values($valuesArray);

            foreach ($valuesArray as $u) {
                $email = Helpers::getInitiatorEmail($u);
                if ($email !== null) {
                    try {
                        Mail::send(
                            'mail.view-mail',
                            ['data' => $data],
                            function ($message) use ($email) {
                                $message->to($email)
                                    ->subject("CFT Assgineed by " . Auth::user()->name);
                            }
                        );
                    } catch (\Exception $e) {
                        //log error
                    }
                }
            }
            if (!empty($request->Initial_attachment)) {
                $files = [];

                if ($data->Initial_attachment) {
                    $files = is_array(json_decode($data->Initial_attachment)) ? $data->Initial_attachment : [];
                }

                if ($request->hasfile('Initial_attachment')) {
                    foreach ($request->file('Initial_attachment') as $file) {
                        $name = $request->name . 'Initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $data->Initial_attachment = json_encode($files);
            }
        }




        // $data->form_progress = isset($form_progress) ? $form_progress : null;
        // dd($data->form_progress);

        $data->update();

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
        $data2 = RiskAssesmentGrid::where('risk_id', $data->id)->where('type', 'fishbone')->first();

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
        $data3 = RiskAssesmentGrid::where('risk_id', $data->id)->where('type', 'why_chart')->first();
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
        $data4 = RiskAssesmentGrid::where('risk_id', $data->id)->where('type', 'what_who_where')->first();

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
        }
        if (!empty($request->when_will_be)) {
            $data4->when_will_be = $request->when_will_be;
        }
        if (!empty($request->when_will_not_be)) {
            $data4->when_will_not_be = $request->when_will_not_be;
        }
        if (!empty($request->when_rationable)) {
            $data4->when_rationable = $request->when_rationable;
        }
        $data4->save();

        $data5 = RiskAssesmentGrid::where('risk_id', $data->id)->where('type', 'Action_Plan')->first();
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
        $data6 = RiskAssesmentGrid::where('risk_id', $data->id)->where('type', 'Mitigation_Plan_Details')->first();
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


        if ($lastDocument->Initiator_Group != $data->Initiator_Group) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Initiator Department';
            $history->previous = Helpers::getFullDepartmentName($lastDocument->Initiator_Group);
            $history->current = Helpers::getFullDepartmentName($data->Initiator_Group);
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Initiator_Group) || $lastDocument->Initiator_Group === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            //  dd($history);
            $history->save();
        }


        if ($lastDocument->initiator_group_code != $data->initiator_group_code) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Initiator Department Code';
            $history->previous = $lastDocument->initiator_group_code;
            $history->current = $data->initiator_group_code;
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
            //  dd($history);
            $history->save();
        }

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


        if ($lastDocument->other_source_of_risk != $data->other_source_of_risk || !empty ($request->other_source_of_risk)) {
            $lastDocumentAuditTrail = RiskAuditTrail::where('risk_id', $data->id)
                            ->where('activity_type', 'Other(Source of Risk/Opportunity)')
                            ->exists();
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other(Source of Risk/Opportunity)';
             $history->previous = $lastDocument->other_source_of_risk;
            $history->current = $data->other_source_of_risk;
            $history->comment = $request->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }

        // if ($lastDocument->other_source_of_risk != $data->other_source_of_risk) {

        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Other(Source of Risk/Opportunity)';
        //     $history->previous = $lastDocument->other_source_of_risk;
        //     $history->current = $data->other_source_of_risk;
        //     $history->comment = $request->other_source_of_risk_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->other_source_of_risk) || $lastDocument->other_source_of_risk === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        if ($lastDocument->type != $data->type || !empty ($request->type)) {
            $lastDocumentAuditTrail = RiskAuditTrail::where('risk_id', $data->id)
                            ->where('activity_type', 'Type')
                            ->exists();
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Type';
             $history->previous = $lastDocument->type;
            $history->current = $data->type;
            $history->comment = $request->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }


        // if ($lastDocument->other_type != $data->other_type) {
        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $data->id;
        //     $history->activity_type = 'Other(Type)';
        //     $history->previous = $lastDocument->other_type;
        //     $history->current = $data->other_type;
        //     $history->comment = $request->comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->other_type) || $lastDocument->other_type === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     //  dd($history);
        //     $history->save();
        // }


        if ($lastDocument->other_type != $data->other_type || !empty ($request->other_type)) {
            $lastDocumentAuditTrail = RiskAuditTrail::where('risk_id', $data->id)
                            ->where('activity_type', 'Other(Type)')
                            ->exists();
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other(Type)';
             $history->previous = $lastDocument->other_type;
            $history->current = $data->other_type;
            $history->comment = $request->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
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
            $history->activity_type = 'Brief Description/Procedure';
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

        if ($lastDocument->risk_attachment != $data->risk_attachment) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Initial Attachment';
            $history->previous = $lastDocument->risk_attachment;
            $history->current = $data->risk_attachment;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->risk_attachment) || $lastDocument->risk_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            //  dd($history);
            $history->save();
        }

        if ($lastDocument->root_cause_methodology != $data->root_cause_methodology) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Root Cause Methodology';
            $history->previous = $lastDocument->root_cause_methodology;
            $history->current = $data->root_cause_methodology;
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
            //  dd($history);
            $history->save();
        }

        if ($lastDocument->other_root_cause_methodology != $data->other_root_cause_methodology) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Other (Root Cause Methodology)';
            $history->previous = $lastDocument->other_root_cause_methodology;
            $history->current = $data->other_root_cause_methodology;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->other_root_cause_methodology) || $lastDocument->other_root_cause_methodology === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            //  dd($history);
            $history->save();
        }


        if ($lastDocument->investigation_summary != $data->investigation_summary) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Risk Assessment Summary';
            $history->previous = $lastDocument->investigation_summary;
            $history->current = $data->investigation_summary;
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
            //  dd($history);
            $history->save();
        }



        if ($lastDocument->r_a_conclussion != $data->r_a_conclussion) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'Risk Assessment Conclusion';
            $history->previous = $lastDocument->r_a_conclussion;
            $history->current = $data->r_a_conclussion;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->r_a_conclussion) || $lastDocument->r_a_conclussion === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            //  dd($history);
            $history->save();
        }

        // if ($lastDocument->severity_rate != $data->severity_rate || !empty($request->severity_rate_comment)) {

        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Severity Rate';
        //     $history->previous = $lastDocument->severity_rate;
        //     $history->current = $data->severity_rate;
        //     $history->comment = $request->severity_rate_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->severity_rate) || $lastDocument->severity_rate === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        // if ($lastDocument->occurrence != $data->occurrence || !empty($request->occurrence_comment)) {

        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Occurrence';
        //     $history->previous = $lastDocument->occurrence;
        //     $history->current = $data->occurrence;
        //     $history->comment = $request->occurrence_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->occurrence) || $lastDocument->occurrence === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }


        // if ($lastDocument->detection != $data->detection || !empty($request->detection_comment)) {

        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Detection';
        //     $history->previous = $lastDocument->detection;
        //     $history->current = $data->detection;
        //     $history->comment = $request->detection_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->detection) || $lastDocument->detection === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        // if ($lastDocument->rpn != $data->rpn || !empty($request->rpn_comment)) {

        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Rpn';
        //     $history->previous = $lastDocument->rpn;
        //     $history->current = $data->rpn;
        //     $history->comment = $request->rpn_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->rpn) || $lastDocument->rpn === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }



        if ($lastDocument->risk_ana_attach != $data->risk_ana_attach || !empty($request->risk_ana_attach)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Attachments';

            // Convert arrays to JSON strings if necessary
            $history->previous = is_array($lastDocument->risk_ana_attach) ? json_encode($lastDocument->risk_ana_attach) : $lastDocument->risk_ana_attach;
            $history->current = is_array($data->risk_ana_attach) ? json_encode($data->risk_ana_attach) : $data->risk_ana_attach;
            $history->comment = is_array($request->risk_ana_attach) ? json_encode($request->risk_ana_attach) : $request->risk_ana_attach;

            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->risk_ana_attach) || $lastDocument->risk_ana_attach === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        if ($lastDocument->reviewer_person_value != $data->reviewer_person_value) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'CFT Reviewer Selection';
            $history->previous = Helpers::getInitiatorName($data->reviewer_person_value);
            $history->current =  Helpers::getInitiatorName($data->reviewer_person_value);
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->reviewer_person_value) || $lastDocument->reviewer_person_value === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            //  dd($history);
            $history->save();
        }


        // if ($lastDocument->hod_des_rev_comm != $data->hod_des_rev_comm || !empty($request->hod_des_rev_comm)) {

        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $id;
        //     $history->activity_type = 'HOD/Designee Review Comment';
        //     $history->previous = $lastDocument->hod_des_rev_comm;
        //     $history->current = $data->hod_des_rev_comm;
        //     $history->comment = $request->hod_des_rev_comm;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->hod_des_rev_comm) || $lastDocument->hod_des_rev_comm === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        if ($lastDocument->hod_des_rev_comm != $data->hod_des_rev_comm) {
            $history = new RiskAuditTrail();
            $history->risk_id = $data->id;
            $history->activity_type = 'HOD Designee Review Comment';
            $history->previous = $lastDocument->hod_des_rev_comm;
            $history->current = $data->hod_des_rev_comm;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->hod_des_rev_comm) || $lastDocument->hod_des_rev_comm === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            //  dd($history);
            $history->save();
        }


        if ($lastDocument->hod_design_attach != $data->hod_design_attach || !empty($request->hod_design_attach)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Hod/Designee Attachments';

            // Convert arrays to strings if necessary
            $previousAttachment = is_array($lastDocument->hod_design_attach) ? implode(', ', $lastDocument->hod_design_attach) : $lastDocument->hod_design_attach;
            $currentAttachment = is_array($data->hod_design_attach) ? implode(', ', $data->hod_design_attach) : $data->hod_design_attach;
            $commentAttachment = is_array($request->hod_design_attach) ? implode(', ', $request->hod_design_attach) : $request->hod_design_attach;

            $history->previous = $previousAttachment;
            $history->current = $currentAttachment;
            $history->comment = $commentAttachment;

            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->hod_design_attach) || $lastDocument->hod_design_attach === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }



        /*************** Production Tablet ***************/

        if ($lastCft->Production_Table_Review != $request->Production_Table_Review && $request->Production_Table_Review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Tablet Required ?';
            $history->previous = $lastCft->Production_Table_Review;
            $history->current = $request->Production_Table_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Production_Table_Review) || $lastCft->Production_Table_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_Person != $request->Production_Table_Person && $request->Production_Table_Person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Tablet Person';
            $history->previous = $lastCft->Production_Table_Person;
            $history->current = $request->Production_Table_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Production_Table_Person) || $lastCft->Production_Table_Person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_Assessment != $request->Production_Table_Assessment && $request->Production_Table_Assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Tablet Assessment';
            $history->previous = $lastCft->Production_Table_Assessment;
            $history->current = $request->Production_Table_Assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Production_Table_Assessment) || $lastCft->Production_Table_Assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_Feedback != $request->Production_Table_Feedback && $request->Production_Table_Feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Tablet Feeback';
            $history->previous = $lastCft->Production_Table_Feedback;
            $history->current = $request->Production_Table_Feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Production_Table_Feedback) || $lastCft->Production_Table_Feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Production_Table_Attachment != $request->Production_Table_Attachment && $request->Production_Table_Attachment != null) {
        //     $history = new RiskAuditTrail;
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Production Table Attachment';
        //     $history->previous = $lastCft->Production_Table_Attachment;
        //     $history->current = implode(',',$request->Production_Table_Attachment);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->Production_Table_Attachment) || $lastCft->Production_Table_Attachment === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Production_Table_Attachment != $data->Production_Table_Attachment || !empty($request->Production_Table_Attachment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Production Table Attachment';

            // Convert arrays to JSON strings if necessary
            $history->previous = is_array($lastCft->Production_Table_Attachment) ? json_encode($lastCft->Production_Table_Attachment) : $lastCft->Production_Table_Attachment;
            $history->current = is_array($data->Production_Table_Attachment) ? json_encode($data->Production_Table_Attachment) : $data->Production_Table_Attachment;
            $history->comment = is_array($request->Production_Table_Attachment) ? json_encode($request->Production_Table_Attachment) : $request->Production_Table_Attachment;

            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastCft->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastCft->status;

            if (is_null($lastCft->Production_Table_Attachment) || $lastCft->Production_Table_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastCft->Production_Table_By != $request->Production_Table_By && $request->Production_Table_By != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Tablet Review By';
            $history->previous = $lastCft->Production_Table_Review;
            $history->current = $request->Production_Table_By;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Production_Table_By) || $lastCft->Production_Table_By === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_On != $request->Production_Table_On && $request->Production_Table_On != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Tablet On';
            $history->previous = $lastCft->Production_Table_On;
            $history->current = $request->Production_Table_On;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Production_Table_On) || $lastCft->Production_Table_On === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

         /*************** Production Liquid ***************/
         if ($lastCft->ProductionLiquid_Review != $request->ProductionLiquid_Review && $request->ProductionLiquid_Review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Liquid Review Required';
            $history->previous = $lastCft->ProductionLiquid_Review;
            $history->current = $request->ProductionLiquid_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ProductionLiquid_Review) || $lastCft->ProductionLiquid_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_person != $request->ProductionLiquid_person && $request->ProductionLiquid_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Liquid Person';
            $history->previous = $lastCft->ProductionLiquid_person;
            $history->current = $request->ProductionLiquid_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ProductionLiquid_person) || $lastCft->ProductionLiquid_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_assessment != $request->ProductionLiquid_assessment && $request->ProductionLiquid_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Liquid Assessment';
            $history->previous = $lastCft->ProductionLiquid_assessment;
            $history->current = $request->ProductionLiquid_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ProductionLiquid_assessment) || $lastCft->ProductionLiquid_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_feedback != $request->ProductionLiquid_feedback && $request->ProductionLiquid_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Liquid Feedback';
            $history->previous = $lastCft->ProductionLiquid_feedback;
            $history->current = $request->ProductionLiquid_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ProductionLiquid_feedback) || $lastCft->ProductionLiquid_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->ProductionLiquid_attachment != $request->ProductionLiquid_attachment && $request->ProductionLiquid_attachment != null) {
        //     $history = new RiskAuditTrail;
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Production Liquid Feedback';
        //     $history->previous = $lastCft->ProductionLiquid_attachment;
        //     $history->current = implode(',',$request->ProductionLiquid_attachment);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->ProductionLiquid_attachment) || $lastCft->ProductionLiquid_attachment === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        if ($lastCft->ProductionLiquid_attachment != $data->ProductionLiquid_attachment || !empty($request->ProductionLiquid_attachment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Production Liquid Attachment';

            // Convert arrays to JSON strings if necessary
            $history->previous = is_array($lastCft->ProductionLiquid_attachment) ? json_encode($lastCft->ProductionLiquid_attachment) : $lastCft->ProductionLiquid_attachment;
            $history->current = is_array($data->ProductionLiquid_attachment) ? json_encode($data->ProductionLiquid_attachment) : $data->ProductionLiquid_attachment;
            $history->comment = is_array($request->ProductionLiquid_attachment) ? json_encode($request->ProductionLiquid_attachment) : $request->ProductionLiquid_attachment;

            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastCft->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastCft->status;

            if (is_null($lastCft->ProductionLiquid_attachment) || $lastCft->ProductionLiquid_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastCft->ProductionLiquid_by != $request->ProductionLiquid_by && $request->ProductionLiquid_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Liquid Review By';
            $history->previous = $lastCft->ProductionLiquid_by;
            $history->current = $request->ProductionLiquid_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ProductionLiquid_by) || $lastCft->ProductionLiquid_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_on != $request->ProductionLiquid_on && $request->ProductionLiquid_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Liquid Review On';
            $history->previous = $lastCft->ProductionLiquid_on;
            $history->current = $request->ProductionLiquid_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ProductionLiquid_on) || $lastCft->ProductionLiquid_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Production Injection ***************/
        if ($lastCft->Production_Injection_Review != $request->Production_Injection_Review && $request->Production_Injection_Review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Injection Required';
            $history->previous = $lastCft->Production_Injection_Review;
            $history->current = $request->Production_Injection_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Production_Injection_Review) || $lastCft->Production_Injection_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_Person != $request->Production_Injection_Person && $request->Production_Injection_Person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Injection Person';
            $history->previous = $lastCft->Production_Injection_Person;
            $history->current = $request->Production_Injection_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Production_Injection_Person) || $lastCft->Production_Injection_Person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_Assessment != $request->Production_Injection_Assessment && $request->Production_Injection_Assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Injection Assessment';
            $history->previous = $lastCft->Production_Injection_Assessment;
            $history->current = $request->Production_Injection_Assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Production_Injection_Assessment) || $lastCft->Production_Injection_Assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_Feedback != $request->Production_Injection_Feedback && $request->Production_Injection_Feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Injection Feedback';
            $history->previous = $lastCft->Production_Injection_Feedback;
            $history->current = $request->Production_Injection_Feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Production_Injection_Feedback) || $lastCft->Production_Injection_Feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Production_Injection_Attachment != $request->Production_Injection_Attachment && $request->Production_Injection_Attachment != null) {
        //     $history = new RiskAuditTrail;
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Production Injection Attachment';
        //     $history->previous = $lastCft->Production_Injection_Attachment;
        //     $history->current =implode(',', $request->Production_Injection_Attachment);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->Production_Injection_Attachment) || $lastCft->Production_Injection_Attachment === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        if ($lastCft->Production_Injection_Attachment != $data->Production_Injection_Attachment || !empty($request->Production_Injection_Attachment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Production Injection Attachment';

            // Convert arrays to JSON strings if necessary
            $history->previous = is_array($lastCft->Production_Injection_Attachment) ? json_encode($lastCft->Production_Injection_Attachment) : $lastCft->Production_Injection_Attachment;
            $history->current = is_array($data->Production_Injection_Attachment) ? json_encode($data->Production_Injection_Attachment) : $data->Production_Injection_Attachment;
            $history->comment = is_array($request->Production_Injection_Attachment) ? json_encode($request->Production_Injection_Attachment) : $request->Production_Injection_Attachment;

            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastCft->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastCft->status;

            if (is_null($lastCft->Production_Injection_Attachment) || $lastCft->Production_Injection_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastCft->Production_Injection_By != $request->Production_Injection_By && $request->Production_Injection_By != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Injection Review By';
            $history->previous = $lastCft->Production_Injection_By;
            $history->current = $request->Production_Injection_By;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Production_Injection_By) || $lastCft->Production_Injection_By === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_On != $request->Production_Injection_On && $request->Production_Injection_On != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Production Injection On';
            $history->previous = $lastCft->Production_Injection_On;
            $history->current = $request->Production_Injection_On;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Production_Injection_On) || $lastCft->Production_Injection_On === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Stores ***************/
        if ($lastCft->Store_Review != $request->Store_Review && $request->Store_Review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Store Review Required';
            $history->previous = $lastCft->Store_Review;
            $history->current = $request->Store_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Store_Review) || $lastCft->Store_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_person != $request->Store_person && $request->Store_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Store Person';
            $history->previous = $lastCft->Store_person;
            $history->current = $request->Store_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Store_person) || $lastCft->Store_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_assessment != $request->Store_assessment && $request->Store_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Store Assessment';
            $history->previous = $lastCft->Store_assessment;
            $history->current = $request->Store_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Store_assessment) || $lastCft->Store_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_feedback != $request->Store_feedback && $request->Store_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Store Feedback';
            $history->previous = $lastCft->Store_feedback;
            $history->current = $request->Store_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Store_feedback) || $lastCft->Store_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
         if ($lastCft->Store_attachment != $request->Store_attachment && $request->Store_attachment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Store Review On';
            $history->previous = $lastCft->Store_attachment;
            $history->current =implode(',', $request->Store_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Store_attachment) || $lastCft->Store_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_by != $request->Store_by && $request->Store_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Store Review By';
            $history->previous = $lastCft->Store_by;
            $history->current = $request->Store_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Store_by) || $lastCft->Store_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_on != $request->Store_on && $request->Store_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Store Review On';
            $history->previous = $lastCft->Store_on;
            $history->current = $request->Store_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Store_on) || $lastCft->Store_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Quality Control ***************/
        if ($lastCft->Quality_review != $request->Quality_review && $request->Quality_review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Quality Control Required';
            $history->previous = $lastCft->Quality_review;
            $history->current = $request->Quality_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Quality_review) || $lastCft->Quality_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Quality_Control_Person != $request->Quality_Control_Person && $request->Quality_Control_Person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Quality Control Person';
            $history->previous = $lastCft->Quality_Control_Person;
            $history->current = $request->Quality_Control_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Quality_Control_Person) || $lastCft->Quality_Control_Person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Quality_Control_assessment != $request->Quality_Control_assessment && $request->Quality_Control_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Quality Control Assessment';
            $history->previous = $lastCft->Quality_Control_assessment;
            $history->current = $request->Quality_Control_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Quality_Control_assessment) || $lastCft->Quality_Control_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Quality_Control_feedback != $request->Quality_Control_feedback && $request->Quality_Control_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Quality Control Feeback';
            $history->previous = $lastCft->Quality_Control_feedback;
            $history->current = $request->Quality_Control_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Quality_Control_feedback) || $lastCft->Quality_Control_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Quality_Control_attachment != $request->Quality_Control_attachment && $request->Quality_Control_attachment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Quality Control On';
            $history->previous = $lastCft->Quality_Control_attachment;
            $history->current =implode(',', $request->Quality_Control_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Quality_Control_attachment) || $lastCft->Quality_Control_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Research & Development ***************/
        if ($lastCft->ResearchDevelopment_Review != $request->ResearchDevelopment_Review && $request->ResearchDevelopment_Review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Research & Development Required';
            $history->previous = $lastCft->ResearchDevelopment_Review;
            $history->current = $request->ResearchDevelopment_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ResearchDevelopment_Review) || $lastCft->ResearchDevelopment_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_person != $request->ResearchDevelopment_person && $request->ResearchDevelopment_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Research & Development Person';
            $history->previous = $lastCft->ResearchDevelopment_person;
            $history->current = $request->ResearchDevelopment_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ResearchDevelopment_person) || $lastCft->ResearchDevelopment_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_assessment != $request->ResearchDevelopment_assessment && $request->ResearchDevelopment_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Research & Development Assessment';
            $history->previous = $lastCft->ResearchDevelopment_assessment;
            $history->current = $request->ResearchDevelopment_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ResearchDevelopment_assessment) || $lastCft->ResearchDevelopment_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_feedback != $request->ResearchDevelopment_feedback && $request->ResearchDevelopment_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Research & Development Feedback';
            $history->previous = $lastCft->ResearchDevelopment_feedback;
            $history->current = $request->ResearchDevelopment_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ResearchDevelopment_feedback) || $lastCft->ResearchDevelopment_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_by != $request->ResearchDevelopment_by && $request->ResearchDevelopment_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Research & Development By';
            $history->previous = $lastCft->ResearchDevelopment_by;
            $history->current = $request->ResearchDevelopment_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ResearchDevelopment_by) || $lastCft->ResearchDevelopment_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_on != $request->ResearchDevelopment_on && $request->ResearchDevelopment_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Research & Development Completed By';
            $history->previous = $lastCft->ResearchDevelopment_on;
            $history->current = $request->ResearchDevelopment_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ResearchDevelopment_on) || $lastCft->ResearchDevelopment_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->ResearchDevelopment_attachment != $request->ResearchDevelopment_attachment && $request->ResearchDevelopment_attachment != null) {
        //     $history = new RiskAuditTrail;
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Research & Development Attachment';
        //     $history->previous = $lastCft->ResearchDevelopment_attachment;
        //     $history->current =implode(',', $request->ResearchDevelopment_attachment);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->ResearchDevelopment_attachment) || $lastCft->ResearchDevelopment_attachment === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

         if ($lastCft->ResearchDevelopment_attachment != $data->ResearchDevelopment_attachment || !empty($request->ResearchDevelopment_attachment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Production Injection Attachment';

            // Convert arrays to JSON strings if necessary
            $history->previous = is_array($lastCft->ResearchDevelopment_attachment) ? json_encode($lastCft->ResearchDevelopment_attachment) : $lastCft->ResearchDevelopment_attachment;
            $history->current = is_array($data->ResearchDevelopment_attachment) ? json_encode($data->ResearchDevelopment_attachment) : $data->ResearchDevelopment_attachment;
            $history->comment = is_array($request->ResearchDevelopment_attachment) ? json_encode($request->ResearchDevelopment_attachment) : $request->ResearchDevelopment_attachment;

            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastCft->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastCft->status;

            if (is_null($lastCft->ResearchDevelopment_attachment) || $lastCft->ResearchDevelopment_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        /*************** Engineering ***************/
        if ($lastCft->Engineering_review != $request->Engineering_review && $request->Engineering_review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Engineering Review Required';
            $history->previous = $lastCft->Engineering_review;
            $history->current = $request->Engineering_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Engineering_review) || $lastCft->Engineering_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_person != $request->Engineering_person && $request->Engineering_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Engineering Person';
            $history->previous = $lastCft->Engineering_person;
            $history->current = $request->Engineering_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Engineering_person) || $lastCft->Engineering_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_assessment != $request->Engineering_assessment && $request->Engineering_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Engineering Assessment';
            $history->previous = $lastCft->Engineering_assessment;
            $history->current = $request->Engineering_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Engineering_assessment) || $lastCft->Engineering_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_feedback != $request->Engineering_feedback && $request->Engineering_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Engineering Feedback';
            $history->previous = $lastCft->Engineering_feedback;
            $history->current = $request->Engineering_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Engineering_feedback) || $lastCft->Engineering_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_by != $request->Engineering_by && $request->Engineering_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Engineering Review By';
            $history->previous = $lastCft->Engineering_by;
            $history->current = $request->Engineering_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Engineering_by) || $lastCft->Engineering_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_on != $request->Engineering_on && $request->Engineering_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Engineering Review On';
            $history->previous = $lastCft->Engineering_on;
            $history->current = $request->Engineering_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Engineering_on) || $lastCft->Engineering_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Engineering_attachment != $request->Engineering_attachment && $request->Engineering_attachment != null) {
        //     $history = new RiskAuditTrail;
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Engineering Review On';
        //     $history->previous = $lastCft->Engineering_attachment;
        //     $history->current = implode(',',$request->Engineering_attachment);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->Engineering_attachment) || $lastCft->Engineering_attachment === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        if ($lastCft->Engineering_attachment != $data->Engineering_attachment || !empty($request->Engineering_attachment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Engineering Attachment';

            // Convert arrays to JSON strings if necessary
            $history->previous = is_array($lastCft->Engineering_attachment) ? json_encode($lastCft->Engineering_attachment) : $lastCft->Engineering_attachment;
            $history->current = is_array($data->Engineering_attachment) ? json_encode($data->Engineering_attachment) : $data->Engineering_attachment;
            $history->comment = is_array($request->Engineering_attachment) ? json_encode($request->Engineering_attachment) : $request->Engineering_attachment;

            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastCft->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastCft->status;

            if (is_null($lastCft->Engineering_attachment) || $lastCft->Engineering_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        /*************** Human Resource ***************/
        if ($lastCft->Human_Resource_review != $request->Human_Resource_review && $request->Human_Resource_review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Human Resource Review Required';
            $history->previous = $lastCft->Human_Resource_review;
            $history->current = $request->Human_Resource_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Human_Resource_review) || $lastCft->Human_Resource_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_person != $request->Human_Resource_person && $request->Human_Resource_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Human Resource Person';
            $history->previous = $lastCft->Human_Resource_person;
            $history->current = $request->Human_Resource_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Human_Resource_person) || $lastCft->Human_Resource_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_assessment != $request->Human_Resource_assessment && $request->Human_Resource_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Human Resource Assessment';
            $history->previous = $lastCft->Human_Resource_assessment;
            $history->current = $request->Human_Resource_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Human_Resource_assessment) || $lastCft->Human_Resource_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_feedback != $request->Human_Resource_feedback && $request->Human_Resource_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Human Resource Feedback';
            $history->previous = $lastCft->Human_Resource_feedback;
            $history->current = $request->Human_Resource_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Human_Resource_feedback) || $lastCft->Human_Resource_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_by != $request->Human_Resource_by && $request->Human_Resource_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Human Resource Review By';
            $history->previous = $lastCft->Human_Resource_by;
            $history->current = $request->Human_Resource_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Human_Resource_by) || $lastCft->Human_Resource_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_on != $request->Human_Resource_on && $request->Human_Resource_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Human Resource Review On';
            $history->previous = $lastCft->Human_Resource_on;
            $history->current = $request->Human_Resource_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Human_Resource_on) || $lastCft->Human_Resource_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Human_Resource_attachment != $request->Human_Resource_attachment && $request->Human_Resource_attachment != null) {
        //     $history = new RiskAuditTrail;
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Human Resource Review On';
        //     $history->previous = $lastCft->Human_Resource_attachment;
        //     $history->current =implode(',', $request->Human_Resource_attachment);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->Human_Resource_attachment) || $lastCft->Human_Resource_attachment === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        if ($lastCft->Human_Resource_attachment != $data->Human_Resource_attachment || !empty($request->Human_Resource_attachment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Engineering Attachment';

            // Convert arrays to JSON strings if necessary
            $history->previous = is_array($lastCft->Human_Resource_attachment) ? json_encode($lastCft->Human_Resource_attachment) : $lastCft->Human_Resource_attachment;
            $history->current = is_array($data->Human_Resource_attachment) ? json_encode($data->Human_Resource_attachment) : $data->Human_Resource_attachment;
            $history->comment = is_array($request->Human_Resource_attachment) ? json_encode($request->Human_Resource_attachment) : $request->Human_Resource_attachment;

            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastCft->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastCft->status;

            if (is_null($lastCft->Human_Resource_attachment) || $lastCft->Human_Resource_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        /*************** Microbiology ***************/
        if ($lastCft->Microbiology_Review != $request->Microbiology_Review && $request->Microbiology_Review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Microbiology Review Required';
            $history->previous = $lastCft->Microbiology_Review;
            $history->current = $request->Microbiology_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Microbiology_Review) || $lastCft->Microbiology_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_person != $request->Microbiology_person && $request->Microbiology_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Microbiology Person';
            $history->previous = $lastCft->Microbiology_person;
            $history->current = $request->Microbiology_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Microbiology_person) || $lastCft->Microbiology_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_assessment != $request->Microbiology_assessment && $request->Microbiology_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Microbiology Assessment';
            $history->previous = $lastCft->Microbiology_assessment;
            $history->current = $request->Microbiology_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Microbiology_assessment) || $lastCft->Microbiology_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_feedback != $request->Microbiology_feedback && $request->Microbiology_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Microbiology Feedback';
            $history->previous = $lastCft->Microbiology_feedback;
            $history->current = $request->Microbiology_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Microbiology_feedback) || $lastCft->Microbiology_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_by != $request->Microbiology_by && $request->Microbiology_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Microbiology Review By';
            $history->previous = $lastCft->Microbiology_by;
            $history->current = $request->Microbiology_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Microbiology_by) || $lastCft->Microbiology_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_on != $request->Microbiology_on && $request->Microbiology_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Microbiology Review On';
            $history->previous = $lastCft->Microbiology_on;
            $history->current = $request->Microbiology_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Microbiology_on) || $lastCft->Microbiology_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        //  if ($lastCft->Microbiology_attachment != $request->Microbiology_attachment && $request->Microbiology_attachment != null) {
        //     $history = new RiskAuditTrail;
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Microbiology Review On';
        //     $history->previous = $lastCft->Microbiology_attachment;
        //     $history->current = implode(',',$request->Microbiology_attachment);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->Microbiology_attachment) || $lastCft->Microbiology_attachment === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        if ($lastCft->Human_Resource_attachment != $data->Human_Resource_attachment || !empty($request->Human_Resource_attachment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Human Resource Attachment';

            // Convert arrays to JSON strings if necessary
            $history->previous = is_array($lastCft->Human_Resource_attachment) ? json_encode($lastCft->Human_Resource_attachment) : $lastCft->Human_Resource_attachment;
            $history->current = is_array($data->Human_Resource_attachment) ? json_encode($data->Human_Resource_attachment) : $data->Human_Resource_attachment;
            $history->comment = is_array($request->Human_Resource_attachment) ? json_encode($request->Human_Resource_attachment) : $request->Human_Resource_attachment;

            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastCft->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastCft->status;

            if (is_null($lastCft->Human_Resource_attachment) || $lastCft->Human_Resource_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        /*************** Regulatory Affair ***************/
        if ($lastCft->RegulatoryAffair_Review != $request->RegulatoryAffair_Review && $request->RegulatoryAffair_Review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Regulatory Affair Review Required';
            $history->previous = $lastCft->RegulatoryAffair_Review;
            $history->current = $request->RegulatoryAffair_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->RegulatoryAffair_Review) || $lastCft->RegulatoryAffair_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_person != $request->RegulatoryAffair_person && $request->RegulatoryAffair_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Regulatory Affair Person';
            $history->previous = $lastCft->RegulatoryAffair_person;
            $history->current = $request->RegulatoryAffair_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->RegulatoryAffair_person) || $lastCft->RegulatoryAffair_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_assessment != $request->RegulatoryAffair_assessment && $request->RegulatoryAffair_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Regulatory Affair Assessment';
            $history->previous = $lastCft->RegulatoryAffair_assessment;
            $history->current = $request->RegulatoryAffair_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->RegulatoryAffair_assessment) || $lastCft->RegulatoryAffair_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_feedback != $request->RegulatoryAffair_feedback && $request->RegulatoryAffair_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Regulatory Affair Feedback';
            $history->previous = $lastCft->RegulatoryAffair_feedback;
            $history->current = $request->RegulatoryAffair_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->RegulatoryAffair_feedback) || $lastCft->RegulatoryAffair_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_by != $request->RegulatoryAffair_by && $request->RegulatoryAffair_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Regulatory Affair Review By';
            $history->previous = $lastCft->RegulatoryAffair_by;
            $history->current = $request->RegulatoryAffair_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->RegulatoryAffair_by) || $lastCft->RegulatoryAffair_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_on != $request->RegulatoryAffair_on  && $request->RegulatoryAffair_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Regulatory Affair Review On';
            $history->previous = $lastCft->RegulatoryAffair_on;
            $history->current = $request->RegulatoryAffair_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->RegulatoryAffair_on) || $lastCft->RegulatoryAffair_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->RegulatoryAffair_attachment != $request->RegulatoryAffair_attachment  && $request->RegulatoryAffair_attachment != null) {
        //     $history = new RiskAuditTrail;
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Regulatory Affair Review On';
        //     $history->previous = $lastCft->RegulatoryAffair_attachment;
        //     $history->current =implode(',', $request->RegulatoryAffair_attachment);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->RegulatoryAffair_attachment) || $lastCft->RegulatoryAffair_attachment === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        if ($lastCft->RegulatoryAffair_attachment != $data->RegulatoryAffair_attachment || !empty($request->RegulatoryAffair_attachment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Regulatory Affair Attachment';

            // Convert arrays to JSON strings if necessary
            $history->previous = is_array($lastCft->RegulatoryAffair_attachment) ? json_encode($lastCft->RegulatoryAffair_attachment) : $lastCft->RegulatoryAffair_attachment;
            $history->current = is_array($data->RegulatoryAffair_attachment) ? json_encode($data->RegulatoryAffair_attachment) : $data->RegulatoryAffair_attachment;
            $history->comment = is_array($request->RegulatoryAffair_attachment) ? json_encode($request->RegulatoryAffair_attachment) : $request->RegulatoryAffair_attachment;

            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastCft->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastCft->status;

            if (is_null($lastCft->RegulatoryAffair_attachment) || $lastCft->RegulatoryAffair_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        /*************** Corporate Quality Assurance ***************/
        if ($lastCft->CorporateQualityAssurance_Review != $request->CorporateQualityAssurance_Review && $request->CorporateQualityAssurance_Review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Review Required';
            $history->previous = $lastCft->CorporateQualityAssurance_Review;
            $history->current = $request->CorporateQualityAssurance_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->CorporateQualityAssurance_Review) || $lastCft->CorporateQualityAssurance_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_person != $request->CorporateQualityAssurance_person && $request->CorporateQualityAssurance_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Person';
            $history->previous = $lastCft->CorporateQualityAssurance_person;
            $history->current = $request->CorporateQualityAssurance_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->CorporateQualityAssurance_person) || $lastCft->CorporateQualityAssurance_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_assessment != $request->CorporateQualityAssurance_assessment && $request->CorporateQualityAssurance_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Assessment';
            $history->previous = $lastCft->CorporateQualityAssurance_assessment;
            $history->current = $request->CorporateQualityAssurance_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->CorporateQualityAssurance_assessment) || $lastCft->CorporateQualityAssurance_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_feedback != $request->CorporateQualityAssurance_feedback && $request->CorporateQualityAssurance_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Feedback';
            $history->previous = $lastCft->CorporateQualityAssurance_feedback;
            $history->current = $request->CorporateQualityAssurance_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->CorporateQualityAssurance_feedback) || $lastCft->CorporateQualityAssurance_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        if ($lastCft->CorporateQualityAssurance_by != $request->CorporateQualityAssurance_by && $request->CorporateQualityAssurance_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Corporate Quality Assurance by';
            $history->previous = $lastCft->CorporateQualityAssurance_by;
            $history->current = $request->CorporateQualityAssurance_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->CorporateQualityAssurance_by) || $lastCft->CorporateQualityAssurance_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_on != $request->CorporateQualityAssurance_on && $request->CorporateQualityAssurance_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Corporate Quality Assurance On';
            $history->previous = $lastCft->CorporateQualityAssurance_on;
            $history->current = $request->CorporateQualityAssurance_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->CorporateQualityAssurance_on) || $lastCft->Human_Resource_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }



        if ($lastCft->CorporateQualityAssurance_attachment != $request->CorporateQualityAssurance_attachment && $request->CorporateQualityAssurance_attachment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Attachment';
            $history->previous = $lastCft->CorporateQualityAssurance_attachment;
            $history->current =implode(',', $request->CorporateQualityAssurance_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->CorporateQualityAssurance_attachment) || $lastCft->CorporateQualityAssurance_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Safety ***************/
        if ($lastCft->Environment_Health_review != $request->Environment_Health_review && $request->Environment_Health_review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Safety Review Required';
            $history->previous = $lastCft->Environment_Health_review;
            $history->current = $request->Environment_Health_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Environment_Health_review) || $lastCft->Environment_Health_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Environment_Health_Safety_person != $request->Environment_Health_Safety_person && $request->Environment_Health_Safety_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Safety Person';
            $history->previous = $lastCft->Environment_Health_Safety_person;
            $history->current = $request->Environment_Health_Safety_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Environment_Health_Safety_person) || $lastCft->Environment_Health_Safety_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Health_Safety_assessment != $request->Health_Safety_assessment && $request->Health_Safety_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Safety Assessment';
            $history->previous = $lastCft->Health_Safety_assessment;
            $history->current = $request->Health_Safety_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Health_Safety_assessment) || $lastCft->Health_Safety_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Health_Safety_feedback != $request->Health_Safety_feedback && $request->Health_Safety_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Safety Feedback';
            $history->previous = $lastCft->Health_Safety_feedback;
            $history->current = $request->Health_Safety_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Health_Safety_feedback) || $lastCft->Health_Safety_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Environment_Health_Safety_by != $request->Environment_Health_Safety_by && $request->Environment_Health_Safety_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Safety Review By';
            $history->previous = $lastCft->Environment_Health_Safety_by;
            $history->current = $request->Environment_Health_Safety_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Environment_Health_Safety_by) || $lastCft->Environment_Health_Safety_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Environment_Health_Safety_on != $request->Environment_Health_Safety_on && $request->Environment_Health_Safety_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Safety Review On';
            $history->previous = $lastCft->Environment_Health_Safety_on;
            $history->current = $request->Environment_Health_Safety_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Environment_Health_Safety_on) || $lastCft->Environment_Health_Safety_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Environment_Health_Safety_attachment != $request->Environment_Health_Safety_attachment && $request->Environment_Health_Safety_attachment != null) {
        //     $history = new RiskAuditTrail;
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Safety Review On';
        //     $history->previous = $lastCft->Environment_Health_Safety_attachment;
        //     $history->current =implode(',', $request->Environment_Health_Safety_attachment);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->Environment_Health_Safety_attachment) || $lastCft->Environment_Health_Safety_attachment === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        if ($lastCft->Environment_Health_Safety_attachment != $data->Environment_Health_Safety_attachment || !empty($request->Environment_Health_Safety_attachment)) {

            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'Environment Health Safety Attachment';

            // Convert arrays to JSON strings if necessary
            $history->previous = is_array($lastCft->Environment_Health_Safety_attachment) ? json_encode($lastCft->Environment_Health_Safety_attachment) : $lastCft->Environment_Health_Safety_attachment;
            $history->current = is_array($data->Environment_Health_Safety_attachment) ? json_encode($data->Environment_Health_Safety_attachment) : $data->Environment_Health_Safety_attachment;
            $history->comment = is_array($request->Environment_Health_Safety_attachment) ? json_encode($request->Environment_Health_Safety_attachment) : $request->Environment_Health_Safety_attachment;

            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastCft->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastCft->status;

            if (is_null($lastCft->Environment_Health_Safety_attachment) || $lastCft->Environment_Health_Safety_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        /*************** Contract Giver ***************/
        if ($lastCft->ContractGiver_Review != $request->ContractGiver_Review && $request->ContractGiver_Review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Contract Giver Review Required';
            $history->previous = $lastCft->ContractGiver_Review;
            $history->current = $request->ContractGiver_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ContractGiver_Review) || $lastCft->ContractGiver_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ContractGiver_person != $request->ContractGiver_person && $request->ContractGiver_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Contract Giver Person';
            $history->previous = $lastCft->ContractGiver_person;
            $history->current = $request->ContractGiver_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ContractGiver_person) || $lastCft->ContractGiver_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ContractGiver_assessment != $request->ContractGiver_assessment && $request->ContractGiver_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Contract Giver Assessment';
            $history->previous = $lastCft->ContractGiver_assessment;
            $history->current = $request->ContractGiver_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ContractGiver_assessment) || $lastCft->ContractGiver_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ContractGiver_feedback != $request->ContractGiver_feedback && $request->ContractGiver_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Contract Giver Feedback';
            $history->previous = $lastCft->ContractGiver_feedback;
            $history->current = $request->ContractGiver_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ContractGiver_feedback) || $lastCft->ContractGiver_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ContractGiver_by != $request->ContractGiver_by && $request->ContractGiver_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Contract Giver Review By';
            $history->previous = $lastCft->ContractGiver_by;
            $history->current = $request->ContractGiver_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ContractGiver_by) || $lastCft->ContractGiver_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ContractGiver_on != $request->ContractGiver_on && $request->ContractGiver_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Contract Giver Review On';
            $history->previous = $lastCft->ContractGiver_on;
            $history->current = $request->ContractGiver_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ContractGiver_on) || $lastCft->ContractGiver_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastCft->ContractGiver_attachment != $request->ContractGiver_attachment && $request->ContractGiver_attachment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Contract Giver Review On';
            $history->previous = $lastCft->ContractGiver_attachment;
            $history->current = implode(',',$request->ContractGiver_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ContractGiver_attachment) || $lastCft->ContractGiver_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        /*************** Other 1 ***************/
        if ($lastCft->Other1_review != $request->Other1_review && $request->Other1_review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 1 Review Required';
            $history->previous = $lastCft->Other1_review;
            $history->current = $request->Other1_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other1_review) || $lastCft->Other1_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_person != $request->Other1_person && $request->Other1_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 1 Person';
            $history->previous = $lastCft->Other1_person;
            $history->current = $request->Other1_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other1_person) || $lastCft->Other1_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_Department_person != $request->Other1_Department_person && $request->Other1_Department_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 1 Review Required';
            $history->previous = $lastCft->Other1_Department_person;
            $history->current = $request->Other1_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other1_Department_person) || $lastCft->Other1_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_assessment != $request->Other1_assessment && $request->Other1_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 1 Assessment';
            $history->previous = $lastCft->Other1_assessment;
            $history->current = $request->Other1_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other1_assessment) || $lastCft->Other1_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_feedback != $request->Other1_feedback && $request->Other1_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 1 Feedback';
            $history->previous = $lastCft->Other1_feedback;
            $history->current = $request->Other1_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other1_feedback) || $lastCft->Other1_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_by != $request->Other1_by && $request->Other1_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 1 Review By';
            $history->previous = $lastCft->Other1_by;
            $history->current = $request->Other1_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other1_by) || $lastCft->Other1_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_on != $request->Other1_on && $request->Other1_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 1 Review On';
            $history->previous = $lastCft->Other1_on;
            $history->current = $request->Other1_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other1_on) || $lastCft->Other1_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastCft->Other1_attachment != $request->Other1_attachment && $request->Other1_attachment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 1 Attachment';
            $history->previous = $lastCft->Other1_attachment;
            $history->current = implode(',',$request->Other1_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other1_attachment) || $lastCft->Other1_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }



        /*************** Other 2 ***************/
        if ($lastCft->Other2_review != $request->Other2_review && $request->Other2_review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 2 Review Required';
            $history->previous = $lastCft->Other2_review;
            $history->current = $request->Other2_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other2_review) || $lastCft->Other2_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_person != $request->Other2_person && $request->Other2_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 2 Person';
            $history->previous = $lastCft->Other2_person;
            $history->current = $request->Other2_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other2_person) || $lastCft->Other2_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_Department_person != $request->Other2_Department_person && $request->Other2_Department_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 2 Review Required';
            $history->previous = $lastCft->Other2_Department_person;
            $history->current = $request->Other2_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other2_Department_person) || $lastCft->Other2_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_assessment != $request->Other2_assessment && $request->Other2_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 2 Assessment';
            $history->previous = $lastCft->Other2_assessment;
            $history->current = $request->Other2_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other2_assessment) || $lastCft->Other2_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_feedback != $request->Other2_feedback && $request->Other2_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 2 Feedback';
            $history->previous = $lastCft->Other2_feedback;
            $history->current = $request->Other2_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other2_feedback) || $lastCft->Other2_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_by != $request->Other2_by && $request->Other2_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 2 Review By';
            $history->previous = $lastCft->Other2_by;
            $history->current = $request->Other2_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other2_by) || $lastCft->Other2_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_on != $request->Other2_on && $request->Other2_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 2 Review On';
            $history->previous = $lastCft->Other2_on;
            $history->current = $request->Other2_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other2_on) || $lastCft->Other2_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_attachment != $request->Other2_attachment && $request->Other2_attachment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 2 Attachment';
            $history->previous = $lastCft->Other2_attachment;
            $history->current =implode(',', $request->Other2_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other2_attachment) || $lastCft->Other2_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        /*************** Other 3 ***************/
        if ($lastCft->Other3_review != $request->Other3_review && $request->Other3_review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 3 Review Required';
            $history->previous = $lastCft->Other3_review;
            $history->current = $request->Other3_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other3_review) || $lastCft->Other3_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_person != $request->Other3_person && $request->Other3_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 3 Person';
            $history->previous = $lastCft->Other3_person;
            $history->current = $request->Other3_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other3_person) || $lastCft->Other3_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_Department_person != $request->Other3_Department_person && $request->Other3_Department_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 3 Review Required';
            $history->previous = $lastCft->Other3_Department_person;
            $history->current = $request->Other3_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other3_Department_person) || $lastCft->Other3_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_assessment != $request->Other3_assessment && $request->Other3_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 3 Assessment';
            $history->previous = $lastCft->Other3_assessment;
            $history->current = $request->Other3_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other3_assessment) || $lastCft->Other3_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_feedback != $request->Other3_feedback && $request->Other3_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 3 Feedback';
            $history->previous = $lastCft->Other3_feedback;
            $history->current = $request->Other3_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other3_feedback) || $lastCft->Other3_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_by != $request->Other3_by && $request->Other3_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 3 Review By';
            $history->previous = $lastCft->Other3_by;
            $history->current = $request->Other3_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other3_by) || $lastCft->Other3_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_on != $request->Other3_on && $request->Other3_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 3 Review On';
            $history->previous = $lastCft->Other3_on;
            $history->current = $request->Other3_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other3_on) || $lastCft->Other3_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_attachment != $request->Other3_attachment && $request->Other3_attachment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 3 Attachment';
            $history->previous = $lastCft->Other3_attachment;
            $history->current =implode(',', $request->Other3_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other3_attachment) || $lastCft->Other3_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }



        /*************** Other 4 ***************/
        if ($lastCft->Other4_review != $request->Other4_review && $request->Other4_review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 4 Review Required';
            $history->previous = $lastCft->Other4_review;
            $history->current = $request->Other4_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other4_review) || $lastCft->Other4_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_person != $request->Other4_person && $request->Other4_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 4 Person';
            $history->previous = $lastCft->Other4_person;
            $history->current = $request->Other4_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other4_person) || $lastCft->Other4_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_Department_person != $request->Other4_Department_person && $request->Other4_Department_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 4 Review Required';
            $history->previous = $lastCft->Other4_Department_person;
            $history->current = $request->Other4_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other4_Department_person) || $lastCft->Other4_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_assessment != $request->Other4_assessment && $request->Other4_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 4 Assessment';
            $history->previous = $lastCft->Other4_assessment;
            $history->current = $request->Other4_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other4_assessment) || $lastCft->Other4_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_feedback != $request->Other4_feedback && $request->Other4_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 4 Feedback';
            $history->previous = $lastCft->Other4_feedback;
            $history->current = $request->Other4_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other4_feedback) || $lastCft->Other4_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_by != $request->Other4_by && $request->Other4_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 4 Review By';
            $history->previous = $lastCft->Other4_by;
            $history->current = $request->Other4_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other4_by) || $lastCft->Other4_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_on != $request->Other4_on && $request->Other4_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 4 Review On';
            $history->previous = $lastCft->Other4_on;
            $history->current = $request->Other4_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other4_on) || $lastCft->Other4_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_attachment != $request->Other4_attachment && $request->Other4_attachment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 4  Attachment';
            $history->previous = $lastCft->Other4_attachment;
            $history->current =implode(',', $request->Other4_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other4_attachment) || $lastCft->Other4_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }



        /*************** Other 5 ***************/
        if ($lastCft->Other5_review != $request->Other5_review && $request->Other5_review != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 5 Review Required';
            $history->previous = $lastCft->Other5_review;
            $history->current = $request->Other5_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other5_review) || $lastCft->Other5_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_person != $request->Other5_person && $request->Other5_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 5 Person';
            $history->previous = $lastCft->Other5_person;
            $history->current = $request->Other5_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other5_person) || $lastCft->Other5_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_Department_person != $request->Other5_Department_person && $request->Other5_Department_person != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 5 Review Required';
            $history->previous = $lastCft->Other5_Department_person;
            $history->current = $request->Other5_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other5_Department_person) || $lastCft->Other5_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_assessment != $request->Other5_assessment && $request->Other5_assessment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 5 Assessment';
            $history->previous = $lastCft->Other5_assessment;
            $history->current = $request->Other5_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other5_assessment) || $lastCft->Other5_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_feedback != $request->Other5_feedback && $request->Other5_feedback != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 5 Feedback';
            $history->previous = $lastCft->Other5_feedback;
            $history->current = $request->Other5_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other5_feedback) || $lastCft->Other5_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_by != $request->Other5_by && $request->Other5_by != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 5 Review By';
            $history->previous = $lastCft->Other5_by;
            $history->current = $request->Other5_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other5_by) || $lastCft->Other5_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_on != $request->Other5_on && $request->Other5_on != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 5 Review On';
            $history->previous = $lastCft->Other5_on;
            $history->current = $request->Other5_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other5_on) || $lastCft->Other5_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_attachment != $request->Other5_attachment && $request->Other5_attachment != null) {
            $history = new RiskAuditTrail;
            $history->risk_id = $id;
            $history->activity_type = 'Other 5 Attachment';
            $history->previous = $lastCft->Other5_attachment;
            $history->current = implode(',',$request->Other5_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other5_attachment) || $lastCft->Other5_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }



        if ($lastDocument->qa_cqa_comments != $data->qa_cqa_comments || !empty($request->qa_cqa_comments)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'QA/CQA Review Comment';
            $history->previous = $lastDocument->qa_cqa_comments;
            $history->current = $data->qa_cqa_comments;
            $history->comment = $request->qa_cqa_comments;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->qa_cqa_comments) || $lastDocument->qa_cqa_comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if (
            (is_array($lastDocument->qa_cqa_attachments) ? json_encode($lastDocument->qa_cqa_attachments) : $lastDocument->qa_cqa_attachments)
            != (is_array($data->qa_cqa_attachments) ? json_encode($data->qa_cqa_attachments) : $data->qa_cqa_attachments)
            || !empty($request->qa_cqa_attachments)
        ) {
            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'QA/CQA Review Attachments';

            // Convert arrays to JSON strings if necessary
            $history->previous = is_array($lastDocument->qa_cqa_attachments) ? json_encode($lastDocument->qa_cqa_attachments) : $lastDocument->qa_cqa_attachments;
            $history->current = is_array($data->qa_cqa_attachments) ? json_encode($data->qa_cqa_attachments) : $data->qa_cqa_attachments;
            $history->comment = is_array($request->qa_cqa_attachments) ? json_encode($request->qa_cqa_attachments) : $request->qa_cqa_attachments;

            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->qa_cqa_attachments) || $lastDocument->qa_cqa_attachments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        if ($lastDocument->qa_cqa_head_comm != $data->qa_cqa_head_comm || !empty($request->qa_cqa_head_comm)) {
            $history = new RiskAuditTrail();
            $history->risk_id = $id;
            $history->activity_type = 'QA/CQA Head Approval Comment';
            $history->previous = $lastDocument->qa_cqa_head_comm;
            $history->current = $data->qa_cqa_head_comm;
            $history->comment = $request->qa_cqa_head_comm;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->qa_cqa_head_comm) || $lastDocument->qa_cqa_head_comm === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ((is_array($lastDocument->qa_cqa_head_attach) ? json_encode($lastDocument->qa_cqa_head_attach) : $lastDocument->qa_cqa_head_attach)
                != (is_array($data->qa_cqa_head_attach) ? json_encode($data->qa_cqa_head_attach) : $data->qa_cqa_head_attach)
                || !empty($request->qa_cqa_head_attach)) {

                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                $history->activity_type = 'QA/CQA Head Attachment';

                // Convert arrays to strings if necessary
                $history->previous = is_array($lastDocument->qa_cqa_head_attach) ? json_encode($lastDocument->qa_cqa_head_attach) : $lastDocument->qa_cqa_head_attach;
                $history->current = is_array($data->qa_cqa_head_attach) ? json_encode($data->qa_cqa_head_attach) : $data->qa_cqa_head_attach;
                $history->comment = is_array($request->qa_cqa_head_attach) ? json_encode($request->qa_cqa_head_attach) : $request->qa_cqa_head_attach;

                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Not Applicable";
                $history->change_from = $lastDocument->status;

                $history->action_name = is_null($lastDocument->qa_cqa_head_attach) || $lastDocument->qa_cqa_head_attach === '' ? "New" : "Update";

                $history->save();
            }



        // if ($lastDocument->open_date != $data->open_date || !empty($request->open_date_comment)) {

        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Open Date';
        //     $history->previous = $lastDocument->open_date;
        //     $history->current = $data->open_date;
        //     $history->comment = $request->open_date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->open_date) || $lastDocument->open_date === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        // if ($lastDocument->severity2_level != $data->severity2_level || !empty($request->comment)) {

        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Severity Level';
        //     $history->previous = $lastDocument->severity2_level;
        //     $history->current = $data['severity2_level'];
        //     $history->comment = $request->comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->severity2_level) || $lastDocument->severity2_level === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

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

        // if ($lastDocument->description != $data->description || !empty($request->description_comment)) {

        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Risk/Opportunity Description';
        //     $history->previous = $lastDocument->description;
        //     $history->current = $data->description;
        //     $history->comment = $request->description_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->description) || $lastDocument->description === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        // if ($lastDocument->comments != $data->comments || !empty($request->comments_comment)) {

        //     $history = new RiskAuditTrail();
        //     $history->risk_id = $id;
        //     $history->activity_type = 'Risk/Opportunity Comments';
        //     $history->previous = $lastDocument->comments;
        //     $history->current = $data->comments;
        //     $history->comment = $request->comments_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->comments) || $lastDocument->comments === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }
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
        $userData = User::all();
        $data1 = RiskManagmentCft::where('risk_id', $id)->latest()->first();
        // return $data1->Production_Review;
        // dd($data1);
        $cft = User::get();
        $pre = CC::all();
        $cftReviewerIds = explode(',', $data->reviewer_person_value);

        // $review = Qareview::where('risk_id', $id)->first();
        $old_record = RiskManagement::select('id', 'division_id', 'record')->get();
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_to)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $riskEffectAnalysis = RiskAssesmentGrid::where('risk_id', $id)->where('type', "effect_analysis")->first();
        $fishbone = RiskAssesmentGrid::where('risk_id', $id)->where('type', "fishbone")->first();
        $whyChart = RiskAssesmentGrid::where('risk_id', $id)->where('type', "why_chart")->first();
        $what_who_where = RiskAssesmentGrid::where('risk_id', $id)->where('type', "what_who_where")->first();
        $action_plan = RiskAssesmentGrid::where('risk_id', $id)->where('type', "Action_Plan")->first();
        $mitigation_plan_details = RiskAssesmentGrid::where('risk_id', $id)->where('type', "Mitigation_Plan_Details")->first();

        return view('frontend.riskAssesment.view', compact('data', 'riskEffectAnalysis', 'cftReviewerIds', 'cft', 'pre', 'fishbone', 'whyChart', 'what_who_where', 'old_record', 'data1', 'userData', 'action_plan', 'mitigation_plan_details'));
    }


    public function riskAssesmentStateChange(Request $request, $id)
    {
        try {
            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $riskAssement = RiskManagement::find($id);
                $updateCFT = RiskManagmentCft::where('risk_id', $id)->latest()->first();
                $lastDocument = RiskManagement::find($id);
                $cftDetails = RiskAssesmentCftResponce::withoutTrashed()->where(['status' => 'In-progress', 'risk_id' => $id])->distinct('cft_user_id')->count();
                $Cft = RiskManagmentCft::withoutTrashed()->where('risk_id', $id)->first();

                if ($riskAssement->stage == 1) {

                    $riskAssement->stage = "2";
                    $riskAssement->status = "HOD Review";
                    $riskAssement->submitted_by = Auth::user()->name;
                    $riskAssement->submitted_on = Carbon::now()->format('d-M-Y');
                    $riskAssement->submit_comment = $request->comment;

                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'Submit By, Submit On';

                    if (is_null($lastDocument->Submit_by) || $lastDocument->Submit_on == '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->submitted_by . ' , ' . $lastDocument->submitted_on;
                    }
                    $history->previous = "";
                    $history->action = 'Submit';
                    $history->current = $riskAssement->submitted_by. ',' . $riskAssement->submitted_on;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "HOD Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    if(is_null($lastDocument->submitted_by) || $lastDocument->submitted_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();

                    //  $list = Helpers::getInitiatorUserList($riskAssement->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $riskAssement->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $riskAssement, 'site'=>"RA", 'history' => "Submit", 'process' => 'Risk Assessment', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $riskAssement) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Risk Assesment, Record #" . str_pad($riskAssement->record, 4, '0', STR_PAD_LEFT) . " - Activity: Submit Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }


                    $riskAssement->update();
                    return back();
                }
                if ($riskAssement->stage == 2) {
                        //  dd($riskAssement->form_progress !== 'cft');

                    //   if ($riskAssement->form_progress !== 'cft')
                    // {
                    //     Session::flash('swal', [
                    //         'type' => 'warning',
                    //         'title' => 'Mandatory Fields!',
                    //         'message' => 'HOD/Designee Review Comment!/CFT Mandatory Tab is yet to be filled!'
                    //     ]);

                    //     return redirect()->back();
                    // } else {
                    //     Session::flash('swal', [
                    //         'type' => 'success',
                    //         'title' => 'Success',
                    //         'message' => 'Sent for CFT review state'
                    //     ]);
                    // }

                    // Check HOD remark value
                    if (!$riskAssement->hod_des_rev_comm) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'HOD/Designee Mandatory Tab is yet to be filled!',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for CFT Review state'
                        ]);
                    }

                    if (!$Cft->Production_Table_Review || !$Cft->Production_Injection_Review || !$Cft->ProductionLiquid_Review || !$Cft->Store_Review || !$Cft->ResearchDevelopment_Review || !$Cft->Microbiology_Review || !$Cft->RegulatoryAffair_Review || !$Cft->CorporateQualityAssurance_Review  || !$Cft->Quality_review || !$Cft->Quality_Assurance_Review || !$Cft->Engineering_review || !$Cft->Environment_Health_review || !$Cft->Human_Resource_review) {
                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'CFT Review Tab is yet to be filled!',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'CFT Reviews'
                        ]);
                    }

                    $riskAssement->stage = "3";
                    $riskAssement->status = "CFT Review";
                    $riskAssement->evaluated_by = Auth::user()->name;
                    $riskAssement->evaluated_on = Carbon::now()->format('d-M-Y');
                    $riskAssement->cft_comments = $request->comment;
                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'HOD Review Complete by, HOD Review Complete On';

                    if (is_null($lastDocument->evaluated_by) || $lastDocument->evaluated_on == '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->evaluated_by. ' , ' .$lastDocument->evaluated_on;
                    }
                    $history->previous = "";
                    $history->current = $riskAssement->evaluated_by. ',' .$riskAssement->evaluated_on;
                    $history->comment = $request->comment;
                    $history->action = 'HOD Review Complete';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "CFT Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Approved';
                    if(is_null($lastDocument->evaluated_by) || $lastDocument->evaluated_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }

                    $history->save();

                    // $list = Helpers::getInitiatorUserList($riskAssement->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $riskAssement->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $riskAssement, 'site'=>"RA", 'history' => "HOD Review Complete", 'process' => 'Risk Assessment', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $riskAssement) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Risk Assesment, Record #" . str_pad($riskAssement->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Review Complete Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    // dd($history->action);
                    // $list = Helpers::getQAUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $riskAssement->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $riskAssement],
                    //                     function ($message) use ($email) {
                    //                         $message->to($email)
                    //                             ->subject("Activity Performed By " . Auth::user()->name);
                    //                     }
                    //                 );
                    //             } catch (\Exception $e) {
                    //                 //log error
                    //             }
                    //         }
                    //     }
                    // }


                    $riskAssement->update();
                    toastr()->success('Document Sent');
                    return back();
                }

                if ($riskAssement->stage == 3) {

                    // CFT review state update form_progress
                    // if ($riskAssement->form_progress !== 'cft')
                    // {
                    //     Session::flash('swal', [
                    //         'type' => 'warning',
                    //         'title' => 'Mandatory Fields!',
                    //         'message' => 'CFT Tab is yet to be filled'
                    //     ]);

                    //     return redirect()->back();
                    // } else {
                    //     Session::flash('swal', [
                    //         'type' => 'success',
                    //         'title' => 'Success',
                    //         'message' => 'Sent for In QA/CQA Review!'
                    //     ]);
                    // }


                    $IsCFTRequired = RiskAssesmentCftResponce::withoutTrashed()->where(['is_required' => 1, 'risk_id' => $id])->latest()->first();
                    $cftUsers = DB::table('risk_managment_cfts')->where(['risk_id' => $id])->first();
                    // Define the column names
                    $columns = ['Quality_Control_Person', 'QualityAssurance_person', 'Engineering_person', 'Environment_Health_Safety_person', 'Human_Resource_person', 'Information_Technology_person', 'Other1_person', 'Other2_person', 'Other3_person', 'Other4_person', 'Other5_person','RA_person', 'Production_Table_Person','ProductionLiquid_person','Production_Injection_Person','Store_person','ResearchDevelopment_person','Microbiology_person','RegulatoryAffair_person','CorporateQualityAssurance_person','ContractGiver_person'];
                    // $columns2 = ['Production_review', 'Warehouse_review', 'Quality_Control_review', 'QualityAssurance_review', 'Engineering_review', 'Analytical_Development_review', 'Kilo_Lab_review', 'Technology_transfer_review', 'Environment_Health_Safety_review', 'Human_Resource_review', 'Information_Technology_review', 'Project_management_review'];

                    // Initialize an array to store the values
                    $valuesArray = [];

                    // Iterate over the columns and retrieve the values
                    foreach ($columns as $index => $column) {
                        $value = $cftUsers->$column;
                       if ($index == 0 && $cftUsers->$column == Auth::user()->name) {
                            $updateCFT->Quality_Control_by = Auth::user()->name;
                            $updateCFT->Quality_Control_on = Carbon::now()->format('Y-m-d');

                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Quality Control Completed By, Quality Control Completed On';

                            if (is_null($lastDocument->Quality_Control_by) || $lastDocument->Quality_Control_on == '') {
                                $history->previous = "";
                            } else {
                                $history->previous = $lastDocument->Quality_Control_by . ' , ' . $lastDocument->Quality_Control_on;
                            }

                            $history->action = 'CFT Review Complete';

                            // Make sure you're using the updated $updateCFT object here
                            $history->current = $updateCFT->Quality_Control_by . ', ' . $updateCFT->Quality_Control_on;

                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to = "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';

                            if (is_null($lastDocument->Quality_Control_by) || $lastDocument->Quality_Control_on == '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }

                            $history->save();
                            }

                                            if ($index == 1 && $cftUsers->$column == Auth::user()->name) {
                            $updateCFT->QualityAssurance_by = Auth::user()->name;
                            $updateCFT->QualityAssurance_on = Carbon::now()->format('Y-m-d'); // Corrected line

                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Quality Assurance Completed By, Quality Assurance Completed On';

                            if (is_null($lastDocument->QualityAssurance_by) || $lastDocument->QualityAssurance_on == '') {
                                $history->previous = "";
                            } else {
                                $history->previous = $lastDocument->QualityAssurance_by . ' ,' .Helpers::getdateFormat ($lastDocument->QualityAssurance_on);
                            }

                            $history->action = 'CFT Review Complete';
                            $history->current = $updateCFT->QualityAssurance_by . ',' .Helpers::getdateFormat ($updateCFT->QualityAssurance_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id; // Use `id` instead of `name` for `user_id`
                            $history->user_name = Auth::user()->name;
                            $history->change_to = "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';

                            if (is_null($lastDocument->QualityAssurance_by) || $lastDocument->QualityAssurance_on == '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }

                            $history->save();
                            }

                        if($index == 2 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->Engineering_by = Auth::user()->name;
                            $updateCFT->Engineering_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Engineering Completed By, Engineering Completed On';
                    if(is_null($lastDocument->Engineering_by) || $lastDocument->Engineering_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Engineering_by. ' ,' .Helpers::getdateFormat ($lastDocument->Engineering_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->Engineering_by. ',' . Helpers::getdateFormat($updateCFT->Engineering_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->Engineering_by) || $lastDocument->Engineering_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 3 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->Environment_Health_Safety_by = Auth::user()->name;
                            $updateCFT->Environment_Health_Safety_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Safety Completed By, Safety Completed On';
                    if(is_null($lastDocument->Environment_Health_Safety_by) || $lastDocument->Environment_Health_Safety_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Environment_Health_Safety_by. ' ,' . Helpers::getdateFormat($lastDocument->Environment_Health_Safety_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->Environment_Health_Safety_by. ',' . Helpers::getdateFormat($updateCFT->Environment_Health_Safety_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->Environment_Health_Safety_by) || $lastDocument->Environment_Health_Safety_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 4 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->Human_Resource_by = Auth::user()->name;
                            $updateCFT->Human_Resource_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Human Resource Completed By, Human Resource Completed On';
                    if(is_null($lastDocument->Human_Resource_by) || $lastDocument->Human_Resource_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Human_Resource_by. ' ,' .Helpers::getdateFormat ($lastDocument->Human_Resource_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->Human_Resource_by. ',' . Helpers::getdateFormat($updateCFT->Human_Resource_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->Human_Resource_by) || $lastDocument->Human_Resource_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 5 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->Information_Technology_by = Auth::user()->name;
                            $updateCFT->Information_Technology_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'CFT Review Completed By, CFT Review Completed On';
                    if(is_null($lastDocument->Information_Technology_by) || $lastDocument->Information_Technology_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Information_Technology_by. ' ,' . Helpers::getdateFormat($lastDocument->Information_Technology_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->Information_Technology_by. ',' . Helpers::getdateFormat($updateCFT->Information_Technology_on);
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->Information_Technology_by) || $lastDocument->Information_Technology_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 6 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->Other1_by = Auth::user()->name;
                            $updateCFT->Other1_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Others 1 Completed By, Others 1 Completed On';
                    if(is_null($lastDocument->Other1_by) || $lastDocument->Other1_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Other1_by. ' ,' .Helpers::getdateFormat ($lastDocument->Other1_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->Other1_by. ',' . Helpers::getdateFormat($updateCFT->Other1_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->Other1_by) || $lastDocument->Other1_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 7 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->Other2_by = Auth::user()->name;
                            $updateCFT->Other2_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Others 2 Completed By, Others 2 Completed On';
                    if(is_null($lastDocument->Other2_by) || $lastDocument->Other2_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Other2_by. ' ,' . Helpers::getdateFormat($lastDocument->Other2_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->Other2_by. ',' .Helpers::getdateFormat($updateCFT->Other2_on);
                            $history->current = $updateCFT->Other2_by;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->Other2_by) || $lastDocument->Other2_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 8 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->Other3_by = Auth::user()->name;
                            $updateCFT->Other3_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Others 3 Completed By, Others 3 Completed On';
                    if(is_null($lastDocument->Other3_by) || $lastDocument->Other3_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Other3_by. ' ,' . Helpers::getdateFormat($lastDocument->Other3_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->Other3_by. ',' . Helpers::getdateFormat($updateCFT->Other3_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->Other3_by) || $lastDocument->Other3_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 9 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->Other4_by = Auth::user()->name;
                            $updateCFT->Other4_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Others 4 Completed By, Others 4 Completed On';
                    if(is_null($lastDocument->Other4_by) || $lastDocument->Other4_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Other4_by. ' ,' . Helpers::getdateFormat($lastDocument->Other4_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->Other4_by. ',' . Helpers::getdateFormat($updateCFT->Other4_on);
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->Other4_by) || $lastDocument->Other4_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 10 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->Other5_by = Auth::user()->name;
                            $updateCFT->Other5_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Others 5 Completed By, Others 5 Completed On';
                    if(is_null($lastDocument->Other5_by) || $lastDocument->Other5_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Other5_by. ' ,' . Helpers::getdateFormat($lastDocument->Other5_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->Other5_by. ',' . Helpers::getdateFormat($updateCFT->Other5_on);
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                           if(is_null($lastDocument->Other5_by) || $lastDocument->Other5_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 11 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->RA_by = Auth::user()->name;
                            $updateCFT->RA_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->previous = "";
                            $history->action= 'CFT Review';
                            $history->current = $updateCFT->RA_by;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            $history->action_name = "Update";
                            $history->save();
                        }
                        if($index == 12 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->Production_Table_By = Auth::user()->name;
                            $updateCFT->Production_Table_On = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                           $history->activity_type = 'Production Table Completed By, Production Table Completed On';
                    if(is_null($lastDocument->Production_Table_By) || $lastDocument->Production_Table_On == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Production_Table_By. ' ,' . Helpers::getdateFormat($lastDocument->Production_Table_On);
                    }
                   $history->action='CFT Review Complete';
                    $history->current = $updateCFT->Production_Table_By. ',' .Helpers::getdateFormat ($updateCFT->Production_Table_On);
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->Production_Table_By) || $lastDocument->Production_Table_On == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 13 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->ProductionLiquid_by = Auth::user()->name;
                            $updateCFT->ProductionLiquid_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Production Liquid Completed By, Production Liquid Completed On';
                    if(is_null($lastDocument->ProductionLiquid_by) || $lastDocument->ProductionLiquid_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->ProductionLiquid_by. ' ,' . Helpers::getdateFormat($lastDocument->ProductionLiquid_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->ProductionLiquid_by. ',' . Helpers::getdateFormat($updateCFT->ProductionLiquid_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->ProductionLiquid_by) || $lastDocument->ProductionLiquid_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 14 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->Production_Injection_By = Auth::user()->name;
                            $updateCFT->Production_Injection_On = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Production Injection Completed By, Production Injection Completed On';
                    if(is_null($lastDocument->Production_Injection_By) || $lastDocument->Production_Injection_On == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Production_Injection_By. ' ,' .Helpers::getdateFormat( $lastDocument->Production_Injection_On);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->Production_Injection_By. ',' . Helpers::getdateFormat($updateCFT->Production_Injection_On);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->Production_Injection_By) || $lastDocument->Production_Injection_On == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 15 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->Store_by = Auth::user()->name;
                            $updateCFT->Store_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                           $history->activity_type = 'Stores Completed By, Stores Completed On';
                    if(is_null($lastDocument->Store_by) || $lastDocument->Store_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Store_by. ' ,' .Helpers::getdateFormat( $lastDocument->Store_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->Store_by. ',' .Helpers::getdateFormat( $updateCFT->Store_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->Store_by) || $lastDocument->Store_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 16 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->ResearchDevelopment_by = Auth::user()->name;
                            $updateCFT->ResearchDevelopment_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Research & Development Completed By, Research & Development Completed On';
                    if(is_null($lastDocument->ResearchDevelopment_by) || $lastDocument->ResearchDevelopment_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->ResearchDevelopment_by. ' ,' . Helpers::getdateFormat($lastDocument->ResearchDevelopment_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->ResearchDevelopment_by. ',' . Helpers::getdateFormat($updateCFT->ResearchDevelopment_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->ResearchDevelopment_by) || $lastDocument->ResearchDevelopment_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 17 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->Microbiology_by = Auth::user()->name;
                            $updateCFT->Microbiology_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Microbiology Completed By, Microbiology Completed On';
                    if(is_null($lastDocument->Microbiology_by) || $lastDocument->Microbiology_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Microbiology_by. ' ,' . Helpers::getdateFormat($lastDocument->Microbiology_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->Microbiology_by. ',' . Helpers::getdateFormat($updateCFT->Microbiology_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->Microbiology_by) || $lastDocument->Microbiology_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 18 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->RegulatoryAffair_by = Auth::user()->name;
                            $updateCFT->RegulatoryAffair_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Regulatory Affair Completed By, Regulatory Affair Completed On';
                    if(is_null($lastDocument->RegulatoryAffair_by) || $lastDocument->RegulatoryAffair_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->RegulatoryAffair_by. ' ,' .Helpers::getdateFormat( $lastDocument->RegulatoryAffair_on);
                    }
                   $history->action='CFT Review Complete';
                    $history->current = $updateCFT->RegulatoryAffair_by. ',' . Helpers::getdateFormat($updateCFT->RegulatoryAffair_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->RegulatoryAffair_by) || $lastDocument->RegulatoryAffair_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }

                        if($index == 19 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->CorporateQualityAssurance_by = Auth::user()->name;
                            $updateCFT->CorporateQualityAssurance_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Corporate Quality Assurance Completed By, Corporate Quality Assurance Completed On';
                    if(is_null($lastDocument->CorporateQualityAssurance_by) || $lastDocument->CorporateQualityAssurance_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->CorporateQualityAssurance_by. ' ,' . Helpers::getdateFormat($lastDocument->CorporateQualityAssurance_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->CorporateQualityAssurance_by. ',' . Helpers::getdateFormat($updateCFT->CorporateQualityAssurance_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->CorporateQualityAssurance_by) || $lastDocument->CorporateQualityAssurance_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 20 && $cftUsers->$column == Auth::user()->name){
                            $updateCFT->ContractGiver_by = Auth::user()->name;
                            $updateCFT->ContractGiver_on = Carbon::now()->format('Y-m-d');
                            $history = new RiskAuditTrail();
                            $history->risk_id = $id;
                            $history->activity_type = 'Contract Giver Completed By, Contract Giver Completed On';
                    if(is_null($lastDocument->ContractGiver_by) || $lastDocument->ContractGiver_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->ContractGiver_by. ' ,' . Helpers::getdateFormat($lastDocument->ContractGiver_on);
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $updateCFT->ContractGiver_by. ',' . Helpers::getdateFormat($updateCFT->ContractGiver_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'CFT Review';
                            if(is_null($lastDocument->ContractGiver_by) || $lastDocument->ContractGiver_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        $updateCFT->update();


                        // Check if the value is not null and not equal to 0
                        if ($value != null && $value != 0) {
                            $valuesArray[] = $value;
                        }
                    }
                    if ($IsCFTRequired) {
                        if (count(array_unique($valuesArray)) == ($cftDetails + 1)) {
                            $stage = new RiskAssesmentCftResponce();
                            $stage->risk_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "Completed";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        } else {
                            $stage = new RiskAssesmentCftResponce();
                            $stage->risk_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "In-progress";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        }
                    }

                    $checkCFTCount = RiskAssesmentCftResponce::withoutTrashed()->where(['status' => 'Completed', 'risk_id' => $id])->count();
                    //  dd(count(array_unique($valuesArray)), $checkCFTCount);


                    if (!$IsCFTRequired || $checkCFTCount) {

                        $riskAssement->stage = "4";
                        $riskAssement->status = "In QA/CQA Review";
                        $riskAssement->CFT_Review_Complete_By = Auth::user()->name;
                        $riskAssement->CFT_Review_Complete_On = Carbon::now()->format('d-M-Y');
                        $riskAssement->CFT_Review_Comments = $request->comment;

                        $history = new RiskAuditTrail();
                        $history->risk_id = $id;
                        $history->activity_type = 'CFT Review Complete By, CFT Review Complete By';
                        if(is_null($lastDocument->CFT_Review_Complete_By) || $lastDocument->CFT_Review_Complete_On == ''){
                            $history->previous = "";
                        }else{
                            $history->previous = $lastDocument->CFT_Review_Complete_By	. ' ,' . $lastDocument->submCFT_Review_Complete_Onitted_on;
                        }
                        $history->action = 'CFT Review Complete';
                        $history->current = $riskAssement->CFT_Review_Complete_By. ',' . $riskAssement->CFT_Review_Complete_On;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "In QA/CQA Review";
                        $history->change_from = $lastDocument->status;
                        $history->stage = 'Complete';
                         if(is_null($lastDocument->CFT_Review_Complete_By) || $lastDocument->CFT_Review_Complete_On == '')
                            {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                        $history->save();

                    //  $list = Helpers::getInitiatorUserList($riskAssement->division_id);
                    //  foreach ($list as $u) {
                    //      // if($u->q_m_s_divisions_id == $riskAssement->division_id){
                    //          $email = Helpers::getUserEmail($u->user_id);
                    //              if ($email !== null) {
                    //              try {
                    //                  Mail::send(
                    //                      'mail.view-mail',
                    //                      ['data' => $riskAssement, 'site'=>"RA", 'history' => "CFT Review Complete", 'process' => 'Risk Assessment', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                      function ($message) use ($email, $riskAssement) {
                    //                          $message->to($email)
                    //                          ->subject("Agio Notification: Risk Assesment, Record #" . str_pad($riskAssement->record, 4, '0', STR_PAD_LEFT) . " - Activity: CFT Review Complete Performed");
                    //                      }
                    //                  );
                    //              } catch(\Exception $e) {
                    //                  info('Error sending mail', [$e]);
                    //              }
                    //          }
                    //      // }
                    //  }
                        // $list = Helpers::getQAUserList();
                        // foreach ($list as $u) {
                        //     if ($u->q_m_s_divisions_id == $riskAssement->division_id) {
                        //         $email = Helpers::getInitiatorEmail($u->user_id);
                        //         if ($email !== null) {
                        //             try {
                        //                 Mail::send(
                        //                     'mail.view-mail',
                        //                     ['data' => $riskAssement],
                        //                     function ($message) use ($email) {
                        //                         $message->to($email)
                        //                             ->subject("Activity Performed By " . Auth::user()->name);
                        //                     }
                        //                 );
                        //             } catch (\Exception $e) {
                        //                 //log error
                        //             }
                        //         }
                        //     }
                        // }
                        $riskAssement->update();
                    }
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($riskAssement->stage == 4) {

                    if (!$riskAssement->qa_cqa_comments) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'QA/CQA Review Comment yet to be filled!',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for CQA/QA Head Approval state'
                        ]);
                    }

                    $riskAssement->stage = "5";
                    $riskAssement->status = "In Approval";
                    $riskAssement->QA_Initial_Review_Complete_By = Auth::user()->name;
                    $riskAssement->QA_Initial_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $riskAssement->QA_Initial_Review_Comments = $request->comment;

                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'In QA/CQA Review Complete By , In QA/CQA Review Complete On';
                    if(is_null($lastDocument->QA_Initial_Review_Complete_By) || $lastDocument->QA_Initial_Review_Complete_On == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->QA_Initial_Review_Complete_By. ' ,' . $lastDocument->QA_Initial_Review_Complete_On;
                    }
                    $history->previous = "";
                    $history->current = $riskAssement->QA_Initial_Review_Complete_By. ',' . $riskAssement->QA_Initial_Review_Complete_On;
                    $history->comment = $request->comment;
                    $history->action = 'In QA/CQA Review Complete';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "In Approval";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Approved';
                     if(is_null($lastDocument->QA_Initial_Review_Complete_By) || $lastDocument->QA_Initial_Review_Complete_On == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();


                    // $list = Helpers::getInitiatorUserList($riskAssement->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $riskAssement->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $riskAssement, 'site'=>"RA", 'history' => "In QA/CQA Review Complete", 'process' => 'Risk Assessment', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $riskAssement) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Risk Assesment, Record #" . str_pad($riskAssement->record, 4, '0', STR_PAD_LEFT) . " - Activity: In QA/CQA Review Complete Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    // $list = Helpers::getQAUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $riskAssement->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $riskAssement],
                    //                     function ($message) use ($email) {
                    //                         $message->to($email)
                    //                             ->subject("Activity Performed By " . Auth::user()->name);
                    //                     }
                    //                 );
                    //             } catch (\Exception $e) {
                    //                 //log error
                    //             }
                    //         }
                    //     }
                    // }
                    $riskAssement->update();
                    toastr()->success('Document Sent');
                    return back();
                }

                if ($riskAssement->stage == 5) {

                    if (!$riskAssement->qa_cqa_head_comm) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'QA/CQA Head Approval Comment yet to be filled!',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for Close Done state'
                        ]);
                    }

                    $riskAssement->stage = "6";
                    $riskAssement->status = "Closed-Done";
                    $riskAssement->in_approve_by = Auth::user()->name;
                    $riskAssement->in_approve_on = Carbon::now()->format('d-M-Y');
                    $riskAssement->in_approve_Comments = $request->comment;

                    $history = new RiskAuditTrail();
                    $history->risk_id = $id;
                    $history->activity_type = 'Approve by , Approve On';
                    if(is_null($lastDocument->in_approve_by) || $lastDocument->in_approve_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->in_approve_by. ' ,' . $lastDocument->in_approve_on;
                    }
                    $history->previous = "";
                    $history->current = $riskAssement->in_approve_by. ',' . $riskAssement->in_approve_on;
                    $history->comment = $request->comment;
                    $history->action = 'Approved';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Close- Done";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Close-Done';
                     if(is_null($lastDocument->in_approve_by) || $lastDocument->in_approve_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();

                    // $list = Helpers::getInitiatorUserList($riskAssement->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $riskAssement->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $riskAssement, 'site'=>"RA", 'history' => "Approved", 'process' => 'Risk Assessment', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $riskAssement) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Risk Assesment, Record #" . str_pad($riskAssement->record, 4, '0', STR_PAD_LEFT) . " - Activity: Approved Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    // $list = Helpers::getQAUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $riskAssement->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $riskAssement],
                    //                     function ($message) use ($email) {
                    //                         $message->to($email)
                    //                             ->subject("Activity Performed By " . Auth::user()->name);
                    //                     }
                    //                 );
                    //             } catch (\Exception $e) {
                    //                 //log error
                    //             }
                    //         }
                    //     }
                    // }
                    $riskAssement->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                // if ($riskAssement->stage == 6) {

                //     // if ($riskAssement->form_progress === 'capa' && !empty($riskAssement->QA_Feedbacks))
                //     // {
                //     //     Session::flash('swal', [
                //     //         'type' => 'success',
                //     //         'title' => 'Success',
                //     //         'message' => 'Sent for QA Head/Manager Designee Approval'
                //     //     ]);

                //     // } else {
                //     //     Session::flash('swal', [
                //     //         'type' => 'warning',
                //     //         'title' => 'Mandatory Fields!',
                //     //         'message' => 'Investigation and CAPA / QA Final review Tab is yet to be filled!'
                //     //     ]);

                //     //     return redirect()->back();
                //     // }


                //     $riskAssement->stage = "7";
                //     $riskAssement->status = "Closed - Done";
                //     $riskAssement->in_approve_by = Auth::user()->name;
                //     $riskAssement->in_approve_on = Carbon::now()->format('d-M-Y');
                //     $riskAssement->in_approve_Comments = $request->comment;

                //     $history = new RiskAuditTrail();
                //     $history->risk_id = $id;
                //     $history->activity_type = 'In Approval By , In Approval On';

                //     if(is_null($lastDocument->in_approve_by) || $lastDocument->in_approve_on == ''){
                //         $history->previous = "";
                //     }else{
                //         $history->previous = $lastDocument->in_approve_by. ' ,' . $lastDocument->in_approve_on;
                //     }
                //     $history->previous = "";
                //     $history->current = $riskAssement->in_approve_by. ',' . $riskAssement->in_approve_on;
                //     $history->comment = $request->comment;
                //     $history->action = 'Approved';
                //     $history->user_id = Auth::user()->id;
                //     $history->user_name = Auth::user()->name;
                //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                //     $history->origin_state = $lastDocument->status;
                //     $history->change_to =   "Close-done";
                //     $history->change_from = $lastDocument->status;
                //     $history->stage = 'Approved';
                //     if(is_null($lastDocument->in_approve_by) || $lastDocument->in_approve_on == ''){
                //         $history->previous = "";
                //     }else{
                //         $history->previous = $lastDocument->in_approve_by. ' ,' . $lastDocument->in_approve_on;
                //     }
                //     $history->save();
                //     // $list = Helpers::getQAUserList();
                //     // foreach ($list as $u) {
                //     //     if ($u->q_m_s_divisions_id == $riskAssement->division_id) {
                //     //         $email = Helpers::getInitiatorEmail($u->user_id);
                //     //         if ($email !== null) {
                //     //             try {
                //     //                 Mail::send(
                //     //                     'mail.view-mail',
                //     //                     ['data' => $riskAssement],
                //     //                     function ($message) use ($email) {
                //     //                         $message->to($email)
                //     //                             ->subject("Activity Performed By " . Auth::user()->name);
                //     //                     }
                //     //                 );
                //     //             } catch (\Exception $e) {
                //     //                 //log error
                //     //             }
                //     //         }
                //     //     }
                //     // }
                //     $riskAssement->update();
                //     toastr()->success('Document Sent');
                //     return back();
                // }


            } else {
                toastr()->error('E-signature Not match');
                return back();
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function RejectStateChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $riskAssement = RiskManagement::find($id);
            $lastDocument =  RiskManagement::find($id);
            $data =  RiskManagement::find($id);

            if ($riskAssement->stage == 6) {
                $riskAssement->stage = "5";
                $riskAssement->status = "In Approval";

                $riskAssement->in_approve_by = "Not Applicable";
                $riskAssement->in_approve_on = "Not Applicable";
                $riskAssement->in_approve_Comments = $request->comment;
                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                $history->activity_type = 'In Approval By , In Approval On';
                // if(is_null($lastDocument->in_approve_by) || $lastDocument->in_approve_on == ''){
                //     $history->previous = "";
                // }else{
                //     $history->previous = $lastDocument->in_approve_by. ' ,' . $lastDocument->in_approve_on;
                // }
                $history->activity_type = 'Not Applicable';
                $history->previous = "";
                $history->current = $riskAssement->in_approve_by;
                $history->comment = $request->comment;
                $history->action  = " Reject Action Plan ";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "In Approval";
                $history->change_from = "Closed - Done";
                $history->action_name = "More Information Required";
                $history->stage = 'Cancelled';
                if(is_null($lastDocument->in_approve_by) || $lastDocument->in_approve_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                $history->save();

                $list = Helpers::getQAUserList($riskAssement->division_id); // Notify CFT Person
                        foreach ($list as $u) {
                            // if($u->q_m_s_divisions_id == $riskAssement->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                            // dd($email);
                            if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $riskAssement, 'site' => "Risk Assesment", 'history' => "More Info Req", 'process' => 'Risk Assesment', 'comment' => $request->comments, 'user' => Auth::user()->name],
                                    function ($message) use ($email, $riskAssement) {
                                        $message->to($email)
                                            ->subject("Agio Notification: Risk Assesment, Record #" . str_pad($riskAssement->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Req");
                                    }
                                );
                            }
                            // }
                        }

                        // $list = Helpers::getCQAUsersList($riskAssement->division_id); // Notify CFT Person
                        // foreach ($list as $u) {
                        //     // if($u->q_m_s_divisions_id == $riskAssement->division_id){
                        //     $email = Helpers::getUserEmail($u->user_id);
                        //     // dd($email);
                        //     if ($email !== null) {
                        //         Mail::send(
                        //             'mail.view-mail',
                        //             ['data' => $riskAssement, 'site' => "Risk Assesment", 'history' => "More Info Req", 'process' => 'Risk Assesment', 'comment' => $request->comments, 'user' => Auth::user()->name],
                        //             function ($message) use ($email, $riskAssement) {
                        //                 $message->to($email)
                        //                     ->subject("Agio Notification: Risk Assesment, Record #" . str_pad($riskAssement->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Req");
                        //             }
                        //         );
                        //     }
                        //     // }
                        // }
                $riskAssement->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($riskAssement->stage == 5) {
                $riskAssement->stage = "4";
                $riskAssement->status = "In QA/CQA Review";

                $riskAssement->in_approve_by = "Not Applicable";
                $riskAssement->in_approve_on = "Not Applicable";
                $riskAssement->QA_Initial_Review_Comments  = $request->comment;

                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                // if(is_null($lastDocument->in_approve_by) || $lastDocument->in_approve_on == ''){
                //     $history->previous = "";
                // }else{
                //     $history->previous = $lastDocument->in_approve_by. ' ,' . $lastDocument->in_approve_on;
                // }
                 $history->activity_type = 'Not Applicable';
                $history->previous = "";
                $history->current = $riskAssement->in_approve_by;
                $history->comment = $request->comment;
                $history->action  = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "In QA/CQA Review";
                $history->change_from = "In Approval";
                $history->action_name = "More Information Required";
                $history->stage = 'Cancelled';
                if(is_null($lastDocument->in_approve_by) || $lastDocument->in_approve_on == ''){
                    $history->previous = "";
                }else{
                    $history->previous = $lastDocument->in_approve_by. ' ,' . $lastDocument->in_approve_on;
                }
                $history->save();
                // $list = Helpers::getHodUserList($riskAssement->division_id); // Notify CFT Person
                //         foreach ($list as $u) {
                //             // if($u->q_m_s_divisions_id == $riskAssement->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //             // dd($email);
                //             if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $riskAssement, 'site' => "Risk Assesment", 'history' => "Request More Info", 'process' => 'Market Complaint', 'comment' => $request->comments, 'user' => Auth::user()->name],
                //                     function ($message) use ($email, $riskAssement) {
                //                         $message->to($email)
                //                             ->subject("Agio Notification: Risk Assement, Record #" . str_pad($riskAssement->record, 4, '0', STR_PAD_LEFT) . " - Activity: Request More Info");
                //                     }
                //                 );
                //             }
                //             // }
                //         }
                $riskAssement->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($riskAssement->stage == 4) {
                $riskAssement->stage = "3";
                $riskAssement->status = "CFT Review";

                $riskAssement->QA_Initial_Review_Complete_By = "Not Applicable";
                $riskAssement->QA_Initial_Review_Complete_On   ="Not Applicable";
                $riskAssement->QA_Initial_Review_Comments = $request->comment;

                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                // if(is_null($lastDocument->QA_Initial_Review_Complete_By) || $lastDocument->QA_Initial_Review_Complete_On	 == ''){
                //     $history->previous = "";
                // }else{
                //     $history->previous = $lastDocument->QA_Initial_Review_Complete_By. ' ,' . $lastDocument->QA_Initial_Review_Complete_On	;
                // }
                $history->activity_type = 'Not Applicable';
                $history->previous = "";
                $history->current = $riskAssement->QA_Initial_Review_Complete_By;
                $history->comment = $request->comment;
                $history->action  = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "CFT review";
                $history->change_from = "In QA/CQA Review";
                $history->action_name = "More Information Required";
                $history->stage = 'Cancelled';
                // if(is_null($lastDocument->QA_Initial_Review_Complete_By) || $lastDocument->QA_Initial_Review_Complete_On	 == ''){
                //     $history->previous = "";
                // }else{
                //     $history->previous = $lastDocument->QA_Initial_Review_Complete_By. ' ,' . $lastDocument->QA_Initial_Review_Complete_On	;
                // }
                $history->save();

                // $list = Helpers::getHodUserList($riskAssement->division_id); // Notify CFT Person
                //         foreach ($list as $u) {
                //             // if($u->q_m_s_divisions_id == $riskAssement->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //             // dd($email);
                //             if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $riskAssement, 'site' => "Risk Assesment", 'history' => "Request More Info", 'process' => 'Risk Assessment', 'comment' => $request->comments, 'user' => Auth::user()->name],
                //                     function ($message) use ($email, $riskAssement) {
                //                         $message->to($email)
                //                             ->subject("Agio Notification: Risk Assessment, Record #" . str_pad($riskAssement->record, 4, '0', STR_PAD_LEFT) . " - Activity: Request More Info");
                //                     }
                //                 );
                //             }
                //             // }
                //         }

                $riskAssement->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($riskAssement->stage == 3) {
                $riskAssement->stage = "2";
                $riskAssement->status = "HOD Review";

                $riskAssement->CFT_Review_Complete_By = "Not Applicable";
                $riskAssement->CFT_Review_Complete_On = "Not Applicable";
                $riskAssement->CFT_Review_Comments = $request->comment;

                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                // if(is_null($lastDocument->CFT_Review_Complete_By) || $lastDocument->CFT_Review_Complete_On == ''){
                //     $history->previous = "";
                // }else{
                //     $history->previous = $lastDocument->CFT_Review_Complete_By. ' ,' . $lastDocument->CFT_Review_Complete_On;
                // }
                $history->activity_type = 'Not Applicable';
                $history->previous = "";
                $history->current = $riskAssement->CFT_Review_Complete_By;
                $history->comment = $request->comment;
                $history->action  = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "HOD Review";
                $history->change_from = "CFT review";
                $history->action_name = "More Information Required";
                $history->stage = 'Cancelled';
                // if(is_null($lastDocument->CFT_Review_Complete_By) || $lastDocument->CFT_Review_Complete_On == ''){
                //     $history->previous = "";
                // }else{
                //     $history->previous = $lastDocument->CFT_Review_Complete_By. ' ,' . $lastDocument->CFT_Review_Complete_On;
                // }
                $history->save();

                // $list = Helpers::getInitiatorUserList($riskAssement->division_id); // Notify CFT Person
                //         foreach ($list as $u) {
                //             // if($u->q_m_s_divisions_id == $riskAssement->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //             // dd($email);
                //             if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $riskAssement, 'site' => "Risk Assessment", 'history' => "More Information Required", 'process' => 'Risk Assessment', 'comment' => $request->comments, 'user' => Auth::user()->name],
                //                     function ($message) use ($email, $riskAssement) {
                //                         $message->to($email)
                //                             ->subject("Agio Notification: Risk Assessment, Record #" . str_pad($riskAssement->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                     }
                //                 );
                //             }
                //             // }
                //         }

                $riskAssement->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($riskAssement->stage == 2) {
                $riskAssement->stage = "1";
                $riskAssement->status = "Opened";

                $riskAssement->risk_analysis_completed_by = 'Not Applicable';
                $riskAssement->risk_analysis_completed_on = 'Not Applicable';
                // $riskAssement->more_actions_needed_1 = $request->comment;

                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                // if(is_null($lastDocument->risk_analysis_completed_by) || $lastDocument->risk_analysis_completed_on == ''){
                //     $history->previous = "";
                // }else{
                //     $history->previous = $lastDocument->risk_analysis_completed_by. ' ,' . $lastDocument->risk_analysis_completed_on;
                // }
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->current = $riskAssement->risk_analysis_completed_by;
                $history->comment = $request->comment;
                $history->action  = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Opened";
                $history->change_from = "HOD Review";
                $history->action_name = "More Information Required";
                $history->stage = 'Cancelled';
                // if(is_null($lastDocument->risk_analysis_completed_by) || $lastDocument->risk_analysis_completed_on == ''){
                //     $history->previous = "";
                // }else{
                //     $history->previous = $lastDocument->risk_analysis_completed_by. ' ,' . $lastDocument->risk_analysis_completed_on;
                // }
                $history->save();

                // $list = Helpers::getHodUserList($riskAssement->division_id); // Notify CFT Person
                //         foreach ($list as $u) {
                //             // if($u->q_m_s_divisions_id == $riskAssement->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //             // dd($email);
                //             if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $riskAssement, 'site' => "Risk Assesment", 'history' => "Cancel", 'process' => 'Risk Assesment', 'comment' => $request->comments, 'user' => Auth::user()->name],
                //                     function ($message) use ($email, $riskAssement) {
                //                         $message->to($email)
                //                             ->subject("Agio Notification: Risk Assesment, Record #" . str_pad($riskAssement->record, 4, '0', STR_PAD_LEFT) . " - Activity: Cancel");
                //                     }
                //                 );
                //             }
                //             // }
                //         }

                $riskAssement->cancelled_by = Auth::user()->name;
                $riskAssement->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($riskAssement->stage == 1) {
                $riskAssement->stage = "0";
                $riskAssement->status = "Closed - Cancelled";
                $riskAssement->cancelled_by = Auth::user()->name;
                $riskAssement->cancelled_on = Carbon::now()->format('d-M-Y');
                $riskAssement->cancel_comment = $request->comment;
                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->current = $riskAssement->cancelled_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'Cancelled';
                $history->save();

                // $list = Helpers::getHodUserList($riskAssement->division_id); // Notify CFT Person
                //         foreach ($list as $u) {
                //             // if($u->q_m_s_divisions_id == $riskAssement->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //             // dd($email);
                //             if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $riskAssement, 'site' => "Risk Assesment", 'history' => "Cancel", 'process' => 'Risk Assesment', 'comment' => $request->comments, 'user' => Auth::user()->name],
                //                     function ($message) use ($email, $riskAssement) {
                //                         $message->to($email)
                //                             ->subject("Agio Notification: Risk Assesment, Record #" . str_pad($riskAssement->record, 4, '0', STR_PAD_LEFT) . " - Activity: Cancel");
                //                     }
                //                 );
                //             }
                //             // }
                //         }

                $riskAssement->update();
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
        $document->originator = User::where('id', $document->initiator_id)->value('name');
        $users = User::all();


        //dd($audit);
        return view("frontend.riskAssesment.new_audit_trail", compact('audit', 'document', 'today','users'));
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
        $data1 =  RiskManagmentCft::where('risk_id', $id)->first();
        // dd($data);
        if (!empty($data)) {
            $users = User::all();
            $riskgrdfishbone = RiskAssesmentGrid::where('risk_id', $data->id)->where('type', 'fishbone')->first();
            $failure_mode = RiskAssesmentGrid::where('risk_id', $data->id)->where('type', 'effect_analysis')->first();
            $riskgrdwhy_chart = RiskAssesmentGrid::where('risk_id', $data->id)->where('type', 'why_chart')->first();
            $riskgrdwhat_who_where = RiskAssesmentGrid::where('risk_id', $data->id)->where('type', 'what_who_where')->first();
            $action_plan = RiskAssesmentGrid::where('risk_id', $id)->where('type', "Action_Plan")->first();
            $mitigation = RiskAssesmentGrid::where('risk_id', $data->id)->where('type', 'Mitigation_Plan_Details')->first();

            // dd($riskgrdwhat_who_where);
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.riskAssesment.singleReport', compact('data','data1', 'riskgrdfishbone', 'riskgrdwhy_chart', 'riskgrdwhat_who_where', 'failure_mode', 'action_plan', 'users', 'mitigation'))
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

    // public function child(Request $request, $id)
    // {
    //     $parent_id = $id;
    //     $parent_type = "Action-Item";
    //     $record = ((RecordNumber::first()->value('counter')) + 1);
    //     $record = str_pad($record, 4, '0', STR_PAD_LEFT);
    //     $currentDate = Carbon::now();
    //     $formattedDate = $currentDate->addDays(30);
    //     $due_date = $formattedDate->format('d-M-Y');
    //     $parent_record = RiskManagement::where('id', $id)->value('record');
    //     $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
    //     $parent_division_id = RiskManagement::where('id', $id)->value('division_id');
    //     $parent_initiator_id = RiskManagement::where('id', $id)->value('initiator_id');
    //     $parent_intiation_date = RiskManagement::where('id', $id)->value('intiation_date');
    //     $parent_short_description = RiskManagement::where('id', $id)->value('short_description');
    //     // $old_record = RiskManagement::select('id', 'division_id', 'record')->get();


    //     return view('frontend.action-item.action-item', compact('parent_id', 'parent_type', 'record', 'currentDate', 'formattedDate', 'due_date', 'parent_record', 'parent_record', 'parent_division_id', 'parent_initiator_id', 'parent_intiation_date', 'parent_short_description', 'old_record'));

    //     $old_record = RiskManagement::select('id', 'division_id', 'record')->get();

    // }

    public function child(Request $request, $id)
    {
        // return "test";

        $cft = [];
        $parent_id = $id;
        $parent_type = "Risk Assesment";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $parent_record = RiskManagement::where('id', $id)->value('record');
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_division_id = RiskManagement::where('id', $id)->value('division_id');
        $parent_initiator_id = RiskManagement::where('id', $id)->value('initiator_id');
        $parent_intiation_date = RiskManagement::where('id', $id)->value('intiation_date');
        $parent_created_at = RiskManagement::where('id', $id)->value('created_at');
        $parent_short_description = RiskManagement::where('id', $id)->value('short_description');
        $hod = User::where('role', 4)->get();
        if ($request->child_type == "extension") {
            $parent_due_date = "";
            $parent_id = $id;
            $parent_name = $request->parent_name;
            if ($request->due_date) {
                $parent_due_date = $request->due_date;
            }

            $record_number = ((RecordNumber::first()->value('counter')) + 1);
            $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            $Extensionchild = RiskManagement::find($id);
            $Extensionchild->Extensionchild = $record_number;
            $Extensionchild->save();
            return view('frontend.extension.extension_new', compact('parent_id','parent_type','parent_record', 'parent_name', 'record_number', 'parent_due_date', 'due_date', 'parent_created_at'));
        }
        $old_record = RiskManagement::select('id', 'division_id', 'record')->get();
        // dd($request->child_type)
        if ($request->child_type == "capa") {
            $parent_name = "CAPA";
            $Capachild = RiskManagement::find($id);
            $Capachild->Capachild = $record_number;
            $record = $record_number;
            $old_records = $old_record;
            $relatedRecords = Helpers::getAllRelatedRecords();
            $Capachild->save();

            return view('frontend.forms.capa', compact('parent_id', 'relatedRecords', 'parent_record','parent_type', 'record', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'old_records', 'cft', 'record_number'));
        } elseif ($request->child_type == "Action_Item")
         {$record = ((RecordNumber::first()->value('counter')) + 1);
            $record = str_pad($record, 4, '0', STR_PAD_LEFT);
            $parent_name = "Risk Assesment";
            $actionchild = RiskManagement::find($id);
            $actionchild->actionchild = $record_number;
            // $p_record = RiskManagement::find($id);
            $data_record = Helpers::getDivisionName($actionchild->division_id ) . '/' . 'RA' .'/' . date('Y') .'/' . str_pad($actionchild->record, 4, '0', STR_PAD_LEFT);
            $parent_id = $id;
            $actionchild->save();
            $parentRecord = RiskManagement::where('id', $id)->value('record');
            return view('frontend.action-item.action-item', compact('old_record','parentRecord','record', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'record_number', 'due_date', 'parent_id', 'parent_type','data_record'));
        }

        elseif ($request->child_type == "effectiveness_check")
         {
            $parent_name = "CAPA";
            $effectivenesschild = RiskManagement::find($id);
            $effectivenesschild->effectivenesschild = $record_number;
            $effectivenesschild->save();
        return view('frontend.forms.effectiveness-check', compact('old_record','parent_short_description','parent_record', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id',  'record_number', 'due_date', 'parent_id', 'parent_type'));
        }
        elseif ($request->child_type == "Change_control") {
            $parent_name = "risk_assessment_required";
            $Changecontrolchild = RiskManagement::find($id);
            $Changecontrolchild->Changecontrolchild = $record_number;
            $data = RiskAssessment::all();
            $preRiskAssessment = RiskAssessment::all();
            $data = Helpers::getAllRelatedRecords();

            $pre = CC::all();

            $Changecontrolchild->save();

            return view('frontend.change-control.new-change-control', compact('pre', 'data', 'preRiskAssessment', 'cft','hod','parent_short_description',  'parent_initiator_id', 'parent_intiation_date', 'parent_division_id',  'record_number', 'due_date', 'parent_id', 'parent_type'));
        }
        // else {
        //     $parent_name = "Root";
        //     $Rootchild = RiskManagement::find($id);
        //     $Rootchild->Rootchild = $record_number;
        //     $Rootchild->save();
        //     return view('frontend.forms.root-cause-analysis', compact('parent_id', 'parent_record','parent_type', 'record_number', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', ));
        // }
    }

    public function riskassesmentCancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $riskAssement = RiskManagement::find($id);
            $lastDocument =  RiskManagement::find($id);

            // if ($riskAssement->stage == 0) {
                $riskAssement->stage = "0";
                $riskAssement->status = "Closed - Cancelled";
                $riskAssement->cancelled_by = Auth::user()->name;
                $riskAssement->cancelled_on = Carbon::now()->format('d-M-Y');
                $riskAssement->cancelled_comment = $request->comment;
                $history = new RiskAuditTrail();
                $history->risk_id = $id;
                $history->activity_type = 'Activity Log';
                $history->action = 'Cancel';
                $history->previous = "";
                $history->current = $riskAssement->closed_done_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Closed - Cancelled";
                $history->change_from = "Supervisor Review";
                $history->stage='Closed - Cancelled';
                $history->save();
                $riskAssement->update();
                toastr()->success('Document Sent');
                return back();
            // }

            // $riskAssement->stage = "2";
            // // $riskAssement->status = "Closed - Cancelled";
            // $riskAssement->cancelled_by = Auth::user()->name;
            // $riskAssement->cancelled_on = Carbon::now()->format('d-M-Y');
            // $riskAssement->update();
            // toastr()->success('Document Sent');
            // return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function rm_AuditReview(Request $request, $id)
    {
            $history = new AuditReviewersDetails;
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->type = $request->type;
            $history->reviewer_comment = $request->reviewer_comment;
            $history->reviewer_comment_by = Auth::user()->name;
            $history->reviewer_comment_on = Carbon::now()->toDateString();
            $history->save();

        return redirect()->back();
    }

    public function audit_filter(Request $request, $id)
    {
        // Start query for DeviationAuditTrail
        $query = RiskAuditTrail::query();
        $query->where('risk_id', $id);

        // Check if typedata is provided
        if ($request->filled('typedata')) {
            switch ($request->typedata) {
                case 'cft_review':
                    // Filter by specific CFT review actions
                    $cft_field = ['CFT Review Complete', 'CFT Review Not Required',];
                    $query->whereIn('action', $cft_field);
                    break;

                case 'stage':
                    // Filter by activity log stage changes
                    $stage = [
                        'Submit',
                        'HOD Review Complete',
                        'QA/CQA Initial Review Complete',
                        'Request For Cancellation',
                        'CFT Review Complete',
                        'QA/CQA Final Assessment Complete',
                        'Approved',
                        'Send to Initiator',
                        'Send to HOD',
                        'Send to QA/CQA Initial Review',
                        'Send to Pending Initiator Update',
                        'QA/CQA Final Review Complete',
                        'Rejected',
                        'Initiator Updated Complete',
                        'HOD Final Review Complete',
                        'More Info Required',
                        'Cancel',
                        'Implementation verification Complete',
                        'Closure Approved'
                    ];
                    $query->whereIn('action', $stage); // Ensure correct activity_type value
                    break;

                case 'user_action':
                    // Filter by various user actions
                    $user_action = [
                        'Submit',
                        'HOD Review Complete',
                        'QA/CQA Initial Review Complete',
                        'Request For Cancellation',
                        'CFT Review Complete',
                        'QA/CQA Final Assessment Complete',
                        'Approved',
                        'Send to Initiator',
                        'Send to HOD',
                        'Send to QA/CQA Initial Review',
                        'Send to Pending Initiator Update',
                        'QA/CQA Final Review Complete',
                        'Rejected',
                        'Initiator Updated Complete',
                        'HOD Final Review Complete',
                        'More Info Required',
                        'Cancel',
                        'Implementation verification Complete',
                        'Closure Approved'
                    ];
                    $query->whereIn('action', $user_action);
                    break;
                case 'notification':
                    // Filter by various user actions
                    $notification = [];
                    $query->whereIn('action', $notification);
                    break;
                case 'business':
                    // Filter by various user actions
                    $business = [];
                    $query->whereIn('action', $business);
                    break;

                default:
                    break;
            }
        }

        // Apply additional filters
        if ($request->filled('user')) {
            $query->where('user_id', $request->user);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        // Get the filtered results
        $audit = $query->orderByDesc('id')->get();

        // Flag for filter request
        $filter_request = true;

        // Render the filtered view and return as JSON
        $responseHtml = view('frontend.riskAssesment.ra_filter', compact('audit', 'filter_request'))->render();

        return response()->json(['html' => $responseHtml]);
    }
}
