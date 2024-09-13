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

        if (!$request->short_description) {
            toastr()->error("Short description is required");
            return redirect()->back();
        }
        $management = new ManagementReview();
        //$management->record_number = ($request->record_number);
        // $management->assign_to = 1;//$request->assign_to;

         $management->priority_level = $request->priority_level;
         $management->assign_to= $request->assign_to;
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
        $management->intiation_date = $request->intiation_date;
        $management->division_code = $request->division_code;
        // $management->Initiator_id = $request->Initiator_id;
        $management->short_description = $request->short_description;
        $management->assigned_to = $request->assigned_to;
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
                    $name = $request->name . 'inv_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
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


            $Cft->hod_Quality_Control_attachment = json_encode($files);
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


            $Cft->hod_Quality_Assurance_attachment = json_encode($files);
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


            $Cft->hod_Engineering_attachment = json_encode($files);
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


            $Cft->hod_Analytical_Development_attachment = json_encode($files);
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


            $Cft->hod_Technology_transfer_attachment = json_encode($files);
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


            $Cft->hod_Environment_Health_Safety_attachment = json_encode($files);
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


            $Cft->hod_Human_Resource_attachment = json_encode($files);
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


            $Cft->hod_Project_management_attachment = json_encode($files);
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


            $Cft->hod_Other1_attachment = json_encode($files);
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


            $Cft->hod_Other2_attachment = json_encode($files);
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


            $Cft->hod_Other3_attachment = json_encode($files);
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


            $Cft->hod_Other4_attachment = json_encode($files);
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


            $Cft->hod_Other5_attachment = json_encode($files);
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
        if (!empty($request->meeting_Attended)) {
            $data3->meeting_Attended = serialize($request->meeting_Attended);
        }
        if (!empty($request->designee_Name)) {
            $data3->designee_Name = serialize($request->designee_Name);
        }
        if (!empty($request->designee_Department)) {
            $data3->designee_Department = serialize($request->designee_Department);
        }
        if (!empty($request->remarks)) {
            $data3->remarks = serialize($request->remarks);
        }
        $data3->save();

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
         
        if (!empty($management->assigned_to)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Assigned To';
        $history->previous = "Null";
        $history->current = $management->assigned_to;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }


        if (!empty($management->due_date)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Date Due';
        $history->previous = "Null";
        $history->current = Helpers::getdateFormat($management->due_date);
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }


        if (!empty($management->type)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Type';
        $history->previous = "Null";
        $history->current = $management->type;
        $history->comment = "NA";
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


        if (!empty($management->end_date)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Scheduled end date';
        $history->previous = "Null";
        $history->current = $management->end_date;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }


        if (!empty($management->Attendess)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Attendess';
        $history->previous = "Null";
        $history->current = $management->attendees;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }


        if (!empty($management->Agenda)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Agenda';
        $history->previous = "Null";
        $history->current = $management->agenda;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        
        if (!empty($management->performance_evaluation)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Performance Evaluation';
        $history->previous = "Null";
        $history->current = $management->performance_evaluation;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($management->management_review_participants)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Management Review Participants';
        $history->previous = "Null";
        $history->current = $management->management_review_participants;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($management->action_item_details)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Action Item Details';
        $history->previous = "Null";
        $history->current = $management->action_item_details;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($management->capa_detail_details)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'CAPA Details';
        $history->previous = "Null";
        $history->current = $management->capa_detail_details;
        $history->comment = "NA";
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


        if (!empty($management->attachment)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Attached Files';
        $history->previous = "Null";
        $history->current = $management->attachment;
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
        $history->activity_type = 'Inv Attachment';
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
         
        if (!empty($management->file_attchment_if_any)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'File Attachment';
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
         
        if (!empty($management->closure_attachments)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'File Attachment';
        $history->previous = "Null";
        $history->current = $management->closure_attachments;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($management->actual_start_date)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Actual Start Date';
        $history->previous = "Null";
        $history->current = $management->actual_start_date;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($management->actual_end_date)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Actual End Date';
        $history->previous = "Null";
        $history->current = $management->actual_end_date;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }


        if (!empty($management->meeting_minute)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Meeting minutes';
        $history->previous = "Null";
        $history->current = $management->meeting_minute;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }


        if (!empty($management->decision)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Decisions';
        $history->previous = "Null";
        $history->current = $management->decision;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }


        if (!empty($management->zone)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Zone';
        $history->previous = "Null";
        $history->current = $management->zone;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to= "Opened";
        $history->change_from= "Initiation";
        $history->action_name="Create";
        $history->save();
        $history->save();
        }

        if (!empty($management->country)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Country';
        $history->previous = "Null";
        $history->current = $management->country;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to= "Opened";
        $history->change_from= "Initiation";
        $history->action_name="Create";
        $history->save();
        $history->save();
        }

        if (!empty($management->city)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'City';
        $history->previous = "Null";
        $history->current = $management->city;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }


        if (!empty($management->site_name)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Site Name';
        $history->previous = "Null";
        $history->current = $management->site_name;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }


        if (!empty($management->building)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Building';
        $history->previous = "Null";
        $history->current = $management->building;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }


        if (!empty($management->floor)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Floor';
        $history->previous = "Null";
        $history->current = $management->floor;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
           $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }


        if (!empty($management->room)) {
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Room';
        $history->previous = "Null";
        $history->current = $management->room;
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
            $history->activity_type = 'QA review comment ';
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
         if(!empty($management->control_externally_provide_services)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Requirements for Products';
            $history->previous = "Null";
            $history->current = $management->control_externally_provide_services;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
          if (!empty($management->production_service_provision)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Design and Development';
            $history->previous = "Null";
            $history->current = $management->production_service_provision;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
          if(!empty($management->release_product_services)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Control of Externally';
            $history->previous = "Null";
            $history->current = $management->release_product_services;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($management->Production_and_Service)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Production and Service';
            $history->previous = "Null";
            $history->current = $management->Production_and_Service;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
         if (!empty($management->release_product_services)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Release of Products';
            $history->previous = "Null";
            $history->current = $management->release_product_services;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
            if (!empty($management->control_nonconforming_outputs)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Control of Non';
            $history->previous = "Null";
            $history->current = $management->control_nonconforming_outputs;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($management->risk_opportunities)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Risk Opportunities';
            $history->previous = "Null";
            $history->current = $management->risk_opportunities;
            $history->comment = "Not Applicable";
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
          if(!empty($management->production_new)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Production';
            $history->previous = "Null";
            $history->current = $management->production_new;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
         if (!empty($management->plans_new)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Plans';
            $history->previous = "Null";
            $history->current = $management->plans_new;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($management->forecast_new)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Forecast';
            $history->previous = "Null";
            $history->current = $management->forecast_new;
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
            $history->activity_type = 'Any Additional Support Required';
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

        if (!empty($management->file_attchment_if_any)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'file attach';
            $history->previous = "Null";
            $history->current = $management->file_attchment_if_any;
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
            $history->activity_type = 'Date Due';
            $history->previous = "Null";
            $history->current = $management->next_managment_review_date;
            $history->comment = "Not Applicable";
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
            $history->activity_type = 'Summary Recommendation';
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
          if(!empty($management->conclusion_new)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Conclusion';
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
            $history->activity_type = 'file attachment';
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

        if (!empty($management->due_date_extension)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Due_Date_Extension_Justification';
            $history->previous = "Null";
            $history->current = $management->due_date_extension;
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

          if (!empty($management->cft_hod_attach)) {
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Review Period (Monthly)';
            $history->previous = "Null";
            $history->current = $management->cft_hod_attach;
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
            $history->activity_type = 'Review Period (Six Monthly)';
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

    

        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }

    public function manageUpdate(Request $request, $id)
    {

         $form_progress = null;
        if (!$request->short_description) {
            toastr()->error("Short description is required");
            return redirect()->back();
        }
        $lastDocument = ManagementReview::find($id);
        $management = ManagementReview::find($id);
        $lastCft = managementCft::where('ManagementReview_id', $management->id)->first();
        $lastCft = hodmanagementCft::where('ManagementReview_id', $management->id)->first();
        $management->initiator_id = Auth::user()->id;
        $management->division_code = $request->division_code;
        // $management->Initiator_id= $request->Initiator_id;
        $management->short_description = $request->short_description;
        $management->assigned_to = $request->assigned_to;
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
        $management->assign_to = $request->assign_to;
        $management->initiator_group_code= $request->initiator_group_code;
        $management->Operations= $request->Operations;
        $management->initiator_Group= $request->initiator_Group;
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

       $attachments = json_decode($management->inv_attachment, true) ?? [];
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
               if (!empty ($request->hod_Quality_Control_attachment)) {
            $files = [];
            if ($request->hasfile('hod_Quality_Control_attachment')) {
                foreach ($request->file('hod_Quality_Control_attachment') as $file) {
                    $name = $request->name . 'hod_Quality_Control_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->hod_Quality_Control_attachment = json_encode($files);
        }
        $Cft->save();

           $hodCft = hodmanagementCft::withoutTrashed()->where('ManagementReview_id', $id)->first();
        if($hodCft && $management->stage == 5 ){

            $hodCft->hod_Production_Table_Review = $request->hod_Production_Table_Review ?? $hodCft->hod_Production_Table_Review;
            $hodCft->hod_Production_Table_Person = $request->hod_Production_Table_Person ?? $hodCft->hod_Production_Table_Person;
            // dd($request->hod_Production_Table_Person);

            $hodCft->hod_Production_Injection_Review = $request->hod_Production_Injection_Review ?? $hodCft->hod_Production_Injection_Review;
            $hodCft->hod_Production_Injection_Person = $request->hod_Production_Injection_Person ?? $hodCft->hod_Production_Injection_Person;

            $hodCft->hod_ProductionLiquid_Review = $request->hod_ProductionLiquid_Review ?? $hodCft->hod_ProductionLiquid_Review;
            $hodCft->hod_ProductionLiquid_person = $request->hod_ProductionLiquid_person ?? $hodCft->hod_ProductionLiquid_person;

            $hodCft->hod_Store_person = $request->hod_Store_person ?? $hodCft->hod_Store_person;
            $hodCft->hod_Store_Review = $request->hod_Store_Review ?? $hodCft->hod_Store_Review;

            $hodCft->hod_ResearchDevelopment_person = $request->hod_ResearchDevelopment_person ?? $hodCft->hod_ResearchDevelopment_person;
            $hodCft->hod_ResearchDevelopment_Review = $request->hod_ResearchDevelopment_Review ?? $hodCft->hod_ResearchDevelopment_Review;

            $hodCft->hod_Microbiology_person = $request->hod_Microbiology_person ?? $hodCft->hod_Microbiology_person;
            $hodCft->hod_Microbiology_Review = $request->hod_Microbiology_Review ?? $hodCft->hod_Microbiology_Review;

            $hodCft->hod_RegulatoryAffair_person = $request->hod_RegulatoryAffair_person ?? $hodCft->hod_RegulatoryAffair_person;
            $hodCft->hod_RegulatoryAffair_Review = $request->hod_RegulatoryAffair_Review ?? $hodCft->hod_RegulatoryAffair_Review;

            $hodCft->hod_CorporateQualityAssurance_person = $request->hod_CorporateQualityAssurance_person ?? $hodCft->hod_CorporateQualityAssurance_person;
            $hodCft->hod_CorporateQualityAssurance_Review = $request->hod_CorporateQualityAssurance_Review ?? $hodCft->hod_CorporateQualityAssurance_Review;

            $hodCft->hod_ContractGiver_person = $request->hod_ContractGiver_person ?? $hodCft->hod_ContractGiver_person;
            $hodCft->hod_ContractGiver_Review = $request->hod_ContractGiver_Review ?? $hodCft->hod_ContractGiver_Review;

            $hodCft->hod_Quality_review = $request->hod_Quality_review ?? $hodCft->hod_Quality_review;
            $hodCft->hod_Quality_Control_Person = $request->hod_Quality_Control_Person ?? $hodCft->hod_Quality_Control_Person;

            $hodCft->hod_QualityAssurance_Review = $request->hod_QualityAssurance_Review ?? $hodCft->hod_QualityAssurance_Review;
            $hodCft->hod_QualityAssurance_person = $request->hod_QualityAssurance_person ?? $hodCft->hod_QualityAssurance_person;

            $hodCft->hod_Engineering_review = $request->hod_Engineering_review ?? $hodCft->hod_Engineering_review;
            $hodCft->hod_Engineering_person = $request->hod_Engineering_person ?? $hodCft->hod_Engineering_person;

            $hodCft->hod_Environment_Health_review = $request->Environment_Health_review ?? $hodCft->hod_Environment_Health_review;
            $hodCft->hod_Environment_Health_Safety_person = $request->Environment_Health_Safety_person ?? $hodCft->hod_Environment_Health_Safety_person;

            $hodCft->hod_Human_Resource_review = $request->hod_Human_Resource_review ?? $hodCft->hod_Human_Resource_review;
            $hodCft->hod_Human_Resource_person = $request->hod_Human_Resource_person ?? $hodCft->hod_Human_Resource_person;

            $hodCft->hod_Other1_review = $request->hod_Other1_review ?? $hodCft->hod_Other1_review;
            $hodCft->hod_Other1_person = $request->hod_Other1_person ?? $hodCft->hod_Other1_person;

            $hodCft->hod_Other2_review = $request->hod_Other2_review ?? $hodCft->hod_Other2_review;
            $hodCft->hod_Other2_person = $request->hod_Other2_person ?? $hodCft->hod_Other2_person;

            $hodCft->hod_Other3_review = $request->hod_Other3_review ?? $hodCft->hod_Other3_review;
            $hodCft->hod_Other3_person = $request->hod_Other3_person ?? $hodCft->hod_Other3_person;

            $hodCft->hod_Other4_review = $request->hod_Other4_review ?? $hodCft->hod_Other4_review;
            $hodCft->hod_Other4_person = $request->hod_Other4_person ?? $hodCft->hod_Other4_person;

            $hodCft->hod_Other5_review = $request->hod_Other5_review ?? $hodCft->hod_Other5_review;
            $hodCft->hod_Other5_person = $request->hod_Other5_person ?? $hodCft->hod_Other5_person;

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

            $hodCft->hod_Warehouse_feedback = $request->hod_Warehouse_feedback;
            $hodCft->hod_Warehouse_assessment = $request->hod_Warehouse_assessment;

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

            $hodCft->hod_Other1_assessment = $request->hod_Other1_assessment;
            $hodCft->hod_Other1_feedback = $request->hod_Other1_feedback;

            $hodCft->hod_Other2_Assessment = $request->hod_Other2_Assessment;
            $hodCft->hod_Other2_feedback = $request->hod_Other2_feedback;

            $hodCft->hod_Other3_Assessment = $request->hod_Other3_Assessment;
            $hodCft->hod_Other3_feedback = $request->hod_Other3_feedback;

            $hodCft->hod_Other4_Assessment = $request->hod_Other4_Assessment;
            $hodCft->Other4_feedback = $request->Other4_feedback;

            $hodCft->hod_Other5_Assessment = $request->hod_Other5_Assessment;
            $hodCft->hod_Other5_feedback = $request->hod_Other5_feedback;



 
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
        if (!empty ($request->Information_Technology_attachment)) {
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
        if ($request->hasfile('inv_attachment')) {
            $files = [];
            foreach ($request->file('inv_attachment') as $file) {
                $name = $request->name . 'inv_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] = $name;
            }
            // Merge the new files with the existing ones
            $attachments = array_merge($attachments, $files);
        }
        // Save the updated attachments list
        $management->inv_attachment = json_encode(array_values($attachments));







        if (!empty($request->file_attchment_if_any)) {
            $files = [];
            if ($request->hasfile('file_attchment_if_any')) {
                foreach ($request->file('file_attchment_if_any') as $file) {
                    $name = $request->name . 'file_attchment_if_any' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $management->file_attchment_if_any = json_encode($files);
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
            $management->closure_attachments = json_encode($files);
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
        

        if ($lastDocument->assigned_to != $management->assigned_to || !empty($request->assigned_to_comment)) {
         $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Short Description')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Assigned To';
            $history->previous = $lastDocument->assigned_to;
            $history->current = $management->assigned_to;
            $history->comment = $request->assigned_to_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->due_date != $management->due_date || !empty($request->due_date_comment)) {
            $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Date Due')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Date Due';
            $history->previous = Helpers::getdateFormat ($lastDocument->due_date);
            $history->current = Helpers::getdateFormat ($management->due_date);
            $history->comment = $request->due_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->type != $management->type || !empty($request->type_comment)) {
         $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Type')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Type';
            $history->previous = $lastDocument->type;
            $history->current = $management->type;
            $history->comment = $request->type_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
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
        if ($lastDocument->end_date != $management->end_date || !empty($request->end_date_comment)) {
        $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Scheduled end date')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Scheduled end date';
            $history->previous = $lastDocument->end_date;
            $history->current = $management->end_date;
            $history->comment = $request->end_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->attendees != $management->attendees || !empty($request->attendees_comment)) {
         $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Attendess')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Attendess';
            $history->previous = $lastDocument->attendees;
            $history->current = $management->attendees;
            $history->comment = $request->attendees_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->agenda != $management->agenda || !empty($request->agenda_comment)) {
         $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Agenda')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Agenda';
            $history->previous = $lastDocument->agenda;
            $history->current = $management->agenda;
            $history->comment = $request->agenda_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->performance_evaluation != $management->performance_evaluation || !empty($request->performance_evaluation_comment)) {
        $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Performance Evaluation')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Performance Evaluation';
            $history->previous = $lastDocument->performance_evaluation;
            $history->current = $management->performance_evaluation;
            $history->comment = $request->performance_evaluation_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->management_review_participants != $management->management_review_participants || !empty($request->management_review_participants_comment)) {
        $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Management Review Participants')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Management Review Participants';
            $history->previous = $lastDocument->management_review_participants;
            $history->current = $management->management_review_participants;
            $history->comment = $request->management_review_participants_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }

        if ($lastDocument->action_item_details != $management->action_item_details || !empty($request->action_item_details_comment)) {
         $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Action Item Details')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = ' Action Item Details';
            $history->previous = $lastDocument->action_item_details;
            $history->current = $management->action_item_details;
            $history->comment = $request->action_item_details_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->capa_detail_details != $management->capa_detail_details || !empty($request->capa_detail_details_comment)) {
         $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'CAPA Details')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = '  CAPA Details';
            $history->previous = $lastDocument->capa_detail_details;
            $history->current = $management->capa_detail_details;
            $history->comment = $request->capa_detail_details_comment;
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
        if ($lastDocument->attachment != $management->attachment || !empty($request->attachment_comment)) {
            $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Attached Files')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Attached Files';
            $history->previous = $lastDocument->attachment;
            $history->current = $management->attachment;
            $history->comment = $request->attachment_comment;
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
                            ->where('activity_type', 'Inv Attachment')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Inv Attachment';
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
        
        if ($lastDocument->file_attchment_if_any != $management->file_attchment_if_any || !empty($request->file_attchment_if_any_comment)) {
         $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'File Attachment')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'File Attachment';
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
        if ($lastDocument->actual_start_date != $management->actual_start_date || !empty($request->actual_start_date_comment)) {
          $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Actual Start Date')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Actual Start Date';
            $history->previous = $lastDocument->actual_start_date;
            $history->current = $management->actual_start_date;
            $history->comment = $request->actual_start_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->actual_end_date != $management->actual_end_date || !empty($request->actual_end_date_comment)) {
         $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Actual End Date')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Actual End Date';
            $history->previous = $lastDocument->actual_end_date;
            $history->current = $management->actual_end_date;
            $history->comment = $request->actual_end_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->meeting_minute != $management->meeting_minute || !empty($request->meeting_minute_comment)) {
            $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Meeting minutes')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Meeting minutes';
            $history->previous = $lastDocument->meeting_minute;
            $history->current = $management->meeting_minute;
            $history->comment = $request->meeting_minute_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->decision != $management->decision || !empty($request->decision_comment)) {
          $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Decisions')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Decisions';
            $history->previous = $lastDocument->decision;
            $history->current = $management->decision;
            $history->comment = $request->decision_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->zone != $management->zone || !empty($request->zone_comment)) {
          $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Zone')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Zone';
            $history->previous = $lastDocument->zone;
            $history->current = $management->zone;
            $history->comment = $request->zone_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->country != $management->country || !empty($request->country_comment)) {
         $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Country')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Country';
            $history->previous = $lastDocument->country;
            $history->current = $management->country;
            $history->comment = $request->country_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->city != $management->city || !empty($request->city_comment)) {
            $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'City')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'City';
            $history->previous = $lastDocument->city;
            $history->current = $management->city;
            $history->comment = $request->city_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->site_name != $management->site_name || !empty($request->site_name_comment)) {
            $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Site Name')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Site Name';
            $history->previous = $lastDocument->site_name;
            $history->current = $management->site_name;
            $history->comment = $request->site_name_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->building != $management->building || !empty($request->building_comment)) {
           $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Building')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Building';
            $history->previous = $lastDocument->building;
            $history->current = $management->building;
            $history->comment = $request->building_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->floor != $management->floor || !empty($request->floor_comment)) {
           $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Floor')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Floor';
            $history->previous = $lastDocument->floor;
            $history->current = $management->floor;
            $history->comment = $request->floor_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
                       $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if ($lastDocument->room != $management->room || !empty($request->room_comment)) {
          $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Room')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Room';
            $history->previous = $lastDocument->room;
            $history->current = $management->room;
            $history->comment = $request->room_comment;
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
                            ->where('activity_type', 'QA review comment ')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'QA review comment ';
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
            if($lastDocument->requirement_products_services !=$management->requirement_products_services || !empty($request->requirement_products_services_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Requirements for Products')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Requirements for Products';
            $history->previous =  $lastDocument->requirement_products_services;
            $history->current = $management->requirement_products_services;
            $history->comment = $request->requirement_products_services_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
            if($lastDocument->design_development_product_services !=$management->design_development_product_services || !empty($request->design_development_product_services_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Design and Development')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Design and Development';
            $history->previous =  $lastDocument->design_development_product_services;
            $history->current = $management->design_development_product_services;
            $history->comment = $request->design_development_product_services_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
            if($lastDocument->control_externally_provide_services !=$management->control_externally_provide_services || !empty($request->control_externally_provide_services_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Control of Externally')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Control of Externally';
            $history->previous =  $lastDocument->control_externally_provide_services;
            $history->current = $management->control_externally_provide_services;
            $history->comment = $request->control_externally_provide_services_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
            if($lastDocument->production_service_provision !=$management->production_service_provision || !empty($request->production_service_provision_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Production and Service')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Production and Service';
            $history->previous =  $lastDocument->production_service_provision;
            $history->current = $management->production_service_provision;
            $history->comment = $request->production_service_provision_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
            if($lastDocument->release_product_services !=$management->release_product_services || !empty($request->release_product_services_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Release of Products')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Release of Products';
            $history->previous =  $lastDocument->release_product_services;
            $history->current = $management->release_product_services;
            $history->comment = $request->release_product_services_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
            if($lastDocument->control_nonconforming_outputs !=$management->control_nonconforming_outputs || !empty($request->control_nonconforming_outputs_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Control of Non')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Control of Non';
            $history->previous =  $lastDocument->control_nonconforming_outputs;
            $history->current = $management->control_nonconforming_outputs;
            $history->comment = $request->control_nonconforming_outputs_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
           if($lastDocument->risk_opportunities !=$management->risk_opportunities || !empty($request->risk_opportunities_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Risk Opportunities')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Risk Opportunities';
            $history->previous =  $lastDocument->risk_opportunities;
            $history->current = $management->risk_opportunities;
            $history->comment = $request->risk_opportunities_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
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
         if($lastDocument->production_new !=$management->production_new || !empty($request->production_new_comment)) {
            $history = new ManagementAuditTrial();
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Production')
                            ->exists();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Production';
            $history->previous =  $lastDocument->production_new;
            $history->current = $management->production_new;
            $history->comment = $request->production_new_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
            if($lastDocument->plans_new !=$management->plans_new || !empty($request->plans_new_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Plans')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Plans';
            $history->previous =  $lastDocument->plans_new;
            $history->current = $management->plans_new;
            $history->comment = $request->plans_new_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
           if($lastDocument->forecast_new !=$management->forecast_new || !empty($request->forecast_new_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Forecast')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Forecast';
            $history->previous =  $lastDocument->forecast_new;
            $history->current = $management->forecast_new;
            $history->comment = $request->forecast_new_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
            if($lastDocument->additional_suport_required !=$management->additional_suport_required || !empty($request->additional_suport_required_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Any Additional Support Required')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Any Additional Support Required';
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
             if($lastDocument->file_attchment_if_any !=$management->file_attchment_if_any || !empty($request->file_attchment_if_any_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'File Attachment')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'File Attachment';
            $history->previous =  $lastDocument->file_attchment_if_any;
            $history->current = $management->file_attchment_if_any;
            $history->comment = $request->file_attchment_if_any_comment;
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
            $history->previous =  $lastDocument->next_managment_review_date;
            $history->current = $management->next_managment_review_date;
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
          if($lastDocument->summary_recommendation !=$management->summary_recommendation || !empty($request->summary_recommendation_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Summary Recommendation')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Summary Recommendation';
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
          if($lastDocument->conclusion_new !=$management->conclusion_new || !empty($request->conclusion_new_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Conclusion')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Conclusion';
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
            if($lastDocument->closure_attachments !=$management->closure_attachments || !empty($request->closure_attachments_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'File Attachment')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'File Attachment';
            $history->previous =  $lastDocument->closure_attachments;
            $history->current = $management->closure_attachments;
            $history->comment = $request->closure_attachments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
          if($lastDocument->due_date_extension !=$management->due_date_extension || !empty($request->due_date_extension_comment)) {
             $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'Due Date Extension Justification')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Due Date Extension Justification';
            $history->previous =  $lastDocument->due_date_extension;
            $history->current = $management->due_date_extension;
            $history->comment = $request->due_date_extension_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        //-------------------------
          if($lastDocument->qa_verification_file !=$management->qa_verification_file || !empty($request->qa_verification_file_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'QA verification Attachment')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'QA verification Attachment';
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
          if($lastDocument->cft_hod_attach !=$management->cft_hod_attach || !empty($request->cft_hod_attach_comment)) {
                 $lastDocumentAuditTrail = ManagementAuditTrial::where('ManagementReview_id', $management->id)
                            ->where('activity_type', 'CFT Hod Attachment')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'CFT Hod Attachment';
            $history->previous =  $lastDocument->cft_hod_attach;
            $history->current = $management->cft_hod_attach;
            $history->comment = $request->cft_hod_attach_comment;
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
        if (!empty($request->meeting_Attended)) {
            $data3->meeting_Attended = serialize($request->meeting_Attended);
        }
        if (!empty($request->designee_Name)) {
            $data3->designee_Name = serialize($request->designee_Name);
        }
        if (!empty($request->designee_Department)) {
            $data3->designee_Department = serialize($request->designee_Department);
        }
        if (!empty($request->remarks)) {
            $data3->remarks = serialize($request->remarks);
        }
        $data3->update();

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
}

    public function ManagementReviewAuditTrial($id)
    
      {
        $data= ManagementReview::find($id);
        $audit = ManagementAuditTrial::where('ManagementReview_id', $id)->orderByDesc('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = ManagementReview::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
        $users = User::all();
        $audits = ManagementAuditTrial::paginate(10);

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


        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = ManagementReview::find($id);
            $lastDocument =  ManagementReview::find($id);
            $data =  ManagementReview::find($id);
             $updateCFT = managementCft::where('ManagementReview_id', $id)->latest()->first();
             $cftDetails = managementCft_Response::withoutTrashed()->where(['status' => 'In-progress', 'ManagementReview_id' => $id])->distinct('cft_user_id')->count();

            if ($changeControl->stage == 1) {
                $changeControl->stage = "2";
                $changeControl->status = 'In Progress';
                $changeControl->Submited_by = Auth::user()->name;
                $changeControl->Submited_on = Carbon::now()->format('d-M-Y');
                $changeControl->Submited_Comment  = 
                $request->comment;
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = 'Submit By ,   Submit On';
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
                $history->change_to= "In Progress";
                $history->change_from= "Opened";
                if (is_null($lastDocument->Submited_by) || $lastDocument->Submited_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
                
                // $list = Helpers::getResponsibleUserList();
                // foreach ($list as $u) {
                //     if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getInitiatorEmail($u->user_id);
                //      if ($email !== null) {
                //          Mail::send(
                //             'mail.view-mail',
                //             ['data' => $changeControl],
                //             function ($message) use ($email) {
                //                 $message->to($email)
                //                     ->subject("Document is Send By ".Auth::user()->name);
                //             }
                //         );
                //       }
                //     } 
                // }
                $changeControl->update();
                toastr()->success('Document Sent');
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
                $history->change_to= "Meeting And Summary";
                $history->change_from= $lastDocument->status;
                if (is_null($lastDocument->qaHeadReviewComplete_By) || $lastDocument->qaHeadReviewComplete_By === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                 $history->save();
                 $changeControl->update();
                 
                // $list = Helpers::getInitiatorUserList();
                // foreach ($list as $u) {
                //     if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getInitiatorEmail($u->user_id);
                //      if ($email !== null) {
                //          Mail::send(
                //             'mail.view-mail',
                //             ['data' => $changeControl],
                //             function ($message) use ($email) {
                //                 $message->to($email)
                //                     ->subject("Document is Send By ".Auth::user()->name);
                //             }
                //         );
                //       }
                //     } 
                // }
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 3) {
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
                $history->activity_type = 'Meeting and Summary Complete By     , Meeting and Summary Complete On';
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
                 
                // $list = Helpers::getInitiatorUserList();
                // foreach ($list as $u) {
                //     if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getInitiatorEmail($u->user_id);
                //      if ($email !== null) {
                //          Mail::send(
                //             'mail.view-mail',
                //             ['data' => $changeControl],
                //             function ($message) use ($email) {
                //                 $message->to($email)
                //                     ->subject("Document is Send By ".Auth::user()->name);
                //             }
                //         );
                //       }
                //     } 
                // }
                toastr()->success('Document Sent');
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
                        $changeControl->status = "HOD Final Review";
                        $changeControl->ALLAICompleteby_by = Auth::user()->name;
                        $changeControl->ALLAICompleteby_on = Carbon::now()->format('d-M-Y');
                        $changeControl->ALLAICompleteby_comment = $request->comment;

                        $history = new ManagementAuditTrial();
                        $history->ManagementReview_id = $id;
                        $history->activity_type = 'CFT Review Completed By, CFT Review Completed On';
                    if(is_null(value: $lastDocument->ALLAICompleteby_by) || $lastDocument->ALLAICompleteby_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->ALLAICompleteby_by. ' ,' . $lastDocument->ALLAICompleteby_on;
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $changeControl->ALLAICompleteby_by. ',' . $changeControl->ALLAICompleteby_on;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "HOD Final Review";
                        $history->change_from = $lastDocument->status;
                        $history->stage = 'Complete';
                        if(is_null($lastDocument->ALLAICompleteby_by) || $lastDocument->ALLAICompleteby_on == '')
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

            // if ($changeControl->stage == 4) {
            //     $changeControl->stage = "5";
            //     $changeControl->status = 'HOD Final Review';
            //     $changeControl->ALLAICompleteby_by = Auth::user()->name;
            //     $changeControl->ALLAICompleteby_on = Carbon::now()->format('d-M-Y');
            //     $changeControl->ALLAICompleteby_comment  = $request->comment;
            //     $history = new ManagementAuditTrial();
            //     $history->ManagementReview_id = $id;
            //     $history->activity_type = 'All AI Completed by Respective Department By     , All AI Completed by Respective Department On';
            //     $history->action ='All AI Completed by Respective Department';
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
            //     $history->stage='All AI Completed by Respective Department';
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
                $changeControl->stage = "6";
                $changeControl->status = 'QA Verification';
                $changeControl->hodFinaleReviewComplete_by = Auth::user()->name;
                $changeControl->hodFinaleReviewComplete_on = Carbon::now()->format('d-M-Y');
                $changeControl->hodFinaleReviewComplete_comment  = $request->comment;
            
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = 'HOD Final Review Complete By, HOD Final Review Complete On';
                $history->action = 'HOD Final Review Complete';
            
                // Check and assign previous values correctly
                if (is_null($lastDocument->hodFinaleReviewComplete_by) || $lastDocument->hodFinaleReviewComplete_by === '') {
                    $history->previous = "Null";
                } else {
                    // Assign previous user and date correctly
                    $history->previous = $lastDocument->hodFinaleReviewComplete_by . '  ' . $lastDocument->hodFinaleReviewComplete_on;
                }
            
                // Assign current user and date correctly
                $history->current = $changeControl->hodFinaleReviewComplete_by . '  ' . $changeControl->hodFinaleReviewComplete_on;
                
                // Other fields in history
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'HOD Final Review Complete';
                $history->change_to = "QA Verification";
                $history->change_from = $lastDocument->status;
            
                // Check action name
                if (is_null($lastDocument->hodFinaleReviewComplete_by) || $lastDocument->hodFinaleReviewComplete_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
            
                // Save history and update the change control
                $history->save();
                $changeControl->update();
            
                // Success message
                toastr()->success('Document Sent');
                return back();
            }
            

            if ($changeControl->stage == 6) {
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
                 
                toastr()->success('Document Sent');
                return back();
            }

            if ($changeControl->stage == 7) {
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
                 
                // $list = Helpers::getInitiatorUserList();
                // foreach ($list as $u) {
                //     if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getInitiatorEmail($u->user_id);
                //      if ($email !== null) {
                //          Mail::send(
                //             'mail.view-mail',
                //             ['data' => $changeControl],
                //             function ($message) use ($email) {
                //                 $message->to($email)
                //                     ->subject("Document is Send By ".Auth::user()->name);
                //             }
                //         );
                //       }
                //     } 
                // }
                toastr()->success('Document Sent');
                return back();
            }


        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function manage_send_more_require_stage(Request $request, $id)
    {


        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
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
                $history->stage='More Information Required By';
                $history->change_to= "Opened";
                $history->change_from= $lastDocument->status;
                $history->action_name = 'Not Applicable';
                // if (is_null($lastDocument->ReturnActivityOpenedstage_By) || $lastDocument->ReturnActivityOpenedstage_By === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                 $history->save();
                 $changeControl->update();
                 
                // $list = Helpers::getInitiatorUserList();
                // foreach ($list as $u) {
                //     if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getInitiatorEmail($u->user_id);
                //      if ($email !== null) {
                //          Mail::send(
                //             'mail.view-mail',
                //             ['data' => $changeControl],
                //             function ($message) use ($email) {
                //                 $message->to($email)
                //                     ->subject("Document is Send By ".Auth::user()->name);
                //             }
                //         );
                //       }
                //     } 
                // }
                toastr()->success('Document Sent');
                return back();
            }
            

            

            if ($changeControl->stage == 6) {
                $changeControl->stage = "3";
                $changeControl->status = 'Meeting And Summary ';
                $changeControl->requireactivitydepartment_by = "Not Applicable";
                $changeControl->requireactivitydepartment_on = "Not Applicable";
                $changeControl->requireactivitydepartment_comment  = $request->comment;
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->action ='More Information Required';
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
                $history->change_to= "CFT actions ";
                $history->change_from= $lastDocument->status;
                $history->action_name = 'Not Applicable';
                // if (is_null($lastDocument->requireactivitydepartment_by) || $lastDocument->requireactivitydepartment_by === '') {
                //     $history->action_name = 'Not Applicable';
                // } else {
                //     $history->action_name = 'Not Applicable';
                // }
                 $history->save();
                 $changeControl->update();
                 
                // $list = Helpers::getInitiatorUserList();
                // foreach ($list as $u) {
                //     if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getInitiatorEmail($u->user_id);
                //      if ($email !== null) {
                //          Mail::send(
                //             'mail.view-mail',
                //             ['data' => $changeControl],
                //             function ($message) use ($email) {
                //                 $message->to($email)
                //                     ->subject("Document is Send By ".Auth::user()->name);
                //             }
                //         );
                //       }
                //     } 
                // }
                toastr()->success('Document Sent');
                return back();
            }

            if ($changeControl->stage == 6) {
                $changeControl->stage = "5";
                $changeControl->status = 'HOD Final Review';
                $changeControl->requireactivityHODdepartment_by = "Not Applicable";
                $changeControl->requireactivityHODdepartment_on = "Not Applicable";
                $changeControl->requireactivityHODdepartment_comment  = $request->comment;
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
                $history->change_to= "HOD Final Review";
                $history->change_from= $lastDocument->status;
                $history->action_name = "Not Applicable";

                // if (is_null($lastDocument->requireactivityHODdepartment_by) || $lastDocument->requireactivityHODdepartment_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                 $history->save();
                 $changeControl->update();
                 
                // $list = Helpers::getInitiatorUserList();
                // foreach ($list as $u) {
                //     if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getInitiatorEmail($u->user_id);
                //      if ($email !== null) {
                //          Mail::send(
                //             'mail.view-mail',
                //             ['data' => $changeControl],
                //             function ($message) use ($email) {
                //                 $message->to($email)
                //                     ->subject("Document is Send By ".Auth::user()->name);
                //             }
                //         );
                //       }
                //     } 
                // }
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
                $history->change_to= "CFT actions";
                $history->change_from= $lastDocument->status;
                $history->action_name = 'Not Applicable';
                // if (is_null($lastDocument->requireactivityQAdepartment_by) || $lastDocument->requireactivityQAdepartment_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                 $history->save();
                 $changeControl->update();
                 
                // $list = Helpers::getInitiatorUserList();
                // foreach ($list as $u) {
                //     if($u->q_m_s_divisions_id == $changeControl->division_id){
                //      $email = Helpers::getInitiatorEmail($u->user_id);
                //      if ($email !== null) {
                //          Mail::send(
                //             'mail.view-mail',
                //             ['data' => $changeControl],
                //             function ($message) use ($email) {
                //                 $message->to($email)
                //                     ->subject("Document is Send By ".Auth::user()->name);
                //             }
                //         );
                //       }
                //     } 
                // }
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
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
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
        $data1 =  ManagementReviewDocDetails::where('review_id',$id)->where('type',"agenda")->first();
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
         $data5 =  ManagementReviewDocDetails::where('review_id',$id)->where('type',"capa_detail_details")->first();
        $data5->review_id = $management->id;
        $data5->type = "capa_detail_details";
        $capa_detail_details=$data5;
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
        $pdf = PDF::loadview('frontend.management-review.report', compact('managementReview', 'agenda','management_review_participants','capa_detail_details', 'performance_evaluation','action_item_details', 'data1','data2','data3','data4','users','data5'))
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
        $parent_type = "Management Review";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $parent_record = $record_number;
        $currentDate = Carbon::now();
        $parent_intiation_date = $currentDate;
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $old_record = ManagementReview::select('id', 'division_id', 'record')->get();
        $record=$record_number;
        $parentRecord = ManagementReview::where('id', $id)->value('record');
        return view('frontend.action-item.action-item', compact('parent_intiation_date', 'parentRecord', 'parent_initiator_id','parent_record', 'record', 'due_date', 'parent_id', 'parent_type','old_record'));
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
                'All AI Completed by Respective Department','HOD Final Review Complete','QA Verification Complete',''];
                $query->whereIn('action', $stage); // Ensure correct activity_type value
                break;

            case 'user_action':
                // Filter by various user actions
                $user_action = [  'Submit', 'HOD Review Complete', 'QA/CQA Initial Review Complete','Request For Cancellation',
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
