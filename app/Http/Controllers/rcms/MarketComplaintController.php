<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\MarketComplaint;
use App\Models\MarketComplaintGrids;
use App\Models\MarketComplaintAuditTrial;
use App\Models\MarketComplaintCft;
use App\Models\MarketComplaintcftResponce;
use App\Models\AuditReviewersDetails;
use App\Models\Capa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\RecordNumber;
use App\Models\RoleGroup;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CC;
use Illuminate\Support\Facades\App;
use Helpers;
use Illuminate\Support\Facades\Validator;


use Carbon\Carbon;
use PDF;

class MarketComplaintController extends Controller
{
    public function index()
    {
        $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = str_pad($record, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        $old_records = Capa::select('id', 'division_id', 'record')->get();


        return view('frontend.market_complaint.market_complaint_new', compact('due_date', 'record', 'old_records'));
    }


    public function store(Request $request)
    {

        if (!$request->description_gi) {
            toastr()->info("Short Description is required");
            return redirect()->back()->withInput();
        }
        $marketComplaint = new MarketComplaint();


        $marketComplaint->status = 'Opened';
        $marketComplaint->stage = 1;

        // Manually assigning each field from the request
        $marketComplaint->initiator_id = Auth::user()->id;
        $marketComplaint->division_id = $request->division_id;
        $marketComplaint->initiator_group = $request->initiator_group;
        $marketComplaint->intiation_date = $request->intiation_date;
        $marketComplaint->due_date_gi = $request->due_date_gi;
        $marketComplaint->initiator_group_code_gi = $request->initiator_group_code_gi;
        $marketComplaint->record = ((RecordNumber::first()->value('counter')) + 1);
        $marketComplaint->initiated_through_gi = $request->initiated_through_gi;
        $marketComplaint->if_other_gi = $request->if_other_gi;
        $marketComplaint->is_repeat_gi = $request->is_repeat_gi;
        $marketComplaint->repeat_nature_gi = $request->repeat_nature_gi;
        $marketComplaint->description_gi = $request->description_gi;
        $marketComplaint->assign_to = $request->assign_to;
        // $marketComplaint->initial_attachment_gi = $request->initial_attachment_gi;
        $marketComplaint->complainant_gi = $request->complainant_gi;
        $marketComplaint->complaint_reported_on_gi = $request->complaint_reported_on_gi;
        // dd( $marketComplaint->complainant_gi);
        // $request->validate([
        //     'complaint_reported_on_gi' => 'nullable|date_format:Y-m-d',
        // ]);
        // if ($request->filled('complaint_reported_on_gi')) {
        //     $complaintDate = Carbon::createFromFormat('Y-m-d', $request->complaint_reported_on_gi)->format('j F Y');
        //     $marketComplaint->complaint_reported_on_gi = $complaintDate;
        // }
        // dd($marketComplaint->complaint_reported_on_gi);
        $marketComplaint->details_of_nature_market_complaint_gi = $request->details_of_nature_market_complaint_gi;
        $marketComplaint->categorization_of_complaint_gi = $request->categorization_of_complaint_gi;
        $marketComplaint->review_of_complaint_sample_gi = $request->review_of_complaint_sample_gi;
        $marketComplaint->review_of_control_sample_gi = $request->review_of_control_sample_gi;

        $marketComplaint->review_of_stability_study_gi = $request->review_of_stability_study_gi;
        $marketComplaint->review_of_product_manu_gi = $request->review_of_product_manu_gi;
        $marketComplaint->additional_inform = $request->additional_inform;
        $marketComplaint->in_case_Invalide_com = $request->in_case_Invalide_com;
        $marketComplaint->conclusion_pi = $request->conclusion_pi;
        $marketComplaint->the_probable_root = $request->the_probable_root;

        $marketComplaint->review_of_batch_manufacturing_record_BMR_gi = $request->review_of_batch_manufacturing_record_BMR_gi;
        $marketComplaint->review_of_raw_materials_used_in_batch_manufacturing_gi = $request->review_of_raw_materials_used_in_batch_manufacturing_gi;
        $marketComplaint->review_of_Batch_Packing_record_bpr_gi = $request->review_of_Batch_Packing_record_bpr_gi;
        $marketComplaint->review_of_packing_materials_used_in_batch_packing_gi = $request->review_of_packing_materials_used_in_batch_packing_gi;
        $marketComplaint->review_of_analytical_data_gi = $request->review_of_analytical_data_gi;
        $marketComplaint->review_of_training_record_of_concern_persons_gi = $request->review_of_training_record_of_concern_persons_gi;
        $marketComplaint->rev_eq_inst_qual_calib_record_gi = $request->rev_eq_inst_qual_calib_record_gi;
        $marketComplaint->review_of_equipment_break_down_and_maintainance_record_gi = $request->review_of_equipment_break_down_and_maintainance_record_gi;
        $marketComplaint->review_of_past_history_of_product_gi = $request->review_of_past_history_of_product_gi;
        $marketComplaint->conclusion_hodsr = $request->conclusion_hodsr;
        $marketComplaint->root_cause_analysis_hodsr = $request->root_cause_analysis_hodsr;
        $marketComplaint->probable_root_causes_complaint_hodsr = $request->probable_root_causes_complaint_hodsr;
        $marketComplaint->impact_assessment_hodsr = $request->impact_assessment_hodsr;
        $marketComplaint->corrective_action_hodsr = $request->corrective_action_hodsr;
        $marketComplaint->preventive_action_hodsr = $request->preventive_action_hodsr;
        $marketComplaint->summary_and_conclusion_hodsr = $request->summary_and_conclusion_hodsr;
        // $marketComplaint->initial_attachment_hodsr = $request->initial_attachment_hodsr;
        $marketComplaint->comments_if_any_hodsr = $request->comments_if_any_hodsr;

        $marketComplaint->manufacturer_name_address_ca = $request->manufacturer_name_address_ca;
        $marketComplaint->complaint_sample_required_ca = $request->complaint_sample_required_ca;
        $marketComplaint->complaint_sample_status_ca = $request->complaint_sample_status_ca;
        $marketComplaint->brief_description_of_complaint_ca = $request->brief_description_of_complaint_ca;
        $marketComplaint->batch_record_review_observation_ca = $request->batch_record_review_observation_ca;
        $marketComplaint->analytical_data_review_observation_ca = $request->analytical_data_review_observation_ca;
        $marketComplaint->retention_sample_review_observation_ca = $request->retention_sample_review_observation_ca;
        $marketComplaint->stability_study_data_review_ca = $request->stability_study_data_review_ca;
        $marketComplaint->qms_events_ifany_review_observation_ca = $request->qms_events_ifany_review_observation_ca;
        $marketComplaint->repeated_complaints_queries_for_product_ca = $request->repeated_complaints_queries_for_product_ca;
        $marketComplaint->interpretation_on_complaint_sample_ifrecieved_ca = $request->interpretation_on_complaint_sample_ifrecieved_ca;
        $marketComplaint->comments_ifany_ca = $request->comments_ifany_ca;
        $marketComplaint->qa_cqa_comments = $request->qa_cqa_comments;
        $marketComplaint->qa_cqa_head_comm = $request->qa_cqa_head_comm;
        $marketComplaint->qa_head_comment = $request->qa_head_comment;


        // $marketComplaint->initial_attachment_ca = $request->initial_attachment_ca;

        // Closure section
        $marketComplaint->closure_comment_c = $request->closure_comment_c;
        // $marketComplaint->initial_attachment_c = $request->initial_attachment_c;

        //  dd($marketComplaint->record);
        $marketComplaint->form_type = "Market Complaint";

        // {{----.File attachemenet   }}


        // if (!empty($request->initial_attachment_gi)) {
        //     $files = [];
        //     if ($request->hasfile('initial_attachment_gi')) {
        //         foreach ($request->file('initial_attachment_gi') as $file) {
        //             $name = $request->name . 'initial_attachment_gi' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $marketComplaint->initial_attachment_gi = json_encode($files);
        // }
        if (!empty($request->initial_attachment_gi)) {
            $files = [];
            if ($request->hasFile('initial_attachment_gi')) {
                foreach ($request->file('initial_attachment_gi') as $file) {
                    // Generate a unique name for the file
                    $name = $request->name . '_initial_attachment_gi_' . rand(1, 100) . '.' . $file->getClientOriginalExtension();

                    // Move the file to the upload directory
                    $file->move(public_path('upload/'), $name);

                    // Add the file name to the array
                    $files[] = $name;
                }
            }
            // Encode the file names array to JSON and assign it to the model
            $marketComplaint->initial_attachment_gi = json_encode($files);
        }


        if (!empty($request->initial_attachment_hodsr)) {
            $files = [];
            if ($request->hasfile('initial_attachment_hodsr')) {
                foreach ($request->file('initial_attachment_hodsr') as $file) {
                    $name = $request->name . 'initial_attachment_hodsr' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $marketComplaint->initial_attachment_hodsr = json_encode($files);
        }

        if (!empty($request->initial_attachment_ca)) {
            $files = [];
            if ($request->hasfile('initial_attachment_ca')) {
                foreach ($request->file('initial_attachment_ca') as $file) {
                    $name = $request->name . 'initial_attachment_ca' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $marketComplaint->initial_attachment_ca = json_encode($files);
        }
        if (!empty($request->initial_attachment_c)) {
            $files = [];
            if ($request->hasfile('initial_attachment_c')) {
                foreach ($request->file('initial_attachment_c') as $file) {
                    $name = $request->name . 'initial_attachment_c' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $marketComplaint->initial_attachment_c = json_encode($files);
        }
        // dd($marketComplaint);

        if (!empty($request->qa_cqa_attachments)) {
            $files = [];
            if ($request->hasfile('qa_cqa_attachments')) {
                foreach ($request->file('qa_cqa_attachments') as $file) {
                    $name = $request->name . 'qa_cqa_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $marketComplaint->qa_cqa_attachments = json_encode($files);
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
            $marketComplaint->qa_cqa_head_attach = json_encode($files);
        }


        if (!empty($request->qa_cqa_he_attach)) {
            $files = [];
            if ($request->hasfile('qa_cqa_he_attach')) {
                foreach ($request->file('qa_cqa_he_attach') as $file) {
                    $name = $request->name . 'qa_cqa_he_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $marketComplaint->qa_cqa_he_attach = json_encode($files);
        }



        $marketComplaint->save();


        /* CFT Data Feilds Start */

        $Cft = new MarketComplaintCft();
        $Cft->mc_id = $marketComplaint->id;
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


        if (!empty($request->RA_attachment)) {
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
        if (!empty($request->store_attachment)) {
            $files = [];
            if ($request->hasfile('store_attachment')) {
                foreach ($request->file('store_attachment') as $file) {
                    $name = $request->name . 'store_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $Cft->store_attachment = json_encode($files);
        }

        if (!empty($request->RegulatoryAffair_attechment)) {
            $files = [];
            if ($request->hasfile('RegulatoryAffair_attechment')) {
                foreach ($request->file('RegulatoryAffair_attechment') as $file) {
                    $name = $request->name . 'RegulatoryAffair_attechment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $Cft->RegulatoryAffair_attechment = json_encode($files);
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

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();


        // ----------------------------------autid show  fileds ----------------------------------------------------------

        $history = new MarketComplaintAuditTrial();
        $history->market_id = $marketComplaint->id;
        $history->activity_type = 'Record Number';
        $history->previous = "Null";
        $history->current = Helpers::getDivisionName(session()->get('division')) . "/MC/" . Helpers::year($marketComplaint->created_at) . "/" . str_pad($marketComplaint->record, 4, '0', STR_PAD_LEFT);
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $marketComplaint->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiator";
        $history->action_name = 'Create';
        $history->save();


        if (!empty($request->division_id)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Site/Location Code';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName($marketComplaint->division_id);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($request->initiator)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = Auth::user()->name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->intiation_date)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = "Null";
            $history->current =  Helpers::getdateFormat($marketComplaint->intiation_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }


        if (!empty($request->due_date_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current =  Helpers::getdateFormat($marketComplaint->due_date_gi);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        //     if (!empty ($request->due_date_gi)){
        //     $history = new MarketComplaintAuditTrial();
        //     $history->market_id = $marketComplaint->id;
        //     $history->activity_type = 'Due Date';
        //     $history->previous = "Null";
        //     $history->current =Helpers::getdateFormat ($marketComplaint->due_date_gi);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $marketComplaint->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiator";
        //     $history->action_name = 'Create';
        //     $history->save();
        //    }

        //        if (!empty($marketComplaint->review_of_stability_study_gi)) {
        //     $history = new MarketComplaintAuditTrial();
        //     $history->market_id = $marketComplaint->id;
        //     $history->activity_type = 'Department Code ';
        //     $history->previous = "Null";
        //     $history->current = $marketComplaint->review_of_stability_study_gi;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $marketComplaint->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        if (!empty($marketComplaint->review_of_stability_study_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of stability study program and samples ';
            $history->previous = "Null";
            $history->current = $marketComplaint->review_of_stability_study_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->review_of_product_manu_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of product manufacturing and analytical process';
            $history->previous = "Null";
            $history->current = $marketComplaint->review_of_product_manu_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->additional_inform)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Additional information if require';
            $history->previous = "Null";
            $history->current = $marketComplaint->additional_inform;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->in_case_Invalide_com)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Comments';
            $history->previous = "Null";
            $history->current = $marketComplaint->in_case_Invalide_com;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->conclusion_pi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Conclusion';
            $history->previous = "Null";
            $history->current = $marketComplaint->conclusion_pi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->the_probable_root)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'The probable root causes or Root Cause';
            $history->previous = "Null";
            $history->current = $marketComplaint->the_probable_root;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


        if (!empty($marketComplaint->division_code)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'division Code';
            $history->previous = "Null";
            $history->current = $marketComplaint->division_code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->initiator_id)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current =  Helpers::getInitiatorName($marketComplaint->initiator_id);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


        // if (!empty($marketComplaint->record)) {
        //     $history = new MarketComplaintAuditTrial();
        //     $history->market_id = $marketComplaint->id;
        //     $history->activity_type = 'Record Number';
        //     $history->previous = "Null";
        //     $history->current = Helpers::getDivisionName($marketComplaint->division_id) . '/MC/' . Helpers::year($marketComplaint->created) . '/' . str_pad($marketComplaint->record, 4, '0', STR_PAD_LEFT);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $marketComplaint->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        if (!empty($marketComplaint->description_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $marketComplaint->description_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        // if (!empty($marketComplaint->intiation_date)) {
        //     $history = new MarketComplaintAuditTrial();
        //     $history->market_id = $marketComplaint->id;
        //     $history->activity_type = 'Date Of Initiation';
        //     $history->previous = "Null";
        //     $history->current = Helpers::getdateFormat($marketComplaint->intiation_date);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $marketComplaint->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        if (!empty($marketComplaint->due_date_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($marketComplaint->due_date_gi);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }



        if (!empty($marketComplaint->initiator_group)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Initiator Department';
            $history->previous = "Null";
            $history->current = Helpers::getFullDepartmentName($marketComplaint->initiator_group);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->initiator_group_code_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Initiator Department Code';
            $history->previous = "Null";
            $history->current = $marketComplaint->initiator_group_code_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        // if (!empty($marketComplaint->initiator_group)) {
        //     $history = new MarketComplaintAuditTrial();
        //     $history->market_id = $marketComplaint->id;
        //     $history->activity_type = 'Initiator Group';
        //     $history->previous = "Null";
        //     $history->current = $marketComplaint->initiator_group;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $marketComplaint->status;
        //      $history->change_to = "Opened";
        //         $history->change_from = "Initiation";
        //         $history->action_name = "Create";
        //     $history->save();
        // }

        if (!empty($marketComplaint->initiated_through_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Initiated Through';
            $history->previous = "Null";
            $history->current = $marketComplaint->initiated_through_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->if_other_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'If Other';
            $history->previous = "Null";
            $history->current = $marketComplaint->if_other_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->is_repeat_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Is Repeat';
            $history->previous = "Null";
            $history->current = $marketComplaint->is_repeat_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->repeat_nature_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = "Null";
            $history->current = $marketComplaint->repeat_nature_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->initial_attachment_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Information Attachment';
            $history->previous = "NA";
            $history->current = $marketComplaint->initial_attachment_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


        if (!empty($marketComplaint->complainant_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Complaint';
            $history->previous = "Null";
            $history->current = $marketComplaint->complainant_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->complaint_reported_on_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Complaint Reported On';
            $history->previous = "Null";
            $history->current = $marketComplaint->complaint_reported_on_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->details_of_nature_market_complaint_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Details Of Nature Market Complaint';
            $history->previous = "Null";
            $history->current = $marketComplaint->details_of_nature_market_complaint_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->categorization_of_complaint_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Categorization of complaint';
            $history->previous = "Null";
            $history->current = $marketComplaint->categorization_of_complaint_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->review_of_complaint_sample_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Complaint Samplet';
            $history->previous = "Null";
            $history->current = $marketComplaint->review_of_complaint_sample_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->review_of_past_history_of_product_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Past history of product';
            $history->previous = "Null";
            $history->current = $marketComplaint->review_of_past_history_of_product_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->review_of_equipment_break_down_and_maintainance_record_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Equipment Break-down and Maintainance Record';
            $history->previous = "Null";
            $history->current = $marketComplaint->review_of_equipment_break_down_and_maintainance_record_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->rev_eq_inst_qual_calib_record_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Equipment/Instrument qualification/Calibration Record';
            $history->previous = "Null";
            $history->current = $marketComplaint->rev_eq_inst_qual_calib_record_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->review_of_training_record_of_concern_persons_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of training record of Concern Persons';
            $history->previous = "Null";
            $history->current = $marketComplaint->review_of_training_record_of_concern_persons_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->review_of_analytical_data_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Analytical Data';
            $history->previous = "Null";
            $history->current = $marketComplaint->review_of_analytical_data_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->review_of_raw_materials_used_in_batch_manufacturing_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of packing materials used in batch packing';
            $history->previous = "Null";
            $history->current = $marketComplaint->review_of_raw_materials_used_in_batch_manufacturing_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->review_of_raw_materials_used_in_batch_manufacturing_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Raw materials used in batch manufacturing';
            $history->previous = "Null";
            $history->current = $marketComplaint->review_of_raw_materials_used_in_batch_manufacturing_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->review_of_Batch_Packing_record_bpr_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Batch Packing record BPR';
            $history->previous = "Null";
            $history->current = $marketComplaint->review_of_Batch_Packing_record_bpr_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


        if (!empty($marketComplaint->review_of_control_sample_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Control Sample';
            $history->previous = "Null";
            $history->current = $marketComplaint->review_of_control_sample_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->review_of_batch_manufacturing_record_BMR_gi)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Batch Manufacturing Record (BMR) ';
            $history->previous = "Null";
            $history->current = $marketComplaint->review_of_batch_manufacturing_record_BMR_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->conclusion_hodsr)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Complaint Samplet';
            $history->previous = "Null";
            $history->current = $marketComplaint->conclusion_hodsr;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->root_cause_analysis_hodsr)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Other Methodology';
            $history->previous = "Null";
            $history->current = $marketComplaint->root_cause_analysis_hodsr;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->probable_root_causes_complaint_hodsr)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Type of Market Complaints';
            $history->previous = "Null";
            $history->current = $marketComplaint->probable_root_causes_complaint_hodsr;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->impact_assessment_hodsr)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Impact Assessment';
            $history->previous = "Null";
            $history->current = $marketComplaint->impact_assessment_hodsr;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->corrective_action_hodsr)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Corrective Action';
            $history->previous = "Null";
            $history->current = $marketComplaint->corrective_action_hodsr;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->preventive_action_hodsr)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Preventive Action';
            $history->previous = "Null";
            $history->current = $marketComplaint->preventive_action_hodsr;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->summary_and_conclusion_hodsr)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Summary and Conclusion';
            $history->previous = "Null";
            $history->current = $marketComplaint->summary_and_conclusion_hodsr;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->initial_attachment_hodsr)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'HOD Attachment';
            $history->previous = "Null";
            $history->current = $marketComplaint->initial_attachment_hodsr;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->comments_if_any_hodsr)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Comments if any';
            $history->previous = "Null";
            $history->current = $marketComplaint->comments_if_any_hodsr;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


        if (!empty($marketComplaint->manufacturer_name_address_ca)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Manufacturer name & Address';
            $history->previous = "Null";
            $history->current = $marketComplaint->manufacturer_name_address_ca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->complaint_sample_required_ca)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Complaint Sample Required';
            $history->previous = "Null";
            $history->current = $marketComplaint->complaint_sample_required_ca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->complaint_sample_status_ca)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Complaint Sample Required';
            $history->previous = "Null";
            $history->current = $marketComplaint->complaint_sample_status_ca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->brief_description_of_complaint_ca)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Brief Description of complaint';
            $history->previous = "Null";
            $history->current = $marketComplaint->brief_description_of_complaint_ca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->batch_record_review_observation_ca)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Batch Record review observation';
            $history->previous = "Null";
            $history->current = $marketComplaint->batch_record_review_observation_ca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($marketComplaint->analytical_data_review_observation_ca)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Analytical Data review observation';
            $history->previous = "Null";
            $history->current = $marketComplaint->analytical_data_review_observation_ca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->retention_sample_review_observation_ca)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Retention sample review observation';
            $history->previous = "Null";
            $history->current = $marketComplaint->retention_sample_review_observation_ca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->retention_sample_review_observation_ca)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Retention sample review observation';
            $history->previous = "Null";
            $history->current = $marketComplaint->retention_sample_review_observation_ca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->stability_study_data_review_ca)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Stablity study data review';
            $history->previous = "Null";
            $history->current = $marketComplaint->stability_study_data_review_ca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->qms_events_ifany_review_observation_ca)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'QMS Events(if any) review Observation';
            $history->previous = "Null";
            $history->current = $marketComplaint->qms_events_ifany_review_observation_ca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->repeated_complaints_queries_for_product_ca)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Repeated complaints/queries for product';
            $history->previous = "Null";
            $history->current = $marketComplaint->repeated_complaints_queries_for_product_ca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->interpretation_on_complaint_sample_ifrecieved_ca)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Interpretation on Complaint sample(if recieved)';
            $history->previous = "Null";
            $history->current = $marketComplaint->interpretation_on_complaint_sample_ifrecieved_ca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->comments_ifany_ca)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Comments(if Any)';
            $history->previous = "Null";
            $history->current = $marketComplaint->comments_ifany_ca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->initial_attachment_ca)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Acknowledgement Attachment';
            $history->previous = "Null";
            $history->current = $marketComplaint->initial_attachment_ca;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->closure_comment_c)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Closure Comment';
            $history->previous = "Null";
            $history->current = $marketComplaint->closure_comment_c;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($marketComplaint->initial_attachment_c)) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Closure Attachment';
            $history->previous = "Null";
            $history->current = $marketComplaint->initial_attachment_c;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $marketComplaint->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


            //----------------- logic for showing grid data in audit trail -----------------------//

    $SummaryUpdate = $marketComplaint->id;

    // Fetch existing summary response data
    $existingSummaryData = MarketComplaintGrids::where(['mc_id' => $SummaryUpdate, 'identifer' => 'ProductDetails'])->first();
    $existingSummaryDataArray = $existingSummaryData ? $existingSummaryData->data : [];

    // Save the new summary response data

    if (!empty($request->SummaryResponse)) {
        $summaryShow = MarketComplaintGrids::firstOrNew(['mc_id' => $SummaryUpdate, 'identifer' => 'ProductDetails']);
        $summaryShow->mc_id = $SummaryUpdate;
        $summaryShow->identifer = 'ProductDetails';
        $summaryShow->data = $request->SummaryResponse;
        $summaryShow->save();



          // Define the mapping of field keys to more descriptive names
          $fieldNames = [
            'info_product_name' => 'Product Name',
            'info_batch_no' => 'Batch No.',
            'info_mfg_date' => 'Mfg Date',
            'info_expiry_date' => 'Expiry Date',
            'info_batch_size' => 'Batch Size',
            'info_pack_size' => 'Pack Size',
            'info_dispatch_quantity' => 'Dispatch Quantity',
            'info_remarks' => 'Remark',
        ];

        // Track audit trail changes
        if (is_array($request->SummaryResponse)) {
            foreach ($request->SummaryResponse as $index => $newSummary) {
                $previousSummary = $existingSummaryDataArray[$index] ?? [];

                // Track changes for each field
                $fieldsToTrack = ['info_product_name', 'info_batch_no', 'info_mfg_date', 'info_batch_size', 'info_pack_size','info_dispatch_quantity','info_remarks'];
               dd($fieldsToTrack);
                foreach ($fieldsToTrack as $field) {
                    $oldValue = $previousSummary[$field] ?? 'Null';
                    $newValue = $newSummary[$field] ?? 'Null';

                    // If there's a change, add an entry to the audit trail
                    if ($oldValue !== $newValue) {
                        $auditTrail = new MarketComplaintAuditTrial();
                        $auditTrail->mc_id = $SummaryUpdate;
                        $auditTrail->activity_type = $fieldNames[$field] . ' (' . ($index + 1) . ')';

                        $auditTrail->previous = $oldValue;
                        $auditTrail->current = $newValue;
                        $auditTrail->comment = "";
                        $auditTrail->user_id = Auth::user()->id;
                        $auditTrail->user_name = Auth::user()->name;
                        $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $auditTrail->origin_state = $marketComplaint->status;
                        $auditTrail->change_to = "Not Applicable";
                        $auditTrail->change_from = $marketComplaint->status;
                        $auditTrail->action_name = $oldValue == 'Null' ? "Add" : "Update";
                        $auditTrail->save();
                    }
                }
            }

               }
    }


        // ====================================================audit show end creatre ========================================
        // -----------------------------------------------------grid storing data


        // For "Product Details"


            $griddata = $marketComplaint->id;

            if (!empty($request->serial_number_gi)) {
                // Save the new auditor data
                $product = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'ProductDetails'])->firstOrNew();
                $product->mc_id = $griddata;
                $product->identifer = 'ProductDetails';
                $product->data = $request->serial_number_gi;
                $product->save();


                // Define the mapping of field keys to more descriptive names
                $fieldNames = [
                    'info_product_name' => 'Product Name',
                    'info_batch_no' => 'Batch No.',
                    'info_mfg_date' => 'Mfg. Date',
                    'info_expiry_date' => 'Exp. Date',
                    'info_batch_size' => 'Batch Size',
                    'info_pack_size' => 'Pack Size',
                    'info_dispatch_quantity' => 'Dispatch Quantity',
                    'info_remarks' => 'Remarks',

                ];

                // Track audit trail changes (creation of new data)
                if (is_array($request->serial_number_gi)) {
                    foreach ($request->serial_number_gi as $index => $newAuditor) {
                        // Track changes for each field
                        $fieldsToTrack = ['info_product_name', 'info_batch_no', 'info_mfg_date', 'info_expiry_date','info_batch_size','info_pack_size','info_dispatch_quantity','info_remarks'];
                        foreach ($fieldsToTrack as $field) {
                            $newValue = $newAuditor[$field] ?? 'Null';

                            // Only proceed if there's new data
                            if ($newValue !== 'Null') {
                                // Log the creation of the new data in the audit trail
                                $auditTrail = new MarketComplaintAuditTrial;
                                $auditTrail->market_id = $marketComplaint->id;
                                $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                                $auditTrail->previous = 'Null'; // Since it's new data, there's no previous value
                                $auditTrail->current = $newValue;
                                $auditTrail->comment = "";
                                $auditTrail->user_id = Auth::user()->id;
                                $auditTrail->user_name = Auth::user()->name;
                                $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $auditTrail->origin_state = $marketComplaint->status;
                                $auditTrail->change_to = "Not Applicable";
                                $auditTrail->change_from = $marketComplaint->status;
                                $auditTrail->action_name = 'Create'; // Since this is a create operation
                                $auditTrail->save();
                            }
                        }
                    }
                }
            }


