<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\Auditee;
use App\Models\AuditeeHistory;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RecordNumber;
use Illuminate\Support\Facades\Log; 
use App\Models\SummaryGrid;
use App\Models\RoleGroup;
use App\Models\ChildRecord;
use App\Models\InternalAuditGrid;
use App\Models\AuditTrialExternal;
use App\Models\ExternalAuditCFT;
use App\Models\ExternalAuditCFTResponse;
use Carbon\Carbon;
use App\Models\User;
use PDF;
use App\Models\ActionItemHistory;
use App\Models\ActionItem;
use App\Models\Observation;
use App\Models\AuditTrialObservation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuditeeController extends Controller
{

    public function external_audit()
    {
        $old_record = Auditee::select('id', 'division_id', 'record')->get();
      //  $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $old_record = Auditee::select('id', 'division_id', 'record')->get();
        $lastAi = Auditee::orderBy('record', 'desc')->first();
        $record_number = $lastAi ? $lastAi->record + 1 : 1;
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');


        return view("frontend.forms.auditee", compact('due_date', 'record_number', 'old_record'));
    }

    public function store(Request $request)
    {
        //$request->dd();
        //  return $request->audit_start_date;
        //  die;


        if (!$request->short_description) {
            toastr()->error("Short description is required");
            return redirect()->back()->withInput();
        }
         $lastCapa = Auditee::orderBy('record', 'desc')->first();

        $record_number = $lastCapa ? $lastCapa->record + 1 : 1;
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);

        

        $internalAudit = new Auditee();
        $internalAudit->form_type = "External-audit";
        $internalAudit->record = $record_number;
        $internalAudit->initiator_id = Auth::user()->id;
        $internalAudit->division_id = $request->division_id;
        //$internalAudit->parent_id = $request->parent_id;
        //$internalAudit->parent_type = $request->parent_type;
        $internalAudit->division_code = $request->division_code;
        $internalAudit->intiation_date = $request->intiation_date;
        $internalAudit->assign_to = $request->assign_to;
        $internalAudit->due_date = $request->due_date;
        $internalAudit->Initiator_Group = $request->Initiator_Group;
        $internalAudit->initiator_group_code = $request->initiator_group_code;
        $internalAudit->short_description = $request->short_description;
        $internalAudit->audit_type = $request->audit_type;
        $internalAudit->if_other = $request->if_other;

        $internalAudit->initiated_through = $request->initiated_through;
        $internalAudit->initiated_if_other = $request->initiated_if_other;
        $internalAudit->others = $request->others;
        $internalAudit->start_date_gi = $request->start_date_gi;
        $internalAudit->end_date_gi = $request->end_date_gi;
        $internalAudit->repeat = $request->repeat;
        $internalAudit->repeat_nature = $request->repeat_nature;
        $internalAudit->due_date_extension = $request->due_date_extension;
        $internalAudit->initial_comments = $request->initial_comments;
        $internalAudit->severity_level = $request->severity_level;

        $internalAudit->reviewer_person_value = is_array($request->reviewer_person_value) ? implode(',',$request->reviewer_person_value) : $request->reviewer_person_value;


        $internalAudit->start_date = $request->start_date;
        $internalAudit->end_date = $request->end_date;
        $internalAudit->audit_agenda = $request->audit_agenda;
        //$internalAudit->Facility =  implode(',', $request->Facility);
        //$internalAudit->Group = implode(',', $request->Group);
        $internalAudit->material_name = $request->material_name;
        $internalAudit->if_comments = $request->if_comments;
        $internalAudit->lead_auditor = $request->lead_auditor;
        $internalAudit->Audit_team = is_array($request->Audit_team) ? implode(',', $request->Audit_team) : $request->Audit_team;
        $internalAudit->Auditee =  is_array($request->Auditee) ? implode(',', $request->Auditee) : $request->Auditee;
        $internalAudit->Auditor_Details = $request->Auditor_Details;
        $internalAudit->External_Auditing_Agency = $request->External_Auditing_Agency;
        $internalAudit->Relevant_Guidelines = $request->Relevant_Guidelines;
        $internalAudit->QA_Comments = $request->QA_Comments;
        $internalAudit->Audit_Category = $request->Audit_Category;
        $internalAudit->Supplier_Details = $request->Supplier_Details;
        $internalAudit->Supplier_Site = $request->Supplier_Site;
        $internalAudit->Comments = $request->Comments;
        $internalAudit->Audit_Comments1 = $request->Audit_Comments1;
        $internalAudit->Remarks = $request->Remarks;
        // $internalAudit->Reference_Recores1 =  implode(',', $request->refrence_record);
        $internalAudit->Audit_Comments2 = $request->Audit_Comments2;
        $internalAudit->due_date = $request->due_date;
        $internalAudit->audit_start_date = $request->audit_start_date;
        $internalAudit->audit_end_date = $request->audit_end_date;
        $internalAudit->status = 'Opened';
        $internalAudit->stage = 1;
        $internalAudit->external_agencies = $request->external_agencies;
        $internalAudit->qa_cqa_comment = $request->qa_cqa_comment;

        if (!empty($request->qa_cqa_attach)) {
            $files = [];
            if ($request->hasfile('qa_cqa_attach')) {
                foreach ($request->file('qa_cqa_attach') as $file) {
                    $name = $request->name . 'qa_cqa_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $internalAudit->qa_cqa_attach = json_encode($files);
        }

        if (!empty($request->file_attachment_guideline)) {
            $files = [];
            if ($request->hasfile('file_attachment_guideline')) {
                foreach ($request->file('file_attachment_guideline') as $file) {
                    $name = $request->name . 'file_attachment_guideline' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $internalAudit->file_attachment_guideline = json_encode($files);
        }


        if (!empty($request->inv_attachment)) {
            $files = [];
            if ($request->hasfile('inv_attachment')) {
                foreach ($request->file('inv_attachment') as $file) {
                    $name = $request->name . 'gi_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $internalAudit->inv_attachment = json_encode($files);
        }

        if (!empty($request->file_attachment)) {
            $files = [];
            if ($request->hasfile('file_attachment')) {
                foreach ($request->file('file_attachment') as $file) {
                    $name = $request->name . 'file_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $internalAudit->file_attachment = json_encode($files);
        }


        if (!empty($request->Audit_file)) {
            $files = [];
            if ($request->hasfile('Audit_file')) {
                foreach ($request->file('Audit_file') as $file) {
                    $name = $request->name . 'Audit_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $internalAudit->Audit_file = json_encode($files);
        }

        if (!empty($request->report_file)) {
            $files = [];
            if ($request->hasfile('report_file')) {
                foreach ($request->file('report_file') as $file) {
                    $name = $request->name . 'report_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $internalAudit->report_file = json_encode($files);
        }
        if (!empty($request->myfile)) {
            $files = [];
            if ($request->hasfile('myfile')) {
                foreach ($request->file('myfile') as $file) {
                    $name = $request->name . 'summary_response_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $internalAudit->myfile = json_encode($files);
        }

        //return $internalAudit;
        $internalAudit->save();

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();

        // -----------------grid---- Audit Agenda
        $data3 = new InternalAuditGrid();
      //  $request->dd();
        $data3->audit_id = $internalAudit->id;
        $data3->type = "external_audit";
        if (!empty($request->audit)) {
            $data3->area_of_audit = serialize($request->audit);
        }
        if (!empty($request->scheduled_start_date)) {
            $data3->start_date = serialize($request->scheduled_start_date);
        }
        if (!empty($request->scheduled_start_time)) {
            $data3->start_time = serialize($request->scheduled_start_time);
        }
        if (!empty($request->scheduled_end_date)) {
            $data3->end_date = serialize($request->scheduled_end_date);
        }
        if (!empty($request->scheduled_end_time)) {
            $data3->end_time = serialize($request->scheduled_end_time);
        }
        if (!empty($request->auditor)) {
            $data3->auditor = serialize($request->auditor);
        }
        if (!empty($request->auditee)) {
            $data3->auditee = serialize($request->auditee);
        }
        if (!empty($request->remarks)) {
            $data3->remark = serialize($request->remarks);
        }

        $data3->save();
         // -----------------grid ---- Observation Details
        $data4 = new InternalAuditGrid();
        $data4->audit_id = $internalAudit->id;
        $data4->type = "Observation_field_Auditee";
        if (!empty($request->observation_id)) {
            $data4->observation_id = serialize($request->observation_id);
        }
        if (!empty($request->date)) {
            $data4->date = serialize($request->date);
        }
        if (!empty($request->auditorG)) {
            $data4->auditor = serialize($request->auditorG);
        }
        if (!empty($request->auditeeG)) {
            $data4->auditee = serialize($request->auditeeG);
        }
        if (!empty($request->observation_description)) {
            $data4->observation_description = serialize($request->observation_description);
        }
        if (!empty($request->severity_level)) {
            $data4->severity_level = serialize($request->severity_level);
        }
        if (!empty($request->area)) {
            $data4->area = serialize($request->area);
        }
        if (!empty($request->observation_category)) {
            $data4->observation_category = serialize($request->observation_category);
        }
         if (!empty($request->capa_required)) {
            $data4->capa_required = serialize($request->capa_required);
        }
         if (!empty($request->auditee_response)) {
            $data4->auditee_response = serialize($request->auditee_response);
        }
        if (!empty($request->auditor_review_on_response)) {
            $data4->auditor_review_on_response = serialize($request->auditor_review_on_response);
        }
        if (!empty($request->qa_comment)) {
            $data4->qa_comment = serialize($request->qa_comment);
        }
        if (!empty($request->capa_details)) {
            $data4->capa_details = serialize($request->capa_details);
        }
        if (!empty($request->capa_due_date)) {
            $data4->capa_due_date = serialize($request->capa_due_date);
        }
        if (!empty($request->capa_owner)) {
            $data4->capa_owner = serialize($request->capa_owner);
        }
        if (!empty($request->action_taken)) {
            $data4->action_taken = serialize($request->action_taken);
        }
        if (!empty($request->capa_completion_date)) {
            $data4->capa_completion_date = serialize($request->capa_completion_date);
        }
        if (!empty($request->status_Observation)) {
            $data4->status = serialize($request->status_Observation);
        }
        if (!empty($request->remark_observation)) {
            $data4->remark = serialize($request->remark_observation);
        }
        //dd($data4);
        $data4->save();
        $Cft = new ExternalAuditCFT();
        $Cft->external_audit_id = $internalAudit->id;
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
        if (!empty($internalAudit->intiation_date)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($internalAudit->intiation_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }







            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current =Auth::user()->name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();


        if (!empty($internalAudit->assign_to)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Assigned to';
            $history->previous = "Null";
            $history->current = $internalAudit->assign_to;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }
        if (!empty($internalAudit->record)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Record Number';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName(session()->get('division')) . "/EA/" . Helpers::year($internalAudit->created_at) . "/" . str_pad($internalAudit->record, 4, '0', STR_PAD_LEFT);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }
        if (!empty($internalAudit->Initiator_Group)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Initiatior Department';
            $history->previous = "Null";
            $history->current =  Helpers::getUsersDepartmentName(Auth::user()->departmentid) ;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }


        if (!empty($internalAudit->initiator_group_code)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Initiator Department Code';
            $history->previous = "Null";
            $history->current =  $internalAudit->initiator_group_code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }
        if(!empty($internalAudit->division_code))
        {


            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Site/Location Code';
            $history->previous = "Null";
            $history->current = $internalAudit->division_code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';


            $history->save();
        }
        if (!empty($internalAudit->initiator)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = $internalAudit->initiator;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }
        if (!empty($internalAudit->short_description)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $internalAudit->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->audit_type)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Type of Audit';
            $history->previous = "Null";
            $history->current = $internalAudit->audit_type;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }
//----------------------------------------------------------------------
        if (!empty($internalAudit->initiated_through)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Initiated Through';
            $history->previous = "Null";
            $history->current = $internalAudit->initiated_through;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                  $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->initiated_if_other)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Others';
            $history->previous = "Null";
            $history->current = $internalAudit->initiated_if_other;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                  $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->if_other)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'If Other';
            $history->previous = "Null";
            $history->current = $internalAudit->if_other;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                  $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->external_agencies)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'External Agencies';
            $history->previous = "Null";
            $history->current = $internalAudit->external_agencies;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                  $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->Others)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Others';
            $history->previous = "Null";
            $history->current = $internalAudit->Others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                  $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }
        if (!empty($internalAudit->initial_comments)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Description';
            $history->previous = "Null";
            $history->current = $internalAudit->initial_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                  $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->start_date)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit  Start Date';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($internalAudit->start_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                  $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->end_date)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit  End Date';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($internalAudit->end_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }






        if (!empty($internalAudit->start_date_gi)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Start Date of Audit';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($internalAudit->start_date_gi);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }



        if (!empty($internalAudit->end_date_gi)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'End Date of Audit';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($internalAudit->end_date_gi);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }




        if (!empty($internalAudit->reviewer_person_value)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'CFT review selection';
            $history->previous = "Null";
            $history->current = $internalAudit->reviewer_person_value;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->if_comments)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Comments if any';
            $history->previous = "Null";
            $history->current = $internalAudit->if_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                 $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->audit_agenda)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Agenda';
            $history->previous = "Null";
            $history->current = $internalAudit->audit_agenda;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        // if (!empty($internalAudit->Facility)) {
        //     $history = new AuditTrialExternal();
        //     $history->ExternalAudit_id = $internalAudit->id;
        //     $history->activity_type = 'Facility Name';
        //     $history->previous = "Null";
        //     $history->current = $internalAudit->Facility;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $internalAudit->status;
        //     $history->save();
        // }

        // if (!empty($internalAudit->Group)) {
        //     $history = new AuditTrialExternal();
        //     $history->ExternalAudit_id = $internalAudit->id;
        //     $history->activity_type = 'Group Name';
        //     $history->previous = "Null";
        //     $history->current = $internalAudit->Group;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $internalAudit->status;
        //     $history->save();
        // }

        if (!empty($internalAudit->material_name)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Product/Material Name';
            $history->previous = "Null";
            $history->current = $internalAudit->material_name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->lead_auditor)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Lead Auditor';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($internalAudit->lead_auditor);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                 $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->Audit_team)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Team';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($internalAudit->Audit_team);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->Auditee)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Auditee';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($internalAudit->Auditee);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->Auditor_Details)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'External Auditor Details';
            $history->previous = "Null";
            $history->current = $internalAudit->Auditor_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->External_Auditing_Agency)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'External Auditing Agency';
            $history->previous = "Null";
            $history->current = $internalAudit->External_Auditing_Agency;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                  $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }



        if (!empty($internalAudit->Relevant_Guideline)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Relevant Guidelines / Industry Standards';
            $history->previous = "Null";
            $history->current = $internalAudit->Relevant_Guideline;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                  $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }


        if (!empty($internalAudit->QA_Comments)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'QA Comments';
            $history->previous = "Null";
            $history->current = $internalAudit->QA_Comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                  $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->Comments)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Comments';
            $history->previous = "Null";
            $history->current = $internalAudit->Comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->Audit_Category)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Category';
            $history->previous = "Null";
            $history->current = $internalAudit->Audit_Category;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }



        if (!empty($internalAudit->Supplier_Details)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Supplier/Vendor/Manufacturer Details';
            $history->previous = "Null";
            $history->current = $internalAudit->Supplier_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                 $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }


        if (!empty($internalAudit->Supplier_Site)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Supplier/Vendor/Manufacturer Site';
            $history->previous = "Null";
            $history->current = $internalAudit->Supplier_Site;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                 $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->Audit_Comments1)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Comments';
            $history->previous = "Null";
            $history->current = $internalAudit->Audit_Comments1;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                  $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->Remarks)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Remarks';
            $history->previous = "Null";
            $history->current = $internalAudit->Remarks;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->Reference_Recores1)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Reference Records';
            $history->previous = "Null";
            $history->current = $internalAudit->Reference_Recores1;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->Reference_Recores2)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Reference Recores';
            $history->previous = "Null";
            $history->current = $internalAudit->Reference_Recores2;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->Audit_Comments2)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Comments';
            $history->previous = "Null";
            $history->current = $internalAudit->Audit_Comments2;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->inv_attachment)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'GI Attachment';
            $history->previous = "Null";
            $history->current = $internalAudit->inv_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->file_attachment)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'File Attachment';
            $history->previous = "Null";
            $history->current = $internalAudit->file_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        // if (!empty($internalAudit->Audit_file)) {
        //     $history = new AuditTrialExternal();
        //     $history->ExternalAudit_id = $internalAudit->id;
        //     $history->activity_type = 'Audit Attachments';
        //     $history->previous = "Null";
        //     $history->current = $internalAudit->Audit_file;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $internalAudit->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';

        //     $history->save();
        // }

        if (!empty($internalAudit->report_file)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Report Attachments';
            $history->previous = "Null";
            $history->current = $internalAudit->report_file;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->myfile)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type =  'Audit Attachments';
            $history->previous = "Null";
            $history->current = $internalAudit->myfile;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }



        if (!empty($internalAudit->reviewer_person_value)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type =  'CFT review selection';
            $history->previous = "Null";
            $history->current = $internalAudit->reviewer_person_value;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }
        if (!empty($internalAudit->myfile)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Summary And Response Attachment';
            $history->previous = "Null";
            $history->current = $internalAudit->myfile;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->due_date)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($internalAudit->due_date);
            // $history->current = Carbon::parse($internalAudit->due_date)->format('d-M-Y');
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                   $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->audit_start_date)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Start Date';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($internalAudit->audit_start_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                 $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->audit_end_date)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit End Date';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($internalAudit->audit_end_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
                 $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        if (!empty($internalAudit->severity_level)) {
            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Observation Category';
            $history->previous = "Null";
            $history->current = $internalAudit->severity_level;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';

            $history->save();
        }

        $Summary = $internalAudit->id;

        // First Grid - Summary Response
        if (!empty($request->SummaryResponse)) {
            $summaryDetails = SummaryGrid::where(['summary_id' => $Summary, 'identifier' => 'Summary Response'])->firstOrNew();
            $summaryDetails->summary_id = $Summary;
            $summaryDetails->identifier = 'Summary Response';
            $summaryDetails->data = $request->SummaryResponse;
            $summaryDetails->save();
        
            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                'observation' => 'Observation',
                'response' => 'Response',
                'reference_id' => 'CAPA / Child action Reference If Any',
                'status' => 'Status',
                'remarks' => 'Remarks'
            ];
        
            // Track audit trail changes
            if (is_array($request->SummaryResponse)) {
                foreach ($request->SummaryResponse as $index => $newSummary) {
                    $previousSummary = $existingSummaryDataArray[$index] ?? [];
        
                    // Track changes for each field
                    $fieldsToTrack = ['observation', 'response', 'reference_id', 'status', 'remarks'];
                    foreach ($fieldsToTrack as $field) {
                        $oldValue = $previousSummary[$field] ?? 'Null';
                        $newValue = $newSummary[$field] ?? 'Null';
        
                        // If there's a change, add an entry to the audit trail
                        if ($oldValue !== $newValue) {
                            $auditTrail = new AuditTrialExternal();
                            $auditTrail->ExternalAudit_id = $Summary;
                            $auditTrail->activity_type = $fieldNames[$field] . ' (' . ($index + 1) . ')';
                            $auditTrail->previous = $oldValue;
                            $auditTrail->current = $newValue;
                            $auditTrail->comment = "";
                            $auditTrail->user_id = Auth::user()->id;
                            $auditTrail->user_name = Auth::user()->name;
                            $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $auditTrail->origin_state = $internalAudit->status;
                            $auditTrail->change_to = "Opened";
                            $auditTrail->change_from = "Initiation";
                            $auditTrail->action_name = 'Create';
                            $auditTrail->save();  // Save the audit trail for each change
                        }
                    }
                }
            }
        }
        
        // Second Grid - Auditors
        if (!empty($request->AuditorNew)) {
            $AuditorsNew = SummaryGrid::where(['summary_id' => $Summary, 'identifier' => 'Auditors'])->firstOrNew();
            $AuditorsNew->summary_id = $Summary;
            $AuditorsNew->identifier = 'Auditors';
            $AuditorsNew->data = $request->AuditorNew;
            $AuditorsNew->save();
        
            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                'auditornew' => 'Auditor Name',
                'regulatoryagency' => 'External Agency Name',
                'designation' => 'Designation',
                'remarks' => 'Remarks'
            ];
        
            // Track audit trail changes
            if (is_array($request->AuditorNew)) {
                foreach ($request->AuditorNew as $index => $newAuditor) {
                    $previousAuditor = $existingAuditorData[$index] ?? [];
        
                    // Track changes for each field
                    $fieldsToTrack = ['auditornew', 'regulatoryagency', 'designation', 'remarks'];
                    foreach ($fieldsToTrack as $field) {
                        $oldValue = $previousAuditor[$field] ?? 'Null';
                        $newValue = $newAuditor[$field] ?? 'Null';
        
                        // If there's a change, add an entry to the audit trail
                        if ($oldValue !== $newValue) {
                            $auditTrail = new AuditTrialExternal();
                            $auditTrail->ExternalAudit_id = $Summary;
                            $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                            $auditTrail->previous = $oldValue;
                            $auditTrail->current = $newValue;
                            $auditTrail->comment = "";
                            $auditTrail->user_id = Auth::user()->id;
                            $auditTrail->user_name = Auth::user()->name;
                            $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $auditTrail->origin_state = $internalAudit->status;
                            $auditTrail->change_to = "Opened";
                            $auditTrail->change_from = "Initiation";
                            $auditTrail->action_name = 'Create';
                            $auditTrail->save();  // Save the audit trail for each change
                        }
                    }
                }
            }
        }
        









        toastr()->success("Record is Create Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }

    public function show($id)
    {


        $old_record = Auditee::select('id', 'division_id', 'record')->get();
        $auditornew = Auditee::where('id', $id)->first();
        $data = Auditee::find($id);


        $cftReviewerIds = explode(',', $data->reviewer_person_value);
        $cft = User::get();

        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $grid_data = InternalAuditGrid::where('audit_id', $id)->where('type', "external_audit")->first();
        $grid_data1 = InternalAuditGrid::where('audit_id', $id)->where('type', "Observation_field_Auditee")->first();
        $data1 =  ExternalAuditCFT::where('external_audit_id', $id)->first();
        $oocgrid = SummaryGrid::where('summary_id',$id)->first();
        $auditorview = SummaryGrid::where(['summary_id'=>$id, 'identifier'=>'Auditors'])->first();






        return view('frontend.externalAudit.view', compact('data', 'old_record','grid_data','grid_data1', 'data1','oocgrid','auditorview','cftReviewerIds','cft'));
    }

    public function update(Request $request, $id)
    {

        //dd($request->all());
        $lastDocument = Auditee::find($id);
        $internalAudit = Auditee::find($id);
        $lastCft = ExternalAuditCFT::where('external_audit_id', $internalAudit->id)->first();
        $form_progress = null;
        //$internalAudit->division_id = $request->division_id;
        //$internalAudit->parent_id = $request->parent_id;
        //$internalAudit->parent_type = $request->parent_type;
        $internalAudit->intiation_date = $request->intiation_date;
        $internalAudit->assign_to = $request->assign_to;
        if ($request->has('due_date_new') && !empty($request->due_date_new)) {
            $internalAudit->due_date = $request->due_date_new;
        } else {
            // Keep the existing due date if no new date is selected
            $internalAudit->due_date = $request->due_date;
        }
        $internalAudit->Initiator_Group = $request->Initiator_Group;
        $internalAudit->initiator_group_code = $request->initiator_group_code;
        $internalAudit->short_description = $request->short_description;
        // $internalAudit->audit_type = $request->audit_type;
        if ($request->has('audit_type') && !empty($request->audit_type)) {
            $internalAudit->audit_type = $request->audit_type;
        }
        $internalAudit->if_other = $request->if_other;

        $internalAudit->initiated_through = $request->initiated_through;
        $internalAudit->start_date_gi = $request->start_date_gi;
        $internalAudit->end_date_gi = $request->end_date_gi;
        $internalAudit->initiated_if_other = $request->initiated_if_other;
        $internalAudit->others = $request->others;
        $internalAudit->external_agencies = $request->external_agencies;
        $internalAudit->repeat = $request->repeat;
        $internalAudit->repeat_nature = $request->repeat_nature;
        $internalAudit->due_date_extension = $request->due_date_extension;

        $internalAudit->initial_comments = $request->initial_comments;
        $internalAudit->start_date = $request->start_date;

        $internalAudit->end_date = $request->end_date;
        $internalAudit->audit_agenda = $request->audit_agenda;
        //$internalAudit->Facility =  implode(',', $request->Facility);
        //$internalAudit->Group = implode(',', $request->Group);
        $internalAudit->material_name = $request->material_name;
        $internalAudit->if_comments = $request->if_comments;
        $internalAudit->lead_auditor = $request->lead_auditor;
        $internalAudit->Audit_team = is_array($request->Audit_team) ? implode(',', $request->Audit_team) : $request->Audit_team;
        $internalAudit->Auditee = is_array($request->Auditee) ? implode(',', $request->Auditee) : $request->Auditee;

        $internalAudit->Auditor_Details = $request->Auditor_Details;
        $internalAudit->Audit_Category = $request->Audit_Category;
        $internalAudit->External_Auditing_Agency = $request->External_Auditing_Agency;
        $internalAudit->Relevant_Guidelines = $request->Relevant_Guidelines;
        $internalAudit->QA_Comments = $request->QA_Comments;
        $internalAudit->Supplier_Details = $request->Supplier_Details;
        $internalAudit->Supplier_Site = $request->Supplier_Site;
        $internalAudit->Comments = $request->Comments;
        $internalAudit->Audit_Comments1 = $request->Audit_Comments1;
        $internalAudit->Remarks = $request->Remarks;


        $internalAudit->reviewer_person_value = is_array($request->reviewer_person_value) ? implode(',',$request->reviewer_person_value) : $request->reviewer_person_value;




        $internalAudit->qa_cqa_comment = $request->qa_cqa_comment;







        // $internalAudit->Reference_Recores1 =  implode(',', $request->refrence_record);
            // if (!empty($request->qa_cqa_attach)) {
        //     $files = [];
        //     if ($request->hasfile('qa_cqa_attach')) {

        //         foreach ($request->file('qa_cqa_attach') as $file) {
        //             $name = $request->name . 'qa_cqa_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }


        //     $internalAudit->qa_cqa_attach = json_encode($files);
        // }



        if (!empty($request->qa_cqa_attach) || !empty($request->deleted_qa_cqa_attach)) {
            $existingFiles = json_decode($internalAudit->qa_cqa_attach, true) ?? [];

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
            $internalAudit->qa_cqa_attach = json_encode($allFiles);
        }

        if (!empty($request->file_attachment_guideline)) {
            $files = [];
            if ($request->hasfile('file_attachment_guideline')) {

                foreach ($request->file('file_attachment_guideline') as $file) {
                    $name = $request->name . 'file_attachment_guideline' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->file_attachment_guideline = json_encode($files);
        }

        $internalAudit->Audit_Comments2 = $request->Audit_Comments2;
        $internalAudit->due_date = $request->due_date;
        $internalAudit->audit_start_date = $request->audit_start_date;
        $internalAudit->audit_end_date = $request->audit_end_date;
        $internalAudit->severity_level = $request->severity_level;

        // if (!empty($request->inv_attachment)) {
        //     $files = [];
        //     if ($request->hasfile('inv_attachment')) {
        //         foreach ($request->file('inv_attachment') as $file) {
        //             $name = $request->name . 'inv_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }


        //     $internalAudit->inv_attachment = json_encode($files);
        // }



        if (!empty($request->inv_attachment) || !empty($request->deleted_inv_attachment)) {
            $existingFiles = json_decode($internalAudit->inv_attachment, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_inv_attachment)) {
                $filesToDelete = explode(',', $request->deleted_inv_attachment);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('inv_attachment')) {
                foreach ($request->file('inv_attachment') as $file) {
                    $name = $request->name . 'gi_attachment' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $internalAudit->inv_attachment = json_encode($allFiles);
        }


        if (!empty($request->file_attachment)) {
            $files = [];
            if ($request->hasfile('file_attachment')) {

                foreach ($request->file('file_attachment') as $file) {
                    $name = $request->name . 'file_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->file_attachment = json_encode($files);
        }


        if (!empty($request->Audit_file)) {
            $files = [];
            if ($request->hasfile('Audit_file')) {
                foreach ($request->file('Audit_file') as $file) {
                    $name = $request->name . 'Audit_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->Audit_file = json_encode($files);
        }

        if (!empty($request->report_file)) {
            $files = [];
            if ($request->hasfile('report_file')) {
                foreach ($request->file('report_file') as $file) {
                    $name = $request->name . 'report_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->report_file = json_encode($files);
        }




        if (!empty($request->myfile) || !empty($request->deleted_myfile)) {
            $existingFiles = json_decode($internalAudit->myfile, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_myfile)) {
                $filesToDelete = explode(',', $request->deleted_myfile);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('myfile')) {
                foreach ($request->file('myfile') as $file) {
                    $name = $request->name . 'summary_response_attachment' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $internalAudit->myfile = json_encode($allFiles);
        }

        if($internalAudit->stage == 2 || $internalAudit->stage == 3 ){


            if (!$form_progress) {
                $form_progress = 'cft';
            }
            // dd($form_progress);

            $Cft = ExternalAuditCFT::where('external_audit_id', $id)->first();
            if($Cft && $internalAudit->stage == 3 ){
                $Cft->RA_Review = $request->RA_Review == null ? $Cft->RA_Review : $request->RA_Review;
                $Cft->RA_person = $request->RA_person == null ? $Cft->RA_person : $request->RA_person;

                $Cft->Production_Table_Review = $request->Production_Table_Review == null ? $Cft->Production_Table_Review : $request->Production_Table_Review;
                $Cft->Production_Table_Person = $request->Production_Table_Person == null ? $Cft->Production_Table_Person : $request->Production_Table_Person;

                $Cft->Production_Injection_Review = $request->Production_Injection_Review == null ? $Cft->Production_Injection_Review : $request->Production_Injection_Review;
                $Cft->Production_Injection_Person = $request->Production_Injection_Person == null ? $Cft->Production_Injection_Person : $request->Production_Injection_Person;

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
                $Cft->Warehouse_notification = $request->Warehouse_notification;
                $Cft->Warehouse_review = $request->Warehouse_review;

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
            $Cft->Warehouse_feedback = $request->Warehouse_feedback;
            $Cft->Warehouse_assessment = $request->Warehouse_assessment;
            $Cft->Production_Table_Feedback = $request->Production_Table_Feedback;
            $Cft->Production_Table_Assessment = $request->Production_Table_Assessment;

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
                $IsCFTRequired = ExternalAuditCFTResponse::where(['is_required' => 1, 'external_audit_id' => $id])->latest()->first();
                $cftUsers = DB::table('external_audit_c_f_t_s')->where(['external_audit_id' => $id])->first();
                // Define the column names
                $columns = ['Quality_Control_Person', 'QualityAssurance_person', 'Engineering_person', 'Environment_Health_Safety_person', 'Human_Resource_person', 'Information_Technology_person', 'Other1_person', 'Other2_person', 'Other3_person', 'Other4_person', 'Other5_person', 'Production_Table_Person','ProductionLiquid_person','Production_Injection_Person','Store_person','ResearchDevelopment_person','Microbiology_person','RegulatoryAffair_person','CorporateQualityAssurance_person','ContractGiver_person'];

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
                                    ['data' => $internalAudit],
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


            if (!empty ($request->Initial_attachment)) {
                $files = [];

                if ($internalAudit->Initial_attachment) {
                    $files = is_array(json_decode($internalAudit->Initial_attachment)) ? $internalAudit->Initial_attachment : [];
                }

                if ($request->hasfile('Initial_attachment')) {
                    foreach ($request->file('Initial_attachment') as $file) {
                        $name = $request->name . 'Initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }


                $internalAudit->Initial_attachment = json_encode($files);
            }
        }

        // $internalAudit->form_progress = isset($form_progress) ? $form_progress : null;
        $internalAudit->update();

        $data3 = InternalAuditGrid::where('audit_id',$internalAudit->id)->where('type','external_audit')->first();
        if (!empty($request->audit)) {
            $data3->area_of_audit = serialize($request->audit);
        }
        if (!empty($request->scheduled_start_date)) {
            $data3->start_date = serialize($request->scheduled_start_date);
        }
        if (!empty($request->scheduled_start_time)) {
            $data3->start_time = serialize($request->scheduled_start_time);
        }
        if (!empty($request->scheduled_end_date)) {
            $data3->end_date = serialize($request->scheduled_end_date);
        }
        if (!empty($request->scheduled_end_time)) {
            $data3->end_time = serialize($request->scheduled_end_time);
        }
        if (!empty($request->auditor)) {
            $data3->auditor = serialize($request->auditor);
        }
        if (!empty($request->auditee)) {
            $data3->auditee = serialize($request->auditee);
        }
        if (!empty($request->remark)) {
            $data3->remark = serialize($request->remark);
        }
        $data3->update();

        $data4 = InternalAuditGrid::where('audit_id',$internalAudit->id)->where('type','Observation_field_Auditee')->first();

        if (!empty($request->observation_id)) {
            $data4->observation_id = serialize($request->observation_id);
        }
        if (!empty($request->date)) {
            $data4->date = serialize($request->date);
        }
        if (!empty($request->auditorG)) {
            $data4->auditor = serialize($request->auditorG);
        }
        if (!empty($request->auditeeG)) {
            $data4->auditee = serialize($request->auditeeG);
        }
        if (!empty($request->observation_description)) {
            $data4->observation_description = serialize($request->observation_description);
        }
        if (!empty($request->severity_level)) {
            $data4->severity_level = serialize($request->severity_level);
        }
        if (!empty($request->area)) {
            $data4->area = serialize($request->area);
        }
        if (!empty($request->observation_category)) {
            $data4->observation_category = serialize($request->observation_category);
        }
         if (!empty($request->capa_required)) {
            $data4->capa_required = serialize($request->capa_required);
        }
         if (!empty($request->auditee_response)) {
            $data4->auditee_response = serialize($request->auditee_response);
        }
        if (!empty($request->auditor_review_on_response)) {
            $data4->auditor_review_on_response = serialize($request->auditor_review_on_response);
        }
        if (!empty($request->qa_comment)) {
            $data4->qa_comment = serialize($request->qa_comment);
        }
        if (!empty($request->capa_details)) {
            $data4->capa_details = serialize($request->capa_details);
        }
        if (!empty($request->capa_due_date)) {
            $data4->capa_due_date = serialize($request->capa_due_date);
        }
        if (!empty($request->capa_owner)) {
            $data4->capa_owner = serialize($request->capa_owner);
        }
        if (!empty($request->action_taken)) {
            $data4->action_taken = serialize($request->action_taken);
        }
        if (!empty($request->capa_completion_date)) {
            $data4->capa_completion_date = serialize($request->capa_completion_date);
        }
        if (!empty($request->status_Observation)) {
            $data4->status = serialize($request->status_Observation);
        }
        if (!empty($request->remark_observation)) {
            $data4->remark = serialize($request->remark_observation);
        }

        $data4->update();

        if ($lastDocument->date != $internalAudit->date || !empty($request->date_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = $lastDocument->date;
            $history->current = $internalAudit->date;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;


            if (is_null($lastDocument->date) || $lastDocument->date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }


            $history->save();
        }



        if ($lastDocument->initiated_through != $internalAudit->initiated_through || !empty($request->comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Initiated Through';
            $history->previous = $lastDocument->initiated_through;
            $history->current = $internalAudit->initiated_through;
            $history->comment = $request->date_comment;
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



        if ($lastDocument->severity_level != $internalAudit->severity_level || !empty($request->comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Observation Category';
            $history->previous = $lastDocument->severity_level;
            $history->current = $internalAudit->severity_level;
            $history->comment = $request->date_comment;
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
        if ($lastDocument->Initiator_Group != $internalAudit->Initiator_Group || !empty($request->Initiator_Group_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Initiator Department';
            $history->previous = Helpers::getFullDepartmentName($lastDocument->Initiator_Group);
            $history->current = Helpers::getFullDepartmentName($internalAudit->Initiator_Group);
            $history->comment = $request->date_comment;
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

            $history->save();
        }



        if ($lastDocument->reviewer_person_value != $internalAudit->reviewer_person_value || !empty($request->reviewer_person_value_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'CFT review selection';
            $history->previous = $lastDocument->reviewer_person_value;
            $history->current = $internalAudit->reviewer_person_value;
            $history->comment = $request->date_comment;
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

            $history->save();
        }

        if ($lastDocument->initiator_group_code != $internalAudit->initiator_group_code || !empty($request->initiator_group_code_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Initiator Department Code';
            $history->previous = $lastDocument->initiator_group_code;
            $history->current = $internalAudit->initiator_group_code;
            $history->comment = $request->date_comment;
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
//-----------------------------------------------------------------------------------------

            if ($lastDocument->initiated_if_other != $internalAudit->initiated_if_other || !empty($request->others_comment)) {

                $history = new AuditTrialExternal();
                $history->ExternalAudit_id = $id;
                $history->activity_type = 'Others';
                $history->previous = $lastDocument->initiated_if_other;
                $history->current = $internalAudit->initiated_if_other;
                $history->comment = $request->date_comment;
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

            if ($lastDocument->others != $internalAudit->others || !empty($request->Initiator_Group_comment)) {

                $history = new AuditTrialExternal();
                $history->ExternalAudit_id = $id;
                $history->activity_type = 'Others';
                $history->previous = $lastDocument->others;
                $history->current = $internalAudit->others;
                $history->comment = $request->date_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Not Applicable";
                $history->change_from = $lastDocument->status;
                if (is_null($lastDocument->others) || $lastDocument->others === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }


                $history->save();
            }


        if ($lastDocument->short_description != $internalAudit->short_description || !empty($request->short_description_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastDocument->short_description;
            $history->current = $internalAudit->short_description;
            $history->comment = $request->date_comment;
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
        if ($lastDocument->audit_type != $internalAudit->audit_type || !empty($request->audit_type_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Type of Audit';
            $history->previous = $lastDocument->audit_type;
            $history->current = $internalAudit->audit_type;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->audit_type) || $lastDocument->audit_type === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }


            $history->save();
        }
        if ($lastDocument->if_other != $internalAudit->if_other || !empty($request->if_other_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'If Other';
            $history->previous = $lastDocument->if_other;
            $history->current = $internalAudit->if_other;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->if_other) || $lastDocument->if_other === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        if ($lastDocument->external_agencies != $internalAudit->external_agencies || !empty($request->if_other_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'External Agencies';
            $history->previous = $lastDocument->external_agencies;
            $history->current = $internalAudit->external_agencies;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->external_agencies) || $lastDocument->external_agencies === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->if_comments != $internalAudit->if_comments || !empty($request->if_other_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Comments if any';
            $history->previous = $lastDocument->if_comments;
            $history->current = $internalAudit->if_comments;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->if_comments) || $lastDocument->if_comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }


            $history->save();
        }
        if ($lastDocument->initial_comments != $internalAudit->initial_comments || !empty($request->initial_comments_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Description';
            $history->previous = $lastDocument->initial_comments;
            $history->current = $internalAudit->initial_comments;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->initial_comments) || $lastDocument->initial_comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->start_date != $internalAudit->start_date || !empty($request->start_date_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Audit  Start Date';
            $history->previous = $lastDocument->start_date;
            $history->current = $internalAudit->start_date;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->start_date) || $lastDocument->start_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->end_date != $internalAudit->end_date || !empty($request->end_date_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Audit  End Date';
            $history->previous = $lastDocument->end_date;
            $history->current = $internalAudit->end_date;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->end_date) || $lastDocument->end_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->audit_agenda != $internalAudit->audit_agenda || !empty($request->audit_agenda_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Audit Agenda';
            $history->previous = $lastDocument->audit_agenda;
            $history->current = $internalAudit->audit_agenda;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->audit_agenda) || $lastDocument->audit_agenda === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Facility != $internalAudit->Facility || !empty($request->Facility_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Facility Name';
            $history->previous = $lastDocument->Facility;
            $history->current = $internalAudit->Facility;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Facility) || $lastDocument->Facility === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
       if ($lastDocument->Group != $internalAudit->Group || !empty($request->Group_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Group Name';
            $history->previous = $lastDocument->Group;
            $history->current = $internalAudit->Group;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Group) || $lastDocument->Group === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }



        if ($lastDocument->material_name != $internalAudit->material_name || !empty($request->material_name_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Product/Material Name';
            $history->previous = $lastDocument->material_name;
            $history->current = $internalAudit->material_name;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->material_name) || $lastDocument->material_name === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        if ($lastDocument->QA_Comments != $internalAudit->QA_Comments || !empty($request->material_name_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'QA Comments';
            $history->previous = $lastDocument->QA_Comments;
            $history->current = $internalAudit->QA_Comments;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->QA_Comments) || $lastDocument->QA_Comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->Audit_Category != $internalAudit->Audit_Category || !empty($request->material_name_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Audit Category';
            $history->previous = $lastDocument->Audit_Category;
            $history->current = $internalAudit->Audit_Category;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Audit_Category) || $lastDocument->Audit_Category === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->Supplier_Details != $internalAudit->Supplier_Details || !empty($request->material_name_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Supplier/Vendor/Manufacturer Details';
            $history->previous = $lastDocument->Supplier_Details;
            $history->current = $internalAudit->Supplier_Details;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Supplier_Details) || $lastDocument->Supplier_Details === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->Supplier_Site != $internalAudit->Supplier_Site || !empty($request->material_name_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Supplier/Vendor/Manufacturer Site';
            $history->previous = $lastDocument->Supplier_Site;
            $history->current = $internalAudit->Supplier_Site;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Supplier_Site) || $lastDocument->Supplier_Site === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }



        if ($lastDocument->External_Auditing_Agency != $internalAudit->External_Auditing_Agency || !empty($request->material_name_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'External Auditing Agency';
            $history->previous = $lastDocument->External_Auditing_Agency;
            $history->current = $internalAudit->External_Auditing_Agency;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->External_Auditing_Agency) || $lastDocument->External_Auditing_Agency === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->lead_auditor != $internalAudit->lead_auditor || !empty($request->lead_auditor_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Lead Auditor';
            $history->previous = Helpers::getInitiatorName($lastDocument->lead_auditor);
            $history->current = Helpers::getInitiatorName($internalAudit->lead_auditor);
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->lead_auditor) || $lastDocument->lead_auditor === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Audit_team != $internalAudit->Audit_team || !empty($request->Audit_team_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Audit Team';
            $history->previous =Helpers::getInitiatorName($lastDocument->Audit_team);
            $history->current = Helpers::getInitiatorName($internalAudit->Audit_team);
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Audit_team) || $lastDocument->Audit_team === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Auditee != $internalAudit->Auditee || !empty($request->Auditee_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Auditee';
            $history->previous = Helpers::getInitiatorName($lastDocument->Auditee);
            $history->current = Helpers::getInitiatorName($internalAudit->Auditee);
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Auditee) || $lastDocument->Auditee === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Auditor_Details != $internalAudit->Auditor_Details || !empty($request->Auditor_Details_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'External Auditor Details';
            $history->previous = $lastDocument->Auditor_Details;
            $history->current = $internalAudit->Auditor_Details;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Auditor_Details) || $lastDocument->Auditor_Details === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Comments != $internalAudit->Comments || !empty($request->Comments_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Comments';
            $history->previous = $lastDocument->Comments;
            $history->current = $internalAudit->Comments;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Comments) || $lastDocument->Comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Audit_Comments1 != $internalAudit->Audit_Comments1 || !empty($request->Audit_Comments1_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Audit Comments';
            $history->previous = $lastDocument->Audit_Comments1;
            $history->current = $internalAudit->Audit_Comments1;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Audit_Comments1) || $lastDocument->Audit_Comments1 === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Remarks != $internalAudit->Remarks || !empty($request->Remarks_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Remarks';
            $history->previous = $lastDocument->Remarks;
            $history->current = $internalAudit->Remarks;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Remarks) || $lastDocument->Remarks === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Reference_Recores1 != $internalAudit->Reference_Recores1 || !empty($request->Reference_Recores1_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Reference Recores';
            $history->previous = $lastDocument->Reference_Recores1;
            $history->current = $internalAudit->Reference_Recores1;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Reference_Recores1) || $lastDocument->Reference_Recores1 === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Reference_Recores2 != $internalAudit->Reference_Recores2 || !empty($request->Reference_Recores2_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Reference Recores';
            $history->previous = $lastDocument->Reference_Recores2;
            $history->current = $internalAudit->Reference_Recores2;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Reference_Recores2) || $lastDocument->Reference_Recores2 === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Audit_Comments2 != $internalAudit->Audit_Comments2 || !empty($request->Audit_Comments2_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Audit Comments';
            $history->previous = $lastDocument->Audit_Comments2;
            $history->current = $internalAudit->Audit_Comments2;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->Audit_Comments2) || $lastDocument->Audit_Comments2 === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }


            $history->save();
        }



        if ($lastDocument->qa_cqa_comment != $internalAudit->qa_cqa_comment || !empty($request->qa_cqa_comment_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'QA/CQA Head Approval Comment';
            $history->previous = $lastDocument->qa_cqa_comment;
            $history->current = $internalAudit->qa_cqa_comment;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->qa_cqa_comment) || $lastDocument->qa_cqa_comment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }


            $history->save();
        }
        if ($lastDocument->inv_attachment != $internalAudit->inv_attachment || !empty($request->inv_attachment_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'GI Attachment';
            $history->previous =str_replace(',', ', ',  $lastDocument->inv_attachment);
            $history->current =str_replace(',', ', ',$internalAudit->inv_attachment) ;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->inv_attachment) || $lastDocument->inv_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }


            $history->save();
        }
        if ($lastDocument->file_attachment != $internalAudit->file_attachment || !empty($request->file_attachment_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'File Attachment';
            $history->previous = $lastDocument->file_attachment;
            $history->current = $internalAudit->file_attachment;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->file_attachment) || $lastDocument->file_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }


            $history->save();
        }
        // if ($lastDocument->Audit_file != $internalAudit->Audit_file || !empty($request->Audit_file_comment)) {

        //     $history = new AuditTrialExternal();
        //     $history->ExternalAudit_id = $id;
        //     $history->activity_type = 'Audit Attachments';
        //     $history->previous = $lastDocument->Audit_file;
        //     $history->current = $internalAudit->Audit_file;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->Audit_file) || $lastDocument->Audit_file === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }


        //     $history->save();
        // }
        if ($lastDocument->report_file != $internalAudit->report_file || !empty($request->report_file_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Report Attachments';
            $history->previous = $lastDocument->report_file;
            $history->current = $internalAudit->report_file;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->report_file) || $lastDocument->report_file === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }


            $history->save();
        }
        if ($lastDocument->qa_cqa_attach != $internalAudit->qa_cqa_attach || !empty($request->qa_cqa_attach_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'QA/CQA Head Approval Attachments';
            $history->previous =  str_replace(',', ', ', $lastDocument->qa_cqa_attach); $lastDocument->qa_cqa_attach;
            $history->current =  str_replace(',', ', ', $internalAudit->qa_cqa_attach);
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->qa_cqa_attach) || $lastDocument->qa_cqa_attach === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }


            $history->save();
        }



        if ($lastDocument->myfile != $internalAudit->myfile || !empty($request->myfile_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Summary And Response Attachment';
            $history->previous =  str_replace(',', ', ', $lastDocument->myfile);
            $history->current = str_replace(',', ', ', $internalAudit->myfile);
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->myfile) || $lastDocument->myfile === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }


            $history->save();
        }
        if ($lastDocument->due_date != $internalAudit->due_date || !empty($request->due_date_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Due Date';
            $history->previous = Helpers::getdateFormat($lastDocument->due_date);
            $history->current = Helpers::getdateFormat($internalAudit->due_date);
            $history->comment = $request->date_comment;
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







        if ($lastDocument->start_date_gi != $internalAudit->start_date_gi || !empty($request->start_date_gi_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Start Date of Audit';
            $history->previous = Helpers::getdateFormat($lastDocument->start_date_gi);
            $history->current = Helpers::getdateFormat($internalAudit->start_date_gi);
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->start_date_gi) || $lastDocument->start_date_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }



            $history->save();
        }
        if ($lastDocument->end_date_gi != $internalAudit->end_date_gi || !empty($request->end_date_gi_comment)) {

            $history = new AuditTrialExternal();
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'End Date of Audit';
            $history->previous = $lastDocument->end_date_gi;
            $history->current = $internalAudit->end_date_gi;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->end_date_gi) || $lastDocument->end_date_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }



            $history->save();
        }










//         $SummaryUpdate = $internalAudit->id;
// if (!empty($request->SummaryResponse)) {
// $summaryShow = SummaryGrid::where(['summary_id' => $SummaryUpdate, 'identifier' => 'Summary Response'])->firstOrNew();
// $summaryShow->summary_id = $SummaryUpdate;
// $summaryShow->identifier = 'Summary Response';
// $summaryShow->data = $request->SummaryResponse;
// $summaryShow->save();
// }








$SummaryUpdate = $internalAudit->id;

// Fetch existing summary response data
$existingSummaryData = SummaryGrid::where(['summary_id' => $SummaryUpdate, 'identifier' => 'Summary Response'])->first();
$existingSummaryDataArray = $existingSummaryData ? $existingSummaryData->data : [];

// Save the new summary response data

if (!empty($request->SummaryResponse)) {
    $summaryShow = SummaryGrid::firstOrNew(['summary_id' => $SummaryUpdate, 'identifier' => 'Summary Response']);
    $summaryShow->summary_id = $SummaryUpdate;
    $summaryShow->identifier = 'Summary Response';
    $summaryShow->data = $request->SummaryResponse;
    $summaryShow->save();



      // Define the mapping of field keys to more descriptive names
      $fieldNames = [
        'observation' => 'Observation',
        'response' => 'Response',
        'reference_id' => 'CAPA / Child action Reference If Any',
        'status' => 'Status',
        'remarks' => 'Remarks'
    ];

    // Track audit trail changes
    if (is_array($request->SummaryResponse)) {
        foreach ($request->SummaryResponse as $index => $newSummary) {
            $previousSummary = $existingSummaryDataArray[$index] ?? [];

            // Track changes for each field
            $fieldsToTrack = ['observation', 'response', 'reference_id', 'status', 'remarks'];
            foreach ($fieldsToTrack as $field) {
                $oldValue = $previousSummary[$field] ?? 'Null';
                $newValue = $newSummary[$field] ?? 'Null';

                // If there's a change, add an entry to the audit trail
                if ($oldValue !== $newValue) {
                    $auditTrail = new AuditTrialExternal();
                    $auditTrail->ExternalAudit_id = $SummaryUpdate;
                    $auditTrail->activity_type = $fieldNames[$field] . ' (' . ($index + 1) . ')';
             
                    $auditTrail->previous = $oldValue;
                    $auditTrail->current = $newValue;
                    $auditTrail->comment = "";
                    $auditTrail->user_id = Auth::user()->id;
                    $auditTrail->user_name = Auth::user()->name;
                    $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $auditTrail->origin_state = $internalAudit->status;
                    $auditTrail->change_to = "Not Applicable";
                    $auditTrail->change_from = $internalAudit->status;
                    $auditTrail->action_name = $oldValue == 'Null' ? "New" : "Update";
                    $auditTrail->save();
                }
            }
        }

        // Check for removed rows
        // foreach ($existingSummaryDataArray as $index => $oldSummary) {
        //     if (!isset($request->SummaryResponse[$index])) {
        //         $auditTrail = new AuditTrialExternal();
        //         $auditTrail->ExternalAudit_id = $SummaryUpdate;
        //         $auditTrail->activity_type = "Summary Response Removal";
        //         $auditTrail->previous = json_encode($oldSummary); // Convert the full data of the removed row
        //         $auditTrail->current = "Removed";
        //         $auditTrail->comment = "";
        //         $auditTrail->user_id = Auth::user()->id;
        //         $auditTrail->user_name = Auth::user()->name;
        //         $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //         $auditTrail->origin_state = $internalAudit->status;
        //         $auditTrail->change_to = "Not Applicable";
        //         $auditTrail->change_from = $internalAudit->status;
        //         $auditTrail->action_name = "Remove";
        //         $auditTrail->save();
        //     }
        // }
    }
}
















// $AuditUpdate = $internalAudit->id;
// if (!empty($request->AuditorNew)) {
// $AuditorShow = SummaryGrid::where(['summary_id' => $AuditUpdate, 'identifier' => 'Auditors'])->firstOrNew();
// $AuditorShow->summary_id = $AuditUpdate;
// $AuditorShow->identifier = 'Auditors';
// $AuditorShow->data = $request->AuditorNew;
// $AuditorShow->save();
// }


$AuditUpdate = $internalAudit->id;

if (!empty($request->AuditorNew)) {
    // Fetch existing auditor data
    $existingAuditorShow = SummaryGrid::where(['summary_id' => $AuditUpdate, 'identifier' => 'Auditors'])->first();
    $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

    // Save the new auditor data
    $AuditorShow = SummaryGrid::firstOrNew(['summary_id' => $AuditUpdate, 'identifier' => 'Auditors']);
    $AuditorShow->summary_id = $AuditUpdate;
    $AuditorShow->identifier = 'Auditors';
    $AuditorShow->data = $request->AuditorNew;
    $AuditorShow->save();


     // Define the mapping of field keys to more descriptive names
     $fieldNames = [
        'auditornew' => 'Auditor Name',
        'regulatoryagency' => 'External Agency Name',
        'designation' => 'Designation',
        'remarks' => 'Remarks',
  
    ];

    // Track audit trail changes
    if (is_array($request->AuditorNew)) {
        foreach ($request->AuditorNew as $index => $newAuditor) {
            $previousAuditor = $existingAuditorData[$index] ?? [];

            // Track changes for each field
            $fieldsToTrack = ['auditornew', 'regulatoryagency', 'designation', 'remarks'];
            foreach ($fieldsToTrack as $field) {
                $oldValue = $previousAuditor[$field] ?? 'Null';
                $newValue = $newAuditor[$field] ?? 'Null';

                // If there's a change, add an entry to the audit trail
                if ($oldValue !== $newValue) {
                    $auditTrail = new AuditTrialExternal();
                    $auditTrail->ExternalAudit_id = $AuditUpdate;
                    $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                    $auditTrail->previous = $oldValue;
                    $auditTrail->current = $newValue;
                    $auditTrail->comment = "";
                    $auditTrail->user_id = Auth::user()->id;
                    $auditTrail->user_name = Auth::user()->name;
                    $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $auditTrail->origin_state = $internalAudit->status;
                    $auditTrail->change_to = "Not Applicable";
                    $auditTrail->change_from = $internalAudit->status;
                    $auditTrail->action_name = $oldValue == 'Null' ? "New" : "Update";
                    $auditTrail->save();
                }
            }
        }

        // Check for removed auditors
        // foreach ($existingAuditorData as $index => $oldAuditor) {
        //     if (!isset($request->AuditorNew[$index])) {
        //         $auditTrail = new AuditTrialExternal();
        //         $auditTrail->ExternalAudit_id = $AuditUpdate;
        //         $auditTrail->activity_type = "Auditor Grid Change". ($index + 1);
        //         $auditTrail->previous = json_encode($oldAuditor); // Convert the full data of the removed row
        //         $auditTrail->current = "Removed";
        //         $auditTrail->comment = "Removed Auditor at row " . ($index + 1);
        //         $auditTrail->user_id = Auth::user()->id;
        //         $auditTrail->user_name = Auth::user()->name;
        //         $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //         $auditTrail->origin_state = $internalAudit->status;
        //         $auditTrail->change_to = "Not Applicable";
        //         $auditTrail->change_from = $internalAudit->status;
        //         $auditTrail->action_name = "Remove";
        //         $auditTrail->save();
        //     }
        // }
    }
}







$Cft = ExternalAuditCFT::where('external_audit_id', $id)->first();



   /************ CFT Review ************/
          /*************** Quality Assurance ***************/
          if ($lastCft->Quality_Assurance_Review != $Cft->Quality_Assurance_Review && $Cft->Quality_Assurance_Review != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Quality Assurance Review Comment Required';
            $history->previous = ucfirst($lastCft->Quality_Assurance_Review);
            $history->current = ucfirst($Cft->Quality_Assurance_Review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Quality_Assurance_Review) || $lastCft->Quality_Assurance_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_person != $request->QualityAssurance_person && $request->QualityAssurance_person != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Quality Assurance Person';
            $history->previous = $lastCft->QualityAssurance_person;
            $history->current = $request->QualityAssurance_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->QualityAssurance_person) || $lastCft->QualityAssurance_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_assessment != $request->QualityAssurance_assessment && $request->QualityAssurance_assessment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Quality Assurance)';
            $history->previous = $lastCft->QualityAssurance_assessment;
            $history->current = $request->QualityAssurance_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->QualityAssurance_assessment) || $lastCft->QualityAssurance_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_feedback != $request->QualityAssurance_feedback && $request->QualityAssurance_feedback != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Quality Assurance Feedback';
            $history->previous = $lastCft->QualityAssurance_feedback;
            $history->current = $request->QualityAssurance_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->QualityAssurance_feedback) || $lastCft->QualityAssurance_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
         if ($lastCft->Quality_Assurance_attachment != $request->Quality_Assurance_attachment && $request->Quality_Assurance_attachment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Quality Assurance Attachments';
            $history->previous = $lastCft->Quality_Assurance_attachment;
            $history->current =implode(',', $request->Quality_Assurance_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Quality_Assurance_attachment) || $lastCft->Quality_Assurance_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_by != $request->QualityAssurance_by && $request->QualityAssurance_by != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Quality Assurance Review By';
            $history->previous = $lastCft->QualityAssurance_by;
            $history->current = $request->QualityAssurance_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->QualityAssurance_by) || $lastCft->QualityAssurance_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_on != $request->QualityAssurance_on && $request->QualityAssurance_on != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Quality Assurance Review On';
            $history->previous = $lastCft->QualityAssurance_on;
            $history->current = $request->QualityAssurance_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->QualityAssurance_person) || $lastCft->QualityAssurance_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        /*************** Production Tablet ***************/
        if ($lastCft->Production_Table_Review != $request->Production_Table_Review && $request->Production_Table_Review != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Production Tablet/Capsule / Powder Review Comment Required';
            $history->previous = ucfirst($lastCft->Production_Table_Review);
            $history->current = ucfirst($request->Production_Table_Review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Production Tablet/Capsule / Powder Person';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review comment (By Production Tablet/Capsule / Powder)';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Feeback';
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
        if ($lastCft->Production_Table_Attachment != $request->Production_Table_Attachment && $request->Production_Table_Attachment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Production Tablet/Capsule / Powder Attachments';
            $history->previous = $lastCft->Production_Table_Attachment;
            $history->current = implode(',',$request->Production_Table_Attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Production_Table_Attachment) || $lastCft->Production_Table_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_By != $request->Production_Table_By && $request->Production_Table_By != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Production Tablet/Capsule / Powder Review Completed By';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Production Tablet/Capsule / Powder Review Completed On';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Production Liquid/ointment Review Comment Required';
            $history->previous = ucfirst($lastCft->ProductionLiquid_Review);
            $history->current = ucfirst($request->ProductionLiquid_Review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Person';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Production Liquid)';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Feedback';
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
        if ($lastCft->ProductionLiquid_attachment != $request->ProductionLiquid_attachment && $request->ProductionLiquid_attachment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Production Liquid/ointment Attachments';
            $history->previous = $lastCft->ProductionLiquid_attachment;
            $history->current = implode(',',$request->ProductionLiquid_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ProductionLiquid_attachment) || $lastCft->ProductionLiquid_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_by != $request->ProductionLiquid_by && $request->ProductionLiquid_by != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Review By';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Review On';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Production Injection Review Comment Required';
            $history->previous = ucfirst($lastCft->Production_Injection_Review);
            $history->current = ucfirst($request->Production_Injection_Review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Production Injection)';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
        if ($lastCft->Production_Injection_Attachment != $request->Production_Injection_Attachment && $request->Production_Injection_Attachment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Production Injection Attachments';
            $history->previous = $lastCft->Production_Injection_Attachment;
            $history->current =implode(',', $request->Production_Injection_Attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Production_Injection_Attachment) || $lastCft->Production_Injection_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_By != $request->Production_Injection_By && $request->Production_Injection_By != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Store Review Comment Required';
            $history->previous = ucfirst($lastCft->Store_Review);
            $history->current = ucfirst($request->Store_Review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Store)';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Store Attachments';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Quality Control Review Comment Required';
            $history->previous =ucfirst( $lastCft->Quality_review);
            $history->current = ucfirst($request->Quality_review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Quality Control)';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
        // if ($lastCft->Quality_Control_by != $request->Quality_Control_by && $request->Quality_Control_by != null) {
        //     $history = new AuditTrialExternal;
        //     $history->ExternalAudit_id = $id;
        //     $history->activity_type = 'Quality Control By';
        //     $history->previous = $lastCft->Quality_Control_by;
        //     $history->current = $request->Quality_Control_by;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->Quality_Control_by) || $lastCft->Quality_Control_by === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        // if ($lastCft->Quality_Control_on != $request->Quality_Control_on && $request->Quality_Control_on != null) {
        //     $history = new AuditTrialExternal;
        //     $history->ExternalAudit_id = $id;
        //     $history->activity_type = 'Quality Control On';
        //     $history->previous = $lastCft->Quality_Control_on;
        //     $history->current = $request->Quality_Control_on;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->Quality_Control_on) || $lastCft->Quality_Control_on === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Quality_Control_attachment != $request->Quality_Control_attachment && $request->Quality_Control_attachment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Quality Control Attachments';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Research & Development Review  Comment  Required';
            $history->previous = ucfirst($lastCft->ResearchDevelopment_Review);
            $history->current = ucfirst($request->ResearchDevelopment_Review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Research & Development)';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Research & Development Review Completed By';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Research & Development Review Completed On';
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
        if ($lastCft->ResearchDevelopment_attachment != $request->ResearchDevelopment_attachment && $request->ResearchDevelopment_attachment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Research & Development Attachment';
            $history->previous = $lastCft->ResearchDevelopment_attachment;
            $history->current =implode(',', $request->ResearchDevelopment_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->ResearchDevelopment_attachment) || $lastCft->ResearchDevelopment_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Engineering ***************/
        if ($lastCft->Engineering_review != $request->Engineering_review && $request->Engineering_review != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Engineering Review Comment Required';
            $history->previous = ucfirst($lastCft->Engineering_review);
            $history->current = ucfirst($request->Engineering_review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Engineering)';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
        if ($lastCft->Engineering_attachment != $request->Engineering_attachment && $request->Engineering_attachment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Engineering Attachments';
            $history->previous = $lastCft->Engineering_attachment;
            $history->current = implode(',',$request->Engineering_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Engineering_attachment) || $lastCft->Engineering_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Human Resource ***************/
        if ($lastCft->Human_Resource_review != $request->Human_Resource_review && $request->Human_Resource_review != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Human Resource Review Comment Required';
            $history->previous = ucfirst($lastCft->Human_Resource_review);
            $history->current = ucfirst($request->Human_Resource_review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Human Resource)';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
        if ($lastCft->Human_Resource_attachment != $request->Human_Resource_attachment && $request->Human_Resource_attachment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Human Resource Attachments';
            $history->previous = $lastCft->Human_Resource_attachment;
            $history->current =implode(',', $request->Human_Resource_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Human_Resource_attachment) || $lastCft->Human_Resource_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Microbiology ***************/
        if ($lastCft->Microbiology_Review != $request->Microbiology_Review && $request->Microbiology_Review != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Microbiology Review Comment Required';
            $history->previous = ucfirst($lastCft->Microbiology_Review);
            $history->current = ucfirst($request->Microbiology_Review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Microbiology)';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
         if ($lastCft->Microbiology_attachment != $request->Microbiology_attachment && $request->Microbiology_attachment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Microbiology Attachments';
            $history->previous = $lastCft->Microbiology_attachment;
            $history->current = implode(',',$request->Microbiology_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Microbiology_attachment) || $lastCft->Microbiology_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Regulatory Affair ***************/
        if ($lastCft->RegulatoryAffair_Review != $request->RegulatoryAffair_Review && $request->RegulatoryAffair_Review != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Regulatory Affair Review Comment Required';
            $history->previous = ucfirst($lastCft->RegulatoryAffair_Review);
            $history->current = ucfirst($request->RegulatoryAffair_Review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Regulatory Affair)';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
        if ($lastCft->RegulatoryAffair_attachment != $request->RegulatoryAffair_attachment  && $request->RegulatoryAffair_attachment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Regulatory Affair Attachments';
            $history->previous = $lastCft->RegulatoryAffair_attachment;
            $history->current =implode(',', $request->RegulatoryAffair_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->RegulatoryAffair_attachment) || $lastCft->RegulatoryAffair_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Corporate Quality Assurance ***************/
        if ($lastCft->CorporateQualityAssurance_Review != $request->CorporateQualityAssurance_Review && $request->CorporateQualityAssurance_Review != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Review Comment Required';
            $history->previous = ucfirst($lastCft->CorporateQualityAssurance_Review);
            $history->current = ucfirst($request->CorporateQualityAssurance_Review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Corporate Quality Assurance)';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
             if (is_null($lastCft->CorporateQualityAssurance_by) || $lastCft->CorporateQualityAssurance_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_on != $request->CorporateQualityAssurance_on && $request->CorporateQualityAssurance_on != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Quality Control Attachments';
            $history->previous = $lastCft->CorporateQualityAssurance_on;
            $history->current = $request->CorporateQualityAssurance_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->CorporateQualityAssurance_on) || $lastCft->CorporateQualityAssurance_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_attachment != $request->CorporateQualityAssurance_attachment && $request->CorporateQualityAssurance_attachment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Attachments';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Safety Review Comment Required';
            $history->previous = ucfirst($lastCft->Environment_Health_review);
            $history->current = ucfirst($request->Environment_Health_review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Safety)';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
        if ($lastCft->Environment_Health_Safety_attachment != $request->Environment_Health_Safety_attachment && $request->Environment_Health_Safety_attachment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Safety Attachments';
            $history->previous = $lastCft->Environment_Health_Safety_attachment;
            $history->current =implode(',', $request->Environment_Health_Safety_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Environment_Health_Safety_attachment) || $lastCft->Environment_Health_Safety_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Contract Giver ***************/
        if ($lastCft->ContractGiver_Review != $request->ContractGiver_Review && $request->ContractGiver_Review != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Contract Giver Review Required';
            $history->previous = ucfirst($lastCft->ContractGiver_Review);
            $history->current = ucfirst($request->ContractGiver_Review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = "Other's 1 Review Comment Required ";
            $history->previous = ucfirst($lastCft->Other1_review);
            $history->current = ucfirst($request->Other1_review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Other s 1 Department';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Others 1)';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Other s 1 Attachments';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Other s 2 Review Comment Required';
            $history->previous = ucfirst($lastCft->Other2_review);
            $history->current = ucfirst($request->Other2_review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
       // dd($lastCft->Other2_Department_person,$request->Other2_Department_person);
        if ($lastCft->Other2_Department_person != $request->Other2_Department_person && $request->Other2_Department_person != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Other s 2 Department';
            $history->previous =$lastCft->Other2_Department_person;
          
            $history->current = $request->Other2_Department_person;
            // dd($history);
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
        if ($lastCft->Other2_Assessment != $request->Other2_Assessment && $request->Other2_Assessment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment(By Others 2)';
            $history->previous = $lastCft->Other2_Assessment;
            $history->current = $request->Other2_Assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other2_Assessment) || $lastCft->Other2_Assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_feedback != $request->Other2_feedback && $request->Other2_feedback != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Other s 2 Attachments';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Other s 3 Review Comment Required';
            $history->previous = ucfirst($lastCft->Other3_review);
            $history->current = ucfirst($request->Other3_review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Other s 3 Department';
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
        if ($lastCft->Other3_Assessment != $request->Other3_Assessment && $request->Other3_Assessment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Others 3)';
            $history->previous = $lastCft->Other3_Assessment;
            $history->current = $request->Other3_Assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other3_Assessment) || $lastCft->Other3_Assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_feedback != $request->Other3_feedback && $request->Other3_feedback != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Other s 3 Attachments';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Other s 4 Review Comment Required';
            $history->previous = ucfirst($lastCft->Other4_review);
            $history->current = ucfirst($request->Other4_review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Other s 4 Department';
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
        if ($lastCft->Other4_Assessment != $request->Other4_Assessment && $request->Other4_Assessment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Others 4)';
            $history->previous = $lastCft->Other4_Assessment;
            $history->current = $request->Other4_Assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other4_Assessment) || $lastCft->Other4_Assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_feedback != $request->Other4_feedback && $request->Other4_feedback != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Other s 4 Attachments';
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Other s 5 Review Comment Required';
            $history->previous = ucfirst($lastCft->Other5_review);
            $history->current = ucfirst($request->Other5_review);
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Other s 5 Department';
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
        if ($lastCft->Other5_Assessment != $request->Other5_Assessment && $request->Other5_Assessment != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Review Comment (By Others 5)';
            $history->previous = $lastCft->Other5_Assessment;
            $history->current = $request->Other5_Assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->Other5_Assessment) || $lastCft->Other5_Assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_feedback != $request->Other5_feedback && $request->Other5_feedback != null) {
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
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
            $history = new AuditTrialExternal;
            $history->ExternalAudit_id = $id;
            $history->activity_type = 'Other s 5 Attachments';
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









        toastr()->success("Record is Update Successfully");
        return back();
    }


    public function ExternalAuditStateChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = Auditee::find($id);
            $Cft = ExternalAuditCFT::where('external_audit_id', $id)->first();
            $emailverification = User:: find($changeControl->initiator_id);
            $lastDocument = Auditee::find($id);
            $internalAudit = Auditee::find($id);
            $updateCFT = ExternalAuditCFT::where('external_audit_id', $id)->latest()->first();
            $cftDetails = ExternalAuditCFTResponse::where(['status' => 'In-progress', 'external_audit_id' => $id])->distinct('cft_user_id')->count();



            if ($changeControl->stage == 1) {
                   //Action Item child validation

                     $actionchilds = ActionItem::where('parent_id', $id)
                                ->where('parent_type', 'External Audit')
                                ->get();
                                    $hasPendingaction = false;
                                foreach ($actionchilds as $ext) {
                                        $actionchildstatus = trim(strtolower($ext->status));
                                       if ($actionchildstatus !== 'closed - done'  && $actionchildstatus !== 'closed-cancelled') {
                                            $hasPendingaction = true;
                                            break;
                                        }
                                    }
                            if ($hasPendingaction) {
                                // $actionchildstatus = trim(strtolower($extensionchild->status));
                                if ($hasPendingaction) {
                                    Session::flash('swal', [
                                        'title' => 'Action Item Child Pending!',
                                        'message' => 'You cannot proceed until Action Item Child is Closed-Done.',
                                        'type' => 'warning',
                                    ]);

                                return redirect()->back();
                                }
                            } else {
                                // Flash message for success (when the form is filled correctly)
                                Session::flash('swal', [
                                    'title' => 'Success!',
                                    'message' => 'Document Sent',
                                    'type' => 'success',
                                ]);
                            }


                    //Observation child validation

                     $observationchilds = Observation::where('parent_id', $id)
                                ->where('parent_type', 'External Audit')
                                ->get();
                                    $hasPendingaction = false;
                                foreach ($observationchilds as $ext) {
                                        $observationchildstatus = trim(strtolower($ext->status));
                                       if ($observationchildstatus !== 'closed - done'  && $observationchildstatus !== 'closed-cancelled') {
                                            $hasPendingaction = true;
                                            break;
                                        }
                                    }
                            if ($hasPendingaction) {
                                // $observationchildstatus = trim(strtolower($extensionchild->status));
                                if ($hasPendingaction) {
                                    Session::flash('swal', [
                                        'title' => 'Observation Child Pending!',
                                        'message' => 'You cannot proceed until Observation Child is Closed-Done.',
                                        'type' => 'warning',
                                    ]);

                                return redirect()->back();
                                }
                            } else {
                                // Flash message for success (when the form is filled correctly)
                                Session::flash('swal', [
                                    'title' => 'Success!',
                                    'message' => 'Document Sent',
                                    'type' => 'success',
                                ]);
                            }
                   
                if (empty($changeControl->due_date)|| empty($changeControl->audit_type)|| empty($changeControl->initial_comments)||empty($changeControl->external_agencies)||empty($changeControl->start_date_gi) ||empty($changeControl->end_date_gi))
                    {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'Pls Fill General Information Tab is yet to be filled'
                        ]);
    
                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for Summary and Response state'
                        ]);
                    }
                $changeControl->stage = "2";
                $changeControl->status = "Summary and Response";
                $changeControl->audit_details_summary_by = Auth::user()->name;
                $changeControl->audit_details_summary_on = Carbon::now()->format('d-M-Y');
                $changeControl->audit_details_summary_on_comment = $request->comment;


                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Audit Details Summary By,Audit Details Summary On';
                        $history->previous = "";
                        $history->current = $changeControl->audit_schedule_by;
                        $history->comment = $request->comment;
                        $history->action = 'Audit Details Summary By';
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "Summary and Response";
                        $history->change_from = $lastDocument->status;
                        $history->action_name = 'Update';
                        $history->stage = 'Summary and Response';
                        if (is_null($lastDocument->audit_details_summary_by) || $lastDocument->audit_details_summary_by === '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->audit_details_summary_by . ' , ' . $lastDocument->audit_details_summary_on;
                        }
                        $history->current = $changeControl->audit_details_summary_by . ' , ' . $changeControl->audit_details_summary_on;
                        if (is_null($lastDocument->audit_details_summary_by) || $lastDocument->audit_details_summary_by === '') {
                            $history->action_name = 'New';
                        } else {
                            $history->action_name = 'Update';
                        }
                        $history->save();

                        $list = Helpers::getQAUserList($changeControl->division_id);

                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changeControl, 
                                            'site' => "view", 
                                            'history' => "Audit Details Summary", 
                                            'process' => 'External Audit', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                                ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Audit Details Summary Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                 
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                   
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        }
                        
                $list = Helpers::getCQAUsersList($changeControl->division_id);

                foreach ($list as $u) {
                    $email = Helpers::getUserEmail($u->user_id);

                    if ($email !== null) {
                        try {
                            Mail::send(
                                'mail.view-mail',
                                [
                                    'data' => $changeControl, 
                                    'site' => "view", 
                                    'history' => "Audit Details Summary", 
                                    'process' => 'External Audit', 
                                    'comment' => $request->comment, 
                                    'user' => Auth::user()->name
                                ],
                                function ($message) use ($email, $changeControl) {
                                    $message->to($email)
                                        ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Audit Details Summary Performed");
                                }
                            );
                        } catch (\Exception $e) {
                            // Log the error for debugging
                            Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());

                            // Optionally handle the exception (e.g., notify the user or admin)
                            session()->flash('error', 'Failed to send email to ' . $email);
                        }
                    }
                }
                 $list = Helpers::getQAUserList($changeControl->division_id);

                foreach ($list as $u) {
                    $email = Helpers::getUserEmail($u->user_id);

                    if ($email !== null) {
                        try {
                            Mail::send(
                                'mail.view-mail',
                                [
                                    'data' => $changeControl, 
                                    'site' => "view", 
                                    'history' => "Audit Details Summary", 
                                    'process' => 'External Audit', 
                                    'comment' => $request->comment, 
                                    'user' => Auth::user()->name
                                ],
                                function ($message) use ($email, $changeControl) {
                                    $message->to($email)
                                        ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Audit Details Summary Performed");
                                }
                            );
                        } catch (\Exception $e) {
                            // Log the error for debugging
                            Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());

                            // Optionally handle the exception (e.g., notify the user or admin)
                            session()->flash('error', 'Failed to send email to ' . $email);
                        }
                    }
                }

                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 2) {
            //    if ($changeControl->form_progress !== 'cft')
            //     {
            //         Session::flash('swal', [
            //             'type' => 'warning',
            //             'title' => 'Mandatory Fields!',
            //             'message' => 'Summary and Response/CFT Tab is yet to be filled'
            //         ]);

            //         return redirect()->back();
            //     } else {
            //         Session::flash('swal', [
            //             'type' => 'success',
            //             'title' => 'Success',
            //             'message' => 'Sent for CFT review state'
            //         ]);
            //     }






















            
                         if (!$Cft->Production_Table_Review|| !$Cft->Production_Injection_Review || !$Cft->ProductionLiquid_Review || !$Cft->Store_Review || !$Cft->ResearchDevelopment_Review || !$Cft->Microbiology_Review || !$Cft->RegulatoryAffair_Review || !$Cft->CorporateQualityAssurance_Review  || !$Cft->Quality_review || !$Cft->Quality_Assurance_Review || !$Cft->Engineering_review || !$Cft->Environment_Health_review || !$Cft->Human_Resource_review) {
                            Session::flash('swal', [
                                'title' => 'Mandatory Fields Required!',
                                'message' => 'CFT Tab is yet to be filled!',
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

                $changeControl->stage = "3";
                $changeControl->status = "CFT Review";


                 $stage = new ExternalAuditCFTResponse();
                    $stage->external_audit_id = $id;
                    $stage->cft_user_id = Auth::user()->id;
                    $stage->status = "CFT Required";


                    
                    // $stage->cft_stage = ;
                    $stage->comment = $request->comment;
                    $stage->is_required = 1;
                    $stage->save();
                $changeControl->summary_and_response_com_by = Auth::user()->name;
                $changeControl->summary_and_response_com_on = Carbon::now()->format('d-M-Y');
                $changeControl->summary_and_response_com_on_comment = $request->comment;


                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Summary and Response Complete By,Summary and Response Complete On';
                        $history->previous = "";
                        $history->current = $changeControl->audit_preparation_completed_by;
                        $history->comment = $request->comment;
                        $history->action = 'Summary and Response Complete';
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "CFT Review";
                        $history->change_from = $lastDocument->status;
                        $history->action_name = 'Update';
                        $history->stage = 'CFT Review';
                        if (is_null($lastDocument->summary_and_response_com_by) || $lastDocument->summary_and_response_com_by === '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->summary_and_response_com_by . ' , ' . $lastDocument->summary_and_response_com_on;
                        }
                        $history->current = $changeControl->summary_and_response_com_by . ' , ' . $changeControl->summary_and_response_com_on;
                        if (is_null($lastDocument->summary_and_response_com_by) || $lastDocument->summary_and_response_com_by === '') {
                            $history->action_name = 'New';
                        } else {
                            $history->action_name = 'Update';
                        }
                        $history->save();
                        $list = Helpers::getCftUserList($changeControl->division_id);

                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changeControl, 
                                            'site' => "External Audit", 
                                            'history' => "Summary and Response Complete", 
                                            'process' => 'External Audit', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                                ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Summary and Response Complete Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                    // Log the error for debugging
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                    // Optionally handle the exception (e.g., notify the user or admin)
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        }
                        


                        $list = Helpers::getCQAUsersList($changeControl->division_id);

                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changeControl, 
                                            'site' => "view", 
                                            'history' => "Summary and Response Complete", 
                                            'process' => 'External Audit', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                                ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Summary and Response Complete Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                    // Log the error for debugging
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                    // Optionally handle the exception (e.g., notify the user or admin)
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        }
                        
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changeControl->stage == 3) {

                // // CFT review state update form_progress
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
                //         'message' => 'Sent for QA/CQA Head Approval state'
                //     ]);
                // }

















                
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////
                     $userId = Auth::user()->name;
                    $userAssignments = DB::table('external_audit_c_f_t_s')->where(['external_audit_id' => $id])->first();
                    $incompleteFields = [];

                    if ($userAssignments->Production_Table_Person == $userId && empty($userAssignments->Production_Table_Assessment)) {
                        $incompleteFields[] = 'Review comment (By Production Tablet/Capsule / Powder)';
                    }
                    
                    if ($userAssignments->Production_Injection_Person == $userId && empty($userAssignments->Production_Injection_Assessment)) {
                        $incompleteFields[] = 'Review Comment (By Production Injection)';
                    }
                    
                    if ($userAssignments->ResearchDevelopment_person == $userId && empty($userAssignments->ResearchDevelopment_assessment)) {
                        $incompleteFields[] = 'Review Comment (By Research & Development)';
                    }
                    
                    if ($userAssignments->Store_person == $userId && empty($userAssignments->Store_assessment)) {
                        $incompleteFields[] = 'Review Comment (By Store)';
                    }
                    
                    if ($userAssignments->Quality_Control_Person == $userId && empty($userAssignments->Quality_Control_assessment)) {
                        $incompleteFields[] = 'Review Comment (By Corporate Quality Assurance) ';
                    }
                    
                    if ($userAssignments->QualityAssurance_person == $userId && empty($userAssignments->QualityAssurance_assessment)) {
                        $incompleteFields[] = 'Review Comment (By Quality Assurance) ';
                    }
                    
                    if ($userAssignments->CorporateQualityAssurance_person == $userId && empty($userAssignments->CorporateQualityAssurance_assessment)) {
                        $incompleteFields[] = 'Corporate Quality Assurance Assessment';
                    }

                    if ($userAssignments->RegulatoryAffair_person == $userId && empty($userAssignments->RegulatoryAffair_assessment)) {
                        $incompleteFields[] = 'Review Comment (By Regulatory Affair)';
                    }
                    
                    if ($userAssignments->ProductionLiquid_person == $userId && empty($userAssignments->ProductionLiquid_assessment)) {
                        $incompleteFields[] = 'Review Comment (By Production Liquid/ointment)';
                    }
                    
                    if ($userAssignments->Microbiology_person == $userId && empty($userAssignments->Microbiology_assessment)) {
                        $incompleteFields[] = 'Review Comment (By Microbiology)';
                    }
                    
                    if ($userAssignments->Engineering_person == $userId && empty($userAssignments->Engineering_assessment)) {
                        $incompleteFields[] ='Review Comment (By Engineering) ';
                    }
                    
                    if ($userAssignments->Environment_Health_Safety_person == $userId && empty($userAssignments->Health_Safety_assessment)) {
                        $incompleteFields[] = 'Review Comment (By Safety) ';
                    }
                    
                    if ($userAssignments->Human_Resource_person == $userId && empty($userAssignments->Human_Resource_assessment)) {
                        $incompleteFields[] = 'Review Comment (By Human Resource) ';
                    }
                    
                    // if ($userAssignments->ContractGiver_person == $userId && empty($userAssignments->ContractGiver_assessment)) {
                    //     $incompleteFields[] = 'ContractGiver Assessment';
                    // }
                    
                    
                    if (!empty($incompleteFields)) {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'You must fill your assigned fields for: ' . implode(', ', $incompleteFields) . '.'
                        ]);
                        return redirect()->back();
                    } else {
                        









                $IsCFTRequired = ExternalAuditCFTResponse::where(['is_required' => 1, 'external_audit_id' => $id])->latest()->first();
                $cftUsers = DB::table('external_audit_c_f_t_s')->where(['external_audit_id' => $id])->first();
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

$history = new AuditTrialExternal();
$history->ExternalAudit_id = $id;
$history->activity_type = 'Quality Control Review Completed By, Quality Control Review Completed On';

if (is_null($lastDocument->Quality_Control_by) || $lastDocument->Quality_Control_on == '') {
    $history->previous = "";
} else {
    
    $history->previous = $lastDocument->Quality_Control_by . ' ,' .Helpers::getdateFormat ($lastDocument->Quality_Control_on);
}

$history->action = 'CFT Review Complete';

$history->current = $updateCFT->Quality_Control_by . ',' .Helpers::getdateFormat ($updateCFT->Quality_Control_on);
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

$history = new AuditTrialExternal();
$history->ExternalAudit_id = $id;
$history->activity_type = 'Quality Assurance Review Completed By, Quality Assurance Review Completed On';

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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Engineering Review Completed  By, Engineering Review Completed  On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Safety Completed Review By, Safety Completed Review On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Human Resource Review Completed By, Human Resource Review Completed  On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Others 1 Review Completed By, Others 1 Review Completed On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Others 2 Review Completed By, Others 2 Review Completed On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Others 3 Review Completed By, Others 3 Review Completed On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
$history->activity_type = 'Others 4 Review Completed By,Others 4 Review Completed';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Others 5 Review Completed By, Others 5 Review Completed On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                       $history->activity_type = 'Production Tablet/Capsule Powder Review Completed By
, Production Tablet/Capsule Powder Review Completed On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Production Liquid/ointment Review Completed  Completed By, Production Liquid/ointment Review Completed  Completed On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Production Injection Review Completed By, Production Injection Review Completed  On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                       $history->activity_type = 'Store Review Completed By, Store Review Completed On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Research Development Review Completed By
, Research Development Review Completed On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Microbiology Review Completed By, Microbiology Review Completed On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Regulatory Affair Review Completed By, Regulatory Affair Review Completed On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Corporate Quality Assurance Review Completed By, Corporate Quality Assurance Review Completed On';
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
                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
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
                        $stage = new ExternalAuditCFTResponse();
                        $stage->external_audit_id = $id;
                        $stage->cft_user_id = Auth::user()->id;
                        $stage->status = "Completed";
                        // $stage->cft_stage = ;
                        $stage->comment = $request->comment;
                        $stage->save();
                    } else {
                        $stage = new ExternalAuditCFTResponse();
                        $stage->external_audit_id = $id;
                        $stage->cft_user_id = Auth::user()->id;
                        $stage->status = "In-progress";
                        // $stage->cft_stage = ;
                        $stage->comment = $request->comment;
                        $stage->save();
                    }
                }

                $checkCFTCount = ExternalAuditCFTResponse::where(['status' => 'Completed', 'external_audit_id' => $id])->count();
                $Cft = ExternalAuditCFT::where('external_audit_id', $id)->first();

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


                    $changeControl->stage = "4";
                    $changeControl->status = "QA/CQA Head Approval";
                    $changeControl->CFT_Review_Complete_By = Auth::user()->name;
                    $changeControl->CFT_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $changeControl->CFT_Review_Comments = $request->comment;

                    $history = new AuditTrialExternal();
                    $history->ExternalAudit_id = $id;
                    $history->activity_type = 'CFT Review Completed By, CFT Review Completed On';
                if(is_null($lastDocument->CFT_Review_Complete_By) || $lastDocument->CFT_Review_Complete_On == ''){
                    $history->previous = "";
                }else{
                    $history->previous = $lastDocument->CFT_Review_Complete_By. ' ,' . $lastDocument->CFT_Review_Complete_On;
                }
                $history->action='CFT Review Complete';
                $history->current = $changeControl->CFT_Review_Complete_By. ',' . $changeControl->CFT_Review_Complete_On;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA/CQA Final Assessment";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Complete';
                    if(is_null($lastDocument->CFT_Review_Complete_By) || $lastDocument->CFT_Review_Complete_On == '')
                {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                    $history->save();
                   



                    $list = Helpers::getCQAUsersList($changeControl->division_id);
                    foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $changeControl->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site'=>"External Audit", 'history' => "CFT Review Complete", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: CFT Review Complete Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                            }
                        // }
                    }
    
                    $list = Helpers::getQAHeadUserList($changeControl->division_id);
                    foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $changeControl->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site'=>"External Audit", 'history' => "CFT Review Complete", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: CFT Review Complete Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                            }
                        // }
                    }
    
                    $changeControl->update();
                }
            }
                toastr()->success('Document Sent');
                return back();
            }

            // if ($changeControl->stage == 3) {
            //     $changeControl->stage = "4";
            //     $changeControl->status = "QA/CQA Head Approval";
            //     $changeControl->cft_review_complete_by = Auth::user()->name;
            //     $changeControl->cft_review_complete_on = Carbon::now()->format('d-M-Y');
            //     $changeControl->cft_review_complete_comment = $request->comment;


            //           $history = new AuditTrialExternal();
            //             $history->ExternalAudit_id = $id;
            //             $history->activity_type = 'CFT Review Complete By,CFT Review Complete On';
            //             $history->previous = "";
            //             $history->current = $changeControl->audit_mgr_more_info_reqd_by;
            //             $history->comment = $request->comment;
            //             $history->action = 'CFT Review Complete';
            //             $history->user_id = Auth::user()->id;
            //             $history->user_name = Auth::user()->name;
            //             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //             $history->origin_state = $lastDocument->status;

            //             $history->change_to =   "QA/CQA Head Approval";
            //             $history->change_from = $lastDocument->status;
            //             $history->action_name = 'Update';
            //             $history->stage = 'QA/CQA Head Approval';
            //             if (is_null($lastDocument->cft_review_complete_by) || $lastDocument->cft_review_complete_by === '') {
            //                 $history->previous = "";
            //             } else {
            //                 $history->previous = $lastDocument->cft_review_complete_by . ' , ' . $lastDocument->cft_review_complete_on;
            //             }
            //             $history->current = $changeControl->cft_review_complete_by . ' , ' . $changeControl->cft_review_complete_on;
            //             if (is_null($lastDocument->cft_review_complete_by) || $lastDocument->cft_review_complete_by === '') {
            //                 $history->action_name = 'New';
            //             } else {
            //                 $history->action_name = 'Update';
            //             }
            //             $history->save();
                    //     $list = Helpers::getLeadAuditeeUserList();
                    //     foreach ($list as $u) {
                    //         if($u->q_m_s_divisions_id == $changeControl->division_id){
                    //             $email = Helpers::getInitiatorEmail($u->user_id);
                    //              if ($email !== null) {

                    //               Mail::send(
                    //                   'mail.view-mail',
                    //                    ['data' => $changeControl],
                    //                 function ($message) use ($email) {
                    //                     $message->to($email)
                    //                         ->subject("Document sent ".Auth::user()->name);
                    //                 }
                    //               );
                    //             }
                    //      }
                    //   }
            //     $changeControl->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changeControl->stage == 4) {
            //     $changeControl->stage = "5";
            //     $changeControl->status = "CAPA Execution in Progress";
            //     $changeControl->audit_observation_submitted_by = Auth::user()->name;
            //     $changeControl->audit_observation_submitted_on = Carbon::now()->format('d-M-Y');
            //     $changeControl->audit_observation_submitted_on_comment = $request->comment;


            //     $history = new AuditTrialExternal();
            //             $history->ExternalAudit_id = $id;
            //             $history->activity_type = 'Activity Log';
            //             $history->previous = "";
            //             $history->current =$changeControl->audit_observation_submitted_by;
            //             $history->comment = $request->comment;
            //             $history->action = 'All CAPA Closed';
            //             $history->user_id = Auth::user()->id;
            //             $history->user_name = Auth::user()->name;
            //             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //             $history->origin_state = $lastDocument->status;
            //             $history->change_to =   "CAPA Execution in Progress";
            //             $history->change_from = $lastDocument->status;
            //             $history->action_name = 'Update';
            //             $history->stage = 'CAPA Execution in Progress';

            //             $history->save();
            //     $changeControl->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }

            if ($changeControl->stage == 4) {
                if (empty($changeControl->qa_cqa_comment))
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'QA/CQA Head Approval Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                 else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Sent for Closed - Done state'
                    ]);
                }
                $changeControl->stage = "5";
                $changeControl->status = "Closed - Done";
                $changeControl->approval_complete_by = Auth::user()->name;
                $changeControl->approval_complete_on = Carbon::now()->format('d-M-Y');
                // $changeControl->audit_response_completed_by = Auth::user()->name;
                // $changeControl->audit_response_completed_on = Carbon::now()->format('d-M-Y');
                // $changeControl->response_feedback_verified_by = Auth::user()->name;
                // $changeControl->response_feedback_verified_on = Carbon::now()->format('d-M-Y');

                $changeControl->approval_complete_on_comment = $request->comment;

                $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Approval Complete By,Approval Complete On';
                        $history->previous = "";
                        $history->current =$changeControl->audit_response_completed_by;
                        $history->comment = $request->comment;
                        $history->action = 'Approval Complete';
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "Closed - Done";
                        $history->change_from = $lastDocument->status;
                        $history->action_name = 'Update';
                        $history->stage = 'Closed - Done';
                        if (is_null($lastDocument->approval_complete_by) || $lastDocument->approval_complete_by === '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->approval_complete_by . ' , ' . $lastDocument->approval_complete_on;
                        }
                        $history->current = $changeControl->approval_complete_by . ' , ' . $changeControl->approval_complete_on;
                        if (is_null($lastDocument->approval_complete_by) || $lastDocument->approval_complete_by === '') {
                            $history->action_name = 'New';
                        } else {
                            $history->action_name = 'Update';
                        }
                        $history->save();



                

                    $list = Helpers::getCQAUsersList($changeControl->division_id);
                    foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $changeControl->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site'=>"External Audit", 'history' => "Approval Complete", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Approval Complete Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                            }
                        // }
                    }
    
                    $list = Helpers::getQAUserList($changeControl->division_id);
                    foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $changeControl->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site'=>"External Audit", 'history' => "Approval Complete", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Approval Complete Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                            }
                        // }
                    }

                    $list = Helpers::getCftUserList($changeControl->division_id);
                    foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $changeControl->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $changeControl, 'site'=>"External Audit", 'history' => "Approval Complete", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                            ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Approval Complete Performed");
                                        }
                                    );
                                } catch(\Exception $e) {
                                    info('Error sending mail', [$e]);
                                }
                            }
                        // }
                    }

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
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = Auditee::find($id);
            $lastDocument = Auditee::find($id);
            $internalAudit = Auditee::find($id);


            // if ($changeControl->stage == 2) {
            //     $changeControl->stage = "4";
            //     $changeControl->status = "QA Head Approval";
            //     $changeControl->audit_preparation_completed_by = Auth::user()->name;
            //     $changeControl->audit_preparation_completed_on = Carbon::now()->format('d-M-Y');
            //     $changeControl->audit_preparation_completed_on_comment = $request->comment;


            //             $history = new AuditTrialExternal();
            //             $history->ExternalAudit_id = $id;
            //             $history->activity_type = 'Activity Log';
            //             $history->previous = "";
            //             $history->current = $changeControl->audit_preparation_completed_by;
            //             $history->comment = $request->comment;
            //             $history->action = 'CFT Review Not Required';
            //             $history->user_id = Auth::user()->id;
            //             $history->user_name = Auth::user()->name;
            //             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //             $history->origin_state = $lastDocument->status;
            //             $history->change_to =   "QA Head Approval";
            //             $history->change_from = $lastDocument->status;
            //             $history->action_name = 'Update';
            //             $history->stage = 'QA Head Approval';

            //             $history->save();

            //     $changeControl->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            if ($changeControl->stage == 2) {
                $changeControl->stage = "1";
                $changeControl->status = "Opened";
                $changeControl->more_info_req_by = Auth::user()->name;
                $changeControl->more_info_req_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_info_req_on_comment = $request->comment;


                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Not Applicable';
                        $history->previous = "Not Applicable";
                        $history->action  = "More Information Required";
                        $history->comment = $request->comment;
                        // $history->action  = "More Info Required";
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "Opened";
                        $history->change_from = $lastDocument->status;
                        $history->action_name ="Not Applicable";

                        $history->stage = "Rejected";
                        // if (is_null($lastDocument->more_info_req_by) || $lastDocument->more_info_req_by === '') {
                        //     $history->previous = "";
                        // } else {
                        //     $history->previous = $lastDocument->more_info_req_by . ' , ' . $lastDocument->more_info_req_on;
                        // }
                        // $history->current = $changeControl->more_info_req_by . ' , ' . $changeControl->more_info_req_on;
                        // if (is_null($lastDocument->more_info_req_by) || $lastDocument->more_info_req_by === '') {
                        //     $history->action_name = 'New';
                        // } else {
                        //     $history->action_name = 'Update';
                        // }
                        $history->save();
                   
                        $list = Helpers::getCQAUsersList($changeControl->division_id);
                        foreach ($list as $u) {
                            // if($u->q_m_s_divisions_id == $changeControl->division_id){
                                $email = Helpers::getUserEmail($u->user_id);
                                    if ($email !== null) {
                                    try {
                                        Mail::send(
                                            'mail.view-mail',
                                            ['data' => $changeControl, 'site'=>"External Audit", 'history' => "More Information Required", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                            function ($message) use ($email, $changeControl) {
                                                $message->to($email)
                                                ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required Performed");
                                            }
                                        );
                                    } catch(\Exception $e) {
                                        info('Error sending mail', [$e]);
                                    }
                                }
                            // }
                        }

                $list = Helpers::getQAUserList($changeControl->division_id);
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            try {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $changeControl, 'site'=>"External Audit", 'history' => "More Information Required", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $changeControl) {
                                        $message->to($email)
                                        ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required Performed");
                                    }
                                );
                            } catch(\Exception $e) {
                                info('Error sending mail', [$e]);
                            }
                        } are bolna ki 1 sal 10 month ho chuke or agr vo ye puche ki incremnet kab hua tha last time to bona incree abhi nhi hua tha kuch 3 4 month stiped pr the uske bad basic salry ki bat hyi thi 
                    // }
                }

                    // $history = new AuditeeHistory();
                    // $history->type = "External Audit";
                    // $history->doc_id = $id;
                    // $history->user_id = Auth::user()->id;
                    // $history->user_name = Auth::user()->name;
                    // $history->stage_id = $changeControl->stage;
                    // $history->status = $changeControl->status;
                    // $history->save();

                $changeControl->update();
                $history = new AuditeeHistory();
                $history->type = "External Audit";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 3) {
                $changeControl->stage = "2";
                $changeControl->status = "Summary and Response";
                $changeControl->more_info_req_crc_by = Auth::user()->name;
                $changeControl->more_info_req_crc_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_info_req_crc_on_comment = $request->comment;

                $history = new AuditTrialExternal();
                $history->ExternalAudit_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->action  = "More Information Required";
                $history->comment = $request->comment;
                $history->action  = "More Information Required";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Summary and Response";
                $history->change_from = $lastDocument->status;
                $history->action_name ="Not Applicable";

                $history->stage = "Summary and Response";
                // if (is_null($lastDocument->more_info_req_crc_by) || $lastDocument->more_info_req_crc_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->more_info_req_crc_by . ' , ' . $lastDocument->more_info_req_crc_on;
                // }
                // $history->current = $changeControl->more_info_req_crc_by . ' , ' . $changeControl->more_info_req_crc_on;
                // if (is_null($lastDocument->more_info_req_crc_by) || $lastDocument->more_info_req_crc_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->save();
                $history = new AuditeeHistory();
                $history->type = "External Audit";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();

                $list = Helpers::getCQAUsersList($changeControl->division_id);
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            try {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $changeControl, 'site'=>"External Audit", 'history' => "More Information Required", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $changeControl) {
                                        $message->to($email)
                                        ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required Performed");
                                    }
                                );
                            } catch(\Exception $e) {
                                info('Error sending mail', [$e]);
                            }
                        }
                    // }
                }

                $list = Helpers::getQAUserList($changeControl->division_id);
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            try {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $changeControl, 'site'=>"External Audit", 'history' => "More Information Required", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $changeControl) {
                                        $message->to($email)
                                        ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required Performed");
                                    }
                                );
                            } catch(\Exception $e) {
                                info('Error sending mail', [$e]);
                            }
                        }
                    // }
                }


                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 4) {
                $changeControl->stage = "1";
                $changeControl->status = "Opened";
                $changeControl->send_to_opened_by = Auth::user()->name;
                $changeControl->send_to_opened_on = Carbon::now()->format('d-M-Y');
                $changeControl->send_to_opened_comment = $request->comment;

                // $marketstat->reject_comment = $request->comment;
                DB::table('external_audit_c_f_t_responses')
                ->where('external_audit_id', $id)
                ->whereIn('status', ['In-progress', 'Completed'])
                ->update([
                    'status' => 'Pending',
                    'updated_at' => now(),
                ]);

                $history = new AuditTrialExternal();
                $history->ExternalAudit_id = $id;
                $history->activity_type = 'Send to Opened By, Send to Opened On';
                $history->previous = "";
                $history->current = $changeControl->rejected_by;
                $history->comment = $request->comment;
                $history->action  = "Send to Opened ";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Opened";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Update';

                $history->stage = "Opened";
                if (is_null($lastDocument->send_to_opened_by) || $lastDocument->send_to_opened_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->send_to_opened_by . ' , ' . $lastDocument->send_to_opened_on;
                }
                $history->current = $changeControl->send_to_opened_by . ' , ' . $changeControl->send_to_opened_on;
                if (is_null($lastDocument->send_to_opened_by) || $lastDocument->send_to_opened_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                $history = new AuditeeHistory();
                $history->type = "External Audit";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;



                $list = Helpers::getQAUserList($changeControl->division_id);
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            try {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $changeControl, 'site'=>"External Audit", 'history' => "Send to Opened", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $changeControl) {
                                        $message->to($email)
                                        ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Send to Opened Performed");
                                    }
                                );
                            } catch(\Exception $e) {
                                info('Error sending mail', [$e]);
                            }
                        }
                    // }
                }


                $list = Helpers::getCQAUsersList($changeControl->division_id);
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            try {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $changeControl, 'site'=>"External Audit", 'history' => "Send to Opened", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $changeControl) {
                                        $message->to($email)
                                        ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Send to Opened Performed");
                                    }
                                );
                            } catch(\Exception $e) {
                                info('Error sending mail', [$e]);
                            }
                        }
                    // }
                }
                $history->save();
                $changeControl->update();

                $Cft = ExternalAuditCFT::where('external_audit_id', $changeControl->id)->first();
                    if ($Cft) {
                        $Cft->QualityAssurance_by = null;
                        $Cft->QualityAssurance_on = null;
                        $Cft->Quality_Control_by = null;
                        $Cft->Quality_Control_on = null;
                        $Cft->Warehouse_by = null;
                        $Cft->Warehouse_on = null;
                        $Cft->Production_Injection_By = null;
                        $Cft->Production_Injection_On = null;
                        $Cft->Production_Table_By = null;
                        $Cft->Production_Table_On = null;
                        $Cft->RA_by = null;
                        $Cft->RA_on = null;
                        $Cft->production_by = null;
                        $Cft->production_on = null;
                        $Cft->ResearchDevelopment_by = null;
                        $Cft->ResearchDevelopment_on = null;
                        $Cft->Human_Resource_by = null;
                        $Cft->Human_Resource_on = null;
                        $Cft->CorporateQualityAssurance_by = null;
                        $Cft->CorporateQualityAssurance_on = null;
                        $Cft->Store_by = null;
                        $Cft->Store_on = null;
                        $Cft->Engineering_by = null;
                        $Cft->Engineering_on = null;
                        $Cft->RegulatoryAffair_by = null;
                        $Cft->RegulatoryAffair_on = null;
                        $Cft->QualityAssurance_by = null;
                        $Cft->QualityAssurance_on = null;
                        $Cft->ProductionLiquid_by = null;
                        $Cft->ProductionLiquid_on = null;
                        $Cft->Quality_Control_by = null;
                        $Cft->Quality_Control_on = null;
                        $Cft->Microbiology_by = null;
                        $Cft->Microbiology_on = null;
                        $Cft->Environment_Health_Safety_by = null;
                        $Cft->Environment_Health_Safety_on = null;
                        $Cft->ContractGiver_by = null;
                        $Cft->ContractGiver_on = null;
                        $Cft->Other1_by = null;
                        $Cft->Other1_on = null;
                        $Cft->Other2_by = null;
                        $Cft->Other2_on = null;
                        $Cft->Other3_by = null;
                        $Cft->Other3_on = null;
                        $Cft->Other4_by = null;
                        $Cft->Other4_on = null;
                        $Cft->Other5_by = null;
                        $Cft->Other5_on = null;

                        $Cft->save();

                        return back();
                    }
                toastr()->success('Document Sent');
                return back();
            }

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function UpdateStateChange(Request $request, $id)
    {

        //return "hello";
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = Auditee::find($id);
            $lastDocument = Auditee::find($id);
            $internalAudit = Auditee::find($id);

            if ($changeControl->stage == 2) {
                $changeControl->stage = "4";
                $changeControl->status = "QA/CQA Head Approval";
                $changeControl->cft_review_not_req_by = Auth::user()->name;
                $changeControl->cft_review_not_req_on = Carbon::now()->format('d-M-Y');
                $changeControl->cft_review_not_req_on_comment = $request->comment;


                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'CFT Review Not Required By, CFT Review Not Required On';
                        $history->previous = "";
                        $history->current = $changeControl->audit_preparation_completed_by;
                        $history->comment = $request->comment;
                        $history->action = 'CFT Review Not Required';
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "QA/CQA Head Approval";
                        $history->change_from = $lastDocument->status;
                        $history->action_name = 'Update';
                        $history->stage = 'QA/CQA Head Approval';
                        if (is_null($lastDocument->cft_review_not_req_by) || $lastDocument->cft_review_not_req_by === '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->cft_review_not_req_by . ' , ' . $lastDocument->cft_review_not_req_on;
                        }
                        $history->current = $changeControl->cft_review_not_req_by . ' , ' . $changeControl->cft_review_not_req_on;
                        if (is_null($lastDocument->cft_review_not_req_by) || $lastDocument->cft_review_not_req_by === '') {
                            $history->action_name = 'New';
                        } else {
                            $history->action_name = 'Update';
                        }
                      //   return $history;
                        $history->save();




                        // $list = Helpers::getQAHeadUserList($changeControl->division_id); // Notify QA
                        // foreach ($list as $u) {
                        //     // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        //         $email = Helpers::getUserEmail($u->user_id);
                        //             if ($email !== null) {
                        //                 try {
                        //                     Mail::send(
                        //                         'mail.view-mail',
                        //                         ['data' => $changeControl, 'site' => "External Audit", 'history' => "CFT Review Not Required", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                        //                         function ($message) use ($email, $changeControl) {
                        //                             $message->to($email)
                        //                             ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: CFT Review Not Required");
                        //                         }
                        //                     );
                        //             } catch(\Exception $e) {
                        //                     info('Error sending mail', [$e]);
                        //                 }
                        //         }
                        //     // }
                        // }
    
                        // $list = Helpers::getCQAUsersList($changeControl->division_id); // Notify CQA
                        // foreach ($list as $u) {
                        //     // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        //         $email = Helpers::getUserEmail($u->user_id);
                        //             if ($email !== null) {
                        //                 try {
                        //                     Mail::send(
                        //                         'mail.view-mail',
                        //                         ['data' => $changeControl, 'site' => "External Audit", 'history' => "CFT Review Not Required", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                        //                         function ($message) use ($email, $changeControl) {
                        //                             $message->to($email)
                        //                             ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: CFT Review Not Required");
                        //                         }
                        //                     );
                        //                 } catch(\Exception $e) {
                        //                     info('Error sending mail', [$e]);
                        //                 }
                        //         }
                        //     // }
                        // }
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }


        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function externalAuditCancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = Auditee::find($id);
            $lastDocument = Auditee::find($id);
            $internalAudit = Auditee::find($id);

            if ($changeControl->stage == 1) {
                $changeControl->stage = "0";
                $changeControl->status = "Closed-Cancelled";
                $changeControl->cancelled_by = Auth::user()->name;
                $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');

                $changeControl->cancelled_on_comment = $request->comment;



                        $history = new AuditTrialExternal();
                        $history->ExternalAudit_id = $id;
                        $history->activity_type = 'Cancelled By,Cancelled On';
                        $history->current = $changeControl->cancelled_by;
                        $history->comment = $request->comment;
                        $history->action  = "Cancel";
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->change_to =   "Closed-Cancelled";
                        $history->change_from = $lastDocument->status;
                        $history->origin_state = $lastDocument->status;
                        $history->stage = "Cancelled";
                        if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->cancelled_by . ' , ' . $lastDocument->cancelled_on;
                        }
                        $history->current = $changeControl->cancelled_by . ' , ' . $changeControl->cancelled_on;
                        if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                            $history->action_name = 'New';
                        } else {
                            $history->action_name = 'Update';
                        }
                    
                        $history->save();












                        // $list = Helpers::getQAHeadUserList($changeControl->division_id); // Notify QA
                        // foreach ($list as $u) {
                        //     // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        //         $email = Helpers::getUserEmail($u->user_id);
                        //             if ($email !== null) {
                        //                 try {
                        //                     Mail::send(
                        //                         'mail.view-mail',
                        //                         ['data' => $changeControl, 'site' => "External Audit", 'history' => "Closed - Cancelled", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                        //                         function ($message) use ($email, $changeControl) {
                        //                             $message->to($email)
                        //                             ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Closed - Cancelled");
                        //                         }
                        //                     );
                        //             } catch(\Exception $e) {
                        //                     info('Error sending mail', [$e]);
                        //                 }
                        //         }
                        //     // }
                        // }
    
                        // $list = Helpers::getCQAUsersList($changeControl->division_id); // Notify CQA
                        // foreach ($list as $u) {
                        //     // if($u->q_m_s_divisions_id == $changeControl->division_id){
                        //         $email = Helpers::getUserEmail($u->user_id);
                        //             if ($email !== null) {
                        //                 try {
                        //                     Mail::send(
                        //                         'mail.view-mail',
                        //                         ['data' => $changeControl, 'site' => "External Audit", 'history' => "Closed - Cancelled", 'process' => 'External Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                        //                         function ($message) use ($email, $changeControl) {
                        //                             $message->to($email)
                        //                             ->subject("Agio Notification: External Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Closed - Cancelled");
                        //                         }
                        //                     );
                        //                 } catch(\Exception $e) {
                        //                     info('Error sending mail', [$e]);
                        //                 }
                        //         }
                        //     // }
                        // }
    
                $changeControl->update();
                $history = new AuditeeHistory();
                $history->type = "External Audit";
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
                $changeControl->stage = "0";
                $changeControl->status = "Closed-Cancelled";
                $changeControl->cancelled_by = Auth::user()->name;
                $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
                $changeControl->cancelled_on_comment1 = $request->comment;

                $history = new AuditTrialExternal();
                $history->ExternalAudit_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->cancelled_by;
                $history->comment = $request->comment;
                $history->action  = "Cancel";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to =   "Closed-Cancelled";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage = "Cancelled";
                $history->save();
                $changeControl->update();
                $history = new AuditeeHistory();
                $history->type = "External Audit";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 3) {
                $changeControl->stage = "0";
                $changeControl->status = "Closed-Cancelled";
                $changeControl->cancelled_by = Auth::user()->name;
                $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
                $changeControl->cancelled_on_comment2 = $request->comment;

                $history = new AuditTrialExternal();
                $history->ExternalAudit_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->cancelled_by;
                $history->comment = $request->comment;
                $history->action  = "Cancel";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to =   "Closed-Cancelled";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage = "Cancelled";
                $history->save();
                $changeControl->update();
                $history = new AuditeeHistory();
                $history->type = "External Audit";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function AuditTrialExternalShow($id)
    {
        // $audit = AuditTrialExternal::where('ExternalAudit_id', $id)->orderByDESC('id')->get()->unique('activity_type');
        $audit = AuditTrialExternal::where('ExternalAudit_id', $id)->orderByDESC('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = Auditee::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
      //  return view('frontend.externalAudit.audit-trial', compact('audit', 'document', 'today'));
      return view('frontend.externalAudit.new_audit_trail', compact('audit', 'document', 'today'));
    }



    public function AuditTrialExternalDetails($id)
    {

        $detail = AuditTrialExternal::find($id);

        $detail_data = AuditTrialExternal::where('activity_type', $detail->activity_type)->where('ExternalAudit_id', $detail->ExternalAudit_id)->latest()->get();

        $doc = Auditee::where('id', $detail->ExternalAudit_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);
        return view('frontend.externalAudit.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
    }

    public static function singleReport($id)
    {
        $data = Auditee::find($id);
       $grid_Data = SummaryGrid::where(['summary_id' => $id, 'identifier' => 'Auditors'])->first();
       
       $grid_Data_2 = SummaryGrid::where(['summary_id' => $id, 'identifier' => 'Summary Response'])->first();


       $data1 =  ExternalAuditCFT::where('external_audit_id', $id)->first();
     //  $cc_cfts =  ExternalAuditCFT::where('external_audit_id', $id)->first();

    //  $AuditorShow = SummaryGrid::where(['summary_id' => $AuditUpdate, 'identifier' => 'Auditors'])->firstOrNew();
        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.externalAudit.singleReport', compact('data','grid_Data','grid_Data_2','data1'))
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
            $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
                $text = "$pageNumber of $pageCount";
                $font = $fontMetrics->getFont('sans-serif');
                $size = 9;
                $width = $fontMetrics->getTextWidth($text, $font, $size);

                $canvas->text(($canvas->get_width() - $width - 110), ($canvas->get_height() - 763), $text, $font, $size);
            });
            return $pdf->stream('External-Audit' . $id . '.pdf');
        }
    }


    public static function SummaryResponseReport($id)
    {
        $oocgrid = SummaryGrid::where('summary_id',$id)->first();
        $data = Auditee::find($id);
        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.externalAudit.SummaryResopnseReport', compact('data','oocgrid'))
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
            return $pdf->stream('External-Audit' . $id . '.pdf');
        }
    }

    public static function auditReport($id)
    {
        $doc = Auditee::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $data = AuditTrialExternal::where('ExternalAudit_id', $id)->orderByDesc('id')->get();
            $audit = AuditTrialExternal::where('ExternalAudit_id', $id)->get();
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.externalAudit.auditReport', compact('data', 'doc','audit'))
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
            $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $text = " $pageNumber of $pageCount";
            $font = $fontMetrics->getFont('sans-serif', 'normal');
            $size = 9;
            $width = $fontMetrics->getTextWidth($text, $font, $size);

            $canvas->text(($canvas->get_width() - $width - 110), ($canvas->get_height() - 26), $text, $font, $size);
            });
            return $pdf->stream('External-Audit' . $id . '.pdf');
        }
    }


    public function child_external(Request $request, $id)
    {
        $parent_id = $id;

        if ($request->child_type == "Action-Item") {
            $parent_division_id  = Auditee::where('id', $id)->value('division_id');
            $parentRecord = Auditee::where('id', $id)->value('record');
            $parent_type = "External Audit";
            $record = ((RecordNumber::first()->value('counter')) + 1);
            $record = str_pad($record, 4, '0', STR_PAD_LEFT);
            $currentDate = Carbon::now();
            $p_record = Auditee::find($id);
            $data = Auditee::find($id);
            $data_record = Helpers::getDivisionName($p_record->division_id ) . '/' . 'EA' .'/' . date('Y') .'/' . str_pad($p_record->record, 4, '0', STR_PAD_LEFT);
            $formattedDate = $currentDate->addDays(30);
            $due_date = $formattedDate->format('d-M-Y');
            $parent_record=$data_record;
            return view('frontend.action-item.action-item', compact('record','parentRecord', 'due_date', 'parent_id', 'parent_type', 'data_record','data','parent_division_id','parent_record'));
        }

        if ($request->child_type == "Observations")
        {
            $parent_type = "External Audit";
            $record_number = ((RecordNumber::first()->value('counter')) + 1);
            $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            $currentDate = Carbon::now();
            $formattedDate = $currentDate->addDays(30);
            $due_date = $formattedDate->format('d-M-Y');
            // dd($parent_type);
            return view('frontend.forms.observation', compact('record_number', 'due_date', 'parent_id', 'parent_type'));
        }


        if ($request->child_type == "Extension")
        {
            $parent_due_date = Auditee::where('id', $id)->value('due_date');
            $record_number = ((RecordNumber::first()->value('counter')) + 1);
            $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            $record = ((RecordNumber::first()->value('counter')) + 1);
            $record = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            $parent_division_id  = Auditee::where('id', $id)->value('division_id');
            $relatedRecords = Helpers::getAllRelatedRecords();
            $data=Auditee::find($id);
            $parent_type = "External Audit";
            $extension_record = Helpers::getDivisionName($data->division_id ) . '/' . 'EA' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
            $count = Helpers::getChildData($id, $parent_type);
            $countData = $count + 1; 
            return view('frontend.extension.extension_new', compact('parent_type','record','record_number','parent_id','parent_due_date','extension_record','parent_division_id', 'relatedRecords','countData',));

        }
    }
}
