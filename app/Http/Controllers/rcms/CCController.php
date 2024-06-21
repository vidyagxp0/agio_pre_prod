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
use App\Models\CcCft;
use App\Models\Evaluation;
use App\Models\Extension;
use App\Models\GroupComments;
use App\Models\QaApprovalComments;
use App\Models\Qareview;
use App\Models\QMSDivision;
use App\Models\RiskAssessment;
use App\Models\RcmDocHistory;
use App\Models\RiskLevelKeywords;
use App\Models\RoleGroup;
use App\Models\User;
// use Barryvdh\DomPDF\PDF;
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

        $division = QMSDivision::where('name', Helpers::getDivisionName(session()->get('division')))->first();

        if ($division) {
            $last_cc = CC::where('division_id', $division->id)->latest()->first();

            if ($last_cc) {
                $record_number = $last_cc->record_number ? str_pad($last_cc->record_number->record_number + 1, 4, '0', STR_PAD_LEFT) : '0001';
            } else {
                $record_number = '0001';
            }
        }

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $hod = User::get();
        $cft = User::get();
        $pre = CC::all();

        return view('frontend.change-control.new-change-control', compact("riskData", "record_number", "due_date", "hod", "cft", "pre"));
    }

    public function store(Request $request)
    {
        $openState = new CC();
        $openState->form_type = "CC";
        $openState->division_id = $request->division_id;
        $openState->initiator_id = Auth::user()->id;
        $openState->record = DB::table('record_numbers')->value('counter') + 1;
        $openState->parent_id = $request->parent_id;
        $openState->parent_type = $request->parent_type;
        $openState->intiation_date = $request->intiation_date;
        $openState->Initiator_Group = $request->Initiator_Group;
        $openState->initiator_group_code = $request->initiator_group_code;
        $openState->short_description = $request->short_description;
        // $openState->assign_to = $request->assign_to;
        // $openState->Division_Code = $request->div_code;
        $openState->related_records = json_encode($request->related_records);
        $openState->risk_assessment_related_record = json_encode($request->risk_assessment_related_record);
        $openState->risk_assessment_required = $request->risk_assessment_required;
        //$openState->qa_eval_attach = json_encode($request->qa_eval_attach);
        // $openState->Microbiology = $request->Microbiology;
        // $openState->due_date = Carbon::now()->addDays(30)->format('d-M-Y');
        $openState->hod_person = $request->hod_person;
        $openState->doc_change = $request->natureChange;
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

        $openState->type_chnage = $request->type_chnage;
        $openState->qa_comments = $request->qa_comments;
        $openState->related_records = implode(',', $request->related_records);
        $openState->qa_head = json_encode($request->qa_head);

        $openState->qa_eval_comments = json_encode($request->qa_eval_comments);
        $openState->training_required = $request->training_required;
        $openState->train_comments = $request->train_comments;

        //     $openState->Microbiology_Person = implode(',', $request->Microbiology_Person);
        $openState->goup_review = $request->goup_review;
        $openState->Production = $request->Production;
        $openState->Production_Person = $request->Production_Person;
        $openState->Quality_Approver = $request->Quality_Approver;
        $openState->Quality_Approver_Person = $request->Quality_Approver_Person;
        $openState->bd_domestic = $request->bd_domestic;
        $openState->Bd_Person = $request->Bd_Person;
        $openState->additional_attachments = json_encode($request->additional_attachments);

        $openState->cft_comments = $request->cft_comments;
        $openState->cft_comments = $request->cft_comments;
        $openState->cft_attchament = json_encode($request->cft_attchament);
        $openState->qa_commentss = $request->qa_commentss;
        $openState->designee_comments = $request->designee_comments;
        $openState->Warehouse_comments = $request->Warehouse_comments;
        $openState->Engineering_comments = $request->Engineering_comments;
        $openState->Instrumentation_comments = $request->Instrumentation_comments;
        $openState->Validation_comments = $request->Validation_comments;
        $openState->Others_comments = $request->Others_comments;
        $openState->Group_comments = $request->Group_comments;
        $openState->group_attachments = json_encode($request->group_attachments);

        $openState->risk_identification = $request->risk_identification;
        $openState->severity = $request->severity;
        $openState->Occurance = $request->Occurance;
        $openState->Detection = $request->Detection;
        $openState->RPN = $request->RPN;
        $openState->risk_evaluation = $request->risk_evaluation;
        $openState->migration_action = $request->migration_action;

        $openState->qa_appro_comments = $request->qa_appro_comments;
        $openState->feedback = $request->feedback;
        $openState->tran_attach = json_encode($request->tran_attach);

        $openState->qa_closure_comments = $request->qa_closure_comments;
        $openState->attach_list = json_encode($request->attach_list);
        $openState->effective_check = $request->effective_check;
        $openState->effective_check_date = $request->effective_check_date;
        $openState->Effectiveness_checker = $request->Effectiveness_checker;
        $openState->effective_check_plan = $request->effective_check_plan;
        $openState->due_date_extension = $request->due_date_extension;


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

        // $Cft->Other1_review = $request->Other1_review;
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

        if (!empty ($request->production_attachment)) {
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
        if (!empty ($request->Warehouse_attachment)) {
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
        if (!empty ($request->Analytical_Development_attachment)) {
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
        if (!empty ($request->Kilo_Lab_attachment)) {
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
        if (!empty ($request->Technology_transfer_attachment)) {
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
        if (!empty ($request->Project_management_attachment)) {
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

            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Inititator';
            $history->previous = "Null";
            $history->current = Auth::user()->name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Initiation Date';
            $history->previous = "Null";
            $history->current = $openState->intiation_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Inititator Group';
            $history->previous = "Null";
            $history->current = $openState->Initiator_Group;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $openState->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

        if(!empty($request->assign_to)){            
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Assigned To';
            $history->previous = "Null";
            $history->current = $openState->assign_to;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->hod_person)){            
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'HOD Person';
            $history->previous = "Null";
            $history->current = $openState->hod_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->risk_assessment_required)){            
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Risk Assessment Required';
            $history->previous = "Null";
            $history->current = $openState->risk_assessment_required;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
  
           
        
        if(!empty($request->doc_change)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Supporting Documents';
            $history->previous = "Null";
            $history->current = $openState->doc_change;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->If_Others)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'If Others';
            $history->previous = "Null";
            $history->current = $openState->If_Others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->Division_Code)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Division Code';
            $history->previous = "Null";
            $history->current = $openState->Division_Code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->current_practice)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Current Practice';
            $history->previous = "Null";
            $history->current = $openState->current_practice;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->proposed_change)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Proposed Change';
            $history->previous = "Null";
            $history->current = $openState->proposed_change;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->other_comment)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Reason for Change';
            $history->previous = "Null";
            $history->current = $openState->other_comment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        // if(!empty($request->supervisor_comment)){    
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $openState->id;
        //     $history->activity_type = 'Supervisor Comments';
        //     $history->previous = "Null";
        //     $history->current = $openState->supervisor_comment;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $openState->status;
        //     $history->change_to =   "Opened";
        //         $history->change_from = "Initiator";
        //         $history->action_name = 'Create';
        //     $history->save();
        // }

        if(!empty($request->type_chnage)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Type of Change';
            $history->previous = "Null";
            $history->current = $openState->type_chnage;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->qa_head)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA Attachments';
            $history->previous = "Null";
            $history->current = $openState->qa_head;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }


        if(!empty($request->qa_comments)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA Review Comments';
            $history->previous = "Null";
            $history->current = $openState->qa_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->related_records)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Related Records';
            $history->previous = "Null";
            $history->current = $openState->related_records;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->qa_eval_comments)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA Evaluation Comments';
            $history->previous = "Null";
            $history->current = $openState->qa_eval_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }


        if(!empty($request->qa_eval_attach)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA Evaluation Attachments';
            $history->previous = "Null";
            $history->current = $openState->qa_eval_attach;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->train_comments)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Training Comments';
            $history->previous = "Null";
            $history->current = $openState->train_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }


        if(!empty($request->training_required)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Training Required';
            $history->previous = "Null";
            $history->current = $openState->training_required;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }


        //---------------------------------------//

        // $history = new RcmDocHistory;
        // $history->cc_id = $openState->id;
        // $history->activity_type = 'Is Group Review Required?';
        // $history->previous = "Null";
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
        // $history->previous = "Null";
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
        // $history->previous = "Null";
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
        // $history->previous = "Null";
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
        // $history->previous = "Null";
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
            $history->previous = "Null";
            $history->current = $openState->Microbiology;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }


        if(!empty($request->Microbiology_Person)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'CFT Reviewer Person';
            $history->previous = "Null";
            $history->current = $openState->Microbiology_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }



        // $history = new RcmDocHistory;
        // $history->cc_id = $openState->id;
        // $history->activity_type = 'Others';
        // $history->previous = "Null";
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
        // $history->previous = "Null";
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
        // $history->previous = "Null";
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
            $history->previous = "Null";
            $history->current = $openState->qa_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->designee_comments)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'QA Head Designee Comments';
            $history->previous = "Null";
            $history->current = $openState->designee_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->Warehouse_comments)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Warehouse Comments';
            $history->previous = "Null";
            $history->current = $openState->Warehouse_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->Engineering_comments)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Engineering Comments';
            $history->previous = "Null";
            $history->current = $openState->Engineering_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->Instrumentation_comments)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Instrumentation Comments';
            $history->previous = "Null";
            $history->current = $openState->Instrumentation_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->Validation_comments)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Validation Comments';
            $history->previous = "Null";
            $history->current = $openState->Validation_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->Others_comments)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Others Comments';
            $history->previous = "Null";
            $history->current = $openState->Others_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->Group_comments)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Comments';
            $history->previous = "Null";
            $history->current = $openState->Group_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->group_attachments)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Attachments';
            $history->previous = "Null";
            $history->current = $openState->group_attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->risk_identification)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Risk Identification';
            $history->previous = "Null";
            $history->current = $openState->risk_identification;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->severity)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Severity';
            $history->previous = "Null";
            $history->current = $openState->severity;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->Occurance)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Occurance';
            $history->previous = "Null";
            $history->current = $openState->Occurance;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->Detection)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Detection';
            $history->previous = "Null";
            $history->current = $openState->Detection;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->RPN)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'RPN';
            $history->previous = "Null";
            $history->current = $openState->RPN;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }


        if(!empty($request->risk_evaluation)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Risk Evaluation';
            $history->previous = "Null";
            $history->current = $openState->risk_evaluation;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->migration_action)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Migration Action';
            $history->previous = "Null";
            $history->current = $openState->migration_action;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->qa_appro_comments)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Migration Action';
            $history->previous = "Null";
            $history->current = $openState->qa_appro_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->feedback)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Migration Action';
            $history->previous = "Null";
            $history->current = $openState->feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->tran_attach)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Training Attachments';
            $history->previous = "Null";
            $history->current = $openState->tran_attach;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->qa_closure_comments)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Migration Action';
            $history->previous = "Null";
            $history->current = $openState->qa_closure_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->Effectiveness_checker)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Migration Action';
            $history->previous = "Null";
            $history->current = $openState->Effectiveness_checker;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->feedbackeffective_check)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Migration Action';
            $history->previous = "Null";
            $history->current = $openState->feedbackeffective_check;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->feedbackeffective_check_date)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'Migration Action';
            $history->previous = "Null";
            $history->current = $openState->feedbackeffective_check_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        if(!empty($request->attach_list)){    
            $history = new RcmDocHistory;
            $history->cc_id = $openState->id;
            $history->activity_type = 'List Of Attachments 2';
            $history->previous = "Null";
            $history->current = $openState->attach_list;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
            $history->save();
        }

        return redirect('rcms/qms-dashboard');
    }

    public function show($id)
    {

        $data = CC::find($id);
        $cc_lid = $data->id;
        $data->assign_to_name = User::where('id', $data->assign_to)->value('name');
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
        // $impactassement = table_cc_impactassement::where('id', $id)->first();

        $assessment = RiskAssessment::where('cc_id', $id)->first();
        $approcomments = QaApprovalComments::where('cc_id', $id)->first();
        $closure = ChangeClosure::where('cc_id', $id)->first();
        $hod = User::get();
        $cft = User::get();
        $cft_aff = [];
        if (!is_null($data->Microbiology_Person)) {
            $cft_aff = explode(',', $data->Microbiology_Person);
        }
        $pre = CC::all();
        $preRiskAssessment = RiskAssessment::all();
        $due_date_extension = $data->due_date_extension;


        $due_date_extension = $data->due_date_extension;
        $impactassement   =  table_cc_impactassement::where('cc_id', $id)->get();
        //    dd($impactassement);
        return view('frontend.change-control.CCview', compact(
            'data',
            'docdetail',
            // 'productDetailGrid',
            'affetctedDocumnetGrid',
            'preRiskAssessment',
            'review',
            'evaluation',
            'info',
            'division',
            'cc_cfts',
            'comments',
            'impactassement',
            'assessment',
            'approcomments',
            'closure',
            "hod",
            "cft",
            "cft_aff",
            "due_date_extension",
            "cc_lid",
            "pre"
        ));



        // print_r('impactassements');



    }

    public function update(Request $request, $id)
    {


        $lastDocument = CC::find($id);
        $openState = CC::find($id);

        // $impactassement   =  table_cc_impactassement::where('cc_id', $id)->find($id);

        // $impactassement->cc_id = $openState->id;

        // if (!$impactassement) {
        //     return response()->json(['error' => 'Record not found'], 404);
        // }
        // $result = $impactassement->update($request->all());

        // if ($result)
        // {
        //     return response()->json(['message' => 'Data updated successfully'], 200);
        // } else {

        //     return response()->json(['error' => 'Failed to update data'], 500);
        // }
        
        // $openState->type_chnage = $request->type_chnage;
        // $openState->Division_Code = $request->div_code;
        // $openState->related_records = $request->related_records;
        
        // $openState->initiator_id = Auth::user()->id;
        $openState->Initiator_Group = $request->Initiator_Group;
        $openState->initiator_group_code = $request->initiator_group_code;
        $openState->risk_assessment_required = $request->risk_assessment_required;
        $openState->short_description = $request->short_description;
        $openState->assign_to = $request->assign_to;
        // if($openState->stage == 3){
            $openState->due_date = $request->due_date;
        //     dd($request->due_date);
        // }
        $openState->doc_change = $request->naturechange;
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
        // $openState->related_records = implode(',', $request->related_records);
        $openState->qa_head = $request->qa_head;

        $openState->qa_eval_comments = $request->qa_eval_comments;
        $openState->qa_eval_attach = $request->qa_eval_attach;
        $openState->due_days = $request->due_days;
        // $openState->training_required = $request->training_required;
        // $openState->train_comments = $request->train_comments;

        $openState->Microbiology = $request->Microbiology;

         if ($request->Microbiology_Person) {
             $openState->Microbiology_Person = implode(',', $request->Microbiology_Person);
         } else {
             toastr()->warning('CFT reviewers can not be empty');
             return back();
         }

        if ($request->Microbiology_Person) {
            $openState->Microbiology_Person = implode(',', $request->Microbiology_Person);
        } else {
            toastr()->warning('CFT reviewers can not be empty');
            return back();
        }
        $openState->goup_review = $request->goup_review;
        $openState->Production = $request->Production;
        $openState->Production_Person = $request->Production_Person;
        $openState->Quality_Approver = $request->Quality_Approver;
        $openState->Quality_Approver_Person = $request->Quality_Approver_Person;
        $openState->bd_domestic = $request->bd_domestic;
        $openState->Bd_Person = $request->Bd_Person;
        $openState->additional_attachments = json_encode($request->additional_attachments);

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
        $openState->tran_attach = json_encode($request->tran_attach);

        $openState->qa_closure_comments = $request->qa_closure_comments;
        $openState->attach_list = json_encode($request->attach_list);
        $openState->effective_check = $request->effective_check;
        $openState->effective_check_date = $request->effective_check_date;
        $openState->Effectiveness_checker = $request->Effectiveness_checker;
        $openState->effective_check_plan = $request->effective_check_plan;

        $openState->due_date_extension = $request->due_date_extension;
        $openState->HOD_Remarks = $request->HOD_Remarks;

        if (!empty($request->HOD_attachment)) {
            $files = [];
            if ($request->hasfile('HOD_attachment')) {
                foreach ($request->file('HOD_attachment') as $file) {
                    $name = "CC" . '-HOD_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $openState->HOD_attachment = json_encode($files);
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

        $openState->update();

        if ($request->risk_assessment_related_record) {
            $openState->risk_assessment_related_record = implode(',', $request->risk_assessment_related_record);
        }

        $openState->update();
        // $impactassement->update();

        

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
        $openState->update();


        if ($openState->stage == 3 || $openState->stage == 4 ){
            $Cft = CcCft::withoutTrashed()->where('cc_id', $id)->first();
            if($Cft && $openState->stage == 4 ){
                $Cft->Production_Review = $request->Production_Review == null ? $Cft->Production_Review : $request->Production_Review;
                $Cft->Production_person = $request->Production_person == null ? $Cft->Production_person : $request->Production_Review;
                
                $Cft->RA_Review = $request->RA_Review == null ? $Cft->RA_Review : $request->RA_Review;
                $Cft->RA_person = $request->RA_person == null ? $Cft->RA_person : $request->RA_person;

                $Cft->Production_Injection_Person = $request->Production_Injection_Person == null ? $Cft->RA_Review : $request->Production_Injection_Person;
                $Cft->Production_Injection_Review = $request->Production_Injection_Review == null ? $Cft->RA_person : $request->Production_Injection_Review;

                $Cft->Production_Table_Person = $request->Production_Table_Person == null ? $Cft->RA_Review : $request->Production_Table_Person;
                $Cft->Production_Table_Review = $request->Production_Table_Review == null ? $Cft->RA_person : $request->Production_Table_Review;

                $Cft->Warehouse_review = $request->Warehouse_review == null ? $Cft->Warehouse_review : $request->Warehouse_review;
                $Cft->Warehouse_notification = $request->Warehouse_notification == null ? $Cft->Warehouse_notification : $request->Warehouse_notification;
                $Cft->Quality_review = $request->Quality_review == null ? $Cft->Quality_review : $request->Quality_review;;
                $Cft->Quality_Control_Person = $request->Quality_Control_Person == null ? $Cft->Quality_Control_Person : $request->Quality_Control_Person;
                $Cft->Quality_Assurance_Review = $request->Quality_Assurance_Review == null ? $Cft->Quality_Assurance_Review : $request->Quality_Assurance_Review;
                $Cft->QualityAssurance_person = $request->QualityAssurance_person == null ? $Cft->QualityAssurance_person : $request->QualityAssurance_person;

                $Cft->Engineering_review = $request->Engineering_review == null ? $Cft->Engineering_review : $request->Engineering_review;
                $Cft->Engineering_person = $request->Engineering_person == null ? $Cft->Engineering_person : $request->Engineering_person;
                $Cft->Analytical_Development_review = $request->Analytical_Development_review == null ? $Cft->Analytical_Development_review : $request->Analytical_Development_review;
                $Cft->Analytical_Development_person = $request->Analytical_Development_person == null ? $Cft->Analytical_Development_person : $request->Analytical_Development_person;
                $Cft->Kilo_Lab_review = $request->Kilo_Lab_review == null ? $Cft->Kilo_Lab_review : $request->Kilo_Lab_review;
                $Cft->Kilo_Lab_person = $request->Kilo_Lab_person == null ? $Cft->Kilo_Lab_person : $request->Kilo_Lab_person;
                $Cft->Technology_transfer_review = $request->Technology_transfer_review == null ? $Cft->Technology_transfer_review : $request->Technology_transfer_review;
                $Cft->Technology_transfer_person = $request->Technology_transfer_person == null ? $Cft->Technology_transfer_person : $request->Technology_transfer_person;
                $Cft->Environment_Health_review = $request->Environment_Health_review == null ? $Cft->Environment_Health_review : $request->Environment_Health_review;
                $Cft->Environment_Health_Safety_person = $request->Environment_Health_Safety_person == null ? $Cft->Environment_Health_Safety_person : $request->Environment_Health_Safety_person;
                $Cft->Human_Resource_review = $request->Human_Resource_review == null ? $Cft->Human_Resource_review : $request->Human_Resource_review;
                $Cft->Human_Resource_person = $request->Human_Resource_person == null ? $Cft->Human_Resource_person : $request->Human_Resource_person;
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
            }
            else{
                $Cft->Production_Review = $request->Production_Review;
                $Cft->Production_person = $request->Production_person;

                $Cft->RA_Review = $request->RA_Review;
                $Cft->RA_person = $request->RA_person;

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
                $Cft->Engineering_review = $request->Engineering_review;
                $Cft->Engineering_person = $request->Engineering_person;
                $Cft->Analytical_Development_review = $request->Analytical_Development_review;
                $Cft->Analytical_Development_person = $request->Analytical_Development_person;
                $Cft->Kilo_Lab_review = $request->Kilo_Lab_review;
                $Cft->Kilo_Lab_person = $request->Kilo_Lab_person;
                $Cft->Technology_transfer_review = $request->Technology_transfer_review;
                $Cft->Technology_transfer_person = $request->Technology_transfer_person;
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
            $Cft->Production_assessment = $request->Production_assessment;
            $Cft->Production_feedback = $request->Production_feedback;

            $Cft->RA_assessment = $request->RA_assessment;
            $Cft->RA_feedback = $request->RA_feedback;

            $Cft->Production_Injection_Assessment = $request->Production_Injection_Assessment;
            $Cft->Production_Injection_Feedback = $request->Production_Injection_Feedback;

            $Cft->Production_Table_Assessment = $request->Production_Table_Assessment;
            $Cft->Production_Table_Feedback = $request->Production_Table_Feedback;

            $Cft->Warehouse_assessment = $request->Warehouse_assessment;
            $Cft->Warehouse_feedback = $request->Warehouse_feedback;
            $Cft->Quality_Control_assessment = $request->Quality_Control_assessment;
            $Cft->Quality_Control_feedback = $request->Quality_Control_feedback;
            $Cft->QualityAssurance_assessment = $request->QualityAssurance_assessment;
            $Cft->QualityAssurance_feedback = $request->QualityAssurance_feedback;
            $Cft->Engineering_assessment = $request->Engineering_assessment;
            $Cft->Engineering_feedback = $request->Engineering_feedback;
            $Cft->Analytical_Development_assessment = $request->Analytical_Development_assessment;
            $Cft->Analytical_Development_feedback = $request->Analytical_Development_feedback;
            $Cft->Kilo_Lab_assessment = $request->Kilo_Lab_assessment;
            $Cft->Kilo_Lab_feedback = $request->Kilo_Lab_feedback;
            $Cft->Technology_transfer_assessment = $request->Technology_transfer_assessment;
            $Cft->Technology_transfer_feedback = $request->Technology_transfer_feedback;
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


            if (!empty ($request->production_attachment)) {
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
            if (!empty ($request->Warehouse_attachment)) {
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
            if (!empty ($request->Analytical_Development_attachment)) {
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
            if (!empty ($request->Kilo_Lab_attachment)) {
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
            if (!empty ($request->Technology_transfer_attachment)) {
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
            if (!empty ($request->Project_management_attachment)) {
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
        }


        if ($openState->stage == 3 || $openState->stage == 4 ){
            $Cft = CcCft::withoutTrashed()->where('cc_id', $id)->first();
            if($Cft && $openState->stage == 4 ){
                $Cft->Production_Review = $request->Production_Review == null ? $Cft->Production_Review : $request->Production_Review;
                $Cft->Production_person = $request->Production_person == null ? $Cft->Production_person : $request->Production_Review;
                
                $Cft->RA_Review = $request->RA_Review == null ? $Cft->RA_Review : $request->RA_Review;
                $Cft->RA_Review = $request->RA_Review == null ? $Cft->RA_Review : $request->RA_Review;

                $Cft->Production_Injection_Person = $request->Production_Injection_Person == null ? $Cft->RA_Review : $request->Production_Injection_Person;
                $Cft->Production_Injection_Review = $request->Production_Injection_Review == null ? $Cft->RA_person : $request->Production_Injection_Review;

                $Cft->Production_Table_Person = $request->Production_Table_Person == null ? $Cft->RA_Review : $request->Production_Table_Person;
                $Cft->Production_Table_Review = $request->Production_Table_Review == null ? $Cft->RA_person : $request->Production_Table_Review;

                $Cft->Warehouse_review = $request->Warehouse_review == null ? $Cft->Warehouse_review : $request->Warehouse_review;
                $Cft->Warehouse_notification = $request->Warehouse_notification == null ? $Cft->Warehouse_notification : $request->Warehouse_notification;
                $Cft->Quality_review = $request->Quality_review == null ? $Cft->Quality_review : $request->Quality_review;;
                $Cft->Quality_Control_Person = $request->Quality_Control_Person == null ? $Cft->Quality_Control_Person : $request->Quality_Control_Person;
                $Cft->Quality_Assurance_Review = $request->Quality_Assurance_Review == null ? $Cft->Quality_Assurance_Review : $request->Quality_Assurance_Review;
                $Cft->QualityAssurance_person = $request->QualityAssurance_person == null ? $Cft->QualityAssurance_person : $request->QualityAssurance_person;

                $Cft->Engineering_review = $request->Engineering_review == null ? $Cft->Engineering_review : $request->Engineering_review;
                $Cft->Engineering_person = $request->Engineering_person == null ? $Cft->Engineering_person : $request->Engineering_person;
                $Cft->Analytical_Development_review = $request->Analytical_Development_review == null ? $Cft->Analytical_Development_review : $request->Analytical_Development_review;
                $Cft->Analytical_Development_person = $request->Analytical_Development_person == null ? $Cft->Analytical_Development_person : $request->Analytical_Development_person;
                $Cft->Kilo_Lab_review = $request->Kilo_Lab_review == null ? $Cft->Kilo_Lab_review : $request->Kilo_Lab_review;
                $Cft->Kilo_Lab_person = $request->Kilo_Lab_person == null ? $Cft->Kilo_Lab_person : $request->Kilo_Lab_person;
                $Cft->Technology_transfer_review = $request->Technology_transfer_review == null ? $Cft->Technology_transfer_review : $request->Technology_transfer_review;
                $Cft->Technology_transfer_person = $request->Technology_transfer_person == null ? $Cft->Technology_transfer_person : $request->Technology_transfer_person;
                $Cft->Environment_Health_review = $request->Environment_Health_review == null ? $Cft->Environment_Health_review : $request->Environment_Health_review;
                $Cft->Environment_Health_Safety_person = $request->Environment_Health_Safety_person == null ? $Cft->Environment_Health_Safety_person : $request->Environment_Health_Safety_person;
                $Cft->Human_Resource_review = $request->Human_Resource_review == null ? $Cft->Human_Resource_review : $request->Human_Resource_review;
                $Cft->Human_Resource_person = $request->Human_Resource_person == null ? $Cft->Human_Resource_person : $request->Human_Resource_person;
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
            }
            else{
                $Cft->Production_Review = $request->Production_Review;
                $Cft->Production_person = $request->Production_person;
                $Cft->RA_Review = $request->RA_Review;
                $Cft->RA_person = $request->RA_person;

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
                $Cft->Engineering_review = $request->Engineering_review;
                $Cft->Engineering_person = $request->Engineering_person;
                $Cft->Analytical_Development_review = $request->Analytical_Development_review;
                $Cft->Analytical_Development_person = $request->Analytical_Development_person;
                $Cft->Kilo_Lab_review = $request->Kilo_Lab_review;
                $Cft->Kilo_Lab_person = $request->Kilo_Lab_person;
                $Cft->Technology_transfer_review = $request->Technology_transfer_review;
                $Cft->Technology_transfer_person = $request->Technology_transfer_person;
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
            $Cft->Production_assessment = $request->Production_assessment;
            $Cft->Production_feedback = $request->Production_feedback;
            $Cft->RA_assessment = $request->RA_assessment;
            $Cft->RA_feedback = $request->RA_feedback;

            $Cft->Production_Injection_Assessment = $request->Production_Injection_Assessment;
            $Cft->Production_Injection_Feedback = $request->Production_Injection_Feedback;

            $Cft->Production_Table_Assessment = $request->Production_Table_Assessment;
            $Cft->Production_Table_Feedback = $request->Production_Table_Feedback;

            $Cft->Warehouse_assessment = $request->Warehouse_assessment;
            $Cft->Warehouse_feedback = $request->Warehouse_feedback;
            $Cft->Quality_Control_assessment = $request->Quality_Control_assessment;
            $Cft->Quality_Control_feedback = $request->Quality_Control_feedback;
            $Cft->QualityAssurance_assessment = $request->QualityAssurance_assessment;
            $Cft->QualityAssurance_feedback = $request->QualityAssurance_feedback;
            $Cft->Engineering_assessment = $request->Engineering_assessment;
            $Cft->Engineering_feedback = $request->Engineering_feedback;
            $Cft->Analytical_Development_assessment = $request->Analytical_Development_assessment;
            $Cft->Analytical_Development_feedback = $request->Analytical_Development_feedback;
            $Cft->Kilo_Lab_assessment = $request->Kilo_Lab_assessment;
            $Cft->Kilo_Lab_feedback = $request->Kilo_Lab_feedback;
            $Cft->Technology_transfer_assessment = $request->Technology_transfer_assessment;
            $Cft->Technology_transfer_feedback = $request->Technology_transfer_feedback;
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


            if (!empty ($request->production_attachment)) {
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
            if (!empty ($request->Warehouse_attachment)) {
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
            if (!empty ($request->Analytical_Development_attachment)) {
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
            if (!empty ($request->Kilo_Lab_attachment)) {
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
            if (!empty ($request->Technology_transfer_attachment)) {
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
            if (!empty ($request->Project_management_attachment)) {
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
        }


        if ($openState->stage == 3 || $openState->stage == 4 ){
            $Cft = CcCft::withoutTrashed()->where('cc_id', $id)->first();
            if($Cft && $openState->stage == 4 ){
                $Cft->Production_Review = $request->Production_Review == null ? $Cft->Production_Review : $request->Production_Review;
                $Cft->Production_person = $request->Production_person == null ? $Cft->Production_person : $request->Production_Review;
                $Cft->RA_Review = $request->RA_Review == null ? $Cft->RA_Review : $request->RA_Review;
                $Cft->RA_Review = $request->RA_Review == null ? $Cft->RA_Review : $request->RA_Review;

                $Cft->Production_Injection_Person = $request->Production_Injection_Person == null ? $Cft->RA_Review : $request->Production_Injection_Person;
                $Cft->Production_Injection_Review = $request->Production_Injection_Review == null ? $Cft->RA_person : $request->Production_Injection_Review;

                $Cft->Production_Table_Person = $request->Production_Table_Person == null ? $Cft->RA_Review : $request->Production_Table_Person;
                $Cft->Production_Table_Review = $request->Production_Table_Review == null ? $Cft->RA_person : $request->Production_Table_Review;

                $Cft->Warehouse_review = $request->Warehouse_review == null ? $Cft->Warehouse_review : $request->Warehouse_review;
                $Cft->Warehouse_notification = $request->Warehouse_notification == null ? $Cft->Warehouse_notification : $request->Warehouse_notification;
                $Cft->Quality_review = $request->Quality_review == null ? $Cft->Quality_review : $request->Quality_review;;
                $Cft->Quality_Control_Person = $request->Quality_Control_Person == null ? $Cft->Quality_Control_Person : $request->Quality_Control_Person;
                $Cft->Quality_Assurance_Review = $request->Quality_Assurance_Review == null ? $Cft->Quality_Assurance_Review : $request->Quality_Assurance_Review;
                $Cft->QualityAssurance_person = $request->QualityAssurance_person == null ? $Cft->QualityAssurance_person : $request->QualityAssurance_person;

                $Cft->Engineering_review = $request->Engineering_review == null ? $Cft->Engineering_review : $request->Engineering_review;
                $Cft->Engineering_person = $request->Engineering_person == null ? $Cft->Engineering_person : $request->Engineering_person;
                $Cft->Analytical_Development_review = $request->Analytical_Development_review == null ? $Cft->Analytical_Development_review : $request->Analytical_Development_review;
                $Cft->Analytical_Development_person = $request->Analytical_Development_person == null ? $Cft->Analytical_Development_person : $request->Analytical_Development_person;
                $Cft->Kilo_Lab_review = $request->Kilo_Lab_review == null ? $Cft->Kilo_Lab_review : $request->Kilo_Lab_review;
                $Cft->Kilo_Lab_person = $request->Kilo_Lab_person == null ? $Cft->Kilo_Lab_person : $request->Kilo_Lab_person;
                $Cft->Technology_transfer_review = $request->Technology_transfer_review == null ? $Cft->Technology_transfer_review : $request->Technology_transfer_review;
                $Cft->Technology_transfer_person = $request->Technology_transfer_person == null ? $Cft->Technology_transfer_person : $request->Technology_transfer_person;
                $Cft->Environment_Health_review = $request->Environment_Health_review == null ? $Cft->Environment_Health_review : $request->Environment_Health_review;
                $Cft->Environment_Health_Safety_person = $request->Environment_Health_Safety_person == null ? $Cft->Environment_Health_Safety_person : $request->Environment_Health_Safety_person;
                $Cft->Human_Resource_review = $request->Human_Resource_review == null ? $Cft->Human_Resource_review : $request->Human_Resource_review;
                $Cft->Human_Resource_person = $request->Human_Resource_person == null ? $Cft->Human_Resource_person : $request->Human_Resource_person;
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
            }
            else{
                $Cft->Production_Review = $request->Production_Review;
                $Cft->Production_person = $request->Production_person;
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
                $Cft->Engineering_review = $request->Engineering_review;
                $Cft->Engineering_person = $request->Engineering_person;
                $Cft->Analytical_Development_review = $request->Analytical_Development_review;
                $Cft->Analytical_Development_person = $request->Analytical_Development_person;
                $Cft->Kilo_Lab_review = $request->Kilo_Lab_review;
                $Cft->Kilo_Lab_person = $request->Kilo_Lab_person;
                $Cft->Technology_transfer_review = $request->Technology_transfer_review;
                $Cft->Technology_transfer_person = $request->Technology_transfer_person;
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
            $Cft->Production_assessment = $request->Production_assessment;
            $Cft->Production_feedback = $request->Production_feedback;
            $Cft->RA_assessment = $request->RA_assessment;
            $Cft->RA_feedback = $request->RA_feedback;

            $Cft->Production_Injection_Assessment = $request->Production_Injection_Assessment;
            $Cft->Production_Injection_Feedback = $request->Production_Injection_Feedback;

            $Cft->Production_Table_Assessment = $request->Production_Table_Assessment;
            $Cft->Production_Table_Feedback = $request->Production_Table_Feedback;

            $Cft->Warehouse_assessment = $request->Warehouse_assessment;
            $Cft->Warehouse_feedback = $request->Warehouse_feedback;
            $Cft->Quality_Control_assessment = $request->Quality_Control_assessment;
            $Cft->Quality_Control_feedback = $request->Quality_Control_feedback;
            $Cft->QualityAssurance_assessment = $request->QualityAssurance_assessment;
            $Cft->QualityAssurance_feedback = $request->QualityAssurance_feedback;
            $Cft->Engineering_assessment = $request->Engineering_assessment;
            $Cft->Engineering_feedback = $request->Engineering_feedback;
            $Cft->Analytical_Development_assessment = $request->Analytical_Development_assessment;
            $Cft->Analytical_Development_feedback = $request->Analytical_Development_feedback;
            $Cft->Kilo_Lab_assessment = $request->Kilo_Lab_assessment;
            $Cft->Kilo_Lab_feedback = $request->Kilo_Lab_feedback;
            $Cft->Technology_transfer_assessment = $request->Technology_transfer_assessment;
            $Cft->Technology_transfer_feedback = $request->Technology_transfer_feedback;
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


            if (!empty ($request->production_attachment)) {
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
            if (!empty ($request->Warehouse_attachment)) {
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
            if (!empty ($request->Analytical_Development_attachment)) {
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
            if (!empty ($request->Kilo_Lab_attachment)) {
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
            if (!empty ($request->Technology_transfer_attachment)) {
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
            if (!empty ($request->Project_management_attachment)) {
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
        }

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
         if ($request->Microbiology_Person) {
             $info->Microbiology_Person = implode(',', $request->Microbiology_Person);
         } else {
             toastr()->warning('CFT reviewers can not be empty');
             return back();
         }
        if ($request->Microbiology == "yes") {
            $info->Microbiology = $request->Microbiology;
        }
        if ($request->Microbiology_Person) {
            $info->Microbiology_Person = implode(',', $request->Microbiology_Person);
        } else {
            toastr()->warning('CFT reviewers can not be empty');
            return back();
        }
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
        $comments->update();

        $lastassessment = RiskAssessment::where('cc_id', $id)->first();
        $assessment = RiskAssessment::where('cc_id', $id)->first();
        $assessment->cc_id = $openState->id;
        $assessment->risk_identification = $request->risk_identification;
        $assessment->severity = $request->severity;
        $assessment->Occurance = $request->Occurance;
        $assessment->Detection = $request->Detection;
        $assessment->RPN = $request->RPN;
        $assessment->risk_evaluation = $request->risk_evaluation;
        $assessment->migration_action = $request->migration_action;

        if (!empty($request->risk_assessment_atch)) {
            $files = [];
            if ($request->hasfile('risk_assessment_atch')) {
                foreach ($request->file('risk_assessment_atch') as $file) {
                    $name = "CC" . '-risk_assessment_atch' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $assessment->risk_assessment_atch = json_encode($files);
        }
        $assessment->update();

        $lastapprocomments = QaApprovalComments::where('cc_id', $id)->first();
        $approcomments = QaApprovalComments::where('cc_id', $id)->first();
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

        $closure->update();

        //<!------------------------RCMS Documents---------------->
        if ($lastDocument->short_description != $openState->short_description) {
            // return 'history';
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastDocument->short_description;
            $history->current = $openState->short_description;
            $history->comment = $request->short_desc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        } 

        if ($lastDocument->risk_assessment_required != $openState->risk_assessment_required) {
            // return 'history';
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
            $history->action_name = 'Update';
            $history->save();
        } 

        if ($lastDocument->hod_person != $openState->hod_person) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'HOD Person';
            $history->previous = $lastDocument->hod_person;
            $history->current = $openState->hod_person;
            $history->comment = $request->Initiator_Group_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastDocument->Initiator_Group != $openState->Initiator_Group) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Inititator Group';
            $history->previous = $lastDocument->Initiator_Group;
            $history->current = $openState->Initiator_Group;
            $history->comment = $request->Initiator_Group_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }


        if ($lastDocument->assign_to != $openState->assign_to) {
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
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastDocument->due_date != $openState->due_date) {
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
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastDocument->doc_change != $openState->doc_change) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Supporting Documents';
            $history->previous = $lastDocument->doc_change;
            $history->current = $openState->doc_change;
            $history->comment = $request->doc_change_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->If_Others != $openState->If_Others) {
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
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->Division_Code != $openState->Division_Code) {
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
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }

        //<!---------------Change Details History---------------->

        if ($lastDocument->current_practice != $openState->current_practice ) {
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
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastDocument->proposed_change != $openState->proposed_change) {
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
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->reason_change != $openState->reason_change ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Reason for Change';
            $history->previous = $lastDocument->proposed_change;
            $history->current = $openState->proposed_change;
            $history->comment = $request->proposed_change_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->other_comment != $openState->other_comment ) {
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
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }

        // if ($lastDocument->supervisor_comment != $openState->other_comment ) {
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'Supervisor Comments';
        //     $history->previous = $lastDocument->supervisor_comment;
        //     $history->current = $openState->supervisor_comment;
        //     $history->comment = $request->supervisor_comment_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = 'Update';
        //     $history->save();
        // }
        if ($lastDocument->type_chnage != $openState->type_chnag) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Type of Change';
            $history->previous = $lastDocument->type_chnage;
            $history->current = $openState->type_chnage;
            $history->comment = $request->type_chnage_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastDocument->qa_head != $openState->qa_head ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA Attachments';
            $history->previous = $lastDocument->qa_head;
            $history->current = $openState->qa_head;
            $history->comment = $request->qa_head_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->qa_comments != $openState->qa_comments) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA Review Comments';
            $history->previous = $lastDocument->qa_comments;
            $history->current = $openState->qa_comments;
            $history->comment = $request->qa_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->related_records != $openState->related_records) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Related Records';
            $history->previous = $lastDocument->related_records;
            $history->current = $openState->related_records;
            $history->comment = $request->related_records_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }


        if ($lastDocument->qa_eval_comments != $openState->qa_eval_comments ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA Evaluation Comments';
            $history->previous = $lastDocument->qa_eval_comments;
            $history->current = $openState->qa_eval_comments;
            $history->comment = $request->qa_eval_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->qa_eval_attach != $openState->qa_eval_attach) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA Evaluation Attachments';
            $history->previous = $lastDocument->qa_eval_attach;
            $history->current = $openState->qa_eval_attach;
            $history->comment = $request->qa_eval_attach_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->train_comments != $openState->train_comments) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Training Comments';
            $history->previous = $lastDocument->train_comments;
            $history->current = $openState->train_comments;
            $history->comment = $request->train_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->training_required != $openState->training_required) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Training Required';
            $history->previous = $lastDocument->training_required;
            $history->current = $openState->training_required;
            $history->comment = $request->training_required_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        // if ($lastDocument->goup_review != $openState->goup_review || !empty($request->goup_review_comment)) {
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'Is Group Review Required?';
        //     $history->previous = $lastDocument->goup_review;
        //     $history->current = $openState->goup_review;
        //     $history->comment = $request->goup_review_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        // if ($lastDocument->Production != $openState->Production || !empty($request->Production_comment)) {
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'Production';
        //     $history->previous = $lastDocument->Production;
        //     $history->current = $openState->Production;
        //     $history->comment = $request->Production_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        // if ($lastDocument->Production_Person != $openState->Production_Person || !empty($request->Production_Person_comment)) {
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'Production Person';
        //     $history->previous = $lastDocument->Production_Person;
        //     $history->current = $openState->Production_Person;
        //     $history->comment = $request->Production_Person_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        // if ($lastDocument->Quality_Approver != $openState->Quality_Approver || !empty($request->Quality_Approver_comment)) {
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'Quality Approver';
        //     $history->previous = $lastDocument->Quality_Approver;
        //     $history->current = $openState->Quality_Approver;
        //     $history->comment = $request->Quality_Approver_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }

        // if ($lastDocument->Quality_Approver_Person != $openState->Quality_Approver_Person || !empty($request->Quality_Approver_Person_comment)) {
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'Quality Approver Person';
        //     $history->previous = $lastDocument->Quality_Approver_Person;
        //     $history->current = $openState->Quality_Approver_Person;
        //     $history->comment = $request->Quality_Approver_Person_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        if ($lastDocument->Microbiology != $openState->Microbiology) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'CFT Reviewer';
            $history->previous = $lastDocument->Microbiology;
            $history->current = $openState->Microbiology;
            $history->comment = $request->Microbiology_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->Microbiology_Person != $openState->Microbiology_Person) {
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
            $history->action_name = 'Update';
            $history->save();
        }
        // if ($lastDocument->bd_domestic != $openState->bd_domestic || !empty($request->bd_domestic_comment)) {
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'Others';
        //     $history->previous = $lastDocument->bd_domestic;
        //     $history->current = $openState->bd_domestic;
        //     $history->comment = $request->bd_domestic_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        // if ($lastDocument->Bd_Person != $openState->Bd_Person || !empty($request->Bd_Person_comment)) {
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'Others Person';
        //     $history->previous = $lastDocument->Bd_Person;
        //     $history->current = $openState->bd_domesticBd_Person;
        //     $history->comment = $request->Bd_Person_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }

        // if ($lastDocument->additional_attachments != $openState->additional_attachments || !empty($request->additional_attachments_comment)) {
        //     $history = new RcmDocHistory;
        //     $history->cc_id = $id;
        //     $history->activity_type = 'Additional Attachments';
        //     $history->previous = $lastDocument->additional_attachments;
        //     $history->current = $openState->additional_attachments;
        //     $history->comment = $request->additional_attachments_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }

        // ----------------------Group Comments History------------------------
        if ($lastDocument->qa_comments != $openState->qa_comments) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA Comments';
            $history->previous= $lastDocument->qa_comments;
            $history->current = $openState->qa_comments;
            $history->comment = $request->qa_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->designee_comments != $openState->designee_comments) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA Head Designee Comments';
            $history->previous= $lastDocument->designee_comments;
            $history->current = $openState->designee_comments;
            $history->comment = $request->designee_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->Warehouse_comments != $openState->Warehouse_comments) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Warehouse Comments';
            $history->previous= $lastDocument->Warehouse_comments;
            $history->current = $openState->Warehouse_comments;
            $history->comment = $request->Warehouse_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->Engineering_comments != $openState->Engineering_comments) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Engineering Comments';
            $history->previous= $lastDocument->Engineering_comments;
            $history->current = $openState->Engineering_comments;
            $history->comment = $request->Engineering_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->Instrumentation_comments != $openState->Instrumentation_comments ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Instrumentation Comments';
            $history->previous= $lastDocument->Instrumentation_comments;
            $history->current = $openState->Instrumentation_comments;
            $history->comment = $request->Instrumentation_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->Validation_comments != $openState->Validation_comments ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Validation Comments';
            $history->previous= $lastDocument->Validation_comments;
            $history->current = $openState->Validation_comments;
            $history->comment = $request->Validation_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->Others_comments != $openState->Others_comments ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Others Comments';
            $history->previous= $lastDocument->Others_comments;
            $history->current = $openState->Others_comments;
            $history->comment = $request->Others_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->Group_comments != $openState->Group_comments ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Comments';
            $history->previous= $lastDocument->Group_comments;
            $history->current = $openState->Group_comments;
            $history->comment = $request->Group_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->group_attachments != $openState->group_attachments ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Attachments';
            $history->previous= $lastDocument->group_attachments;
            $history->current = $openState->group_attachments;
            $history->comment = $request->group_attachments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        // ----------------------Risk Assesments------------------------

        if ($lastDocument->risk_identification != $openState->risk_identification ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Risk Identification';
            $history->previous = $lastDocument->risk_identification;
            $history->current = $openState->risk_identification;
            $history->comment = $request->risk_identification_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastDocument->severity != $openState->severity ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Severity';
            $history->previous = $lastDocument->severity;
            $history->current = $openState->severity;
            $history->comment = $request->severity_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->Occurance != $openState->Occurance ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Occurance';
            $history->previous = $lastDocument->Occurance;
            $history->current = $openState->Occurance;
            $history->comment = $request->Occurance_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->Detection != $openState->Detection) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Detection';
            $history->previous = $lastDocument->Detection;
            $history->current = $openState->Detection;
            $history->comment = $request->Detection_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->RPN != $openState->RPN ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'RPN';
            $history->previous = $lastDocument->RPN;
            $history->current = $openState->RPN;
            $history->comment = $request->RPN_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->risk_evaluation != $openState->risk_evaluation ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Risk Evaluation';
            $history->previous = $lastDocument->risk_evaluation;
            $history->current = $openState->risk_evaluation;
            $history->comment = $request->risk_evaluation_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->migration_action != $openState->migration_action ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Migration Action';
            $history->previous = $lastDocument->migration_action;
            $history->current = $openState->migration_action;
            $history->comment = $request->migration_action_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        //-----------------------QA Approval Comments-----------------

        if ($lastDocument->qa_appro_comments != $openState->qa_appro_comments ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Migration Action';
            $history->previous = $lastDocument->qa_appro_comments;
            $history->current = $openState->qa_appro_comments;
            $history->comment = $request->qa_appro_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->feedback != $openState->feedback ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Migration Action';
            $history->previous = $lastDocument->feedback;
            $history->current = $openState->feedback;
            $history->comment = $request->feedback_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->tran_attach != $openState->tran_attach ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Training Attachments';
            $history->previous = $lastDocument->tran_attach;
            $history->current = $openState->tran_attach;
            $history->comment = $request->tran_attach_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        // --------------------Change Closure------------------
        if ($lastDocument->qa_closure_comments != $openState->qa_closure_comments) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Migration Action';
            $history->previous = $lastDocument->qa_closure_comments;
            $history->current = $openState->qa_closure_comments;
            $history->comment = $request->qa_closure_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
            // return $closure;
        }
        if ($lastDocument->Effectiveness_checker != $openState->Effectiveness_checker ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Migration Action';
            $history->previous = $lastDocument->Effectiveness_checker;
            $history->current = $openState->Effectiveness_checker;
            $history->comment = $request->Effectiveness_checker_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
            // return $closure;
        }
        if ($lastDocument->effective_check != $openState->effective_check ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Migration Action';
            $history->previous = $lastDocument->effective_check;
            $history->current = $openState->feedbackeffective_check;
            $history->comment = $request->effective_check_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }


        if ($lastDocument->effective_check_date != $openState->feedbackeffective_check_date ) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Migration Action';
            $history->previous = $lastDocument->effective_check_date;
            $history->current = $openState->feedbackeffective_check_date;
            $history->comment = $request->effective_check_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastDocument->attach_list != $openState->attach_list) {
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'List Of Attachments 1';
            $history->previous = $lastDocument->attach_list;
            $history->current = $openState->attach_list;
            $history->comment = $request->attach_list_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
            // return $history;
        }
        // toastr()->success('Record is updated Successfully');
        return back();
    }


    public function destroy($id)
    {
    }

    public function stageChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = CC::find($id);
            $lastDocument = CC::find($id);
            $evaluation = Evaluation::where('cc_id', $id)->first();
            if ($changeControl->stage == 1) {
                    $changeControl->stage = "2";
                    $changeControl->status = "HOD Review";
                    $changeControl->submit_by = Auth::user()->name;
                    $changeControl->submit_on = Carbon::now()->format('d-M-Y');
                    $changeControl->submit_comment = $request->comments;

                    $history = new RcmDocHistory();
                    $history->cc_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action='Submit';
                    $history->current = $changeControl->submit_by;
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "HOD Review";
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
                    toastr()->success('Sent to HOD Review');
                    return back();

            }
            if ($changeControl->stage == 2) {
                    $changeControl->stage = "3";
                    $changeControl->status = "QA Initial Review";
                    $changeControl->hod_review_by = Auth::user()->name;
                    $changeControl->hod_review_on = Carbon::now()->format('d-M-Y');
                    $changeControl->hod_review_comment = $request->comments;

                    $history = new RcmDocHistory();
                    $history->cc_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action='HOD Review Complete';
                    $history->current = $changeControl->submit_by;
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA Initial Review";
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
                    toastr()->success('Sent to QA Initial Review');
                    return back();
            }
            if ($changeControl->stage == 3) {
                $changeControl->stage = "4";
                $changeControl->status = "Pending RA Review";
                $changeControl->QA_initial_review_by = Auth::user()->name;
                $changeControl->QA_initial_review_on = Carbon::now()->format('d-M-Y');
                $changeControl->QA_initial_review_comment = $request->comments;

                $history = new RcmDocHistory();
                    $history->cc_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action=' QA Initial Review Complete';
                    $history->current = $changeControl->submit_by;
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Pending RA Review";
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
                toastr()->success('Sent to Pending RA Review');
                return back();
            }
            if ($changeControl->stage == 4) {
                $changeControl->stage = "5";
                $changeControl->status = "CFT Review";
                $changeControl->pending_RA_review_by = Auth::user()->name;
                $changeControl->pending_RA_review_on = Carbon::now()->format('d-M-Y');
                $changeControl->pending_RA_review_comment = $request->comments;
                $history = new RcmDocHistory();
                    $history->cc_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action='RA Review Complete';
                    $history->current = $changeControl->submit_by;
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "CFT Review";
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
                toastr()->success('Pending CFT Review');
                return back();
            }
            if ($changeControl->stage == 5) {
                $changeControl->stage = "6";
                $changeControl->status = "QA Final Review";
                $changeControl->cft_review_by = Auth::user()->name;
                $changeControl->cft_review_on = Carbon::now()->format('d-M-Y');
                $changeControl->cft_review_comment = $request->comments;

                $history = new RcmDocHistory();
                    $history->cc_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action='CFT Review Complete';
                    $history->current = $changeControl->submit_by;
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA Final Review";
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
                toastr()->success('Sent to QA Final Review');
                return back();
            }
            if ($changeControl->stage == 6) {
                $changeControl->stage = "7";
                $changeControl->status = "QA Final Review Complete";
                $changeControl->QA_final_review_by = Auth::user()->name;
                $changeControl->QA_final_review_on = Carbon::now()->format('d-M-Y');
                $changeControl->QA_final_review_comment = $request->comments;

                $history = new RcmDocHistory();
                    $history->cc_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action='Pre-Approved';
                    $history->current = $changeControl->QA_final_review_by;
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA Head/Manager Designee Pre-Approval";
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
                toastr()->success('Sent to QA Head/Manager Designee Pre-Approval');
                return back();
            }
            if ($changeControl->stage == 7) {
                $changeControl->stage = "8";
                $changeControl->status = "Sent to QA Head/Manager Designee Approval";
                $changeControl->QA_preapproved_by = Auth::user()->name;
                $changeControl->QA_preapproved_on = Carbon::now()->format('d-M-Y');
                $changeControl->QA_preapproved_comment = $request->comments;

                $history = new RcmDocHistory();
                    $history->cc_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action= 'Approved';
                    $history->current = $changeControl->QA_preapproved_by;
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Sent to QA Head/Manager Designee Approval";
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
                toastr()->success('Sent Closed Done');
                return back();
            }

            if ($changeControl->stage == 8) {
                $changeControl->stage = "9";
                $changeControl->status = "Closed - Done";
                $changeControl->QA_head_approval_by = Auth::user()->name;
                $changeControl->QA_head_approval_on = Carbon::now()->format('d-M-Y');
                $changeControl->QA_head_approval_comment = $request->comments;

                $history = new RcmDocHistory();
                    $history->cc_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action= 'Approved';
                    $history->current = $changeControl->submit_by;
                    $history->comment = $request->comments;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Closed - Done";
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
                toastr()->success('Sent Closed Done');
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
            $openState = CC::find($id);

            if ($changeControl->stage == 1) {
                $changeControl->stage = "0";
                $changeControl->status = "Closed-Cancelled";
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
            }
            if ($changeControl->stage == 2) {
                $changeControl->stage = "1";
                $changeControl->status = "Opened";
                $changeControl->hod_to_initiator_by = Auth::user()->name;
                $changeControl->hod_to_initiator_on = Carbon::now()->format('d-M-Y');
                $changeControl->hod_to_initiator_comment = $request->comments;
            //     $list = Helpers::getInitiatorUserList();
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
                //     $list = Helpers::getInitiatorUserList();
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
                $history->comments = $request->comments;
                $history->stage_id = $changeControl->stage;
                $history->status = "Opened";
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 3) {
                $changeControl->stage = "2";
                $changeControl->status = "HOD Review";
                $changeControl->QA_initialTo_HOD_by = Auth::user()->name;
                $changeControl->QA_initialTo_HOD_on = Carbon::now()->format('d-M-Y');
                $changeControl->QA_initialTo_HOD_comment = $request->comments;
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
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->comments = $request->comments;
                $history->stage_id = $changeControl->stage;
                $history->status = "HOD Review";
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 4) {
                $changeControl->stage = "3";
                $changeControl->status = "QA Initial Review";
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
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->comments = $request->comments;
                $history->stage_id = $changeControl->stage;
                $history->status = "QA Initial Review";
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 5) {
                $changeControl->stage = "3";
                $changeControl->status = "QA Initial Review";
                $changeControl->cft_to_qaInitial_by = Auth::user()->name;
                $changeControl->cft_to_qaInitial_on = Carbon::now()->format('d-M-Y');
                $changeControl->cft_to_qaInitial_comment = $request->comments;
                
                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->comments = $request->comments;
                $history->stage_id = $changeControl->stage;
                $history->status = "QA Initial Review";
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 6) {
                $changeControl->stage = "5";
                $changeControl->status = "CFT Review";
                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->comments = $request->comments;
                $history->stage_id = $changeControl->stage;
                $history->status = "CFT Review";
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 7) {
                $changeControl->stage = "6";
                $changeControl->status = "QA Final Review";
                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->comments = $request->comments;
                $history->stage_id = $changeControl->stage;
                $history->status = "QA Final Review";
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 8) {
                $changeControl->stage = "7";
                $changeControl->status = "QA Head/Manager Designee Approval";
                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Change-Control";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->comments = $request->comments;
                $history->stage_id = $changeControl->stage;
                $history->status = "QA Head/Manager Designee Approval";
                $history->save();
                toastr()->success('Document Sent');
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
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $changeControl->qa_final_to_initiator_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to Opened State';
        // dd($history);
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
        //     if ($u->q_m_s_divisions_id == $deviation->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $deviation],
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
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $changeControl->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send HOD Review';
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
        //     if ($u->q_m_s_divisions_id == $deviation->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $deviation],
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
        $changeControl->status = "QA Initial Review";
        $changeControl->qa_final_to_qainital_by = Auth::user()->name;
        $changeControl->qa_final_to_qainital_on = Carbon::now()->format('d-M-Y');
        $changeControl->qa_final_to_qainital_comment = $request->comments;

        $history = new RcmDocHistory();
        $history->cc_id = $id;
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $changeControl->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to QA Initial Review';
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
        //     if ($u->q_m_s_divisions_id == $deviation->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $deviation],
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


    public function sendToCft(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = CC::find($id);
            $lastDocument = CC::find($id);
            $cftResponse = ChangeControlCftResponse::withoutTrashed()->where(['cc_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();
            $cftResponse->each(function ($response) {
            $response->delete();
        });


        $changeControl->stage = "5";
        $changeControl->status = "CFT Review";
        $changeControl->qa_more_info_required_by = Auth::user()->name;
        $changeControl->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
        $history = new RcmDocHistory();
        $history->cc_id = $id;
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $changeControl->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to CFT Review';
        $history->save();
        $changeControl->update();
        $history = new RcmDocHistory();
        $history->type = "CC";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $changeControl->stage;
        $history->status = "Send to CFT Review";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $deviation->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $deviation],
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


    public function stageCFTnotReq(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = CC::find($id);
            $lastDocument = CC::find($id);
            $openState = CC::find($id);

            $changeControl->stage = "6";
            $changeControl->status = "QA Final Review";
            $history = new RcmDocHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = "";
            $history->current = Auth::user()->name;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage = 'CFT Review Not required';
            $history->save();
            $changeControl->update();
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

    public function stagecancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = CC::find($id);
            $openState = CC::find($id);



            $changeControl->stage = "0";
            $changeControl->status = "Closed-Cancelled";
            $changeControl->update();
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
        // return "hiii";
        $cc = CC::find($id);
        $parent_id = $id;
        $parent_name = "CC";
        $parent_type = "CC";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
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

        if ($request->revision == "Action-Item") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.forms.action-item', compact('parent_record','parent_id', 'parent_name', 'record_number', 'cc', 'parent_data', 'parent_data1', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id', 'due_date', 'old_record'));
        }
        if ($request->revision == "RCA") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.forms.root-cause-analysis', compact('parent_record','parent_type','parent_id', 'parent_name', 'record_number', 'cc', 'parent_data', 'parent_data1', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id', 'due_date', 'old_record'));
        }
        if ($request->revision == "Capa") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.forms.capa', compact('parent_record','parent_id','parent_type', 'parent_name', 'record_number', 'cc', 'parent_data', 'parent_data1', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id', 'due_date', 'old_record'));
        }
        if ($request->revision == "Extension") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.extension.extension_new', compact('parent_name','parent_id', 'record_number', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id', 'parent_record', 'cc'));
        }
        if ($request->revision == "New Document") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return redirect()->route('documents.create');

        }
        else{
            toastr()->warning('Not Working');
            return back();
        }
    }

    public function auditTrial($id)
    {
        $audit = RcmDocHistory::where('cc_id', $id)->orderByDESC('id')->paginate(5);
        // dd($audit);
        $today = Carbon::now()->format('d-m-y');
        $document = CC::where('id', $id)->first();
        $document->originator = User::where('id', $document->initiator_id)->value('name');

        return view('frontend.rcms.CC.audit-trial', compact('audit', 'document', 'today'));
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
        $data = RcmDocHistory::where('cc_id', $doc->id)->orderByDesc('id')->get();
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
        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');

            $docdetail = Docdetail::where('cc_id', $data->id)->first();
            $review = Qareview::where('cc_id', $data->id)->first();
            $evaluation = Evaluation::where('cc_id', $data->id)->first();
            $info = AdditionalInformation::where('cc_id', $data->id)->first();
            $comments = GroupComments::where('cc_id', $data->id)->first();
            $assessment = RiskAssessment::where('cc_id', $data->id)->first();
            $approcomments = QaApprovalComments::where('cc_id', $data->id)->first();
            $closure = ChangeClosure::where('cc_id', $data->id)->first();


            // pdf related work
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.change-control.change_control_single_pdf', compact(
                'data',
                'docdetail',
                'cftData',
                'review',
                'evaluation',
                'info',
                'comments',
                'assessment',
                'approcomments',
                'closure'
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
}
