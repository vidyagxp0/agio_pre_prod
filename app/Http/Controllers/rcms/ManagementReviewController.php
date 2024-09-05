<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\ActionItem;
use App\Models\Auditee;
use App\Models\AuditProgram;
use App\Models\Capa;
use App\Models\CC;
use App\Models\EffectivenessCheck;
use App\Models\InternalAudit;
use App\Models\LabIncident;
use App\Models\ManagementReview;
use App\Models\RecordNumber;
use App\Models\ManagementAuditTrial;
use App\Models\ManagementReviewDocDetails;
use App\Models\RiskManagement;
use App\Models\RoleGroup;
use App\Models\RootCauseAnalysis;
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
        $history->activity_type = 'Scheduled Start Date';
        $history->previous = "Null";
        $history->current = $management->start_date;
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
            $history->activity_type = 'Operations';
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
            $history->activity_type = 'External Supplier Performance';
            $history->previous = "Null";
            $history->current = $management->external_supplier_performance;
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
            $history->activity_type = 'Customer Satisfactio Level';
            $history->previous = "Null";
            $history->current = $management->customer_satisfaction_level;
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
            $history->activity_type = 'Budget Estimates';
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
            $history->activity_type = 'Completion of Previous Tasks';
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

    

        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }
    
    public function manageUpdate(Request $request, $id)
    {

        if (!$request->short_description) {
            toastr()->error("Short description is required");
            return redirect()->back();
        }
        $lastDocument = ManagementReview::find($id);
        $management = ManagementReview::find($id);
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
            $history->previous = $lastDocument->due_date;
            $history->current = $management->due_date;
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
                            ->where('activity_type', 'Scheduled Start Date')
                            ->exists();

            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $id;
            $history->activity_type = 'Scheduled Start Date';
            $history->previous = $lastDocument->start_date;
            $history->current = $management->start_date;
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
                            ->where('activity_type', 'Operations')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Operations';
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
                            ->where('activity_type', 'External Supplier Performance')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'External Supplier Performance';
            $history->previous =  $lastDocument->external_supplier_performance;
            $history->current = $management->external_supplier_performance;
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
                            ->where('activity_type', 'Customer Satisfaction Level')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Customer Satisfaction Level';
            $history->previous =  $lastDocument->customer_satisfaction_level;
            $history->current = $management->customer_satisfaction_level;
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
                            ->where('activity_type', 'Budget Estimates')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Budget Estimates';
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
                            ->where('activity_type', 'Completion of Previous Tasks')
                            ->exists();
            $history = new ManagementAuditTrial();
            $history->ManagementReview_id = $management->id;
            $history->activity_type = 'Completion of Previous Tasks';
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
        
        return view('frontend.management-review.management_review', compact( 'data','agenda','management_review_participants','performance_evaluation','action_item_details','capa_detail_details','due_date' ));
    }


    public function manage_send_stage(Request $request, $id)
    {


        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = ManagementReview::find($id);
            $lastDocument =  ManagementReview::find($id);
            $data =  ManagementReview::find($id);

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
            if ($changeControl->stage == 2) {
                $changeControl->stage = "3";
                $changeControl->status = 'QA Head Review';
                $changeControl->completed_by = Auth::user()->name;
                $changeControl->completed_on = Carbon::now()->format('d-M-Y');
                $changeControl->Completed_Comment  = $request->comment;
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = 'Completed By     , Completed On';
                $history->action ='Completed';
                // $history->previous = $lastDocument->completed_by;
                if (is_null($lastDocument->completed_by) || $lastDocument->completed_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->completed_by . ' , ' . $lastDocument->completed_on;
                }
                $history->current = $changeControl->completed_by . ' , ' . $changeControl->completed_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='Completed';
                $history->change_to= "QA Head Review";
                $history->change_from= $lastDocument->status;
                if (is_null($lastDocument->completed_by) || $lastDocument->completed_by === '') {
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
            if ($changeControl->stage == 4) {
                $changeControl->stage = "5";
                $changeControl->status = 'All AI Update by Respective Department';
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
                $history->change_to= "All AI Update by Respective Department";
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

            if ($changeControl->stage == 5) {
                $changeControl->stage = "6";
                $changeControl->status = 'HOD Final Review';
                $changeControl->ALLAICompleteby_by = Auth::user()->name;
                $changeControl->ALLAICompleteby_on = Carbon::now()->format('d-M-Y');
                $changeControl->ALLAICompleteby_comment  = $request->comment;
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = 'All AI Completed by Respective Department By     , All AI Completed by Respective Department On';
                $history->action ='All AI Completed by Respective Department';
                // $history->previous = $lastDocument->completed_by;
                if (is_null($lastDocument->ALLAICompleteby_by) || $lastDocument->ALLAICompleteby_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->ALLAICompleteby_by . ' , ' . $lastDocument->ALLAICompleteby_on;
                }
                
                $history->current = $changeControl->ALLAICompleteby_by . ' , ' . $changeControl->ALLAICompleteby_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='All AI Completed by Respective Department';
                $history->change_to= "HOD Final Review";
                $history->change_from= $lastDocument->status;
                if (is_null($lastDocument->ALLAICompleteby_by) || $lastDocument->ALLAICompleteby_by === '') {
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

            if ($changeControl->stage == 6) {
                $changeControl->stage = "7";
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
            

            if ($changeControl->stage == 7) {
                $changeControl->stage = "8";
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

            if ($changeControl->stage == 8) {
                $changeControl->stage = "9";
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

            
            
            if ($changeControl->stage == 3) {
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
                $changeControl->stage = "4";
                $changeControl->status = 'All AI Update by Respective Department';
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
                $history->change_to= "All AI Update by Respective Department";
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

            if ($changeControl->stage == 7) {
                $changeControl->stage = "6";
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

            if ($changeControl->stage == 8) {
                $changeControl->stage = "7";
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
                $history->change_to= "All AI Update by Respective Department";
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
    // Start query for DeviationAuditTrail
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