        // dd($marketrproducts->data);
        //Traceability
        // $griddata = $marketComplaint->id;



        $griddata = $marketComplaint->id;

        if (!empty($request->trace_ability)) {
            // Save the new auditor data
            $gitracebilty = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Traceability'])->firstOrNew();
            $gitracebilty->mc_id = $griddata;
            $gitracebilty->identifer = 'Traceability';
            $gitracebilty->data = $request->trace_ability;
            $gitracebilty->save();


            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                'product_name_tr' => 'Product Name',
                'batch_no_tr' => 'Batch No.',
                'manufacturing_location_tr' => 'Manufacturing Location',
                'remarks_tr' => 'Remarks',
            ];

            // Track audit trail changes (creation of new data)
            if (is_array($request->trace_ability)) {
                foreach ($request->trace_ability as $index => $newAuditor) {
                    // Track changes for each field
                    $fieldsToTrack = ['product_name_tr', 'batch_no_tr', 'manufacturing_location_tr', 'remarks_tr'];
                    foreach ($fieldsToTrack as $field) {
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's new data
                        if ($newValue !== 'Null') {
                            // Log the creation of the new data in the audit trail
                            $auditTrail = new MarketComplaintAuditTrial;
                            $auditTrail->market_id = $marketComplaint->id;
                            $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                            $auditTrail->previous = 'Null'; // Since it's new data, there's no previous value
                            $auditTrail->current = $newValue;
                            $auditTrail->comment = "";
                            $auditTrail->user_id = Auth::user()->id;
                            $auditTrail->user_name = Auth::user()->name;
                            $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $auditTrail->origin_state = $marketComplaint->status;
                            $auditTrail->change_to = "Not Applicable";
                            $auditTrail->change_from = $marketComplaint->status;
                            $auditTrail->action_name = 'Create'; // Since this is a create operation
                            $auditTrail->save();
                        }
                    }
                }
            }
        }

        // {{-- Investing_team --}}



        $griddata = $marketComplaint->id;

        if (!empty($request->Investing_team)) {
            // Save the new auditor data
            $giinvesting = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Investing_team'])->firstOrNew();
            $giinvesting->mc_id = $griddata;
            $giinvesting->identifer = 'Investing_team';
            $giinvesting->data = $request->Investing_team;
            // dd($giinvesting);
            $giinvesting->save();


            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                    'name_inv_tem' => 'Name',
                    'department_inv_tem' => 'Department',
                    'remarks_inv_tem' => 'Remarks',
            ];

            // Track audit trail changes (creation of new data)
            if (is_array($request->Investing_team)) {
                foreach ($request->Investing_team as $index => $newAuditor) {
                    // Track changes for each field
                    $fieldsToTrack = ['name_inv_tem', 'department_inv_tem', 'remarks_inv_tem'];
                    foreach ($fieldsToTrack as $field) {
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's new data
                        if ($newValue !== 'Null') {
                            // Log the creation of the new data in the audit trail
                            $auditTrail = new MarketComplaintAuditTrial;
                            $auditTrail->market_id = $marketComplaint->id;
                            $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                            $auditTrail->previous = 'Null'; // Since it's new data, there's no previous value
                            $auditTrail->current = $newValue;
                            $auditTrail->comment = "";
                            $auditTrail->user_id = Auth::user()->id;
                            $auditTrail->user_name = Auth::user()->name;
                            $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $auditTrail->origin_state = $marketComplaint->status;
                            $auditTrail->change_to = "Not Applicable";
                            $auditTrail->change_from = $marketComplaint->status;
                            $auditTrail->action_name = 'Create'; // Since this is a create operation
                            $auditTrail->save();
                        }
                    }
                }
            }
        }


        // {{-- Brain stroming Session --}}



        $griddata = $marketComplaint->id;

        if (!empty($request->Investing_team)) {
            // Save the new auditor data
            $brain = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'brain_stroming_details'])->firstOrNew();
            $brain->mc_id = $griddata;
            $brain->identifer = 'brain_stroming_details';
            $brain->data = $request->brain_stroming_details;
            $brain->save();


            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                    'possibility_bssd' => 'Possibility',
                    'factscontrols_bssd' => 'Facts/Controls',
                    'probable_cause_bssd' => 'Probable Cause',
                    'remarks_bssd' => 'Remarks',
            ];

            // Track audit trail changes (creation of new data)
            if (is_array($request->brain_stroming_details)) {
                foreach ($request->brain_stroming_details as $index => $newAuditor) {
                    // Track changes for each field
                    $fieldsToTrack = ['possibility_bssd', 'factscontrols_bssd', 'probable_cause_bssd', 'remarks_bssd'];
                    foreach ($fieldsToTrack as $field) {
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's new data
                        if ($newValue !== 'Null') {
                            // Log the creation of the new data in the audit trail
                            $auditTrail = new MarketComplaintAuditTrial;
                            $auditTrail->market_id = $marketComplaint->id;
                            $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                            $auditTrail->previous = 'Null'; // Since it's new data, there's no previous value
                            $auditTrail->current = $newValue;
                            $auditTrail->comment = "";
                            $auditTrail->user_id = Auth::user()->id;
                            $auditTrail->user_name = Auth::user()->name;
                            $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $auditTrail->origin_state = $marketComplaint->status;
                            $auditTrail->change_to = "Not Applicable";
                            $auditTrail->change_from = $marketComplaint->status;
                            $auditTrail->action_name = 'Create'; // Since this is a create operation
                            $auditTrail->save();
                        }
                    }
                }
            }
        }

        // {{ Team Members }}

        $griddata = $marketComplaint->id;

        if (!empty($request->Team_Members)) {
            // Save the new auditor data
            $hodteammembers = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Team_Members'])->firstOrNew();
            $hodteammembers->mc_id = $griddata;
            $hodteammembers->identifer = 'Team_Members';
            $hodteammembers->data = $request->Team_Members;
            $hodteammembers->save();


            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                'names_tm' => 'Names',
                'designation' => 'Designation',
                'department_tm' => 'Department',
                'sign_tm' => 'Sign',
                'date_tm' => 'Date',
            ];

            // Track audit trail changes (creation of new data)
            if (is_array($request->Team_Members)) {
                foreach ($request->Team_Members as $index => $newAuditor) {
                    // Track changes for each field
                    $fieldsToTrack = ['names_tm', 'designation', 'department_tm', 'sign_tm', 'date_tm'];
                    foreach ($fieldsToTrack as $field) {
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's new data
                        if ($newValue !== 'Null') {
                            // Log the creation of the new data in the audit trail
                            $auditTrail = new MarketComplaintAuditTrial;
                            $auditTrail->market_id = $marketComplaint->id;
                            $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                            $auditTrail->previous = 'Null'; // Since it's new data, there's no previous value
                            $auditTrail->current = $newValue;
                            $auditTrail->comment = "";
                            $auditTrail->user_id = Auth::user()->id;
                            $auditTrail->user_name = Auth::user()->name;
                            $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $auditTrail->origin_state = $marketComplaint->status;
                            $auditTrail->change_to = "Not Applicable";
                            $auditTrail->change_from = $marketComplaint->status;
                            $auditTrail->action_name = 'Create'; // Since this is a create operation
                            $auditTrail->save();
                        }
                    }
                }
            }
        }


        // {{ Report_Approval }}


        $griddata = $marketComplaint->id;

        if (!empty($request->Report_Approval)) {
            // Save the new auditor data
            $hodreportapproval = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Report_Approval'])->firstOrNew();
            $hodreportapproval->mc_id = $griddata;
            $hodreportapproval->identifer = 'Report_Approval';
            $hodreportapproval->data = $request->Report_Approval;
            $hodreportapproval->save();

            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                'names_rrv' => 'Names',
                'designation' => 'Designation',
                'department_rrv' => 'Department',
                'sign_rrv' => 'Sign',
                'date_rrv' => 'Date'
            ];

            // Track audit trail changes (creation of new data)
            if (is_array($request->Report_Approval)) {
                foreach ($request->Report_Approval as $index => $newAuditor) {
                    // Track changes for each field
                    $fieldsToTrack = ['names_rrv', 'designation', 'department_rrv', 'sign_rrv', 'date_rrv'];
                    foreach ($fieldsToTrack as $field) {
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's new data
                        if ($newValue !== 'Null') {
                            // Log the creation of the new data in the audit trail
                            $auditTrail = new MarketComplaintAuditTrial;
                            $auditTrail->market_id = $marketComplaint->id;
                            $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                            $auditTrail->previous = 'Null'; // Since it's new data, there's no previous value
                            $auditTrail->current = $newValue;
                            $auditTrail->comment = "";
                            $auditTrail->user_id = Auth::user()->id;
                            $auditTrail->user_name = Auth::user()->name;
                            $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $auditTrail->origin_state = $marketComplaint->status;
                            $auditTrail->change_to = "Not Applicable";
                            $auditTrail->change_from = $marketComplaint->status;
                            $auditTrail->action_name = 'Create'; // Since this is a create operation
                            $auditTrail->save();
                        }
                    }
                }
            }
        }

        // {{ Product_MaterialDetails }}


        $griddata = $marketComplaint->id;

        if (!empty($request->Product_MaterialDetails)) {
            // Save the new auditor data
            $caprduct = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Product_MaterialDetails'])->firstOrNew();
            $caprduct->mc_id = $griddata;
            $caprduct->identifer = 'Product_MaterialDetails';
            $caprduct->data = $request->Product_MaterialDetails;
            // dd($caprduct);
            $caprduct->save();

            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                'product_name_ca' => 'Product Name',
                'batch_no_pmd_ca' => 'Batch No.',
                'mfg_date_pmd_ca' => 'Mfg. Date',
                'expiry_date_pmd_ca' => 'Exp. Date',
                'batch_size_pmd_ca' => 'Batch Size',
                'pack_profile_pmd_ca' => 'Pack Profile',
                'released_quantity_pmd_ca' => 'Released Quantity',
                'remarks_ca' => 'Remarks'
            ];

            // Track audit trail changes (creation of new data)
            if (is_array($request->Product_MaterialDetails)) {
                foreach ($request->Product_MaterialDetails as $index => $newAuditor) {
                    // Track changes for each field
                    $fieldsToTrack = ['product_name_ca', 'batch_no_pmd_ca', 'mfg_date_pmd_ca', 'expiry_date_pmd_ca', 'batch_size_pmd_ca', 'pack_profile_pmd_ca', 'released_quantity_pmd_ca', 'remarks_ca'];
                    foreach ($fieldsToTrack as $field) {
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's new data
                        if ($newValue !== 'Null') {
                            // Log the creation of the new data in the audit trail
                            $auditTrail = new MarketComplaintAuditTrial;
                            $auditTrail->market_id = $marketComplaint->id;
                            $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                            $auditTrail->previous = 'Null'; // Since it's new data, there's no previous value
                            $auditTrail->current = $newValue;
                            $auditTrail->comment = "";
                            $auditTrail->user_id = Auth::user()->id;
                            $auditTrail->user_name = Auth::user()->name;
                            $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $auditTrail->origin_state = $marketComplaint->status;
                            $auditTrail->change_to = "Not Applicable";
                            $auditTrail->change_from = $marketComplaint->status;
                            $auditTrail->action_name = 'Create'; // Since this is a create operation
                            $auditTrail->save();
                        }
                    }
                }
            }
        }

        // {{  g}}
        $griddata = $marketComplaint->id;

        // Create MarketComplaintGrids record for Proposal to accomplish investigation
        $investigationData = [
            'Complaint sample Required' => ['csr1' => $request->csr1, 'csr2' => $request->csr2, 'csr3' => $request->csr1_yesno],
            'Additional info. From Complainant' => ['afc1' => $request->afc1, 'afc2' => $request->afc2, 'afc3' => $request->afc1_yesno],
            'Analysis of complaint Sample' => ['acs1' => $request->acs1, 'acs2' => $request->acs2, 'acs3' => $request->acs1_yesno],
            'QRM Approach' => ['qrm1' => $request->qrm1, 'qrm2' => $request->qrm2, 'qrm3' => $request->qrm1_yesno],
            'Others' => ['oth1' => $request->oth1, 'oth2' => $request->oth2, 'oth3' => $request->oth1_yesno]
        ];

        $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Proposal_to_accomplish_investigation'])->firstOrNew();
        $marketrproducts->mc_id = $griddata;
        $marketrproducts->identifer = 'Proposal_to_accomplish_investigation';
        $marketrproducts->data = json_encode($investigationData); // Encode data to JSON
        $marketrproducts->save();




        // return redirect()->route('qms-dashboard')->with('success', 'Market Complaint created successfully.');
        return redirect()->to('rcms/qms-dashboard')->with('success', 'Market Complaint created successfully.');
    }


    public function show($id)
    {
        $data = MarketComplaint::find($id);
        //  dd($data);
        $data1 = MarketComplaintCft::where('mc_id', $id)->first();

        $productsgi = MarketComplaintGrids::where('mc_id', $id)->where('identifer', 'ProductDetails')->first();
        $traceability_gi = MarketComplaintGrids::where('mc_id', $id)->where('identifer', 'Traceability')->first();
        $investing_team = MarketComplaintGrids::where('mc_id', $id)->where('identifer', 'Investing_team')->first();
        $brain_stroming_details = MarketComplaintGrids::where('mc_id', $id)->where('identifer', 'brain_stroming_details')->first();
        $team_members = MarketComplaintGrids::where('mc_id', $id)->where('identifer', 'Team_Members')->first();
        $report_approval = MarketComplaintGrids::where('mc_id', $id)->where('identifer', 'Report_Approval')->first();
        $product_materialDetails = MarketComplaintGrids::where('mc_id', $id)->where('identifer', 'Product_MaterialDetails')->first();
        // dd($product_materialDetails->data);
        // dd($product_materialDetails);
        // dd($data);
        // $productsgi = MarketComplaintGrids::where('mc_id',$id)->where('identifer','ProductDetails')->first();

        $proposal_to_accomplish_investigation = MarketComplaintGrids::where('mc_id', $id)->where('identifer', 'Proposal_to_accomplish_investigation')->first();
        $proposalData = $proposal_to_accomplish_investigation ? json_decode($proposal_to_accomplish_investigation->data, true) : [];


        //  dd($proposalData );
        return view('frontend.market_complaint.market_complaint_view', compact(
            'data',
            'productsgi',
            'traceability_gi',
            'investing_team',
            'brain_stroming_details',
            'team_members',
            'report_approval',
            'product_materialDetails',
            'proposalData',
            'data1'
        ));
    }





    public function update(Request $request, $id)
    {
//dd($request->all());
        $form_progress = null;

        // $marketComplaint = MarketComplaint::find($id);
        // if (!$request->description_gi) {
        //     toastr()->info("Short Description is required");
        //     return redirect()->back()->withInput();
        // }

        $lastmarketComplaint = MarketComplaint::find($id);
        $lastCft = MarketComplaintCft::where('mc_id', $lastmarketComplaint->id)->first();

        $marketComplaint = MarketComplaint::find($id);

        if (!$marketComplaint) {
            return redirect()->back()->with('error', 'Market Complaint not found.');
        }
        $marketComplaint->if_other_gi = $request->input('if_other_gi');
        $marketComplaint->initiator_group_code_gi = $request->initiator_group_code_gi;
        $marketComplaint->initiator_group = $request->initiator_group;

        // $marketComplaint->record =((RecordNumber::first()->value('counter')) + 1);
        $marketComplaint->initiated_through_gi = $request->initiated_through_gi;
        $marketComplaint->due_date_gi = $request->due_date_gi;

        $marketComplaint->if_other_gi = $request->if_other_gi;
        $marketComplaint->is_repeat_gi = $request->is_repeat_gi;
        $marketComplaint->repeat_nature_gi = $request->repeat_nature_gi;
        $marketComplaint->description_gi = $request->description_gi;
        $marketComplaint->assign_to = $request->assign_to;
        // $marketComplaint->initial_attachment_gi = $request->initial_attachment_gi;
        $marketComplaint->complainant_gi = $request->complainant_gi;
        $marketComplaint->complaint_reported_on_gi = $request->complaint_reported_on_gi;

        // if ($request->filled('complaint_reported_on_gi')) {
        //     $complaintDate = Carbon::createFromFormat('Y-m-d', $request->complaint_reported_on_gi)->format('j F Y');
        //     $marketComplaint->complaint_reported_on_gi = $complaintDate;
        // }

        $marketComplaint->details_of_nature_market_complaint_gi = $request->details_of_nature_market_complaint_gi;
        $marketComplaint->categorization_of_complaint_gi = $request->categorization_of_complaint_gi;
        $marketComplaint->review_of_complaint_sample_gi = $request->review_of_complaint_sample_gi;
        $marketComplaint->review_of_control_sample_gi = $request->review_of_control_sample_gi;

        $marketComplaint->review_of_stability_study_gi = $request->review_of_stability_study_gi;
        $marketComplaint->review_of_product_manu_gi = $request->review_of_product_manu_gi;
        $marketComplaint->additional_inform = $request->additional_inform;
        $marketComplaint->in_case_Invalide_com = $request->in_case_Invalide_com;
        $marketComplaint->conclusion_pi = $request->conclusion_pi;
        $marketComplaint->the_probable_root = $request->the_probable_root;

        $marketComplaint->review_of_batch_manufacturing_record_BMR_gi = $request->review_of_batch_manufacturing_record_BMR_gi;
        $marketComplaint->review_of_raw_materials_used_in_batch_manufacturing_gi = $request->review_of_raw_materials_used_in_batch_manufacturing_gi;
        $marketComplaint->review_of_Batch_Packing_record_bpr_gi = $request->review_of_Batch_Packing_record_bpr_gi;
        $marketComplaint->review_of_packing_materials_used_in_batch_packing_gi = $request->review_of_packing_materials_used_in_batch_packing_gi;
        $marketComplaint->review_of_analytical_data_gi = $request->review_of_analytical_data_gi;
        $marketComplaint->review_of_training_record_of_concern_persons_gi = $request->review_of_training_record_of_concern_persons_gi;
        $marketComplaint->rev_eq_inst_qual_calib_record_gi = $request->rev_eq_inst_qual_calib_record_gi;
        $marketComplaint->review_of_equipment_break_down_and_maintainance_record_gi = $request->review_of_equipment_break_down_and_maintainance_record_gi;
        $marketComplaint->review_of_past_history_of_product_gi = $request->review_of_past_history_of_product_gi;
        $marketComplaint->conclusion_hodsr = $request->conclusion_hodsr;
        $marketComplaint->root_cause_analysis_hodsr = $request->root_cause_analysis_hodsr;
        $marketComplaint->probable_root_causes_complaint_hodsr = $request->probable_root_causes_complaint_hodsr;
        $marketComplaint->impact_assessment_hodsr = $request->impact_assessment_hodsr;
        $marketComplaint->corrective_action_hodsr = $request->corrective_action_hodsr;
        $marketComplaint->preventive_action_hodsr = $request->preventive_action_hodsr;
        $marketComplaint->summary_and_conclusion_hodsr = $request->summary_and_conclusion_hodsr;
        // $marketComplaint->initial_attachment_hodsr = $request->initial_attachment_hodsr;
        $marketComplaint->comments_if_any_hodsr = $request->comments_if_any_hodsr;

        $marketComplaint->manufacturer_name_address_ca = $request->manufacturer_name_address_ca;
        $marketComplaint->complaint_sample_required_ca = $request->complaint_sample_required_ca;
        $marketComplaint->complaint_sample_status_ca = $request->complaint_sample_status_ca;
        $marketComplaint->brief_description_of_complaint_ca = $request->brief_description_of_complaint_ca;
        $marketComplaint->batch_record_review_observation_ca = $request->batch_record_review_observation_ca;
        $marketComplaint->analytical_data_review_observation_ca = $request->analytical_data_review_observation_ca;
        $marketComplaint->retention_sample_review_observation_ca = $request->retention_sample_review_observation_ca;
        $marketComplaint->stability_study_data_review_ca = $request->stability_study_data_review_ca;
        $marketComplaint->qms_events_ifany_review_observation_ca = $request->qms_events_ifany_review_observation_ca;
        $marketComplaint->repeated_complaints_queries_for_product_ca = $request->repeated_complaints_queries_for_product_ca;
        $marketComplaint->interpretation_on_complaint_sample_ifrecieved_ca = $request->interpretation_on_complaint_sample_ifrecieved_ca;
        $marketComplaint->comments_ifany_ca = $request->comments_ifany_ca;
        // $marketComplaint->initial_attachment_ca = $request->initial_attachment_ca;
        $marketComplaint->qa_cqa_comments = $request->qa_cqa_comments;
        $marketComplaint->qa_cqa_head_comm = $request->qa_cqa_head_comm;
        $marketComplaint->qa_head_comment = $request->qa_head_comment;

        // Closure section
        $marketComplaint->closure_comment_c = $request->closure_comment_c;
        // $marketComplaint->initial_attachment_c = $request->initial_attachment_c;

        $marketComplaint->form_type = "Market Complaint";
        //    dd($marketComplaint);


        // {{----.File attachemenet   }}


        // $files = [];
        // if ($request->hasFile('initial_attachment_gi')) {
        //     foreach ($request->file('initial_attachment_gi') as $file) {
        //         // Generate a unique name for the file
        //         $name = $request->name . 'initial_attachment_gi' . uniqid() . '.' . $file->getClientOriginalExtension();

        //         // Move the file to the upload directory
        //         $file->move(public_path('upload/'), $name);

        //         // Add the file name to the array
        //         $files[] = $name;
        //     }
        // }
        // // Encode the file names array to JSON and assign it to the model
        // $marketComplaint->initial_attachment_gi = json_encode($files);


        if ($request->form_name == 'general-open') {

            // dd($request->Delay_Justification);
            $validator = Validator::make($request->all(), [
                'short_description' => 'required',
                'short_description_required' => 'required|in:Recurring,Non_Recurring',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $form_progress = 'general-open';
            }
        }


        if ($request->form_name == 'qa') {
            $validator = Validator::make($request->all(), [
                'qa_head_comment' => 'required|not_in:0',

            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $form_progress = 'qa';
            }
        }



        // cft update //

        if ($marketComplaint->stage == 3 || $marketComplaint->stage == 4) {


            if (!$form_progress) {
                $form_progress = 'cft';
            }

            $Cft = marketComplaintCft::withoutTrashed()->where('mc_id', $id)->first();
            if ($Cft && $marketComplaint->stage == 4) {
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
            } else {
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
            // dd($Cft->Production_Table_Assessment = $request->Production_Table_Assessment);


            $Cft->Production_Injection_Assessment = $request->Production_Injection_Assessment;

            $Cft->Production_Injection_Feedback = $request->Production_Injection_Feedback;

            // $Cft->Production_Table_Assessment = $request->Production_Table_Assessment;
            // $Cft->Production_Table_Feedback = $request->Production_Table_Feedback;

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


            if (!empty($request->RA_attachment)) {
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
            if (!empty($request->store_attachment)) {
                $files = [];
                if ($request->hasfile('store_attachment')) {
                    foreach ($request->file('store_attachment') as $file) {
                        $name = $request->name . 'store_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $Cft->store_attachment = json_encode($files);
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

            if (!empty($request->RegulatoryAffair_attechment)) {
                $files = [];
                if ($request->hasfile('RegulatoryAffair_attechment')) {
                    foreach ($request->file('RegulatoryAffair_attechment') as $file) {
                        $name = $request->name . 'RegulatoryAffair_attechment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $Cft->RegulatoryAffair_attechment = json_encode($files);
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
            $IsCFTRequired = MarketComplaintcftResponce::withoutTrashed()->where(['is_required' => 1, 'mc_id' => $id])->latest()->first();
            $cftUsers = DB::table('market_complaint_cfts')->where(['mc_id' => $id])->first();
            // Define the column names
            $columns = ['Quality_Control_Person', 'QualityAssurance_person', 'Engineering_person', 'Environment_Health_Safety_person', 'Human_Resource_person', 'Information_Technology_person', 'Other1_person', 'Other2_person', 'Other3_person', 'Other4_person', 'Other5_person', 'Production_Table_Person', 'ProductionLiquid_person', 'Production_Injection_Person', 'Store_person', 'ResearchDevelopment_person', 'Microbiology_person', 'RegulatoryAffair_person', 'CorporateQualityAssurance_person', 'ContractGiver_person'];

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
                            ['data' => $marketComplaint],
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

                if ($marketComplaint->Initial_attachment) {
                    $files = is_array(json_decode($marketComplaint->Initial_attachment)) ? $marketComplaint->Initial_attachment : [];
                }

                if ($request->hasfile('Initial_attachment')) {
                    foreach ($request->file('Initial_attachment') as $file) {
                        $name = $request->name . 'Initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }


                $marketComplaint->Initial_attachment = json_encode($files);
            }
        }



        //first attchment ============================
        if (!empty($request->initial_attachment_gi) || !empty($request->deleted_attachments_gi)) {
            $existingFiles = json_decode($marketComplaint->initial_attachment_gi, true) ?? [];
            if (!empty($request->deleted_attachments_gi)) {
                $filesToDelete = explode(',', $request->deleted_attachments_gi);
                $existingFiles = array_filter($existingFiles, function ($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }
            $newFiles = [];
            if ($request->hasFile('initial_attachment_gi')) {
                foreach ($request->file('initial_attachment_gi') as $file) {
                    $name = $request->name . 'initial_attachment_gi' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }
            $allFiles = array_merge($existingFiles, $newFiles);
            $marketComplaint->initial_attachment_gi = json_encode($allFiles);
        }

        if ($request->hasFile('initial_attachment_hodsr')) {
            $files = [];
            foreach ($request->file('initial_attachment_hodsr') as $file) {
                $name = $request->name . '_initial_attachment_hodsr_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/'), $name);
                $files[] = $name;
            }
            $marketComplaint->initial_attachment_hodsr = json_encode($files);
        }
        $marketComplaint->fill($request->except('initial_attachment_hodsr'));


        if (!empty($request->initial_attachment_ca) || !empty($request->deleted_initial_attachment_ca)) {
            $existingFiles = json_decode($marketComplaint->initial_attachment_ca, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_initial_attachment_ca)) {
                $filesToDelete = explode(',', $request->deleted_initial_attachment_ca);
                $existingFiles = array_filter($existingFiles, function ($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('initial_attachment_ca')) {
                foreach ($request->file('initial_attachment_ca') as $file) {
                    $name = $request->name . 'initial_attachment_ca' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $marketComplaint->initial_attachment_ca = json_encode($allFiles);
        }


        if (!empty($request->initial_attachment_c) || !empty($request->deleted_initial_attachment_c)) {
            $existingFiles = json_decode($marketComplaint->initial_attachment_c, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_initial_attachment_c)) {
                $filesToDelete = explode(',', $request->deleted_initial_attachment_c);
                $existingFiles = array_filter($existingFiles, function ($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('initial_attachment_c')) {
                foreach ($request->file('initial_attachment_c') as $file) {
                    $name = $request->name . 'initial_attachment_c' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $marketComplaint->initial_attachment_c = json_encode($allFiles);
        }
        $marketComplaint->fill($request->except('initial_attachment_c'));


        //     if (!empty($request->qa_cqa_attachments) || !empty($request->deleted_qa_cqa_attachments)) {
        //     $existingFiles = json_decode($marketComplaint->qa_cqa_attachments, true) ?? [];

        //     // Handle deleted files
        //     if (!empty($request->deleted_qa_cqa_attachments)) {
        //         $filesToDelete = explode(',', $request->deleted_qa_cqa_attachments);
        //         $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
        //             return !in_array($file, $filesToDelete);
        //         });
        //     }

        //     // Handle new files
        //     $newFiles = [];
        //     if ($request->hasFile('qa_cqa_attachments')) {
        //         foreach ($request->file('qa_cqa_attachments') as $file) {
        //             $name = $request->name . 'qa_cqa_attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
        //             $file->move(public_path('upload/'), $name);
        //             $newFiles[] = $name;
        //         }
        //     }

        //     // Merge existing and new files
        //     $allFiles = array_merge($existingFiles, $newFiles);
        //     $marketComplaint->qa_cqa_attachments = json_encode($allFiles);
        // }
        //     // Handle deleted files
        //     if (!empty($request->deleted_qa_cqa_he_attach)) {
        //         $filesToDelete = explode(',', $request->deleted_qa_cqa_he_attach);
        //         $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
        //             return !in_array($file, $filesToDelete);
        //         });
        //     }

        //     // Handle new files
        //     $newFiles = [];
        //     if ($request->hasFile('qa_cqa_he_attach')) {
        //         foreach ($request->file('qa_cqa_he_attach') as $file) {
        //             $name = $request->name . 'qa_cqa_he_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
        //             $file->move(public_path('upload/'), $name);
        //             $newFiles[] = $name;
        //         }
        //     }
        if (!empty($request->qa_cqa_head_attach) || !empty($request->deleted_qa_cqa_head_attach)) {
            $existingFiles = json_decode($marketComplaint->qa_cqa_head_attach, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_qa_cqa_head_attach)) {
                $filesToDelete = explode(',', $request->deleted_qa_cqa_head_attach);
                $existingFiles = array_filter($existingFiles, function ($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('qa_cqa_head_attach')) {
                foreach ($request->file('qa_cqa_head_attach') as $file) {
                    $name = $request->name . 'qa_cqa_head_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $marketComplaint->qa_cqa_head_attach = json_encode($allFiles);
        }

        if (!empty($request->qa_cqa_he_attach) || !empty($request->deleted_qa_cqa_he_attach)) {
            $existingFiles = json_decode($marketComplaint->qa_cqa_he_attach, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_qa_cqa_he_attach)) {
                $filesToDelete = explode(',', $request->deleted_qa_cqa_he_attach);
                $existingFiles = array_filter($existingFiles, function ($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('qa_cqa_he_attach')) {
                foreach ($request->file('qa_cqa_he_attach') as $file) {
                    $name = $request->name . 'qa_cqa_he_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $marketComplaint->qa_cqa_he_attach = json_encode($allFiles);
        }
        if (!empty($request->qa_cqa_attachments) || !empty($request->deleted_qa_cqa_attachments)) {
            $existingFiles = json_decode($marketComplaint->qa_cqa_attachments, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_qa_cqa_attachments)) {
                $filesToDelete = explode(',', $request->deleted_qa_cqa_attachments);
                $existingFiles = array_filter($existingFiles, function ($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('qa_cqa_attachments')) {
                foreach ($request->file('qa_cqa_attachments') as $file) {
                    $name = $request->name . 'qa_cqa_attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $marketComplaint->qa_cqa_attachments = json_encode($allFiles);
        }


        // -------------------------audit show conditon--codestart----------------------------------
        if ($lastmarketComplaint->review_of_stability_study_gi != $marketComplaint->review_of_stability_study_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of stability study program and samples';
            $history->previous = $lastmarketComplaint->review_of_stability_study_gi;
            $history->current = $marketComplaint->review_of_stability_study_gi;
            $history->comment = $request->review_of_stability_study_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->review_of_stability_study_gi) || $lastmarketComplaint->review_of_stability_study_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastmarketComplaint->review_of_product_manu_gi != $marketComplaint->review_of_product_manu_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of product manufacturing and analytical process';
            $history->previous = $lastmarketComplaint->review_of_product_manu_gi;
            $history->current = $marketComplaint->review_of_product_manu_gi;
            $history->comment = $request->review_of_product_manu_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->review_of_product_manu_gi) || $lastmarketComplaint->review_of_product_manu_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastmarketComplaint->additional_inform != $marketComplaint->additional_inform) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Additional information if require ';
            $history->previous = $lastmarketComplaint->additional_inform;
            $history->current = $marketComplaint->additional_inform;
            $history->comment = $request->additional_inform_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->additional_inform) || $lastmarketComplaint->additional_inform === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastmarketComplaint->in_case_Invalide_com != $marketComplaint->in_case_Invalide_com) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Comments';
            $history->previous = $lastmarketComplaint->in_case_Invalide_com;
            $history->current = $marketComplaint->in_case_Invalide_com;
            $history->comment = $request->in_case_Invalide_com_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->in_case_Invalide_com) || $lastmarketComplaint->in_case_Invalide_com === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastmarketComplaint->conclusion_pi != $marketComplaint->conclusion_pi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Conclusion';
            $history->previous = $lastmarketComplaint->conclusion_pi;
            $history->current = $marketComplaint->conclusion_pi;
            $history->comment = $request->conclusion_pi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->conclusion_pi) || $lastmarketComplaint->conclusion_pi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastmarketComplaint->the_probable_root != $marketComplaint->the_probable_root) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'The probable root causes or Root Cause';
            $history->previous = $lastmarketComplaint->the_probable_root;
            $history->current = $marketComplaint->the_probable_root;
            $history->comment = $request->the_probable_root_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->the_probable_root) || $lastmarketComplaint->the_probable_root === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastmarketComplaint->initiator_group != $marketComplaint->initiator_group) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Initiator Department';
            $history->previous = Helpers::getFullDepartmentName($lastmarketComplaint->initiator_group);
            $history->current = Helpers::getFullDepartmentName($marketComplaint->initiator_group);
            $history->comment = $request->initiator_group_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->initiator_group) || $lastmarketComplaint->initiator_group === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastmarketComplaint->initiator_group_code_gi != $marketComplaint->initiator_group_code_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Initiator Department Code';
            $history->previous = Helpers::getFullDepartmentName($lastmarketComplaint->initiator_group_code_gi);
            $history->current = Helpers::getFullDepartmentName($marketComplaint->initiator_group_code_gi);
            $history->comment = $request->initiator_group_code_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->initiator_group_code_gi) || $lastmarketComplaint->initiator_group_code_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastmarketComplaint->review_of_past_history_of_product_gi != $marketComplaint->review_of_past_history_of_product_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Past history of product';
            $history->previous = $lastmarketComplaint->review_of_past_history_of_product_gi;
            $history->current = $marketComplaint->review_of_past_history_of_product_gi;
            $history->comment = $request->review_of_past_history_of_product_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->review_of_past_history_of_product_gi) || $lastmarketComplaint->review_of_past_history_of_product_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastmarketComplaint->review_of_equipment_break_down_and_maintainance_record_gi != $marketComplaint->review_of_equipment_break_down_and_maintainance_record_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Equipment Break-down and Maintainance Record';
            $history->previous = $lastmarketComplaint->review_of_equipment_break_down_and_maintainance_record_gi;
            $history->current = $marketComplaint->review_of_equipment_break_down_and_maintainance_record_gi;
            $history->comment = $request->review_of_equipment_break_down_and_maintainance_record_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->review_of_equipment_break_down_and_maintainance_record_gi)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->rev_eq_inst_qual_calib_record_gi != $marketComplaint->rev_eq_inst_qual_calib_record_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Equipment/Instrument qualification/Calibration record';
            $history->previous = $lastmarketComplaint->rev_eq_inst_qual_calib_record_gi;
            $history->current = $marketComplaint->rev_eq_inst_qual_calib_record_gi;
            $history->comment = $request->rev_eq_inst_qual_calib_record_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->rev_eq_inst_qual_calib_record_gi)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastmarketComplaint->review_of_training_record_of_concern_persons_gi != $marketComplaint->review_of_training_record_of_concern_persons_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of training record of Concern Persons';
            $history->previous = $lastmarketComplaint->review_of_training_record_of_concern_persons_gi;
            $history->current = $marketComplaint->review_of_training_record_of_concern_persons_gi;
            $history->comment = $request->review_of_training_record_of_concern_persons_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->review_of_training_record_of_concern_persons_gi)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->review_of_analytical_data_gi != $marketComplaint->review_of_analytical_data_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Analytical Data';
            $history->previous = $lastmarketComplaint->review_of_analytical_data_gi;
            $history->current = $marketComplaint->review_of_analytical_data_gi;
            $history->comment = $request->review_of_analytical_data_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->review_of_analytical_data_gi)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->review_of_Batch_Packing_record_bpr_gi != $marketComplaint->review_of_Batch_Packing_record_bpr_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Batch Packing record BPR';
            $history->previous = $lastmarketComplaint->review_of_Batch_Packing_record_bpr_gi;
            $history->current = $marketComplaint->review_of_Batch_Packing_record_bpr_gi;
            $history->comment = $request->review_of_Batch_Packing_record_bpr_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->review_of_Batch_Packing_record_bpr_gi)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastmarketComplaint->review_of_packing_materials_used_in_batch_packing_gi != $marketComplaint->review_of_packing_materials_used_in_batch_packing_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of packing materials used in batch packing';
            $history->previous = $lastmarketComplaint->review_of_packing_materials_used_in_batch_packing_gi;
            $history->current = $marketComplaint->review_of_packing_materials_used_in_batch_packing_gi;
            $history->comment = $request->review_of_packing_materials_used_in_batch_packing_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->review_of_packing_materials_used_in_batch_packing_gi)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->review_of_raw_materials_used_in_batch_manufacturing_gi != $marketComplaint->review_of_raw_materials_used_in_batch_manufacturing_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Raw materials used in batch manufacturing';
            $history->previous = $lastmarketComplaint->review_of_raw_materials_used_in_batch_manufacturing_gi;
            $history->current = $marketComplaint->review_of_raw_materials_used_in_batch_manufacturing_gi;
            $history->comment = $request->review_of_raw_materials_used_in_batch_manufacturing_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->review_of_raw_materials_used_in_batch_manufacturing_gi)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->review_of_control_sample_gi != $marketComplaint->review_of_control_sample_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Control Sample';
            $history->previous = $lastmarketComplaint->review_of_control_sample_gi;
            $history->current = $marketComplaint->review_of_control_sample_gi;
            $history->comment = $request->review_of_control_sample_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->review_of_control_sample_gi)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        if ($lastmarketComplaint->review_of_batch_manufacturing_record_BMR_gi != $marketComplaint->review_of_batch_manufacturing_record_BMR_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Batch Manufacturing Record (BMR)';
            $history->previous = $lastmarketComplaint->review_of_batch_manufacturing_record_BMR_gi;
            $history->current = $marketComplaint->review_of_batch_manufacturing_record_BMR_gi;
            $history->comment = $request->review_of_batch_manufacturing_record_BMR_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->review_of_batch_manufacturing_record_BMR_gi)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastmarketComplaint->review_of_complaint_sample_gi != $marketComplaint->review_of_complaint_sample_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Review of Complaint Sample';
            $history->previous = $lastmarketComplaint->review_of_complaint_sample_gi;
            $history->current = $marketComplaint->review_of_complaint_sample_gi;
            $history->comment = $request->review_of_complaint_sample_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->review_of_complaint_sample_gi)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        if ($lastmarketComplaint->due_date_gi != $marketComplaint->due_date_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Due Date';
            $history->previous = $lastmarketComplaint->due_date_gi;
            $history->current = $marketComplaint->due_date_gi;
            $history->comment = $request->due_date_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->due_date_gi)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastmarketComplaint->description_gi != $marketComplaint->description_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastmarketComplaint->description_gi;
            $history->current = $marketComplaint->description_gi;
            $history->comment = $request->description_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->description_gi)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }



        // if ( $lastmarketComplaint->initiator_group != $marketComplaint->initiator_group ) {
        //     $history = new MarketComplaintAuditTrial();
        //     $history->market_id = $marketComplaint->id;
        //     $history->activity_type = 'Initiator Group';
        //     $history->previous = $lastmarketComplaint->initiator_group;
        //     $history->current = $marketComplaint->initiator_group;
        //     $history->comment = $request->initiator_group_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastmarketComplaint->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastmarketComplaint->status;

        //     // New condition added here
        //     if (is_null($lastmarketComplaint->initiator_group) || $lastmarketComplaint->initiator_group === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        if ($lastmarketComplaint->initiated_through_gi != $marketComplaint->initiated_through_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Initiated Through';
            $history->previous = $lastmarketComplaint->initiated_through_gi;
            $history->current = $marketComplaint->initiated_through_gi;
            $history->comment = $request->initiated_through_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->initiated_through_gi) || $lastmarketComplaint->initiated_through_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastmarketComplaint->if_other_gi != $marketComplaint->if_other_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'If Other';
            $history->previous = $lastmarketComplaint->if_other_gi;
            $history->current = $marketComplaint->if_other_gi;
            $history->comment = $request->if_other_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->if_other_gi) || $lastmarketComplaint->if_other_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastmarketComplaint->is_repeat_gi != $marketComplaint->is_repeat_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Is Repeat';
            $history->previous = $lastmarketComplaint->is_repeat_gi;
            $history->current = $marketComplaint->is_repeat_gi;
            $history->comment = $request->is_repeat_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->is_repeat_gi) || $lastmarketComplaint->is_repeat_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        if ($lastmarketComplaint->repeat_nature_gi != $marketComplaint->repeat_nature_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = $lastmarketComplaint->repeat_nature_gi;
            $history->current = $marketComplaint->repeat_nature_gi;
            $history->comment = $request->repeat_nature_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->repeat_nature_gi) || $lastmarketComplaint->repeat_nature_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastmarketComplaint->initial_attachment_gi != $marketComplaint->initial_attachment_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Information Attachment';
            $history->previous = str_replace(',', ', ', $lastmarketComplaint->initial_attachment_gi);
            $history->current = str_replace(',', ', ', $marketComplaint->initial_attachment_gi);
            $history->comment = $request->initial_attachment_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->initial_attachment_gi) || $lastmarketComplaint->initial_attachment_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastmarketComplaint->complainant_gi != $marketComplaint->complainant_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Complaint';
            $history->previous = $lastmarketComplaint->complainant_gi;
            $history->current = $marketComplaint->complainant_gi;
            $history->comment = $request->complainant_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->complainant_gi) || $lastmarketComplaint->complainant_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastmarketComplaint->complaint_reported_on_gi != $marketComplaint->complaint_reported_on_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Complaint Reported On';
            $history->previous = $lastmarketComplaint->complaint_reported_on_gi;
            $history->current = $marketComplaint->complaint_reported_on_gi;
            $history->comment = $request->complaint_reported_on_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->complaint_reported_on_gi) || $lastmarketComplaint->complaint_reported_on_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastmarketComplaint->details_of_nature_market_complaint_gi != $marketComplaint->details_of_nature_market_complaint_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Details Of Nature Market Complaint';
            $history->previous = $lastmarketComplaint->details_of_nature_market_complaint_gi;
            $history->current = $marketComplaint->details_of_nature_market_complaint_gi;
            $history->comment = $request->details_of_nature_market_complaint_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->details_of_nature_market_complaint_gi) || $lastmarketComplaint->details_of_nature_market_complaint_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        if ($lastmarketComplaint->stability_study_data_review_ca != $marketComplaint->stability_study_data_review_ca) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Stablity Study Data Review';
            $history->previous = $lastmarketComplaint->stability_study_data_review_ca;
            $history->current = $marketComplaint->stability_study_data_review_ca;
            $history->comment = $request->stability_study_data_review_ca_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->stability_study_data_review_ca) || $lastmarketComplaint->stability_study_data_review_ca === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        if ($lastmarketComplaint->categorization_of_complaint_gi != $marketComplaint->categorization_of_complaint_gi) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Categorization of complaint';
            $history->previous = $lastmarketComplaint->categorization_of_complaint_gi;
            $history->current = $marketComplaint->categorization_of_complaint_gi;
            $history->comment = $request->categorization_of_complaint_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->categorization_of_complaint_gi) || $lastmarketComplaint->categorization_of_complaint_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        if ($lastmarketComplaint->qa_head_comment != $marketComplaint->qa_head_comment) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'QA/CQA Head Comment';
            $history->previous = $lastmarketComplaint->qa_head_comment;
            $history->current = $marketComplaint->qa_head_comment;
            $history->comment = $request->qa_head_comment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->qa_head_comment) || $lastmarketComplaint->qa_head_comment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastmarketComplaint->qa_cqa_he_attach != $marketComplaint->qa_cqa_he_attach) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'QA/CQA Head Attachment';
            $history->previous = str_replace(',', ', ', $lastmarketComplaint->qa_cqa_he_attach);
            $history->current = str_replace(',', ', ', $marketComplaint->qa_cqa_he_attach);
            $history->comment = $request->qa_cqa_he_attach_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->qa_cqa_he_attach) || $lastmarketComplaint->qa_cqa_he_attach === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        if ($lastmarketComplaint->qa_cqa_comments != $marketComplaint->qa_cqa_comments) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'QA/CQA Comment';
            $history->previous = $lastmarketComplaint->qa_cqa_comments;
            $history->current = $marketComplaint->qa_cqa_comments;
            $history->comment = $request->qa_cqa_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->qa_cqa_comments) || $lastmarketComplaint->qa_cqa_comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        if ($lastmarketComplaint->qa_cqa_attachments != $marketComplaint->qa_cqa_attachments) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'QA/CQA  Attachments';
            $history->previous = str_replace(',', ', ', $lastmarketComplaint->qa_cqa_attachments);
            $history->current = str_replace(',', ', ', $marketComplaint->qa_cqa_attachments);
            $history->comment = $request->qa_cqa_attachments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->qa_cqa_attachments) || $lastmarketComplaint->qa_cqa_attachments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        if ($lastmarketComplaint->qa_cqa_head_comm != $marketComplaint->qa_cqa_head_comm) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'QA/CQA Head Approval Comment';
            $history->previous = $lastmarketComplaint->qa_cqa_head_comm;
            $history->current = $marketComplaint->qa_cqa_head_comm;
            $history->comment = $request->qa_cqa_head_comm_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->qa_cqa_head_comm) || $lastmarketComplaint->qa_cqa_head_comm === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        if ($lastmarketComplaint->qa_cqa_head_attach != $marketComplaint->qa_cqa_head_attach) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'QA/CQA Head Approval Attachment';
            $history->previous = str_replace(',', ', ', $lastmarketComplaint->qa_cqa_head_attach);
            $history->current = str_replace(',', ', ', $marketComplaint->qa_cqa_head_attach);
            $history->comment = $request->qa_cqa_head_attach_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;

            // New condition added here
            if (is_null($lastmarketComplaint->qa_cqa_head_attach) || $lastmarketComplaint->qa_cqa_head_attach === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        // -------------------------------------------------------hod audit show filds ----------------------------------------------

        if ($lastmarketComplaint->conclusion_hodsr != $marketComplaint->conclusion_hodsr) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Root Cause Analysis';
            $history->previous = $lastmarketComplaint->conclusion_hodsr;
            $history->current = $marketComplaint->conclusion_hodsr;
            $history->comment = $request->conclusion_hodsr_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->conclusion_hodsr) || $lastmarketComplaint->conclusion_hodsr === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->root_cause_analysis_hodsr != $marketComplaint->root_cause_analysis_hodsr) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Other Methodology';
            $history->previous = $lastmarketComplaint->root_cause_analysis_hodsr;
            $history->current = $marketComplaint->root_cause_analysis_hodsr;
            $history->comment = $request->root_cause_analysis_hodsr_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->root_cause_analysis_hodsr) || $lastmarketComplaint->root_cause_analysis_hodsr === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->probable_root_causes_complaint_hodsr != $marketComplaint->probable_root_causes_complaint_hodsr) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Type of Market Complaints';
            $history->previous = $lastmarketComplaint->probable_root_causes_complaint_hodsr;
            $history->current = $marketComplaint->probable_root_causes_complaint_hodsr;
            $history->comment = $request->probable_root_causes_complaint_hodsr_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->probable_root_causes_complaint_hodsr) || $lastmarketComplaint->probable_root_causes_complaint_hodsr === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->impact_assessment_hodsr != $marketComplaint->impact_assessment_hodsr) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Impact Assessment';
            $history->previous = $lastmarketComplaint->impact_assessment_hodsr;
            $history->current = $marketComplaint->impact_assessment_hodsr;
            $history->comment = $request->impact_assessment_hodsr_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->impact_assessment_hodsr) || $lastmarketComplaint->impact_assessment_hodsr === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->corrective_action_hodsr != $marketComplaint->corrective_action_hodsr) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Corrective Action';
            $history->previous = $lastmarketComplaint->corrective_action_hodsr;
            $history->current = $marketComplaint->corrective_action_hodsr;
            $history->comment = $request->corrective_action_hodsr_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->corrective_action_hodsr) || $lastmarketComplaint->corrective_action_hodsr === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastmarketComplaint->preventive_action_hodsr != $marketComplaint->preventive_action_hodsr) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Preventive Action';
            $history->previous = $lastmarketComplaint->preventive_action_hodsr;
            $history->current = $marketComplaint->preventive_action_hodsr;
            $history->comment = $request->preventive_action_hodsr_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->preventive_action_hodsr) || $lastmarketComplaint->preventive_action_hodsr === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->summary_and_conclusion_hodsr != $marketComplaint->summary_and_conclusion_hodsr) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Summary and Conclusion';
            $history->previous = $lastmarketComplaint->summary_and_conclusion_hodsr;
            $history->current = $marketComplaint->summary_and_conclusion_hodsr;
            $history->comment = $request->summary_and_conclusion_hodsr_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->summary_and_conclusion_hodsr) || $lastmarketComplaint->summary_and_conclusion_hodsr === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->initial_attachment_hodsr != $marketComplaint->initial_attachment_hodsr) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'HOD Attachment';
            $history->previous = str_replace(',', ', ', $lastmarketComplaint->initial_attachment_hodsr);
            $history->current = str_replace(',', ', ', $marketComplaint->initial_attachment_hodsr);
            $history->comment = $request->initial_attachment_hodsr_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->initial_attachment_hodsr) || $lastmarketComplaint->initial_attachment_hodsr === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastmarketComplaint->comments_if_any_hodsr != $marketComplaint->comments_if_any_hodsr) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Comments if Any';
            $history->previous = $lastmarketComplaint->comments_if_any_hodsr;
            $history->current = $marketComplaint->comments_if_any_hodsr;
            $history->comment = $request->comments_if_any_hodsr_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->comments_if_any_hodsr) || $lastmarketComplaint->comments_if_any_hodsr === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // ------------------------------------------------c a audit show data---------------------

        if ($lastmarketComplaint->manufacturer_name_address_ca != $marketComplaint->manufacturer_name_address_ca) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Manufacturer name & Address';
            $history->previous = $lastmarketComplaint->manufacturer_name_address_ca;
            $history->current = $marketComplaint->manufacturer_name_address_ca;
            $history->comment = $request->manufacturer_name_address_ca_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->manufacturer_name_address_ca) || $lastmarketComplaint->manufacturer_name_address_ca === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastmarketComplaint->complaint_sample_required_ca != $marketComplaint->complaint_sample_required_ca) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Complaint Sample Required';
            $history->previous = $lastmarketComplaint->complaint_sample_required_ca;
            $history->current = $marketComplaint->complaint_sample_required_ca;
            $history->comment = $request->complaint_sample_required_ca_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->complaint_sample_required_ca) || $lastmarketComplaint->complaint_sample_required_ca === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastmarketComplaint->complaint_sample_status_ca != $marketComplaint->complaint_sample_status_ca) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Complaint Sample Status';
            $history->previous = $lastmarketComplaint->complaint_sample_status_ca;
            $history->current = $marketComplaint->complaint_sample_status_ca;
            $history->comment = $request->complaint_sample_status_ca_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->complaint_sample_status_ca) || $lastmarketComplaint->complaint_sample_status_ca === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        if ($lastmarketComplaint->brief_description_of_complaint_ca != $marketComplaint->brief_description_of_complaint_ca) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Brief Description of complaint';
            $history->previous = $lastmarketComplaint->brief_description_of_complaint_ca;
            $history->current = $marketComplaint->brief_description_of_complaint_ca;
            $history->comment = $request->brief_description_of_complaint_ca_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->brief_description_of_complaint_ca) || $lastmarketComplaint->brief_description_of_complaint_ca === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastmarketComplaint->batch_record_review_observation_ca != $marketComplaint->batch_record_review_observation_ca) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Batch Record review observation';
            $history->previous = $lastmarketComplaint->batch_record_review_observation_ca;
            $history->current = $marketComplaint->batch_record_review_observation_ca;
            $history->comment = $request->batch_record_review_observation_ca_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->batch_record_review_observation_ca) || $lastmarketComplaint->batch_record_review_observation_ca === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->analytical_data_review_observation_ca != $marketComplaint->analytical_data_review_observation_ca) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Analytical Data review observation';
            $history->previous = $lastmarketComplaint->analytical_data_review_observation_ca;
            $history->current = $marketComplaint->analytical_data_review_observation_ca;
            $history->comment = $request->analytical_data_review_observation_ca_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->analytical_data_review_observation_ca) || $lastmarketComplaint->analytical_data_review_observation_ca === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->retention_sample_review_observation_ca != $marketComplaint->retention_sample_review_observation_ca) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Retention sample review observation';
            $history->previous = $lastmarketComplaint->retention_sample_review_observation_ca;
            $history->current = $marketComplaint->retention_sample_review_observation_ca;
            $history->comment = $request->retention_sample_review_observation_ca_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->retention_sample_review_observation_ca) || $lastmarketComplaint->retention_sample_review_observation_ca === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastmarketComplaint->qms_events_ifany_review_observation_ca != $marketComplaint->qms_events_ifany_review_observation_ca) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'QMS Events(if any) review Observation';
            $history->previous = $lastmarketComplaint->qms_events_ifany_review_observation_ca;
            $history->current = $marketComplaint->qms_events_ifany_review_observation_ca;
            $history->comment = $request->qms_events_ifany_review_observation_ca_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->qms_events_ifany_review_observation_ca) || $lastmarketComplaint->qms_events_ifany_review_observation_ca === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->repeated_complaints_queries_for_product_ca != $marketComplaint->repeated_complaints_queries_for_product_ca) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Repeated complaints/queries for product';
            $history->previous = $lastmarketComplaint->repeated_complaints_queries_for_product_ca;
            $history->current = $marketComplaint->repeated_complaints_queries_for_product_ca;
            $history->comment = $request->repeated_complaints_queries_for_product_ca_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->repeated_complaints_queries_for_product_ca) || $lastmarketComplaint->repeated_complaints_queries_for_product_ca === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastmarketComplaint->interpretation_on_complaint_sample_ifrecieved_ca != $marketComplaint->interpretation_on_complaint_sample_ifrecieved_ca) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Interpretation on Complaint sample(if recieved)';
            $history->previous = $lastmarketComplaint->interpretation_on_complaint_sample_ifrecieved_ca;
            $history->current = $marketComplaint->interpretation_on_complaint_sample_ifrecieved_ca;
            $history->comment = $request->interpretation_on_complaint_sample_ifrecieved_ca_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->interpretation_on_complaint_sample_ifrecieved_ca) || $lastmarketComplaint->interpretation_on_complaint_sample_ifrecieved_ca === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->comments_ifany_ca != $marketComplaint->comments_ifany_ca) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Comments(if Any)';
            $history->previous = $lastmarketComplaint->comments_ifany_ca;
            $history->current = $marketComplaint->comments_ifany_ca;
            $history->comment = $request->comments_ifany_ca_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->comments_ifany_ca) || $lastmarketComplaint->comments_ifany_ca === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastmarketComplaint->initial_attachment_ca != $marketComplaint->initial_attachment_ca) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Acknowledgement Attachment';
            $history->previous = str_replace(',', ', ', $lastmarketComplaint->initial_attachment_ca);
            $history->current = str_replace(',', ', ', $marketComplaint->initial_attachment_ca);
            $history->comment = $request->initial_attachment_ca_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->initial_attachment_ca) || $lastmarketComplaint->initial_attachment_ca === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        // =======================closure tab ========
        if ($lastmarketComplaint->closure_comment_c != $marketComplaint->closure_comment_c) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Closure Comment';
            $history->previous = $lastmarketComplaint->closure_comment_c;
            $history->current = $marketComplaint->closure_comment_c;
            $history->comment = $request->closure_comment_c_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->closure_comment_c) || $lastmarketComplaint->closure_comment_c === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastmarketComplaint->initial_attachment_c != $marketComplaint->initial_attachment_c) {
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $marketComplaint->id;
            $history->activity_type = 'Closure Attachment    ';
            $history->previous = str_replace(',', ', ', $lastmarketComplaint->initial_attachment_c);
            $history->current = str_replace(',', ', ', $marketComplaint->initial_attachment_c);
            $history->comment = $request->initial_attachment_c_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastmarketComplaint->initial_attachment_c) || $lastmarketComplaint->initial_attachment_c === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        ///------------------------CFT----------------------------------------------------

        /************ CFT Review ************/
        /*************** Quality Assurance ***************/
        if ($lastCft->Quality_Assurance_Review != $request->Quality_Assurance_Review && $request->Quality_Assurance_Review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Quality Assurance Review Required';
            $history->previous = $lastCft->Quality_Assurance_Review;
            $history->current = $request->Quality_Assurance_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Quality_Assurance_Review) || $lastCft->Quality_Assurance_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_person != $request->QualityAssurance_person && $request->QualityAssurance_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Quality Assurance Person';
            $history->previous = $lastCft->QualityAssurance_person;
            $history->current = $request->QualityAssurance_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->QualityAssurance_person) || $lastCft->QualityAssurance_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_assessment != $request->QualityAssurance_assessment && $request->QualityAssurance_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Impact Assessment(Quality Assurance)';
            $history->previous = $lastCft->QualityAssurance_assessment;
            $history->current = $request->QualityAssurance_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->QualityAssurance_assessment) || $lastCft->QualityAssurance_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_feedback != $request->QualityAssurance_feedback && $request->QualityAssurance_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Quality Assurance Feedback';
            $history->previous = $lastCft->QualityAssurance_feedback;
            $history->current = $request->QualityAssurance_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->QualityAssurance_feedback) || $lastCft->QualityAssurance_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Quality_Assurance_attachment != $request->Quality_Assurance_attachment && $request->Quality_Assurance_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Quality Assurance Attachment';
            $history->previous = $lastCft->Quality_Assurance_attachment;
            $history->current = implode(',', $request->Quality_Assurance_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Quality_Assurance_attachment) || $lastCft->Quality_Assurance_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_by != $request->QualityAssurance_by && $request->QualityAssurance_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Quality Assurance Review Completed By';
            $history->previous = $lastCft->QualityAssurance_by;
            $history->current = $request->QualityAssurance_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->QualityAssurance_by) || $lastCft->QualityAssurance_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_on != $request->QualityAssurance_on && $request->QualityAssurance_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Quality Assurance Review Completed On';
            $history->previous = $lastCft->QualityAssurance_on;
            $history->current = $request->QualityAssurance_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->QualityAssurance_person) || $lastCft->QualityAssurance_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        /*************** Production Tablet ***************/
        if ($lastCft->Production_Table_Review != $request->Production_Table_Review && $request->Production_Table_Review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Tablet  Required';
            $history->previous = $lastCft->Production_Table_Review;
            $history->current = $request->Production_Table_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Production_Table_Review) || $lastCft->Production_Table_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_Person != $request->Production_Table_Person && $request->Production_Table_Person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Tablet Person';
            $history->previous = $lastCft->Production_Table_Person;
            $history->current = $request->Production_Table_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Production_Table_Person) || $lastCft->Production_Table_Person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_Assessment != $request->Production_Table_Assessment && $request->Production_Table_Assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Impact Assessment (By Production Tablet)';
            $history->previous = $lastCft->Production_Table_Assessment;
            $history->current = $request->Production_Table_Assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Production_Table_Assessment) || $lastCft->Production_Table_Assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_Feedback != $request->Production_Table_Feedback && $request->Production_Table_Feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Tablet Feeback';
            $history->previous = $lastCft->Production_Table_Feedback;
            $history->current = $request->Production_Table_Feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Production_Table_Feedback) || $lastCft->Production_Table_Feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_Attachment != $request->Production_Table_Attachment && $request->Production_Table_Attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Tablet Attachment';
            $history->previous = $lastCft->Production_Table_Attachment;
            $history->current = implode(',', $request->Production_Table_Attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Production_Table_Attachment) || $lastCft->Production_Table_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_By != $request->Production_Table_By && $request->Production_Table_By != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Tablet Completed By';
            $history->previous = $lastCft->Production_Table_Review;
            $history->current = $request->Production_Table_By;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Production_Table_By) || $lastCft->Production_Table_By === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_On != $request->Production_Table_On && $request->Production_Table_On != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Tablet Completed On';
            $history->previous = $lastCft->Production_Table_On;
            $history->current = $request->Production_Table_On;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Production_Table_On) || $lastCft->Production_Table_On === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Production Liquid ***************/
        if ($lastCft->ProductionLiquid_Review != $request->ProductionLiquid_Review && $request->ProductionLiquid_Review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Liquid Required ?';
            $history->previous = $lastCft->ProductionLiquid_Review;
            $history->current = $request->ProductionLiquid_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ProductionLiquid_Review) || $lastCft->ProductionLiquid_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_person != $request->ProductionLiquid_person && $request->ProductionLiquid_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Person';
            $history->previous = $lastCft->ProductionLiquid_person;
            $history->current = $request->ProductionLiquid_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ProductionLiquid_person) || $lastCft->ProductionLiquid_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_assessment != $request->ProductionLiquid_assessment && $request->ProductionLiquid_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Impact Assessment (By Production Liquid)';
            $history->previous = $lastCft->ProductionLiquid_assessment;
            $history->current = $request->ProductionLiquid_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ProductionLiquid_assessment) || $lastCft->ProductionLiquid_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_feedback != $request->ProductionLiquid_feedback && $request->ProductionLiquid_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Feedback';
            $history->previous = $lastCft->ProductionLiquid_feedback;
            $history->current = $request->ProductionLiquid_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ProductionLiquid_feedback) || $lastCft->ProductionLiquid_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_attachment != $request->ProductionLiquid_attachment && $request->ProductionLiquid_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Attachments';
            $history->previous = $lastCft->ProductionLiquid_attachment;
            $history->current = implode(',', $request->ProductionLiquid_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ProductionLiquid_attachment) || $lastCft->ProductionLiquid_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_by != $request->ProductionLiquid_by && $request->ProductionLiquid_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Liquid Completed By';
            $history->previous = $lastCft->ProductionLiquid_by;
            $history->current = $request->ProductionLiquid_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ProductionLiquid_by) || $lastCft->ProductionLiquid_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_on != $request->ProductionLiquid_on && $request->ProductionLiquid_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Liquid Completed On';
            $history->previous = $lastCft->ProductionLiquid_on;
            $history->current = $request->ProductionLiquid_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ProductionLiquid_on) || $lastCft->ProductionLiquid_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Production Injection ***************/
        if ($lastCft->Production_Injection_Review != $request->Production_Injection_Review && $request->Production_Injection_Review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Injection Required';
            $history->previous = $lastCft->Production_Injection_Review;
            $history->current = $request->Production_Injection_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Production_Injection_Review) || $lastCft->Production_Injection_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_Person != $request->Production_Injection_Person && $request->Production_Injection_Person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Injection Person';
            $history->previous = $lastCft->Production_Injection_Person;
            $history->current = $request->Production_Injection_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Production_Injection_Person) || $lastCft->Production_Injection_Person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_Assessment != $request->Production_Injection_Assessment && $request->Production_Injection_Assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Impact Assessment(By Production Injection)';
            $history->previous = $lastCft->Production_Injection_Assessment;
            $history->current = $request->Production_Injection_Assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Production_Injection_Assessment) || $lastCft->Production_Injection_Assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_Feedback != $request->Production_Injection_Feedback && $request->Production_Injection_Feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Injection Feedback';
            $history->previous = $lastCft->Production_Injection_Feedback;
            $history->current = $request->Production_Injection_Feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Production_Injection_Feedback) || $lastCft->Production_Injection_Feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_Attachment != $request->Production_Injection_Attachment && $request->Production_Injection_Attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Injection Attachment';
            $history->previous = $lastCft->Production_Injection_Attachment;
            $history->current = implode(',', $request->Production_Injection_Attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Production_Injection_Attachment) || $lastCft->Production_Injection_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_By != $request->Production_Injection_By && $request->Production_Injection_By != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Injection Completed By';
            $history->previous = $lastCft->Production_Injection_By;
            $history->current = $request->Production_Injection_By;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Production_Injection_By) || $lastCft->Production_Injection_By === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_On != $request->Production_Injection_On && $request->Production_Injection_On != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Production Injection Completed On';
            $history->previous = $lastCft->Production_Injection_On;
            $history->current = $request->Production_Injection_On;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Production_Injection_On) || $lastCft->Production_Injection_On === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Stores ***************/
        if ($lastCft->Store_Review != $request->Store_Review && $request->Store_Review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Store Required';
            $history->previous = $lastCft->Store_Review;
            $history->current = $request->Store_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Store_Review) || $lastCft->Store_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_person != $request->Store_person && $request->Store_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Store Person';
            $history->previous = $lastCft->Store_person;
            $history->current = $request->Store_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Store_person) || $lastCft->Store_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_assessment != $request->Store_assessment && $request->Store_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Impact Assessment (By Store)';
            $history->previous = $lastCft->Store_assessment;
            $history->current = $request->Store_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Store_assessment) || $lastCft->Store_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_feedback != $request->Store_feedback && $request->Store_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Store Feedback';
            $history->previous = $lastCft->Store_feedback;
            $history->current = $request->Store_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Store_feedback) || $lastCft->Store_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_attachment != $request->Store_attachment && $request->Store_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Store Attachments';
            $history->previous = $lastCft->Store_attachment;
            $history->current = implode(',', $request->Store_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Store_attachment) || $lastCft->Store_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_by != $request->Store_by && $request->Store_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Store Completed By';
            $history->previous = $lastCft->Store_by;
            $history->current = $request->Store_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Store_by) || $lastCft->Store_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_on != $request->Store_on && $request->Store_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Store Completed On';
            $history->previous = $lastCft->Store_on;
            $history->current = $request->Store_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Store_on) || $lastCft->Store_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Quality Control ***************/
        if ($lastCft->Quality_review != $request->Quality_review && $request->Quality_review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Quality Control Required';
            $history->previous = $lastCft->Quality_review;
            $history->current = $request->Quality_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Quality_review) || $lastCft->Quality_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Quality_Control_Person != $request->Quality_Control_Person && $request->Quality_Control_Person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Quality Control Person';
            $history->previous = $lastCft->Quality_Control_Person;
            $history->current = $request->Quality_Control_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Quality_Control_Person) || $lastCft->Quality_Control_Person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Quality_Control_assessment != $request->Quality_Control_assessment && $request->Quality_Control_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Quality Control Assessment';
            $history->previous = $lastCft->Quality_Control_assessment;
            $history->current = $request->Quality_Control_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Quality_Control_assessment) || $lastCft->Quality_Control_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Quality_Control_feedback != $request->Quality_Control_feedback && $request->Quality_Control_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Quality Control Feeback';
            $history->previous = $lastCft->Quality_Control_feedback;
            $history->current = $request->Quality_Control_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Quality_Control_feedback) || $lastCft->Quality_Control_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Quality_Control_by != $request->Quality_Control_by && $request->Quality_Control_by != null) {
        //     $history = new MarketComplaintAuditTrial;
        //     $history->market_id = $id;
        //     $history->activity_type = 'Quality Control By';
        //     $history->previous = $lastCft->Quality_Control_by;
        //     $history->current = $request->Quality_Control_by;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastmarketComplaint->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastmarketComplaint->status;
        //      if (is_null($lastCft->Quality_Control_by) || $lastCft->Quality_Control_by === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        // if ($lastCft->Quality_Control_on != $request->Quality_Control_on && $request->Quality_Control_on != null) {
        //     $history = new MarketComplaintAuditTrial;
        //     $history->market_id = $id;
        //     $history->activity_type = 'Quality Control On';
        //     $history->previous = $lastCft->Quality_Control_on;
        //     $history->current = $request->Quality_Control_on;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastmarketComplaint->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastmarketComplaint->status;
        //      if (is_null($lastCft->Quality_Control_on) || $lastCft->Quality_Control_on === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Quality_Control_attachment != $request->Quality_Control_attachment && $request->Quality_Control_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Quality Control On';
            $history->previous = $lastCft->Quality_Control_attachment;
            $history->current = implode(',', $request->Quality_Control_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Quality_Control_attachment) || $lastCft->Quality_Control_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Research & Development ***************/
        if ($lastCft->ResearchDevelopment_Review != $request->ResearchDevelopment_Review && $request->ResearchDevelopment_Review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Research Development Required';
            $history->previous = $lastCft->ResearchDevelopment_Review;
            $history->current = $request->ResearchDevelopment_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ResearchDevelopment_Review) || $lastCft->ResearchDevelopment_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_person != $request->ResearchDevelopment_person && $request->ResearchDevelopment_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Research Development Person';
            $history->previous = $lastCft->ResearchDevelopment_person;
            $history->current = $request->ResearchDevelopment_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ResearchDevelopment_person) || $lastCft->ResearchDevelopment_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_assessment != $request->ResearchDevelopment_assessment && $request->ResearchDevelopment_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Impact Assessment(Research Development)';
            $history->previous = $lastCft->ResearchDevelopment_assessment;
            $history->current = $request->ResearchDevelopment_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ResearchDevelopment_assessment) || $lastCft->ResearchDevelopment_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_feedback != $request->ResearchDevelopment_feedback && $request->ResearchDevelopment_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Research Development Feedback';
            $history->previous = $lastCft->ResearchDevelopment_feedback;
            $history->current = $request->ResearchDevelopment_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ResearchDevelopment_feedback) || $lastCft->ResearchDevelopment_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_by != $request->ResearchDevelopment_by && $request->ResearchDevelopment_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Research Development Completed By';
            $history->previous = $lastCft->ResearchDevelopment_by;
            $history->current = $request->ResearchDevelopment_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ResearchDevelopment_by) || $lastCft->ResearchDevelopment_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_on != $request->ResearchDevelopment_on && $request->ResearchDevelopment_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Research & Development Completed On';
            $history->previous = $lastCft->ResearchDevelopment_on;
            $history->current = $request->ResearchDevelopment_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ResearchDevelopment_on) || $lastCft->ResearchDevelopment_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_attachment != $request->ResearchDevelopment_attachment && $request->ResearchDevelopment_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Research Development attachments';
            $history->previous = $lastCft->ResearchDevelopment_attachment;
            $history->current = implode(',', $request->ResearchDevelopment_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ResearchDevelopment_attachment) || $lastCft->ResearchDevelopment_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Engineering ***************/
        if ($lastCft->Engineering_review != $request->Engineering_review && $request->Engineering_review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Engineering Review Required';
            $history->previous = $lastCft->Engineering_review;
            $history->current = $request->Engineering_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Engineering_review) || $lastCft->Engineering_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_person != $request->Engineering_person && $request->Engineering_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Engineering Person';
            $history->previous = $lastCft->Engineering_person;
            $history->current = $request->Engineering_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Engineering_person) || $lastCft->Engineering_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_assessment != $request->Engineering_assessment && $request->Engineering_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Engineering Assessment';
            $history->previous = $lastCft->Engineering_assessment;
            $history->current = $request->Engineering_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Engineering_assessment) || $lastCft->Engineering_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_feedback != $request->Engineering_feedback && $request->Engineering_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Engineering Feedback';
            $history->previous = $lastCft->Engineering_feedback;
            $history->current = $request->Engineering_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Engineering_feedback) || $lastCft->Engineering_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_by != $request->Engineering_by && $request->Engineering_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Engineering Completed By';
            $history->previous = $lastCft->Engineering_by;
            $history->current = $request->Engineering_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Engineering_by) || $lastCft->Engineering_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_on != $request->Engineering_on && $request->Engineering_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Engineering Completed On';
            $history->previous = $lastCft->Engineering_on;
            $history->current = $request->Engineering_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Engineering_on) || $lastCft->Engineering_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_attachment != $request->Engineering_attachment && $request->Engineering_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Engineering Attachments';
            $history->previous = $lastCft->Engineering_attachment;
            $history->current = implode(',', $request->Engineering_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Engineering_attachment) || $lastCft->Engineering_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Human Resource ***************/
        if ($lastCft->Human_Resource_review != $request->Human_Resource_review && $request->Human_Resource_review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Human Resource Required';
            $history->previous = $lastCft->Human_Resource_review;
            $history->current = $request->Human_Resource_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Human_Resource_review) || $lastCft->Human_Resource_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_person != $request->Human_Resource_person && $request->Human_Resource_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Human Resource Person';
            $history->previous = $lastCft->Human_Resource_person;
            $history->current = $request->Human_Resource_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Human_Resource_person) || $lastCft->Human_Resource_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_assessment != $request->Human_Resource_assessment && $request->Human_Resource_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Impact Assessment(By Human Resource)';
            $history->previous = $lastCft->Human_Resource_assessment;
            $history->current = $request->Human_Resource_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Human_Resource_assessment) || $lastCft->Human_Resource_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_feedback != $request->Human_Resource_feedback && $request->Human_Resource_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Human Resource Feedback';
            $history->previous = $lastCft->Human_Resource_feedback;
            $history->current = $request->Human_Resource_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Human_Resource_feedback) || $lastCft->Human_Resource_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_by != $request->Human_Resource_by && $request->Human_Resource_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Human Resource Completed By';
            $history->previous = $lastCft->Human_Resource_by;
            $history->current = $request->Human_Resource_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Human_Resource_by) || $lastCft->Human_Resource_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_on != $request->Human_Resource_on && $request->Human_Resource_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Human Resource Completed On';
            $history->previous = $lastCft->Human_Resource_on;
            $history->current = $request->Human_Resource_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Human_Resource_on) || $lastCft->Human_Resource_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_attachment != $request->Human_Resource_attachment && $request->Human_Resource_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Human Resource Attachments';
            $history->previous = $lastCft->Human_Resource_attachment;
            $history->current = implode(',', $request->Human_Resource_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Human_Resource_attachment) || $lastCft->Human_Resource_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Microbiology ***************/
        if ($lastCft->Microbiology_Review != $request->Microbiology_Review && $request->Microbiology_Review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Microbiology Review Required';
            $history->previous = $lastCft->Microbiology_Review;
            $history->current = $request->Microbiology_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Microbiology_Review) || $lastCft->Microbiology_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_person != $request->Microbiology_person && $request->Microbiology_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Microbiology Person';
            $history->previous = $lastCft->Microbiology_person;
            $history->current = $request->Microbiology_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Microbiology_person) || $lastCft->Microbiology_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_assessment != $request->Microbiology_assessment && $request->Microbiology_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Impact Assessment (By Microbiology)';
            $history->previous = $lastCft->Microbiology_assessment;
            $history->current = $request->Microbiology_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Microbiology_assessment) || $lastCft->Microbiology_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_feedback != $request->Microbiology_feedback && $request->Microbiology_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Microbiology Feedback';
            $history->previous = $lastCft->Microbiology_feedback;
            $history->current = $request->Microbiology_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Microbiology_feedback) || $lastCft->Microbiology_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_by != $request->Microbiology_by && $request->Microbiology_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Microbiology Completed By';
            $history->previous = $lastCft->Microbiology_by;
            $history->current = $request->Microbiology_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Microbiology_by) || $lastCft->Microbiology_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_on != $request->Microbiology_on && $request->Microbiology_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Microbiology Completed On';
            $history->previous = Helpers::getdateFormat($lastCft->Microbiology_on);
            $history->current = Helpers::getdateFormat($request->Microbiology_on);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Microbiology_on) || $lastCft->Microbiology_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_attachment != $request->Microbiology_attachment && $request->Microbiology_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Microbiology Attachments';
            $history->previous = $lastCft->Microbiology_attachment;
            $history->current = implode(',', $request->Microbiology_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Microbiology_attachment) || $lastCft->Microbiology_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Regulatory Affair ***************/
        if ($lastCft->RegulatoryAffair_Review != $request->RegulatoryAffair_Review && $request->RegulatoryAffair_Review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Regulatory Affair Required';
            $history->previous = $lastCft->RegulatoryAffair_Review;
            $history->current = $request->RegulatoryAffair_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->RegulatoryAffair_Review) || $lastCft->RegulatoryAffair_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_person != $request->RegulatoryAffair_person && $request->RegulatoryAffair_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Regulatory Affair Person';
            $history->previous = $lastCft->RegulatoryAffair_person;
            $history->current = $request->RegulatoryAffair_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->RegulatoryAffair_person) || $lastCft->RegulatoryAffair_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_assessment != $request->RegulatoryAffair_assessment && $request->RegulatoryAffair_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Impat Assessment(Regulatory Affair)';
            $history->previous = $lastCft->RegulatoryAffair_assessment;
            $history->current = $request->RegulatoryAffair_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->RegulatoryAffair_assessment) || $lastCft->RegulatoryAffair_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_feedback != $request->RegulatoryAffair_feedback && $request->RegulatoryAffair_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Regulatory Affair Feedback';
            $history->previous = $lastCft->RegulatoryAffair_feedback;
            $history->current = $request->RegulatoryAffair_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->RegulatoryAffair_feedback) || $lastCft->RegulatoryAffair_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_by != $request->RegulatoryAffair_by && $request->RegulatoryAffair_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Regulatory Affair Completed By';
            $history->previous = $lastCft->RegulatoryAffair_by;
            $history->current = $request->RegulatoryAffair_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->RegulatoryAffair_by) || $lastCft->RegulatoryAffair_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_on != $request->RegulatoryAffair_on  && $request->RegulatoryAffair_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Regulatory Affair Completed On';
            $history->previous = $lastCft->RegulatoryAffair_on;
            $history->current = $request->RegulatoryAffair_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->RegulatoryAffair_on) || $lastCft->RegulatoryAffair_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_attachment != $request->RegulatoryAffair_attachment  && $request->RegulatoryAffair_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Regulatory Affair Attachments';
            $history->previous = $lastCft->RegulatoryAffair_attachment;
            $history->current = implode(',', $request->RegulatoryAffair_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->RegulatoryAffair_attachment) || $lastCft->RegulatoryAffair_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Corporate Quality Assurance ***************/
        if ($lastCft->CorporateQualityAssurance_Review != $request->CorporateQualityAssurance_Review && $request->CorporateQualityAssurance_Review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Required';
            $history->previous = $lastCft->CorporateQualityAssurance_Review;
            $history->current = $request->CorporateQualityAssurance_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->CorporateQualityAssurance_Review) || $lastCft->CorporateQualityAssurance_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_person != $request->CorporateQualityAssurance_person && $request->CorporateQualityAssurance_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Person';
            $history->previous = $lastCft->CorporateQualityAssurance_person;
            $history->current = $request->CorporateQualityAssurance_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->CorporateQualityAssurance_person) || $lastCft->CorporateQualityAssurance_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_assessment != $request->CorporateQualityAssurance_assessment && $request->CorporateQualityAssurance_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Impact Assessment(Corporate Quality Assurance)';
            $history->previous = $lastCft->CorporateQualityAssurance_assessment;
            $history->current = $request->CorporateQualityAssurance_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->CorporateQualityAssurance_assessment) || $lastCft->CorporateQualityAssurance_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_feedback != $request->CorporateQualityAssurance_feedback && $request->CorporateQualityAssurance_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Feedback';
            $history->previous = $lastCft->CorporateQualityAssurance_feedback;
            $history->current = $request->CorporateQualityAssurance_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->CorporateQualityAssurance_feedback) || $lastCft->CorporateQualityAssurance_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_by != $request->CorporateQualityAssurance_by && $request->CorporateQualityAssurance_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Completed By';
            $history->previous = $lastCft->CorporateQualityAssurance_by;
            $history->current = $request->CorporateQualityAssurance_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->CorporateQualityAssurance_by) || $lastCft->CorporateQualityAssurance_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_on != $request->CorporateQualityAssurance_on && $request->CorporateQualityAssurance_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Corporate Quality Assurance completed On';
            $history->previous = $lastCft->CorporateQualityAssurance_on;
            $history->current = $request->CorporateQualityAssurance_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->CorporateQualityAssurance_on) || $lastCft->CorporateQualityAssurance_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_attachment != $request->CorporateQualityAssurance_attachment && $request->CorporateQualityAssurance_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Attachments';
            $history->previous = $lastCft->CorporateQualityAssurance_attachment;
            $history->current = implode(',', $request->CorporateQualityAssurance_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->CorporateQualityAssurance_attachment) || $lastCft->CorporateQualityAssurance_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Safety ***************/
        if ($lastCft->Environment_Health_review != $request->Environment_Health_review && $request->Environment_Health_review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Safety Review Required';
            $history->previous = $lastCft->Environment_Health_review;
            $history->current = $request->Environment_Health_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Environment_Health_review) || $lastCft->Environment_Health_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Environment_Health_Safety_person != $request->Environment_Health_Safety_person && $request->Environment_Health_Safety_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Safety Person';
            $history->previous = $lastCft->Environment_Health_Safety_person;
            $history->current = $request->Environment_Health_Safety_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Environment_Health_Safety_person) || $lastCft->Environment_Health_Safety_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Health_Safety_assessment != $request->Health_Safety_assessment && $request->Health_Safety_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Safety Assessment';
            $history->previous = $lastCft->Health_Safety_assessment;
            $history->current = $request->Health_Safety_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Health_Safety_assessment) || $lastCft->Health_Safety_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Health_Safety_feedback != $request->Health_Safety_feedback && $request->Health_Safety_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Safety Feedback';
            $history->previous = $lastCft->Health_Safety_feedback;
            $history->current = $request->Health_Safety_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Health_Safety_feedback) || $lastCft->Health_Safety_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Environment_Health_Safety_by != $request->Environment_Health_Safety_by && $request->Environment_Health_Safety_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Safety Review By';
            $history->previous = $lastCft->Environment_Health_Safety_by;
            $history->current = $request->Environment_Health_Safety_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Environment_Health_Safety_by) || $lastCft->Environment_Health_Safety_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Environment_Health_Safety_on != $request->Environment_Health_Safety_on && $request->Environment_Health_Safety_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Safety Review On';
            $history->previous = $lastCft->Environment_Health_Safety_on;
            $history->current = $request->Environment_Health_Safety_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Environment_Health_Safety_on) || $lastCft->Environment_Health_Safety_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Environment_Health_Safety_attachment != $request->Environment_Health_Safety_attachment && $request->Environment_Health_Safety_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Safety Review On';
            $history->previous = $lastCft->Environment_Health_Safety_attachment;
            $history->current = implode(',', $request->Environment_Health_Safety_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Environment_Health_Safety_attachment) || $lastCft->Environment_Health_Safety_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Contract Giver ***************/
        if ($lastCft->ContractGiver_Review != $request->ContractGiver_Review && $request->ContractGiver_Review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Contract Giver Review Required';
            $history->previous = $lastCft->ContractGiver_Review;
            $history->current = $request->ContractGiver_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ContractGiver_Review) || $lastCft->ContractGiver_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ContractGiver_person != $request->ContractGiver_person && $request->ContractGiver_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Contract Giver Person';
            $history->previous = $lastCft->ContractGiver_person;
            $history->current = $request->ContractGiver_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ContractGiver_person) || $lastCft->ContractGiver_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ContractGiver_assessment != $request->ContractGiver_assessment && $request->ContractGiver_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Contract Giver Assessment';
            $history->previous = $lastCft->ContractGiver_assessment;
            $history->current = $request->ContractGiver_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ContractGiver_assessment) || $lastCft->ContractGiver_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ContractGiver_feedback != $request->ContractGiver_feedback && $request->ContractGiver_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Contract Giver Feedback';
            $history->previous = $lastCft->ContractGiver_feedback;
            $history->current = $request->ContractGiver_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ContractGiver_feedback) || $lastCft->ContractGiver_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ContractGiver_by != $request->ContractGiver_by && $request->ContractGiver_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Contract Giver Review By';
            $history->previous = $lastCft->ContractGiver_by;
            $history->current = $request->ContractGiver_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ContractGiver_by) || $lastCft->ContractGiver_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ContractGiver_on != $request->ContractGiver_on && $request->ContractGiver_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Contract Giver Review On';
            $history->previous = $lastCft->ContractGiver_on;
            $history->current = $request->ContractGiver_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ContractGiver_on) || $lastCft->ContractGiver_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastCft->ContractGiver_attachment != $request->ContractGiver_attachment && $request->ContractGiver_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Contract Giver Review On';
            $history->previous = $lastCft->ContractGiver_attachment;
            $history->current = implode(',', $request->ContractGiver_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->ContractGiver_attachment) || $lastCft->ContractGiver_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        /*************** Other 1 ***************/
        if ($lastCft->Other1_review != $request->Other1_review && $request->Other1_review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 1 Review Required';
            $history->previous = $lastCft->Other1_review;
            $history->current = $request->Other1_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other1_review) || $lastCft->Other1_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_person != $request->Other1_person && $request->Other1_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 1 Person';
            $history->previous = $lastCft->Other1_person;
            $history->current = $request->Other1_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other1_person) || $lastCft->Other1_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_Department_person != $request->Other1_Department_person && $request->Other1_Department_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 1 Department';
            $history->previous = Helpers::getFullDepartmentName($lastCft->Other1_Department_person);
            $history->current = Helpers::getFullDepartmentName($request->Other1_Department_person);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other1_Department_person) || $lastCft->Other1_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_assessment != $request->Other1_assessment && $request->Other1_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 1 Assessment';
            $history->previous = $lastCft->Other1_assessment;
            $history->current = $request->Other1_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other1_assessment) || $lastCft->Other1_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_feedback != $request->Other1_feedback && $request->Other1_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 1 Feedback';
            $history->previous = $lastCft->Other1_feedback;
            $history->current = $request->Other1_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other1_feedback) || $lastCft->Other1_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_by != $request->Other1_by && $request->Other1_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 1 Review By';
            $history->previous = $lastCft->Other1_by;
            $history->current = $request->Other1_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other1_by) || $lastCft->Other1_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_on != $request->Other1_on && $request->Other1_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 1 Review On';
            $history->previous = Helpers::getdateFormat($lastCft->Other1_on);
            $history->current = Helpers::getdateFormat($request->Other1_on);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other1_on) || $lastCft->Other1_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_attachment != $request->Other1_attachment && $request->Other1_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 1 Attachments';
            $history->previous = $lastCft->Other1_attachment;
            $history->current = implode(',', $request->Other1_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other1_attachment) || $lastCft->Other1_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        /*************** Other 2 ***************/
        if ($lastCft->Other2_review != $request->Other2_review && $request->Other2_review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 2 Review Required';
            $history->previous = $lastCft->Other2_review;
            $history->current = $request->Other2_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other2_review) || $lastCft->Other2_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_person != $request->Other2_person && $request->Other2_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 2 Person';
            $history->previous = $lastCft->Other2_person;
            $history->current = $request->Other2_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other2_person) || $lastCft->Other2_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_Department_person != $request->Other2_Department_person && $request->Other2_Department_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 2 Department';
            $history->previous = Helpers::getFullDepartmentName($lastCft->Other2_Department_person);
            $history->current = Helpers::getFullDepartmentName($request->Other2_Department_person);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other2_Department_person) || $lastCft->Other2_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_assessment != $request->Other2_assessment && $request->Other2_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 2 Assessment';
            $history->previous = $lastCft->Other2_assessment;
            $history->current = $request->Other2_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other2_assessment) || $lastCft->Other2_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_feedback != $request->Other2_feedback && $request->Other2_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 2 Feedback';
            $history->previous = $lastCft->Other2_feedback;
            $history->current = $request->Other2_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other2_feedback) || $lastCft->Other2_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_by != $request->Other2_by && $request->Other2_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 2 Review Completed By';
            $history->previous = $lastCft->Other2_by;
            $history->current = $request->Other2_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other2_by) || $lastCft->Other2_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_on != $request->Other2_on && $request->Other2_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 2 Completed On';
            $history->previous = Helpers::getdateFormat($lastCft->Other2_on);
            $history->current = Helpers::getsdateFormat($request->Other2_on);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other2_on) || $lastCft->Other2_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_attachment != $request->Other2_attachment && $request->Other2_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 2 Attachments';
            $history->previous = $lastCft->Other2_attachment;
            $history->current = implode(',', $request->Other2_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other2_attachment) || $lastCft->Other2_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Other 3 ***************/
        if ($lastCft->Other3_review != $request->Other3_review && $request->Other3_review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 3 Review Required';
            $history->previous = $lastCft->Other3_review;
            $history->current = $request->Other3_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other3_review) || $lastCft->Other3_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_person != $request->Other3_person && $request->Other3_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 3 Person';
            $history->previous = $lastCft->Other3_person;
            $history->current = $request->Other3_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other3_person) || $lastCft->Other3_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_Department_person != $request->Other3_Department_person && $request->Other3_Department_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 3 Department';
            $history->previous = Helpers::getFullDepartmentName($lastCft->Other3_Department_person);
            $history->current = Helpers::getFullDepartmentName($request->Other3_Department_person);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other3_Department_person) || $lastCft->Other3_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_assessment != $request->Other3_assessment && $request->Other3_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Other 3 Assessment';
            $history->previous = $lastCft->Other3_assessment;
            $history->current = $request->Other3_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other3_assessment) || $lastCft->Other3_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_feedback != $request->Other3_feedback && $request->Other3_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 3 Feedback';
            $history->previous = $lastCft->Other3_feedback;
            $history->current = $request->Other3_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other3_feedback) || $lastCft->Other3_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_by != $request->Other3_by && $request->Other3_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 3 Review Completed By';
            $history->previous = $lastCft->Other3_by;
            $history->current = $request->Other3_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other3_by) || $lastCft->Other3_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_on != $request->Other3_on && $request->Other3_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 3 Completed On';
            $history->previous = Helpers::getdateFormat($lastCft->Other3_on);
            $history->current = Helpers::getdateFormat($request->Other3_on);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other3_on) || $lastCft->Other3_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_attachment != $request->Other3_attachment && $request->Other3_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 3 Attachments';
            $history->previous = $lastCft->Other3_attachment;
            $history->current = implode(',', $request->Other3_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other3_attachment) || $lastCft->Other3_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Other 4 ***************/
        if ($lastCft->Other4_review != $request->Other4_review && $request->Other4_review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 4 Review Required';
            $history->previous = $lastCft->Other4_review;
            $history->current = $request->Other4_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other4_review) || $lastCft->Other4_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_person != $request->Other4_person && $request->Other4_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 4 Person';
            $history->previous = $lastCft->Other4_person;
            $history->current = $request->Other4_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other4_person) || $lastCft->Other4_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_Department_person != $request->Other4_Department_person && $request->Other4_Department_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 4 Department ';
            $history->previous = Helpers::getFullDepartmentName($lastCft->Other4_Department_person);
            $history->current = Helpers::getFullDepartmentName($request->Other4_Department_person);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other4_Department_person) || $lastCft->Other4_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_assessment != $request->Other4_assessment && $request->Other4_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Other 4 Assessment';
            $history->previous = $lastCft->Other4_assessment;
            $history->current = $request->Other4_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other4_assessment) || $lastCft->Other4_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_feedback != $request->Other4_feedback && $request->Other4_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 4 Feedback';
            $history->previous = $lastCft->Other4_feedback;
            $history->current = $request->Other4_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other4_feedback) || $lastCft->Other4_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_by != $request->Other4_by && $request->Other4_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 4 Review Completed By';
            $history->previous = $lastCft->Other4_by;
            $history->current = $request->Other4_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other4_by) || $lastCft->Other4_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_on != $request->Other4_on && $request->Other4_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 4 Completed On';
            $history->previous = Helpers::getdateFormat($lastCft->Other4_on);
            $history->current = Helpers::getdateFormat($request->Other4_on);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other4_on) || $lastCft->Other4_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_attachment != $request->Other4_attachment && $request->Other4_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 4 Attachments';
            $history->previous = $lastCft->Other4_attachment;
            $history->current = implode(',', $request->Other4_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other4_attachment) || $lastCft->Other4_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        /*************** Other 5 ***************/
        if ($lastCft->Other5_review != $request->Other5_review && $request->Other5_review != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 5 Review Required';
            $history->previous = $lastCft->Other5_review;
            $history->current = $request->Other5_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other5_review) || $lastCft->Other5_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_person != $request->Other5_person && $request->Other5_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 5 Person';
            $history->previous = $lastCft->Other5_person;
            $history->current = $request->Other5_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other5_person) || $lastCft->Other5_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_Department_person != $request->Other5_Department_person && $request->Other5_Department_person != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 5 Department';
            $history->previous = Helpers::getFullDepartmentName($lastCft->Other5_Department_person);
            $history->current = Helpers::getFullDepartmentName($request->Other5_Department_person);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other5_Department_person) || $lastCft->Other5_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_assessment != $request->Other5_assessment && $request->Other5_assessment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 5 Assessment';
            $history->previous = $lastCft->Other5_assessment;
            $history->current = $request->Other5_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other5_assessment) || $lastCft->Other5_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_feedback != $request->Other5_feedback && $request->Other5_feedback != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 5 Feedback';
            $history->previous = $lastCft->Other5_feedback;
            $history->current = $request->Other5_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other5_feedback) || $lastCft->Other5_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_by != $request->Other5_by && $request->Other5_by != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 5 Review Completed By';
            $history->previous = $lastCft->Other5_by;
            $history->current = $request->Other5_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other5_by) || $lastCft->Other5_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_on != $request->Other5_on && $request->Other5_on != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 5 Completed On';
            $history->previous = Helpers::getdateFormat($lastCft->Other5_on);
            $history->current = Helpers::getdateFormat($request->Other5_on);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other5_on) || $lastCft->Other5_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_attachment != $request->Other5_attachment && $request->Other5_attachment != null) {
            $history = new MarketComplaintAuditTrial;
            $history->market_id = $id;
            $history->activity_type = 'Others 5 Attachments';
            $history->previous = $lastCft->Other5_attachment;
            $history->current = implode(',', $request->Other5_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastmarketComplaint->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastmarketComplaint->status;
            if (is_null($lastCft->Other5_attachment) || $lastCft->Other5_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


//----------------- logic for showing grid data in audit trail -----------------------//

$data1 = MarketComplaintGrids::where('mc_id', $id)->where('identifer', "ProductDetails")->first();

$data1->mc_id = $marketComplaint->id;
$data1->identifer = "ProductDetails";

// Define the mapping of database fields to the descriptive field names
$fieldNames = [
    'info_product_name' => 'Product Name',
    'info_batch_no' => 'Batch No',
    'info_mfg_date' => 'Mfg Date',
    'info_expiry_date' => 'Expiry Date',
    'info_batch_size' => 'Batch Size',
    'info_pack_size' => 'Pack Size',
    'info_dispatch_quantity' => 'Dispatch Quantity',
    'info_remarks' => 'Remarks',
];

if (!empty($request->productsgi) && is_array($request->productsgi)) {
    foreach ($request->productsgi as $index => $product) {
        // Safely unserialize and use fallback to empty array if null
        $previousDetails = [
            'info_product_name' => $data1->info_product_name[$index] ?? null,
            'info_batch_no' => $data1->info_batch_no[$index] ?? null,
            'info_mfg_date' => $data1->info_mfg_date[$index] ?? null,
            'info_expiry_date' => $data1->info_expiry_date[$index] ?? null,
            'info_batch_size' => $data1->info_batch_size[$index] ?? null,
            'info_pack_size' => $data1->info_pack_size[$index] ?? null,
            'info_dispatch_quantity' => $data1->info_dispatch_quantity[$index] ?? null,
            'info_remarks' => $data1->info_remarks[$index] ?? null
        ];


        // Current fields values
        $fields = [
            'info_product_name' => $product['info_product_name'],
            'info_batch_no' => $product['info_batch_no'],
            'info_mfg_date' => Helpers::getdateFormat($product['info_mfg_date']),
            'info_expiry_date' => Helpers::getdateFormat($product['info_expiry_date']),
            'info_batch_size' => $product['info_batch_size'],
            'info_pack_size' => $product['info_pack_size'],
            'info_dispatch_quantity' => $product['info_dispatch_quantity'],
            'info_remarks' => $product['info_remarks'],
        ];

        foreach ($fields as $key => $currentValue) {
            $previousValue = $previousDetails[$key];

            // Log changes if the current value is different from the previous one
            if (($previousValue != $currentValue || !empty($request->material_comment[$index])) && !empty($currentValue)) {
                // Check if an audit trail entry for this specific row and field already exists
                $existingAudit = MarketComplaintAuditTrial::where('mc_id', $id)
                    ->where('activity_type', $fieldNames[$key] . ' (' . ($index + 1) . ')')
                    ->where('previous', $previousValue)
                    ->where('current', $currentValue)
                    ->exists();

                // Only create a new audit trail entry if no existing entry matches
                if (!$existingAudit) {
                    $history = new MarketComplaintAuditTrial();
                    $history->mc_id = $id;
                    // Set activity type to use the field name from the mapping
                    $history->activity_type = $fieldNames[$key] . ' (' . ($index + 1) . ')';
                    $history->previous = $previousValue; // Previous value
                    $history->current = $currentValue; // New value
                    $history->comment = $request->material_comment[$index] ?? '';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $data1->status;
                    $history->change_to = "Not Applicable";
                    $history->change_from = $data1->status;
                    $history->action_name = "Update";
                    $history->save();
                }
            }
        }
    }
}


        // -------------------------end audit show conditon end code ----------------------------------


        $marketComplaint->update();
        // dd($marketComplaint);
        // {{-- --produts grid gi  --}}
        // {{ grid update }}
        // For "Product Details"
        $griddata = $marketComplaint->id;

        // $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Product Details'])->firstOrNew();
        // $marketrproducts->mc_id = $griddata;
        // $marketrproducts->identifer = 'ProductDetails';
        // $marketrproducts->data = $request->serial_number_gi;
        // $marketrproducts->update();

        // // Save the new auditor data
        // $product = MarketComplaintGrids::firstOrNew(['mc_id' => $griddata, 'identifier' => 'ProductDetails']);
        // $product->auditor_id = $griddata;
        // $product->identifier = 'ProductDetails';
        // $product->data = $request->serial_number_gi;
        // $product->save();


        $griddata = $marketComplaint->id;

        if (!empty($request->serial_number_gi)) {
            // Fetch existing auditor data
            $existingAuditorShow = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'ProductDetails'])->first();
            $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

            $product = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'ProductDetails'])->firstOrNew();
            $product->mc_id = $griddata;
            $product->identifer = 'ProductDetails';
            $product->data = $request->serial_number_gi;
            //  dd( $product->data);

            $product->update();
            //dd($product);
            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                    'info_product_name' => 'Product Name',
                    'info_batch_no' => 'Batch No.',
                    'info_mfg_date' => 'Mfg. Date',
                    'info_expiry_date' => 'Exp. Date',
                    'info_batch_size' => 'Batch Size',
                    'info_pack_size' => 'Pack Size',
                    'info_dispatch_quantity' => 'Dispatch Quantity',
                    'info_remarks' => 'Remarks',
                ];

            // Track audit trail changes
            if (is_array($request->serial_number_gi)) {
                foreach ($request->serial_number_gi as $index => $newAuditor) {
                    $previousAuditor = $existingAuditorData[$index] ?? [];

                    // Track changes for each field
                    $fieldsToTrack = ['info_product_name', 'info_batch_no', '_info_mfg_date', 'info_mfg_date', 'info_expiry_date', 'info_batch_size', 'info_dispatch_quantity', 'info_remarks'];
                    foreach ($fieldsToTrack as $field) {
                        $oldValue = $previousAuditor[$field] ?? 'Null';
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's a change or the data is new
                        if ($oldValue !== $newValue) {
                            // Check if this specific change has already been logged in the audit trail
                            $existingAuditTrail = MarketComplaintAuditTrial::where([
                                ['market_id', '=', $marketComplaint->id],
                                ['activity_type', '=', $fieldNames[$field] . ' ( ' . ($index + 1) . ')'],
                                ['previous', '=', $oldValue],
                                ['current', '=', $newValue]
                            ])->first();

                            // Determine if the data is new or updated
                            $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

                            // If no existing audit trail record, log the change
                            if (!$existingAuditTrail) {
                                $auditTrail = new MarketComplaintAuditTrial;
                                $auditTrail->market_id = $marketComplaint->id;
                                $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                                $auditTrail->previous = $oldValue;
                                $auditTrail->current = $newValue;
                                $auditTrail->comment = "";
                                $auditTrail->user_id = Auth::user()->id;
                                $auditTrail->user_name = Auth::user()->name;
                                $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $auditTrail->origin_state = $marketComplaint->status;
                                $auditTrail->change_to = "Not Applicable";
                                $auditTrail->change_from = $marketComplaint->status;
                                $auditTrail->action_name = $actionName; // Set action to New or Update
                                $auditTrail->save();
                            }
                        }
                    }
                }
            }
        }
        //Traceability
        // $griddata = $marketComplaint->id;

        //$marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Traceability'])->firstOrNew();
        //$marketrproducts->mc_id = $griddata;
        //$marketrproducts->identifer = 'Traceability';
        //$marketrproducts->data = $request->trace_ability;
        //// dd($marketrproducts);
        //$marketrproducts->update();

        $griddata = $marketComplaint->id;

        if (!empty($request->serial_number_gi)) {
            // Fetch existing auditor data
            $existingAuditorShow = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Traceability'])->first();
            $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

            $product = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Traceability'])->firstOrNew();
            $product->mc_id = $griddata;
            $product->identifer = 'Traceability';
            $product->data = $request->trace_ability;
            //  dd( $product->data);

            $product->update();
            //dd($product);
            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                    'product_name_tr' => 'Product Name',
                    'batch_no_tr' => 'Batch No.',
                    'manufacturing_location_tr' => 'Manufacturing Location',
                    'remarks_tr' => 'Remarks',
                ];

            // Track audit trail changes
            if (is_array($request->trace_ability)) {
                foreach ($request->trace_ability as $index => $newAuditor) {
                    $previousAuditor = $existingAuditorData[$index] ?? [];

                    // Track changes for each field
                    $fieldsToTrack = ['product_name_tr', 'info_batch_no', 'batch_no_tr', 'manufacturing_location_tr', 'remarks_tr'];
                    foreach ($fieldsToTrack as $field) {
                        $oldValue = $previousAuditor[$field] ?? 'Null';
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's a change or the data is new
                        if ($oldValue !== $newValue) {
                            // Check if this specific change has already been logged in the audit trail
                            $existingAuditTrail = MarketComplaintAuditTrial::where([
                                ['market_id', '=', $marketComplaint->id],
                                ['activity_type', '=', $fieldNames[$field] . ' ( ' . ($index + 1) . ')'],
                                ['previous', '=', $oldValue],
                                ['current', '=', $newValue]
                            ])->first();

                            // Determine if the data is new or updated
                            $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

                            // If no existing audit trail record, log the change
                            if (!$existingAuditTrail) {
                                $auditTrail = new MarketComplaintAuditTrial;
                                $auditTrail->market_id = $marketComplaint->id;
                                $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                                $auditTrail->previous = $oldValue;
                                $auditTrail->current = $newValue;
                                $auditTrail->comment = "";
                                $auditTrail->user_id = Auth::user()->id;
                                $auditTrail->user_name = Auth::user()->name;
                                $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $auditTrail->origin_state = $marketComplaint->status;
                                $auditTrail->change_to = "Not Applicable";
                                $auditTrail->change_from = $marketComplaint->status;
                                $auditTrail->action_name = $actionName; // Set action to New or Update
                                $auditTrail->save();
                            }
                        }
                    }
                }
            }
        }



        // {{-- Investing_team --}}
        //$marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Investing_team'])->firstOrNew();
        //$marketrproducts->mc_id = $griddata;
        //$marketrproducts->identifer = 'Investing_team';
        //$marketrproducts->data = $request->Investing_team;
        //$marketrproducts->update();

        $griddata = $marketComplaint->id;

        if (!empty($request->Investing_team)) {
            // Fetch existing auditor data
            $existingAuditorShow = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Investing_team'])->first();
            $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

            $product = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Investing_team'])->firstOrNew();
            $product->mc_id = $griddata;
            $product->identifer = 'Investing_team';
            $product->data = $request->Investing_team;
            //  dd( $product->data);

            $product->update();
            //dd($product);
            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                    'name_inv_tem' => 'Name',
                    'department_inv_tem' => 'Department',
                    'remarks_inv_tem' => 'Remarks',
                ];

            // Track audit trail changes
            if (is_array($request->Investing_team)) {
                foreach ($request->Investing_team as $index => $newAuditor) {
                    $previousAuditor = $existingAuditorData[$index] ?? [];

                    // Track changes for each field
                    $fieldsToTrack = ['name_inv_tem', 'department_inv_tem', 'remarks_inv_tem'];
                    foreach ($fieldsToTrack as $field) {
                        $oldValue = $previousAuditor[$field] ?? 'Null';
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's a change or the data is new
                        if ($oldValue !== $newValue) {
                            // Check if this specific change has already been logged in the audit trail
                            $existingAuditTrail = MarketComplaintAuditTrial::where([
                                ['market_id', '=', $marketComplaint->id],
                                ['activity_type', '=', $fieldNames[$field] . ' ( ' . ($index + 1) . ')'],
                                ['previous', '=', $oldValue],
                                ['current', '=', $newValue]
                            ])->first();

                            // Determine if the data is new or updated
                            $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

                            // If no existing audit trail record, log the change
                            if (!$existingAuditTrail) {
                                $auditTrail = new MarketComplaintAuditTrial;
                                $auditTrail->market_id = $marketComplaint->id;
                                $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                                $auditTrail->previous = $oldValue;
                                $auditTrail->current = $newValue;
                                $auditTrail->comment = "";
                                $auditTrail->user_id = Auth::user()->id;
                                $auditTrail->user_name = Auth::user()->name;
                                $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $auditTrail->origin_state = $marketComplaint->status;
                                $auditTrail->change_to = "Not Applicable";
                                $auditTrail->change_from = $marketComplaint->status;
                                $auditTrail->action_name = $actionName; // Set action to New or Update
                                $auditTrail->save();
                            }
                        }
                    }
                }
            }
        }


        // {{-- Brain stroming Session --}}

        //$brain = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'brain_stroming_details'])->firstOrNew();
        //$brain->mc_id = $griddata;
        //$brain->identifer = 'brain_stroming_details';
        //$brain->data = $request->brain_stroming_details;
        //$brain->update();

        $griddata = $marketComplaint->id;

        if (!empty($request->brain_stroming_details)) {
            // Fetch existing auditor data
            $existingAuditorShow = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'brain_stroming_details'])->first();
            $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

            $product = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'brain_stroming_details'])->firstOrNew();
            $product->mc_id = $griddata;
            $product->identifer = 'brain_stroming_details';
            $product->data = $request->brain_stroming_details;
            //  dd( $product->data);

            $product->update();
            //dd($product);
            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                    'possibility_bssd' => 'Possibility',
                    'factscontrols_bssd' => 'Facts/Controls',
                    'probable_cause_bssd' => 'Probable Cause',
                    'remarks_bssd' => 'Remarks',
                ];

            // Track audit trail changes
            if (is_array($request->brain_stroming_details)) {
                foreach ($request->brain_stroming_details as $index => $newAuditor) {
                    $previousAuditor = $existingAuditorData[$index] ?? [];

                    // Track changes for each field
                    $fieldsToTrack = ['possibility_bssd', 'factscontrols_bssd', 'probable_cause_bssd', 'remarks_bssd'];
                    foreach ($fieldsToTrack as $field) {
                        $oldValue = $previousAuditor[$field] ?? 'Null';
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's a change or the data is new
                        if ($oldValue !== $newValue) {
                            // Check if this specific change has already been logged in the audit trail
                            $existingAuditTrail = MarketComplaintAuditTrial::where([
                                ['market_id', '=', $marketComplaint->id],
                                ['activity_type', '=', $fieldNames[$field] . ' ( ' . ($index + 1) . ')'],
                                ['previous', '=', $oldValue],
                                ['current', '=', $newValue]
                            ])->first();

                            // Determine if the data is new or updated
                            $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

                            // If no existing audit trail record, log the change
                            if (!$existingAuditTrail) {
                                $auditTrail = new MarketComplaintAuditTrial;
                                $auditTrail->market_id = $marketComplaint->id;
                                $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                                $auditTrail->previous = $oldValue;
                                $auditTrail->current = $newValue;
                                $auditTrail->comment = "";
                                $auditTrail->user_id = Auth::user()->id;
                                $auditTrail->user_name = Auth::user()->name;
                                $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $auditTrail->origin_state = $marketComplaint->status;
                                $auditTrail->change_to = "Not Applicable";
                                $auditTrail->change_from = $marketComplaint->status;
                                $auditTrail->action_name = $actionName; // Set action to New or Update
                                $auditTrail->save();
                            }
                        }
                    }
                }
            }
        }

        // {{ Team Member
        // {{ Team Members }}

        $griddata = $marketComplaint->id;

        if (!empty($request->Team_Members)) {
            // Fetch existing auditor data
            $existingAuditorShow = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Team_Members'])->first();
            $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

            $product = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Team_Members'])->firstOrNew();
            $product->mc_id = $griddata;
            $product->identifer = 'Team_Members';
            $product->data = $request->Team_Members;
            //  dd( $product->data);

            $product->update();
            //dd($product);
            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                    'names_tm' => 'Names',
                    'designation' => 'Designation',
                    'department_tm' => 'Department',
                    'sign_tm' => 'Sign',
                    'date_tm' => 'Date',
                ];

            // Track audit trail changes
            if (is_array($request->Team_Members)) {
                foreach ($request->Team_Members as $index => $newAuditor) {
                    $previousAuditor = $existingAuditorData[$index] ?? [];

                    // Track changes for each field
                    $fieldsToTrack = ['names_tm', 'designation', 'department_tm', 'sign_tm', 'date_tm'];
                    foreach ($fieldsToTrack as $field) {
                        $oldValue = $previousAuditor[$field] ?? 'Null';
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's a change or the data is new
                        if ($oldValue !== $newValue) {
                            // Check if this specific change has already been logged in the audit trail
                            $existingAuditTrail = MarketComplaintAuditTrial::where([
                                ['market_id', '=', $marketComplaint->id],
                                ['activity_type', '=', $fieldNames[$field] . ' ( ' . ($index + 1) . ')'],
                                ['previous', '=', $oldValue],
                                ['current', '=', $newValue]
                            ])->first();

                            // Determine if the data is new or updated
                            $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

                            // If no existing audit trail record, log the change
                            if (!$existingAuditTrail) {
                                $auditTrail = new MarketComplaintAuditTrial;
                                $auditTrail->market_id = $marketComplaint->id;
                                $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                                $auditTrail->previous = $oldValue;
                                $auditTrail->current = $newValue;
                                $auditTrail->comment = "";
                                $auditTrail->user_id = Auth::user()->id;
                                $auditTrail->user_name = Auth::user()->name;
                                $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $auditTrail->origin_state = $marketComplaint->status;
                                $auditTrail->change_to = "Not Applicable";
                                $auditTrail->change_from = $marketComplaint->status;
                                $auditTrail->action_name = $actionName; // Set action to New or Update
                                $auditTrail->save();
                            }
                        }
                    }
                }
            }
        }


        //// {{ Report_Approval }}
        //$marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Report_Approval'])->firstOrNew();
        //$marketrproducts->mc_id = $griddata;
        //$marketrproducts->identifer = 'Report_Approval';
        //$marketrproducts->data = $request->Report_Approval;
        //$marketrproducts->update();

        $griddata = $marketComplaint->id;

        if (!empty($request->Report_Approval)) {
            // Fetch existing auditor data
            $existingAuditorShow = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Report_Approval'])->first();
            $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

            $product = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Report_Approval'])->firstOrNew();
            $product->mc_id = $griddata;
            $product->identifer = 'Report_Approval';
            $product->data = $request->Report_Approval;
            //  dd( $product->data);

            $product->update();
            //dd($product);
            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                    'names_rrv' => 'Names',
                    'designation' => 'Designation',
                    'department_rrv' => 'Department',
                    'sign_rrv' => 'Sign',
                    'date_rrv' => 'Date'
                ];

            // Track audit trail changes
            if (is_array($request->Report_Approval)) {
                foreach ($request->Report_Approval as $index => $newAuditor) {
                    $previousAuditor = $existingAuditorData[$index] ?? [];

                    // Track changes for each field
                    $fieldsToTrack = ['names_rrv', 'designation', 'department_rrv', 'sign_rrv', 'date_rrv'];
                    foreach ($fieldsToTrack as $field) {
                        $oldValue = $previousAuditor[$field] ?? 'Null';
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's a change or the data is new
                        if ($oldValue !== $newValue) {
                            // Check if this specific change has already been logged in the audit trail
                            $existingAuditTrail = MarketComplaintAuditTrial::where([
                                ['market_id', '=', $marketComplaint->id],
                                ['activity_type', '=', $fieldNames[$field] . ' ( ' . ($index + 1) . ')'],
                                ['previous', '=', $oldValue],
                                ['current', '=', $newValue]
                            ])->first();

                            // Determine if the data is new or updated
                            $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

                            // If no existing audit trail record, log the change
                            if (!$existingAuditTrail) {
                                $auditTrail = new MarketComplaintAuditTrial;
                                $auditTrail->market_id = $marketComplaint->id;
                                $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                                $auditTrail->previous = $oldValue;
                                $auditTrail->current = $newValue;
                                $auditTrail->comment = "";
                                $auditTrail->user_id = Auth::user()->id;
                                $auditTrail->user_name = Auth::user()->name;
                                $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $auditTrail->origin_state = $marketComplaint->status;
                                $auditTrail->change_to = "Not Applicable";
                                $auditTrail->change_from = $marketComplaint->status;
                                $auditTrail->action_name = $actionName; // Set action to New or Update
                                $auditTrail->save();
                            }
                        }
                    }
                }
            }
        }


        // {{ Product_MaterialDetails }}
        //$marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Product_MaterialDetails'])->firstOrNew();
        //$marketrproducts->mc_id = $griddata;
        //$marketrproducts->identifer = 'Product_MaterialDetails';
        //$marketrproducts->data = $request->Product_MaterialDetails;
        //// dd($marketrproducts->data);
        //$marketrproducts->update();

        $griddata = $marketComplaint->id;

        if (!empty($request->Product_MaterialDetails)) {
            // Fetch existing auditor data
            $existingAuditorShow = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Product_MaterialDetails'])->first();
            $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

            $product = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Product_MaterialDetails'])->firstOrNew();
            $product->mc_id = $griddata;
            $product->identifer = 'Product_MaterialDetails';
            $product->data = $request->Product_MaterialDetails;
            //  dd( $product->data);

            $product->update();
            //dd($product);
            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                    'product_name_ca' => 'Product Name',
                    'batch_no_pmd_ca' => 'Batch No.',
                    'mfg_date_pmd_ca' => 'Mfg. Date',
                    'expiry_date_pmd_ca' => 'Exp. Date',
                    'batch_size_pmd_ca' => 'Batch Size',
                    'pack_profile_pmd_ca' => 'Pack Profile',
                    'released_quantity_pmd_ca' => 'Released Quantity',
                    'remarks_ca' => 'Remarks'
                ];

            // Track audit trail changes
            if (is_array($request->Product_MaterialDetails)) {
                foreach ($request->Product_MaterialDetails as $index => $newAuditor) {
                    $previousAuditor = $existingAuditorData[$index] ?? [];

                    // Track changes for each field
                    $fieldsToTrack = ['product_name_ca', 'batch_no_pmd_ca', 'mfg_date_pmd_ca', 'expiry_date_pmd_ca', 'batch_size_pmd_ca', 'pack_profile_pmd_ca', 'released_quantity_pmd_ca', 'remarks_ca'];
                    foreach ($fieldsToTrack as $field) {
                        $oldValue = $previousAuditor[$field] ?? 'Null';
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's a change or the data is new
                        if ($oldValue !== $newValue) {
                            // Check if this specific change has already been logged in the audit trail
                            $existingAuditTrail = MarketComplaintAuditTrial::where([
                                ['market_id', '=', $marketComplaint->id],
                                ['activity_type', '=', $fieldNames[$field] . ' ( ' . ($index + 1) . ')'],
                                ['previous', '=', $oldValue],
                                ['current', '=', $newValue]
                            ])->first();

                            // Determine if the data is new or updated
                            $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

                            // If no existing audit trail record, log the change
                            if (!$existingAuditTrail) {
                                $auditTrail = new MarketComplaintAuditTrial;
                                $auditTrail->market_id = $marketComplaint->id;
                                $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                                $auditTrail->previous = $oldValue;
                                $auditTrail->current = $newValue;
                                $auditTrail->comment = "";
                                $auditTrail->user_id = Auth::user()->id;
                                $auditTrail->user_name = Auth::user()->name;
                                $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $auditTrail->origin_state = $marketComplaint->status;
                                $auditTrail->change_to = "Not Applicable";
                                $auditTrail->change_from = $marketComplaint->status;
                                $auditTrail->action_name = $actionName; // Set action to New or Update
                                $auditTrail->save();
                            }
                        }
                    }
                }
            }
        }



        // {{  g}}
        $griddata = $marketComplaint->id;

        // Create MarketComplaintGrids record for Proposal to accomplish investigation
        $investigationData = [
            'Complaint sample Required' => ['csr1' => $request->csr1, 'csr2' => $request->csr2, 'csr3' => $request->csr1_yesno],
            'Additional info. From Complainant' => ['afc1' => $request->afc1, 'afc2' => $request->afc2, 'afc3' => $request->afc1_yesno],
            'Analysis of complaint Sample' => ['acs1' => $request->acs1, 'acs2' => $request->acs2, 'acs3' => $request->acs1_yesno],
            'QRM Approach' => ['qrm1' => $request->qrm1, 'qrm2' => $request->qrm2, 'qrm3' => $request->qrm1_yesno],
            'Others' => ['oth1' => $request->oth1, 'oth2' => $request->oth2, 'oth3' => $request->oth1_yesno]
        ];

        $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifer' => 'Proposal_to_accomplish_investigation'])->firstOrNew();
        $marketrproducts->mc_id = $griddata;
        $marketrproducts->identifer = 'Proposal_to_accomplish_investigation';
        $marketrproducts->data = json_encode($investigationData); // Encode data to JSON
        $marketrproducts->update();

        toastr()->success('Record is updated Successfully');
        return redirect()->back();
        //  return redirect()->route('marketcomplaint.marketcomplaintupdate' ,['id'=> $marketComplaint->id])->with('success', 'Market Complaint updated successfully.');

    }


    public function marketComplaintStateChange(Request $request, $id)
    { {
            try {
                if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                    $marketstat = MarketComplaint::find($id);
                    $marketComplaint = MarketComplaint::find($id);
                    $Cft = marketComplaintCft::withoutTrashed()->where('mc_id', $id)->first();
                    $updateCFT = MarketComplaintCft::where('mc_id', $id)->latest()->first();
                    $lastDocument = MarketComplaint::find($id);
                    $cftDetails = MarketComplaintcftResponce::withoutTrashed()->where(['status' => 'In-progress', 'mc_id' => $id])->distinct('cft_user_id')->count();

                    if ($marketstat->stage == 1) {

                        $marketstat->stage = "2";
                        $marketstat->status = "QA/CQA Head Review";
                        $marketstat->submitted_by = Auth::user()->name;
                        $marketstat->submitted_on = Carbon::now()->format('d-M-Y');
                        $marketstat->submitted_comment = $request->comment;

                        $history = new MarketComplaintAuditTrial();
                        $history->market_id = $id;
                        $history->activity_type = 'Submitted By, Submitted On';
                        if (is_null($lastDocument->submitted_by) || $lastDocument->submitted_on == '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->submitted_by . ' ,' . $lastDocument->submitted_on;
                        }
                        $history->action = 'Submitted';
                        $history->current = $marketstat->submitted_by . ',' . $marketstat->submitted_on;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "QA/CQA Head Review";
                        $history->change_from = $lastDocument->status;
                        $history->stage = 'Plan Proposed';
                        if (is_null($lastDocument->submitted_by) || $lastDocument->submitted_on == '') {
                            $history->action_name = 'New';
                        } else {
                            $history->action_name = 'Update';
                        }
                        $history->save();

                        // $list = Helpers::getInitiatorUserList($marketstat->division_id); // Notify CFT Person
                        // foreach ($list as $u) {
                        //     // if($u->q_m_s_divisions_id == $marketstat->division_id){
                        //     $email = Helpers::getUserEmail($u->user_id);
                        //     // dd($email);
                        //     if ($email !== null) {
                        //         Mail::send(
                        //             'mail.view-mail',
                        //             ['data' => $marketstat, 'site' => "Ext", 'history' => "Submit", 'process' => 'Market Complaint', 'comment' => $request->comments, 'user' => Auth::user()->name],
                        //             function ($message) use ($email, $marketstat) {
                        //                 $message->to($email)
                        //                     ->subject("Agio Notification: Market Complaint, Record #" . str_pad($marketstat->record, 4, '0', STR_PAD_LEFT) . " - Activity: Submit");
                        //             }
                        //         );
                        //     }
                        //     // }
                        // }

                        $marketstat->update();
                        toastr()->success('Document Set');
                        return back();
                    }

                    if ($marketstat->stage == 2) {

                        if (!$marketstat->qa_head_comment) {
                            Session::flash('swal', [
                                'title' => 'Mandatory Fields Required!',
                                'message' => 'QA/CQA Head Comment is yet to be filled!',
                                'type' => 'warning',
                            ]);

                            return redirect()->back();
                        } else {
                            Session::flash('swal', [
                                'type' => 'success',
                                'title' => 'Success',
                                'message' => 'Investigation CAPA And Root Cause Analysis'
                            ]);
                        }


                        $marketstat->stage = "3";
                        $marketstat->status = "Investigation CAPA And Root Cause Analysis";

                        // Code for the CFT required
                        $stage = new MarketComplaintcftResponce();
                        $stage->mc_id = $id;
                        $stage->mc_id = Auth::user()->id;
                        $stage->status = "CFT Review";
                        // $stage->cft_stage = ;
                        $stage->comment = $request->comment;
                        $stage->is_required = 1;
                        $stage->save();

                        $marketstat->complete_review_by = Auth::user()->name;
                        $marketstat->complete_review_on = Carbon::now()->format('d-M-Y');
                        $marketstat->complete_review_Comments = $request->comment;
                        $history = new MarketComplaintAuditTrial();
                        $history->market_id = $id;
                        $history->activity_type = 'Complete Review By, Complete Review On';
                        if (is_null($lastDocument->complete_review_by) || $lastDocument->complete_review_on == '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->complete_review_by . ' ,' . $lastDocument->complete_review_on;
                        }
                        // $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->action = 'Complete Review';
                        $history->current = $marketstat->complete_review_by;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->change_to =   "Investigation CAPA And Root Cause Analysis";
                        $history->change_from = $lastDocument->status;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->stage = 'Completed';
                        if (is_null($lastDocument->complete_review_by) || $lastDocument->complete_review_on == '') {
                            $history->action_name = 'New';
                        } else {
                            $history->action_name = 'Update';
                        }
                        $history->save();

                        // $list = Helpers::getInitiatorUserList($marketstat->division_id); // Notify CFT Person
                        // foreach ($list as $u) {
                        //     // if($u->q_m_s_divisions_id == $marketstat->division_id){
                        //     $email = Helpers::getUserEmail($u->user_id);
                        //     if ($email !== null) {
                        //         Mail::send(
                        //             'mail.view-mail',
                        //             ['data' => $marketstat, 'site' => "Ext", 'history' => "Submit", 'process' => 'Market Complaint', 'comment' => $request->comments, 'user' => Auth::user()->name],
                        //             function ($message) use ($email, $marketstat) {
                        //                 $message->to($email)
                        //                     ->subject("Agio Notification: Market Complaint, Record #" . str_pad($marketstat->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                        //             }
                        //         );
                        //     }
                        //     // }
                        // }

                        $marketstat->update();
                        toastr()->success('Document Sent');
                        return back();
                    }


                    if ($marketstat->stage == 3) {

                        if (!$marketstat->review_of_batch_manufacturing_record_BMR_gi) {
                            Session::flash('swal', [
                                'title' => 'Mandatory Fields Required!',
                                'message' => 'Preliminary Investigation Tab is yet to be filled!',
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
                        if (!$Cft->Production_Table_Review || !$Cft->Production_Injection_Review || !$Cft->ProductionLiquid_Review || !$Cft->Store_Review || !$Cft->ResearchDevelopment_Review || !$Cft->Microbiology_Review || !$Cft->RegulatoryAffair_Review || !$Cft->CorporateQualityAssurance_Review || !$Cft->ContractGiver_Review || !$Cft->Quality_review || !$Cft->Quality_Assurance_Review || !$Cft->Engineering_review || !$Cft->Environment_Health_review || !$Cft->Human_Resource_review) {
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

                        $marketstat->stage = "4";
                        $marketstat->status = "CFT Review";

                        // Code for the CFT required
                        $stage = new MarketComplaintcftResponce();
                        $stage->mc_id = $id;
                        $stage->cft_user_id = Auth::user()->id;
                        $stage->status = "CFT Required";
                        // $stage->cft_stage = ;
                        $stage->comment = $request->comment;
                        $stage->is_required = 1;
                        $stage->save();

                        $marketstat->send_cft_by = Auth::user()->name;
                        $marketstat->send_cft_on = Carbon::now()->format('d-M-Y');
                        $marketstat->send_cft_comment = $request->comment;
                        $history = new MarketComplaintAuditTrial();
                        $history->market_id = $id;
                        $history->activity_type = 'Send CFT By , Send CFT On';
                        if (is_null($lastDocument->send_cft_by) || $lastDocument->send_cft_on == '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->send_cft_by . ' , ' . $lastDocument->send_cft_on;
                        }
                        $history->action = 'QA/CQA Initial Review Complete';
                        $history->current = $marketstat->send_cft_by . ' , ' . $marketstat->send_cft_on;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->change_to =   "CFT Review";
                        $history->change_from = $lastDocument->status;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->stage = 'Completed';
                        if (is_null($lastDocument->send_cft_by) || $lastDocument->send_cft_on == '') {
                            $history->action_name = 'New';
                        } else {
                            $history->action_name = 'Update';
                        }
                        $history->save();

                        // $list = Helpers::getInitiatorUserList($marketstat->division_id); // Notify CFT Person
                        // foreach ($list as $u) {
                        //     // if($u->q_m_s_divisions_id == $marketstat->division_id){
                        //     $email = Helpers::getUserEmail($u->user_id);
                        //     if ($email !== null) {
                        //         Mail::send(
                        //             'mail.view-mail',
                        //             ['data' => $marketstat, 'site' => "Ext", 'history' => "Submit", 'process' => 'Market Complaint', 'comment' => $request->comments, 'user' => Auth::user()->name],
                        //             function ($message) use ($email, $marketstat) {
                        //                 $message->to($email)
                        //                     ->subject("Agio Notification: Market Complaint, Record #" . str_pad($marketstat->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                        //             }
                        //         );
                        //     }
                        //     // }
                        // }

                        $marketstat->update();
                        toastr()->success('Document Sent');
                        return back();
                    }
                    if ($marketstat->stage == 4) {

                        // CFT review state update form_progress

                        $IsCFTRequired = MarketComplaintcftResponce::withoutTrashed()->where(['is_required' => 1, 'mc_id' => $id])->latest()->first();
                        $cftUsers = DB::table('market_complaint_cfts')->where(['mc_id' => $id])->first();
                        // Define the column names
                        $columns = ['Quality_Control_Person', 'QualityAssurance_person', 'Engineering_person', 'Environment_Health_Safety_person', 'Human_Resource_person', 'Information_Technology_person', 'Other1_person', 'Other2_person', 'Other3_person', 'Other4_person', 'Other5_person', 'RA_person', 'Production_Table_Person', 'ProductionLiquid_person', 'Production_Injection_Person', 'Store_person', 'ResearchDevelopment_person', 'Microbiology_person', 'RegulatoryAffair_person', 'CorporateQualityAssurance_person', 'ContractGiver_person'];
                        // $columns2 = ['Production_review', 'Warehouse_review', 'Quality_Control_review', 'QualityAssurance_review', 'Engineering_review', 'Analytical_Development_review', 'Kilo_Lab_review', 'Technology_transfer_review', 'Environment_Health_Safety_review', 'Human_Resource_review', 'Information_Technology_review', 'Project_management_review'];

                        // Initialize an array to store the values
                        $valuesArray = [];

                        // Iterate over the columns and retrieve the values
                        foreach ($columns as $index => $column) {
                            $value = $cftUsers->$column;
                            if ($index == 0 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->Quality_Control_by = Auth::user()->name;
                                $updateCFT->Quality_Control_on = Carbon::now()->format('Y-m-d');
                                // $updateCFT->quality_control_comment = $request->comment;

                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
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
                                $updateCFT->QualityAssurance_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Quality Assurance Completed By, Quality Assurance Completed On';
                                if (is_null($lastDocument->QualityAssurance_by) || $lastDocument->QualityAssurance_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->QualityAssurance_by . ' ,' . $lastDocument->QualityAssurance_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->QualityAssurance_by . ',' . $updateCFT->QualityAssurance_on;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
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
                            if ($index == 2 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->Engineering_by = Auth::user()->name;
                                $updateCFT->Engineering_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Engineering Completed By, Engineering Completed On';
                                if (is_null($lastDocument->Engineering_by) || $lastDocument->Engineering_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->Engineering_by . ' ,' . $lastDocument->Engineering_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->Engineering_by . ',' . $updateCFT->Engineering_on;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->Engineering_by) || $lastDocument->Engineering_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 3 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->Environment_Health_Safety_by = Auth::user()->name;
                                $updateCFT->Environment_Health_Safety_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Safety Completed By, Safety Completed On';
                                if (is_null($lastDocument->Environment_Health_Safety_by) || $lastDocument->Environment_Health_Safety_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->Environment_Health_Safety_by . ' ,' . $lastDocument->Environment_Health_Safety_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->Environment_Health_Safety_by . ',' . $updateCFT->Environment_Health_Safety_on;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->Environment_Health_Safety_by) || $lastDocument->Environment_Health_Safety_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 4 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->Human_Resource_by = Auth::user()->name;
                                $updateCFT->Human_Resource_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Human Resource Completed By, Human Resource Completed On';
                                if (is_null($lastDocument->Human_Resource_by) || $lastDocument->Human_Resource_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->Human_Resource_by . ' ,' . $lastDocument->Human_Resource_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->Human_Resource_by . ',' . $updateCFT->Human_Resource_on;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->Human_Resource_by) || $lastDocument->Human_Resource_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 5 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->Information_Technology_by = Auth::user()->name;
                                $updateCFT->Information_Technology_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'CFT Review Completed By, CFT Review Completed On';
                                if (is_null($lastDocument->Information_Technology_by) || $lastDocument->Information_Technology_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->Information_Technology_by . ' ,' . $lastDocument->Information_Technology_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->Information_Technology_by . ',' . $updateCFT->Information_Technology_on;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->Information_Technology_by) || $lastDocument->Information_Technology_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 6 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->Other1_by = Auth::user()->name;
                                $updateCFT->Other1_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Others 1 Completed By, Others 1 Completed On';
                                if (is_null($lastDocument->Other1_by) || $lastDocument->Other1_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->Other1_by . ' ,' . $lastDocument->Other1_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->Other1_by . ',' . $updateCFT->Other1_on;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->Other1_by) || $lastDocument->Other1_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 7 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->Other2_by = Auth::user()->name;
                                $updateCFT->Other2_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Others 2 Completed By, Others 2 Completed On';
                                if (is_null($lastDocument->Other2_by) || $lastDocument->Other2_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->Other2_by . ' ,' . $lastDocument->Other2_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->Other2_by . ',' . $updateCFT->Other2_on;
                                $history->current = $updateCFT->Other2_by;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->Other2_by) || $lastDocument->Other2_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 8 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->Other3_by = Auth::user()->name;
                                $updateCFT->Other3_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Others 3 Completed By, Others 3 Completed On';
                                if (is_null($lastDocument->Other3_by) || $lastDocument->Other3_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->Other3_by . ' ,' . $lastDocument->Other3_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->Other3_by . ',' . $updateCFT->Other3_on;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->Other3_by) || $lastDocument->Other3_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 9 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->Other4_by = Auth::user()->name;
                                $updateCFT->Other4_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Others 4 Completed By, Others 4 Completed On';
                                if (is_null($lastDocument->Other4_by) || $lastDocument->Other4_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->Other4_by . ' ,' . $lastDocument->Other4_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->Other4_by . ',' . $updateCFT->Other4_on;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->Other4_by) || $lastDocument->Other4_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 10 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->Other5_by = Auth::user()->name;
                                $updateCFT->Other5_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Others 5 Completed By, Others 5 Completed On';
                                if (is_null($lastDocument->Other5_by) || $lastDocument->Other5_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->Other5_by . ' ,' . $lastDocument->Other5_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->Other5_by . ',' . $updateCFT->Other5_on;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->Other5_by) || $lastDocument->Other5_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 11 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->RA_by = Auth::user()->name;
                                $updateCFT->RA_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Activity Log';
                                $history->previous = "";
                                $history->action = 'CFT Review';
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
                            if ($index == 12 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->Production_Table_By = Auth::user()->name;
                                $updateCFT->Production_Table_On = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Production Table Completed By, Production Table Completed On';
                                if (is_null($lastDocument->Production_Table_By) || $lastDocument->Production_Table_On == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->Production_Table_By . ' ,' . $lastDocument->Production_Table_On;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->Production_Table_By . ',' . $updateCFT->Production_Table_On;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->Production_Table_By) || $lastDocument->Production_Table_On == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 13 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->ProductionLiquid_by = Auth::user()->name;
                                $updateCFT->ProductionLiquid_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Production Liquid Completed By, Production Liquid Completed On';
                                if (is_null($lastDocument->ProductionLiquid_by) || $lastDocument->ProductionLiquid_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->ProductionLiquid_by . ' ,' . $lastDocument->ProductionLiquid_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->ProductionLiquid_by . ',' . $updateCFT->ProductionLiquid_on;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->ProductionLiquid_by) || $lastDocument->ProductionLiquid_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 14 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->Production_Injection_By = Auth::user()->name;
                                $updateCFT->Production_Injection_On = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Production Injection Completed By, Production Injection Completed On';
                                if (is_null($lastDocument->Production_Injection_By) || $lastDocument->Production_Injection_On == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->Production_Injection_By . ' ,' . $lastDocument->Production_Injection_On;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->Production_Injection_By . ',' . $updateCFT->Production_Injection_On;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->Production_Injection_By) || $lastDocument->Production_Injection_On == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 15 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->Store_by = Auth::user()->name;
                                $updateCFT->Store_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Stores Completed By, Stores Completed On';
                                if (is_null($lastDocument->Store_by) || $lastDocument->Store_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->Store_by . ' ,' . $lastDocument->Store_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->Store_by . ',' . $updateCFT->Store_on;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->Store_by) || $lastDocument->Store_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 16 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->ResearchDevelopment_by = Auth::user()->name;
                                $updateCFT->ResearchDevelopment_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Research & Development Completed By, Research & Development Completed On';
                                if (is_null($lastDocument->ResearchDevelopment_by) || $lastDocument->ResearchDevelopment_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->ResearchDevelopment_by . ' ,' . $lastDocument->ResearchDevelopment_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->ResearchDevelopment_by . ',' . $updateCFT->ResearchDevelopment_on;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->ResearchDevelopment_by) || $lastDocument->ResearchDevelopment_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 17 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->Microbiology_by = Auth::user()->name;
                                $updateCFT->Microbiology_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Microbiology Completed By, Microbiology Completed On';
                                if (is_null($lastDocument->Microbiology_by) || $lastDocument->Microbiology_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->Microbiology_by . ' ,' . $lastDocument->Microbiology_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->Microbiology_by . ',' . $updateCFT->Microbiology_on;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->Microbiology_by) || $lastDocument->Microbiology_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 18 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->RegulatoryAffair_by = Auth::user()->name;
                                $updateCFT->RegulatoryAffair_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Regulatory Affair Completed By, Regulatory Affair Completed On';
                                if (is_null($lastDocument->RegulatoryAffair_by) || $lastDocument->RegulatoryAffair_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->RegulatoryAffair_by . ' ,' . $lastDocument->RegulatoryAffair_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->RegulatoryAffair_by . ',' . $updateCFT->RegulatoryAffair_on;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->RegulatoryAffair_by) || $lastDocument->RegulatoryAffair_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }

                            if ($index == 19 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->CorporateQualityAssurance_by = Auth::user()->name;
                                $updateCFT->CorporateQualityAssurance_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Corporate Quality Assurance Completed By, Corporate Quality Assurance Completed On';
                                if (is_null($lastDocument->CorporateQualityAssurance_by) || $lastDocument->CorporateQualityAssurance_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->CorporateQualityAssurance_by . ' ,' . $lastDocument->CorporateQualityAssurance_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->CorporateQualityAssurance_by . ',' . $updateCFT->CorporateQualityAssurance_on;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->CorporateQualityAssurance_by) || $lastDocument->CorporateQualityAssurance_on == '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                            }
                            if ($index == 20 && $cftUsers->$column == Auth::user()->name) {
                                $updateCFT->ContractGiver_by = Auth::user()->name;
                                $updateCFT->ContractGiver_on = Carbon::now()->format('Y-m-d');
                                $history = new MarketComplaintAuditTrial();
                                $history->market_id = $id;
                                $history->activity_type = 'Contract Giver Completed By, Contract Giver Completed On';
                                if (is_null($lastDocument->ContractGiver_by) || $lastDocument->ContractGiver_on == '') {
                                    $history->previous = "";
                                } else {
                                    $history->previous = $lastDocument->ContractGiver_by . ' ,' . $lastDocument->ContractGiver_on;
                                }
                                $history->action = 'CFT Review Complete';
                                $history->current = $updateCFT->ContractGiver_by . ',' . $updateCFT->ContractGiver_on;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->name;
                                $history->user_name = Auth::user()->name;
                                $history->change_to =   "Not Applicable";
                                $history->change_from = $lastDocument->status;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = 'CFT Review';
                                if (is_null($lastDocument->ContractGiver_by) || $lastDocument->ContractGiver_on == '') {
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
                                $stage = new MarketComplaintcftResponce();
                                $stage->mc_id = $id;
                                $stage->cft_user_id = Auth::user()->id;
                                $stage->status = "Completed";
                                // $stage->cft_stage = ;
                                $stage->comment = $request->comment;
                                $stage->save();
                            } else {
                                $stage = new MarketComplaintcftResponce();
                                $stage->mc_id = $id;
                                $stage->cft_user_id = Auth::user()->id;
                                $stage->status = "In-progress";
                                // $stage->cft_stage = ;
                                $stage->comment = $request->comment;
                                $stage->save();
                            }
                        }

                        $checkCFTCount = MarketComplaintcftResponce::withoutTrashed()->where(['status' => 'Completed', 'mc_id' => $id])->count();
                        // dd(count(array_unique($valuesArray)), $checkCFTCount);


                        if (!$IsCFTRequired || $checkCFTCount) {

                            $marketstat->stage = "5";
                            $marketstat->status = "All Action Completion Verification by QA/CQA";
                            $marketstat->cft_complate_by = Auth::user()->name;
                            $marketstat->cft_complate_on = Carbon::now()->format('d-M-Y');
                            $marketstat->cft_complate_comm = $request->comment;

                            $history = new MarketComplaintAuditTrial();
                            $history->market_id = $id;
                            $history->activity_type = 'CFT Review Completed By, CFT Review Completed On';
                            if (is_null($lastDocument->cft_complate_by) || $lastDocument->cft_complate_on == '') {
                                $history->previous = "";
                            } else {
                                $history->previous = $lastDocument->cft_complate_by . ' ,' . $lastDocument->cft_complate_on;
                            }
                            $history->action = 'CFT Review Complete';
                            $history->current = $marketstat->cft_complate_by . ',' . $marketstat->cft_complate_on;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->change_to =   "All Action Completion Verification by QA/CQA";
                            $history->change_from = $lastDocument->status;
                            $history->stage = 'Complete';
                            if (is_null($lastDocument->cft_complate_by) || $lastDocument->cft_complate_on == '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                            $history->save();

                        //     $list = Helpers::getInitiatorUserList($marketstat->division_id); // Notify CFT Person
                        //     foreach ($list as $u) {
                        //     // if($u->q_m_s_divisions_id == $marketstat->division_id){
                        //     $email = Helpers::getUserEmail($u->user_id);
                        //     if ($email !== null) {
                        //         Mail::send(
                        //             'mail.view-mail',
                        //             ['data' => $marketstat, 'site' => "Ext", 'history' => "Submit", 'process' => 'Market Complaint', 'comment' => $request->comments, 'user' => Auth::user()->name],
                        //             function ($message) use ($email, $marketstat) {
                        //                 $message->to($email)
                        //                     ->subject("Agio Notification: Market Complaint, Record #" . str_pad($marketstat->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                        //             }
                        //         );
                        //     }
                        //     // }
                        // }
                            $marketstat->update();
                        }
                        toastr()->success('Document Sent');
                        return back();
                    }

                    if ($marketstat->stage == 5) {

                        if (!$marketstat->qa_cqa_comments) {
                            Session::flash('swal', [
                                'title' => 'Mandatory Fields Required!',
                                'message' => 'QA CQA Comments is yet to be filled!',
                                'type' => 'warning',
                            ]);

                            return redirect()->back();
                        } else {
                            Session::flash('swal', [
                                'type' => 'success',
                                'title' => 'Success',
                                'message' => 'QA/CQA Head Approval!'
                            ]);
                        }

                        $marketstat->stage = "6";
                        $marketstat->status = "QA/CQA Head Approve";
                        $marketstat->qa_cqa_verif_comp_by = Auth::user()->name;
                        $marketstat->qa_cqa_verif_comp_on = Carbon::now()->format('d-M-Y');
                        $marketstat->QA_cqa_verif_Comments = $request->comment;

                        $history = new MarketComplaintAuditTrial();
                        $history->market_id = $id;
                        $history->activity_type = 'qa_cqa_verif_comp_by , CFT Review Complete On';

                        if (is_null($lastDocument->qa_cqa_verif_comp_by) || $lastDocument->complete_review_on == '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->qa_cqa_verif_comp_by . ' ,' . $lastDocument->closed_done_on;
                        }
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        // $history->current = $marketstat->qa_cqa_verif_comp_by;
                        $history->comment = $request->comment;
                        $history->action = 'QA/CQA Verification Complete';
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "QA/CQA Head Approval ";
                        $history->change_from = $lastDocument->status;
                        $history->stage = 'Approved';
                        if (is_null($lastDocument->qa_cqa_verif_comp_by) || $lastDocument->approve_plan_on == '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->qa_cqa_verif_comp_by . ' ,' . $lastDocument->approve_plan_on;
                        }
                        $history->save();

                        // $list = Helpers::getInitiatorUserList($marketstat->division_id); // Notify CFT Person
                        // foreach ($list as $u) {
                        //     // if($u->q_m_s_divisions_id == $marketstat->division_id){
                        //     $email = Helpers::getUserEmail($u->user_id);
                        //     if ($email !== null) {
                        //         Mail::send(
                        //             'mail.view-mail',
                        //             ['data' => $marketstat, 'site' => "Ext", 'history' => "Submit", 'process' => 'Market Complaint', 'comment' => $request->comments, 'user' => Auth::user()->name],
                        //             function ($message) use ($email, $marketstat) {
                        //                 $message->to($email)
                        //                     ->subject("Agio Notification: Market Complaint, Record #" . str_pad($marketstat->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                        //             }
                        //         );
                        //     }
                        //     // }
                        // }

                        $marketstat->update();
                        toastr()->success('Document Sent');
                        return back();
                    }


                    if ($marketstat->stage == 6) {

                        if (!$marketstat->qa_cqa_head_comm) {
                            Session::flash('swal', [
                                'title' => 'Mandatory Fields Required!',
                                'message' => 'QA/CQA Head Approval By Comment Tab is yet to be filled!',
                                'type' => 'warning',
                            ]);

                            return redirect()->back();
                        } else {
                            Session::flash('swal', [
                                'type' => 'success',
                                'title' => 'Success',
                                'message' => 'Pending Response Letter!'
                            ]);
                        }


                        $marketstat->stage = "7";
                        $marketstat->status = "Pending Response Letter";
                        $marketstat->approve_plan_by = Auth::user()->name;
                        $marketstat->approve_plan_on = Carbon::now()->format('d-M-Y');
                        $marketstat->approve_Comments = $request->comment;

                        $history = new MarketComplaintAuditTrial();
                        $history->market_id = $id;
                        $history->activity_type = 'Approval Complete By  , Approval Complete On';

                        if (is_null($lastDocument->approve_plan_by) || $lastDocument->complete_review_on == '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->approve_plan_by . ' ,' . $lastDocument->approve_plan_on;
                        }
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->current = $marketstat->approve_plan_on;
                        $history->comment = $request->comment;
                        $history->action = 'Approval Complete';
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "Pending Response Letter";
                        $history->change_from = $lastDocument->status;
                        $history->stage = 'Approved';
                        if (is_null($lastDocument->approve_plan_by) || $lastDocument->complete_review_on == '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->approve_plan_by . ' ,' . $lastDocument->approve_plan_on;
                        }
                        $history->save();

                        // $list = Helpers::getCftUserList($marketstat->division_id); // Notify CFT Person
                        // foreach ($list as $u) {
                        //     // if($u->q_m_s_divisions_id == $marketstat->division_id){
                        //     $email = Helpers::getUserEmail($u->user_id);
                        //     if ($email !== null) {
                        //         Mail::send(
                        //             'mail.view-mail',
                        //             ['data' => $marketstat, 'site' => "Ext", 'history' => "Submit", 'process' => 'Market Complaint', 'comment' => $request->comments, 'user' => Auth::user()->name],
                        //             function ($message) use ($email, $marketstat) {
                        //                 $message->to($email)
                        //                     ->subject("Agio Notification: Market Complaint, Record #" . str_pad($marketstat->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                        //             }
                        //         );
                        //     }
                        //     // }
                        // }

                        $marketstat->update();
                        toastr()->success('Document Sent');
                        return back();
                    }


                    if ($marketstat->stage == 7) {

                        if (!$marketstat->closure_comment_c) {
                            Session::flash('swal', [
                                'title' => 'Mandatory Fields Required!',
                                'message' => 'Closure Comment is yet to be filled!',
                                'type' => 'warning',
                            ]);

                            return redirect()->back();
                        } else {
                            Session::flash('swal', [
                                'type' => 'success',
                                'title' => 'Success',
                                'message' => 'Closed-Done'
                            ]);
                        }


                        $marketstat->stage = "8";
                        $marketstat->status = "Closed-Done";
                        $marketstat->send_letter_by = Auth::user()->name;
                        $marketstat->send_letter_on = Carbon::now()->format('d-M-Y');
                        $marketstat->send_letter_comment = $request->comment;
                        $history = new MarketComplaintAuditTrial();
                        $history->market_id = $id;
                        $history->activity_type = 'send letter by  , send letter On';
                        if (is_null($lastDocument->send_letter_by) || $lastDocument->send_letter_on == '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->send_letter_by . ' ,' . $lastDocument->closed_done_on;
                        }
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->action = 'Send Letter';
                        // $history->current = $marketstat->send_letter_by;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "Closed-Done";
                        $history->change_from = $lastDocument->status;
                        $history->stage = 'Completed';
                        if (is_null($lastDocument->send_letter_by) || $lastDocument->send_letter_on == '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->send_letter_by . ' ,' . $lastDocument->send_letter_on;
                        }
                        $history->save();

                        $marketstat->update();
                        toastr()->success('Document Sent');
                        return back();
                    }
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
    }

    public function marketComplaintRejectState(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $marketstat = MarketComplaint::find($id);
            $lastDocument =  MarketComplaint::find($id);

            if ($marketstat->stage == 8) {
                $marketstat->stage = "7";
                $marketstat->status = "Pending Response Letter";
                $marketstat->reject_by = 'Not Applicable';
                $marketstat->reject_on = 'Not Applicable';
                // $marketstat->reject_comment = $request->comment;
                $history = new MarketComplaintAuditTrial();
                $history->market_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->action = 'More Information Required';
                $history->previous = "Not Applicable";
                $history->current = 'Not Applicable';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Pending Response Letter";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Pending Response Letter';
                $history->save();
                $marketstat->update();

                return back();
            }

            if ($marketstat->stage == 7) {
                $marketstat->stage = "6";
                $marketstat->status = "QA Head Approve";
                $marketstat->reject_by = 'Not Applicable';
                $marketstat->reject_on = 'Not Applicable';
                // $marketstat->reject_comment = $request->comment;
                $history = new MarketComplaintAuditTrial();
                $history->market_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->action = 'More Information Required';
                $history->previous = "Not Applicable";
                $history->current = 'Not Applicable';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Pending Response Letter";
                $history->change_from = $lastDocument->status;;
                $history->stage = 'In QA Review';
                $history->save();

                // $list = Helpers::getQAUserList($marketstat->division_id); // Notify CFT Person
                //         foreach ($list as $u) {
                //             // if($u->q_m_s_divisions_id == $marketstat->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //             // dd($email);
                //             if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $marketstat, 'site' => "Market Complaint", 'history' => "More Information Required", 'process' => 'Market Complaint', 'comment' => $request->comments, 'user' => Auth::user()->name],
                //                     function ($message) use ($email, $marketstat) {
                //                         $message->to($email)
                //                             ->subject("Agio Notification: Market Complaint, Record #" . str_pad($marketstat->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                     }
                //                 );
                //             }
                //             // }
                //         }
                $marketstat->update();

                return back();
            }

            if ($marketstat->stage == 6) {
                $marketstat->stage = "5";
                $marketstat->status = "All Action Complete";
                $marketstat->reject_by = 'Not Applicable';
                $marketstat->reject_on = 'Not Applicable';
                $marketstat->reject_comment = $request->comment;
                $history = new MarketComplaintAuditTrial();
                $history->market_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->action = 'More Information Required';
                $history->previous = "Not Applicable";
                $history->current = 'Not Applicable';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "All Action Completion Verification by QA/CQA";
                $history->change_from = $lastDocument->status;
                $history->stage = 'In QA Review';
                $history->save();

                // $list = Helpers::getCftUserList($marketstat->division_id); // Notify CFT Person
                //         foreach ($list as $u) {
                //             // if($u->q_m_s_divisions_id == $marketstat->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //             // dd($email);
                //             if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $marketstat, 'site' => "Market Complaint", 'history' => "More Information Required", 'process' => 'Market Complaint', 'comment' => $request->comments, 'user' => Auth::user()->name],
                //                     function ($message) use ($email, $marketstat) {
                //                         $message->to($email)
                //                             ->subject("Agio Notification: Market Complaint, Record #" . str_pad($marketstat->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                     }
                //                 );
                //             }
                //             // }
                //         }


                $marketstat->update();

                return back();
            }

            if ($marketstat->stage == 5) {
                $marketstat->stage = "4";
                $marketstat->status = "CFt Review";
                $marketstat->reject_by = 'Not Applicable';
                $marketstat->reject_on = 'Not Applicable';
                // $marketstat->reject_comment = $request->comment;
                $history = new MarketComplaintAuditTrial();
                $history->market_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->action = 'More Information Required';
                $history->previous = "Not Applicable";
                $history->current = $marketstat->closed_done_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "CFT Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'CFT Review';
                $history->save();
                $marketstat->update();


                // $list = Helpers::getQAUserList($marketstat->division_id); // Notify CFT Person
                //         foreach ($list as $u) {
                //             // if($u->q_m_s_divisions_id == $marketstat->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //             // dd($email);
                //             if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $marketstat, 'site' => "Market Complaint", 'history' => "More Information Required", 'process' => 'Market Complaint', 'comment' => $request->comments, 'user' => Auth::user()->name],
                //                     function ($message) use ($email, $marketstat) {
                //                         $message->to($email)
                //                             ->subject("Agio Notification: Market Complaint, Record #" . str_pad($marketstat->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                     }
                //                 );
                //             }
                //             // }
                //         }

                        //$list = Helpers::getCQAUsersList($marketstat->division_id); // Notify CFT Person
                        //foreach ($list as $u) {
                        //    // if($u->q_m_s_divisions_id == $marketstat->division_id){
                        //    $email = Helpers::getUserEmail($u->user_id);
                        //    // dd($email);
                        //    if ($email !== null) {
                        //        Mail::send(
                        //            'mail.view-mail',
                        //            ['data' => $marketstat, 'site' => "Market Complaint", 'history' => "More Information Required", 'process' => 'Market Complaint', 'comment' => $request->comments, 'user' => Auth::user()->name],
                        //            function ($message) use ($email, $marketstat) {
                        //                $message->to($email)
                        //                    ->subject("Agio Notification: Market Complaint, Record #" . str_pad($marketstat->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                        //            }
                        //        );
                        //    }
                        //    // }
                        //}

                return back();
            }

            if ($marketstat->stage == 4) {
                $marketstat->stage = "3";
                $marketstat->status = "Investigation CAPA And Root Cause Analysis";
                $marketstat->reject_by = 'Not Applicable';
                $marketstat->reject_on = 'Not Applicable';
                // $marketstat->reject_comment = $request->comment;
                $history = new MarketComplaintAuditTrial();
                $history->market_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->action = 'More Information Required';
                $history->previous = "Not Applicable";
                $history->current = 'Not Applicable';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Investigation CAPA And Root Cause Analysis";
                $history->change_from = $lastDocument->status;;
                $history->stage = 'CFT Review';
                $history->save();
                $marketstat->update();

                return back();
            }

            if ($marketstat->stage == 3) {
                $marketstat->stage = "2";
                $marketstat->status = "QA/CQA Head Review";
                $marketstat->more_information_required_by = 'Null';
                $marketstat->more_information_required_on = 'Null';
                // $marketstat->more_information_required_comment = $request->comment;
                $history = new MarketComplaintAuditTrial();
                $history->market_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->action = 'More Information Required';
                $history->previous = "Not Applicable";
                $history->current = 'Not Applicable';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "QA/CQA Head Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Opened';
                $history->save();
                $marketstat->update();

                return back();
            }


            if ($marketstat->stage == 2) {
                $marketstat->stage = "1";
                $marketstat->status = "Opened";
                $marketstat->more_information_required_by = 'Not Applicable';
                $marketstat->more_information_required_on = 'Not Applicable';
                $marketstat->more_information_required_comment = $request->comment;
                $history = new MarketComplaintAuditTrial();
                $history->market_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->action = 'More Information Required';
                $history->previous = "Not Applicable";
                $history->current = 'Not Applicable';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Open";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Opened';
                $history->save();

                // $list = Helpers::getQAUserList($marketstat->division_id); // Notify CFT Person
                //         foreach ($list as $u) {
                //             // if($u->q_m_s_divisions_id == $marketstat->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //             // dd($email);
                //             if ($email !== null) {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $marketstat, 'site' => "Market Complaint", 'history' => "Cancel", 'process' => 'Market Complaint', 'comment' => $request->comments, 'user' => Auth::user()->name],
                //                     function ($message) use ($email, $marketstat) {
                //                         $message->to($email)
                //                             ->subject("Agio Notification: Market Complaint, Record #" . str_pad($marketstat->record, 4, '0', STR_PAD_LEFT) . " - Activity: Cancel");
                //                     }
                //                 );
                //             }
                //             // }
                //         }

                        // $list = Helpers::getCQAUsersList($marketstat->division_id); // Notify CFT Person
                        // foreach ($list as $u) {
                        //     // if($u->q_m_s_divisions_id == $marketstat->division_id){
                        //     $email = Helpers::getUserEmail($u->user_id);
                        //     // dd($email);
                        //     if ($email !== null) {
                        //         Mail::send(
                        //             'mail.view-mail',
                        //             ['data' => $marketstat, 'site' => "Market Complaint", 'history' => "More Information Required", 'process' => 'Market Complaint', 'comment' => $request->comments, 'user' => Auth::user()->name],
                        //             function ($message) use ($email, $marketstat) {
                        //                 $message->to($email)
                        //                     ->subject("Agio Notification: Market Complaint, Record #" . str_pad($marketstat->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                        //             }
                        //         );
                        //     }
                        //     // }
                        // }

                $marketstat->update();

                return back();
            }
        }

        // Optionally, handle invalid credentials or other logic
        return back()->withErrors(['Invalid credentials or action not allowed.']);
    }


    public function MarketComplaintCancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = MarketComplaint::find($id);
            $lastDocument =  MarketComplaint::find($id);

            // if ($changeControl->stage == 0) {
            $changeControl->stage = "0";
            $changeControl->status = "Closed - Cancelled";
            $changeControl->cancelled_by = Auth::user()->name;
            $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
            $changeControl->cancelled_comment = $request->comment;
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $id;
            $history->activity_type = 'Activity Log';
            $history->action = 'Cancel';
            $history->previous = "";
            $history->current = $changeControl->closed_done_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Closed - Cancelled";
            $history->change_from = "Supervisor Review";
            $history->stage = 'Closed - Cancelled';
            $history->save();
            $changeControl->update();
            toastr()->success('Document Sent');
            return back();
            // }

            // $changeControl->stage = "2";
            // // $changeControl->status = "Closed - Cancelled";
            // $changeControl->cancelled_by = Auth::user()->name;
            // $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
            // $changeControl->update();
            // toastr()->success('Document Sent');
            // return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    // =======================================================RCA and Action ======================================================

    public function MarketComplaintRca_actionChild(Request $request, $id)
    {
        // dd($request->revision);

        $cc = MarketComplaint::find($id);
        $cft = [];
        $parent_id = $id;
        $parent_type = "Market Complaint";
        $old_records = Capa::select('id', 'division_id', 'record')->get();
        $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = str_pad($record, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
        $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_initiator_id = $id;


        if ($request->revision == "rca-child") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            // $record_number = $record;
            return view('frontend.forms.root-cause-analysis', compact('record', 'due_date', 'parent_id', 'old_records', 'parent_type', 'parent_intiation_date', 'parent_record', 'parent_initiator_id', 'cft'));
        }
        if ($request->revision == "Action-Item") {
            // return "test";
            $data = MarketComplaint::find($id);

            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.action-item.action-item', compact('record', 'due_date', 'parent_id', 'old_records', 'parent_type', 'parent_intiation_date', 'parent_record', 'parent_initiator_id', 'data'));
        }

        if ($request->revision == "capa-child") {
            $relatedRecords = Helpers::getAllRelatedRecords();
            // return "test";
            $Capachild = MarketComplaint::find($id);
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            $reference_record = Helpers::getDivisionName($Capachild->division_id ) . '/' . 'RA' .'/' . date('Y') .'/' . str_pad($Capachild->record, 4, '0', STR_PAD_LEFT);
            return view('frontend.forms.capa', compact('record', 'record_number','reference_record', 'due_date', 'parent_id', 'old_records', 'parent_type', 'parent_intiation_date', 'parent_record', 'parent_initiator_id', 'relatedRecords'));
        }
    }

    // ================================================================Capa and Action==================================================

    public function MarketComplaintCapa_ActionChild(Request $request, $id)
    {
        // dd($request->revision);

        $cc = MarketComplaint::find($id);
        $cft = [];

        $parent_type = "Market Complaint";
        $old_records = Capa::select('id', 'division_id', 'record')->get();
        // $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = $cc->record;
        $record = str_pad($record, 4, '0', STR_PAD_LEFT);
        $record_number = $cc->record;
        $record_number = str_pad($record, 4, '0', STR_PAD_LEFT);
        $parent_id = $record;
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
        $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_initiator_id = $id;

        if ($request->revision == "capa-child") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            $record_number = $record;
            $relatedRecords = Helpers::getAllRelatedRecords();
            $Capachild = MarketComplaint::find($id);
            //    dd($Capachild->division_id);
               $reference_record = Helpers::getDivisionName($Capachild->division_id ) . '/' . 'MC' .'/' . date('Y') .'/' . str_pad($Capachild->record, 4, '0', STR_PAD_LEFT);

            return view('frontend.forms.capa', compact('record_number', 'due_date', 'parent_id', 'old_records', 'parent_type', 'parent_intiation_date', 'parent_record', 'parent_initiator_id', 'cft', 'relatedRecords','reference_record'));
        } elseif ($request->revision == "Action-Item") {
            // return "test";
            $p_record = MarketComplaint::find($id);
            $data_record = Helpers::getDivisionName($p_record->division_id) . '/' . 'MC' . '/' . date('Y') . '/' . str_pad($p_record->record, 4, '0', STR_PAD_LEFT);
            $parentRecord = MarketComplaint::where('id', $id)->value('record');
            $data = MarketComplaint::find($id);
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.action-item.action-item', compact('record', 'data', 'parentRecord', 'due_date', 'parent_id', 'old_records', 'parent_type', 'parent_intiation_date', 'parent_record', 'parent_initiator_id', 'data_record'));
        } elseif ($request->revision == "rca") {
            //  return "test";
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.forms.root-cause-analysis', compact('record_number', 'record', 'due_date', 'parent_id', 'old_records', 'parent_type', 'parent_intiation_date', 'parent_record', 'parent_initiator_id'));
        }
    }


    public function child(Request $request, $id)
    {

        $cft = [];
        $parent_id = $id;
        $parent_type = "Audit_Program";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $parent_record = MarketComplaint::where('id', $id)->value('record');
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_division_id = MarketComplaint::where('id', $id)->value('division_id');
        $parent_initiator_id = MarketComplaint::where('id', $id)->value('initiator_id');
        $parent_intiation_date = MarketComplaint::where('id', $id)->value('intiation_date');
        $parent_created_at = MarketComplaint::where('id', $id)->value('created_at');
        $parent_short_description = MarketComplaint::where('id', $id)->value('short_description');
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
            $Extensionchild = MarketComplaint::find($id);
            $Extensionchild->Extensionchild = $record_number;
            $Extensionchild->save();
            return view('frontend.extension.extension_new', compact('parent_id', 'parent_type', 'parent_record', 'parent_name', 'record_number', 'parent_due_date', 'due_date', 'parent_created_at'));
        }
        $old_record = MarketComplaint::select('id', 'division_id', 'record')->get();
        // dd($request->child_type)
        if ($request->child_type == "capa") {
            $parent_name = "CAPA";
            $Capachild = MarketComplaint::find($id);
            $reference_record = Helpers::getDivisionName($Capachild->division_id ) . '/' . 'RA' .'/' . date('Y') .'/' . str_pad($Capachild->record, 4, '0', STR_PAD_LEFT);
            $Capachild->Capachild = $record_number;
            $record = $record_number;
            $old_records = $old_record;
            $Capachild->save();

            return view('frontend.forms.capa', compact('parent_id','reference_record', 'parent_record', 'parent_type', 'record', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'old_records', 'cft', 'record_number'));
        } elseif ($request->child_type == "Action_Item") {
            $parent_name = "CAPA";
            $actionchild = MarketComplaint::find($id);
            // $p_record = OutOfCalibration::find($id);
            $data_record = Helpers::getDivisionName($actionchild->division_id) . '/' . 'MC' . '/' . date('Y') . '/' . str_pad($actionchild->record, 4, '0',  STR_PAD_LEFT);
            $actionchild->actionchild = $record_number;
            $parent_id = $id;
            $actionchild->save();

            return view('frontend.action-item.action-item', compact('old_record', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'record_number', 'due_date', 'parent_id', 'parent_type', 'data_record'));
        } elseif ($request->child_type == "effectiveness_check") {
            $parent_name = "CAPA";
            $effectivenesschild = MarketComplaint::find($id);
            $effectivenesschild->effectivenesschild = $record_number;
            $effectivenesschild->save();
            return view('frontend.forms.effectiveness-check', compact('old_record', 'parent_short_description', 'parent_record', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id',  'record_number', 'due_date', 'parent_id', 'parent_type'));
        } elseif ($request->child_type == "Change_control") {
            $parent_name = "CAPA";
            $Changecontrolchild = MarketComplaint::find($id);
            $Changecontrolchild->Changecontrolchild = $record_number;
            $preRiskAssessment = MarketComplaint::all();
            $pre = CC::all();

            $Changecontrolchild->save();

            return view('frontend.change-control.new-change-control', compact('pre', 'preRiskAssessment', 'cft', 'hod', 'parent_short_description',  'parent_initiator_id', 'parent_intiation_date', 'parent_division_id',  'record_number', 'due_date', 'parent_id', 'parent_type'));
        }
        // else {
        //     $parent_name = "Root";
        //     $Rootchild = RiskManagement::find($id);
        //     $Rootchild->Rootchild = $record_number;
        //     $Rootchild->save();
        //     return view('frontend.forms.root-cause-analysis', compact('parent_id', 'parent_record','parent_type', 'record_number', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', ));
        // }
    }
    // {{-- ==================================Regulatory  Reporting  and Effectiveness  Check child=============================================== --}}

    public function MarketComplaintRegu_Effec_Child(Request $request, $id)
    {
        // dd($request->revision);

        $cc = MarketComplaint::find($id);
        $cft = [];

        $parent_type = "Capa";
        $old_records = Capa::select('id', 'division_id', 'record')->get();
        // $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = $cc->record;
        $record = str_pad($record, 4, '0', STR_PAD_LEFT);
        $parent_id = $record;
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
        $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_initiator_id = $id;

        if ($request->revision == "regulatory-child") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return "<h2>This Page is Not Available</h2>";
            // return view('frontend.forms.capa', compact('record', 'due_date', 'parent_id','old_record', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id','cft'));

        }
        if ($request->revision == "Effectiveness-child") {
            // return "test";
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            $record_number = $record;

            return view('frontend.forms.effectiveness-check', compact('record_number', 'due_date', 'parent_id', 'old_records', 'parent_type', 'parent_intiation_date', 'parent_record', 'parent_initiator_id'));
        }
    }


    public function singleReport(Request $request, $id)
    {

        $data = MarketComplaint::find($id);
        $data1 = MarketComplaintCft::where('mc_id', $id)->first();
        // dd($data1)
        $prductgigrid = MarketComplaintGrids::where(['mc_id' => $id, 'identifer' => 'ProductDetails'])->first();
        $gitracebilty = MarketComplaintGrids::where(['mc_id' => $id, 'identifer' => 'Traceability'])->first();
        $marketrproducts = MarketComplaintGrids::where(['mc_id' => $id, 'identifer' => 'Product_MaterialDetails'])->first();
        $giinvesting = MarketComplaintGrids::where(['mc_id' => $id, 'identifer' => 'Investing_team'])->first();
        $brain = MarketComplaintGrids::where(['mc_id' => $id, 'identifer' => 'brain_stroming_details'])->first();
        $hodteammembers = MarketComplaintGrids::where(['mc_id' => $id, 'identifer' => 'Team_Members'])->first();
        $hodreportapproval = MarketComplaintGrids::where(['mc_id' => $id, 'identifer' => 'Report_Approval'])->first();
        $proposal_to_accomplish_investigation = MarketComplaintGrids::where('mc_id', $id)->where('identifer', 'Proposal_to_accomplish_investigation')->first();
        $proposalData = $proposal_to_accomplish_investigation ? json_decode($proposal_to_accomplish_investigation->data, true) : [];



        // $martab_grid =MarketComplaintGrids::where(['mc_id' => $id,'identifer'=> 'Sutability'])->first();

        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.market_complaint.singleReport', compact('data', 'proposalData', 'proposal_to_accomplish_investigation', 'data1', 'prductgigrid', 'gitracebilty', 'marketrproducts', 'giinvesting', 'brain', 'hodteammembers', 'hodreportapproval'))
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
            return $pdf->stream('MarketComplainta' . $id . '.pdf');
        }


        return view('frontend.market_complaint.singleReport', compact('data', 'prductgigrid'));
    }

    public function MarketAuditTrial($id)
    {
        $audit = MarketComplaintAuditTrial::where('market_id', $id)->orderByDESC('id')->paginate();
        $today = Carbon::now()->format('d-m-y');
        $document = MarketComplaint::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
        $users = User::all();

        return view('frontend.market_complaint.audit-trial', compact('audit', 'users', 'document', 'today'));
    }


    public function auditDetailsMarket($id)
    {
        $detail = MarketComplaintAuditTrial::find($id);

        $detail_data = MarketComplaintAuditTrial::where('Activity_type', $detail->activity_type)->where('market_id', $detail->market_id)->latest()->get();

        $doc = MarketComplaint::where('id', $detail->market_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);
        return view('frontend.market_complaint.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
    }


    public static function auditReport($id)
    {
        $doc = MarketComplaint::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $data = MarketComplaintAuditTrial::where('market_id', $id)->paginate(1000);
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.market_complaint.auditReport', compact('data', 'doc'))
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
            return $pdf->stream('Market-AuditTrial' . $id . '.pdf');
        }
    }



    public function auditTrailPdf($id)
    {
        $doc = MarketComplaint::find($id);
        $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        $data = MarketComplaintAuditTrial::where('market_id', $doc->id)->orderByDesc('id')->paginate(1000);
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $data = $data->sortBy('created_at');
        $pdf = PDF::loadview('frontend.market_complaint.marketcomplaint_audit_trail_pdf', compact('data', 'doc'))
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
        return $pdf->stream('Market-Audit_Trail' . $id . '.pdf');
    }

    public function reopenStage(Request $request, $id)
    {
        $lastmarketComplaint = MarketComplaint::find($id);
        $marketComplaint = MarketComplaint::findOrFail($id);
        $history = new MarketComplaintAuditTrial();
        if ($marketComplaint->stage == '8') {
            $history->market_id = $id;
            $history->activity_type = 'Activity Log';
            $history->action = 'Reopen';

            $history->change_from = "Close-Done";
            $history->change_to = "Opened";
            $history->save();
        }
        $marketComplaint->stage = 1;

        // $history->action_name = "Reopen";
        //    call function update  so how can do this
        $marketComplaint->status = "Opened";

        $this->show($request, $id);
        // $history->change_to = "Opened";

        $marketComplaint->save();
        return redirect()->route('marketcomplaint.marketcomplaint_view', $id);
    }

    public function mc_AuditReview(Request $request, $id)
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
        // Start query for MarketComplaintAuditTrial
        $query = MarketComplaintAuditTrial::query();
        $query->where('market_id', $id);

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
        $responseHtml = view('frontend.market_complaint.mc_filter', compact('audit', 'filter_request'))->render();

        return response()->json(['html' => $responseHtml]);
    }

    public function AcknoledgmentReport(Request $request, $id)
    {

        $data = MarketComplaint::find($id);
        // $data1 = MarketComplaintCft::where('mc_id', $id)->first();

        // dd($data1)
        // $prductgigrid = MarketComplaintGrids::where(['mc_id' => $id, 'identifer' => 'ProductDetails'])->first();
        $product_materialDetails = MarketComplaintGrids::where('mc_id', $id)->where('identifer', 'Product_MaterialDetails')->first();
        $proposal_to_accomplish_investigation = MarketComplaintGrids::where('mc_id', $id)->where('identifer', 'Proposal_to_accomplish_investigation')->first();
        $proposalData = $proposal_to_accomplish_investigation ? json_decode($proposal_to_accomplish_investigation->data, true) : [];

        // $martab_grid =MarketComplaintGrids::where(['mc_id' => $id,'identifer'=> 'Sutability'])->first();

        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.market_complaint.acknoledgment', compact('data', 'proposalData', 'product_materialDetails'))
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
            return $pdf->stream('MarketComplainta' . $id . '.pdf');
        }


        return view('frontend.market_complaint.acknoledgment', compact('data', 'prductgigrid'));
    }


    public function MarkComplaintCFTRequired(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $marketstat = MarketComplaint::find($id);
            $lastDocument = MarketComplaint::find($id);
            $list = Helpers::getInitiatorUserList();
            $marketstat->stage = "5";
            $marketstat->status = "All Action Completion Verification by QA/CQA";
            $marketstat->CFT_Review_Complete_By = Auth::user()->name;
            $marketstat->CFT_Review_Complete_On = Carbon::now()->format('d-M-Y');
            $history = new MarketComplaintAuditTrial();
            $history->mc_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = "";
            $history->current = $marketstat->CFT_Review_Complete_By;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage = 'Send to QA/CQA';


            // foreach ($list as $u) {
            //     if ($u->q_m_s_divisions_id == $marketComplaint->division_id) {
            //         $email = Helpers::getInitiatorEmail($u->user_id);
            //         if ($email !== null) {

            //             try {
            //                 Mail::send(
            //                     'mail.view-mail',
            //                     ['data' => $marketComplaint],
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
            $history->save();
            $marketstat->update();
            // $history = new marketComplaintHistory();
            $history->type = "market Complaint";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $marketstat->stage;
            $history->status = $marketstat->status;
            $history->save();

            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
}
