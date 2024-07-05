<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Incident,
IncidentAuditTrail,
IncidentCft,
IncidentCftResponse,
IncidentGrid,
IncidentGridData,
IncidentGridFailureMode,
IncidentHistory,
IncidentLaunchExtension,
};
use App\Models\RootCauseAnalysis;
use App\Models\EffectivenessCheck;
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

class IncidentController extends Controller
{
    public function index(Request $request){

        $old_record = Incident::select('id', 'division_id', 'record')->get();
        $currentDate = Carbon::now();
        $data = ((RecordNumber::first()->value('counter')) + 1);
        $data = str_pad($data, 4, '0', STR_PAD_LEFT);
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $pre = Incident::all();
        return response()->view('frontend.incident.incident-new', compact('formattedDate','data', 'due_date', 'old_record', 'pre'));
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

        $incident = new Incident();
        $incident->form_type = "Incident";

        $incident->record = ((RecordNumber::first()->value('counter')) + 1);
        $incident->initiator_id = Auth::user()->id;

        $incident->form_progress = isset($form_progress) ? $form_progress : null;

        # -------------new-----------
        //  $incident->record_number = $request->record_number;
        $incident->division_id = $request->division_id;
        $incident->assign_to = $request->assign_to;
        $incident->Facility = $request->Facility;
        $incident->due_date = $request->due_date;
        $incident->intiation_date = $request->intiation_date;
        $incident->Initiator_Group = $request->Initiator_Group;
        $incident->due_date = Carbon::now()->addDays(30)->format('d-M-Y');
        $incident->initiator_group_code = $request->initiator_group_code;
        $incident->short_description = $request->short_description;
        $incident->incident_date = $request->incident_date;
        $incident->incident_time = $request->incident_time;
        $incident->incident_reported_date = $request->incident_reported_date;
        if (is_array($request->audit_type)) {
            $incident->audit_type = implode(',', $request->audit_type);
        }
        $incident->short_description_required = $request->short_description_required;
        $incident->nature_of_repeat = $request->nature_of_repeat;
        $incident->others = $request->others;

        $incident->Product_Batch = $request->Product_Batch;

        $incident->Description_incident = implode(',', $request->Description_incident);
        $incident->Immediate_Action = implode(',', $request->Immediate_Action);
        $incident->Preliminary_Impact = implode(',', $request->Preliminary_Impact);
        $incident->Product_Details_Required = $request->Product_Details_Required;

        $incident->HOD_Remarks = $request->HOD_Remarks;
        $incident->incident_category = $request->incident_category;
        if($request->incident_category=='')
        $incident->Justification_for_categorization = $request->Justification_for_categorization;
        $incident->Investigation_required = $request->Investigation_required;
        $incident->capa_required = $request->capa_required;
        $incident->qrm_required = $request->qrm_required;

        $incident->Investigation_Details = $request->Investigation_Details;
        $incident->Customer_notification = $request->Customer_notification;
        $incident->customers = $request->customers;
        $incident->QAInitialRemark = $request->QAInitialRemark;

        $incident->Investigation_Summary = $request->Investigation_Summary;
        $incident->Impact_assessment = $request->Impact_assessment;
        $incident->Root_cause = $request->Root_cause;
        $incident->CAPA_Rquired = $request->CAPA_Rquired;
        $incident->capa_type = $request->capa_type;
        $incident->CAPA_Description = $request->CAPA_Description;
        $incident->Post_Categorization = $request->Post_Categorization;
        $incident->Investigation_Of_Review = $request->Investigation_Of_Review;
        $incident->QA_Feedbacks = $request->QA_Feedbacks;
        $incident->Closure_Comments = $request->Closure_Comments;
        $incident->Disposition_Batch = $request->Disposition_Batch;
        $incident->department_head = $request->department_head;
        $incident->qa_reviewer  = $request->qa_reviewer;
        $incident->Facility_Equipment = $request->Facility_Equipment;
        $incident->detail_of_root = $request->detail_of_root;
        $incident->Document_Details_Required = $request->Document_Details_Required;

        if ($request->incident_category == 'major' || $request->incident_category == 'minor' || $request->incident_category == 'critical') {
            $list = Helpers::getHeadoperationsUserList();
                    foreach ($list as $u) {
                        if ($u->q_m_s_divisions_id == $incident->division_id) {
                            $email = Helpers::getInitiatorEmail($u->user_id);
                            if ($email !== null) {
                                 // Add this if statement
                                try {
                                    Mail::send(
                                        'mail.Categorymail',
                                        ['data' => $incident],
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


                if ($request->incident_category == 'major' || $request->incident_category == 'minor' || $request->incident_category == 'critical') {
                    $list = Helpers::getCEOUserList();
                            foreach ($list as $u) {
                                if ($u->q_m_s_divisions_id == $incident->division_id) {
                                    $email = Helpers::getInitiatorEmail($u->user_id);
                                    if ($email !== null) {
                                         // Add this if statement
                                         try {
                                                Mail::send(
                                                    'mail.Categorymail',
                                                    ['data' => $incident],
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
                        if ($request->incident_category == 'major' || $request->incident_category == 'minor' || $request->incident_category == 'critical') {
                            $list = Helpers::getCorporateEHSHeadUserList();
                                    foreach ($list as $u) {
                                        if ($u->q_m_s_divisions_id == $incident->division_id) {
                                            $email = Helpers::getInitiatorEmail($u->user_id);
                                            if ($email !== null) {
                                                 // Add this if statement
                                                 try {
                                                        Mail::send(
                                                            'mail.Categorymail',
                                                            ['data' => $incident],
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
                                                if ($u->q_m_s_divisions_id == $incident->division_id) {
                                                    $email = Helpers::getInitiatorEmail($u->user_id);
                                                    if ($email !== null) {
                                                         // Add this if statement
                                                         try {
                                                            Mail::send(
                                                                'mail.Categorymail',
                                                                ['data' => $incident],
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
                                                        if ($u->q_m_s_divisions_id == $incident->division_id) {
                                                            $email = Helpers::getInitiatorEmail($u->user_id);
                                                            if ($email !== null) {
                                                                 // Add this if statement
                                                                 try {
                                                                        Mail::send(
                                                                            'mail.Categorymail',
                                                                            ['data' => $incident],
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
                                                                if ($u->q_m_s_divisions_id == $incident->division_id) {
                                                                    $email = Helpers::getInitiatorEmail($u->user_id);
                                                                    if ($email !== null) {
                                                                         // Add this if statement
                                                                         try {
                                                                                Mail::send(
                                                                                    'mail.Categorymail',
                                                                                    ['data' => $incident],
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

     if (!empty ($request->Initial_attachment)) {

   $files = [];

if ($incident->Initial_attachment) {
    $existingFiles = json_decode($incident->Initial_attachment, true); // Convert to associative array
    if (is_array($existingFiles)) {
        $files = $existingFiles;
    }
    // $files = is_array(json_decode($NonConformance->Audit_file)) ? $NonConformance->Audit_file : [];
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


            $incident->Audit_file = json_encode($files);
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


            $incident->initial_file = json_encode($files);
        }
        //dd($request->Initial_attachment);


        if (!empty ($request->QA_attachment)) {
            $files = [];
            if ($request->hasfile('QA_attachment')) {
                foreach ($request->file('QA_attachment') as $file) {
                    $name = $request->name . 'QA_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $incident->QA_attachment = json_encode($files);
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


            $incident->Investigation_attachment = json_encode($files);
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


            $incident->Capa_attachment = json_encode($files);
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


            $incident->QA_attachments = json_encode($files);
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


            $incident->closure_attachment = json_encode($files);
        }

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();



        $incident->status = 'Opened';
        $incident->stage = 1;

        $incident->save();

            $teamInvestigationData = IncidentGridData::where(['incident_id' => $incident->id,'identifier' => "TeamInvestigation"])->firstOrCreate();
            $teamInvestigationData->incident_id = $incident->id;
            $teamInvestigationData->identifier = "TeamInvestigation";
            $teamInvestigationData->data = $request->investigationTeam;
            $teamInvestigationData->save();

            $rootCauseData = IncidentGridData::where(['incident_id' => $incident->id,'identifier' => "RootCause"])->firstOrCreate();
            $rootCauseData->incident_id = $incident->id;
            $rootCauseData->identifier = "RootCause";
            $rootCauseData->data = $request->rootCauseData;
            $rootCauseData->save();

            $newDataGridWhy = IncidentGridData::where(['incident_id' => $incident->id, 'identifier' => 'why'])->firstOrCreate();
            $newDataGridWhy->incident_id = $incident->id;
            $newDataGridWhy->identifier = 'why';
            $newDataGridWhy->data = $request->why;
            $newDataGridWhy->save();

            $newDataGridFishbone = IncidentGridData::where(['incident_id' => $incident->id, 'identifier' => 'fishbone'])->firstOrCreate();
            $newDataGridFishbone->incident_id = $incident->id;
            $newDataGridFishbone->identifier = 'fishbone';
            $newDataGridFishbone->data = $request->fishbone;
            $newDataGridFishbone->save();



        $newDataGridqrms = IncidentGridFailureMode::where(['incident_id' => $incident->id, 'identifier' => 'failure_mode_qrms'])->firstOrCreate();
        $newDataGridqrms->incident_id = $incident->id;
        $newDataGridqrms->identifier = 'failure_mode_qrms';
        $newDataGridqrms->data = $request->failure_mode_qrms;
        // dd($newDataGridqrms->data);
        $newDataGridqrms->save();


        $matrixDataGridqrms = IncidentGridFailureMode::where(['incident_id' => $incident->id, 'identifier' => 'matrix_qrms'])->firstOrCreate();
        $matrixDataGridqrms->incident_id = $incident->id;
        $matrixDataGridqrms->identifier = 'matrix_qrms';
        $matrixDataGridqrms->data = $request->matrix_qrms;
        $matrixDataGridqrms->save();



        $data3 = new IncidentGrid();
        $data3->incident_grid_id = $incident->id;
        $data3->type = "Incident";
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
        $data4 = new IncidentGrid();
        $data4->incident_grid_id = $incident->id;
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

        $data5 = new IncidentGrid();
        $data5->incident_grid_id = $incident->id;
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

        $Cft = new IncidentCft();
        $Cft->incident_id = $incident->id;
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

            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = Auth::user()->name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current = $incident->due_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = "Null";
            $history->current = Carbon::now()->format('d-M-Y');
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

        if (!empty ($request->short_description)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $incident->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty ($request->Initiator_Group)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Department';
            $history->previous = "Null";
            $history->current = $incident->Initiator_Group;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->incident_date)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Incident Observed';
            $history->previous = "Null";
            $history->current = $incident->incident_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (is_array($request->Facility) && $request->Facility[0] !== null){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Observed by';
            $history->previous = "Null";
            $history->current = $incident->Facility;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->incident_reported_date)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Incident Reported on';
            $history->previous = "Null";
            $history->current = $incident->incident_reported_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if ($request->audit_type[0] !== null){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Incident Related To';
            $history->previous = "Null";
            $history->current = $incident->audit_type;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->others)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Others';
            $history->previous = "Null";
            $history->current = $incident->others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->action_name = 'Create';
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->save();
        }
        if (!empty ($request->Facility_Equipment)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Facility/ Equipment/ Instrument/ System Details Required?';
            $history->previous = "Null";
            $history->current = $incident->Facility_Equipment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Document_Details_Required)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Document Details Required';
            $history->previous = "Null";
            $history->current = $incident->Document_Details_Required;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Product_Batch)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Name of Product & Batch No';
            $history->previous = "Null";
            $history->current = $incident->Product_Batch;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if ($request->Description_incident[0] !== null){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Description of Incident';
            $history->previous = "Null";
            $history->current = $incident->Description_incident;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if ($request->Immediate_Action[0] !== null){
            $history = new IncidentAuditTrail();
        $history->incident_id = $incident->id;
        $history->activity_type = 'Immediate Action (if any)';
        $history->previous = "Null";
        $history->current = $incident->Immediate_Action;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->change_to =   "Opened";
            $history->change_from = "Initiator";
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $incident->status;
        $history->action_name = 'Create';
        $history->save();
        }
        if ($request->Preliminary_Impact[0] !== null){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Preliminary Impact of Incident';
            $history->previous = "Null";
            $history->current = $incident->Preliminary_Impact;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->action_name = 'Create';
            $history->save();
        }

        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }


    public function incidentShow($id)
    {
        $old_record = Incident::select('id', 'division_id', 'record')->get();
        $data = Incident::find($id);
        $userData = User::all();
        $data1 = IncidentCft::where('incident_id', $id)->latest()->first();
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $grid_data = IncidentGrid::where('incident_grid_id', $id)->where('type', "Incident")->first();
        $grid_data1 = IncidentGrid::where('incident_grid_id', $id)->where('type', "Document")->first();
        $grid_data2 = IncidentGrid::where('incident_grid_id', $id)->where('type', "Product")->first();
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        // dd($data->initiator_id);
        $pre = Incident::all();
        $divisionName = DB::table('q_m_s_divisions')->where('id', $data->division_id)->value('name');

        $incidentNewGrid = IncidentGridData::where('incident_id', $id)->latest()->first();

         $investigation_data = IncidentGridData::where(['incident_id' => $id, 'identifier' => 'investication'])->first();

        // $why_data = IncidentGridData::where(['incident_id' => $id, 'identifier' => 'why'])->first();
        // $fishbone_data = IncidentGridData::where(['incident_id' => $id, 'identifier' => 'fishbone'])->first();

        $jsonData = IncidentGridFailureMode::where(['incident_id' => $id, 'identifier' => 'failure_mode_qrms'])->first();
        $grid_data_qrms = json_decode($jsonData->data, true);


        $jsonData = IncidentGridFailureMode::where(['incident_id' => $id, 'identifier' => 'matrix_qrms'])->first();
        $grid_data_matrix_qrms = json_decode($jsonData->data, true);

        $capaExtension = IncidentLaunchExtension::where(['incident_id' => $id, "extension_identifier" => "Capa"])->first();
        $qrmExtension = IncidentLaunchExtension::where(['incident_id' => $id, "extension_identifier" => "QRM"])->first();
        $investigationExtension = IncidentLaunchExtension::where(['incident_id' => $id, "extension_identifier" => "Investigation"])->first();
        $incidentExtension = IncidentLaunchExtension::where(['incident_id' => $id, "extension_identifier" => "Incident"])->first();

        $investigationTeam = IncidentGridData::where(['incident_id' => $id, 'identifier' =>'TeamInvestigation'])->first();
        $investigationTeamData = json_decode($investigationTeam->data, true);

        $rootCause = IncidentGridData::where(['incident_id' => $id, 'identifier' =>'RootCause'])->first();
        $rootCauseData = json_decode($rootCause->data, true);


        $whyData = IncidentGridData::where(['incident_id' => $id, 'identifier' => 'why'])->first();
        $why_data = json_decode($whyData->data, true);


        $fishbone = IncidentGridData::where(['incident_id' => $id, 'identifier' =>'fishbone'])->first();
        $fishbone_data = json_decode($fishbone->data, true);

        return view('frontend.incident.incident-view', compact('data','userData', 'grid_data_qrms','grid_data_matrix_qrms', 'capaExtension','qrmExtension','investigationExtension','incidentExtension', 'old_record', 'pre', 'data1', 'divisionName','grid_data','grid_data1', 'incidentNewGrid','grid_data2','investigationTeamData','rootCauseData', 'why_data', 'fishbone_data'));
    }


    public function update(Request $request, $id)
    {
        $form_progress = null;

        $lastIncident = Incident::find($id);
        $incident = Incident::find($id);
        $incident->Delay_Justification = $request->Delay_Justification;

        if ($request->incident_category == 'major' || $request->incident_category == 'critical')
        {
            $incident->Investigation_required = "yes";
            $incident->capa_required = "yes";
            $incident->qrm_required = "yes";
        }

        if ($request->incident_category == 'minor')
        {
            $incident->Investigation_required = $request->Investigation_required;
            $incident->capa_required = $request->capa_required;
            $incident->qrm_required = $request->qrm_required;
        }

        if ($request->form_name == 'general-open')
        {

            // dd($request->Delay_Justification);
            $validator = Validator::make($request->all(), [
                'Initiator_Group' => 'required',
                'short_description' => 'required',
                'short_description_required' => 'required|in:Recurring,Non_Recurring',
                'nature_of_repeat' => 'required_if:short_description_required,Recurring',
                'incident_date' => 'required',
                'incident_time' => 'required',
                'incident_reported_date' => 'required',
                'Delay_Justification' => [
                    function ($attribute, $value, $fail) use ($request) {
                        $incident_date = Carbon::parse($request->incident_date);
                        $reported_date = Carbon::parse($request->incident_reported_date);
                        $diff_in_days = $reported_date->diffInDays($incident_date);
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
                // 'Description_incident' => [
                //     'required',
                //     'array',
                //     function($attribute, $value, $fail) {
                //         if (count($value) === 1 && reset($value) === null) {
                //             return $fail('Description of Incident must not be empty!.');
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
                'audit_type' => 'Incident related to field required!'
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
                'incident_category' => 'required|not_in:0',
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
                $incident->capa_number = $request->capa_number ? $request->capa_number : $incident->capa_number;
                $incident->department_capa = $request->department_capa ? $request->department_capa : $incident->department_capa;
                $incident->source_of_capa = $request->source_of_capa ? $request->source_of_capa : $incident->source_of_capa;
                $incident->capa_others = $request->capa_others ? $request->capa_others : $incident->capa_others;
                $incident->source_doc = $request->source_doc ? $request->source_doc : $incident->source_doc;
                $incident->Description_of_Discrepancy = $request->Description_of_Discrepancy ? $request->Description_of_Discrepancy : $incident->Description_of_Discrepancy;
                $incident->capa_root_cause = $request->capa_root_cause ? $request->capa_root_cause : $incident->capa_root_cause;
                $incident->Immediate_Action_Take = $request->Immediate_Action_Take ? $request->Immediate_Action_Take : $incident->Immediate_Action_Take;
                $incident->Corrective_Action_Details = $request->Corrective_Action_Details ? $request->Corrective_Action_Details : $incident->Corrective_Action_Details;
                $incident->Preventive_Action_Details = $request->Preventive_Action_Details ? $request->Preventive_Action_Details : $incident->Preventive_Action_Details;
                $incident->capa_completed_date = $request->capa_completed_date ? $request->capa_completed_date : $incident->capa_completed_date;
                $incident->Interim_Control = $request->Interim_Control ? $request->Interim_Control : $incident->Interim_Control;
                $incident->Corrective_Action_Taken = $request->Corrective_Action_Taken ? $request->Corrective_Action_Taken : $incident->Corrective_Action_Taken;
                $incident->Preventive_action_Taken = $request->Preventive_action_Taken ? $request->Preventive_action_Taken : $incident->Preventive_action_Taken;
                $incident->CAPA_Closure_Comments = $request->CAPA_Closure_Comments ? $request->CAPA_Closure_Comments : $incident->CAPA_Closure_Comments;

                 if (!empty ($request->CAPA_Closure_attachment)) {
                    $files = [];
                    if ($request->hasfile('CAPA_Closure_attachment')) {

                        foreach ($request->file('CAPA_Closure_attachment') as $file) {
                            $name = 'capa_closure_attachment-' . time() . '.' . $file->getClientOriginalExtension();
                            $file->move('upload/', $name);
                            $files[] = $name;
                        }
                    }
                    $incident->CAPA_Closure_attachment = json_encode($files);

                }
                $incident->update();
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

        $incident->assign_to = $request->assign_to;
        $incident->Initiator_Group = $request->Initiator_Group;

        if ($incident->stage < 3) {
            $incident->short_description = $request->short_description;
        } else {
            $incident->short_description = $incident->short_description;
        }
        $incident->initiator_group_code = $request->initiator_group_code;
        $incident->incident_reported_date = $request->incident_reported_date;
        $incident->incident_date = $request->incident_date;
        $incident->incident_time = $request->incident_time;
        $incident->Delay_Justification = $request->Delay_Justification;
        // $incident->audit_type = implode(',', $request->audit_type);
        if (is_array($request->audit_type)) {
            $incident->audit_type = implode(',', $request->audit_type);
        }
        $incident->short_description_required = $request->short_description_required;
        $incident->nature_of_repeat = $request->nature_of_repeat;
        $incident->others = $request->others;
        $incident->Product_Batch = $request->Product_Batch;

        $incident->Description_incident = $request->Description_incident;
        if ($request->related_records) {
            $incident->Related_Records1 =  implode(',', $request->related_records);
        }
        $incident->Facility = $request->Facility;
        $incident->department_head = $request->department_head;
        $incident->qa_reviewer  = $request->qa_reviewer;
        $incident->detail_of_root = $request->detail_of_root;


        $incident->Immediate_Action = implode(',', $request->Immediate_Action);
        $incident->Preliminary_Impact = implode(',', $request->Preliminary_Impact);
        $incident->Product_Details_Required = $request->Product_Details_Required;


        $incident->HOD_Remarks = $request->HOD_Remarks;
        $incident->Justification_for_categorization = !empty($request->Justification_for_categorization) ? $request->Justification_for_categorization : $incident->Justification_for_categorization;

        $incident->Investigation_Details = !empty($request->Investigation_Details) ? $request->Investigation_Details : $incident->Investigation_Details;

        $incident->QAInitialRemark = $request->QAInitialRemark;
        $incident->Investigation_Summary = $request->Investigation_Summary;
        $incident->Impact_assessment = $request->Impact_assessment;
        $incident->Root_cause = $request->Root_cause;

        $incident->Conclusion = $request->Conclusion;
        $incident->Identified_Risk = $request->Identified_Risk;
        $incident->severity_rate = $request->severity_rate ? $request->severity_rate : $incident->severity_rate;
        $incident->Occurrence = $request->Occurrence ? $request->Occurrence : $incident->Occurrence;
        $incident->detection = $request->detection ? $request->detection: $incident->detection;

        $newDataGridqrms = IncidentGridFailureMode::where(['incident_id' => $id, 'identifier' =>
        'failure_mode_qrms'])->firstOrCreate();
        $newDataGridqrms->incident_id = $id;
        $newDataGridqrms->identifier = 'failure_mode_qrms';
        $newDataGridqrms->data = $request->failure_mode_qrms;
        $newDataGridqrms->save();

        $matrixDataGridqrms = IncidentGridFailureMode::where(['incident_id' => $id, 'identifier' => 'matrix_qrms'])->firstOrCreate();
        $matrixDataGridqrms->incident_id = $id;
        $matrixDataGridqrms->identifier = 'matrix_qrms';
        $matrixDataGridqrms->data = $request->matrix_qrms;
        $matrixDataGridqrms->save();

        if ($incident->stage < 6) {
            $incident->CAPA_Rquired = $request->CAPA_Rquired;
        }

        if ($incident->stage < 6) {
            $incident->capa_type = $request->capa_type;
        }

        $incident->CAPA_Description = !empty($request->CAPA_Description) ? $request->CAPA_Description : $incident->CAPA_Description;
        $incident->Post_Categorization = !empty($request->Post_Categorization) ? $request->Post_Categorization : $incident->Post_Categorization;
        $incident->Investigation_Of_Review = $request->Investigation_Of_Review;
        $incident->QA_Feedbacks = $request->has('QA_Feedbacks') ? $request->QA_Feedbacks : $incident->QA_Feedbacks;
        $incident->Closure_Comments = $request->Closure_Comments;
        $incident->Disposition_Batch = $request->Disposition_Batch;
        $incident->Facility_Equipment = $request->Facility_Equipment;
        $incident->Document_Details_Required = $request->Document_Details_Required;

        if ($incident->stage == 3)
        {
            $incident->Customer_notification = $request->Customer_notification;
            // $incident->Investigation_required = $request->Investigation_required;
            // $incident->capa_required = $request->capa_required;
            // $incident->qrm_required = $request->qrm_required;
            $incident->incident_category = $request->incident_category;
            $incident->QAInitialRemark = $request->QAInitialRemark;
            // $incident->customers = $request->customers;
        }

        if($incident->stage == 3 || $incident->stage == 4 ){


            if (!$form_progress) {
                $form_progress = 'cft';
            }

            $Cft = IncidentCft::withoutTrashed()->where('incident_id', $id)->first();
            if($Cft && $incident->stage == 4 ){
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
                $IsCFTRequired = IncidentCftResponse::withoutTrashed()->where(['is_required' => 1, 'incident_id' => $id])->latest()->first();
                $cftUsers = DB::table('incident_cfts')->where(['incident_id' => $id])->first();
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
                                    ['data' => $incident],
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

                if ($incident->Initial_attachment) {
                    $files = is_array(json_decode($incident->Initial_attachment)) ? $incident->Initial_attachment : [];
                }

                if ($request->hasfile('Initial_attachment')) {
                    foreach ($request->file('Initial_attachment') as $file) {
                        $name = $request->name . 'Initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }

                $incident->Initial_attachment = json_encode($files);

            }



        }


        if (!empty ($request->Audit_file)) {

            $files = [];

            if ($incident->Audit_file) {
                $existingFiles = json_decode($incident->Audit_file, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($incident->Audit_file)) ? $incident->Audit_file : [];
            }

            if ($request->hasfile('Audit_file')) {
                foreach ($request->file('Audit_file') as $file) {
                    $name = $request->name . 'Audit_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $incident->Audit_file = json_encode($files);
        }

        if (!empty ($request->hod_attachments)) {

            $files = [];

            if ($incident->hod_attachments) {
                $existingFiles = json_decode($incident->hod_attachments, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($incident->Audit_file)) ? $incident->Audit_file : [];
            }

            if ($request->hasfile('hod_attachments')) {
                foreach ($request->file('hod_attachments') as $file) {
                    $name = $request->name . 'hod_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $incident->hod_attachments = json_encode($files);
        }
        if (!empty($request->initial_file)) {
            $files = [];

            // Decode existing files if they exist
            if ($incident->initial_file) {
                $existingFiles = json_decode($incident->initial_file, true); // Convert to associative array
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
            $incident->initial_file = json_encode($files);
        }

        if (!empty ($request->QA_attachment)) {
            $files = [];

            if ($incident->QA_attachment) {
                $existingFiles = json_decode($incident->QA_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($incident->QA_attachment)) ? $incident->QA_attachment : [];
            }

            if ($request->hasfile('QA_attachment')) {
                foreach ($request->file('QA_attachment') as $file) {
                    $name = $request->name . 'QA_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $incident->QA_attachment = json_encode($files);
        }

        if (!empty ($request->Investigation_attachment)) {

            $files = [];

            if ($incident->Investigation_attachment) {
                $existingFiles = json_decode($incident->Investigation_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($incident->QA_attachment)) ? $incident->QA_attachment : [];
            }

            if ($request->hasfile('Investigation_attachment')) {
                foreach ($request->file('Investigation_attachment') as $file) {
                    $name = $request->name . 'Investigation_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $incident->Investigation_attachment = json_encode($files);
        }

        if (!empty ($request->Capa_attachment)) {

            $files = [];

            if ($incident->Capa_attachment) {
                $existingFiles = json_decode($incident->Capa_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($incident->Capa_attachment)) ? $incident->Capa_attachment : [];
            }

            if ($request->hasfile('Capa_attachment')) {
                foreach ($request->file('Capa_attachment') as $file) {
                    $name = $request->name . 'Capa_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $incident->Capa_attachment = json_encode($files);
        }
        if (!empty ($request->QA_attachments)) {

            $files = [];

            if ($incident->QA_attachments) {
                $files = is_array(json_decode($incident->QA_attachments)) ? $incident->QA_attachments : [];
            }

            if ($request->hasfile('QA_attachments')) {
                foreach ($request->file('QA_attachments') as $file) {
                    $name = $request->name . 'QA_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $incident->QA_attachments = json_encode($files);
        }

        if (!empty ($request->closure_attachment)) {

            $files = [];

            if ($incident->closure_attachment) {
                $existingFiles = json_decode($incident->closure_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($incident->closure_attachment)) ? $incident->closure_attachment : [];
            }

            if ($request->hasfile('closure_attachment')) {
                foreach ($request->file('closure_attachment') as $file) {
                    $name = $request->name . 'closure_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $incident->closure_attachment = json_encode($files);
        }
        if($incident->stage > 0){


            //investiocation dynamic
            $incident->Discription_Event = $request->Discription_Event;
            $incident->objective = $request->objective;
            $incident->scope = $request->scope;
            $incident->imidiate_action = $request->imidiate_action;
            $incident->investigation_approach = is_array($request->investigation_approach) ? implode(',', $request->investigation_approach) : '';
            $incident->attention_issues = $request->attention_issues;
            $incident->attention_actions = $request->attention_actions;
            $incident->attention_remarks = $request->attention_remarks;
            $incident->understanding_issues = $request->understanding_issues;
            $incident->understanding_actions = $request->understanding_actions;
            $incident->understanding_remarks = $request->understanding_remarks;
            $incident->procedural_issues = $request->procedural_issues;
            $incident->procedural_actions = $request->procedural_actions;
            $incident->procedural_remarks = $request->procedural_remarks;
            $incident->behavioiral_issues = $request->behavioiral_issues;
            $incident->behavioiral_actions = $request->behavioiral_actions;
            $incident->behavioiral_remarks = $request->behavioiral_remarks;
            $incident->skill_issues = $request->skill_issues;
            $incident->skill_actions = $request->skill_actions;
            $incident->skill_remarks = $request->skill_remarks;
            $incident->what_will_be = $request->what_will_be;
            $incident->what_will_not_be = $request->what_will_not_be;
            $incident->what_rationable = $request->what_rationable;
            $incident->where_will_be = $request->where_will_be;
            $incident->where_will_not_be = $request->where_will_not_be;
            $incident->where_rationable = $request->where_rationable;
            $incident->when_will_not_be = $request->when_will_not_be;
            $incident->when_will_be = $request->when_will_be;
            $incident->when_rationable = $request->when_rationable;
            $incident->coverage_will_be = $request->coverage_will_be;
            $incident->coverage_will_not_be = $request->coverage_will_not_be;
            $incident->coverage_rationable = $request->coverage_rationable;
            $incident->who_will_be = $request->who_will_be;
            $incident->who_will_not_be = $request->who_will_not_be;
            $incident->who_rationable = $request->who_rationable;

            // dd($id);

            $teamInvestigationData = IncidentGridData::where(['incident_id' => $incident->id,'identifier' => "TeamInvestigation"])->firstOrCreate();
            $teamInvestigationData->incident_id = $incident->id;
            $teamInvestigationData->identifier = "TeamInvestigation";
            $teamInvestigationData->data = $request->investigationTeam;
            $teamInvestigationData->save();

            $rootCauseData = IncidentGridData::where(['incident_id' => $incident->id,'identifier' => "RootCause"])->firstOrCreate();
            $rootCauseData->incident_id = $incident->id;
            $rootCauseData->identifier = "RootCause";
            $rootCauseData->data = $request->rootCauseData;
            $rootCauseData->save();

            $newDataGridWhy = IncidentGridData::where(['incident_id' => $id, 'identifier' => 'why'])->firstOrCreate();
            $newDataGridWhy->incident_id = $id;
            $newDataGridWhy->identifier = 'why';
            $newDataGridWhy->data = $request->why;
            $newDataGridWhy->save();

            $newDataGridFishbone = IncidentGridData::where(['incident_id' => $id, 'identifier' => 'fishbone'])->firstOrCreate();
            $newDataGridFishbone->incident_id = $id;
            $newDataGridFishbone->identifier = 'fishbone';
            $newDataGridFishbone->data = $request->fishbone;
            $newDataGridFishbone->save();

        }


        $incident->form_progress = isset($form_progress) ? $form_progress : null;
        $incident->update();
        // grid
         $data3=IncidentGrid::where('incident_grid_id', $incident->id)->where('type', "Incident")->first();
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


            $data4=IncidentGrid::where('incident_grid_id', $incident->id)->where('type', "Document")->first();
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

            $data5=IncidentGrid::where('incident_grid_id', $incident->id)->where('type', "Product")->first();
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


        if ($lastIncident->short_description != $incident->short_description || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Short Description';
             $history->previous = $lastIncident->short_description;
            $history->current = $incident->short_description;
            $history->comment = $incident->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastIncident->Initiator_Group != $incident->Initiator_Group || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Initiator Group';
            $history->previous = $lastIncident->Initiator_Group;
            $history->current = $incident->Initiator_Group;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->incident_date != $incident->incident_date || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Incident Observed';
            $history->previous = $lastIncident->incident_date;
            $history->current = $incident->incident_date;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Observed_by != $incident->Observed_by || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Observed by';
            $history->previous = $lastIncident->Observed_by;
            $history->current = $incident->Observed_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->incident_reported_date != $incident->incident_reported_date || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Incident Reported on';
            $history->previous = $lastIncident->incident_reported_date;
            $history->current = $incident->incident_reported_date;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->audit_type != $incident->audit_type || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Incident Related To';
            $history->previous = $lastIncident->audit_type;
            $history->current = $incident->audit_type;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Others != $incident->Others || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Others';
            $history->previous = $lastIncident->Others;
            $history->current = $incident->Others;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Facility_Equipment != $incident->Facility_Equipment || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Facility/ Equipment/ Instrument/ System Details Required?';
            $history->previous = $lastIncident->Facility_Equipment;
            $history->current = $incident->Facility_Equipment;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Document_Details_Required != $incident->Document_Details_Required || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Document Details Required';
            $history->previous = $lastIncident->Document_Details_Required;
            $history->current = $incident->Document_Details_Required;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Product_Batch != $incident->Product_Batch || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Name of Product & Batch No';
            $history->previous = $lastIncident->Product_Batch;
            $history->current = $incident->Product_Batch;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Description_incident != $incident->Description_incident || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Description of Incident';
            $history->previous = $lastIncident->Description_incident;
            $history->current = $incident->Description_incident;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Immediate_Action != $incident->Immediate_Action || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Immediate Action (if any)';
            $history->previous = $lastIncident->Immediate_Action;
            $history->current = $incident->Immediate_Action;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Preliminary_Impact != $incident->Preliminary_Impact || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Preliminary Impact of Incident';
            $history->previous = $lastIncident->Preliminary_Impact;
            $history->current = $incident->Preliminary_Impact;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->HOD_Remarks != $incident->HOD_Remarks || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'HOD Remarks';
            $history->previous = $lastIncident->HOD_Remarks;
            $history->current = $incident->HOD_Remarks;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->incident_category != $incident->incident_category || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Initial Incident Category';
            $history->previous = $lastIncident->incident_category;
            $history->current = $incident->incident_category;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Justification_for_categorization != $incident->Justification_for_categorization || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Justification for Categorization';
            $history->previous = $lastIncident->Justification_for_categorization;
            $history->current = $incident->Justification_for_categorization;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Investigation_required != $incident->Investigation_required || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Investigation Is required ?';
            $history->previous = $lastIncident->Investigation_required;
            $history->current = $incident->Investigation_required;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Investigation_Details != $incident->Investigation_Details || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Investigation Details';
            $history->previous = $lastIncident->Investigation_Details;
            $history->current = $incident->Investigation_Details;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Customer_notification != $incident->Customer_notification || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Customer Notification Required ?';
            $history->previous = $lastIncident->Customer_notification;
            $history->current = $incident->Customer_notification;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->customers != $incident->customers || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Customer';
            $history->previous = $lastIncident->customers;
            $history->current = $incident->customers;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->QAInitialRemark != $incident->QAInitialRemark || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'QA Initial Remarks';
            $history->previous = $lastIncident->QAInitialRemark;
            $history->current = $incident->QAInitialRemark;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Investigation_Summary != $incident->Investigation_Summary || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Investigation Summary';
            $history->previous = $lastIncident->Investigation_Summary;
            $history->current = $incident->Investigation_Summary;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->action_name = 'Update';
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->save();
        }

        if ($lastIncident->Impact_assessment != $incident->Impact_assessment || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Impact Assessment';
            $history->previous = $lastIncident->Impact_assessment;
            $history->current = $incident->Impact_assessment;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Root_cause != $incident->Root_cause || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Root Cause';
            $history->previous = $lastIncident->Root_cause;
            $history->current = $incident->Root_cause;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->CAPA_Rquired != $incident->CAPA_Rquired || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'CAPA Required ?';
            $history->previous = $lastIncident->CAPA_Rquired;
            $history->current = $incident->CAPA_Rquired;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->capa_type != $incident->capa_type || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'CAPA Type?';
            $history->previous = $lastIncident->capa_type;
            $history->current = $incident->capa_type;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->CAPA_Description != $incident->CAPA_Description || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'CAPA Description';
            $history->previous = $lastIncident->CAPA_Description;
            $history->current = $incident->CAPA_Description;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Post_Categorization != $incident->Post_Categorization || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Post Categorization Of Incident';
            $history->previous = $lastIncident->Post_Categorization;
            $history->current = $incident->Post_Categorization;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Investigation_Of_Review != $incident->Investigation_Of_Review || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Investigation Of Revised Categorization';
            $history->previous = $lastIncident->Investigation_Of_Review;
            $history->current = $incident->Investigation_Of_Review;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->QA_Feedbacks != $incident->QA_Feedbacks || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'QA Feedbacks';
            $history->previous = $lastIncident->QA_Feedbacks;
            $history->current = $incident->QA_Feedbacks;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Closure_Comments != $incident->Closure_Comments || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Closure Comments';
            $history->previous = $lastIncident->Closure_Comments;
            $history->current = $incident->Closure_Comments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastIncident->Disposition_Batch != $incident->Disposition_Batch || !empty ($request->comment)) {
            // return 'history';
            $history = new IncidentAuditTrail;
            $history->incident_id = $id;
            $history->activity_type = 'Disposition of Batch';
            $history->previous = $lastIncident->Disposition_Batch;
            $history->current = $incident->Disposition_Batch;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastIncident->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastIncident->status;
            $history->action_name = 'Update';
            $history->save();
        }

        toastr()->success('Record is Update Successfully');

        return back();
    }


    public function launchExtensionIncident(Request $request, $id){
        $incident = Incident::find($id);
        $getCounter = IncidentLaunchExtension::where(['incident_id' => $incident->id, 'extension_identifier' => "Incident"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($incident->id != null){
            $data = IncidentLaunchExtension::where([
                'incident_id' => $incident->id,
                'extension_identifier' => "Incident"
            ])->firstOrCreate();

            $data->incident_id = $request->incident_id;
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
        $incident = Incident::find($id);
        $getCounter = IncidentLaunchExtension::where(['incident_id' => $incident->id, 'extension_identifier' => "Capa"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($incident->id != null){

            $data = IncidentLaunchExtension::where([
                'incident_id' => $incident->id,
                'extension_identifier' => "Capa"
            ])->firstOrCreate();

            $data->incident_id = $request->incident_id;
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
        $incident = Incident::find($id);
        $getCounter = IncidentLaunchExtension::where(['incident_id' => $incident->id, 'extension_identifier' => "QRM"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($incident->id != null){

            $data = IncidentLaunchExtension::where([
                'incident_id' => $incident->id,
                'extension_identifier' => "QRM"
            ])->firstOrCreate();

            $data->incident_id = $request->incident_id;
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
        $incident = Incident::find($id);
        $getCounter = IncidentLaunchExtension::where(['incident_id' => $incident->id, 'extension_identifier' => "Investigation"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($incident->id != null){

            $data = IncidentLaunchExtension::where([
                'incident_id' => $incident->id,
                'extension_identifier' => "Investigation"
            ])->firstOrCreate();

            $data->incident_id = $request->incident_id;
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

    public function incidentReject(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            // return $request;
            $incident = Incident::find($id);
            $lastDocument = Incident::find($id);
            $list = Helpers::getInitiatorUserList();


            if ($incident->stage == 2) {

                $incident->stage = "1";
                $incident->status = "Opened";
                $incident->rejected_by = Auth::user()->name;
                $incident->rejected_on = Carbon::now()->format('d-M-Y');
                $incident->update();
                $history = new IncidentHistory();
                $history->type = "Incident";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $incident->stage;
                $history->status = "Opened";
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $incident],
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
            if ($incident->stage == 3) {
                $incident->stage = "2";
                $incident->status = "HOD Review";
                $incident->form_progress = 'hod';
                $incident->qa_more_info_required_by = Auth::user()->name;
                $incident->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $incident->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->save();
                $incident->update();
                $history = new IncidentHistory();
                $history->type = "Incident";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $incident->stage;
                $history->status = "More Info Required";

                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $incident],
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
            if ($incident->stage == 4) {

                $cftResponse = IncidentCftResponse::withoutTrashed()->where(['incident_id' => $id])->get();

                // Soft delete all records
                $cftResponse->each(function ($response) {
                    $response->delete();
                });

                $stage = new IncidentCftResponse();
                $stage->incident_id = $id;
                $stage->cft_user_id = Auth::user()->id;
                $stage->status = "More Info Required";
                // $stage->cft_stage = ;
                $stage->comment = $request->comment;
                $stage->save();

                $incident->stage = "3";
                $incident->status = "QA Initial Review";
                $incident->form_progress = 'qa';

                $incident->qa_more_info_required_by = Auth::user()->name;
                $incident->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $incident->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->save();
                $incident->update();
                $history = new IncidentHistory();
                $history->type = "Incident";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $incident->stage;
                $history->status = "More Info Required";
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $incident],
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

            if ($incident->stage == 6) {
                $incident->stage = "5";
                $incident->status = "QA Final Review";
                $incident->form_progress = 'capa';

                $incident->qa_more_info_required_by = Auth::user()->name;
                $incident->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $incident->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                // dd();
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $incident],
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
                $incident->update();
                $history = new IncidentHistory();
                $history->type = "Incident";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $incident->stage;
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

    public function incidentCancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $incident = Incident::find($id);
            $lastDocument = Incident::find($id);

            $incident->stage = "0";
            $incident->status = "Closed-Cancelled";
            $incident->cancelled_by = Auth::user()->name;
            $incident->cancelled_on = Carbon::now()->format('d-M-Y');
            $history = new IncidentAuditTrail();
            $history->incident_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = "";
            $history->current = $incident->cancelled_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->stage = 'Cancelled';
            $history->save();
            $incident->update();
            $history = new IncidentHistory();
            $history->type = "Incident";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $incident->stage;
            $history->status = $incident->status;
            $history->save();

            // $list = Helpers::getInitiatorUserList();
            // foreach ($list as $u) {
            //     if ($u->q_m_s_divisions_id == $incident->division_id) {
            //         $email = Helpers::getInitiatorEmail($u->user_id);
            //         if ($email !== null) {

            //             try {
            //                 Mail::send(
            //                     'mail.view-mail',
            //                     ['data' => $incident],
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

    public function incidentIsCFTRequired(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $incident = Incident::find($id);
            $lastDocument = Incident::find($id);
            $list = Helpers::getInitiatorUserList();
            $incident->stage = "5";
            $incident->status = "QA Final Review";
            $incident->CFT_Review_Complete_By = Auth::user()->name;
            $incident->CFT_Review_Complete_On = Carbon::now()->format('d-M-Y');
            $history = new IncidentAuditTrail();
            $history->incident_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = "";
            $history->current = $incident->CFT_Review_Complete_By;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage = 'Send to HOD';
            // foreach ($list as $u) {
            //     if ($u->q_m_s_divisions_id == $incident->division_id) {
            //         $email = Helpers::getInitiatorEmail($u->user_id);
            //         if ($email !== null) {

            //             try {
            //                 Mail::send(
            //                     'mail.view-mail',
            //                     ['data' => $incident],
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
            $incident->update();
            $history = new IncidentHistory();
            $history->type = "Incident";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $incident->stage;
            $history->status = $incident->status;
            $history->save();

            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function incidentCheck(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $incident = Incident::find($id);
            $lastDocument = Incident::find($id);
            $cftResponse = IncidentCftResponse::withoutTrashed()->where(['incident_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();
           // Soft delete all records
           $cftResponse->each(function ($response) {
            $response->delete();
        });


        $incident->stage = "1";
        $incident->status = "Opened";
        $incident->qa_more_info_required_by = Auth::user()->name;
        $incident->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
        $history = new IncidentAuditTrail();
        $history->incident_id = $id;
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $incident->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to Initiator';
        $history->save();
        $incident->update();
        $history = new IncidentHistory();
        $history->type = "Incident";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $incident->stage;
        $history->status = "Send to Initiator";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $incident->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $incident],
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
        $incident->update();
        toastr()->success('Document Sent');
        return back();

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function incidentCheck2(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $incident = Incident::find($id);
            $lastDocument = Incident::find($id);
            $cftResponse = IncidentCftResponse::withoutTrashed()->where(['incident_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();

        // Soft delete all records
        $cftResponse->each(function ($response) {
            $response->delete();
        });
        $incident->stage = "2";
        $incident->status = "HOD Review";
        $incident->qa_more_info_required_by = Auth::user()->name;
        $incident->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
        $history = new IncidentAuditTrail();
        $history->incident_id = $id;
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $incident->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to HOD';
        $history->save();
        $incident->update();
        $history = new IncidentHistory();
        $history->type = "Incident";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $incident->stage;
        $history->status = "Send to HOD Review";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $incident->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $incident],
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
        $incident->update();
        toastr()->success('Document Sent');
        return back();

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function incidentCheck3(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $incident = Incident::find($id);
            $lastDocument = Incident::find($id);
            $cftResponse = IncidentCftResponse::withoutTrashed()->where(['incident_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();

        // Soft delete all records
        $cftResponse->each(function ($response) {
            $response->delete();
        });
        $incident->stage = "3";
            $incident->status = "QA Initial Review";
            $incident->qa_more_info_required_by = Auth::user()->name;
            $incident->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
        $history = new IncidentAuditTrail();
        $history->incident_id = $id;
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $incident->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to HOD';
        $history->save();
        $incident->update();
        $history = new IncidentHistory();
        $history->type = "Incident";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $incident->stage;
        $history->status = "Send to QA Initial Review";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $incident->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $incident],
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
        $incident->update();
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
            $incident = Incident::find($id);
            $lastDocument = Incident::find($id);
            // $cftResponse = IncidentCftResponse::withoutTrashed()->where(['incident_id' => $id])->get();
            $list = Helpers::getInitiatorUserList();
           // Soft delete all records
        //    $cftResponse->each(function ($response) {
        //     $response->delete();
        // });


        $incident->stage = "7";
        $incident->status = "Pending Initiator Update";
        $incident->qa_more_info_required_by = Auth::user()->name;
        $incident->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
        $history = new IncidentAuditTrail();
        $history->incident_id = $id;
        $history->activity_type = 'Activity Log';
        $history->previous = "";
        $history->current = $incident->qa_more_info_required_by;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->stage = 'Send to Pending Initiator Update';
        $history->save();
        $incident->update();
        $history = new IncidentHistory();
        $history->type = "Incident";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $incident->stage;
        $history->status = "Send to Pending Initiator Update";
        $history->save();
        // foreach ($list as $u) {
        //     if ($u->q_m_s_divisions_id == $incident->division_id) {
        //         $email = Helpers::getInitiatorEmail($u->user_id);
        //         if ($email !== null) {

        //             try {
        //                 Mail::send(
        //                     'mail.view-mail',
        //                     ['data' => $incident],
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
        $incident->update();
        toastr()->success('Document Sent');
        return back();

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function incident_send_stage(Request $request, $id)
    {
        try {
            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $incident = Incident::find($id);
                $updateCFT = IncidentCft::where('incident_id', $id)->latest()->first();
                $lastDocument = Incident::find($id);
                $cftDetails = IncidentCftResponse::withoutTrashed()->where(['status' => 'In-progress', 'incident_id' => $id])->distinct('cft_user_id')->count();

                if ($incident->stage == 1) {
                    if ($incident->form_progress !== 'general-open')
                    {
                        // dd('emnter');
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

                    $incident->stage = "2";
                    $incident->status = "HOD Review";
                    $incident->submit_by = Auth::user()->name;
                    $incident->submit_on = Carbon::now()->format('d-M-Y');
                    $incident->submit_comment = $request->comment;

                    $history = new IncidentAuditTrail();
                    $history->incident_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action='Submit';
                    $history->current = $incident->submit_by;
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
                    //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {

                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $incident],
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
                    //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {

                    //             Mail::send(
                    //                 'mail.Categorymail',
                    //                 ['data' => $incident],
                    //                 function ($message) use ($email) {
                    //                     $message->to($email)
                    //                         ->subject("Activity Performed By " . Auth::user()->name);
                    //                 }
                    //             );
                    //         }
                    //     }
                    // }
                    // dd($incident);
                    $incident->update();
                    return back();
                }
                if ($incident->stage == 2) {

                    // Check HOD remark value
                    if (!$incident->HOD_Remarks) {

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

                    $incident->stage = "3";
                    $incident->status = "QA Initial Review";
                    $incident->HOD_Review_Complete_By = Auth::user()->name;
                    $incident->HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $incident->HOD_Review_Comments = $request->comment;
                    $history = new IncidentAuditTrail();
                    $history->incident_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->current = $incident->HOD_Review_Complete_By;
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
                    //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $incident],
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


                    $incident->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($incident->stage == 3) {
                    if ($incident->form_progress !== 'cft')
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

                    $incident->stage = "4";
                    $incident->status = "CFT Review";

                    // Code for the CFT required
                    $stage = new IncidentCftResponse();
                    $stage->incident_id = $id;
                    $stage->cft_user_id = Auth::user()->id;
                    $stage->status = "CFT Required";
                    // $stage->cft_stage = ;
                    $stage->comment = $request->comment;
                    $stage->is_required = 1;
                    $stage->save();

                    $incident->QA_Initial_Review_Complete_By = Auth::user()->name;
                    $incident->QA_Initial_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $incident->QA_Initial_Review_Comments = $request->comment;
                    $history = new IncidentAuditTrail();
                    $history->incident_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action= 'QA Initial Review Complete';
                    $history->current = $incident->QA_Initial_Review_Complete_By;
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
                    //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $incident],
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

                    if ($request->Incident_category == 'major' || $request->Incident_category == 'minor' || $request->Incident_category == 'critical') {
                        $list = Helpers::getHeadoperationsUserList();
                                // foreach ($list as $u) {
                                //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                                //         $email = Helpers::getInitiatorEmail($u->user_id);
                                //         if ($email !== null) {
                                //              try {
                                //                     Mail::send(
                                //                         'mail.Categorymail',
                                //                         ['data' => $incident],
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
                            if ($request->Incident_category == 'major' || $request->Incident_category == 'minor' || $request->Incident_category == 'critical') {
                                $list = Helpers::getCEOUserList();
                                        // foreach ($list as $u) {
                                        //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                                        //         $email = Helpers::getInitiatorEmail($u->user_id);
                                        //         if ($email !== null) {
                                        //              // Add this if statement
                                        //              try {
                                        //                     Mail::send(
                                        //                         'mail.Categorymail',
                                        //                         ['data' => $incident],
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
                                    if ($request->Incident_category == 'major' || $request->Incident_category == 'minor' || $request->Incident_category == 'critical') {
                                        $list = Helpers::getCorporateEHSHeadUserList();
                                                // foreach ($list as $u) {
                                                //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                                                //         $email = Helpers::getInitiatorEmail($u->user_id);
                                                //         if ($email !== null) {
                                                //              // Add this if statement
                                                //              try {
                                                //                     Mail::send(
                                                //                         'mail.Categorymail',
                                                //                         ['data' => $incident],
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

                    $incident->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($incident->stage == 4) {

                    // CFT review state update form_progress
                    if ($incident->form_progress !== 'cft')
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


                    $IsCFTRequired = IncidentCftResponse::withoutTrashed()->where(['is_required' => 1, 'incident_id' => $id])->latest()->first();
                    $cftUsers = DB::table('incident_cfts')->where(['incident_id' => $id])->first();
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
                            $stage = new IncidentCftResponse();
                            $stage->incident_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "Completed";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        } else {
                            $stage = new IncidentCftResponse();
                            $stage->incident_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "In-progress";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        }
                    }

                    $checkCFTCount = IncidentCftResponse::withoutTrashed()->where(['status' => 'Completed', 'incident_id' => $id])->count();
                    // dd(count(array_unique($valuesArray)), $checkCFTCount);


                    if (!$IsCFTRequired || $checkCFTCount) {

                        $incident->stage = "5";
                        $incident->status = "QA Final Review";
                        $incident->CFT_Review_Complete_By = Auth::user()->name;
                        $incident->CFT_Review_Complete_On = Carbon::now()->format('d-M-Y');
                        $incident->CFT_Review_Comments = $request->comment;

                        $history = new IncidentAuditTrail();
                        $history->incident_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->action='CFT Review Complete';
                        $history->current = $incident->CFT_Review_Complete_By;
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
                        //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                        //         $email = Helpers::getInitiatorEmail($u->user_id);
                        //         if ($email !== null) {
                        //             try {
                        //                 Mail::send(
                        //                     'mail.view-mail',
                        //                     ['data' => $incident],
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
                        $incident->update();
                    }
                    toastr()->success('Document Sent');
                    return back();
                }

                if ($incident->stage == 5) {

                    if ($incident->form_progress === 'capa' && !empty($incident->QA_Feedbacks))
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


                    $incident->stage = "6";
                    $incident->status = "QA Head/Manager Designee Approval";
                    $incident->QA_Final_Review_Complete_By = Auth::user()->name;
                    $incident->QA_Final_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $incident->QA_Final_Review_Comments = $request->comment;

                    $history = new IncidentAuditTrail();
                    $history->incident_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->current = $incident->QA_Final_Review_Complete_By;
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
                    //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $incident],
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
                    $incident->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($incident->stage == 6) {

                    if ($incident->form_progress !== 'qah')
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
                            'message' => 'Incident sent to Intiator Update'
                        ]);
                    }

                    $extension = Extension::where('parent_id', $incident->id)->first();

                    $rca = RootCauseAnalysis::where('parent_record', str_pad($incident->id, 4, 0, STR_PAD_LEFT))->first();

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

                    $incident->stage = "7";
                    $incident->status = "Pending Initiator Update";
                    $incident->QA_head_approved_by = Auth::user()->name;
                    $incident->QA_head_approved_on = Carbon::now()->format('d-M-Y');
                    $incident->QA_head_approved_comment	 = $request->comment;

                    $history = new IncidentAuditTrail();
                    $history->incident_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action ='Approved';
                    $history->current = $incident->QA_head_approved_by;
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
                    //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $incident],
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
                    $incident->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($incident->stage == 7) {

                    if ($incident->form_progress !== 'qah')
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
                            'message' => 'Incident sent to QA Final Approval.'
                        ]);
                    }

                    $extension = Extension::where('parent_id', $incident->id)->first();

                    $rca = RootCauseAnalysis::where('parent_record', str_pad($incident->id, 4, 0, STR_PAD_LEFT))->first();

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

                    $incident->stage = "8";
                    $incident->status = "QA Final Approval";
                    $incident->pending_initiator_approved_by = Auth::user()->name;
                    $incident->pending_initiator_approved_on = Carbon::now()->format('d-M-Y');
                    $incident->pending_initiator_approved_comment = $request->comment;

                    $history = new IncidentAuditTrail();
                    $history->incident_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action ='Initiator Updated Complete';
                    $history->current = $incident->pending_initiator_approved_by;
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
                    //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $incident],
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
                    $incident->update();
                    toastr()->success('Document Sent');
                    return back();
                }


                if ($incident->stage == 8) {

                    if ($incident->form_progress !== 'qah')
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
                            'message' => 'Incident sent to Closed/Done state'
                        ]);
                    }

                    $extension = Extension::where('parent_id', $incident->id)->first();

                    $rca = RootCauseAnalysis::where('parent_record', str_pad($incident->id, 4, 0, STR_PAD_LEFT))->first();

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

                    $incident->stage = "9";
                    $incident->status = "Closed-Done";
                    $incident->QA_final_approved_by = Auth::user()->name;
                    $incident->QA_final_approved_on = Carbon::now()->format('d-M-Y');
                    $incident->QA_final_approved_comment = $request->comment;

                    $history = new IncidentAuditTrail();
                    $history->incident_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action ='Closed-Done';
                    $history->current = $incident->QA_final_approved_by;
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
                    //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $incident],
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
                    $incident->update();
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
            $incident = Incident::find($id);
            $lastDocument = Incident::find($id);
            $cftDetails = IncidentCftResponse::withoutTrashed()->where(['status' => 'In-progress', 'incident_id' => $id])->distinct('cft_user_id')->count();

                $incident->stage = "5";
                $incident->status = "QA Final Review";
                $incident->QA_Initial_Review_Complete_By = Auth::user()->name;
                // dd($incident->QA_Initial_Review_Complete_By);
                $incident->QA_Initial_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $incident->QA_Initial_Review_Comments = $request->comment;

                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action ='QA Final Review Complete';
                $history->current = $incident->QA_Initial_Review_Complete_By;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'Approved';
                $history->save();
                // $list = Helpers::getQAUserList();
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $incident],
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
                $incident->update();
                toastr()->success('Document Sent');
                return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function incident_qa_more_info(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $incident = Incident::find($id);
            $lastDocument = Incident::find($id);

            if ($incident->stage == 2) {
                $incident->stage = "2";
                $incident->status = "Opened";
                $incident->qa_more_info_required_by = Auth::user()->name;
                $incident->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $incident->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'HOD Review';
                $history->save();
                $incident->update();
                $history = new IncidentHistory();
                $history->type = "Incident";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $incident->stage;
                $history->status = $incident->status;
                $history->save();
                // $list = Helpers::getHodUserList();
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $incident],
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
            if ($incident->stage == 3) {
                $incident->stage = "2";
                $incident->status = "HOD Review";
                $incident->qa_more_info_required_by = Auth::user()->name;
                $incident->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $incident->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->save();
                $incident->update();
                $history = new IncidentHistory();
                $history->type = "Incident";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $incident->stage;
                $history->status = $incident->status;
                $history->save();
                // $list = Helpers::getHodUserList();
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $incident],
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

            if ($incident->stage == 4) {
                $incident->stage = "3";
                $incident->status = "QA Initial Review";
                $incident->qa_more_info_required_by = Auth::user()->name;
                $incident->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Information Required';
                $history->current = $incident->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->save();
                $incident->update();
                $history = new IncidentHistory();
                $history->type = "Incident";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $incident->stage;
                $history->status = $incident->status;
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function incidentAuditTrail($id)
    {
        $audit = IncidentAuditTrail::where('incident_id', $id)->orderByDesc('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = Incident::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');

        return view('frontend.incident.audit-trail', compact('audit', 'document', 'today'));
    }

    public function incidentAuditTrailPdf($id)
    {
        $doc = Incident::find($id);
        $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        $data = IncidentAuditTrail::where('incident_id', $doc->id)->orderByDesc('id')->get();
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.incident.audit-trail-pdf', compact('data', 'doc'))
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

    public static function singleReport($id)
    {
        $data = Incident::find($id);
        $data1 =  IncidentCft::where('incident_id', $id)->first();
        if (!empty ($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $grid_data = IncidentGrid::where('incident_grid_id', $id)->where('type', "Incident")->first();
            $grid_data1 = IncidentGrid::where('incident_grid_id', $id)->where('type', "Document")->first();

            $json_decode = IncidentGridData::where(['incident_id' => $id, 'identifier' => 'TeamInvestigation'])->first();
            $investigation_data = json_decode($json_decode->data, true);

            $json_decode = IncidentGridData::where(['incident_id' => $id, 'identifier' => 'RootCause'])->first();
            $root_cause_data = json_decode($json_decode->data,true);

            $json_decode = IncidentGridData::where(['incident_id' => $id, 'identifier' => 'why'])->first();
            $why_data = json_decode($json_decode->data, true);

            $capaExtension = IncidentLaunchExtension::where(['incident_id' => $id, "extension_identifier" => "Capa"])->first();
            $qrmExtension = IncidentLaunchExtension::where(['incident_id' => $id, "extension_identifier" => "QRM"])->first();
            $investigationExtension = IncidentLaunchExtension::where(['incident_id' => $id, "extension_identifier" => "Investigation"])->first();

            $json_decode = IncidentGridFailureMode::where(['incident_id' => $id, 'identifier' => 'failure_mode_qrms'])->first();
            $grid_data_qrms =  json_decode($json_decode->data,true);

            $json_decode = IncidentGridFailureMode::where(['incident_id' => $id, 'identifier' => 'matrix_qrms'])->first();
            $grid_data_matrix_qrms = json_decode($json_decode->data,true);
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.incident.single-report', compact('data','grid_data_qrms','grid_data_matrix_qrms','data1','capaExtension','qrmExtension','grid_data','grid_data1','investigation_data','root_cause_data','why_data','investigationExtension'))
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
