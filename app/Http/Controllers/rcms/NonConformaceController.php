<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{NonConformance,NonConformanceAuditTrails,NonConformanceCFTs,
NonConformanceCFTResponse,
NonConformanceGrid,
NonConformanceGridDatas,
NonConformanceGridModes,
NonConformanceHistories,
NonConformanceLunchExtension,
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

class NonConformaceController extends Controller
{
    public function index(){


        $old_record = NonConformance::select('id', 'division_id', 'record')->get();
        $data = ((RecordNumber::first()->value('counter')) + 1);
        $data = str_pad($data, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $pre = NonConformance::all();
        return response()->view('frontend.non-conformance.failure-inv-new', compact('formattedDate', 'due_date', 'old_record', 'pre','data'));
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

        $NonConformance = new NonConformance();
        $NonConformance->form_type = "Failure Investigation";

        $NonConformance->record = ((RecordNumber::first()->value('counter')) + 1);
        $NonConformance->initiator_id = Auth::user()->id;

        $NonConformance->form_progress = isset($form_progress) ? $form_progress : null;

        # -------------new-----------
        //  $NonConformance->record_number = $request->record_number;
        $NonConformance->division_id = $request->division_id;
        $NonConformance->assign_to = $request->assign_to;
        $NonConformance->Facility = $request->Facility;
        $NonConformance->due_date = $request->due_date;
        $NonConformance->intiation_date = $request->intiation_date;
        $NonConformance->Initiator_Group = $request->Initiator_Group;
        $NonConformance->due_date = Carbon::now()->addDays(30)->format('d-M-Y');
        $NonConformance->initiator_group_code = $request->initiator_group_code;
        $NonConformance->short_description = $request->short_description;
        $NonConformance->non_conformances_date = $request->non_conformances_date;
        $NonConformance->non_conformances_time = $request->non_conformances_time;
        $NonConformance->non_conformances_reported_date = $request->non_conformances_reported_date;
        if (is_array($request->audit_type)) {
            $NonConformance->audit_type = implode(',', $request->audit_type);
        }
        $NonConformance->short_description_required = $request->short_description_required;
        $NonConformance->nature_of_repeat = $request->nature_of_repeat;
        $NonConformance->others = $request->others;

        $NonConformance->Product_Batch = $request->Product_Batch;

        $NonConformance->Description_non_conformanceS = implode(',', $request->Description_non_conformanceS);
        $NonConformance->Immediate_Action = implode(',', $request->Immediate_Action);
        $NonConformance->Preliminary_Impact = implode(',', $request->Preliminary_Impact);
        $NonConformance->Product_Details_Required = $request->Product_Details_Required;

        $NonConformance->HOD_Remarks = $request->HOD_Remarks;
        $NonConformance->non_conformances_category = $request->non_conformances_category;
        if($request->non_conformances_category=='')
        $NonConformance->Justification_for_categorization = $request->Justification_for_categorization;
        $NonConformance->Investigation_required = $request->Investigation_required;
        $NonConformance->capa_required = $request->capa_required;
        $NonConformance->qrm_required = $request->qrm_required;

        $NonConformance->Investigation_Details = $request->Investigation_Details;
        $NonConformance->Customer_notification = $request->Customer_notification;
        $NonConformance->customers = $request->customers;
        $NonConformance->QAInitialRemark = $request->QAInitialRemark;

        $NonConformance->Investigation_Summary = $request->Investigation_Summary;
        $NonConformance->Impact_assessment = $request->Impact_assessment;
        $NonConformance->Root_cause = $request->Root_cause;
        $NonConformance->CAPA_Rquired = $request->CAPA_Rquired;
        $NonConformance->capa_type = $request->capa_type;
        $NonConformance->CAPA_Description = $request->CAPA_Description;
        $NonConformance->Post_Categorization = $request->Post_Categorization;
        $NonConformance->Investigation_Of_Review = $request->Investigation_Of_Review;
        $NonConformance->QA_Feedbacks = $request->QA_Feedbacks;
        $NonConformance->Closure_Comments = $request->Closure_Comments;
        $NonConformance->Disposition_Batch = $request->Disposition_Batch;
        $NonConformance->Facility_Equipment = $request->Facility_Equipment;
        $NonConformance->Document_Details_Required = $request->Document_Details_Required;

        if ($request->non_conformances_category == 'major' || $request->non_conformances_category == 'minor' || $request->non_conformances_category == 'critical') {
            $list = Helpers::getHeadoperationsUserList();
                    foreach ($list as $u) {
                        if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                            $email = Helpers::getInitiatorEmail($u->user_id);
                            if ($email !== null) {
                                 // Add this if statement
                                try {
                                    Mail::send(
                                        'mail.Categorymail',
                                        ['data' => $NonConformance],
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


                if ($request->non_conformances_category == 'major' || $request->non_conformances_category == 'minor' || $request->non_conformances_category == 'critical') {
                    $list = Helpers::getCEOUserList();
                            foreach ($list as $u) {
                                if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                                    $email = Helpers::getInitiatorEmail($u->user_id);
                                    if ($email !== null) {
                                         // Add this if statement
                                         try {
                                                Mail::send(
                                                    'mail.Categorymail',
                                                    ['data' => $NonConformance],
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
                        if ($request->non_conformances_category == 'major' || $request->non_conformances_category == 'minor' || $request->non_conformances_category == 'critical') {
                            $list = Helpers::getCorporateEHSHeadUserList();
                                    foreach ($list as $u) {
                                        if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                                            $email = Helpers::getInitiatorEmail($u->user_id);
                                            if ($email !== null) {
                                                 // Add this if statement
                                                 try {
                                                        Mail::send(
                                                            'mail.Categorymail',
                                                            ['data' => $NonConformance],
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
                                                if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                                                    $email = Helpers::getInitiatorEmail($u->user_id);
                                                    if ($email !== null) {
                                                         // Add this if statement
                                                         try {
                                                            Mail::send(
                                                                'mail.Categorymail',
                                                                ['data' => $NonConformance],
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
                                                        if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                                                            $email = Helpers::getInitiatorEmail($u->user_id);
                                                            if ($email !== null) {
                                                                 // Add this if statement
                                                                 try {
                                                                        Mail::send(
                                                                            'mail.Categorymail',
                                                                            ['data' => $NonConformance],
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
                                                                if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                                                                    $email = Helpers::getInitiatorEmail($u->user_id);
                                                                    if ($email !== null) {
                                                                         // Add this if statement
                                                                         try {
                                                                                Mail::send(
                                                                                    'mail.Categorymail',
                                                                                    ['data' => $NonConformance],
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


            $NonConformance->Audit_file = json_encode($files);
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


            $NonConformance->initial_file = json_encode($files);
        }

        if (!empty ($request->hod_file)) {
            $files = [];
            if ($request->hasfile('hod_file')) {
                foreach ($request->file('hod_file') as $file) {
                    $name = $request->name . 'hod_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $NonConformance->hod_file = json_encode($files);
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


            $NonConformance->Initial_attachment = json_encode($files);
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


            $NonConformance->QA_attachment = json_encode($files);
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


            $NonConformance->Investigation_attachment = json_encode($files);
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


            $NonConformance->Capa_attachment = json_encode($files);
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


            $NonConformance->QA_attachments = json_encode($files);
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


            $NonConformance->closure_attachment = json_encode($files);
        }

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();



        $NonConformance->status = 'Opened';
        $NonConformance->stage = 1;

        $NonConformance->save();



        $teamInvestigationData = NonConformanceGridDatas::where(['non_conformances_id' => $NonConformance->id,'identifier' => "TeamInvestigation"])->firstOrCreate();
        $teamInvestigationData->non_conformances_id = $NonConformance->id;
        $teamInvestigationData->identifier = "TeamInvestigation";
        $teamInvestigationData->data = $request->investigationTeam;
        $teamInvestigationData->save();

        $rootCauseData = NonConformanceGridDatas::where(['non_conformances_id' => $NonConformance->id,'identifier' => "RootCause"])->firstOrCreate();
        $rootCauseData->non_conformances_id = $NonConformance->id;
        $rootCauseData->identifier = "RootCause";
        $rootCauseData->data = $request->rootCauseData;
        $rootCauseData->save();


        $newDataGridWhy = NonConformanceGridDatas::where(['non_conformances_id' => $NonConformance->id, 'identifier' => 'why'])->firstOrCreate();
        $newDataGridWhy->non_conformances_id = $NonConformance->id;
        $newDataGridWhy->identifier = 'why';
        $newDataGridWhy->data = $request->why;
        $newDataGridWhy->save();

        $newDataGridFishbone = NonConformanceGridDatas::where(['non_conformances_id' => $NonConformance->id, 'identifier' => 'fishbone'])->firstOrCreate();
        $newDataGridFishbone->non_conformances_id = $NonConformance->id;
        $newDataGridFishbone->identifier = 'fishbone';
        $newDataGridFishbone->data = $request->fishbone;
        $newDataGridFishbone->save();


        $newDataGridqrms = NonConformanceGridModes::where(['non_conformances_id' => $NonConformance->id, 'identifier' => 'failure_mode_qrms'])->firstOrCreate();
        $newDataGridqrms->non_conformances_id = $NonConformance->id;
        $newDataGridqrms->identifier = 'failure_mode_qrms';
        $newDataGridqrms->data = $request->failure_mode_qrms;
        // dd($newDataGridqrms->data);
        $newDataGridqrms->save();


        $matrixDataGridqrms = NonConformanceGridModes::where(['non_conformances_id' => $NonConformance->id, 'identifier' => 'matrix_qrms'])->firstOrCreate();
        $matrixDataGridqrms->non_conformances_id = $NonConformance->id;
        $matrixDataGridqrms->identifier = 'matrix_qrms';
        $matrixDataGridqrms->data = $request->matrix_qrms;
        $matrixDataGridqrms->save();

        $data3 = new NonConformanceGrid();
        $data3->non_conformances_grid_id = $NonConformance->id;
        $data3->type = "NonConformance";
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
        $data4 = new NonConformanceGrid();
        $data4->non_conformances_grid_id = $NonConformance->id;
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

        $data5 = new NonConformanceGrid();
        $data5->non_conformances_grid_id = $NonConformance->id;
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

        $Cft = new NonConformanceCFTs();
        $Cft->non_conformances_id = $NonConformance->id;
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

            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = Auth::user()->name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current = $NonConformance->due_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = "Null";
            $history->current = Carbon::now()->format('d-M-Y');
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

        if (!empty ($request->short_description)){
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $NonConformance->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty ($request->Initiator_Group)){
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Department';
            $history->previous = "Null";
            $history->current = $NonConformance->Initiator_Group;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->non_conformances_date)){
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Failure Investigation Observed';
            $history->previous = "Null";
            $history->current = $NonConformance->non_conformances_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (is_array($request->Facility) && $request->Facility[0] !== null){
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Observed by';
            $history->previous = "Null";
            $history->current = $NonConformance->Facility;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->non_conformances_reported_date)){
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Failure Investigation Reported on';
            $history->previous = "Null";
            $history->current = $NonConformance->non_conformances_reported_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if ($request->audit_type[0] !== null){
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Failure Investigation Related To';
            $history->previous = "Null";
            $history->current = $NonConformance->audit_type;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->others)){
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Others';
            $history->previous = "Null";
            $history->current = $NonConformance->others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->action_name = 'Create';
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->save();
        }
        if (!empty ($request->Facility_Equipment)){
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Facility/ Equipment/ Instrument/ System Details Required?';
            $history->previous = "Null";
            $history->current = $NonConformance->Facility_Equipment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Document_Details_Required)){
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Document Details Required';
            $history->previous = "Null";
            $history->current = $NonConformance->Document_Details_Required;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Product_Batch)){
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Name of Product & Batch No';
            $history->previous = "Null";
            $history->current = $NonConformance->Product_Batch;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if ($request->Description_non_conformanceS[0] !== null){
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Description of Failure Investigation';
            $history->previous = "Null";
            $history->current = $NonConformance->Description_non_conformanceS;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if ($request->Immediate_Action[0] !== null){
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Immediate Action (if any)';
            $history->previous = "Null";
            $history->current = $NonConformance->Immediate_Action;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if ($request->Preliminary_Impact[0] !== null){
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $NonConformance->id;
            $history->activity_type = 'Preliminary Impact of Failure Investigation';
            $history->previous = "Null";
            $history->current = $NonConformance->Preliminary_Impact;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->action_name = 'Create';
            $history->save();
        }

        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }

    public function show($id)
    {
        $old_record = NonConformance::select('id', 'division_id', 'record')->get();
        $data = NonConformance::find($id);
        $userData = User::all();
        $data1 = NonConformanceCFTs::where('non_conformances_id', $id)->latest()->first();
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $grid_data = NonConformanceGrid::where('non_conformances_grid_id', $id)->where('type', "NonConformance")->first();
        $grid_data1 = NonConformanceGrid::where('non_conformances_grid_id', $id)->where('type', "Document")->first();
        $grid_data2 = NonConformanceGrid::where('non_conformances_grid_id', $id)->where('type', "Product")->first();
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $pre = NonConformance::all();
        $divisionName = DB::table('q_m_s_divisions')->where('id', $data->division_id)->value('name');


        $json_data = NonConformanceGridModes::where(['non_conformances_id' => $id, 'identifier' => 'failure_mode_qrms'])->first();
        $grid_data_qrms = json_decode($json_data->data, true);
            // dd($grid_data_qrms);

        $json_data = NonConformanceGridModes::where(['non_conformances_id' => $id, 'identifier' => 'matrix_qrms'])->first();
        $grid_data_matrix_qrms = json_decode($json_data->data,true);

        $capaExtension = NonConformanceLunchExtension::where(['non_conformances_id' => $id, "extension_identifier" => "Capa"])->first();
        $qrmExtension = NonConformanceLunchExtension::where(['non_conformances_id' => $id, "extension_identifier" => "QRM"])->first();
        $investigationExtension = NonConformanceLunchExtension::where(['non_conformances_id' => $id, "extension_identifier" => "Investigation"])->first();
        $NonConformanceExtension = NonConformanceLunchExtension::where(['non_conformances_id' => $id, "extension_identifier" => "NonConformance"])->first();

        $investigationTeam = NonConformanceGridDatas::where(['non_conformances_id' => $id, 'identifier' =>'TeamInvestigation'])->first();
        $investigationTeamData = json_decode($investigationTeam->data, true);

        $rootCause = NonConformanceGridDatas::where(['non_conformances_id' => $id, 'identifier' =>'RootCause'])->first();
        $rootCauseData = json_decode($rootCause->data, true);


        $whyData = NonConformanceGridDatas::where(['non_conformances_id' => $id, 'identifier' => 'why'])->first();
        $why_data = json_decode($whyData->data, true);


        $fishbone = NonConformanceGridDatas::where(['non_conformances_id' => $id, 'identifier' =>'fishbone'])->first();
        $fishbone_data = json_decode($fishbone->data, true);

        return view('frontend.non-conformance.failure-inv-view', compact('data','userData', 'grid_data_qrms','grid_data_matrix_qrms', 'capaExtension','qrmExtension','investigationExtension','NonConformanceExtension', 'old_record', 'pre', 'data1', 'divisionName','grid_data','grid_data1','grid_data2','investigationTeamData','rootCauseData', 'why_data', 'fishbone_data'));
    }

    public function update(Request $request,$id)
    {
        $form_progress = null;

        $lastNonConformance = NonConformance::find($id);
        $NonConformance = NonConformance::find($id);
        $NonConformance->Delay_Justification = $request->Delay_Justification;

        if ($request->non_conformances_category == 'major' || $request->non_conformances_category == 'critical')
        {
            $NonConformance->Investigation_required = "yes";
            $NonConformance->capa_required = "yes";
            $NonConformance->qrm_required = "yes";
        }

        if ($request->non_conformances_category == 'minor')
        {
            $NonConformance->Investigation_required = $request->Investigation_required;
            $NonConformance->capa_required = $request->capa_required;
            $NonConformance->qrm_required = $request->qrm_required;
        }

        if ($request->form_name == 'general-open')
        {

            // dd($request->Delay_Justification);
            $validator = Validator::make($request->all(), [
                'Initiator_Group' => 'required',
                'short_description' => 'required',
                'short_description_required' => 'required|in:Recurring,Non_Recurring',
                'nature_of_repeat' => 'required_if:short_description_required,Recurring',
                'non_conformances_date' => 'required',
                'non_conformances_time' => 'required',
                'non_conformances_reported_date' => 'required',
                'Delay_Justification' => [
                    function ($attribute, $value, $fail) use ($request) {
                        $NonConformance_date = Carbon::parse($request->non_conformances_date);
                        $reported_date = Carbon::parse($request->non_conformances_reported_date);
                        $diff_in_days = $reported_date->diffInDays($NonConformance_date);
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
                // 'Description_non_conformanceS' => [
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
                'non_conformances_category' => 'required|not_in:0',
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
                // $NonConformance->capa_number = $request->capa_number ? $request->capa_number : $NonConformance->capa_number;
                $NonConformance->department_capa = $request->department_capa ? $request->department_capa : $NonConformance->department_capa;
                $NonConformance->source_of_capa = $request->source_of_capa ? $request->source_of_capa : $NonConformance->source_of_capa;
                $NonConformance->capa_others = $request->capa_others ? $request->capa_others : $NonConformance->capa_others;
                $NonConformance->source_doc = $request->source_doc ? $request->source_doc : $NonConformance->source_doc;
                $NonConformance->Description_of_Discrepancy = $request->Description_of_Discrepancy ? $request->Description_of_Discrepancy : $NonConformance->Description_of_Discrepancy;
                $NonConformance->capa_root_cause = $request->capa_root_cause ? $request->capa_root_cause : $NonConformance->capa_root_cause;
                $NonConformance->Immediate_Action_Take = $request->Immediate_Action_Take ? $request->Immediate_Action_Take : $NonConformance->Immediate_Action_Take;
                $NonConformance->Corrective_Action_Details = $request->Corrective_Action_Details ? $request->Corrective_Action_Details : $NonConformance->Corrective_Action_Details;
                $NonConformance->Preventive_Action_Details = $request->Preventive_Action_Details ? $request->Preventive_Action_Details : $NonConformance->Preventive_Action_Details;
                $NonConformance->capa_completed_date = $request->capa_completed_date ? $request->capa_completed_date : $NonConformance->capa_completed_date;
                $NonConformance->Interim_Control = $request->Interim_Control ? $request->Interim_Control : $NonConformance->Interim_Control;
                $NonConformance->Corrective_Action_Taken = $request->Corrective_Action_Taken ? $request->Corrective_Action_Taken : $NonConformance->Corrective_Action_Taken;
                $NonConformance->Preventive_action_Taken = $request->Preventive_action_Taken ? $request->Preventive_action_Taken : $NonConformance->Preventive_action_Taken;
                $NonConformance->CAPA_Closure_Comments = $request->CAPA_Closure_Comments ? $request->CAPA_Closure_Comments : $NonConformance->CAPA_Closure_Comments;

                 if (!empty ($request->CAPA_Closure_attachment)) {
                    $files = [];
                    if ($request->hasfile('CAPA_Closure_attachment')) {

                        foreach ($request->file('CAPA_Closure_attachment') as $file) {
                            $name = 'capa_closure_attachment-' . time() . '.' . $file->getClientOriginalExtension();
                            $file->move('upload/', $name);
                            $files[] = $name;
                        }
                    }
                    $NonConformance->CAPA_Closure_attachment = json_encode($files);

                }
                $NonConformance->update();
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

        $NonConformance->assign_to = $request->assign_to;
        $NonConformance->Initiator_Group = $request->Initiator_Group;

        if ($NonConformance->stage < 3) {
            $NonConformance->short_description = $request->short_description;
        } else {
            $NonConformance->short_description = $NonConformance->short_description;
        }
        $NonConformance->initiator_group_code = $request->initiator_group_code;
        $NonConformance->non_conformances_reported_date = $request->non_conformances_reported_date;
        $NonConformance->non_conformances_date = $request->non_conformances_date;
        $NonConformance->non_conformances_time = $request->non_conformances_time;
        $NonConformance->Delay_Justification = $request->Delay_Justification;
        // $NonConformance->audit_type = implode(',', $request->audit_type);
        if (is_array($request->audit_type)) {
            $NonConformance->audit_type = implode(',', $request->audit_type);
        }
        $NonConformance->short_description_required = $request->short_description_required;
        $NonConformance->nature_of_repeat = $request->nature_of_repeat;
        $NonConformance->others = $request->others;
        $NonConformance->Product_Batch = $request->Product_Batch;

        $NonConformance->Description_non_conformanceS = $request->Description_non_conformanceS;
        if ($request->related_records) {
            $NonConformance->Related_Records1 =  implode(',', $request->related_records);
        }
        $NonConformance->Facility = $request->Facility;


        $NonConformance->Immediate_Action = implode(',', $request->Immediate_Action);
        $NonConformance->Preliminary_Impact = implode(',', $request->Preliminary_Impact);
        $NonConformance->Product_Details_Required = $request->Product_Details_Required;


        $NonConformance->HOD_Remarks = $request->HOD_Remarks;
        $NonConformance->Justification_for_categorization = !empty($request->Justification_for_categorization) ? $request->Justification_for_categorization : $NonConformance->Justification_for_categorization;

        $NonConformance->Investigation_Details = !empty($request->Investigation_Details) ? $request->Investigation_Details : $NonConformance->Investigation_Details;

        $NonConformance->QAInitialRemark = $request->QAInitialRemark;
        $NonConformance->Investigation_Summary = $request->Investigation_Summary;
        $NonConformance->Impact_assessment = $request->Impact_assessment;
        $NonConformance->Root_cause = $request->Root_cause;

        $NonConformance->Conclusion = $request->Conclusion;
        $NonConformance->Identified_Risk = $request->Identified_Risk;
        $NonConformance->severity_rate = $request->severity_rate ? $request->severity_rate : $NonConformance->severity_rate;
        $NonConformance->Occurrence = $request->Occurrence ? $request->Occurrence : $NonConformance->Occurrence;
        $NonConformance->detection = $request->detection ? $request->detection: $NonConformance->detection;


        $newDataGridqrms = NonConformanceGridModes::where(['non_conformances_id' => $id, 'identifier' => 'failure_mode_qrms'])->firstOrCreate();
        $newDataGridqrms->non_conformances_id = $id;
        $newDataGridqrms->identifier = 'failure_mode_qrms';
        $newDataGridqrms->data = $request->failure_mode_qrms;
        // dd($newDataGridqrms->data);
        $newDataGridqrms->save();


        $matrixDataGridqrms = NonConformanceGridModes::where(['non_conformances_id' => $id, 'identifier' => 'matrix_qrms'])->firstOrCreate();
        $matrixDataGridqrms->non_conformances_id = $id;
        $matrixDataGridqrms->identifier = 'matrix_qrms';
        $matrixDataGridqrms->data = $request->matrix_qrms;
        $matrixDataGridqrms->save();


        if ($NonConformance->stage < 6) {
            $NonConformance->CAPA_Rquired = $request->CAPA_Rquired;
        }

        if ($NonConformance->stage < 6) {
            $NonConformance->capa_type = $request->capa_type;
        }

        $NonConformance->CAPA_Description = !empty($request->CAPA_Description) ? $request->CAPA_Description : $NonConformance->CAPA_Description;
        $NonConformance->Post_Categorization = !empty($request->Post_Categorization) ? $request->Post_Categorization : $NonConformance->Post_Categorization;
        $NonConformance->Investigation_Of_Review = $request->Investigation_Of_Review;
        $NonConformance->QA_Feedbacks = $request->has('QA_Feedbacks') ? $request->QA_Feedbacks : $NonConformance->QA_Feedbacks;
        $NonConformance->Closure_Comments = $request->Closure_Comments;
        $NonConformance->Disposition_Batch = $request->Disposition_Batch;
        $NonConformance->Facility_Equipment = $request->Facility_Equipment;
        $NonConformance->Document_Details_Required = $request->Document_Details_Required;

        if ($NonConformance->stage == 3)
        {
            $NonConformance->Customer_notification = $request->Customer_notification;
            // $NonConformance->Investigation_required = $request->Investigation_required;
            // $NonConformance->capa_required = $request->capa_required;
            // $NonConformance->qrm_required = $request->qrm_required;
            $NonConformance->non_conformances_category = $request->non_conformances_category;
            $NonConformance->QAInitialRemark = $request->QAInitialRemark;
            // $NonConformance->customers = $request->customers;
        }

        if($NonConformance->stage == 3 || $NonConformance->stage == 4 ){


            if (!$form_progress) {
                $form_progress = 'cft';
            }

            $Cft = NonConformanceCFTs::withoutTrashed()->where('non_conformances_id', $id)->first();
            if($Cft && $NonConformance->stage == 4 ){
                $Cft->Production_Review = $request->Production_Review == null ? $Cft->Production_Review : $request->Production_Review;
                $Cft->Production_person = $request->Production_person == null ? $Cft->Production_person : $request->Production_Review;
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
                $IsCFTRequired = NonConformanceCFTResponse::withoutTrashed()->where(['is_required' => 1, 'non_conformances_id' => $id])->latest()->first();
                $cftUsers = DB::table('non_conformance_c_f_ts')->where(['non_conformances_id' => $id])->first();
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
                                    ['data' => $NonConformance],
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

            if ($NonConformance->Initial_attachment) {
                $existingFiles = json_decode($NonConformance->Initial_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($NonConformance->Audit_file)) ? $NonConformance->Audit_file : [];
            }

            if ($request->hasfile('Initial_attachment')) {
                foreach ($request->file('Initial_attachment') as $file) {
                    $name = $request->name . 'Initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $NonConformance->Initial_attachment = json_encode($files);
        }

        }



        if (!empty ($request->Audit_file)) {

            $files = [];

            if ($NonConformance->Audit_file) {
                $existingFiles = json_decode($NonConformance->Audit_file, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($NonConformance->Audit_file)) ? $NonConformance->Audit_file : [];
            }

            if ($request->hasfile('Audit_file')) {
                foreach ($request->file('Audit_file') as $file) {
                    $name = $request->name . 'Audit_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $NonConformance->Audit_file = json_encode($files);
        }
        if (!empty($request->initial_file)) {
            $files = [];

            // Decode existing files if they exist
            if ($NonConformance->initial_file) {
                $existingFiles = json_decode($NonConformance->initial_file, true); // Convert to associative array
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
            $NonConformance->initial_file = json_encode($files);
        }

        if (!empty ($request->QA_attachment)) {
            $files = [];

            if ($NonConformance->QA_attachment) {
                $existingFiles = json_decode($NonConformance->QA_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($NonConformance->QA_attachment)) ? $NonConformance->QA_attachment : [];
            }

            if ($request->hasfile('QA_attachment')) {
                foreach ($request->file('QA_attachment') as $file) {
                    $name = $request->name . 'QA_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $NonConformance->QA_attachment = json_encode($files);
        }

        if (!empty ($request->Investigation_attachment)) {

            $files = [];

            if ($NonConformance->Investigation_attachment) {
                $existingFiles = json_decode($NonConformance->Investigation_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($NonConformance->QA_attachment)) ? $NonConformance->QA_attachment : [];
            }

            if ($request->hasfile('Investigation_attachment')) {
                foreach ($request->file('Investigation_attachment') as $file) {
                    $name = $request->name . 'Investigation_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $NonConformance->Investigation_attachment = json_encode($files);
        }

        if (!empty ($request->Capa_attachment)) {

            $files = [];

            if ($NonConformance->Capa_attachment) {
                $existingFiles = json_decode($NonConformance->Capa_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($NonConformance->Capa_attachment)) ? $NonConformance->Capa_attachment : [];
            }

            if ($request->hasfile('Capa_attachment')) {
                foreach ($request->file('Capa_attachment') as $file) {
                    $name = $request->name . 'Capa_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $NonConformance->Capa_attachment = json_encode($files);
        }
        // if (!empty ($request->QA_attachments)) {

        //     $files = [];

        //     if ($NonConformance->QA_attachments) {
        //         $files = is_array(json_decode($NonConformance->QA_attachments)) ? $NonConformance->QA_attachments : [];
        //     }

        //     if ($request->hasfile('QA_attachments')) {
        //         foreach ($request->file('QA_attachments') as $file) {
        //             $name = $request->name . 'QA_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }


        //     $NonConformance->QA_attachments = json_encode($files);
        // }

        if (!empty($request->QA_attachments)) {
            $files = [];

            // Decode existing files if they exist
            if ($NonConformance->QA_attachments) {
                $existingFiles = json_decode($NonConformance->QA_attachments, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
            }

            // Process and add new files
            if ($request->hasfile('QA_attachments')) {
                foreach ($request->file('QA_attachments') as $file) {
                    $name = $request->name . 'QA_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            // Encode the files array and update the model
            $NonConformance->QA_attachments = json_encode($files);
        }

        if (!empty ($request->closure_attachment)) {

            $files = [];

            if ($NonConformance->closure_attachment) {
                $existingFiles = json_decode($NonConformance->closure_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($NonConformance->closure_attachment)) ? $NonConformance->closure_attachment : [];
            }

            if ($request->hasfile('closure_attachment')) {
                foreach ($request->file('closure_attachment') as $file) {
                    $name = $request->name . 'closure_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $NonConformance->closure_attachment = json_encode($files);
        }


        if (!empty ($request->hod_file)) {

            $files = [];

            if ($NonConformance->hod_file) {
                $existingFiles = json_decode($NonConformance->hod_file, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($NonConformance->closure_attachment)) ? $NonConformance->closure_attachment : [];
            }

            if ($request->hasfile('hod_file')) {
                foreach ($request->file('hod_file') as $file) {
                    $name = $request->name . 'hod_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $NonConformance->hod_file = json_encode($files);
        }

        if($NonConformance->stage > 0){
            //investiocation dynamic
            $NonConformance->Discription_Event = $request->Discription_Event;
            $NonConformance->objective = $request->objective;
            $NonConformance->scope = $request->scope;
            $NonConformance->imidiate_action = $request->imidiate_action;
            $NonConformance->investigation_approach = is_array($request->investigation_approach) ? implode(',', $request->investigation_approach) : '';
            $NonConformance->attention_issues = $request->attention_issues;
            $NonConformance->attention_actions = $request->attention_actions;
            $NonConformance->attention_remarks = $request->attention_remarks;
            $NonConformance->understanding_issues = $request->understanding_issues;
            $NonConformance->understanding_actions = $request->understanding_actions;
            $NonConformance->understanding_remarks = $request->understanding_remarks;
            $NonConformance->procedural_issues = $request->procedural_issues;
            $NonConformance->procedural_actions = $request->procedural_actions;
            $NonConformance->procedural_remarks = $request->procedural_remarks;
            $NonConformance->behavioiral_issues = $request->behavioiral_issues;
            $NonConformance->behavioiral_actions = $request->behavioiral_actions;
            $NonConformance->behavioiral_remarks = $request->behavioiral_remarks;
            $NonConformance->skill_issues = $request->skill_issues;
            $NonConformance->skill_actions = $request->skill_actions;
            $NonConformance->skill_remarks = $request->skill_remarks;
            $NonConformance->what_will_be = $request->what_will_be;
            $NonConformance->what_will_not_be = $request->what_will_not_be;
            $NonConformance->what_rationable = $request->what_rationable;
            $NonConformance->where_will_be = $request->where_will_be;
            $NonConformance->where_will_not_be = $request->where_will_not_be;
            $NonConformance->where_rationable = $request->where_rationable;
            $NonConformance->when_will_not_be = $request->when_will_not_be;
            $NonConformance->when_will_be = $request->when_will_be;
            $NonConformance->when_rationable = $request->when_rationable;
            $NonConformance->coverage_will_be = $request->coverage_will_be;
            $NonConformance->coverage_will_not_be = $request->coverage_will_not_be;
            $NonConformance->coverage_rationable = $request->coverage_rationable;
            $NonConformance->who_will_be = $request->who_will_be;
            $NonConformance->who_will_not_be = $request->who_will_not_be;
            $NonConformance->who_rationable = $request->who_rationable;

            // dd($id);
        $newDataGridInvestication = NonConformanceGridDatas::where(['non_conformances_id' => $id, 'identifier' => 'TeamInvestigation'])->firstOrCreate();
        $newDataGridInvestication->non_conformances_id = $id;
        $newDataGridInvestication->identifier = 'TeamInvestigation';
        $newDataGridInvestication->data = $request->investigationTeam;
        $newDataGridInvestication->save();

        $newDataGridRCA = NonConformanceGridDatas::where(['non_conformances_id' => $id, 'identifier' => 'RootCause'])->firstOrCreate();
        $newDataGridRCA->non_conformances_id = $id;
        $newDataGridRCA->identifier = 'RootCause';
        $newDataGridRCA->data = $request->rootCauseData;
        $newDataGridRCA->save();


        $newDataGridWhy = NonConformanceGridDatas::where(['non_conformances_id' => $id, 'identifier' => 'why'])->firstOrCreate();
        $newDataGridWhy->non_conformances_id = $id;
        $newDataGridWhy->identifier = 'why';
        $newDataGridWhy->data = $request->why;
        $newDataGridWhy->save();

        $newDataGridFishbone = NonConformanceGridDatas::where(['non_conformances_id' => $id, 'identifier' => 'fishbone'])->firstOrCreate();
        $newDataGridFishbone->non_conformances_id = $id;
        $newDataGridFishbone->identifier = 'fishbone';
        $newDataGridFishbone->data = $request->fishbone;
        $newDataGridFishbone->save();

        }

        $NonConformance->form_progress = isset($form_progress) ? $form_progress : null;
        $NonConformance->update();
        // grid
         $data3=NonConformanceGrid::where('non_conformances_grid_id', $NonConformance->id)->where('type', "NonConformance")->first();
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


            $data4=NonConformanceGrid::where('non_conformances_grid_id', $NonConformance->id)->where('type', "Document")->first();
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

            $data5=NonConformanceGrid::where('non_conformances_grid_id', $NonConformance->id)->where('type', "Product")->first();
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


        if ($lastNonConformance->short_description != $NonConformance->short_description || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastNonConformance->short_description;
            $history->current = $NonConformance->short_description;
            $history->comment = $NonConformance->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastNonConformance->Initiator_Group != $NonConformance->Initiator_Group || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Initiator Group';
            $history->previous = $lastNonConformance->Initiator_Group;
            $history->current = $NonConformance->Initiator_Group;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->non_conformances_date != $NonConformance->non_conformances_date || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Failure Investigation Observed';
            $history->previous = $lastNonConformance->non_conformances_date;
            $history->current = $NonConformance->non_conformances_date;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Observed_by != $NonConformance->Observed_by || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Observed by';
            $history->previous = $lastNonConformance->Observed_by;
            $history->current = $NonConformance->Observed_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->non_conformances_reported_date != $NonConformance->non_conformances_reported_date || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Failure Investigation Reported on';
            $history->previous = $lastNonConformance->non_conformances_reported_date;
            $history->current = $NonConformance->non_conformances_reported_date;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->audit_type != $NonConformance->audit_type || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Failure Investigation Related To';
            $history->previous = $lastNonConformance->audit_type;
            $history->current = $NonConformance->audit_type;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Others != $NonConformance->Others || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Others';
            $history->previous = $lastNonConformance->Others;
            $history->current = $NonConformance->Others;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Facility_Equipment != $NonConformance->Facility_Equipment || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Facility/ Equipment/ Instrument/ System Details Required?';
            $history->previous = $lastNonConformance->Facility_Equipment;
            $history->current = $NonConformance->Facility_Equipment;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Document_Details_Required != $NonConformance->Document_Details_Required || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Document Details Required';
            $history->previous = $lastNonConformance->Document_Details_Required;
            $history->current = $NonConformance->Document_Details_Required;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Product_Batch != $NonConformance->Product_Batch || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Name of Product & Batch No';
            $history->previous = $lastNonConformance->Product_Batch;
            $history->current = $NonConformance->Product_Batch;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Description_non_conformanceS != $NonConformance->Description_non_conformanceS || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Description of Failure Investigation';
            $history->previous = $lastNonConformance->Description_non_conformanceS;
            $history->current = $NonConformance->Description_non_conformanceS;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Immediate_Action != $NonConformance->Immediate_Action || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Immediate Action (if any)';
            $history->previous = $lastNonConformance->Immediate_Action;
            $history->current = $NonConformance->Immediate_Action;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Preliminary_Impact != $NonConformance->Preliminary_Impact || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Preliminary Impact of Failure Investigation';
            $history->previous = $lastNonConformance->Preliminary_Impact;
            $history->current = $NonConformance->Preliminary_Impact;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->HOD_Remarks != $NonConformance->HOD_Remarks || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'HOD Remarks';
            $history->previous = $lastNonConformance->HOD_Remarks;
            $history->current = $NonConformance->HOD_Remarks;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->non_conformances_category != $NonConformance->non_conformances_category || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Initial Failure Investigation Category';
            $history->previous = $lastNonConformance->non_conformances_category;
            $history->current = $NonConformance->non_conformances_category;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Justification_for_categorization != $NonConformance->Justification_for_categorization || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Justification for Categorization';
            $history->previous = $lastNonConformance->Justification_for_categorization;
            $history->current = $NonConformance->Justification_for_categorization;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Investigation_required != $NonConformance->Investigation_required || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Investigation Is required ?';
            $history->previous = $lastNonConformance->Investigation_required;
            $history->current = $NonConformance->Investigation_required;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Investigation_Details != $NonConformance->Investigation_Details || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Investigation Details';
            $history->previous = $lastNonConformance->Investigation_Details;
            $history->current = $NonConformance->Investigation_Details;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Customer_notification != $NonConformance->Customer_notification || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Customer Notification Required ?';
            $history->previous = $lastNonConformance->Customer_notification;
            $history->current = $NonConformance->Customer_notification;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->customers != $NonConformance->customers || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Customer';
            $history->previous = $lastNonConformance->customers;
            $history->current = $NonConformance->customers;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->QAInitialRemark != $NonConformance->QAInitialRemark || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'QA Initial Remarks';
            $history->previous = $lastNonConformance->QAInitialRemark;
            $history->current = $NonConformance->QAInitialRemark;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Investigation_Summary != $NonConformance->Investigation_Summary || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Investigation Summary';
            $history->previous = $lastNonConformance->Investigation_Summary;
            $history->current = $NonConformance->Investigation_Summary;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->save();
        }

        if ($lastNonConformance->Impact_assessment != $NonConformance->Impact_assessment || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Impact Assessment';
            $history->previous = $lastNonConformance->Impact_assessment;
            $history->current = $NonConformance->Impact_assessment;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Root_cause != $NonConformance->Root_cause || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Root Cause';
            $history->previous = $lastNonConformance->Root_cause;
            $history->current = $NonConformance->Root_cause;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->CAPA_Rquired != $NonConformance->CAPA_Rquired || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'CAPA Required ?';
            $history->previous = $lastNonConformance->CAPA_Rquired;
            $history->current = $NonConformance->CAPA_Rquired;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->capa_type != $NonConformance->capa_type || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'CAPA Type?';
            $history->previous = $lastNonConformance->capa_type;
            $history->current = $NonConformance->capa_type;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->CAPA_Description != $NonConformance->CAPA_Description || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'CAPA Description';
            $history->previous = $lastNonConformance->CAPA_Description;
            $history->current = $NonConformance->CAPA_Description;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Post_Categorization != $NonConformance->Post_Categorization || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Post Categorization Of Failure Investigation';
            $history->previous = $lastNonConformance->Post_Categorization;
            $history->current = $NonConformance->Post_Categorization;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Investigation_Of_Review != $NonConformance->Investigation_Of_Review || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Investigation Of Revised Categorization';
            $history->previous = $lastNonConformance->Investigation_Of_Review;
            $history->current = $NonConformance->Investigation_Of_Review;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->QA_Feedbacks != $NonConformance->QA_Feedbacks || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'QA Feedbacks';
            $history->previous = $lastNonConformance->QA_Feedbacks;
            $history->current = $NonConformance->QA_Feedbacks;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Closure_Comments != $NonConformance->Closure_Comments || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Closure Comments';
            $history->previous = $lastNonConformance->Closure_Comments;
            $history->current = $NonConformance->Closure_Comments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastNonConformance->Disposition_Batch != $NonConformance->Disposition_Batch || !empty ($request->comment)) {
            // return 'history';
            $history = new NonConformanceAuditTrails;
            $history->non_conformances_id = $id;
            $history->activity_type = 'Disposition of Batch';
            $history->previous = $lastNonConformance->Disposition_Batch;
            $history->current = $NonConformance->Disposition_Batch;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastNonConformance->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastNonConformance->status;
            $history->action_name = 'Update';
            $history->save();
        }

        toastr()->success('Record is Update Successfully');

        return back();
    }

    public function nonConformaceReject(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            // return $request;
            $NonConformance = NonConformance::find($id);
            $lastDocument = NonConformance::find($id);
            $list = Helpers::getInitiatorUserList();


            if ($NonConformance->stage == 2) {

                $NonConformance->stage = "1";
                $NonConformance->status = "Opened";
                $NonConformance->rejected_by = Auth::user()->name;
                $NonConformance->rejected_on = Carbon::now()->format('d-M-Y');
                $NonConformance->update();
                $history = new NonConformanceHistories();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $NonConformance->stage;
                $history->status = "Opened";
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $NonConformance],
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
            if ($NonConformance->stage == 3) {
                $NonConformance->stage = "2";
                $NonConformance->status = "HOD Review";
                $NonConformance->form_progress = 'hod';
                $NonConformance->qa_more_info_required_by = Auth::user()->name;
                $NonConformance->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new NonConformanceAuditTrails();
                $history->non_conformances_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $NonConformance->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->save();
                $NonConformance->update();
                $history = new NonConformanceHistories();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $NonConformance->stage;
                $history->status = "More Info Required";

                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $NonConformance],
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
            if ($NonConformance->stage == 4) {

                $cftResponse = NonConformanceCFTResponse::withoutTrashed()->where(['non_conformances_id' => $id])->get();

                // Soft delete all records
                $cftResponse->each(function ($response) {
                    $response->delete();
                });

                $stage = new NonConformanceCFTResponse();
                $stage->non_conformances_id = $id;
                $stage->cft_user_id = Auth::user()->id;
                $stage->status = "More Info Required";
                // $stage->cft_stage = ;
                $stage->comment = $request->comment;
                $stage->save();

                $NonConformance->stage = "3";
                $NonConformance->status = "QA Initial Review";
                $NonConformance->form_progress = 'qa';

                $NonConformance->qa_more_info_required_by = Auth::user()->name;
                $NonConformance->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new NonConformanceAuditTrails();
                $history->non_conformances_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $NonConformance->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->save();
                $NonConformance->update();
                $history = new NonConformanceHistories();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $NonConformance->stage;
                $history->status = "More Info Required";
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $NonConformance],
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

            if ($NonConformance->stage == 6) {
                $NonConformance->stage = "5";
                $NonConformance->status = "QA Final Review";
                $NonConformance->form_progress = 'capa';

                $NonConformance->qa_more_info_required_by = Auth::user()->name;
                $NonConformance->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new NonConformanceAuditTrails();
                $history->non_conformances_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $NonConformance->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                // dd();
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $NonConformance],
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
                $NonConformance->update();
                $history = new NonConformanceHistories();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $NonConformance->stage;
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

    public function NonConformanceCancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $NonConformance = NonConformance::find($id);
            $lastDocument = NonConformance::find($id);
            $NonConformance->stage = "0";
            $NonConformance->status = "Closed-Cancelled";
            $NonConformance->cancelled_by = Auth::user()->name;
            $NonConformance->cancelled_on = Carbon::now()->format('d-M-Y');
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = "";
            $history->current = $NonConformance->cancelled_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $NonConformance->status;
            $history->stage = 'Cancelled';
            $history->save();
            $NonConformance->update();
            $history = new NonConformanceHistories();
            $history->type = "Failure Investigation";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $NonConformance->stage;
            $history->status = $NonConformance->status;
            $history->save();

            // $list = Helpers::getInitiatorUserList();
            // foreach ($list as $u) {
            //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
            //         $email = Helpers::getInitiatorEmail($u->user_id);
            //         if ($email !== null) {

            //             try {
            //                 Mail::send(
            //                     'mail.view-mail',
            //                     ['data' => $NonConformance],
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

    public function NonConformanceCftNotrequired(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $NonConformance = NonConformance::find($id);
            $lastDocument = NonConformance::find($id);
            $list = Helpers::getInitiatorUserList();
            $NonConformance->stage = "5";
            $NonConformance->status = "QA Final Review";
            $NonConformance->CFT_Review_Complete_By = Auth::user()->name;
            $NonConformance->CFT_Review_Complete_On = Carbon::now()->format('d-M-Y');
            $history = new NonConformanceAuditTrails();
            $history->non_conformances_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = "";
            $history->current = $NonConformance->CFT_Review_Complete_By;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage = 'Send to HOD';
            // foreach ($list as $u) {
            //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
            //         $email = Helpers::getInitiatorEmail($u->user_id);
            //         if ($email !== null) {

            //             try {
            //                 Mail::send(
            //                     'mail.view-mail',
            //                     ['data' => $NonConformance],
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
            $NonConformance->update();
            $history = new NonConformanceHistories();
            $history->type = "Failure Investigation";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $NonConformance->stage;
            $history->status = $NonConformance->status;
            $history->save();

            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function nonConformaceCheck(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $NonConformance = NonConformance::find($id);
            $lastDocument = NonConformance::find($id);
            $cftResponse = NonConformanceCFTResponse::withoutTrashed()->where(['non_conformances_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();
           // Soft delete all records
           $cftResponse->each(function ($response) {
            $response->delete();
        });


        $NonConformance->stage = "1";
        $NonConformance->status = "Opened";
        $NonConformance->qa_more_info_required_by = Auth::user()->name;
        $NonConformance->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
        $history = new NonConformanceAuditTrails();
        $history->non_conformances_id = $id;
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $NonConformance->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to Initiator';
        $history->save();
        $NonConformance->update();
        $history = new NonConformanceHistories();
        $history->type = "Failure Investigation";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $NonConformance->stage;
        $history->status = "Send to Initiator";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $NonConformance],
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
        $NonConformance->update();
        toastr()->success('Document Sent');
        return back();

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function nonConformaceCheck2(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $NonConformance = NonConformance::find($id);
            $lastDocument = NonConformance::find($id);
            $cftResponse = NonConformanceCFTResponse::withoutTrashed()->where(['non_conformances_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();

        // Soft delete all records
        $cftResponse->each(function ($response) {
            $response->delete();
        });
        $NonConformance->stage = "2";
        $NonConformance->status = "HOD Review";
        $NonConformance->qa_more_info_required_by = Auth::user()->name;
        $NonConformance->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
        $history = new NonConformanceAuditTrails();
        $history->non_conformances_id = $id;
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $NonConformance->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to HOD';
        $history->save();
        $NonConformance->update();
        $history = new NonConformanceHistories();
        $history->type = "Failure Investigation";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $NonConformance->stage;
        $history->status = "Send to HOD Review";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $NonConformance],
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
        $NonConformance->update();
        toastr()->success('Document Sent');
        return back();

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function nonConformaceCheck3(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $NonConformance = NonConformance::find($id);
            $lastDocument = NonConformance::find($id);
            $cftResponse = NonConformanceCFTResponse::withoutTrashed()->where(['non_conformances_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();

        // Soft delete all records
        $cftResponse->each(function ($response) {
            $response->delete();
        });
        $NonConformance->stage = "3";
            $NonConformance->status = "QA Initial Review";
            $NonConformance->qa_more_info_required_by = Auth::user()->name;
            $NonConformance->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
        $history = new NonConformanceAuditTrails();
        $history->non_conformances_id = $id;
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $NonConformance->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to HOD';
        $history->save();
        $NonConformance->update();
        $history = new NonConformanceHistories();
        $history->type = "Failure Investigation";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $NonConformance->stage;
        $history->status = "Send to QA Initial Review";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $NonConformance],
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
        $NonConformance->update();
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
            $NonConformance = NonConformance::find($id);
            $lastDocument = NonConformance::find($id);
            // $cftResponse = NonConformanceCFTResponse::withoutTrashed()->where(['non_conformances_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();
           // Soft delete all records
        //    $cftResponse->each(function ($response) {
        //     $response->delete();
        // });


        $NonConformance->stage = "7";
        $NonConformance->status = "Pending Initiator Update";
        $NonConformance->qa_more_info_required_by = Auth::user()->name;
        $NonConformance->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
        $history = new NonConformanceAuditTrails();
        $history->non_conformances_id = $id;
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $NonConformance->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to Pending Initiator Update';
        $history->save();
        $NonConformance->update();
        $history = new NonConformanceHistories();
        $history->type = "Failure Investigation";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $NonConformance->stage;
        $history->status = "Send to Pending Initiator Update";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $NonConformance],
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
        $NonConformance->update();
        toastr()->success('Document Sent');
        return back();

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function non_conformance_send_stage(Request $request, $id)
    {
        try {
            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $NonConformance = NonConformance::find($id);
                $updateCFT = NonConformanceCFTs::where('non_conformances_id', $id)->latest()->first();
                $lastDocument = NonConformance::find($id);
                $cftDetails = NonConformanceCFTResponse::withoutTrashed()->where(['status' => 'In-progress', 'non_conformances_id' => $id])->distinct('cft_user_id')->count();

                if ($NonConformance->stage == 1) {
                    if ($NonConformance->form_progress !== 'general-open')
                    {

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

                    $NonConformance->stage = "2";
                    $NonConformance->status = "HOD Review";
                    $NonConformance->submit_by = Auth::user()->name;
                    $NonConformance->submit_on = Carbon::now()->format('d-M-Y');
                    $NonConformance->submit_comment = $request->comment;

                    $history = new NonConformanceAuditTrails();
                    $history->non_conformances_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action='Submit';
                    $history->current = $NonConformance->submit_by;
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
                    //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {

                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $NonConformance],
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
                    //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {

                    //             Mail::send(
                    //                 'mail.Categorymail',
                    //                 ['data' => $NonConformance],
                    //                 function ($message) use ($email) {
                    //                     $message->to($email)
                    //                         ->subject("Activity Performed By " . Auth::user()->name);
                    //                 }
                    //             );
                    //         }
                    //     }
                    // }
                    // dd($NonConformance);
                    $NonConformance->update();
                    return back();
                }
                if ($NonConformance->stage == 2) {

                    // Check HOD remark value
                    if (!$NonConformance->HOD_Remarks) {

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

                    $NonConformance->stage = "3";
                    $NonConformance->status = "QA Initial Review";
                    $NonConformance->HOD_Review_Complete_By = Auth::user()->name;
                    $NonConformance->HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $NonConformance->HOD_Review_Comments = $request->comment;
                    $history = new NonConformanceAuditTrails();
                    $history->non_conformances_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->current = $NonConformance->HOD_Review_Complete_By;
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
                    //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $NonConformance],
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


                    $NonConformance->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($NonConformance->stage == 3) {
                    if ($NonConformance->form_progress !== 'cft')
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

                    $NonConformance->stage = "4";
                    $NonConformance->status = "CFT Review";

                    // Code for the CFT required
                    $stage = new NonConformanceCFTResponse();
                    $stage->non_conformances_id = $id;
                    $stage->cft_user_id = Auth::user()->id;
                    $stage->status = "CFT Required";
                    // $stage->cft_stage = ;
                    $stage->comment = $request->comment;
                    $stage->is_required = 1;
                    $stage->save();

                    $NonConformance->QA_Initial_Review_Complete_By = Auth::user()->name;
                    $NonConformance->QA_Initial_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $NonConformance->QA_Initial_Review_Comments = $request->comment;
                    $history = new NonConformanceAuditTrails();
                    $history->non_conformances_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action= 'QA Initial Review Complete';
                    $history->current = $NonConformance->QA_Initial_Review_Complete_By;
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
                    //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $NonConformance],
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

                    if ($request->non_conformances_category == 'major' || $request->non_conformances_category == 'minor' || $request->non_conformances_category == 'critical') {
                        $list = Helpers::getHeadoperationsUserList();
                                // foreach ($list as $u) {
                                //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                                //         $email = Helpers::getInitiatorEmail($u->user_id);
                                //         if ($email !== null) {
                                //              try {
                                //                     Mail::send(
                                //                         'mail.Categorymail',
                                //                         ['data' => $NonConformance],
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
                            if ($request->non_conformances_category == 'major' || $request->non_conformances_category == 'minor' || $request->non_conformances_category == 'critical') {
                                $list = Helpers::getCEOUserList();
                                        // foreach ($list as $u) {
                                        //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                                        //         $email = Helpers::getInitiatorEmail($u->user_id);
                                        //         if ($email !== null) {
                                        //              // Add this if statement
                                        //              try {
                                        //                     Mail::send(
                                        //                         'mail.Categorymail',
                                        //                         ['data' => $NonConformance],
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
                                    if ($request->non_conformances_category == 'major' || $request->non_conformances_category == 'minor' || $request->non_conformances_category == 'critical') {
                                        $list = Helpers::getCorporateEHSHeadUserList();
                                                // foreach ($list as $u) {
                                                //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                                                //         $email = Helpers::getInitiatorEmail($u->user_id);
                                                //         if ($email !== null) {
                                                //              // Add this if statement
                                                //              try {
                                                //                     Mail::send(
                                                //                         'mail.Categorymail',
                                                //                         ['data' => $NonConformance],
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

                    $NonConformance->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($NonConformance->stage == 4) {

                    // CFT review state update form_progress
                    if ($NonConformance->form_progress !== 'cft')
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


                    $IsCFTRequired = NonConformanceCFTResponse::withoutTrashed()->where(['is_required' => 1, 'non_conformances_id' => $id])->latest()->first();
                    $cftUsers = DB::table('non_conformance_c_f_ts')->where(['non_conformances_id' => $id])->first();
                    // Define the column names
                    $columns = ['Production_person', 'Warehouse_notification', 'Quality_Control_Person', 'QualityAssurance_person', 'Engineering_person', 'Analytical_Development_person', 'Kilo_Lab_person', 'Technology_transfer_person', 'Environment_Health_Safety_person', 'Human_Resource_person', 'Information_Technology_person', 'Project_management_person','Other1_person','Other2_person','Other3_person','Other4_person','Other5_person'];
                    // $columns2 = ['Production_review', 'Warehouse_review', 'Quality_Control_review', 'QualityAssurance_review', 'Engineering_review', 'Analytical_Development_review', 'Kilo_Lab_review', 'Technology_transfer_review', 'Environment_Health_Safety_review', 'Human_Resource_review', 'Information_Technology_review', 'Project_management_review'];

                    // Initialize an array to store the values
                    $valuesArray = [];

                    // Iterate over the columns and retrieve the values
                    foreach ($columns as $index => $column) {
                        $value = $cftUsers->$column;
                        if($index == 0 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Production_by = Auth::user()->name;
                            $updateCFT->production_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 1 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Warehouse_by = Auth::user()->name;
                            $updateCFT->Warehouse_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 4 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Engineering_by = Auth::user()->name;
                            $updateCFT->Engineering_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 2 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Quality_Control_by = Auth::user()->name;
                            $updateCFT->Quality_Control_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 3 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->QualityAssurance_by = Auth::user()->name;
                            $updateCFT->QualityAssurance_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 5 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Analytical_Development_by = Auth::user()->name;
                            $updateCFT->Analytical_Development_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 6 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Kilo_Lab_attachment_by = Auth::user()->name;
                            $updateCFT->Kilo_Lab_attachment_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 7 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Technology_transfer_by = Auth::user()->name;
                            $updateCFT->Technology_transfer_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 8 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Environment_Health_Safety_by = Auth::user()->name;
                            $updateCFT->Environment_Health_Safety_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 9 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Human_Resource_by = Auth::user()->name;
                            $updateCFT->Human_Resource_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 10 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Information_Technology_by = Auth::user()->name;
                            $updateCFT->Information_Technology_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 11 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Project_management_by = Auth::user()->name;
                            $updateCFT->Project_management_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 12 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Other1_by = Auth::user()->name;
                            $updateCFT->Other1_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 13 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Other2_by = Auth::user()->name;
                            $updateCFT->Other2_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 14 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Other3_by = Auth::user()->name;
                            $updateCFT->Other3_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 15 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Other4_by = Auth::user()->name;
                            $updateCFT->Other4_on = Carbon::now()->format('Y-m-d');
                        }
                        if($index == 16 && $cftUsers->$column == Auth::user()->id){
                            $updateCFT->Other5_by = Auth::user()->name;
                            $updateCFT->Other5_on = Carbon::now()->format('Y-m-d');
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
                            $stage = new NonConformanceCFTResponse();
                            $stage->non_conformances_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "Completed";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        } else {
                            $stage = new NonConformanceCFTResponse();
                            $stage->non_conformances_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "In-progress";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        }
                    }

                    $checkCFTCount = NonConformanceCFTResponse::withoutTrashed()->where(['status' => 'Completed', 'non_conformances_id' => $id])->count();
                    // dd(count(array_unique($valuesArray)), $checkCFTCount);


                    if (!$IsCFTRequired || $checkCFTCount) {

                        $NonConformance->stage = "5";
                        $NonConformance->status = "QA Final Review";
                        $NonConformance->CFT_Review_Complete_By = Auth::user()->name;
                        $NonConformance->CFT_Review_Complete_On = Carbon::now()->format('d-M-Y');
                        $NonConformance->CFT_Review_Comments = $request->comment;

                        $history = new NonConformanceAuditTrails();
                        $history->non_conformances_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->action='CFT Review Complete';
                        $history->current = $NonConformance->CFT_Review_Complete_By;
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
                        //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                        //         $email = Helpers::getInitiatorEmail($u->user_id);
                        //         if ($email !== null) {
                        //             try {
                        //                 Mail::send(
                        //                     'mail.view-mail',
                        //                     ['data' => $NonConformance],
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
                        $NonConformance->update();
                    }
                    toastr()->success('Document Sent');
                    return back();
                }

                if ($NonConformance->stage == 5) {

                    if ($NonConformance->form_progress === 'capa' && !empty($NonConformance->QA_Feedbacks))
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


                    $NonConformance->stage = "6";
                    $NonConformance->status = "QA Head/Manager Designee Approval";
                    $NonConformance->QA_Final_Review_Complete_By = Auth::user()->name;
                    $NonConformance->QA_Final_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $NonConformance->QA_Final_Review_Comments = $request->comment;

                    $history = new NonConformanceAuditTrails();
                    $history->non_conformances_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->current = $NonConformance->QA_Final_Review_Complete_By;
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
                    //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $NonConformance],
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
                    $NonConformance->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($NonConformance->stage == 6) {

                    if ($NonConformance->form_progress !== 'qah')
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

                    $extension = Extension::where('parent_id', $NonConformance->id)->first();

                    $rca = RootCauseAnalysis::where('parent_record', str_pad($NonConformance->id, 4, 0, STR_PAD_LEFT))->first();

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

                    $NonConformance->stage = "7";
                    $NonConformance->status = "Pending Initiator Update";
                    $NonConformance->QA_head_approved_by = Auth::user()->name;
                    $NonConformance->QA_head_approved_on = Carbon::now()->format('d-M-Y');
                    $NonConformance->QA_head_approved_comment	 = $request->comment;

                    $history = new NonConformanceAuditTrails();
                    $history->non_conformances_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action ='Approved';
                    $history->current = $NonConformance->QA_head_approved_by;
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
                    //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $NonConformance],
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
                    $NonConformance->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($NonConformance->stage == 7) {

                    if ($NonConformance->form_progress !== 'qah')
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

                    $extension = Extension::where('parent_id', $NonConformance->id)->first();

                    $rca = RootCauseAnalysis::where('parent_record', str_pad($NonConformance->id, 4, 0, STR_PAD_LEFT))->first();

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

                    $NonConformance->stage = "8";
                    $NonConformance->status = "QA Final Approval";
                    $NonConformance->pending_initiator_approved_by = Auth::user()->name;
                    $NonConformance->pending_initiator_approved_on = Carbon::now()->format('d-M-Y');
                    $NonConformance->pending_initiator_approved_comment = $request->comment;

                    $history = new NonConformanceAuditTrails();
                    $history->non_conformances_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action ='Initiator Updated Complete';
                    $history->current = $NonConformance->pending_initiator_approved_by;
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
                    //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $NonConformance],
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
                    $NonConformance->update();
                    toastr()->success('Document Sent');
                    return back();
                }


                if ($NonConformance->stage == 8) {

                    if ($NonConformance->form_progress !== 'qah')
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

                    $extension = Extension::where('parent_id', $NonConformance->id)->first();

                    $rca = RootCauseAnalysis::where('parent_record', str_pad($NonConformance->id, 4, 0, STR_PAD_LEFT))->first();

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

                    $NonConformance->stage = "9";
                    $NonConformance->status = "Closed-Done";
                    $NonConformance->QA_final_approved_by = Auth::user()->name;
                    $NonConformance->QA_final_approved_on = Carbon::now()->format('d-M-Y');
                    $NonConformance->QA_final_approved_comment = $request->comment;

                    $history = new NonConformanceAuditTrails();
                    $history->non_conformances_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action ='Closed-Done';
                    $history->current = $NonConformance->QA_final_approved_by;
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
                    //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $NonConformance],
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
                    $NonConformance->update();
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
            $NonConformance = NonConformance::find($id);
            $lastDocument = NonConformance::find($id);
            $cftDetails = NonConformanceCFTResponse::withoutTrashed()->where(['status' => 'In-progress', 'non_conformances_id' => $id])->distinct('cft_user_id')->count();

                $NonConformance->stage = "5";
                $NonConformance->status = "QA Final Review";
                $NonConformance->QA_Initial_Review_Complete_By = Auth::user()->name;
                // dd($NonConformance->QA_Initial_Review_Complete_By);
                $NonConformance->QA_Initial_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $NonConformance->QA_Initial_Review_Comments = $request->comment;

                $history = new NonConformanceAuditTrails();
                $history->non_conformances_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action ='QA Final Review Complete';
                $history->current = $NonConformance->QA_Initial_Review_Complete_By;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'Approved';
                $history->save();
                // $list = Helpers::getQAUserList();
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $NonConformance],
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
                $NonConformance->update();
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
            $NonConformance = NonConformance::find($id);
            $lastDocument = NonConformance::find($id);

            if ($NonConformance->stage == 2) {
                $NonConformance->stage = "2";
                $NonConformance->status = "Opened";
                $NonConformance->qa_more_info_required_by = Auth::user()->name;
                $NonConformance->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new NonConformanceAuditTrails();
                $history->non_conformances_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $NonConformance->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'HOD Review';
                $history->save();
                $NonConformance->update();
                $history = new NonConformanceHistories();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $NonConformance->stage;
                $history->status = $NonConformance->status;
                $history->save();
                // $list = Helpers::getHodUserList();
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $NonConformance],
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
            if ($NonConformance->stage == 3) {
                $NonConformance->stage = "2";
                $NonConformance->status = "HOD Review";
                $NonConformance->qa_more_info_required_by = Auth::user()->name;
                $NonConformance->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new NonConformanceAuditTrails();
                $history->non_conformances_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $NonConformance->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->save();
                $NonConformance->update();
                $history = new NonConformanceHistories();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $NonConformance->stage;
                $history->status = $NonConformance->status;
                $history->save();
                // $list = Helpers::getHodUserList();
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $NonConformance->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $NonConformance],
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

            if ($NonConformance->stage == 4) {
                $NonConformance->stage = "3";
                $NonConformance->status = "QA Initial Review";
                $NonConformance->qa_more_info_required_by = Auth::user()->name;
                $NonConformance->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new NonConformanceAuditTrails();
                $history->non_conformances_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $NonConformance->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->save();
                $NonConformance->update();
                $history = new NonConformanceHistories();
                $history->type = "Failure Investigation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $NonConformance->stage;
                $history->status = $NonConformance->status;
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }



    public function NonConformaceAuditTrail($id)
    {
        $audit = NonConformanceAuditTrails::where('non_conformances_id', $id)->orderByDesc('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = NonConformance::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');

        return view('frontend.non-conformance.audit-trail', compact('audit', 'document', 'today'));
    }

    public function NonConformanceAuditTrailPdf($id)
    {
        $doc = NonConformance::find($id);
        $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        $data = NonConformanceAuditTrails::where('non_conformances_id', $doc->id)->orderByDesc('id')->get();
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.non-conformance.audit-trail-pdf', compact('data', 'doc'))
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
        $data = NonConformance::find($id);

        $data1 =  NonConformanceCFTs::where('non_conformances_id', $id)->first();
        if (!empty ($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $grid_data = NonConformanceGrid::where('non_conformances_grid_id', $id)->where('type', "NonConformance")->first();
            $grid_data1 = NonConformanceGrid::where('non_conformances_grid_id', $id)->where('type', "Document")->first();

            $investigationTeam = NonConformanceGridDatas::where(['non_conformances_id' => $id, 'identifier' => 'TeamInvestigation'])->first();
            $investigation_data = json_decode($investigationTeam->data, true);

            $rootCause = NonConformanceGridDatas::where(['non_conformances_id' => $id, 'identifier' => 'RootCause'])->first();
            $root_cause_data = json_decode($rootCause->data,true);

            $whyData = NonConformanceGridDatas::where(['non_conformances_id' => $id, 'identifier' => 'why'])->first();
            $why_data = json_decode($whyData->data,true);

            $capaExtension = NonConformanceLunchExtension::where(['non_conformances_id' => $id, "extension_identifier" => "Capa"])->first();
            $qrmExtension = NonConformanceLunchExtension::where(['non_conformances_id' => $id, "extension_identifier" => "QRM"])->first();
            $investigationExtension = NonConformanceLunchExtension::where(['non_conformances_id' => $id, "extension_identifier" => "Investigation"])->first();

            $grid_data_qrms = NonConformanceGridModes::where(['non_conformances_id' => $id, 'identifier' => 'failure_mode_qrms'])->first();
            $grid_data_matrix_qrms = NonConformanceGridModes::where(['non_conformances_id' => $id, 'identifier' => 'matrix_qrms'])->first();

            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.non-conformance.single-report', compact('data','grid_data_qrms','grid_data_matrix_qrms','data1','capaExtension','qrmExtension','grid_data','grid_data1','investigation_data','root_cause_data','why_data','investigationExtension'))
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
}
