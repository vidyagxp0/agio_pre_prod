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
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $pre = FailureInvestigation::all();
        return response()->view('frontend.failure-investigation.failure-inv-new', compact('formattedDate', 'due_date', 'old_record', 'pre'));
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

        $data3 = new FailureInvestigation();
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
        $data4 = new FailureInvestigation();
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

        $data5 = new FailureInvestigation();
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
        $Cft->Production_Review = $request->Production_Review;
        $Cft->Production_person = $request->Production_person;
        $Cft->Production_assessment = $request->Production_assessment;
        $Cft->Production_feedback = $request->Production_feedback;
        $Cft->production_on = $request->production_on;
        $Cft->production_by = $request->production_by;

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
}
