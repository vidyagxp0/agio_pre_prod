<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviationNewGridData;
use App\Models\DeviationCftsResponse;
use App\Models\RootCauseAnalysis;
use App\Models\FailureInvestigationGridData;
use App\Models\{EffectivenessCheck,LaunchExtension,DeviationGridQrms};
use App\Models\CC;
use App\Models\ActionItem;
use App\Models\Deviation;
use App\Models\Extension;
use App\Models\DeviationAuditTrail;
use App\Models\DeviationGrid;
use App\Models\DeviationHistory;
use App\Models\DeviationCft;
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

class DeviationController extends Controller
{
    public function deviation(Request $request){
        $old_record = Deviation::select('id', 'division_id', 'record')->get();
        $record_number = (RecordNumber::first()->value('counter')) + 1;
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $pre = Deviation::all();
        return response()->view('frontend.forms.deviation.deviation_new', compact('formattedDate', 'due_date', 'old_record', 'pre','record_number'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $form_progress = null;

        if ($request->form_name == 'general')
        {
            $validator = Validator::make($request->all(), [
                'short_description' => 'required',
                'due_date'=>'required'

            ], [
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

        // if (!$request->short_description) {
        //     toastr()->error("Short description is required");
        //     return response()->redirect()->back()->withInput();
        // }
        $initiationDate = $request->intiation_date;
        $deviationCategory = $request->Deviation_category;
          // Determine the number of days based on deviation category
            $days = 0;
            switch ($deviationCategory) {
                case 'minor':
                    $days = 15;
                    break;
                case 'major':
                    $days = 30;
                    break;
                case 'critical':
                    $days = 30;
                    break;
            }


        $deviation = new Deviation();
        $deviation->form_type = "Deviation";

        $deviation->record = ((RecordNumber::first()->value('counter')) + 1);
        $deviation->initiator_id = Auth::user()->id;

        $deviation->form_progress = isset($form_progress) ? $form_progress : null;

        # -------------new-----------
        //  $deviation->record_number = $request->record_number;
        $deviation->division_id = $request->division_id;
        $deviation->assign_to = $request->assign_to;
        //$deviation->Facility = $request->Facility;
        if (is_array($request->Facility)) {
            $deviation->Facility = implode(',', $request->Facility);
        }
        $deviation->due_date = $request->due_date;
        $deviation->intiation_date = $initiationDate;
        $deviation->Deviation_category = $deviationCategory;
        $deviation->days = $days;
        $deviation->Initiator_Group = $request->Initiator_Group;
        $deviation->initiator_group_code = $request->initiator_group_code;
        $deviation->short_description = $request->short_description;
        $deviation->Deviation_date = $request->Deviation_date;
        // $deviation->discb_deviat = $request->discb_deviat;
        $deviation->discb_deviat = implode(',', $request->discb_deviat);
        $deviation->deviation_time = $request->deviation_time;
        $deviation->Hod_person_to = $request->Hod_person_to;
        $deviation->Reviewer_to = $request->Reviewer_to;
        $deviation->Approver_to = $request->Approver_to;
        $deviation->Deviation_reported_date = $request->Deviation_reported_date;
        if (is_array($request->audit_type)) {
            $deviation->audit_type = implode(',', $request->audit_type);
        }
        $deviation->short_description_required = $request->short_description_required;
        $deviation->nature_of_repeat = $request->nature_of_repeat;
        $deviation->others = $request->others;
        $deviation->Delay_Justification = $request->Delay_Justification;

        $deviation->Product_Batch = $request->Product_Batch;

        // $deviation->Description_Deviation = implode(',', $request->Description_Deviation);
        $deviation->Immediate_Action = implode(',', $request->Immediate_Action);
        $deviation->Preliminary_Impact = implode(',', $request->Preliminary_Impact);
        $deviation->Product_Details_Required = $request->Product_Details_Required;

        $deviation->HOD_Remarks = $request->HOD_Remarks;
        $deviation->Pending_initiator_update = $request->Pending_initiator_update;
         $deviation->hod_final_review = $request->hod_final_review;

        // $deviation->Deviation_category = $deviationCategory;
        // $deviation->days = $days;
        // // if($request->Deviation_category=='')
        $deviation->Justification_for_categorization = $request->Justification_for_categorization;
        $deviation->Investigation_required = $request->Investigation_required;
        $deviation->capa_required = $request->capa_required;
        $deviation->qrm_required = $request->qrm_required;

        $deviation->Investigation_Details = $request->Investigation_Details;
        $deviation->Customer_notification = $request->Customer_notification;
        $deviation->customers = $request->customers;

        $deviation->qa_final_assement = $request->qa_final_assement;
        $deviation->qa_head_designe_comment = $request->qa_head_designe_comment;


        $deviation->QAInitialRemark = $request->QAInitialRemark;

        $deviation->Investigation_Summary = $request->Investigation_Summary;
        $deviation->Impact_assessment = $request->Impact_assessment;
        $deviation->Root_cause = $request->Root_cause;
        $deviation->CAPA_Rquired = $request->CAPA_Rquired;
        $deviation->capa_type = $request->capa_type;
        $deviation->CAPA_Description = $request->CAPA_Description;
        $deviation->Post_Categorization = $request->Post_Categorization;
        $deviation->Investigation_Of_Review = $request->Investigation_Of_Review;
        $deviation->QA_Feedbacks = $request->QA_Feedbacks;
        $deviation->Closure_Comments = $request->Closure_Comments;
        $deviation->Disposition_Batch = $request->Disposition_Batch;
        $deviation->Facility_Equipment = $request->Facility_Equipment;
        $deviation->Document_Details_Required = $request->Document_Details_Required;
        // New Added Line
        $deviation->what=$request->what;
        $deviation->why_why=$request->why_why;
        $deviation->where_where=$request->where_where;
        $deviation->when_when=$request->when_when;
        $deviation->who=$request->who;
        $deviation->how=$request->how;
        $deviation->how_much=$request->how_much;
        $deviation->Detail_Of_Root_Cause=$request->Detail_Of_Root_Cause;

        if ($request->Deviation_category == 'major' || $request->Deviation_category == 'minor' || $request->Deviation_category == 'critical') {
            $list = Helpers::getHeadoperationsUserList();
                    foreach ($list as $u) {
                        if ($u->q_m_s_divisions_id == $deviation->division_id) {
                            $email = Helpers::getInitiatorEmail($u->user_id);
                            if ($email !== null) {
                                 // Add this if statement
                                try {
                                    Mail::send(
                                        'mail.Categorymail',
                                        ['data' => $deviation],
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


                if ($request->Deviation_category == 'major' || $request->Deviation_category == 'minor' || $request->Deviation_category == 'critical') {
                    $list = Helpers::getCEOUserList();
                            foreach ($list as $u) {
                                if ($u->q_m_s_divisions_id == $deviation->division_id) {
                                    $email = Helpers::getInitiatorEmail($u->user_id);
                                    if ($email !== null) {
                                         // Add this if statement
                                         try {
                                                Mail::send(
                                                    'mail.Categorymail',
                                                    ['data' => $deviation],
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
                        if ($request->Deviation_category == 'major' || $request->Deviation_category == 'minor' || $request->Deviation_category == 'critical') {
                            $list = Helpers::getCorporateEHSHeadUserList();
                                    foreach ($list as $u) {
                                        if ($u->q_m_s_divisions_id == $deviation->division_id) {
                                            $email = Helpers::getInitiatorEmail($u->user_id);
                                            if ($email !== null) {
                                                 // Add this if statement
                                                 try {
                                                        Mail::send(
                                                            'mail.Categorymail',
                                                            ['data' => $deviation],
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
                                                if ($u->q_m_s_divisions_id == $deviation->division_id) {
                                                    $email = Helpers::getInitiatorEmail($u->user_id);
                                                    if ($email !== null) {
                                                         // Add this if statement
                                                         try {
                                                            Mail::send(
                                                                'mail.Categorymail',
                                                                ['data' => $deviation],
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
                                                        if ($u->q_m_s_divisions_id == $deviation->division_id) {
                                                            $email = Helpers::getInitiatorEmail($u->user_id);
                                                            if ($email !== null) {
                                                                 // Add this if statement
                                                                 try {
                                                                        Mail::send(
                                                                            'mail.Categorymail',
                                                                            ['data' => $deviation],
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
                                                                if ($u->q_m_s_divisions_id == $deviation->division_id) {
                                                                    $email = Helpers::getInitiatorEmail($u->user_id);
                                                                    if ($email !== null) {
                                                                         // Add this if statement
                                                                         try {
                                                                                Mail::send(
                                                                                    'mail.Categorymail',
                                                                                    ['data' => $deviation],
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

        if (!empty ($request->hod_file_attachment)) {
            $files = [];
            if ($request->hasfile('hod_file_attachment')) {
                foreach ($request->file('hod_file_attachment') as $file) {
                    $name = $request->name . 'hod_file_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->hod_file_attachment = json_encode($files);
        }
         if (!empty ($request->pending_attachment)) {
            $files = [];
            if ($request->hasfile('pending_attachment')) {
                foreach ($request->file('pending_attachment') as $file) {
                    $name = $request->name . 'pending_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->pending_attachment = json_encode($files);
        }
         if (!empty ($request->hod_final_attachment)) {
            $files = [];
            if ($request->hasfile('hod_final_attachment')) {
                foreach ($request->file('hod_final_attachment') as $file) {
                    $name = $request->name . 'hod_final_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->hod_final_attachment = json_encode($files);
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


            $deviation->initial_file = json_encode($files);
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


            $deviation->Initial_attachment = json_encode($files);
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


            $deviation->QA_attachment = json_encode($files);
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


            $deviation->Investigation_attachment = json_encode($files);
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


            $deviation->Capa_attachment = json_encode($files);
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


            $deviation->QA_attachments = json_encode($files);
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


            $deviation->closure_attachment = json_encode($files);
        }



        if (!empty ($request->qa_final_assement_attach)) {
            $files = [];
            if ($request->hasfile('qa_final_assement_attach')) {
                foreach ($request->file('qa_final_assement_attach') as $file) {
                    $name = $request->name . 'qa_final_assement_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->qa_final_assement_attach = json_encode($files);
        }


        if (!empty ($request->qa_head_designee_attach)) {
            $files = [];
            if ($request->hasfile('qa_head_designee_attach')) {
                foreach ($request->file('qa_head_designee_attach') as $file) {
                    $name = $request->name . 'qa_head_designee_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->qa_head_designee_attach = json_encode($files);
        }
        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();



        $deviation->status = 'Opened';
        $deviation->stage = 1;

        $deviation->save();

        $teamInvestigationData = DeviationNewGridData::where(['deviation_id' => $deviation->id, 'identifier' => "TeamInvestigation"])->firstOrCreate();
        $teamInvestigationData->deviation_id = $deviation->id;
        $teamInvestigationData->identifier = "TeamInvestigation";
        $teamInvestigationData->data = $request->investigationTeam;
        $teamInvestigationData->save();

        $rootCauseData = DeviationNewGridData::where(['deviation_id' => $deviation->id, 'identifier' => "RootCause"])->firstOrCreate();
        $rootCauseData->deviation_id = $deviation->id;
        $rootCauseData->identifier = "RootCause";
        $rootCauseData->data = $request->rootCauseData;
        $rootCauseData->save();

        $newDataGridWhy = DeviationNewGridData::where(['deviation_id' => $deviation->id, 'identifier' => 'why'])->firstOrCreate();
        $newDataGridWhy->deviation_id = $deviation->id;
        $newDataGridWhy->identifier = 'why';
        $newDataGridWhy->data = $request->why;
        $newDataGridWhy->save();

        $newDataGridFishbone = DeviationNewGridData::where(['deviation_id' => $deviation->id, 'identifier' => 'fishbone'])->firstOrCreate();
        $newDataGridFishbone->deviation_id = $deviation->id;
        $newDataGridFishbone->identifier = 'fishbone';
        $newDataGridFishbone->data = $request->fishbone;
        $newDataGridFishbone->save();

        $data3 = new DeviationGrid();
        $data3->deviation_grid_id = $deviation->id;
        $data3->type = "Deviation";

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
        $fieldNames = [
            'facility_name' => 'Related to',
            'IDnumber' => 'Name & ID Number',
            'Remarks' => 'Remarks'
        ];

        // Check if $request->Number is an array and not null
        if (!empty($request->facility_name) && is_array($request->facility_name)) {
            foreach ($request->facility_name as $index => $facility_name) {
                // Ensure the necessary arrays are present and have corresponding values
                $IDnumber = $request->IDnumber[$index] ?? null;
                $Remarks = $request->Remarks[$index] ?? null;

                // Since this is a new entry, there are no previous details
                $previousDetails = [
                    'facility_name' => null,
                    'IDnumber' => null,
                    'Remarks' => null,
                ];

                // Current fields values from the request
                $fields = [
                    'facility_name' => $facility_name,
                    'IDnumber' => $IDnumber,
                    'Remarks' => $Remarks,
                ];

                foreach ($fields as $key => $currentValue) {
                    // Log changes for new rows (no previous value to compare)
                    if (!empty($currentValue)) {
                        // Only create an audit trail entry for new values
                        $history = new DeviationAuditTrail();
                        $history->deviation_id = $deviation->id;

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
        }



        $data4 = new DeviationGrid();
        $data4->deviation_grid_id = $deviation->id;
        $data4->type = "Document";
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
        $fieldNames = [
            'Number' => 'Document Number',
            'ReferenceDocumentName' => 'Document Name',
            'Document_Remarks' => 'Remarks'
        ];

        // Check if $request->Number is an array and not null
        if (!empty($request->Number) && is_array($request->Number)) {
            foreach ($request->Number as $index => $Number) {
                // Ensure the necessary arrays are present and have corresponding values
                $ReferenceDocumentName = $request->ReferenceDocumentName[$index] ?? null;
                $Document_Remarks = $request->Document_Remarks[$index] ?? null;

                // Since this is a new entry, there are no previous details
                $previousDetails = [
                    'Number' => null,
                    'ReferenceDocumentName' => null,
                    'Document_Remarks' => null,
                ];

                // Current fields values from the request
                $fields = [
                    'Number' => $Number,
                    'ReferenceDocumentName' => $ReferenceDocumentName,
                    'Document_Remarks' => $Document_Remarks,
                ];

                foreach ($fields as $key => $currentValue) {
                    // Log changes for new rows (no previous value to compare)
                    if (!empty($currentValue)) {
                        // Only create an audit trail entry for new values
                        $history = new DeviationAuditTrail();
                        $history->deviation_id = $deviation->id;

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
        }


        $data5 = new DeviationGrid();
        $data5->deviation_grid_id = $deviation->id;
        $data5->type = "Product";
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
        $fieldNames = [
            'product_name' => 'Product / Material',
            'product_stage' => 'Stage',
            'batch_no' => 'A.R.No. / Batch No'
        ];

        // Check if $request->product_name is an array and not null
        if (!empty($request->product_name) && is_array($request->product_name)) {
            foreach ($request->product_name as $index => $product_name) {
                // Ensure the necessary arrays are present and have corresponding values
                $product_stage = $request->product_stage[$index] ?? null;
                $batch_no = $request->batch_no[$index] ?? null;

                // Since this is a new entry, there are no previous details
                $previousDetails = [
                    'product_name' => null,
                    'product_stage' => null,
                    'batch_no' => null,
                ];

                // Current fields values from the request
                $fields = [
                    'product_name' => $product_name,
                    'product_stage' => $product_stage,
                    'batch_no' => $batch_no,
                ];

                foreach ($fields as $key => $currentValue) {
                    // Log changes for new rows (no previous value to compare)
                    if (!empty($currentValue)) {
                        // Only create an audit trail entry for new values
                        $history = new DeviationAuditTrail();
                        $history->deviation_id = $deviation->id;

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
        }


         $data8 = new DeviationGrid();


        $data8->deviation_grid_id = $deviation->id;
        $data8->type = "effect_analysis";
        // if (!empty($request->risk_factor)) {
        //     $data8->risk_factor = serialize($request->risk_factor);
        // }
        // if (!empty($request->risk_element)) {
        //     $data8->risk_element = serialize($request->risk_element);
        // }
        // if (!empty($request->problem_cause)) {
        //     $data8->problem_cause = serialize($request->problem_cause);
        // }
        // if (!empty($request->existing_risk_control)) {
        //     $data8->existing_risk_control = serialize($request->existing_risk_control);
        // }
        // if (!empty($request->initial_severity)) {
        //     $data8->initial_severity = serialize($request->initial_severity);
        // }
        // if (!empty($request->initial_detectability)) {
        //     $data8->initial_detectability = serialize($request->initial_detectability);
        // }
        // if (!empty($request->initial_probability)) {
        //     $data8->initial_probability = serialize($request->initial_probability);
        // }
        // if (!empty($request->initial_rpn)) {
        //     $data8->initial_rpn = serialize($request->initial_rpn);
        // }
        // if (!empty($request->risk_acceptance)) {
        //     $data8->risk_acceptance = serialize($request->risk_acceptance);
        // }
        // if (!empty($request->risk_control_measure)) {
        //     $data8->risk_control_measure = serialize($request->risk_control_measure);
        // }
        // if (!empty($request->residual_severity)) {
        //     $data8->residual_severity = serialize($request->residual_severity);
        // }
        // if (!empty($request->residual_probability)) {
        //     $data8->residual_probability = serialize($request->residual_probability);
        // }
        // if (!empty($request->residual_detectability)) {
        //     $data8->residual_detectability = serialize($request->residual_detectability);
        // }
        // if (!empty($request->residual_rpn)) {
        //     $data8->residual_rpn = serialize($request->residual_rpn);
        // }

        // if (!empty($request->risk_acceptance2)) {
        //     $data8->risk_acceptance2 = serialize($request->risk_acceptance2);
        // }
        // if (!empty($request->mitigation_proposal)) {
        //     $data8->mitigation_proposal = serialize($request->mitigation_proposal);
        // }

        // $data8->save();




        $Cft = new DeviationCft();
        $Cft->deviation_id = $deviation->id;
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


            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Record Number';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName(session()->get('division')) . "/DEV/" . Helpers::year($deviation->created_at) . "/" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();


            if (!empty ($request->division_id)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Site/Location Code';
            $history->previous = "Null";
            $history->current =Helpers::getDivisionName($deviation->division_id);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
           }
           if (!empty ($request->division_id)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = Auth::user()->name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
           }

            if (!empty ($request->intiation_date)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = "Null";
            $history->current =  Helpers::getdateFormat($deviation->intiation_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
            }
                           if (!empty ($request->due_date)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current =Helpers::getdateFormat ($deviation->due_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
               }
                if (!empty ($request->Initiator_Group)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Initiation Department';
            $history->previous = "Null";
            $history->current = $deviation->Initiator_Group;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty ($request->Initiator_Group)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Initiation Department Code';
            $history->previous = "Null";
            $history->current = $deviation->initiator_group_code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty ($request->short_description)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $deviation->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
         if (!empty ($request->nature_of_repeat)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Repeat Deviation';
            $history->previous = "Null";
            $history->current = $deviation->nature_of_repeat;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }


        if (!empty ($request->Deviation_date)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Deviation Observed On';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($deviation->Deviation_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
         if (!empty ($request->deviation_time)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Deviation Observed On (Time)';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($deviation->deviation_time);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
         if (!empty ($request->Deviation_reported_date)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Deviation Reported on';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($deviation->Deviation_reported_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (is_array($request->Deviation_reported_date)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Deviation Observed On (Time)';
            $history->previous = "Null";
            $history->current = $deviation->Deviation_reported_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (is_array($request->Delay_Justification)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Delay Justification';
            $history->previous = "Null";
            $history->current = $deviation->Delay_Justification;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
          if (is_array($request->Facility) && array_key_exists(0, $request->Facility) && $request->Facility[0] !== null){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Deviation Observed By';
            $history->previous = "Null";
            $history->current = $deviation->Facility;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (is_array($request->others)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Others';
            $history->previous = "Null";
            $history->current = $deviation->others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

               if (is_array($request->audit_type) && array_key_exists(0, $request->audit_type) && $request->audit_type[0] !== null){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Deviation Related To';
            $history->previous = "Null";
            $history->current = $deviation->audit_type;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->others)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Others';
            $history->previous = "Null";
            $history->current = $deviation->others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->action_name = 'Create';
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->save();
        }
        if (!empty ($request->Facility_Equipment)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Facility/ Equipment/ Instrument/ System Details Required?';
            $history->previous = "Null";
            $history->current = $deviation->Facility_Equipment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Document_Details_Required)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Document Details Required?';
            $history->previous = "Null";
            $history->current = $deviation->Document_Details_Required;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->action_name = 'Create';
            $history->save();
        }
         if (!empty ($deviation->discb_deviat)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Description of Deviation';
            $history->previous = "Null";
            $history->current = $deviation->discb_deviat;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Hod_person_to)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'HOD Person';
            $history->previous = "Null";
            $history->current = $deviation->Hod_person_to;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Approver_to)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Approver Person';
            $history->previous = "Null";
            $history->current = $deviation->Approver_to;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Reviewer_to)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Reviewer Person';
            $history->previous = "Null";
            $history->current = $deviation->Reviewer_to;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty ($request->qa_head_designe_comment)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'QA/CQA Head/Designee Approval comment';
            $history->previous = "Null";
            $history->current = $deviation->qa_head_designe_comment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty ($request->Product_Batch)){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Product & Batch No';
            $history->previous = "Null";
            $history->current = $deviation->Product_Batch;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->action_name = 'Create';
            $history->save();
        }
if (is_array($request->Description_Deviation) && array_key_exists(0, $request->Description_Deviation) && $request->Description_Deviation[0] !== null){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Description of Deviation';
            $history->previous = "Null";
            $history->current = $deviation->Description_Deviation;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->action_name = 'Create';
            $history->save();
        }


               if (is_array($request->Immediate_Action) && array_key_exists(0, $request->Immediate_Action) && $request->Immediate_Action[0] !== null){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Immediate Action (if any)';
            $history->previous = "Null";
            $history->current = $deviation->Immediate_Action;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $deviation->status;
        $history->action_name = 'Create';
        $history->save();
        }
        //   if ($request->initial_file[0] !== null){
        //     $history = new DeviationAuditTrail();
        //     $history->deviation_id = $deviation->id;
        //     $history->activity_type = 'Initial Attachments';
        //     $history->previous = "Null";
        //     $history->current = $deviation->initial_file;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiator";
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $deviation->status;
        //     $history->action_name = 'Create';
        //     $history->save();
        // }
               if (is_array($request->Preliminary_Impact) && array_key_exists(0, $request->Preliminary_Impact) && $request->Preliminary_Impact[0] !== null){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Preliminary Impact of Deviation';
            $history->previous = "Null";
            $history->current = $deviation->Preliminary_Impact;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->action_name = 'Create';
            $history->save();
        }
        if (is_array($request->initial_file) && array_key_exists(0, $request->initial_file) && $request->initial_file[0] !== null){
            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = 'Initial Attachments';
            $history->previous = "Null";
            $history->current = $deviation->initial_file;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $deviation->status;
            $history->action_name = 'Create';
            $history->save();
        }

         if (!empty($deviation->inv_attachment)) {
        $history = new DeviationAuditTrail();
        $history->deviation_id = $deviation->id;
        $history->activity_type = 'Initial Attachment';
        $history->previous = "Null";
        $history->current = $deviation->inv_attachment;
        $history->comment = "NA";
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


    public function devshow($id)
    {
        $old_record = Deviation::select('id', 'division_id', 'record')->get();
        // $currentDate = Carbon::now();
        // $formattedDate = $currentDate->addDays(30);
        // $due_date = $formattedDate->format('d-M-Y');
        $data = Deviation::find($id);

        $userData = User::all();
        $data1 = DeviationCft::where('deviation_id', $id)->latest()->first();
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $riskEffectAnalysis = DeviationGrid::where('deviation_grid_id', $id)->where('type', "effect_analysis")->latest()->first();
        $grid_data = DeviationGrid::where('deviation_grid_id', $id)->where('type', "Deviation")->first();
        $grid_data1 = DeviationGrid::where('deviation_grid_id', $id)->where('type', "Document")->first();
        $grid_data2 = DeviationGrid::where('deviation_grid_id', $id)->where('type', "Product")->first();
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        // dd($data->initiator_id);
        $pre = Deviation::all();
        $divisionName = DB::table('q_m_s_divisions')->where('id', $data->division_id)->value('name');
        $deviationNewGrid = DeviationNewGridData::where('deviation_id', $id)->latest()->first();

        $investigationTeam = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => 'TeamInvestigation'])->first();
        $investigationTeamData = json_decode($investigationTeam->data, true);

        $rootCause = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => 'RootCause'])->first();
        $rootCauseData = json_decode($rootCause->data, true);

        $whyData = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => 'why'])->first();
        $why_data = json_decode($whyData->data, true);

        $fishbone = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => 'fishbone'])->first();
        $fishbone_data = json_decode($fishbone->data, true);

        $grid_data_qrms = DeviationGridQrms::where(['deviation_id' => $id, 'identifier' => 'failure_mode_qrms'])->first();
        $grid_data_matrix_qrms = DeviationGridQrms::where(['deviation_id' => $id, 'identifier' => 'matrix_qrms'])->first();

        $capaExtension = LaunchExtension::where(['deviation_id' => $id, "extension_identifier" => "Capa"])->first();
        $qrmExtension = LaunchExtension::where(['deviation_id' => $id, "extension_identifier" => "QRM"])->first();
        $investigationExtension = LaunchExtension::where(['deviation_id' => $id, "extension_identifier" => "Investigation"])->first();
        $deviationExtension = LaunchExtension::where(['deviation_id' => $id, "extension_identifier" => "Deviation"])->first();

        // return $riskEffectAnalysis;
        return view('frontend.forms.deviation.deviation_view', compact('riskEffectAnalysis','data','userData', 'grid_data_qrms','grid_data_matrix_qrms', 'capaExtension','qrmExtension','investigationExtension','deviationExtension', 'old_record', 'pre', 'data1', 'divisionName','grid_data','grid_data1', 'deviationNewGrid','grid_data2','investigationTeamData','rootCauseData', 'why_data', 'fishbone_data'));
    }




    public function update(Request $request, $id)
    {

      // dd($request->all());
        $form_progress = null;

        $lastDeviation = deviation::find($id);
        $lastDeviationAuditTrail = deviation::find($id);
        $deviation = deviation::find($id);

        // $lastDocument = deviation::find($id);
        $lastCft = DeviationCft::where('deviation_id', $deviation->id)->first();
        $deviation->Delay_Justification = $request->Delay_Justification;


        $whyData = [];
        if (!empty($request->why_questions) && !empty($request->why_answers)) {
            foreach ($request->why_questions as $index => $question) {
                $whyData[] = [
                    'question' => $question,
                    'answer' => $request->why_answers[$index] ?? '',
                ];
            }
        }
        $deviation->why_data = !empty($whyData) ? serialize($whyData) : null;
        if (!empty($request->why_root_cause)) {
            $deviation->why_root_cause = $request->why_root_cause;
        }

        if (!empty($request->why_problem_statement)) {
            $deviation->why_problem_statement = $request->why_problem_statement;
        }

        // Is/Is Not Anal
        $deviation->what = $request->what;
        $deviation->why_why = $request->why_why;
        $deviation->where_where = $request->where_where;
        $deviation->due_date = $request->due_date;
        $deviation->others_data = $request->others_data;
        // $deviation->discb_deviat = $request->discb_deviat;
        $deviation->when_when = $request->when_when;
        $deviation->who = $request->who;
        $deviation->how = $request->how;

        $deviation->how_much = $request->how_much;
        $deviation->Detail_Of_Root_Cause=$request->Detail_Of_Root_Cause;
        $deviation->Investigation_required = $request->Investigation_required;
        // dd($deviation->Investigation_required );
        $deviation->capa_required = $request->capa_required;
        $deviation->qrm_required = $request->qrm_required;

        $deviation->capa_root_cause = $request->capa_root_cause;
        $deviation->Immediate_Action_Take = $request->Immediate_Action_Take;
        $deviation->Corrective_Action_Details = $request->Corrective_Action_Details;
        $deviation->Preventive_Action_Details = $request->Preventive_Action_Details;

        if (!empty($request->CAPA_Closure_attachment) || !empty($request->deleted_CAPA_Closure_attachment)) {
            $existingFiles = json_decode($deviation->CAPA_Closure_attachment, true) ?? [];

         // Handle deleted files
         if (!empty($request->deleted_CAPA_Closure_attachment)) {
             $filesToDelete = explode(',', $request->deleted_CAPA_Closure_attachment);
             $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                 return !in_array($file, $filesToDelete);
             });
         }

         // Handle new files
         $newFiles = [];
         if ($request->hasFile('CAPA_Closure_attachment')) {
             foreach ($request->file('CAPA_Closure_attachment') as $file) {
                 $name = $request->name . 'CAPA_Closure_attachment' . uniqid() . '.' . $file->getClientOriginalExtension();
                 $file->move(public_path('upload/'), $name);
                 $newFiles[] = $name;
             }
         }

         // Merge existing and new files
         $allFiles = array_merge($existingFiles, $newFiles);
         $deviation->CAPA_Closure_attachment = json_encode($allFiles);
     }




        // if ($request->Deviation_category == 'major' || $request->Deviation_category == 'critical')



        // $deviation->Deviation_category = $request->Deviation_category;
        //     $deviation->Investigation_required = $request->Investigation_required;
        //     $deviation->capa_required = $request->capa_required;
        //     $deviation->qrm_required = $request->qrm_required;


        if ($request->form_name == 'general-open')
        {

            // dd($request->Delay_Justification);
            $validator = Validator::make($request->all(), [
               // 'Initiator_Group' => 'required',
                'short_description' => 'required',
                // 'short_description_required' => 'required|in:Recurring,Non_Recurring',
                // 'nature_of_repeat' => 'required_if:short_description_required,Recurring',
                'Deviation_date' => 'required',
                'deviation_time' => 'required',
                'Deviation_reported_date' => 'required',
                'Delay_Justification' => [
                    function ($attribute, $value, $fail) use ($request) {
                        $deviation_date = Carbon::parse($request->Deviation_date);
                        $reported_date = Carbon::parse($request->Deviation_reported_date);
                        $diff_in_days = $reported_date->diffInDays($deviation_date);
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
                // 'Description_Deviation' => [
                //     'required',
                //     'array',
                //     function($attribute, $value, $fail) {
                //         if (count($value) === 1 && reset($value) === null) {
                //             return $fail('Description of deviation must not be empty!.');
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
                'audit_type' => 'Deviation related to field required!'
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
                'Deviation_category' => 'required|not_in:0',
                'Justification_for_categorization' => 'required',
                'QAInitialRemark' => 'required',

                // 'Investigation_required' => 'required|in:yes,no|not_in:0',
                // 'capa_required' => 'required|in:yes,no|not_in:0',
                // 'qrm_required' => 'required|in:yes,no|not_in:0',
                // 'QAInitialRemark' => 'required'
                'Investigation_Details' => 'required_if:Investigation_required,yes'
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
                $deviation->capa_number = $request->capa_number ? $request->capa_number : $deviation->capa_number;
                $deviation->department_capa = $request->department_capa ? $request->department_capa : $deviation->department_capa;
                $deviation->source_of_capa = $request->source_of_capa ? $request->source_of_capa : $deviation->source_of_capa;
                $deviation->capa_others = $request->capa_others ? $request->capa_others : $deviation->capa_others;
                $deviation->source_doc = $request->source_doc ? $request->source_doc : $deviation->source_doc;
                $deviation->Description_of_Discrepancy = $request->Description_of_Discrepancy ? $request->Description_of_Discrepancy : $deviation->Description_of_Discrepancy;
                $deviation->capa_root_cause = $request->capa_root_cause ? $request->capa_root_cause : $deviation->capa_root_cause;
                $deviation->Immediate_Action_Take = $request->Immediate_Action_Take ? $request->Immediate_Action_Take : $deviation->Immediate_Action_Take;
                $deviation->Corrective_Action_Details = $request->Corrective_Action_Details ? $request->Corrective_Action_Details : $deviation->Corrective_Action_Details;
                $deviation->Preventive_Action_Details = $request->Preventive_Action_Details ? $request->Preventive_Action_Details : $deviation->Preventive_Action_Details;
                $deviation->capa_completed_date = $request->capa_completed_date ? $request->capa_completed_date : $deviation->capa_completed_date;
                $deviation->Interim_Control = $request->Interim_Control ? $request->Interim_Control : $deviation->Interim_Control;
                $deviation->Corrective_Action_Taken = $request->Corrective_Action_Taken ? $request->Corrective_Action_Taken : $deviation->Corrective_Action_Taken;
                $deviation->Preventive_action_Taken = $request->Preventive_action_Taken ? $request->Preventive_action_Taken : $deviation->Preventive_action_Taken;
                $deviation->CAPA_Closure_Comments = $request->CAPA_Closure_Comments ? $request->CAPA_Closure_Comments : $deviation->CAPA_Closure_Comments;

                //  if (!empty ($request->CAPA_Closure_attachment)) {
                //     $files = [];
                //     if ($request->hasfile('CAPA_Closure_attachment')) {

                //         foreach ($request->file('CAPA_Closure_attachment') as $file) {
                //             $name = 'capa_closure_attachment-' . time() . '.' . $file->getClientOriginalExtension();
                //             $file->move('upload/', $name);
                //             $files[] = $name;
                //         }
                //     }
                //     $deviation->CAPA_Closure_attachment = json_encode($files);

                // }
                   if (!empty($request->CAPA_Closure_attachment) || !empty($request->deleted_CAPA_Closure_attachment)) {
       $existingFiles = json_decode($deviation->CAPA_Closure_attachment, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_CAPA_Closure_attachment)) {
        $filesToDelete = explode(',', $request->deleted_CAPA_Closure_attachment);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new files
    $newFiles = [];
    if ($request->hasFile('CAPA_Closure_attachment')) {
        foreach ($request->file('CAPA_Closure_attachment') as $file) {
            $name = $request->name . 'CAPA_Closure_attachment' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    // Merge existing and new files
    $allFiles = array_merge($existingFiles, $newFiles);
    $deviation->CAPA_Closure_attachment = json_encode($allFiles);
}
                $deviation->update();
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

        $deviation->assign_to = $request->assign_to;
       // $deviation->Initiator_Group = $request->Initiator_Group;

        if ($deviation->stage < 3) {
            $deviation->short_description = $request->short_description;
        } else {
            $deviation->short_description = $deviation->short_description;
        }
        $deviation->initiator_group_code = $request->initiator_group_code;
        $deviation->Deviation_reported_date = $request->Deviation_reported_date;
        $deviation->Deviation_date = $request->Deviation_date;
        $deviation->deviation_time = $request->deviation_time;
        $deviation->Hod_person_to = $request->Hod_person_to;
        $deviation->Reviewer_to = $request->Reviewer_to;
        $deviation->Approver_to = $request->Approver_to;
        $deviation->Delay_Justification = $request->Delay_Justification;
        // $deviation->audit_type = implode(',', $request->audit_type);
        if (is_array($request->audit_type)) {
            $deviation->audit_type = implode(',', $request->audit_type);
        }
        $deviation->short_description_required = $request->short_description_required;
        $deviation->nature_of_repeat = $request->nature_of_repeat;
        $deviation->others = $request->others;
        $deviation->Product_Batch = $request->Product_Batch;

        $deviation->Description_Deviation = $request->Description_Deviation;
        if ($request->related_records) {
            $deviation->Related_Records1 =  implode(',', $request->related_records);
        }


    //    $deviation->Facility = $request->Facility;

        $deviation->Facility = is_array($request->Facility)
        ? implode(',', $request->Facility)
        : $request->Facility;


        // Ensure Immediate_Action is an array before using implode
$deviation->Immediate_Action = is_array($request->Immediate_Action)
? implode(',', $request->Immediate_Action)
: $request->Immediate_Action;

        // $deviation = is_array($lastDeviation->Immediate_Action) ? implode(',', $lastDeviation->Immediate_Action) : $lastDeviation->Immediate_Action;
        // $deviation->Preliminary_Impact = implode(',', $request->Preliminary_Impact);
        // Ensure Immediate_Action is an array before using implode
$deviation->Immediate_Action = is_array($request->Immediate_Action)
? implode(',', $request->Immediate_Action)
: $request->Immediate_Action;

// Ensure Preliminary_Impact is an array before using implode
$deviation->Preliminary_Impact = is_array($request->Preliminary_Impact)
? implode(',', $request->Preliminary_Impact)
: $request->Preliminary_Impact;

$deviation->Product_Details_Required = $request->Product_Details_Required;
$deviation->HOD_Remarks = $request->HOD_Remarks;
$deviation->Pending_initiator_update = $request->Pending_initiator_update;


         $deviation->hod_final_review = $request->hod_final_review;


         $deviation->qa_final_assement = $request->qa_final_assement;
         $deviation->qa_head_designe_comment = $request->qa_head_designe_comment;


        $deviation->Justification_for_categorization = !empty($request->Justification_for_categorization) ? $request->Justification_for_categorization : $deviation->Justification_for_categorization;

        $deviation->Investigation_Details = !empty($request->Investigation_Details) ? $request->Investigation_Details : $deviation->Investigation_Details;

        $deviation->QAInitialRemark = $request->QAInitialRemark;
        $deviation->Investigation_Summary = $request->Investigation_Summary;
        // $deviation->discb_deviat = $request->discb_deviat;
        // $deviation->discb_deviat = implode(',', $request->discb_deviat);
        // Ensure Immediate_Action is an array before using implode
        $deviation->discb_deviat = is_array($request->discb_deviat)
        ? implode(',', $request->discb_deviat)
        : $request->discb_deviat;

        $deviation->Impact_assessment = $request->Impact_assessment;
        $deviation->Root_cause = $request->Root_cause;

        $deviation->Conclusion = $request->Conclusion;
        $deviation->Identified_Risk = $request->Identified_Risk;
        $deviation->severity_rate = $request->severity_rate ? $request->severity_rate : $deviation->severity_rate;
        $deviation->Occurrence = $request->Occurrence ? $request->Occurrence : $deviation->Occurrence;
        $deviation->detection = $request->detection ? $request->detection: $deviation->detection;
        // $deviation->rpn = $request->rpn ? $request->rpn: $deviation->rpn;
        $deviation->rpn = $request->rpn;



        $data8 = DeviationGrid::where('deviation_grid_id', $deviation->id)->where('type', 'effect_analysis')->firstOrNew();

        $previousDetails = [
            'risk_factor_1' => is_array(@unserialize($data8->risk_factor_1)) ? unserialize($data8->risk_factor_1) : null,
            'problem_cause_1' => is_array(@unserialize($data8->problem_cause_1)) ? unserialize($data8->problem_cause_1) : null,
            'existing_risk_control_1' => is_array(@unserialize($data8->existing_risk_control_1)) ? unserialize($data8->existing_risk_control_1) : null,
            'initial_severity_1' => is_array(@unserialize($data8->initial_severity_1)) ? unserialize($data8->initial_severity_1) : null,
            'initial_probability_1' => is_array(@unserialize($data8->initial_probability_1)) ? unserialize($data8->initial_probability_1) : null,
            'initial_detectability_1' => is_array(@unserialize($data8->initial_detectability_1)) ? unserialize($data8->initial_detectability_1) : null,
            'initial_rpn_1' => is_array(@unserialize($data8->initial_rpn_1)) ? unserialize($data8->initial_rpn_1) : null,
            'risk_control_measure_1' => is_array(@unserialize($data8->risk_control_measure_1)) ? unserialize($data8->risk_control_measure_1) : null,
            'residual_severity_1' => is_array(@unserialize($data8->residual_severity_1)) ? unserialize($data8->residual_severity_1) : null,
            'residual_probability_1' => is_array(@unserialize($data8->residual_probability_1)) ? unserialize($data8->residual_probability_1) : null,
            'residual_detectability_1' => is_array(@unserialize($data8->residual_detectability_1)) ? unserialize($data8->residual_detectability_1) : null,
            'residual_rpn_1' => is_array(@unserialize($data8->residual_rpn_1)) ? unserialize($data8->residual_rpn_1) : null,
            'risk_acceptance_1' => is_array(@unserialize($data8->risk_acceptance_1)) ? unserialize($data8->risk_acceptance_1) : null,
            'risk_acceptance3' => is_array(@unserialize($data8->risk_acceptance3)) ? unserialize($data8->risk_acceptance3) : null,
            'mitigation_proposal_1' => is_array(@unserialize($data8->mitigation_proposal_1)) ? unserialize($data8->mitigation_proposal_1) : null,
          //  'conclusion' => is_array(@unserialize($data8->conclusion)) ? unserialize($data8->conclusion) : null,
        ];



        $previousDetail_1 = [
            'risk_factor' => is_array(@unserialize($data8->risk_factor)) ? unserialize($data8->risk_factor) : null,
            'problem_cause' => is_array(@unserialize($data8->problem_cause)) ? unserialize($data8->problem_cause) : null,
            'existing_risk_control' => is_array(@unserialize($data8->existing_risk_control)) ? unserialize($data8->existing_risk_control) : null,
            'initial_severity' => is_array(@unserialize($data8->initial_severity)) ? unserialize($data8->initial_severity) : null,
            'initial_detectability' => is_array(@unserialize($data8->initial_detectability)) ? unserialize($data8->initial_detectability) : null,

            'initial_probability' => is_array(@unserialize($data8->initial_probability)) ? unserialize($data8->initial_probability) : null,
            'initial_rpn' => is_array(@unserialize($data8->initial_rpn)) ? unserialize($data8->initial_rpn) : null,
            'risk_control_measure' => is_array(@unserialize($data8->risk_control_measure)) ? unserialize($data8->risk_control_measure) : null,
            'residual_severity' => is_array(@unserialize($data8->residual_severity)) ? unserialize($data8->residual_severity) : null,
            'residual_probability' => is_array(@unserialize($data8->residual_probability)) ? unserialize($data8->residual_probability) : null,
            'residual_detectability' => is_array(@unserialize($data8->residual_detectability)) ? unserialize($data8->residual_detectability) : null,
            'residual_rpn' => is_array(@unserialize($data8->residual_rpn)) ? unserialize($data8->residual_rpn) : null,
            'risk_acceptance' => is_array(@unserialize($data8->risk_acceptance)) ? unserialize($data8->risk_acceptance) : null,
            'risk_acceptance2' => is_array(@unserialize($data8->risk_acceptance2)) ? unserialize($data8->risk_acceptance2) : null,
            'mitigation_proposal' => is_array(@unserialize($data8->mitigation_proposal)) ? unserialize($data8->mitigation_proposal) : null,
        ];


       // dd($previousDetail_1);

        $data8->deviation_grid_id = $deviation->id;
        $data8->type = "effect_analysis";
        // Serialize and update the data, ensuring that we always update the fields
        $data8->risk_factor = serialize($request->risk_factor ?? []);
        $data8->risk_element = serialize($request->risk_element ?? []);
        $data8->problem_cause = serialize($request->problem_cause ?? []);
        $data8->existing_risk_control = serialize($request->existing_risk_control ?? []);
        $data8->initial_severity = serialize($request->initial_severity ?? []);
        $data8->initial_detectability = serialize($request->initial_detectability ?? []);
        $data8->initial_probability = serialize($request->initial_probability ?? []);
        $data8->initial_rpn = serialize($request->initial_rpn ?? []);
        $data8->risk_control_measure = serialize($request->risk_control_measure ?? []);
        $data8->residual_severity = serialize($request->residual_severity ?? []);
        $data8->residual_probability = serialize($request->residual_probability ?? []);
        $data8->residual_detectability = serialize($request->residual_detectability ?? []);
        $data8->residual_rpn = serialize($request->residual_rpn ?? []);
        $data8->risk_acceptance = serialize($request->risk_acceptance ?? []);
        $data8->risk_acceptance2 = serialize($request->risk_acceptance2 ?? []);
        $data8->mitigation_proposal = serialize($request->mitigation_proposal ?? []);




        $data8->risk_factor_1 = serialize($request->risk_factor_1 ?? []);
        $data8->risk_factor_1 = serialize($request->input('risk_factor_1', []));
        $data8->problem_cause_1 = serialize($request->input('problem_cause_1', []));
        $data8->existing_risk_control_1 = serialize($request->input('existing_risk_control_1', []));
        $data8->initial_severity_1 = serialize($request->input('initial_severity_1', []));
        $data8->initial_detectability_1 = serialize($request->input('initial_detectability_1', []));
        $data8->initial_probability_1 = serialize($request->input('initial_probability_1', []));
        $data8->initial_rpn_1 = serialize($request->input('initial_rpn_1', []));
        $data8->risk_control_measure_1 = serialize($request->input('risk_control_measure_1', []));
        $data8->residual_severity_1 = serialize($request->input('residual_severity_1', []));
        $data8->residual_probability_1 = serialize($request->input('residual_probability_1', []));
        $data8->residual_detectability_1 = serialize($request->input('residual_detectability_1', []));
        $data8->residual_rpn_1 = serialize($request->input('residual_rpn_1', []));
        $data8->risk_acceptance_1 = serialize($request->input('risk_acceptance_1', []));
        $data8->risk_acceptance3 = serialize($request->input('risk_acceptance3', []));
        $data8->mitigation_proposal_1 = serialize($request->input('mitigation_proposal_1', []));
        // $data8->conclusion = serialize($request->input('conclusion', []));




        // $allAttachments = [];

        // // Loop through each attachment group (key) in the request
        // if ($request->has('attachment')) {
        //     foreach ($request->attachment as $key => $files) {
        //         $attachmentFiles = []; // Initialize an array to store files for the current key

        //         // Check if the files array is valid
        //         if (is_array($files)) {
        //             foreach ($files as $file) {
        //                 if ($file instanceof \Illuminate\Http\UploadedFile) {
        //                     // Generate a unique name for the file
        //                     $name = 'DOC-' . uniqid() . '.' . $file->getClientOriginalExtension();
        //                     // Move the file to the upload directory
        //                     $file->move(public_path('upload'), $name);
        //                     // Add the file name to the array for the current key
        //                     $attachmentFiles[] = $name;
        //                 }
        //             }
        //         }

        //         // Assign the array of files for the current key
        //         $allAttachments[$key] = $attachmentFiles;
        //     }
        // }

        // // Store the attachments array in the database (serialized or JSON format)
        // $data8->attachment = json_encode($allAttachments); // Or use serialize($allAttachments) for serialized format

 //---------------------------------------------------------ORM Failure Grid data----------------------------------------------------------------------

 $fieldName_1 = [
    'risk_factor' => 'ORM / Activity',
    'problem_cause' => 'ORM / Possible Risk/Failure (Identified Risk)',
    'existing_risk_control' => 'ORM / Consequences of Risk/Potential Causes',
    'initial_severity' => 'ORM / Severity (S)',
    'initial_detectability' => 'ORM / Probability (P)',
    'initial_probability' => 'ORM / Detection (D)',

    'initial_rpn' => 'ORM / Risk Level (RPN)',
    'risk_control_measure' => 'ORM / Control Measures recommended/ Risk mitigation proposed',
    'residual_severity' => 'ORM / Severity (S)',
    'residual_probability' => 'ORM / Probability (P)',
    'residual_detectability' => 'ORM / Detection (D)',
    'residual_rpn' => 'ORM / Risk Level (RPN)',
    'risk_acceptance' => 'ORM / Category of Risk Level (Low, Medium and High)',
    'risk_acceptance2' => 'ORM / Risk Acceptance (Y/N)',
    'mitigation_proposal' => 'ORM / Traceability document',

];
foreach ($fieldName_1 as $key => $label) {
    $previousValues = $previousDetail_1[$key] ?? [];
    $currentValues = $request->input($key, []);


    // Ensure both are arrays
    $previousValues = is_array($previousValues) ? $previousValues : [];
    $currentValues = is_array($currentValues) ? $currentValues : [];


    // Compare values for each entry
    foreach ($currentValues as $index => $currentValue) {
        $previousValue = $previousValues[$index] ?? null;
        // dd($currentValue);
        // Compare individual values (not the entire array)

        if (($previousValue !== $currentValue) && !is_null($currentValue)) {
            $existingAudit = DeviationAuditTrail::where('deviation_id', $deviation->id)
                ->where('activity_type', $label . ' (' . ($index + 1) . ')')
                ->exists();

            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = $label . ' (' . ($index + 1) . ')';
            $history->previous = json_encode($previousValue); // Convert array to JSON
            $history->current = json_encode($currentValue);   // Convert array to JSON
            $history->user_id = Auth::id();
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->action_name = $existingAudit ? 'Update' : 'New';
            $history->save();
        }
    }

}
  //--------------------------------------------------------End ORM Failure Grid data----------------------------------------------------------------------

 //---------------------------------failure mode- Grid ----------------------------------------------------------------------------------------------------------------




// dd($request->risk_control_measure_1);

$fieldNames = [
    'risk_factor_1' => 'Activity',
    'problem_cause_1' => 'Possible Risk/Failure (Identified Risk)',
    'existing_risk_control_1' => 'Consequences of Risk/Potential Causes',
    'initial_severity_1' => 'Severity (S)',
    'initial_probability_1' => 'Probability (P)',
    'initial_detectability_1' => 'Detection (D)',
    'initial_rpn_1' => 'RPN',
    'risk_control_measure_1' => 'Control Measures recommended/ Risk mitigation proposed',
    'residual_severity_1' => 'Severity (S)',
    'residual_probability_1' => 'Probability (P)',
    'residual_detectability_1' => 'Detection (D)',
    'residual_rpn_1' => 'Risk Level (RPN)',
    'risk_acceptance_1' => 'Category of Risk Level (Low, Medium and High)',
    'risk_acceptance3' => 'Risk Acceptance (Y/N)',
    'mitigation_proposal_1' => 'Traceability document',
    'conclusion' => 'Others',
];
foreach ($fieldNames as $key => $label) {
    $previousValues = $previousDetails[$key] ?? [];
    $currentValues = $request->input($key, []);


    // Ensure both are arrays
    $previousValues = is_array($previousValues) ? $previousValues : [];
    $currentValues = is_array($currentValues) ? $currentValues : [];


    // Compare values for each entry
    foreach ($currentValues as $index => $currentValue) {
        $previousValue = $previousValues[$index] ?? null;
        // dd($currentValue);
        // Compare individual values (not the entire array)

        if (($previousValue !== $currentValue) && !is_null($currentValue)) {
            $existingAudit = DeviationAuditTrail::where('deviation_id', $deviation->id)
                ->where('activity_type', $label . ' (' . ($index + 1) . ')')
                ->exists();

            $history = new DeviationAuditTrail();
            $history->deviation_id = $deviation->id;
            $history->activity_type = $label . ' (' . ($index + 1) . ')';
            $history->previous = json_encode($previousValue); // Convert array to JSON
            $history->current = json_encode($currentValue);   // Convert array to JSON
            $history->user_id = Auth::id();
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->action_name = $existingAudit ? 'Update' : 'New';
            $history->save();
        }
    }

}
$data8->save();



 //---------------------------------End of Failure mode Grid--------------------------------------------------------------------------------------------------------
        $newDataGridqrms = DeviationGridQrms::where(['deviation_id' => $id, 'identifier' =>
        'failure_mode_qrms'])->firstOrCreate();
        $newDataGridqrms->deviation_id = $id;
        $newDataGridqrms->identifier = 'failure_mode_qrms';
        $newDataGridqrms->data = $request->failure_mode_qrms;
        $newDataGridqrms->save();

        $matrixDataGridqrms = DeviationGridQrms::where(['deviation_id' => $id, 'identifier' => 'matrix_qrms'])->firstOrCreate();
        $matrixDataGridqrms->deviation_id = $id;
        $matrixDataGridqrms->identifier = 'matrix_qrms';
        $matrixDataGridqrms->data = $request->matrix_qrms;
        $matrixDataGridqrms->save();

        if ($deviation->stage < 6) {
            $deviation->CAPA_Rquired = $request->CAPA_Rquired;
        }

        if ($deviation->stage < 6) {
            $deviation->capa_type = $request->capa_type;
        }

        $deviation->CAPA_Description = !empty($request->CAPA_Description) ? $request->CAPA_Description : $deviation->CAPA_Description;
        $deviation->Post_Categorization = !empty($request->Post_Categorization) ? $request->Post_Categorization : $deviation->Post_Categorization;
        $deviation->Investigation_Of_Review = $request->Investigation_Of_Review;
        $deviation->QA_Feedbacks = $request->has('QA_Feedbacks') ? $request->QA_Feedbacks : $deviation->QA_Feedbacks;
        $deviation->Closure_Comments = $request->Closure_Comments;
        $deviation->Disposition_Batch = $request->Disposition_Batch;
        $deviation->Facility_Equipment = $request->Facility_Equipment;
        $deviation->Document_Details_Required = $request->Document_Details_Required;

        if ($deviation->stage == 3)
        {
            $deviation->Customer_notification = $request->Customer_notification;
            // $deviation->Investigation_required = $request->Investigation_required;
            // $deviation->capa_required = $request->capa_required;
            // $deviation->qrm_required = $request->qrm_required;
            $deviation->Deviation_category = $request->Deviation_category;
            $deviation->QAInitialRemark = $request->QAInitialRemark;
            // $deviation->customers = $request->customers;
        }

        if($deviation->stage == 3 || $deviation->stage == 4 ){


            if (!$form_progress) {
                $form_progress = 'cft';
            }

            $Cft = DeviationCft::withoutTrashed()->where('deviation_id', $id)->first();
            if($Cft && $deviation->stage == 4 ){
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
                $IsCFTRequired = DeviationCftsResponse::withoutTrashed()->where(['is_required' => 1, 'deviation_id' => $id])->latest()->first();
                $cftUsers = DB::table('deviationcfts')->where(['deviation_id' => $id])->first();
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
                                    ['data' => $deviation],
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


            // if (!empty ($request->Initial_attachment)) {
            //     $files = [];

            //     if ($deviation->Initial_attachment) {
            //         $files = is_array(json_decode($deviation->Initial_attachment)) ? $deviation->Initial_attachment : [];
            //     }

            //     if ($request->hasfile('Initial_attachment')) {
            //         foreach ($request->file('Initial_attachment') as $file) {
            //             $name = $request->name . 'Initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //             $file->move('upload/', $name);
            //             $files[] = $name;
            //         }
            //     }


            //     $deviation->Initial_attachment = json_encode($files);
            // }
        }


//         if (!empty($request->Initial_attachment) || !empty($request->deleted_Initial_attachment)) {
//     $existingFiles = json_decode($deviation->Initial_attachment, true) ?? [];

//     // Handle deleted files
//     if (!empty($request->deleted_Initial_attachment)) {
//         $filesToDelete = explode(',', $request->deleted_Initial_attachment);
//         $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
//             return !in_array($file, $filesToDelete);
//         });
//     }

//     // Handle new files
//     $newFiles = [];
//     if ($request->hasFile('Initial_attachment')) {
//         foreach ($request->file('Initial_attachment') as $file) {
//             $name = $request->name . 'Initial_attachment' . uniqid() . '.' . $file->getClientOriginalExtension();
//             $file->move(public_path('upload/'), $name);
//             $newFiles[] = $name;
//         }
//     }

//     // Merge existing and new files
//     $allFiles = array_merge($existingFiles, $newFiles);
//     $deviation->Initial_attachment = json_encode($allFiles);
// }
               if (!empty($request->Initial_attachment) || !empty($request->deleted_Initial_attachment)) {
       $existingFiles = json_decode($deviation->Initial_attachment, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_Initial_attachment)) {
        $filesToDelete = explode(',', $request->deleted_Initial_attachment);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new files
    $newFiles = [];
    if ($request->hasFile('Initial_attachment')) {
        foreach ($request->file('Initial_attachment') as $file) {
            $name = $request->name . 'Initial_attachment' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    // Merge existing and new files
    $allFiles = array_merge($existingFiles, $newFiles);
    $deviation->Initial_attachment = json_encode($allFiles);
}


        if (!empty ($request->hod_file_attachment)) {

            $files = [];

            if ($deviation->hod_file_attachment) {
                $existingFiles = json_decode($deviation->hod_file_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($deviation->hod_file_attachment)) ? $deviation->hod_file_attachment : [];
            }

            if ($request->hasfile('hod_file_attachment')) {
                foreach ($request->file('hod_file_attachment') as $file) {
                    $name = $request->name . 'hod_file_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $deviation->hod_file_attachment = json_encode($files);
        }
          if (!empty ($request->pending_attachment)) {

            $files = [];

            if ($deviation->pending_attachment) {
                $existingFiles = json_decode($deviation->pending_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($deviation->pending_attachment)) ? $deviation->pending_attachment : [];
            }

            if ($request->hasfile('pending_attachment')) {
                foreach ($request->file('pending_attachment') as $file) {
                    $name = $request->name . 'pending_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $deviation->pending_attachment = json_encode($files);
        }


        if (!empty($request->hod_final_attachment) || !empty($request->deleted_hod_final_attachment)) {
       $existingFiles = json_decode($deviation->hod_final_attachment, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_hod_final_attachment)) {
        $filesToDelete = explode(',', $request->deleted_hod_final_attachment);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new files
    $newFiles = [];
    if ($request->hasFile('hod_final_attachment')) {
        foreach ($request->file('hod_final_attachment') as $file) {
            $name = $request->name . 'hod_final_attachment' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    // Merge existing and new files
    $allFiles = array_merge($existingFiles, $newFiles);
    $deviation->hod_final_attachment = json_encode($allFiles);


}








if (!empty($request->qa_final_assement_attach) || !empty($request->deleted_qa_final_assement_attach)) {
    $existingFiles = json_decode($deviation->qa_final_assement_attach, true) ?? [];

 // Handle deleted files
 if (!empty($request->deleted_qa_final_assement_attach)) {
     $filesToDelete = explode(',', $request->deleted_qa_final_assement_attach);
     $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
         return !in_array($file, $filesToDelete);
     });
 }

 // Handle new files
 $newFiles = [];
 if ($request->hasFile('qa_final_assement_attach')) {
     foreach ($request->file('qa_final_assement_attach') as $file) {
         $name = $request->name . 'qa_final_assement_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
         $file->move(public_path('upload/'), $name);
         $newFiles[] = $name;
     }
 }

 // Merge existing and new files
 $allFiles = array_merge($existingFiles, $newFiles);
 $deviation->qa_final_assement_attach = json_encode($allFiles);


}





if (!empty($request->qa_head_designee_attach) || !empty($request->deleted_qa_head_designee_attach)) {
    $existingFiles = json_decode($deviation->qa_head_designee_attach, true) ?? [];

 // Handle deleted files
 if (!empty($request->deleted_qa_head_designee_attach)) {
     $filesToDelete = explode(',', $request->deleted_qa_head_designee_attach);
     $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
         return !in_array($file, $filesToDelete);
     });
 }

 // Handle new files
 $newFiles = [];
 if ($request->hasFile('qa_head_designee_attach')) {
     foreach ($request->file('qa_head_designee_attach') as $file) {
         $name = $request->name . 'qa_head_designee_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
         $file->move(public_path('upload/'), $name);
         $newFiles[] = $name;
     }
 }

 // Merge existing and new files
 $allFiles = array_merge($existingFiles, $newFiles);
 $deviation->qa_head_designee_attach = json_encode($allFiles);


}
        // if (!empty($request->initial_file) || $request->removed_files) {
        //     $files = [];

        //     // Decode existing files if they exist
        //     if ($deviation->initial_file) {
        //         $existingFiles = json_decode($deviation->initial_file, true); // Convert to associative array
        //         if (is_array($existingFiles)) {
        //             $files = $existingFiles;
        //         }
        //     }

        //     // Remove files that were marked for deletion
        //     if ($request->removed_files) {
        //         $removedFiles = explode(',', $request->removed_files);
        //         foreach ($removedFiles as $removedFile) {
        //             if (($key = array_search($removedFile, $files)) !== false) {
        //                 unset($files[$key]);
        //                 @unlink(public_path('upload/' . $removedFile)); // Delete the file from the server
        //             }
        //         }
        //     }

        //     // Process and add new files
        //     if ($request->hasfile('initial_file')) {
        //         foreach ($request->file('initial_file') as $file) {
        //             $name = $request->name . 'initial_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }

        //     // Re-index the array to remove gaps in keys and encode it
        //     $deviation->initial_file = json_encode(array_values($files));
        // }

        if (!empty($request->initial_file) || !empty($request->deleted_initial_file)) {
    $existingFiles = json_decode($deviation->initial_file, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_initial_file)) {
        $filesToDelete = explode(',', $request->deleted_initial_file);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new files
    $newFiles = [];
    if ($request->hasFile('initial_file')) {
        foreach ($request->file('initial_file') as $file) {
            $name = $request->name . 'initial_file' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    // Merge existing and new files
    $allFiles = array_merge($existingFiles, $newFiles);
    $deviation->initial_file = json_encode($allFiles);
}


        if (!empty ($request->QA_attachment)) {
            $files = [];

            if ($deviation->QA_attachment) {
                $existingFiles = json_decode($deviation->QA_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($deviation->QA_attachment)) ? $deviation->QA_attachment : [];
            }

            if ($request->hasfile('QA_attachment')) {
                foreach ($request->file('QA_attachment') as $file) {
                    $name = $request->name . 'QA_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->QA_attachment = json_encode($files);
        }


        if (!empty ($request->closure_attachment)) {
            $files = [];

            if ($deviation->closure_attachment) {
                $existingFiles = json_decode($deviation->closure_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($deviation->closure_attachment)) ? $deviation->closure_attachment : [];
            }

            if ($request->hasfile('closure_attachment')) {
                foreach ($request->file('closure_attachment') as $file) {
                    $name = $request->name . 'closure_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->closure_attachment = json_encode($files);
        }



        if (!empty ($request->Investigation_attachment)) {

            $files = [];

            if ($deviation->Investigation_attachment) {
                $existingFiles = json_decode($deviation->Investigation_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($deviation->QA_attachment)) ? $deviation->QA_attachment : [];
            }

            if ($request->hasfile('Investigation_attachment')) {
                foreach ($request->file('Investigation_attachment') as $file) {
                    $name = $request->name . 'Investigation_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->Investigation_attachment = json_encode($files);
        }



        if (!empty ($request->other_attachment)) {

            $files = [];

            if ($deviation->other_attachment) {
                $existingFiles = json_decode($deviation->other_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($deviation->QA_attachment)) ? $deviation->QA_attachment : [];
            }

            if ($request->hasfile('other_attachment')) {
                foreach ($request->file('other_attachment') as $file) {
                    $name = $request->name . 'other_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->other_attachment = json_encode($files);
        }

        if (!empty ($request->Capa_attachment)) {

            $files = [];

            if ($deviation->Capa_attachment) {
                $existingFiles = json_decode($deviation->Capa_attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
                // $files = is_array(json_decode($deviation->Capa_attachment)) ? $deviation->Capa_attachment : [];
            }

            if ($request->hasfile('Capa_attachment')) {
                foreach ($request->file('Capa_attachment') as $file) {
                    $name = $request->name . 'Capa_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->Capa_attachment = json_encode($files);
        }
          if (!empty($request->QA_attachments) || !empty($request->deleted_QA_attachments)) {
       $existingFiles = json_decode($deviation->QA_attachments, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_QA_attachments)) {
        $filesToDelete = explode(',', $request->deleted_QA_attachments);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new files
    $newFiles = [];
    if ($request->hasFile('QA_attachments')) {
        foreach ($request->file('QA_attachments') as $file) {
            $name = $request->name . 'QA_attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    // Merge existing and new files
    $allFiles = array_merge($existingFiles, $newFiles);
    $deviation->QA_attachments = json_encode($allFiles);
}
        // if (!empty ($request->closure_attachment)) {

        //     $files = [];

        //     if ($deviation->closure_attachment) {
        //         $existingFiles = json_decode($deviation->closure_attachment, true); // Convert to associative array
        //         if (is_array($existingFiles)) {
        //             $files = $existingFiles;
        //         }
        //         // $files = is_array(json_decode($deviation->closure_attachment)) ? $deviation->closure_attachment : [];
        //     }

        //     if ($request->hasfile('closure_attachment')) {
        //         foreach ($request->file('closure_attachment') as $file) {
        //             $name = $request->name . 'closure_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }


        //     $deviation->closure_attachment = json_encode($files);
        // }
        if($deviation->stage > 0){


            //investiocation dynamic
            $deviation->Discription_Event = $request->Discription_Event;
            $deviation->objective = $request->objective;
            $deviation->scope = $request->scope;
            $deviation->imidiate_action = $request->imidiate_action;
            $deviation->investigation_approach = is_array($request->investigation_approach) ? implode(',', $request->investigation_approach) : '';
            $deviation->attention_issues = $request->attention_issues;
            $deviation->attention_actions = $request->attention_actions;
            $deviation->attention_remarks = $request->attention_remarks;
            $deviation->understanding_issues = $request->understanding_issues;
            $deviation->understanding_actions = $request->understanding_actions;
            $deviation->understanding_remarks = $request->understanding_remarks;
            $deviation->procedural_issues = $request->procedural_issues;
            $deviation->procedural_actions = $request->procedural_actions;
            $deviation->procedural_remarks = $request->procedural_remarks;
            $deviation->behavioiral_issues = $request->behavioiral_issues;
            $deviation->behavioiral_actions = $request->behavioiral_actions;
            $deviation->behavioiral_remarks = $request->behavioiral_remarks;
            $deviation->skill_issues = $request->skill_issues;
            $deviation->skill_actions = $request->skill_actions;
            $deviation->skill_remarks = $request->skill_remarks;
            $deviation->what_will_be = $request->what_will_be;
            $deviation->what_will_not_be = $request->what_will_not_be;
            $deviation->what_rationable = $request->what_rationable;
            $deviation->where_will_be = $request->where_will_be;
            $deviation->where_will_not_be = $request->where_will_not_be;
            $deviation->where_rationable = $request->where_rationable;
            $deviation->when_will_not_be = $request->when_will_not_be;
            $deviation->when_will_be = $request->when_will_be;
            $deviation->when_rationable = $request->when_rationable;
            $deviation->coverage_will_be = $request->coverage_will_be;
            $deviation->coverage_will_not_be = $request->coverage_will_not_be;
            $deviation->coverage_rationable = $request->coverage_rationable;
            $deviation->who_will_be = $request->who_will_be;
            $deviation->who_will_not_be = $request->who_will_not_be;
            $deviation->who_rationable = $request->who_rationable;

        //---------------------------------------------------------TeamInvestigation------------------------------------------------------------------

                        $fieldNames = [
                        'teamMember' => 'Investigation Team',
                        'desination_dept' => 'Designation & Department',
                        'responsibility' => 'Responsibility',
                        'remarks' => 'Remarks',
                        // 'investigation_approach' => 'Investigation Approach'
                    ];

                    // Fetch or create the relevant grid data
                    $teamInvestigationData = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => "TeamInvestigation"])->firstOrCreate();

                    $existingData = $teamInvestigationData->data;

                    // Decode existing data from JSON, or initialize as an empty array
                    if (is_string($existingData)) {
                        $existingData = json_decode($existingData, true) ?: [];
                    }

                    $TeamInvestigation_data = $request->investigationTeam;

                    if (is_array($TeamInvestigation_data)) {
                        // Loop through each entry in the new data
                        foreach ($TeamInvestigation_data as $newIndex => $newEntry) {
                            $oldEntry = $existingData[$newIndex] ?? []; // Get the corresponding old entry, or empty if non-existent

                            // Loop through each field to compare and process changes
                            foreach ($fieldNames as $fieldKey => $fieldName) {
                                $oldValue = $oldEntry[$fieldKey] ?? null; // Safely access the old value
                                $newValue = $newEntry[$fieldKey] ?? null; // Safely access the new value

                                // Log the change if the value has been updated
                                if ($oldValue !== $newValue) {
                                    // Format activity_type to include the index

                                    $activityType = $fieldName . ' (' . ($newIndex + 1) . ')';

                                    // Check for existing audit trail for the specific activity type
                                    $lastDeviationAuditTrailExists = DeviationAuditTrail::where('deviation_id', $id)
                                        ->where('activity_type', $activityType)
                                        ->exists();

                                    // Create a new audit trail record
                                    $history = new DeviationAuditTrail();
                                    $history->deviation_id = $id;
                                    $history->activity_type = $activityType; // Include row index in activity_type
                                    $history->previous = json_encode($oldValue); // Log the old value
                                    $history->current = json_encode($newValue); // Log the new value
                                    $history->comment = $request->input('comment', '');
                                    $history->user_id = Auth::user()->id;
                                    $history->user_name = Auth::user()->name;
                                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                    $history->origin_state = $deviation->status;
                                    $history->change_to = "Not Applicable"; // Adjust as needed
                                    $history->change_from = $deviation->status; // Adjust as needed
                                    $history->action_name = $lastDeviationAuditTrailExists ? "Update" : "New";
                                    $history->save();
                                }
                            }
                        }

                        // Save the updated data
                        $teamInvestigationData->deviation_id = $id;
                        $teamInvestigationData->identifier = 'TeamInvestigation';
                        $teamInvestigationData->data = json_encode($TeamInvestigation_data); // Ensure data is saved as a JSON string
                        $teamInvestigationData->save();
                    }


    //---------------------------------------------------------TeamInvestigation------------------------------------------------------------------

    $rootCauseData = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => "RootCause"])->firstOrCreate();
            $rootCauseData->deviation_id = $deviation->id;
            $rootCauseData->identifier = "RootCause";
            $rootCauseData->data = $request->rootCauseData;
            $rootCauseData->update();

            // $newDataGridWhy = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => 'why'])->firstOrCreate();
            // $newDataGridWhy->deviation_id = $id;
            // $newDataGridWhy->identifier = 'why';
            // $newDataGridWhy->data = $request->why;
            // $newDataGridWhy->save();

            //---------------------------------------------Grid for why why --------------------------------------------------------------

        // audit trail
        $fieldNamewhys = [
            'problem_statement' => 'Problem Statement',
            'why_1' => 'Why 1',
            'why_2' => 'Why 2',
            'why_3' => 'Why 3',
            'why_4' => 'Why 4',
            'why_5' => 'Why 5',
            'root-cause' => 'Root Cause',
        ];

        // Retrieve or create the fishbone record
        $newDataGridWhy = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => 'why'])->firstOrCreate();


        // Decode existing data from JSON if it's stored as a string
        $existingData = $newDataGridWhy->data;
        if (is_string($existingData)) {
            $existingData = json_decode($existingData, true) ?: null; // Decode or set as an empty array
        }

        // Loop through each field to compare and process changes
        foreach ($fieldNamewhys as $fieldKey => $fieldName) {
            $fieldNamewhy = $request->why;

            // Retrieve old and new values
            $oldValue = $existingData[$fieldKey] ?? null; // Safely access the old value
            $newValue = is_array($fieldNamewhy) && array_key_exists($fieldKey, $fieldNamewhy)
                ? $fieldNamewhy[$fieldKey]
                : null;



    // If there's a change, create an audit trail record
    if ($oldValue !== $newValue && !is_null($oldValue) && !is_null($newValue) ) {
        $lastDeviationAuditTrailExists = DeviationAuditTrail::where('deviation_id', $id)
            ->where('activity_type', $fieldName)
            ->exists();

        $history = new DeviationAuditTrail();
        $history->deviation_id = $id;
        $history->activity_type = $fieldName;
        $history->previous = json_encode($oldValue);
        $history->current = json_encode($newValue);
        $history->comment = $request->input('comment', '');
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $deviation->status;
        $history->change_to = "Not Applicable"; // Adjust as needed
        $history->change_from = $deviation->status; // Adjust as needed
        $history->action_name = $lastDeviationAuditTrailExists ? "Update" : "New";
        $history->save();
    }
}
// Save the updated fishbone data as a JSON string
$newDataGridWhy->deviation_id = $id;
$newDataGridWhy->identifier = 'why';
$newDataGridWhy->data = json_encode($request->why); // Ensure data is saved as a JSON string
$newDataGridWhy->save();






            //---------------------------------------------End Grid for why why --------------------------------------------------------------

            // $newDataGridFishbone = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => 'fishbone'])->firstOrCreate();
            // $newDataGridFishbone->deviation_id = $id;
            // $newDataGridFishbone->identifier = 'fishbone';
            // $newDataGridFishbone->data = $request->fishbone;
            // $newDataGridFishbone->save();

        }


        $deviation->form_progress = isset($form_progress) ? $form_progress : null;


          if (!empty($request->inference_type)) {

                $deviation->inference_type = serialize($request->inference_type);
        }
        if (!empty($request->inference_remarks)) {
            $deviation->inference_remarks = serialize($request->inference_remarks);
        }


        $deviation->update();

//-----------------------------------------------Inference Grid ---------------------------------------------------


 //----------------------------------------------- End Inference Grid ---------------------------------------------------

//-------------------------------------grid for Investigation team and Responsibilities--------------------------------------------------


// $teamInvestigationData = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => "TeamInvestigation"])->firstOrCreate();
// $teamInvestigationData->deviation_id = $deviation->id;
// $teamInvestigationData->identifier = "TeamInvestigation";
// $teamInvestigationData->data = $request->investigationTeam;
// $teamInvestigationData->update();





//---------------------------------------------- End  -----------------------------------------------------------------

//---------------------------------------------- fishbone  -----------------------------------------------------------------

 // Audit trail field names
 $fieldNames = [
    'measurement' => 'Measurement',
    'materials' => 'Materials',
    'methods' => 'Methods',
    'environment' => 'Mother Environment',
    'manpower' => 'Man',
    'machine' => 'Machine',
    'fishbone_problem_statement' => 'Problem Statement',
];

// Retrieve or create the fishbone record
$newDataGridFishbone = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => 'fishbone'])->firstOrCreate();

// Decode existing data from JSON if it's stored as a string
$existingData = $newDataGridFishbone->data;
if (is_string($existingData)) {
    $existingData = json_decode($existingData, true) ?: []; // Decode or set as an empty array
}

// Loop through each field to compare and process changes
foreach ($fieldNames as $fieldKey => $fieldName) {
    $fishboneData = $request->fishbone;

    // Retrieve old and new values
    $oldValue = $existingData[$fieldKey] ?? null; // Safely access the old value
    $newValue = is_array($fishboneData) && array_key_exists($fieldKey, $fishboneData)
        ? $fishboneData[$fieldKey]
        : null;

    // Skip the audit trail entry if:
    // - Both old and new values are null or empty
    // - The new value is not provided (null or empty string)
    if ((is_null($oldValue) && (is_null($newValue) || $newValue === '')) || is_null($newValue) || $newValue === '') {
        continue;
    }

    // If there's a change, create an audit trail record
    if ($oldValue !== $newValue && !is_null($oldValue) && !is_null($newValue))
     {
        $lastDeviationAuditTrailExists = DeviationAuditTrail::where('deviation_id', $id)
            ->where('activity_type', $fieldName)
            ->exists();

        $history = new DeviationAuditTrail();
        $history->deviation_id = $id;
        $history->activity_type = $fieldName;
        $history->previous = is_array($oldValue) ? json_encode($oldValue) : ($oldValue ?? 'Null');
        $history->current = is_array($newValue) ? json_encode($newValue) : ($newValue ?? 'Null');
        $history->comment = $request->input('comment', '');
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $deviation->status;
        $history->change_to = "Not Applicable"; // Adjust as needed
        $history->change_from = $deviation->status; // Adjust as needed
        $history->action_name = $lastDeviationAuditTrailExists ? "Update" : "New";
        $history->save();
    }
}

// Save the updated fishbone data as a JSON string
$newDataGridFishbone->deviation_id = $id;
$newDataGridFishbone->identifier = 'fishbone';
$newDataGridFishbone->data = json_encode($request->fishbone); // Ensure data is saved as a JSON string
$newDataGridFishbone->save();



//---------------------------------------------- End fishbone-----------------------------------------------------------------

        // grid
         $data3=DeviationGrid::where('deviation_grid_id', $deviation->id)->where('type', "Deviation")->first();
         $previousDetails = [
            'facility_name' => !is_null($data3->facility_name) ? unserialize($data3->facility_name) : null,
            'IDnumber' => !is_null($data3->IDnumber) ? unserialize($data3->IDnumber) : null,
            'Remarks' => !is_null($data3->Remarks) ? unserialize($data3->Remarks) : null,
        ];

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

                $fieldNames = [
                    'facility_name' => 'Related to',
                    'IDnumber' => 'Document Number',
                    'Remarks' => 'Remarks'
                ];
                if (is_array($request->facility_name) && !empty($request->facility_name)) {
                    foreach ($request->facility_name as $index => $facility_name) {
                        // Retrieve previous details for the current index
                        $previousValues = [
                            'facility_name' => $previousDetails['facility_name'][$index] ?? null,
                            'IDnumber' => $previousDetails['IDnumber'][$index] ?? null,
                            'Remarks' => $previousDetails['Remarks'][$index] ?? null,
                        ];

                        // Current fields values from the request
                        $fields = [
                            'facility_name' => $facility_name,
                            'IDnumber' => $request->IDnumber[$index],
                            'Remarks' => $request->Remarks[$index],
                        ];

                        foreach ($fields as $key => $currentValue) {
                            // Get the previous value from the previous data
                            $previousValue = $previousValues[$key] ?? null;

                            // Log changes for new or updated rows only if previous and current values differ
                            if ($previousValue != $currentValue && !empty($currentValue)) {
                                // Check if an audit trail entry for this specific row and field already exists
                                $existingAudit = DeviationAuditTrail::where('deviation_id', $id)
                                    ->where('activity_type', $fieldNames[$key] . ' (' . ($index + 1) . ')')
                                    ->where('previous', $previousValue)
                                    ->where('current', $currentValue)
                                    ->exists();

                                // Only create a new audit trail entry if no existing entry matches
                                if (!$existingAudit) {
                                    $history = new DeviationAuditTrail();
                                    $history->deviation_id = $id;
                                    $history->activity_type = $fieldNames[$key] . ' (' . ($index + 1) . ')';
                                    $history->previous = $previousValue; // Previous value or 'null'
                                    $history->current = $currentValue; // New value
                                    $history->comment = $request->equipment_comments[$index] ?? '';
                                    $history->user_id = Auth::user()->id;
                                    $history->user_name = Auth::user()->name;
                                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                    $history->origin_state = $data3->status;
                                    $history->change_to = "Not Applicable";
                                    $history->change_from = $lastDeviation->status;
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
                // dd($request->Remarks);


            $data4=DeviationGrid::where('deviation_grid_id', $deviation->id)->where('type', "Document")->first();
            $previousDetails = [
                'ReferenceDocumentName' => !is_null($data4->ReferenceDocumentName) ? unserialize($data4->ReferenceDocumentName) : null,
                'Number' => !is_null($data4->Number) ? unserialize($data4->Number) : null,
                'Document_Remarks' => !is_null($data4->Document_Remarks) ? unserialize($data4->Document_Remarks) : null,
            ];
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
            $fieldNames = [
                'ReferenceDocumentName' => 'Document Number',
                'Number' => 'Document Name',
                'Document_Remarks' => 'Remarks'
            ];

            // Ensure ReferenceDocumentName is an array before iterating
            if (is_array($request->ReferenceDocumentName) && !empty($request->ReferenceDocumentName)) {
                foreach ($request->ReferenceDocumentName as $index => $ReferenceDocumentName) {
                    // Retrieve previous details for the current index
                    $previousValues = [
                        'ReferenceDocumentName' => $previousDetails['ReferenceDocumentName'][$index] ?? null,
                        'Number' => $previousDetails['Number'][$index] ?? null,
                        'Document_Remarks' => $previousDetails['Document_Remarks'][$index] ?? null,
                    ];

                    // Current fields values from the request
                    $fields = [
                        'ReferenceDocumentName' => $ReferenceDocumentName,
                        'Number' => $request->Number[$index],
                        'Document_Remarks' => $request->Document_Remarks[$index],
                    ];

                    foreach ($fields as $key => $currentValue) {
                        // Get the previous value from the previous data
                        $previousValue = $previousValues[$key] ?? null;

                        // Log changes for new or updated rows only if previous and current values differ
                        if ($previousValue != $currentValue && !empty($currentValue)) {
                            // Check if an audit trail entry for this specific row and field already exists
                            $existingAudit = DeviationAuditTrail::where('deviation_id', $id)
                                ->where('activity_type', $fieldNames[$key] . ' (' . ($index + 1) . ')')
                                ->where('previous', $previousValue)
                                ->where('current', $currentValue)
                                ->exists();

                            // Only create a new audit trail entry if no existing entry matches
                            if (!$existingAudit) {
                                $history = new DeviationAuditTrail();
                                $history->deviation_id = $id;

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
                                $history->origin_state = $data4->status;
                                $history->change_to = "Not Applicable";
                                $history->change_from = $lastDeviation->status;
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

            $data5=DeviationGrid::where('deviation_grid_id', $deviation->id)->where('type', "Product")->first();
            $previousDetails = [
                'product_name' => !is_null($data5->product_name) ? unserialize($data5->product_name) : null,
                'product_stage' => !is_null($data5->product_stage) ? unserialize($data5->product_stage) : null,
                'batch_no' => !is_null($data5->batch_no) ? unserialize($data5->batch_no) : null,
            ];
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
            $fieldNames = [
                'product_name' => 'Product / Material',
                'product_stage' => 'Stage',
                'batch_no' => 'A.R.No. / Batch No'
            ];

            // Ensure product_name is an array before iterating
            if (is_array($request->product_name) && !empty($request->product_name)) {
                foreach ($request->product_name as $index => $product_name) {
                    // Retrieve previous details for the current index
                    $previousValues = [
                        'product_name' => $previousDetails['product_name'][$index] ?? null,
                        'product_stage' => $previousDetails['product_stage'][$index] ?? null,
                        'batch_no' => $previousDetails['batch_no'][$index] ?? null,
                    ];

                    // Current fields values from the request
                    $fields = [
                        'product_name' => $product_name,
                        'product_stage' => $request->product_stage[$index],
                        'batch_no' => $request->batch_no[$index],
                    ];

                    foreach ($fields as $key => $currentValue) {
                        // Get the previous value from the previous data
                        $previousValue = $previousValues[$key] ?? null;

                        // Log changes for new or updated rows only if previous and current values differ
                        if ($previousValue != $currentValue && !empty($currentValue)) {
                            // Check if an audit trail entry for this specific row and field already exists
                            $existingAudit = DeviationAuditTrail::where('deviation_id', $id)
                                ->where('activity_type', $fieldNames[$key] . ' (' . ($index + 1) . ')')
                                ->where('previous', $previousValue)
                                ->where('current', $currentValue)
                                ->exists();

                            // Only create a new audit trail entry if no existing entry matches
                            if (!$existingAudit) {
                                $history = new DeviationAuditTrail();
                                $history->deviation_id = $id;

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
                                $history->origin_state = $data5->status;
                                $history->change_to = "Not Applicable";
                                $history->change_from = $lastDeviation->status;
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

        if ($lastDeviation->due_date != $deviation->due_date || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Due Date')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Due Date';
             $history->previous = Helpers::getdateFormat($lastDeviation->due_date);
            $history->current = Helpers::getdateFormat($deviation->due_date);
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
         if ($lastDeviation->Initiator_Group != $deviation->Initiator_Group || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Initiator Department')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Initiator Department';
             $history->previous = $lastDeviation->Initiator_Group;
            $history->current = $deviation->Initiator_Group;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->short_description != $deviation->short_description || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Short Description')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Short Description';
             $history->previous = $lastDeviation->short_description;
            $history->current = $deviation->short_description;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }




        if ($lastDeviation->due_date != $deviation->due_date || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Due Date')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Due Date';
            $history->previous = Helpers::getdateFormat($lastDeviation->due_date);
            $history->current = Helpers::getdateFormat($deviation->due_date);
             $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->nature_of_repeat != $deviation->nature_of_repeat || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Repeat Deviation')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Repeat Deviation';
             $history->previous = $lastDeviation->nature_of_repeat;
            $history->current = $deviation->nature_of_repeat;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->qa_head_designe_comment != $deviation->qa_head_designe_comment || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'QA/CQA Head/Designee Approval comment')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'QA/CQA Head/Designee Approval comment';
             $history->previous = $lastDeviation->qa_head_designe_comment;
            $history->current = $deviation->qa_head_designe_comment;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->qa_head_designee_attach != $deviation->qa_head_designee_attach || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'QA/CQA Head/ Designee Approval attachment')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'QA/CQA Head/ Designee Approval attachment';
             $history->previous = $lastDeviation->qa_head_designee_attach;
            $history->current = $deviation->qa_head_designee_attach;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }


         if ($lastDeviation->Deviation_date != $deviation->Deviation_date || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Deviation Observed On')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Deviation Observed On';
             $history->previous = Helpers::getdateFormat($lastDeviation->Deviation_date);
            $history->current = Helpers::getdateFormat($deviation->Deviation_date);
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->deviation_time != $deviation->deviation_time || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Deviation Observed On (Time)')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Deviation Observed On (Time)';
             $history->previous = $lastDeviation->deviation_time;
            $history->current = $deviation->deviation_time;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
         if ($lastDeviation->Delay_Justification != $deviation->Delay_Justification || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Delay Justification')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Delay Justification';
             $history->previous = $lastDeviation->Delay_Justification;
            $history->current = $deviation->Delay_Justification;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }


        if ($lastDeviation->Observed_by != $deviation->Observed_by || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Deviation Observed By')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Deviation Observed By';
             $history->previous = $lastDeviation->Observed_by;
            $history->current = $deviation->Observed_by;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
         if ($lastDeviation->Deviation_reported_date != $deviation->Deviation_reported_date || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Deviation Reported On')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Deviation Reported On';
             $history->previous = Helpers::getdateFormat($lastDeviation->Deviation_reported_date);
            $history->current =Helpers::getdateFormat ($deviation->Deviation_reported_date);
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }



        // if ($lastDeviation->Deviation_reported_date != $deviation->Deviation_reported_date || !empty ($request->comment)) {
        //     $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
        //                     ->where('activity_type', 'Deviation Reported on')
        //                     ->exists();
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Deviation Reported on';
        //      $history->previous = Helpers::getdateFormat($lastDeviation->Deviation_reported_date);
        //     $history->current = Helpers::getdateFormat($deviation->Deviation_reported_date);
        //     $history->comment = $deviation->submit_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //     $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        //     $history->save();
        // }

        if ($lastDeviation->audit_type != $deviation->audit_type || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Deviation Related To')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Deviation Related To';
             $history->previous = $lastDeviation->audit_type;
            $history->current = $deviation->audit_type;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

         if ($lastDeviation->Facility != $deviation->Facility || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Deviation Observed By')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Deviation Observed By';
             $history->previous = $lastDeviation->Facility;
            $history->current = $deviation->Facility;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Others != $deviation->Others || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Others')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Others';
             $history->previous = $lastDeviation->Others;
            $history->current = $deviation->Others;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
         if ($lastDeviation->Facility_Equipment != $deviation->Facility_Equipment || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Facility Equipment')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Facility Equipment';
             $history->previous = $lastDeviation->Facility_Equipment;
            $history->current = $deviation->Facility_Equipment;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
     if ($lastDeviation->Document_Details_Required != $deviation->Document_Details_Required || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Document Details Required')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Document Details Required?';
             $history->previous = $lastDeviation->Document_Details_Required;
            $history->current = $deviation->Document_Details_Required;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->Product_Batch != $deviation->Product_Batch || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Product Batch')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Product Batch';
             $history->previous = $lastDeviation->Product_Batch;
            $history->current = $deviation->Product_Batch;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

         if ($lastDeviation->Description_Deviation != $deviation->Description_Deviation || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Description Deviation')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Description Deviation';
             $history->previous = $lastDeviation->Description_Deviation;
            $history->current = $deviation->Description_Deviation;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Reviewer_to != $deviation->Reviewer_to || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Reviewer Person')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Reviewer Person';
             $history->previous = $lastDeviation->Reviewer_to;
            $history->current = $deviation->Reviewer_to;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Approver_to != $deviation->Approver_to || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Approve Person')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Approver Person';
             $history->previous = $lastDeviation->Approver_to;
            $history->current = $deviation->Approver_to;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Hod_person_to != $deviation->Hod_person_to || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'HOD Person')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'HOD Person';
             $history->previous = $lastDeviation->Hod_person_to;
            $history->current = $deviation->Hod_person_to;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->discb_deviat != $deviation->discb_deviat || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Description of Deviation')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Description of Deviation';
             $history->previous = $lastDeviation->discb_deviat;
            $history->current = $deviation->discb_deviat;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->Immediate_Action != $deviation->Immediate_Action || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Immediate Action')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Immediate Action (if any)';
             $history->previous = $lastDeviation->Immediate_Action;
            $history->current = $deviation->Immediate_Action;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->initial_file != $deviation->initial_file || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Initial Attachments')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Initial Attachments';
             $history->previous = $lastDeviation->initial_file;
            $history->current = $deviation->initial_file;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Preliminary_Impact != $deviation->Preliminary_Impact || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Preliminary Impact of Deviation')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Preliminary Impact of Deviation';
             $history->previous = $lastDeviation->Preliminary_Impact;
            $history->current = $deviation->Preliminary_Impact;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->HOD_Remarks != $deviation->HOD_Remarks || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'HOD Review Comment')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'HOD Review Comment';
             $history->previous = $lastDeviation->HOD_Remarks;
            $history->current = $deviation->HOD_Remarks;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
           if ($lastDeviation->hod_file_attachment != $deviation->hod_file_attachment || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'HOD Attachments')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'HOD Attachments';
             $history->previous = $lastDeviation->hod_file_attachment;
            $history->current = $deviation->hod_file_attachment;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Pending_initiator_update != $deviation->Pending_initiator_update || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Pending Initiator Update Comments')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Pending Initiator Update Comments';
             $history->previous = $lastDeviation->Pending_initiator_update;
            $history->current = $deviation->Pending_initiator_update;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->pending_attachment != $deviation->pending_attachment || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Pending Initiator Update Attachments')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Pending Initiator Update Attachments';
             $history->previous = $lastDeviation->pending_attachment;
            $history->current = $deviation->pending_attachment;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->hod_final_attachment != $deviation->hod_final_attachment || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'HOD Final Review Attachments')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'HOD Final Review Attachments';
             $history->previous = $lastDeviation->hod_final_attachment;
            $history->current = $deviation->hod_final_attachment;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->hod_final_review != $deviation->hod_final_review || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'HOD Final Review Comments')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'HOD Final Review Comments';
             $history->previous = $lastDeviation->hod_final_review;
            $history->current = $deviation->hod_final_review;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }


        if ($lastDeviation->Deviation_category != $deviation->Deviation_category || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Initial Deviation category')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Initial Deviation category';
             $history->previous = $lastDeviation->Deviation_category;
            $history->current = $deviation->Deviation_category;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->Justification_for_categorization != $deviation->Justification_for_categorization || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Justification for categorization')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Justification for categorization';
             $history->previous = $lastDeviation->Justification_for_categorization;
            $history->current = $deviation->Justification_for_categorization;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->Investigation_required != $deviation->Investigation_required || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Investigation required ?')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Investigation required ?';
             $history->previous = $lastDeviation->Investigation_required;
            $history->current = $deviation->Investigation_required;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->capa_required != $deviation->capa_required || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'CAPA Required ?')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'CAPA required ?';
             $history->previous = $lastDeviation->capa_required;
            $history->current = $deviation->capa_required;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->qrm_required != $deviation->qrm_required || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'QRM Required ?')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'QRM Required ? ';
             $history->previous = $lastDeviation->qrm_required;
            $history->current = $deviation->qrm_required;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->Investigation_Details != $deviation->Investigation_Details || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Investigation Details')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Investigation Details';
             $history->previous = $lastDeviation->Investigation_Details;
            $history->current = $deviation->Investigation_Details;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->Customer_notification != $deviation->Customer_notification || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Customer Notification Required')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Customer Notification Required';
             $history->previous = $lastDeviation->Customer_notification;
            $history->current = $deviation->Customer_notification;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->customers != $deviation->customers || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Customer')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Customer';
             $history->previous = $lastDeviation->customers;
            $history->current = $deviation->customers;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->QAInitialRemark != $deviation->QAInitialRemark || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'QA/CQA Initial Assessment Comment')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'QA/CQA Initial Assessment Comment';
             $history->previous = $lastDeviation->QAInitialRemark;
            $history->current = $deviation->QAInitialRemark;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Initial_attachment != $deviation->Initial_attachment || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'QA/CQA initial Attachments')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'QA/CQA initial Attachments';
             $history->previous = $lastDeviation->Initial_attachment;
            $history->current = $deviation->Initial_attachment;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
         if ($lastDeviation->QA_attachments != $deviation->QA_attachments || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'QA/CQA Implementation Verification Attachments')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'QA/CQA Implementation Verification Attachments';
             $history->previous = $lastDeviation->QA_attachments;
            $history->current = $deviation->QA_attachments;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        //----------------------------------------------//--------------------------------------------------//
        if ($lastDeviation->Discription_Event != $deviation->Discription_Event || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Description of Event')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Description of Event';
             $history->previous = $lastDeviation->Discription_Event;
            $history->current = $deviation->Discription_Event;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->objective != $deviation->objective || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Objective')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Objective';
             $history->previous = $lastDeviation->objective;
            $history->current = $deviation->objective;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->scope != $deviation->scope || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Scope')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Scope';
             $history->previous = $lastDeviation->scope;
            $history->current = $deviation->scope;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->imidiate_action != $deviation->imidiate_action || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Immediate Action')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Immediate Action (if any)';
             $history->previous = $lastDeviation->imidiate_action;
            $history->current = $deviation->imidiate_action;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->investigation_approach != $deviation->investigation_approach || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Investigation Approach')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Investigation Approach';
             $history->previous = $lastDeviation->investigation_approach;
            $history->current = $deviation->investigation_approach;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Detail_Of_Root_Cause != $deviation->Detail_Of_Root_Cause || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Investigation Summary')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Investigation Summary';
             $history->previous = $lastDeviation->Detail_Of_Root_Cause;
            $history->current = $deviation->Detail_Of_Root_Cause;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Investigation_attachment != $deviation->Investigation_attachment || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Investigation Attachment')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Investigation Attachment';
             $history->previous = $lastDeviation->Investigation_attachment;
            $history->current = $deviation->Investigation_attachment;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }





        if ($lastDeviation->other_attachment != $deviation->other_attachment || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Other attachment')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other attachment';
             $history->previous = $lastDeviation->other_attachment;
            $history->current = $deviation->other_attachment;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Conclusion != $deviation->Conclusion || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Conclusion')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Conclusion';
             $history->previous = $lastDeviation->Conclusion;
            $history->current = $deviation->Conclusion;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->department_capa != $deviation->department_capa || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Name of the Department')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Name of the Department';
             $history->previous = $lastDeviation->department_capa;
            $history->current = $deviation->department_capa;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->source_of_capa != $deviation->source_of_capa || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Source of CAPA')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Source of CAPA';
             $history->previous = $lastDeviation->source_of_capa;
            $history->current = $deviation->source_of_capa;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->others != $deviation->others || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Others')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Others';
             $history->previous = $lastDeviation->others;
            $history->current = $deviation->others;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->source_doc != $deviation->source_doc || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Source Document')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Source Document';
             $history->previous = $lastDeviation->source_doc;
            $history->current = $deviation->source_doc;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Description_of_Discrepancy != $deviation->Description_of_Discrepancy || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Description of Discrepancy')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Description of Discrepancy';
             $history->previous = $lastDeviation->Description_of_Discrepancy;
            $history->current = $deviation->Description_of_Discrepancy;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->capa_root_cause != $deviation->capa_root_cause || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Root Cause')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Root Cause';
             $history->previous = $lastDeviation->capa_root_cause;
            $history->current = $deviation->capa_root_cause;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Immediate_Action_Take != $deviation->Immediate_Action_Take || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Immediate Action Taken (If Applicable)')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Immediate Action Taken (If Applicable)';
             $history->previous = $lastDeviation->Immediate_Action_Take;
            $history->current = $deviation->Immediate_Action_Take;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Corrective_Action_Details != $deviation->Corrective_Action_Details || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Corrective Action Details')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Corrective Action Details';
             $history->previous = $lastDeviation->Corrective_Action_Details;
            $history->current = $deviation->Corrective_Action_Details;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Preventive_Action_Details != $deviation->Preventive_Action_Details || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Preventive Action Details')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Preventive Action Details';
             $history->previous = $lastDeviation->Preventive_Action_Details;
            $history->current = $deviation->Preventive_Action_Details;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->capa_completed_date != $deviation->capa_completed_date || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Target Completion Date')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Target Completion Date';
             $history->previous =Helpers::getdateFormat ($lastDeviation->capa_completed_date);
            $history->current = Helpers::getdateFormat($deviation->capa_completed_date);
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Interim_Control != $deviation->Interim_Control || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Interim Control(If Any)')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Interim Control(If Any)';
             $history->previous = $lastDeviation->Interim_Control;
            $history->current = $deviation->Interim_Control;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Corrective_Action_Taken != $deviation->Corrective_Action_Taken || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Corrective Action Taken')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Corrective Action Taken';
             $history->previous = $lastDeviation->Corrective_Action_Taken;
            $history->current = $deviation->Corrective_Action_Taken;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->Preventive_action_Taken != $deviation->Preventive_action_Taken || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Preventive Action Taken')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Preventive Action Taken';
             $history->previous = $lastDeviation->Preventive_action_Taken;
            $history->current = $deviation->Preventive_action_Taken;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->CAPA_Closure_Comments != $deviation->CAPA_Closure_Comments || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'CAPA Closure Comments')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'CAPA Closure Comments';
             $history->previous = $lastDeviation->CAPA_Closure_Comments;
            $history->current = $deviation->CAPA_Closure_Comments;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastDeviation->CAPA_Closure_attachment != $deviation->CAPA_Closure_attachment || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'CAPA Closure Attachment')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'CAPA Closure Attachment';
             $history->previous = $lastDeviation->CAPA_Closure_attachment;
            $history->current = $deviation->CAPA_Closure_attachment;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
        //-----------------------------------//---------------------------------------//

        if ($lastDeviation->Investigation_Summary != $deviation->Investigation_Summary || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Investigation Summary')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Investigation Summary';
             $history->previous = $lastDeviation->Investigation_Summary;
            $history->current = $deviation->Investigation_Summary;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->Impact_assessment != $deviation->Impact_assessment || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Impact Assessment')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Impact Assessment';
             $history->previous = $lastDeviation->Impact_assessment;
            $history->current = $deviation->Impact_assessment;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->Root_cause != $deviation->Root_cause || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Root Cause')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Root Cause';
             $history->previous = $lastDeviation->Root_cause;
            $history->current = $deviation->Root_cause;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->CAPA_Rquired != $deviation->CAPA_Rquired || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'CAPA Rquired')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'CAPA Rquired';
             $history->previous = $lastDeviation->CAPA_Rquired;
            $history->current = $deviation->CAPA_Rquired;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->capa_type != $deviation->capa_type || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Capa Type')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Capa Type';
             $history->previous = $lastDeviation->capa_type;
            $history->current = $deviation->capa_type;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

       if ($lastDeviation->CAPA_Description != $deviation->CAPA_Description || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'CAPA Description')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'CAPA Description';
             $history->previous = $lastDeviation->CAPA_Description;
            $history->current = $deviation->CAPA_Description;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
         if ($lastDeviation->Detail_Of_Root_Cause != $deviation->Detail_Of_Root_Cause || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Investigation Summary')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Investigation Summary';
             $history->previous = $lastDeviation->Detail_Of_Root_Cause;
            $history->current = $deviation->Detail_Of_Root_Cause;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
         if ($lastDeviation->Investigation_attachment != $deviation->Investigation_attachment || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Investigation Attachment')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Investigation Attachment';
             $history->previous = $lastDeviation->Investigation_attachment;
            $history->current = $deviation->Investigation_attachment;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->Post_Categorization != $deviation->Post_Categorization || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Post Categorization Of Deviation')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Post Categorization Of Deviation';
             $history->previous = $lastDeviation->Post_Categorization;
            $history->current = $deviation->Post_Categorization;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->Investigation_Of_Review != $deviation->Investigation_Of_Review || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', operator: $deviation->id)
                            ->where('activity_type', 'Justification for Revised Category')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Justification for Revised Category';
             $history->previous = $lastDeviation->Investigation_Of_Review;
            $history->current = $deviation->Investigation_Of_Review;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->QA_Feedbacks != $deviation->QA_Feedbacks || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'QA/CQA Implementation Verification')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'QA/CQA Implementation Verification';
             $history->previous = $lastDeviation->QA_Feedbacks;
            $history->current = $deviation->QA_Feedbacks;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastDeviation->Closure_Comments != $deviation->Closure_Comments || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Head QA/CQA / Designee Closure Approval Comments')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Head QA/CQA / Designee Closure Approval Comments';
             $history->previous = $lastDeviation->Closure_Comments;
            $history->current = $deviation->Closure_Comments;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
         if ($lastDeviation->closure_attachment != $deviation->closure_attachment || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Head QA/CQA / Designee Closure Approval Attachments')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Head QA/CQA / Designee Closure Approval Attachments';
             $history->previous = $lastDeviation->closure_attachment;
            $history->current = $deviation->closure_attachment;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }


        if ($lastDeviation->Disposition_Batch != $deviation->Disposition_Batch || !empty ($request->comment)) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                            ->where('activity_type', 'Disposition of Batch')
                            ->exists();
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Disposition of Batch';
             $history->previous = $lastDeviation->Disposition_Batch;
            $history->current = $deviation->Disposition_Batch;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =  "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }



        /************ CFT Review ************/
          /*************** Quality Assurance ***************/
        if ($lastCft->Quality_Assurance_Review != $request->Quality_Assurance_Review && $request->Quality_Assurance_Review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Quality Assurance Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->Quality_Assurance_Review);
            $history->current = Ucfirst($request->Quality_Assurance_Review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Quality_Assurance_Review) || $lastCft->Quality_Assurance_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_person != $request->QualityAssurance_person && $request->QualityAssurance_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Quality Assurance Person';
            $history->previous = $lastCft->QualityAssurance_person;
            $history->current = $request->QualityAssurance_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->QualityAssurance_person) || $lastCft->QualityAssurance_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_assessment != $request->QualityAssurance_assessment && $request->QualityAssurance_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Quality Assurance Assessment';
            $history->previous = $lastCft->QualityAssurance_assessment;
            $history->current = $request->QualityAssurance_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->QualityAssurance_assessment) || $lastCft->QualityAssurance_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->QualityAssurance_feedback != $request->QualityAssurance_feedback && $request->QualityAssurance_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Quality Assurance Feedback';
        //     $history->previous = $lastCft->QualityAssurance_feedback;
        //     $history->current = $request->QualityAssurance_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->QualityAssurance_feedback) || $lastCft->QualityAssurance_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
         if ($lastCft->Quality_Assurance_attachment != $request->Quality_Assurance_attachment && $request->Quality_Assurance_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Quality Assurance Attachment';
            $history->previous = $lastCft->Quality_Assurance_attachment;
            $history->current =implode(',', $request->Quality_Assurance_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Quality_Assurance_attachment) || $lastCft->Quality_Assurance_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_by != $request->QualityAssurance_by && $request->QualityAssurance_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Quality Assurance Impact Assessment By';
            $history->previous = $lastCft->QualityAssurance_by;
            $history->current = $request->QualityAssurance_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->QualityAssurance_by) || $lastCft->QualityAssurance_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->QualityAssurance_on != $request->QualityAssurance_on && $request->QualityAssurance_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Quality Assurance Impact Assessment On';
            $history->previous = $lastCft->QualityAssurance_on;
            $history->current = $request->QualityAssurance_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->QualityAssurance_person) || $lastCft->QualityAssurance_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        /*************** Production Tablet ***************/
        if ($lastCft->Production_Table_Review != $request->Production_Table_Review && $request->Production_Table_Review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->Production_Table_Review);
            $history->current = Ucfirst($request->Production_Table_Review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Production_Table_Review) || $lastCft->Production_Table_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_Person != $request->Production_Table_Person && $request->Production_Table_Person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Person';
            $history->previous = $lastCft->Production_Table_Person;
            $history->current = $request->Production_Table_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Production_Table_Person) || $lastCft->Production_Table_Person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_Assessment != $request->Production_Table_Assessment && $request->Production_Table_Assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Assessment';
            $history->previous = $lastCft->Production_Table_Assessment;
            $history->current = $request->Production_Table_Assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Production_Table_Assessment) || $lastCft->Production_Table_Assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Production_Table_Feedback != $request->Production_Table_Feedback && $request->Production_Table_Feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Production Tablet/Capsule/Powder Feeback';
        //     $history->previous = $lastCft->Production_Table_Feedback;
        //     $history->current = $request->Production_Table_Feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Production_Table_Feedback) || $lastCft->Production_Table_Feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Production_Table_Attachment != $request->Production_Table_Attachment && $request->Production_Table_Attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Attachment';
            $history->previous = $lastCft->Production_Table_Attachment;
            $history->current = implode(',',$request->Production_Table_Attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Production_Table_Attachment) || $lastCft->Production_Table_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_By != $request->Production_Table_By && $request->Production_Table_By != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Impact Assessment By';
            $history->previous = $lastCft->Production_Table_Review;
            $history->current = $request->Production_Table_By;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Production_Table_By) || $lastCft->Production_Table_By === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Table_On != $request->Production_Table_On && $request->Production_Table_On != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Tablet/Capsule/Powder Impact Assessment On';
            $history->previous = $lastCft->Production_Table_On;
            $history->current = $request->Production_Table_On;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Production_Table_On) || $lastCft->Production_Table_On === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

         /*************** Production Liquid ***************/
         if ($lastCft->ProductionLiquid_Review != $request->ProductionLiquid_Review && $request->ProductionLiquid_Review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->ProductionLiquid_Review);
            $history->current = Ucfirst($request->ProductionLiquid_Review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ProductionLiquid_Review) || $lastCft->ProductionLiquid_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_person != $request->ProductionLiquid_person && $request->ProductionLiquid_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Person';
            $history->previous = $lastCft->ProductionLiquid_person;
            $history->current = $request->ProductionLiquid_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ProductionLiquid_person) || $lastCft->ProductionLiquid_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_assessment != $request->ProductionLiquid_assessment && $request->ProductionLiquid_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Assessment';
            $history->previous = $lastCft->ProductionLiquid_assessment;
            $history->current = $request->ProductionLiquid_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ProductionLiquid_assessment) || $lastCft->ProductionLiquid_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_feedback != $request->ProductionLiquid_feedback && $request->ProductionLiquid_feedback != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Feedback';
            $history->previous = $lastCft->ProductionLiquid_feedback;
            $history->current = $request->ProductionLiquid_feedback;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ProductionLiquid_feedback) || $lastCft->ProductionLiquid_feedback === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->ProductionLiquid_attachment != $request->ProductionLiquid_attachment && $request->ProductionLiquid_attachment != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Production Liquid/Ointment Feedback';
        //     $history->previous = $lastCft->ProductionLiquid_attachment;
        //     $history->current = implode(',',$request->ProductionLiquid_attachment);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->ProductionLiquid_attachment) || $lastCft->ProductionLiquid_attachment === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->ProductionLiquid_by != $request->ProductionLiquid_by && $request->ProductionLiquid_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Impact Assessment By';
            $history->previous = $lastCft->ProductionLiquid_by;
            $history->current = $request->ProductionLiquid_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ProductionLiquid_by) || $lastCft->ProductionLiquid_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ProductionLiquid_on != $request->ProductionLiquid_on && $request->ProductionLiquid_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Liquid/Ointment Impact Assessment On';
            $history->previous = $lastCft->ProductionLiquid_on;
            $history->current = $request->ProductionLiquid_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ProductionLiquid_on) || $lastCft->ProductionLiquid_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Production Injection ***************/
        if ($lastCft->Production_Injection_Review != $request->Production_Injection_Review && $request->Production_Injection_Review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Injection Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->Production_Injection_Review);
            $history->current = Ucfirst($request->Production_Injection_Review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Production_Injection_Review) || $lastCft->Production_Injection_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_Person != $request->Production_Injection_Person && $request->Production_Injection_Person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Injection Person';
            $history->previous = $lastCft->Production_Injection_Person;
            $history->current = $request->Production_Injection_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Production_Injection_Person) || $lastCft->Production_Injection_Person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_Assessment != $request->Production_Injection_Assessment && $request->Production_Injection_Assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Injection Assessment';
            $history->previous = $lastCft->Production_Injection_Assessment;
            $history->current = $request->Production_Injection_Assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Production_Injection_Assessment) || $lastCft->Production_Injection_Assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Production_Injection_Feedback != $request->Production_Injection_Feedback && $request->Production_Injection_Feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Production Injection Feedback';
        //     $history->previous = $lastCft->Production_Injection_Feedback;
        //     $history->current = $request->Production_Injection_Feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Production_Injection_Feedback) || $lastCft->Production_Injection_Feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Production_Injection_Attachment != $request->Production_Injection_Attachment && $request->Production_Injection_Attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Injection Attachment';
            $history->previous = $lastCft->Production_Injection_Attachment;
            $history->current =implode(',', $request->Production_Injection_Attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Production_Injection_Attachment) || $lastCft->Production_Injection_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_By != $request->Production_Injection_By && $request->Production_Injection_By != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Injection Impact Assessment By';
            $history->previous = $lastCft->Production_Injection_By;
            $history->current = $request->Production_Injection_By;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Production_Injection_By) || $lastCft->Production_Injection_By === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Production_Injection_On != $request->Production_Injection_On && $request->Production_Injection_On != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Production Injection Impact Assessment On';
            $history->previous = $lastCft->Production_Injection_On;
            $history->current = $request->Production_Injection_On;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Production_Injection_On) || $lastCft->Production_Injection_On === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Stores ***************/
        if ($lastCft->Store_Review != $request->Store_Review && $request->Store_Review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Store Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->Store_Review);
            $history->current = Ucfirst($request->Store_Review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Store_Review) || $lastCft->Store_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_person != $request->Store_person && $request->Store_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Store Person';
            $history->previous = $lastCft->Store_person;
            $history->current = $request->Store_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Store_person) || $lastCft->Store_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_assessment != $request->Store_assessment && $request->Store_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Store Assessment';
            $history->previous = $lastCft->Store_assessment;
            $history->current = $request->Store_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Store_assessment) || $lastCft->Store_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Store_feedback != $request->Store_feedback && $request->Store_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Store Feedback';
        //     $history->previous = $lastCft->Store_feedback;
        //     $history->current = $request->Store_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Store_feedback) || $lastCft->Store_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
         if ($lastCft->Store_attachment != $request->Store_attachment && $request->Store_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Store Attachment';
            $history->previous = $lastCft->Store_attachment;
            $history->current =implode(',', $request->Store_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Store_attachment) || $lastCft->Store_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_by != $request->Store_by && $request->Store_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Store Impact Assessment By';
            $history->previous = $lastCft->Store_by;
            $history->current = $request->Store_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Store_by) || $lastCft->Store_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Store_on != $request->Store_on && $request->Store_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Store Impact Assessment On';
            $history->previous = $lastCft->Store_on;
            $history->current = $request->Store_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Store_on) || $lastCft->Store_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Quality Control ***************/
        if ($lastCft->Quality_review != $request->Quality_review && $request->Quality_review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Quality Control Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->Quality_review);
            $history->current = Ucfirst($request->Quality_review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Quality_review) || $lastCft->Quality_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Quality_Control_Person != $request->Quality_Control_Person && $request->Quality_Control_Person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Quality Control Person';
            $history->previous = $lastCft->Quality_Control_Person;
            $history->current = $request->Quality_Control_Person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Quality_Control_Person) || $lastCft->Quality_Control_Person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Quality_Control_assessment != $request->Quality_Control_assessment && $request->Quality_Control_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Quality Control Assessment';
            $history->previous = $lastCft->Quality_Control_assessment;
            $history->current = $request->Quality_Control_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Quality_Control_assessment) || $lastCft->Quality_Control_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Quality_Control_feedback != $request->Quality_Control_feedback && $request->Quality_Control_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Quality Control Feeback';
        //     $history->previous = $lastCft->Quality_Control_feedback;
        //     $history->current = $request->Quality_Control_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Quality_Control_feedback) || $lastCft->Quality_Control_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        // if ($lastCft->Quality_Control_by != $request->Quality_Control_by && $request->Quality_Control_by != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Quality Control By';
        //     $history->previous = $lastCft->Quality_Control_by;
        //     $history->current = $request->Quality_Control_by;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Quality_Control_by) || $lastCft->Quality_Control_by === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        // if ($lastCft->Quality_Control_on != $request->Quality_Control_on && $request->Quality_Control_on != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Quality Control On';
        //     $history->previous = $lastCft->Quality_Control_on;
        //     $history->current = $request->Quality_Control_on;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Quality_Control_on) || $lastCft->Quality_Control_on === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Quality_Control_attachment != $request->Quality_Control_attachment && $request->Quality_Control_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Quality Control Attachment';
            $history->previous = $lastCft->Quality_Control_attachment;
            $history->current =implode(',', $request->Quality_Control_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Quality_Control_attachment) || $lastCft->Quality_Control_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Research & Development ***************/
        if ($lastCft->ResearchDevelopment_Review != $request->ResearchDevelopment_Review && $request->ResearchDevelopment_Review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Research & Development Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->ResearchDevelopment_Review);
            $history->current = Ucfirst($request->ResearchDevelopment_Review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ResearchDevelopment_Review) || $lastCft->ResearchDevelopment_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_person != $request->ResearchDevelopment_person && $request->ResearchDevelopment_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Research & Development Person';
            $history->previous = $lastCft->ResearchDevelopment_person;
            $history->current = $request->ResearchDevelopment_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ResearchDevelopment_person) || $lastCft->ResearchDevelopment_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_assessment != $request->ResearchDevelopment_assessment && $request->ResearchDevelopment_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Research & Development Assessment';
            $history->previous = $lastCft->ResearchDevelopment_assessment;
            $history->current = $request->ResearchDevelopment_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ResearchDevelopment_assessment) || $lastCft->ResearchDevelopment_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->ResearchDevelopment_feedback != $request->ResearchDevelopment_feedback && $request->ResearchDevelopment_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Research & Development Feedback';
        //     $history->previous = $lastCft->ResearchDevelopment_feedback;
        //     $history->current = $request->ResearchDevelopment_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->ResearchDevelopment_feedback) || $lastCft->ResearchDevelopment_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->ResearchDevelopment_by != $request->ResearchDevelopment_by && $request->ResearchDevelopment_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Research & Development Impact Assessment By';
            $history->previous = $lastCft->ResearchDevelopment_by;
            $history->current = $request->ResearchDevelopment_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ResearchDevelopment_by) || $lastCft->ResearchDevelopment_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_on != $request->ResearchDevelopment_on && $request->ResearchDevelopment_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Research & Development Impact Assessment On';
            $history->previous = $lastCft->ResearchDevelopment_on;
            $history->current = $request->ResearchDevelopment_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ResearchDevelopment_on) || $lastCft->ResearchDevelopment_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ResearchDevelopment_attachment != $request->ResearchDevelopment_attachment && $request->ResearchDevelopment_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Research & Development Attachment';
            $history->previous = $lastCft->ResearchDevelopment_attachment;
            $history->current =implode(',', $request->ResearchDevelopment_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ResearchDevelopment_attachment) || $lastCft->ResearchDevelopment_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Engineering ***************/
        if ($lastCft->Engineering_review != $request->Engineering_review && $request->Engineering_review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Engineering Review Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->Engineering_review);
            $history->current = Ucfirst($request->Engineering_review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Engineering_review) || $lastCft->Engineering_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_person != $request->Engineering_person && $request->Engineering_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Engineering Person';
            $history->previous = $lastCft->Engineering_person;
            $history->current = $request->Engineering_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Engineering_person) || $lastCft->Engineering_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_assessment != $request->Engineering_assessment && $request->Engineering_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Engineering Assessment';
            $history->previous = $lastCft->Engineering_assessment;
            $history->current = $request->Engineering_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Engineering_assessment) || $lastCft->Engineering_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Engineering_feedback != $request->Engineering_feedback && $request->Engineering_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Engineering Feedback';
        //     $history->previous = $lastCft->Engineering_feedback;
        //     $history->current = $request->Engineering_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Engineering_feedback) || $lastCft->Engineering_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Engineering_by != $request->Engineering_by && $request->Engineering_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Engineering Impact Assessment By';
            $history->previous = $lastCft->Engineering_by;
            $history->current = $request->Engineering_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Engineering_by) || $lastCft->Engineering_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_on != $request->Engineering_on && $request->Engineering_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Engineering Impact Assessment On';
            $history->previous = $lastCft->Engineering_on;
            $history->current = $request->Engineering_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Engineering_on) || $lastCft->Engineering_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Engineering_attachment != $request->Engineering_attachment && $request->Engineering_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Engineering Attachment';
            $history->previous = $lastCft->Engineering_attachment;
            $history->current = implode(',',$request->Engineering_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Engineering_attachment) || $lastCft->Engineering_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Human Resource ***************/
        if ($lastCft->Human_Resource_review != $request->Human_Resource_review && $request->Human_Resource_review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Human Resource Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->Human_Resource_review);
            $history->current = Ucfirst($request->Human_Resource_review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Human_Resource_review) || $lastCft->Human_Resource_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_person != $request->Human_Resource_person && $request->Human_Resource_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Human Resource Person';
            $history->previous = $lastCft->Human_Resource_person;
            $history->current = $request->Human_Resource_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Human_Resource_person) || $lastCft->Human_Resource_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_assessment != $request->Human_Resource_assessment && $request->Human_Resource_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Human Resource Assessment';
            $history->previous = $lastCft->Human_Resource_assessment;
            $history->current = $request->Human_Resource_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Human_Resource_assessment) || $lastCft->Human_Resource_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Human_Resource_feedback != $request->Human_Resource_feedback && $request->Human_Resource_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Human Resource Feedback';
        //     $history->previous = $lastCft->Human_Resource_feedback;
        //     $history->current = $request->Human_Resource_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Human_Resource_feedback) || $lastCft->Human_Resource_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Human_Resource_by != $request->Human_Resource_by && $request->Human_Resource_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Human Resource Impact Assessment By';
            $history->previous = $lastCft->Human_Resource_by;
            $history->current = $request->Human_Resource_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Human_Resource_by) || $lastCft->Human_Resource_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_on != $request->Human_Resource_on && $request->Human_Resource_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Human Resource Impact Assessment On';
            $history->previous = $lastCft->Human_Resource_on;
            $history->current = $request->Human_Resource_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Human_Resource_on) || $lastCft->Human_Resource_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Human_Resource_attachment != $request->Human_Resource_attachment && $request->Human_Resource_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Human Resource Attachment';
            $history->previous = $lastCft->Human_Resource_attachment;
            $history->current =implode(',', $request->Human_Resource_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Human_Resource_attachment) || $lastCft->Human_Resource_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Microbiology ***************/
        if ($lastCft->Microbiology_Review != $request->Microbiology_Review && $request->Microbiology_Review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Microbiology Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->Microbiology_Review);
            $history->current =Ucfirst( $request->Microbiology_Review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Microbiology_Review) || $lastCft->Microbiology_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_person != $request->Microbiology_person && $request->Microbiology_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Microbiology Person';
            $history->previous = $lastCft->Microbiology_person;
            $history->current = $request->Microbiology_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Microbiology_person) || $lastCft->Microbiology_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_assessment != $request->Microbiology_assessment && $request->Microbiology_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Microbiology Assessment';
            $history->previous = $lastCft->Microbiology_assessment;
            $history->current = $request->Microbiology_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Microbiology_assessment) || $lastCft->Microbiology_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Microbiology_feedback != $request->Microbiology_feedback && $request->Microbiology_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Microbiology Feedback';
        //     $history->previous = $lastCft->Microbiology_feedback;
        //     $history->current = $request->Microbiology_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Microbiology_feedback) || $lastCft->Microbiology_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Microbiology_by != $request->Microbiology_by && $request->Microbiology_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Microbiology Impact Assessment By';
            $history->previous = $lastCft->Microbiology_by;
            $history->current = $request->Microbiology_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Microbiology_by) || $lastCft->Microbiology_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Microbiology_on != $request->Microbiology_on && $request->Microbiology_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Microbiology Impact Assessment On';
            $history->previous = $lastCft->Microbiology_on;
            $history->current = $request->Microbiology_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Microbiology_on) || $lastCft->Microbiology_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
         if ($lastCft->Microbiology_attachment != $request->Microbiology_attachment && $request->Microbiology_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Microbiology Attachment';
            $history->previous = $lastCft->Microbiology_attachment;
            $history->current = implode(',',$request->Microbiology_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Microbiology_attachment) || $lastCft->Microbiology_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Regulatory Affair ***************/
        if ($lastCft->RegulatoryAffair_Review != $request->RegulatoryAffair_Review && $request->RegulatoryAffair_Review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Regulatory Affair Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->RegulatoryAffair_Review);
            $history->current = Ucfirst($request->RegulatoryAffair_Review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->RegulatoryAffair_Review) || $lastCft->RegulatoryAffair_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_person != $request->RegulatoryAffair_person && $request->RegulatoryAffair_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Regulatory Affair Person';
            $history->previous = $lastCft->RegulatoryAffair_person;
            $history->current = $request->RegulatoryAffair_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->RegulatoryAffair_person) || $lastCft->RegulatoryAffair_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_assessment != $request->RegulatoryAffair_assessment && $request->RegulatoryAffair_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Regulatory Affair Assessment';
            $history->previous = $lastCft->RegulatoryAffair_assessment;
            $history->current = $request->RegulatoryAffair_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->RegulatoryAffair_assessment) || $lastCft->RegulatoryAffair_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->RegulatoryAffair_feedback != $request->RegulatoryAffair_feedback && $request->RegulatoryAffair_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Regulatory Affair Feedback';
        //     $history->previous = $lastCft->RegulatoryAffair_feedback;
        //     $history->current = $request->RegulatoryAffair_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->RegulatoryAffair_feedback) || $lastCft->RegulatoryAffair_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->RegulatoryAffair_by != $request->RegulatoryAffair_by && $request->RegulatoryAffair_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Regulatory Affair Impact Assessment By';
            $history->previous = $lastCft->RegulatoryAffair_by;
            $history->current = $request->RegulatoryAffair_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->RegulatoryAffair_by) || $lastCft->RegulatoryAffair_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_on != $request->RegulatoryAffair_on  && $request->RegulatoryAffair_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Regulatory Affair Impact Assessment On';
            $history->previous = $lastCft->RegulatoryAffair_on;
            $history->current = $request->RegulatoryAffair_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->RegulatoryAffair_on) || $lastCft->RegulatoryAffair_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->RegulatoryAffair_attachment != $request->RegulatoryAffair_attachment  && $request->RegulatoryAffair_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Regulatory Affair Attachment';
            $history->previous = $lastCft->RegulatoryAffair_attachment;
            $history->current =implode(',', $request->RegulatoryAffair_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->RegulatoryAffair_attachment) || $lastCft->RegulatoryAffair_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Corporate Quality Assurance ***************/
        if ($lastCft->CorporateQualityAssurance_Review != $request->CorporateQualityAssurance_Review && $request->CorporateQualityAssurance_Review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Impact Assessment Required';
            $history->previous =Ucfirst( $lastCft->CorporateQualityAssurance_Review);
            $history->current = Ucfirst($request->CorporateQualityAssurance_Review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->CorporateQualityAssurance_Review) || $lastCft->CorporateQualityAssurance_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_person != $request->CorporateQualityAssurance_person && $request->CorporateQualityAssurance_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Person';
            $history->previous = $lastCft->CorporateQualityAssurance_person;
            $history->current = $request->CorporateQualityAssurance_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->CorporateQualityAssurance_person) || $lastCft->CorporateQualityAssurance_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_assessment != $request->CorporateQualityAssurance_assessment && $request->CorporateQualityAssurance_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Assessment';
            $history->previous = $lastCft->CorporateQualityAssurance_assessment;
            $history->current = $request->CorporateQualityAssurance_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->CorporateQualityAssurance_assessment) || $lastCft->CorporateQualityAssurance_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->CorporateQualityAssurance_feedback != $request->CorporateQualityAssurance_feedback && $request->CorporateQualityAssurance_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Corporate Quality Assurance Feedback';
        //     $history->previous = $lastCft->CorporateQualityAssurance_feedback;
        //     $history->current = $request->CorporateQualityAssurance_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->CorporateQualityAssurance_feedback) || $lastCft->CorporateQualityAssurance_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->CorporateQualityAssurance_by != $request->CorporateQualityAssurance_by && $request->CorporateQualityAssurance_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Impact Assessment By';
            $history->previous = $lastCft->CorporateQualityAssurance_by;
            $history->current = $request->CorporateQualityAssurance_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->CorporateQualityAssurance_by) || $lastCft->CorporateQualityAssurance_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_on != $request->CorporateQualityAssurance_on && $request->CorporateQualityAssurance_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Impact Assessment On';
            $history->previous = $lastCft->CorporateQualityAssurance_on;
            $history->current = $request->CorporateQualityAssurance_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->CorporateQualityAssurance_on) || $lastCft->CorporateQualityAssurance_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->CorporateQualityAssurance_attachment != $request->CorporateQualityAssurance_attachment && $request->CorporateQualityAssurance_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Corporate Quality Assurance Attachment';
            $history->previous = $lastCft->CorporateQualityAssurance_attachment;
            $history->current =implode(',', $request->CorporateQualityAssurance_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->CorporateQualityAssurance_attachment) || $lastCft->CorporateQualityAssurance_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Safety ***************/
        if ($lastCft->Environment_Health_review != $request->Environment_Health_review && $request->Environment_Health_review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Safety Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->Environment_Health_review);
            $history->current = Ucfirst($request->Environment_Health_review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Environment_Health_review) || $lastCft->Environment_Health_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Environment_Health_Safety_person != $request->Environment_Health_Safety_person && $request->Environment_Health_Safety_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Safety Person';
            $history->previous = $lastCft->Environment_Health_Safety_person;
            $history->current = $request->Environment_Health_Safety_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Environment_Health_Safety_person) || $lastCft->Environment_Health_Safety_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Health_Safety_assessment != $request->Health_Safety_assessment && $request->Health_Safety_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Safety Assessment';
            $history->previous = $lastCft->Health_Safety_assessment;
            $history->current = $request->Health_Safety_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Health_Safety_assessment) || $lastCft->Health_Safety_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Health_Safety_feedback != $request->Health_Safety_feedback && $request->Health_Safety_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Safety Feedback';
        //     $history->previous = $lastCft->Health_Safety_feedback;
        //     $history->current = $request->Health_Safety_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Health_Safety_feedback) || $lastCft->Health_Safety_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Environment_Health_Safety_by != $request->Environment_Health_Safety_by && $request->Environment_Health_Safety_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Safety Impact Assessment By';
            $history->previous = $lastCft->Environment_Health_Safety_by;
            $history->current = $request->Environment_Health_Safety_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Environment_Health_Safety_by) || $lastCft->Environment_Health_Safety_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Environment_Health_Safety_on != $request->Environment_Health_Safety_on && $request->Environment_Health_Safety_on != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Safety Review On';
        //     $history->previous = $lastCft->Environment_Health_Safety_on;
        //     $history->current = $request->Environment_Health_Safety_on;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Environment_Health_Safety_on) || $lastCft->Environment_Health_Safety_on === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Environment_Health_Safety_attachment != $request->Environment_Health_Safety_attachment && $request->Environment_Health_Safety_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Safety Impact Assessment On';
            $history->previous = $lastCft->Environment_Health_Safety_attachment;
            $history->current =implode(',', $request->Environment_Health_Safety_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Environment_Health_Safety_attachment) || $lastCft->Environment_Health_Safety_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Contract Giver ***************/
        if ($lastCft->ContractGiver_Review != $request->ContractGiver_Review && $request->ContractGiver_Review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Contract giver Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->ContractGiver_Review);
            $history->current =Ucfirst( $request->ContractGiver_Review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ContractGiver_Review) || $lastCft->ContractGiver_Review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ContractGiver_person != $request->ContractGiver_person && $request->ContractGiver_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Contract Giver Person';
            $history->previous = $lastCft->ContractGiver_person;
            $history->current = $request->ContractGiver_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ContractGiver_person) || $lastCft->ContractGiver_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ContractGiver_assessment != $request->ContractGiver_assessment && $request->ContractGiver_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Contract Giver Assessment';
            $history->previous = $lastCft->ContractGiver_assessment;
            $history->current = $request->ContractGiver_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ContractGiver_assessment) || $lastCft->ContractGiver_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->ContractGiver_feedback != $request->ContractGiver_feedback && $request->ContractGiver_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Contract Giver Feedback';
        //     $history->previous = $lastCft->ContractGiver_feedback;
        //     $history->current = $request->ContractGiver_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->ContractGiver_feedback) || $lastCft->ContractGiver_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->ContractGiver_by != $request->ContractGiver_by && $request->ContractGiver_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Contract Giver Impact Assessment By';
            $history->previous = $lastCft->ContractGiver_by;
            $history->current = $request->ContractGiver_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ContractGiver_by) || $lastCft->ContractGiver_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->ContractGiver_on != $request->ContractGiver_on && $request->ContractGiver_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Contract Giver Impact Assessment On';
            $history->previous = $lastCft->ContractGiver_on;
            $history->current = $request->ContractGiver_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ContractGiver_on) || $lastCft->ContractGiver_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastCft->ContractGiver_attachment != $request->ContractGiver_attachment && $request->ContractGiver_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Contract Giver Attachment ';
            $history->previous = $lastCft->ContractGiver_attachment;
            $history->current = implode(',',$request->ContractGiver_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->ContractGiver_attachment) || $lastCft->ContractGiver_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        /*************** Other 1 ***************/
        if ($lastCft->Other1_review != $request->Other1_review && $request->Other1_review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 1 Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->Other1_review);
            $history->current = Ucfirst($request->Other1_review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other1_review) || $lastCft->Other1_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_person != $request->Other1_person && $request->Other1_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 1 Person';
            $history->previous = $lastCft->Other1_person;
            $history->current = $request->Other1_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other1_person) || $lastCft->Other1_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_Department_person != $request->Other1_Department_person && $request->Other1_Department_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 1 Department';
            $history->previous = $lastCft->Other1_Department_person;
            $history->current = $request->Other1_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other1_Department_person) || $lastCft->Other1_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_assessment != $request->Other1_assessment && $request->Other1_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 1 Assessment';
            $history->previous = $lastCft->Other1_assessment;
            $history->current = $request->Other1_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other1_assessment) || $lastCft->Other1_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Other1_feedback != $request->Other1_feedback && $request->Other1_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Other 1 Feedback';
        //     $history->previous = $lastCft->Other1_feedback;
        //     $history->current = $request->Other1_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Other1_feedback) || $lastCft->Other1_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Other1_by != $request->Other1_by && $request->Other1_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 1 Impact Assessment By';
            $history->previous = $lastCft->Other1_by;
            $history->current = $request->Other1_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other1_by) || $lastCft->Other1_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_on != $request->Other1_on && $request->Other1_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 1 Impact Assessment On';
            $history->previous = $lastCft->Other1_on;
            $history->current = $request->Other1_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other1_on) || $lastCft->Other1_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other1_attachment != $request->Other1_attachment && $request->Other1_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 1 Attachment';
            $history->previous = $lastCft->Other1_attachment;
            $history->current = implode(',',$request->Other1_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other1_attachment) || $lastCft->Other1_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        /*************** Other 2 ***************/
        if ($lastCft->Other2_review != $request->Other2_review && $request->Other2_review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 2 Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->Other2_review);
            $history->current = Ucfirst($request->Other2_review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other2_review) || $lastCft->Other2_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_person != $request->Other2_person && $request->Other2_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 2 Person';
            $history->previous = $lastCft->Other2_person;
            $history->current = $request->Other2_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other2_person) || $lastCft->Other2_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_Department_person != $request->Other2_Department_person && $request->Other2_Department_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 2 Department';
            $history->previous = $lastCft->Other2_Department_person;
            $history->current = $request->Other2_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other2_Department_person) || $lastCft->Other2_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_assessment != $request->Other2_assessment && $request->Other2_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 2 Assessment';
            $history->previous = $lastCft->Other2_assessment;
            $history->current = $request->Other2_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other2_assessment) || $lastCft->Other2_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Other2_feedback != $request->Other2_feedback && $request->Other2_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Other 2 Feedback';
        //     $history->previous = $lastCft->Other2_feedback;
        //     $history->current = $request->Other2_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Other2_feedback) || $lastCft->Other2_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Other2_by != $request->Other2_by && $request->Other2_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 2 Impact Assessment By';
            $history->previous = $lastCft->Other2_by;
            $history->current = $request->Other2_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other2_by) || $lastCft->Other2_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_on != $request->Other2_on && $request->Other2_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 2 Impact Assessment On';
            $history->previous = $lastCft->Other2_on;
            $history->current = $request->Other2_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other2_on) || $lastCft->Other2_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other2_attachment != $request->Other2_attachment && $request->Other2_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 2 Attachment';
            $history->previous = $lastCft->Other2_attachment;
            $history->current =implode(',', $request->Other2_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other2_attachment) || $lastCft->Other2_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Other 3 ***************/
        if (!is_null($lastCft->Other3_review) != is_null($request->Other3_review) &&  !is_null($request->Other3_review)) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 3 Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->Other3_review);
            $history->current = Ucfirst($request->Other3_review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other3_review) || $lastCft->Other3_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_person != $request->Other3_person && $request->Other3_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 3 Person';
            $history->previous = $lastCft->Other3_person;
            $history->current = $request->Other3_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other3_person) || $lastCft->Other3_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_Department_person != $request->Other3_Department_person && $request->Other3_Department_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 3 Department';
            $history->previous = $lastCft->Other3_Department_person;
            $history->current = $request->Other3_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other3_Department_person) || $lastCft->Other3_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_assessment != $request->Other3_assessment && $request->Other3_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 3 Assessment';
            $history->previous = $lastCft->Other3_assessment;
            $history->current = $request->Other3_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other3_assessment) || $lastCft->Other3_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Other3_feedback != $request->Other3_feedback && $request->Other3_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Other 3 Feedback';
        //     $history->previous = $lastCft->Other3_feedback;
        //     $history->current = $request->Other3_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Other3_feedback) || $lastCft->Other3_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Other3_by != $request->Other3_by && $request->Other3_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 3 Impact Assessment By';
            $history->previous = $lastCft->Other3_by;
            $history->current = $request->Other3_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other3_by) || $lastCft->Other3_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_on != $request->Other3_on && $request->Other3_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 3 Impact Assessment On';
            $history->previous = $lastCft->Other3_on;
            $history->current = $request->Other3_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other3_on) || $lastCft->Other3_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other3_attachment != $request->Other3_attachment && $request->Other3_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 3 Attachment';
            $history->previous = $lastCft->Other3_attachment;
            $history->current =implode(',', $request->Other3_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other3_attachment) || $lastCft->Other3_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        /*************** Other 4 ***************/
        if ($lastCft->Other4_review != $request->Other4_review && $request->Other4_review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 4 Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->Other4_review);
            $history->current = Ucfirst($request->Other4_review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other4_review) || $lastCft->Other4_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_person != $request->Other4_person && $request->Other4_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 4 Person';
            $history->previous = $lastCft->Other4_person;
            $history->current = $request->Other4_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other4_person) || $lastCft->Other4_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_Department_person != $request->Other4_Department_person && $request->Other4_Department_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 4 Department';
            $history->previous = $lastCft->Other4_Department_person;
            $history->current = $request->Other4_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other4_Department_person) || $lastCft->Other4_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_assessment != $request->Other4_assessment && $request->Other4_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 4 Assessment';
            $history->previous = $lastCft->Other4_assessment;
            $history->current = $request->Other4_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other4_assessment) || $lastCft->Other4_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Other4_feedback != $request->Other4_feedback && $request->Other4_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Other 4 Feedback';
        //     $history->previous = $lastCft->Other4_feedback;
        //     $history->current = $request->Other4_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Other4_feedback) || $lastCft->Other4_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Other4_by != $request->Other4_by && $request->Other4_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 4 Impact Assessment By';
            $history->previous = $lastCft->Other4_by;
            $history->current = $request->Other4_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other4_by) || $lastCft->Other4_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_on != $request->Other4_on && $request->Other4_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 4 Impact Assessment On';
            $history->previous = $lastCft->Other4_on;
            $history->current = $request->Other4_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other4_on) || $lastCft->Other4_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other4_attachment != $request->Other4_attachment && $request->Other4_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 4 Attachment';
            $history->previous = $lastCft->Other4_attachment;
            $history->current =implode(',', $request->Other4_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other4_attachment) || $lastCft->Other4_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        /*************** Other 5 ***************/
        if ($lastCft->Other5_review != $request->Other5_review && $request->Other5_review != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 5 Impact Assessment Required';
            $history->previous = Ucfirst($lastCft->Other5_review);
            $history->current = Ucfirst($request->Other5_review);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other5_review) || $lastCft->Other5_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_person != $request->Other5_person && $request->Other5_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 5 Person';
            $history->previous = $lastCft->Other5_person;
            $history->current = $request->Other5_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other5_person) || $lastCft->Other5_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_Department_person != $request->Other5_Department_person && $request->Other5_Department_person != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 5 Department';
            $history->previous = $lastCft->Other5_Department_person;
            $history->current = $request->Other5_Department_person;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other5_Department_person) || $lastCft->Other5_Department_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_assessment != $request->Other5_assessment && $request->Other5_assessment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 5 Assessment';
            $history->previous = $lastCft->Other5_assessment;
            $history->current = $request->Other5_assessment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other5_assessment) || $lastCft->Other5_assessment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastCft->Other5_feedback != $request->Other5_feedback && $request->Other5_feedback != null) {
        //     $history = new DeviationAuditTrail;
        //     $history->deviation_id = $id;
        //     $history->activity_type = 'Other 5 Feedback';
        //     $history->previous = $lastCft->Other5_feedback;
        //     $history->current = $request->Other5_feedback;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDeviation->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDeviation->status;
        //      if (is_null($lastCft->Other5_feedback) || $lastCft->Other5_feedback === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }
        if ($lastCft->Other5_by != $request->Other5_by && $request->Other5_by != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 5 Impact Assessment By';
            $history->previous = $lastCft->Other5_by;
            $history->current = $request->Other5_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other5_by) || $lastCft->Other5_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_on != $request->Other5_on && $request->Other5_on != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 5 Impact Assessment On';
            $history->previous = $lastCft->Other5_on;
            $history->current = $request->Other5_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other5_on) || $lastCft->Other5_on === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastCft->Other5_attachment != $request->Other5_attachment && $request->Other5_attachment != null) {
            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = 'Other 5 Attachment';
            $history->previous = $lastCft->Other5_attachment;
            $history->current = implode(',',$request->Other5_attachment);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDeviation->status;
             if (is_null($lastCft->Other5_attachment) || $lastCft->Other5_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


      //--------------------------------------------is-is not Analysis----------------------------------------------------------------------------




      if ($lastDeviation->what_will_be != $deviation->what_will_be || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'What / Will Be')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'What / Will Be';
         $history->previous = $lastDeviation->what_will_be;
        $history->current = $deviation->what_will_be;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }



    if ($lastDeviation->what_will_not_be != $deviation->what_will_not_be || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'What/Will Not Be')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'What/Will Not Be';
         $history->previous = $lastDeviation->what_will_not_be;
        $history->current = $deviation->what_will_not_be;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }

    if ($lastDeviation->what_rationable != $deviation->what_rationable || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'What/Rationale')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'What/Rationale';
         $history->previous = $lastDeviation->what_rationable;
        $history->current = $deviation->what_rationable;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }


    if ($lastDeviation->where_will_be != $deviation->where_will_be || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Where/Will Be')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Where/Will Be';
         $history->previous = $lastDeviation->where_will_be;
        $history->current = $deviation->where_will_be;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }


    if ($lastDeviation->where_will_not_be != $deviation->where_will_not_be || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Where/Will Not Be')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Where/Will Not Be';
         $history->previous = $lastDeviation->where_will_not_be;
        $history->current = $deviation->where_will_not_be;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }


    if ($lastDeviation->where_rationable != $deviation->where_rationable || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Where/Rationale')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Where/Rationale';
         $history->previous = $lastDeviation->where_rationable;
        $history->current = $deviation->where_rationable;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }



 //   $deviation->when_will_not_be = $request->when_will_not_be;
    //   $deviation->when_will_be = $request->when_will_be;
    //   $deviation->when_rationable = $request->when_rationable;
    //   $deviation->coverage_will_be = $request->coverage_will_be;
    //   $deviation->coverage_will_not_be = $request->coverage_will_not_be;
    //   $deviation->coverage_rationable = $request->coverage_rationable;
    //   $deviation->who_will_be = $request->who_will_be;
    //   $deviation->who_will_not_be = $request->who_will_not_be;
    //   $deviation->who_rationable = $request->who_rationable;

    if ($lastDeviation->when_will_be != $deviation->when_will_be || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'When / Will Be')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'When / Will Be';
         $history->previous = $lastDeviation->when_will_be;
        $history->current = $deviation->when_will_be;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }

    if ($lastDeviation->when_will_not_be != $deviation->when_will_not_be || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'When / Will Not Be')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'When / Will Not Be';
         $history->previous = $lastDeviation->when_will_not_be;
        $history->current = $deviation->when_will_not_be;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }

    if ($lastDeviation->when_rationable != $deviation->when_rationable || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'When /Rationale')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'When /Rationale';
         $history->previous = $lastDeviation->when_rationable;
        $history->current = $deviation->when_rationable;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }

    if ($lastDeviation->coverage_will_be != $deviation->coverage_will_be || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Why/Will Be')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Why/Will Be';
         $history->previous = $lastDeviation->coverage_will_be;
        $history->current = $deviation->coverage_will_be;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }

    if ($lastDeviation->coverage_will_not_be != $deviation->coverage_will_not_be || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Why/Will Not Be')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Why/Will Not Be';
         $history->previous = $lastDeviation->coverage_will_not_be;
        $history->current = $deviation->coverage_will_not_be;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }

    if ($lastDeviation->coverage_rationable != $deviation->coverage_rationable || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Why/Rationale')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Why/Rationale';
         $history->previous = $lastDeviation->coverage_rationable;
        $history->current = $deviation->coverage_rationable;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }

    if ($lastDeviation->who_will_be != $deviation->who_will_be || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Who/Will Be')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Who/Will Be';
         $history->previous = $lastDeviation->who_will_be;
        $history->current = $deviation->who_will_be;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }

    if ($lastDeviation->who_will_not_be != $deviation->who_will_not_be || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Who/Will Not Be')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Who/Will Not Be';
         $history->previous = $lastDeviation->who_will_not_be;
        $history->current = $deviation->who_will_not_be;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }

    if ($lastDeviation->who_rationable != $deviation->who_rationable || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Who/Rationale')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Who/Rationale';
         $history->previous = $lastDeviation->who_rationable;
        $history->current = $deviation->who_rationable;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }


//-------------------------Category Of Human Error-------------------------------------------------------------------------

    if ($lastDeviation->attention_issues != $deviation->attention_issues || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Attention/Issues')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Attention/Issues';
         $history->previous = $lastDeviation->attention_issues;
        $history->current = $deviation->attention_issues;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }




    if ($lastDeviation->attention_actions != $deviation->attention_actions || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Attention/Actions')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Attention/Actions';
         $history->previous = $lastDeviation->attention_actions;
        $history->current = $deviation->attention_actions;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }




    if ($lastDeviation->attention_remarks != $deviation->attention_remarks || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Attention/Remarks')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Attention/Remarks';
         $history->previous = $lastDeviation->attention_remarks;
        $history->current = $deviation->attention_remarks;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }

    if ($lastDeviation->understanding_issues != $deviation->understanding_issues || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Understanding/Issues')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Understanding/Issues';
         $history->previous = $lastDeviation->understanding_issues;
        $history->current = $deviation->understanding_issues;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }
    if ($lastDeviation->understanding_actions != $deviation->understanding_actions || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Understanding/Actions')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Understanding/Actions';
         $history->previous = $lastDeviation->understanding_actions;
        $history->current = $deviation->understanding_actions;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }
    if ($lastDeviation->understanding_remarks != $deviation->understanding_remarks || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Understanding/Remarks')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Understanding/Remarks';
         $history->previous = $lastDeviation->understanding_remarks;
        $history->current = $deviation->understanding_remarks;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }
    if ($lastDeviation->procedural_issues != $deviation->procedural_issues || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Procedural/Issues')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Procedural/Issues';
         $history->previous = $lastDeviation->procedural_issues;
        $history->current = $deviation->procedural_issues;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }
if ($lastDeviation->procedural_actions != $deviation->procedural_actions || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Procedural/Actions')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Procedural/Actions';
         $history->previous = $lastDeviation->procedural_actions;
        $history->current = $deviation->procedural_actions;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }
if ($lastDeviation->procedural_remarks != $deviation->procedural_remarks || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Procedural/Remarks')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Procedural/Remarks';
         $history->previous = $lastDeviation->procedural_remarks;
        $history->current = $deviation->procedural_remarks;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }

    if ($lastDeviation->behavioiral_issues != $deviation->behavioiral_issues || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Behavioral/Issues')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Behavioral/Issues';
         $history->previous = $lastDeviation->behavioiral_issues;
        $history->current = $deviation->behavioiral_issues;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }
if ($lastDeviation->behavioiral_actions != $deviation->behavioiral_actions || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Behavioral/Actions')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Behavioral/Actions';
         $history->previous = $lastDeviation->behavioiral_actions;
        $history->current = $deviation->behavioiral_actions;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }
if ($lastDeviation->behavioiral_remarks != $deviation->behavioiral_remarks || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Behavioral/Remarks')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Behavioral/Remarks';
         $history->previous = $lastDeviation->behavioiral_remarks;
        $history->current = $deviation->behavioiral_remarks;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }
    if ($lastDeviation->skill_issues != $deviation->skill_issues || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Skill/Issues')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Skill/Issues';
         $history->previous = $lastDeviation->skill_issues;
        $history->current = $deviation->skill_issues;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }
if ($lastDeviation->skill_actions != $deviation->skill_actions || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Skill/Actions')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Skill/Actions';
         $history->previous = $lastDeviation->skill_actions;
        $history->current = $deviation->skill_actions;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }

if ($lastDeviation->skill_remarks != $deviation->skill_remarks || !empty ($request->comment)) {
        $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                        ->where('activity_type', 'Skill/Remarks')
                        ->exists();
        $history = new DeviationAuditTrail;
        $history->deviation_id = $id;
        $history->activity_type = 'Skill/Remarks';
        $history->previous = !empty($lastDeviation->inference_remarks)
        ? json_encode(unserialize($lastDeviation->inference_remarks))
        : null;
        $history->current = !empty($deviation->inference_remarks)
        ? json_encode(unserialize($deviation->inference_remarks))
        : null;
        $history->comment = $deviation->submit_comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDeviation->status;
        $history->change_to =   "Not Applicable";
        $history->change_from = $lastDeviation->status;
        $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
        $history->save();
    }


// Field names mapping
$fieldNames = [
    'inference_type' => 'Inference / Type',
    'inference_remarks' => 'Inference / Remarks',
];

if (!empty($lastDeviation->inference_type) || !empty($deviation->inference_type)) {
    // Unserialize data into arrays
    $lastInferenceTypes = !empty($lastDeviation->inference_type)
        ? unserialize($lastDeviation->inference_type)
        : [];
    $currentInferenceTypes = !empty($deviation->inference_type)
        ? unserialize($deviation->inference_type)
        : [];

    foreach ($currentInferenceTypes as $index => $currentType) {
        $previousType = $lastInferenceTypes[$index] ?? null;

        if ($previousType !== $currentType) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                ->where('activity_type', $fieldNames['inference_type'] . ' (' . ($index + 1) . ')')
                ->exists();

            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = $fieldNames['inference_type'] . ' (' . ($index + 1) . ')';
            $history->previous = $previousType;
            $history->current = $currentType;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name = $lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
    }
}

if (!empty($lastDeviation->inference_remarks) || !empty($deviation->inference_remarks)) {
    // Unserialize data into arrays
    $lastInferenceRemarks = !empty($lastDeviation->inference_remarks)
        ? unserialize($lastDeviation->inference_remarks)
        : [];
    $currentInferenceRemarks = !empty($deviation->inference_remarks)
        ? unserialize($deviation->inference_remarks)
        : [];

    foreach ($currentInferenceRemarks as $index => $currentRemark) {
        $previousRemark = $lastInferenceRemarks[$index] ?? null;

        if ($previousRemark !== $currentRemark) {
            $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                ->where('activity_type', $fieldNames['inference_remarks'] . ' (' . ($index + 1) . ')')
                ->exists();

            $history = new DeviationAuditTrail;
            $history->deviation_id = $id;
            $history->activity_type = $fieldNames['inference_remarks'] . ' (' . ($index + 1) . ')';
            $history->previous = $previousRemark;
            $history->current = $currentRemark;
            $history->comment = $deviation->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDeviation->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDeviation->status;
            $history->action_name = $lastDeviationAuditTrail ? "Update" : "New";
            $history->save();
        }
    }
}


if ($lastDeviation->qa_final_assement != $deviation->qa_final_assement || !empty ($request->comment)) {
    $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                    ->where('activity_type', 'QA/CQA Final Assessment Comment')
                    ->exists();
    $history = new DeviationAuditTrail;
    $history->deviation_id = $id;
    $history->activity_type = 'QA/CQA Final Assessment Comment';
     $history->previous = $lastDeviation->qa_final_assement;
    $history->current = $deviation->qa_final_assement;
    $history->comment = $deviation->submit_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDeviation->status;
    $history->change_to =   "Not Applicable";
    $history->change_from = $lastDeviation->status;
    $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
    $history->save();
}

if ($lastDeviation->qa_final_assement_attach != $deviation->qa_final_assement_attach || !empty ($request->comment)) {
    $lastDeviationAuditTrail = DeviationAuditTrail::where('deviation_id', $deviation->id)
                    ->where('activity_type', 'QA/CQA Final Assessment attachment')
                    ->exists();
    $history = new DeviationAuditTrail;
    $history->deviation_id = $id;
    $history->activity_type = 'QA/CQA Final Assessment attachment';
     $history->previous = $lastDeviation->qa_final_assement_attach;
    $history->current = $deviation->qa_final_assement_attach;
    $history->comment = $deviation->submit_comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDeviation->status;
    $history->change_to =   "Not Applicable";
    $history->change_from = $lastDeviation->status;
    $history->action_name=$lastDeviationAuditTrail ? "Update" : "New";
    $history->save();
}


        toastr()->success('Record is Update Successfully');

        return back();
    }

    public function launchExtensionDeviation(Request $request, $id){
        $deviation = Deviation::find($id);
        $getCounter = LaunchExtension::where(['deviation_id' => $deviation->id, 'extension_identifier' => "Deviation"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($deviation->id != null){
            $data = LaunchExtension::where([
                'deviation_id' => $deviation->id,
                'extension_identifier' => "Deviation"
            ])->firstOrCreate();

            $data->deviation_id = $request->deviation_id;
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
        $deviation = Deviation::find($id);
        $getCounter = LaunchExtension::where(['deviation_id' => $deviation->id, 'extension_identifier' => "Capa"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($deviation->id != null){

            $data = LaunchExtension::where([
                'deviation_id' => $deviation->id,
                'extension_identifier' => "Capa"
            ])->firstOrCreate();

            $data->deviation_id = $request->deviation_id;
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
        $deviation = Deviation::find($id);
        $getCounter = LaunchExtension::where(['deviation_id' => $deviation->id, 'extension_identifier' => "QRM"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($deviation->id != null){

            $data = LaunchExtension::where([
                'deviation_id' => $deviation->id,
                'extension_identifier' => "QRM"
            ])->firstOrCreate();

            $data->deviation_id = $request->deviation_id;
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
        $deviation = Deviation::find($id);
        $getCounter = LaunchExtension::where(['deviation_id' => $deviation->id, 'extension_identifier' => "Investigation"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($deviation->id != null){

            $data = LaunchExtension::where([
                'deviation_id' => $deviation->id,
                'extension_identifier' => "Investigation"
            ])->firstOrCreate();

            $data->deviation_id = $request->deviation_id;
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

    public function deviation_child_1(Request $request, $id)
    {



        $cft = [];
        $parent_id = $id;
        $parent_type = "Deviation";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        // $due_date = $formattedDate->format('d-M-Y');
        $parent_record = Deviation::where('id', $id)->value('record');
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_division_id = Deviation::where('id', $id)->value('division_id');
        $parent_initiator_id = Deviation::where('id', $id)->value('initiator_id');
        $parent_intiation_date = Deviation::where('id', $id)->value('intiation_date');
        $parent_due_date=Deviation::where('id', $id)->value('due_date');
        $parent_created_at = Deviation::where('id', $id)->value('created_at');
        $parent_short_description = Deviation::where('id', $id)->value('short_description');
        $hod = User::where('role', 4)->get();
        if ($request->child_type == "extension") {
            // $parent_due_date = "";
            $parent_id = $id;
            $parent_name = $request->parent_name;
            // if ($request->due_date) {
            //     $parent_due_date = $request->due_date;
            // }
            $due_date = $formattedDate->format('d-M-Y');

            $record_number = ((RecordNumber::first()->value('counter')) + 1);
            $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);

            $Extensionchild = Deviation::find($id);

            $Extensionchild->Extensionchild = $record_number;
           $relatedRecords = Helpers::getAllRelatedRecords();
           $data=Deviation::find($id);

           $extension_record = Helpers::getDivisionName($data->division_id ) . '/' . 'DEV' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
           $count = Helpers::getChildData($id, $parent_type);
           $countData = $count + 1;
                               // $relatedRecords = collect();



        //    dd($extension_record);
            $Extensionchild->save();
            return view('frontend.extension.extension_new', compact('parent_id','parent_type','extension_record','parent_record', 'parent_name','countData', 'record_number', 'parent_due_date', 'due_date', 'parent_created_at','relatedRecords','parent_division_id','parent_intiation_date'));
        }
        $old_record = Deviation::select('id', 'division_id', 'record')->get();
        // dd($request->child_type)
        if ($request->child_type == "capa") {
            $parent_name = "CAPA";
            $Capachild = Deviation::find($id);
            $relatedRecords = Helpers::getAllRelatedRecords();
            $Capachild->Capachild = $record_number;
            $record = $record_number;
            $old_records = $old_record;
            $reference_record = Helpers::getDivisionName($Capachild->division_id ) . '/' . 'DEV' .'/' . date('Y') .'/' . str_pad($Capachild->record, 4, '0', STR_PAD_LEFT);

            $Capachild->save();

            return view('frontend.forms.capa', compact('parent_id','relatedRecords','record_number', 'parent_record','parent_type', 'record',  'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name','reference_record', 'parent_division_id', 'parent_record', 'old_records', 'cft','parent_due_date',));
        } elseif ($request->child_type == "Action_Item")
         {
            $parent_name = "Action Item";
            $actionchild = Deviation::find($id);
            $actionchild->actionchild = $record_number;
            $parent_id = $id;
            $actionchild->save();


            return view('frontend.forms.action-item', compact('old_record', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'record_number', 'parent_id', 'parent_type','parent_due_date',));
        }

        elseif ($request->child_type == "effectiveness_check")
         {
            $parent_name = "CAPA";
            $effectivenesschild = Deviation::find($id);
            $effectivenesschild->effectivenesschild = $record_number;
            $effectivenesschild->save();
        return view('frontend.forms.effectiveness-check', compact('old_record','parent_short_description','parent_record', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id',  'record_number', 'due_date', 'parent_id', 'parent_type','parent_due_date',));
        }
        elseif ($request->child_type == "Change_control") {
            $parent_name = "CAPA";
            $Changecontrolchild = Deviation::find($id);
            $Changecontrolchild->Changecontrolchild = $record_number;

            $Changecontrolchild->save();

            return view('frontend.change-control.new-change-control', compact('cft','pre','hod','parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id',  'record_number', 'due_date', 'parent_id', 'parent_type','parent_due_date',));
        }
        else {
            $parent_name = "Root";
            $Rootchild = Deviation::find($id);
            $Rootchild->Rootchild = $record_number;
            $Rootchild->save();
            return view('frontend.forms.root-cause-analysis', compact('parent_id', 'parent_record','parent_type', 'record_number', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record','parent_due_date','parent_due_date',));
        }
    }

    public function deviation_reject(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
             if ($deviation->stage == 2) {

                    $deviation->stage = "1";
                    $deviation->status = "Opened";
                    $deviation->qa_more_info_required_by = 'Not Applicable';
                    $deviation->qa_more_info_required_on = 'Not Applicable';
                    // $deviation->pending_Cancel_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->previous = 'Not Applicable';
                    $history->activity_type = 'Not Applicable';

                    $history->action='More Information Required';
                    $history->current = 'Not Applicable';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'Not Applicable';
                    $history->change_to =   "Opened";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();
                    // $list = Helpers::getInitiatorUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "More Information Required", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }

                    $deviation->update();
                    return back();
                }
        if ($deviation->stage == 3) {

                    $deviation->stage = "2";
                    $deviation->status = "HOD Review";
                    $deviation->qa_more_info_required_by = 'Not Applicable';
                    $deviation->qa_more_info_required_on = 'Not Applicable';
                    // $deviation->pending_Cancel_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->previous = 'Not Applicable';
                    $history->activity_type = 'Not Applicable';

                    $history->action='More Information Required';
                    $history->current = 'Not Applicable';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'Not Applicable';
                    $history->change_to =   "HOD Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();
                    // $list = Helpers::getHodUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "More Information Required", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }

                    $deviation->update();
                    return back();
                }
           if ($deviation->stage == 4) {

                    $deviation->stage = "3";
                    $deviation->status = "QA/CQA Initial Assessment";
                    $deviation->qa_more_info_required_by = 'Not Applicable';
                    $deviation->qa_more_info_required_on = 'Not Applicable';
                    // $deviation->pending_Cancel_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->previous = 'Not Applicable';
                    $history->activity_type = 'Not Applicable';

                    $history->action='More Information Required';
                    $history->current = 'Not Applicable';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'Not Applicable';
                    $history->change_to =   "QA/CQA Initial Assessment";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();
                    // $list = Helpers::getQAUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "More Information Required", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    // $list = Helpers::getCQAUsersList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Send to HOD", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Send to HOD Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    $deviation->update();
                    return back();
                }
               if ($deviation->stage == 5) {

                    $deviation->stage = "4";
                    $deviation->status = "CFT Review";
                    $deviation->qa_more_info_required_by = 'Not Applicable';
                    $deviation->qa_more_info_required_on = 'Not Applicable';
                    // $deviation->pending_Cancel_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->previous = 'Not Applicable';
                    $history->activity_type = 'Not Applicable';

                    $history->action='More Information Required';
                    $history->current = 'Not Applicable';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'Not Applicable';
                    $history->change_to =   "CFT Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();
                    $deviation->update();
                    return back();
                }

                 if ($deviation->stage == 6) {

                    $deviation->stage = "5";
                    $deviation->status = "QA/CQA Final Assessment";
                    $deviation->qa_more_info_required_by = 'Not Applicable';
                    $deviation->qa_more_info_required_on = 'Not Applicable';
                    // $deviation->pending_Cancel_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->previous = 'Not Applicable';
                    $history->activity_type = 'Not Applicable';

                    $history->action='More Information Required';
                    $history->current = 'Not Applicable';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'Not Applicable';
                    $history->change_to =   "QA/CQA Final Assessment";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();
                    // $list = Helpers::getQAUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "More Information Required", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    // $list = Helpers::getCQAUsersList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Send to HOD", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Send to HOD Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    $deviation->update();
                    return back();
                }
            if ($deviation->stage == 8) {

                    $deviation->stage = "7";
                    $deviation->status = "Pending Initiator Update";
                    $deviation->qa_more_info_required_by = 'Not Applicable';
                    $deviation->qa_more_info_required_on = 'Not Applicable';
                    // $deviation->pending_Cancel_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->previous = 'Not Applicable';
                    $history->activity_type = 'Not Applicable';

                    $history->action='More Information Required';
                    $history->current = 'Not Applicable';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'Not Applicable';
                    $history->change_to =   "Pending Initiator Update";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();
                    // $list = Helpers::getInitiatorUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "More Information Required", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }

                    $deviation->update();
                    return back();
                }



        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
     public function Request_Cancel(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
             if ($deviation->stage == 2) {




                    $deviation->stage = "11";
                    $deviation->status = "Pending Cancellation";
                    $deviation->pending_Cancel_by = Auth::user()->name;
                    $deviation->pending_Cancel_on = Carbon::now()->format('d-M-Y');
                    $deviation->pending_Cancel_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->activity_type = 'Request For Cancellation By, Request For Cancellation On';
                    if(is_null($lastDocument->pending_Cancel_by) || $lastDocument->pending_Cancel_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->pending_Cancel_by. ' ,' . $lastDocument->pending_Cancel_on;
                    }
                    $history->action='Request For Cancellation';
                    $history->current = $deviation->pending_Cancel_by. ',' . $deviation->pending_Cancel_on;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Pending Cancellation";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    if(is_null($lastDocument->pending_Cancel_by) || $lastDocument->pending_Cancel_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();


                    // $list = Helpers::getHodUserList();
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

                    // $list = Helpers::getHeadoperationsUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $deviation->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {

                    //             Mail::send(
                    //                 'mail.Categorymail',
                    //                 ['data' => $deviation],
                    //                 function ($message) use ($email) {
                    //                     $message->to($email)
                    //                         ->subject("Activity Performed By " . Auth::user()->name);
                    //                 }
                    //             );
                    //         }
                    //     }
                    // }
                    // dd($deviation);
                    // $list = Helpers::getQAUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Request For Cancellation", 'process' => 'Deviation', 'comment' => $deviation->pending_Cancel_comment, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Request For Cancellation Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }

                    $deviation->update();
                    return back();
                }



        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function deviationCancel(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
            // dd( $deviation->stage);




             if ($deviation->stage == 11) {




                    $deviation->stage = "0";
                    $deviation->status = "Closed-Cancel";
                    $deviation->cancelled_by = Auth::user()->name;
                    $deviation->cancelled_on = Carbon::now()->format('d-M-Y');
                    $deviation->cancelled_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->action='Cancel';
                    $history->current = $deviation->cancelled_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Closed-Cancel";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Pending Cancellation';
                    $history->save();





                    // $list = Helpers::getInitiatorUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Cancel", 'process' => 'Deviation', 'comment' => $request->cancelled_comment, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Cancel Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }



                    $deviation->update();
                    $history = new DeviationHistory();
                    $history->type = "Capa";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $deviation->stage;
                    $history->status = $deviation->status;
                    $history->save();
                    return back();
                }
         else {
            toastr()->error('E-signature Not match');
            return back();
           }
         }
    }

    public function deviationIsCFTRequired(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
            $deviation->stage = "5";
            $deviation->status = "QA/CQA Final Review";
            $deviation->CFT_Review_Complete_By = Auth::user()->name;
            $deviation->CFT_Review_Complete_On = Carbon::now()->format('d-M-Y');
            $history = new DeviationAuditTrail();
            $history->deviation_id = $id;
            $history->activity_type = 'Activity Log';
            $history->previous = "";
            $history->current = $deviation->CFT_Review_Complete_By;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage = 'Send to HOD';


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
            $history->save();
            $deviation->update();
            $history = new DeviationHistory();
            $history->type = "Deviation";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $deviation->stage;
            $history->status = $deviation->status;
            $history->save();

            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function check(Request $request, $id)
    {
         if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
           if ($deviation->stage == 5) {




                    $deviation->stage = "1";
                    $deviation->status = "Opened";
                    $deviation->qa_more_info_required_by = 'Not Applicable';
                    $deviation->qa_more_info_required_on = 'Not Applicable';
                    // $deviation->pending_Cancel_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->previous = 'Not Applicable';
                    $history->activity_type = 'Not Applicable';
                    $history->action='Send to Opened';
                    $history->current = 'Not Applicable';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'Not Applicable';
                    $history->change_to =   "Opened";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';

                    $history->save();
                    // $list = Helpers::getInitiatorUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Send to Initiator", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Send to Initiator Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    $deviation->update();
                    return back();
                }
             else {
            toastr()->error('E-signature Not match');
            return back();
        }}
    }

    public function check2(Request $request, $id)
   {
         if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
                 if ($deviation->stage == 5) {




                    $deviation->stage = "2";
                    $deviation->status = "HOD Review";
                    $deviation->qa_more_info_required_by = 'Not Applicable';
                    $deviation->qa_more_info_required_on = 'Not Applicable';
                    // $deviation->pending_Cancel_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->previous = 'Not Applicable';
                    $history->activity_type = 'Not Applicable';

                    $history->action='Send to HOD';
                    $history->current = 'Not Applicable';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'Not Applicable';
                    $history->change_to =   "HOD Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';

                    $history->save();
                    // $list = Helpers::getHodUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Send to HOD", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Send to HOD Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    $deviation->update();
                    return back();
                }
             else {
            toastr()->error('E-signature Not match');
            return back();
        }}
    }

    public function check3(Request $request, $id)
    {
         if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
           if ($deviation->stage == 5) {




                    $deviation->stage = "3";
                    $deviation->status = "QA/CQA Initial Assessment";
                    $deviation->qa_more_info_required_by ='Not Applicable';
                    $deviation->qa_more_info_required_on = 'Not Applicable';
                    // $deviation->pending_Cancel_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->previous = 'Not Applicable';
                    $history->activity_type = 'Not Applicable';
                    // if(is_null($lastDocument->qa_more_info_required_by) || $lastDocument->qa_more_info_required_on == ''){
                    //     $history->previous = "";
                    // }else{
                    //     $history->previous = $lastDocument->qa_more_info_required_by. ' ,' . $lastDocument->qa_more_info_required_on;
                    // }
                    $history->action='Send to QA/CQA Initial Review';
                    $history->current ='Not Applicable';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'Not Applicable';
                    $history->change_to =   "QA/CQA Initial Assessment";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';

                    $history->save();
                    // $list = Helpers::getQAUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Send to QA/CQA Initial Review", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Send to QA/CQA Initial Review Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    // $list = Helpers::getCQAUsersList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Send to QA/CQA Initial Review", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Send to QA/CQA Initial Review Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    $deviation->update();
                    return back();
                }
             else {
            toastr()->error('E-signature Not match');
            return back();
        }}
    }
    public function pending_initiator_update(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $Cft = DeviationCft::withoutTrashed()->where('deviation_id', $id)->first();
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
         if ($deviation->stage == 10) {




                    $deviation->stage = "7";
                    $deviation->status = "Pending Initiator Update";
                    $deviation->qa_more_info_required_by = 'Not Applicable';
                    $deviation->qa_more_info_required_on = 'Not Applicable';
                    // $deviation->qa_more_info_required_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->previous = 'Not Applicable';
                    $history->activity_type = 'Not Applicable';

                    $history->action='Send to Pending Initiator Update';
                    $history->current = 'Not Applicable';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'Not Applicable';
                    $history->change_to =   "Pending Initiator Update";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';

                    $history->save();
                    // $list = Helpers::getInitiatorUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Send to Pending Initiator Update", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Send to Pending Initiator Update Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    $deviation->update();
                    return back();
                }
                 if ($deviation->stage == 9) {




                    $deviation->stage = "7";
                    $deviation->status = "Pending Initiator Update";
                    $deviation->qa_more_info_required_by = 'Not Applicable';
                    $deviation->qa_more_info_required_on = 'Not Applicable';
                    // $deviation->qa_more_info_required_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->previous = 'Not Applicable';
                    $history->activity_type = 'Not Applicable';

                    $history->action='Send to Pending Initiator Update';
                    $history->current = 'Not Applicable';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'Not Applicable';
                    $history->change_to =   "Pending Initiator Update";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';

                    $history->save();
                    // $list = Helpers::getInitiatorUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Send to Pending Initiator Update", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Send to Pending Initiator Update Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    $deviation->update();
                    return back();
                }



        }
        else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
    public function deviation_send_stage(Request $request, $id)
    {
        try {
            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $deviation = Deviation::find($id);
                $updateCFT = DeviationCft::where('deviation_id', $id)->latest()->first();
                $lastDocument = Deviation::find($id);
                $cftDetails = DeviationCftsResponse::withoutTrashed()->where(['status' => 'In-progress', 'deviation_id' => $id])->distinct('cft_user_id')->count();

                if ($deviation->stage == 1) {
                    if ($deviation->form_progress !== 'general-open')
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

                    $deviation->stage = "2";
                    $deviation->status = "HOD Review";
                    $deviation->submit_by = Auth::user()->name;
                    $deviation->submit_on = Carbon::now()->format('d-M-Y');
                    $deviation->submit_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    // $history->activity_type = 'Activity Log';
                    // $history->previous = "";
                    $history->activity_type = 'Submit By, Submit On';
                    if(is_null($lastDocument->submit_by) || $lastDocument->submit_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->submit_by. ' ,' . $lastDocument->submit_on;
                    }
                    $history->action='Submit';
                    $history->current = $deviation->submit_by. ',' . $deviation->submit_on;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "HOD Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    if(is_null($lastDocument->submit_by) || $lastDocument->submit_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();


                    // $list = Helpers::getHodUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Submit", 'process' => 'Deviation', 'comment' => $deviation->submit_comment, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Submit Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }


                    $deviation->update();
                    return back();
                }
                if ($deviation->stage == 2) {

                    // Check HOD remark value
                    if (!$deviation->HOD_Remarks) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'Pls fill HOD Review tab !',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for QA/CQA initial  Assessment Tab'
                        ]);
                    }

                    $deviation->stage = "3";
                    $deviation->status = "QA/CQA Initial Assessment";
                    $deviation->HOD_Review_Complete_By = Auth::user()->name;
                    $deviation->HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $deviation->HOD_Review_Comments = $request->comment;
                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    // $history->activity_type = 'Activity Log';
                    // $history->previous = "";
                      $history->activity_type = 'HOD Review Complete By, HOD Review Complete On';
                    if(is_null($lastDocument->HOD_Review_Complete_By) || $lastDocument->HOD_Review_Complete_On == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->HOD_Review_Complete_By. ' ,' . $lastDocument->HOD_Review_Complete_On;
                    }
                    $history->action='HOD Review Complete';
                    $history->current = $deviation->HOD_Review_Complete_By. ',' . $deviation->HOD_Review_Complete_On;
                    $history->comment = $request->comment;
                    $history->action= 'HOD Review Complete';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA/CQA Initial Assessment";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Approved';
                                        if(is_null($lastDocument->HOD_Review_Complete_By) || $lastDocument->HOD_Review_Complete_On == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // dd($history->action);
                    // $list = Helpers::getQAUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "HOD Review Complete", 'process' => 'Deviation', 'comment' => $deviation->HOD_Review_Comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Review Complete Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }

                    // $list = Helpers::getCQAUsersList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "HOD Review Complete", 'process' => 'Deviation', 'comment' => $deviation->HOD_Review_Comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Review Complete Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }


                    $deviation->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($deviation->stage == 3) {
                    if ($deviation->form_progress !== 'cft')
                    {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'QA/CQA initial review / CFT Mandatory Tab is yet to be filled!'
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for CFT review state'
                        ]);
                    }

                    $deviation->stage = "4";
                    $deviation->status = "CFT Review";

                    // Code for the CFT required
                    $stage = new DeviationCftsResponse();
                    $stage->deviation_id = $id;
                    $stage->cft_user_id = Auth::user()->id;
                    $stage->status = "CFT Required";
                    // $stage->cft_stage = ;
                    $stage->comment = $request->comment;
                    $stage->is_required = 1;
                    $stage->save();

                    $deviation->QA_Initial_Review_Complete_By = Auth::user()->name;
                    $deviation->QA_Initial_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $deviation->QA_Initial_Review_Comments = $request->comment;
                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                     $history->activity_type = 'QA/CQA Initial Review Complete By, QA/CQA Initial Review Complete On';
                    if(is_null($lastDocument->QA_Initial_Review_Complete_By) || $lastDocument->QA_Initial_Review_Complete_On == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->QA_Initial_Review_Complete_By. ' ,' . $lastDocument->QA_Initial_Review_Complete_On;
                    }
                    $history->action='QA/CQA Initial Review Complete';
                    $history->current = $deviation->QA_Initial_Review_Complete_By. ',' . $deviation->QA_Initial_Review_Complete_On;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->change_to =   "CFT Review";
                    $history->change_from = $lastDocument->status;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = 'Complete';
                    if(is_null($lastDocument->QA_Initial_Review_Complete_By) || $lastDocument->QA_Initial_Review_Complete_On == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getQAUserList();
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

                    // if ($request->Deviation_category == 'major' || $request->Deviation_category == 'minor' || $request->Deviation_category == 'critical') {

                    //         }
                    //         if ($request->Deviation_category == 'major' || $request->Deviation_category == 'minor' || $request->Deviation_category == 'critical') {

                    //                 }
                    //                 if ($request->Deviation_category == 'major' || $request->Deviation_category == 'minor' || $request->Deviation_category == 'critical') {

                    //                         }

                                            // $list = Helpers::getCftUserList($deviation->division_id);
                                            // foreach ($list as $u) {
                                            //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                                            //         $email = Helpers::getUserEmail($u->user_id);
                                            //             if ($email !== null) {
                                            //             try {
                                            //                 Mail::send(
                                            //                     'mail.view-mail',
                                            //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "QA/CQA Initial Review", 'process' => 'Deviation', 'comment' => $deviation->QA_Initial_Review_Comments, 'user'=> Auth::user()->name],
                                            //                     function ($message) use ($email, $deviation) {
                                            //                         $message->to($email)
                                            //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA/CQA Initial Review Complete Performed");
                                            //                     }
                                            //                 );
                                            //             } catch(\Exception $e) {
                                            //                 info('Error sending mail', [$e]);
                                            //             }
                                            //         }
                                            //     // }
                                            // }

                    $deviation->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($deviation->stage == 4) {

                    // CFT review state update form_progress
                    // if ($deviation->form_progress !== 'cft')
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
                    //         'message' => 'Sent to CFT Review State'
                    //     ]);
                    // }


                    $IsCFTRequired = DeviationCftsResponse::withoutTrashed()->where(['is_required' => 1, 'deviation_id' => $id])->latest()->first();
                    $cftUsers = DB::table('deviationcfts')->where(['deviation_id' => $id])->first();
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

                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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

                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
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
                            $stage = new DeviationCftsResponse();
                            $stage->deviation_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "Completed";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        } else {
                            $stage = new DeviationCftsResponse();
                            $stage->deviation_id = $id;
                            $stage->cft_user_id = Auth::user()->id;
                            $stage->status = "In-progress";
                            // $stage->cft_stage = ;
                            $stage->comment = $request->comment;
                            $stage->save();
                        }
                    }

                    $checkCFTCount = DeviationCftsResponse::withoutTrashed()->where(['status' => 'Completed', 'deviation_id' => $id])->count();
                    $Cft = DeviationCft::withoutTrashed()->where('deviation_id', $id)->first();

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


                        $deviation->stage = "5";
                        $deviation->status = "QA/CQA Final Assessment";
                        $deviation->CFT_Review_Complete_By = Auth::user()->name;
                        $deviation->CFT_Review_Complete_On = Carbon::now()->format('d-M-Y');
                        $deviation->CFT_Review_Comments = $request->comment;

                        $history = new DeviationAuditTrail();
                        $history->deviation_id = $id;
                        $history->activity_type = 'CFT Review Complete By, CFT Review Complete On';
                    if(is_null($lastDocument->CFT_Review_Complete_By) || $lastDocument->CFT_Review_Complete_On == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->CFT_Review_Complete_By. ' ,' . $lastDocument->CFT_Review_Complete_On;
                    }
                    $history->action='CFT Review Complete';
                    $history->current = $deviation->CFT_Review_Complete_By. ',' . $deviation->CFT_Review_Complete_On;
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
                        // $list = Helpers::getQAUserList($deviation->division_id);
                        // foreach ($list as $u) {
                        //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                        //         $email = Helpers::getUserEmail($u->user_id);
                        //             if ($email !== null) {
                        //             try {
                        //                 Mail::send(
                        //                     'mail.view-mail',
                        //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "CFT Review Complete", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                        //                     function ($message) use ($email, $deviation) {
                        //                         $message->to($email)
                        //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: CFT Review Complete Performed");
                        //                     }
                        //                 );
                        //             } catch(\Exception $e) {
                        //                 info('Error sending mail', [$e]);
                        //             }
                        //         }
                        //     // }
                        // }
                        // $list = Helpers::getCQAUsersList($deviation->division_id);
                        //                     foreach ($list as $u) {
                        //                         // if($u->q_m_s_divisions_id == $deviation->division_id){
                        //                             $email = Helpers::getUserEmail($u->user_id);
                        //                                 if ($email !== null) {
                        //                                 try {
                        //                                     Mail::send(
                        //                                         'mail.view-mail',
                        //                                         ['data' => $deviation, 'site'=>"DEV", 'history' => "CFT Review Complete", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                        //                                         function ($message) use ($email, $deviation) {
                        //                                             $message->to($email)
                        //                                             ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: CFT Review Complete Performed");
                        //                                         }
                        //                                     );
                        //                                 } catch(\Exception $e) {
                        //                                     info('Error sending mail', [$e]);
                        //                                 }
                        //                             }
                        //                         // }
                        //                     }
                        $deviation->update();
                    }
                    toastr()->success('Document Sent');
                    return back();
                }

                if ($deviation->stage == 5) {

                      // return "PAUSE";
                      if (!$deviation->qa_final_assement) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'QA/CQA Final Assessment',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for QA/CQA Head/Manager Designee Approval'
                        ]);
                    }


                    $deviation->stage = "6";
                    $deviation->status = "QA/CQA Head/Manager Designee Approval";
                    $deviation->QA_Final_Review_Complete_By = Auth::user()->name;
                    $deviation->QA_Final_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $deviation->QA_Final_Review_Comments = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->activity_type = 'QA/CQA Final Assessment Complete By, QA/CQA Final Assessment Complete On';
                    if(is_null($lastDocument->QA_Final_Review_Complete_By) || $lastDocument->QA_Final_Review_Complete_On == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->QA_Final_Review_Complete_By. ' ,' . $lastDocument->QA_Final_Review_Complete_On;
                    }
                    $history->action='QA/CQA Final Assessment Complete';
                    $history->current = $deviation->QA_Final_Review_Complete_By. ',' . $deviation->QA_Final_Review_Complete_On;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA/CQA Head/Manager Designee Approval";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Approved';
                    if(is_null($lastDocument->QA_Final_Review_Complete_By) || $lastDocument->QA_Final_Review_Complete_On == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                                        //  $list = Helpers::getCQAHeadUsersList($deviation->division_id);
                                        //     foreach ($list as $u) {
                                        //         // if($u->q_m_s_divisions_id == $deviation->division_id){
                                        //             $email = Helpers::getUserEmail($u->user_id);
                                        //                 if ($email !== null) {
                                        //                 try {
                                        //                     Mail::send(
                                        //                         'mail.view-mail',
                                        //                         ['data' => $deviation, 'site'=>"DEV", 'history' => "QA/CQA Final Assessment Complete", 'process' => 'Deviation', 'comment' => $deviation->QA_Final_Review_Comments, 'user'=> Auth::user()->name],
                                        //                         function ($message) use ($email, $deviation) {
                                        //                             $message->to($email)
                                        //                             ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA/CQA Final Assessment Complete Performed");
                                        //                         }
                                        //                     );
                                        //                 } catch(\Exception $e) {
                                        //                     info('Error sending mail', [$e]);
                                        //                 }
                                        //             }
                                        //         // }
                                        //     }
                                        //     $list = Helpers::getQAUserList($deviation->division_id);
                                        //     foreach ($list as $u) {
                                        //         // if($u->q_m_s_divisions_id == $deviation->division_id){
                                        //             $email = Helpers::getUserEmail($u->user_id);
                                        //                 if ($email !== null) {
                                        //                 try {
                                        //                     Mail::send(
                                        //                         'mail.view-mail',
                                        //                         ['data' => $deviation, 'site'=>"DEV", 'history' => "QA/CQA Final Assessment Complete", 'process' => 'Deviation', 'comment' => $deviation->QA_Final_Review_Comments, 'user'=> Auth::user()->name],
                                        //                         function ($message) use ($email, $deviation) {
                                        //                             $message->to($email)
                                        //                             ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA/CQA Final Assessment Complete Performed");
                                        //                         }
                                        //                     );
                                        //                 } catch(\Exception $e) {
                                        //                     info('Error sending mail', [$e]);
                                        //                 }
                                        //             }
                                        //         // }
                                        //     }
                    $deviation->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($deviation->stage == 6) {


            // return "PAUSE";
            if (!$deviation->qa_head_designe_comment) {

                Session::flash('swal', [
                    'title' => 'Mandatory Fields Required!',
                    'message' => 'QA/CQA Head/ Designee Approval Tab',
                    'type' => 'warning',
                ]);

                return redirect()->back();
            } else {
                Session::flash('swal', [
                    'type' => 'success',
                    'title' => 'Success',
                    'message' => 'Sent for Pending Initiator Update state'
                ]);
                 }




                    $deviation->stage = "7";
                    $deviation->status = "Pending Initiator Update";
                    $deviation->QA_head_approved_by = Auth::user()->name;
                    $deviation->QA_head_approved_on = Carbon::now()->format('d-M-Y');
                    $deviation->QA_head_approved_comment	 = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->activity_type = 'Approved By, Approved On';
                    if(is_null($lastDocument->QA_head_approved_by) || $lastDocument->QA_head_approved_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->QA_head_approved_by. ' ,' . $lastDocument->QA_head_approved_on;
                    }
                    $history->action='Approved';
                    $history->current = $deviation->QA_head_approved_by. ',' . $deviation->QA_head_approved_on;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Pending Initiator Update";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Complete';
                    if(is_null($lastDocument->QA_head_approved_by) || $lastDocument->QA_head_approved_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    // $list = Helpers::getInitiatorUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Approved", 'process' => 'Deviation', 'comment' => $deviation->QA_head_approved_comment, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Approved Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }

                    $deviation->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($deviation->stage == 7) {



                    $extension = Extension::where('parent_id', $deviation->id)->first();

                    $rca = RootCauseAnalysis::where('parent_record', str_pad($deviation->id, 4, 0, STR_PAD_LEFT))->first();

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
                    if ((empty($deviation->Discription_Event) && empty($changeControl->objective)
                    && empty($deviation->scope) &&  empty($deviation->imidiate_action) &&  empty($deviation->Detail_Of_Root_Cause)
                    )){
                       Session::flash('swal', [
                           'title' => 'Mandatory Fields Required!',
                           'message' => 'Investingation tab is yet to be filled!',
                           'type' => 'warning',
                       ]);

                       return redirect()->back();
                   } else {
                       Session::flash('swal', [
                           'type' => 'success',
                           'title' => 'Success',
                           'message' => 'Sent for HOD Final Review state'
                       ]);
                   }

                   $riskEffectAnalysis = DeviationGrid::where('deviation_grid_id', $id)->where('type', "effect_analysis")->latest()->first();
                //  dd($riskEffectAnalysis->risk_factor);
                   if (empty($riskEffectAnalysis->risk_factor)) {

                      Session::flash('swal', [
                          'title' => 'Mandatory Fields Required!',
                          'message' => 'QRM tab is yet to be filled!',
                          'type' => 'warning',
                      ]);

                      return redirect()->back();
                  } else {
                      Session::flash('swal', [
                          'type' => 'success',
                          'title' => 'Success',
                          'message' => 'Sent for HOD Final Review state'
                      ]);
                  }
                //   dd($deviation->capa_root_cause);
                  if (empty($deviation->capa_root_cause) && empty($deviation->Immediate_Action_Take) ) {

                     Session::flash('swal', [
                         'title' => 'Mandatory Fields Required!',
                         'message' => 'QRM and CAPA tab is yet to be filled!',
                         'type' => 'warning',
                     ]);

                     return redirect()->back();
                 } else {
                     Session::flash('swal', [
                         'type' => 'success',
                         'title' => 'Success',
                         'message' => 'Sent for HOD Final Review state'
                     ]);
                 }

                    if (!$deviation->Pending_initiator_update) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'Pending Initiator Update is yet to be filled!',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for HOD Final Review state'
                        ]);
                    }
                    // if (!$deviation->Discription_Event) {


                    $deviation->stage = "8";
                    $deviation->status = "HOD Final Review";
                    $deviation->pending_initiator_approved_by = Auth::user()->name;
                    $deviation->pending_initiator_approved_on = Carbon::now()->format('d-M-Y');
                    $deviation->pending_initiator_approved_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->activity_type = 'Initiator Updated Complete By, Initiator Updated Complete On';
                    if(is_null($lastDocument->pending_initiator_approved_by) || $lastDocument->pending_initiator_approved_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->pending_initiator_approved_by. ' ,' . $lastDocument->pending_initiator_approved_on;
                    }
                    $history->action='Initiator Updated Complete';
                    $history->current = $deviation->pending_initiator_approved_by. ',' . $deviation->pending_initiator_approved_on;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "HOD Final Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Completed';
                    if(is_null($lastDocument->pending_initiator_approved_by) || $lastDocument->pending_initiator_approved_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getHodUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Initiator Update Completed", 'process' => 'Deviation', 'comment' => $deviation->pending_initiator_approved_comment, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Initiator Update Completed Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    $deviation->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($deviation->stage == 8) {


                    $extension = Extension::where('parent_id', $deviation->id)->first();

                    $rca = RootCauseAnalysis::where('parent_record', str_pad($deviation->id, 4, 0, STR_PAD_LEFT))->first();


                    if (!$deviation->hod_final_review) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'HOD Final Review is yet to be filled!',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for Implementation verification by QA/CQA state'
                        ]);
                    }

                    $deviation->stage = "9";
                    $deviation->status = "Implementation verification by QA/CQA";
                    $deviation->Hod_final_by = Auth::user()->name;
                    $deviation->Hod_final_on = Carbon::now()->format('d-M-Y');
                    $deviation->Hod_final_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->activity_type = 'HOD Final Review Complete By, HOD Final Review Complete On';
                    if(is_null($lastDocument->Hod_final_by) || $lastDocument->Hod_final_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Hod_final_by. ' ,' . $lastDocument->Hod_final_on;
                    }
                    $history->action='HOD Final Review Complete';
                    $history->current = $deviation->Hod_final_by. ',' . $deviation->Hod_final_on;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Implementation verification by QA/CQA";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Complete';
                    if(is_null($lastDocument->Hod_final_by) || $lastDocument->Hod_final_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getQAUserList($deviation->division_id);
                    //                         foreach ($list as $u) {
                    //                             // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //                                 $email = Helpers::getUserEmail($u->user_id);
                    //                                     if ($email !== null) {
                    //                                     try {
                    //                                         Mail::send(
                    //                                             'mail.view-mail',
                    //                                             ['data' => $deviation, 'site'=>"DEV", 'history' => "HOD Final Review Complete", 'process' => 'Deviation', 'comment' => $deviation->Hod_final_comment, 'user'=> Auth::user()->name],
                    //                                             function ($message) use ($email, $deviation) {
                    //                                                 $message->to($email)
                    //                                                 ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Final Review Complete Performed");
                    //                                             }
                    //                                         );
                    //                                     } catch(\Exception $e) {
                    //                                         info('Error sending mail', [$e]);
                    //                                     }
                    //                                 }
                    //                             // }
                    //                         }
                    //                         $list = Helpers::getCQAUsersList($deviation->division_id);
                    //                         foreach ($list as $u) {
                    //                             // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //                                 $email = Helpers::getUserEmail($u->user_id);
                    //                                     if ($email !== null) {
                    //                                     try {
                    //                                         Mail::send(
                    //                                             'mail.view-mail',
                    //                                             ['data' => $deviation, 'site'=>"DEV", 'history' => "HOD Final Review Complete", 'process' => 'Deviation', 'comment' => $deviation->Hod_final_comment, 'user'=> Auth::user()->name],
                    //                                             function ($message) use ($email, $deviation) {
                    //                                                 $message->to($email)
                    //                                                 ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Final Review Complete Performed");
                    //                                             }
                    //                                         );
                    //                                     } catch(\Exception $e) {
                    //                                         info('Error sending mail', [$e]);
                    //                                     }
                    //                                 }
                    //                             // }
                    //                         }
                    $deviation->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                 if ($deviation->stage == 9) {

                    // if ($deviation->form_progress !== 'qah')
                    // {

                    //     Session::flash('swal', [
                    //         'title' => 'Mandatory Fields!',
                    //         'message' => 'QAH/Designee Approval Tab is yet to be filled!',
                    //         'type' => 'warning',
                    //     ]);

                    //     return redirect()->back();
                    // } else {
                    //     Session::flash('swal', [
                    //         'type' => 'success',
                    //         'title' => 'Success',
                    //         'message' => 'Deviation sent to QA Final Approval.'
                    //     ]);
                    // }


                    if (!$deviation->QA_Feedbacks) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'QA/CQA Implementation Verification is yet to be filled!',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for Head QA/CQA / Designee Closure Approval'
                        ]);
                    }
                    $extension = Extension::where('parent_id', $deviation->id)->first();

                    $rca = RootCauseAnalysis::where('parent_record', str_pad($deviation->id, 4, 0, STR_PAD_LEFT))->first();



                    $deviation->stage = "10";
                    $deviation->status = "Head QA/CQA / Designee Closure Approval";
                    $deviation->QA_final_approved_by = Auth::user()->name;
                    $deviation->QA_final_approved_on = Carbon::now()->format('d-M-Y');
                    $deviation->QA_final_approved_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->activity_type = 'Implementation verification Complete By, Implementation verification Complete On';
                    if(is_null($lastDocument->QA_final_approved_by) || $lastDocument->QA_final_approved_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->QA_final_approved_by. ' ,' . $lastDocument->QA_final_approved_on;
                    }
                    $history->action='Implementation verification Complete';
                    $history->current = $deviation->QA_final_approved_by. ',' . $deviation->QA_final_approved_on;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Head QA/CQA / Designee Closure Approval";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Complete';
                    if(is_null($lastDocument->QA_final_approved_by) || $lastDocument->QA_final_approved_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getQAHeadUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Implementation verification Complete", 'process' => 'Deviation', 'comment' => $deviation->QA_final_approved_comment, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Implementation verification Complete Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    // $list = Helpers::getCQAHeadUsersList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Implementation verification Complete", 'process' => 'Deviation', 'comment' => $deviation->QA_final_approved_comment, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Implementation verification Complete Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    $deviation->update();
                    toastr()->success('Document Sent');
                    return back();
                }


                if ($deviation->stage == 10) {


                    // return "PAUSE";

                    if (!$deviation->Closure_Comments) {

                        Session::flash('swal', [
                            'title' => 'Mandatory Fields Required!',
                            'message' => 'Head QA/CQA / Designee Closure Approval is yet to be filled!',
                            'type' => 'warning',
                        ]);

                        return redirect()->back();
                    } else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for Close-Done'
                        ]);
                    }

                    $deviation->stage = "12";
                    $deviation->status = "Closed-Done";
                    $deviation->Close_by = Auth::user()->name;
                    $deviation->Close_on = Carbon::now()->format('d-M-Y');
                    $deviation->Close_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->activity_type = 'Closure Approved By, Closure Approved On';
                    if(is_null($lastDocument->Close_by) || $lastDocument->Close_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->Close_by. ' ,' . $lastDocument->Close_on;
                    }
                    $history->action='Closure Approved';
                    $history->current = $deviation->Close_by. ',' . $deviation->Close_on;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Closed-Done";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Complete';
                    if(is_null($lastDocument->Close_by) || $lastDocument->Close_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getQAHeadUserList($deviation->division_id);
                    //                         foreach ($list as $u) {
                    //                             // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //                                 $email = Helpers::getUserEmail($u->user_id);
                    //                                     if ($email !== null) {
                    //                                     try {
                    //                                         Mail::send(
                    //                                             'mail.view-mail',
                    //                                             ['data' => $deviation, 'site'=>"DEV", 'history' => "Closure Approved", 'process' => 'Deviation', 'comment' => $deviation->comments, 'user'=> Auth::user()->name],
                    //                                             function ($message) use ($email, $deviation) {
                    //                                                 $message->to($email)
                    //                                                 ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Closure Approved Performed");
                    //                                             }
                    //                                         );
                    //                                     } catch(\Exception $e) {
                    //                                         info('Error sending mail', [$e]);
                    //                                     }
                    //                                 }
                    //                             // }
                    //                         }
                    //                         $list = Helpers::getQAUserList($deviation->division_id);
                    //                         foreach ($list as $u) {
                    //                             // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //                                 $email = Helpers::getUserEmail($u->user_id);
                    //                                     if ($email !== null) {
                    //                                     try {
                    //                                         Mail::send(
                    //                                             'mail.view-mail',
                    //                                             ['data' => $deviation, 'site'=>"DEV", 'history' => "Closure Approved", 'process' => 'Deviation', 'comment' => $deviation->comments, 'user'=> Auth::user()->name],
                    //                                             function ($message) use ($email, $deviation) {
                    //                                                 $message->to($email)
                    //                                                 ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Closure Approved Performed");
                    //                                             }
                    //                                         );
                    //                                     } catch(\Exception $e) {
                    //                                         info('Error sending mail', [$e]);
                    //                                     }
                    //                                 }
                    //                             // }
                    //                         }
                    //                         $list = Helpers::getCQAUsersList($deviation->division_id);
                    //                         foreach ($list as $u) {
                    //                             // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //                                 $email = Helpers::getUserEmail($u->user_id);
                    //                                     if ($email !== null) {
                    //                                     try {
                    //                                         Mail::send(
                    //                                             'mail.view-mail',
                    //                                             ['data' => $deviation, 'site'=>"DEV", 'history' => "Closure Approved", 'process' => 'Deviation', 'comment' => $deviation->comments, 'user'=> Auth::user()->name],
                    //                                             function ($message) use ($email, $deviation) {
                    //                                                 $message->to($email)
                    //                                                 ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Closure Approved Performed");
                    //                                             }
                    //                                         );
                    //                                     } catch(\Exception $e) {
                    //                                         info('Error sending mail', [$e]);
                    //                                     }
                    //                                 }
                    //                             // }
                    //                         }
                                            // $list = Helpers::getInitiatorUserList($deviation->division_id);
                                            // foreach ($list as $u) {
                                            //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                                            //         $email = Helpers::getUserEmail($u->user_id);
                                            //             if ($email !== null) {
                                            //             try {
                                            //                 Mail::send(Close_comment
                                            //                     'mail.view-mail',
                                            //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Closure Approved", 'process' => 'Deviation', 'comment' => $deviation->Close_comment, 'user'=> Auth::user()->name],
                                            //                     function ($message) use ($email, $deviation) {
                                            //                         $message->to($email)
                                            //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Closure Approved Performed");
                                            //                     }
                                            //                 );
                                            //             } catch(\Exception $e) {
                                            //                 info('Error sending mail', [$e]);
                                            //             }
                                            //         }
                                            //     // }
                                            // }
                                            // $list = Helpers::getCftUserList($deviation->division_id);
                                            // foreach ($list as $u) {
                                            //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                                            //         $email = Helpers::getUserEmail($u->user_id);
                                            //             if ($email !== null) {
                                            //             try {
                                            //                 Mail::send(
                                            //                     'mail.view-mail',
                                            //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Closure Approved", 'process' => 'Deviation', 'comment' => $deviation->Close_comment, 'user'=> Auth::user()->name],
                                            //                     function ($message) use ($email, $deviation) {
                                            //                         $message->to($email)
                                            //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Closure Approved Performed");
                                            //                     }
                                            //                 );
                                            //             } catch(\Exception $e) {
                                            //                 info('Error sending mail', [$e]);
                                            //             }
                                            //         }
                                            //     // }
                                            // }
                                            // $list = Helpers::getHodUserList($deviation->division_id);
                                            // foreach ($list as $u) {
                                            //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                                            //         $email = Helpers::getUserEmail($u->user_id);
                                            //             if ($email !== null) {
                                            //             try {
                                            //                 Mail::send(
                                            //                     'mail.view-mail',
                                            //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "Closure Approved", 'process' => 'Deviation', 'comment' => $deviation->Close_comment, 'user'=> Auth::user()->name],
                                            //                     function ($message) use ($email, $deviation) {
                                            //                         $message->to($email)
                                            //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: Closure Approved Performed");
                                            //                     }
                                            //                 );
                                            //             } catch(\Exception $e) {
                                            //                 info('Error sending mail', [$e]);
                                            //             }
                                            //         }
                                            //     // }
                                            // }
                    $deviation->update();
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
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
           if ($deviation->stage == 3) {




                    $deviation->stage = "5";
                    $deviation->status = "QA/CQA Final Assessment";
                    $deviation->cft_review_not_req_by = Auth::user()->name;
                    $deviation->cft_review_not_req_on = Carbon::now()->format('d-M-Y');
                    $deviation->cft_review_not_req_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->activity_type = 'CFT Review Not Required By, CFT Review Not Required On';
                    if(is_null($lastDocument->cft_review_not_req_by) || $lastDocument->cft_review_not_req_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->cft_review_not_req_by. ' ,' . $lastDocument->cft_review_not_req_on;
                    }
                    $history->action='CFT Review Not Required';
                    $history->current = $deviation->cft_review_not_req_by. ',' . $deviation->cft_review_not_req_on;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA/CQA Final Assessment";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    if(is_null($lastDocument->cft_review_not_req_by) || $lastDocument->cft_review_not_req_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();

                    // $list = Helpers::getQAUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "CFT Review Not Required", 'process' => 'Deviation', 'comment' => $deviation->cft_review_not_req_comment, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: CFT Review Not Required Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    // $list = Helpers::getCQAUsersList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "CFT Review Not Required", 'process' => 'Deviation', 'comment' => $deviation->cft_review_not_req_comment, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: CFT Review Not Required Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    $deviation->update();
                    return back();
                }
             else {
            toastr()->error('E-signature Not match');
            return back();
        }}
    }

    public function deviation_qa_more_info(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);

               if ($deviation->stage == 2) {




                    $deviation->stage = "1";
                    $deviation->status = "Opened";
                    $deviation->qa_more_info_required_by = Auth::user()->name;
                    $deviation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                    // $deviation->pending_Cancel_comment = $request->comment;

                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->activity_type = 'More Information Required By, More Information Required On';
                    if(is_null($lastDocument->qa_more_info_required_by) || $lastDocument->qa_more_info_required_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->qa_more_info_required_by. ' ,' . $lastDocument->qa_more_info_required_on;
                    }
                    $history->action='More Information Required';
                    $history->current = $deviation->qa_more_info_required_by. ',' . $deviation->qa_more_info_required_on;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    if(is_null($lastDocument->qa_more_info_required_by) || $lastDocument->qa_more_info_required_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();

                    // $list = Helpers::getInitiatorUserList($deviation->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $deviation->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $deviation, 'site'=>"DEV", 'history' => "More Information Required", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $deviation) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }
                    $deviation->update();
                    return back();
                }

            if ($deviation->stage == 3) {
                $deviation->stage = "2";
                $deviation->status = "HOD Review";
                $deviation->qa_more_info_required_by = Auth::user()->name;
                $deviation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new DeviationAuditTrail();
                $history->deviation_id = $id;
                $history->activity_type = 'More Information Required By, More Information Required On';
                    if(is_null($lastDocument->qa_more_info_required_by) || $lastDocument->qa_more_info_required_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->qa_more_info_required_by. ' ,' . $lastDocument->qa_more_info_required_on;
                    }
                    $history->action='More Information Required';
                    $history->current = $deviation->qa_more_info_required_by. ',' . $deviation->qa_more_info_required_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->save();
                $deviation->update();
                $history = new DeviationHistory();
                $history->type = "Deviation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $deviation->stage;
                $history->status = $deviation->status;
                if(is_null($lastDocument->qa_more_info_required_by) || $lastDocument->qa_more_info_required_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                $history->save();
                // $list = Helpers::getHodUserList($deviation->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $deviation->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 try {
                //                     Mail::send(
                //                         'mail.view-mail',
                //                         ['data' => $deviation, 'site'=>"DEV", 'history' => "More Information Required", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                         function ($message) use ($email, $deviation) {
                //                             $message->to($email)
                //                             ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required Performed");
                //                         }
                //                     );
                //                 } catch(\Exception $e) {
                //                     info('Error sending mail', [$e]);
                //                 }
                //             }
                //         // }
                //     }
                toastr()->success('Document Sent');
                return back();
            }

            if ($deviation->stage == 4) {
                $deviation->stage = "3";
                $deviation->status = "QA/CQA Initial Review";
                $deviation->qa_more_info_required_by = Auth::user()->name;
                $deviation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $history = new DeviationAuditTrail();
                $history->deviation_id = $id;
                $history->activity_type = 'QA/CQA Final Review Complete By, QA/CQA Final Review Completed On';
                    if(is_null($lastDocument->qa_more_info_required_by) || $lastDocument->qa_more_info_required_on == ''){
                        $history->previous = "";
                    }else{
                        $history->previous = $lastDocument->qa_more_info_required_by. ' ,' . $lastDocument->qa_more_info_required_on;
                    }
                    $history->action='QA/CQA Final Review Complete';
                    $history->current = $deviation->qa_more_info_required_by. ',' . $deviation->qa_more_info_required_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'More Info Required';
                $history->save();

                // $list = Helpers::getQAUserList($deviation->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $deviation->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 try {
                //                     Mail::send(
                //                         'mail.view-mail',
                //                         ['data' => $deviation, 'site'=>"DEV", 'history' => "More Information Required", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                         function ($message) use ($email, $deviation) {
                //                             $message->to($email)
                //                             ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required Performed");
                //                         }
                //                     );
                //                 } catch(\Exception $e) {
                //                     info('Error sending mail', [$e]);
                //                 }
                //             }
                //         // }
                //     }
                //     $list = Helpers::getCQAUsersList($deviation->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $deviation->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 try {
                //                     Mail::send(
                //                         'mail.view-mail',
                //                         ['data' => $deviation, 'site'=>"DEV", 'history' => "More Information Required", 'process' => 'Deviation', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                         function ($message) use ($email, $deviation) {
                //                             $message->to($email)
                //                             ->subject("Agio Notification: Deviation, Record #" . str_pad($deviation->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required Performed");
                //                         }
                //                     );
                //                 } catch(\Exception $e) {
                //                     info('Error sending mail', [$e]);
                //                 }
                //             }
                //         // }
                //     }
                $deviation->update();
                $history = new DeviationHistory();
                $history->type = "Deviation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $deviation->stage;
                $history->status = $deviation->status;
                if(is_null($lastDocument->qa_more_info_required_by) || $lastDocument->qa_more_info_required_on == '')
                    {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function store_audit_review(Request $request, $id)
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

    public function rootAuditTrial($id)
    {
        $audit = RootAuditTrial::where('root_id', $id)->orderByDESC('id')->get()->unique('activity_type');
        $today = Carbon::now()->format('d-m-y');
        $document = RootCauseAnalysis::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');

        return view("frontend.root-cause-analysis.root-audit-trail", compact('audit', 'document', 'today'));
    }

    public function DeviationAuditTrial($id)
    // {
    //     $audit = DeviationAuditTrail::where('deviation_id', $id)->orderByDesc('id')->paginate(5);
    //     $today = Carbon::now()->format('d-m-y');
    //     $document = Deviation::where('id', $id)->first();
    //     $document->initiator = User::where('id', $document->initiator_id)->value('name');

    //     return view('frontend.forms.deviation.deviation_audit', compact('audit', 'document', 'today'));
    // }
        {
        $audit = DeviationAuditTrail::where('deviation_id', $id)->orderByDESC('id')->paginate(5);
        // dd($audit);
        $today = Carbon::now()->format('d-m-y');
        $document = Deviation::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');

        $users = User::all();
        return view('frontend.forms.deviation.deviation_audit', compact('audit', 'document', 'today','users'));
    }





public function audit_trail_filter(Request $request, $id)
{
    // Start query for DeviationAuditTrail
    $query = DeviationAuditTrail::query();
    $query->where('deviation_id', $id);

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
    $responseHtml = view('frontend.forms.deviation.deviation_filter', compact('audit', 'filter_request'))->render();

    return response()->json(['html' => $responseHtml]);
}




    public function deviationAuditTrailPdf($id)
    {
        $doc = Deviation::find($id);
        $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        $data = DeviationAuditTrail::where('deviation_id', $id)->paginate(1000);
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.forms.deviation.deviation_audit_trail_pdf', compact('data', 'doc'))
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

    public function DeviationAuditTrialPdf($id)
    {
        $audit = DeviationAuditTrail::where('deviation_id', $id)->orderByDesc('id')->paginate(500);
        $today = Carbon::now()->format('d-m-y');
        $document = Deviation::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
        return view('frontend.forms.deviation.deviation_audit', compact('audit', 'document', 'today'));
    }

    public static function singleReport($id)
    {
        $data = Deviation::find($id);
        $data1 =  DeviationCft::where('deviation_id', $id)->first();
        if (!empty ($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $grid_data = DeviationGrid::where('deviation_grid_id', $id)->where('type', "Deviation")->first();
            $grid_data1 = DeviationGrid::where('deviation_grid_id', $id)->where('type', "Document")->first();
            $grid_data2 = DeviationGrid::where('deviation_grid_id', $id)->where('type', "Product")->first();

            // $data8 = DeviationGrid::where('deviation_grid_id', $id)->where('type', 'effect_analysis')->first();

            $investigationTeam = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => 'TeamInvestigation'])->first();
            $investigation_data = json_decode($investigationTeam->data, true);

            $rootCause = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => 'RootCause'])->first();
            $root_cause_data = json_decode($rootCause->data, true);

            $whyData = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => 'why'])->first();
            $why_data = json_decode($whyData->data, true);
      //  $riskEffectAnalysis_1 = DeviationGrid::where('deviation_grid_id', $id)->where('type', "effect_analysis")->first();
            $riskEffectAnalysis = DeviationGrid::where('deviation_grid_id', $id)->where('type', "effect_analysis")->latest()->first();

//dd($riskEffectAnalysis);
            $capaExtension = LaunchExtension::where(['deviation_id' => $id, "extension_identifier" => "Capa"])->first();
            $qrmExtension = LaunchExtension::where(['deviation_id' => $id, "extension_identifier" => "QRM"])->first();
            $investigationExtension = LaunchExtension::where(['deviation_id' => $id, "extension_identifier" => "Investigation"])->first();

            $grid_data_qrms = DeviationGridQrms::where(['deviation_id' => $id, 'identifier' => 'failure_mode_qrms'])->first();
            $grid_data_matrix_qrms = DeviationGridQrms::where(['deviation_id' => $id, 'identifier' => 'matrix_qrms'])->first();

           $fishboneData = DeviationNewGridData::where(['deviation_id' => $id, 'identifier' => 'fishbone'])->first();

            //dd($fishboneData);
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();

           //   dd($riskEffectAnalysis);
            // foreach($investigation_data as $invest)
            // {
            //     return $invest;
            // }


            $pdf = PDF::loadview('frontend.forms.deviation.SingleReportdeviation', compact('data','grid_data2','riskEffectAnalysis','grid_data_qrms','grid_data_matrix_qrms','capaExtension','qrmExtension','investigationExtension','root_cause_data','why_data','investigation_data','grid_data','grid_data1', 'data1','fishboneData'))
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
            $canvas->page_text($width / 10, $height / 2, $data->status, null, 25, [0, 0, 0], 2, 6, -20);
            return $pdf->stream('Deviation' . $id . '.pdf');
        }
    }
}
