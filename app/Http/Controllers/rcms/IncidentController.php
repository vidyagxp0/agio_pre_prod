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
//dd($pre);
        return response()->view('frontend.incident.incident-new', compact('formattedDate','data', 'due_date', 'old_record', 'pre'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $form_progress = null;

        if ($request->form_name == 'general')
        {
            $validator = Validator::make($request->all(), [
                // 'Initiator_Group' => 'required',
                'short_description' => 'required'

            ], [
                // 'Initiator_Group.required' => 'Department field required!',
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
        $incident->Initiator_Group =$request->Initiator_Group;

        $incident->division_code = $request->division_code;
        $incident->initiator_group_code = $request->initiator_group_code;
        // $incident->due_date = Carbon::now()->addDays(30)->format('d-M-Y');
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
//  dd($incident->others);
        $incident->Product_Batch = $request->Product_Batch;

        $incident->Description_incident = implode(',', $request->Description_incident);
        // dd($incident->Description_incident );
        // $incident->Immediate_Action = implode(',', $request->Immediate_Action);
        // $incident->Preliminary_Impact = implode(',', $request->Preliminary_Impact);
        $incident->Product_Details_Required = $request->Product_Details_Required;
        $incident->qa_final_review = $request->qa_final_review;
        $incident->investigation = $request->investigation;
        $incident->Delay_Justification = $request->Delay_Justification;
        $incident->immediate_correction = $request->immediate_correction;
        $incident->review_of_verific = $request->review_of_verific;
        $incident->Recommendations = $request->Recommendations;
        $incident->Impact_Assessmenta = $request->Impact_Assessmenta;
        $incident->HOD_Remarks = $request->HOD_Remarks;
        $incident->qa_head_Remarks = $request->qa_head_Remarks;
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
        // $incident->equipment_name = $request->equipment_name;
        // $incident->instrument_name = $request->instrument_name;
        // $incident->inc_facility_name = $request->inc_facility_name;
        $incident->product_quality_imapct = $request->product_quality_imapct;
        $incident->process_performance_impact = $request->process_performance_impact;
        $incident->yield_impact = $request->yield_impact;
        $incident->gmp_impact = $request->gmp_impact;

        $incident->additionl_testing_required = $request->additionl_testing_required;
        $incident->any_similar_incident_in_past = $request->any_similar_incident_in_past;
        $incident->classification_by_qa = $request->classification_by_qa;
        $incident->capa_require = $request->capa_require;

        $incident->deviation_required = $request->deviation_required;
        $incident->capa_implementation = $request->capa_implementation;
        $incident->check_points = $request->check_points;
        $incident->corrective_actions = $request->corrective_actions;
        $incident->batch_release = $request->batch_release;
        $incident->closure_ini = $request->closure_ini;
        $incident->affected_documents = $request->affected_documents;
        $incident->qa_head_deginee_comment = $request->qa_head_deginee_comment;

        // dd($incident->product_quality_imapct);
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

                            //     if ($request->Post_Categorization == 'major' || $request->Post_Categorization == 'minor' || $request->Post_Categorization == 'critical')
                            //     {
                            //            $list = Helpers::getHeadoperationsUserList();
                            //                 foreach ($list as $u) {
                            //                     if ($u->q_m_s_divisions_id == $incident->division_id) {
                            //                         $email = Helpers::getInitiatorEmail($u->user_id);
                            //                         if ($email !== null) {
                            //                              // Add this if statement
                            //                              try {
                            //                                 Mail::send(
                            //                                     'mail.Categorymail',
                            //                                     ['data' => $incident],
                            //                                     function ($message) use ($email) {
                            //                                         $message->to($email)
                            //                                             ->subject("Activity Performed By " . Auth::user()->name);
                            //                                     }
                            //                                 );
                            //                             } catch (\Exception $e) {
                            //                                 //log error
                            //                             }

                            //                         }
                            //                     }
                            //                 }
                            //    }
                                    //     if ($request->Post_Categorization == 'major' || $request->Post_Categorization == 'minor' || $request->Post_Categorization == 'critical') {
                                    //         $list = Helpers::getCEOUserList();
                                    //                 foreach ($list as $u) {
                                    //                     if ($u->q_m_s_divisions_id == $incident->division_id) {
                                    //                         $email = Helpers::getInitiatorEmail($u->user_id);
                                    //                         if ($email !== null) {
                                    //                              // Add this if statement
                                    //                              try {
                                    //                                     Mail::send(
                                    //                                         'mail.Categorymail',
                                    //                                         ['data' => $incident],
                                    //                                         function ($message) use ($email) {
                                    //                                             $message->to($email)
                                    //                                                 ->subject("Activity Performed By " . Auth::user()->name);
                                    //                                         }
                                    //                                     );
                                    //                                 } catch (\Exception $e) {
                                    //                                     //log error
                                    //                                 }

                                    //                         }
                                    //                     }
                                    //                 }
                                    //             }
                                    //             if ($request->Post_Categorization == 'major' || $request->Post_Categorization == 'minor' || $request->Post_Categorization == 'critical') {
                                    //                 $list = Helpers::getCorporateEHSHeadUserList();
                                    //                         foreach ($list as $u) {
                                    //                             if ($u->q_m_s_divisions_id == $incident->division_id) {
                                    //                                 $email = Helpers::getInitiatorEmail($u->user_id);
                                    //                                 if ($email !== null) {
                                    //                                      // Add this if statement
                                    //                                      try {
                                    //                                             Mail::send(
                                    //                                                 'mail.Categorymail',
                                    //                                                 ['data' => $incident],
                                    //                                                 function ($message) use ($email) {
                                    //                                                     $message->to($email)
                                    //                                                         ->subject("Activity Performed By " . Auth::user()->name);
                                    //                                                 }
                                    //                                             );
                                    //                                         } catch (\Exception $e) {
                                    //                                             //log error
                                    //                                         }

                                    //                                 }
                                    //                             }
                                    //                         }
                                    //    }

//      if (!empty ($request->Initial_attachment)) {

//                 $files = [];

//                 if ($incident->Initial_attachment) {
//                     $existingFiles = json_decode($incident->Initial_attachment, true); // Convert to associative array
//                     if (is_array($existingFiles)) {
//                         $files = $existingFiles;
//                     }
//                 }


//   }

  if (!empty ($request->Initial_attachment)) {
    $files = [];
    if ($request->hasfile('Initial_attachment')) {
        foreach ($request->file('Initial_attachment') as $file) {
            $name = $request->name . 'Initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $files[] = $name;
        }
    }


    $incident->Initial_attachment = json_encode($files);
}


        if (!empty ($request->qa_head_deginee_attachments)) {
            $files = [];
            if ($request->hasfile('qa_head_deginee_attachments')) {
                foreach ($request->file('qa_head_deginee_attachments') as $file) {
                    $name = $request->name . 'qa_head_deginee_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $incident->qa_head_deginee_attachments = json_encode($files);
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
        if (!empty ($request->qa_head_attachments)) {
            $files = [];
            if ($request->hasfile('qa_head_attachments')) {
                foreach ($request->file('qa_head_attachments') as $file) {
                    $name = $request->name . 'qa_head_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $incident->qa_head_attachments = json_encode($files);
        }
        if (!empty ($request->qa_final_ra_attachments)) {
            $files = [];
            if ($request->hasfile('qa_final_ra_attachments')) {
                foreach ($request->file('qa_final_ra_attachments') as $file) {
                    $name = $request->name . 'qa_final_ra_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $incident->qa_final_ra_attachments = json_encode($files);
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
        if (!empty ($request->hod_attachments)) {
            $files = [];
            if ($request->hasfile('hod_attachments')) {
                foreach ($request->file('hod_attachments') as $file) {
                    $name = $request->name . 'hod_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $incident->hod_attachments = json_encode($files);
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
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($incident->due_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to = "Opened";
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
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();

            if (!empty ($request->record)){
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
               $history->activity_type = 'Record Number';
                $history->activity_type = 'Record ';
                $history->previous = "Null";
                $history->current = Helpers::getDivisionName(session()->get('division')) . "/INC/" . Helpers::year($incident->created_at) . "/" . str_pad($incident->record, 4, '0', STR_PAD_LEFT);
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $incident->status;
                $history->change_to = "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
                $history->save();
            };
             if (!empty ($request->division_id)){
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Site/Location Code';
                $history->previous = "Null";
                $history->current = $incident->division_id;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $incident->status;
                $history->change_to = "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
                $history->save();
            };

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
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty ($request->short_description_required)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Repeat Incident? ';
            $history->previous = "Null";
            $history->current = $incident->short_description_required;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->nature_of_repeat)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = "Null";
            $history->current = $incident->nature_of_repeat;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }


        if (!empty ($request->incident_date)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Incident Observed On (Date)';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($incident->incident_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty ($request->incident_time)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Incident Observed On (Time)';
            $history->previous = "Null";
            $history->current = $incident->incident_time;
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
        if (!empty ($request->Delay_Justification)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Delay Justification';
            $history->previous = "Null";
            $history->current = $incident->Delay_Justification;
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
            $history->activity_type = 'Initiation Department';
            $history->previous = "Null";
            $history->current = Helpers::getFullDepartmentName($incident->Initiator_Group);
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
            $history->activity_type = 'Initiation Department Code';
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

        if (!empty ($request->immediate_correction)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Immediate corrective action';
            $history->previous = "Null";
            $history->current = $incident->immediate_correction;
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
        if (!empty ($request->investigation)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Investigation';
            $history->previous = "Null";
            $history->current = $incident->investigation;
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
        if (!empty ($request->qa_reviewer)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'QA Reviewer';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($incident->qa_reviewer);
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
        if (!empty ($request->department_head)){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Department Head';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($incident->department_head);
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
        // if (!empty ($request->incident_date)){
        //     $history = new IncidentAuditTrail();
        //     $history->incident_id = $incident->id;
        //     $history->activity_type = 'Incident Observed';
        //     $history->previous = "Null";
        //     $history->current = $incident->incident_date;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $incident->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiator";
        //     $history->action_name = 'Create';
        //     $history->save();
        // }
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
            $history->current = Helpers::getdateFormat($incident->incident_reported_date);
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
        if (!empty($request->Description_incident)){
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
        // if ($request->Immediate_Action[0] !== null){
        //     $history = new IncidentAuditTrail();
        // $history->incident_id = $incident->id;
        // $history->activity_type = 'Immediate Action (if any)';
        // $history->previous = "Null";
        // $history->current = $incident->Immediate_Action;
        // $history->comment = "Not Applicable";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->change_to =   "Opened";
        //     $history->change_from = "Initiator";
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $incident->status;
        // $history->action_name = 'Create';
        // $history->save();
        // }
        // if ($request->Preliminary_Impact[0] !== null){
        //     $history = new IncidentAuditTrail();
        //     $history->incident_id = $incident->id;
        //     $history->activity_type = 'Preliminary Impact of Incident';
        //     $history->previous = "Null";
        //     $history->current = $incident->Preliminary_Impact;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiator";
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $incident->status;
        //     $history->action_name = 'Create';
        //     $history->save();
        // }
        if ($request->Initial_attachment){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Initial Attachments';
            $history->previous = "Null";
            $history->current = $incident->Initial_attachment;
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

        if ($request->review_of_verific){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Review Of Incident And Verfication Of Effectivess Of Correction';
            $history->previous = "Null";
            $history->current = $incident->review_of_verific;
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
        if ($request->Recommendations){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Recommendations';
            $history->previous = "Null";
            $history->current = $incident->Recommendations;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->action_name = 'Create';
            $history->save();


        } if ($request->Impact_Assessmenta){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Impact Assessment';
            $history->previous = "Null";
            $history->current = $incident->Impact_Assessmenta;
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
        if ($request->HOD_Remarks){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'HOD Remarks';
            $history->previous = "Null";
            $history->current = $incident->HOD_Remarks;
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
        if ($request->hod_attachments){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'HOD Attachments';
            $history->previous = "Null";
            $history->current = $incident->hod_attachments;
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
        if ($request->product_quality_imapct){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Product Quality Impact';
            $history->previous = "Null";
            $history->current = $incident->product_quality_imapct;
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

        if ($request->process_performance_impact){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Process Performance Impact';
            $history->previous = "Null";
            $history->current = $incident->process_performance_impact;
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
        if ($request->yield_impact){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Yield Impact';
            $history->previous = "Null";
            $history->current = $incident->yield_impact;
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
        if ($request->gmp_impact){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'GMP Impact:';
            $history->previous = "Null";
            $history->current = $incident->gmp_impact;
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
        if ($request->additionl_testing_required){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Additional Testing Required:';
            $history->previous = "Null";
            $history->current = $incident->additionl_testing_required;
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
        if ($request->any_similar_incident_in_past){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'If Yes, Then Mention';
            $history->previous = "Null";
            $history->current = $incident->any_similar_incident_in_past;
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


        if ($request->capa_require){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Any Similar Incident in Past';
            $history->previous = "Null";
            $history->current = $incident->capa_require;
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

         if ($request->classification_by_qa){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Classification by QA';
            $history->previous = "Null";
            $history->current = $incident->classification_by_qa;
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
        if ($request->QAInitialRemark){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'QA Initial Review Remarks';
            $history->previous = "Null";
            $history->current = $incident->QAInitialRemark;
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

        if ($request->Initial_attachment){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'QA Initial Review Attachments';
            $history->previous = "Null";
            $history->current = $incident->Initial_attachment;
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

        if ($request->qa_head_deginee_comment){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'QA Head/Designee approval comment';
            $history->previous = "Null";
            $history->current = $incident->qa_head_deginee_comment;
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

        if ($request->qa_head_deginee_attachments){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'QA Head/Designee approval comment';
            $history->previous = "Null";
            $history->current = $incident->qa_head_deginee_attachments;
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

        if ($request->capa_implementation){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'CAPA Implementation';
            $history->previous = "Null";
            $history->current = $incident->capa_implementation;
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
        if ($request->corrective_actions){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Based upon the assessment of the corrective actions planned, whether unplanned deviation is required:';
            $history->previous = "Null";
            $history->current = $incident->corrective_actions;
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
        if ($request->batch_release){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Batch release satisfactory';
            $history->previous = "Null";
            $history->current = $incident->batch_release;
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

        if ($request->affected_documents){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Affected documents closed';
            $history->previous = "Null";
            $history->current = $incident->affected_documents;
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
        if ($request->QA_Feedbacks){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Initiator Update Comments';
            $history->previous = "Null";
            $history->current = $incident->QA_Feedbacks;
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
        if ($request->QA_attachments){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Initiator Update Attachments';
            $history->previous = "Null";
            $history->current = $incident->QA_attachments;
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
        if ($request->qa_head_Remarks){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'HOD Final Review Comments';
            $history->previous = "Null";
            $history->current = $incident->qa_head_Remarks;
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
        if ($request->qa_head_attachments){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'HOD Final Review Attachments';
            $history->previous = "Null";
            $history->current = $incident->qa_head_attachments;
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

        if ($request->qa_final_review){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'QA Final Review Comments';
            $history->previous = "Null";
            $history->current = $incident->qa_final_review;
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

        if ($request->qa_final_ra_attachments){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'QA Final Review Attachments';
            $history->previous = "Null";
            $history->current = $incident->qa_final_ra_attachments;
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

        // if ($request->Post_Categorization){
        //     $history = new IncidentAuditTrail();
        //     $history->incident_id = $incident->id;
        //     $history->activity_type = 'Post Categorization Of Incident';
        //     $history->previous = "Null";
        //     $history->current = $incident->Post_Categorization;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiator";
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $incident->status;
        //     $history->action_name = 'Create';
        //     $history->save();
        // }

        // if ($request->Investigation_Of_Review){
        //     $history = new IncidentAuditTrail();
        //     $history->incident_id = $incident->id;
        //     $history->activity_type = 'Justification for Revised Category';
        //     $history->previous = "Null";
        //     $history->current = $incident->Investigation_Of_Review;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiator";
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $incident->status;
        //     $history->action_name = 'Create';
        //     $history->save();
        // }

        if ($request->Closure_Comments){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Closure Comments';
            $history->previous = "Null";
            $history->current = $incident->Closure_Comments;
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

        if ($request->Disposition_Batch){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Disposition of Batch';
            $history->previous = "Null";
            $history->current = $incident->Disposition_Batch;
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
        if ($request->closure_attachment){
            $history = new IncidentAuditTrail();
            $history->incident_id = $incident->id;
            $history->activity_type = 'Closure Attachments';
            $history->previous = "Null";
            $history->current = $incident->closure_attachment;
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

//dd($data);
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

            // dd($request->audit_type);
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
                // 'ReferenceDocumentName' => [
                //     function ($attribute, $value, $fail) use ($request) {
                //         if ($request->input('Document_Details_Required') === 'yes' && (count($value) === 1 && reset($value) === null)) {
                //             $fail('The Referrence Document Number field is required when Document Details Required is yes.');
                //         }
                //     },
                // ],
                // 'Description_incident' => [
                //     'required',
                //     'array',
                //     function($attribute, $value, $fail) {
                //         if (count($value) === 1 && reset($value) === null) {
                //             return $fail('Description of Incident must not be empty!.');
                //         }
                //     },
                // ],
                // 'Immediate_Action' => [
                //     'required',
                //     'array',
                //     function($attribute, $value, $fail) {
                //         if (count($value) === 1 && reset($value) === null) {
                //             return $fail('Immediate Action field must not be empty!.');
                //         }
                //     },
                // ],
                // 'Preliminary_Impact' => [
                //     'required',
                //     'array',
                //     function($attribute, $value, $fail) {
                //         if (count($value) === 1 && reset($value) === null) {
                //             return $fail('Preliminary Impact field must not be empty!.');
                //         }
                //     },
                // ],
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


        // if ($incident->stage < 3) {
        //     $incident->short_description = $request->short_description;
        // } else {
        //     $incident->short_description = $incident->short_description;
        // }
        $incident->short_description = $request->short_description;
        $incident->initiator_group_code = $request->initiator_group_code;
        $incident->incident_reported_date = $request->incident_reported_date;
        $incident->incident_date = $request->incident_date;
        $incident->incident_time = $request->incident_time;
        $incident->Delay_Justification = $request->Delay_Justification;
        // $incident->audit_type = implode(',', $request->audit_type);

        if($incident->stage == 1){
            if (is_array($request->audit_type)) {
                $incident->audit_type = implode(',', $request->audit_type);
            }
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


        // $incident->Immediate_Action = implode(',', $request->Immediate_Action);
        // $incident->Preliminary_Impact = implode(',', $request->Preliminary_Impact);
        $incident->Product_Details_Required = $request->Product_Details_Required;
        $incident->qa_final_review = $request->qa_final_review;
        $incident->investigation = $request->investigation;
        // $incident->due_date = $request->due_date;
        $incident->immediate_correction = $request->immediate_correction;
        $incident->review_of_verific = $request->review_of_verific;
        $incident->Recommendations = $request->Recommendations;
        $incident->Impact_Assessmenta = $request->Impact_Assessmenta;
        $incident->qa_head_Remarks = $request->qa_head_Remarks;
        $incident->HOD_Remarks = $request->HOD_Remarks;
        $incident->product_quality_imapct = $request->product_quality_imapct;
        $incident->process_performance_impact = $request->process_performance_impact;
        $incident->yield_impact = $request->yield_impact;
        $incident->gmp_impact = $request->gmp_impact;
        $incident->additionl_testing_required = $request->additionl_testing_required;
        $incident->any_similar_incident_in_past= $request->any_similar_incident_in_past;
        $incident->classification_by_qa = $request->classification_by_qa;
        $incident->capa_require = $request->capa_require;

        $incident->qa_head_deginee_comment = $request->qa_head_deginee_comment;


        $incident->capa_implementation = $request->capa_implementation;
        $incident->check_points = $request->check_points;
        $incident->corrective_actions = $request->corrective_actions;
        $incident->batch_release = $request->batch_release;
        $incident->closure_ini = $request->closure_ini;
        $incident->affected_documents = $request->affected_documents;

        $incident->Justification_for_categorization = !empty($request->Justification_for_categorization) ? $request->Justification_for_categorization : $incident->Justification_for_categorization;

        $incident->Investigation_Details = !empty($request->Investigation_Details) ? $request->Investigation_Details : $incident->Investigation_Details;

        // $incident->QAInitialRemark = $request->QAInitialRemark;
        $incident->Investigation_Summary = $request->Investigation_Summary;
        $incident->Impact_assessment = $request->Impact_assessment;
        $incident->Root_cause = $request->Root_cause;

        $incident->Conclusion = $request->Conclusion;
        $incident->Identified_Risk = $request->Identified_Risk;
        $incident->severity_rate = $request->severity_rate ? $request->severity_rate : $incident->severity_rate;
        $incident->Occurrence = $request->Occurrence ? $request->Occurrence : $incident->Occurrence;
        $incident->detection = $request->detection ? $request->detection: $incident->detection;


        // $incident->equipment_name = $request->equipment_name;
        // $incident->instrument_name = $request->instrument_name;
        // $incident->inc_facility_name = $request->inc_facility_name;
        // $incident->product_quality_imapct = $request->product_quality_imapct;
        // $incident->process_performance_impact = $request->process_performance_impact;
        // $incident->yield_impact = $request->yield_impact;
        // $incident->gmp_impact = $request->gmp_impact;
        // $incident->additionl_testing_required = $request->additionl_testing_required;
        // $incident->any_similar_incident_in_past = $request->any_similar_incident_in_past;
        // $incident->classification_by_qa = $request->classification_by_qa;
        // $incident->capa_require = $request->capa_require;
        // $incident->deviation_required = $request->deviation_required;

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

        // if ($incident->stage < 6) {
        //     $incident->CAPA_Rquired = $request->CAPA_Rquired;
        // }

        // if ($incident->stage < 6) {
        //     $incident->capa_type = $request->capa_type;
        // }

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
            $incident->QAInitialRemark = $request->QAInitialRemark;

        }

        if($incident->stage == 3 || $incident->stage == 4 ){


            if (!$form_progress) {
                $form_progress = 'cft';
            }

            $Cft = IncidentCft::withoutTrashed()->where('incident_id', $id)->first();
            // if($Cft && $incident->stage == 4 ){
            //     $Cft->Production_Review = $request->Production_Review == null ? $Cft->Production_Review : $request->Production_Review;
            //     $Cft->Production_person = $request->Production_person == null ? $Cft->Production_person : $request->Production_Review;
            //     $Cft->Warehouse_review = $request->Warehouse_review == null ? $Cft->Warehouse_review : $request->Warehouse_review;
            //     $Cft->Warehouse_notification = $request->Warehouse_notification == null ? $Cft->Warehouse_notification : $request->Warehouse_notification;
            //     $Cft->Quality_review = $request->Quality_review == null ? $Cft->Quality_review : $request->Quality_review;;
            //     $Cft->Quality_Control_Person = $request->Quality_Control_Person == null ? $Cft->Quality_Control_Person : $request->Quality_Control_Person;
            //     $Cft->Quality_Assurance_Review = $request->Quality_Assurance_Review == null ? $Cft->Quality_Assurance_Review : $request->Quality_Assurance_Review;
            //     $Cft->QualityAssurance_person = $request->QualityAssurance_person == null ? $Cft->QualityAssurance_person : $request->QualityAssurance_person;

            //     $Cft->Engineering_review = $request->Engineering_review == null ? $Cft->Engineering_review : $request->Engineering_review;
            //     $Cft->Engineering_person = $request->Engineering_person == null ? $Cft->Engineering_person : $request->Engineering_person;
            //     $Cft->Analytical_Development_review = $request->Analytical_Development_review == null ? $Cft->Analytical_Development_review : $request->Analytical_Development_review;
            //     $Cft->Analytical_Development_person = $request->Analytical_Development_person == null ? $Cft->Analytical_Development_person : $request->Analytical_Development_person;
            //     $Cft->Kilo_Lab_review = $request->Kilo_Lab_review == null ? $Cft->Kilo_Lab_review : $request->Kilo_Lab_review;
            //     $Cft->Kilo_Lab_person = $request->Kilo_Lab_person == null ? $Cft->Kilo_Lab_person : $request->Kilo_Lab_person;
            //     $Cft->Technology_transfer_review = $request->Technology_transfer_review == null ? $Cft->Technology_transfer_review : $request->Technology_transfer_review;
            //     $Cft->Technology_transfer_person = $request->Technology_transfer_person == null ? $Cft->Technology_transfer_person : $request->Technology_transfer_person;
            //     $Cft->Environment_Health_review = $request->Environment_Health_review == null ? $Cft->Environment_Health_review : $request->Environment_Health_review;
            //     $Cft->Environment_Health_Safety_person = $request->Environment_Health_Safety_person == null ? $Cft->Environment_Health_Safety_person : $request->Environment_Health_Safety_person;
            //     $Cft->Human_Resource_review = $request->Human_Resource_review == null ? $Cft->Human_Resource_review : $request->Human_Resource_review;
            //     $Cft->Human_Resource_person = $request->Human_Resource_person == null ? $Cft->Human_Resource_person : $request->Human_Resource_person;
            //     $Cft->Project_management_review = $request->Project_management_review == null ? $Cft->Project_management_review : $request->Project_management_review;
            //     $Cft->Project_management_person = $request->Project_management_person == null ? $Cft->Project_management_person : $request->Project_management_person;
            //     $Cft->Information_Technology_review = $request->Information_Technology_review == null ? $Cft->Information_Technology_review : $request->Information_Technology_review;
            //     $Cft->Information_Technology_person = $request->Information_Technology_person == null ? $Cft->Information_Technology_person : $request->Information_Technology_person;
            //     $Cft->Other1_review = $request->Other1_review  == null ? $Cft->Other1_review : $request->Other1_review;
            //     $Cft->Other1_person = $request->Other1_person  == null ? $Cft->Other1_person : $request->Other1_person;
            //     $Cft->Other1_Department_person = $request->Other1_Department_person  == null ? $Cft->Other1_Department_person : $request->Other1_Department_person;
            //     $Cft->Other2_review = $request->Other2_review  == null ? $Cft->Other2_review : $request->Other2_review;
            //     $Cft->Other2_person = $request->Other2_person  == null ? $Cft->Other2_person : $request->Other2_person;
            //     $Cft->Other2_Department_person = $request->Other2_Department_person  == null ? $Cft->Other2_Department_person : $request->Other2_Department_person;
            //     $Cft->Other3_review = $request->Other3_review  == null ? $Cft->Other3_review : $request->Other3_review;
            //     $Cft->Other3_person = $request->Other3_person  == null ? $Cft->Other3_person : $request->Other3_person;
            //     $Cft->Other3_Department_person = $request->Other3_Department_person  == null ? $Cft->Other3_Department_person : $request->Other3_Department_person;
            //     $Cft->Other4_review = $request->Other4_review  == null ? $Cft->Other4_review : $request->Other4_review;
            //     $Cft->Other4_person = $request->Other4_person  == null ? $Cft->Other4_person : $request->Other4_person;
            //     $Cft->Other4_Department_person = $request->Other4_Department_person  == null ? $Cft->Other4_Department_person : $request->Other4_Department_person;
            //     $Cft->Other5_review = $request->Other5_review  == null ? $Cft->Other5_review : $request->Other5_review;
            //     $Cft->Other5_person = $request->Other5_person  == null ? $Cft->Other5_person : $request->Other5_person;
            //     $Cft->Other5_Department_person = $request->Other5_Department_person  == null ? $Cft->Other5_Department_person : $request->Other5_Department_person;
            // }
            // else{
            //     $Cft->Production_Review = $request->Production_Review;
            //     $Cft->Production_person = $request->Production_person;
            //     $Cft->Warehouse_review = $request->Warehouse_review;
            //     $Cft->Warehouse_notification = $request->Warehouse_notification;
            //     $Cft->Quality_review = $request->Quality_review;
            //     $Cft->Quality_Control_Person = $request->Quality_Control_Person;
            //     $Cft->Quality_Assurance_Review = $request->Quality_Assurance_Review;
            //     $Cft->QualityAssurance_person = $request->QualityAssurance_person;
            //     $Cft->Engineering_review = $request->Engineering_review;
            //     $Cft->Engineering_person = $request->Engineering_person;
            //     $Cft->Analytical_Development_review = $request->Analytical_Development_review;
            //     $Cft->Analytical_Development_person = $request->Analytical_Development_person;
            //     $Cft->Kilo_Lab_review = $request->Kilo_Lab_review;
            //     $Cft->Kilo_Lab_person = $request->Kilo_Lab_person;
            //     $Cft->Technology_transfer_review = $request->Technology_transfer_review;
            //     $Cft->Technology_transfer_person = $request->Technology_transfer_person;
            //     $Cft->Environment_Health_review = $request->Environment_Health_review;
            //     $Cft->Environment_Health_Safety_person = $request->Environment_Health_Safety_person;
            //     $Cft->Human_Resource_review = $request->Human_Resource_review;
            //     $Cft->Human_Resource_person = $request->Human_Resource_person;
            //     $Cft->Project_management_review = $request->Project_management_review;
            //     $Cft->Project_management_person = $request->Project_management_person;
            //     $Cft->Information_Technology_review = $request->Information_Technology_review;
            //     $Cft->Information_Technology_person = $request->Information_Technology_person;
            //     $Cft->Other1_review = $request->Other1_review;
            //     $Cft->Other1_person = $request->Other1_person;
            //     $Cft->Other1_Department_person = $request->Other1_Department_person;
            //     $Cft->Other2_review = $request->Other2_review;
            //     $Cft->Other2_person = $request->Other2_person;
            //     $Cft->Other2_Department_person = $request->Other2_Department_person;
            //     $Cft->Other3_review = $request->Other3_review;
            //     $Cft->Other3_person = $request->Other3_person;
            //     $Cft->Other3_Department_person = $request->Other3_Department_person;
            //     $Cft->Other4_review = $request->Other4_review;
            //     $Cft->Other4_person = $request->Other4_person;
            //     $Cft->Other4_Department_person = $request->Other4_Department_person;
            //     $Cft->Other5_review = $request->Other5_review;
            //     $Cft->Other5_person = $request->Other5_person;
            //     $Cft->Other5_Department_person = $request->Other5_Department_person;
            // }
            // $Cft->Production_assessment = $request->Production_assessment;
            // $Cft->Production_feedback = $request->Production_feedback;
            // $Cft->Warehouse_assessment = $request->Warehouse_assessment;
            // $Cft->Warehouse_feedback = $request->Warehouse_feedback;
            // $Cft->Quality_Control_assessment = $request->Quality_Control_assessment;
            // $Cft->Quality_Control_feedback = $request->Quality_Control_feedback;
            // $Cft->QualityAssurance_assessment = $request->QualityAssurance_assessment;
            // $Cft->QualityAssurance_feedback = $request->QualityAssurance_feedback;
            // $Cft->Engineering_assessment = $request->Engineering_assessment;
            // $Cft->Engineering_feedback = $request->Engineering_feedback;
            // $Cft->Analytical_Development_assessment = $request->Analytical_Development_assessment;
            // $Cft->Analytical_Development_feedback = $request->Analytical_Development_feedback;
            // $Cft->Kilo_Lab_assessment = $request->Kilo_Lab_assessment;
            // $Cft->Kilo_Lab_feedback = $request->Kilo_Lab_feedback;
            // $Cft->Technology_transfer_assessment = $request->Technology_transfer_assessment;
            // $Cft->Technology_transfer_feedback = $request->Technology_transfer_feedback;
            // $Cft->Health_Safety_assessment = $request->Health_Safety_assessment;
            // $Cft->Health_Safety_feedback = $request->Health_Safety_feedback;
            // $Cft->Human_Resource_assessment = $request->Human_Resource_assessment;
            // $Cft->Human_Resource_feedback = $request->Human_Resource_feedback;
            // $Cft->Information_Technology_assessment = $request->Information_Technology_assessment;
            // $Cft->Information_Technology_feedback = $request->Information_Technology_feedback;
            // $Cft->Project_management_assessment = $request->Project_management_assessment;
            // $Cft->Project_management_feedback = $request->Project_management_feedback;
            // $Cft->Other1_assessment = $request->Other1_assessment;
            // $Cft->Other1_feedback = $request->Other1_feedback;
            // $Cft->Other2_Assessment = $request->Other2_Assessment;
            // $Cft->Other2_feedback = $request->Other2_feedback;
            // $Cft->Other3_Assessment = $request->Other3_Assessment;
            // $Cft->Other3_feedback = $request->Other3_feedback;
            // $Cft->Other4_Assessment = $request->Other4_Assessment;
            // $Cft->Other4_feedback = $request->Other4_feedback;
            // $Cft->Other5_Assessment = $request->Other5_Assessment;
            // $Cft->Other5_feedback = $request->Other5_feedback;


            // if (!empty ($request->production_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('production_attachment')) {
            //         foreach ($request->file('production_attachment') as $file) {
            //             $name = $request->name . 'production_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }

            //     $Cft->production_attachment = json_encode($files);
            // }
            // if (!empty ($request->Warehouse_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Warehouse_attachment')) {
            //         foreach ($request->file('Warehouse_attachment') as $file) {
            //             $name = $request->name . 'Warehouse_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }

            //     $Cft->Warehouse_attachment = json_encode($files);
            // }
            // if (!empty ($request->Quality_Control_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Quality_Control_attachment')) {
            //         foreach ($request->file('Quality_Control_attachment') as $file) {
            //             $name = $request->name . 'Quality_Control_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }

            //     $Cft->Quality_Control_attachment = json_encode($files);
            // }
            // if (!empty ($request->Quality_Assurance_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Quality_Assurance_attachment')) {
            //         foreach ($request->file('Quality_Assurance_attachment') as $file) {
            //             $name = $request->name . 'Quality_Assurance_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }


            //     $Cft->Quality_Assurance_attachment = json_encode($files);
            // }
            // if (!empty ($request->Engineering_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Engineering_attachment')) {
            //         foreach ($request->file('Engineering_attachment') as $file) {
            //             $name = $request->name . 'Engineering_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }


            //     $Cft->Engineering_attachment = json_encode($files);
            // }
            // if (!empty ($request->Analytical_Development_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Analytical_Development_attachment')) {
            //         foreach ($request->file('Analytical_Development_attachment') as $file) {
            //             $name = $request->name . 'Analytical_Development_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }


            //     $Cft->Analytical_Development_attachment = json_encode($files);
            // }
            // if (!empty ($request->Kilo_Lab_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Kilo_Lab_attachment')) {
            //         foreach ($request->file('Kilo_Lab_attachment') as $file) {
            //             $name = $request->name . 'Kilo_Lab_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }

            //     $Cft->Kilo_Lab_attachment = json_encode($files);
            // }
            // if (!empty ($request->Technology_transfer_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Technology_transfer_attachment')) {
            //         foreach ($request->file('Technology_transfer_attachment') as $file) {
            //             $name = $request->name . 'Technology_transfer_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }

            //     $Cft->Technology_transfer_attachment = json_encode($files);
            // }
            // if (!empty ($request->Environment_Health_Safety_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Environment_Health_Safety_attachment')) {
            //         foreach ($request->file('Environment_Health_Safety_attachment') as $file) {
            //             $name = $request->name . 'Environment_Health_Safety_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }


            //     $Cft->Environment_Health_Safety_attachment = json_encode($files);
            // }
            // if (!empty ($request->Human_Resource_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Human_Resource_attachment')) {
            //         foreach ($request->file('Human_Resource_attachment') as $file) {
            //             $name = $request->name . 'Human_Resource_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }

            //     $Cft->Human_Resource_attachment = json_encode($files);
            // }
            // if (!empty ($request->Information_Technology_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Information_Technology_attachment')) {
            //         foreach ($request->file('Information_Technology_attachment') as $file) {
            //             $name = $request->name . 'Information_Technology_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }


            //     $Cft->Information_Technology_attachment = json_encode($files);
            // }
            // if (!empty ($request->Project_management_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Project_management_attachment')) {
            //         foreach ($request->file('Project_management_attachment') as $file) {
            //             $name = $request->name . 'Project_management_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }

            //     $Cft->Project_management_attachment = json_encode($files);
            // }
            // if (!empty ($request->Other1_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Other1_attachment')) {
            //         foreach ($request->file('Other1_attachment') as $file) {
            //             $name = $request->name . 'Other1_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }


            //     $Cft->Other1_attachment = json_encode($files);
            // }
            // if (!empty ($request->Other2_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Other2_attachment')) {
            //         foreach ($request->file('Other2_attachment') as $file) {
            //             $name = $request->name . 'Other2_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }


            //     $Cft->Other2_attachment = json_encode($files);
            // }
            // if (!empty ($request->Other3_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Other3_attachment')) {
            //         foreach ($request->file('Other3_attachment') as $file) {
            //             $name = $request->name . 'Other3_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }
            //     $Cft->Other3_attachment = json_encode($files);
            // }
            // if (!empty ($request->Other4_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Other4_attachment')) {
            //         foreach ($request->file('Other4_attachment') as $file) {
            //             $name = $request->name . 'Other4_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }

            //     $Cft->Other4_attachment = json_encode($files);
            // }
            // if (!empty ($request->Other5_attachment)) {
            //     $files = [];
            //     if ($request->hasfile('Other5_attachment')) {
            //         foreach ($request->file('Other5_attachment') as $file) {
            //             $name = $request->name . 'Other5_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }


            //     $Cft->Other5_attachment = json_encode($files);
            // }


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


        }

        // if (!empty ($request->Initial_attachment)) {

        //     $files = [];

        //     if ($incident->Initial_attachment) {
        //         $existingFiles = json_decode($incident->Initial_attachment, true); // Convert to associative array
        //         if (is_array($existingFiles)) {
        //             $files = $existingFiles;
        //         }
        //         // $files = is_array(json_decode($incident->Initial_attachment)) ? $incident->Initial_attachment : [];
        //     }

        //     if ($request->hasfile('Initial_attachment')) {
        //         foreach ($request->file('Initial_attachment') as $file) {
        //             $name = $request->name . 'Initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $incident->Initial_attachment = json_encode($files);
        // }

        // third attachment
        // Initial_attachment logic
if (!empty($request->Initial_attachment) || !empty($request->deleted_Initial_attachment)) {
    $existingFiles = json_decode($incident->Initial_attachment, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_Initial_attachment)) {
        $filesToDelete = explode(',', $request->deleted_Initial_attachment);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    $newFiles = [];
    if ($request->hasFile('Initial_attachment')) {
        foreach ($request->file('Initial_attachment') as $file) {
            $name = $request->name . 'Initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    $allFiles = array_merge($existingFiles, $newFiles);
    $incident->Initial_attachment = json_encode($allFiles);
}

       //new attachment

       if (!empty($request->qa_head_deginee_attachments) || !empty($request->deleted_qa_head_deginee_attachments)) {
        $existingFiles = json_decode($incident->qa_head_deginee_attachments, true) ?? [];

        // Handle deleted files
        if (!empty($request->deleted_qa_head_deginee_attachments)) {
            $filesToDelete = explode(',', $request->deleted_qa_head_deginee_attachments);
            $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                return !in_array($file, $filesToDelete);
            });
        }

        $newFiles = [];
        if ($request->hasFile('qa_head_deginee_attachments')) {
            foreach ($request->file('qa_head_deginee_attachments') as $file) {
                $name = $request->name . 'qa_head_deginee_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/'), $name);
                $newFiles[] = $name;
            }
        }

        $allFiles = array_merge($existingFiles, $newFiles);
        $incident->qa_head_deginee_attachments = json_encode($allFiles);
    }

        //if (!empty ($request->qa_head_deginee_attachments)) {
        //    $files = [];
        //    if ($request->hasfile('qa_head_deginee_attachments')) {
        //        foreach ($request->file('qa_head_deginee_attachments') as $file) {
        //            $name = $request->name . 'qa_head_deginee_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //            $file->move('upload/', $name);
        //            $files[] = $name;
        //        }
        //    }


        //    $incident->qa_head_deginee_attachments = json_encode($files);
        //}

        // if (!empty ($request->Audit_file)) {

        //     $files = [];

        //     if ($incident->Audit_file) {
        //         $existingFiles = json_decode($incident->Audit_file, true); // Convert to associative array
        //         if (is_array($existingFiles)) {
        //             $files = $existingFiles;
        //         }
        //         // $files = is_array(json_decode($incident->Audit_file)) ? $incident->Audit_file : [];
        //     }

        //     if ($request->hasfile('Audit_file')) {
        //         foreach ($request->file('Audit_file') as $file) {
        //             $name = $request->name . 'Audit_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $incident->Audit_file = json_encode($files);
        // }
// Audit_file attachment logic
if (!empty($request->Audit_file) || !empty($request->deleted_Audit_file)) {
    $existingFiles = json_decode($incident->Audit_file, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_Audit_file)) {
        $filesToDelete = explode(',', $request->deleted_Audit_file);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    $newFiles = [];
    if ($request->hasFile('Audit_file')) {
        foreach ($request->file('Audit_file') as $file) {
            $name = $request->name . 'Audit_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    $allFiles = array_merge($existingFiles, $newFiles);
    $incident->Audit_file = json_encode($allFiles);
}


        // if (!empty ($request->hod_attachments)) {

        //     $files = [];

        //     if ($incident->hod_attachments) {
        //         $existingFiles = json_decode($incident->hod_attachments, true); // Convert to associative array
        //         if (is_array($existingFiles)) {
        //             $files = $existingFiles;
        //         }
        //         // $files = is_array(json_decode($incident->Audit_file)) ? $incident->Audit_file : [];
        //     }

        //     if ($request->hasfile('hod_attachments')) {
        //         foreach ($request->file('hod_attachments') as $file) {
        //             $name = $request->name . 'hod_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $incident->hod_attachments = json_encode($files);
        // }

        // HOD_attachments logic
if (!empty($request->hod_attachments) || !empty($request->deleted_hod_attachments)) {
    $existingFiles = json_decode($incident->hod_attachments, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_hod_attachments)) {
        $filesToDelete = explode(',', $request->deleted_hod_attachments);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    $newFiles = [];
    if ($request->hasFile('hod_attachments')) {
        foreach ($request->file('hod_attachments') as $file) {
            $name = $request->name . 'hod_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    $allFiles = array_merge($existingFiles, $newFiles);
    $incident->hod_attachments = json_encode($allFiles);
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
        // if (!empty ($request->qa_head_attachments)) {
        //     $files = [];

        //     if ($incident->qa_head_attachments) {
        //         $existingFiles = json_decode($incident->qa_head_attachments, true); // Convert to associative array
        //         if (is_array($existingFiles)) {
        //             $files = $existingFiles;
        //         }
        //         // $files = is_array(json_decode($incident->qa_head_attachments)) ? $incident->qa_head_attachments : [];
        //     }

        //     if ($request->hasfile('qa_head_attachments')) {
        //         foreach ($request->file('qa_head_attachments') as $file) {
        //             $name = $request->name . 'qa_head_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }


        //     $incident->qa_head_attachments = json_encode($files);
        // }
        // QA Head Attachments logic
if (!empty($request->qa_head_attachments) || !empty($request->deleted_qa_head_attachments)) {
    $existingFiles = json_decode($incident->qa_head_attachments, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_qa_head_attachments)) {
        $filesToDelete = explode(',', $request->deleted_qa_head_attachments);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    $newFiles = [];
    if ($request->hasFile('qa_head_attachments')) {
        foreach ($request->file('qa_head_attachments') as $file) {
            $name = $request->name . 'qa_head_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    $allFiles = array_merge($existingFiles, $newFiles);
    $incident->qa_head_attachments = json_encode($allFiles);
}

        // if (!empty ($request->qa_final_ra_attachments)) {
        //     $files = [];

        //     if ($incident->qa_final_ra_attachments) {
        //         $existingFiles = json_decode($incident->qa_final_ra_attachments, true); // Convert to associative array
        //         if (is_array($existingFiles)) {
        //             $files = $existingFiles;
        //         }
        //         // $files = is_array(json_decode($incident->qa_final_ra_attachments)) ? $incident->qa_final_ra_attachments : [];
        //     }

        //     if ($request->hasfile('qa_final_ra_attachments')) {
        //         foreach ($request->file('qa_final_ra_attachments') as $file) {
        //             $name = $request->name . 'qa_final_ra_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }


        //     $incident->qa_final_ra_attachments = json_encode($files);
        // }
    // QA Final Review Attachments logic
    if (!empty($request->qa_final_ra_attachments) || !empty($request->deleted_qa_final_ra_attachments)) {
        $existingFiles = json_decode($incident->qa_final_ra_attachments, true) ?? [];

        // Handle deleted files
        if (!empty($request->deleted_qa_final_ra_attachments)) {
            $filesToDelete = explode(',', $request->deleted_qa_final_ra_attachments);
            $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                return !in_array($file, $filesToDelete);
            });
        }

        $newFiles = [];
        if ($request->hasFile('qa_final_ra_attachments')) {
            foreach ($request->file('qa_final_ra_attachments') as $file) {
                $name = $request->name . 'qa_final_ra_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/'), $name);
                $newFiles[] = $name;
            }
        }

        $allFiles = array_merge($existingFiles, $newFiles);
        $incident->qa_final_ra_attachments = json_encode($allFiles);
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
                $existingFiles = json_decode($incident->QA_attachments, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($incident->QA_attachments)) ? $incident->QA_attachments : [];
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
        // if (!empty ($request->closure_attachment)) {

        //     $files = [];

        //     if ($incident->closure_attachment) {
        //         $existingFiles = json_decode($incident->closure_attachment, true); // Convert to associative array
        //         if (is_array($existingFiles)) {
        //             $files = $existingFiles;
        //         }
        //         // $files = is_array(json_decode($incident->closure_attachment)) ? $incident->closure_attachment : [];
        //     }

        //     if ($request->hasfile('closure_attachment')) {
        //         foreach ($request->file('closure_attachment') as $file) {
        //             $name = $request->name . 'closure_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }


        //     $incident->closure_attachment = json_encode($files);
        // }

        // Closure Attachments logic
if (!empty($request->closure_attachment) || !empty($request->deleted_closure_attachment)) {
    $existingFiles = json_decode($incident->closure_attachment, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_closure_attachment)) {
        $filesToDelete = explode(',', $request->deleted_closure_attachment);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    $newFiles = [];
    if ($request->hasFile('closure_attachment')) {
        foreach ($request->file('closure_attachment') as $file) {
            $name = $request->name . 'closure_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    $allFiles = array_merge($existingFiles, $newFiles);
    $incident->closure_attachment = json_encode($allFiles);
}

        if($incident->stage > 0){

            //investiocation dynamic
            $incident->Discription_Event = $request->Discription_Event;
            $incident->objective = $request->objective;
            $incident->scope = $request->scope;
            $incident->imidiate_action = $request->imidiate_action;
            $incident->impact_ass = $request->impact_ass;
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
        $incident->due_date = $request->due_date;

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

            if($lastIncident->short_description !=$incident->short_description || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Short Description')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Short Description';
                $history->previous =  $lastIncident->short_description;
                $history->current = $incident->short_description;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }


            if($lastIncident->incident_date != $incident->incident_date || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Incident Date')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Incident Observed On (Date)';
                $history->previous =  Helpers::getdateFormat($lastIncident->incident_date);
                $history->current = Helpers::getdateFormat($incident->incident_date);
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Initiator_Group !=$incident->Initiator_Group || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Initiator Group')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Initiation Department';
                $history->previous =  Helpers::getFullDepartmentName($lastIncident->Initiator_Group);
                $history->current = Helpers::getFullDepartmentName($incident->Initiator_Group);
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Initiator_Group !=$incident->Initiator_Group || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Initiator Group')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Initiation Department Code';
                $history->previous =  $lastIncident->Initiator_Group;
                $history->current = $incident->Initiator_Group;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name = $lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->product_quality_imapct !=$incident->product_quality_imapct || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Product Quality Impact')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Product Quality Impact';
                $history->previous =  $lastIncident->product_quality_imapct;
                $history->current = $incident->product_quality_imapct;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }
            if($lastIncident->qa_head_Remarks !=$incident->qa_head_Remarks || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'HOD Final Review Comments')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'HOD Final Review Comments';
                $history->previous =  $lastIncident->qa_head_Remarks;
                $history->current = $incident->qa_head_Remarks;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }
            if($lastIncident->qa_head_attachments !=$incident->qa_head_attachments || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'HOD Final Review Attachments')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'HOD Final Review Attachments';
                $history->previous =  $lastIncident->qa_head_attachments;
                $history->current = $incident->qa_head_attachments;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            // if($lastIncident->Initiator_Group !=$incident->Initiator_Group || !empty($request->Initiator_Group)) {
            //     $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
            //                     ->where('activity_type', 'Initiator Group')
            //                     ->exists();
            //     $history = new IncidentAuditTrail();
            //     $history->incident_id = $incident->id;
            //     $history->activity_type = 'Initiator Group';
            //     $history->previous =  $lastIncident->Initiator_Group;
            //     $history->current = $incident->Initiator_Group;
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state= $lastIncident->status;
            //     $history->change_to= "Not Applicable";
            //     $history->change_from= $lastIncident->status;
            //     $history->action_name=$lastDataAuditTrail ? "Update" : "New";
            //     $history->save();
            // }

            if($lastIncident->Facility !=$incident->Facility || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Initiator Group')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Facility';
                $history->previous =  $lastIncident->Facility;
                $history->current = $incident->Facility;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->incident_reported_date !=$incident->incident_reported_date || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Incident Deported')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Incident Reported On';
                $history->previous =  Helpers::getdateFormat($lastIncident->incident_reported_date);
                $history->current = Helpers::getdateFormat($incident->incident_reported_date);
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }


            if($lastIncident->audit_type !=$incident->audit_type || !empty($request->audit_type_comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Audit Type')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Audit Type';
                $history->previous =  $lastIncident->audit_type;
                $history->current = $incident->audit_type;
                $history->comment = $request->audit_type_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Delay_Justification !=$incident->Delay_Justification || !empty($request->Delay_Justification_comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Delay Justification')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Delay Justification';
                $history->previous =  $lastIncident->Delay_Justification;
                $history->current = $incident->Delay_Justification;
                $history->comment = $request->Delay_Justification_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }



            if($lastIncident->Facility_Equipment !=$incident->Facility_Equipment || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Facility Equipment')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Facility Equipment';
                $history->previous =  $lastIncident->Facility_Equipment;
                $history->current = $incident->Facility_Equipment;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }


            if($lastIncident->Document_Details_Required !=$incident->Document_Details_Required || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Document Details Required')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Document Details Required';
                $history->previous =  $lastIncident->Document_Details_Required;
                $history->current = $incident->Document_Details_Required;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Product_Batch !=$incident->Product_Batch || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Product Batch')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Product Batch';
                $history->previous =  $lastIncident->Product_Batch;
                $history->current = $incident->Product_Batch;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Description_incident !=$incident->Description_incident || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Description Incident')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Description Incident';
                $history->previous =  $lastIncident->Description_incident;
                $history->current = $incident->Description_incident;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }


            // if($lastIncident->Immediate_Action !=$incident->Immediate_Action || !empty($request->comment)) {
            //     $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
            //                     ->where('activity_type', 'Immediate Action')
            //                     ->exists();
            //     $history = new IncidentAuditTrail();
            //     $history->incident_id = $incident->id;
            //     $history->activity_type = 'Immediate Action';
            //     $history->previous =  $lastIncident->Immediate_Action;
            //     $history->current = $incident->Immediate_Action;
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state= $lastIncident->status;
            //     $history->change_to= "Not Applicable";
            //     $history->change_from= $lastIncident->status;
            //     $history->action_name=$lastDataAuditTrail ? "Update" : "New";
            //     $history->save();
            // }

            // if($lastIncident->Preliminary_Impact !=$incident->Preliminary_Impact || !empty($request->comment)) {
            //     $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
            //                     ->where('activity_type', 'Preliminary Impact')
            //                     ->exists();
            //     $history = new IncidentAuditTrail();
            //     $history->incident_id = $incident->id;
            //     $history->activity_type = 'Preliminary Impact';
            //     $history->previous =  $lastIncident->Preliminary_Impact;
            //     $history->current = $incident->Preliminary_Impact;
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state= $lastIncident->status;
            //     $history->change_to= "Not Applicable";
            //     $history->change_from= $lastIncident->status;
            //     $history->action_name=$lastDataAuditTrail ? "Update" : "New";
            //     $history->save();
            // }


            if($lastIncident->HOD_Remarks !=$incident->HOD_Remarks || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'HOD Remarks')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'HOD Remarks';
                $history->previous =  $lastIncident->HOD_Remarks;
                $history->current = $incident->HOD_Remarks;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->incident_category !=$incident->incident_category || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'HOD Remarks')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'HOD Remarks';
                $history->previous =  $lastIncident->incident_category;
                $history->current = $incident->incident_category;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->incident_category !=$incident->incident_category || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'HOD Remarks')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'HOD Remarks';
                $history->previous =  $lastIncident->incident_category;
                $history->current = $incident->incident_category;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Justification_for_categorization !=$incident->Justification_for_categorization || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Justification for Categorization')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Justification for Categorization';
                $history->previous =  $lastIncident->Justification_for_categorization;
                $history->current = $incident->Justification_for_categorization;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Justification_for_categorization !=$incident->Justification_for_categorization || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Justification for Categorization')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Justification for Categorization';
                $history->previous =  $lastIncident->Justification_for_categorization;
                $history->current = $incident->Justification_for_categorization;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Investigation_required !=$incident->Investigation_required || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Investigation Required')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Investigation Required';
                $history->previous =  $lastIncident->Investigation_required;
                $history->current = $incident->Investigation_required;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Investigation_Details !=$incident->Investigation_Details || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Investigation Details')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Investigation Details';
                $history->previous =  $lastIncident->Investigation_Details;
                $history->current = $incident->Investigation_Details;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Investigation_Details !=$incident->Investigation_Details || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Investigation Details')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Investigation Details';
                $history->previous =  $lastIncident->Investigation_Details;
                $history->current = $incident->Investigation_Details;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Customer_notification !=$incident->Customer_notification || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Customer Notification')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Customer Notification';
                $history->previous =  $lastIncident->Customer_notification;
                $history->current = $incident->Customer_notification;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }


            if($lastIncident->customers !=$incident->customers || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Customers')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Customers';
                $history->previous =  $lastIncident->customers;
                $history->current = $incident->customers;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->QAInitialRemark !=$incident->QAInitialRemark || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'QAInitialRemark')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'QAInitialRemark';
                $history->previous =  $lastIncident->QAInitialRemark;
                $history->current = $incident->QAInitialRemark;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Investigation_Summary !=$incident->Investigation_Summary || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Investigation Summary')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Investigation Summary';
                $history->previous =  $lastIncident->Investigation_Summary;
                $history->current = $incident->Investigation_Summary;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }


            if($lastIncident->Impact_assessment !=$incident->Impact_assessment || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Impact Assessment')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Impact Assessment';
                $history->previous =  $lastIncident->Impact_assessment;
                $history->current = $incident->Impact_assessment;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Root_cause !=$incident->Root_cause || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Root Cause')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Root Cause';
                $history->previous =  $lastIncident->Root_cause;
                $history->current = $incident->Root_cause;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->CAPA_Rquired !=$incident->CAPA_Rquired || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'CAPA Rquired')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'CAPA Rquired';
                $history->previous =  $lastIncident->CAPA_Rquired;
                $history->current = $incident->CAPA_Rquired;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->CAPA_Rquired !=$incident->CAPA_Rquired || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'CAPA Rquired')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'CAPA Rquired';
                $history->previous =  $lastIncident->CAPA_Rquired;
                $history->current = $incident->CAPA_Rquired;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }


            if($lastIncident->capa_type !=$incident->capa_type || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'capa type')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'capa type';
                $history->previous =  $lastIncident->capa_type;
                $history->current = $incident->capa_type;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->CAPA_Description !=$incident->CAPA_Description || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'CAPA Description')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'CAPA Description';
                $history->previous =  $lastIncident->CAPA_Description;
                $history->current = $incident->CAPA_Description;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            // if($lastIncident->Post_Categorization !=$incident->Post_Categorization || !empty($request->comment)) {
            //     $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
            //                     ->where('activity_type', 'Post Categorization')
            //                     ->exists();
            //     $history = new IncidentAuditTrail();
            //     $history->incident_id = $incident->id;
            //     $history->activity_type = 'Post Categorization Of Incident';
            //     $history->previous =  $lastIncident->Post_Categorization;
            //     $history->current = $incident->Post_Categorization;
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state= $lastIncident->status;
            //     $history->change_to= "Not Applicable";
            //     $history->change_from= $lastIncident->status;
            //     $history->action_name=$lastDataAuditTrail ? "Update" : "New";
            //     $history->save();
            // }

            // if($lastIncident->Investigation_Of_Review !=$incident->Investigation_Of_Review || !empty($request->comment)) {
            //     $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
            //                     ->where('activity_type', 'Investigation Of Review')
            //                     ->exists();
            //     $history = new IncidentAuditTrail();
            //     $history->incident_id = $incident->id;
            //     $history->activity_type = 'Justification for Revised Category';
            //     $history->previous =  $lastIncident->Investigation_Of_Review;
            //     $history->current = $incident->Investigation_Of_Review;
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state= $lastIncident->status;
            //     $history->change_to= "Not Applicable";
            //     $history->change_from= $lastIncident->status;
            //     $history->action_name=$lastDataAuditTrail ? "Update" : "New";
            //     $history->save();
            // }

            if($lastIncident->QA_Feedbacks !=$incident->QA_Feedbacks || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'QA Feedbacks')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'QA Feedbacks';
                $history->previous =  $lastIncident->QA_Feedbacks;
                $history->current = $incident->QA_Feedbacks;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Closure_Comments !=$incident->Closure_Comments || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Closure Comments')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Closure Comments';
                $history->previous =  $lastIncident->Closure_Comments;
                $history->current = $incident->Closure_Comments;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->Disposition_Batch !=$incident->Disposition_Batch || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Disposition Batch')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Disposition Batch';
                $history->previous =  $lastIncident->Disposition_Batch;
                $history->current = $incident->Disposition_Batch;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }
            if($lastIncident->review_of_verific !=$incident->review_of_verific || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Review Of Incident And Verfication Of Effectivess Of Correction')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Review Of Incident And Verfication Of Effectivess Of Correction';
                $history->previous =  $lastIncident->review_of_verific;
                $history->current = $incident->review_of_verific;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }
            if($lastIncident->Recommendations !=$incident->Recommendations || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Recommendations')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Recommendations';
                $history->previous =  $lastIncident->Recommendations;
                $history->current = $incident->Recommendations;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }
            if($lastIncident->Impact_Assessmenta !=$incident->Impact_Assessmenta || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Impact Assessmenta')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Impact Assessmenta';
                $history->previous =  $lastIncident->Impact_Assessmenta;
                $history->current = $incident->Impact_Assessmenta;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->qa_head_deginee_comment !=$incident->qa_head_deginee_comment || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'QA Head/Designee approval comment')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'QA Head/Designee approval comment';
                $history->previous =  $lastIncident->qa_head_deginee_comment;
                $history->current = $incident->qa_head_deginee_comment;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }


            if($lastIncident->qa_head_deginee_attachments !=$incident->qa_head_deginee_attachments || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'QA Head/Designee approval attachement')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'QA Head/Designee approval attachement';
                $history->previous =  $lastIncident->qa_head_deginee_attachments;
                $history->current = $incident->qa_head_deginee_attachments;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }




            if($lastIncident->hod_attachments !=$incident->hod_attachments || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'HOD Attachments')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'HOD Attachments';
                $history->previous =  $lastIncident->hod_attachments;
                $history->current = $incident->hod_attachments;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->qa_final_ra_attachments !=$incident->qa_final_ra_attachments || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'QA Final Review Comments')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'QA Final Review Comments';
                $history->previous =  $lastIncident->qa_final_ra_attachments;
                $history->current = $incident->qa_final_ra_attachments;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }

            if($lastIncident->qa_final_ra_attachments !=$incident->qa_final_ra_attachments || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'QA Final Review Attachments')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'QA Final Review Attachments';
                $history->previous =  $lastIncident->qa_final_ra_attachments;
                $history->current = $incident->qa_final_ra_attachments;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
                $history->save();
            }



            if($lastIncident->closure_attachment !=$incident->closure_attachment || !empty($request->comment)) {
                $lastDataAuditTrail = IncidentAuditTrail::where('incident_id', $incident->id)
                                ->where('activity_type', 'Closure Attachments')
                                ->exists();
                $history = new IncidentAuditTrail();
                $history->incident_id = $incident->id;
                $history->activity_type = 'Closure Attachments';
                $history->previous =  $lastIncident->closure_attachment;
                $history->current = $incident->closure_attachment;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state= $lastIncident->status;
                $history->change_to= "Not Applicable";
                $history->change_from= $lastIncident->status;
                $history->action_name=$lastDataAuditTrail ? "Update" : "New";
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
                $incident->more_info_req_by = Auth::user()->name;
                $incident->more_info_req_on = Carbon::now()->format('d-M-Y');
                $incident->more_info_req_cmt = $request->comment;

                $history = new IncidentAuditTrail();


                    $history->incident_id = $id;
                    $history->activity_type = 'Not Applicable';
                    $history->previous = "Not Applicable";
                    $history->action  = "More Information Required";
                    $history->current ="Not Applicable";
                    $history->action_name ="Not Applicable";
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'HOD Initial Review';
                    // if (is_null($lastDocument->more_info_req_by) || $lastDocument->more_info_req_by === '') {
                    //     $history->previous = "";
                    // } else {
                    //     $history->previous = $lastDocument->more_info_req_by . ' , ' . $lastDocument->more_info_req_on;
                    // }
                    // $history->current = $incident->more_info_req_by . ' , ' . $incident->more_info_req_on;
                    // if (is_null($lastDocument->more_info_req_by) || $lastDocument->more_info_req_by === '') {
                    //     $history->action_name = 'New';
                    // } else {
                    //     $history->action_name = 'Update';
                    // }
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

                toastr()->success('Document Sent');
                return back();
            }
            if ($incident->stage == 3) {
                $incident->stage = "2";
                $incident->status = "HOD Initial Review";
                $incident->form_progress = 'hod';
                $incident->Qa_more_info_req_by = Auth::user()->name;
                $incident->Qa_more_info_req_on = Carbon::now()->format('d-M-Y');
                $incident->Qa_more_info_req_cmt = $request->comment;
                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->action  = "More Information Required";
                $history->current ="Not Applicable";
                $history->action_name ="Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "HOD Initial Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'More Info Required';
                // if (is_null($lastDocument->Qa_more_info_req_by) || $lastDocument->Qa_more_info_req_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->Qa_more_info_req_by . ' , ' . $lastDocument->Qa_more_info_req_on;
                // }
                // $history->current = $incident->Qa_more_info_req_by . ' , ' . $incident->Qa_more_info_req_on;
                // if (is_null($lastDocument->Qa_more_info_req_by) || $lastDocument->Qa_more_info_req_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
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

                $incident->Pending_more_info_req_by = Auth::user()->name;
                $incident->Pending_more_info_req_on = Carbon::now()->format('d-M-Y');
                $incident->Pending_more_info_req_cmt = $request->comment;
                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->action  = "More Information Required";
                $history->current ="Not Applicable";
                $history->action_name ="Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->change_to =   "QA Initial Review";
                $history->change_from = $lastDocument->status;
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
            if ($incident->stage == 5) {
                $incident->stage = "4";
                $incident->status = "Pending Initiator Update";
                $incident->form_progress = 'capa';
                $incident->Hod_more_info_req_by = Auth::user()->name;
                $incident->Hod_more_info_req_on = Carbon::now()->format('d-M-Y');
                $incident->Hod_more_info_req_cmt = $request->comment;
                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->action  = "More Information Required";
                $history->current ="Not Applicable";
                $history->action_name ="Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->change_to =   "Pending Initiator Update";
                $history->change_from = $lastDocument->status;
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
                $incident->status = "HOD Final Review";
                $incident->form_progress = 'capa';

                $incident->Qa_final_more_info_req_by = Auth::user()->name;
                $incident->Qa_final_more_info_req_on = Carbon::now()->format('d-M-Y');
                $incident->Qa_final_more_info_req_cmt = $request->comment;
                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->action  = "More Information Required";
                $history->current ="Not Applicable";
                $history->action_name ="Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->change_to =   "HOD Final Review";
                $history->change_from = $lastDocument->status;
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
            if ($incident->stage == 7) {
                $incident->stage = "6";
                $incident->status = "QA Final Review";
                $incident->form_progress = 'capa';

                $incident->approved_more_info_req_by = Auth::user()->name;
                $incident->approved_more_info_req_on = Carbon::now()->format('d-M-Y');
                 $incident->approved_more_info_req_cmt = $request->comment;
                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->action  = "More Information Required";
                $history->current ="Not Applicable";
                $history->action_name ="Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->change_to =   "QA Final Review";
                $history->change_from = $lastDocument->status;
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

            if ($incident->stage == 8) {
                $incident->stage = "7";
                $incident->status = "QA Final Review";
                //$incident->form_progress = 'capa';
                $incident->approved_more_info_req_by = Auth::user()->name;
                $incident->approved_more_info_req_on = Carbon::now()->format('d-M-Y');
                 $incident->approved_more_info_req_cmt = $request->comment;
                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->action  = "More Information Required";
                $history->current ="Not Applicable";
                $history->action_name ="Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->change_to =   "QAH Closure Approval";
                $history->change_from = $lastDocument->status;
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
            $incident->Hod_Cancelled_by = Auth::user()->name;
            $incident->Hod_Cancelled_on = Carbon::now()->format('d-M-Y');
            $history = new IncidentAuditTrail();
            $history->incident_id = $id;
            $history->activity_type = 'Cancelled By,Cancelled On';
            $history->action='Cancel';
            $history->previous = "";
            $history->current = $incident->Hod_Cancelled_by;
            $history->current = $incident->cancelled_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $incident->status;
            $history->change_to =   "Closed-Cancelled";
            $history->change_from = $lastDocument->status;
            $history->stage = 'Cancelled';
            if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                $history->previous = "";
            } else {
                $history->previous = $lastDocument->cancelled_by . ' , ' . $lastDocument->cancelled_on;
            }
            $history->current = $incident->cancelled_by . ' , ' . $incident->cancelled_on;
            if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                $history->action_name = 'New';
            } else {
                $history->action_name = 'Update';
            }
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
                            'message' => 'Sent for HOD Initial Review state'
                        ]);
                    }
                    $incident->stage = "2";
                    $incident->status = "HOD Initial Review";
                    $incident->submit_by = Auth::user()->name;
                    $incident->submit_on = Carbon::now()->format('d-M-Y');
                    $incident->submit_comment = $request->comment;

                    $history = new IncidentAuditTrail();
                    $history->incident_id = $id;
                    $history->activity_type = 'Submit By, Submit On';
                    $history->previous = "";
                    $history->action='Submit';
                    $history->current = $incident->submit_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "HOD Initial Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'HOD Initial Review';
                    if (is_null($lastDocument->submit_by) || $lastDocument->submit_by === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->submit_by . ' , ' . $lastDocument->submit_on;
                    }
                    $history->current = $incident->submit_by . ' , ' . $incident->submit_on;
                    if (is_null($lastDocument->submit_by) || $lastDocument->submit_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
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
                    $incident->HOD_Initial_Review_Complete_By = Auth::user()->name;
                    $incident->HOD_Initial_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $incident->HOD_Initial_Review_Comments = $request->comment;
                    $history = new IncidentAuditTrail();
                    $history->incident_id = $id;
                    $history->activity_type = 'HOD Initial Review Complete By, HOD Initial Review Complete On';
                    $history->previous = "";
                    $history->current = $incident->HOD_Initial_Review_Complete_By;
                    $history->comment = $request->comment;
                    $history->action= 'HOD Review Complete';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA Initial Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'HOD Review Complete';
                    if (is_null($lastDocument->HOD_Initial_Review_Complete_By) || $lastDocument->HOD_Initial_Review_Complete_By === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->HOD_Initial_Review_Complete_By . ' , ' . $lastDocument->HOD_Initial_Review_Complete_On;
                    }
                    $history->current = $incident->HOD_Initial_Review_Complete_By . ' , ' . $incident->HOD_Initial_Review_Complete_On;
                    if (is_null($lastDocument->HOD_Initial_Review_Complete_By) || $lastDocument->HOD_Initial_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }


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

                    // Check HOD remark value
                    if (!$incident->QAInitialRemark) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'QA Initial Remarks is yet to be filled!',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for QAH/Designee Approval state'
                        ]);
                    }

                    //dd($incident->stage);
                    $incident->stage = "4";
                    $incident->status = "QAH/Designee Approval";
                    $incident->QA_Initial_Review_Complete_By = Auth::user()->name;
                    $incident->QA_Initial_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $incident->QA_Initial_Review_Comments = $request->comment;

                    $history = new IncidentAuditTrail();
                    $history->incident_id = $id;
                    $history->activity_type = 'QA Initial Review Complete By, QA Initial Review Complete On';
                    $history->previous = "";
                    $history->action= 'QA Initial Review Complete';
                    $history->current = $incident->QA_Initial_Review_Complete_By;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->change_to =   "Pending Initiator Update";
                    $history->change_from = $lastDocument->status;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = 'Pending Initiator Update';
                    if (is_null($lastDocument->QA_Initial_Review_Complete_By) || $lastDocument->QA_Initial_Review_Complete_By === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->QA_Initial_Review_Complete_By . ' , ' . $lastDocument->QA_Initial_Review_Complete_On;
                    }
                    $history->current = $incident->QA_Initial_Review_Complete_By . ' , ' . $incident->QA_Initial_Review_Complete_On;
                    if (is_null($lastDocument->QA_Initial_Review_Complete_By) || $lastDocument->HOD_Initial_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
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





                if ($incident->stage == 4) {
                    if ($incident->form_progress !== 'qa_head_deginee_comment')
                    if (!$incident->qa_head_deginee_comment)
                    {
                            Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'QAH/Designee Approval Remark field  is yet to be filled!'
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for Pending Initiator Update state'
                        ]);
                    }
                    $incident->stage = "5";
                    $incident->status = "Pending Initiator Update";
                    $incident->QAH_Designee_Approval_Complete_By = Auth::user()->name;
                    $incident->QAH_Designee_Approval_Complete_On = Carbon::now()->format('d-M-Y');
                    $incident->QAH_Designee_Approval_Complete_Comments = $request->comment;

                    // Code for the CFT required
                    $stage = new IncidentCftResponse();
                    $stage->incident_id = $id;
                    $stage->cft_user_id = Auth::user()->id;
                    $stage->status = "Pending Initiator Update";
                    // $stage->cft_stage = ;
                    $stage->comment = $request->comment;
                    $stage->is_required = 1;
                    $stage->save();

                    $history = new IncidentAuditTrail();
                    $history->incident_id = $id;
                    $history->activity_type = 'QAH/Designee Approval Complete By, QAH/Designee Approval Complete On';
                    //$history->previous = "";
                    //$history->current = $incident->QAH_Designee_Approval_Complete_By;
                    $history->comment = $request->comment;
                    $history->action= 'QAH/Designee Approval Complete';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QAH/Designee Approval";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'QAH/Designee Approval Complete';
                    if (is_null($lastDocument->QAH_Designee_Approval_Complete_By) || $lastDocument->QAH_Designee_Approval_Complete_By === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->QAH_Designee_Approval_Complete_By . ' , ' . $lastDocument->HOD_Initial_Review_Complete_On;
                    }
                    $history->current = $incident->QAH_Designee_Approval_Complete_By . ' , ' . $incident->HOD_Initial_Review_Complete_On;

                    if (is_null($lastDocument->QAH_Designee_Approval_Complete_By) || $lastDocument->QAH_Designee_Approval_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }


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


                if ($incident->stage == 5) {
                        //  dd(!$incident->QA_Feedbacks);
                    // CFT review state update form_progress
                    if (!$incident->QA_Feedbacks)
                    {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'Initiator Update Comments field is yet to be filled'
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal',[
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => ' Sent For HOD Final Review state'
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

                    if ($IsCFTRequired || $checkCFTCount) {
                        $incident->stage = "6";
                        $incident->status = "HOD Final Review";
                        $incident->Pending_Review_Complete_By = Auth::user()->name;
                        $incident->Pending_Review_Complete_On = Carbon::now()->format('d-M-Y');
                        $incident->Pending_Review_Comments = $request->comment;

                        $history = new IncidentAuditTrail();
                        $history->incident_id = $id;
                        $history->activity_type = 'Pending Initiator Update Complete By,Pending Initiator Update Complete On';
                        $history->previous = "";
                        $history->action='Pending Initiator Update Complete';
                        $history->current = $incident->Pending_Review_Complete_By;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "HOD Final Review";
                        $history->change_from = $lastDocument->status;
                        $history->stage = 'HOD Final Review';
                        if (is_null($lastDocument->Pending_Review_Complete_By) || $lastDocument->Pending_Review_Complete_By === '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->Pending_Review_Complete_By . ' , ' . $lastDocument->Pending_Review_Complete_On;
                        }
                        $history->current = $incident->Pending_Review_Complete_By . ' , ' . $incident->Pending_Review_Complete_On;
                        if (is_null($lastDocument->Pending_Review_Complete_By) || $lastDocument->HOD_Initial_Review_Complete_By === '') {
                            $history->action_name = 'New';
                        } else {
                            $history->action_name = 'Update';
                        }
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

                if ($incident->stage == 6) {
                    // dd($incident->qa_head_Remarks);
                    if ($incident->qa_head_Remarks)
                    {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for QA Final Review'
                        ]);

                    } else {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'HOD Final Review Comments field is yet to be filled!'
                        ]);

                        return redirect()->back();
                    }


                    $incident->stage = "7";
                    $incident->status = "QA Final Review";
                    $incident->Hod_Final_Review_Complete_By = Auth::user()->name;
                    $incident->Hod_Final_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $incident->Hod_Final_Review_Comments = $request->comment;

                    $history = new IncidentAuditTrail();
                    $history->incident_id = $id;
                    $history->activity_type = 'HOD Final Review Complete By,HOD Final Review Complete On';
                    $history->previous = "";
                    $history->current = $incident->Hod_Final_Review_Complete_By;
                    $history->comment = $request->comment;
                    $history->action ='HOD Final Review Complete';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA Final Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Approved';
                    if (is_null($lastDocument->Hod_Final_Review_Complete_By) || $lastDocument->Hod_Final_Review_Complete_By === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->Hod_Final_Review_Complete_By . ' , ' . $lastDocument->Hod_Final_Review_Complete_On;
                    }
                    $history->current = $incident->Hod_Final_Review_Complete_By . ' , ' . $incident->Hod_Final_Review_Complete_On;
                    if (is_null($lastDocument->Hod_Final_Review_Complete_By) || $lastDocument->HOD_Initial_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
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
                if ($incident->stage == 7)
                     {
                    if (!$incident->qa_final_review)

                    // if ($incident->form_progress !== 'qa_final_review')
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
                            'message' => ' Sent For QAH Approval state'
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
                    $incident->status = "QAH Approval";
                    $incident->Qa_Final_Review_Complete_By = Auth::user()->name;
                    $incident->Qa_Final_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $incident->Qa_Final_Review_Comments = $request->comment;

                    $history = new IncidentAuditTrail();
                    $history->incident_id = $id;
                    $history->activity_type = 'QA Final Review Complete By,QA Final Review Complete On';
                    $history->previous = "";
                    $history->action ='QA Final Review Complete';
                    $history->current = $incident->Qa_Final_Review_Complete_By;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QAH Approval";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'QAH Approval';
                    if (is_null($lastDocument->Qa_Final_Review_Complete_By) || $lastDocument->Qa_Final_Review_Complete_By === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->Qa_Final_Review_Complete_By . ' , ' . $lastDocument->Qa_Final_Review_Complete_On;
                    }
                    $history->current = $incident->Qa_Final_Review_Complete_By . ' , ' . $incident->Qa_Final_Review_Complete_On;
                    if (is_null($lastDocument->Qa_Final_Review_Complete_By) || $lastDocument->HOD_Initial_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
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
                // if ($incident->stage == 7) {

                //     if ($incident->form_progress !== 'qah')
                //     {

                //         Session::flash('swal', [
                //             'title' => 'Mandatory Fields!',
                //             'message' => 'QAH/Designee Approval Tab is yet to be filled!',
                //             'type' => 'warning',
                //         ]);

                //         return redirect()->back();
                //     } else {
                //         Session::flash('swal', [
                //             'type' => 'success',
                //             'title' => 'Success',
                //             'message' => 'Incident sent to QA Final Approval.'
                //         ]);
                //     }

                //     $extension = Extension::where('parent_id', $incident->id)->first();

                //     $rca = RootCauseAnalysis::where('parent_record', str_pad($incident->id, 4, 0, STR_PAD_LEFT))->first();

                //     if ($extension && $extension->status !== 'Closed-Done') {
                //         Session::flash('swal', [
                //             'title' => 'Extension record pending!',
                //             'message' => 'There is an Extension record which is yet to be closed/done!',
                //             'type' => 'warning',
                //         ]);

                //         return redirect()->back();
                //     }

                //     if ($rca && $rca->status !== 'Closed-Done') {
                //         Session::flash('swal', [
                //             'title' => 'RCA record pending!',
                //             'message' => 'There is an Root Cause Analysis record which is yet to be closed/done!',
                //             'type' => 'warning',
                //         ]);

                //         return redirect()->back();
                //     }

                //     // return "PAUSE";

                //     $incident->stage = "8";
                //     $incident->status = "Closed - Done";
                //     $incident->pending_initiator_approved_by = Auth::user()->name;
                //     $incident->pending_initiator_approved_on = Carbon::now()->format('d-M-Y');
                //     $incident->pending_initiator_approved_comment = $request->comment;

                //     $history = new IncidentAuditTrail();
                //     $history->incident_id = $id;
                //     $history->activity_type = 'Activity Log';
                //     $history->previous = "";
                //     $history->action ='Approved';
                //     $history->current = $incident->pending_initiator_approved_by;
                //     $history->comment = $request->comment;
                //     $history->user_id = Auth::user()->id;
                //     $history->user_name = Auth::user()->name;
                //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                //     $history->origin_state = $lastDocument->status;
                //     $history->change_to =   "Closed - Done";
                //     $history->change_from = $lastDocument->status;
                //     $history->stage = 'Closed - Done';
                //     $history->save();
                //     // $list = Helpers::getQAUserList();
                //     // foreach ($list as $u) {
                //     //     if ($u->q_m_s_divisions_id == $incident->division_id) {
                //     //         $email = Helpers::getInitiatorEmail($u->user_id);
                //     //         if ($email !== null) {
                //     //             try {
                //     //                 Mail::send(
                //     //                     'mail.view-mail',
                //     //                     ['data' => $incident],
                //     //                     function ($message) use ($email) {
                //     //                         $message->to($email)
                //     //                             ->subject("Activity Performed By " . Auth::user()->name);
                //     //                     }
                //     //                 );
                //     //             } catch (\Exception $e) {
                //     //                 //log error
                //     //             }
                //     //         }
                //     //     }
                //     // }
                //     $incident->update();
                //     toastr()->success('Document Sent');
                //     return back();
                // }


                if ($incident->stage == 8) {
                    if (!$incident->Closure_Comments)
                    {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields!',
                            'message' => 'Closure Comments field is yet to be filled!',
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

                    // if ($extension && $extension->status !== 'Closed-Done') {
                    //     Session::flash('swal', [
                    //         'title' => 'Extension record pending!',
                    //         'message' => 'There is an Extension record which is yet to be closed/done!',
                    //         'type' => 'warning',
                    //     ]);

                    //     return redirect()->back();
                    // }

                    // if ($rca && $rca->status !== 'Closed-Done') {
                    //     Session::flash('swal', [
                    //         'title' => 'RCA record pending!',
                    //         'message' => 'There is an Root Cause Analysis record which is yet to be closed/done!',
                    //         'type' => 'warning',
                    //     ]);

                    //     return redirect()->back();
                    // }

                    // return "PAUSE";

                    $incident->stage = "9";
                    $incident->status = "Closed-Done";
                    $incident->QA_head_approved_by = Auth::user()->name;
                    $incident->QA_head_approved_on = Carbon::now()->format('d-M-Y');
                    $incident->QA_head_approved_comment = $request->comment;

                    $history = new IncidentAuditTrail();
                    $history->incident_id = $id;
                    $history->activity_type = 'Approved By, Approved On';
                    $history->previous = "";
                    $history->action ='Approved';
                    $history->current = $incident->QA_head_approved_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Closed-Done";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Closed-Done';
                    if (is_null($lastDocument->QA_head_approved_by) || $lastDocument->QA_head_approved_by === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->QA_head_approved_by . ' , ' . $lastDocument->QA_head_approved_on;
                    }
                    $history->current = $incident->QA_head_approved_by . ' , ' . $incident->QA_head_approved_on;
                    if (is_null($lastDocument->QA_head_approved_by) || $lastDocument->HOD_Initial_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
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
                $incident->status = "HOD Initial ";
                $incident->qa_more_info_required_by = Auth::user()->name;
                $incident->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action='More Info Required By';
                $history->current = $incident->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->change_to =   "HOD Initial Review";
                $history->change_from = $lastDocument->status;

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


            if ($incident->stage == 5) {
                $incident->stage = "4";
                $incident->status = "QAH/Designee Approval";
                $incident->QAH_Designee_More_Info_Required_by = Auth::user()->name;
                $incident->QAH_Designee_More_Info_Required_on = Carbon::now()->format('d-M-Y');
                $history->QAH_Designee_More_Info_Required_comments = $request->comment;

                $history = new IncidentAuditTrail();
                $history->incident_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->action=' More Information Required';
                $history->current = $incident->QAH_Designee_More_Info_Required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Information Required';
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



            if ($incident->stage == 6) {
                $incident->stage = "5";
                $incident->status = "Pending Initiator Update";
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

            if ($incident->stage == 7) {
                $incident->stage = "6";
                $incident->status = "HOD Final Review";
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

            //if ($incident->stage == 8) {
            //    $incident->stage = "7";
            //    $incident->status = "QA Final Review";
            //    $incident->qa_more_info_required_by = Auth::user()->name;
            //    $incident->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
            //    $history = new IncidentAuditTrail();
            //    $history->incident_id = $id;
            //    $history->activity_type = 'Activity Log';
            //    $history->previous = "";
            //    $history->action='More Information Required';
            //    $history->current = $incident->qa_more_info_required_by;
            //    $history->comment = $request->comment;
            //    $history->user_id = Auth::user()->id;
            //    $history->user_name = Auth::user()->name;
            //    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //    $history->origin_state = $lastDocument->status;
            //    $history->stage = 'More Info Required';
            //    $history->save();
            //    $incident->update();
            //    $history = new IncidentHistory();
            //    $history->type = "Incident";
            //    $history->doc_id = $id;
            //    $history->user_id = Auth::user()->id;
            //    $history->user_name = Auth::user()->name;
            //    $history->stage_id = $incident->stage;
            //    $history->status = $incident->status;
            //    $history->save();
            //    toastr()->success('Document Sent');
            //    return back();
            //}
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
        $users = User::all();

        return view('frontend.incident.audit-trail', compact('users','audit', 'document', 'today'));
    }

    public function incidentAuditTrailPdf($id)
    {
        $doc = Incident::find($id);
        $audit = IncidentAuditTrail::where('incident_id', $id)->paginate();
        $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        $data = IncidentAuditTrail::where('incident_id', $doc->id)->get();
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.incident.audit-trail-pdf', compact('data', 'doc','audit'))
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
             $grid_data2 = IncidentGrid::where('incident_grid_id', $id)->where('type', "Product")->first();


            // $json_decode = IncidentGridData::where(['incident_id' => $id, 'identifier' => 'TeamInvestigation'])->first();

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
            $pdf = PDF::loadview('frontend.incident.single-report', compact('data','qrmExtension', 'grid_data2','grid_data','grid_data1','root_cause_data','why_data','investigationExtension'))
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

    public function incident_child_1(Request $request, $id)
    {

        $cft = [];
        $parent_id = $id;
        $parent_type = "Audit_Program";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $parent_record = Incident::where('id', $id)->value('record');
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_division_id = Incident::where('id', $id)->value('division_id');
        $parent_initiator_id = Incident::where('id', $id)->value('initiator_id');
        $parent_intiation_date = Incident::where('id', $id)->value('intiation_date');
        $parent_created_at = Incident::where('id', $id)->value('created_at');
        $parent_short_description = Incident::where('id', $id)->value('short_description');
        $hod = User::where('role', 4)->get();
        if ($request->child_type == "extension") {
            $parent_due_date = "";
            $parent_id = $id;
            $parent_type = "extension";
            $parent_name = $request->parent_name;

            $record_number = ((RecordNumber::first()->value('counter')) + 1);
            $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            $Extensionchild = Incident::find($id);
            $Extensionchild->Extensionchild = $record_number;
            $old_records = Incident::select('id', 'division_id', 'record')->get();
            $relatedRecords = Helpers::getAllRelatedRecords();

            $Extensionchild->save();
            return view('frontend.extension.extension_new', compact('parent_id','parent_record', 'parent_name', 'record_number', 'parent_due_date', 'due_date','old_records', 'parent_type','parent_created_at','relatedRecords'));

        }
        $old_record = Incident::select('id', 'division_id', 'record')->get();
        // dd($request->child_type)
        if ($request->child_type == "capa") {
            $parent_name = "CAPA";
            $record = ((RecordNumber::first()->value('counter')) + 1);
            $record = str_pad($record, 4, '0', STR_PAD_LEFT);
            $Capachild = Incident::find($id);
            $Capachild->Capachild = $record;
            $old_records = Incident::select('id', 'division_id', 'record')->get();
            $relatedRecords = Helpers::getAllRelatedRecords();

            $Capachild->save();


            return view('frontend.forms.capa', compact('relatedRecords','parent_id','record_number', 'parent_record','parent_type', 'record', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'old_records', 'cft'));
        } elseif ($request->child_type == "Action_Item")
         {
            $parent_name = "CAPA";
            $actionchild = Incident::find($id);
            $actionchild->actionchild = $record_number;
            $parent_id = $id;
            $actionchild->save();

            return view('frontend.forms.action-item', compact('old_record', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'record_number', 'due_date', 'parent_id', 'parent_type'));
        }
        elseif ($request->child_type == "effectiveness_check")
         {
            $parent_name = "CAPA";
            $effectivenesschild = Incident::find($id);
            $effectivenesschild->effectivenesschild = $record_number;
            $effectivenesschild->save();
        return view('frontend.forms.effectiveness-check', compact('old_record','parent_short_description','parent_record', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id',  'record_number', 'due_date', 'parent_id', 'parent_type'));
        }
        elseif ($request->child_type == "Change_control") {
            $parent_name = "CAPA";
            $Changecontrolchild = Incident::find($id);
            $Changecontrolchild->Changecontrolchild = $record_number;

            $Changecontrolchild->save();

            return view('frontend.change-control.new-change-control', compact('cft','pre','hod','parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id',  'record_number', 'due_date', 'parent_id', 'parent_type'));
        }
        else {
            $parent_name = "Root";
            $Rootchild = Incident::find($id);
            $Rootchild->Rootchild = $record_number;
            $Rootchild->save();
            return view('frontend.forms.root-cause-analysis', compact('parent_id', 'parent_record','parent_type', 'record_number', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', ));
        }
    }

    public function audit_trail_filter_incident(Request $request, $id)
    {
        // Start query for DeviationAuditTrail
        $query = IncidentAuditTrail::query();
        $query->where('Incident_id', $id);

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
                    $stage=[  'Submit', 'HOD Review Complete', 'QA/CQA Initial Review Complete','Request For Cancellation',
                        'CFT Review Complete', 'QA/CQA Final Assessment Complete', 'Approved','Send to Initiator','Send to HOD','Send to QA/CQA Initial Review','Send to Pending Initiator Update',
                        'QA/CQA Final Review Complete', 'Rejected', 'Initiator Updated Complete',
                        'HOD Final Review Complete', 'More Info Required', 'Cancel','Implementation verification Complete','Closure Approved'];
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
        $responseHtml = view('frontend.incident.incident_filter', compact('audit', 'filter_request'))->render();

        return response()->json(['html' => $responseHtml]);
    }



}
