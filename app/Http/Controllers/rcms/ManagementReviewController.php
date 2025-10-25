<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\ActionItem;
use App\Models\Auditee;
use App\Models\AuditProgram;
use App\Models\managementCft;
use App\Models\hodmanagementCft;
use App\Models\Capa;
use App\Models\managementCft_Response;
use App\Models\hodmanagementCft_Response;
use App\Models\CC;
use App\Models\EffectivenessCheck;
use App\Models\managementHistory;
use App\Models\InternalAudit;
use App\Models\LabIncident;
use App\Models\ManagementReview;
use App\Models\RecordNumber;
use App\Models\ManagementAuditTrial;
use App\Models\ManagementReviewDocDetails;
use App\Models\RiskManagement;
use App\Models\RoleGroup;
use App\Models\RootCauseAnalysis;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Carbon\Carbon;
use PDF;
use Helpers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagementReviewController extends Controller
{

    public function meeting()
    {
       // $old_record = ManagementReview::select('id', 'division_id', 'record')->get();
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');


        return view("frontend.forms.meeting", compact('due_date', 'record_number'));
    }

    public function managestore(Request $request)
    {
         //$request->dd();
        //  return $request;
         $form_progress = null;

        if (!$request->short_description) {
            toastr()->error("Short description is required");
            return redirect()->back();
        }
        //  if (!$request->initiator_Group) {
        //     toastr()->error("Initiator Department is required");
        //     return redirect()->back();
        // }
        $management = new ManagementReview();
        //$management->record_number = ($request->record_number);
        // $management->assign_to = 1;//$request->assign_to;

         $management->priority_level = $request->priority_level;
        //  $management->assign_to= $request->assign_to;
        // $management->assign_to = implode(',', $request->assign_to);

        $management->assign_to = implode(',', $request->assign_to);


         $management->Operations= $request->Operations;
         $management->requirement_products_services = $request->requirement_products_services;
         $management->design_development_product_services = $request->design_development_product_services;
         $management->control_externally_provide_services = $request->control_externally_provide_services;
         $management->production_service_provision= $request->production_service_provision;
         $management->release_product_services = $request->release_product_services;
        $management->control_nonconforming_outputs = $request->control_nonconforming_outputs;
        $management->risk_opportunities = $request->risk_opportunities;
        $management->initiator_group_code= $request->initiator_group_code;
        $management->initiator_Group= $request->initiator_Group;
       // $management->type = $request->type;
       // $management->serial_number = 1;
        //json_encode($request->serial_number);
        //  $management->date =1; //json_encode($request->date);
        //$management->topic = json_encode($request->topic);
       // $management->responsible = json_encode ($request->responsible);

        //$management->comment = json_encode($request->comment);
        //$management->end_time = json_encode($request->end_time);
       // $management->topic = json_encode($request->topic);

      // $management = new ManagementReview();
        $management->form_type = "Management Review";
        $management->division_id = $request->division_id;
        $management->record = ((RecordNumber::first()->value('counter')) + 1);
        $management->initiator_id = Auth::user()->id;
        $management->form_progress = isset($form_progress) ? $form_progress : null;
        $management->intiation_date = $request->intiation_date;
        $management->division_code = $request->division_code;
        // $management->Initiator_id = $request->Initiator_id;
        $management->short_description = $request->short_description;
        // $management->assigned_to = $request->assigned_to;
        // $management->assign_to = implode(',', $request->assign_to);

        $management->due_date = $request->due_date;
        $management->type = $request->type;

        $management->start_date = $request->start_date;
        $management->end_date = $request->end_date;
        $management->attendees = $request->attendees;
        $management->agenda = $request->agenda;
        $management->performance_evaluation = $request->performance_evaluation;
        $management->management_review_participants = $request->management_review_participants;
        $management->action_item_details =$request->action_item_details;
        $management->capa_detail_details = $request->capa_detail_details;
        $management->description = $request->description;
        $management->attachment = $request->attachment;
        //  $management->inv_attachment = json_encode($request->inv_attachment);
        $management->actual_start_date = $request->actual_start_date;
        $management->actual_end_date = $request->actual_end_date;
        $management->meeting_minute = $request->meeting_minute;
        $management->decision = $request->decision;
        $management->zone = $request->zone;
        $management->country = $request->country;
        $management->city = $request->city;
        $management->site_name = $request->site_name;
        $management->building = $request->building;
        $management->floor = $request->floor;
        $management->room = $request->room;
        $management->updated_at = $request->updated_at;
        $management->review_period_monthly = $request->review_period_monthly;
        $management->review_period_six_monthly = $request->review_period_six_monthly;
        $management->status = 'Opened';
        $management->stage = 1;

        if (!empty($request->inv_attachment)) {
            $files = [];
            if ($request->hasfile('inv_attachment')) {
                foreach ($request->file('inv_attachment') as $file) {
                    $name = $request->name . 'GI Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $management->inv_attachment= json_encode($files);
        }
        if (!empty($request->file_attchment_if_any)) {
            $files = [];
            if ($request->hasfile('file_attchment_if_any')) {
                foreach ($request->file('file_attchment_if_any') as $file) {
                    $name = $request->name . 'file_attchment_if_any' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $management->file_attchment_if_any= json_encode($files);
        }
        if (!empty($request->closure_attachments)) {
            $files = [];
            if ($request->hasfile('closure_attachments')) {
                foreach ($request->file('closure_attachments') as $file) {
                    $name = $request->name . 'closure_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $management->closure_attachments= json_encode($files);
        }

        if (!empty($request->meeting_and_summary_attachment)) {
            $files = [];
            if ($request->hasfile('meeting_and_summary_attachment')) {
                foreach ($request->file('meeting_and_summary_attachment') as $file) {
                    $name = $request->name . 'meeting_and_summary_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $management->meeting_and_summary_attachment= json_encode($files);
        }



         if (!empty($request->cft_hod_attach)) {
            $files = [];
            if ($request->hasfile('cft_hod_attach')) {
                foreach ($request->file('cft_hod_attach') as $file) {
                    $name = $request->name . 'cft_hod_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $management->cft_hod_attach= json_encode($files);
        } if (!empty($request->qa_verification_file)) {
            $files = [];
            if ($request->hasfile('qa_verification_file')) {
                foreach ($request->file('qa_verification_file') as $file) {
                    $name = $request->name . 'qa_verification_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $management->qa_verification_file= json_encode($files);
        }

        $management->save();
        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();


        //  $request->dd();

        // $management = new MeetingSummary();
        $management->risk_opportunities = $request->risk_opportunities;
        $management->external_supplier_performance = $request->external_supplier_performance;
        $management->customer_satisfaction_level = $request->customer_satisfaction_level;
        $management->budget_estimates = $request->budget_estimates;
        $management->completion_of_previous_tasks = $request->completion_of_previous_tasks;
        $management->production_new = $request->production_new;
        $management->plans_new = $request->plans_new;
        $management->forecast_new = $request->forecast_new;
        $management->due_date_extension= $request->due_date_extension;
        $management->conclusion_new = $request->conclusion_new;
        $management->next_managment_review_date = $request->next_managment_review_date;
        $management->summary_recommendation = $request->summary_recommendation;
        $management->additional_suport_required = $request->additional_suport_required;
        // $management->file_attchment_if_any = json_encode($request->file_attchment_if_any);

        $management->save();
        $Cft = new managementCft();
       $Cft->ManagementReview_id = $management->id;

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

        //-------------------HODCFT------------------------------//




        //======================HODCFT ATTACHMENT===================//

          $hodCft = new hodmanagementCft();
        $hodCft->ManagementReview_id = $management->id;

        $hodCft->hod_Production_Table_Review = $request->hod_Production_Table_Review;
        $hodCft->hod_Production_Table_Person = $request->hod_Production_Table_Person;
        $hodCft->hod_Production_Table_Feedback = $request->hod_Production_Table_Feedback;
        $hodCft->hod_Production_Table_Attachment = $request->hod_Production_Table_Attachment;
        $hodCft->hod_Production_Table_By = $request->hod_Production_Table_By;
        $hodCft->hod_Production_Table_On = $request->hod_Production_Table_On;

        $hodCft->hod_Production_Injection_Review = $request->hod_Production_Injection_Review;
        $hodCft->hod_Production_Injection_Person = $request->hod_Production_Injection_Person;
        $hodCft->hod_Production_Injection_Feedback = $request->hod_Production_Injection_Feedback;
        $hodCft->hod_Production_Injection_Attachment = $request->hod_Production_Injection_Attachment;
        $hodCft->hod_Production_Injection_By = $request->hod_Production_Injection_By;
        $hodCft->hod_Production_Injection_On = $request->hod_Production_Injection_On;

        $hodCft->hod_Quality_review = $request->hod_Quality_review;
        $hodCft->hod_Quality_Control_Person = $request->hod_Quality_Control_Person;
        $hodCft->hod_Quality_Control_feedback = $request->hod_Quality_Control_feedback;
        $hodCft->hod_Quality_Control_by = $request->hod_Quality_Control_by;
        $hodCft->hod_Quality_Control_on = $request->hod_Quality_Control_on;

        $hodCft->hod_Quality_Assurance_Review = $request->hod_Quality_Assurance_Review;
        $hodCft->hod_QualityAssurance_person = $request->hod_QualityAssurance_person;
        $hodCft->hod_QualityAssurance_feedback = $request->hod_QualityAssurance_feedback;
        $hodCft->hod_QualityAssurance_by = $request->hod_QualityAssurance_by;
        $hodCft->hod_QualityAssurance_on = $request->hod_QualityAssurance_on;

        $hodCft->hod_Engineering_review = $request->hod_Engineering_review;
        $hodCft->hod_Engineering_person = $request->hod_Engineering_person;
        $hodCft->hod_Engineering_feedback = $request->hod_Engineering_feedback;
        $hodCft->hod_Engineering_by = $request->hod_Engineering_by;
        $hodCft->hod_Engineering_on = $request->hod_Engineering_on;

        $hodCft->hod_Analytical_Development_review = $request->hod_Analytical_Development_review;
        $hodCft->hod_Analytical_Development_person = $request->hod_Analytical_Development_person;
        $hodCft->hod_Analytical_Development_feedback = $request->hod_Analytical_Development_feedback;
        $hodCft->hod_Analytical_Development_by = $request->hod_Analytical_Development_by;
        $hodCft->hod_Analytical_Development_on = $request->hod_Analytical_Development_on;

        $hodCft->hod_Technology_transfer_review = $request->hod_Technology_transfer_review;
        $hodCft->hod_Technology_transfer_person = $request->hod_Technology_transfer_person;
        $hodCft->hod_Technology_transfer_feedback = $request->hod_Technology_transfer_feedback;
        $hodCft->hod_Technology_transfer_by = $request->hod_Technology_transfer_by;
        $hodCft->hod_Technology_transfer_on = $request->hod_Technology_transfer_on;

        $hodCft->hod_Environment_Health_review = $request->hod_Environment_Health_review;
        $hodCft->hod_Environment_Health_Safety_person = $request->hod_Environment_Health_Safety_person;
        $hodCft->hod_Health_Safety_feedback = $request->hod_Health_Safety_feedback;
        $hodCft->hod_Environment_Health_Safety_by = $request->hod_Environment_Health_Safety_by;
        $hodCft->hod_Environment_Health_Safety_on = $request->hod_Environment_Health_Safety_on;

        $hodCft->hod_Human_Resource_review = $request->hod_Human_Resource_review;
        $hodCft->hod_Human_Resource_person = $request->hod_Human_Resource_person;
        $hodCft->hod_Human_Resource_feedback = $request->hod_Human_Resource_feedback;
        $hodCft->hod_Human_Resource_by = $request->hod_Human_Resource_by;
        $hodCft->hod_Human_Resource_on = $request->hod_Human_Resource_on;

        $hodCft->hod_ProductionLiquid_Review = $request->hod_ProductionLiquid_Review;
        $hodCft->hod_ProductionLiquid_person = $request->hod_ProductionLiquid_person;
        $hodCft->hod_ProductionLiquid_feedback = $request->hod_ProductionLiquid_feedback;
        $hodCft->hod_ProductionLiquid_by = $request->hod_ProductionLiquid_by;
        $hodCft->hod_ProductionLiquid_on = $request->hod_ProductionLiquid_on;

        $hodCft->hod_Store_Review = $request->hod_Store_Review;
        $hodCft->hod_Store_person = $request->hod_Store_person;
        $hodCft->hod_Store_feedback = $request->hod_Store_feedback;
        $hodCft->hod_Store_by = $request->hod_Store_by;
        $hodCft->hod_Store_on = $request->hod_Store_on;

        $hodCft->hod_ResearchDevelopment_Review = $request->hod_ResearchDevelopment_Review;
        $hodCft->hod_ResearchDevelopment_person = $request->hod_ResearchDevelopment_person;
        $hodCft->hod_ResearchDevelopment_feedback = $request->hod_ResearchDevelopment_feedback;
        $hodCft->hod_ResearchDevelopment_by = $request->hod_ResearchDevelopment_by;
        $hodCft->hod_ResearchDevelopment_on = $request->hod_ResearchDevelopment_on;

        $hodCft->hod_RegulatoryAffair_Review = $request->hod_RegulatoryAffair_Review;
        $hodCft->hod_RegulatoryAffair_person = $request->hod_RegulatoryAffair_person;
        $hodCft->hod_RegulatoryAffair_feedback = $request->hod_RegulatoryAffair_feedback;
        $hodCft->hod_RegulatoryAffair_by = $request->hod_RegulatoryAffair_by;
        $hodCft->hod_RegulatoryAffair_on = $request->hod_RegulatoryAffair_on;

        $hodCft->hod_Microbiology_Review = $request->hod_Microbiology_Review;
        $hodCft->hod_Microbiology_person = $request->hod_Microbiology_person;
        $hodCft->hod_Microbiology_feedback = $request->hod_Microbiology_feedback;
        $hodCft->hod_Microbiology_by = $request->hod_Microbiology_by;
        $hodCft->hod_Microbiology_on = $request->hod_Microbiology_on;

        $hodCft->hod_CorporateQualityAssurance_Review = $request->hod_CorporateQualityAssurance_Review;
        $hodCft->hod_CorporateQualityAssurance_person = $request->hod_CorporateQualityAssurance_person;
        $hodCft->hod_CorporateQualityAssurance_assessment = $request->hod_CorporateQualityAssurance_assessment;
        $hodCft->hod_CorporateQualityAssurance_feedback = $request->hod_CorporateQualityAssurance_feedback;
        $hodCft->hod_CorporateQualityAssurance_by = $request->hod_CorporateQualityAssurance_by;
        // dd($hodCft->hod_CorporateQualityAssurance_by);
        $hodCft->hod_CorporateQualityAssurance_on = $request->hod_CorporateQualityAssurance_on;
        $hodCft->hod_ContractGiver_Review = $request->hod_ContractGiver_Review;
        $hodCft->hod_ContractGiver_person = $request->hod_ContractGiver_person;
        $hodCft->hod_ContractGiver_assessment = $request->hod_ContractGiver_assessment;
        $hodCft->hod_ContractGiver_feedback = $request->hod_ContractGiver_feedback;
        $hodCft->hod_ContractGiver_by = $request->hod_ContractGiver_by;
        $hodCft->hod_ContractGiver_on = $request->hod_ContractGiver_on;

        $hodCft->hod_Other1_review = $request->hod_Other1_review;
        $hodCft->hod_Other1_person = $request->hod_Other1_person;
        $hodCft->hod_Other1_feedback = $request->hod_Other1_feedback;
        $hodCft->hod_Other1_by = $request->hod_Other1_by;
        $hodCft->hod_Other1_on = $request->hod_Other1_on;

        $hodCft->hod_Other2_review = $request->hod_Other2_review;
        $hodCft->hod_Other2_person = $request->hod_Other2_person;
        $hodCft->hod_Other2_feedback = $request->hod_Other2_feedback;
        $hodCft->hod_Other2_by = $request->hod_Other2_by;
        $hodCft->hod_Other2_on = $request->hod_Other2_on;

        $hodCft->hod_Other3_review = $request->hod_Other3_review;
        $hodCft->hod_Other3_person = $request->hod_Other3_person;
        $hodCft->hod_Other3_feedback = $request->hod_Other3_feedback;
        $hodCft->hod_Other3_by = $request->hod_Other3_by;
        $hodCft->hod_Other3_on = $request->hod_Other3_on;

        $hodCft->hod_Other4_review = $request->hod_Other4_review;
        $hodCft->hod_Other4_person = $request->hod_Other4_person;
        $hodCft->hod_Other4_Department_person = $request->hod_Other4_Department_person;
        $hodCft->hod_Other4_Assessment = $request->hod_Other4_Assessment;
        $hodCft->Other4_feedback = $request->Other4_feedback;
        $hodCft->hod_Other4_by = $request->hod_Other4_by;
        $hodCft->hod_Other4_on = $request->hod_Other4_on;

        $hodCft->hod_Other5_review = $request->hod_Other5_review;
        $hodCft->hod_Other5_person = $request->hod_Other5_person;
        $hodCft->hod_Other5_Department_person = $request->hod_Other5_Department_person;
        $hodCft->hod_Other5_Assessment = $request->hod_Other5_Assessment;
        $hodCft->hod_Other5_feedback = $request->hod_Other5_feedback;
        $hodCft->hod_Other5_by = $request->hod_Other5_by;
        $hodCft->hod_Other5_on = $request->hod_Other5_on;



        if (!empty ($request->hod_Quality_Control_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Quality_Control_attachment')) {
                foreach ($request->file('hod_Quality_Control_attachment') as $file) {
                    $name = $request->name . 'hod_Quality_Control_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Quality_Control_attachment = json_encode($files);
        }
          if (!empty ($request->hod_CorporateQualityAssurance_attachment)) {
            $files = [];
            if ($request->hasfile('hod_CorporateQualityAssurance_attachment')) {
                foreach ($request->file('hod_CorporateQualityAssurance_attachment') as $file) {
                    $name = $request->name . 'hod_CorporateQualityAssurance_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_CorporateQualityAssurance_attachment = json_encode($files);
        }
          if (!empty ($request->hod_Store_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Store_attachment')) {
                foreach ($request->file('hod_Store_attachment') as $file) {
                    $name = $request->name . 'hod_Store_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Store_attachment = json_encode($files);
        }
        if (!empty ($request->hod_ResearchDevelopment_attachment)) {
            $files = [];
            if ($request->hasfile('hod_ResearchDevelopment_attachment')) {
                foreach ($request->file('hod_ResearchDevelopment_attachment') as $file) {
                    $name = $request->name . 'hod_ResearchDevelopment_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_ResearchDevelopment_attachment = json_encode($files);
        }
         if (!empty ($request->hod_Production_Table_Attachment)) {
            $files = [];
            if ($request->hasfile('hod_Production_Table_Attachment')) {
                foreach ($request->file('hod_Production_Table_Attachment') as $file) {
                    $name = $request->name . 'hod_Production_Table_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Production_Table_Attachment = json_encode($files);
        }
        if (!empty ($request->hod_Quality_Assurance_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Quality_Assurance_attachment')) {
                foreach ($request->file('hod_Quality_Assurance_attachment') as $file) {
                    $name = $request->name . 'hod_Quality_Assurance_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Quality_Assurance_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Engineering_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Engineering_attachment')) {
                foreach ($request->file('hod_Engineering_attachment') as $file) {
                    $name = $request->name . 'hod_Engineering_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Engineering_attachment = json_encode($files);
        }
         if (!empty ($request->hod_RegulatoryAffair_attachment)) {
            $files = [];
            if ($request->hasfile('hod_RegulatoryAffair_attachment')) {
                foreach ($request->file('hod_RegulatoryAffair_attachment') as $file) {
                    $name = $request->name . 'hod_RegulatoryAffair_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_RegulatoryAffair_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Analytical_Development_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Analytical_Development_attachment')) {
                foreach ($request->file('hod_Analytical_Development_attachment') as $file) {
                    $name = $request->name . 'hod_Analytical_Development_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Analytical_Development_attachment = json_encode($files);
        }

        if (!empty ($request->hod_Technology_transfer_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Technology_transfer_attachment')) {
                foreach ($request->file('hod_Technology_transfer_attachment') as $file) {
                    $name = $request->name . 'hod_Technology_transfer_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Technology_transfer_attachment = json_encode($files);
        }
         if (!empty ($request->hod_ProductionLiquid_attachment)) {
            $files = [];
            if ($request->hasfile('hod_ProductionLiquid_attachment')) {
                foreach ($request->file('hod_ProductionLiquid_attachment') as $file) {
                    $name = $request->name . 'hod_ProductionLiquid_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_ProductionLiquid_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Environment_Health_Safety_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Environment_Health_Safety_attachment')) {
                foreach ($request->file('hod_Environment_Health_Safety_attachment') as $file) {
                    $name = $request->name . 'hod_Environment_Health_Safety_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Environment_Health_Safety_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Human_Resource_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Human_Resource_attachment')) {
                foreach ($request->file('hod_Human_Resource_attachment') as $file) {
                    $name = $request->name . 'hod_Human_Resource_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Human_Resource_attachment = json_encode($files);
        }

        if (!empty ($request->hod_Project_management_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Project_management_attachment')) {
                foreach ($request->file('hod_Project_management_attachment') as $file) {
                    $name = $request->name . 'hod_Project_management_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Project_management_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Other1_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Other1_attachment')) {
                foreach ($request->file('hod_Other1_attachment') as $file) {
                    $name = $request->name . 'hod_Other1_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Other1_attachment = json_encode($files);
        }
          if (!empty ($request->hod_Production_Injection_Attachment)) {
            $files = [];
            if ($request->hasfile('hod_Production_Injection_Attachment')) {
                foreach ($request->file('hod_Production_Injection_Attachment') as $file) {
                    $name = $request->name . 'hod_Production_Injection_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Production_Injection_Attachment = json_encode($files);
        }
        if (!empty ($request->hod_Other2_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Other2_attachment')) {
                foreach ($request->file('hod_Other2_attachment') as $file) {
                    $name = $request->name . 'hod_Other2_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Other2_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Other3_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Other3_attachment')) {
                foreach ($request->file('hod_Other3_attachment') as $file) {
                    $name = $request->name . 'hod_Other3_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Other3_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Other4_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Other4_attachment')) {
                foreach ($request->file('hod_Other4_attachment') as $file) {
                    $name = $request->name . 'hod_Other4_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Other4_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Other5_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Other5_attachment')) {
                foreach ($request->file('hod_Other5_attachment') as $file) {
                    $name = $request->name . 'hod_Other5_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Other5_attachment = json_encode($files);
        }
           if (!empty ($request->hod_ContractGiver_attachment)) {
            $files = [];
            if ($request->hasfile('hod_ContractGiver_attachment')) {
                foreach ($request->file('hod_ContractGiver_attachment') as $file) {
                    $name = $request->name . 'hod_ContractGiver_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_ContractGiver_attachment = json_encode($files);
        }
         if (!empty ($request->hod_Microbiology_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Microbiology_attachment')) {
                foreach ($request->file('hod_Microbiology_attachment') as $file) {
                    $name = $request->name . 'hod_Microbiology_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Microbiology_attachment = json_encode($files);
        }
        $hodCft->save();
        //  dd($management->id);






        // --------------agenda--------------
        $data1 = new ManagementReviewDocDetails();
        $data1->review_id = $management->id;
        $data1->type = "agenda";
        if (!empty($request->date)) {
            $data1->date = serialize($request->date);
        }
        if (!empty($request->topic)) {
            $data1->topic = serialize($request->topic);
        }
        if (!empty($request->responsible)) {
            $data1->responsible = serialize($request->responsible);
        }
        if (!empty($request->start_time)) {
            $data1->start_time = serialize($request->start_time);
        }
        if (!empty($request->end_time)) {
            $data1->end_time = serialize($request->end_time);
        }
        if (!empty($request->comment)) {
            $data1->comment = serialize($request->comment);
        }
        $data1->save();

        $data2 = new ManagementReviewDocDetails();
        $data2->review_id = $management->id;
        $data2->type = "performance_evaluation";
        if (!empty($request->monitoring)) {
            $data2->monitoring = serialize($request->monitoring);
        }
        if (!empty($request->measurement)) {
            $data2->measurement = serialize($request->measurement);
        }
        if (!empty($request->analysis)) {
            $data2->analysis = serialize($request->analysis);
        }
        if (!empty($request->evaluation)) {
            $data2->evaluation = serialize($request->evaluation);
        }
        $data2->save();

        $data3 = new ManagementReviewDocDetails();
        $data3->review_id = $management->id;
        $data3->type = "management_review_participants";
        if (!empty($request->invited_Person)) {
            $data3->invited_Person = serialize($request->invited_Person);
        }
        if (!empty($request->designee)) {
            $data3->designee = serialize($request->designee);
        }
        if (!empty($request->department)) {
            $data3->department = serialize($request->department);
        }
        if (!empty($request->remarks)) {
            $data3->remarks = serialize($request->remarks);
        }
        $data3->save();
        $fieldNames = [
            'invited_Person' => 'Invited Person	',
            'designee' => 'Designation',
            'department' => 'Department',
            'remarks' => 'Remarks'
        ];

        foreach ($request->invited_Person as $index => $invited_Person) {
            // Since this is a new entry, there are no previous details
            $previousDetails = [
                'invited_Person' => null,
                'designee' => null,
                'department' => null,
                'remarks' => null
            ];

            // Current fields values from the request
            $fields = [
                'invited_Person' => $invited_Person,
                'designee' => $request->designee[$index],
                'department' => $request->department[$index],
                'remarks' => $request->remarks[$index],
            ];

            foreach ($fields as $key => $currentValue) {
                // Log changes for new rows (no previous value to compare)
                if (!empty($currentValue)) {
                    // Only create an audit trail entry for new values
                    $history = new ManagementAuditTrial();
                    $history->ManagementReview_id = $management->id;

                    // Set activity type to include field name and row index using the fieldNames array
                    $history->activity_type = $fieldNames[$key] . ' (' . ($index + 1) . ')';

                    // Since this is a new entry, 'Previous' value is null
                    $history->previous = 'null'; // Previous value or 'null'

                    // Assign 'Current' value, which is the new value
                    $history->current = $currentValue; // New value

                    // Comments and user details
                    $history->comment = $request->equipment_comments[$index] ?? '';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = "Not Applicable"; // For new entries, set an appropriate status
                    $history->change_to = "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = "Create";

                    // Save the history record
                    $history->save();
                }
            }
        }

        $data4 = new ManagementReviewDocDetails();
        $data4->review_id = $management->id;
        $data4->type = "action_item_details";

        if (!empty($request->short_desc)) {
            $data4->short_desc = serialize($request->short_desc);
        }
        if (!empty($request->date_due)) {
            $data4->date_due = serialize($request->date_due);
        }
        if (!empty($request->site)) {
            $data4->site = serialize($request->site);
        }
        if (!empty($request->responsible_person)) {
            $data4->responsible_person = serialize($request->responsible_person);
        }
        if (!empty($request->current_status)) {
            $data4->current_status = serialize($request->current_status);
        }
        if (!empty($request->date_closed)) {
            $data4->date_closed = serialize($request->date_closed);
        }
        if (!empty($request->remark)) {
            $data4->remark = serialize($request->remark);
        }
        $data4->save();

        $data5 = new ManagementReviewDocDetails();
        $data5->review_id = $management->id;
        $data5->type = "capa_detail_details";

        if (!empty($request->Details)) {
            $data5->Details = serialize($request->Details);
        }
        if (!empty($request->capa_type)) {
            $data5->capa_type = serialize($request->capa_type);
        }
        if (!empty($request->site2)) {
            $data5->site2 = serialize($request->site2);
        }
        if (!empty($request->responsible_person2)) {
            $data5->responsible_person2 = serialize($request->responsible_person2);
        }
        if (!empty($request->current_status2)) {
            $data5->current_status2 = serialize($request->current_status2);
        }
        if (!empty($request->date_closed2)) {
            $data5->date_closed2 = serialize($request->date_closed2);
        }
        if (!empty($request->remark2)) {
            $data5->remark2 = serialize($request->remark2);
        }
        $data5->save();

            //if (!empty($management->record_number)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Record Number';
            $history->previous = "Null";
            $history->current =Helpers::getDivisionName($management->division_id). '/RA/'. Helpers::year($management->created). '/'.str_pad($management->record, 4, '0', STR_PAD_LEFT);
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        //}

            if (!empty($management->division_code)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Site/Location Code';
            $history->previous = "Null";
            $history->current = $management->division_code;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
            }

            if (!empty($management->initiator_name)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = $management->initiator_name;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
            }

            if (!empty($management->intiation_date)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = "Null";
            $history->current =  Helpers::getdateFormat($management->intiation_date);
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
            }

            if(!empty($management->initiator_Group)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Initiator department';
            $history->previous = "Null";
            $history->current = Helpers::getFullDepartmentName($management->initiator_Group);
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
            }

            if(!empty($management->initiator_group_code)) {
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $management->id;
                $history->activity_type = 'Initiation Department Code';
                $history->previous = "Null";
                $history->current = $management->initiator_group_code;
                $history->comment = "NA";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to= "Opened";
                $history->change_from= "Initiation";
                $history->action_name="Create";
                $history->save();
                }


            if (!empty($management->short_description)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $management->short_description;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
          if (!empty($management->summary_recommendation)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Type';
            $history->previous = "Null";
            $history->current = $management->summary_recommendation;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
          if (!empty($management->review_period_monthly)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Review Period (Monthly)';
            $history->previous = "Null";
            $history->current = $management->review_period_monthly;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($management->review_period_six_monthly)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Review Period (Six Monthly)';
            $history->previous = "Null";
            $history->current = $management->review_period_six_monthly;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
         if (!empty($management->start_date)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Proposed Scheduled Start Date';
            $history->previous = "Null";
            $history->current =Helpers::getdateFormat ( $management->start_date);
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
            }

            if (!empty($management->assign_to)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Invite Person Notify';
            $history->previous = "Null";
            $history->current = $management->assign_to;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
            }

        if (!empty($management->meeting_and_summary_attachment)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Meetings and Summary Attachments';
            $history->previous = "Null";
            $history->current = $management->meeting_and_summary_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

         if (!empty($management->description)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Description';
            $history->previous = "Null";
            $history->current = $management->description;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
          }



         if (!empty($management->inv_attachment)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'GI Attachment';
            $history->previous = "Null";
            $history->current = $management->inv_attachment;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
         if (!empty($management->Operations)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'QA Head Review comment ';
            $history->previous = "Null";
            $history->current = $management->Operations;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
            if (!empty($management->file_attchment_if_any)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'QA Head Review Attachment';
            $history->previous = "Null";
            $history->current = $management->file_attchment_if_any;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        if (!empty($management->external_supplier_performance)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Meeting Start Date';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat ($management->external_supplier_performance);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($management->customer_satisfaction_level)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Meeting End Date';
            $history->previous = "Null";
            $history->current =Helpers::getdateFormat ( $management->customer_satisfaction_level);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($management->budget_estimates)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Meeting Start Time';
            $history->previous = "Null";
            $history->current = $management->budget_estimates;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($management->completion_of_previous_tasks)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Meeting End Time';
            $history->previous = "Null";
            $history->current = $management->completion_of_previous_tasks;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        if (!empty($management->additional_suport_required)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'QA verification Comment';
            $history->previous = "Null";
            $history->current = $management->additional_suport_required;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        if (!empty($management->qa_verification_file)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'QA Verification Attachment';
            $history->previous = "Null";
            $history->current = $management->qa_verification_file;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        if (!empty($management->next_managment_review_date)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Next Management Review Date';
            $history->previous = "Null";
            $history->current =  Helpers::getdateFormat($management->next_managment_review_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        if (!empty($management->conclusion_new)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'QA Head Comment';
            $history->previous = "Null";
            $history->current = $management->conclusion_new;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        if (!empty($management->closure_attachments)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Closure Attachments';
            $history->previous = "Null";
            $history->current = $management->closure_attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }













        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }

    public function manageUpdate(Request $request, $id)
    {

         $form_progress = null;
        // if (!$request->short_description) {
        //     toastr()->error("Short description is required");
        //     return redirect()->back();
        // }
        //  if (!$request->summary_recommendation) {
        //     toastr()->error("Type is required");
        //     return redirect()->back();
        // }
        //  if (!$request->start_date) {
        //     toastr()->error("Proposed Scheduled Start Date is required");
        //     return redirect()->back();
        // }
        // if (!$request->assign_to) {
        //     toastr()->error("Invite Person Notify is required");
        //     return redirect()->back();
        // }
        // // if (!$request->external_supplier_performance) {
        // //     toastr()->error("Meeting End Date is required");
        // //     return redirect()->back();
        // // }
        // if (!$request->customer_satisfaction_level) {
        //     toastr()->error("Meeting Start Date is required");
        //     return redirect()->back();
        // }
        // if (!$request->additional_suport_required) {
        //     toastr()->error("QA verification Comment  is required");
        //     return redirect()->back();
        // }
        // if (!$request->conclusion_new) {
        //     toastr()->error("QA Head Comment is required");
        //     return redirect()->back();
        // }
        $lastDocument = ManagementReview::find($id);
        $management = ManagementReview::find($id);
            $changeControl = ManagementReview::find($id);

        $lastCft = managementCft::where('ManagementReview_id', $management->id)->first();
        $lastCft = hodmanagementCft::where('ManagementReview_id', $management->id)->first();
        $Cft = managementCft::where('ManagementReview_id', $id)->first();
        $hodCft = hodmanagementCft::where('ManagementReview_id', $id)->first();

        // $management->initiator_id = Auth::user()->id;
        // $changeControl->form_progress = isset($form_progress) ? $form_progress : null;

        $management->division_code = $request->division_code;
        // $management->Initiator_id= $request->Initiator_id;
        $management->short_description = $request->short_description;
        // $management->assign_to = $request->assign_to;
        // $management->assign_to = implode(',', $request->assign_to);
        // $management->assign_to = explode(',', $management->assign_to ?? '');
        if (is_array($request->assign_to)) {
            $management->assign_to = implode(',', $request->assign_to);
        } else {
            $management->assign_to = null; // Or handle it according to your logic
        }




        $management->form_progress = isset($form_progress) ? $form_progress : null;

        $management->due_date = $request->due_date;
        $management->type = $request->type;
        $management->start_date = $request->start_date;
        $management->end_date = $request->end_date;
        $management->attendees = $request->attendees;
        $management->agenda = $request->agenda;
        $management->performance_evaluation = $request->performance_evaluation;
       $management->management_review_participants = $management->management_review_participants;
       $management->action_item_details =$request->action_item_details;
       $management->capa_detail_details = $request->capa_detail_details;
        $management->description = $request->description;
        $management->attachment = $request->attachment;
        // $management->inv_attachment = json_encode($request->inv_attachment);
        $management->actual_start_date = $request->actual_start_date;
        $management->actual_end_date = $request->actual_end_date;
        $management->meeting_minute = $request->meeting_minute;
        $management->decision = $request->decision;
        $management->zone = $request->zone;
        $management->country = $request->country;
        $management->city = $request->city;
        $management->site_name = $request->site_name;
        $management->building = $request->building;
        $management->floor = $request->floor;
        $management->room = $request->room;
        $management->priority_level = $request->priority_level;
        // $management->file_attchment_if_any = json_encode($request->file_attchment_if_any);
        // $management->assign_to = $request->assign_to;
        $management->initiator_group_code= $request->initiator_group_code;
        $management->Operations= $request->Operations;
        // $management->initiator_Group= $request->initiator_Group;
        $management->requirement_products_services = $request->requirement_products_services;
        $management->design_development_product_services = $request->design_development_product_services;
        $management->control_externally_provide_services = $request->control_externally_provide_services;
        $management->production_service_provision= $request->production_service_provision;
        $management->release_product_services = $request->release_product_services;
       $management->control_nonconforming_outputs = $request->control_nonconforming_outputs;
         $management->external_supplier_performance = $request->external_supplier_performance;
         $management->customer_satisfaction_level = $request->customer_satisfaction_level;
         $management->budget_estimates = $request->budget_estimates;
         $management->completion_of_previous_tasks = $request->completion_of_previous_tasks;
         $management->production_new = $request->production_new;
         $management->plans_new = $request->plans_new;
         $management->forecast_new = $request->forecast_new;
         $management->additional_suport_required = $request->additional_suport_required;
         $management->next_managment_review_date = $request->next_managment_review_date;
         $management->forecast_new = $request->forecast_new;
         $management->conclusion_new = $request->conclusion_new;
         $management->summary_recommendation = $request->summary_recommendation;
         $management->due_date_extension= $request->due_date_extension;
         $management->risk_opportunities= $request->risk_opportunities;
         $management->review_period_monthly = $request->review_period_monthly;
        $management->review_period_six_monthly = $request->review_period_six_monthly;
        //  if (!empty($request->inv_attachment)) {
        //     $files = [];
        //     if ($request->hasfile('inv_attachment')) {
        //         foreach ($request->file('inv_attachment') as $file) {
        //             $name = $request->name . 'inv_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $management->inv_attachment = json_encode($files);
        // }

        //    $attachments = json_decode($management->inv_attachment, true) ?? [];
        // Handle file removals


            if($management->stage == 3 || $management->stage == 4 ){


            if (!$form_progress) {
                $form_progress = 'cft';
            }

            $Cft = managementCft::withoutTrashed()->where('ManagementReview_id', $id)->first();
            if($Cft && $management->stage == 4 ){
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


                $IsCFTRequired = managementCft_Response::withoutTrashed()->where(['is_required' => 1, 'ManagementReview_id' => $id])->latest()->first();
                $cftUsers = DB::table('management_cfts')->where(['ManagementReview_id' => $id])->first();
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
                                    ['data' => $management],
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
                 if($management->stage == 3 || $management->stage == 5 ){


                    if (!$form_progress) {
                        $form_progress = 'cft';
                    }

                           $hodCft = hodmanagementCft::withoutTrashed()->where('ManagementReview_id', $id)->first();
                         if($hodCft && $management->stage == 5 ){



            $hodCft->hod_Production_Table_Review = $request->hod_Production_Table_Review == null ? $hodCft->hod_Production_Table_Review : $request->hod_Production_Table_Review;
            $hodCft->hod_Production_Table_Person = $request->hod_Production_Table_Person == null ? $hodCft->hod_Production_Table_Person : $request->hod_Production_Table_Person;


            $hodCft->hod_Production_Injection_Review = $request->hod_Production_Injection_Review == null ? $hodCft->hod_Production_Injection_Review : $request->hod_Production_Injection_Review;
            $hodCft->hod_Production_Injection_Person = $request->hod_Production_Injection_Person == null ? $hodCft->hod_Production_Injection_Person : $request->hod_Production_Injection_Person;

            $hodCft->hod_ProductionLiquid_Review = $request->hod_ProductionLiquid_Review == null ? $hodCft->hod_ProductionLiquid_Review : $request->hod_ProductionLiquid_Review;
            $hodCft->hod_ProductionLiquid_person = $request->hod_ProductionLiquid_person == null ? $hodCft->hod_ProductionLiquid_person : $request->hod_ProductionLiquid_person;

            $hodCft->hod_Store_person = $request->hod_Store_person == null ? $hodCft->hod_Store_person : $request->hod_Store_person;
            $hodCft->hod_Store_Review = $request->hod_Store_Review == null ? $hodCft->hod_Store_Review : $request->hod_Store_Review;

            $hodCft->hod_ResearchDevelopment_person = $request->hod_ResearchDevelopment_person == null ? $hodCft->hod_ResearchDevelopment_person : $request->hod_ResearchDevelopment_person;
            $hodCft->hod_ResearchDevelopment_Review = $request->hod_ResearchDevelopment_Review == null ? $hodCft->hod_ResearchDevelopment_Review : $request->hod_ResearchDevelopment_Review;

            $hodCft->hod_Microbiology_person = $request->hod_Microbiology_person == null ? $hodCft->hod_Microbiology_person : $request->hod_Microbiology_person;
            $hodCft->hod_Microbiology_Review = $request->hod_Microbiology_Review == null ? $hodCft->hod_Microbiology_Review : $request->hod_Microbiology_Review;

            $hodCft->hod_RegulatoryAffair_person = $request->hod_RegulatoryAffair_person == null ? $hodCft->hod_RegulatoryAffair_person : $request->hod_RegulatoryAffair_person;
            $hodCft->hod_RegulatoryAffair_Review = $request->hod_RegulatoryAffair_Review == null ? $hodCft->hod_RegulatoryAffair_Review : $request->hod_RegulatoryAffair_Review;

            $hodCft->hod_CorporateQualityAssurance_person = $request->hod_CorporateQualityAssurance_person == null ? $hodCft->hod_CorporateQualityAssurance_person : $request->hod_CorporateQualityAssurance_person;
            $hodCft->hod_CorporateQualityAssurance_Review = $request->hod_CorporateQualityAssurance_Review == null ? $hodCft->hod_CorporateQualityAssurance_Review : $request->hod_CorporateQualityAssurance_Review;

            $hodCft->hod_ContractGiver_person = $request->hod_ContractGiver_person == null ? $hodCft->hod_ContractGiver_person : $request->hod_ContractGiver_person;
            $hodCft->hod_ContractGiver_Review = $request->hod_ContractGiver_Review == null ? $hodCft->hod_ContractGiver_Review : $request->hod_ContractGiver_Review;

            $hodCft->hod_Quality_review = $request->hod_Quality_review == null ? $hodCft->hod_Quality_review : $request->hod_Quality_review;
            $hodCft->hod_Quality_Control_Person = $request->hod_Quality_Control_Person == null ? $hodCft->hod_Quality_Control_Person : $request->hod_Quality_Control_Person;

            $hodCft->hod_Quality_Assurance_Review = $request->hod_Quality_Assurance_Review == null ? $hodCft->hod_Quality_Assurance_Review : $request->hod_Quality_Assurance_Review;
            $hodCft->hod_QualityAssurance_person = $request->hod_QualityAssurance_person == null ? $hodCft->hod_QualityAssurance_person : $request->hod_QualityAssurance_person;

            $hodCft->hod_Engineering_review = $request->hod_Engineering_review == null ? $hodCft->hod_Engineering_review : $request->hod_Engineering_review;
            $hodCft->hod_Engineering_person = $request->hod_Engineering_person == null ? $hodCft->hod_Engineering_person : $request->hod_Engineering_person;

            $hodCft->hod_Environment_Health_review = $request->Environment_Health_review == null ? $hodCft->hod_Environment_Health_review : $request->hod_Environment_Health_review;
            $hodCft->hod_Environment_Health_Safety_person = $request->Environment_Health_Safety_person == null ? $hodCft->hod_Environment_Health_Safety_person : $request->hod_Environment_Health_Safety_person;

            $hodCft->hod_Human_Resource_review = $request->hod_Human_Resource_review == null ? $hodCft->hod_Human_Resource_review : $request->hod_Human_Resource_review;
            $hodCft->hod_Human_Resource_person = $request->hod_Human_Resource_person == null ? $hodCft->hod_Human_Resource_person : $request->hod_Human_Resource_person;

            $hodCft->hod_Other1_review = $request->hod_Other1_review == null ? $hodCft->hod_Other1_review : $request->hod_Other1_review;
            $hodCft->hod_Other1_person = $request->hod_Other1_person == null ? $hodCft->hod_Other1_person : $request->hod_Other1_person;

            $hodCft->hod_Other2_review = $request->hod_Other2_review == null ? $hodCft->hod_Other2_review : $request->hod_Other2_review;
            $hodCft->hod_Other2_person = $request->hod_Other2_person == null ? $hodCft->hod_Other2_person : $request->hod_Other2_person;

            $hodCft->hod_Other3_review = $request->hod_Other3_review == null ? $hodCft->hod_Other3_review : $request->hod_Other3_review;
            $hodCft->hod_Other3_person = $request->hod_Other3_person == null ? $hodCft->hod_Other3_person : $request->hod_Other3_person;

            $hodCft->hod_Other4_review = $request->hod_Other4_review == null ? $hodCft->hod_Other4_review : $request->hod_Other4_review;
            $hodCft->hod_Other4_person = $request->hod_Other4_person == null ? $hodCft->hod_Other4_person : $request->hod_Other4_person;

            $hodCft->hod_Other5_review = $request->hod_Other5_review == null ? $hodCft->hod_Other5_review : $request->hod_Other5_review;
            $hodCft->hod_Other5_person = $request->hod_Other5_person == null ? $hodCft->hod_Other5_person : $request->hod_Other5_person;

            }
            else{

            $hodCft->hod_Production_Table_Review = $request->hod_Production_Table_Review;
            $hodCft->hod_Production_Table_Person = $request->hod_Production_Table_Person;

            $hodCft->hod_Production_Injection_Review = $request->hod_Production_Injection_Review;
            $hodCft->hod_Production_Injection_Person = $request->hod_Production_Injection_Person;

            $hodCft->hod_ProductionLiquid_person = $request->hod_ProductionLiquid_person;
            $hodCft->hod_ProductionLiquid_Review = $request->hod_ProductionLiquid_Review;

            $hodCft->hod_Store_person = $request->hod_Store_person;
            $hodCft->hod_Store_Review = $request->hod_Store_Review;

            $hodCft->hod_ResearchDevelopment_person = $request->hod_ResearchDevelopment_person;
            $hodCft->hod_ResearchDevelopment_Review = $request->hod_ResearchDevelopment_Review;

            $hodCft->hod_Microbiology_person = $request->hod_Microbiology_person;
            $hodCft->hod_Microbiology_Review = $request->hod_Microbiology_Review;

            $hodCft->hod_RegulatoryAffair_person = $request->hod_RegulatoryAffair_person;
            $hodCft->hod_RegulatoryAffair_Review = $request->hod_RegulatoryAffair_Review;

            $hodCft->hod_CorporateQualityAssurance_person = $request->hod_CorporateQualityAssurance_person;
            $hodCft->hod_CorporateQualityAssurance_Review = $request->hod_CorporateQualityAssurance_Review;

            $hodCft->hod_ContractGiver_person = $request->hod_ContractGiver_person;
            $hodCft->hod_ContractGiver_Review = $request->hod_ContractGiver_Review;

            $hodCft->hod_Quality_review = $request->hod_Quality_review;
            $hodCft->hod_Quality_Control_Person = $request->hod_Quality_Control_Person;

            $hodCft->hod_Quality_Assurance_Review = $request->hod_Quality_Assurance_Review;
            $hodCft->hod_QualityAssurance_person = $request->hod_QualityAssurance_person;

            $hodCft->hod_Engineering_review = $request->hod_Engineering_review;
            $hodCft->hod_Engineering_person = $request->hod_Engineering_person;

            $hodCft->hod_Environment_Health_review = $request->hod_Environment_Health_review;
            $hodCft->hod_Environment_Health_Safety_person = $request->hod_Environment_Health_Safety_person;

            $hodCft->hod_Human_Resource_review = $request->hod_Human_Resource_review;
            $hodCft->hod_Human_Resource_person = $request->hod_Human_Resource_person;

            $hodCft->hod_Project_management_review = $request->hod_Project_management_review;
            $hodCft->hod_Project_management_person = $request->hod_Project_management_person;

            $hodCft->hod_Other1_review = $request->hod_Other1_review;
            $hodCft->hod_Other1_person = $request->hod_Other1_person;

            $hodCft->hod_Other2_review = $request->hod_Other2_review;
            $hodCft->hod_Other2_person = $request->hod_Other2_person;

            $hodCft->hod_Other3_review = $request->hod_Other3_review;
            $hodCft->hod_Other3_person = $request->hod_Other3_person;

            $hodCft->hod_Other4_review = $request->hod_Other4_review;
            $hodCft->hod_Other4_person = $request->hod_Other4_person;

            $hodCft->hod_Other5_review = $request->hod_Other5_review;
            $hodCft->hod_Other5_person = $request->hod_Other5_person;
            }

            // $hodCft->hod_Warehouse_feedback = $request->hod_Warehouse_feedback;
            // $hodCft->hod_Warehouse_assessment = $request->hod_Warehouse_assessment;

            $hodCft->hod_Production_Table_Feedback = $request->hod_Production_Table_Feedback;
            $hodCft->hod_Production_Table_Assessment = $request->hod_Production_Table_Assessment;

            $hodCft->hod_Production_Injection_Assessment = $request->hod_Production_Injection_Assessment;
            $hodCft->hod_Production_Injection_Feedback = $request->hod_Production_Injection_Feedback;

            $hodCft->hod_ProductionLiquid_feedback = $request->hod_ProductionLiquid_feedback;
            $hodCft->hod_ProductionLiquid_assessment = $request->hod_ProductionLiquid_assessment;

            $hodCft->hod_Store_feedback = $request->hod_Store_feedback;
            $hodCft->hod_Store_assessment = $request->hod_Store_assessment;

            $hodCft->hod_ResearchDevelopment_feedback = $request->hod_ResearchDevelopment_feedback;
            $hodCft->hod_ResearchDevelopment_assessment = $request->hod_ResearchDevelopment_assessment;

            $hodCft->hod_Microbiology_feedback = $request->hod_Microbiology_feedback;
            $hodCft->hod_Microbiology_assessment = $request->hod_Microbiology_assessment;

            $hodCft->hod_RegulatoryAffair_feedback = $request->hod_RegulatoryAffair_feedback;
            $hodCft->hod_RegulatoryAffair_assessment = $request->hod_RegulatoryAffair_assessment;

            $hodCft->hod_CorporateQualityAssurance_feedback = $request->hod_CorporateQualityAssurance_feedback;
            $hodCft->hod_CorporateQualityAssurance_assessment = $request->hod_CorporateQualityAssurance_assessment;

            $hodCft->hod_ContractGiver_feedback = $request->hod_ContractGiver_feedback;
            $hodCft->hod_ContractGiver_assessment = $request->hod_ContractGiver_assessment;

            $hodCft->hod_Quality_Control_assessment = $request->hod_Quality_Control_assessment;
            $hodCft->hod_Quality_Control_feedback = $request->hod_Quality_Control_feedback;

            $hodCft->hod_QualityAssurance_assessment = $request->hod_QualityAssurance_assessment;
            $hodCft->hod_QualityAssurance_feedback = $request->hod_QualityAssurance_feedback;

            $hodCft->hod_Engineering_assessment = $request->hod_Engineering_assessment;
            $hodCft->hod_Engineering_feedback = $request->hod_Engineering_feedback;

            $hodCft->hod_Health_Safety_assessment = $request->hod_Health_Safety_assessment;
            $hodCft->hod_Health_Safety_feedback = $request->hod_Health_Safety_feedback;

            $hodCft->hod_Human_Resource_assessment = $request->hod_Human_Resource_assessment;
            $hodCft->hod_Human_Resource_feedback = $request->hod_Human_Resource_feedback;

            // $hodCft->hod_Other1_assessment = $request->hod_Other1_assessment;
            $hodCft->hod_Other1_feedback = $request->hod_Other1_feedback;

            // $hodCft->hod_Other2_Assessment = $request->hod_Other2_Assessment;
            $hodCft->hod_Other2_feedback = $request->hod_Other2_feedback;

            // $hodCft->hod_Other3_Assessment = $request->hod_Other3_Assessment;
            $hodCft->hod_Other3_feedback = $request->hod_Other3_feedback;

            // $hodCft->hod_Other4_Assessment = $request->hod_Other4_Assessment;
            $hodCft->Other4_feedback = $request->Other4_feedback;

            // $hodCft->hod_Other5_Assessment = $request->hod_Other5_Assessment;
            $hodCft->hod_Other5_feedback = $request->hod_Other5_feedback;


            if (!empty ($request->hod_ContractGiver_attachment)) {
            $files = [];
            if ($request->hasfile('hod_ContractGiver_attachment')) {
                foreach ($request->file('hod_ContractGiver_attachment') as $file) {
                    $name = $request->name . 'hod_ContractGiver_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_ContractGiver_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Microbiology_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Microbiology_attachment')) {
                foreach ($request->file('hod_Microbiology_attachment') as $file) {
                    $name = $request->name . 'hod_Microbiology_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Microbiology_attachment = json_encode($files);
        }
        if (!empty ($request->hod_CorporateQualityAssurance_attachment)) {
            $files = [];
            if ($request->hasfile('hod_CorporateQualityAssurance_attachment')) {
                foreach ($request->file('hod_CorporateQualityAssurance_attachment') as $file) {
                    $name = $request->name . 'hod_CorporateQualityAssurance_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_CorporateQualityAssurance_attachment = json_encode($files);
        }
        if (!empty ($request->hod_ResearchDevelopment_attachment)) {
            $files = [];
            if ($request->hasfile('hod_ResearchDevelopment_attachment')) {
                foreach ($request->file('hod_ResearchDevelopment_attachment') as $file) {
                    $name = $request->name . 'hod_ResearchDevelopment_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_ResearchDevelopment_attachment = json_encode($files);
        }

          if (!empty ($request->hod_Store_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Store_attachment')) {
                foreach ($request->file('hod_Store_attachment') as $file) {
                    $name = $request->name . 'hod_Store_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Store_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Quality_Assurance_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Quality_Assurance_attachment')) {
                foreach ($request->file('hod_Quality_Assurance_attachment') as $file) {
                    $name = $request->name . 'hod_Quality_Assurance_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Quality_Assurance_attachment = json_encode($files);
        }
         if (!empty ($request->hod_Quality_Control_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Quality_Control_attachment')) {
                foreach ($request->file('hod_Quality_Control_attachment') as $file) {
                    $name = $request->name . 'hod_Quality_Control_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Quality_Control_attachment = json_encode($files);
        }
         if (!empty ($request->hod_Production_Table_Attachment)) {
            $files = [];
            if ($request->hasfile('hod_Production_Table_Attachment')) {
                foreach ($request->file('hod_Production_Table_Attachment') as $file) {
                    $name = $request->name . 'hod_Production_Table_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Production_Table_Attachment = json_encode($files);
        }
        if (!empty ($request->hod_RegulatoryAffair_attachment)) {
            $files = [];
            if ($request->hasfile('hod_RegulatoryAffair_attachment')) {
                foreach ($request->file('hod_RegulatoryAffair_attachment') as $file) {
                    $name = $request->name . 'hod_RegulatoryAffair_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_RegulatoryAffair_attachment = json_encode($files);
        }

          if (!empty ($request->hod_Production_Injection_Attachment)) {
            $files = [];
            if ($request->hasfile('hod_Production_Injection_Attachment')) {
                foreach ($request->file('hod_Production_Injection_Attachment') as $file) {
                    $name = $request->name . 'hod_Production_Injection_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Production_Injection_Attachment = json_encode($files);
        }
        if (!empty ($request->hod_Engineering_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Engineering_attachment')) {
                foreach ($request->file('hod_Engineering_attachment') as $file) {
                    $name = $request->name . 'hod_Engineering_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Engineering_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Analytical_Development_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Analytical_Development_attachment')) {
                foreach ($request->file('hod_Analytical_Development_attachment') as $file) {
                    $name = $request->name . 'hod_Analytical_Development_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Analytical_Development_attachment = json_encode($files);
        }

        if (!empty ($request->hod_Technology_transfer_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Technology_transfer_attachment')) {
                foreach ($request->file('hod_Technology_transfer_attachment') as $file) {
                    $name = $request->name . 'hod_Technology_transfer_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Technology_transfer_attachment = json_encode($files);
        }
         if (!empty ($request->hod_ProductionLiquid_attachment)) {
            $files = [];
            if ($request->hasfile('hod_ProductionLiquid_attachment')) {
                foreach ($request->file('hod_ProductionLiquid_attachment') as $file) {
                    $name = $request->name . 'hod_ProductionLiquid_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_ProductionLiquid_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Environment_Health_Safety_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Environment_Health_Safety_attachment')) {
                foreach ($request->file('hod_Environment_Health_Safety_attachment') as $file) {
                    $name = $request->name . 'hod_Environment_Health_Safety_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Environment_Health_Safety_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Human_Resource_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Human_Resource_attachment')) {
                foreach ($request->file('hod_Human_Resource_attachment') as $file) {
                    $name = $request->name . 'hod_Human_Resource_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Human_Resource_attachment = json_encode($files);
        }
        // if (!empty ($request->Information_Technology_attachment)) {
        if (!empty ($request->hod_Project_management_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Project_management_attachment')) {
                foreach ($request->file('hod_Project_management_attachment') as $file) {
                    $name = $request->name . 'hod_Project_management_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Project_management_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Other1_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Other1_attachment')) {
                foreach ($request->file('hod_Other1_attachment') as $file) {
                    $name = $request->name . 'hod_Other1_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Other1_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Other2_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Other2_attachment')) {
                foreach ($request->file('hod_Other2_attachment') as $file) {
                    $name = $request->name . 'hod_Other2_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Other2_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Other3_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Other3_attachment')) {
                foreach ($request->file('hod_Other3_attachment') as $file) {
                    $name = $request->name . 'hod_Other3_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Other3_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Other4_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Other4_attachment')) {
                foreach ($request->file('hod_Other4_attachment') as $file) {
                    $name = $request->name . 'hod_Other4_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Other4_attachment = json_encode($files);
        }
        if (!empty ($request->hod_Other5_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Other5_attachment')) {
                foreach ($request->file('hod_Other5_attachment') as $file) {
                    $name = $request->name . 'hod_Other5_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $hodCft->hod_Other5_attachment = json_encode($files);
        }



            $hodCft->save();
            $IsCFTRequired = hodmanagementCft_Response::withoutTrashed()->where(['is_required' => 1, 'ManagementReview_id' => $id])->latest()->first();
                $hodcftUsers = DB::table('hodmanagement_cfts')->where(['ManagementReview_id' => $id])->first();
                // Define the column names
                $columns2 = ['hod_Quality_Control_Person', 'hod_QualityAssurance_person', 'hod_Engineering_person', 'hod_Environment_Health_Safety_person', 'hod_Human_Resource_person', 'hod_Other1_person', 'hod_Other2_person', 'hod_Other3_person', 'hod_Other4_person', 'hod_Other5_person', 'hod_Production_Table_Person','hod_ProductionLiquid_person','hod_Production_Injection_Person','hod_Store_person','hod_ResearchDevelopment_person','hod_Microbiology_person','hod_RegulatoryAffair_person','hod_CorporateQualityAssurance_person','hod_ContractGiver_person'];

                // Initialize an array to store the values
                $valuesArray = [];

                foreach ($columns2 as $index => $column) {
                    $value = $hodcftUsers->$column;
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
                                    ['data' => $management],
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
            $attachments = json_decode($management->inv_attachment, true) ?? [];


            if (!empty ($request->Initial_attachment)) {
                $files = [];

                if ($management->Initial_attachment) {
                    $files = is_array(json_decode($management->Initial_attachment)) ? $management->Initial_attachment : [];
                }

                if ($request->hasfile('Initial_attachment')) {
                    foreach ($request->file('Initial_attachment') as $file) {
                        $name = $request->name . 'Initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }


                $management->Initial_attachment = json_encode($files);
            }

        if ($request->has('removed_files')) {
            $removedFiles = explode(',', $request->input('removed_files'));
            foreach ($removedFiles as $removedFile) {
                if (($key = array_search($removedFile, $attachments)) !== false) {
                    unset($attachments[$key]);
                    // Optionally, delete the file from the server
                    if (file_exists(public_path('upload/' . $removedFile))) {
                        unlink(public_path('upload/' . $removedFile));
                    }
                }
            }
        }
        // Handle new file uploads
        // if ($request->hasfile('inv_attachment')) {
        //     $files = [];
        //     foreach ($request->file('inv_attachment') as $file) {
        //         $name = $request->name . 'inv_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //         $file->move('upload/', $name);
        //         $files[] = $name;
        //     }
        //     // Merge the new files with the existing ones
        //     $attachments = array_merge($attachments, $files);
        // }
        // Save the updated attachments list
        // $management->inv_attachment = json_encode(array_values($attachments));






        //  if (!empty($request->inv_attachment)) {
        //     $files = [];
        //     if ($request->hasfile('inv_attachment')) {
        //         foreach ($request->file('inv_attachment') as $file) {
        //             $name = $request->name . 'inv_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $management->inv_attachment = json_encode($files);
        // }
        if (!empty($request->inv_attachment) || !empty($request->deleted_inv_attachment)) {
     $existingFiles = json_decode($management->inv_attachment, true) ?? [];

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
            $name = $request->name . 'GI Attachment' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    // Merge existing and new files
    $allFiles = array_merge($existingFiles, $newFiles);
    $management->inv_attachment = json_encode($allFiles);
}

        // if (!empty($request->file_attchment_if_any)) {
        //     $files = [];
        //     if ($request->hasfile('file_attchment_if_any')) {
        //         foreach ($request->file('file_attchment_if_any') as $file) {
        //             $name = $request->name . 'file_attchment_if_any' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $management->file_attchment_if_any = json_encode($files);
        // }
        if (!empty($request->file_attchment_if_any) || !empty($request->deleted_file_attchment_if_any)) {
    $existingFiles = json_decode($management->file_attchment_if_any, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_file_attchment_if_any)) {
        $filesToDelete = explode(',', $request->deleted_file_attchment_if_any);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new files
    $newFiles = [];
    if ($request->hasFile('file_attchment_if_any')) {
        foreach ($request->file('file_attchment_if_any') as $file) {
            $name = $request->name . 'file_attchment_if_any' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    // Merge existing and new files
    $allFiles = array_merge($existingFiles, $newFiles);
    $management ->file_attchment_if_any = json_encode($allFiles);
}
        // if (!empty($request->closure_attachments)) {
        //     $files = [];
        //     if ($request->hasfile('closure_attachments')) {
        //         foreach ($request->file('closure_attachments') as $file) {
        //             $name = $request->name . 'closure_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $management->closure_attachments = json_encode($files);
        // }
        if (!empty($request->closure_attachments) || !empty($request->deleted_closure_attachments)) {
    $existingFiles = json_decode($management->closure_attachments, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_closure_attachments)) {
        $filesToDelete = explode(',', $request->deleted_closure_attachments);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new files
    $newFiles = [];
    if ($request->hasFile('closure_attachments')) {
        foreach ($request->file('closure_attachments') as $file) {
            $name = $request->name . 'closure_attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    // Merge existing and new files
    $allFiles = array_merge($existingFiles, $newFiles);
    $management->closure_attachments = json_encode($allFiles);
}
if (!empty($request->meeting_and_summary_attachment) || !empty($request->deleted_meeting_and_summary_attachment)) {
    $existingFiles = json_decode($management->meeting_and_summary_attachment, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_meeting_and_summary_attachment)) {
        $filesToDelete = explode(',', $request->deleted_meeting_and_summary_attachment);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new files
    $newFiles = [];
    if ($request->hasFile('meeting_and_summary_attachment')) {
        foreach ($request->file('meeting_and_summary_attachment') as $file) {
            $name = $request->name . 'meeting_and_summary_attachment' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    // Merge existing and new files
    $allFiles = array_merge($existingFiles, $newFiles);
    $management->meeting_and_summary_attachment = json_encode($allFiles);
}



             if (!empty($request->cft_hod_attach)) {
            $files = [];
            if ($request->hasfile('cft_hod_attach')) {
                foreach ($request->file('cft_hod_attach') as $file) {
                    $name = $request->name . 'cft_hod_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $management->cft_hod_attach= json_encode($files);
        }
        // if (!empty($request->qa_verification_file)) {
        //     $files = [];
        //     if ($request->hasfile('qa_verification_file')) {
        //         foreach ($request->file('qa_verification_file') as $file) {
        //             $name = $request->name . 'qa_verification_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }

        //     $management->qa_verification_file= json_encode($files);
        // }
        if (!empty($request->qa_verification_file) || !empty($request->deleted_qa_verification_file)) {
    $existingFiles = json_decode($management->qa_verification_file, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_qa_verification_file)) {
        $filesToDelete = explode(',', $request->deleted_qa_verification_file);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new files
    $newFiles = [];
    if ($request->hasFile('qa_verification_file')) {
        foreach ($request->file('qa_verification_file') as $file) {
            $name = $request->name . 'qa_verification_file' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    // Merge existing and new files
    $allFiles = array_merge($existingFiles, $newFiles);
    $management->qa_verification_file = json_encode($allFiles);
}

        $management->update();

        if ($lastDocument->short_description != $management->short_description || !empty($request->short_desc_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Short Description')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastDocument->short_description;
            $history->current = $management->short_description;
            $history->comment = $request->short_desc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
           if($lastDocument->initiator_Group !=$management->initiator_Group || !empty($request->initiator_Group_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Initiator Department')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Initiator Department';
            $history->previous =  Helpers::getFullDepartmentName($lastDocument->initiator_Group);
            $history->current =Helpers::getFullDepartmentName( $management->initiator_Group);
            $history->comment = $request->initiator_Group_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
          if($lastDocument->initiator_group_code != $management->initiator_group_code || !empty($request->initiator_group_code_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Initiator Department Code')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Initiator Department Code';
            $history->previous =  $lastDocument->initiator_group_code;
            $history->current = $management->initiator_group_code;
            $history->comment = $request->initiator_group_code_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
            if($lastDocument->summary_recommendation !=$management->summary_recommendation || !empty($request->summary_recommendation_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Type')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Type';
            $history->previous =  $lastDocument->summary_recommendation;
            $history->current = $management->summary_recommendation;
            $history->comment = $request->summary_recommendation_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
            if($lastDocument->review_period_monthly !=$management->review_period_monthly || !empty($request->review_period_monthly_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Review Period (Monthly)')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Review Period (Monthly)';
            $history->previous =  $lastDocument->review_period_monthly;
            $history->current = $management->review_period_monthly;
            $history->comment = $request->review_period_monthly_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
         if($lastDocument->review_period_six_monthly !=$management->review_period_six_monthly || !empty($request->review_period_six_monthly_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Review Period (Six Monthly)')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Review Period (Six Monthly)';
            $history->previous =  $lastDocument->review_period_six_monthly;
            $history->current = $management->review_period_six_monthly;
            $history->comment = $request->review_period_six_monthly_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
             if ($lastDocument->start_date != $management->start_date || !empty($request->start_date_comment)) {
        $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Proposed Scheduled Start Date')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Proposed Scheduled Start Date';
            $history->previous =Helpers::getdateFormat ( $lastDocument->start_date);
            $history->current = Helpers::getdateFormat ($management->start_date);
            $history->comment = $request->start_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDocument->assign_to != $management->assign_to || !empty($request->assign_to_comment)) {
         $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Invite Person Notify')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Invite Person Notify';
            $history->previous = $lastDocument->assign_to;
            $history->current = $management->assign_to;
            $history->comment = $request->assign_to_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
          if ($lastDocument->description != $management->description || !empty($request->description_comment)) {
           $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Description')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Description';
            $history->previous = $lastDocument->description;
            $history->current = $management->description;
            $history->comment = $request->description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
         if ($lastDocument->inv_attachment != $management->inv_attachment || !empty($request->inv_attachment_comment)) {
        $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'GI Attachment')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'GI Attachment';
            $history->previous = $lastDocument->inv_attachment;
            $history->current = $management->inv_attachment;
            $history->comment = $request->inv_attachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
            if($lastDocument->Operations !=$management->Operations || !empty($request->Operations_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'QA Head Review comment ')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'QA Head Review comment ';
            $history->previous =  $lastDocument->Operations;
            $history->current = $management->Operations;
            $history->comment = $request->Operations_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
              if ($lastDocument->file_attchment_if_any != $management->file_attchment_if_any || !empty($request->file_attchment_if_any_comment)) {
         $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'QA Head Review Attachment')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'QA Head Review Attachment';
            $history->previous = $lastDocument->file_attchment_if_any;
            $history->current = $management->file_attchment_if_any;
            $history->comment = $request->file_attchment_if_any_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
                if($lastDocument->external_supplier_performance !=$management->external_supplier_performance || !empty($request->external_supplier_performance_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Meeting Start Date')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Meeting Start Date';
            $history->previous = Helpers::getdateFormat ( $lastDocument->external_supplier_performance);
            $history->current =Helpers::getdateFormat ( $management->external_supplier_performance);
            $history->comment = $request->external_supplier_performance_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
             if($lastDocument->customer_satisfaction_level !=$management->customer_satisfaction_level || !empty($request->customer_satisfaction_level_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Meeting End Date')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Meeting End Date';
            $history->previous = Helpers::getdateFormat ( $lastDocument->customer_satisfaction_level);
            $history->current =Helpers::getdateFormat ( $management->customer_satisfaction_level);
            $history->comment = $request->customer_satisfaction_level_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
            if($lastDocument->budget_estimates !=$management->budget_estimates || !empty($request->budget_estimates_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Meeting Start Time')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Meeting Start Time';
            $history->previous =  $lastDocument->budget_estimates;
            $history->current = $management->budget_estimates;
            $history->comment = $request->budget_estimates_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
         if($lastDocument->completion_of_previous_tasks !=$management->completion_of_previous_tasks || !empty($request->completion_of_previous_tasks_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Meeting End Time')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Meeting End Time';
            $history->previous =  $lastDocument->completion_of_previous_tasks;
            $history->current = $management->completion_of_previous_tasks;
            $history->comment = $request->completion_of_previous_tasks_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
            /*************** Quality Assurance ***************/
        if ($lastCft->Quality_Assurance_Review != $request->Quality_Assurance_Review && $request->Quality_Assurance_Review != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Quality Assurance Review Action Required';
            $history->previous = $lastCft->Quality_Assurance_Review;
            $history->current = $request->Quality_Assurance_Review;
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
         if ($lastCft->hod_QualityAssurance_person != $request->hod_QualityAssurance_person && $request->hod_QualityAssurance_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Quality Assurance Person';
            $history->previous = $lastCft->hod_QualityAssurance_person;
            $history->current = $request->hod_QualityAssurance_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_QualityAssurance_person) || $lastCft->hod_QualityAssurance_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_assessment != $request->QualityAssurance_assessment && $request->QualityAssurance_assessment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Quality Assurance Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Quality Assurance Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Quality Assurance Attachment';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Quality Assurance Review Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Quality Assurance Review Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Action Required';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Person';
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
        if ($lastCft->hod_Production_Table_Person != $request->hod_Production_Table_Person && $request->hod_Production_Table_Person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Production Tablet/Capsule/Powder Person';
            $history->previous = $lastCft->hod_Production_Table_Person;
            $history->current = $request->hod_Production_Table_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Production_Table_Person) || $lastCft->hod_Production_Table_Person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_Assessment != $request->Production_Table_Assessment && $request->Production_Table_Assessment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Attachment';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Action By';
            $history->previous = $lastCft->Production_Table_By;
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Tablet/Capsule Review Powder Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Action Required';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
         if ($lastCft->hod_ProductionLiquid_person != $request->hod_ProductionLiquid_person && $request->hod_ProductionLiquid_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Production Liquid/Ointment Person';
            $history->previous = $lastCft->hod_ProductionLiquid_person;
            $history->current = $request->hod_ProductionLiquid_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_ProductionLiquid_person) || $lastCft->hod_ProductionLiquid_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_assessment != $request->ProductionLiquid_assessment && $request->ProductionLiquid_assessment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Attachment';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Injection Action Required';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
        if ($lastCft->hod_Production_Injection_Person != $request->hod_Production_Injection_Person && $request->hod_Production_Injection_Person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Production Injection Person';
            $history->previous = $lastCft->hod_Production_Injection_Person;
            $history->current = $request->hod_Production_Injection_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Production_Injection_Person) || $lastCft->hod_Production_Injection_Person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastCft->Production_Injection_Assessment != $request->Production_Injection_Assessment && $request->Production_Injection_Assessment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Injection Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Injection Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Injection On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Injection Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Production Injection Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Store Action Required';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
        if ($lastCft->hod_Store_person != $request->hod_Store_person && $request->hod_Store_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Store Person';
            $history->previous = $lastCft->hod_Store_person;
            $history->current = $request->hod_Store_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Store_person) || $lastCft->hod_Store_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_assessment != $request->Store_assessment && $request->Store_assessment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Store Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Store Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Store Review Attachment';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Store Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Store Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Quality Control Action Required';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
         if ($lastCft->hod_Quality_Control_Person != $request->hod_Quality_Control_Person && $request->hod_Quality_Control_Person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Quality Control Person';
            $history->previous = $lastCft->hod_Quality_Control_Person;
            $history->current = $request->hod_Quality_Control_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Quality_Control_Person) || $lastCft->hod_Quality_Control_Person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Quality_Control_assessment != $request->Quality_Control_assessment && $request->Quality_Control_assessment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Quality Control Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Quality Control Status of Action Item';
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
        //     $history = new ManagementAuditTrial;
        //     $history->ManagementReview_id = $id;
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
        //     $history = new ManagementAuditTrial;
        //     $history->ManagementReview_id = $id;
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Quality Control Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Research & Development Action Required';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
         if ($lastCft->hod_ResearchDevelopment_person != $request->hod_ResearchDevelopment_person && $request->hod_ResearchDevelopment_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Research & Development Person';
            $history->previous = $lastCft->hod_ResearchDevelopment_person;
            $history->current = $request->hod_ResearchDevelopment_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_ResearchDevelopment_person) || $lastCft->hod_ResearchDevelopment_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_assessment != $request->ResearchDevelopment_assessment && $request->ResearchDevelopment_assessment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Research & Development Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Research & Development Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Research & Development Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Research & Development Actio On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Engineering Action Required';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
        if ($lastCft->hod_Engineering_person != $request->hod_Engineering_person && $request->hod_Engineering_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Engineering Person';
            $history->previous = $lastCft->hod_Engineering_person;
            $history->current = $request->hod_Engineering_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Engineering_person) || $lastCft->hod_Engineering_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_assessment != $request->Engineering_assessment && $request->Engineering_assessment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Engineering Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Engineering Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Engineering Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Engineering Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Engineering Review On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Human Resource Action Required';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
        if ($lastCft->hod_Human_Resource_person != $request->hod_Human_Resource_person && $request->hod_Human_Resource_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Human Resource Person';
            $history->previous = $lastCft->hod_Human_Resource_person;
            $history->current = $request->hod_Human_Resource_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Human_Resource_person) || $lastCft->hod_Human_Resource_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_assessment != $request->Human_Resource_assessment && $request->Human_Resource_assessment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Human Resource Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Human Resource Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Human Resource Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Human Resource Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Human Resource Attachment';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Microbiology Action Required';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
        if ($lastCft->hod_Microbiology_person != $request->hod_Microbiology_person && $request->hod_Microbiology_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Microbiology Person';
            $history->previous = $lastCft->hod_Microbiology_person;
            $history->current = $request->hod_Microbiology_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Microbiology_person) || $lastCft->hod_Microbiology_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_assessment != $request->Microbiology_assessment && $request->Microbiology_assessment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Microbiology Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Microbiology Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Microbiology Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Microbiology Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Microbiology Attachment';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Regulatory Affair Action Required';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
        if ($lastCft->hod_RegulatoryAffair_person != $request->hod_RegulatoryAffair_person && $request->hod_RegulatoryAffair_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Regulatory Affair Person';
            $history->previous = $lastCft->hod_RegulatoryAffair_person;
            $history->current = $request->hod_RegulatoryAffair_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_RegulatoryAffair_person) || $lastCft->hod_RegulatoryAffair_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_assessment != $request->RegulatoryAffair_assessment && $request->RegulatoryAffair_assessment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Regulatory Affair Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Regulatory Affair Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Regulatory Affair Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Regulatory Affair Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Regulatory Affair Attachment';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Action Required';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
        if ($lastCft->hod_CorporateQualityAssurance_person != $request->hod_CorporateQualityAssurance_person && $request->hod_CorporateQualityAssurance_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Corporate Quality Assurance Person';
            $history->previous = $lastCft->hod_CorporateQualityAssurance_person;
            $history->current = $request->hod_CorporateQualityAssurance_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_CorporateQualityAssurance_person) || $lastCft->hod_CorporateQualityAssurance_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_assessment != $request->CorporateQualityAssurance_assessment && $request->CorporateQualityAssurance_assessment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Safety Action Required';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
        if ($lastCft->hod_Environment_Health_Safety_person != $request->hod_Environment_Health_Safety_person && $request->hod_Environment_Health_Safety_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Safety Person';
            $history->previous = $lastCft->hod_Environment_Health_Safety_person;
            $history->current = $request->hod_Environment_Health_Safety_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Environment_Health_Safety_person) || $lastCft->hod_Environment_Health_Safety_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Health_Safety_assessment != $request->Health_Safety_assessment && $request->Health_Safety_assessment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Safety Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Safety Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Safety Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Safety Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Safety Attachment';
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
        // if ($lastCft->ContractGiver_Review != $request->ContractGiver_Review && $request->ContractGiver_Review != null) {
        //     $history = new ManagementAuditTrial;
        //     $history->ManagementReview_id = $id;
        //     $history->activity_type = 'Contract Giver Action Required';
        //     $history->previous = $lastCft->ContractGiver_Review;
        //     $history->current = $request->ContractGiver_Review;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->ContractGiver_Review) || $lastCft->ContractGiver_Review === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        // if ($lastCft->ContractGiver_person != $request->ContractGiver_person && $request->ContractGiver_person != null) {
        //     $history = new ManagementAuditTrial;
        //     $history->ManagementReview_id = $id;
        //     $history->activity_type = 'Contract Giver Person';
        //     $history->previous = $lastCft->ContractGiver_person;
        //     $history->current = $request->ContractGiver_person;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->ContractGiver_person) || $lastCft->ContractGiver_person === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        // if ($lastCft->hod_ContractGiver_person != $request->hod_ContractGiver_person && $request->hod_ContractGiver_person != null) {
        //     $history = new ManagementAuditTrial;
        //     $history->ManagementReview_id = $id;
        //     $history->activity_type = 'HOD Contract Giver Person';
        //     $history->previous = $lastCft->hod_ContractGiver_person;
        //     $history->current = $request->hod_ContractGiver_person;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->hod_ContractGiver_person) || $lastCft->hod_ContractGiver_person === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        // if ($lastCft->ContractGiver_assessment != $request->ContractGiver_assessment && $request->ContractGiver_assessment != null) {
        //     $history = new ManagementAuditTrial;
        //     $history->ManagementReview_id = $id;
        //     $history->activity_type = 'Contract Giver Description of Action Item';
        //     $history->previous = $lastCft->ContractGiver_assessment;
        //     $history->current = $request->ContractGiver_assessment;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->ContractGiver_assessment) || $lastCft->ContractGiver_assessment === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        // if ($lastCft->ContractGiver_feedback != $request->ContractGiver_feedback && $request->ContractGiver_feedback != null) {
        //     $history = new ManagementAuditTrial;
        //     $history->ManagementReview_id = $id;
        //     $history->activity_type = 'Contract Giver Status of Action Item';
        //     $history->previous = $lastCft->ContractGiver_feedback;
        //     $history->current = $request->ContractGiver_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->ContractGiver_feedback) || $lastCft->ContractGiver_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        // if ($lastCft->ContractGiver_by != $request->ContractGiver_by && $request->ContractGiver_by != null) {
        //     $history = new ManagementAuditTrial;
        //     $history->ManagementReview_id = $id;
        //     $history->activity_type = 'Contract Giver Action By';
        //     $history->previous = $lastCft->ContractGiver_by;
        //     $history->current = $request->ContractGiver_by;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->ContractGiver_by) || $lastCft->ContractGiver_by === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        // if ($lastCft->ContractGiver_on != $request->ContractGiver_on && $request->ContractGiver_on != null) {
        //     $history = new ManagementAuditTrial;
        //     $history->ManagementReview_id = $id;
        //     $history->activity_type = 'Contract Giver Action On';
        //     $history->previous = $lastCft->ContractGiver_on;
        //     $history->current = $request->ContractGiver_on;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->ContractGiver_on) || $lastCft->ContractGiver_on === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        // if ($lastCft->ContractGiver_attachment != $request->ContractGiver_attachment && $request->ContractGiver_attachment != null) {
        //     $history = new ManagementAuditTrial;
        //     $history->ManagementReview_id = $id;
        //     $history->activity_type = 'Contract Giver Attachment';
        //     $history->previous = $lastCft->ContractGiver_attachment;
        //     $history->current = implode(',',$request->ContractGiver_attachment);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastCft->ContractGiver_attachment) || $lastCft->ContractGiver_attachment === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        /*************** Other 1 ***************/
        if ($lastCft->Other1_review != $request->Other1_review && $request->Other1_review != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 1 Action Required';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
        if ($lastCft->hod_Other1_person != $request->hod_Other1_person && $request->hod_Other1_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 1 Person';
            $history->previous = $lastCft->hod_Other1_person;
            $history->current = $request->hod_Other1_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other1_person) || $lastCft->hod_Other1_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if (!is_null($lastCft->Other1_Department_person) != $Cft->Other1_Department_person && $Cft->Other1_Department_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 1 Department';
            $history->previous = Helpers::getFullDepartmentName ($lastCft->Other1_Department_person);
            $history->current =Helpers::getFullDepartmentName ($Cft->Other1_Department_person);
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 1 Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 1 Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 1 Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 1 Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 2 Action Required';
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
        if (!is_null($lastCft->Other2_person) != $request->Other2_person && $request->Other2_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
         if ($lastCft->hod_Other2_person != $request->hod_Other2_person && $request->hod_Other2_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 2 Person';
            $history->previous = $lastCft->hod_Other2_person;
            $history->current = $request->hod_Other2_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other2_person) || $lastCft->hod_Other2_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if (!is_null($lastCft->Other2_Department_person) != $Cft->Other2_Department_person && $Cft->Other2_Department_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 2 Department';
            $history->previous = Helpers::getFullDepartmentName($lastCft->Other2_Department_person);
            $history->current = Helpers::getFullDepartmentName($Cft->Other2_Department_person);
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 2 Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 2 Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 2 Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 2 Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 3 Action Required';
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
        if (!is_null($lastCft->Other3_person) != $request->Other3_person && $request->Other3_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
         if ($lastCft->hod_Other3_person != $request->hod_Other3_person && $request->hod_Other3_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 3 Person';
            $history->previous = $lastCft->hod_Other3_person;
            $history->current = $request->hod_Other3_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other3_person) || $lastCft->hod_Other3_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if (!is_null($lastCft->Other3_Department_person) != $request->Other3_Department_person && $request->Other3_Department_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 3 Department';
            $history->previous = Helpers::getFullDepartmentName($lastCft->Other3_Department_person);
            $history->current = Helpers::getFullDepartmentName($request->Other3_Department_person);
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 3 Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 3 Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 3 Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 3 Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 4 Action Required';
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
        if (!is_null($lastCft->Other4_person) != $request->Other4_person && $request->Other4_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
        if ($lastCft->hod_Other4_person != $request->hod_Other4_person && $request->hod_Other4_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 4 Person';
            $history->previous = $lastCft->hod_Other4_person;
            $history->current = $request->hod_Other4_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other4_person) || $lastCft->hod_Other4_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if (!is_null($lastCft->Other4_Department_person) != $request->Other4_Department_person && $request->Other4_Department_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Others 4 Department';
            $history->previous =Helpers::getFullDepartmentName( $lastCft->Other4_Department_person);
            $history->current = Helpers::getFullDepartmentName($request->Other4_Department_person);
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 4 Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 4 Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 4 Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 4 Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 4 Attachment';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 5 Action Required';
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
        if (!is_null($lastCft->Other5_person) != $request->Other5_person && $request->Other5_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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
        if ($lastCft->hod_Other5_person != $request->hod_Other5_person && $request->hod_Other5_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 5 Person';
            $history->previous = $lastCft->hod_Other5_person;
            $history->current = $request->hod_Other5_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other5_person) || $lastCft->hod_Other5_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if (!is_null($lastCft->Other5_Department_person) != $request->Other5_Department_person && $request->Other5_Department_person != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 5 Department';
            $history->previous = Helpers::getFullDepartmentName($lastCft->Other5_Department_person);
            $history->current =Helpers::getFullDepartmentName ($request->Other5_Department_person);
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 5 Description of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 5 Status of Action Item';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 5 Action By';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 5 Action On';
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
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
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



        //----------------------HOD CFT-------------------------------------------------------//

                  /*************** Quality Assurance ***************/

        if ($lastCft->hod_QualityAssurance_feedback != $request->hod_QualityAssurance_feedback && $request->hod_QualityAssurance_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Quality Assurance Review Comments';
            $history->previous = $lastCft->hod_QualityAssurance_feedback;
            $history->current = $request->hod_QualityAssurance_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_QualityAssurance_feedback) || $lastCft->hod_QualityAssurance_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
         if ($lastCft->hod_Quality_Assurance_attachment != $request->hod_Quality_Assurance_attachment && $request->hod_Quality_Assurance_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Quality Assurance Attachment';
            $history->previous = $lastCft->hod_Quality_Assurance_attachment;
            $history->current =implode(',', $request->hod_Quality_Assurance_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Quality_Assurance_attachment) || $lastCft->hod_Quality_Assurance_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_QualityAssurance_by != $request->hod_QualityAssurance_by && $request->hod_QualityAssurance_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Quality Assurance Review By';
            $history->previous = $lastCft->hod_QualityAssurance_by;
            $history->current = $request->hod_QualityAssurance_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_QualityAssurance_by) || $lastCft->hod_QualityAssurance_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_QualityAssurance_on != $request->hod_QualityAssurance_on && $request->hod_QualityAssurance_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Quality Assurance Review On';
            $history->previous = $lastCft->hod_QualityAssurance_on;
            $history->current = $request->hod_QualityAssurance_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_QualityAssurance_on) || $lastCft->hod_QualityAssurance_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        /*************** Production Tablet ***************/

        if ($lastCft->hod_Production_Table_Feedback != $request->hod_Production_Table_Feedback && $request->hod_Production_Table_Feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Production Tablet/Capsule Powder Review Comments';
            $history->previous = $lastCft->hod_Production_Table_Feedback;
            $history->current = $request->hod_Production_Table_Feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Production_Table_Feedback) || $lastCft->hod_Production_Table_Feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Production_Table_Attachment != $request->hod_Production_Table_Attachment && $request->hod_Production_Table_Attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Production Tablet/Capsule Powder Attachment';
            $history->previous = $lastCft->hod_Production_Table_Attachment;
            $history->current = implode(',',$request->hod_Production_Table_Attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Production_Table_Attachment) || $lastCft->hod_Production_Table_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastCft->hod_Production_Table_On != $request->hod_Production_Table_On && $request->hod_Production_Table_On != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Production Tablet/Capsule Powder Review On';
            $history->previous = $lastCft->hod_Production_Table_On;
            $history->current = $request->hod_Production_Table_On;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Production_Table_On) || $lastCft->hod_Production_Table_On === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

         /*************** Production Liquid ***************/

        if ($lastCft->hod_ProductionLiquid_feedback != $request->hod_ProductionLiquid_feedback && $request->hod_ProductionLiquid_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Production Liquid/Ointment Review Comments';
            $history->previous = $lastCft->hod_ProductionLiquid_feedback;
            $history->current = $request->hod_ProductionLiquid_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_ProductionLiquid_feedback) || $lastCft->hod_ProductionLiquid_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_ProductionLiquid_attachment != $request->hod_ProductionLiquid_attachment && $request->hod_ProductionLiquid_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Production Liquid/Ointment Attachment';
            $history->previous = $lastCft->hod_ProductionLiquid_attachment;
            $history->current = implode(',',$request->hod_ProductionLiquid_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_ProductionLiquid_attachment) || $lastCft->hod_ProductionLiquid_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_ProductionLiquid_by != $request->hod_ProductionLiquid_by && $request->hod_ProductionLiquid_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Production Liquid/Ointment Review By';
            $history->previous = $lastCft->hod_ProductionLiquid_by;
            $history->current = $request->hod_ProductionLiquid_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_ProductionLiquid_by) || $lastCft->hod_ProductionLiquid_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_ProductionLiquid_on != $request->hod_ProductionLiquid_on && $request->hod_ProductionLiquid_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Production Liquid/Ointment Review On';
            $history->previous = $lastCft->hod_ProductionLiquid_on;
            $history->current = $request->hod_ProductionLiquid_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_ProductionLiquid_on) || $lastCft->hod_ProductionLiquid_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Production Injection ***************/

        if ($lastCft->hod_Production_Injection_Feedback != $request->hod_Production_Injection_Feedback && $request->hod_Production_Injection_Feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Production Injection Review Comments';
            $history->previous = $lastCft->hod_Production_Injection_Feedback;
            $history->current = $request->hod_Production_Injection_Feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Production_Injection_Feedback) || $lastCft->hod_Production_Injection_Feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Production_Injection_Attachment != $request->hod_Production_Injection_Attachment && $request->hod_Production_Injection_Attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Production Injection Attachment';
            $history->previous = $lastCft->hod_Production_Injection_Attachment;
            $history->current =implode(',', $request->hod_Production_Injection_Attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Production_Injection_Attachment) || $lastCft->hod_Production_Injection_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Production_Injection_By != $request->hod_Production_Injection_By && $request->hod_Production_Injection_By != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Production Injection Review By';
            $history->previous = $lastCft->hod_Production_Injection_By;
            $history->current = $request->hod_Production_Injection_By;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Production_Injection_By) || $lastCft->hod_Production_Injection_By === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Production_Injection_On != $request->hod_Production_Injection_On && $request->hod_Production_Injection_On != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Production Injection Review On';
            $history->previous = $lastCft->hod_Production_Injection_On;
            $history->current = $request->hod_Production_Injection_On;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Production_Injection_On) || $lastCft->hod_Production_Injection_On === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Stores ***************/

        if ($lastCft->hod_Store_feedback != $request->hod_Store_feedback && $request->hod_Store_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Store Review Comments';
            $history->previous = $lastCft->hod_Store_feedback;
            $history->current = $request->hod_Store_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Store_feedback) || $lastCft->hod_Store_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
         if ($lastCft->hod_Store_attachment != $request->hod_Store_attachment && $request->hod_Store_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Store Review Attachment';
            $history->previous = $lastCft->hod_Store_attachment;
            $history->current =implode(',', $request->hod_Store_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Store_attachment) || $lastCft->hod_Store_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Store_by != $request->hod_Store_by && $request->hod_Store_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Store Review By';
            $history->previous = $lastCft->hod_Store_by;
            $history->current = $request->hod_Store_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Store_by) || $lastCft->hod_Store_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Store_on != $request->hod_Store_on && $request->hod_Store_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Store Review On';
            $history->previous = $lastCft->hod_Store_on;
            $history->current = $request->hod_Store_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Store_on) || $lastCft->hod_Store_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Quality Control ***************/

        if ($lastCft->hod_Quality_Control_feedback != $request->hod_Quality_Control_feedback && $request->hod_Quality_Control_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Quality Control Review Comments';
            $history->previous = $lastCft->hod_Quality_Control_feedback;
            $history->current = $request->hod_Quality_Control_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Quality_Control_feedback) || $lastCft->hod_Quality_Control_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastCft->hod_Quality_Control_attachment != $request->hod_Quality_Control_attachment && $request->hod_Quality_Control_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Quality Control Attachment';
            $history->previous = $lastCft->hod_Quality_Control_attachment;
            $history->current =implode(',', $request->hod_Quality_Control_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Quality_Control_attachment) || $lastCft->hod_Quality_Control_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Research & Development ***************/

        if ($lastCft->hod_ResearchDevelopment_feedback != $request->hod_ResearchDevelopment_feedback && $request->hod_ResearchDevelopment_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Research & Development Review Comments';
            $history->previous = $lastCft->hod_ResearchDevelopment_feedback;
            $history->current = $request->hod_ResearchDevelopment_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_ResearchDevelopment_feedback) || $lastCft->hod_ResearchDevelopment_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_ResearchDevelopment_by != $request->hod_ResearchDevelopment_by && $request->hod_ResearchDevelopment_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Research & Development Review By';
            $history->previous = $lastCft->hod_ResearchDevelopment_by;
            $history->current = $request->hod_ResearchDevelopment_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_ResearchDevelopment_by) || $lastCft->hod_ResearchDevelopment_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_ResearchDevelopment_on != $request->hod_ResearchDevelopment_on && $request->hod_ResearchDevelopment_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Research & Development Review On';
            $history->previous = $lastCft->hod_ResearchDevelopment_on;
            $history->current = $request->hod_ResearchDevelopment_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_ResearchDevelopment_on) || $lastCft->hod_ResearchDevelopment_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_ResearchDevelopment_attachment != $request->hod_ResearchDevelopment_attachment && $request->hod_ResearchDevelopment_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Research & Development Review On';
            $history->previous = $lastCft->hod_ResearchDevelopment_attachment;
            $history->current =implode(',', $request->hod_ResearchDevelopment_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_ResearchDevelopment_attachment) || $lastCft->hod_ResearchDevelopment_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Engineering ***************/

        if ($lastCft->hod_Engineering_feedback != $request->hod_Engineering_feedback && $request->hod_Engineering_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Engineering Review Comments';
            $history->previous = $lastCft->hod_Engineering_feedback;
            $history->current = $request->hod_Engineering_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Engineering_feedback) || $lastCft->hod_Engineering_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Engineering_by != $request->hod_Engineering_by && $request->hod_Engineering_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Engineering Review By';
            $history->previous = $lastCft->hod_Engineering_by;
            $history->current = $request->hod_Engineering_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Engineering_by) || $lastCft->hod_Engineering_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Engineering_on != $request->hod_Engineering_on && $request->hod_Engineering_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Engineering Review On';
            $history->previous = $lastCft->hod_Engineering_on;
            $history->current = $request->hod_Engineering_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Engineering_on) || $lastCft->hod_Engineering_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Engineering_attachment != $request->hod_Engineering_attachment && $request->hod_Engineering_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Engineering Review Attachment';
            $history->previous = $lastCft->hod_Engineering_attachment;
            $history->current = implode(',',$request->hod_Engineering_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Engineering_attachment) || $lastCft->hod_Engineering_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Human Resource ***************/

        if ($lastCft->hod_Human_Resource_feedback != $request->hod_Human_Resource_feedback && $request->hod_Human_Resource_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Human Resource Review Comments';
            $history->previous = $lastCft->hod_Human_Resource_feedback;
            $history->current = $request->hod_Human_Resource_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Human_Resource_feedback) || $lastCft->hod_Human_Resource_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Human_Resource_by != $request->hod_Human_Resource_by && $request->hod_Human_Resource_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Human Resource Review By';
            $history->previous = $lastCft->hod_Human_Resource_by;
            $history->current = $request->hod_Human_Resource_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Human_Resource_by) || $lastCft->hod_Human_Resource_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Human_Resource_on != $request->hod_Human_Resource_on && $request->hod_Human_Resource_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Human Resource Review On';
            $history->previous = $lastCft->hod_Human_Resource_on;
            $history->current = $request->hod_Human_Resource_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Human_Resource_on) || $lastCft->hod_Human_Resource_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Human_Resource_attachment != $request->hod_Human_Resource_attachment && $request->hod_Human_Resource_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Human Resource Review Attachment';
            $history->previous = $lastCft->hod_Human_Resource_attachment;
            $history->current =implode(',', $request->hod_Human_Resource_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Human_Resource_attachment) || $lastCft->hod_Human_Resource_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Microbiology ***************/

        if ($lastCft->hod_Microbiology_feedback != $request->hod_Microbiology_feedback && $request->hod_Microbiology_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Microbiology Review Comments';
            $history->previous = $lastCft->hod_Microbiology_feedback;
            $history->current = $request->hod_Microbiology_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Microbiology_feedback) || $lastCft->hod_Microbiology_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Microbiology_by != $request->hod_Microbiology_by && $request->hod_Microbiology_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Microbiology Review By';
            $history->previous = $lastCft->hod_Microbiology_by;
            $history->current = $request->hod_Microbiology_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Microbiology_by) || $lastCft->hod_Microbiology_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Microbiology_on != $request->hod_Microbiology_on && $request->hod_Microbiology_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Microbiology Review On';
            $history->previous = $lastCft->hod_Microbiology_on;
            $history->current = $request->hod_Microbiology_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Microbiology_on) || $lastCft->hod_Microbiology_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
         if ($lastCft->hod_Microbiology_attachment != $request->hod_Microbiology_attachment && $request->hod_Microbiology_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Microbiology Review Attachment';
            $history->previous = $lastCft->hod_Microbiology_attachment;
            $history->current = implode(',',$request->hod_Microbiology_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Microbiology_attachment) || $lastCft->hod_Microbiology_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Regulatory Affair ***************/

        if ($lastCft->hod_RegulatoryAffair_feedback != $request->hod_RegulatoryAffair_feedback && $request->hod_RegulatoryAffair_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Regulatory Affair Review Comments';
            $history->previous = $lastCft->hod_RegulatoryAffair_feedback;
            $history->current = $request->hod_RegulatoryAffair_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_RegulatoryAffair_feedback) || $lastCft->hod_RegulatoryAffair_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_RegulatoryAffair_by != $request->hod_RegulatoryAffair_by && $request->hod_RegulatoryAffair_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Regulatory Affair Review By';
            $history->previous = $lastCft->hod_RegulatoryAffair_by;
            $history->current = $request->hod_RegulatoryAffair_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_RegulatoryAffair_by) || $lastCft->hod_RegulatoryAffair_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_RegulatoryAffair_on != $request->hod_RegulatoryAffair_on  && $request->hod_RegulatoryAffair_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Regulatory Affair Review On';
            $history->previous = $lastCft->hod_RegulatoryAffair_on;
            $history->current = $request->hod_RegulatoryAffair_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_RegulatoryAffair_on) || $lastCft->hod_RegulatoryAffair_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_RegulatoryAffair_attachment != $request->hod_RegulatoryAffair_attachment  && $request->hod_RegulatoryAffair_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Regulatory Affair Review Attachment';
            $history->previous = $lastCft->hod_RegulatoryAffair_attachment;
            $history->current =implode(',', $request->hod_RegulatoryAffair_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_RegulatoryAffair_attachment) || $lastCft->hod_RegulatoryAffair_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Corporate Quality Assurance ***************/

        if ($lastCft->hod_CorporateQualityAssurance_feedback != $request->hod_CorporateQualityAssurance_feedback && $request->hod_CorporateQualityAssurance_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Corporate Quality Assurance Review Comments';
            $history->previous = $lastCft->hod_CorporateQualityAssurance_feedback;
            $history->current = $request->hod_CorporateQualityAssurance_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_CorporateQualityAssurance_feedback) || $lastCft->hod_CorporateQualityAssurance_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_CorporateQualityAssurance_by != $request->hod_CorporateQualityAssurance_by && $request->hod_CorporateQualityAssurance_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Corporate Quality Assurance Review By';
            $history->previous = $lastCft->hod_CorporateQualityAssurance_by;
            $history->current = $request->hod_CorporateQualityAssurance_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_CorporateQualityAssurance_by) || $lastCft->hod_CorporateQualityAssurance_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_CorporateQualityAssurance_on != $request->hod_CorporateQualityAssurance_on && $request->hod_CorporateQualityAssurance_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Corporate Quality Assurance Review On';
            $history->previous = $lastCft->hod_CorporateQualityAssurance_on;
            $history->current = $request->hod_CorporateQualityAssurance_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_CorporateQualityAssurance_on) || $lastCft->hod_CorporateQualityAssurance_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_CorporateQualityAssurance_attachment != $request->hod_CorporateQualityAssurance_attachment && $request->hod_CorporateQualityAssurance_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Corporate Quality Assurance Review Attachment';
            $history->previous = $lastCft->hod_CorporateQualityAssurance_attachment;
            $history->current =implode(',', $request->hod_CorporateQualityAssurance_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_CorporateQualityAssurance_attachment) || $lastCft->hod_CorporateQualityAssurance_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Safety ***************/

        if ($lastCft->hod_Health_Safety_feedback != $request->hod_Health_Safety_feedback && $request->hod_Health_Safety_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Safety Review Comments';
            $history->previous = $lastCft->hod_Health_Safety_feedback;
            $history->current = $request->hod_Health_Safety_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Health_Safety_feedback) || $lastCft->hod_Health_Safety_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Environment_Health_Safety_by != $request->hod_Environment_Health_Safety_by && $request->hod_Environment_Health_Safety_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Safety Review By';
            $history->previous = $lastCft->hod_Environment_Health_Safety_by;
            $history->current = $request->hod_Environment_Health_Safety_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Environment_Health_Safety_by) || $lastCft->hod_Environment_Health_Safety_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Environment_Health_Safety_on != $request->hod_Environment_Health_Safety_on && $request->hod_Environment_Health_Safety_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Safety Review On';
            $history->previous = $lastCft->hod_Environment_Health_Safety_on;
            $history->current = $request->hod_Environment_Health_Safety_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Environment_Health_Safety_on) || $lastCft->hod_Environment_Health_Safety_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Environment_Health_Safety_attachment != $request->hod_Environment_Health_Safety_attachment && $request->hod_Environment_Health_Safety_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Safety Review Attachment';
            $history->previous = $lastCft->hod_Environment_Health_Safety_attachment;
            $history->current =implode(',', $request->hod_Environment_Health_Safety_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Environment_Health_Safety_attachment) || $lastCft->hod_Environment_Health_Safety_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Contract Giver ***************/

        if ($lastCft->hod_ContractGiver_feedback != $request->hod_ContractGiver_feedback && $request->hod_ContractGiver_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Contract Giver Review Comments';
            $history->previous = $lastCft->hod_ContractGiver_feedback;
            $history->current = $request->hod_ContractGiver_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_ContractGiver_feedback) || $lastCft->hod_ContractGiver_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_ContractGiver_by != $request->hod_ContractGiver_by && $request->hod_ContractGiver_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Contract Giver Review By';
            $history->previous = $lastCft->hod_ContractGiver_by;
            $history->current = $request->hod_ContractGiver_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_ContractGiver_by) || $lastCft->hod_ContractGiver_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_ContractGiver_on != $request->hod_ContractGiver_on && $request->hod_ContractGiver_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Contract Giver Review On';
            $history->previous = $lastCft->hod_ContractGiver_on;
            $history->current = $request->hod_ContractGiver_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_ContractGiver_on) || $lastCft->hod_ContractGiver_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastCft->hod_ContractGiver_attachment != $request->hod_ContractGiver_attachment && $request->hod_ContractGiver_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Contract Giver Review Attachment';
            $history->previous = $lastCft->hod_ContractGiver_attachment;
            $history->current = implode(',',$request->hod_ContractGiver_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_ContractGiver_attachment) || $lastCft->hod_ContractGiver_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        /*************** Other 1 ***************/

        if ($lastCft->hod_Other1_feedback != $request->hod_Other1_feedback && $request->hod_Other1_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 1 Review Comments';
            $history->previous = $lastCft->hod_Other1_feedback;
            $history->current = $request->hod_Other1_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other1_feedback) || $lastCft->hod_Other1_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other1_by != $request->hod_Other1_by && $request->hod_Other1_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 1 Review By';
            $history->previous = $lastCft->hod_Other1_by;
            $history->current = $request->hod_Other1_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other1_by) || $lastCft->hod_Other1_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other1_on != $request->hod_Other1_on && $request->hod_Other1_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Other 1 Review On';
            $history->previous = $lastCft->hod_Other1_on;
            $history->current = $request->hod_Other1_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other1_on) || $lastCft->hod_Other1_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other1_attachment != $request->hod_Other1_attachment && $request->hod_Other1_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 1 Review Attachment';
            $history->previous = $lastCft->hod_Other1_attachment;
            $history->current = implode(',',$request->hod_Other1_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other1_attachment) || $lastCft->hod_Other1_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        /*************** Other 2 ***************/

        if ($lastCft->hod_Other2_feedback != $request->hod_Other2_feedback && $request->hod_Other2_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 2 Review Comments';
            $history->previous = $lastCft->hod_Other2_feedback;
            $history->current = $request->hod_Other2_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other2_feedback) || $lastCft->hod_Other2_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other2_by != $request->hod_Other2_by && $request->hod_Other2_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 2 Review By';
            $history->previous = $lastCft->hod_Other2_by;
            $history->current = $request->hod_Other2_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other2_by) || $lastCft->hod_Other2_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other2_on != $request->hod_Other2_on && $request->hod_Other2_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 2 Review On';
            $history->previous = $lastCft->hod_Other2_on;
            $history->current = $request->hod_Other2_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other2_on) || $lastCft->hod_Other2_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other2_attachment != $request->hod_Other2_attachment && $request->hod_Other2_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 2 Review Attachment';
            $history->previous = $lastCft->hod_Other2_attachment;
            $history->current =implode(',', $request->hod_Other2_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other2_attachment) || $lastCft->hod_Other2_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Other 3 ***************/

        if ($lastCft->hod_Other3_feedback != $request->hod_Other3_feedback && $request->hod_Other3_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 3 Review Comments';
            $history->previous = $lastCft->hod_Other3_feedback;
            $history->current = $request->hod_Other3_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other3_feedback) || $lastCft->hod_Other3_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other3_by != $request->hod_Other3_by && $request->hod_Other3_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 3 Review By';
            $history->previous = $lastCft->hod_Other3_by;
            $history->current = $request->hod_Other3_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other3_by) || $lastCft->hod_Other3_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other3_on != $request->hod_Other3_on && $request->hod_Other3_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 3 Review On';
            $history->previous = $lastCft->hod_Other3_on;
            $history->current = $request->hod_Other3_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other3_on) || $lastCft->hod_Other3_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other3_attachment != $request->hod_Other3_attachment && $request->hod_Other3_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 3 Review Attachment';
            $history->previous = $lastCft->hod_Other3_attachment;
            $history->current =implode(',', $request->hod_Other3_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other3_attachment) || $lastCft->hod_Other3_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Other 4 ***************/

        if ($lastCft->hod_Other4_feedback != $request->hod_Other4_feedback && $request->hod_Other4_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 4 Review Comments';
            $history->previous = $lastCft->hod_Other4_feedback;
            $history->current = $request->hod_Other4_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other4_feedback) || $lastCft->hod_Other4_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other4_by != $request->hod_Other4_by && $request->hod_Other4_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 4 Review By';
            $history->previous = $lastCft->hod_Other4_by;
            $history->current = $request->hod_Other4_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other4_by) || $lastCft->hod_Other4_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other4_on != $request->hod_Other4_on && $request->hod_Other4_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 4 Review On';
            $history->previous = $lastCft->hod_Other4_on;
            $history->current = $request->hod_Other4_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other4_on) || $lastCft->hod_Other4_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other4_attachment != $request->hod_Other4_attachment && $request->hod_Other4_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 4 Review Attachment';
            $history->previous = $lastCft->hod_Other4_attachment;
            $history->current =implode(',', $request->hod_Other4_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other4_attachment) || $lastCft->hod_Other4_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        /*************** Other 5 ***************/

        if ($lastCft->hod_Other5_feedback != $request->hod_Other5_feedback && $request->hod_Other5_feedback != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 5 Review Comments';
            $history->previous = $lastCft->hod_Other5_feedback;
            $history->current = $request->hod_Other5_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other5_feedback) || $lastCft->hod_Other5_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other5_by != $request->hod_Other5_by && $request->hod_Other5_by != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 5 Review By';
            $history->previous = $lastCft->hod_Other5_by;
            $history->current = $request->hod_Other5_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other5_by) || $lastCft->hod_Other5_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other5_on != $request->hod_Other5_on && $request->hod_Other5_on != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 5 Review On';
            $history->previous = $lastCft->hod_Other5_on;
            $history->current = $request->hod_Other5_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other5_on) || $lastCft->hod_Other5_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->hod_Other5_attachment != $request->hod_Other5_attachment && $request->hod_Other5_attachment != null) {
            $history = new ManagementAuditTrial;
            $history->ManagementReview_id = $id;
            $history->activity_type = 'HOD Other 5 Review Attachment';
            $history->previous = $lastCft->hod_Other5_attachment;
            $history->current = implode(',',$request->hod_Other5_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastCft->hod_Other5_attachment) || $lastCft->hod_Other5_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

                 if($lastDocument->additional_suport_required !=$management->additional_suport_required || !empty($request->additional_suport_required_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'QA verification Comment')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'QA verification Comment';
            $history->previous =  $lastDocument->additional_suport_required;
            $history->current = $management->additional_suport_required;
            $history->comment = $request->attendees_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
           if($lastDocument->qa_verification_file !=$management->qa_verification_file || !empty($request->qa_verification_file_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'QA Verification Attachment')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'QA Verification Attachment';
            $history->previous =  $lastDocument->qa_verification_file;
            $history->current = $management->qa_verification_file;
            $history->comment = $request->qa_verification_file_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
          if($lastDocument->next_managment_review_date !=$management->next_managment_review_date || !empty($request->next_managment_review_date_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Date Due')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Date Due';
            $history->previous =   Helpers::getdateFormat($lastDocument->next_managment_review_date);
            $history->current =  Helpers::getdateFormat($management->next_managment_review_date);
            $history->comment = $request->next_managment_review_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }
         if($lastDocument->conclusion_new !=$management->conclusion_new || !empty($request->conclusion_new_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'QA Head Comment')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'QA Head Comment';
            $history->previous =  $lastDocument->conclusion_new;
            $history->current = $management->conclusion_new;
            $history->comment = $request->conclusion_new_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }

           if ($lastDocument->closure_attachments != $management->closure_attachments || !empty($request->closure_attachments_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Closure Attachment')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Closure Attachment';
            $history->previous = $lastDocument->closure_attachments;
            $history->current = $management->closure_attachments;
            $history->comment = $request->closure_attachments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDocument->meeting_and_summary_attachment != $management->meeting_and_summary_attachment || !empty($request->meeting_and_summary_attachment_comment)) {
            $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                           ->where('activity_type', 'Meetings and Summary Attachment')
                           ->exists();

           $history = new ManagementAuditTrial();
           $history->ManagementReview_id = $id;
           $history->activity_type = 'Meetings and Summary Attachment';
           $history->previous = $lastDocument->meeting_and_summary_attachment;
           $history->current = $management->meeting_and_summary_attachment;
           $history->comment = $request->meeting_and_summary_attachment_comment;
           $history->user_id = Auth::user()->id;
           $history->user_name = Auth::user()->name;
           $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->origin_state = $lastDocument->status;
                      $history->change_to= "Not Applicable";
           $history->change_from= $lastDocument->status;
           $history->action_name=$lastDocumentAuditTrail ? "Update" : "New";
           $history->save();
       }




        // --------------agenda--------------
        $data1 =  ManagementReviewDocDetails::where('review_id',$id)->where('type',"agenda")->first();
        $data1->review_id = $management->id;
        $data1->type = "agenda";
        if (!empty($request->date)) {
            $data1->date = serialize($request->date);
        }
        if (!empty($request->topic)) {
            $data1->topic = serialize($request->topic);
        }
        if (!empty($request->responsible)) {
            $data1->responsible = serialize($request->responsible);
        }
        if (!empty($request->start_time)) {
            $data1->start_time = serialize($request->start_time);
        }
        if (!empty($request->end_time)) {
            $data1->end_time = serialize($request->end_time);
        }
        if (!empty($request->comment)) {
            $data1->comment = serialize($request->comment);
        }
        $data1->update();

        $data2 =  ManagementReviewDocDetails::where('review_id',$id)->where('type',"performance_evaluation")->first();
        $data2->review_id = $management->id;
        $data2->type = "performance_evaluation";
        if (!empty($request->monitoring)) {
            $data2->monitoring = serialize($request->monitoring);
        }
        if (!empty($request->measurement)) {
            $data2->measurement = serialize($request->measurement);
        }
        if (!empty($request->analysis)) {
            $data2->analysis = serialize($request->analysis);
        }
        if (!empty($request->evaluation)) {
            $data2->evaluation = serialize($request->evaluation);
        }
        $data2->update();

        $data3 = ManagementReviewDocDetails::where('review_id',$id)->where('type',"management_review_participants")->first();
        $previousDetails = [
            'invited_Person' => !is_null($data3->invited_Person) ? unserialize($data3->invited_Person) : null,
            'designee' => !is_null($data3->designee) ? unserialize($data3->designee) : null,
            'department' => !is_null($data3->department) ? unserialize($data3->department) : null,
            'remarks' => !is_null($data3->remarks) ? unserialize($data3->remarks) : null,
        ];
        $data3->review_id = $management->id;
        $data3->type = "management_review_participants";
        if (!empty($request->invited_Person)) {
            $data3->invited_Person = serialize($request->invited_Person);
        }
        if (!empty($request->designee)) {
            $data3->designee = serialize($request->designee);
        }
        if (!empty($request->department)) {
            $data3->department = serialize($request->department);
        }



        if (!empty($request->remarks)) {
            $data3->remarks = serialize($request->remarks);
        }
        $data3->update();

        $fieldNames = [
            'invited_Person' => 'Invited Person',
            'designee' => 'Designation',
            'department' => 'Department',
            'remarks' => 'Remarks'
        ];

        // Ensure ReferenceDocumentName is an array before iterating
        if (is_array($request->invited_Person) && !empty($request->invited_Person)) {
            foreach ($request->invited_Person as $index => $invited_Person) {
                // Retrieve previous details for the current index
                $previousValues = [
                    'invited_Person' => $previousDetails['invited_Person'][$index] ?? null,
                    'designee' => $previousDetails['designee'][$index] ?? null,
                    'department' => $previousDetails['department'][$index] ?? null,
                    'remarks' => $previousDetails['remarks'][$index] ?? null,
                ];

                // Current fields values from the request
                $fields = [
                    'invited_Person' => $invited_Person,
                    'designee' => $request->designee[$index],
                    'department' => $request->department[$index],
                    'remarks' => $request->remarks[$index],
                ];

                foreach ($fields as $key => $currentValue) {
                    // Get the previous value from the previous data
                    $previousValue = $previousValues[$key] ?? null;

                    // Log changes for new or updated rows only if previous and current values differ
                    if ($previousValue != $currentValue && !empty($currentValue)) {
                        // Check if an audit trail entry for this specific row and field already exists
                        $existingAudit = ManagementAuditTrial::where('ManagementReview_id', $id)
                            ->where('activity_type', $fieldNames[$key] . ' (' . ($index + 1) . ')')
                            ->where('previous', $previousValue)
                            ->where('current', $currentValue)
                            ->exists();

                        // Only create a new audit trail entry if no existing entry matches
                        if (!$existingAudit) {
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;

                            // Set activity type to include field name and row index using the fieldNames array
                            $history->activity_type = $fieldNames[$key] . ' (' . ($index + 1) . ')';

                            // Assign 'Previous' value explicitly as null if it doesn't exist
                            $history->previous = $previousValue; // Previous value or 'null'

                            // Assign 'Current' value, which is the new value
                            $history->current = $currentValue; // New value

                            // Comments and user details
                            $history->comment = $request->equipment_comments[$index] ?? '';
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $data3->status;
                            $history->change_to = "Not Applicable";
                            $history->change_from = $data3->status;
                            if (is_null($previousValue) || $currentValue === '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                            //$history->action_name = "Update";

                            // Save the history record
                            $history->save();
                        }
                    }
                }
            }
        }

        $data4 = ManagementReviewDocDetails::where('review_id',$id)->where('type',"action_item_details")->first();
        $data4->review_id = $management->id;
        $data4->type = "action_item_details";
        if (!empty($request->short_desc)) {
            $data4->short_desc = serialize($request->short_desc);
        }
        //dd($request->date_due);
        if (!empty($request->date_due)) {
            $data4->date_due = serialize($request->date_due);
        }
        if (!empty($request->site)) {
            $data4->site = serialize($request->site);
        }
        if (!empty($request->responsible_person)) {
            $data4->responsible_person = serialize($request->responsible_person);
        }
        if (!empty($request->current_status)) {
            $data4->current_status = serialize($request->current_status);
        }

        if (!empty($request->date_closed)) {
            $data4->date_closed = serialize($request->date_closed);
        }
        if (!empty($request->remark)) {
            $data4->remark = serialize($request->remark);
        }
        $data4->update();

        $data5 = ManagementReviewDocDetails::where('review_id',$id)->where('type',"capa_detail_details")->first();
        $data5->review_id = $management->id;
        $data5->type = "capa_detail_details";

        if (!empty($request->Details)) {
            $data5->Details = serialize($request->Details);
        }
        // dd($request->capa_type);
        if (!empty($request->capa_type)) {
            $data5->capa_type = serialize($request->capa_type);
        }
        if (!empty($request->site2)) {
            $data5->site2 = serialize($request->site2);
        }
        if (!empty($request->responsible_person2)) {
            $data5->responsible_person2 = serialize($request->responsible_person2);
        }
        if (!empty($request->current_status2)) {
            $data5->current_status2 = serialize($request->current_status2);
        }
        if (!empty($request->date_closed2)) {
            $data5->date_closed2 = serialize($request->date_closed2);
        }
        if (!empty($request->remark2)) {
            $data5->remark2 = serialize($request->remark2);
        }
        $data5->update();


    toastr()->success("Record is updated Successfully");
    return back();
}

    public function ManagementReviewAuditTrial($id)

      {
        $data= ManagementReview::find($id);
        $audit = ManagementAuditTrial::where('ManagementReview_id', $id)->orderByDESC('id')->paginate(15);
        $today = Carbon::now()->format('d-m-y');
        $document = ManagementReview::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
        $users = User::all();
        // $audits = ManagementAuditTrial::paginate(10);

        return view('frontend.management-review.audit-trial', compact('audit', 'document', 'today','data','users'));
    }


    public function ManagementReviewAuditDetails($id)
    {
        $detail = ManagementAuditTrial::find($id);
        $detail_data = ManagementAuditTrial::where('activity_type', $detail->activity_type)->where('ManagementReview_id', $detail->ManagementReview_id)->latest()->get();
        $doc = ManagementReview::where('id', $detail->ManagementReview_id)->first();
        $doc->origiator_name = User::find($doc->initiator_id);
        return view('frontend.management-review.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
    }

    public function manageshow($id)
    {

        $data = ManagementReview::find($id);
        $userData = User::all();
        $data1 = managementCft::where('ManagementReview_id', $id)->latest()->first();
        $data5 = hodmanagementCft::where('ManagementReview_id', $id)->latest()->first();
          $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_to)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $agenda = ManagementReviewDocDetails::where('review_id',$data->id)->where('type',"agenda")->first();
        $management_review_participants = ManagementReviewDocDetails::where('review_id',$data->id)->where('type',"management_review_participants")->first();
        $performance_evaluation = ManagementReviewDocDetails::where('review_id',$data->id)->where('type',"performance_evaluation")->first();
        $action_item_details=  ManagementReviewDocDetails::where('review_id',$data->id)->where('type',"action_item_details")->first();
        //dd(unserialize($action_item_details->date_due));
        $capa_detail_details=  ManagementReviewDocDetails::where('review_id',$data->id)->where('type',"capa_detail_details")->first();

        return view('frontend.management-review.management_review', compact('userData','data5','data1', 'data','agenda','management_review_participants','performance_evaluation','action_item_details','capa_detail_details','due_date' ));
    }


    public function manage_send_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = ManagementReview::find($id);
            $Cft = managementCft::where('ManagementReview_id', $id)->first();
            $management = ManagementReview::find($id);
            $lastDocument =  ManagementReview::find($id);
            $data =  ManagementReview::find($id);
             $updateCFT = managementCft::where('ManagementReview_id', $id)->latest()->first();
             $updatehodCFT = hodmanagementCft::where('ManagementReview_id', $id)->latest()->first();
             $cftDetails = managementCft_Response::withoutTrashed()->where(['status' => 'In-progress', 'ManagementReview_id' => $id])->distinct('cft_user_id')->count();
             $cfthodDetails = hodmanagementCft_Response::withoutTrashed()->where(['status' => 'In-progress', 'ManagementReview_id' => $id])->distinct('cft_user_id')->count();


            if ($changeControl->stage == 1) {
                 if (!$changeControl->short_description || !$changeControl->summary_recommendation || !$changeControl->start_date || !$changeControl->inv_attachment) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => ' Short Discription and Type and Proposed Scheduled Start Date, GI Attachments is yet to be filled!',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for QA Head Review state'
                        ]);
                    }
                $changeControl->stage = "2";
                $changeControl->status = 'QA Head Review';
                $changeControl->Submited_by = Auth::user()->name;
                $changeControl->Submited_on = Carbon::now()->format('d-M-Y');
                $changeControl->Submited_Comment  =
                $request->comment;
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = 'Submit By, Submit On';
                $history->action ='Submit';
                if (is_null($lastDocument->Submited_by) || $lastDocument->Submited_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->Submited_by . ' , ' . $lastDocument->Submited_on;
                }
                $history->current = $changeControl->Submited_by . ' , ' . $changeControl->Submited_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='Submit';
                $history->change_to = "QA Head Review";
                $history->change_from = "Opened";
                if (is_null($lastDocument->Submited_by) || $lastDocument->Submited_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getQAHeadUserList($changeControl->division_id); // Notify CFT Person
                //         foreach ($list as $u) {
                //             // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //             // dd($email);
                //             if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $changeControl, 'site' => "Ext", 'history' => "Submit", 'process' => 'Managment Review', 'comment' => $changeControl->Submited_Comment, 'user' => Auth::user()->name],
                //                     function ($message) use ($email, $changeControl) {
                //                         $message->to($email)
                //                             ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Submit");
                //                     }
                //                 );
                //             }
                //             // }
                //         }



                $changeControl->update();
                //toastr()->success('Document Sent');
                return back();
            }
            // if ($changeControl->stage == 2) {
            //     $changeControl->stage = "3";
            //     $changeControl->status = 'QA Head Review';
            //     $changeControl->completed_by = Auth::user()->name;
            //     $changeControl->completed_on = Carbon::now()->format('d-M-Y');
            //     $changeControl->Completed_Comment  = $request->comment;
            //     $history = new ManagementAuditTrial();
            //     $history->ManagementReview_id = $id;
            //     $history->activity_type = 'Completed By     , Completed On';
            //     $history->action ='Completed';
            //     // $history->previous = $lastDocument->completed_by;
            //     if (is_null($lastDocument->completed_by) || $lastDocument->completed_by === '') {
            //         $history->previous = "Null";
            //     } else {
            //         $history->previous = $lastDocument->completed_by . ' , ' . $lastDocument->completed_on;
            //     }
            //     $history->current = $changeControl->completed_by . ' , ' . $changeControl->completed_on;
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocument->status;
            //     $history->stage='Completed';
            //     $history->change_to= "QA Head Review";
            //     $history->change_from= $lastDocument->status;
            //     if (is_null($lastDocument->completed_by) || $lastDocument->completed_by === '') {
            //         $history->action_name = 'New';
            //     } else {
            //         $history->action_name = 'Update';
            //     }
            //      $history->save();
            //     $changeControl->update();
            //     // $list = Helpers::getInitiatorUserList();
            //     // foreach ($list as $u) {
            //     //     if($u->q_m_s_divisions_id == $changeControl->division_id){
            //     //      $email = Helpers::getInitiatorEmail($u->user_id);
            //     //      if ($email !== null) {
            //     //          Mail::send(
            //     //             'mail.view-mail',
            //     //             ['data' => $changeControl],
            //     //             function ($message) use ($email) {
            //     //                 $message->to($email)
            //     //                     ->subject("Document is Send By ".Auth::user()->name);
            //     //             }
            //     //         );
            //     //       }
            //     //     }
            //     // }
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            if ($changeControl->stage == 2) {
                 if (!$changeControl->assign_to || !$changeControl->Operations) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'QA Head Review Tab is yet to be filled!',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for Meeting And Summary state'
                        ]);
                    }
                $changeControl->stage = "3";
                $changeControl->status = 'Meeting And Summary';
                $changeControl->qaHeadReviewComplete_By = Auth::user()->name;
                $changeControl->qaHeadReviewComplete_On = Carbon::now()->format('d-M-Y');
                $changeControl->qaHeadReviewComplete_Comment  = $request->comment;
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = 'QA Head Review Complete By     , QA Head Review Complete On';
                $history->action ='QA Head Review Complete';
                // $history->previous = $lastDocument->completed_by;
                if (is_null($lastDocument->qaHeadReviewComplete_By) || $lastDocument->qaHeadReviewComplete_By === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->qaHeadReviewComplete_By . ' , ' . $lastDocument->qaHeadReviewComplete_On;
                }
                $history->current = $changeControl->qaHeadReviewComplete_By . ' , ' . $changeControl->qaHeadReviewComplete_On;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='QA Head Review Complete';
                $history->change_to = "Meeting And Summary";
                $history->change_from = $lastDocument->status;
                if (is_null($lastDocument->qaHeadReviewComplete_By) || $lastDocument->qaHeadReviewComplete_By === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                 $history->save();
                 $changeControl->update();

                //  $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                //  foreach ($list as $u) {
                //      // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getUserEmail($u->user_id);
                //      // dd($email);
                //      if ($email !== null) {
                //          Mail::send(
                //              'mail.view-mail',
                //              ['data' => $changeControl, 'site' => "Ext", 'history' => "QA Head Review Complete", 'process' => 'Managment Review', 'comment' => $changeControl->qaHeadReviewComplete_Comment, 'user' => Auth::user()->name],
                //              function ($message) use ($email, $changeControl) {
                //                  $message->to($email)
                //                      ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA Head Review Complete");
                //              }
                //          );
                //      }
                //      // }
                //  }
                //  $list = Helpers::getQAUserList($changeControl->division_id); // Notify CFT Person
                //  foreach ($list as $u) {
                //      // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getUserEmail($u->user_id);
                //      // dd($email);
                //      if ($email !== null) {
                //          Mail::send(
                //              'mail.view-mail',
                //              ['data' => $changeControl, 'site' => "Ext", 'history' => "QA Head Review Complete", 'process' => 'Managment Review', 'comment' => $changeControl->qaHeadReviewComplete_Comment, 'user' => Auth::user()->name],
                //              function ($message) use ($email, $changeControl) {
                //                  $message->to($email)
                //                      ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA Head Review Complete");
                //              }
                //          );
                //      }
                //      // }
                //  }


                //toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 3) {
                 if (!$changeControl->customer_satisfaction_level || !$changeControl->external_supplier_performance || !$changeControl->budget_estimates || !$changeControl->completion_of_previous_tasks) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'Meeting And Summary Tab is yet to be filled!',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for CFT actions state'
                        ]);
                    }
                //  if ($management->form_progress !== 'cft')
                //     {
                //         Session::flash('swal', [
                //             'type' => 'warning',
                //             'title' => 'Mandatory Fields!',
                //             'message' => 'QA/CQA initial review / CFT Mandatory Tab is yet to be filled!'
                //         ]);

                //         return redirect()->back();
                //     } else {
                //         Session::flash('swal', [
                //             'type' => 'success',
                //             'title' => 'Success',
                //             'message' => 'Sent for CFT review state'
                //         ]);
                //     }
                //   if (!$Cft->Production_Table_Review || !$Cft->Production_Injection_Review || !$Cft->ProductionLiquid_Review || !$Cft->Store_Review || !$Cft->ResearchDevelopment_Review || !$Cft->Microbiology_Review || !$Cft->RegulatoryAffair_Review || !$Cft->CorporateQualityAssurance_Review || !$Cft->Quality_review || !$Cft->Quality_Assurance_Review || !$Cft->Engineering_review || !$Cft->Environment_Health_review || !$Cft->Human_Resource_review) {
                //             Session::flash('swal', [
                //                 'title' => 'Mandatory Fields Required!',
                //                 'message' => 'CFT Tab is yet to be filled!',
                //                 'type' => 'warning',
                //             ]);

                //             return redirect()->back();
                //         } else {
                //             Session::flash('swal', [
                //                 'type' => 'success',
                //                 'title' => 'Success',
                //                 'message' => 'CFT Action'
                //             ]);
                //         }
               
                 if ( $Cft->Production_Table_Review !== 'Yes' &&
                            $Cft->Production_Injection_Review !== 'Yes' &&
                            $Cft->ProductionLiquid_Review !== 'Yes' &&
                            $Cft->Store_Review !== 'Yes' &&
                            $Cft->ResearchDevelopment_Review !== 'Yes' &&
                            $Cft->Microbiology_Review !== 'Yes' &&
                            $Cft->RegulatoryAffair_Review !== 'Yes' &&
                            $Cft->CorporateQualityAssurance_Review !== 'Yes' &&
                            $Cft->ContractGiver_Review !== 'Yes' &&
                            $Cft->Quality_review !== 'Yes' &&
                            $Cft->Quality_Assurance_Review !== 'Yes' &&
                            $Cft->Engineering_review !== 'Yes' &&
                            $Cft->Environment_Health_review !== 'Yes' &&
                            $Cft->Human_Resource_review !== 'Yes' &&
                            $Cft->Other1_person !== 'Yes' &&
                            $Cft->Other2_person !== 'Yes' &&
                            $Cft->Other3_person !== 'Yes' &&
                            $Cft->Other4_person !== 'Yes' &&
                            $Cft->Other5_person !== 'Yes' 
                            ) {
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
                $changeControl->stage = "4";
                $changeControl->status = 'CFT actions';
                 $stage = new managementCft_Response();
                    $stage->ManagementReview_id = $id;
                    $stage->cft_user_id = Auth::user()->id;
                    $stage->status = "CFT Required";
                    // $stage->cft_stage = ;
                    $stage->comment = $request->comment;
                    $stage->is_required = 1;
                    $stage->save();
                $changeControl->meeting_summary_by = Auth::user()->name;
                $changeControl->meeting_summary_on = Carbon::now()->format('d-M-Y');
                $changeControl->meeting_summary_comment  = $request->comment;
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = 'Meeting and Summary Complete By, Meeting and Summary Complete On';
                $history->action ='Meeting and Summary Complete';
                // $history->previous = $lastDocument->completed_by;
                if (is_null($lastDocument->meeting_summary_by) || $lastDocument->meeting_summary_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->meeting_summary_by . ' , ' . $lastDocument->meeting_summary_on;
                }
                $history->current = $changeControl->meeting_summary_by . ' , ' . $changeControl->meeting_summary_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='Meeting and Summary Complete';
                $history->change_to= "CFT actions";
                $history->change_from= $lastDocument->status;
                if (is_null($lastDocument->meeting_summary_by) || $lastDocument->meeting_summary_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                 $history->save();
                 $changeControl->update();

                //  $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                //  foreach ($list as $u) {
                //      // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getUserEmail($u->user_id);
                //      // dd($email);
                //      if ($email !== null) {
                //          Mail::send(
                //              'mail.view-mail',
                //              ['data' => $changeControl, 'site' => "Ext", 'history' => "Meeting and Summary Complete", 'process' => 'Managment Review', 'comment' => $changeControl->meeting_summary_comment, 'user' => Auth::user()->name],
                //              function ($message) use ($email, $changeControl) {
                //                  $message->to($email)
                //                      ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Meeting and Summary Complete");
                //              }
                //          );
                //      }
                //      // }
                //  }


                //toastr()->success('Document Sent');
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

                    // /////////////////////////////////////////////////////////////
                      $userId = Auth::user()->name;
                    $userAssignments = DB::table('management_cfts')->where(['ManagementReview_id' => $id])->first();
                    $incompleteFields = [];

                    if ($userAssignments->Production_Table_Person == $userId && empty($userAssignments->Production_Table_Assessment)) {
                        $incompleteFields[] = 'Production Table Assessment';
                    }
                    
                    if ($userAssignments->Production_Injection_Person == $userId && empty($userAssignments->Production_Injection_Assessment)) {
                        $incompleteFields[] = 'Production Injection Assessment';
                    }
                    
                    if ($userAssignments->ResearchDevelopment_person == $userId && empty($userAssignments->ResearchDevelopment_assessment)) {
                        $incompleteFields[] = 'Research Development Assessment';
                    }
                    
                    if ($userAssignments->Store_person == $userId && empty($userAssignments->Store_assessment)) {
                        $incompleteFields[] = 'Store assessment';
                    }
                    
                    if ($userAssignments->Quality_Control_Person == $userId && empty($userAssignments->Quality_Control_assessment)) {
                        $incompleteFields[] = 'Quality Control assessment';
                    }
                    
                    if ($userAssignments->QualityAssurance_person == $userId && empty($userAssignments->QualityAssurance_assessment)) {
                        $incompleteFields[] = 'Quality Assurance assessment';
                    }
                    
                    if ($userAssignments->CorporateQualityAssurance_person == $userId && empty($userAssignments->CorporateQualityAssurance_assessment)) {
                        $incompleteFields[] = 'Corporate Quality Assurance Assessment';
                    }

                    if ($userAssignments->RegulatoryAffair_person == $userId && empty($userAssignments->RegulatoryAffair_assessment)) {
                        $incompleteFields[] = 'RegulatoryAffair assessment';
                    }
                    
                    if ($userAssignments->ProductionLiquid_person == $userId && empty($userAssignments->ProductionLiquid_assessment)) {
                        $incompleteFields[] = 'ProductionLiquid assessment';
                    }
                    
                    if ($userAssignments->Microbiology_person == $userId && empty($userAssignments->Microbiology_assessment)) {
                        $incompleteFields[] = 'Microbiology assessment';
                    }
                    
                    if ($userAssignments->Engineering_person == $userId && empty($userAssignments->Engineering_assessment)) {
                        $incompleteFields[] ='Engineering assessment';
                    }
                    
                    if ($userAssignments->Environment_Health_Safety_person == $userId && empty($userAssignments->Health_Safety_assessment)) {
                        $incompleteFields[] = 'Health Safety assessment';
                    }
                    
                    if ($userAssignments->Human_Resource_person == $userId && empty($userAssignments->Human_Resource_assessment)) {
                        $incompleteFields[] = 'Human Resourcec Assessment';
                    }
                    
                    if ($userAssignments->ContractGiver_person == $userId && empty($userAssignments->ContractGiver_assessment)) {
                        $incompleteFields[] = 'ContractGiver Assessment';
                    }
                     if (!empty($incompleteFields)) {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'You must fill your assigned fields for: ' . implode(', ', $incompleteFields) . '.'
                        ]);
                        return redirect()->back();
                    } else {

                    $IsCFTRequired = managementCft_Response::withoutTrashed()->where(['is_required' => 1, 'ManagementReview_id' => $id])->latest()->first();
                    $cftUsers = DB::table('management_cfts')->where(['ManagementReview_id' => $id])->first();
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

    $history = new ManagementAuditTrial();
    $history->ManagementReview_id = $id;
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

    $history = new ManagementAuditTrial();
    $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                           $history->activity_type = 'Production Tablet/Capsule Powder Completed By, Production Tablet/Capsule Powder Completed On';
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
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
                            $stage = new managementCft_Response();
                            $stage->ManagementReview_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "Completed";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        } else {
                            $stage = new managementCft_Response();
                            $stage->ManagementReview_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "In-progress";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        }
                    }

                    $checkCFTCount = managementCft_Response::withoutTrashed()->where(['status' => 'Completed', 'ManagementReview_id' => $id])->count();

                    $Cft = managementCft::withoutTrashed()->where('ManagementReview_id', $id)->first();


                    if (!$IsCFTRequired || $checkCFTCount) {


                        $changeControl->stage = "5";
                        $changeControl->status = "CFT HOD Review";
                         $stage = new hodmanagementCft_Response();
                    $stage->ManagementReview_id = $id;
                    $stage->cft_user_id = Auth::user()->id;
                    $stage->status = "CFT Required";
                    // $stage->cft_stage = ;
                    $stage->comment = $request->comment;
                    $stage->is_required = 1;
                    $stage->save();
                        $changeControl->ALLAICompleteby_by = Auth::user()->name;
                        $changeControl->ALLAICompleteby_on = Carbon::now()->format('d-M-Y');
                        $changeControl->ALLAICompleteby_comment = $request->comment;

                        $history = new ManagementAuditTrial();
                        $history->ManagementReview_id = $id;
                        $history->activity_type = 'CFT Action Complete By, CFT Action Complete On';
                    if(is_null(value: $lastDocument->ALLAICompleteby_by) || $lastDocument->ALLAICompleteby_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->ALLAICompleteby_by. ' ,' . $lastDocument->ALLAICompleteby_on;
                    }
                    $history->action='CFT Action Complete';
                    $history->current = $changeControl->ALLAICompleteby_by. ',' . $changeControl->ALLAICompleteby_on;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "CFT HOD Review";
                        $history->change_from = $lastDocument->status;
                        $history->stage = 'Complete';
                        if(is_null($lastDocument->ALLAICompleteby_by) || $lastDocument->ALLAICompleteby_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                        $history->save();

                //         $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                //  foreach ($list as $u) {
                //      // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getUserEmail($u->user_id);
                //      // dd($email);
                //      if ($email !== null) {
                //          Mail::send(
                //              'mail.view-mail',
                //              ['data' => $changeControl, 'site' => "Ext", 'history' => "CFT Action Complete", 'process' => 'Managment Review', 'comment' => $changeControl->ALLAICompleteby_comment, 'user' => Auth::user()->name],
                //              function ($message) use ($email, $changeControl) {
                //                  $message->to($email)
                //                      ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: CFT Action Complete");
                //              }
                //          );
                //      }
                //      // }
                //  }
                //  $list = Helpers::getHodUserList($changeControl->division_id); // Notify CFT Person
                //  foreach ($list as $u) {
                //      // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getUserEmail($u->user_id);
                //      // dd($email);
                //      if ($email !== null) {
                //          Mail::send(
                //              'mail.view-mail',
                //              ['data' => $changeControl, 'site' => "Ext", 'history' => "CFT Action Complete", 'process' => 'Managment Review', 'comment' => $changeControl->ALLAICompleteby_comment, 'user' => Auth::user()->name],
                //              function ($message) use ($email, $changeControl) {
                //                  $message->to($email)
                //                      ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: CFT Action Complete");
                //              }
                //          );
                //      }
                //      // }
                //  }


                        $changeControl->update();
                    }
                  }    
                    toastr()->success('Document Sent');
                    return back();
                }

            // if ($changeControl->stage == 4) {
            //     $changeControl->stage = "5";
            //     $changeControl->status = 'HOD Final Review';
            //     $changeControl->ALLAICompleteby_by = Auth::user()->name;
            //     $changeControl->ALLAICompleteby_on = Carbon::now()->format('d-M-Y');
            //     $changeControl->ALLAICompleteby_comment  = $request->comment;
            //     $history = new ManagementAuditTrial();
            //     $history->ManagementReview_id = $id;
            //     $history->activity_type = 'CFT Action Complete By     , CFT Action Complete On';
            //     $history->action ='CFT Action Complete';
            //     // $history->previous = $lastDocument->completed_by;
            //     if (is_null($lastDocument->ALLAICompleteby_by) || $lastDocument->ALLAICompleteby_by === '') {
            //         $history->previous = "Null";
            //     } else {
            //         $history->previous = $lastDocument->ALLAICompleteby_by . ' , ' . $lastDocument->ALLAICompleteby_on;
            //     }

            //     $history->current = $changeControl->ALLAICompleteby_by . ' , ' . $changeControl->ALLAICompleteby_on;
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocument->status;
            //     $history->stage='CFT Action Complete';
            //     $history->change_to= "HOD Final Review";
            //     $history->change_from= $lastDocument->status;
            //     if (is_null($lastDocument->ALLAICompleteby_by) || $lastDocument->ALLAICompleteby_by === '') {
            //         $history->action_name = 'New';
            //     } else {
            //         $history->action_name = 'Update';
            //     }
            //      $history->save();
            //      $changeControl->update();

            //     // $list = Helpers::getInitiatorUserList();
            //     // foreach ($list as $u) {
            //     //     if($u->q_m_s_divisions_id == $changeControl->division_id){
            //     //      $email = Helpers::getInitiatorEmail($u->user_id);
            //     //      if ($email !== null) {
            //     //          Mail::send(
            //     //             'mail.view-mail',
            //     //             ['data' => $changeControl],
            //     //             function ($message) use ($email) {
            //     //                 $message->to($email)
            //     //                     ->subject("Document is Send By ".Auth::user()->name);
            //     //             }
            //     //         );
            //     //       }
            //     //     }
            //     // }
            //     toastr()->success('Document Sent');
            //     return back();
            // }

              if ($changeControl->stage == 5) {

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

                     // /////////////////////////////////////////////////////////////
                      $userId = Auth::user()->name;
                    $userAssignments = DB::table('hodmanagement_cfts')->where(['ManagementReview_id' => $id])->first();
                    $incompleteFields = [];

                    if ($userAssignments->hod_Production_Table_Person == $userId && empty($userAssignments->hod_Production_Table_Feedback)) {
                        $incompleteFields[] = 'Production Table Assessment';
                    }
                    
                    if ($userAssignments->hod_Production_Injection_Person == $userId && empty($userAssignments->hod_Production_Injection_Feedback)) {
                        $incompleteFields[] = 'Production Injection Assessment';
                    }
                    
                    if ($userAssignments->hod_ResearchDevelopment_person == $userId && empty($userAssignments->hod_ResearchDevelopment_feedback)) {
                        $incompleteFields[] = 'Research Development Assessment';
                    }
                    
                    if ($userAssignments->hod_Store_person == $userId && empty($userAssignments->hod_Store_feedback)) {
                        $incompleteFields[] = 'Store assessment';
                    }
                    
                    if ($userAssignments->hod_Quality_Control_Person == $userId && empty($userAssignments->hod_Quality_Control_feedback)) {
                        $incompleteFields[] = 'Quality Control assessment';
                    }
                    
                    if ($userAssignments->hod_QualityAssurance_person == $userId && empty($userAssignments->hod_QualityAssurance_feedback)) {
                        $incompleteFields[] = 'Quality Assurance assessment';
                    }
                    
                    if ($userAssignments->hod_CorporateQualityAssurance_person == $userId && empty($userAssignments->hod_CorporateQualityAssurance_feedback)) {
                        $incompleteFields[] = 'Corporate Quality Assurance Assessment';
                    }

                    if ($userAssignments->hod_RegulatoryAffair_person == $userId && empty($userAssignments->hod_RegulatoryAffair_feedback)) {
                        $incompleteFields[] = 'RegulatoryAffair assessment';
                    }
                    
                    if ($userAssignments->hod_ProductionLiquid_person == $userId && empty($userAssignments->hod_ProductionLiquid_feedback)) {
                        $incompleteFields[] = 'ProductionLiquid assessment';
                    }
                    
                    if ($userAssignments->hod_Microbiology_person == $userId && empty($userAssignments->hod_Microbiology_feedback)) {
                        $incompleteFields[] = 'Microbiology assessment';
                    }
                    
                    if ($userAssignments->hod_Engineering_person == $userId && empty($userAssignments->hod_Engineering_feedback)) {
                        $incompleteFields[] ='Engineering assessment';
                    }
                    
                    if ($userAssignments->hod_Environment_Health_Safety_person == $userId && empty($userAssignments->hod_Health_Safety_feedback)) {
                        $incompleteFields[] = 'Health Safety assessment';
                    }
                    
                    if ($userAssignments->hod_Human_Resource_person == $userId && empty($userAssignments->hod_Human_Resource_feedback)) {
                        $incompleteFields[] = 'Human Resourcec Assessment';
                    }
                    
                    // if ($userAssignments->hod_ContractGiver_person == $userId && empty($userAssignments->hod_ContractGiver_feedback)) {
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


                    $IsCFTRequired = hodmanagementCft_Response::withoutTrashed()->where(['is_required' => 1, 'ManagementReview_id' => $id])->latest()->first();
                    $hodcftUsers = DB::table('hodmanagement_cfts')->where(['ManagementReview_id' => $id])->first();
                    // dd($hodcftUsers);
                    // Define the column names
                    $columns2 = ['hod_Quality_Control_Person', 'hod_QualityAssurance_person', 'hod_Engineering_person', 'hod_Environment_Health_Safety_person', 'hod_Human_Resource_person', 'hod_Other1_person', 'hod_Other2_person', 'hod_Other3_person', 'hod_Other4_person', 'hod_Other5_person', 'hod_Production_Table_Person','hod_ProductionLiquid_person','hod_Production_Injection_Person','hod_Store_person','hod_ResearchDevelopment_person','hod_Microbiology_person','hod_RegulatoryAffair_person','hod_CorporateQualityAssurance_person','hod_ContractGiver_person'];
                    // $columns2 = ['Production_review', 'Warehouse_review', 'Quality_Control_review', 'QualityAssurance_review', 'Engineering_review', 'Analytical_Development_review', 'Kilo_Lab_review', 'Technology_transfer_review', 'Environment_Health_Safety_review', 'Human_Resource_review', 'Information_Technology_review', 'Project_management_review'];

                    // Initialize an array to store the values
                    $valuesArray = [];

                    // Iterate over the columns and retrieve the values
                    foreach ($columns2 as $index => $column) {
                        $value = $hodcftUsers->$column;
                        if ($index == 0 && $hodcftUsers->$column == Auth::user()->name) {

    $updatehodCFT->hod_Quality_Control_by = Auth::user()->name;
    $updatehodCFT->hod_Quality_Control_on = Carbon::now()->format('Y-m-d');

    $history = new ManagementAuditTrial();
    $history->ManagementReview_id = $id;
    $history->activity_type = 'HOD Quality Control Completed By, HOD Quality Control Completed On';

    if (is_null($lastDocument->hod_Quality_Control_by) || $lastDocument->hod_Quality_Control_on == '') {
        $history->previous = "";
    } else {
        $history->previous = $lastDocument->hod_Quality_Control_by . ' , ' . $lastDocument->hod_Quality_Control_on;
    }

    $history->action = 'HOD Final Review Complete';

    // Make sure you're using the updated $updatehodCFT object here
    $history->current = $updatehodCFT->hod_Quality_Control_by . ', ' . $updatehodCFT->hod_Quality_Control_on;

    $history->comment = $request->comment;
    $history->user_id = Auth::user()->name;
    $history->user_name = Auth::user()->name;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->stage = 'HOD Final Review';

    if (is_null($lastDocument->hod_Quality_Control_by) || $lastDocument->hod_Quality_Control_on == '') {
        $history->action_name = 'New';
    } else {
        $history->action_name = 'Update';
    }

    $history->save();
}

                     if ($index == 1 && $hodcftUsers->$column == Auth::user()->name) {
    $updatehodCFT->hod_QualityAssurance_by = Auth::user()->name;
    $updatehodCFT->hod_QualityAssurance_on = Carbon::now()->format('Y-m-d'); // Corrected line

    $history = new ManagementAuditTrial();
    $history->ManagementReview_id = $id;
    $history->activity_type = 'HOD Quality Assurance Completed By,HOD Quality Assurance Completed On';

    if (is_null($lastDocument->hod_QualityAssurance_by) || $lastDocument->hod_QualityAssurance_on == '') {
        $history->previous = "";
    } else {
        $history->previous = $lastDocument->hod_QualityAssurance_by . ' ,' .Helpers::getdateFormat ($lastDocument->hod_QualityAssurance_on);
    }

    $history->action = 'HOD Final Review Complete';
    $history->current = $updatehodCFT->hod_QualityAssurance_by . ',' .Helpers::getdateFormat ($updatehodCFT->hod_QualityAssurance_on);
    $history->comment = $request->comment;
    $history->user_id = Auth::user()->id; // Use `id` instead of `name` for `user_id`
    $history->user_name = Auth::user()->name;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->stage = 'HOD Final Review';

    if (is_null($lastDocument->hod_QualityAssurance_by) || $lastDocument->hod_QualityAssurance_on == '') {
        $history->action_name = 'New';
    } else {
        $history->action_name = 'Update';
    }

    $history->save();
}

                        if($index == 2 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_Engineering_by = Auth::user()->name;
                            $updatehodCFT->hod_Engineering_on = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Engineering Completed By, HOD Engineering Completed On';
                    if(is_null($lastDocument->hod_Engineering_by) || $lastDocument->hod_Engineering_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_Engineering_by. ' ,' .Helpers::getdateFormat ($lastDocument->hod_Engineering_on);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_Engineering_by. ',' . Helpers::getdateFormat($updatehodCFT->hod_Engineering_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_Engineering_by) || $lastDocument->hod_Engineering_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 3 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_Environment_Health_Safety_by = Auth::user()->name;
                            $updatehodCFT->hod_Environment_Health_Safety_on = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Safety Completed By, HOD Safety Completed On';
                    if(is_null($lastDocument->hod_Environment_Health_Safety_by) || $lastDocument->hod_Environment_Health_Safety_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_Environment_Health_Safety_by. ' ,' . Helpers::getdateFormat($lastDocument->hod_Environment_Health_Safety_on);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_Environment_Health_Safety_by. ',' . Helpers::getdateFormat($updatehodCFT->hod_Environment_Health_Safety_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_Environment_Health_Safety_by) || $lastDocument->hod_Environment_Health_Safety_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 4 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_Human_Resource_by = Auth::user()->name;
                            $updatehodCFT->hod_Human_Resource_on = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Human Resource Completed By, HOD Human Resource Completed On';
                    if(is_null($lastDocument->hod_Human_Resource_by) || $lastDocument->hod_Human_Resource_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_Human_Resource_by. ' ,' .Helpers::getdateFormat ($lastDocument->hod_Human_Resource_on);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_Human_Resource_by. ',' . Helpers::getdateFormat($updatehodCFT->hod_Human_Resource_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_Human_Resource_by) || $lastDocument->hod_Human_Resource_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                    //     if($index == 5 && $hodcftUsers->$column == Auth::user()->name){
                    //         $updatehodCFT->Information_Technology_by = Auth::user()->name;
                    //         $updatehodCFT->Information_Technology_on = Carbon::now()->format('Y-m-d');
                    //         $history = new ManagementAuditTrial();
                    //         $history->ManagementReview_id = $id;
                    //         $history->activity_type = 'HODCFT Review Completed By, CFT Review Completed On';
                    // if(is_null($lastDocument->Information_Technology_by) || $lastDocument->Information_Technology_on == ''){
                    //     $history->previous = "";
                    // }else{
                    //     $history->previous = $lastDocument->Information_Technology_by. ' ,' . Helpers::getdateFormat($lastDocument->Information_Technology_on);
                    // }
                    // $history->action='CFT Review Complete';
                    // $history->current = $updatehodCFT->Information_Technology_by. ',' . Helpers::getdateFormat($updatehodCFT->Information_Technology_on);
                    //         $history->user_id = Auth::user()->name;
                    //         $history->user_name = Auth::user()->name;
                    //         $history->change_to =   "Not Applicable";
                    //         $history->change_from = $lastDocument->status;
                    //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    //         $history->origin_state = $lastDocument->status;
                    //         $history->stage = 'CFT Review';
                    //         if(is_null($lastDocument->Information_Technology_by) || $lastDocument->Information_Technology_on == '')
                    // {
                    //     $history->action_name = 'New';
                    // } else {
                    //     $history->action_name = 'Update';
                    // }
                    //         $history->save();
                    //     }
                        if($index == 5 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_Other1_by = Auth::user()->name;
                            $updatehodCFT->hod_Other1_on = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Others 1 Completed By, HOD Others 1 Completed On';
                    if(is_null($lastDocument->hod_Other1_by) || $lastDocument->hod_Other1_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_Other1_by. ' ,' .Helpers::getdateFormat ($lastDocument->hod_Other1_on);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_Other1_by. ',' . Helpers::getdateFormat($updatehodCFT->hod_Other1_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_Other1_by) || $lastDocument->hod_Other1_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 6 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_Other2_by = Auth::user()->name;
                            $updatehodCFT->hod_Other2_on = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Others 2 Completed By,HOD Others 2 Completed On';
                    if(is_null($lastDocument->hod_Other2_by) || $lastDocument->hod_Other2_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_Other2_by. ' ,' . Helpers::getdateFormat($lastDocument->hod_Other2_on);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_Other2_by. ',' .Helpers::getdateFormat($updatehodCFT->hod_Other2_on);
                            $history->current = $updatehodCFT->hod_Other2_by;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_Other2_by) || $lastDocument->hod_Other2_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 7 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_Other3_by = Auth::user()->name;
                            $updatehodCFT->hod_Other3_on = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Others 3 Completed By,HOD Others 3 Completed On';
                    if(is_null($lastDocument->hod_Other3_by) || $lastDocument->hod_Other3_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_Other3_by. ' ,' . Helpers::getdateFormat($lastDocument->hod_Other3_on);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_Other3_by. ',' . Helpers::getdateFormat($updatehodCFT->hod_Other3_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_Other3_by) || $lastDocument->hod_Other3_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 8 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_Other4_by = Auth::user()->name;
                            $updatehodCFT->hod_Other4_on = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Others 4 Completed By,HOD Others 4 Completed On';
                    if(is_null($lastDocument->hod_Other4_by) || $lastDocument->hod_Other4_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_Other4_by. ' ,' . Helpers::getdateFormat($lastDocument->hod_Other4_on);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_Other4_by. ',' . Helpers::getdateFormat($updatehodCFT->hod_Other4_on);
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_Other4_by) || $lastDocument->hod_Other4_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 9 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_Other5_by = Auth::user()->name;
                            $updatehodCFT->hod_Other5_on = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Others 5 Completed By, HOD Others 5 Completed On';
                    if(is_null($lastDocument->hod_Other5_by) || $lastDocument->hod_Other5_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_Other5_by. ' ,' . Helpers::getdateFormat($lastDocument->hod_Other5_on);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_Other5_by. ',' . Helpers::getdateFormat($updatehodCFT->hod_Other5_on);
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                           if(is_null($lastDocument->hod_Other5_by) || $lastDocument->hod_Other5_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        // if($index == 11 && $hodcftUsers->$column == Auth::user()->name){
                        //     $updatehodCFT->RA_by = Auth::user()->name;
                        //     $updatehodCFT->RA_on = Carbon::now()->format('Y-m-d');
                        //     $history = new ManagementAuditTrial();
                        //     $history->ManagementReview_id = $id;
                        //     $history->activity_type = 'Activity Log';
                        //     $history->previous = "";
                        //     $history->action= 'CFT Review';
                        //     $history->current = $updatehodCFT->RA_by;
                        //     $history->comment = $request->comment;
                        //     $history->user_id = Auth::user()->name;
                        //     $history->user_name = Auth::user()->name;
                        //     $history->change_to =   "Not Applicable";
                        //     $history->change_from = $lastDocument->status;
                        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        //     $history->origin_state = $lastDocument->status;
                        //     $history->stage = 'CFT Review';
                        //     $history->action_name = "Update";
                        //     $history->save();
                        // }
                        if($index == 10 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_Production_Table_By = Auth::user()->name;
                            $updatehodCFT->hod_Production_Table_On = Carbon::now()->format('Y-m-d');

                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                           $history->activity_type = 'HOD Production Table Completed By,HOD Production Table Completed On';
                    if(is_null($lastDocument->hod_Production_Table_By) || $lastDocument->hod_Production_Table_On == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_Production_Table_By. ' ,' . Helpers::getdateFormat($lastDocument->hod_Production_Table_On);
                    }
                   $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_Production_Table_By. ',' .Helpers::getdateFormat ($updatehodCFT->hod_Production_Table_On);
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_Production_Table_By) || $lastDocument->hod_Production_Table_On == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 11 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_ProductionLiquid_by = Auth::user()->name;
                            $updatehodCFT->hod_ProductionLiquid_on = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Production Liquid Completed By, HOD Production Liquid Completed On';
                    if(is_null($lastDocument->hod_ProductionLiquid_by) || $lastDocument->hod_ProductionLiquid_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_ProductionLiquid_by. ' ,' . Helpers::getdateFormat($lastDocument->hod_ProductionLiquid_on);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_ProductionLiquid_by. ',' . Helpers::getdateFormat($updatehodCFT->hod_ProductionLiquid_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_ProductionLiquid_by) || $lastDocument->hod_ProductionLiquid_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 12 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_Production_Injection_By = Auth::user()->name;
                            $updatehodCFT->hod_Production_Injection_On = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Production Injection Completed By, HOD Production Injection Completed On';
                    if(is_null($lastDocument->hod_Production_Injection_By) || $lastDocument->hod_Production_Injection_On == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_Production_Injection_By. ' ,' .Helpers::getdateFormat( $lastDocument->hod_Production_Injection_On);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_Production_Injection_By. ',' . Helpers::getdateFormat($updatehodCFT->hod_Production_Injection_On);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_Production_Injection_By) || $lastDocument->hod_Production_Injection_On == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 13 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_Store_by = Auth::user()->name;
                            $updatehodCFT->hod_Store_on = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                           $history->activity_type = 'HOD Stores Completed By,HOD Stores Completed On';
                    if(is_null($lastDocument->hod_Store_by) || $lastDocument->hod_Store_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_Store_by. ' ,' .Helpers::getdateFormat( $lastDocument->hod_Store_on);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_Store_by. ',' .Helpers::getdateFormat( $updatehodCFT->hod_Store_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_Store_by) || $lastDocument->hod_Store_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 14 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_ResearchDevelopment_by = Auth::user()->name;
                            $updatehodCFT->hod_ResearchDevelopment_on = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Research & Development Completed By,HOD Research & Development Completed On';
                    if(is_null($lastDocument->hod_ResearchDevelopment_by) || $lastDocument->hod_ResearchDevelopment_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_ResearchDevelopment_by. ' ,' . Helpers::getdateFormat($lastDocument->hod_ResearchDevelopment_on);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_ResearchDevelopment_by. ',' . Helpers::getdateFormat($updatehodCFT->hod_ResearchDevelopment_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_ResearchDevelopment_by) || $lastDocument->hod_ResearchDevelopment_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        // dd($index == 15 && $hodcftUsers->$column == Auth::user()->name);
                        if($index == 15 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_Microbiology_by = Auth::user()->name;
                            $updatehodCFT->hod_Microbiology_on = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Microbiology Completed By,HOD Microbiology Completed On';
                    if(is_null($lastDocument->hod_Microbiology_by) || $lastDocument->hod_Microbiology_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_Microbiology_by. ' ,' . Helpers::getdateFormat($lastDocument->hod_Microbiology_on);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_Microbiology_by. ',' . Helpers::getdateFormat($updatehodCFT->hod_Microbiology_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_Microbiology_by) || $lastDocument->hod_Microbiology_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 16 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_RegulatoryAffair_by = Auth::user()->name;

                            $updatehodCFT->hod_RegulatoryAffair_on = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Regulatory Affair Completed By,HOD Regulatory Affair Completed On';
                    if(is_null($lastDocument->hod_RegulatoryAffair_by) || $lastDocument->hod_RegulatoryAffair_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_RegulatoryAffair_by. ' ,' .Helpers::getdateFormat( $lastDocument->hod_RegulatoryAffair_on);
                    }
                   $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_RegulatoryAffair_by. ',' . Helpers::getdateFormat($updatehodCFT->hod_RegulatoryAffair_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_RegulatoryAffair_by) || $lastDocument->hod_RegulatoryAffair_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }


                        if($index == 17 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_CorporateQualityAssurance_by= Auth::user()->name;
                            $updatehodCFT->hod_CorporateQualityAssurance_on = Carbon::now()->format('Y-m-d');

                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Corporate Quality Assurance Completed By,HOD Corporate Quality Assurance Completed On';
                    if(is_null($lastDocument->hod_CorporateQualityAssurance_by) || $lastDocument->hod_CorporateQualityAssurance_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_CorporateQualityAssurance_by. ' ,' . Helpers::getdateFormat($lastDocument->hod_CorporateQualityAssurance_on);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_CorporateQualityAssurance_by. ',' . Helpers::getdateFormat($updatehodCFT->hod_CorporateQualityAssurance_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_CorporateQualityAssurance_by) ||$lastDocument->hod_CorporateQualityAssurance_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        if($index == 18 && $hodcftUsers->$column == Auth::user()->name){
                            $updatehodCFT->hod_ContractGiver_by = Auth::user()->name;
                            $updatehodCFT->hod_ContractGiver_on = Carbon::now()->format('Y-m-d');
                            $history = new ManagementAuditTrial();
                            $history->ManagementReview_id = $id;
                            $history->activity_type = 'HOD Contract Giver Completed By,HOD Contract Giver Completed On';
                    if(is_null($lastDocument->hod_ContractGiver_by) || $lastDocument->hod_ContractGiver_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hod_ContractGiver_by. ' ,' . Helpers::getdateFormat($lastDocument->hod_ContractGiver_on);
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $updatehodCFT->hod_ContractGiver_by. ',' . Helpers::getdateFormat($updatehodCFT->hod_ContractGiver_on);
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->name;
                            $history->user_name = Auth::user()->name;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'HOD Final Review';
                            if(is_null($lastDocument->hod_ContractGiver_by) || $lastDocument->hod_ContractGiver_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                            $history->save();
                        }
                        $updatehodCFT->update();

                        // Check if the value is not null and not equal to 0
                        if ($value != null && $value != 0) {
                            $valuesArray[] = $value;
                        }
                    }
                    // dd($valuesArray, count(array_unique($valuesArray)), ($cftDetails+1));
                    if ($IsCFTRequired) {
                        if (count(array_unique($valuesArray)) == ($cfthodDetails + 1)) {
                            $stage = new hodmanagementCft_Response();
                            $stage->ManagementReview_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "Completed";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        } else {
                            $stage = new hodmanagementCft_Response();
                            $stage->ManagementReview_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "In-progress";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        }
                    }

                    $checkCFTCount = hodmanagementCft_Response::withoutTrashed()->where(['status' => 'Completed', 'ManagementReview_id' => $id])->count();

                    $hodCft = hodmanagementCft::withoutTrashed()->where('ManagementReview_id', $id)->first();


                    if (!$IsCFTRequired || $checkCFTCount) {


                        $changeControl->stage = "6";
                        $changeControl->status = "QA Verification";
                        $changeControl->hodFinaleReviewComplete_by = Auth::user()->name;
                        $changeControl->hodFinaleReviewComplete_on = Carbon::now()->format('d-M-Y');
                        $changeControl->hodFinaleReviewComplete_comment = $request->comment;

                        $history = new ManagementAuditTrial();
                        $history->ManagementReview_id = $id;
                        $history->activity_type = 'CFT HOD Review Completed By, CFT HOD Review Completed On';
                    if(is_null(value: $lastDocument->hodFinaleReviewComplete_by) || $lastDocument->hodFinaleReviewComplete_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->hodFinaleReviewComplete_by. ' ,' . $lastDocument->hodFinaleReviewComplete_on;
                    }
                    $history->action='CFT HOD Review Complete';
                    $history->current = $changeControl->hodFinaleReviewComplete_by. ',' . $changeControl->hodFinaleReviewComplete_on;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "HOD Final Review";
                        $history->change_from = $lastDocument->status;
                        $history->stage = 'Complete';
                        if(is_null($lastDocument->hodFinaleReviewComplete_by) || $lastDocument->hodFinaleReviewComplete_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                        $history->save();

                //         $list = Helpers::getQAUserList($changeControl->division_id); // Notify CFT Person
                //  foreach ($list as $u) {
                //      // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getUserEmail($u->user_id);
                //      // dd($email);
                //      if ($email !== null) {
                //          Mail::send(
                //              'mail.view-mail',
                //              ['data' => $changeControl, 'site' => "Ext", 'history' => "CFT HOD Review Complete", 'process' => 'Managment Review', 'comment' => $changeControl->hodFinaleReviewComplete_comment, 'user' => Auth::user()->name],
                //              function ($message) use ($email, $changeControl) {
                //                  $message->to($email)
                //                      ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: CFT Review Complete");
                //              }
                //          );
                //      }
                //      // }
                //  }

                        $changeControl->update();
                        }
                    }    
                    toastr()->success('Document Sent');
                    return back();
                }




            // if ($changeControl->stage == 5) {

            //     $changeControl->stage = "6";
            //     $changeControl->status = 'QA Verification';
            //     $changeControl->hodFinaleReviewComplete_by = Auth::user()->name;
            //     $changeControl->hodFinaleReviewComplete_on = Carbon::now()->format('d-M-Y');
            //     $changeControl->hodFinaleReviewComplete_comment  = $request->comment;

            //     $history = new ManagementAuditTrial();
            //     $history->ManagementReview_id = $id;
            //     $history->activity_type = 'CFT HOD Review Complete By, CFT HOD Review Complete On';
            //     $history->action = 'CFT HOD Review Complete';

            //     // Check and assign previous values correctly
            //     if (is_null($lastDocument->hodFinaleReviewComplete_by) || $lastDocument->hodFinaleReviewComplete_by === '') {
            //         $history->previous = "Null";
            //     } else {
            //         // Assign previous user and date correctly
            //         $history->previous = $lastDocument->hodFinaleReviewComplete_by . '  ' . $lastDocument->hodFinaleReviewComplete_on;
            //     }

            //     // Assign current user and date correctly
            //     $history->current = $changeControl->hodFinaleReviewComplete_by . '  ' . $changeControl->hodFinaleReviewComplete_on;

            //     // Other fields in history
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocument->status;
            //     $history->stage = 'HOD Final Review Complete';
            //     $history->change_to = "QA Verification";
            //     $history->change_from = $lastDocument->status;

            //     // Check action name
            //     if (is_null($lastDocument->hodFinaleReviewComplete_by) || $lastDocument->hodFinaleReviewComplete_by === '') {
            //         $history->action_name = 'New';
            //     } else {
            //         $history->action_name = 'Update';
            //     }

            //     // Save history and update the change control
            //     $history->save();
            //     $changeControl->update();

            //     // Success message
            //     toastr()->success('Document Sent');
            //     return back();
            // }


            if ($changeControl->stage == 6) {
                 if (!$changeControl->additional_suport_required) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'QA verification Comment  is yet to be filled!',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for QA Head Closure Approval state'
                        ]);
                    }
                $changeControl->stage = "7";
                $changeControl->status = 'QA Head Closure Approval';
                $changeControl->QAVerificationComplete_by = Auth::user()->name;
                $changeControl->QAVerificationComplete_On = Carbon::now()->format('d-M-Y');
                $changeControl->QAVerificationComplete_Comment  = $request->comment;
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = 'QA Verification Complete By     , QA Verification Complete On';
                $history->action ='QA Verification Complete';
                // $history->previous = $lastDocument->completed_by;
                if (is_null($lastDocument->QAVerificationComplete_by) || $lastDocument->QAVerificationComplete_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->QAVerificationComplete_by . ' , ' . $lastDocument->QAVerificationComplete_On;
                }
                $history->current = $changeControl->QAVerificationComplete_by . ' , ' . $changeControl->QAVerificationComplete_On;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='QA Verification Complete';
                $history->change_to= "QA Head Closure Approval";
                $history->change_from= $lastDocument->status;
                if (is_null($lastDocument->QAVerificationComplete_by) || $lastDocument->QAVerificationComplete_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                 $history->save();
                 $changeControl->update();

                //  $list = Helpers::getQAHeadUserList($changeControl->division_id); // Notify CFT Person
                //  foreach ($list as $u) {
                //      // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getUserEmail($u->user_id);
                //      // dd($email);
                //      if ($email !== null) {
                //          Mail::send(
                //              'mail.view-mail',
                //              ['data' => $changeControl, 'site' => "Ext", 'history' => "QA Verification Complete", 'process' => 'Managment Review', 'comment' => $changeControl->QAVerificationComplete_Comment, 'user' => Auth::user()->name],
                //              function ($message) use ($email, $changeControl) {
                //                  $message->to($email)
                //                      ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA Verification Complete");
                //              }
                //          );
                //      }
                //      // }
                //  }

                //toastr()->success('Document Sent');
                return back();
            }

            if ($changeControl->stage == 7) {
                 if (!$changeControl->conclusion_new) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'QA Head Comment is yet to be filled!',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for Closed - Done state'
                        ]);
                    }
                $changeControl->stage = "8";
                $changeControl->status = 'Closed-Done';
                $changeControl->Approved_by = Auth::user()->name;
                $changeControl->Approved_on = Carbon::now()->format('d-M-Y');
                $changeControl->Approved_comment  = $request->comment;
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = '    Approved By , Approved On';
                $history->action ='Approved';
                // $history->previous = $lastDocument->completed_by;
                if (is_null($lastDocument->Approved_by) || $lastDocument->Approved_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->Approved_by . ' , ' . $lastDocument->Approved_on;
                }
                $history->current = $changeControl->Approved_by . ' , ' . $changeControl->Approved_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='Approved';
                $history->change_to= "Closed-Done";
                $history->change_from= $lastDocument->status;
                if (is_null($lastDocument->Approved_by) || $lastDocument->Approved_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                 $history->save();
                 $changeControl->update();

                //  $list = Helpers::getQAHeadUserList($changeControl->division_id); // Notify CFT Person
                //  foreach ($list as $u) {
                //      // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getUserEmail($u->user_id);
                //      // dd($email);
                //      if ($email !== null) {
                //          Mail::send(
                //              'mail.view-mail',
                //              ['data' => $changeControl, 'site' => "Ext", 'history' => "Approved", 'process' => 'Managment Review', 'comment' => $changeControl->Approved_comment, 'user' => Auth::user()->name],
                //              function ($message) use ($email, $changeControl) {
                //                  $message->to($email)
                //                      ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Approved");
                //              }
                //          );
                //      }
                //      // }
                //  }

                //  $list = Helpers::getQAUserList($changeControl->division_id); // Notify CFT Person
                //  foreach ($list as $u) {
                //      // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getUserEmail($u->user_id);
                //      // dd($email);
                //      if ($email !== null) {
                //          Mail::send(
                //              'mail.view-mail',
                //              ['data' => $changeControl, 'site' => "Ext", 'history' => "Approved", 'process' => 'Managment Review', 'comment' => $changeControl->Approved_comment, 'user' => Auth::user()->name],
                //              function ($message) use ($email, $changeControl) {
                //                  $message->to($email)
                //                      ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Approved");
                //              }
                //          );
                //      }
                //      // }
                //  }

                //  $list = Helpers::getHodUserList($changeControl->division_id); // Notify CFT Person
                //  foreach ($list as $u) {
                //      // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getUserEmail($u->user_id);
                //      // dd($email);
                //      if ($email !== null) {
                //          Mail::send(
                //              'mail.view-mail',
                //              ['data' => $changeControl, 'site' => "Ext", 'history' => "Approved", 'process' => 'Managment Review', 'comment' => $changeControl->Approved_comment, 'user' => Auth::user()->name],
                //              function ($message) use ($email, $changeControl) {
                //                  $message->to($email)
                //                      ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Approved");
                //              }
                //          );
                //      }
                //      // }
                //  }


                //toastr()->success('Document Sent');
                return back();
            }


        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function manage_send_more_require_stage(Request $request, $id)
    {


        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = ManagementReview::find($id);
            $lastDocument =  ManagementReview::find($id);
            $data =  ManagementReview::find($id);



            if ($changeControl->stage == 2) {
                $changeControl->stage = "1";
                $changeControl->status = 'Opened';
                $changeControl->ReturnActivityOpenedstage_By = "Not Applicable";
                $changeControl->ReturnActivityOpenedstage_On = "Not Applicable";
                $changeControl->ReturnActivityOpenedstage_Comment  = $request->comment;
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->action ='More Information Required';
                $history->previous = "Not Applicable";
                // $history->previous = $lastDocument->completed_by;
                // if (is_null($lastDocument->ReturnActivityOpenedstage_By) || $lastDocument->ReturnActivityOpenedstage_By === '') {
                //     $history->previous = "Nulldfdf";
                // } else {
                //     $history->previous = $lastDocument->ReturnActivityOpenedstage_On;
                // }
                $history->current = $changeControl->ReturnActivityOpenedstage_On;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Information Required By';
                $history->change_to = "Opened";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Not Applicable';
                // if (is_null($lastDocument->ReturnActivityOpenedstage_By) || $lastDocument->ReturnActivityOpenedstage_By === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                 $history->save();
                 $changeControl->update();

                //  $list = Helpers::getQAUserList($changeControl->division_id); // Notify CFT Person
                //  foreach ($list as $u) {
                //      // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getUserEmail($u->user_id);
                //      // dd($email);
                //      if ($email !== null) {
                //          Mail::send(
                //              'mail.view-mail',
                //              ['data' => $changeControl, 'site' => "Ext", 'history' => "More Information Required", 'process' => 'Managment Review', 'comment' => $changeControl->ReturnActivityOpenedstage_Comment, 'user' => Auth::user()->name],
                //              function ($message) use ($email, $changeControl) {
                //                  $message->to($email)
                //                      ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //              }
                //          );
                //      }
                //      // }
                //  }
                toastr()->success('Document Sent');
                return back();
            }




            if ($changeControl->stage == 5) {
                $changeControl->stage = "3";
                $changeControl->status = 'Meeting And Summary ';
                $changeControl->requireactivitydepartment_by = "Not Applicable";
                $changeControl->requireactivitydepartment_on = "Not Applicable";
                $changeControl->requireactivitydepartment_comment  = $request->comment;
                 DB::table('management_cft__responses')
                    ->where('ManagementReview_id', $id)
                    ->whereIn('status', ['In-progress', 'Completed'])
                    ->update([
                        'status' => 'Pending',
                        'updated_at' => now(),
                    ]);
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->action = 'More Information Required';
                $history->previous = "Not Applicable";
                // $history->previous = $lastDocument->completed_by;
                // if (is_null($lastDocument->requireactivitydepartment_by) || $lastDocument->requireactivitydepartment_by === '') {
                //     $history->previous = "Null";
                // } else {
                //     $history->previous = $lastDocument->requireactivitydepartment_by;
                // }
                $history->current = $changeControl->requireactivitydepartment_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='More Information Required';
                $history->change_to = "Meeting and Summary";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Not Applicable';
                // if (is_null($lastDocument->requireactivitydepartment_by) || $lastDocument->requireactivitydepartment_by === '') {
                //     $history->action_name = 'Not Applicable';
                // } else {
                //     $history->action_name = 'Not Applicable';
                // }
                 $history->save();
                 $changeControl->update();
                  $Cft = managementCft::where('ManagementReview_id', $changeControl->id)->first();
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

                toastr()->success('Returned to Meeting And Summary stage. CFT Review reopened.');
                return back();
                                }

                 //  $list = Helpers::getQAUserList($changeControl->division_id); // Notify CFT Person
                //  foreach ($list as $u) {
                //      // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getUserEmail($u->user_id);
                //      // dd($email);
                //      if ($email !== null) {
                //          Mail::send(
                //              'mail.view-mail',
                //              ['data' => $changeControl, 'site' => "Ext", 'history' => "More Information Required", 'process' => 'Managment Review', 'comment' => $changeControl->requireactivitydepartment_comment, 'user' => Auth::user()->name],
                //              function ($message) use ($email, $changeControl) {
                //                  $message->to($email)
                //                      ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //              }
                //          );
                //      }
                //      // }
                //  }
                toastr()->success('Document Sent');
                return back();
            }

            if ($changeControl->stage == 6) {
                $changeControl->stage = "3";
                $changeControl->status = 'Meeting And Summary';
                $changeControl->requireactivityHODdepartment_by = "Not Applicable";
                $changeControl->requireactivityHODdepartment_on = "Not Applicable";
                $changeControl->requireactivityHODdepartment_comment  = $request->comment;
                // for cft 
                 DB::table('management_cft__responses')
                    ->where('ManagementReview_id', $id)
                    ->whereIn('status', ['In-progress', 'Completed'])
                    ->update([
                        'status' => 'Pending',
                        'updated_at' => now(),
                    ]);

                 // for hod cft 
                      DB::table('hodmanagement_cft__responses')
                    ->where('ManagementReview_id', $id)
                    ->whereIn('status', ['In-progress', 'Completed'])
                    ->update([
                        'status' => 'Pending',
                        'updated_at' => now(),
                    ]);
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = "Not Applicable";
                $history->action ='More Information Required';
                $history->previous = "Not Applicable";
                // $history->previous = $lastDocument->completed_by;
                // if (is_null($lastDocument->requireactivityHODdepartment_by) || $lastDocument->requireactivityHODdepartment_by === '') {
                //     $history->previous = "Null";
                // } else {
                //     $history->previous =  $lastDocument->requireactivityHODdepartment_on;
                // }
                $history->current =  $changeControl->requireactivityHODdepartment_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='More Information Required';
                $history->change_to = "CFT HOD Review";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Not Applicable";

                // if (is_null($lastDocument->requireactivityHODdepartment_by) || $lastDocument->requireactivityHODdepartment_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                 $history->save();
                 $changeControl->update();
                  $Cft = managementCft::where('ManagementReview_id', $changeControl->id)->first();
                                // if ($Cft) 
                                // {
                                   

                                //     toastr()->success('Returned to Meeting And Summary stage. CFT Review reopened.');
                                //     // return back();
                                // }

                    $hodCft = hodmanagementCft::where('ManagementReview_id', $changeControl->id)->first();
                    // dd( $hodCft);
                                if ($hodCft) {
                                    $hodCft->hod_QualityAssurance_by = null;
                                    $hodCft->hod_QualityAssurance_on = null;
                                    $hodCft->hod_Quality_Control_by = null;
                                    $hodCft->hod_Quality_Control_on = null;
                                    // $hodCft->hod_Warehouse_by = null;
                                    // $hodCft->hod_Warehouse_on = null;
                                    $hodCft->hod_Production_Injection_By = null;
                                    $hodCft->hod_Production_Injection_On = null;
                                    $hodCft->hod_Production_Table_By = null;
                                    $hodCft->hod_Production_Table_On = null;
                                    // $hodCft->hod_RA_by = null;
                                    // $hodCft->hod_RA_on = null;
                                    // $hodCft->hod_production_by = null;
                                    // $hodCft->hod_production_on = null;
                                    $hodCft->hod_ResearchDevelopment_by = null;
                                    $hodCft->hod_ResearchDevelopment_on = null;
                                    $hodCft->hod_Human_Resource_by = null;
                                    $hodCft->hod_Human_Resource_on = null;
                                    $hodCft->hod_CorporateQualityAssurance_by = null;
                                    $hodCft->hod_CorporateQualityAssurance_on = null;
                                    $hodCft->hod_Store_by = null;
                                    $hodCft->hod_Store_on = null;
                                    $hodCft->hod_Engineering_by = null;
                                    $hodCft->hod_Engineering_on = null;
                                    $hodCft->hod_RegulatoryAffair_by = null;
                                    $hodCft->hod_RegulatoryAffair_on = null;
                                    $hodCft->hod_QualityAssurance_by = null;
                                    $hodCft->hod_QualityAssurance_on = null;
                                    $hodCft->hod_ProductionLiquid_by = null;
                                    $hodCft->hod_ProductionLiquid_on = null;
                                    $hodCft->hod_Quality_Control_by = null;
                                    $hodCft->hod_Quality_Control_on = null;
                                    $hodCft->hod_Microbiology_by = null;
                                    $hodCft->hod_Microbiology_on = null;
                                    $hodCft->hod_Environment_Health_Safety_by = null;
                                    $hodCft->hod_Environment_Health_Safety_on = null;
                                    // $hodCft->hod_ContractGiver_by = null;
                                    // $hodCft->hod_ContractGiver_on = null;
                                    $hodCft->hod_Other1_by = null;
                                    $hodCft->hod_Other1_on = null;
                                    $hodCft->hod_Other2_by = null;
                                    $hodCft->hod_Other2_on = null;
                                    $hodCft->hod_Other3_by = null;
                                    $hodCft->hod_Other3_on = null;
                                    $hodCft->hod_Other4_by = null;
                                    $hodCft->hod_Other4_on = null;
                                    $hodCft->hod_Other5_by = null;
                                    $hodCft->hod_Other5_on = null;
                                    $hodCft->save();

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

                // toastr()->success('Returned to Meeting And Summary stage. CFT Review reopened.');
                return back();
                                }
//                $hodCft = hodmanagementCft::where('ManagementReview_id', $changeControl->id)->first();

// $hodCft->hod_Production_Table_By = 'temp';
// $hodCft->hod_Production_Table_On = now();
// $hodCft->save();

// $hodCft->hod_Production_Table_By = null;
// $hodCft->hod_Production_Table_On = null;
// $hodCft->save();

// dd($hodCft->fresh());             //  $list = Helpers::getQAUserList($changeControl->division_id); // Notify CFT Person
                //  foreach ($list as $u) {
                //      // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getUserEmail($u->user_id);
                //      // dd($email);
                //      if ($email !== null) {
                //          Mail::send(
                //              'mail.view-mail',
                //              ['data' => $changeControl, 'site' => "Ext", 'history' => "More Information Required", 'process' => 'Managment Review', 'comment' => $changeControl->requireactivityHODdepartment_comment, 'user' => Auth::user()->name],
                //              function ($message) use ($email, $changeControl) {
                //                  $message->to($email)
                //                      ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //              }
                //          );
                //      }
                //      // }
                //  }
                toastr()->success('Document Sent');
                return back();
            }

            if ($changeControl->stage == 7) {
                $changeControl->stage = "6";
                $changeControl->status = 'QA Verification';
                $changeControl->requireactivityQAdepartment_by = 'Not Applicable';
                $changeControl->requireactivityQAdepartment_on = 'Not Applicable';
                $changeControl->requireactivityQAdepartment_comment  = $request->comment;
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->action ='More Information Required';
                $history->previous = "Not Applicable";
                // $history->previous = $lastDocument->completed_by;
                // if (is_null($lastDocument->requireactivityQAdepartment_by) || $lastDocument->requireactivityQAdepartment_by === '') {
                //     $history->previous = "Null";
                // } else {
                //     $history->previous = $lastDocument->requireactivityQAdepartment_by . ' , ' . $lastDocument->requireactivityQAdepartment_on;
                // }
                $history->current = $changeControl->requireactivityQAdepartment_by . ' , ' . $changeControl->requireactivityQAdepartment_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='More Information Required';
                $history->change_to = "QA Verification";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Not Applicable';
                // if (is_null($lastDocument->requireactivityQAdepartment_by) || $lastDocument->requireactivityQAdepartment_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                 $history->save();
                 $changeControl->update();

                 //  $list = Helpers::getQAUserList($changeControl->division_id); // Notify CFT Person
                //  foreach ($list as $u) {
                //      // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getUserEmail($u->user_id);
                //      // dd($email);
                //      if ($email !== null) {
                //          Mail::send(
                //              'mail.view-mail',
                //              ['data' => $changeControl, 'site' => "Ext", 'history' => "More Information Required", 'process' => 'Managment Review', 'comment' => $changeControl->requireactivityQAdepartment_comment, 'user' => Auth::user()->name],
                //              function ($message) use ($email, $changeControl) {
                //                  $message->to($email)
                //                      ->subject("Agio Notification: Managment Review, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //              }
                //          );
                //      }
                //      // }
                //  }
                toastr()->success('Document Sent');
                return back();
            }






        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
   public function managementIsCFTRequired(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = ManagementReview::find($id);
            $lastDocument = ManagementReview::find($id);
            $list = Helpers::getInitiatorUserList();
            $changeControl->stage = "5";
            $changeControl->status = "QA/CQA Final Review";
            $changeControl->ALLAICompleteby_by = Auth::user()->name;
            $changeControl->ALLAICompleteby_on = Carbon::now()->format('d-M-Y');
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = "";
            $history->current = $changeControl->ALLAICompleteby_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage = 'Send to HOD';



            $history->save();
            $changeControl->update();
            $history = new managementHistory();
            $history->type = "Management Review";
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



    public function managementReport($id)
    {
        $management = ManagementReview::find($id);
        $data1 =  managementCft::where('ManagementReview_id', $id)->first();
        $data5 =  hodmanagementCft::where('ManagementReview_id', $id)->first();
        // $data1 =  ManagementReviewDocDetails::where('review_id',$id)->where('type',"agenda")->first();
        $data1->review_id = $management->id;
        $data1->type = "agenda";
        $agenda=$data1;
         $data2 =  ManagementReviewDocDetails::where('review_id',$id)->where('type',"management_review_participants")->first();
        $data2->review_id = $management->id;
        $data2->type = "management_review_participants";
        $management_review_participants=$data2;
          $data3 =  ManagementReviewDocDetails::where('review_id',$id)->where('type',"performance_evaluation")->first();
        $data3->review_id = $management->id;
        $data3->type = "performance_evaluation";
        $performance_evaluation=$data3;
          $data4 =  ManagementReviewDocDetails::where('review_id',$id)->where('type',"action_item_details")->first();
        $data4->review_id = $management->id;
        $data4->type = "action_item_details";
        $action_item_details=$data4;
        //  $data5 =  ManagementReviewDocDetails::where('review_id',$id)->where('type',"capa_detail_details")->first();
        // $data5->review_id = $management->id;
        // $data5->type = "capa_detail_details";
        // $capa_detail_details=$data5;
        $users = User::all();
        //   $data5 =  ManagementReviewDocDetails::where('review_id',$id)->where('type',"capa_detail")->first();
        // $data5->review_id = $management->id;
        // $data5->type = "capa_detail";
        // $capa_detail=$data5;
        $managementReview = ManagementReview::find($id);
        $managementReview->internalAudit = InternalAudit::all();
        $managementReview->externalAudit = Auditee::all();
        $managementReview->capa = Capa::all();
        $managementReview->auditProgram = AuditProgram::all();
        $managementReview->LabIncident = LabIncident::all();
        $managementReview->riskAnalysis = RiskManagement::all();
        $managementReview->rootCause = RootCauseAnalysis::all();
        $managementReview->changeControl = CC::all();
        $managementReview->actionItem = ActionItem::all();
        $managementReview->effectiveNess = EffectivenessCheck::all();
        $pdf = PDF::loadview('frontend.management-review.report', compact('managementReview', 'agenda','management_review_participants', 'performance_evaluation','action_item_details', 'data1','data2','data3','data4','users','data5'))
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
        $canvas->page_text($width / 4, $height / 2, $managementReview->status, null, 25, [0, 0, 0], 2, 6, -20);
        return $pdf->stream('Management-Review' . $id . '.pdf');


    }


    public function child_management_Review(Request $request, $id)
    {
        $parent_id = $id;
        $parent_initiator_id = ManagementReview::where('id', $id)->value('initiator_id');
        $parent_division_id = ManagementReview::where('id', $id)->value('division_id');
        $parent_type = "Management Review";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $parent_record = $record_number;
        $data1 = ManagementReview::find($id);
        $currentDate = Carbon::now();
        $parent_intiation_date = $currentDate;
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $old_record = ManagementReview::select('id', 'division_id', 'record')->get();
        $record=$record_number;
        $parentRecord = ManagementReview::where('id', $id)->value('record');
        $p_record = ManagementReview::find($id);
        $data_record = Helpers::getDivisionName($p_record->division_id ) . '/' . 'MR' .'/' . date('Y') .'/' . str_pad($p_record->record, 4, '0', STR_PAD_LEFT);

        return view('frontend.action-item.action-item', compact('parent_intiation_date', 'parentRecord', 'data1','parent_initiator_id','parent_record', 'record', 'due_date','parent_division_id', 'parent_id', 'parent_type','old_record', 'data_record'));
    }

    public static function managementReviewReport($id)
    {
        $doc = ManagementReview::find($id);
        $audit = ManagementAuditTrial::where('ManagementReview_id', $id)->orderByDesc('id')->get();
        $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        $data = ManagementAuditTrial::where('ManagementReview_id', $doc->id)->orderByDesc('id')->get();
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.management-review.auditReport', compact('data','audit' ,'doc'))
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


    public function audit_trail_managementReview_filter(Request $request, $id)
{
    // Start query for managementAuditTrail
    $query = ManagementAuditTrial::query();
    $query->where('ManagementReview_id', $id);

    // Check if typedata is provided
    if ($request->filled('typedata')) {
        switch ($request->typedata) {
            case 'cft_review':
                // Filter by specific CFT review actions
                $cft_field = ['CFT Review Complete','CFT Review Not Required',];
                $query->whereIn('action', $cft_field);
                break;

            case 'stage':
                // Filter by activity log stage changes
                $stage=['Submit','Completed','More Information Required','QA Head Review Complete','Meeting and Summary Complete',
                'CFT Action Complete','HOD Final Review Complete','QA Verification Complete',''];
                $query->whereIn('action', $stage); // Ensure correct activity_type value
                break;

            case 'user_action':
                // Filter by various user actions
                $user_action = [  'Submit', 'HOD Review Complete', 'QA/CQA Initial Review Complete','Request For Cancellation','CFT Action Complete','CFT HOD Review Complete',
                    'CFT Review Complete', 'QA/CQA Final Assessment Complete', 'Approved','Send to Initiator','Send to HOD','Send to QA/CQA Initial Review','Send to Pending Initiator Update',
                    'QA/CQA Final Review Complete', 'Rejected', 'Initiator Updated Complete',
                    'HOD Final Review Complete', 'More Info Required', 'Cancel','Implementation verification Complete','Closure Approved'];
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
    $responseHtml = view('frontend.management-review.management_filter', compact('audit', 'filter_request'))->render();

    return response()->json(['html' => $responseHtml]);
}


}
