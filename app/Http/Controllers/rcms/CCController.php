<?php

namespace App\Http\Controllers\rcms;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\ActionItem;
use App\Models\AdditionalInformation;
use App\Models\{CC,ChangeControlCftResponse};
use App\Models\RecordNumber;
use App\Models\CCStageHistory;
use App\Models\ChangeClosure;
use App\Models\table_cc_impactassement;
use App\Models\Docdetail;
use App\Models\ChangeControlComment;
use App\Models\CcCft;

use App\Models\Evaluation;
use App\Models\Extension;
use App\Models\GroupComments;
use App\Models\QaApprovalComments;
use App\Models\Qareview;
use App\Models\QMSDivision;
use App\Models\RiskAssessment;
use App\Models\RiskManagement;
use App\Models\RcmDocHistory;
use App\Models\RiskLevelKeywords;
use App\Models\RoleGroup;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Helpers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PDF;

class CCController extends Controller
{
    public function changecontrol()
    {

        $riskData = RiskLevelKeywords::all();
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);

        $division = QMSDivision::where('name', Helpers::getDivisionName(session()->get('division')))->first();

        if ($division) {
            $last_capa = Capa::where('division_id', $division->id)->latest()->first();

            if ($last_capa) {
                $record_number = $last_capa->record_number ? str_pad($last_capa->record_number->record_number + 1, 4, '0', STR_PAD_LEFT) : '0001';
            } else {
                $record_number = '0001';
            }
        }


        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        return view('frontend.change-control.new-change-control', compact("riskData", "record_number", "due_date"));
    }

    public function index()
    {

        $document = CC::where('initiator_id', Auth::user()->id)->get();
        foreach ($document as $data) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
        }

        return view('frontend.change-control.CC', compact('document'));
    }

    public function create()
    {

        $riskData = RiskLevelKeywords::all();
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $preRiskAssessment = RiskManagement::all();

        $division = QMSDivision::where('name', Helpers::getDivisionName(session()->get('division')))->first();

        // if ($division) {
        //     $last_cc = CC::where('division_id', $division->id)->latest()->first();

        //     if ($last_cc) {
        //         $record_number = $last_cc->record_number ? str_pad($last_cc->record_number->record_number + 1, 4, '0', STR_PAD_LEFT) : '0001';
        //     } else {
        //         $record_number = '0001';
        //     }
        // }

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $hod = User::get();
        $cft = User::get();
        $pre = CC::all();

        return view('frontend.change-control.new-change-control', compact("riskData", "preRiskAssessment", "due_date", "hod", "cft", "pre"));
    }

    public function store(Request $request)
    {
        // $openState->assign_to = $request->assign_to;
        // $openState->Division_Code = $request->div_code;
        //$openState->qa_eval_attach = json_encode($request->qa_eval_attach);
        // $openState->Microbiology = $request->Microbiology;
        // $openState->due_date = Carbon::now()->addDays(30)->format('d-M-Y');
        // $openState->supervisor_comment = $request->supervisor_comment;

        $openState = new CC();
        $openState->form_type = "CC";
        $openState->division_id = $request->division_id;
        $openState->initiator_id = Auth::user()->id;
        $openState->record = DB::table('record_numbers')->value('counter') + 1;

        $openState->due_days = $request->due_days;
        $openState->severity_level1 = $request->severity_level1;

        $openState->parent_id = $request->parent_id;
        $openState->due_date = $request->due_date;
        $openState->parent_type = $request->parent_type;
        $openState->intiation_date = $request->intiation_date;
        $openState->Initiator_Group = $request->Initiator_Group;
        $openState->initiator_group_code = $request->initiator_group_code;
        $openState->short_description = $request->short_description;
        $openState->risk_assessment_required = $request->risk_assessment_required;
        $openState->hod_person = $request->hod_person;
        $openState->doc_change = $request->doc_change;
        $openState->If_Others = $request->others;
        $openState->severity_level1 = $request->severity_level1;
        $openState->initiated_through = $request->initiated_through;
        $openState->initiated_through_req = $request->initiated_through_req;
        $openState->repeat = $request->repeat;
        $openState->repeat_nature = $request->repeat_nature;
        $openState->current_practice = $request->current_practice;
        $openState->proposed_change = $request->proposed_change;
        $openState->reason_change = $request->reason_change;
        $openState->other_comment = $request->other_comment;
        $openState->other_comment = $request->other_comment;

        $openState->type_chnage = $request->type_chnage;
        $openState->qa_comments = $request->qa_comments;
        $openState->justification = $request->justification;
        // $openState->related_records = implode(',', $request->related_records);
        // $openState->qa_head = json_encode($request->qa_head);

        // $openState->training_required = $request->training_required;
         $openState->train_comments = $request->train_comments;

        //     $openState->Microbiology_Person = implode(',', $request->Microbiology_Person);
        $openState->goup_review = $request->goup_review;
        $openState->Production = $request->Production;
        $openState->Production_Person = $request->Production_Person;
        $openState->Quality_Approver = $request->Quality_Approver;
        $openState->Quality_Approver_Person = $request->Quality_Approver_Person;
        $openState->bd_domestic = $request->bd_domestic;
        // $openState->Bd_Person = $request->Bd_Person;

        $openState->cft_comments = $request->cft_comments;
        // $openState->cft_comments = $request->cft_comments;
        $openState->qa_commentss = $request->qa_commentss;
        $openState->designee_comments = $request->designee_comments;
        $openState->Warehouse_comments = $request->Warehouse_comments;
        $openState->Engineering_comments = $request->Engineering_comments;
        $openState->Instrumentation_comments = $request->Instrumentation_comments;
        $openState->Validation_comments = $request->Validation_comments;
        $openState->Others_comments = $request->Others_comments;
        $openState->Group_comments = $request->Group_comments;

        $openState->risk_identification = $request->risk_identification;
        $openState->severity = $request->severity;
        $openState->Occurance = $request->Occurance;
        $openState->Detection = $request->Detection;
        $openState->RPN = $request->RPN;
        $openState->risk_evaluation = $request->risk_evaluation;
        $openState->migration_action = $request->migration_action;

        $openState->qa_appro_comments = $request->qa_appro_comments;
        $openState->feedback = $request->feedback;

        $openState->qa_closure_comments = $request->qa_closure_comments;
        $openState->effective_check = $request->effective_check;
        $openState->effective_check_date = $request->effective_check_date;
        $openState->Effectiveness_checker = $request->Effectiveness_checker;
        $openState->effective_check_plan = $request->effective_check_plan;
        $openState->due_date_extension = $request->due_date_extension;


        // new fields
        if (!empty ($request->initial_update_attach)) {
            $files = [];
            if ($request->hasfile('initial_update_attach')) {
                foreach ($request->file('initial_update_attach') as $file) {
                    $name = $request->name . 'initial_update_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $openState->initial_update_attach = json_encode($files);
        }

        if (!empty ($request->hod_assessment_attach)) {
            $files = [];
            if ($request->hasfile('hod_assessment_attach')) {
                foreach ($request->file('hod_assessment_attach') as $file) {
                    $name = $request->name . 'hod_assessment_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $openState->hod_assessment_attach = json_encode($files);
        }


        if (!empty($request->in_attachment)) {
            $files = [];
            if ($request->hasfile('in_attachment')) {
                foreach ($request->file('in_attachment') as $file) {
                    $name = "CC" . '-in_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $openState->in_attachment = json_encode($files);
        }

        if (!empty($request->risk_assessment_atch)) {
            $files = [];
            if ($request->hasfile('risk_assessment_atch')) {
                foreach ($request->file('risk_assessment_atch') as $file) {
                    $name = "CC" . '-risk_assessment_atch' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $openState->risk_assessment_atch = json_encode($files);
        }


        $openState->status = 'Opened';
        $openState->stage = 1;


        $openState->save();


        /* CFT Data Feilds Start */

        $Cft = new CcCft();
        $Cft->cc_id = $openState->id;
        $Cft->Production_Review = $request->Production_Review;
        $Cft->Production_person = $request->Production_person;
        $Cft->Production_assessment = $request->Production_assessment;
        $Cft->Production_feedback = $request->Production_feedback;
        $Cft->production_on = $request->production_on;
        $Cft->production_by = $request->production_by;

        $Cft->RA_Review = $request->RA_Review;
        $Cft->RA_Comments = $request->RA_Comments;
        $Cft->RA_person = $request->RA_person;
        $Cft->RA_assessment = $request->RA_assessment;
        $Cft->RA_feedback = $request->RA_feedback;
        $Cft->RA_attachment = $request->RA_attachment;
        $Cft->RA_by = $request->RA_by;
        $Cft->RA_on = $request->RA_on;

        $Cft->Production_Table_Review = $request->Production_Table_Review;
        $Cft->Production_Table_Person = $request->Production_Table_Person;
        $Cft->Production_Table_Assessment = $request->Production_Table_Assessment;
        $Cft->Production_Table_Feedback = $request->Production_Table_Feedback;
        $Cft->Production_Table_Attachment = $request->Production_Table_Attachment;
        $Cft->Production_Table_By = $request->Production_Table_By;
        $Cft->Production_Table_On = $request->Production_Table_On;

        $Cft->Production_Injection_Review = $request->Production_Injection_Review;
        $Cft->Production_Injection_Person = $request->Production_Injection_Person;
        $Cft->Production_Injection_Assessment = $request->Production_Injection_Assessment;
        $Cft->Production_Injection_Feedback = $request->Production_Injection_Feedback;
        $Cft->Production_Injection_Attachment = $request->Production_Injection_Attachment;
        $Cft->Production_Injection_By = $request->Production_Injection_By;
        $Cft->Production_Injection_On = $request->Production_Injection_On;

        $Cft->Warehouse_review = $request->Warehouse_review;
        $Cft->Warehouse_notification = $request->Warehouse_notification;
        $Cft->Warehouse_assessment = $request->Warehouse_assessment;
        $Cft->Warehouse_feedback = $request->Warehouse_feedback;
        $Cft->Warehouse_by = $request->Warehouse_Review_Completed_By;
        $Cft->Warehouse_on = $request->Warehouse_on;

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

        $Cft->ProductionLiquid_Review = $request->ProductionLiquid_Review;
        $Cft->ProductionLiquid_person = $request->ProductionLiquid_person;
        $Cft->ProductionLiquid_assessment = $request->ProductionLiquid_assessment;
        $Cft->ProductionLiquid_feedback = $request->ProductionLiquid_feedback;
        $Cft->ProductionLiquid_by = $request->ProductionLiquid_by;
        $Cft->ProductionLiquid_on = $request->ProductionLiquid_on;

        $Cft->Project_management_review = $request->Project_management_review;
        $Cft->Project_management_person = $request->Project_management_person;
        $Cft->Project_management_assessment = $request->Project_management_assessment;
        $Cft->Project_management_feedback = $request->Project_management_feedback;
        $Cft->Project_management_by = $request->Project_management_by;
        $Cft->Project_management_on = $request->Project_management_on;

        $Cft->Store_Review = $request->Store_Review;
        $Cft->Store_person = $request->Store_person;
        $Cft->Store_assessment = $request->Store_assessment;
        $Cft->Store_feedback = $request->Store_feedback;
        $Cft->Store_by = $request->Store_by;
        $Cft->Store_on = $request->Store_on;

        $Cft->ResearchDevelopment_Review = $request->ResearchDevelopment_Review;
        $Cft->ResearchDevelopment_person = $request->ResearchDevelopment_person;
        $Cft->ResearchDevelopment_assessment = $request->ResearchDevelopment_assessment;
        $Cft->ResearchDevelopment_feedback = $request->ResearchDevelopment_feedback;
        $Cft->ResearchDevelopment_by = $request->ResearchDevelopment_by;
        $Cft->ResearchDevelopment_on = $request->ResearchDevelopment_on;

        $Cft->RegulatoryAffair_Review = $request->RegulatoryAffair_Review;
        $Cft->RegulatoryAffair_person = $request->RegulatoryAffair_person;
        $Cft->RegulatoryAffair_assessment = $request->RegulatoryAffair_assessment;
        $Cft->RegulatoryAffair_feedback = $request->RegulatoryAffair_feedback;
        $Cft->RegulatoryAffair_by = $request->RegulatoryAffair_by;
        $Cft->RegulatoryAffair_on = $request->RegulatoryAffair_on;

        $Cft->Microbiology_Review = $request->Microbiology_Review;
        $Cft->Microbiology_person = $request->Microbiology_person;
        $Cft->Microbiology_assessment = $request->Microbiology_assessment;
        $Cft->Microbiology_feedback = $request->Microbiology_feedback;
        $Cft->Microbiology_by = $request->Microbiology_by;
        $Cft->Microbiology_on = $request->Microbiology_on;

        $Cft->CorporateQualityAssurance_Review = $request->CorporateQualityAssurance_Review;
        $Cft->CorporateQualityAssurance_person = $request->CorporateQualityAssurance_person;
        $Cft->CorporateQualityAssurance_assessment = $request->CorporateQualityAssurance_assessment;
        $Cft->CorporateQualityAssurance_feedback = $request->CorporateQualityAssurance_feedback;
        $Cft->CorporateQualityAssurance_by = $request->CorporateQualityAssurance_by;
        $Cft->CorporateQualityAssurance_on = $request->CorporateQualityAssurance_on;

        $Cft->ContractGiver_Review = $request->ContractGiver_Review;
        $Cft->ContractGiver_person = $request->ContractGiver_person;
        $Cft->ContractGiver_assessment = $request->ContractGiver_assessment;
        $Cft->ContractGiver_feedback = $request->ContractGiver_feedback;
        $Cft->ContractGiver_by = $request->ContractGiver_by;
        $Cft->ContractGiver_on = $request->ContractGiver_on;



        $Cft->hod_assessment_comments = $request->hod_assessment_comments;
        // $Cft->Other1_person = $request->Other1_person;
        // $Cft->Other1_Department_person = $request->Other1_Department_person;
        // $Cft->Other1_assessment = $request->Other1_assessment;
        // $Cft->Other1_feedback = $request->Other1_feedback;
        // $Cft->Other1_by = $request->Other1_by;
        // $Cft->Other1_on = $request->Other1_on;

        // $Cft->Other2_review = $request->Other2_review;
        // $Cft->Other2_person = $request->Other2_person;
        // $Cft->Other2_Department_person = $request->Other2_Department_person;
        // $Cft->Other2_Assessment = $request->Other2_Assessment;
        // $Cft->Other2_feedback = $request->Other2_feedback;
        // $Cft->Other2_by = $request->Other2_by;
        // $Cft->Other2_on = $request->Other2_on;

        // $Cft->Other3_review = $request->Other3_review;
        // $Cft->Other3_person = $request->Other3_person;
        // $Cft->Other3_Department_person = $request->Other3_Department_person;
        // $Cft->Other3_Assessment = $request->Other3_Assessment;
        // $Cft->Other3_feedback = $request->Other3_feedback;
        // $Cft->Other3_by = $request->Other3_by;
        // $Cft->Other3_on = $request->Other3_on;

        // $Cft->Other4_review = $request->Other4_review;
        // $Cft->Other4_person = $request->Other4_person;
        // $Cft->Other4_Department_person = $request->Other4_Department_person;
        // $Cft->Other4_Assessment = $request->Other4_Assessment;
        // $Cft->Other4_feedback = $request->Other4_feedback;
        // $Cft->Other4_by = $request->Other4_by;
        // $Cft->Other4_on = $request->Other4_on;

        // $Cft->Other5_review = $request->Other5_review;
        // $Cft->Other5_person = $request->Other5_person;
        // $Cft->Other5_Department_person = $request->Other5_Department_person;
        // $Cft->Other5_Assessment = $request->Other5_Assessment;
        // $Cft->Other5_feedback = $request->Other5_feedback;
        // $Cft->Other5_by = $request->Other5_by;
        // $Cft->Other5_on = $request->Other5_on;


        if (!empty ($request->RA_attachment)) {
            $files = [];
            if ($request->hasfile('RA_attachment')) {
                foreach ($request->file('RA_attachment') as $file) {
                    $name = $request->name . 'RA_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $Cft->RA_attachment = json_encode($files);
        }
        if (!empty ($request->Quality_Assurance_attachment)) {
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
        if (!empty ($request->Production_Table_Attachment)) {
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
        if (!empty ($request->ProductionLiquid_attachment)) {
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
        if (!empty ($request->Production_Injection_Attachment)) {
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



        if (!empty ($request->Store_attachment)) {
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
        if (!empty ($request->Quality_Control_attachment)) {
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
        if (!empty ($request->ResearchDevelopment_attachment)) {
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
        if (!empty ($request->Engineering_attachment)) {
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
        if (!empty ($request->Human_Resource_attachment)) {
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
        if (!empty ($request->Microbiology_attachment)) {
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
        if (!empty ($request->RegulatoryAffair_attachment)) {
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
        if (!empty ($request->CorporateQualityAssurance_attachment)) {
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
        if (!empty ($request->Environment_Health_Safety_attachment)) {
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
        if (!empty ($request->Information_Technology_attachment)) {
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
        if (!empty ($request->ContractGiver_attachment)) {
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


        if (!empty ($request->Other1_attachment)) {
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
        if (!empty ($request->Other2_attachment)) {
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
        if (!empty ($request->Other3_attachment)) {
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
        if (!empty ($request->Other4_attachment)) {
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
        if (!empty ($request->Other5_attachment)) {
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

        /* CFT Fields Ends */

        // Retrieve the current counter value
        $counter = DB::table('record_numbers')->value('counter');
        // Generate the record number with leading zeros
        $recordNumber = str_pad($counter, 5, '0', STR_PAD_LEFT);
        // Increment the counter value
        $newCounter = $counter + 1;
        DB::table('record_numbers')->update(['counter' => $newCounter]);


        $doocumentDetail = Docdetail::where(['cc_id' => $openState->id])->firstOrCreate();
        $doocumentDetail->cc_id = $openState->id;
        $doocumentDetail->current_practice = $request->current_practice;
        $doocumentDetail->proposed_change = $request->proposed_change;
        $doocumentDetail->reason_change = $request->reason_change;
        $doocumentDetail->other_comment = $request->other_comment;
        $doocumentDetail->save();

        $affectedDocumentDetail = Docdetail::where(['cc_id' => $openState->id, 'identifier' =>'AffectedDocDetail'])->firstOrCreate();
        $affectedDocumentDetail->cc_id = $openState->id;
        $affectedDocumentDetail->identifier = 'AffectedDocDetail';
        $affectedDocumentDetail->data = $request->affectedDocuments;
        $affectedDocumentDetail->current_practice = $request->current_practice;
        $affectedDocumentDetail->proposed_change = $request->proposed_change;
        $affectedDocumentDetail->reason_change = $request->reason_change;
        $affectedDocumentDetail->other_comment = $request->other_comment;
        $affectedDocumentDetail->supervisor_comment = $request->supervisor_comment;
        $affectedDocumentDetail->save();


        $docdetail = new Docdetail();

        // $docdetail->cc_id = $openState->id;
        // if (!empty($request->serial_number)) {
        //     $docdetail->sno = serialize($request->serial_number);
        // }
        // if (!empty($request->current_doc_number)) {
        //     $docdetail->current_doc_no = serialize($request->current_doc_number);
        // }
        // if (!empty($request->current_version)) {
        //     $docdetail->current_version_no = serialize($request->current_version);
        // }
        // if (!empty($request->new_doc_number)) {
        //     $docdetail->new_doc_no = serialize($request->new_doc_number);
        // }
        // if (!empty($request->new_version)) {
        //     $docdetail->new_version_no = serialize($request->new_version);
        // }
        // $docdetail->current_practice = $request->current_practice;
        // $docdetail->proposed_change = $request->proposed_change;
        // $docdetail->reason_change = $request->reason_change;
        // $docdetail->other_comment = $request->other_comment;
        // $docdetail->supervisor_comment = $request->supervisor_comment;
        // $docdetail->save();



        $review = new Qareview();
        $review->cc_id = $openState->id;
        // $review->type_chnage = $request->type_chnage;
        $review->qa_comments = $request->qa_comments;
        if ($request->related_records) {
            $review->related_records = implode(',', $request->related_records);
        }

        if (!empty($request->qa_head)) {
            $files = [];
            if ($request->hasfile('qa_head')) {
                foreach ($request->file('qa_head') as $file) {


                    $name = "CC" . '-qa_head' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $review->qa_head = json_encode($files);
        }
        $review->save();

        $evaluation = new Evaluation();
        $evaluation->cc_id = $openState->id;
        $evaluation->qa_eval_comments = $request->qa_eval_comments;
        $evaluation->train_comments = $request->train_comments;

        if ($request->training_required) {
            $evaluation->training_required = $request->training_required;
        }
        if (!empty($request->qa_eval_attach)) {
            $files = [];
            if ($request->hasfile('qa_eval_attach')) {
                foreach ($request->file('qa_eval_attach') as $file) {
                    $name = "CC" . '-qa_eval_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $evaluation->qa_eval_attach = json_encode($files);
        }

        $evaluation->save();

        $info = new AdditionalInformation();
        $info->cc_id = $openState->id;
        $info->goup_review = $request->goup_review;
        $info->Production = $request->Production;
        $info->Production_Person = $request->Production_Person;
        $info->Quality_Approver = $request->Quality_Approver;
        $info->Quality_Approver_Person = $request->Quality_Approver_Person;
         if ($request->Microbiology == "yes") {
             $info->Microbiology = $request->Microbiology;

         }
        //  if ($request->Microbiology_Person) {
        //      $info->Microbiology_Person = implode(',', $request->Microbiology_Person);
        //  } else {
        //      toastr()->warning('CFT reviewers can not be empty');
        //      return back();
        //  }

        if ($request->Microbiology == "yes") {
            $info->Microbiology = $request->Microbiology;
        }
        // if ($request->Microbiology_Person) {
        //     $info->Microbiology_Person = implode(',', $request->Microbiology_Person);
        // } else {
        //     toastr()->warning('CFT reviewers can not be empty');
        //     return back();
        // }

        $info->bd_domestic = $request->bd_domestic;
        $info->Bd_Person = $request->Bd_Person;
        if (!empty($request->additional_attachments)) {
            $files = [];
            if ($request->hasfile('additional_attachments')) {
                foreach ($request->file('additional_attachments') as $file) {
                    $name = "CC" . '-additional_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $info->additional_attachments = json_encode($files);
        }

        $info->save();

        $comments = new GroupComments();
        $comments->cc_id = $openState->id;
        $comments->qa_comments = $request->qa_comments;
        $comments->qa_commentss = $request->qa_commentss;
        $comments->designee_comments = $request->designee_comments;
        $comments->Warehouse_comments = $request->Warehouse_comments;
        $comments->Engineering_comments = $request->Engineering_comments;
        $comments->Instrumentation_comments = $request->Instrumentation_comments;
        $comments->Validation_comments = $request->Validation_comments;
        $comments->Others_comments = $request->Others_comments;
        $comments->Group_comments = $request->Group_comments;
        $comments->cft_comments = $request->cft_comments;

        if (!empty($request->group_attachments)) {
            $files = [];
            if ($request->hasfile('group_attachments')) {
                foreach ($request->file('group_attachments') as $file) {
                    $name = "CC" . '-group_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $comments->group_attachments = json_encode($files);
        }
        if (!empty($request->cft_attchament)) {
            $files = [];
            if ($request->hasfile('cft_attchament')) {
                foreach ($request->file('cft_attchament') as $file) {
                    $name = "CC" . '-cft_attchament' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $comments->cft_attchament = json_encode($files);
        }

        $comments->save();

        $assessment = new RiskAssessment();
        $assessment->cc_id = $openState->id;
        $assessment->risk_identification = $request->risk_identification;
        $assessment->severity = $request->severity;
        $assessment->Occurance = $request->Occurance;
        $assessment->Detection = $request->Detection;
        $assessment->RPN = $request->RPN;
        $assessment->risk_evaluation = $request->risk_evaluation;
        $assessment->migration_action = $request->migration_action;
        $assessment->save();

        $approcomments = new QaApprovalComments();
        $approcomments->cc_id = $openState->id;
        $approcomments->qa_appro_comments = $request->qa_appro_comments;
        $approcomments->feedback = $request->feedback;
        if (!empty($request->tran_attach)) {
            $files = [];
            if ($request->hasfile('tran_attach')) {
                foreach ($request->file('tran_attach') as $file) {
                    $name = "CC" . '-tran_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $approcomments->tran_attach = json_encode($files);
        }

        $approcomments->save();

        $closure = new ChangeClosure();

        $closure->cc_id = $openState->id;

        if (!empty($request->serial_number)) {
            $closure->sno = serialize($request->serial_number);
        }
        if (!empty($request->affected_documents)) {
            $closure->affected_document = serialize($request->affected_documents);
        }
        if (!empty($request->document_name)) {
            $closure->doc_name = serialize($request->document_name);
        }
        if (!empty($request->document_no)) {
            $closure->doc_no = serialize($request->document_no);
        }
        if (!empty($request->version_no)) {
            $closure->version_no = serialize($request->version_no);
        }
        if (!empty($request->implementation_date)) {
            $closure->implementation_date = serialize($request->implementation_date);
        }
        if (!empty($request->new_document_no)) {
            $closure->new_doc_no = serialize($request->new_document_no);
        }
        if (!empty($request->new_version_no)) {
            $closure->new_version_no = serialize($request->new_version_no);
        }

        $closure->qa_closure_comments = $request->qa_closure_comments;
        $closure->Effectiveness_checker = $request->Effectiveness_checker;
        $closure->effective_check = $request->effective_check;
        $closure->effective_check_date = $request->effective_check_date;
        if (!empty($request->attach_list)) {
            $files = [];
            if ($request->hasfile('attach_list')) {
                foreach ($request->file('attach_list') as $file) {
                    $name = "CC" . '-attach_list' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $closure->attach_list = json_encode($files);
        }

        $closure->save();

        //<!------------------------RCMS Documents---------------->






        $history = new RcmDocHistory();
        $history->cc_id = $openState->id;
        $history->activity_type = 'Record Number';
        $history->previous = "Null";
        $history->current = Helpers::getDivisionName(session()->get('division')) . "/CC/" . Helpers::year($openState->created_at) . "/" . str_pad($openState->record, 4, '0', STR_PAD_LEFT);
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $openState->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();



        if (!empty($openState->division_id)) {
            $history = new RcmDocHistory();
            $history->cc_id = $openState->id;
            $history->activity_type = 'Site/Location Code';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName($openState->division_id);
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }


        // if (!empty($openState->department_code)) {
        //     $history = new RcmDocHistory();
        //     $history->cc_id = $openState->id;
        //     $history->activity_type = 'Department Code';
        //     $history->previous = "Null";
        //     $history->current = Helpers::getDivisionName($openState->department_code);
        //     $history->comment = "NA";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $openState->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->save();
        // }


            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Inititator';
            $history->previous = "NULL";
            $history->current = Auth::user()->name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Initiation Date';
            $history->previous = "NULL";
            $history->current = Helpers::getdateFormat($openState->intiation_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

            $departmentName = Helpers::getFullDepartmentName($openState->Initiator_Group);
            if (!empty($departmentName)) {
                $history = new RcmDocHistory;
                $history->cc_id = $openState->id;
                $history->activity_type = 'Initiation Department';
                $history->previous = "NULL";
                $history->current = $departmentName; // Assign the actual value if not empty
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $openState->status;
                $history->change_to = "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->save();
            }

            $initiatorGroupCode = $openState->initiator_group_code;
            if (!empty($initiatorGroupCode)) {
                $history = new RcmDocHistory;
                $history->cc_id = $openState->id;
                $history->activity_type = 'Initiation Department Code';
                $history->previous = "NULL";
                $history->current = $initiatorGroupCode; // Assign the actual value if not empty
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $openState->status;
                $history->change_to = "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->save();
            }



            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Short Description';
            $history->previous = "NULL";
            $history->current = $openState->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        if(!empty($request->assign_to)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Assigned To';
            $history->previous = "NULL";
            $history->current = $openState->assign_to;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->hod_person)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'HOD Person';
            $history->previous = "NULL";
            $history->current = Helpers::getInitiatorName($openState->hod_person);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->risk_assessment_required)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Risk Assessment Required';
            $history->previous = "NULL";
            $history->current = $openState->risk_assessment_required;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->justification)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Justification';
            $history->previous = "NULL";
            $history->current = $openState->risk_assessment_required;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->due_date)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Due Date';
            $history->previous = "NULL";
            $history->current = $openState->due_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($openState->in_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Initial Attachment';
            $history->previous = "NULL";
            $history->current = $openState->in_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($openState->risk_assessment_atch)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Risk Assessment Attachment';
            $history->previous = "NULL";
            $history->current = $openState->risk_assessment_atch;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($openState->HOD_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'HOD Attachments';
            $history->previous = "NULL";
            $history->current = $openState->HOD_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($review->qa_head)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA/CQA Initial Attachments';
            $history->previous = "NULL";
            $history->current = $review->qa_head;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }


        if(!empty($Cft->RA_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'RA Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->RA_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Quality_Assurance_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Quality Assurance Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->Quality_Assurance_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Production_Table_Attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Production Tablet Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->Production_Table_Attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->ProductionLiquid_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Production Liquid Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->ProductionLiquid_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Production_Injection_Attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Production Injection Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->Production_Injection_Attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Store_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Store Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->Store_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Quality_Control_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Quality Control Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->Quality_Control_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->ResearchDevelopment_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Research Development Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->ResearchDevelopment_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Engineering_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Engineering Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->Engineering_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Human_Resource_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Human Resource Attachment';
            $history->previous = "NULL";
            $history->current = $Cft->Human_Resource_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Microbiology_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Microbiology Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->Microbiology_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->RegulatoryAffair_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Regulatory Affair Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->RegulatoryAffair_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->CorporateQualityAssurance_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Corporate Quality Assurance Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->CorporateQualityAssurance_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Environment_Health_Safety_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Safety Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->Environment_Health_Safety_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Information_Technology_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Information Technology Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->Information_Technology_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->ContractGiver_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Contract Giver Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->ContractGiver_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Other1_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Other 1 Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->Other1_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Other2_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Other 2 Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->Other2_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Other3_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Other 3 Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->Other3_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Other4_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Other 4 Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->Other4_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($Cft->Other5_attachment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Other 5 Attachments';
            $history->previous = "NULL";
            $history->current = $Cft->Other5_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($evaluation->qa_eval_attach)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA Evaluation Attachments';
            $history->previous = "NULL";
            $history->current = $evaluation->qa_eval_attach;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->If_Others)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'If Others';
            $history->previous = "NULL";
            $history->current = $openState->If_Others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->Division_Code)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Division Code';
            $history->previous = "NULL";
            $history->current = $openState->Division_Code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->current_practice)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Current Practice';
            $history->previous = "NULL";
            $history->current = $openState->current_practice;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->proposed_change)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Proposed Change';
            $history->previous = "NULL";
            $history->current = $openState->proposed_change;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->other_comment)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Reason for Change';
            $history->previous = "NULL";
            $history->current = $openState->other_comment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        // if(!empty($request->supervisor_comment)){
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $openState->id;
        //     $history->activity_type = 'Supervisor Comments';
        //     $history->previous = "NULL";
        //     $history->current = $openState->supervisor_comment;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $openState->status;
        //     $history->change_to =   "Opened";
        //         $history->change_from = "Initiation";
        //         $history->action_name = 'Create';
        //     $history->save();
        // }

        if(!empty($request->type_chnage)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Type of Change';
            $history->previous = "NULL";
            $history->current = $openState->type_chnage;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->qa_head)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA Attachments';
            $history->previous = "NULL";
            $history->current = $openState->qa_head;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }


        if(!empty($request->qa_comments)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA/CQA Review Comments';
            $history->previous = "NULL";
            $history->current = $openState->qa_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->related_records)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Related Records';
            $history->previous = "NULL";
            $history->current = $openState->related_records;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($evaluation->qa_eval_comments)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA Evaluation Comments';
            $history->previous = "NULL";
            $history->current = $evaluation->qa_eval_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }


        if(!empty($request->qa_eval_attach)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA Evaluation Attachments';
            $history->previous = "NULL";
            $history->current = $openState->qa_eval_attach;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->train_comments)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Training Comments';
            $history->previous = "NULL";
            $history->current = $openState->train_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }


        if(!empty($request->training_required)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Training Required';
            $history->previous = "NULL";
            $history->current = $openState->training_required;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }


        //---------------------------------------//

        // $history = new RcmDocHistory;
        // $history->cc_id = $openState->id;
        // $history->activity_type = 'Is Group Review Required?';
        // $history->previous = "NULL";
        // $history->current = $openState->goup_review;
        // $history->comment = "Not Applicable";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $openState->status;
        // $history->save();

        // $history = new RcmDocHistory;
        // $history->cc_id = $openState->id;
        // $history->activity_type = 'Production';
        // $history->previous = "NULL";
        // $history->current = $openState->Production;
        // $history->comment = "Not Applicable";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $openState->status;
        // $history->save();

        // $history = new RcmDocHistory;
        // $history->cc_id = $openState->id;
        // $history->activity_type = 'Production Person';
        // $history->previous = "NULL";
        // $history->current = $openState->Production_Person;
        // $history->comment = "Not Applicable";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $openState->status;
        // $history->save();

        // $history = new RcmDocHistory;
        // $history->cc_id = $openState->id;
        // $history->activity_type = 'Quality Approver';
        // $history->previous = "NULL";
        // $history->current = $openState->Quality_Approver;
        // $history->comment = "Not Applicable";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $openState->status;
        // $history->save();

        // $history = new RcmDocHistory;
        // $history->cc_id = $openState->id;
        // $history->activity_type = 'Quality Approver Person';
        // $history->previous = "NULL";
        // $history->current = $openState->Quality_Approver_Person;
        // $history->comment = "Not Applicable";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $openState->status;
        // $history->save();

        if(!empty($request->Microbiology)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'CFT Reviewer';
            $history->previous = "NULL";
            $history->current = $openState->Microbiology;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }


        if(!empty($request->Microbiology_Person)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'CFT Reviewer Person';
            $history->previous = "NULL";
            $history->current = $openState->Microbiology_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }



        // $history = new RcmDocHistory;
        // $history->cc_id = $openState->id;
        // $history->activity_type = 'Others';
        // $history->previous = "NULL";
        // $history->current = $openState->bd_domestic;
        // $history->comment = "Not Applicable";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $openState->status;
        // $history->save();

        // $history = new RcmDocHistory;
        // $history->cc_id = $openState->id;
        // $history->activity_type = 'Others Person';
        // $history->previous = "NULL";
        // $history->current = $openState->bd_domesticBd_Person;
        // $history->comment = "Not Applicable";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $openState->status;
        // $history->save();

        // $history = new RcmDocHistory;
        // $history->cc_id = $openState->id;
        // $history->activity_type = 'Additional Attachments';
        // $history->previous = "NULL";
        // $history->current = $openState->additional_attachments;
        // $history->comment = "Not Applicable";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $openState->status;
        // $history->save();


        // ----------------------Group Comments History------------------------

        if(!empty($request->qa_comments)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA Comments';
            $history->previous = "NULL";
            $history->current = $openState->qa_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->designee_comments)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA Head Designee Comments';
            $history->previous = "NULL";
            $history->current = $openState->designee_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->Warehouse_comments)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Warehouse Comments';
            $history->previous = "NULL";
            $history->current = $openState->Warehouse_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->Engineering_comments)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Engineering Comments';
            $history->previous = "NULL";
            $history->current = $openState->Engineering_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->Instrumentation_comments)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Instrumentation Comments';
            $history->previous = "NULL";
            $history->current = $openState->Instrumentation_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->Validation_comments)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Validation Comments';
            $history->previous = "NULL";
            $history->current = $openState->Validation_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->Others_comments)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Others Comments';
            $history->previous = "NULL";
            $history->current = $openState->Others_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->Group_comments)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Comments';
            $history->previous = "NULL";
            $history->current = $openState->Group_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($comments->group_attachments)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Attachments';
            $history->previous = "NULL";
            $history->current = $comments->group_attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->risk_identification)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Risk Identification';
            $history->previous = "NULL";
            $history->current = $openState->risk_identification;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->severity)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Severity';
            $history->previous = "NULL";

            if($request->severity == 1){
                $history->current = "Negligible";
            } elseif($request->severity == 2){
                $history->current = "Minor";
            } elseif($request->severity == 3){
                $history->current = "Moderate";
            }elseif ($request->severity == 4){
                $history->current = "Major";
            }else {
                $history->current = "Fatel";
            }

            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->Occurance)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Occurance';
            $history->previous = "NULL";

            if($request->Occurance == 1){
                $history->current = "Very Likely";
            } elseif($request->Occurance == 2){
                $history->current = "Likely";
            } elseif($request->Occurance == 3){
                $history->current = "Unlikely";
            }elseif ($request->Occurance == 4){
                $history->current = "Rare";
            }else {
                $history->current = "Extremely Unlikely";
            }

            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->Detection)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Detection';
            $history->previous = "NULL";

            if($request->Detection == 1){
                $history->current = "Likely";
            } elseif($request->Detection == 2){
                $history->current = "Unlikely";
            } elseif($request->Detection == 3){
                $history->current = "Rare";
            } else {
                $history->current = "Impossible";
            }

            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->RPN)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'RPN';
            $history->previous = "NULL";
            $history->current = $openState->RPN;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }


        if(!empty($request->risk_evaluation)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Risk Evaluation';
            $history->previous = "NULL";
            $history->current = $openState->risk_evaluation;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->migration_action)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Comments';
            $history->previous = "NULL";
            $history->current = $openState->migration_action;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->qa_appro_comments)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA Approval Commnent';
            $history->previous = "NULL";
            $history->current = $openState->qa_appro_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->feedback)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Feedback';
            $history->previous = "NULL";
            $history->current = $openState->feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($approcomments->tran_attach)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Implementation Verification Attachments';
            $history->previous = "NULL";
            $history->current = $approcomments->tran_attach;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->qa_closure_comments)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA/CQA Closure Comments';
            $history->previous = "NULL";
            $history->current = $openState->qa_closure_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->Effectiveness_checker)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Effectiveness Check';
            $history->previous = "NULL";
            $history->current = $openState->Effectiveness_checker;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->feedbackeffective_check)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Feedback';
            $history->previous = "NULL";
            $history->current = $openState->feedbackeffective_check;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->feedbackeffective_check_date)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Effectiveness Check Date';
            $history->previous = "NULL";
            $history->current = $openState->feedbackeffective_check_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($closure->attach_list)){
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'List Of Attachments';
            $history->previous = "NULL";
            $history->current = $closure->attach_list;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
            $history->save();
        }

        return redirect('rcms/qms-dashboard');
    }

    public function show($id)
    {



        $pre = [
            'DEV' => \App\Models\Deviation::class,
           'AP' => \App\Models\AuditProgram::class,
           'AI' => \App\Models\ActionItem::class,
           'Exte' => \App\Models\extension_new::class,
           'Resam' => \App\Models\Resampling::class,
           'Obse' => \App\Models\Observation::class,
           'RCA' => \App\Models\RootCauseAnalysis::class,
           'RA' => \App\Models\RiskAssessment::class,
           'MR' => \App\Models\ManagementReview::class,
           'EA' => \App\Models\Auditee::class,
           'IA' => \App\Models\InternalAudit::class,
           'CAPA' => \App\Models\Capa::class,
           'CC' => \App\Models\CC::class,
           'ND' => \App\Models\Document::class,
           'Lab' => \App\Models\LabIncident::class,
           'EC' => \App\Models\EffectivenessCheck::class,
           'OOSChe' => \App\Models\OOS::class,
           'OOT' => \App\Models\OOT::class,
           'OOC' => \App\Models\OutOfCalibration::class,
           'MC' => \App\Models\MarketComplaint::class,
           'NC' => \App\Models\NonConformance::class,
           'Incident' => \App\Models\Incident::class,
           'FI' => \App\Models\FailureInvestigation::class,
           'ERRATA' => \App\Models\errata::class,
           'OOSMicr' => \App\Models\OOS_micro::class,
           // Add other models as necessary...
        ];

        // Create an empty collection to store the related records
        $relatedRecords = collect();

        // Loop through each model and get the records, adding the process name to each record
        foreach ($pre as $processName => $modelClass) {
           $records = $modelClass::all()->map(function ($record) use ($processName) {
               $record->process_name = $processName; // Attach the process name to each record
               return $record;
           });

           // Merge the records into the collection
           $relatedRecords = $relatedRecords->merge($records);
        }



        $data = CC::find($id);
        $cftReviewerIds = explode(',', $data->reviewer_person_value);
        $cc_lid = $data->id;
        $data->originator = User::where('id', $data->initiator_id)->value('name');
        $division = CC::where('c_c_s.id', $id)->leftjoin('q_m_s_divisions', 'q_m_s_divisions.id', 'c_c_s.division_id')->first(['name']);
        // $documentDetail = Docdetail::where(['cc_id' => $id, 'identifier' => "DocumentDetail"])->first();
        // $productDetailGrid = json_decode($documentDetail->data, true);

        $affetctedDocumnetDetail = Docdetail::where(['cc_id' => $id, 'identifier' => "AffectedDocDetail"])->first();
        $affetctedDocumnetGrid = json_decode($affetctedDocumnetDetail->data, true);

        $docdetail = Docdetail::where('cc_id', $id)->first();
        $review = Qareview::where('cc_id', $id)->first();
        $cc_cfts = CcCft::where('cc_id', $id)->first();
        $evaluation = Evaluation::where('cc_id', $id)->first();
        $info = AdditionalInformation::where('cc_id', $id)->first();
        $comments = GroupComments::where('cc_id', $id)->first();
        $data1  = ChangeControlComment::where('cc_id', $id)->first();
        // dd($data1);

        // $assessment = RiskAssessment::where('cc_id', $id)->first();
        $approcomments = QaApprovalComments::where('cc_id', $id)->first();
        $closure = ChangeClosure::where('cc_id', $id)->first();
        $hod = User::get();
        $cft = User::get();
        $pre = CC::all();
        $previousRelated = explode(',', $data->related_records);

        $preRiskAssessment = RiskManagement::all();
        $due_date_extension = $data->due_date_extension;


        $due_date_extension = $data->due_date_extension;
        $impactassement   =  table_cc_impactassement::where('cc_id', $id)->get();
        return view('frontend.change-control.CCview', compact(
            'data',
            'docdetail',
            // 'productDetailGrid',
            'cftReviewerIds',
            'data1',
            'affetctedDocumnetGrid',
            'preRiskAssessment',
            'review',
            'evaluation',
            'info',
            'division',
            'cc_cfts',
            'comments',
            'impactassement',
            // 'assessment',
            'approcomments',
            'closure',
            "hod",
            "cft",
            "due_date_extension",
            "cc_lid",
            "pre",
            "previousRelated",
        "relatedRecords"
        ));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());



        $lastDocCft = CcCft::where('cc_id', $id)->first();


        $lastDocument = CC::find($id);
        $openState = CC::find($id);
        $cc_cfts = CcCft::find($id);
        $lastCft = CcCft::where('cc_id', $openState->id)->first();
        $review = Qareview::where('cc_id', $openState->id)->first();
        $Cft = CcCft::where('cc_id', $id)->first();




        $cc_cfts->hod_assessment_comments = $request->hod_assessment_comments;
        $cc_cfts->intial_update_comments = $request->intial_update_comments;
        $cc_cfts->qa_cqa_comments = $request->qa_cqa_comments;
        $cc_cfts->implementation_verification_comments = $request->implementation_verification_comments;
        $cc_cfts->hod_final_review_comment = $request->hod_final_review_comment;

        $Cft->RA_data_person = $request->RA_data_person;

        $Cft->effect_check = $request->effect_check;

        $Cft->QA_CQA_person = $request->QA_CQA_person;
        $Cft->qa_final_comments = $request->qa_final_comments;
        // $Cft->qa_final_attach = $request->qa_final_attach;
        $Cft->ra_tab_comments = $request->ra_tab_comments;



        // if (!empty ($request->hod_final_review_attach)) {
        //     $files = [];
        //     if ($request->hasfile('hod_final_review_attach')) {
        //         foreach ($request->file('hod_final_review_attach') as $file) {
        //             $name = $request->name . 'hod_final_review_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $Cft->hod_final_review_attach = json_encode($files);
        // }


        if (!empty($request->hod_final_review_attach) || !empty($request->deleted_hod_final_review_attach)) {
    $existingFiles = json_decode($Cft->hod_final_review_attach, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_hod_final_review_attach)) {
        $filesToDelete = explode(',', $request->deleted_hod_final_review_attach);
        $existingFiles = array_filter($existingFiles, function ($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new files
    $newFiles = [];
    if ($request->hasFile('hod_final_review_attach')) {
        foreach ($request->file('hod_final_review_attach') as $file) {
            // Generate a unique filename
            $filename = $request->name . '_hod_final_review_attach_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Move the file to the upload directory
            $file->move(public_path('upload/'), $filename);

            // Save only the filename, not the full path
            $newFiles[] = $filename;
        }
    }

    // Merge existing and new files
    $allFiles = array_merge($existingFiles, $newFiles);
    $Cft->hod_final_review_attach = json_encode($allFiles);
}






                        if (!empty($request->RA_attachment_second) || !empty($request->deleted_RA_attachment_second)) {
                            $existingFiles = json_decode($cc_cfts->RA_attachment_second, true) ?? [];

                            // Handle deleted files
                            if (!empty($request->deleted_RA_attachment_second)) {
                                $filesToDelete = explode(',', $request->deleted_RA_attachment_second);
                                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                                    return !in_array($file, $filesToDelete);
                                });
                            }

                            // Handle new files
                            $newFiles = [];
                            if ($request->hasFile('RA_attachment_second')) {
                                foreach ($request->file('RA_attachment_second') as $file) {
                                    $name = $request->name . 'RA_attachment_second' . uniqid() . '.' . $file->getClientOriginalExtension();
                                    $file->move(public_path('upload/'), $name);
                                    $newFiles[] = $name;
                                }
                            }

                            // Merge existing and new files
                            $allFiles = array_merge($existingFiles, $newFiles);
                            $cc_cfts->RA_attachment_second = json_encode($allFiles);
                        }

                        $cc_cfts->update();

                if (!empty($request->qa_final_attach) || !empty($request->deleted_qa_final_attach)) {
                    $existingFiles = json_decode($Cft->qa_final_attach, true) ?? [];

                    // Handle deleted files
                    if (!empty($request->deleted_qa_final_attach)) {
                        $filesToDelete = explode(',', $request->deleted_qa_final_attach);
                        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                            return !in_array($file, $filesToDelete);
                        });
                    }

                    // Handle new files
                    $newFiles = [];
                    if ($request->hasFile('qa_final_attach')) {
                        foreach ($request->file('qa_final_attach') as $file) {
                            $name = $request->name . 'qa_final_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('upload/'), $name);
                            $newFiles[] = $name;
                        }
                    }

                    // Merge existing and new files
                    $allFiles = array_merge($existingFiles, $newFiles);
                    $Cft->qa_final_attach = json_encode($allFiles);
                }

                $Cft->update();






        if (!empty($request->hod_assessment_attachment) || !empty($request->deleted_hod_assessment_attachment)) {
            $existingFiles = json_decode($cc_cfts->hod_assessment_attachment, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_hod_assessment_attachment)) {
                $filesToDelete = explode(',', $request->deleted_hod_assessment_attachment);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('hod_assessment_attachment')) {
                foreach ($request->file('hod_assessment_attachment') as $file) {
                    $name = $request->name . 'hod_assessment_attachment' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $cc_cfts->hod_assessment_attachment = json_encode($allFiles);
        }
        $cc_cfts->save();




        // if (!empty($request->qa_cqa_attach)) {
        //     $files = [];
        //     if ($request->hasfile('qa_cqa_attach')) {
        //         foreach ($request->file('qa_cqa_attach') as $file) {


        //             $name = "CC" . '-qa_cqa_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $cc_cfts->qa_cqa_attach = json_encode($files);
        // }
        // $cc_cfts->save();


        if (!empty($request->qa_cqa_attach) || !empty($request->deleted_qa_cqa_attach)) {
            $existingFiles = json_decode($cc_cfts->qa_cqa_attach, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_qa_cqa_attach)) {
                $filesToDelete = explode(',', $request->deleted_qa_cqa_attach);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('qa_cqa_attach')) {
                foreach ($request->file('qa_cqa_attach') as $file) {
                    $name = $request->name . 'qa_cqa_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $cc_cfts->qa_cqa_attach = json_encode($allFiles);
        }
        $cc_cfts->save();


        // if (!empty($request->intial_update_attach)) {
        //     $files = [];
        //     if ($request->hasfile('intial_update_attach')) {
        //         foreach ($request->file('intial_update_attach') as $file) {


        //             $name = "CC" . '-intial_update_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $cc_cfts->intial_update_attach = json_encode($files);
        // }
        // $cc_cfts->save();

        if (!empty($request->intial_update_attach) || !empty($request->deleted_intial_update_attach)) {
            $existingFiles = json_decode($cc_cfts->intial_update_attach, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_intial_update_attach)) {
                $filesToDelete = explode(',', $request->deleted_intial_update_attach);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('intial_update_attach')) {
                foreach ($request->file('intial_update_attach') as $file) {
                    $name = $request->name . 'intial_update_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $cc_cfts->intial_update_attach = json_encode($allFiles);
        }
       $cc_cfts->save();
        // $openState->initiator_id = Auth::user()->id;
        $openState->Initiator_Group = $request->Initiator_Group;
        $openState->initiator_group_code = $request->initiator_group_code;
        $openState->risk_assessment_required = $request->risk_assessment_required;
        $openState->short_description = $request->short_description;
        $openState->assign_to = $request->assign_to;
        $openState->due_date = $request->due_date;
        //dd($request->related_records)
        if ($request->related_records) {
            $openState->related_records = implode(',', $request->related_records);
        }
        $openState->Microbiology = $request->Microbiology;
        // dd($request->cft_reviewer);
        // if (is_array($request->reviewer_person_value)) {
        //     $openState->reviewer_person_value = implode(',', $request->reviewer_person_value);
        // } else {
        //     $openState->reviewer_person_value = $request->reviewer_person_value;
        // }





        $getId = $lastDocument->reviewer_person_value;
        $reviewer_person_valueIdsArray = explode(',', $getId);
        $reviewer_Names = User::whereIn('id', $reviewer_person_valueIdsArray)->pluck('name')->toArray();
        $lastcft_teamName = implode(', ', $reviewer_Names);


        $openState->reviewer_person_value =  is_array($request->reviewer_person_value) 
        ? implode(',', $request->reviewer_person_value) 
        : $request->reviewer_person_value;
        $capa_teamIdsArray = explode(',', $openState->reviewer_person_value);
        $reviewer_teamNames = User::whereIn('id', $capa_teamIdsArray)->pluck('name')->toArray();
        $Cft_teamNamesString = implode(', ', $reviewer_teamNames);











        if($openState->stage == 3){
            $initiationDate = Carbon::createFromFormat('Y-m-d', $lastDocument->intiation_date);
            $daysToAdd = $request->due_days;
            $dueDate = $initiationDate->addDays($daysToAdd);
            $openState->record_number = $request->record_number;
        }

        $openState->doc_change = $request->doc_change;
        $openState->hod_person = $request->hod_person;
        $openState->If_Others = $request->others;
        $openState->severity_level1 = $request->severity_level1;
        $openState->initiated_through = $request->initiated_through;
        $openState->initiated_through_req = $request->initiated_through_req;
        $openState->repeat = $request->repeat;
        $openState->repeat_nature = $request->repeat_nature;
        $openState->current_practice = $request->current_practice;
        $openState->proposed_change = $request->proposed_change;
        $openState->reason_change = $request->reason_change;
        $openState->other_comment = $request->other_comment;
        $openState->other_comment = $request->other_comment;
        $openState->supervisor_comment = $request->supervisor_comment;
        $openState->qa_comments = $request->qa_comments;
        $openState->justification = $request->justification;



        // $openState->related_records = implode(',', $request->related_records);
      //  $openState->qa_head = $request->qa_head;

        // $openState->qa_eval_comments = $request->qa_eval_comments;
        $openState->qa_eval_attach = $request->qa_eval_attach;
        $openState->due_days = $request->due_days;
        // $openState->training_required = $request->training_required;
         $openState->train_comments = $request->train_comments;

        $openState->Microbiology = $request->Microbiology;
        // if (is_array($request->reviewer_person_value)) {
        //     $openState->reviewer_person_value = implode(',', $request->reviewer_person_value);
        // } else {
        //     $openState->reviewer_person_value = $request->reviewer_person_value; // or handle it as you need
        // }
       // $reviewers = is_array($request->reviewer_person_value) ? $request->reviewer_person_value : explode(',', $request->reviewer_person_value);
        //$openState->reviewer_person_value = implode(',', $reviewers);


        $openState->goup_review = $request->goup_review;
        $openState->Production = $request->Production;
        $openState->Production_Person = $request->Production_Person;
        $openState->Quality_Approver = $request->Quality_Approver;
        $openState->Quality_Approver_Person = $request->Quality_Approver_Person;
        $openState->bd_domestic = $request->bd_domestic;
        // $openState->Bd_Person = $request->Bd_Person;
        // $openState->additional_attachments = json_encode($request->additional_attachments);

        // $openState->cft_comments = $request->cft_comments;
        // $openState->cft_comments = $request->cft_comments;
        // $openState->cft_attchament = json_encode($request->cft_attchament);
        // $openState->qa_commentss = $request->qa_commentss;
        // $openState->designee_comments = $request->designee_comments;
        // $openState->Warehouse_comments = $request->Warehouse_comments;
        // $openState->Engineering_comments = $request->Engineering_comments;
        // $openState->Instrumentation_comments = $request->Instrumentation_comments;
        // $openState->Validation_comments = $request->Validation_comments;
        // $openState->Others_comments = $request->Others_comments;
        // $openState->Group_comments = $request->Group_comments;
        // $openState->group_attachments = json_encode($request->group_attachments);

        $openState->risk_identification = $request->risk_identification;
        $openState->severity = $request->severity;
        $openState->Occurance = $request->Occurance;
        $openState->Detection = $request->Detection;
        $openState->RPN = $request->RPN;
        $openState->risk_evaluation = $request->risk_evaluation;
        $openState->migration_action = $request->migration_action;

        $openState->qa_appro_comments = $request->qa_appro_comments;
        $openState->feedback = $request->feedback;

        $openState->qa_closure_comments = $request->qa_closure_comments;
        $openState->effective_check = $request->effective_check;
        $openState->effective_check_date = $request->effective_check_date;
        $openState->Effectiveness_checker = $request->Effectiveness_checker;
        $openState->effective_check_plan = $request->effective_check_plan;

        $openState->due_date_extension = $request->due_date_extension;
        $openState->HOD_Remarks = $request->HOD_Remarks;

        $files = is_array($request->existinHodFile) ? $request->existinHodFile : null;
        if (!empty($request->HOD_attachment)) {
            if ($openState->HOD_attachment) {
                $existingFiles = json_decode($openState->HOD_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
            }

            if ($request->hasfile('HOD_attachment')) {
                foreach ($request->file('HOD_attachment') as $file) {
                    $name = "CC" . '-HOD_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
        }
        $openState->HOD_attachment = !empty($files) ? json_encode($files) : null;
        $areHODAttachSame = $lastDocument->HOD_attachment == $openState->HOD_attachment;


        $files = is_array($request->existinRiskAssessmentFile) ? $request->existinRiskAssessmentFile : null;
        if (!empty($request->risk_assessment_atch)) {
            if ($openState->risk_assessment_atch) {
                $existingFiles = json_decode($openState->risk_assessment_atch, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
            }

            if ($request->hasfile('risk_assessment_atch')) {
                foreach ($request->file('risk_assessment_atch') as $file) {
                    $name = "CC" . '-risk_assessment_atch' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
        }
        $openState->risk_assessment_atch = !empty($files) ? json_encode($files) : null;
        $areRiskAttachSame = $lastDocument->risk_assessment_atch == $openState->risk_assessment_atch;

        $openState->update();

        if ($request->risk_assessment_related_record) {
            $openState->risk_assessment_related_record = implode(',', $request->risk_assessment_related_record);
        }

        $openState->update();

        $files = is_array($request->existing_initial_files) ? $request->existing_initial_files : null;


        // if (!empty($request->in_attachment)) {
        //     if ($openState->in_attachment) {
        //         $existingFiles = json_decode($openState->in_attachment, true); // Convert to associative array
        //         if (is_array($existingFiles)) {
        //             $files = $existingFiles;
        //         }
        //     }

        //     if ($request->hasfile('in_attachment')) {
        //         foreach ($request->file('in_attachment') as $file) {
        //             $name = $request->name . 'in_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        // }
        // $openState->in_attachment = !empty($files) ? json_encode($files) : null;


        if (!empty($request->in_attachment) || !empty($request->deleted_in_attachment)) {
            $existingFiles = json_decode($openState->in_attachment, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_in_attachment)) {
                $filesToDelete = explode(',', $request->deleted_in_attachment);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('in_attachment')) {
                foreach ($request->file('in_attachment') as $file) {
                    $name = $request->name . 'in_attachment' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $openState->in_attachment = json_encode($allFiles);
        }





        $areInitialAttachSame = $lastDocument->in_attachment == $openState->in_attachment;




        $qa_files = is_array($request->existinQAFile) ? $request->existinQAFile : [];





        if (!empty($request->qa_head) || !empty($request->deleted_qa_head)) {
            $existingFiles = json_decode($openState->qa_head, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_qa_head)) {
                $filesToDelete = explode(',', $request->deleted_qa_head);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('qa_head')) {
                foreach ($request->file('qa_head') as $file) {
                    $name = $request->name . 'qa_head' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $openState->qa_head = json_encode($allFiles);
        }

        $openState->update();





        // $openState->form_progress = 'cft';

        if ($openState->stage == 3 || $openState->stage == 4 ){
                // $form_progress = 'cft';
                // $openState->form_progress = 'cft';
                // $openState->update();
            $Cft = CcCft::where('cc_id', $id)->first();
            if($Cft && $openState->stage == 4 ){
                // return $Cft;
               // return dd($request->Production_Table_Person == null ? $Cft->Production_Table_Person : $request->Production_Table_Person);


                $Cft->RA_Review = $request->RA_Review == null ? $Cft->RA_Review : $request->RA_Review;
                $Cft->RA_person = $request->RA_person == null ? $Cft->RA_person : $request->RA_person;

                $Cft->Production_Injection_Person = $request->Production_Injection_Person == null ? $Cft->Production_Injection_Person : $request->Production_Injection_Person;
                $Cft->Production_Injection_Review = $request->Production_Injection_Review == null ? $Cft->Production_Injection_Review : $request->Production_Injection_Review;

                $Cft->Production_Table_Person = $request->Production_Table_Person == null ? $Cft->Production_Table_Person : $request->Production_Table_Person;
                $Cft->Production_Table_Review = $request->Production_Table_Review == null ? $Cft->Production_Table_Review : $request->Production_Table_Review;

                $Cft->ProductionInjection_person = $request->ProductionInjection_person == null ? $Cft->ProductionInjection_person : $request->ProductionInjection_person;
                $Cft->ProductionInjection_Review = $request->ProductionInjection_Review == null ? $Cft->ProductionInjection_Review : $request->ProductionInjection_Review;

                $Cft->ProductionLiquid_Review = $request->ProductionLiquid_Review == null ? $Cft->ProductionLiquid_Review : $request->ProductionLiquid_Review;
                $Cft->ProductionLiquid_person = $request->ProductionLiquid_person == null ? $Cft->ProductionLiquid_person : $request->ProductionLiquid_person;

                $Cft->Store_person = $request->Store_person == null ? $Cft->Store_person : $request->Store_person;
                $Cft->Store_Review = $request->Store_Review == null ? $Cft->Store_Review : $request->Store_Review;

                $Cft->ResearchDevelopment_person = $request->ResearchDevelopment_person == null ? $Cft->ResearchDevelopment_person : $request->ResearchDevelopment_person;
                $Cft->ResearchDevelopment_Review = $request->ResearchDevelopment_Review == null ? $Cft->ResearchDevelopment_Review : $request->ResearchDevelopment_Review;

                $Cft->Microbiology_person = $request->Microbiology_person == null ? $Cft->Microbiology_person : $request->Microbiology_person;
                $Cft->Microbiology_Review = $request->Microbiology_Review == null ? $Cft->Microbiology_Review : $request->Microbiology_Review;

                $Cft->RegulatoryAffair_person = $request->RegulatoryAffair_person == null ? $Cft->RegulatoryAffair_person : $request->RegulatoryAffair_person;
                $Cft->RegulatoryAffair_Review = $request->RegulatoryAffair_Review == null ? $Cft->RegulatoryAffair_Review : $request->RegulatoryAffair_Review;

                $Cft->CorporateQualityAssurance_person = $request->CorporateQualityAssurance_person == null ? $Cft->CorporateQualityAssurance_person : $request->CorporateQualityAssurance_person;
                $Cft->CorporateQualityAssurance_Review = $request->CorporateQualityAssurance_Review == null ? $Cft->CorporateQualityAssurance_Review : $request->CorporateQualityAssurance_Review;

                $Cft->ContractGiver_person = $request->ContractGiver_person == null ? $Cft->ContractGiver_person : $request->ContractGiver_person;
                $Cft->ContractGiver_Review = $request->ContractGiver_Review == null ? $Cft->ContractGiver_Review : $request->ContractGiver_Review;

                $Cft->Quality_review = $request->Quality_review == null ? $Cft->Quality_review : $request->Quality_review;;
                $Cft->Quality_Control_Person = $request->Quality_Control_Person == null ? $Cft->Quality_Control_Person : $request->Quality_Control_Person;

                $Cft->Quality_Assurance_Review = $request->Quality_Assurance_Review == null ? $Cft->Quality_Assurance_Review : $request->Quality_Assurance_Review;
                $Cft->QualityAssurance_person = $request->QualityAssurance_person == null ? $Cft->QualityAssurance_person : $request->QualityAssurance_person;

                $Cft->Engineering_review = $request->Engineering_review == null ? $Cft->Engineering_review : $request->Engineering_review;
                $Cft->Engineering_person = $request->Engineering_person == null ? $Cft->Engineering_person : $request->Engineering_person;

                $Cft->Environment_Health_review = $request->Environment_Health_review == null ? $Cft->Environment_Health_review : $request->Environment_Health_review;
                $Cft->Environment_Health_Safety_person = $request->Environment_Health_Safety_person == null ? $Cft->Environment_Health_Safety_person : $request->Environment_Health_Safety_person;

                $Cft->Human_Resource_review = $request->Human_Resource_review == null ? $Cft->Human_Resource_review : $request->Human_Resource_review;
                $Cft->Human_Resource_person = $request->Human_Resource_person == null ? $Cft->Human_Resource_person : $request->Human_Resource_person;

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
            }
            else{

                $Cft->RA_Review = $request->RA_Review;
                $Cft->RA_person = $request->RA_person;

                $Cft->Production_Review = $request->Production_Review;
                $Cft->Production_person = $request->Production_person;

                $Cft->Production_Table_Review = $request->Production_Table_Review;
                $Cft->Production_Table_Person = $request->Production_Table_Person;

                $Cft->Production_Injection_Review = $request->Production_Injection_Review;
                $Cft->Production_Injection_Person = $request->Production_Injection_Person;

                $Cft->ProductionLiquid_person = $request->ProductionLiquid_person;
                $Cft->ProductionLiquid_Review = $request->ProductionLiquid_Review;

                $Cft->Store_person = $request->Store_person;
                $Cft->Store_Review = $request->Store_Review;

                $Cft->ResearchDevelopment_person = $request->ResearchDevelopment_person;
                $Cft->ResearchDevelopment_Review = $request->ResearchDevelopment_Review;

                $Cft->Microbiology_person = $request->Microbiology_person;
                $Cft->Microbiology_Review = $request->Microbiology_Review;

                $Cft->RegulatoryAffair_person = $request->RegulatoryAffair_person;
                $Cft->RegulatoryAffair_Review = $request->RegulatoryAffair_Review;

                $Cft->CorporateQualityAssurance_person = $request->CorporateQualityAssurance_person;
                $Cft->CorporateQualityAssurance_Review = $request->CorporateQualityAssurance_Review;

                $Cft->ContractGiver_person = $request->ContractGiver_person;
                $Cft->ContractGiver_Review = $request->ContractGiver_Review;

                $Cft->Quality_review = $request->Quality_review;
                $Cft->Quality_Control_Person = $request->Quality_Control_Person;

                $Cft->Quality_Assurance_Review = $request->Quality_Assurance_Review;
                $Cft->QualityAssurance_person = $request->QualityAssurance_person;

                $Cft->Engineering_review = $request->Engineering_review;
                $Cft->Engineering_person = $request->Engineering_person;

                $Cft->Environment_Health_review = $request->Environment_Health_review;
                $Cft->Environment_Health_Safety_person = $request->Environment_Health_Safety_person;

                $Cft->Human_Resource_review = $request->Human_Resource_review;
                $Cft->Human_Resource_person = $request->Human_Resource_person;

                $Cft->Project_management_review = $request->Project_management_review;
                $Cft->Project_management_person = $request->Project_management_person;

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
            $Cft->RA_assessment = $request->RA_assessment;
            $Cft->RA_feedback = $request->RA_feedback;

            $Cft->Production_Injection_Assessment = $request->Production_Injection_Assessment;
            $Cft->Production_Injection_Feedback = $request->Production_Injection_Feedback;

            $Cft->Production_Table_Assessment = $request->Production_Table_Assessment;
            $Cft->Production_Table_Feedback = $request->Production_Table_Feedback;

            $Cft->ProductionLiquid_feedback = $request->ProductionLiquid_feedback;
            $Cft->ProductionLiquid_assessment = $request->ProductionLiquid_assessment;

            $Cft->Store_feedback = $request->Store_feedback;
            $Cft->Store_assessment = $request->Store_assessment;

            $Cft->ResearchDevelopment_feedback = $request->ResearchDevelopment_feedback;
            $Cft->ResearchDevelopment_assessment = $request->ResearchDevelopment_assessment;

            $Cft->Microbiology_feedback = $request->Microbiology_feedback;
            $Cft->Microbiology_assessment = $request->Microbiology_assessment;

            $Cft->RegulatoryAffair_feedback = $request->RegulatoryAffair_feedback;
            $Cft->RegulatoryAffair_assessment = $request->RegulatoryAffair_assessment;

            $Cft->CorporateQualityAssurance_feedback = $request->CorporateQualityAssurance_feedback;
            $Cft->CorporateQualityAssurance_assessment = $request->CorporateQualityAssurance_assessment;

            $Cft->ContractGiver_feedback = $request->ContractGiver_feedback;
            $Cft->ContractGiver_assessment = $request->ContractGiver_assessment;

            $Cft->Quality_Control_assessment = $request->Quality_Control_assessment;
            $Cft->Quality_Control_feedback = $request->Quality_Control_feedback;

            $Cft->QualityAssurance_assessment = $request->QualityAssurance_assessment;
            $Cft->QualityAssurance_feedback = $request->QualityAssurance_feedback;

            $Cft->Engineering_assessment = $request->Engineering_assessment;
            $Cft->Engineering_feedback = $request->Engineering_feedback;

            $Cft->Health_Safety_assessment = $request->Health_Safety_assessment;
            $Cft->Health_Safety_feedback = $request->Health_Safety_feedback;

            $Cft->Human_Resource_assessment = $request->Human_Resource_assessment;
            $Cft->Human_Resource_feedback = $request->Human_Resource_feedback;

            $Cft->Information_Technology_assessment = $request->Information_Technology_assessment;
            $Cft->Information_Technology_feedback = $request->Information_Technology_feedback;

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


            if (!empty ($request->RA_attachment)) {
                $files = [];
                if ($request->hasfile('RA_attachment')) {
                    foreach ($request->file('RA_attachment') as $file) {
                        $name = $request->name . 'RA_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $Cft->RA_attachment = json_encode($files);
            }
            $areRaAttachSame = $lastDocCft->RA_attachment == $Cft->RA_attachment;

            if (!empty ($request->Quality_Assurance_attachment)) {
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
            $areQAAttachSame = $lastDocCft->Quality_Assurance_attachment == $Cft->Quality_Assurance_attachment;

            if (!empty ($request->Production_Table_Attachment)) {
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
            $arePTAttachSame = $lastDocCft->Production_Table_Attachment == $Cft->Production_Table_Attachment;

            if (!empty ($request->ProductionLiquid_attachment)) {
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
            $arePlAttachSame = $lastDocCft->ProductionLiquid_attachment == $Cft->ProductionLiquid_attachment;

            if (!empty ($request->Production_Injection_Attachment)) {
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
            $arePiAttachSame = $lastDocCft->Production_Injection_Attachment == $Cft->Production_Injection_Attachment;

            if (!empty ($request->Store_attachment)) {
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
            $areStoreAttachSame = $lastDocCft->Store_attachment == $Cft->Store_attachment;

            if (!empty ($request->Quality_Control_attachment)) {
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
            $areQcAttachSame = $lastDocCft->Quality_Control_attachment == $Cft->Quality_Control_attachment;

            if (!empty ($request->ResearchDevelopment_attachment)) {
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
            $areRdAttachSame = $lastDocCft->ResearchDevelopment_attachment == $Cft->ResearchDevelopment_attachment;

            if (!empty ($request->Engineering_attachment)) {
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
            $areEngAttachSame = $lastDocCft->Engineering_attachment == $Cft->Engineering_attachment;

            if (!empty ($request->Human_Resource_attachment)) {
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
            $areHrAttachSame = $lastDocCft->Human_Resource_attachment == $Cft->Human_Resource_attachment;

            if (!empty ($request->Microbiology_attachment)) {
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
            $areMicroAttachSame = $lastDocCft->Microbiology_attachment == $Cft->Microbiology_attachment;

            if (!empty ($request->RegulatoryAffair_attachment)) {
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
            $areRegAffairAttachSame = $lastDocCft->RegulatoryAffair_attachment == $Cft->RegulatoryAffair_attachment;

            if (!empty ($request->CorporateQualityAssurance_attachment)) {
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
            $areCQAAttachSame = $lastDocCft->CorporateQualityAssurance_attachment == $Cft->CorporateQualityAssurance_attachment;

            if (!empty ($request->Environment_Health_Safety_attachment)) {
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
            $areSafetyAttachSame = $lastDocCft->Environment_Health_Safety_attachment == $Cft->Environment_Health_Safety_attachment;

            if (!empty ($request->Information_Technology_attachment)) {
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
            $areItAttachSame = $lastDocCft->Information_Technology_attachment == $Cft->Information_Technology_attachment;

            if (!empty ($request->ContractGiver_attachment)) {
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
            $areContractGiverAttachSame = $lastDocCft->ContractGiver_attachment == $Cft->ContractGiver_attachment;

            if (!empty ($request->Other1_attachment)) {
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
            $areOther1AttachSame = $lastDocCft->Other1_attachment == $Cft->Other1_attachment;

            if (!empty ($request->Other2_attachment)) {
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
            $areOther2AttachSame = $lastDocCft->Other2_attachment == $Cft->Other2_attachment;

            if (!empty ($request->Other3_attachment)) {
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
            $areOther3AttachSame = $lastDocCft->Other3_attachment == $Cft->Other3_attachment;

            if (!empty ($request->Other4_attachment)) {
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
            $areOther4AttachSame = $lastDocCft->Other4_attachment == $Cft->Other4_attachment;

            if (!empty ($request->Other5_attachment)) {
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
            $areOther5AttachSame = $lastDocCft->Other5_attachment == $Cft->Other5_attachment;


            $Cft->save();
            $IsCFTRequired = ChangeControlCftResponse::withoutTrashed()->where(['is_required' => 1, 'cc_id' => $id])->latest()->first();
            $cftUsers = DB::table('cc_cfts')->where(['cc_id' => $id])->first();
            // Define the column names


            $columns = ['Quality_Control_Person', 'QualityAssurance_person', 'Engineering_person', 'Environment_Health_Safety_person', 'Human_Resource_person', 'Information_Technology_person', 'Other1_person', 'Other2_person', 'Other3_person', 'Other4_person', 'Other5_person','RA_person', 'Production_Table_Person','ProductionLiquid_person','Production_Injection_Person','Store_person','ResearchDevelopment_person','Microbiology_person','RegulatoryAffair_person','CorporateQualityAssurance_person','ContractGiver_person'];


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
                                        ['data' => $openState],
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
        }


        $areRaAttachSame = $lastDocCft->RA_attachment == json_encode($request->RA_attachment);
        $areQAAttachSame = $lastDocCft->Quality_Assurance_attachment == json_encode($request->Quality_Assurance_attachment);
        $arePTAttachSame = $lastDocCft->Production_Table_Attachment == json_encode($request->Production_Table_Attachment);
        $arePlAttachSame = $lastDocCft->ProductionLiquid_attachment == json_encode($request->ProductionLiquid_attachment);
        $arePiAttachSame = $lastDocCft->Production_Injection_Attachment == json_encode($request->Production_Injection_Attachment);
        $areStoreAttachSame = $lastDocCft->Store_attachment == json_encode($request->Store_attachment);
        $areQcAttachSame = $lastDocCft->Quality_Control_attachment == json_encode($request->Quality_Control_attachment);
        $areRdAttachSame = $lastDocCft->ResearchDevelopment_attachment == json_encode($request->ResearchDevelopment_attachment);
        $areEngAttachSame = $lastDocCft->Engineering_attachment == json_encode($request->Engineering_attachment);
        $areHrAttachSame = $lastDocCft->Human_Resource_attachment == json_encode($request->Human_Resource_attachment);
        $areMicroAttachSame = $lastDocCft->Microbiology_attachment == json_encode($request->Microbiology_attachment);
        $areRegAffairAttachSame = $lastDocCft->RegulatoryAffair_attachment == json_encode($request->RegulatoryAffair_attachment);
        $areCQAAttachSame = $lastDocCft->CorporateQualityAssurance_attachment == json_encode($request->CorporateQualityAssurance_attachment);
        $areSafetyAttachSame = $lastDocCft->Environment_Health_Safety_attachment == json_encode($request->Environment_Health_Safety_attachment);
        $areItAttachSame = $lastDocCft->Information_Technology_attachment == json_encode($request->Information_Technology_attachment);
        $areContractGiverAttachSame = $lastDocCft->ContractGiver_attachment == json_encode($request->ContractGiver_attachment);
        $areOther1AttachSame = $lastDocCft->Other1_attachment == json_encode($request->Other1_attachment);
        $areOther2AttachSame = $lastDocCft->Other2_attachment == json_encode($request->Other2_attachment);
        $areOther3AttachSame = $lastDocCft->Other3_attachment == json_encode($request->Other3_attachment);
        $areOther4AttachSame = $lastDocCft->Other4_attachment == json_encode($request->Other4_attachment);
        $areOther5AttachSame = $lastDocCft->Other5_attachment == json_encode($request->Other5_attachment);

        // $openState->form_progress = isset($form_progress) ? $form_progress : null;
        $documentDataGrid = DocDetail::where(['cc_id' => $openState->id])->firstOrCreate();
        $documentDataGrid->cc_id = $openState->id;
        $documentDataGrid->current_practice = $request->current_practice;
        $documentDataGrid->proposed_change = $request->proposed_change;
        $documentDataGrid->reason_change = $request->reason_change;
        $documentDataGrid->other_comment = $request->other_comment;
        $documentDataGrid->supervisor_comment = $request->supervisor_comment;
        $documentDataGrid->update();

        $affectedDocumentDetail = Docdetail::where(['cc_id' => $openState->id, 'identifier' =>'AffectedDocDetail'])->firstOrCreate();
        $affectedDocumentDetail->cc_id = $openState->id;
        $affectedDocumentDetail->identifier = 'AffectedDocDetail';
        $affectedDocumentDetail->data = $request->affectedDocuments;
        $affectedDocumentDetail->current_practice = $request->current_practice;
        $affectedDocumentDetail->proposed_change = $request->proposed_change;
        $affectedDocumentDetail->reason_change = $request->reason_change;
        $affectedDocumentDetail->other_comment = $request->other_comment;
        $affectedDocumentDetail->supervisor_comment = $request->supervisor_comment;
        $affectedDocumentDetail->update();

        $lastdocdetail = Docdetail::where('cc_id', $id)->first();
        $docdetail = Docdetail::where('cc_id', $id)->first();

        // $docdetail->current_practice = $request->current_practice;
        // $docdetail->proposed_change = $request->proposed_change;
        // $docdetail->reason_change = $request->reason_change;
        // $docdetail->other_comment = $request->other_comment;
        // $docdetail->supervisor_comment = $request->supervisor_comment;
        // $docdetail->update();


        $lastreview = Qareview::where('cc_id', $id)->first();
        $review = Qareview::where('cc_id', $id)->first();
        $review->cc_id = $openState->id;
        $review->type_chnage = $request->type_chnage;
        $review->qa_comments = $request->qa_review_comments;
        if ($request->related_records) {
            $review->related_records = implode(',', $request->related_records);
        }


        $review->risk_assessment_atch = !empty($files) ? json_encode($files) : null;
        $areQaHeadAttachSame = $lastreview->qa_head == $review->qa_head;
        $review->update();

        $lastevaluation = Evaluation::where('cc_id', $id)->first();

        $evaluation = Evaluation::where('cc_id', $id)->first();
        $evaluation->cc_id = $openState->id;
        $evaluation->qa_eval_comments = $request->qa_eval_comments;
        $evaluation->train_comments = $request->train_comments;

        if ($request->training_required) {
            $evaluation->training_required = $request->training_required;
        }

        if (!empty($request->qa_eval_attach)) {
            $files = [];
            if ($request->hasfile('qa_eval_attach')) {
                foreach ($request->file('qa_eval_attach') as $file) {
                    $name = "CC" . '-qa_eval_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $evaluation->qa_eval_attach = json_encode($files);
        }
        $areQaEvalAttachSame = $lastevaluation->qa_eval_attach == $evaluation->qa_eval_attach;
        $evaluation->update();

        $lastinfo = AdditionalInformation::where('cc_id', $id)->first();
        $info = AdditionalInformation::where('cc_id', $id)->first();
        $info->cc_id = $openState->id;
        $info->goup_review = $request->goup_review;
        $info->Production = $request->Production;
        $info->Production_Person = $request->Production_Person;
        $info->Quality_Approver = $request->Quality_Approver;
        $info->Quality_Approver_Person = $request->Quality_Approver_Person;
         if ($request->Microbiology == "yes") {
             $info->Microbiology = $request->Microbiology;

         }
        //  if ($request->Microbiology_Person) {
        //      $info->Microbiology_Person = implode(',', $request->Microbiology_Person);
        //  } else {
        //      toastr()->warning('CFT reviewers can not be empty');
        //      return back();
        //  }
        if ($request->Microbiology == "yes") {
            $info->Microbiology = $request->Microbiology;
        }
        // if ($request->Microbiology_Person) {
        //     $info->Microbiology_Person = implode(',', $request->Microbiology_Person);
        // } else {
        //     toastr()->warning('CFT reviewers can not be empty');
        //     return back();
        // }
        $info->bd_domestic = $request->bd_domestic;
        $info->Bd_Person = $request->Bd_Person;

        if (!empty($request->additional_attachments)) {
            $files = [];
            if ($request->hasfile('additional_attachments')) {
                foreach ($request->file('additional_attachments') as $file) {
                    $name = "CC" . '-additional_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $info->additional_attachments = json_encode($files);
        }
        $areAdditionalAttachSame = $lastinfo->additional_attachments == $info->additional_attachments;
        $info->update();

        $lastcomments = GroupComments::where('cc_id', $id)->first();
        $comments = GroupComments::where('cc_id', $id)->first();
        $comments->cc_id = $openState->id;
        $comments->qa_comments = $request->qa_comments;
        $comments->qa_commentss = $request->qa_commentss;
        $comments->designee_comments = $request->designee_comments;
        $comments->Warehouse_comments = $request->Warehouse_comments;
        $comments->Engineering_comments = $request->Engineering_comments;
        $comments->Instrumentation_comments = $request->Instrumentation_comments;
        $comments->Validation_comments = $request->Validation_comments;
        $comments->Others_comments = $request->Others_comments;
        $comments->Group_comments = $request->Group_comments;
        $comments->cft_comments = $request->cft_comments;

        if (!empty($request->group_attachments)) {
            $files = [];
            if ($request->hasfile('group_attachments')) {
                foreach ($request->file('group_attachments') as $file) {
                    $name = "CC" . '-group_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $comments->group_attachments = json_encode($files);
        }
        $areGroupAttachSame = $lastcomments->group_attachments == $comments->group_attachments;

        if (!empty($request->cft_attchament)) {
            $files = [];
            if ($request->hasfile('cft_attchament')) {
                foreach ($request->file('cft_attchament') as $file) {
                    $name = "CC" . '-cft_attchament' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $comments->cft_attchament = json_encode($files);
        }
        $areCftAttachSame = $lastcomments->cft_attchament == $comments->cft_attchament;
        $comments->update();

        $assessment = RiskAssessment::where('cc_id', $id)->first();
        $assessment->cc_id = $openState->id;
        $assessment->risk_identification = $request->risk_identification;
        $assessment->severity = $request->severity;
        $assessment->Occurance = $request->Occurance;
        $assessment->Detection = $request->Detection;
        $assessment->RPN = $request->RPN;
        $assessment->risk_evaluation = $request->risk_evaluation;
        $assessment->migration_action = $request->migration_action;

        // if (!empty($request->risk_assessment_atch)) {
        //     $files = [];
        //     if ($request->hasfile('risk_assessment_atch')) {
        //         foreach ($request->file('risk_assessment_atch') as $file) {
        //             $name = "CC" . '-risk_assessment_atch' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $assessment->risk_assessment_atch = json_encode($files);
        // }
        // $assessment->update();

        $lastapprocomments = QaApprovalComments::where('cc_id', $id)->first();
        $approcomments = QaApprovalComments::where('cc_id', $id)->first();
        $approcomments->cc_id = $openState->id;
        $approcomments->qa_appro_comments = $request->qa_appro_comments;
        $approcomments->feedback = $request->feedback;

        // if (!empty($request->tran_attach)) {
        //     $files = [];
        //     if ($request->hasfile('tran_attach')) {
        //         foreach ($request->file('tran_attach') as $file) {
        //             $name = "CC" . '-tran_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $approcomments->tran_attach = json_encode($files);
        // }



        if (!empty($request->tran_attach) || !empty($request->deleted_tran_attach)) {
            $existingFiles = json_decode($approcomments->tran_attach, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_tran_attach)) {
                $filesToDelete = explode(',', $request->deleted_tran_attach);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('tran_attach')) {
                foreach ($request->file('tran_attach') as $file) {
                    $name = $request->name . 'tran_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $approcomments->tran_attach = json_encode($allFiles);
        }


        $areQaApprovalAttachSame = $lastapprocomments->tran_attach == $approcomments->tran_attach;

        $approcomments->update();

        $lastclosure = ChangeClosure::where('cc_id', $id)->first();
        $closure = ChangeClosure::where('cc_id', $id)->first();

        $closure->cc_id = $openState->id;

        if (!empty($request->serial_number)) {
            $closure->sno = serialize($request->serial_number);
        }
        if (!empty($request->affected_documents)) {
            $closure->affected_document = serialize($request->affected_documents);
        }
        if (!empty($request->document_name)) {
            $closure->doc_name = serialize($request->document_name);
        }
        if (!empty($request->document_no)) {
            $closure->doc_no = serialize($request->document_no);
        }
        if (!empty($request->version_no)) {
            $closure->version_no = serialize($request->version_no);
        }
        if (!empty($request->implementation_date)) {
            $closure->implementation_date = serialize($request->implementation_date);
        }
        if (!empty($request->new_document_no)) {
            $closure->new_doc_no = serialize($request->new_document_no);
        }
        if (!empty($request->new_version_no)) {
            $closure->new_version_no = serialize($request->new_version_no);
        }

        $closure->qa_closure_comments = $request->qa_closure_comments;
        $closure->Effectiveness_checker = $request->Effectiveness_checker;
        $closure->effective_check = $request->effective_check;
        $closure->effective_check_date = $request->effective_check_date;


        if (!empty($request->attach_list) || !empty($request->deleted_attach_list)) {
            $existingFiles = json_decode($closure->attach_list, true) ?? [];
        
            // Handle deleted files
            if (!empty($request->deleted_attach_list)) {
                $filesToDelete = explode(',', $request->deleted_attach_list);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }
        
            // Handle new files
            $newFiles = [];
            if ($request->hasFile('attach_list')) {
                foreach ($request->file('attach_list') as $file) {
                    $name = $request->name . 'attach_list' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }
        
            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $closure->attach_list = json_encode($allFiles);
        }
        
        $areChangeClosureAttachSame = $lastclosure->attach_list === $closure->attach_list;

        $closure->update();

        //<!------------------------RCMS Documents---------------->



        if ($lastDocument->short_description != $openState->short_description) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Short Description')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Short Description';
            if($lastDocument->short_description == null){
                $history->previous = "NULL";
            } else{
                $history->previous = $lastDocument->short_description;
            }
            $history->current = $openState->short_description;
            $history->comment = $request->short_desc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }



        if ($lastDocument->risk_assessment_required != $request->risk_assessment_required) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Risk Assessment Required')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Risk Assessment Required';
            $history->previous = $lastDocument->risk_assessment_required;
            $history->current = $openState->risk_assessment_required;
            $history->comment = $request->short_desc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }


        if ($lastDocument->justification != $request->justification) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Justification')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Justification';
            $history->previous = $lastDocument->justification;
            $history->current = $openState->justification;
            $history->comment = $request->short_desc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }



        if ($lastDocument->train_comments != $request->train_comments) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Justification')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Justification';
            $history->previous = $lastDocument->train_comments;
            $history->current = $openState->train_comments;
            $history->comment = $request->short_desc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->hod_person != $request->hod_person) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'HOD Person')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'HOD Person';
            $history->previous = Helpers::getInitiatorName($lastDocument->hod_person);
            $history->current = Helpers::getInitiatorName($openState->hod_person);
            $history->comment = $request->Initiator_Group_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->Initiator_Group != $request->Initiator_Group) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Initiation Department')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Initiation Department';
            $history->previous = Helpers::getFullDepartmentName($lastDocument->Initiator_Group);
            $history->current =Helpers::getFullDepartmentName($openState->Initiator_Group);
            $history->comment = $request->Initiator_Group_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }





        if ($lastDocument->initiator_group_code != $request->initiator_group_code) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Initiation Department Code')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Initiation Department Code';
            $history->previous = $lastDocument->initiator_group_code;
            $history->current = $openState->initiator_group_code;
            $history->comment = $request->Initiator_Group_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->assign_to != $request->assign_to) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Assigned To')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Assigned To';
            $history->previous = $lastDocument->assign_to;
            $history->current = $openState->assign_to;
            $history->comment = $request->assign_to_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->due_date != $request->due_date) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Due Date')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Due Date';
            $history->previous = $lastDocument->due_date;
            $history->current = $openState->due_date;
            $history->comment = $request->due_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->doc_change != $openState->doc_change) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Nature Of Change')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Nature Of Change';
            $history->previous = $lastDocument->doc_change;
            $history->current = $openState->doc_change;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }


        if ($lastDocument->reviewer_person_value != $openState->reviewer_person_value) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'CFT Reviewer Person')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'CFT Reviewer Person';
            $history->previous = $lastcft_teamName;
            $history->current = $Cft_teamNamesString;

            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }



        /************** Attachment Code Start **************/

        if ($areInitialAttachSame != true) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Initial Attachment')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Initial Attachment';
            $history->previous = str_replace(',', ', ',$lastDocument->in_attachment);
            $history->current =str_replace(',', ', ', $openState->in_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areRiskAttachSame != true) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Risk Assessment Attachment')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Risk Assessment Attachment';
            $history->previous = str_replace(',', ', ',$lastDocument->risk_assessment_atch);
            $history->current = str_replace(',', ', ',$openState->risk_assessment_atch);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }




        if ($areHODAttachSame != true) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'HOD Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'HOD Attachments';
            $history->previous = str_replace(',', ', ',$lastDocument->HOD_attachment);
            $history->current = str_replace(',', ', ',$openState->HOD_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areQaHeadAttachSame != true) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'QA/CQA Initial Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA/CQA Initial Attachments';
            $history->previous = str_replace(',', ', ',$lastDocCft->qa_head);
            $history->current = str_replace(',', ', ',$Cft->qa_head);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areRaAttachSame != true && $request->RA_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'RA Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'RA Attachments';
            $history->previous = str_replace(',', ', ',$lastDocCft->RA_attachment);
            $history->current =str_replace(',', ', ', $Cft->RA_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        // if ($areQAAttachSame != true && $request->Quality_Assurance_attachment != null) {
        //     $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        //         ->where('activity_type', 'Quality Assurance Attachments')
        //         ->exists();
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'Quality Assurance Attachments';
        //     $history->previous = $lastDocCft->Quality_Assurance_attachment;
        //     $history->current = json_encode($request->Quality_Assurance_attachment);
        //     $history->comment = "";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
        //     $history->save();
        // }


        if (!$areQAAttachSame && $request->Quality_Assurance_attachment) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Quality Assurance Attachments')
                ->exists();

            $previousAttachments = json_decode($lastDocCft->Quality_Assurance_attachment, true) ?? [];
            $newAttachments = is_array($request->Quality_Assurance_attachment) ? $request->Quality_Assurance_attachment : [];

            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Quality Assurance Attachments';
            $history->previous = json_encode($previousAttachments);
            $history->current = json_encode($newAttachments);
            $history->comment = '';
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = 'Not Applicable';
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';

            $history->save();
        }


        if ($arePTAttachSame != true && $request->Production_Table_Attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Production Tablet/Capsule/Powder Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Attachments';
            $history->previous = $lastDocCft->Production_Table_Attachment;
            $history->current = json_encode($request->Production_Table_Attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($arePlAttachSame != true && $request->ProductionLiquid_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Production Liquid/Ointment Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Attachments';
            $history->previous = $lastDocCft->ProductionLiquid_attachment;
            $history->current = json_encode($request->ProductionLiquid_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($arePiAttachSame != true && $request->Production_Injection_Attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Production Injection Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Production Injection Attachments';
            $history->previous = $lastDocCft->Production_Injection_Attachment;
            $history->current = json_encode($request->Production_Injection_Attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areStoreAttachSame != true && $request->Store_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Store Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Store Attachments';
            $history->previous = $lastDocCft->Store_attachment;
            $history->current = json_encode($request->Store_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areQcAttachSame != true && $request->Quality_Control_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Quality Control Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Quality Control Attachments';
            $history->previous = $lastDocCft->Quality_Control_attachment;
            $history->current = json_encode($request->Quality_Control_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areRdAttachSame != true && $request->ResearchDevelopment_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Research Development Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Research Development Attachments';
            $history->previous = $lastDocCft->ResearchDevelopment_attachment;
            $history->current = json_encode($request->ResearchDevelopment_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areEngAttachSame != true && $request->Engineering_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Engineering Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Engineering Attachments';
            $history->previous = $lastDocCft->Engineering_attachment;
            $history->current = json_encode($request->Engineering_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areHrAttachSame != true && $request->Human_Resource_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Human_Resource_attachment')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Human_Resource_attachment';
            $history->previous = $lastDocCft->Human_Resource_attachment;
            $history->current = json_encode($request->Human_Resource_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areMicroAttachSame != true && $request->Microbiology_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Microbiology Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Microbiology Attachments';
            $history->previous = $lastDocCft->Microbiology_attachment;
            $history->current = json_encode($request->Microbiology_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areRegAffairAttachSame != true && $request->RegulatoryAffair_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Regulatory Affair Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Regulatory Affair Attachments';
            $history->previous = $lastDocCft->RegulatoryAffair_attachment;
            $history->current = json_encode($request->RegulatoryAffair_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areCQAAttachSame != true && $request->CorporateQualityAssurance_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Corporate Quality Assurance Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Attachments';
            $history->previous = $lastDocCft->CorporateQualityAssurance_attachment;
            $history->current = json_encode($request->CorporateQualityAssurance_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areSafetyAttachSame != true && $request->Environment_Health_Safety_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Safety Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Safety Attachments';
            $history->previous = $lastDocCft->Environment_Health_Safety_attachment;
            $history->current = json_encode($request->Environment_Health_Safety_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areItAttachSame != true && $request->Information_Technology_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Information Technology Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Information Technology Attachments';
            $history->previous = $lastDocCft->Information_Technology_attachment;
            $history->current = json_encode($request->Information_Technology_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }






        if ($areContractGiverAttachSame != true && $request->ContractGiver_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Contract Giver Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Contract Giver Attachments';
            $history->previous = $lastDocCft->ContractGiver_attachment;
            $history->current = json_encode($request->ContractGiver_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areOther1AttachSame != true && $request->Other1_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 1 Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 1 Attachments';
            $history->previous = $lastDocCft->Other1_attachment;
            $history->current = json_encode($request->Other1_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areOther2AttachSame != true && $request->Other2_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 2 Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 2 Attachments';
            $history->previous = $lastDocCft->Other2_attachment;
            $history->current = json_encode($request->Other2_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areOther3AttachSame != true && $request->Other3_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 3 Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 3 Attachments';
            $history->previous = $lastDocCft->Other3_attachment;
            $history->current = json_encode($request->Other3_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areOther4AttachSame != true && $request->Other4_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 4 Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 4 Attachments';
            $history->previous = $lastDocCft->Other4_attachment;
            $history->current = json_encode($request->Other4_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areOther5AttachSame != true && $request->Other5_attachment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 5 Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 5 Attachments';
            $history->previous = $lastDocCft->Other5_attachment;
            $history->current = json_encode($request->Other5_attachment);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areQaEvalAttachSame != true) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'QA Evaluation Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA Evaluation Attachments';
            $history->previous = $lastevaluation->qa_eval_attach;
            $history->current = $evaluation->qa_eval_attach;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areQaHeadAttachSame != true) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'QA/CQA Initial Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA/CQA Initial Attachments';
            $history->previous = $lastDocument->qa_head;
            $history->current = $openState->qa_head;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areGroupAttachSame != true) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Attachments';
            $history->previous = $lastcomments->group_attachments;
            $history->current = $comments->group_attachments;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($areQaApprovalAttachSame != true) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Implementation Verification Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Implementation Verification Attachments';
            $history->previous = $lastapprocomments->tran_attach;
            $history->current = $approcomments->tran_attach;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

      

        /************** Attachment Code Ends **************/
        if ($lastDocument->If_Others != $openState->If_Others) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'If Others')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'If Others';
            $history->previous = $lastDocument->If_Others;
            $history->current = $openState->If_Others;
            $history->comment = $request->If_Others_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->Division_Code != $request->Division_Code) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Division Code')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Division Code';
            $history->previous = $lastDocument->Division_Code;
            $history->current = $openState->Division_Code;
            $history->comment = $request->Division_Code_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->initiated_through != $request->initiated_through) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Initiated Through')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Initiated Through';
            $history->previous = $lastDocument->initiated_through;
            $history->current = $openState->initiated_through;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->repeat != $request->repeat) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Repeat')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Repeat';
            $history->previous = $lastDocument->repeat;
            $history->current = $openState->repeat;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->repeat_nature != $request->repeat_nature) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Repeat Nature')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = $lastDocument->repeat_nature;
            $history->current = $openState->repeat_nature;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->others != $openState->others) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other';
            $history->previous = $lastDocument->others;
            $history->current = $openState->others;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->initiated_through_req != $request->initiated_through_req) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Others')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Others';
            $history->previous = $lastDocument->initiated_through_req;
            $history->current = $openState->initiated_through_req;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }


        /************ Risk Assessment ************/

        if ($lastDocument->risk_identification != $openState->risk_identification) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Justification')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Justification';
            $history->previous = $lastDocument->risk_identification;
            $history->current = $openState->risk_identification;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }


        if ($lastDocument->risk_assessment_related_record != $openState->risk_assessment_related_record) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Related Records')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Related Records';
            $history->previous =  str_replace(',', ', ', $lastDocument->risk_assessment_related_record);
            $history->current =  str_replace(',', ', ',  $openState->risk_assessment_related_record);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->severity != $openState->severity) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Change Related To')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Change Related To';
            $history->previous = $lastDocument->severity;
            $history->current = $openState->severity;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        // if ($lastDocument->severity != $request->severity) {
        //     $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        //         ->where('activity_type', 'Severity')
        //         ->exists();
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'Severity';

        //     if ($request->severity == 1) {
        //         $history->previous = "Negligible";
        //     } elseif ($request->severity == 2) {
        //         $history->previous = "Minor";
        //     } elseif ($request->severity == 3) {
        //         $history->previous = "Moderate";
        //     } elseif ($request->severity == 4) {
        //         $history->previous = "Major";
        //     } else {
        //         $history->previous = "Fatel";
        //     }

        //     if ($request->severity == 1) {
        //         $history->current = "Negligible";
        //     } elseif ($request->severity == 2) {
        //         $history->current = "Minor";
        //     } elseif ($request->severity == 3) {
        //         $history->current = "Moderate";
        //     } elseif ($request->severity == 4) {
        //         $history->current = "Major";
        //     } else {
        //         $history->current = "Fatel";
        //     }

        //     $history->comment = "";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
        //     $history->save();
        // }

        if ($lastDocument->Occurance != $openState->Occurance) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Occurance')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Occurance';

            if ($request->Occurance == 1) {
                $history->previous = "Very Likely";
            } elseif ($request->Occurance == 2) {
                $history->previous = "Likely";
            } elseif ($request->Occurance == 3) {
                $history->previous = "Unlikely";
            } elseif ($request->Occurance == 4) {
                $history->previous = "Rare";
            } else {
                $history->previous = "Extremely Unlikely";
            }

            if ($request->Occurance == 1) {
                $history->current = "Very Likely";
            } elseif ($request->Occurance == 2) {
                $history->current = "Likely";
            } elseif ($request->Occurance == 3) {
                $history->current = "Unlikely";
            } elseif ($request->Occurance == 4) {
                $history->current = "Rare";
            } else {
                $history->current = "Extremely Unlikely";
            }

            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->Detection != $openState->Detection) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Detection')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Detection';

            if ($request->Detection == 1) {
                $history->previous = "Likely";
            } elseif ($request->Detection == 2) {
                $history->previous = "Unlikely";
            } elseif ($request->Detection == 3) {
                $history->previous = "Rare";
            } else {
                $history->previous = "Impossible";
            }

            if ($request->Detection == 1) {
                $history->current = "Likely";
            } elseif ($request->Detection == 2) {
                $history->current = "Unlikely";
            } elseif ($request->Detection == 3) {
                $history->current = "Rare";
            } else {
                $history->current = "Impossible";
            }

            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->RPN != $openState->RPN) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'RPN')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'RPN';
            $history->previous = $lastDocument->RPN;
            $history->current = $openState->RPN;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->risk_evaluation != $openState->risk_evaluation) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Risk Evaluation')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Risk Evaluation';
            $history->previous = $lastDocument->risk_evaluation;
            $history->current = $openState->risk_evaluation;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->migration_action != $openState->migration_action) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Comments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'comments';
            $history->previous = $lastDocument->migration_action;
            $history->current = $openState->migration_action;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        /************ Risk Assessment End ************/

        /************ Change Details History ************/

        if ($lastDocument->current_practice != $openState->current_practice) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Current Practice')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Current Practice';
            $history->previous = $lastDocument->current_practice;
            $history->current = $openState->current_practice;
            $history->comment = $request->current_practice_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->proposed_change != $openState->proposed_change) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Proposed Change')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Proposed Change';
            $history->previous = $lastDocument->proposed_change;
            $history->current = $openState->proposed_change;
            $history->comment = $request->proposed_change_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->reason_change != $openState->reason_change) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Reason for Change')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Reason for Change';
            $history->previous = $lastDocument->reason_change;
            $history->current = $openState->reason_change;
            $history->comment = $request->reason_change_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->other_comment != $openState->other_comment) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Any Other Comments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Any Other Comments';
            $history->previous = $lastDocument->other_comment;
            $history->current = $openState->other_comment;
            $history->comment = $request->other_comment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        /************ Change Details History End ************/

        /************ HOD Review ************/
        if ($lastDocument->HOD_Remarks != $openState->HOD_Remarks) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'HOD Remarks')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'HOD Remarks';
            $history->previous = $lastDocument->HOD_Remarks;
            $history->current = $openState->HOD_Remarks;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        /************ HOD Review End ************/

        /************ QA Initial ************/
        if ($lastDocument->due_days != $openState->due_days) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Due Days')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Due Days';
            $history->previous = $lastDocument->due_days;
            $history->current = $openState->due_days;
            $history->comment = $request->type_chnage_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->severity_level1 != $openState->severity_level1) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Classification of Change')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Classification of Change';
            $history->previous = $lastDocument->severity_level1;
            $history->current = $openState->severity_level1;
            $history->comment = $request->type_chnage_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->qa_comments != $request->qa_review_comments && $request->qa_review_comments != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'QA/CQA Initial Review Comments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA/CQA Initial Review Comments';
            $history->previous = $lastDocument->qa_comments;
            $history->current = $request->qa_review_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }


        // if ($lastDocument->qa_head != $request->qa_head) {
        //     $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        //         ->where('activity_type', 'QA Attachments')
        //         ->exists();
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'QA Attachments';
        //     $history->previous = $lastDocument->qa_head;
        //     $history->current = $request->qa_head;
        //     $history->comment = $request->type_chnage_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
        //     $history->save();
        // }


       // Convert $request->qa_head to a string if it is an array
$requestQaHead = is_array($openState->qa_head) ? implode(',', $openState->qa_head) : $openState->qa_head;
// dd($requestQaHead);
// Convert $lastDocument->qa_head to a string if it is an array
$lastDocumentQaHead = is_array($lastDocument->qa_head) ? implode(',', $lastDocument->qa_head) : $lastDocument->qa_head;

if ($lastDocumentQaHead != $requestQaHead && $requestQaHead != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'QA/CQA Initial Attachments')
        ->exists();

    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'QA/CQA Initial Attachments';
    $history->previous = $lastDocumentQaHead;
    $history->current = $requestQaHead;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

        /************ QA Initial End ************/

        /************ CFT Review ************/
        if ($lastCft->RA_Review != $request->RA_Review && $request->RA_Review != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'RA Review Required')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'RA Review Required';
            $history->previous = $lastCft->RA_Review;
            $history->current = $request->RA_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->RA_person != $request->RA_person && $request->RA_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'RA Person')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'RA Person';
            $history->previous = $lastCft->RA_person;
            $history->current = $request->RA_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->RA_assessment != $request->RA_assessment && $request->RA_assessment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'RA Assessment')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'RA Assessment';
            $history->previous = $lastCft->RA_assessment;
            $history->current = $request->RA_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->RA_feedback != $request->RA_feedback && $request->RA_feedback != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'RA Comment')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'RA Comment';
            $history->previous = $lastCft->RA_feedback;
            $history->current = $request->RA_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->RA_by != $request->RA_by && $request->RA_by != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'RA Review By')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'RA Review By';
            $history->previous = $lastCft->RA_by;
            $history->current = $request->RA_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->RA_on != $request->RA_on && $request->RA_on != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'RA Review On')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'RA Review On';
            $history->previous = $lastCft->RA_on;
            $history->current = $request->RA_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        //====================CFT Table ===================
        if ($lastCft->hod_assessment_comments != $request->hod_assessment_comments && $request->hod_assessment_comments != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'HOD Assessment Comments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'HOD Assessment Comments';
            $history->previous = $lastCft->hod_assessment_comments;
            $history->current = $request->hod_assessment_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }



        $lastCftAttachment = is_array($lastCft->intial_update_attach) ? implode(',', $lastCft->intial_update_attach) : $lastCft->intial_update_attach;
            $requestAttachment = is_array($cc_cfts->intial_update_attach) ? implode(',', $cc_cfts->intial_update_attach) : $cc_cfts->intial_update_attach;

            if ($lastCftAttachment != $requestAttachment && $cc_cfts->intial_update_attach != null) {
                $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                    ->where('activity_type', 'Initiator Update Attachments')
                    ->exists();

                $history = new RcmDocHistory;
                $history->cc_id = $id;
                $history->activity_type = 'Initiator Update Attachments';
                $history->previous = $lastCftAttachment;
                $history->current = $requestAttachment;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Not Applicable";
                $history->change_from = $lastDocument->status;
                $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
                $history->save();
}


        $lastCftAttachment = is_array($lastCft->hod_assessment_attachment) ? implode(',', $lastCft->hod_assessment_attachment) : $lastCft->hod_assessment_attachment;
            $requestAttachment = is_array($cc_cfts->hod_assessment_attachment) ? implode(',', $cc_cfts->hod_assessment_attachment) : $cc_cfts->hod_assessment_attachment;

            if ($lastCftAttachment != $requestAttachment && $cc_cfts->hod_assessment_attachment != null) {
                $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                    ->where('activity_type', 'HOD Assessment Attachments')
                    ->exists();

                $history = new RcmDocHistory;
                $history->cc_id = $id;
                $history->activity_type = 'HOD Assessment Attachments';
                $history->previous = $lastCftAttachment;
                $history->current = $requestAttachment;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Not Applicable";
                $history->change_from = $lastDocument->status;
                $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
                $history->save();
}

        if ($lastCft->RA_data_person != $request->RA_data_person && $request->RA_data_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'RA Approval required')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'RA Approval required';
            $history->previous = $lastCft->RA_data_person;
            $history->current = $request->RA_data_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }


        if ($lastCft->effect_check != $request->effect_check && $request->effect_check != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Effectivess Check Required')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Effectivess Check Required';
            $history->previous = $lastCft->effect_check;
            $history->current = $request->effect_check;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->QA_CQA_person != $request->QA_CQA_person && $request->QA_CQA_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'QA/CQA Head Approval Person')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA/CQA Head Approval Person';
            $history->previous = $lastCft->QA_CQA_person;
            $history->current = $request->QA_CQA_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->qa_final_comments != $request->qa_final_comments && $request->qa_final_comments != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'QA/CQA Final Review Comments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA/CQA Final Review Comments';
            $history->previous = $lastCft->qa_final_comments;
            $history->current = $request->qa_final_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->qa_final_attach != $Cft->qa_final_attach && $Cft->qa_final_attach != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'QA/CQA Final Review Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA/CQA Final Review Attachments';
            $history->previous = $lastCft->qa_final_attach;
            $history->current = $Cft->qa_final_attach;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }


        // if ($review->qa_comments != $request->qa_review_comments && $request->qa_review_comments != null) {
        //     $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        //         ->where('activity_type', 'QA/CQA Initial Review Comments')
        //         ->exists();
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'QA/CQA Initial Review Comments';
        //     $history->previous = $review->qa_comments;
        //     $history->current = $request->qa_review_comments;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
        //     $history->save();
        // }

        if ($lastDocument->ra_tab_comments != $Cft->ra_tab_comments && $Cft->ra_tab_comments != null) {
            // Check if an identical entry already exists to avoid repeating
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'RA Approval Comment')
                ->where('previous', $lastDocument->ra_tab_comments)
                ->where('current', $Cft->ra_tab_comments)
                ->exists();
        
            // Only add a new entry if an identical entry does not already exist
            if (!$lastDocumentAuditTrail) {
                $history = new RcmDocHistory;
                $history->cc_id = $id;
                $history->activity_type = 'RA Approval Comment';
                $history->previous = $lastDocument->ra_tab_comments;
                $history->current = $Cft->ra_tab_comments;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Not Applicable";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'New';
                $history->save();
            }
        }
        


        if ($lastCft->RA_attachment_second != $cc_cfts->RA_attachment_second && $cc_cfts->RA_attachment_second != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'RA Attachments')
                ->exists();

            // Convert array to a readable string format if necessary
            $previousAttachment = is_array($lastCft->RA_attachment_second) ? implode(", ", $lastCft->RA_attachment_second) : $lastCft->RA_attachment_second;
            $currentAttachment = is_array($cc_cfts->RA_attachment_second) ? implode(", ", $cc_cfts->RA_attachment_second) : $cc_cfts->RA_attachment_second;

            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'RA Attachments';
            $history->previous = $previousAttachment;
            $history->current = $currentAttachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if (is_array($request->qa_cqa_comments)) {
            $request->qa_cqa_comments = implode(', ', $request->qa_cqa_comments);
        }
        if ($lastCft->qa_cqa_comments != $request->qa_cqa_comments && $request->qa_cqa_comments != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'QA/CQA Head/Manager Designee Approval Comments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA/CQA Head/Manager Designee Approval Comments';
            $history->previous = is_array($lastCft->qa_cqa_comments) ? implode(', ', $lastCft->qa_cqa_comments) : $lastCft->qa_cqa_comments;
            $history->current = $request->qa_cqa_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if (is_array($request->qa_cqa_attach)) {
            $request->qa_cqa_attach = implode(', ', $request->qa_cqa_attach);
        }
        if ($lastCft->qa_cqa_attach != $cc_cfts->qa_cqa_attach && $cc_cfts->qa_cqa_attach != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'QA/CQA Head/Manager Designee Approval Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA/CQA Head/Manager Designee Approval Attachments';
            $history->previous = is_array($lastCft->qa_cqa_attach) ? implode(', ', $lastCft->qa_cqa_attach) : $lastCft->qa_cqa_attach;
            $history->current = $cc_cfts->qa_cqa_attach;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        /*************** Quality Assurance ***************/
        if ($lastCft->Quality_Assurance_Review != $request->Quality_Assurance_Review && $request->Quality_Assurance_Review != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Quality Assurance Review Required')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Quality Assurance Review Required';
            $history->previous = $lastCft->Quality_Assurance_Review;
            $history->current = $request->Quality_Assurance_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->QualityAssurance_person != $request->QualityAssurance_person && $request->QualityAssurance_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Quality Assurance Person')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Quality Assurance Person';
            $history->previous = $lastCft->QualityAssurance_person;
            $history->current = $request->QualityAssurance_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->QualityAssurance_assessment != $request->QualityAssurance_assessment && $request->QualityAssurance_assessment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Quality Assurance Assessment')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Quality Assurance Assessment';
            $history->previous = $lastCft->QualityAssurance_assessment;
            $history->current = $request->QualityAssurance_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->QualityAssurance_feedback != $request->QualityAssurance_feedback && $request->QualityAssurance_feedback != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Quality Assurance Feedback')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Quality Assurance Feedback';
            $history->previous = $lastCft->QualityAssurance_feedback;
            $history->current = $request->QualityAssurance_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->QualityAssurance_by != $request->QualityAssurance_by && $request->QualityAssurance_by != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Quality Assurance Review Completed By')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Quality Assurance Review Completed By';
            $history->previous = $lastCft->QualityAssurance_by;
            $history->current = $request->QualityAssurance_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->QualityAssurance_on != $request->QualityAssurance_on && $request->QualityAssurance_on != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Quality Assurance Review Completed On')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Quality Assurance Review Completed On';
            $history->previous = $lastCft->QualityAssurance_on;
            $history->current = $request->QualityAssurance_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        /*************** Production Tablet ***************/
        if ($lastCft->Production_Table_Review != $request->Production_Table_Review && $request->Production_Table_Review != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Production Tablet/Capsule/Powder Required')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Required';
            $history->previous = $lastCft->Production_Table_Review;
            $history->current = $request->Production_Table_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Production_Table_Person != $request->Production_Table_Person && $request->Production_Table_Person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Production Tablet/Capsule/Powder Person')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Person';
            $history->previous = $lastCft->Production_Table_Person;
            $history->current = $request->Production_Table_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Production_Table_Assessment != $request->Production_Table_Assessment && $request->Production_Table_Assessment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Impact Assessment(By Production (Tablet/Capsule/Powder))')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Impact Assessment(By Production (Tablet/Capsule/Powder))';
            $history->previous = $lastCft->Production_Table_Assessment;
            $history->current = $request->Production_Table_Assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Production_Table_Feedback != $request->Production_Table_Feedback && $request->Production_Table_Feedback != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Production Tablet/Capsule/Powder Feedback')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Feedback';
            $history->previous = $lastCft->Production_Table_Feedback;
            $history->current = $request->Production_Table_Feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Production_Table_By != $request->Production_Table_By && $request->Production_Table_By != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Production Tablet/Capsule/Powder Completed By')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Completed By';
            $history->previous = $lastCft->Production_Table_By;
            $history->current = $request->Production_Table_By;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Production_Table_On != $request->Production_Table_On && $request->Production_Table_On != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Production Tablet/Capsule/Powder Completed On')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Completed On';
            $history->previous = $lastCft->Production_Table_On;
            $history->current = $request->Production_Table_On;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        /*************** Production Liquid ***************/
        if ($lastCft->ProductionLiquid_Review != $request->ProductionLiquid_Review && $request->ProductionLiquid_Review != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Production Liquid/Ointment Required')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Required';
            $history->previous = $lastCft->ProductionLiquid_Review;
            $history->current = $request->ProductionLiquid_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->ProductionLiquid_person != $request->ProductionLiquid_person && $request->ProductionLiquid_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Production Liquid/Ointment Person')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Person';
            $history->previous = $lastCft->ProductionLiquid_person;
            $history->current = $request->ProductionLiquid_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->ProductionLiquid_assessment != $request->ProductionLiquid_assessment && $request->ProductionLiquid_assessment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Impact Assessment (By Production Liquid)')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Impact Assessment (By Production Liquid)';
            $history->previous = $lastCft->ProductionLiquid_assessment;
            $history->current = $request->ProductionLiquid_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->ProductionLiquid_feedback != $request->ProductionLiquid_feedback && $request->ProductionLiquid_feedback != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Production Liquid/Ointment Feedback')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Feedback';
            $history->previous = $lastCft->ProductionLiquid_feedback;
            $history->current = $request->ProductionLiquid_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->ProductionLiquid_by != $request->ProductionLiquid_by && $request->ProductionLiquid_by != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Production Liquid/Ointment Completed By')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Completed By';
            $history->previous = $lastCft->ProductionLiquid_by;
            $history->current = $request->ProductionLiquid_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->ProductionLiquid_on != $Cft->ProductionLiquid_on && $request->ProductionLiquid_on != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Production Liquid/Ointment Completed On')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Completed On';
            $history->previous = $lastCft->ProductionLiquid_on;
            $history->current = $Cft->ProductionLiquid_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }


        /*************** Production Injection ***************/
        // Production Injection
if ($lastCft->Production_Injection_Review != $request->Production_Injection_Review && $request->Production_Injection_Review != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Production Injection Review Required')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Production Injection Review Required';
    $history->previous = $lastCft->Production_Injection_Review;
    $history->current = $request->Production_Injection_Review;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Production_Injection_Person != $request->Production_Injection_Person && $request->Production_Injection_Person != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Production Injection Person')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Production Injection Person';
    $history->previous = $lastCft->Production_Injection_Person;
    $history->current = $request->Production_Injection_Person;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Production_Injection_Assessment != $request->Production_Injection_Assessment && $request->Production_Injection_Assessment != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Production Injection Assessment')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Production Injection Assessment';
    $history->previous = $lastCft->Production_Injection_Assessment;
    $history->current = $request->Production_Injection_Assessment;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Production_Injection_Feedback != $request->Production_Injection_Feedback && $request->Production_Injection_Feedback != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Production Injection Feedback')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Production Injection Feedback';
    $history->previous = $lastCft->Production_Injection_Feedback;
    $history->current = $request->Production_Injection_Feedback;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Production_Injection_By != $request->Production_Injection_By && $request->Production_Injection_By != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Production Injection Review By')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Production Injection Review By';
    $history->previous = $lastCft->Production_Injection_By;
    $history->current = $request->Production_Injection_By;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Production_Injection_On != $Cft->Production_Injection_On && $request->Production_Injection_On != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Production Injection On')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Production Injection On';
    $history->previous = $lastCft->Production_Injection_On;
    $history->current = $Cft->Production_Injection_On;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

// Stores
if ($lastCft->Store_Review != $request->Store_Review && $request->Store_Review != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Store Review Required')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Store Review Required';
    $history->previous = $lastCft->Store_Review;
    $history->current = $request->Store_Review;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Store_person != $request->Store_person && $request->Store_person != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Store Person')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Store Person';
    $history->previous = $lastCft->Store_person;
    $history->current = $request->Store_person;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Store_assessment != $request->Store_assessment && $request->Store_assessment != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Store Assessment')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Store Assessment';
    $history->previous = $lastCft->Store_assessment;
    $history->current = $request->Store_assessment;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Store_feedback != $request->Store_feedback && $request->Store_feedback != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Store Feedback')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Store Feedback';
    $history->previous = $lastCft->Store_feedback;
    $history->current = $request->Store_feedback;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Store_by != $request->Store_by && $request->Store_by != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Store Review By')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Store Review By';
    $history->previous = $lastCft->Store_by;
    $history->current = $request->Store_by;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Store_on != $Cft->Store_on && $request->Store_on != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Store Review On')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Store Review On';
    $history->previous = $lastCft->Store_on;
    $history->current = $Cft->Store_on;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

// Quality Control
if ($lastCft->Quality_review != $request->Quality_review && $request->Quality_review != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Quality Control Required')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Quality Control Required';
    $history->previous = $lastCft->Quality_review;
    $history->current = $request->Quality_review;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Quality_Control_Person != $request->Quality_Control_Person && $request->Quality_Control_Person != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Quality Control Person')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Quality Control Person';
    $history->previous = $lastCft->Quality_Control_Person;
    $history->current = $request->Quality_Control_Person;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Quality_Control_assessment != $request->Quality_Control_assessment && $request->Quality_Control_assessment != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Quality Control Assessment')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Quality Control Assessment';
    $history->previous = $lastCft->Quality_Control_assessment;
    $history->current = $request->Quality_Control_assessment;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Quality_Control_feedback != $request->Quality_Control_feedback && $request->Quality_Control_feedback != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Quality Control Feedback')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Quality Control Feedback';
    $history->previous = $lastCft->Quality_Control_feedback;
    $history->current = $request->Quality_Control_feedback;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Quality_Control_by != $request->Quality_Control_by && $request->Quality_Control_by != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Quality Control By')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Quality Control By';
    $history->previous = $lastCft->Quality_Control_by;
    $history->current = $request->Quality_Control_by;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Quality_Control_on != $Cft->Quality_Control_on && $request->Quality_Control_on != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Quality Control On')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Quality Control On';
    $history->previous = $lastCft->Quality_Control_on;
    $history->current = $Cft->Quality_Control_on;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

// Research & Development
if ($lastCft->ResearchDevelopment_Review != $request->ResearchDevelopment_Review && $request->ResearchDevelopment_Review != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Research & Development Required')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Research & Development Required';
    $history->previous = $lastCft->ResearchDevelopment_Review;
    $history->current = $request->ResearchDevelopment_Review;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->ResearchDevelopment_person != $request->ResearchDevelopment_person && $request->ResearchDevelopment_person != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Research & Development Person')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Research & Development Person';
    $history->previous = $lastCft->ResearchDevelopment_person;
    $history->current = $request->ResearchDevelopment_person;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->ResearchDevelopment_assessment != $request->ResearchDevelopment_assessment && $request->ResearchDevelopment_assessment != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Research & Development Assessment')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Research & Development Assessment';
    $history->previous = $lastCft->ResearchDevelopment_assessment;
    $history->current = $request->ResearchDevelopment_assessment;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->ResearchDevelopment_feedback != $request->ResearchDevelopment_feedback && $request->ResearchDevelopment_feedback != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Research & Development Feedback')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Research & Development Feedback';
    $history->previous = $lastCft->ResearchDevelopment_feedback;
    $history->current = $request->ResearchDevelopment_feedback;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->ResearchDevelopment_by != $request->ResearchDevelopment_by && $request->ResearchDevelopment_by != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Research & Development By')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Research & Development By';
    $history->previous = $lastCft->ResearchDevelopment_by;
    $history->current = $request->ResearchDevelopment_by;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->ResearchDevelopment_on != $Cft->ResearchDevelopment_on && $request->ResearchDevelopment_on != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Research & Development On')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Research & Development On';
    $history->previous = $lastCft->ResearchDevelopment_on;
    $history->current = $Cft->ResearchDevelopment_on;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

        /*************** Engineering ***************/
        // Engineering
if ($lastCft->Engineering_review != $request->Engineering_review && $request->Engineering_review != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Engineering Review Required')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Engineering Review Required';
    $history->previous = $lastCft->Engineering_review;
    $history->current = $request->Engineering_review;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Engineering_person != $request->Engineering_person && $request->Engineering_person != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Engineering Person')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Engineering Person';
    $history->previous = $lastCft->Engineering_person;
    $history->current = $request->Engineering_person;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Engineering_assessment != $request->Engineering_assessment && $request->Engineering_assessment != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Engineering Assessment')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Engineering Assessment';
    $history->previous = $lastCft->Engineering_assessment;
    $history->current = $request->Engineering_assessment;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Engineering_feedback != $request->Engineering_feedback && $request->Engineering_feedback != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Engineering Feedback')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Engineering Feedback';
    $history->previous = $lastCft->Engineering_feedback;
    $history->current = $request->Engineering_feedback;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Engineering_by != $request->Engineering_by && $request->Engineering_by != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Engineering Review By')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Engineering Review By';
    $history->previous = $lastCft->Engineering_by;
    $history->current = $request->Engineering_by;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Engineering_on != $Cft->Engineering_on && $request->Engineering_on != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Engineering Review On')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Engineering Review On';
    $history->previous = $lastCft->Engineering_on;
    $history->current = $Cft->Engineering_on;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

// Human Resource
if ($lastCft->Human_Resource_review != $request->Human_Resource_review && $request->Human_Resource_review != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Human Resource Review Required')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Human Resource Review Required';
    $history->previous = $lastCft->Human_Resource_review;
    $history->current = $request->Human_Resource_review;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Human_Resource_person != $request->Human_Resource_person && $request->Human_Resource_person != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Human Resource Person')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Human Resource Person';
    $history->previous = $lastCft->Human_Resource_person;
    $history->current = $request->Human_Resource_person;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Human_Resource_assessment != $request->Human_Resource_assessment && $request->Human_Resource_assessment != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Human Resource Assessment')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Human Resource Assessment';
    $history->previous = $lastCft->Human_Resource_assessment;
    $history->current = $request->Human_Resource_assessment;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Human_Resource_feedback != $request->Human_Resource_feedback && $request->Human_Resource_feedback != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Human Resource Feedback')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Human Resource Feedback';
    $history->previous = $lastCft->Human_Resource_feedback;
    $history->current = $request->Human_Resource_feedback;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Human_Resource_by != $request->Human_Resource_by && $request->Human_Resource_by != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Human Resource Review By')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Human Resource Review By';
    $history->previous = $lastCft->Human_Resource_by;
    $history->current = $request->Human_Resource_by;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Human_Resource_on != $Cft->Human_Resource_on && $request->Human_Resource_on != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Human Resource Review On')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Human Resource Review On';
    $history->previous = $lastCft->Human_Resource_on;
    $history->current = $Cft->Human_Resource_on;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

// Microbiology
if ($lastCft->Microbiology_Review != $request->Microbiology_Review && $request->Microbiology_Review != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Microbiology Review Required')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Microbiology Review Required';
    $history->previous = $lastCft->Microbiology_Review;
    $history->current = $request->Microbiology_Review;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Microbiology_person != $request->Microbiology_person && $request->Microbiology_person != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Microbiology Person')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Microbiology Person';
    $history->previous = $lastCft->Microbiology_person;
    $history->current = $request->Microbiology_person;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Microbiology_assessment != $request->Microbiology_assessment && $request->Microbiology_assessment != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Microbiology Assessment')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Microbiology Assessment';
    $history->previous = $lastCft->Microbiology_assessment;
    $history->current = $request->Microbiology_assessment;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Microbiology_feedback != $request->Microbiology_feedback && $request->Microbiology_feedback != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Microbiology Feedback')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Microbiology Feedback';
    $history->previous = $lastCft->Microbiology_feedback;
    $history->current = $request->Microbiology_feedback;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Microbiology_by != $request->Microbiology_by && $request->Microbiology_by != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Microbiology Review By')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Microbiology Review By';
    $history->previous = $lastCft->Microbiology_by;
    $history->current = $request->Microbiology_by;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->Microbiology_on != $Cft->Microbiology_on && $request->Microbiology_on != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Microbiology Review On')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Microbiology Review On';
    $history->previous = $lastCft->Microbiology_on;
    $history->current = $Cft->Microbiology_on;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

// Regulatory Affair
if ($lastCft->RegulatoryAffair_Review != $request->RegulatoryAffair_Review && $request->RegulatoryAffair_Review != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Regulatory Affair Review Required')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Regulatory Affair Review Required';
    $history->previous = $lastCft->RegulatoryAffair_Review;
    $history->current = $request->RegulatoryAffair_Review;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->RegulatoryAffair_person != $request->RegulatoryAffair_person && $request->RegulatoryAffair_person != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Regulatory Affair Person')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Regulatory Affair Person';
    $history->previous = $lastCft->RegulatoryAffair_person;
    $history->current = $request->RegulatoryAffair_person;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->RegulatoryAffair_assessment != $request->RegulatoryAffair_assessment && $request->RegulatoryAffair_assessment != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Regulatory Affair Assessment')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Regulatory Affair Assessment';
    $history->previous = $lastCft->RegulatoryAffair_assessment;
    $history->current = $request->RegulatoryAffair_assessment;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->RegulatoryAffair_feedback != $request->RegulatoryAffair_feedback && $request->RegulatoryAffair_feedback != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Regulatory Affair Feedback')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Regulatory Affair Feedback';
    $history->previous = $lastCft->RegulatoryAffair_feedback;
    $history->current = $request->RegulatoryAffair_feedback;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->RegulatoryAffair_by != $request->RegulatoryAffair_by && $request->RegulatoryAffair_by != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Regulatory Affair Review By')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Regulatory Affair Review By';
    $history->previous = $lastCft->RegulatoryAffair_by;
    $history->current = $request->RegulatoryAffair_by;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

if ($lastCft->RegulatoryAffair_on != $Cft->RegulatoryAffair_on && $request->RegulatoryAffair_on != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Regulatory Affair Review On')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Regulatory Affair Review On';
    $history->previous = $lastCft->RegulatoryAffair_on;
    $history->current = $Cft->RegulatoryAffair_on;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}





        /*************** Corporate Quality Assurance ***************/
        if ($lastCft->CorporateQualityAssurance_Review != $request->CorporateQualityAssurance_Review && $request->CorporateQualityAssurance_Review != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Corporate Quality Assurance Review Required')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_person != $request->CorporateQualityAssurance_person && $request->CorporateQualityAssurance_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Corporate Quality Assurance Person')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_assessment != $request->CorporateQualityAssurance_assessment && $request->CorporateQualityAssurance_assessment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Corporate Quality Assurance Assessment')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_feedback != $request->CorporateQualityAssurance_feedback && $request->CorporateQualityAssurance_feedback != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Corporate Quality Assurance Feedback')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_by != $request->CorporateQualityAssurance_by && $request->CorporateQualityAssurance_by != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Corporate Quality Assurance Review By')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Review By';
            $history->previous = $lastCft->CorporateQualityAssurance_by;
            $history->current = $request->CorporateQualityAssurance_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_on != $Cft->CorporateQualityAssurance_on && $request->CorporateQualityAssurance_on != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Corporate Quality Assurance Review On')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Review On';
            $history->previous = $lastCft->CorporateQualityAssurance_on;
            $history->current = $Cft->CorporateQualityAssurance_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        /*************** Safety ***************/
        if ($lastCft->Environment_Health_review != $request->Environment_Health_review && $request->Environment_Health_review != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Safety Review Required')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Environment_Health_Safety_person != $request->Environment_Health_Safety_person && $request->Environment_Health_Safety_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Safety Person')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Health_Safety_assessment != $request->Health_Safety_assessment && $request->Health_Safety_assessment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Safety Assessment')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Health_Safety_feedback != $request->Health_Safety_feedback && $request->Health_Safety_feedback != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Safety Feedback')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Environment_Health_Safety_by != $request->Environment_Health_Safety_by && $request->Environment_Health_Safety_by != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Safety Review By')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Environment_Health_Safety_on != $Cft->Environment_Health_Safety_on && $request->Environment_Health_Safety_on != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Safety Review On')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Safety Review On';
            $history->previous = $lastCft->Environment_Health_Safety_on;
            $history->current = $Cft->Environment_Health_Safety_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        /*************** Information Technology ***************/
        if ($lastCft->Information_Technology_review != $request->Information_Technology_review && $request->Information_Technology_review != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Information Technology Review Required')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Information Technology Review Required';
            $history->previous = $lastCft->Information_Technology_review;
            $history->current = $request->Information_Technology_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Information_Technology_person != $request->Information_Technology_person && $request->Information_Technology_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Information Technology Person')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Information Technology Person';
            $history->previous = $lastCft->Information_Technology_person;
            $history->current = $request->Information_Technology_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Information_Technology_assessment != $request->Information_Technology_assessment && $request->Information_Technology_assessment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Information Technology Assessment')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Information Technology Assessment';
            $history->previous = $lastCft->Information_Technology_assessment;
            $history->current = $request->Information_Technology_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Information_Technology_feedback != $request->Information_Technology_feedback && $request->Information_Technology_feedback != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Information Technology Feedback')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Information Technology Feedback';
            $history->previous = $lastCft->Information_Technology_feedback;
            $history->current = $request->Information_Technology_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Information_Technology_by != $request->Information_Technology_by && $request->Information_Technology_by != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Information Technology Review By')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Information Technology Review By';
            $history->previous = $lastCft->Information_Technology_by;
            $history->current = $request->Information_Technology_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Information_Technology_on != $Cft->Information_Technology_on && $request->Information_Technology_on != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Information Technology Review On')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Information Technology Review On';
            $history->previous = $lastCft->Information_Technology_on;
            $history->current = $Cft->Information_Technology_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        /*************** Contract Giver ***************/
        if ($lastCft->ContractGiver_Review != $request->ContractGiver_Review && $request->ContractGiver_Review != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Contract Giver Review Required')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->ContractGiver_person != $request->ContractGiver_person && $request->ContractGiver_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Contract Giver Person')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->ContractGiver_assessment != $request->ContractGiver_assessment && $request->ContractGiver_assessment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Contract Giver Assessment')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->ContractGiver_feedback != $request->ContractGiver_feedback && $request->ContractGiver_feedback != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Contract Giver Feedback')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->ContractGiver_by != $request->ContractGiver_by && $request->ContractGiver_by != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Contract Giver Review By')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }



        // if ($lastCft->ContractGiver_on != $Cft->ContractGiver_on && $request->ContractGiver_on != null) {
        //     $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        //     ->where('activity_type', 'Contract Giver Review On')
        //     ->exists();
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'Contract Giver Review On';
        //     $history->previous = $lastCft->ContractGiver_on;
        //     $history->current = $Cft->ContractGiver_on;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
        //     $history->save();
        // }

        if ($lastCft->ContractGiver_on != $request->ContractGiver_on && $request->ContractGiver_on != null) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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



        if ($lastDocument->Microbiology_Person != $openState->Microbiology_Person && $request->Microbiology_Person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'CFT Reviewer Person')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'CFT Reviewer Person';
            $history->previous = $lastDocument->Microbiology_Person;
            $history->current = $openState->Microbiology_Person;
            $history->comment = $request->Microbiology_Person_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        /*************** Other 1 ***************/
        if ($lastCft->Other1_review != $request->Other1_review && $request->Other1_review != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Other 1 Review Required')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Other1_person != $request->Other1_person && $request->Other1_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Other 1 Person')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Other1_Department_person != $request->Other1_Department_person && $request->Other1_Department_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Other 1 Review Required')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Other1_assessment != $request->Other1_assessment && $request->Other1_assessment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Other 1 Assessment')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Other1_feedback != $request->Other1_feedback && $request->Other1_feedback != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Other 1 Feedback')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Other1_by != $request->Other1_by && $request->Other1_by != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Other 1 Review By')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Other1_on != $request->Other1_on && $request->Other1_on != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', '')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }


        /*************** Other 2 ***************/
        if ($lastCft->Other2_review != $request->Other2_review && $request->Other2_review != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Other 2 Review Required')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Other2_person != $request->Other2_person && $request->Other2_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Other 2 Person')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Other2_Department_person != $request->Other2_Department_person && $request->Other2_Department_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Other 2 Review Required')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Other2_assessment != $request->Other2_assessment && $request->Other2_assessment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Other 2 Assessment')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Other2_feedback != $request->Other2_feedback && $request->Other2_feedback != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Other 2 Feedback')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Other2_by != $request->Other2_by && $request->Other2_by != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Other 2 Review By')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastCft->Other2_on != $request->Other2_on && $request->Other2_on != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
            ->where('activity_type', 'Other 2 Review On')
            ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
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
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        /*************** Other 3 ***************/
        // Other 3 Review Required
if ($lastCft->Other3_review != $request->Other3_review && $request->Other3_review != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Other 3 Review Required')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Other 3 Review Required';
    $history->previous = $lastCft->Other3_review;
    $history->current = $request->Other3_review;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

// Other 3 Person
if ($lastCft->Other3_person != $request->Other3_person && $request->Other3_person != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Other 3 Person')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Other 3 Person';
    $history->previous = $lastCft->Other3_person;
    $history->current = $request->Other3_person;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

// Other 3 Department Person
if ($lastCft->Other3_Department_person != $request->Other3_Department_person && $request->Other3_Department_person != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Other 3 Department Person')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Other 3 Department Person';
    $history->previous = $lastCft->Other3_Department_person;
    $history->current = $request->Other3_Department_person;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

// Other 3 Assessment
if ($lastCft->Other3_assessment != $request->Other3_assessment && $request->Other3_assessment != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Other 3 Assessment')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Other 3 Assessment';
    $history->previous = $lastCft->Other3_assessment;
    $history->current = $request->Other3_assessment;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

// Other 3 Feedback
if ($lastCft->Other3_feedback != $request->Other3_feedback && $request->Other3_feedback != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Other 3 Feedback')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Other 3 Feedback';
    $history->previous = $lastCft->Other3_feedback;
    $history->current = $request->Other3_feedback;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

// Other 3 Review By
if ($lastCft->Other3_by != $request->Other3_by && $request->Other3_by != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Other 3 Review By')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Other 3 Review By';
    $history->previous = $lastCft->Other3_by;
    $history->current = $request->Other3_by;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

// Other 3 Review On
if ($lastCft->Other3_on != $request->Other3_on && $request->Other3_on != null) {
    $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        ->where('activity_type', 'Other 3 Review On')
        ->exists();
    $history = new RcmDocHistory;
    $history->cc_id = $id;
    $history->activity_type = 'Other 3 Review On';
    $history->previous = $lastCft->Other3_on;
    $history->current = $request->Other3_on;
    $history->comment = "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
    $history->save();
}

        /*************** Other 4 ***************/
        if ($lastCft->Other4_review != $request->Other4_review && $request->Other4_review != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 4 Review Required')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 4 Review Required';
            $history->previous = $lastCft->Other4_review;
            $history->current = $request->Other4_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Other4_person != $request->Other4_person && $request->Other4_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 4 Person')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 4 Person';
            $history->previous = $lastCft->Other4_person;
            $history->current = $request->Other4_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Other4_Department_person != $request->Other4_Department_person && $request->Other4_Department_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 4 Department Person')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 4 Department Person';
            $history->previous = $lastCft->Other4_Department_person;
            $history->current = $request->Other4_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Other4_assessment != $request->Other4_assessment && $request->Other4_assessment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 4 Assessment')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 4 Assessment';
            $history->previous = $lastCft->Other4_assessment;
            $history->current = $request->Other4_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Other4_feedback != $request->Other4_feedback && $request->Other4_feedback != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 4 Feedback')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 4 Feedback';
            $history->previous = $lastCft->Other4_feedback;
            $history->current = $request->Other4_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Other4_by != $request->Other4_by && $request->Other4_by != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 4 Review By')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 4 Review By';
            $history->previous = $lastCft->Other4_by;
            $history->current = $request->Other4_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Other4_on != $request->Other4_on && $request->Other4_on != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 4 Review On')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 4 Review On';
            $history->previous = $lastCft->Other4_on;
            $history->current = $request->Other4_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }


        /*************** Other 5 ***************/
        if ($lastCft->Other5_review != $request->Other5_review && $request->Other5_review != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 5 Review Required')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 5 Review Required';
            $history->previous = $lastCft->Other5_review;
            $history->current = $request->Other5_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Other5_person != $request->Other5_person && $request->Other5_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 5 Person')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 5 Person';
            $history->previous = $lastCft->Other5_person;
            $history->current = $request->Other5_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Other5_Department_person != $request->Other5_Department_person && $request->Other5_Department_person != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 5 Department Person')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 5 Department Person';
            $history->previous = $lastCft->Other5_Department_person;
            $history->current = $request->Other5_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Other5_assessment != $request->Other5_assessment && $request->Other5_assessment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 5 Assessment')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 5 Assessment';
            $history->previous = $lastCft->Other5_assessment;
            $history->current = $request->Other5_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Other5_feedback != $request->Other5_feedback && $request->Other5_feedback != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 5 Feedback')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 5 Feedback';
            $history->previous = $lastCft->Other5_feedback;
            $history->current = $request->Other5_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Other5_by != $request->Other5_by && $request->Other5_by != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 5 Review By')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 5 Review By';
            $history->previous = $lastCft->Other5_by;
            $history->current = $request->Other5_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->Other5_on != $request->Other5_on && $request->Other5_on != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Other 5 Review On')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Other 5 Review On';
            $history->previous = $lastCft->Other5_on;
            $history->current = $request->Other5_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        /************ CFT Review End ************/

         /************ Evalution ************/

        //  if ($lastevaluation->qa_eval_comments != $evaluation->qa_eval_comments ) {
        //     // dd($lastevaluation->qa_eval_comments);
        //     $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        //         ->where('activity_type', 'QA Evaluation Comments')
        //         ->exists();
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'QA Evaluation Comments';
        //     $history->previous = $lastevaluation->qa_eval_comments;
        //     $history->current = $evaluation->qa_eval_comments;
        //     // dd($history->current);
        //     $history->comment = $request->qa_eval_comments_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
        //     $history->save();
        // }

        if ($lastevaluation->qa_eval_comments != $request->qa_eval_comments && $request->qa_eval_comments != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'QA Evaluation Comments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA Evaluation Comments';
            $history->previous = $lastevaluation->qa_eval_comments;
            $history->current = $request->qa_eval_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if (is_array($request->qa_eval_attach)) {
            $request->qa_eval_attach = implode(', ', $request->qa_eval_attach);
        }
        if ($lastevaluation->qa_eval_attach != $request->qa_eval_attach && $request->qa_eval_attach != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'QA Evaluation Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA Evaluation Attachments';
            $history->previous = is_array($lastevaluation->qa_eval_attach) ? implode(', ', $lastevaluation->qa_eval_attach) : $lastevaluation->qa_eval_attach;
            $history->current = $request->qa_eval_attach;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }


        // if ($lastevaluation->intial_update_comments != $request->intial_update_comments && $request->intial_update_comments != null) {
        //     $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
        //         ->where('activity_type', 'Initiator Update Comments')
        //         ->exists();
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'Initiator Update Comments';
        //     $history->previous = $lastevaluation->intial_update_comments;
        //     $history->current = $request->intial_update_comments;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
        //     $history->save();
        // }

        if ($lastCft->intial_update_comments != $request->intial_update_comments && $request->intial_update_comments != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Initiator Update Comments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Initiator Update Comments';
            $history->previous = $lastCft->intial_update_comments;
            $history->current = $request->intial_update_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }


        if ($lastCft->implementation_verification_comments != $request->implementation_verification_comments && $request->implementation_verification_comments != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Implementation Verification by QA/CQA Comments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Implementation Verification by QA/CQA Comments';
            $history->previous = $lastCft->implementation_verification_comments;
            $history->current = $request->implementation_verification_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastCft->hod_final_review_comment != $request->hod_final_review_comment && $request->hod_final_review_comment != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'HOD Final Review Comments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'HOD Final Review Comments';
            $history->previous = $lastCft->hod_final_review_comment;
            $history->current = $request->hod_final_review_comment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if (is_array($request->hod_final_review_attach)) {
            $request->hod_final_review_attach = implode(', ', $request->hod_final_review_attach);
        }
        if (is_array($lastCft->hod_final_review_attach)) {
            $lastCft->hod_final_review_attach = implode(', ', $lastCft->hod_final_review_attach);
        }

        if ($lastCft->hod_final_review_attach != $Cft->hod_final_review_attach && $Cft->hod_final_review_attach != null) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'HOD Final Review Attachments')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'HOD Final Review Attachments';
            $history->previous =str_replace(',', ', ',  $lastCft->hod_final_review_attach);
            $history->current =str_replace(',', ', ',  $Cft->hod_final_review_attach);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }



        /************ Evalution End ************/

        /************ QA Approval ************/

        if ($lastDocument->qa_appro_comments != $openState->qa_appro_comments ) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'QA Approval Comment')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA Approval Comment';
            $history->previous = $lastDocument->qa_appro_comments;
            $history->current = $openState->qa_appro_comments;
            $history->comment = $request->qa_appro_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if ($lastDocument->implementation_verification_comments != $openState->implementation_verification_comments ) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Feedback')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Implementation Verification by QA/CQA Comments';
            $history->previous = $lastDocument->implementation_verification_comments;
            $history->current = $openState->implementation_verification_comments;
            $history->comment = $request->feedback_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if ($lastDocument->feedback != $openState->feedback ) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Feedback')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Training Feedback';
            $history->previous = $lastDocument->feedback;
            $history->current = $openState->feedback;
            $history->comment = $request->feedback_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        /************ QA Approval Ends ************/

        /************ Change Closure ************/
        if ($lastDocument->qa_closure_comments != $openState->qa_closure_comments) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'QA/CQA Closure Comment')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA/CQA Closure Comment';
            $history->previous = $lastDocument->qa_closure_comments;
            $history->current = $openState->qa_closure_comments;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
            // return $closure;
        }


        if ($lastDocument->related_records != $openState->related_records) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Related Records')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Related Records';
            $history->previous =  str_replace(',', ', ', $lastDocument->related_records);
            $history->current = str_replace(',', ', ', $openState->related_records);
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
            // return $closure;
        }
        if ($lastDocument->due_date_extension != $openState->due_date_extension) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'Due Date Extension Justification')
                ->exists();
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Due Date Extension Justification';
            $history->previous = $lastDocument->due_date_extension;
            $history->current = $openState->due_date_extension;
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
            // return $closure;
        }









        if (!$areChangeClosureAttachSame) {
            $lastDocumentAuditTrail = RcmDocHistory::where('cc_id', $id)
                ->where('activity_type', 'List Of Attachments')
                ->exists();
        
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'List Of Attachments';
        
            // Convert the previous and current lists to readable formats (JSON string or comma-separated)
            $history->previous = str_replace(',', ', ', json_encode(json_decode($lastclosure->attach_list, true))) ?: "NULL";
            $history->current = str_replace(',', ', ', json_encode(json_decode($closure->attach_list, true))) ?: "NULL";
            
            $history->comment = "";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastclosure->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastclosure->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        





        /************ Change Closure Ends ************/
        return back();
    }


    public function destroy($id)
    {
    }

    public function stageChange(Request $request, $id)
    {
        if($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = CC::find($id);
            $lastDocument = CC::find($id);

            $review = Qareview::where('cc_id', $id)->first();
            $evaluation = Evaluation::where('cc_id', $id)->first();
            $updateCFT = CcCft::where('cc_id', $id)->latest()->first();
            $cftDetails = ChangeControlCftResponse::withoutTrashed()->where(['status' => 'In-progress', 'cc_id' => $id])->distinct('cft_user_id')->count();

            if ($changeControl->stage == 1) {

                if (empty($changeControl->severity) || empty($changeControl->short_description)) {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'Pls Fill General Information fields'
                    ]);

                    return redirect()->back();
                } else {
                    // If both fields are filled, proceed with success message
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Document Sent'
                    ]);
                }



                    $changeControl->stage = "2";
                    $changeControl->status = "HOD Assessment";
                    $changeControl->submit_by = Auth::user()->name;
                    $changeControl->submit_on = Carbon::now()->format('d-M-Y');
                    $changeControl->submit_comment = $request->comments;

                    $history = new RcmDocHistory();
                    $history->cc_id = $id;

                    $history->activity_type = 'Submit By, Submit On';
                    if (is_null($lastDocument->submit_by) || $lastDocument->submit_by === '') {
                        $history->previous = "NULL";
                    } else {
                        $history->previous = $lastDocument->submit_by . ' , ' . $lastDocument->submit_on;
                    }
                    $history->current = $changeControl->submit_by . ' , ' . $changeControl->submit_on;
                    if (is_null($lastDocument->submit_by) || $lastDocument->submit_on === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }

                    $history->action = 'Submit';
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to = "HOD Assessment";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';

                    $history->save();

                    $list = Helpers::getHodUserList($changeControl->division_id);
                    foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $changeControl->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site'=>"CC", 'history' => "Submit", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Submit Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                            }
                        // }
                    }

                    $changeControl->update();
                    $history = new CCStageHistory();
                    $history->type = "Change-Control";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();

                    $history = new CCStageHistory();
                    $history->type = "Activity-log";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();
                    // Helpers::hodMail($changeControl);
                    toastr()->success('Sent to HOD Assessment');
                    return back();

            }
            if ($changeControl->stage == 2) {

                if (empty($updateCFT->hod_assessment_comments))
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'Initial HOD Review Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                else {
                    // dd($updateCFT->hod_assessment_comments);
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Document Sent'
                    ]);
                }
                    $changeControl->stage = "3";
                    $changeControl->status = "QA Initial Assessment";
                    $changeControl->hod_review_by = Auth::user()->name;
                    $changeControl->hod_review_on = Carbon::now()->format('d-M-Y');
                    $changeControl->hod_review_comment = $request->comments;

                    $history = new RcmDocHistory();
                    $history->cc_id = $id;
                    $history->activity_type = 'Activity Log';

                    $history->activity_type = 'HOD Assessment Complete By, HOD Assessment Complete On';
                    if (is_null($lastDocument->hod_review_by) || $lastDocument->hod_review_by === '') {
                        $history->previous = "NULL";
                    } else {
                        $history->previous = $lastDocument->hod_review_by . ' , ' . $lastDocument->hod_review_on;
                    }
                    $history->current = $changeControl->hod_review_by . ' , ' . $changeControl->hod_review_on;
                    if (is_null($lastDocument->hod_review_by) || $lastDocument->hod_review_on === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }

                    $history->action = 'HOD Assessment Complete';
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to = "QA Initial Assessment";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();

                    $list = Helpers::getQAUserList($changeControl->division_id); // Notify QA
                    foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $changeControl->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                    try {
                                        Mail::send(
                                            'mail.view-mail',
                                            ['data' => $changeControl, 'site' => "CC", 'history' => "HOD Assessment Complete", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                            function ($message) use ($email, $changeControl) {
                                                $message->to($email)
                                                ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Assessment Complete Performed");
                                            }
                                        );
                                } catch(\Exception $e) {
                                        info('Error sending mail', [$e]);
                                    }
                            }
                        // }
                    }

                    $list = Helpers::getCQAUsersList($changeControl->division_id); // Notify CQA
                    foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $changeControl->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                    try {
                                        Mail::send(
                                            'mail.view-mail',
                                            ['data' => $changeControl, 'site' => "CC", 'history' => "HOD Assessment Complete", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                            function ($message) use ($email, $changeControl) {
                                                $message->to($email)
                                                ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Assessment Complete Performed");
                                            }
                                        );
                                    } catch(\Exception $e) {
                                        info('Error sending mail', [$e]);
                                    }
                            }
                        // }
                    }

                    $changeControl->update();
                    $history = new CCStageHistory();
                    $history->type = "Change-Control";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();

                    $history = new CCStageHistory();
                    $history->type = "Activity-log";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();
                    // Helpers::hodMail($changeControl);
                    toastr()->success('Sent to QA Initial Assessment');
                    return back();
            }
            if ($changeControl->stage == 3) {
                if (empty($review->qa_comments))
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'QA/CQA Review Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Document Sent'
                    ]);
                }

                $changeControl->stage = "4";
                $changeControl->status = "CFT Assessment";

                    // Code for the CFT required
                $stage = new ChangeControlCftResponse();
                $stage->cc_id = $id;
                $stage->cft_user_id = Auth::user()->id;
                $stage->status = "CFT Required";

                $stage->comment = $request->comment;
                $stage->is_required = 1;
                $stage->save();




                $changeControl->QA_initial_review_by = Auth::user()->name;
                $changeControl->QA_initial_review_on = Carbon::now()->format('d-M-Y');
                $changeControl->QA_initial_review_comment = $request->comments;

                $history = new RcmDocHistory();
                $history->cc_id = $id;
                $history->activity_type = 'Activity Log';

                $history->activity_type = 'QA/CQA Initial Assessment Complete By, QA/CQA Initial Assessment Complete On';
                if (is_null($lastDocument->QA_initial_review_by) || $lastDocument->QA_initial_review_by === '') {
                    $history->previous = "NULL";
                } else {
                    $history->previous = $lastDocument->QA_initial_review_by . ' , ' . $lastDocument->QA_initial_review_on;
                }
                $history->current = $changeControl->QA_initial_review_by . ' , ' . $changeControl->QA_initial_review_on;
                if (is_null($lastDocument->QA_initial_review_by) || $lastDocument->QA_initial_review_on === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }

                $history->action = 'QA/CQA Initial Assessment Complete';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "CFT Assessment";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "CC", 'history' => "QA/CQA Initial Assessment Complete", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA/CQA Initial Assessment Complete Performed");
                //                 }
                //             );
                //         }
                //     // }
                // }

                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();
                // Helpers::hodMail($changeControl);
                toastr()->success('Sent to CFT Assessment');
                return back();
            }
           if ($changeControl->stage == 4) {

                    // CFT review state update form_progress
                    // if ($changeControl->form_progress !== 'cft')
                    // {
                    //     Session::flash('swal', [
                    //         'type' => 'warning',
                    //         'title' => 'Mandatory Fields!',
                    //         'message' => 'CFT Tab is yet to be filled'
                    //     ]);

                    //     return redirect()->back();
                    // }
                    //  else {
                    //     Session::flash('swal', [
                    //         'type' => 'success',
                    //         'title' => 'Success',
                    //         'message' => 'Sent for Investigation and CAPA review state'
                    //     ]);
                    // }


                    $IsCFTRequired = ChangeControlCftResponse::withoutTrashed()->where(['is_required' => 1, 'cc_id' => $id])->latest()->first();
                    $cftUsers = DB::table('cc_cfts')->where(['cc_id' => $id])->first();
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

    $history = new RcmDocHistory();
    $history->cc_id = $id;
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

    $history = new RcmDocHistory();
    $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                            $history = new RcmDocHistory();
                            $history->cc_id = $id;
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
                    // dd($valuesArray, count(array_unique($valuesArray)), ($cftDetails+1));
                    if ($IsCFTRequired) {
                        if (count(array_unique($valuesArray)) == ($cftDetails + 1)) {
                            $stage = new ChangeControlCftResponse();
                            $stage->cc_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "Completed";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        } else {
                            $stage = new ChangeControlCftResponse();
                            $stage->cc_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "In-progress";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        }
                    }

                    $checkCFTCount = ChangeControlCftResponse::withoutTrashed()->where(['status' => 'Completed', 'cc_id' => $id])->count();
                    $Cft = CcCft::withoutTrashed()->where('cc_id', $id)->first();

                    // dd(count(array_unique($valuesArray)), $checkCFTCount);

                    //  if (!$Cft->Production_Table_Assessment) {

                    //     Session::flash('swal', [
                    //         'title' => 'Mandatory Fields Required!',
                    //         'message' => 'HOD Remarks is yet to be filled!',
                    //         'type' => 'warning',
                    //     ]);

                    //     return redirect()->back();
                    // } else {
                    //     Session::flash('swal', [
                    //         'type' => 'success',
                    //         'title' => 'Success',
                    //         'message' => 'Sent for QA/CQA initial review state'
                    //     ]);
                    // }

                    if (!$IsCFTRequired || $checkCFTCount) {


                        $changeControl->stage = "5";
                        $changeControl->status = "QA/CQA Final Assessment";
                        $changeControl->pending_RA_review_by = Auth::user()->name;
                        $changeControl->pending_RA_review_on = Carbon::now()->format('d-M-Y');
                        $changeControl->pending_RA_review_comment = $request->comment;

                        $history = new RcmDocHistory();
                        $history->cc_id = $id;
                        $history->activity_type = 'CFT Review Completed By, CFT Review Completed On';
                    if(is_null($lastDocument->pending_RA_review_by) || $lastDocument->pending_RA_review_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->pending_RA_review_by. ' ,' . $lastDocument->pending_RA_review_on;
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $changeControl->pending_RA_review_by. ',' . $changeControl->pending_RA_review_on;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "QA/CQA Final Assessment";
                        $history->change_from = $lastDocument->status;
                        $history->stage = 'Complete';
                        if(is_null($lastDocument->pending_RA_review_by) || $lastDocument->pending_RA_review_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                        $history->save();
                        // $list = Helpers::getQAUserList();
                        // foreach ($list as $u) {
                        //     if ($u->q_m_s_divisions_id == $changeControl->division_id) {
                        //         $email = Helpers::getInitiatorEmail($u->user_id);
                        //         if ($email !== null) {
                        //             try {
                        //                 Mail::send(
                        //                     'mail.view-mail',
                        //                     ['data' => $changeControl],
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
                        $changeControl->update();
                    }
                    toastr()->success('Document Sent');
                    return back();
                }
            if ($changeControl->stage == 5) {
                if (is_null($updateCFT->RA_data_person) || is_null($updateCFT->QA_CQA_person) || is_null($updateCFT->qa_final_comments) )
                    {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'QA/CQA Final Review Tab is yet to be filled'
                        ]);

                        return redirect()->back();
                    }
                     else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Document Sent'
                        ]);
                    }
                $changeControl->stage = "6";
                $changeControl->status = "Pending RA Approval";
                $changeControl->RA_review_required_by = Auth::user()->name;
                $changeControl->RA_review_required_on = Carbon::now()->format('d-M-Y');
                $changeControl->RA_review_required_comment = $request->comments;

                $history = new RcmDocHistory();
                $history->cc_id = $id;
                $history->activity_type = 'RA Approval By, RA Approval On';
                if (is_null($lastDocument->RA_review_required_by) || $lastDocument->RA_review_required_by === '') {
                    $history->previous = "NULL";
                } else {
                    $history->previous = $lastDocument->RA_review_required_by . ' , ' . $lastDocument->RA_review_required_on;
                }
                $history->current = $changeControl->RA_review_required_by . ' , ' . $changeControl->RA_review_required_on;
                if (is_null($lastDocument->RA_review_required_by) || $lastDocument->RA_review_required_on === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->action = 'RA Approval Required';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Pending RA Approval";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                $list = Helpers::getRAUsersList($changeControl->division_id); // Notify RA Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "RA Approval Required", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: RA Approval Required Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();
                toastr()->success('Sent to Pending RA Approval');
                return back();
            }
            if ($changeControl->stage == 6) {


                if (is_null($updateCFT->ra_tab_comments) )
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'Pls Fill RA Tab'
                    ]);

                    return redirect()->back();
                }
                 else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Document Sent'
                    ]);
                }



                $changeControl->stage = "7";
                $changeControl->status = "QA/CQA Head/Manager Designee Approval";


                $changeControl->RA_review_completed_by = Auth::user()->name;
                $changeControl->RA_review_completed_on = Carbon::now()->format('d-M-Y');
                $changeControl->RA_review_completed_comment = $request->comments;

                $history = new RcmDocHistory();
                $history->cc_id = $id;

                $history->activity_type = 'RA Approval Complete By, RA Approval Complete On';
                if (is_null($lastDocument->RA_review_completed_by) || $lastDocument->RA_review_completed_by === '') {
                    $history->previous = "NULL";
                } else {
                    $history->previous = $lastDocument->RA_review_completed_by . ' , ' . $lastDocument->RA_review_completed_on;
                }
                $history->current = $changeControl->RA_review_completed_by . ' , ' . $changeControl->RA_review_completed_on;
                if (is_null($lastDocument->RA_review_completed_by) || $lastDocument->RA_review_completed_on === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }

                $history->action = 'RA Approval Complete';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "QA/CQA Head/Manager Designee Approval";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                $list = Helpers::getQAUserList($changeControl->division_id); // Notify QA Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "RA Approval Complete", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: RA Approval Complete Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $list = Helpers::getCQAUsersList($changeControl->division_id); // Notify CQA Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "RA Approval Complete", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: RA Approval Complete Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->comments = $request->comments;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                // Helpers::hodMail($changeControl);
                toastr()->success('Sent QA/CQA Head/Manager Designee Approval');
                return back();
            }
            if ($changeControl->stage == 7) {
                $changeControl->stage = "8";
                $changeControl->status = "Closed - Rejected";
                $changeControl->RA_review_completed_by = Auth::user()->name;
                $changeControl->RA_review_completed_on = Carbon::now()->format('d-M-Y');
                $changeControl->RA_review_completed_comment = $request->comments;

                $history = new RcmDocHistory();
                $history->cc_id = $id;

                $history->activity_type = 'Rejected By, Rejected On';
                if (is_null($lastDocument->RA_review_completed_by) || $lastDocument->RA_review_completed_by === '') {
                    $history->previous = "NULL";
                } else {
                    $history->previous = $lastDocument->RA_review_completed_by . ' , ' . $lastDocument->RA_review_completed_on;
                }
                $history->current = $changeControl->RA_review_completed_by . ' , ' . $changeControl->RA_review_completed_on;
                if (is_null($lastDocument->RA_review_completed_by) || $lastDocument->RA_review_completed_on === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }

                $history->action = 'Rejected';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Closed - Rejected";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                $list = Helpers::getInitiatorUserList($changeControl->division_id); // Notify Initiator
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "Rejected", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Rejected Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $list = Helpers::getQAUserList($changeControl->division_id); // Notify QA Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "Rejected", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Rejected Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $list = Helpers::getCQAUsersList($changeControl->division_id); // Notify CQA Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "Rejected Complete", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Rejected Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->comments = $request->comments;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                // Helpers::hodMail($changeControl);
                toastr()->success('Sent to Closed - Rejected');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function reject(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = CC::find($id);
            $lastDocument = CC::find($id);
            $evaluation = Evaluation::where('cc_id', $id)->first();
            $updateCFT = CcCft::where('cc_id', $id)->latest()->first();
            $cftDetails = ChangeControlCftResponse::withoutTrashed()
                ->where(['status' => 'In-progress', 'cc_id' => $id])
                ->distinct('cft_user_id')
                ->count();

            if ($changeControl->stage == 7) {
                $changeControl->stage = 8;
                $changeControl->status = "Closed - Rejected";
                $changeControl->RA_review_completed_by = Auth::user()->name;
                $changeControl->RA_review_completed_on = Carbon::now()->format('d-M-Y');
                $changeControl->RA_review_completed_comment = $request->comments;

                $history = new RcmDocHistory();
                $history->cc_id = $id;
                $history->activity_type = 'Rejected By, Rejected On';

                $history->previous = is_null($lastDocument->RA_review_completed_by) || $lastDocument->RA_review_completed_by === ''
                    ? "NULL"
                    : $lastDocument->RA_review_completed_by . ' , ' . $lastDocument->RA_review_completed_on;

                $history->current = $changeControl->RA_review_completed_by . ' , ' . $changeControl->RA_review_completed_on;

                $history->action_name = is_null($lastDocument->RA_review_completed_by) || $lastDocument->RA_review_completed_on === ''
                    ? 'New'
                    : 'Update';

                $history->action = 'Rejected';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Closed - Rejected";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                $list = Helpers::getInitiatorUserList($changeControl->division_id); // Notify Initiator
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "Rejected", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Rejected Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $list = Helpers::getQAUserList($changeControl->division_id); // Notify QA Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "Rejected", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Rejected Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $list = Helpers::getCQAUsersList($changeControl->division_id); // Notify CQA Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "Rejected Complete", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Rejected Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $changeControl->update();

                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                // Send HOD email (commented out)
                // Helpers::hodMail($changeControl);

                toastr()->success('Sent to Closed - Rejected');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function sentToQAHeadApproval(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = CC::find($id);
            $comments = ChangeControlComment::where('cc_id', $id)->firstOrCreate();

            $lastDocument = CC::find($id);
            $evaluation = Evaluation::where('cc_id', $id)->first();
            $updateCFT = CcCft::where('cc_id', $id)->latest()->first();
            if ($changeControl->stage == 5) {
                    $changeControl->stage = "7";
                    $changeControl->status = "QA/CQA Head/Manager Designee Approval";
                    $changeControl->QA_final_review_by = Auth::user()->name;
                    $changeControl->QA_final_review_on = Carbon::now()->format('d-M-Y');
                    $changeControl->QA_final_review_comment = $request->comments;

                    $history = new RcmDocHistory();
                    $history->cc_id = $id;

                    $history->activity_type = 'QA/CQA Final Review Complete By, QA/CQA Final Review Complete On';
                    if (is_null($lastDocument->QA_final_review_by) || $lastDocument->QA_final_review_by === '') {
                        $history->previous = "NULL";
                    } else {
                        $history->previous = $lastDocument->QA_final_review_by . ' , ' . $lastDocument->QA_final_review_on;
                    }
                    $history->current = $changeControl->QA_final_review_by . ' , ' . $changeControl->QA_final_review_on;
                    if (is_null($lastDocument->QA_final_review_by) || $lastDocument->QA_final_review_on === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }

                    $history->action = 'QA/CQA Final Review Complete';
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to = "QA/CQA Head/Manager Designee Approval";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();

                    $list = Helpers::getQAHeadUserList($changeControl->division_id); // Notify QA Head
                    foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $changeControl->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                    try {
                                        Mail::send(
                                            'mail.view-mail',
                                            ['data' => $changeControl, 'site' => "CC", 'history' => "QA/CQA Final Review Complete", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                            function ($message) use ($email, $changeControl) {
                                                $message->to($email)
                                                ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA/CQA Final Review Complete Performed");
                                            }
                                        );
                                    } catch(\Exception $e) {
                                        info('Error sending mail', [$e]);
                                    }
                            }
                        // }
                    }

                    $list = Helpers::getCQAHeadUsersList($changeControl->division_id); // Notify CQA Head
                    foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $changeControl->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                    try {
                                        Mail::send(
                                            'mail.view-mail',
                                            ['data' => $changeControl, 'site' => "CC", 'history' => "QA/CQA Final Review Complete", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                            function ($message) use ($email, $changeControl) {
                                                $message->to($email)
                                                ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA/CQA Final Review Complete Performed");
                                            }
                                        );
                                    } catch(\Exception $e) {
                                        info('Error sending mail', [$e]);
                                    }
                            }
                        // }
                    }

                    $changeControl->update();
                    $history = new CCStageHistory();
                    $history->type = "Change-Control";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();

                    $history = new CCStageHistory();
                    $history->type = "Activity-log";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();
                    // Helpers::hodMail($changeControl);
                    toastr()->success('Sent to QA Head/Manager Designee Approval');
                    return back();

            }
            if ($changeControl->stage == 7) {



                if (!empty($updateCFT->qa_cqa_comments) )
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'Pls fill QA/CQA  Designee Approval'
                    ]);

                    return redirect()->back();
                }
                 else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Document Sent'
                    ]);
                }
                    $changeControl->stage = "9";
                    $changeControl->status = "Pending Initiator Update";
                    $changeControl->approved_by = Auth::user()->name;
                    $changeControl->approved_on = Carbon::now()->format('d-M-Y');
                    $changeControl->approved_comment = $request->comments;


                    $history = new RcmDocHistory();
                    $history->cc_id = $id;

                    $history->activity_type = 'QA/CQA Head/Manager Designee Approval By, QA/CQA Head/Manager Designee ApprovalOn';
                    if (is_null($lastDocument->approved_by) || $lastDocument->approved_by === '') {
                        $history->previous = "NULL";
                    } else {
                        $history->previous = $lastDocument->approved_by . ' , ' . $lastDocument->approved_on;
                    }
                    $history->current = $changeControl->approved_by . ' , ' . $changeControl->approved_on;
                    if (is_null($lastDocument->approved_by) || $lastDocument->approved_on === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }

                    $history->action = 'Approved';
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to = "Pending Initiator Update";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();

                    $list = Helpers::getInitiatorUserList($changeControl->division_id); // Notify Initiator
                    foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $changeControl->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                    try {
                                        Mail::send(
                                            'mail.view-mail',
                                            ['data' => $changeControl, 'site' => "CC", 'history' => "Approved", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                            function ($message) use ($email, $changeControl) {
                                                $message->to($email)
                                                ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Approved Performed");
                                            }
                                        );
                                    } catch(\Exception $e) {
                                        info('Error sending mail', [$e]);
                                    }
                            }
                        // }
                    }

                    $changeControl->update();
                    $history = new CCStageHistory();
                    $history->type = "Change-Control";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();

                    $history = new CCStageHistory();
                    $history->type = "Activity-log";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();
                    // Helpers::hodMail($changeControl);
                    toastr()->success('Sent to Pending Initiator Update');
                    return back();
            }




            if ($changeControl->stage == 9) {
                $changeControl->stage = "10";
                $changeControl->status = "HOD Final Review";



                $comments->initiator_update_complete_by = Auth::user()->name;
                $comments->initiator_update_complete_on = Carbon::now()->format('d-M-Y');
                $comments->initiator_update_complete_comment = $request->comments;

                $comments->save();


                $history = new RcmDocHistory();
                $history->cc_id = $id;

                $lastDocument = ChangeControlComment::find($id);
                $history->activity_type = 'Initiator Updated Complete By, Initiator Updated Complete On';
                if (is_null($lastDocument->initiator_update_complete_by) || $lastDocument->initiator_update_complete_by === '') {
                    $history->previous = "NULL";
                } else {
                    $history->previous = $lastDocument->initiator_update_complete_by . ' , ' . $lastDocument->initiator_update_complete_on;
                }
                $history->current = $comments->initiator_update_complete_by . ' , ' . $comments->initiator_update_complete_on;
                if (is_null($lastDocument->initiator_update_complete_by) || $lastDocument->initiator_update_complete_on === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }

                $history->action = 'Initiator Updated Complete';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "HOD Final Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                $list = Helpers::getHodUserList($changeControl->division_id); // Notify HOD/Designee
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "Initiator Updated Complete", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Initiator Updated Complete Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $changeControl->update();

                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                toastr()->success('Sent to HOD Final Review');
                return back();
            }



            // if ($changeControl->stage == 9) {
            //     $changeControl->stage = "10";
            //     $changeControl->status = "HOD Final Review";

            //    // Update the comment fields
            // $comment->initiator_update_complete_by = Auth::user()->name;
            // $comment->initiator_update_complete_on = Carbon::now()->format('d-M-Y');
            // $comment->initiator_update_complete_comment = $request->comments;
            // $comment->save(); // Save the updated comment to the database

            // // Save the history

            //     $history = new RcmDocHistory();
            //     $history->cc_id = $id;

            //     $lastDocument = ChangeControlComment::find($id);
            //     $history->activity_type = 'Initiator Updated Complete By, Initiator Updated Complete On';
            //     if (is_null($lastDocument->initiator_update_complete_by) || $lastDocument->initiator_update_complete_by === '') {
            //         $history->previous = "NULL";
            //     } else {
            //         $history->previous = $lastDocument->initiator_update_complete_by . ' , ' . $lastDocument->initiator_update_complete_on;
            //     }
            //     $history->current = $comment->initiator_update_complete_by . ' , ' . $comment->initiator_update_complete_on;
            //     if (is_null($lastDocument->initiator_update_complete_by) || $lastDocument->initiator_update_complete_on === '') {
            //         $history->action_name = 'New';
            //     } else {
            //         $history->action_name = 'Update';
            //     }

            //     $history->action = 'Initiator Updated Complete';
            //     $history->comment = $request->comments;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocument->status;
            //     $history->change_to = "HOD Final Review";
            //     $history->change_from = $lastDocument->status;
            //     $history->stage = 'Plan Proposed';
            //     $history->save();



            //     //  $list = Helpers::getHodUserList();
            //     //     foreach ($list as $u) {
            //     //         if($u->q_m_s_divisions_id == $changeControl->division_id){
            //     //             $email = Helpers::getInitiatorEmail($u->user_id);
            //     //              if ($email !== null) {
            //     //               Mail::send(
            //     //                   'mail.view-mail',
            //     //                    ['data' => $changeControl],
            //     //                 function ($message) use ($email) {
            //     //                     $message->to($email)
            //     //                         ->subject("Document is Send By".Auth::user()->name);
            //     //                 }
            //     //               );
            //     //             }
            //     //      }
            //     //   }

            //     $comment->update();
            //     $changeControl->update();
            //     $history = new CCStageHistory();
            //     $history->type = "Change-Control";
            //     $history->doc_id = $id;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->stage_id = $changeControl->stage;
            //     $history->comments = $request->comments;
            //     $history->status = $changeControl->status;
            //     $history->save();

            //     $history = new CCStageHistory();
            //     $history->type = "Activity-log";
            //     $history->doc_id = $id;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->stage_id = $changeControl->stage;
            //     $history->comments = $request->comments;
            //     $history->status = $changeControl->status;
            //     $history->save();
            //     // Helpers::hodMail($changeControl);
            //     toastr()->success('Sent to HOD Final Review');
            //     return back();
            // }
            if ($changeControl->stage == 10) {
                $changeControl->stage = "11";
                $changeControl->status = "Implementation Verification by QA";

                $comments->cc_id = $id;

                $comments->HOD_finalReview_complete_by = Auth::user()->name;
                $comments->HOD_finalReview_complete_on = Carbon::now()->format('d-M-Y');
                $comments->HOD_finalReview_complete_comment = $request->comments;
                $comments->save();
                $history = new RcmDocHistory();
                $history->cc_id = $id;
                $lastDocument = ChangeControlComment::find($id);
                $history->activity_type = 'HOD Final Review Complete By, HOD Final Review Complete On';
                if (is_null($lastDocument->HOD_finalReview_complete_by) || $lastDocument->HOD_finalReview_complete_by === '') {
                    $history->previous = "NULL";
                } else {
                    $history->previous = $lastDocument->HOD_finalReview_complete_by . ' , ' . $lastDocument->HOD_finalReview_complete_on;
                }
                $history->current = $comments->HOD_finalReview_complete_by . ' , ' . $comments->HOD_finalReview_complete_on;
                if (is_null($lastDocument->HOD_finalReview_complete_by) || $lastDocument->HOD_finalReview_complete_on === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }

                $history->action = 'HOD Final Review Complete';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Implementation Verification by QA";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                $list = Helpers::getQAUserList($changeControl->division_id); // Notify QA Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "HOD Final Review Complete", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Final Review Complete Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $list = Helpers::getCQAUsersList($changeControl->division_id); // Notify CQA Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "HOD Final Review Complete", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Final Review Complete Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();
                // Helpers::hodMail($changeControl);
                toastr()->success('Sent to Implementation Verification by QA');
                return back();
            }


            if ($changeControl->stage == 11) {
                $changeControl->stage = "12";
                $changeControl->status = "QA/CQA Closure Approval";
                $changeControl->HOD_finalReview_complete_by = Auth::user()->name;
                $changeControl->HOD_finalReview_complete_on = Carbon::now()->format('d-M-Y');
                $changeControl->HOD_finalReview_complete_comment = $request->comments;

                $history = new RcmDocHistory();
                $history->cc_id = $id;

                $history->activity_type = 'Implementation verification by QA/CQA Complete By, Implementation verification by QA/CQA Complete On';
                if (is_null($lastDocument->HOD_finalReview_complete_by) || $lastDocument->HOD_finalReview_complete_by === '') {
                    $history->previous = "NULL";
                } else {
                    $history->previous = $lastDocument->HOD_finalReview_complete_by . ' , ' . $lastDocument->HOD_finalReview_complete_on;
                }
                $history->current = $changeControl->HOD_finalReview_complete_by . ' , ' . $changeControl->HOD_finalReview_complete_on;
                if (is_null($lastDocument->HOD_finalReview_complete_by) || $lastDocument->HOD_finalReview_complete_on === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }

                $history->action = 'Send For Final QA/CQA Head Approval';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "QA/CQA Closure Approval";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';

                $list = Helpers::getHodUserList($changeControl->division_id); // Notify HOD
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "Send For Final QA/CQA Head Approval", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Send For Final QA/CQA Head Approval Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $list = Helpers::getQAUserList($changeControl->division_id); // Notify QA Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "Send For Final QA/CQA Head Approval", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Send For Final QA/CQA Head Approval Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $list = Helpers::getCQAUsersList($changeControl->division_id); // Notify CQA Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site' => "CC", 'history' => "Send For Final QA/CQA Head Approval", 'process' => 'Change Control', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: Change Control, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Send For Final QA/CQA Head Approval");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                        }
                    // }
                }

                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();
                // Helpers::hodMail($changeControl);
                toastr()->success('Sent to Implementation Verification by QA/CQA');
                return back();
            }


        } else {
            toastr()->error('E-signature Not match');
            return back();
        }




    }



    public function sentoPostImplementation(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = CC::find($id);
            $lastDocument = CC::find($id);
            $comments = ChangeControlComment::where('cc_id', $id)->firstOrCreate();
            $evaluation = Evaluation::where('cc_id', $id)->first();
            $updateCFT = CcCft::where('cc_id', $id)->latest()->first();
            if ($changeControl->stage == 7) {


                if (is_null($updateCFT->qa_cqa_comments))
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'Pls Fill QA/CQA Designee Approval Tab'
                    ]);

                    return redirect()->back();
                }
                 else {
                    // dd($updateCFT->intial_update_comments);
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Document Sent'
                    ]);
                }
                    $changeControl->stage = "9";
                    $changeControl->status = "Pending Initiator Update";
                    $changeControl->approved_by = Auth::user()->name;
                    $changeControl->approved_on = Carbon::now()->format('d-M-Y');
                    $changeControl->approved_comment = $request->comments;

                    $history = new RcmDocHistory();
                    $history->cc_id = $id;

                    $history->activity_type = 'QA/CQA Head/Manager Designee Approval By, QA/CQA Head/Manager Designee Approval On';
                    if (is_null($lastDocument->approved_by) || $lastDocument->approved_by === '') {
                        $history->previous = "NULL";
                    } else {
                        $history->previous = $lastDocument->approved_by . ' , ' . $lastDocument->approved_on;
                    }
                    $history->current = $changeControl->approved_by . ' , ' . $changeControl->approved_on;
                    if (is_null($lastDocument->approved_by) || $lastDocument->approved_on === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }

                    $history->action = 'Approved';
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to = "Pending Initiator Update";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();

                    //  $list = Helpers::getHodUserList();
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
                    $history = new CCStageHistory();
                    $history->type = "Change-Control";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();

                    $history = new CCStageHistory();
                    $history->type = "Activity-log";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();
                    // Helpers::hodMail($changeControl);
                    toastr()->success('Sent to Pending Initiator Update');
                    return back();

            }




            if ($changeControl->stage == 9) {
                if (is_null($updateCFT->intial_update_comments))
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'Initiator Update Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                 else {
                    // dd($updateCFT->intial_update_comments);
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Document Sent'
                    ]);
                }
                $changeControl->stage = "10";
                $changeControl->status = "HOD Final Review";


                $comments->cc_id =$id;
                $comments->initiator_update_complete_by = Auth::user()->name;
                $comments->initiator_update_complete_on = Carbon::now()->format('d-M-Y');
                $comments->initiator_update_complete_comment = $request->comments;

                $comments->save();


                $history = new RcmDocHistory();
                $history->cc_id = $id;

                $history->activity_type = 'Initiator Updated Complete By, Initiator Updated Complete On';
                if (is_null($lastDocument->initiator_update_complete_by) || $lastDocument->initiator_update_complete_by === '') {
                    $history->previous = "NULL";
                } else {
                    $history->previous = $lastDocument->initiator_update_complete_by . ' , ' . $lastDocument->initiator_update_complete_on;
                }
                $history->current = $comments->initiator_update_complete_by . ' , ' . $comments->initiator_update_complete_on;
                if (is_null($lastDocument->initiator_update_complete_by) || $lastDocument->initiator_update_complete_on === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }

                $history->action = 'Initiator Updated Complete';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "HOD Final Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                $changeControl->update();

                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                toastr()->success('Sent to HOD Final Review');
                return back();
            }







             if ($changeControl->stage == 9) {
                    $changeControl->stage = "10";
                    $changeControl->status = "QA/CQA Closure Approval";

                    $changeControl->sentFor_final_approval_by = Auth::user()->name;
                    $changeControl->sentFor_final_approval_on = Carbon::now()->format('d-M-Y');
                    $changeControl->sentFor_final_approval_comment = $request->comments;

                    $history = new RcmDocHistory();
                    $history->cc_id = $id;

                    $history->activity_type = 'Approved By, Approved On';
                    if (is_null($lastDocument->sentFor_final_approval_by) || $lastDocument->sentFor_final_approval_by === '') {
                        $history->previous = "NULL";
                    } else {
                        $history->previous = $lastDocument->sentFor_final_approval_by . ' , ' . $lastDocument->sentFor_final_approval_on;
                    }
                    $history->current = $changeControl->sentFor_final_approval_by . ' , ' . $changeControl->sentFor_final_approval_on;
                    if (is_null($lastDocument->sentFor_final_approval_by) || $lastDocument->sentFor_final_approval_on === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }

                    $history->action = 'Send For Final Approval';
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to = "QA/CQA Closure Approval";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();
                    //  $list = Helpers::getHodUserList();
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
                    $history = new CCStageHistory();
                    $history->type = "Change-Control";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();

                    $history = new CCStageHistory();
                    $history->type = "Activity-log";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();
                    // Helpers::hodMail($changeControl);
                    toastr()->success('Sent to QA/CQA Closure Approval');
                    return back();
            }



            if ($changeControl->stage == 10) {
                if (is_null($updateCFT->hod_final_review_comment))
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'HOD Final Review Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                 else {
                    // dd($updateCFT->intial_update_comments);
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Document Sent'
                    ]);
                }
                $changeControl->stage = "11";
                $changeControl->status = "Implementation verification by QA/CQA";
                $changeControl->closure_approved_by = Auth::user()->name;
                $changeControl->closure_approved_on = Carbon::now()->format('d-M-Y');
                $changeControl->closure_approved_comment = $request->comments;

                $history = new RcmDocHistory();
                $history->cc_id = $id;

                $history->activity_type = 'HOD Final Review Complete By, HOD Final Review Complete On';
                if (is_null($lastDocument->closure_approved_by) || $lastDocument->closure_approved_by === '') {
                    $history->previous = "NULL";
                } else {
                    $history->previous = $lastDocument->closure_approved_by . ' , ' . $lastDocument->closure_approved_on;
                }
                $history->current = $changeControl->closure_approved_by . ' , ' . $changeControl->closure_approved_on;
                if (is_null($lastDocument->closure_approved_by) || $lastDocument->closure_approved_on === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }

                $history->action = 'HOD Final Review Complete';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Implementation verification by QA/CQA";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();
                //  $list = Helpers::getHodUserList();
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
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();
                // Helpers::hodMail($changeControl);
                toastr()->success('Sent to Closed Done');
                return back();
        }

        if ($changeControl->stage == 11) {
            if (is_null($updateCFT->implementation_verification_comments))
            {
                Session::flash('swal', [
                    'type' => 'warning',
                    'title' => 'Mandatory Fields!',
                    'message' => 'Implementation Verification Tab is yet to be filled'
                ]);

                return redirect()->back();
            }
             else {
                // dd($updateCFT->intial_update_comments);
                Session::flash('swal', [
                    'type' => 'success',
                    'title' => 'Success',
                    'message' => 'Document Sent'
                ]);
            }
            $changeControl->stage = "12";
            $changeControl->status = "QA/CQA Closure Approval";
            $comments->cc_id =$id;
            $comments->send_for_final_qa_head_approval = Auth::user()->name;
            $comments->send_for_final_qa_head_approval_on = Carbon::now()->format('d-M-Y');
            $comments->send_for_final_qa_head_approval_comment = $request->comments;

            $comments->save();
            $history = new RcmDocHistory();
            $history->cc_id = $id;

            $history->activity_type = 'Implementation verification by QA/CQA By, Implementation verification by QA/CQA On';
            if (is_null($lastDocument->send_for_final_qa_head_approval) || $lastDocument->send_for_final_qa_head_approval === '') {
                $history->previous = "NULL";
            } else {
                $history->previous = $lastDocument->send_for_final_qa_head_approval . ' , ' . $lastDocument->send_for_final_qa_head_approval_on;
            }
            $history->current = $comments->send_for_final_qa_head_approval . ' , ' . $comments->send_for_final_qa_head_approval_on;
            if (is_null($lastDocument->send_for_final_qa_head_approval) || $lastDocument->send_for_final_qa_head_approval_on === '') {
                $history->action_name = 'New';
            } else {
                $history->action_name = 'Update';
            }

            $history->action = 'Send For Final QA/CQA Head Approval';
            $history->comment = $request->comments;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "QA/CQA Closure Approval";
            $history->change_from = $lastDocument->status;
            $history->stage = 'Plan Proposed';
            $history->save();
            //  $list = Helpers::getHodUserList();
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
            $history = new CCStageHistory();
            $history->type = "Change-Control";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $changeControl->stage;
            $history->comments = $request->comments;
            $history->status = $changeControl->status;
            $history->save();

            $history = new CCStageHistory();
            $history->type = "Activity-log";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $changeControl->stage;
            $history->comments = $request->comments;
            $history->status = $changeControl->status;
            $history->save();
            // Helpers::hodMail($changeControl);
            toastr()->success('Sent to Closed Done');
            return back();
    }





    if ($changeControl->stage == 12) {
        if (is_null($changeControl->qa_closure_comments))
        {
            Session::flash('swal', [
                'type' => 'warning',
                'title' => 'Mandatory Fields!',
                'message' => 'Change Closure Tab is yet to be filled'
            ]);

            return redirect()->back();
        }
         else {
            // dd($updateCFT->intial_update_comments);
            Session::flash('swal', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Document Sent'
            ]);
        }
        $changeControl->stage = "13";
        $changeControl->status = "Closed Done";

        $comments->cc_id =$id;
        $comments->closure_approved_by = Auth::user()->name;
        $comments->closure_approved_on = Carbon::now()->format('d-M-Y');
        $comments->closure_approved_comment = $request->comments;

        $comments->save();


        $history = new RcmDocHistory();
        $history->cc_id = $id;

        $history->activity_type = 'QA/CQA Closure Approval By, Closure Approval On';
        if (is_null($lastDocument->closure_approved_by) || $lastDocument->closure_approved_by === '') {
            $history->previous = "NULL";
        } else {
            $history->previous = $lastDocument->closure_approved_by . ' , ' . $lastDocument->closure_approved_on;
        }
        $history->current = $comments->closure_approved_by . ' , ' . $changeControl->closure_approved_on;
        if (is_null($lastDocument->closure_approved_by) || $lastDocument->closure_approved_on === '') {
            $history->action_name = 'New';
        } else {
            $history->action_name = 'Update';
        }

        $history->action = 'Closure Approved';
        $history->comment = $request->comments;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to = "Closed Done";
        $history->change_from = $lastDocument->status;
        $history->stage = 'Plan Proposed';
        $history->save();
        //  $list = Helpers::getHodUserList();
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
        $history = new CCStageHistory();
        $history->type = "Change-Control";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $changeControl->stage;
        $history->comments = $request->comments;
        $history->status = $changeControl->status;
        $history->save();

        $history = new CCStageHistory();
        $history->type = "Activity-log";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $changeControl->stage;
        $history->comments = $request->comments;
        $history->status = $changeControl->status;
        $history->save();
        // Helpers::hodMail($changeControl);
        toastr()->success('Sent to Closed Done');
        return back();
}
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function stagereject(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = CC::find($id);
            $lastDocument = CC::find($id);
            $lastdata = ChangeControlComment::where('cc_id', $id)->first();
            $comment = ChangeControlComment::where('cc_id', $id)->firstOrCreate();
            $evaluation = Evaluation::where('cc_id', $id)->first();
            $updateCFT = CcCft::where('cc_id', $id)->latest()->first();



            if ($changeControl->stage == 12) {
                $changeControl->stage = "11";
                $changeControl->status = "QA/CQA Closure Approval";
                $changeControl->QaClouseToPostImplementationBy = Auth::user()->name;
                $changeControl->QaClouseToPostImplementationOn = Carbon::now()->format('d-M-Y');
                $changeControl->QaClouseToPostImplementationComment = $request->comments;

                $history = new RcmDocHistory();
                $history->cc_id = $id;

                // $history->activity_type = 'More Info Required By, More Info Required On';
                // if (is_null($lastDocument->QaClouseToPostImplementationBy) || $lastDocument->QaClouseToPostImplementationBy === '') {
                //     $history->previous = "NULL";
                // } else {
                //     $history->previous = $lastDocument->QaClouseToPostImplementationBy . ' , ' . $lastDocument->QaClouseToPostImplementationOn;
                // }
                // $history->current = $changeControl->QaClouseToPostImplementationBy . ' , ' . $changeControl->QaClouseToPostImplementationOn;
                // if (is_null($lastDocument->QaClouseToPostImplementationBy) || $lastDocument->QaClouseToPostImplementationOn === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "QA Closure Approval";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                //  $list = Helpers::getHodUserList();
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
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();
                // Helpers::hodMail($changeControl);
                toastr()->success('Sent to Implementation verification by QA/CQA');
                return back();

        }




            if ($changeControl->stage == 11) {
                $changeControl->stage = "9";
                $changeControl->status = "Pending Initiator Update";
                $changeControl->QaClouseToPostImplementationBy = Auth::user()->name;
                $changeControl->QaClouseToPostImplementationOn = Carbon::now()->format('d-M-Y');
                $changeControl->QaClouseToPostImplementationComment = $request->comments;

                $history = new RcmDocHistory();
                $history->cc_id = $id;

                // $history->activity_type = 'More Info Required By, More Info Required On';
                // if (is_null($lastDocument->QaClouseToPostImplementationBy) || $lastDocument->QaClouseToPostImplementationBy === '') {
                //     $history->previous = "NULL";
                // } else {
                //     $history->previous = $lastDocument->QaClouseToPostImplementationBy . ' , ' . $lastDocument->QaClouseToPostImplementationOn;
                // }
                // $history->current = $changeControl->QaClouseToPostImplementationBy . ' , ' . $changeControl->QaClouseToPostImplementationOn;
                // if (is_null($lastDocument->QaClouseToPostImplementationBy) || $lastDocument->QaClouseToPostImplementationOn === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Pending Initiator Update";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                //  $list = Helpers::getHodUserList();
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
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();
                // Helpers::hodMail($changeControl);
                toastr()->success('Sent to Pending Initiator Update');
                return back();

        }







            if ($changeControl->stage == 10) {
                    $changeControl->stage = "9";
                    $changeControl->status = "Pending Initiator Update";
                    $changeControl->QaClouseToPostImplementationBy = Auth::user()->name;
                    $changeControl->QaClouseToPostImplementationOn = Carbon::now()->format('d-M-Y');
                    $changeControl->QaClouseToPostImplementationComment = $request->comments;

                    $history = new RcmDocHistory();
                    $history->cc_id = $id;

                    // $history->activity_type = 'More Info Required By, More Info Required On';
                    // if (is_null($lastDocument->QaClouseToPostImplementationBy) || $lastDocument->QaClouseToPostImplementationBy === '') {
                    //     $history->previous = "NULL";
                    // } else {
                    //     $history->previous = $lastDocument->QaClouseToPostImplementationBy . ' , ' . $lastDocument->QaClouseToPostImplementationOn;
                    // }
                    // $history->current = $changeControl->QaClouseToPostImplementationBy . ' , ' . $changeControl->QaClouseToPostImplementationOn;
                    // if (is_null($lastDocument->QaClouseToPostImplementationBy) || $lastDocument->QaClouseToPostImplementationOn === '') {
                    //     $history->action_name = 'New';
                    // } else {
                    //     $history->action_name = 'Update';
                    // }
                    $history->activity_type = 'Not Applicable';
                    $history->previous = 'Not Applicable';
                    $history->action_name = 'Not Applicable';
                    $history->action = 'More Info Required';
                    $history->current = 'Not Applicable';
                    $history->action = 'More Info Required';
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to = "Pending Initiator Update";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();

                    //  $list = Helpers::getHodUserList();
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
                    $history = new CCStageHistory();
                    $history->type = "Change-Control";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();

                    $history = new CCStageHistory();
                    $history->type = "Activity-log";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();
                    // Helpers::hodMail($changeControl);
                    toastr()->success('Sent to Post Implementation');
                    return back();

            }
            if ($changeControl->stage == 9) {
                    $changeControl->stage = "7";
                    $changeControl->status = "QA/CQA Head/Manager Designee Approval";
                    $changeControl->postImplementationToQaHeadBy = Auth::user()->name;
                    $changeControl->postImplementationToQaHeadOn = Carbon::now()->format('d-M-Y');
                    $changeControl->postImplementationToQaHeadComment = $request->comments;

                    $history = new RcmDocHistory();
                    $history->cc_id = $id;

                    // $history->activity_type = 'More Info Required By, More Info Required On';
                    // if (is_null($lastDocument->postImplementationToQaHeadBy) || $lastDocument->postImplementationToQaHeadBy === '') {
                    //     $history->previous = "NULL";
                    // } else {
                    //     $history->previous = $lastDocument->postImplementationToQaHeadBy . ' , ' . $lastDocument->postImplementationToQaHeadOn;
                    // }
                    // $history->current = $changeControl->postImplementationToQaHeadBy . ' , ' . $changeControl->postImplementationToQaHeadOn;
                    // if (is_null($lastDocument->postImplementationToQaHeadBy) || $lastDocument->postImplementationToQaHeadOn === '') {
                    //     $history->action_name = 'New';
                    // } else {
                    //     $history->action_name = 'Update';
                    // }
                    $history->activity_type = 'Not Applicable';
                    $history->previous = 'Not Applicable';
                    $history->action_name = 'Not Applicable';
                    $history->action = 'More Info Required';
                    $history->current = 'Not Applicable';
                    $history->action = 'More Info Required';
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to = "QA/CQA Head/Manager Designee Approval";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();
                    //  $list = Helpers::getHodUserList();
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
                    $history = new CCStageHistory();
                    $history->type = "Change-Control";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();

                    $history = new CCStageHistory();
                    $history->type = "Activity-log";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->comments = $request->comments;
                    $history->status = $changeControl->status;
                    $history->save();
                    // Helpers::hodMail($changeControl);
                    toastr()->success('Sent to QA Head/Manager Designee Approval');
                    return back();
            }
            if ($changeControl->stage == 7) {
                $changeControl->stage = "5";
                $changeControl->status = "QA/CQA Final Review";

                $comment->cc_id = $id;
                $comment->QaHeadToQaFinalBy = Auth::user()->name;
                $comment->QaHeadToQaFinalOn = Carbon::now()->format('d-M-Y');
                $comment->QaHeadToQaFinalComment = $request->comments;
                $comment->save();

                $history = new RcmDocHistory();
                $history->cc_id = $id;

                // $history->activity_type = 'More Info Required By, More Info Required On';
                // if (is_null($lastDocument->QaHeadToQaFinalBy) || $lastDocument->QaHeadToQaFinalBy === '') {
                //     $history->previous = "NULL";
                // } else {
                //     $history->previous = $lastDocument->QaHeadToQaFinalBy . ' , ' . $lastDocument->QaHeadToQaFinalOn;
                // }
                // $history->current = $changeControl->QaHeadToQaFinalBy . ' , ' . $changeControl->QaHeadToQaFinalOn;
                // if (is_null($lastDocument->QaHeadToQaFinalBy) || $lastDocument->QaHeadToQaFinalOn === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "QA/CQA Final Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                //  $list = Helpers::getHodUserList();
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
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();
                // Helpers::hodMail($changeControl);
                toastr()->success('Sent to Pending RA Approval');
                return back();
            }
            if ($changeControl->stage == 5) {
                $changeControl->stage = "4";
                $changeControl->status = "CFT Review";

                $comment->cc_id = $id;
                $comment->comment = Auth::user()->name;
                $comment->comment = Carbon::now()->format('d-M-Y');
                $comment->comment = $request->comments;
                $comment->save();

                $history = new RcmDocHistory();
                $history->cc_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = "";
                $history->action = 'More Info Required';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "CFT Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();
                //  $list = Helpers::getHodUserList();
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
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();
                // Helpers::hodMail($changeControl);
                toastr()->success('Sent to CFT Review');
                return back();
            }
            if ($changeControl->stage == 4) {
                $changeControl->stage = "3";
                $changeControl->status = "QA/CQA Initial Review";

                $comment->cc_id = $id;
                $comment->cftToQaInitialBy = Auth::user()->name;
                $comment->cftToQaInitialOn = Carbon::now()->format('d-M-Y');
                $comment->cftToQaInitialComment = $request->comments;
                $comment->save();

                $history = new RcmDocHistory();
                $history->cc_id = $id;

                // $history->activity_type = 'More Info Required By, More Info Required On';
                // if (is_null($lastDocument->cftToQaInitialBy) || $lastDocument->cftToQaInitialBy === '') {
                //     $history->previous = "NULL";
                // } else {
                //     $history->previous = $lastDocument->cftToQaInitialBy . ' , ' . $lastDocument->cftToQaInitialOn;
                // }
                // $history->current = $changeControl->cftToQaInitialBy . ' , ' . $changeControl->cftToQaInitialOn;
                // if (is_null($lastDocument->cftToQaInitialBy) || $lastDocument->cftToQaInitialOn === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "QA/CQA Initial Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();
                //  $list = Helpers::getHodUserList();
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
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();
                toastr()->success('Sent to QA/CQA Initial Review');
                return back();
            }
            if ($changeControl->stage == 3) {
                $changeControl->stage = "2";
                $changeControl->status = "HOD Review";

                $comment->cc_id = $id;
                $comment->QaInitialToHodBy = Auth::user()->name;
                $comment->QaInitialToHodOn = Carbon::now()->format('d-M-Y');
                $comment->QaInitialToHodComment = $request->comments;
                $comment->save();

                $history = new RcmDocHistory();
                $history->cc_id = $id;

                // $history->activity_type = 'More Info Required By, More Info Required On';
                // if (is_null($lastdata->QaInitialToHodBy) || $lastdata->QaInitialToHodBy === '') {
                //     $history->previous = "NULL";
                // } else {
                //     $history->previous = $lastdata->QaInitialToHodBy . ' , ' . $lastdata->QaInitialToHodOn;
                // }
                // $history->current = $changeControl->QaInitialToHodBy . ' , ' . $changeControl->QaInitialToHodOn;
                // if (is_null($lastdata->QaInitialToHodBy) || $lastdata->QaInitialToHodOn === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "HOD Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();
                //  $list = Helpers::getHodUserList();
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
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->comments = $request->comments;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                // Helpers::hodMail($changeControl);
                toastr()->success('Sent to HOD Review');
                return back();
            }
            if ($changeControl->stage == 2) {
                $changeControl->stage = "1";
                $changeControl->status = "Opened";

                $comment->cc_id = $id;
                $comment->HodToOpenedBy = Auth::user()->name;
                $comment->HodToOpenedOn = Carbon::now()->format('d-M-Y');
                $comment->HodToOpenedComment = $request->comments;
                $comment->save();

                $history = new RcmDocHistory();
                $history->cc_id = $id;

                // $history->activity_type = 'More Info Required By, More Info Required On';
                // if (is_null($lastdata->HodToOpenedBy) || $lastdata->HodToOpenedBy === '') {
                //     $history->previous = "NULL";
                // } else {
                //     $history->previous = $lastdata->HodToOpenedBy . ' , ' . $lastdata->HodToOpenedOn;
                // }
                // $history->current = $comment->HodToOpenedBy . ' , ' . $comment->HodToOpenedOn;
                // if (is_null($lastdata->HodToOpenedBy) || $lastdata->HodToOpenedOn === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Opened";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();
                //  $list = Helpers::getHodUserList();
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
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->comments = $request->comments;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                // Helpers::hodMail($changeControl);
                toastr()->success('Sent to Opened');
                return back();
            }
            if ($changeControl->stage == 1) {
                $changeControl->stage = "0";
                $changeControl->status = "Close - Cancelled";

                $comment->cc_id = $id;
                $comment->openedToCancelBy = Auth::user()->name;
                $comment->openedToCancelOn = Carbon::now()->format('d-M-Y');
                $comment->openedToCancelComment = $request->comments;
                $comment->save();

                $history = new RcmDocHistory();
                $history->cc_id = $id;

                $history->activity_type = 'Cancel By, Cancel On';
                if (is_null($lastDocument->openedToCancelBy) || $lastDocument->openedToCancelBy === '') {
                    $history->previous = "NULL";
                } else {
                    $history->previous = $lastDocument->openedToCancelBy . ' , ' . $lastDocument->openedToCancelOn;
                }
                $history->current = $changeControl->openedToCancelBy . ' , ' . $changeControl->openedToCancelOn;
                if (is_null($lastDocument->openedToCancelBy) || $lastDocument->openedToCancelOn === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }

                $history->action = 'Cancel';
                $history->comment = $request->comments;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Close - Cancelled";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();
                //  $list = Helpers::getHodUserList();
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
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->comments = $request->comments;
                $history->status = $changeControl->status;
                $history->save();

                $history = new CCStageHistory();
                $history->type = "Activity-log";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->comments = $request->comments;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                // Helpers::hodMail($changeControl);
                toastr()->success('Sent to Close - Cancelled');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function sendToInitiator(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = CC::find($id);
            $lastDocument = CC::find($id);
            $cftResponse = ChangeControlCftResponse::withoutTrashed()->where(['cc_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();
            $cftResponse->each(function ($response) {
            $response->delete();
        });

        $changeControl->stage = "1";
        $changeControl->status = "Opened";
        $changeControl->qa_final_to_initiator_by = Auth::user()->name;
        $changeControl->qa_final_to_initiator_on = Carbon::now()->format('d-M-Y');
        $changeControl->qa_final_to_initiator_comment = $request->comments;

        $history = new RcmDocHistory();
        $history->cc_id = $id;

        $history->activity_type = 'Send To Initiator By, Send To Initiator On';
        if (is_null($lastDocument->qa_final_to_initiator_by) || $lastDocument->qa_final_to_initiator_by === '') {
            $history->previous = "NULL";
        } else {
            $history->previous = $lastDocument->qa_final_to_initiator_by . ' , ' . $lastDocument->qa_final_to_initiator_on;
        }
        $history->current = $changeControl->qa_final_to_initiator_by . ' , ' . $changeControl->qa_final_to_initiator_on;
        if (is_null($lastDocument->qa_final_to_initiator_by) || $lastDocument->qa_final_to_initiator_on === '') {
            $history->action_name = 'New';
        } else {
            $history->action_name = 'Update';
        }

        $history->action = 'Send To Initiator';
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to = "Opened";
        $history->change_from = $lastDocument->status;
        $history->save();
        $changeControl->update();

        $history = new RcmDocHistory();
        $history->type = "CC";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $changeControl->stage;
        $history->status = "Send to Opened State";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $changeControl->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $changeControl],
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
        $changeControl->update();
        toastr()->success('Document Sent');
        return back();

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function sendToHod(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = CC::find($id);
            $lastDocument = CC::find($id);
            $cftResponse = ChangeControlCftResponse::withoutTrashed()->where(['cc_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();
            $cftResponse->each(function ($response) {
            $response->delete();
        });


        $changeControl->stage = "2";
        $changeControl->status = "HOD Review";
        $changeControl->qa_final_to_HOD_by = Auth::user()->name;
        $changeControl->qa_final_to_HOD_on = Carbon::now()->format('d-M-Y');
        $changeControl->qa_final_to_HOD_comment = $request->comments;

        $history = new RcmDocHistory();
        $history->cc_id = $id;

        $history->activity_type = 'Send To HOD By, Send To HOD On';
        if (is_null($lastDocument->qa_final_to_HOD_by) || $lastDocument->qa_final_to_HOD_by === '') {
            $history->previous = "NULL";
        } else {
            $history->previous = $lastDocument->qa_final_to_HOD_by . ' , ' . $lastDocument->qa_final_to_HOD_on;
        }
        $history->current = $changeControl->qa_final_to_HOD_by . ' , ' . $changeControl->qa_final_to_HOD_on;
        if (is_null($lastDocument->qa_final_to_HOD_by) || $lastDocument->qa_final_to_HOD_on === '') {
            $history->action_name = 'New';
        } else {
            $history->action_name = 'Update';
        }

        $history->action= 'Send To HOD';
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "HOD Review";
        $history->change_from = $lastDocument->status;
        $history->save();
        $changeControl->update();

        $history = new RcmDocHistory();
        $history->type = "CC";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $changeControl->stage;
        $history->status = "Send HOD Review";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $changeControl->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $changeControl],
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
        $changeControl->update();
        toastr()->success('Document Sent');
        return back();

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function sendToInitialQA(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = CC::find($id);
            $lastDocument = CC::find($id);
            $cftResponse = ChangeControlCftResponse::withoutTrashed()->where(['cc_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();
            $cftResponse->each(function ($response) {
            $response->delete();
        });


        $changeControl->stage = "3";
        $changeControl->status = "QA/CQA Initial Review";
        $changeControl->qa_final_to_qainital_by = Auth::user()->name;
        $changeControl->qa_final_to_qainital_on = Carbon::now()->format('d-M-Y');
        $changeControl->qa_final_to_qainital_comment = $request->comments;

        $history = new RcmDocHistory();
        $history->cc_id = $id;

        $history->activity_type = 'Send To QA/CQA Initial By, Send To QA/CQA Initial On';
        if (is_null($lastDocument->qa_final_to_qainital_by) || $lastDocument->qa_final_to_qainital_by === '') {
            $history->previous = "NULL";
        } else {
            $history->previous = $lastDocument->qa_final_to_qainital_by . ' , ' . $lastDocument->qa_final_to_qainital_on;
        }
        $history->current = $changeControl->qa_final_to_qainital_by . ' , ' . $changeControl->qa_final_to_qainital_on;
        if (is_null($lastDocument->qa_final_to_qainital_by) || $lastDocument->qa_final_to_qainital_on === '') {
            $history->action_name = 'New';
        } else {
            $history->action_name = 'Update';
        }

        $history->action= 'Send To QA/CQA Initial';
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to =   "QA/CQA Initial Review";
        $history->change_from = $lastDocument->status;
        $history->save();
        $changeControl->update();

        $history = new RcmDocHistory();
        $history->type = "CC";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $changeControl->stage;
        $history->status = "Sent to QA Initial Review";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $changeControl->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $changeControl],
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
        $changeControl->update();
        toastr()->success('Document Sent');
        return back();

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function stagecancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = CC::find($id);
            $openState = CC::find($id);
            $lastDocument = CC::find($id);

            $changeControl->stage = "0";
            $changeControl->status = "Closed-Cancelled";
            $changeControl->cancelled_by = Auth::user()->name;
            $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
            $changeControl->cancelled_comment = $request->comments;
            $changeControl->update();

            $history = new RcmDocHistory();
            $history->cc_id = $id;

            $history->activity_type = 'Cancel By, Cancel On';
            if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                $history->previous = "NULL";
            } else {
                $history->previous = $lastDocument->cancelled_by . ' , ' . $lastDocument->cancelled_on;
            }
            $history->current = $changeControl->cancelled_by . ' , ' . $changeControl->cancelled_on;
            if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_on === '') {
                $history->action_name = 'New';
            } else {
                $history->action_name = 'Update';
            }

            $history->action= 'Cancel';
            $history->comment = $request->comments;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Closed - Cancelled";
            $history->change_from = $lastDocument->status;
            $history->stage = 'Plan Proposed';
            $history->save();

            $history = new CCStageHistory();
            $history->type = "Change-Control";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $changeControl->stage;
            $history->status = $changeControl->status;
            $history->save();
            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
    public function child(Request $request, $id)
    {
        $cc = CC::find($id);
        $parent_id = $id;
        $parent_name = "CC";
        $parent_type = "CC";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');

        $parent_data = CC::where('id', $id)->select('record', 'division_id', 'initiator_id', 'short_description')->first();
        $parent_data1 = CC::select('record', 'division_id', 'initiator_id', 'id')->get();
        $parent_record = CC::where('id', $id)->value('record');
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_division_id = CC::where('id', $id)->value('division_id');
        $parent_initiator_id = CC::where('id', $id)->value('initiator_id');
        $parent_intiation_date = CC::where('id', $id)->value('intiation_date');
        $parent_short_description = CC::where('id', $id)->value('short_description');
        $old_record = CC::select('id', 'division_id', 'record')->get();
        $relatedRecords = Helpers::getAllRelatedRecords();


     //   $data =$parent_data1;
        if ($request->revision == "Action-Item") {
            $p_record = CC::find($id);
            $data_record = Helpers::getDivisionName($p_record->division_id ) . '/' . 'CC' .'/' . date('Y') .'/' . str_pad($p_record->record, 4, '0', STR_PAD_LEFT);
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.action-item.action-item', compact('parent_record','parent_id', 'parent_name', 'record', 'cc', 'parent_data', 'parent_data1', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id', 'due_date', 'old_record', 'parent_type', 'data_record'));
        }
        if ($request->revision == "RCA") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.forms.root-cause-analysis', compact('parent_record','parent_type','parent_id', 'parent_name', 'record_number', 'cc', 'parent_data', 'parent_data1', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id', 'due_date', 'old_record'));
        }
        if ($request->revision == "Capa") {
            $old_records = $old_record;
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            $Capachild =CC::find($id);
            $reference_record = Helpers::getDivisionName($Capachild->division_id ) . '/' . 'CC' .'/' . date('Y') .'/' . str_pad($Capachild->record, 4, '0', STR_PAD_LEFT);
            return view('frontend.forms.capa', compact('parent_record','parent_id','parent_type', 'parent_name', 'record_number', 'cc', 'parent_data', 'parent_data1', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id', 'due_date', 'old_records','relatedRecords','reference_record'));
        }
        if ($request->revision == "Extension") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            $relatedRecords = Helpers::getAllRelatedRecords();
            $data=CC::find($id);
        $extension_record = Helpers::getDivisionName($data->division_id ) . '/' . 'CC' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
            

         $count = Helpers::getChildData($id, $parent_type);
         $countData = $count + 1; 
        return view('frontend.extension.extension_new', compact('parent_name', 'parent_type', 'parent_id', 'record_number','extension_record', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id', 'parent_record', 'cc','relatedRecords','countData'));
        }
        if ($request->revision == "New Document") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return redirect()->route('documents.create');

        }


        if ($request->revision == "Effective-Check") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.forms.effectiveness-check', compact('parent_record','parent_type','parent_id', 'parent_name', 'record_number', 'cc', 'parent_data', 'parent_data1', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id', 'due_date', 'old_record',));
        }
        else{
            toastr()->warning('Not Working');
            return back();
        }
    }

    public function auditTrial($id)
    {
        $audit = RcmDocHistory::where('cc_id', $id)->orderByDESC('id')->paginate(200);
        // dd($audit);
        $today = Carbon::now()->format('d-m-y');
        $document = CC::where('id', $id)->first();
        $document->originator = User::where('id', $document->initiator_id)->value('name');

        $users = User::all();
        return view('frontend.rcms.CC.audit-trial', compact('audit', 'document', 'today','users'));
    }





    public function audit_trail_filter(Request $request,$id)
                {
                   $query= RcmDocHistory::query();
                             $query->where('cc_id',$id);

                     if($request->filled('typedata'))
                     {
                        switch($request->typedata)
                        {
                            case 'cft_review':

                                $cft_field= ['CFT Review Complete'];
                                $query->where('action',$cft_field);
                                break;

                             case 'stage':

                                $stage = ['Submit By, Submit On','HOD Assessment Complete By,
                                 HOD Assessment Complete On','QA/CQA Initial Assessment Complete By, QA/CQA Initial Assessment Complete On','CFT Assessment Complete By','RA Approval By, RA Approval On','RA Approval Complete By, RA Approval Complete On','Rejected By, Rejected On','QA/CQA Final Review Complete By, QA/CQA Final Review Complete On','QA/CQA Head/Manager Designee Approval By, QA/CQA Head/Manager Designee ApprovalOn','Initiator Updated Complete By, Initiator Updated Complete On','HOD Final Review Complete By, HOD Final Review Complete On', 'Implementation verification by QA/CQA Complete By, Implementation verification by QA/CQA Complete On','QA/CQA Head/Manager Designee Approval By, QA/CQA Head/Manager Designee Approval On','Pending Initiator Update By, Pending Initiator Update On','Approved By, Approved On','HOD Final Review Complete By, HOD Final Review Complete On','Implementation verification by QA/CQA By, Implementation verification by CQA/QA On','QA/CQA Closure Approval By, Closure Approval On','More Info Required By, More Info Required On'];





                                $query->whereIn('activity_type',$stage);
                                break;

                                case 'user_action':
                                    $user_action = [
                                        'Submit', 'HOD Assessment Complete', 'QA/CQA Initial Assessment Complete','CFT Assessment Complete', 'RA Approval Required','RA Approval Complete', 'Approved','QA/CQA Final Review Complete','HOD Final Review Complete','Initiator Updated Complete','Rejected', 'Send For Final QA/CQA Head Approval','Send For Final Approval','Closure Approved','More Info Required','Send To Initiator','Send To HOD','Send To QA/CQA Initial','Initiator Updated Completed', 'More Info Required','More Info Required','Cancel','More Info Required','Cancel','Rejected'
                                    ];
                                $query->whereIn('action',$user_action);
                                break;



                                case 'notification':
                                    $notification = [ 'user notification'

                                    ];
                                $query->where('action',$notification);
                                break;



                                case 'business':
                                    $business = [ 'business'

                                    ];
                                $query->where('action',$business);
                                break;
                              default;
                              break;
                        }

                     }
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

                    $filter_request = true;

                    $responseHtml = view('frontend.rcms.CC.CC_filter', compact('audit', 'filter_request'))->render();

                 return response()->json(['html' => $responseHtml]);



                }
    public function auditDetails($id)
    {
        $detail = RcmDocHistory::find($id);
        $detail_data = RcmDocHistory::where('activity_type', $detail->activity_type)->where('cc_id', $detail->cc_id)->latest()->get();
        $doc = CC::where('id', $detail->cc_id)->first();
        $doc->origiator_name = User::find($doc->initiator_id);
        return view('frontend.rcms.CC.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
    }



    public function summery_pdf($id)
    {
        $data = CC::find($id);
        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
        } else {
            $datas = ActionItem::find($id);

            if (empty($datas)) {
                $datas = Extension::find($id);
                $data = CC::find($datas->cc_id);
                $data->originator = User::where('id', $data->initiator_id)->value('name');
                $data->created_at = $datas->created_at;
            } else {
                $data = CC::find($datas->cc_id);
                $data->originator = User::where('id', $data->initiator_id)->value('name');
                $data->created_at = $datas->created_at;
            }
        }

        // pdf related work
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.change-control.summary_pdf', compact('data', 'time'))
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

        $canvas->page_text(
            $width / 3,
            $height / 2,
            $data->status,
            null,
            60,
            [0, 0, 0],
            2,
            6,
            -20
        );

        if ($data->documents) {

            $pdfArray = explode(',', $data->documents);
            foreach ($pdfArray as $pdfFile) {
                $existingPdfPath = public_path('upload/PDF/' . $pdfFile);
                $permissions = 0644; // Example permission value, change it according to your needs
                if (file_exists($existingPdfPath)) {
                    // Create a new Dompdf instance
                    $options = new Options();
                    $options->set('chroot', public_path());
                    $options->set('isPhpEnabled', true);
                    $options->set('isRemoteEnabled', true);
                    $options->set('isHtml5ParserEnabled', true);
                    $options->set('allowedFileExtensions', ['pdf']); // Allow PDF file extension

                    $dompdf = new Dompdf($options);

                    chmod($existingPdfPath, $permissions);

                    // Load the existing PDF file
                    $dompdf->loadHtmlFile($existingPdfPath);

                    // Render the PDF
                    $dompdf->render();

                    // Output the PDF to the browser
                    $dompdf->stream();
                }
            }
        }

        return $pdf->stream('SOP' . $id . '.pdf');
    }

    public function audit_pdf($id)
    {
        $doc = CC::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        } else {
            $datas = ActionItem::find($id);

            if (empty($datas)) {
                $datas = Extension::find($id);
                $doc = CC::find($datas->cc_id);
                $doc->originator = User::where('id', $doc->initiator_id)->value('name');
                $doc->created_at = $datas->created_at;
            } else {
                $doc = CC::find($datas->cc_id);
                $doc->originator = User::where('id', $doc->initiator_id)->value('name');
                $doc->created_at = $datas->created_at;
            }
        }
        $data = RcmDocHistory::where('cc_id', $doc->id)->orderBy('id')->get();
        
        // pdf related work
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();

        $pdf = PDF::loadview('frontend.change-control.audit_trial_pdf', compact('data', 'doc'))
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

        $canvas->page_text(
            $width / 3,
            $height / 2,
            $doc->status,
            null,
            60,
            [0, 0, 0],
            2,
            6,
            -20
        );



        return $pdf->stream('SOP' . $id . '.pdf');
    }

    public function ccView($id)
    {

        $data = CC::find($id);
        if (empty($data)) {
            $data = ActionItem::find($id);
            if (empty($data)) {
                $data = Extension::find($id);
            }
        }
        $html = '';
        $html = '<div class="block">
        <div class="record_no">
            Record No. ' . str_pad($data->record, 4, '0', STR_PAD_LEFT) .
            '</div>
        <div class="short_desc">' .
            $data->short_description . '
        </div>
        <div class="division">
            QMS - EMEA / Change Control
        </div>
        <div class="status">' .
            $data->status . '
        </div>
            </div>
            <div class="block">
                <div class="block-head">
                    Actions
                </div>
                <div class="block-list">
                    <a href="/rcms/audit/' . $data->id . '" class="list-item">View History</a>
                    <a href="send-notification" class="list-item">Send Notification</a>
                    <div class="list-drop">
                        <div class="list-item" onclick="showAction()">
                            <div>Run Report</div>
                            <div><i class="fa-solid fa-angle-down"></i></div>
                        </div>
                        <div class="drop-list">
                            <a target="_blank" href="summary/' . $data->id . '" class="inner-item">Change Control Summary</a>
                            <a target="_blank" href="/rcms/audit/' . $data->id . '" class="inner-item">Audit Trail</a>
                            <a target="_blank" href="/rcms/change_control_single_pdf/' . $data->id . '" class="inner-item">Change Control Single Report</a>
                            <a target="_blank" href="/rcms/change_control_family_pdf" class="inner-item">Change Control Parent with Immediate Child</a>
                        </div>
                    </div>
                </div>
            </div>';
        $response['html'] = $html;

        return response()->json($response);
    }
    public function single_pdf($id)
    {


        $data = CC::find($id);
        $cftData =  CcCft::where('cc_id', $id)->first();
        $cc_cfts =  CcCft::where('cc_id', $id)->first();

        $QaApprovalComments = QaApprovalComments::where('cc_id', $id)->first();

        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $preRiskAssessment = RiskAssessment::where('cc_id', $data->id)->get(); // Adjust this condition based on your actual requirement


            $docdetail = Docdetail::where('cc_id', $data->id)->first();
            $review = Qareview::where('cc_id', $data->id)->first();
            $evaluation = Evaluation::where('cc_id', $data->id)->first();
            $info = AdditionalInformation::where('cc_id', $data->id)->first();
            $comments = GroupComments::where('cc_id', $data->id)->first();
            $assessment = RiskAssessment::where('cc_id', $data->id)->first();
            $approcomments = QaApprovalComments::where('cc_id', $data->id)->first();
            $closure = ChangeClosure::where('cc_id', $data->id)->first();
            $json_decode = Docdetail::where(['cc_id' => $data->id, 'identifier' =>'AffectedDocDetail'])->first();
            $affectedDoc = json_decode($json_decode->data, true);
            $commnetData = DB::table('change_control_comments')->where('cc_id', $data->id)->first();





            $cft_teamIdsArray = explode(',', $data->reviewer_person_value);
            $cft_teamNames = User::whereIn('id', $cft_teamIdsArray)->pluck('name')->toArray();
            $cft_teamNamesString = implode(', ', $cft_teamNames);




            // pdf related work
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.change-control.change_control_single_pdf', compact(
                'data',
                'docdetail',
                'cftData',
                'cc_cfts',
                'review',
                'evaluation',
                'info',
                'comments',
                'assessment',
                'approcomments',
                'closure',
                'affectedDoc',
                'commnetData',
                'QaApprovalComments',
                'cft_teamNamesString',
                'preRiskAssessment'
            ))
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

            $canvas->page_text(
                $width / 4,
                $height / 2,
                $data->status,
                null,
                25,
                [0, 0, 0],
                2,
                6,
                -20
            );



            return $pdf->stream('SOP' . $id . '.pdf');
        }
    }


    public function parent_child()
    {



        // pdf related work
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.change-control.change_control_family_pdf')
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

        $canvas->page_text(
            $width / 4,
            $height / 2,
            "Opened",
            null,
            25,
            [0, 0, 0],
            2,
            6,
            -20
        );



        return $pdf->stream('SOP.pdf');
    }

    public function eCheck($id)
    {
        $data = CC::find($id);
        return view('frontend.effectivenessCheck.create', compact('data'));
    }

    public function ImpactUpdate($id)
    {
    }

    public function changeControlEffectivenessCheck(Request $request, $id)
    {
        $cc = CC::find($id);
        $parent_id = $id;
        $parent_name = "CC";
        $parent_type = "CC";

        $parent_record = CC::where('id', $id)->value('record');
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);

        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');

        return view("frontend.forms.effectiveness-check", compact('due_date','parent_record','parent_id','parent_type', 'parent_name', 'record_number'));
    }
}
