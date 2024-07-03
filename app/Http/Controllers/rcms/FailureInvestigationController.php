<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{FailureInvestigation,FailureInvestigationAuditTrail,FailureInvestigationCft,
FailureInvestigationCftResponse,
FailureInvestigationGrid,
FailureInvestigationGridData,
FailureInvestigationGridFailureMode,
FailureInvestigationHistory,
FailureInvestigationLaunchExtension,
};
use App\Models\RootCauseAnalysis;
use App\Models\{EffectivenessCheck,LaunchExtension};
use App\Models\CC;
use App\Models\ActionItem;
use App\Models\Extension;
use App\Models\AuditReviewersDetails;
use App\Models\UserRole;
use App\Models\Capa;
use App\Models\Customer;
use Carbon\Carbon;
use App\Models\RecordNumber;
use App\Models\RoleGroup;
use App\Models\User;

use Helpers;
use Illuminate\Pagination\Paginator;
use PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FailureInvestigationController extends Controller
{
    public function index(){
        $old_record = FailureInvestigation::select('id', 'division_id', 'record')->get();
        $record_numbers = (RecordNumber::first()->value('counter')) + 1;
        $record_number = str_pad($record_numbers, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $pre = FailureInvestigation::all();
        return response()->view('frontend.failure-investigation.failure-inv-new', compact('formattedDate','record_number', 'due_date', 'old_record', 'pre'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $form_progress = null;

        if ($request->form_name == 'general')
        {
            $validator = Validator::make($request->all(), [
                'Initiator_Group' => 'required',
                'short_description' => 'required'

            ], [
                'Initiator_Group.required' => 'Department field required!',
                'short_description_required.required' => 'Nature of repeat field required!'
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $form_progress = 'general';
            }
        }

        if (!$request->short_description) {
            toastr()->error("Short description is required");
            return response()->redirect()->back()->withInput();
        }

        $failureInvestigation = new FailureInvestigation();
        $failureInvestigation->form_type = "Failure Investigation";

        $failureInvestigation->record = ((RecordNumber::first()->value('counter')) + 1);
        $failureInvestigation->initiator_id = Auth::user()->id;

        $failureInvestigation->form_progress = isset($form_progress) ? $form_progress : null;

        # -------------new-----------
        //  $failureInvestigation->record_number = $request->record_number;
        $failureInvestigation->division_id = $request->division_id;
        $failureInvestigation->assign_to = $request->assign_to;
        $failureInvestigation->Facility = $request->Facility;
        $failureInvestigation->due_date = $request->due_date;
        $failureInvestigation->intiation_date = $request->intiation_date;
        $failureInvestigation->Initiator_Group = $request->Initiator_Group;
        $failureInvestigation->due_date = Carbon::now()->addDays(30)->format('d-M-Y');
        $failureInvestigation->initiator_group_code = $request->initiator_group_code;
        $failureInvestigation->short_description = $request->short_description;
        $failureInvestigation->failure_investigation_date = $request->failure_investigation_date;
        $failureInvestigation->failure_investigation_time = $request->failure_investigation_time;
        $failureInvestigation->failure_investigation_reported_date = $request->failure_investigation_reported_date;
        if (is_array($request->audit_type)) {
            $failureInvestigation->audit_type = implode(',', $request->audit_type);
        }
        $failureInvestigation->short_description_required = $request->short_description_required;
        $failureInvestigation->nature_of_repeat = $request->nature_of_repeat;
        $failureInvestigation->others = $request->others;

        $failureInvestigation->Product_Batch = $request->Product_Batch;

        $failureInvestigation->Description_failure_investigation = implode(',', $request->Description_failure_investigation);
        $failureInvestigation->Immediate_Action = implode(',', $request->Immediate_Action);
        $failureInvestigation->Preliminary_Impact = implode(',', $request->Preliminary_Impact);
        $failureInvestigation->Product_Details_Required = $request->Product_Details_Required;

        $failureInvestigation->HOD_Remarks = $request->HOD_Remarks;
        $failureInvestigation->failure_investigation_category = $request->failure_investigation_category;
        if($request->failure_investigation_category=='')
        $failureInvestigation->Justification_for_categorization = $request->Justification_for_categorization;
        $failureInvestigation->Investigation_required = $request->Investigation_required;
        $failureInvestigation->capa_required = $request->capa_required;
        $failureInvestigation->qrm_required = $request->qrm_required;

        $failureInvestigation->Investigation_Details = $request->Investigation_Details;
        $failureInvestigation->Customer_notification = $request->Customer_notification;
        $failureInvestigation->customers = $request->customers;
        $failureInvestigation->QAInitialRemark = $request->QAInitialRemark;

        $failureInvestigation->Investigation_Summary = $request->Investigation_Summary;
        $failureInvestigation->Impact_assessment = $request->Impact_assessment;
        $failureInvestigation->Root_cause = $request->Root_cause;
        $failureInvestigation->CAPA_Rquired = $request->CAPA_Rquired;
        $failureInvestigation->capa_type = $request->capa_type;
        $failureInvestigation->CAPA_Description = $request->CAPA_Description;
        $failureInvestigation->Post_Categorization = $request->Post_Categorization;
        $failureInvestigation->Investigation_Of_Review = $request->Investigation_Of_Review;
        $failureInvestigation->QA_Feedbacks = $request->QA_Feedbacks;
        $failureInvestigation->Closure_Comments = $request->Closure_Comments;
        $failureInvestigation->Disposition_Batch = $request->Disposition_Batch;
        $failureInvestigation->Facility_Equipment = $request->Facility_Equipment;
        $failureInvestigation->Document_Details_Required = $request->Document_Details_Required;
      
        if ($request->failure_investigation_category == 'major' || $request->failure_investigation_category == 'minor' || $request->failure_investigation_category == 'critical') {
            $list = Helpers::getHeadoperationsUserList();
                    foreach ($list as $u) {
                        if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                            $email = Helpers::getInitiatorEmail($u->user_id);
                            if ($email !== null) {
                                 // Add this if statement
                                try {
                                    Mail::send(
                                        'mail.Categorymail',
                                        ['data' => $failureInvestigation],
                                        function ($message) use ($email) {
                                            $message->to($email)
                                                ->subject("Activity Performed By " . Auth::user()->name);
                                        }
                                    );
                                } catch (\Exception $e) {
                                    //log error
                                }

                            }
                        }
                    }
                }


                if ($request->failure_investigation_category == 'major' || $request->failure_investigation_category == 'minor' || $request->failure_investigation_category == 'critical') {
                    $list = Helpers::getCEOUserList();
                            foreach ($list as $u) {
                                if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                                    $email = Helpers::getInitiatorEmail($u->user_id);
                                    if ($email !== null) {
                                         // Add this if statement
                                         try {
                                                Mail::send(
                                                    'mail.Categorymail',
                                                    ['data' => $failureInvestigation],
                                                    function ($message) use ($email) {
                                                        $message->to($email)
                                                            ->subject("Activity Performed By " . Auth::user()->name);
                                                    }
                                                );
                                            } catch (\Exception $e) {
                                                //log error
                                            }

                                    }
                                }
                            }
                        }
                        if ($request->failure_investigation_category == 'major' || $request->failure_investigation_category == 'minor' || $request->failure_investigation_category == 'critical') {
                            $list = Helpers::getCorporateEHSHeadUserList();
                                    foreach ($list as $u) {
                                        if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                                            $email = Helpers::getInitiatorEmail($u->user_id);
                                            if ($email !== null) {
                                                 // Add this if statement
                                                 try {
                                                        Mail::send(
                                                            'mail.Categorymail',
                                                            ['data' => $failureInvestigation],
                                                            function ($message) use ($email) {
                                                                $message->to($email)
                                                                    ->subject("Activity Performed By " . Auth::user()->name);
                                                            }
                                                        );
                                                    } catch (\Exception $e) {
                                                        //log error
                                                    }

                                            }
                                        }
                                    }
                                }

                                if ($request->Post_Categorization == 'major' || $request->Post_Categorization == 'minor' || $request->Post_Categorization == 'critical') {
                                    $list = Helpers::getHeadoperationsUserList();
                                            foreach ($list as $u) {
                                                if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                                                    $email = Helpers::getInitiatorEmail($u->user_id);
                                                    if ($email !== null) {
                                                         // Add this if statement
                                                         try {
                                                            Mail::send(
                                                                'mail.Categorymail',
                                                                ['data' => $failureInvestigation],
                                                                function ($message) use ($email) {
                                                                    $message->to($email)
                                                                        ->subject("Activity Performed By " . Auth::user()->name);
                                                                }
                                                            );
                                                        } catch (\Exception $e) {
                                                            //log error
                                                        }

                                                    }
                                                }
                                            }
                                        }
                                        if ($request->Post_Categorization == 'major' || $request->Post_Categorization == 'minor' || $request->Post_Categorization == 'critical') {
                                            $list = Helpers::getCEOUserList();
                                                    foreach ($list as $u) {
                                                        if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                                                            $email = Helpers::getInitiatorEmail($u->user_id);
                                                            if ($email !== null) {
                                                                 // Add this if statement
                                                                 try {
                                                                        Mail::send(
                                                                            'mail.Categorymail',
                                                                            ['data' => $failureInvestigation],
                                                                            function ($message) use ($email) {
                                                                                $message->to($email)
                                                                                    ->subject("Activity Performed By " . Auth::user()->name);
                                                                            }
                                                                        );
                                                                    } catch (\Exception $e) {
                                                                        //log error
                                                                    }

                                                            }
                                                        }
                                                    }
                                                }
                                                if ($request->Post_Categorization == 'major' || $request->Post_Categorization == 'minor' || $request->Post_Categorization == 'critical') {
                                                    $list = Helpers::getCorporateEHSHeadUserList();
                                                            foreach ($list as $u) {
                                                                if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                                                                    $email = Helpers::getInitiatorEmail($u->user_id);
                                                                    if ($email !== null) {
                                                                         // Add this if statement
                                                                         try {
                                                                                Mail::send(
                                                                                    'mail.Categorymail',
                                                                                    ['data' => $failureInvestigation],
                                                                                    function ($message) use ($email) {
                                                                                        $message->to($email)
                                                                                            ->subject("Activity Performed By " . Auth::user()->name);
                                                                                    }
                                                                                );
                                                                            } catch (\Exception $e) {
                                                                                //log error
                                                                            }

                                                                    }
                                                                }
                                                            }
                                                        }

        if (!empty ($request->Audit_file)) {
            $files = [];
            if ($request->hasfile('Audit_file')) {
                foreach ($request->file('Audit_file') as $file) {
                    $name = $request->name . 'Audit_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $failureInvestigation->Audit_file = json_encode($files);
        }
        if (!empty ($request->initial_file)) {
            $files = [];
            if ($request->hasfile('initial_file')) {
                foreach ($request->file('initial_file') as $file) {
                    $name = $request->name . 'initial_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $failureInvestigation->initial_file = json_encode($files);
        }
        //dd($request->Initial_attachment);
        if (!empty ($request->Initial_attachment)) {
            $files = [];
            if ($request->hasfile('Initial_attachment')) {
                foreach ($request->file('Initial_attachment') as $file) {
                    $name = $request->name . 'Initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $failureInvestigation->Initial_attachment = json_encode($files);
        }

        if (!empty ($request->QA_attachment)) {
            $files = [];
            if ($request->hasfile('QA_attachment')) {
                foreach ($request->file('QA_attachment') as $file) {
                    $name = $request->name . 'QA_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $failureInvestigation->QA_attachment = json_encode($files);
        }
        if (!empty ($request->Investigation_attachment)) {
            $files = [];
            if ($request->hasfile('Investigation_attachment')) {
                foreach ($request->file('Investigation_attachment') as $file) {
                    $name = $request->name . 'Investigation_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $failureInvestigation->Investigation_attachment = json_encode($files);
        }
        if (!empty ($request->Capa_attachment)) {
            $files = [];
            if ($request->hasfile('Capa_attachment')) {
                foreach ($request->file('Capa_attachment') as $file) {
                    $name = $request->name . 'Capa_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $failureInvestigation->Capa_attachment = json_encode($files);
        }

        if (!empty ($request->QA_attachments)) {
            $files = [];
            if ($request->hasfile('QA_attachments')) {
                foreach ($request->file('QA_attachments') as $file) {
                    $name = $request->name . 'QA_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $failureInvestigation->QA_attachments = json_encode($files);
        }

        if (!empty ($request->closure_attachment)) {
            $files = [];
            if ($request->hasfile('closure_attachment')) {
                foreach ($request->file('closure_attachment') as $file) {
                    $name = $request->name . 'closure_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $failureInvestigation->closure_attachment = json_encode($files);
        }

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();



        $failureInvestigation->status = 'Opened';
        $failureInvestigation->stage = 1;

        $failureInvestigation->save();

        $teamInvestigationData = FailureInvestigationGridData::where(['failure_investigation_id' => $failureInvestigation->id, 'identifier' => "TeamInvestigation"])->firstOrCreate();
        $teamInvestigationData->failure_investigation_id = $failureInvestigation->id;
        $teamInvestigationData->identifier = "TeamInvestigation";
        $teamInvestigationData->data = $request->investigationTeam;
        $teamInvestigationData->save();

        $rootCauseData = FailureInvestigationGridData::where(['failure_investigation_id' => $failureInvestigation->id, 'identifier' => "RootCause"])->firstOrCreate();
        $rootCauseData->failure_investigation_id = $failureInvestigation->id;
        $rootCauseData->identifier = "RootCause";
        $rootCauseData->data = $request->rootCauseData;
        $rootCauseData->save();

        $newDataGridWhy = FailureInvestigationGridData::where(['failure_investigation_id' => $failureInvestigation->id, 'identifier' => 'why'])->firstOrCreate();
        $newDataGridWhy->failure_investigation_id = $failureInvestigation->id;
        $newDataGridWhy->identifier = 'why';
        $newDataGridWhy->data = $request->why;
        $newDataGridWhy->save();

        $newDataGridFishbone = FailureInvestigationGridData::where(['failure_investigation_id' => $failureInvestigation->id, 'identifier' => 'fishbone'])->firstOrCreate();
        $newDataGridFishbone->failure_investigation_id = $failureInvestigation->id;
        $newDataGridFishbone->identifier = 'fishbone';
        $newDataGridFishbone->data = $request->fishbone;
        $newDataGridFishbone->save();

        $data3 = new FailureInvestigationGrid();
        $data3->failure_investigation_grid_id = $failureInvestigation->id;
        $data3->type = "FailureInvestigation";
        if (!empty($request->facility_name)) {
            $data3->facility_name = serialize($request->facility_name);
        }
        if (!empty($request->IDnumber)) {
            $data3->IDnumber = serialize($request->IDnumber);
        }

        if (!empty($request->Remarks)) {
            $data3->Remarks = serialize($request->Remarks);
        }
        $data3->save();
        $data4 = new FailureInvestigationGrid();
        $data4->failure_investigation_grid_id = $failureInvestigation->id;
        $data4->type = "Document ";
        if (!empty($request->Number)) {
            $data4->Number = serialize($request->Number);
        }
        if (!empty($request->ReferenceDocumentName)) {
            $data4->ReferenceDocumentName = serialize($request->ReferenceDocumentName);
        }

        if (!empty($request->Document_Remarks)) {
            $data4->Document_Remarks = serialize($request->Document_Remarks);
        }
        $data4->save();

        $data5 = new FailureInvestigationGrid();
        $data5->failure_investigation_grid_id = $failureInvestigation->id;
        $data5->type = "Product ";
        if (!empty($request->product_name)) {
            $data5->product_name = serialize($request->product_name);
        }
        if (!empty($request->product_stage)) {
            $data5->product_stage = serialize($request->product_stage);
        }

        if (!empty($request->batch_no)) {
            $data5->batch_no = serialize($request->batch_no);
        }
        $data5->save();



        $Cft = new FailureInvestigationCft();
        $Cft->failure_investigation_id = $failureInvestigation->id;
        $Cft->RA_Review = $request->RA_Review;
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

            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = Auth::user()->name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current = $failureInvestigation->due_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = "Null";
            $history->current = Carbon::now()->format('d-M-Y');
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

        if (!empty ($request->short_description)){
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $failureInvestigation->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty ($request->Initiator_Group)){
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Department';
            $history->previous = "Null";
            $history->current = $failureInvestigation->Initiator_Group;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->failure_investigation_date)){
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Failure Investigation Observed';
            $history->previous = "Null";
            $history->current = $failureInvestigation->failure_investigation_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (is_array($request->Facility) && $request->Facility[0] !== null){
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Observed by';
            $history->previous = "Null";
            $history->current = $failureInvestigation->Facility;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->failure_investigation_reported_date)){
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Failure Investigation Reported on';
            $history->previous = "Null";
            $history->current = $failureInvestigation->failure_investigation_reported_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if ($request->audit_type[0] !== null){
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Failure Investigation Related To';
            $history->previous = "Null";
            $history->current = $failureInvestigation->audit_type;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->others)){
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Others';
            $history->previous = "Null";
            $history->current = $failureInvestigation->others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->action_name = 'Create';
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->save();
        }
        if (!empty ($request->Facility_Equipment)){
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Facility/ Equipment/ Instrument/ System Details Required?';
            $history->previous = "Null";
            $history->current = $failureInvestigation->Facility_Equipment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Document_Details_Required)){
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Document Details Required';
            $history->previous = "Null";
            $history->current = $failureInvestigation->Document_Details_Required;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Product_Batch)){
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Name of Product & Batch No';
            $history->previous = "Null";
            $history->current = $failureInvestigation->Product_Batch;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if ($request->Description_failure_investigation[0] !== null){
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Description of Failure Investigation';
            $history->previous = "Null";
            $history->current = $failureInvestigation->Description_failure_investigation;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if ($request->Immediate_Action[0] !== null){
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Immediate Action (if any)';
            $history->previous = "Null";
            $history->current = $failureInvestigation->Immediate_Action;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if ($request->Preliminary_Impact[0] !== null){
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $failureInvestigation->id;
            $history->activity_type = 'Preliminary Impact of Failure Investigation';
            $history->previous = "Null";
            $history->current = $failureInvestigation->Preliminary_Impact;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->action_name = 'Create';
            $history->save();
        }

        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }

    public function show($id)
    {
        $old_record = FailureInvestigation::select('id', 'division_id', 'record')->get();
        $data = FailureInvestigation::find($id);
        $userData = User::all();
        $data1 = FailureInvestigationCft::where('failure_investigation_id', $id)->latest()->first();
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $grid_data = FailureInvestigationGrid::where('failure_investigation_grid_id', $id)->where('type', "FailureInvestigation")->first();
        $grid_data1 = FailureInvestigationGrid::where('failure_investigation_grid_id', $id)->where('type', "Document")->first();
        $grid_data2 = FailureInvestigationGrid::where('failure_investigation_grid_id', $id)->where('type', "Product")->first();
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $pre = FailureInvestigation::all();
        $divisionName = DB::table('q_m_s_divisions')->where('id', $data->division_id)->value('name');

        $investigationTeam = FailureInvestigationGridData::where(['failure_investigation_id' => $id, 'identifier' => 'TeamInvestigation'])->first();
        $investigationTeamData = json_decode($investigationTeam->data, true);

        $rootCause = FailureInvestigationGridData::where(['failure_investigation_id' => $id, 'identifier' => 'RootCause'])->first();
        $rootCauseData = json_decode($rootCause->data, true);

        $whyData = FailureInvestigationGridData::where(['failure_investigation_id' => $id, 'identifier' => 'why'])->first();
        $why_data = json_decode($whyData->data, true);
  
        $fishbone = FailureInvestigationGridData::where(['failure_investigation_id' => $id, 'identifier' => 'fishbone'])->first();
        $fishbone_data = json_decode($fishbone->data, true);

        $grid_data_qrms = FailureInvestigationGridFailureMode::where(['failure_investigation_id' => $id, 'identifier' => 'failure_mode_qrms'])->first();
        $grid_data_matrix_qrms = FailureInvestigationGridFailureMode::where(['failure_investigation_id' => $id, 'identifier' => 'matrix_qrms'])->first();

        $capaExtension = FailureInvestigationLaunchExtension::where(['failure_investigation_id' => $id, "extension_identifier" => "Capa"])->first();
        $qrmExtension = FailureInvestigationLaunchExtension::where(['failure_investigation_id' => $id, "extension_identifier" => "QRM"])->first();
        $investigationExtension = FailureInvestigationLaunchExtension::where(['failure_investigation_id' => $id, "extension_identifier" => "Investigation"])->first();
        $failureInvestigationExtension = FailureInvestigationLaunchExtension::where(['failure_investigation_id' => $id, "extension_identifier" => "FailureInvestigation"])->first();

        return view('frontend.failure-investigation.failure-inv-view', compact('data','userData', 'grid_data_qrms','grid_data_matrix_qrms', 'capaExtension','qrmExtension','investigationExtension','failureInvestigationExtension', 'old_record', 'pre', 'data1', 'divisionName','grid_data','grid_data1','grid_data2','investigationTeamData','rootCauseData', 'why_data', 'fishbone_data'));
    }

    public function update(Request $request,$id)
    {
        $form_progress = null;
        
        $lastFailureInvestigation = FailureInvestigation::find($id);
        $failureInvestigation = FailureInvestigation::find($id);
        $lastCft = FailureInvestigationCft::where('failure_investigation_id', $failureInvestigation->id)->first();
        $failureInvestigation->Delay_Justification = $request->Delay_Justification;

        if ($request->failure_investigation_category == 'major' || $request->failure_investigation_category == 'critical')
        {
            $failureInvestigation->Investigation_required = "yes";
            $failureInvestigation->capa_required = "yes";
            $failureInvestigation->qrm_required = "yes";
        }

        if ($request->failure_investigation_category == 'minor')
        {
            $failureInvestigation->Investigation_required = $request->Investigation_required;
            $failureInvestigation->capa_required = $request->capa_required;
            $failureInvestigation->qrm_required = $request->qrm_required;
        }

        if ($request->form_name == 'general-open')
        {

            // dd($request->Delay_Justification);
            $validator = Validator::make($request->all(), [
                'Initiator_Group' => 'required',
                'short_description' => 'required',
                'short_description_required' => 'required|in:Recurring,Non_Recurring',
                'nature_of_repeat' => 'required_if:short_description_required,Recurring',
                'failure_investigation_date' => 'required',
                'failure_investigation_time' => 'required',
                'failure_investigation_reported_date' => 'required',
                'Delay_Justification' => [
                    function ($attribute, $value, $fail) use ($request) {
                        $failureInvestigation_date = Carbon::parse($request->failure_investigation_date);
                        $reported_date = Carbon::parse($request->failure_investigation_reported_date);
                        $diff_in_days = $reported_date->diffInDays($failureInvestigation_date);
                        if ($diff_in_days !== 0) {
                            if(!$request->Delay_Justification){
                                $fail('The Delay Justification is required!');
                            }
                        }
                    },
                ],
                'audit_type' => [
                    'required',
                    'array',
                    function($attribute, $value, $fail) {
                        if (count($value) === 1 && reset($value) === null) {
                            return $fail($attribute.' must not contain only null values.');
                        }
                    },
                ],
                'Facility_Equipment' => 'required|in:yes,no',
                'facility_name' => [
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->input('Facility_Equipment') === 'yes' && (count($value) === 1 && reset($value) === null)) {
                            $fail('The Facility name is required when Facility Equipment is yes.');
                        }
                    },
                ],
                'IDnumber' => [
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->input('Facility_Equipment') === 'yes' && (count($value) === 1 && reset($value) === null)) {
                            $fail('The ID Number field is required when Facility Equipment is yes.');
                        }
                    },
                ],
                'Document_Details_Required' => 'required|in:yes,no',
                'Product_Details_Required' => 'required|in:yes,no',
                'Number' => [
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->input('Document_Details_Required') === 'yes' && (count($value) === 1 && reset($value) === null)) {
                            $fail('The Document Number field is required when Document Details Required is yes.');
                        }
                    },
                ],
                'ReferenceDocumentName' => [
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->input('Document_Details_Required') === 'yes' && (count($value) === 1 && reset($value) === null)) {
                            $fail('The Referrence Document Number field is required when Document Details Required is yes.');
                        }
                    },
                ],
                // 'Description_failure_investigation' => [
                //     'required',
                //     'array',
                //     function($attribute, $value, $fail) {
                //         if (count($value) === 1 && reset($value) === null) {
                //             return $fail('Description of Failure Investigation must not be empty!.');
                //         }
                //     },
                // ],
                'Immediate_Action' => [
                    'required',
                    'array',
                    function($attribute, $value, $fail) {
                        if (count($value) === 1 && reset($value) === null) {
                            return $fail('Immediate Action field must not be empty!.');
                        }
                    },
                ],
                'Preliminary_Impact' => [
                    'required',
                    'array',
                    function($attribute, $value, $fail) {
                        if (count($value) === 1 && reset($value) === null) {
                            return $fail('Preliminary Impact field must not be empty!.');
                        }
                    },
                ],
            ], [
                'short_description_required.required' => 'Nature of Repeat required!',
                'nature_of_repeat.required' =>  'The nature of repeat field is required when nature of repeat is Recurring.',
                'audit_type' => 'Failure Investigation related to field required!'
            ]);

            $validator->sometimes('others', 'required|string|min:1', function ($input) {
                return in_array('Anyother(specify)', explode(',', $input->audit_type[0]));
            });

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $form_progress = 'general-open';
            }
        }
        if ($request->form_name == 'qa')
        {
            $validator = Validator::make($request->all(), [
                'failure_investigation_category' => 'required|not_in:0',
                'Justification_for_categorization' => 'required',

                // 'Investigation_required' => 'required|in:yes,no|not_in:0',
                // 'capa_required' => 'required|in:yes,no|not_in:0',
                // 'qrm_required' => 'required|in:yes,no|not_in:0',
                'Investigation_Details' => 'required_if:Investigation_required,yes',
                'QAInitialRemark' => 'required'
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $form_progress = 'qa';
            }
        }

        if ($request->form_name == 'capa')
        {

            // ============ capa ======================
        if ($request->form_name == 'capa')
        {
            if($request->source_doc!=""){
                $failureInvestigation->capa_number = $request->capa_number ? $request->capa_number : $failureInvestigation->capa_number;
                $failureInvestigation->department_capa = $request->department_capa ? $request->department_capa : $failureInvestigation->department_capa;
                $failureInvestigation->source_of_capa = $request->source_of_capa ? $request->source_of_capa : $failureInvestigation->source_of_capa;
                $failureInvestigation->capa_others = $request->capa_others ? $request->capa_others : $failureInvestigation->capa_others;
                $failureInvestigation->source_doc = $request->source_doc ? $request->source_doc : $failureInvestigation->source_doc;
                $failureInvestigation->Description_of_Discrepancy = $request->Description_of_Discrepancy ? $request->Description_of_Discrepancy : $failureInvestigation->Description_of_Discrepancy;
                $failureInvestigation->capa_root_cause = $request->capa_root_cause ? $request->capa_root_cause : $failureInvestigation->capa_root_cause;
                $failureInvestigation->Immediate_Action_Take = $request->Immediate_Action_Take ? $request->Immediate_Action_Take : $failureInvestigation->Immediate_Action_Take;
                $failureInvestigation->Corrective_Action_Details = $request->Corrective_Action_Details ? $request->Corrective_Action_Details : $failureInvestigation->Corrective_Action_Details;
                $failureInvestigation->Preventive_Action_Details = $request->Preventive_Action_Details ? $request->Preventive_Action_Details : $failureInvestigation->Preventive_Action_Details;
                $failureInvestigation->capa_completed_date = $request->capa_completed_date ? $request->capa_completed_date : $failureInvestigation->capa_completed_date;
                $failureInvestigation->Interim_Control = $request->Interim_Control ? $request->Interim_Control : $failureInvestigation->Interim_Control;
                $failureInvestigation->Corrective_Action_Taken = $request->Corrective_Action_Taken ? $request->Corrective_Action_Taken : $failureInvestigation->Corrective_Action_Taken;
                $failureInvestigation->Preventive_action_Taken = $request->Preventive_action_Taken ? $request->Preventive_action_Taken : $failureInvestigation->Preventive_action_Taken;
                $failureInvestigation->CAPA_Closure_Comments = $request->CAPA_Closure_Comments ? $request->CAPA_Closure_Comments : $failureInvestigation->CAPA_Closure_Comments;

                 if (!empty ($request->CAPA_Closure_attachment)) {
                    $files = [];
                    if ($request->hasfile('CAPA_Closure_attachment')) {

                        foreach ($request->file('CAPA_Closure_attachment') as $file) {
                            $name = 'capa_closure_attachment-' . time() . '.' . $file->getClientOriginalExtension();
                            $file->move('upload/', $name);
                            $files[] = $name;
                        }
                    }
                    $failureInvestigation->CAPA_Closure_attachment = json_encode($files);

                }
                $failureInvestigation->update();
                toastr()->success('Document Sent');
                return back();
                }


                $validator = Validator::make($request->all(), [
                    'capa_root_cause' => 'required',
                    'CAPA_Rquired' => 'required|in:yes,no|not_in:0',
                    'Post_Categorization' => 'required',
                    'capa_type' => [
                        'required_if:CAPA_Rquired,yes',
                        function ($attribute, $value, $fail) use ($request) {
                            if ($value === '0' && $request->CAPA_Rquired == 'yes') {
                                $fail('The capa type field is required when CAPA required is set to yes.');
                            }
                        }
                    ],
                    'CAPA_Description' => 'required_if:CAPA_Rquired,yes',
                ],  [
                    'CAPA_Rquired.required' => 'Capa required field cannot be empty!',
                ]);

                if ($validator->fails()) {
                    return back()
                        ->withErrors($validator)
                        ->withInput();
                } else {
                    $form_progress = 'capa';
                }

            }



        }

        if ($request->form_name == 'qa-final')
        {
            $form_progress = 'capa';
        }

        if ($request->form_name == 'qah')
        {
            $validator = Validator::make($request->all(), [
                'Closure_Comments' => 'required',
                'Disposition_Batch' => 'required',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $form_progress = 'qah';
            }
        }

        $failureInvestigation->assign_to = $request->assign_to;
        $failureInvestigation->Initiator_Group = $request->Initiator_Group;

        if ($failureInvestigation->stage < 3) {
            $failureInvestigation->short_description = $request->short_description;
        } else {
            $failureInvestigation->short_description = $failureInvestigation->short_description;
        }
        $failureInvestigation->initiator_group_code = $request->initiator_group_code;
        $failureInvestigation->failure_investigation_reported_date = $request->failure_investigation_reported_date;
        $failureInvestigation->failure_investigation_date = $request->failure_investigation_date;
        $failureInvestigation->failure_investigation_time = $request->failure_investigation_time;
        $failureInvestigation->Delay_Justification = $request->Delay_Justification;
        // $failureInvestigation->audit_type = implode(',', $request->audit_type);
        if (is_array($request->audit_type)) {
            $failureInvestigation->audit_type = implode(',', $request->audit_type);
        }
        $failureInvestigation->short_description_required = $request->short_description_required;
        $failureInvestigation->nature_of_repeat = $request->nature_of_repeat;
        $failureInvestigation->others = $request->others;
        $failureInvestigation->Product_Batch = $request->Product_Batch;

        $failureInvestigation->Description_failure_investigation = $request->Description_failure_investigation;
        if ($request->related_records) {
            $failureInvestigation->Related_Records1 =  implode(',', $request->related_records);
        }
        $failureInvestigation->Facility = $request->Facility;


        $failureInvestigation->Immediate_Action = implode(',', $request->Immediate_Action);
        $failureInvestigation->Preliminary_Impact = implode(',', $request->Preliminary_Impact);
        $failureInvestigation->Product_Details_Required = $request->Product_Details_Required;


        $failureInvestigation->HOD_Remarks = $request->HOD_Remarks;
        $failureInvestigation->Justification_for_categorization = !empty($request->Justification_for_categorization) ? $request->Justification_for_categorization : $failureInvestigation->Justification_for_categorization;

        $failureInvestigation->Investigation_Details = !empty($request->Investigation_Details) ? $request->Investigation_Details : $failureInvestigation->Investigation_Details;

        $failureInvestigation->QAInitialRemark = $request->QAInitialRemark;
        $failureInvestigation->Investigation_Summary = $request->Investigation_Summary;
        $failureInvestigation->Impact_assessment = $request->Impact_assessment;
        $failureInvestigation->Root_cause = $request->Root_cause;

        $failureInvestigation->Conclusion = $request->Conclusion;
        $failureInvestigation->Identified_Risk = $request->Identified_Risk;
        $failureInvestigation->severity_rate = $request->severity_rate ? $request->severity_rate : $failureInvestigation->severity_rate;
        $failureInvestigation->Occurrence = $request->Occurrence ? $request->Occurrence : $failureInvestigation->Occurrence;
        $failureInvestigation->detection = $request->detection ? $request->detection: $failureInvestigation->detection;

        $newDataGridqrms = FailureInvestigationGridFailureMode::where(['failure_investigation_id' => $id, 'identifier' =>
        'failure_mode_qrms'])->firstOrCreate();
        $newDataGridqrms->failure_investigation_id = $id;
        $newDataGridqrms->identifier = 'failure_mode_qrms';
        $newDataGridqrms->data = $request->failure_mode_qrms;
        $newDataGridqrms->save();

        $matrixDataGridqrms = FailureInvestigationGridFailureMode::where(['failure_investigation_id' => $id, 'identifier' => 'matrix_qrms'])->firstOrCreate();
        $matrixDataGridqrms->failure_investigation_id = $id;
        $matrixDataGridqrms->identifier = 'matrix_qrms';
        $matrixDataGridqrms->data = $request->matrix_qrms;
        $matrixDataGridqrms->save();

        if ($failureInvestigation->stage < 6) {
            $failureInvestigation->CAPA_Rquired = $request->CAPA_Rquired;
        }

        if ($failureInvestigation->stage < 6) {
            $failureInvestigation->capa_type = $request->capa_type;
        }

        $failureInvestigation->CAPA_Description = !empty($request->CAPA_Description) ? $request->CAPA_Description : $failureInvestigation->CAPA_Description;
        $failureInvestigation->Post_Categorization = !empty($request->Post_Categorization) ? $request->Post_Categorization : $failureInvestigation->Post_Categorization;
        $failureInvestigation->Investigation_Of_Review = $request->Investigation_Of_Review;
        $failureInvestigation->QA_Feedbacks = $request->has('QA_Feedbacks') ? $request->QA_Feedbacks : $failureInvestigation->QA_Feedbacks;
        $failureInvestigation->Closure_Comments = $request->Closure_Comments;
        $failureInvestigation->Disposition_Batch = $request->Disposition_Batch;
        $failureInvestigation->Facility_Equipment = $request->Facility_Equipment;
        $failureInvestigation->Document_Details_Required = $request->Document_Details_Required;

        if ($failureInvestigation->stage == 3)
        {
            $failureInvestigation->Customer_notification = $request->Customer_notification;
            // $failureInvestigation->Investigation_required = $request->Investigation_required;
            // $failureInvestigation->capa_required = $request->capa_required;
            // $failureInvestigation->qrm_required = $request->qrm_required;
            $failureInvestigation->failure_investigation_category = $request->failure_investigation_category;
            $failureInvestigation->QAInitialRemark = $request->QAInitialRemark;
            // $failureInvestigation->customers = $request->customers;
        }

        if($failureInvestigation->stage == 3 || $failureInvestigation->stage == 4 ){


            if (!$form_progress) {
                $form_progress = 'cft';
            }

            $Cft = FailureInvestigationCft::withoutTrashed()->where('failure_investigation_id', $id)->first();
            if($Cft && $failureInvestigation->stage == 4 ){
                $Cft->RA_Review = $request->RA_Review == null ? $Cft->RA_Review : $request->RA_Review;
                $Cft->RA_person = $request->RA_person == null ? $Cft->RA_person : $request->RA_person;

                $Cft->Production_Injection_Person = $request->Production_Injection_Person == null ? $Cft->Production_Injection_Person : $request->Production_Injection_Person;
                $Cft->Production_Injection_Review = $request->Production_Injection_Review == null ? $Cft->Production_Injection_Review : $request->Production_Injection_Review;

                $Cft->Production_Table_Person = $request->Production_Table_Person == null ? $Cft->Production_Table_Person : $request->Production_Table_Person;
                $Cft->Production_Table_Review = $request->Production_Table_Review == null ? $Cft->Production_Table_Review : $request->Production_Table_Review;
                
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
                $IsCFTRequired = FailureInvestigationCftResponse::withoutTrashed()->where(['is_required' => 1, 'failure_investigation_id' => $id])->latest()->first();
                $cftUsers = DB::table('failure_investigation_cfts')->where(['failure_investigation_id' => $id])->first();
                // Define the column names
                $columns = ['Production_person', 'Warehouse_notification', 'Quality_Control_Person', 'QualityAssurance_person', 'Engineering_person', 'Analytical_Development_person', 'Kilo_Lab_person', 'Technology_transfer_person', 'Environment_Health_Safety_person', 'Human_Resource_person', 'Information_Technology_person', 'Project_management_person','Other1_person','Other2_person','Other3_person','Other4_person','Other5_person'];

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
                                    ['data' => $failureInvestigation],
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

                if ($failureInvestigation->Initial_attachment) {
                    $files = is_array(json_decode($failureInvestigation->Initial_attachment)) ? $failureInvestigation->Initial_attachment : [];
                }

                if ($request->hasfile('Initial_attachment')) {
                    foreach ($request->file('Initial_attachment') as $file) {
                        $name = $request->name . 'Initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }


                $failureInvestigation->Initial_attachment = json_encode($files);
            }
        }



        if (!empty ($request->Audit_file)) {

            $files = [];

            if ($failureInvestigation->Audit_file) {
                $existingFiles = json_decode($failureInvestigation->Audit_file, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($failureInvestigation->Audit_file)) ? $failureInvestigation->Audit_file : [];
            }

            if ($request->hasfile('Audit_file')) {
                foreach ($request->file('Audit_file') as $file) {
                    $name = $request->name . 'Audit_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $failureInvestigation->Audit_file = json_encode($files);
        }
        if (!empty($request->initial_file)) {
            $files = [];

            // Decode existing files if they exist
            if ($failureInvestigation->initial_file) {
                $existingFiles = json_decode($failureInvestigation->initial_file, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
            }

            // Process and add new files
            if ($request->hasfile('initial_file')) {
                foreach ($request->file('initial_file') as $file) {
                    $name = $request->name . 'initial_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            // Encode the files array and update the model
            $failureInvestigation->initial_file = json_encode($files);
        }

        if (!empty ($request->QA_attachment)) {
            $files = [];

            if ($failureInvestigation->QA_attachment) {
                $existingFiles = json_decode($failureInvestigation->QA_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($failureInvestigation->QA_attachment)) ? $failureInvestigation->QA_attachment : [];
            }

            if ($request->hasfile('QA_attachment')) {
                foreach ($request->file('QA_attachment') as $file) {
                    $name = $request->name . 'QA_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $failureInvestigation->QA_attachment = json_encode($files);
        }

        if (!empty ($request->Investigation_attachment)) {

            $files = [];

            if ($failureInvestigation->Investigation_attachment) {
                $existingFiles = json_decode($failureInvestigation->Investigation_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($failureInvestigation->QA_attachment)) ? $failureInvestigation->QA_attachment : [];
            }

            if ($request->hasfile('Investigation_attachment')) {
                foreach ($request->file('Investigation_attachment') as $file) {
                    $name = $request->name . 'Investigation_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $failureInvestigation->Investigation_attachment = json_encode($files);
        }

        if (!empty ($request->Capa_attachment)) {

            $files = [];

            if ($failureInvestigation->Capa_attachment) {
                $existingFiles = json_decode($failureInvestigation->Capa_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($failureInvestigation->Capa_attachment)) ? $failureInvestigation->Capa_attachment : [];
            }

            if ($request->hasfile('Capa_attachment')) {
                foreach ($request->file('Capa_attachment') as $file) {
                    $name = $request->name . 'Capa_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $failureInvestigation->Capa_attachment = json_encode($files);
        }
        if (!empty ($request->QA_attachments)) {

            $files = [];

            if ($failureInvestigation->QA_attachments) {
                $files = is_array(json_decode($failureInvestigation->QA_attachments)) ? $failureInvestigation->QA_attachments : [];
            }

            if ($request->hasfile('QA_attachments')) {
                foreach ($request->file('QA_attachments') as $file) {
                    $name = $request->name . 'QA_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $failureInvestigation->QA_attachments = json_encode($files);
        }

        if (!empty ($request->closure_attachment)) {

            $files = [];

            if ($failureInvestigation->closure_attachment) {
                $existingFiles = json_decode($failureInvestigation->closure_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($failureInvestigation->closure_attachment)) ? $failureInvestigation->closure_attachment : [];
            }

            if ($request->hasfile('closure_attachment')) {
                foreach ($request->file('closure_attachment') as $file) {
                    $name = $request->name . 'closure_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $failureInvestigation->closure_attachment = json_encode($files);
        }
        if($failureInvestigation->stage > 0){


            //investiocation dynamic
            $failureInvestigation->Discription_Event = $request->Discription_Event;
            $failureInvestigation->objective = $request->objective;
            $failureInvestigation->scope = $request->scope;
            $failureInvestigation->imidiate_action = $request->imidiate_action;
            $failureInvestigation->investigation_approach = is_array($request->investigation_approach) ? implode(',', $request->investigation_approach) : '';
            $failureInvestigation->attention_issues = $request->attention_issues;
            $failureInvestigation->attention_actions = $request->attention_actions;
            $failureInvestigation->attention_remarks = $request->attention_remarks;
            $failureInvestigation->understanding_issues = $request->understanding_issues;
            $failureInvestigation->understanding_actions = $request->understanding_actions;
            $failureInvestigation->understanding_remarks = $request->understanding_remarks;
            $failureInvestigation->procedural_issues = $request->procedural_issues;
            $failureInvestigation->procedural_actions = $request->procedural_actions;
            $failureInvestigation->procedural_remarks = $request->procedural_remarks;
            $failureInvestigation->behavioiral_issues = $request->behavioiral_issues;
            $failureInvestigation->behavioiral_actions = $request->behavioiral_actions;
            $failureInvestigation->behavioiral_remarks = $request->behavioiral_remarks;
            $failureInvestigation->skill_issues = $request->skill_issues;
            $failureInvestigation->skill_actions = $request->skill_actions;
            $failureInvestigation->skill_remarks = $request->skill_remarks;
            $failureInvestigation->what_will_be = $request->what_will_be;
            $failureInvestigation->what_will_not_be = $request->what_will_not_be;
            $failureInvestigation->what_rationable = $request->what_rationable;
            $failureInvestigation->where_will_be = $request->where_will_be;
            $failureInvestigation->where_will_not_be = $request->where_will_not_be;
            $failureInvestigation->where_rationable = $request->where_rationable;
            $failureInvestigation->when_will_not_be = $request->when_will_not_be;
            $failureInvestigation->when_will_be = $request->when_will_be;
            $failureInvestigation->when_rationable = $request->when_rationable;
            $failureInvestigation->coverage_will_be = $request->coverage_will_be;
            $failureInvestigation->coverage_will_not_be = $request->coverage_will_not_be;
            $failureInvestigation->coverage_rationable = $request->coverage_rationable;
            $failureInvestigation->who_will_be = $request->who_will_be;
            $failureInvestigation->who_will_not_be = $request->who_will_not_be;
            $failureInvestigation->who_rationable = $request->who_rationable;

            $teamInvestigationData = FailureInvestigationGridData::where(['failure_investigation_id' => $id, 'identifier' => "TeamInvestigation"])->firstOrCreate();
            $teamInvestigationData->failure_investigation_id = $failureInvestigation->id;
            $teamInvestigationData->identifier = "TeamInvestigation";
            $teamInvestigationData->data = $request->investigationTeam;
            $teamInvestigationData->update();

            $rootCauseData = FailureInvestigationGridData::where(['failure_investigation_id' => $id, 'identifier' => "RootCause"])->firstOrCreate();
            $rootCauseData->failure_investigation_id = $failureInvestigation->id;
            $rootCauseData->identifier = "RootCause";
            $rootCauseData->data = $request->rootCauseData;
            $rootCauseData->update();

            $newDataGridWhy = FailureInvestigationGridData::where(['failure_investigation_id' => $id, 'identifier' => 'why'])->firstOrCreate();
            $newDataGridWhy->failure_investigation_id = $id;
            $newDataGridWhy->identifier = 'why';
            $newDataGridWhy->data = $request->why;
            $newDataGridWhy->save();

            $newDataGridFishbone = FailureInvestigationGridData::where(['failure_investigation_id' => $id, 'identifier' => 'fishbone'])->firstOrCreate();
            $newDataGridFishbone->failure_investigation_id = $id;
            $newDataGridFishbone->identifier = 'fishbone';
            $newDataGridFishbone->data = $request->fishbone;
            $newDataGridFishbone->save();
            
        }


        $failureInvestigation->form_progress = isset($form_progress) ? $form_progress : null;
        $failureInvestigation->update();
        // grid
         $data3=FailureInvestigationGrid::where('failure_investigation_grid_id', $failureInvestigation->id)->where('type', "FailureInvestigation")->first();
                if (!empty($request->IDnumber)) {
                    $data3->IDnumber = serialize($request->IDnumber);
                }
                if (!empty($request->facility_name)) {
                    $data3->facility_name = serialize($request->facility_name);
                }

                if (!empty($request->Remarks)) {
                    $data3->Remarks = serialize($request->Remarks);
                }

                $data3->update();
                // dd($request->Remarks);


            $data4=FailureInvestigationGrid::where('failure_investigation_grid_id', $failureInvestigation->id)->where('type', "Document")->first();
            if (!empty($request->Number)) {
                $data4->Number = serialize($request->Number);
            }
            if (!empty($request->ReferenceDocumentName)) {
                $data4->ReferenceDocumentName = serialize($request->ReferenceDocumentName);
            }

            if (!empty($request->Document_Remarks)) {
                $data4->Document_Remarks = serialize($request->Document_Remarks);
            }
            $data4->update();

            $data5=FailureInvestigationGrid::where('failure_investigation_grid_id', $failureInvestigation->id)->where('type', "Product")->first();
            if (!empty($request->product_name)) {
                $data5->product_name = serialize($request->product_name);
            }
            if (!empty($request->product_stage)) {
                $data5->product_stage = serialize($request->product_stage);
            }

            if (!empty($request->batch_no)) {
                $data5->batch_no = serialize($request->batch_no);
            }
            $data5->update();


        if ($lastFailureInvestigation->short_description != $failureInvestigation->short_description || !empty ($request->comment)) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Short Description';
             $history->previous = $lastFailureInvestigation->short_description;
            $history->current = $failureInvestigation->short_description;
            $history->comment = $failureInvestigation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastFailureInvestigation->Initiator_Group != $failureInvestigation->Initiator_Group || !empty ($request->comment)) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Initiator Group';
            $history->previous = $lastFailureInvestigation->Initiator_Group;
            $history->current = $failureInvestigation->Initiator_Group;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->failure_investigation_date != $failureInvestigation->failure_investigation_date || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Failure Investigation Observed';
            $history->previous = $lastFailureInvestigation->failure_investigation_date;
            $history->current = $failureInvestigation->failure_investigation_date;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Observed_by != $failureInvestigation->Observed_by || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Observed by';
            $history->previous = $lastFailureInvestigation->Observed_by;
            $history->current = $failureInvestigation->Observed_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->failure_investigation_reported_date != $failureInvestigation->failure_investigation_reported_date || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Failure Investigation Reported on';
            $history->previous = $lastFailureInvestigation->failure_investigation_reported_date;
            $history->current = $failureInvestigation->failure_investigation_reported_date;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->audit_type != $failureInvestigation->audit_type || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Failure Investigation Related To';
            $history->previous = $lastFailureInvestigation->audit_type;
            $history->current = $failureInvestigation->audit_type;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Others != $failureInvestigation->Others || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Others';
            $history->previous = $lastFailureInvestigation->Others;
            $history->current = $failureInvestigation->Others;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Facility_Equipment != $failureInvestigation->Facility_Equipment || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Facility/ Equipment/ Instrument/ System Details Required?';
            $history->previous = $lastFailureInvestigation->Facility_Equipment;
            $history->current = $failureInvestigation->Facility_Equipment;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Document_Details_Required != $failureInvestigation->Document_Details_Required || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Document Details Required';
            $history->previous = $lastFailureInvestigation->Document_Details_Required;
            $history->current = $failureInvestigation->Document_Details_Required;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Product_Batch != $failureInvestigation->Product_Batch || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Name of Product & Batch No';
            $history->previous = $lastFailureInvestigation->Product_Batch;
            $history->current = $failureInvestigation->Product_Batch;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Description_failure_investigation != $failureInvestigation->Description_failure_investigation || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Description of Failure Investigation';
            $history->previous = $lastFailureInvestigation->Description_failure_investigation;
            $history->current = $failureInvestigation->Description_failure_investigation;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Immediate_Action != $failureInvestigation->Immediate_Action || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Immediate Action (if any)';
            $history->previous = $lastFailureInvestigation->Immediate_Action;
            $history->current = $failureInvestigation->Immediate_Action;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Preliminary_Impact != $failureInvestigation->Preliminary_Impact || !empty ($request->comment)) {           
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Preliminary Impact of Failure Investigation';
            $history->previous = $lastFailureInvestigation->Preliminary_Impact;
            $history->current = $failureInvestigation->Preliminary_Impact;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->HOD_Remarks != $failureInvestigation->HOD_Remarks || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'HOD Remarks';
            $history->previous = $lastFailureInvestigation->HOD_Remarks;
            $history->current = $failureInvestigation->HOD_Remarks;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->failure_investigation_category != $failureInvestigation->failure_investigation_category || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Initial Failure Investigation Category';
            $history->previous = $lastFailureInvestigation->failure_investigation_category;
            $history->current = $failureInvestigation->failure_investigation_category;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Justification_for_categorization != $failureInvestigation->Justification_for_categorization || !empty ($request->comment)) {           
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Justification for Categorization';
            $history->previous = $lastFailureInvestigation->Justification_for_categorization;
            $history->current = $failureInvestigation->Justification_for_categorization;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Investigation_required != $failureInvestigation->Investigation_required || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Investigation Is required ?';
            $history->previous = $lastFailureInvestigation->Investigation_required;
            $history->current = $failureInvestigation->Investigation_required;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Investigation_Details != $failureInvestigation->Investigation_Details || !empty ($request->comment)) {           
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Investigation Details';
            $history->previous = $lastFailureInvestigation->Investigation_Details;
            $history->current = $failureInvestigation->Investigation_Details;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Customer_notification != $failureInvestigation->Customer_notification || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Customer Notification Required ?';
            $history->previous = $lastFailureInvestigation->Customer_notification;
            $history->current = $failureInvestigation->Customer_notification;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->customers != $failureInvestigation->customers || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Customer';
            $history->previous = $lastFailureInvestigation->customers;
            $history->current = $failureInvestigation->customers;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->QAInitialRemark != $failureInvestigation->QAInitialRemark || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'QA Initial Remarks';
            $history->previous = $lastFailureInvestigation->QAInitialRemark;
            $history->current = $failureInvestigation->QAInitialRemark;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Investigation_Summary != $failureInvestigation->Investigation_Summary || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Investigation Summary';
            $history->previous = $lastFailureInvestigation->Investigation_Summary;
            $history->current = $failureInvestigation->Investigation_Summary;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->save();
        }

        if ($lastFailureInvestigation->Impact_assessment != $failureInvestigation->Impact_assessment || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Impact Assessment';
            $history->previous = $lastFailureInvestigation->Impact_assessment;
            $history->current = $failureInvestigation->Impact_assessment;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Root_cause != $failureInvestigation->Root_cause || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Root Cause';
            $history->previous = $lastFailureInvestigation->Root_cause;
            $history->current = $failureInvestigation->Root_cause;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->CAPA_Rquired != $failureInvestigation->CAPA_Rquired || !empty ($request->comment)) {
                        $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'CAPA Required ?';
            $history->previous = $lastFailureInvestigation->CAPA_Rquired;
            $history->current = $failureInvestigation->CAPA_Rquired;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->capa_type != $failureInvestigation->capa_type || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'CAPA Type?';
            $history->previous = $lastFailureInvestigation->capa_type;
            $history->current = $failureInvestigation->capa_type;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->CAPA_Description != $failureInvestigation->CAPA_Description || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'CAPA Description';
            $history->previous = $lastFailureInvestigation->CAPA_Description;
            $history->current = $failureInvestigation->CAPA_Description;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Post_Categorization != $failureInvestigation->Post_Categorization || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Post Categorization Of Failure Investigation';
            $history->previous = $lastFailureInvestigation->Post_Categorization;
            $history->current = $failureInvestigation->Post_Categorization;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Investigation_Of_Review != $failureInvestigation->Investigation_Of_Review || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Investigation Of Revised Categorization';
            $history->previous = $lastFailureInvestigation->Investigation_Of_Review;
            $history->current = $failureInvestigation->Investigation_Of_Review;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->QA_Feedbacks != $failureInvestigation->QA_Feedbacks || !empty ($request->comment)) {           
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'QA Feedbacks';
            $history->previous = $lastFailureInvestigation->QA_Feedbacks;
            $history->current = $failureInvestigation->QA_Feedbacks;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Closure_Comments != $failureInvestigation->Closure_Comments || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Closure Comments';
            $history->previous = $lastFailureInvestigation->Closure_Comments;
            $history->current = $failureInvestigation->Closure_Comments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastFailureInvestigation->Disposition_Batch != $failureInvestigation->Disposition_Batch || !empty ($request->comment)) {            
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Disposition of Batch';
            $history->previous = $lastFailureInvestigation->Disposition_Batch;
            $history->current = $failureInvestigation->Disposition_Batch;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /************ CFT Review ************/
        if ($lastCft->RA_Review != $request->RA_Review && $request->RA_Review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'RA Review Required';
            $history->previous = $lastCft->RA_Review;
            $history->current = $request->RA_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->RA_person != $request->RA_person && $request->RA_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'RA Person';
            $history->previous = $lastCft->RA_person;
            $history->current = $request->RA_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->RA_assessment != $request->RA_assessment && $request->RA_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'RA Assessment';
            $history->previous = $lastCft->RA_assessment;
            $history->current = $request->RA_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->RA_feedback != $request->RA_feedback && $request->RA_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'RA Feedback';
            $history->previous = $lastCft->RA_feedback;
            $history->current = $request->RA_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->RA_by != $request->RA_by && $request->RA_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'RA Review By';
            $history->previous = $lastCft->RA_by;
            $history->current = $request->RA_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->RA_on != $request->RA_on && $request->RA_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'RA Review On';
            $history->previous = $lastCft->RA_on;
            $history->current = $request->RA_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Quality Assurance ***************/
        if ($lastCft->Quality_Assurance_Review != $request->Quality_Assurance_Review && $request->Quality_Assurance_Review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Quality Assurance Review Required';
            $history->previous = $lastCft->Quality_Assurance_Review;
            $history->current = $request->Quality_Assurance_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->QualityAssurance_person != $request->QualityAssurance_person && $request->QualityAssurance_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Quality Assurance Person';
            $history->previous = $lastCft->QualityAssurance_person;
            $history->current = $request->QualityAssurance_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->QualityAssurance_assessment != $request->QualityAssurance_assessment && $request->QualityAssurance_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Quality Assurance Assessment';
            $history->previous = $lastCft->QualityAssurance_assessment;
            $history->current = $request->QualityAssurance_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->QualityAssurance_feedback != $request->QualityAssurance_feedback && $request->QualityAssurance_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Quality Assurance Feedback';
            $history->previous = $lastCft->QualityAssurance_feedback;
            $history->current = $request->QualityAssurance_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->QualityAssurance_by != $request->QualityAssurance_by && $request->QualityAssurance_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Quality Assurance Review By';
            $history->previous = $lastCft->QualityAssurance_by;
            $history->current = $request->QualityAssurance_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->QualityAssurance_on != $request->QualityAssurance_on && $request->QualityAssurance_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Quality Assurance Review On';
            $history->previous = $lastCft->QualityAssurance_on;
            $history->current = $request->QualityAssurance_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        
        /*************** Production Tablet ***************/
        if ($lastCft->Production_Table_Review != $request->Production_Table_Review && $request->Production_Table_Review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Tablet Review Required';
            $history->previous = $lastCft->Production_Table_Review;
            $history->current = $request->Production_Table_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Production_Table_Person != $request->Production_Table_Person && $request->Production_Table_Person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Tablet Person';
            $history->previous = $lastCft->Production_Table_Person;
            $history->current = $request->Production_Table_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Production_Table_Assessment != $request->Production_Table_Assessment && $request->Production_Table_Assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Tablet Assessment';
            $history->previous = $lastCft->Production_Table_Assessment;
            $history->current = $request->Production_Table_Assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Production_Table_Feedback != $request->Production_Table_Feedback && $request->Production_Table_Feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Tablet Feeback';
            $history->previous = $lastCft->Production_Table_Feedback;
            $history->current = $request->Production_Table_Feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Production_Table_By != $request->Production_Table_By && $request->Production_Table_By != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Tablet Review By';
            $history->previous = $lastCft->Production_Table_Review;
            $history->current = $request->Production_Table_By;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Production_Table_On != $request->Production_Table_On && $request->Production_Table_On != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Tablet On';
            $history->previous = $lastCft->Production_Table_On;
            $history->current = $request->Production_Table_On;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

         /*************** Production Liquid ***************/
         if ($lastCft->ProductionLiquid_Review != $request->ProductionLiquid_Review && $request->ProductionLiquid_Review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Liquid Review Required';
            $history->previous = $lastCft->ProductionLiquid_Review;
            $history->current = $request->ProductionLiquid_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ProductionLiquid_person != $request->ProductionLiquid_person && $request->ProductionLiquid_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Liquid Person';
            $history->previous = $lastCft->ProductionLiquid_person;
            $history->current = $request->ProductionLiquid_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ProductionLiquid_assessment != $request->ProductionLiquid_assessment && $request->ProductionLiquid_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Liquid Assessment';
            $history->previous = $lastCft->ProductionLiquid_assessment;
            $history->current = $request->ProductionLiquid_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ProductionLiquid_feedback != $request->ProductionLiquid_feedback && $request->ProductionLiquid_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Liquid Feedback';
            $history->previous = $lastCft->ProductionLiquid_feedback;
            $history->current = $request->ProductionLiquid_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ProductionLiquid_by != $request->ProductionLiquid_by && $request->ProductionLiquid_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Liquid Review By';
            $history->previous = $lastCft->ProductionLiquid_by;
            $history->current = $request->ProductionLiquid_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ProductionLiquid_on != $request->ProductionLiquid_on && $request->ProductionLiquid_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Liquid Review On';
            $history->previous = $lastCft->ProductionLiquid_on;
            $history->current = $request->ProductionLiquid_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Production Injection ***************/
        if ($lastCft->Production_Injection_Review != $request->Production_Injection_Review && $request->Production_Injection_Review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Injection Review Required';
            $history->previous = $lastCft->Production_Injection_Review;
            $history->current = $request->Production_Injection_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Production_Injection_Person != $request->Production_Injection_Person && $request->Production_Injection_Person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Injection Person';
            $history->previous = $lastCft->Production_Injection_Person;
            $history->current = $request->Production_Injection_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Production_Injection_Assessment != $request->Production_Injection_Assessment && $request->Production_Injection_Assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Injection Assessment';
            $history->previous = $lastCft->Production_Injection_Assessment;
            $history->current = $request->Production_Injection_Assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Production_Injection_Feedback != $request->Production_Injection_Feedback && $request->Production_Injection_Feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Injection Feedback';
            $history->previous = $lastCft->Production_Injection_Feedback;
            $history->current = $request->Production_Injection_Feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Production_Injection_By != $request->Production_Injection_By && $request->Production_Injection_By != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Injection Review By';
            $history->previous = $lastCft->Production_Injection_By;
            $history->current = $request->Production_Injection_By;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Production_Injection_On != $request->Production_Injection_On && $request->Production_Injection_On != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Production Injection On';
            $history->previous = $lastCft->Production_Injection_On;
            $history->current = $request->Production_Injection_On;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Stores ***************/
        if ($lastCft->Store_Review != $request->Store_Review && $request->Store_Review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Store Review Required';
            $history->previous = $lastCft->Store_Review;
            $history->current = $request->Store_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Store_person != $request->Store_person && $request->Store_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Store Person';
            $history->previous = $lastCft->Store_person;
            $history->current = $request->Store_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Store_assessment != $request->Store_assessment && $request->Store_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Store Assessment';
            $history->previous = $lastCft->Store_assessment;
            $history->current = $request->Store_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Store_feedback != $request->Store_feedback && $request->Store_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Store Feedback';
            $history->previous = $lastCft->Store_feedback;
            $history->current = $request->Store_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Store_by != $request->Store_by && $request->Store_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Store Review By';
            $history->previous = $lastCft->Store_by;
            $history->current = $request->Store_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Store_on != $request->Store_on && $request->Store_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Store Review On';
            $history->previous = $lastCft->Store_on;
            $history->current = $request->Store_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Quality Control ***************/
        if ($lastCft->Quality_review != $request->Quality_review && $request->Quality_review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Quality Control Required';
            $history->previous = $lastCft->Quality_review;
            $history->current = $request->Quality_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Quality_Control_Person != $request->Quality_Control_Person && $request->Quality_Control_Person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Quality Control Person';
            $history->previous = $lastCft->Quality_Control_Person;
            $history->current = $request->Quality_Control_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Quality_Control_assessment != $request->Quality_Control_assessment && $request->Quality_Control_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Quality Control Assessment';
            $history->previous = $lastCft->Quality_Control_assessment;
            $history->current = $request->Quality_Control_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Quality_Control_feedback != $request->Quality_Control_feedback && $request->Quality_Control_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Quality Control Feeback';
            $history->previous = $lastCft->Quality_Control_feedback;
            $history->current = $request->Quality_Control_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Quality_Control_by != $request->Quality_Control_by && $request->Quality_Control_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Quality Control By';
            $history->previous = $lastCft->Quality_Control_by;
            $history->current = $request->Quality_Control_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Quality_Control_on != $request->Quality_Control_on && $request->Quality_Control_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Quality Control On';
            $history->previous = $lastCft->Quality_Control_on;
            $history->current = $request->Quality_Control_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Research & Development ***************/
        if ($lastCft->ResearchDevelopment_Review != $request->ResearchDevelopment_Review && $request->ResearchDevelopment_Review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Research & Development Required';
            $history->previous = $lastCft->ResearchDevelopment_Review;
            $history->current = $request->ResearchDevelopment_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_person != $request->ResearchDevelopment_person && $request->ResearchDevelopment_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Research & Development Person';
            $history->previous = $lastCft->ResearchDevelopment_person;
            $history->current = $request->ResearchDevelopment_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_assessment != $request->ResearchDevelopment_assessment && $request->ResearchDevelopment_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Research & Development Assessment';
            $history->previous = $lastCft->ResearchDevelopment_assessment;
            $history->current = $request->ResearchDevelopment_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_feedback != $request->ResearchDevelopment_feedback && $request->ResearchDevelopment_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Research & Development Feedback';
            $history->previous = $lastCft->ResearchDevelopment_feedback;
            $history->current = $request->ResearchDevelopment_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_by != $request->ResearchDevelopment_by && $request->ResearchDevelopment_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Research & Development By';
            $history->previous = $lastCft->ResearchDevelopment_by;
            $history->current = $request->ResearchDevelopment_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_on != $request->ResearchDevelopment_on && $request->ResearchDevelopment_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Research & Development On';
            $history->previous = $lastCft->ResearchDevelopment_on;
            $history->current = $request->ResearchDevelopment_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Engineering ***************/
        if ($lastCft->Engineering_review != $request->Engineering_review && $request->Engineering_review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Engineering Review Required';
            $history->previous = $lastCft->Engineering_review;
            $history->current = $request->Engineering_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Engineering_person != $request->Engineering_person && $request->Engineering_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Engineering Person';
            $history->previous = $lastCft->Engineering_person;
            $history->current = $request->Engineering_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Engineering_assessment != $request->Engineering_assessment && $request->Engineering_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Engineering Assessment';
            $history->previous = $lastCft->Engineering_assessment;
            $history->current = $request->Engineering_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Engineering_feedback != $request->Engineering_feedback && $request->Engineering_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Engineering Feedback';
            $history->previous = $lastCft->Engineering_feedback;
            $history->current = $request->Engineering_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Engineering_by != $request->Engineering_by && $request->Engineering_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Engineering Review By';
            $history->previous = $lastCft->Engineering_by;
            $history->current = $request->Engineering_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Engineering_on != $request->Engineering_on && $request->Engineering_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Engineering Review On';
            $history->previous = $lastCft->Engineering_on;
            $history->current = $request->Engineering_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Human Resource ***************/
        if ($lastCft->Human_Resource_review != $request->Human_Resource_review && $request->Human_Resource_review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Human Resource Review Required';
            $history->previous = $lastCft->Human_Resource_review;
            $history->current = $request->Human_Resource_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Human_Resource_person != $request->Human_Resource_person && $request->Human_Resource_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Human Resource Person';
            $history->previous = $lastCft->Human_Resource_person;
            $history->current = $request->Human_Resource_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Human_Resource_assessment != $request->Human_Resource_assessment && $request->Human_Resource_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Human Resource Assessment';
            $history->previous = $lastCft->Human_Resource_assessment;
            $history->current = $request->Human_Resource_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Human_Resource_feedback != $request->Human_Resource_feedback && $request->Human_Resource_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Human Resource Feedback';
            $history->previous = $lastCft->Human_Resource_feedback;
            $history->current = $request->Human_Resource_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Human_Resource_by != $request->Human_Resource_by && $request->Human_Resource_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Human Resource Review By';
            $history->previous = $lastCft->Human_Resource_by;
            $history->current = $request->Human_Resource_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Human_Resource_on != $request->Human_Resource_on && $request->Human_Resource_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Human Resource Review On';
            $history->previous = $lastCft->Human_Resource_on;
            $history->current = $request->Human_Resource_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Microbiology ***************/
        if ($lastCft->Microbiology_Review != $request->Microbiology_Review && $request->Microbiology_Review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Microbiology Review Required';
            $history->previous = $lastCft->Microbiology_Review;
            $history->current = $request->Microbiology_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Microbiology_person != $request->Microbiology_person && $request->Microbiology_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Microbiology Person';
            $history->previous = $lastCft->Microbiology_person;
            $history->current = $request->Microbiology_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Microbiology_assessment != $request->Microbiology_assessment && $request->Microbiology_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Microbiology Assessment';
            $history->previous = $lastCft->Microbiology_assessment;
            $history->current = $request->Microbiology_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Microbiology_feedback != $request->Microbiology_feedback && $request->Microbiology_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Microbiology Feedback';
            $history->previous = $lastCft->Microbiology_feedback;
            $history->current = $request->Microbiology_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Microbiology_by != $request->Microbiology_by && $request->Microbiology_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Microbiology Review By';
            $history->previous = $lastCft->Microbiology_by;
            $history->current = $request->Microbiology_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Microbiology_on != $request->Microbiology_on && $request->Microbiology_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Microbiology Review On';
            $history->previous = $lastCft->Microbiology_on;
            $history->current = $request->Microbiology_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Regulatory Affair ***************/
        if ($lastCft->RegulatoryAffair_Review != $request->RegulatoryAffair_Review && $request->RegulatoryAffair_Review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Regulatory Affair Review Required';
            $history->previous = $lastCft->RegulatoryAffair_Review;
            $history->current = $request->RegulatoryAffair_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_person != $request->RegulatoryAffair_person && $request->RegulatoryAffair_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Regulatory Affair Person';
            $history->previous = $lastCft->RegulatoryAffair_person;
            $history->current = $request->RegulatoryAffair_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_assessment != $request->RegulatoryAffair_assessment && $request->RegulatoryAffair_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Regulatory Affair Assessment';
            $history->previous = $lastCft->RegulatoryAffair_assessment;
            $history->current = $request->RegulatoryAffair_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_feedback != $request->RegulatoryAffair_feedback && $request->RegulatoryAffair_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Regulatory Affair Feedback';
            $history->previous = $lastCft->RegulatoryAffair_feedback;
            $history->current = $request->RegulatoryAffair_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_by != $request->RegulatoryAffair_by && $request->RegulatoryAffair_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Regulatory Affair Review By';
            $history->previous = $lastCft->RegulatoryAffair_by;
            $history->current = $request->RegulatoryAffair_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_on != $request->RegulatoryAffair_on  && $request->RegulatoryAffair_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Regulatory Affair Review On';
            $history->previous = $lastCft->RegulatoryAffair_on;
            $history->current = $request->RegulatoryAffair_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Corporate Quality Assurance ***************/
        if ($lastCft->CorporateQualityAssurance_Review != $request->CorporateQualityAssurance_Review && $request->CorporateQualityAssurance_Review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Review Required';
            $history->previous = $lastCft->CorporateQualityAssurance_Review;
            $history->current = $request->CorporateQualityAssurance_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_person != $request->CorporateQualityAssurance_person && $request->CorporateQualityAssurance_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Person';
            $history->previous = $lastCft->CorporateQualityAssurance_person;
            $history->current = $request->CorporateQualityAssurance_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_assessment != $request->CorporateQualityAssurance_assessment && $request->CorporateQualityAssurance_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Assessment';
            $history->previous = $lastCft->CorporateQualityAssurance_assessment;
            $history->current = $request->CorporateQualityAssurance_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_feedback != $request->CorporateQualityAssurance_feedback && $request->CorporateQualityAssurance_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Feedback';
            $history->previous = $lastCft->CorporateQualityAssurance_feedback;
            $history->current = $request->CorporateQualityAssurance_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_by != $request->CorporateQualityAssurance_by && $request->CorporateQualityAssurance_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Review By';
            $history->previous = $lastCft->CorporateQualityAssurance_by;
            $history->current = $request->CorporateQualityAssurance_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_on != $request->CorporateQualityAssurance_on && $request->CorporateQualityAssurance_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Review On';
            $history->previous = $lastCft->CorporateQualityAssurance_on;
            $history->current = $request->CorporateQualityAssurance_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Safety ***************/
        if ($lastCft->Environment_Health_review != $request->Environment_Health_review && $request->Environment_Health_review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Safety Review Required';
            $history->previous = $lastCft->Environment_Health_review;
            $history->current = $request->Environment_Health_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Environment_Health_Safety_person != $request->Environment_Health_Safety_person && $request->Environment_Health_Safety_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Safety Person';
            $history->previous = $lastCft->Environment_Health_Safety_person;
            $history->current = $request->Environment_Health_Safety_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Health_Safety_assessment != $request->Health_Safety_assessment && $request->Health_Safety_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Safety Assessment';
            $history->previous = $lastCft->Health_Safety_assessment;
            $history->current = $request->Health_Safety_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Health_Safety_feedback != $request->Health_Safety_feedback && $request->Health_Safety_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Safety Feedback';
            $history->previous = $lastCft->Health_Safety_feedback;
            $history->current = $request->Health_Safety_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Environment_Health_Safety_by != $request->Environment_Health_Safety_by && $request->Environment_Health_Safety_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Safety Review By';
            $history->previous = $lastCft->Environment_Health_Safety_by;
            $history->current = $request->Environment_Health_Safety_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Environment_Health_Safety_on != $request->Environment_Health_Safety_on && $request->Environment_Health_Safety_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Safety Review On';
            $history->previous = $lastCft->Environment_Health_Safety_on;
            $history->current = $request->Environment_Health_Safety_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Information Technology ***************/
        if ($lastCft->Information_Technology_review != $request->Information_Technology_review && $request->Information_Technology_review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Information Technology Review Required';
            $history->previous = $lastCft->Information_Technology_review;
            $history->current = $request->Information_Technology_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Information_Technology_person != $request->Information_Technology_person && $request->Information_Technology_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Information Technology Person';
            $history->previous = $lastCft->Information_Technology_person;
            $history->current = $request->Information_Technology_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Information_Technology_assessment != $request->Information_Technology_assessment && $request->Information_Technology_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Information Technology Assessment';
            $history->previous = $lastCft->Information_Technology_assessment;
            $history->current = $request->Information_Technology_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Information_Technology_feedback != $request->Information_Technology_feedback && $request->Information_Technology_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Information Technology Feedback';
            $history->previous = $lastCft->Information_Technology_feedback;
            $history->current = $request->Information_Technology_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Information_Technology_by != $request->Information_Technology_by && $request->Information_Technology_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Information Technology Review By';
            $history->previous = $lastCft->Information_Technology_by;
            $history->current = $request->Information_Technology_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Information_Technology_on != $request->Information_Technology_on && $request->Information_Technology_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Information Technology Review On';
            $history->previous = $lastCft->Information_Technology_on;
            $history->current = $request->Information_Technology_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Contract Giver ***************/
        if ($lastCft->ContractGiver_Review != $request->ContractGiver_Review && $request->ContractGiver_Review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Contract Giver Review Required';
            $history->previous = $lastCft->ContractGiver_Review;
            $history->current = $request->ContractGiver_Review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ContractGiver_person != $request->ContractGiver_person && $request->ContractGiver_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Contract Giver Person';
            $history->previous = $lastCft->ContractGiver_person;
            $history->current = $request->ContractGiver_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ContractGiver_assessment != $request->ContractGiver_assessment && $request->ContractGiver_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Contract Giver Assessment';
            $history->previous = $lastCft->ContractGiver_assessment;
            $history->current = $request->ContractGiver_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ContractGiver_feedback != $request->ContractGiver_feedback && $request->ContractGiver_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Contract Giver Feedback';
            $history->previous = $lastCft->ContractGiver_feedback;
            $history->current = $request->ContractGiver_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ContractGiver_by != $request->ContractGiver_by && $request->ContractGiver_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Contract Giver Review By';
            $history->previous = $lastCft->ContractGiver_by;
            $history->current = $request->ContractGiver_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->ContractGiver_on != $request->ContractGiver_on && $request->ContractGiver_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Contract Giver Review On';
            $history->previous = $lastCft->ContractGiver_on;
            $history->current = $request->ContractGiver_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Other 1 ***************/
        if ($lastCft->Other1_review != $request->Other1_review && $request->Other1_review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 1 Review Required';
            $history->previous = $lastCft->Other1_review;
            $history->current = $request->Other1_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other1_person != $request->Other1_person && $request->Other1_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 1 Person';
            $history->previous = $lastCft->Other1_person;
            $history->current = $request->Other1_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other1_Department_person != $request->Other1_Department_person && $request->Other1_Department_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 1 Review Required';
            $history->previous = $lastCft->Other1_Department_person;
            $history->current = $request->Other1_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other1_assessment != $request->Other1_assessment && $request->Other1_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 1 Assessment';
            $history->previous = $lastCft->Other1_assessment;
            $history->current = $request->Other1_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other1_feedback != $request->Other1_feedback && $request->Other1_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 1 Feedback';
            $history->previous = $lastCft->Other1_feedback;
            $history->current = $request->Other1_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other1_by != $request->Other1_by && $request->Other1_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 1 Review By';
            $history->previous = $lastCft->Other1_by;
            $history->current = $request->Other1_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other1_on != $request->Other1_on && $request->Other1_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 1 Review On';
            $history->previous = $lastCft->Other1_on;
            $history->current = $request->Other1_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }


        /*************** Other 2 ***************/
        if ($lastCft->Other2_review != $request->Other2_review && $request->Other2_review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 2 Review Required';
            $history->previous = $lastCft->Other2_review;
            $history->current = $request->Other2_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other2_person != $request->Other2_person && $request->Other2_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 2 Person';
            $history->previous = $lastCft->Other2_person;
            $history->current = $request->Other2_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other2_Department_person != $request->Other2_Department_person && $request->Other2_Department_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 2 Review Required';
            $history->previous = $lastCft->Other2_Department_person;
            $history->current = $request->Other2_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other2_assessment != $request->Other2_assessment && $request->Other2_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 2 Assessment';
            $history->previous = $lastCft->Other2_assessment;
            $history->current = $request->Other2_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other2_feedback != $request->Other2_feedback && $request->Other2_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 2 Feedback';
            $history->previous = $lastCft->Other2_feedback;
            $history->current = $request->Other2_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other2_by != $request->Other2_by && $request->Other2_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 2 Review By';
            $history->previous = $lastCft->Other2_by;
            $history->current = $request->Other2_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other2_on != $request->Other2_on && $request->Other2_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 2 Review On';
            $history->previous = $lastCft->Other2_on;
            $history->current = $request->Other2_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Other 3 ***************/
        if ($lastCft->Other3_review != $request->Other3_review && $request->Other3_review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 3 Review Required';
            $history->previous = $lastCft->Other3_review;
            $history->current = $request->Other3_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other3_person != $request->Other3_person && $request->Other3_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 3 Person';
            $history->previous = $lastCft->Other3_person;
            $history->current = $request->Other3_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other3_Department_person != $request->Other3_Department_person && $request->Other3_Department_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 3 Review Required';
            $history->previous = $lastCft->Other3_Department_person;
            $history->current = $request->Other3_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other3_assessment != $request->Other3_assessment && $request->Other3_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 3 Assessment';
            $history->previous = $lastCft->Other3_assessment;
            $history->current = $request->Other3_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other3_feedback != $request->Other3_feedback && $request->Other3_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 3 Feedback';
            $history->previous = $lastCft->Other3_feedback;
            $history->current = $request->Other3_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other3_by != $request->Other3_by && $request->Other3_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 3 Review By';
            $history->previous = $lastCft->Other3_by;
            $history->current = $request->Other3_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other3_on != $request->Other3_on && $request->Other3_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 3 Review On';
            $history->previous = $lastCft->Other3_on;
            $history->current = $request->Other3_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Other 4 ***************/
        if ($lastCft->Other4_review != $request->Other4_review && $request->Other4_review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 4 Review Required';
            $history->previous = $lastCft->Other4_review;
            $history->current = $request->Other4_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other4_person != $request->Other4_person && $request->Other4_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 4 Person';
            $history->previous = $lastCft->Other4_person;
            $history->current = $request->Other4_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other4_Department_person != $request->Other4_Department_person && $request->Other4_Department_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 4 Review Required';
            $history->previous = $lastCft->Other4_Department_person;
            $history->current = $request->Other4_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other4_assessment != $request->Other4_assessment && $request->Other4_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 4 Assessment';
            $history->previous = $lastCft->Other4_assessment;
            $history->current = $request->Other4_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other4_feedback != $request->Other4_feedback && $request->Other4_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 4 Feedback';
            $history->previous = $lastCft->Other4_feedback;
            $history->current = $request->Other4_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other4_by != $request->Other4_by && $request->Other4_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 4 Review By';
            $history->previous = $lastCft->Other4_by;
            $history->current = $request->Other4_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other4_on != $request->Other4_on && $request->Other4_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 4 Review On';
            $history->previous = $lastCft->Other4_on;
            $history->current = $request->Other4_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }

        /*************** Other 5 ***************/
        if ($lastCft->Other5_review != $request->Other5_review && $request->Other5_review != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 5 Review Required';
            $history->previous = $lastCft->Other5_review;
            $history->current = $request->Other5_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other5_person != $request->Other5_person && $request->Other5_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 5 Person';
            $history->previous = $lastCft->Other5_person;
            $history->current = $request->Other5_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other5_Department_person != $request->Other5_Department_person && $request->Other5_Department_person != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 5 Review Required';
            $history->previous = $lastCft->Other5_Department_person;
            $history->current = $request->Other5_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other5_assessment != $request->Other5_assessment && $request->Other5_assessment != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 5 Assessment';
            $history->previous = $lastCft->Other5_assessment;
            $history->current = $request->Other5_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other5_feedback != $request->Other5_feedback && $request->Other5_feedback != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 5 Feedback';
            $history->previous = $lastCft->Other5_feedback;
            $history->current = $request->Other5_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other5_by != $request->Other5_by && $request->Other5_by != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 5 Review By';
            $history->previous = $lastCft->Other5_by;
            $history->current = $request->Other5_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastFailureInvestigation->status;
            $history->action_name = 'Update';
            $history->save();
        }
        if ($lastCft->Other5_on != $request->Other5_on && $request->Other5_on != null) {
            $history = new FailureInvestigationAuditTrail;
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Other 5 Review On';
            $history->previous = $lastCft->Other5_on;
            $history->current = $request->Other5_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastFailureInvestigation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = 'Update';
            $history->save();
        }

        toastr()->success('Record is Update Successfully');



        return back();
    }

    public function failureInvestigationReject(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            // return $request;
            $failureInvestigation = FailureInvestigation::find($id);
            $lastDocument = FailureInvestigation::find($id);
            $list = Helpers::getInitiatorUserList();

            if ($failureInvestigation->stage == 1) {

                $failureInvestigation->stage = "0";
                $failureInvestigation->status = "Close - Cancelled";
                $failureInvestigation->cancelled_by = Auth::user()->name;
                $failureInvestigation->cancelled_on = Carbon::now()->format('d-M-Y');
                $failureInvestigation->cancelled_comment = $request->comments;
                $failureInvestigation->update();

                $history = new FailureInvestigationHistory();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $failureInvestigation->stage;
                $history->status = "Opened";
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $failureInvestigation],
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

                toastr()->success('Document Sent');
                return back();
            }

            if ($failureInvestigation->stage == 2) {

                $failureInvestigation->stage = "1";
                $failureInvestigation->status = "Opened";
                $failureInvestigation->rejected_by = Auth::user()->name;
                $failureInvestigation->rejected_on = Carbon::now()->format('d-M-Y');
                $failureInvestigation->update();

                $history = new FailureInvestigationHistory();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $failureInvestigation->stage;
                $history->status = "Opened";
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $failureInvestigation],
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

                toastr()->success('Document Sent');
                return back();
            }
            if ($failureInvestigation->stage == 3) {
                $failureInvestigation->stage = "2";
                $failureInvestigation->status = "HOD Review";
                $failureInvestigation->form_progress = 'hod';
                $failureInvestigation->qa_more_info_required_by = Auth::user()->name;
                $failureInvestigation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');

                $history = new FailureInvestigationAuditTrail();
                $history->failure_investigation_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $failureInvestigation->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->save();
                $failureInvestigation->update();
                
                $history = new FailureInvestigationHistory();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $failureInvestigation->stage;
                $history->status = "More Info Required";

                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $failureInvestigation],
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

                toastr()->success('Document Sent');
                return back();
            }
            if ($failureInvestigation->stage == 4) {

                $cftResponse = FailureInvestigationCftResponse::withoutTrashed()->where(['failure_investigation_id' => $id])->get();

                // Soft delete all records
                $cftResponse->each(function ($response) {
                    $response->delete();
                });

                $stage = new FailureInvestigationCftResponse();
                $stage->failure_investigation_id = $id;
                $stage->cft_user_id = Auth::user()->id;
                $stage->status = "More Info Required";
                // $stage->cft_stage = ;
                $stage->comment = $request->comment;
                $stage->save();

                $failureInvestigation->stage = "3";
                $failureInvestigation->status = "QA Initial Review";
                $failureInvestigation->form_progress = 'qa';

                $failureInvestigation->qa_more_info_required_by = Auth::user()->name;
                $failureInvestigation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new FailureInvestigationAuditTrail();
                $history->failure_investigation_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $failureInvestigation->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->save();
                $failureInvestigation->update();
                $history = new FailureInvestigationHistory();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $failureInvestigation->stage;
                $history->status = "More Info Required";
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $failureInvestigation],
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
                toastr()->success('Document Sent');
                return back();
            }

            if ($failureInvestigation->stage == 6) {
                $failureInvestigation->stage = "5";
                $failureInvestigation->status = "QA Final Review";
                $failureInvestigation->form_progress = 'capa';

                $failureInvestigation->qa_more_info_required_by = Auth::user()->name;
                $failureInvestigation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new FailureInvestigationAuditTrail();
                $history->failure_investigation_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $failureInvestigation->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                // dd();
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $failureInvestigation],
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
                $failureInvestigation->update();
                $history = new FailureInvestigationHistory();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $failureInvestigation->stage;
                $history->status = "More Info Required";
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function failureInvestigationCancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $failureInvestigation = FailureInvestigation::find($id);
            $lastDocument = FailureInvestigation::find($id);


            $failureInvestigation->stage = "0";
            $failureInvestigation->status = "Closed-Cancelled";
            $failureInvestigation->cancelled_by = Auth::user()->name;
            $failureInvestigation->cancelled_on = Carbon::now()->format('d-M-Y');
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = "";
            $history->current = $failureInvestigation->cancelled_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $failureInvestigation->status;
            $history->stage = 'Cancelled';
            $history->save();
            $failureInvestigation->update();
            $history = new FailureInvestigationHistory();
            $history->type = "Failure Investigation";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $failureInvestigation->stage;
            $history->status = $failureInvestigation->status;
            $history->save();

            // $list = Helpers::getInitiatorUserList();
            // foreach ($list as $u) {
            //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
            //         $email = Helpers::getInitiatorEmail($u->user_id);
            //         if ($email !== null) {

            //             try {
            //                 Mail::send(
            //                     'mail.view-mail',
            //                     ['data' => $failureInvestigation],
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

            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function failureInvestigationCftNotrequired(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $failureInvestigation = FailureInvestigation::find($id);
            $lastDocument = FailureInvestigation::find($id);
            $list = Helpers::getInitiatorUserList();
            $failureInvestigation->stage = "5";
            $failureInvestigation->status = "QA Final Review";
            $failureInvestigation->CFT_Review_Complete_By = Auth::user()->name;
            $failureInvestigation->CFT_Review_Complete_On = Carbon::now()->format('d-M-Y');
            $history = new FailureInvestigationAuditTrail();
            $history->failure_investigation_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = "";
            $history->current = $failureInvestigation->CFT_Review_Complete_By;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage = 'Send to HOD';
            // foreach ($list as $u) {
            //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
            //         $email = Helpers::getInitiatorEmail($u->user_id);
            //         if ($email !== null) {

            //             try {
            //                 Mail::send(
            //                     'mail.view-mail',
            //                     ['data' => $failureInvestigation],
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
            $failureInvestigation->update();
            $history = new FailureInvestigationHistory();
            $history->type = "Failure Investigation";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $failureInvestigation->stage;
            $history->status = $failureInvestigation->status;
            $history->save();

            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function failureInvestigationCheck(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $failureInvestigation = FailureInvestigation::find($id);
            $lastDocument = FailureInvestigation::find($id);
            $cftResponse = FailureInvestigationCftResponse::withoutTrashed()->where(['failure_investigation_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();
           // Soft delete all records
           $cftResponse->each(function ($response) {
            $response->delete();
        });


        $failureInvestigation->stage = "1";
        $failureInvestigation->status = "Opened";
        $failureInvestigation->qa_more_info_required_by = Auth::user()->name;
        $failureInvestigation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
        $history = new FailureInvestigationAuditTrail();
        $history->failure_investigation_id = $id;
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $failureInvestigation->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to Initiator';
        $history->save();
        $failureInvestigation->update();
        $history = new FailureInvestigationHistory();
        $history->type = "Failure Investigation";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $failureInvestigation->stage;
        $history->status = "Send to Initiator";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $failureInvestigation],
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
        $failureInvestigation->update();
        toastr()->success('Document Sent');
        return back();

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function failureInvestigationCheck2(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $failureInvestigation = FailureInvestigation::find($id);
            $lastDocument = FailureInvestigation::find($id);
            $cftResponse = FailureInvestigationCftResponse::withoutTrashed()->where(['failure_investigation_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();

        // Soft delete all records
        $cftResponse->each(function ($response) {
            $response->delete();
        });
        $failureInvestigation->stage = "2";
        $failureInvestigation->status = "HOD Review";
        $failureInvestigation->qa_more_info_required_by = Auth::user()->name;
        $failureInvestigation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
        $history = new FailureInvestigationAuditTrail();
        $history->failure_investigation_id = $id;
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $failureInvestigation->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to HOD';
        $history->save();
        $failureInvestigation->update();
        $history = new FailureInvestigationHistory();
        $history->type = "Failure Investigation";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $failureInvestigation->stage;
        $history->status = "Send to HOD Review";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $failureInvestigation],
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
        $failureInvestigation->update();
        toastr()->success('Document Sent');
        return back();

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function failureInvestigationCheck3(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $failureInvestigation = FailureInvestigation::find($id);
            $lastDocument = FailureInvestigation::find($id);
            $cftResponse = FailureInvestigationCftResponse::withoutTrashed()->where(['failure_investigation_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();

        // Soft delete all records
        $cftResponse->each(function ($response) {
            $response->delete();
        });
        $failureInvestigation->stage = "3";
            $failureInvestigation->status = "QA Initial Review";
            $failureInvestigation->qa_more_info_required_by = Auth::user()->name;
            $failureInvestigation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
        $history = new FailureInvestigationAuditTrail();
        $history->failure_investigation_id = $id;
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $failureInvestigation->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to HOD';
        $history->save();
        $failureInvestigation->update();
        $history = new FailureInvestigationHistory();
        $history->type = "Failure Investigation";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $failureInvestigation->stage;
        $history->status = "Send to QA Initial Review";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $failureInvestigation],
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
        $failureInvestigation->update();
        toastr()->success('Document Sent');
        return back();

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function pending_initiator_update(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $failureInvestigation = FailureInvestigation::find($id);
            $lastDocument = FailureInvestigation::find($id);
            // $cftResponse = FailureInvestigationCftResponse::withoutTrashed()->where(['failure_investigation_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();
           // Soft delete all records
        //    $cftResponse->each(function ($response) {
        //     $response->delete();
        // });


        $failureInvestigation->stage = "7";
        $failureInvestigation->status = "Pending Initiator Update";
        $failureInvestigation->qa_more_info_required_by = Auth::user()->name;
        $failureInvestigation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
        $history = new FailureInvestigationAuditTrail();
        $history->failure_investigation_id = $id;
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $failureInvestigation->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to Pending Initiator Update';
        $history->save();
        $failureInvestigation->update();
        $history = new FailureInvestigationHistory();
        $history->type = "Failure Investigation";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $failureInvestigation->stage;
        $history->status = "Send to Pending Initiator Update";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $failureInvestigation],
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
        $failureInvestigation->update();
        toastr()->success('Document Sent');
        return back();

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function failure_investigation_send_stage(Request $request, $id)
    { 
        try {
            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $failureInvestigation = FailureInvestigation::find($id);
                $updateCFT = FailureInvestigationCft::where('failure_investigation_id', $id)->latest()->first();
                $lastDocument = FailureInvestigation::find($id);
                $cftDetails = FailureInvestigationCftResponse::withoutTrashed()->where(['status' => 'In-progress', 'failure_investigation_id' => $id])->distinct('cft_user_id')->count();
    
                if ($failureInvestigation->stage == 1) {
                    if ($failureInvestigation->form_progress !== 'general-open')
                    {
                        dd('emnter');
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'General Information Tab is yet to be filled'
                        ]);
    
                        return redirect()->back();
                    } else {
                        
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for HOD review state'
                        ]);
                    }
                    
                    $failureInvestigation->stage = "2";
                    $failureInvestigation->status = "HOD Review";
                    $failureInvestigation->submit_by = Auth::user()->name;
                    $failureInvestigation->submit_on = Carbon::now()->format('d-M-Y');
                    $failureInvestigation->submit_comment = $request->comment;
                    
                    $history = new FailureInvestigationAuditTrail();
                    $history->failure_investigation_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action='Submit';
                    $history->current = $failureInvestigation->submit_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "HOD Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();
    
    
                    // $list = Helpers::getHodUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
    
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $failureInvestigation],
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
    
                    // $list = Helpers::getHeadoperationsUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
    
                    //             Mail::send(
                    //                 'mail.Categorymail',
                    //                 ['data' => $failureInvestigation],
                    //                 function ($message) use ($email) {
                    //                     $message->to($email)
                    //                         ->subject("Activity Performed By " . Auth::user()->name);
                    //                 }
                    //             );
                    //         }
                    //     }
                    // }
                    // dd($failureInvestigation);
                    $failureInvestigation->update();
                    return back();
                }
                if ($failureInvestigation->stage == 2) {
    
                    // Check HOD remark value
                    if (!$failureInvestigation->HOD_Remarks) {
    
                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'HOD Remarks is yet to be filled!',
                            'type' => 'warning',
                        ]);
    
                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for QA initial review state'
                        ]);
                    }
    
                    $failureInvestigation->stage = "3";
                    $failureInvestigation->status = "QA Initial Review";
                    $failureInvestigation->HOD_Review_Complete_By = Auth::user()->name;
                    $failureInvestigation->HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $failureInvestigation->HOD_Review_Comments = $request->comment;
                    $history = new FailureInvestigationAuditTrail();
                    $history->failure_investigation_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->current = $failureInvestigation->HOD_Review_Complete_By;
                    $history->comment = $request->comment;
                    $history->action= 'HOD Review Complete';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA Initial Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Approved';
                    $history->save();
                    // dd($history->action);
                    // $list = Helpers::getQAUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $failureInvestigation],
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
    
    
                    $failureInvestigation->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($failureInvestigation->stage == 3) {
                    if ($failureInvestigation->form_progress !== 'cft')
                    {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'QA initial review / CFT Mandatory Tab is yet to be filled!'
                        ]);
    
                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for CFT review state'
                        ]);
                    }
    
                    $failureInvestigation->stage = "4";
                    $failureInvestigation->status = "CFT Review";
    
                    // Code for the CFT required
                    $stage = new FailureInvestigationCftResponse();
                    $stage->failure_investigation_id = $id;
                    $stage->cft_user_id = Auth::user()->id;
                    $stage->status = "CFT Required";
                    // $stage->cft_stage = ;
                    $stage->comment = $request->comment;
                    $stage->is_required = 1;
                    $stage->save();
    
                    $failureInvestigation->QA_Initial_Review_Complete_By = Auth::user()->name;
                    $failureInvestigation->QA_Initial_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $failureInvestigation->QA_Initial_Review_Comments = $request->comment;
                    $history = new FailureInvestigationAuditTrail();
                    $history->failure_investigation_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action= 'QA Initial Review Complete';
                    $history->current = $failureInvestigation->QA_Initial_Review_Complete_By;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->change_to =   "CFT Review";
                    $history->change_from = $lastDocument->status;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = 'Completed';
                    $history->save();
                    // $list = Helpers::getQAUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $failureInvestigation],
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
    
                    if ($request->failure_investigation_category == 'major' || $request->failure_investigation_category == 'minor' || $request->failure_investigation_category == 'critical') {
                        $list = Helpers::getHeadoperationsUserList();
                                // foreach ($list as $u) {
                                //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                                //         $email = Helpers::getInitiatorEmail($u->user_id);
                                //         if ($email !== null) {
                                //              try {
                                //                     Mail::send(
                                //                         'mail.Categorymail',
                                //                         ['data' => $failureInvestigation],
                                //                         function ($message) use ($email) {
                                //                             $message->to($email)
                                //                                 ->subject("Activity Performed By " . Auth::user()->name);
                                //                         }
                                //                     );
                                //                 } catch (\Exception $e) {
                                //                 }
    
                                //         }
                                //     }
                                // }
                            }
                            if ($request->failure_investigation_category == 'major' || $request->failure_investigation_category == 'minor' || $request->failure_investigation_category == 'critical') {
                                $list = Helpers::getCEOUserList();
                                        // foreach ($list as $u) {
                                        //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                                        //         $email = Helpers::getInitiatorEmail($u->user_id);
                                        //         if ($email !== null) {
                                        //              // Add this if statement
                                        //              try {
                                        //                     Mail::send(
                                        //                         'mail.Categorymail',
                                        //                         ['data' => $failureInvestigation],
                                        //                         function ($message) use ($email) {
                                        //                             $message->to($email)
                                        //                                 ->subject("Activity Performed By " . Auth::user()->name);
                                        //                         }
                                        //                     );
                                        //                 } catch (\Exception $e) {
                                        //                     //log error
                                        //                 }
    
                                        //         }
                                        //     }
                                        // }
                                    }
                                    if ($request->failure_investigation_category == 'major' || $request->failure_investigation_category == 'minor' || $request->failure_investigation_category == 'critical') {
                                        $list = Helpers::getCorporateEHSHeadUserList();
                                                // foreach ($list as $u) {
                                                //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                                                //         $email = Helpers::getInitiatorEmail($u->user_id);
                                                //         if ($email !== null) {
                                                //              // Add this if statement
                                                //              try {
                                                //                     Mail::send(
                                                //                         'mail.Categorymail',
                                                //                         ['data' => $failureInvestigation],
                                                //                         function ($message) use ($email) {
                                                //                             $message->to($email)
                                                //                                 ->subject("Activity Performed By " . Auth::user()->name);
                                                //                         }
                                                //                     );
                                                //                 } catch (\Exception $e) {
                                                //                     //log error
                                                //                 }
    
                                                //         }
                                                //     }
                                                // }
                                            }
    
                    $failureInvestigation->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($failureInvestigation->stage == 4) {
    
                    // CFT review state update form_progress
                    if ($failureInvestigation->form_progress !== 'cft')
                    {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'CFT Tab is yet to be filled'
                        ]);
    
                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for Investigation and CAPA review state'
                        ]);
                    }
    
    
                    $IsCFTRequired = FailureInvestigationCftResponse::withoutTrashed()->where(['is_required' => 1, 'failure_investigation_id' => $id])->latest()->first();
                    $cftUsers = DB::table('failure_investigation_cfts')->where(['failure_investigation_id' => $id])->first();
                    // Define the column names
                    $columns = ['Quality_Control_Person', 'QualityAssurance_person', 'Engineering_person', 'Environment_Health_Safety_person', 'Human_Resource_person', 'Information_Technology_person', 'Other1_person', 'Other2_person', 'Other3_person', 'Other4_person', 'Other5_person','RA_person', 'Production_Table_Person','ProductionLiquid_person','Production_Injection_Person','Store_person','ResearchDevelopment_person','Microbiology_person','RegulatoryAffair_person','CorporateQualityAssurance_person','ContractGiver_person'];
                    // $columns2 = ['Production_review', 'Warehouse_review', 'Quality_Control_review', 'QualityAssurance_review', 'Engineering_review', 'Analytical_Development_review', 'Kilo_Lab_review', 'Technology_transfer_review', 'Environment_Health_Safety_review', 'Human_Resource_review', 'Information_Technology_review', 'Project_management_review'];
    
                    // Initialize an array to store the values
                    $valuesArray = [];
    
                    // Iterate over the columns and retrieve the values
                    foreach ($columns as $index => $column) {
                        $value = $cftUsers->$column;
                        if($index == 0 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Quality_Control_by = Auth::user()->name;
                            $updateCFT->Quality_Control_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 1 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->QualityAssurance_by = Auth::user()->name;
                            $updateCFT->QualityAssurance_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 2 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Engineering_by = Auth::user()->name;
                            $updateCFT->Engineering_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 3 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Environment_Health_Safety_by = Auth::user()->name;
                            $updateCFT->Environment_Health_Safety_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 4 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Human_Resource_by = Auth::user()->name;
                            $updateCFT->Human_Resource_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 5 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Information_Technology_by = Auth::user()->name;
                            $updateCFT->Information_Technology_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 6 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Other1_by = Auth::user()->name;
                            $updateCFT->Other1_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 7 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Other2_by = Auth::user()->name;
                            $updateCFT->Other2_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 8 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Other3_by = Auth::user()->name;
                            $updateCFT->Other3_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 9 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Other4_by = Auth::user()->name;
                            $updateCFT->Other4_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 10 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Other5_by = Auth::user()->name;
                            $updateCFT->Other5_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 11 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->RA_by = Auth::user()->name;
                            $updateCFT->RA_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 12 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Production_Table_By = Auth::user()->name;
                            $updateCFT->Production_Table_On = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 13 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->ProductionLiquid_by = Auth::user()->name;
                            $updateCFT->ProductionLiquid_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 14 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Production_Injection_By = Auth::user()->name;
                            $updateCFT->Production_Injection_On = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 15 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Store_by = Auth::user()->name;
                            $updateCFT->Store_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 16 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->ResearchDevelopment_by = Auth::user()->name;
                            $updateCFT->ResearchDevelopment_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 17 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Microbiology_by = Auth::user()->name;
                            $updateCFT->Microbiology_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 18 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->RegulatoryAffair_by = Auth::user()->name;
                            $updateCFT->RegulatoryAffair_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 19 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->CorporateQualityAssurance_by = Auth::user()->name;
                            $updateCFT->CorporateQualityAssurance_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 20 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->ContractGiver_by = Auth::user()->name;
                            $updateCFT->ContractGiver_by = Carbon::now()->format('Y-m-d');
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
                            $stage = new FailureInvestigationCftResponse();
                            $stage->failure_investigation_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "Completed";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        } else {
                            $stage = new FailureInvestigationCftResponse();
                            $stage->failure_investigation_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "In-progress";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        }
                    }
    
                    $checkCFTCount = FailureInvestigationCftResponse::withoutTrashed()->where(['status' => 'Completed', 'failure_investigation_id' => $id])->count();
                    // dd(count(array_unique($valuesArray)), $checkCFTCount);
    
    
                    if (!$IsCFTRequired || $checkCFTCount) {
    
                        $failureInvestigation->stage = "5";
                        $failureInvestigation->status = "QA Final Review";
                        $failureInvestigation->CFT_Review_Complete_By = Auth::user()->name;
                        $failureInvestigation->CFT_Review_Complete_On = Carbon::now()->format('d-M-Y');
                        $failureInvestigation->CFT_Review_Comments = $request->comment;
    
                        $history = new FailureInvestigationAuditTrail();
                        $history->failure_investigation_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->action='CFT Review Complete';
                        $history->current = $failureInvestigation->CFT_Review_Complete_By;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "QA Final Review";
                        $history->change_from = $lastDocument->status;
                        $history->stage = 'Complete';
                        $history->save();
                        // $list = Helpers::getQAUserList();
                        // foreach ($list as $u) {
                        //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                        //         $email = Helpers::getInitiatorEmail($u->user_id);
                        //         if ($email !== null) {
                        //             try {
                        //                 Mail::send(
                        //                     'mail.view-mail',
                        //                     ['data' => $failureInvestigation],
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
                        $failureInvestigation->update();
                    }
                    toastr()->success('Document Sent');
                    return back();
                }
    
                if ($failureInvestigation->stage == 5) {
    
                    if ($failureInvestigation->form_progress === 'capa' && !empty($failureInvestigation->QA_Feedbacks))
                    {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for QA Head/Manager Designee Approval'
                        ]);
    
                    } else {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'Investigation and CAPA / QA Final review Tab is yet to be filled!'
                        ]);
    
                        return redirect()->back();
                    }
    
    
                    $failureInvestigation->stage = "6";
                    $failureInvestigation->status = "QA Head/Manager Designee Approval";
                    $failureInvestigation->QA_Final_Review_Complete_By = Auth::user()->name;
                    $failureInvestigation->QA_Final_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $failureInvestigation->QA_Final_Review_Comments = $request->comment;
    
                    $history = new FailureInvestigationAuditTrail();
                    $history->failure_investigation_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->current = $failureInvestigation->QA_Final_Review_Complete_By;
                    $history->comment = $request->comment;
                    $history->action ='QA Final Review Complete';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA Head/Manager Designee Approval";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Approved';
                    $history->save();
                    // $list = Helpers::getQAUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $failureInvestigation],
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
                    $failureInvestigation->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($failureInvestigation->stage == 6) {
    
                    if ($failureInvestigation->form_progress !== 'qah')
                    {
    
                        Session::flash('swal', [
                            'title' => 'Mandatory Fields!',
                            'message' => 'QAH/Designee Approval Tab is yet to be filled!',
                            'type' => 'warning',
                        ]);
    
                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Failure Investigation sent to Intiator Update'
                        ]);
                    }
    
                    $extension = Extension::where('parent_id', $failureInvestigation->id)->first();
    
                    $rca = RootCauseAnalysis::where('parent_record', str_pad($failureInvestigation->id, 4, 0, STR_PAD_LEFT))->first();
    
                    if ($extension && $extension->status !== 'Closed-Done') {
                        Session::flash('swal', [
                            'title' => 'Extension record pending!',
                            'message' => 'There is an Extension record which is yet to be closed/done!',
                            'type' => 'warning',
                        ]);
    
                        return redirect()->back();
                    }
    
                    if ($rca && $rca->status !== 'Closed-Done') {
                        Session::flash('swal', [
                            'title' => 'RCA record pending!',
                            'message' => 'There is an Root Cause Analysis record which is yet to be closed/done!',
                            'type' => 'warning',
                        ]);
    
                        return redirect()->back();
                    }
    
                    // return "PAUSE";
    
                    $failureInvestigation->stage = "7";
                    $failureInvestigation->status = "Pending Initiator Update";
                    $failureInvestigation->QA_head_approved_by = Auth::user()->name;
                    $failureInvestigation->QA_head_approved_on = Carbon::now()->format('d-M-Y');
                    $failureInvestigation->QA_head_approved_comment	 = $request->comment;
    
                    $history = new FailureInvestigationAuditTrail();
                    $history->failure_investigation_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action ='Approved';
                    $history->current = $failureInvestigation->QA_head_approved_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Pending Initiator Update";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Completed';
                    $history->save();
                    // $list = Helpers::getQAUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $failureInvestigation],
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
                    $failureInvestigation->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($failureInvestigation->stage == 7) {
    
                    if ($failureInvestigation->form_progress !== 'qah')
                    {
    
                        Session::flash('swal', [
                            'title' => 'Mandatory Fields!',
                            'message' => 'QAH/Designee Approval Tab is yet to be filled!',
                            'type' => 'warning',
                        ]);
    
                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Failure Investigation sent to QA Final Approval.'
                        ]);
                    }
    
                    $extension = Extension::where('parent_id', $failureInvestigation->id)->first();
    
                    $rca = RootCauseAnalysis::where('parent_record', str_pad($failureInvestigation->id, 4, 0, STR_PAD_LEFT))->first();
    
                    if ($extension && $extension->status !== 'Closed-Done') {
                        Session::flash('swal', [
                            'title' => 'Extension record pending!',
                            'message' => 'There is an Extension record which is yet to be closed/done!',
                            'type' => 'warning',
                        ]);
    
                        return redirect()->back();
                    }
    
                    if ($rca && $rca->status !== 'Closed-Done') {
                        Session::flash('swal', [
                            'title' => 'RCA record pending!',
                            'message' => 'There is an Root Cause Analysis record which is yet to be closed/done!',
                            'type' => 'warning',
                        ]);
    
                        return redirect()->back();
                    }
    
                    // return "PAUSE";
    
                    $failureInvestigation->stage = "8";
                    $failureInvestigation->status = "QA Final Approval";
                    $failureInvestigation->pending_initiator_approved_by = Auth::user()->name;
                    $failureInvestigation->pending_initiator_approved_on = Carbon::now()->format('d-M-Y');
                    $failureInvestigation->pending_initiator_approved_comment = $request->comment;
    
                    $history = new FailureInvestigationAuditTrail();
                    $history->failure_investigation_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action ='Initiator Updated Complete';
                    $history->current = $failureInvestigation->pending_initiator_approved_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA Final Approval";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Completed';
                    $history->save();
                    // $list = Helpers::getQAUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $failureInvestigation],
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
                    $failureInvestigation->update();
                    toastr()->success('Document Sent');
                    return back();
                }
    
    
                if ($failureInvestigation->stage == 8) {
    
                    if ($failureInvestigation->form_progress !== 'qah')
                    {
    
                        Session::flash('swal', [
                            'title' => 'Mandatory Fields!',
                            'message' => 'QAH/Designee Approval Tab is yet to be filled!',
                            'type' => 'warning',
                        ]);
    
                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Failure Investigation sent to Closed/Done state'
                        ]);
                    }
    
                    $extension = Extension::where('parent_id', $failureInvestigation->id)->first();
    
                    $rca = RootCauseAnalysis::where('parent_record', str_pad($failureInvestigation->id, 4, 0, STR_PAD_LEFT))->first();
    
                    if ($extension && $extension->status !== 'Closed-Done') {
                        Session::flash('swal', [
                            'title' => 'Extension record pending!',
                            'message' => 'There is an Extension record which is yet to be closed/done!',
                            'type' => 'warning',
                        ]);
    
                        return redirect()->back();
                    }
    
                    if ($rca && $rca->status !== 'Closed-Done') {
                        Session::flash('swal', [
                            'title' => 'RCA record pending!',
                            'message' => 'There is an Root Cause Analysis record which is yet to be closed/done!',
                            'type' => 'warning',
                        ]);
    
                        return redirect()->back();
                    }
    
                    // return "PAUSE";
    
                    $failureInvestigation->stage = "9";
                    $failureInvestigation->status = "Closed-Done";
                    $failureInvestigation->QA_final_approved_by = Auth::user()->name;
                    $failureInvestigation->QA_final_approved_on = Carbon::now()->format('d-M-Y');
                    $failureInvestigation->QA_final_approved_comment = $request->comment;
    
                    $history = new FailureInvestigationAuditTrail();
                    $history->failure_investigation_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action ='QA Final Review Complete';
                    $history->current = $failureInvestigation->QA_final_approved_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Closed-Done";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Completed';
                    $history->save();
                    // $list = Helpers::getQAUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $failureInvestigation],
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
                    $failureInvestigation->update();
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

    public function cftnotreqired(Request $request, $id)
    {


        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $failureInvestigation = FailureInvestigation::find($id);
            $lastDocument = FailureInvestigation::find($id);
            $cftDetails = FailureInvestigationCftResponse::withoutTrashed()->where(['status' => 'In-progress', 'failure_investigation_id' => $id])->distinct('cft_user_id')->count();

                $failureInvestigation->stage = "5";
                $failureInvestigation->status = "QA Final Review";
                $failureInvestigation->QA_Initial_Review_Complete_By = Auth::user()->name;
                // dd($failureInvestigation->QA_Initial_Review_Complete_By);
                $failureInvestigation->QA_Initial_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $failureInvestigation->QA_Initial_Review_Comments = $request->comment;

                $history = new FailureInvestigationAuditTrail();
                $history->failure_investigation_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action ='QA Final Review Complete';
                $history->current = $failureInvestigation->QA_Initial_Review_Complete_By;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'Approved';
                $history->save();
                // $list = Helpers::getQAUserList();
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $failureInvestigation],
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
                $failureInvestigation->update();
                toastr()->success('Document Sent');
                return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function failure_inv_qa_more_info(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $failureInvestigation = FailureInvestigation::find($id);
            $lastDocument = FailureInvestigation::find($id);

            if ($failureInvestigation->stage == 2) {
                $failureInvestigation->stage = "2";
                $failureInvestigation->status = "Opened";
                $failureInvestigation->qa_more_info_required_by = Auth::user()->name;
                $failureInvestigation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new FailureInvestigationAuditTrail();
                $history->failure_investigation_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $failureInvestigation->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'HOD Review';
                $history->save();
                $failureInvestigation->update();
                $history = new FailureInvestigationHistory();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $failureInvestigation->stage;
                $history->status = $failureInvestigation->status;
                $history->save();
                // $list = Helpers::getHodUserList();
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $failureInvestigation],
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
                toastr()->success('Document Sent');
                return back();
            }
            if ($failureInvestigation->stage == 3) {
                $failureInvestigation->stage = "2";
                $failureInvestigation->status = "HOD Review";
                $failureInvestigation->qa_more_info_required_by = Auth::user()->name;
                $failureInvestigation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new FailureInvestigationAuditTrail();
                $history->failure_investigation_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $failureInvestigation->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->save();
                $failureInvestigation->update();
                $history = new FailureInvestigationHistory();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $failureInvestigation->stage;
                $history->status = $failureInvestigation->status;
                $history->save();
                // $list = Helpers::getHodUserList();
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $failureInvestigation->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $failureInvestigation],
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
                toastr()->success('Document Sent');
                return back();
            }

            if ($failureInvestigation->stage == 4) {
                $failureInvestigation->stage = "3";
                $failureInvestigation->status = "QA Initial Review";
                $failureInvestigation->qa_more_info_required_by = Auth::user()->name;
                $failureInvestigation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new FailureInvestigationAuditTrail();
                $history->failure_investigation_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $failureInvestigation->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->save();
                $failureInvestigation->update();
                $history = new FailureInvestigationHistory();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $failureInvestigation->stage;
                $history->status = $failureInvestigation->status;
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function failureInvestigationAuditTrail($id)
    {
        $audit = FailureInvestigationAuditTrail::where('failure_investigation_id', $id)->orderByDesc('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = FailureInvestigation::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
        
        return view('frontend.failure-investigation.audit-trail', compact('audit', 'document', 'today'));
    }

    public function failureInvestigationAuditTrailPdf($id)
    {
        $doc = FailureInvestigation::find($id);
        $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        $data = FailureInvestigationAuditTrail::where('failure_investigation_id', $doc->id)->orderByDesc('id')->get();
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.failure-investigation.audit-trail-pdf', compact('data', 'doc'))
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

    public function singleReport($id)
    {
        $data = FailureInvestigation::find($id);
        // dd($data->initial_file);
        $data1 =  FailureInvestigationCft::where('failure_investigation_id', $id)->first();
        if (!empty ($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $grid_data = FailureInvestigationGrid::where('failure_investigation_grid_id', $id)->where('type', "FailureInvestigation")->first();
            $grid_data1 = FailureInvestigationGrid::where('failure_investigation_grid_id', $id)->where('type', "Document")->first();

            $investigationTeam = FailureInvestigationGridData::where(['failure_investigation_id' => $id, 'identifier' => 'TeamInvestigation'])->first();
            $investigation_data = json_decode($investigationTeam->data, true);

            $rootCause = FailureInvestigationGridData::where(['failure_investigation_id' => $id, 'identifier' => 'RootCause'])->first();
            $root_cause_data = json_decode($rootCause->data, true);

            $whyData = FailureInvestigationGridData::where(['failure_investigation_id' => $id, 'identifier' => 'why'])->first();
            $why_data = json_decode($whyData->data, true);

            $capaExtension = FailureInvestigationLaunchExtension::where(['failure_investigation_id' => $id, "extension_identifier" => "Capa"])->first();
            $qrmExtension = FailureInvestigationLaunchExtension::where(['failure_investigation_id' => $id, "extension_identifier" => "QRM"])->first();
            $investigationExtension = FailureInvestigationLaunchExtension::where(['failure_investigation_id' => $id, "extension_identifier" => "Investigation"])->first();

            $grid_data_qrms = FailureInvestigationGridFailureMode::where(['failure_investigation_id' => $id, 'identifier' => 'failure_mode_qrms'])->first();
            $grid_data_matrix_qrms = FailureInvestigationGridFailureMode::where(['failure_investigation_id' => $id, 'identifier' => 'matrix_qrms'])->first();

            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.failure-investigation.single-report', compact('data','grid_data_qrms','grid_data_matrix_qrms','data1','capaExtension','qrmExtension','grid_data','grid_data1','investigation_data','root_cause_data','why_data','investigationExtension'))
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
            return $pdf->stream('Failure Investigation' . $id . '.pdf');
        }
    }

    public function failure_investigation_child_1(Request $request, $id)
    {
        $cft = [];
        $parent_id = $id;
        $parent_type = "Audit_Program";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $parent_record = FailureInvestigation::where('id', $id)->value('record');
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_division_id = FailureInvestigation::where('id', $id)->value('division_id');
        $parent_initiator_id = FailureInvestigation::where('id', $id)->value('initiator_id');
        $parent_intiation_date = FailureInvestigation::where('id', $id)->value('intiation_date');
        $parent_created_at = FailureInvestigation::where('id', $id)->value('created_at');
        $parent_short_description = FailureInvestigation::where('id', $id)->value('short_description');
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
            $Extensionchild = FailureInvestigation::find($id);
            $Extensionchild->Extensionchild = $record_number;
            $Extensionchild->save();
            return view('frontend.forms.extension', compact('parent_id','parent_record', 'parent_name', 'record_number', 'parent_due_date', 'due_date', 'parent_created_at'));
        }
        $old_record = FailureInvestigation::select('id', 'division_id', 'record')->get();
        // dd($request->child_type)
        if ($request->child_type == "capa") {
            $parent_name = "CAPA";
            $Capachild = FailureInvestigation::find($id);
            $Capachild->Capachild = $record_number;
            $Capachild->save();

            return view('frontend.forms.capa', compact('parent_id', 'parent_record','parent_type', 'record_number', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'old_record', 'cft'));
        } elseif ($request->child_type == "Action_Item")
         {
            $parent_name = "CAPA";
            $actionchild = FailureInvestigation::find($id);
            $actionchild->actionchild = $record_number;
            $parent_id = $id;
            $actionchild->save();

            return view('frontend.forms.action-item', compact('old_record', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'record_number', 'due_date', 'parent_id', 'parent_type'));
        }
        elseif ($request->child_type == "effectiveness_check")
         {
            $parent_name = "CAPA";
            $effectivenesschild = FailureInvestigation::find($id);
            $effectivenesschild->effectivenesschild = $record_number;
            $effectivenesschild->save();
        return view('frontend.forms.effectiveness-check', compact('old_record','parent_short_description','parent_record', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id',  'record_number', 'due_date', 'parent_id', 'parent_type'));
        }
        elseif ($request->child_type == "Change_control") {
            $parent_name = "CAPA";
            $Changecontrolchild = FailureInvestigation::find($id);
            $Changecontrolchild->Changecontrolchild = $record_number;

            $Changecontrolchild->save();

            return view('frontend.change-control.new-change-control', compact('cft','pre','hod','parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id',  'record_number', 'due_date', 'parent_id', 'parent_type'));
        }
        else {
            $parent_name = "Root";
            $Rootchild = FailureInvestigation::find($id);
            $Rootchild->Rootchild = $record_number;
            $Rootchild->save();
            return view('frontend.forms.root-cause-analysis', compact('parent_id', 'parent_record','parent_type', 'record_number', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', ));
        }
    }

    
    public function launchExtensionDeviation(Request $request, $id){
        $failureinvestigation = FailureInvestigation::find($id);
        $getCounter = FailureInvestigationlaunchExtension::where(['failure_investigation_id' => $failureinvestigation->id, 'extension_identifier' => "Failure Investigation"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($failureinvestigation->id != null){
            $data = FailureInvestigationlaunchExtension::where([
                'failure_investigation_id' => $failureinvestigation->id,
                'extension_identifier' => "Failure Investigation"
            ])->firstOrCreate();

            $data->failure_investigation_id = $request->failure_investigation_id;
            $data->extension_identifier = $request->extension_identifier;
            $data->counter = $counter;
            $data->dev_proposed_due_date = $request->dev_proposed_due_date;
            $data->dev_extension_justification = $request->dev_extension_justification;
            $data->dev_extension_completed_by = $request->dev_extension_completed_by;
            $data->dev_completed_on = $request->dev_completed_on;
            $data->save();

            toastr()->success('Record is Update Successfully');
            return back();
        }
    }

    public function launchExtensionCapa(Request $request, $id){
        $failureinvestigation = FailureInvestigation::find($id);
        $getCounter = FailureInvestigationlaunchExtension::where(['failure_investigation_id' => $failureinvestigation->id, 'extension_identifier' => "Capa"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($failureinvestigation->id != null){

            $data = FailureInvestigationlaunchExtension::where([
                'failure_investigation_id' => $failureinvestigation->id,
                'extension_identifier' => "Capa"
            ])->firstOrCreate();

            $data->failure_investigation_id = $request->failure_investigation_id;
            $data->extension_identifier = $request->extension_identifier;
            $data->counter = $counter;
            $data->capa_proposed_due_date = $request->capa_proposed_due_date;
            $data->capa_extension_justification = $request->capa_extension_justification;
            $data->capa_extension_completed_by = $request->capa_extension_completed_by;
            $data->capa_completed_on = $request->capa_completed_on;
            $data->save();

            toastr()->success('Record is Update Successfully');
            return back();
        }
    }


    public function launchExtensionQrm(Request $request, $id){
        $failureinvestigation = FailureInvestigation::find($id);
        $getCounter = FailureInvestigationlaunchExtension::where(['failure_investigation_id' => $failureinvestigation->id, 'extension_identifier' => "QRM"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($failureinvestigation->id != null){

            $data = FailureInvestigationlaunchExtension::where([
                'failure_investigation_id' => $failureinvestigation->id,
                'extension_identifier' => "QRM"
            ])->firstOrCreate();

            $data->failure_investigation_id = $request->failure_investigation_id;
            $data->extension_identifier = $request->extension_identifier;
            $data->counter = $counter;
            $data->qrm_proposed_due_date = $request->qrm_proposed_due_date;
            $data->qrm_extension_justification = $request->qrm_extension_justification;
            $data->qrm_extension_completed_by = $request->qrm_extension_completed_by;
            $data->qrm_completed_on = $request->qrm_completed_on;
            $data->save();

            toastr()->success('Record is Update Successfully');
            return back();
        }
    }

    public function launchExtensionInvestigation(Request $request, $id){
        $failureinvestigation = FailureInvestigation::find($id);
        $getCounter = FailureInvestigationlaunchExtension::where(['failure_investigation_id' => $failureinvestigation->id, 'extension_identifier' => "Investigation"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($failureinvestigation->id != null){

            $data = FailureInvestigationlaunchExtension::where([
                'failure_investigation_id' => $failureinvestigation->id,
                'extension_identifier' => "Investigation"
            ])->firstOrCreate();

            $data->failure_investigation_id = $request->failure_investigation_id;
            $data->extension_identifier = $request->extension_identifier;
            $data->counter = $counter;
            $data->investigation_proposed_due_date = $request->investigation_proposed_due_date;
            $data->investigation_extension_justification = $request->investigation_extension_justification;
            $data->investigation_extension_completed_by = $request->investigation_extension_completed_by;
            $data->investigation_completed_on = $request->investigation_completed_on;
            $data->save();

            toastr()->success('Record is Update Successfully');
            return back();
        }
    }
}
