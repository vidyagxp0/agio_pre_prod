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

        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Short Description';
        $history->previous = "Null";
        $history->current = $management->short_description;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();

        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Assigned To';
        $history->previous = "Null";
        $history->current = $management->assigned_to;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Date Due';
        $history->previous = "Null";
        $history->current = $management->due_date;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Type';
        $history->previous = "Null";
        $history->current = $management->type;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Scheduled Start Date';
        $history->previous = "Null";
        $history->current = $management->start_date;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Scheduled end date';
        $history->previous = "Null";
        $history->current = $management->end_date;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Attendess';
        $history->previous = "Null";
        $history->current = $management->attendees;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Agenda';
        $history->previous = "Null";
        $history->current = $management->agenda;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();

        
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Performance Evaluation';
        $history->previous = "Null";
        $history->current = $management->performance_evaluation;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();

        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Management Review Participants';
        $history->previous = "Null";
        $history->current = $management->management_review_participants;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();

        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Action Item Details';
        $history->previous = "Null";
        $history->current = $management->action_item_details;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();

        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'CAPA Details';
        $history->previous = "Null";
        $history->current = $management->capa_detail_details;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Description';
        $history->previous = "Null";
        $history->current = $management->description;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Attached Files';
        $history->previous = "Null";
        $history->current = $management->attachment;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Inv Attachment';
        $history->previous = "Null";
        $history->current = $management->inv_attachment;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();
         
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'File Attachment';
        $history->previous = "Null";
        $history->current = $management->file_attchment_if_any;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();
         
        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'File Attachment';
        $history->previous = "Null";
        $history->current = $management->closure_attachments;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();

        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Actual Start Date';
        $history->previous = "Null";
        $history->current = $management->actual_start_date;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();

        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Actual End Date';
        $history->previous = "Null";
        $history->current = $management->actual_end_date;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Meeting minutes';
        $history->previous = "Null";
        $history->current = $management->meeting_minute;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Decisions';
        $history->previous = "Null";
        $history->current = $management->decision;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Zone';
        $history->previous = "Null";
        $history->current = $management->zone;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Country';
        $history->previous = "Null";
        $history->current = $management->country;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'City';
        $history->previous = "Null";
        $history->current = $management->city;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Site Name';
        $history->previous = "Null";
        $history->current = $management->site_name;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Building';
        $history->previous = "Null";
        $history->current = $management->building;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Floor';
        $history->previous = "Null";
        $history->current = $management->floor;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();


        $history = new ManagementAuditTrial();
        $history->ManagementReview_id = $management->id;
        $history->activity_type = 'Room';
        $history->previous = "Null";
        $history->current = $management->room;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $management->status;
        $history->save();




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

         if (!empty($request->inv_attachment)) {
            $files = [];
            if ($request->hasfile('inv_attachment')) {
                foreach ($request->file('inv_attachment') as $file) {
                    $name = $request->name . 'inv_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $management->inv_attachment = json_encode($files);
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
            $history->save();
        }

        if ($lastDocument->assigned_to != $management->assigned_to || !empty($request->assigned_to_comment)) {

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
            $history->save();
        }
        if ($lastDocument->due_date != $management->due_date || !empty($request->due_date_comment)) {

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
            $history->save();
        }
        if ($lastDocument->type != $management->type || !empty($request->type_comment)) {

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
            $history->save();
        }
        if ($lastDocument->start_date != $management->start_date || !empty($request->start_date_comment)) {

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
            $history->save();
        }
        if ($lastDocument->end_date != $management->end_date || !empty($request->end_date_comment)) {

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
            $history->save();
        }
        if ($lastDocument->attendees != $management->attendees || !empty($request->attendees_comment)) {

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
            $history->save();
        }
        if ($lastDocument->agenda != $management->agenda || !empty($request->agenda_comment)) {

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
            $history->save();
        }
        if ($lastDocument->performance_evaluation != $management->performance_evaluation || !empty($request->performance_evaluation_comment)) {

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
            $history->save();
        }
        if ($lastDocument->management_review_participants != $management->management_review_participants || !empty($request->management_review_participants_comment)) {

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
            $history->save();
        }

        if ($lastDocument->action_item_details != $management->action_item_details || !empty($request->action_item_details_comment)) {

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
            $history->save();
        }
        if ($lastDocument->capa_detail_details != $management->capa_detail_details || !empty($request->capa_detail_details_comment)) {

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
            $history->save();
        }
        if ($lastDocument->description != $management->description || !empty($request->description_comment)) {

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
            $history->save();
        }
        if ($lastDocument->attachment != $management->attachment || !empty($request->attachment_comment)) {

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
            $history->save();
        }
        if ($lastDocument->inv_attachment != $management->inv_attachment || !empty($request->inv_attachment_comment)) {

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
            $history->save();
        }
        
        if ($lastDocument->file_attchment_if_any != $management->file_attchment_if_any || !empty($request->file_attchment_if_any_comment)) {

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
            $history->save();
        }
        if ($lastDocument->closure_attachments != $management->closure_attachments || !empty($request->closure_attachments_comment)) {

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
            $history->save();
        }
        if ($lastDocument->actual_start_date != $management->actual_start_date || !empty($request->actual_start_date_comment)) {

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
            $history->save();
        }
        if ($lastDocument->actual_end_date != $management->actual_end_date || !empty($request->actual_end_date_comment)) {

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
            $history->save();
        }
        if ($lastDocument->meeting_minute != $management->meeting_minute || !empty($request->meeting_minute_comment)) {

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
            $history->save();
        }
        if ($lastDocument->decision != $management->decision || !empty($request->decision_comment)) {

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
            $history->save();
        }
        if ($lastDocument->zone != $management->zone || !empty($request->zone_comment)) {

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
            $history->save();
        }
        if ($lastDocument->country != $management->country || !empty($request->country_comment)) {

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
            $history->save();
        }
        if ($lastDocument->city != $management->city || !empty($request->city_comment)) {

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
            $history->save();
        }
        if ($lastDocument->site_name != $management->site_name || !empty($request->site_name_comment)) {

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
            $history->save();
        }
        if ($lastDocument->building != $management->building || !empty($request->building_comment)) {

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
            $history->save();
        }
        if ($lastDocument->floor != $management->floor || !empty($request->floor_comment)) {

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
            $history->save();
        }
        if ($lastDocument->room != $management->room || !empty($request->room_comment)) {

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
        
        $audit = ManagementAuditTrial::where('ManagementReview_id', $id)->orderByDESC('id')->get()->unique('activity_type');
        $today = Carbon::now()->format('d-m-y');
        $document = ManagementReview::where('id', $id)->first();
        $document->originator = User::where('id', $document->initiator_id)->value('name');

        return view('frontend.management-review.audit-trial', compact('audit', 'document', 'today'));
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
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_to)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $agenda = ManagementReviewDocDetails::where('review_id',$data->id)->where('type',"agenda")->first();
        $management_review_participants = ManagementReviewDocDetails::where('review_id',$data->id)->where('type',"management_review_participants")->first();
        $performance_evaluation = ManagementReviewDocDetails::where('review_id',$data->id)->where('type',"performance_evaluation")->first();
        $action_item_details=  ManagementReviewDocDetails::where('review_id',$data->id)->where('type',"action_item_details")->first();
        //dd(unserialize($action_item_details->date_due));
        $capa_detail_details=  ManagementReviewDocDetails::where('review_id',$data->id)->where('type',"capa_detail_details")->first();
        
        return view('frontend.management-review.management_review', compact( 'data','agenda','management_review_participants','performance_evaluation','action_item_details','capa_detail_details' ));
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
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocument->Submited_by;
                $history->current = $changeControl->Submited_by;    
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='Submited';
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
                $changeControl->status = 'Closed - Done';
                $changeControl->completed_by = Auth::user()->name;
                $changeControl->completed_on = Carbon::now()->format('d-M-Y');
                $history = new ManagementAuditTrial();
                $history->ManagementReview_id = $id;
                $history->activity_type = 'Activity Log';
                // $history->previous = $lastDocument->completed_by;
                $history->current = $changeControl->completed_by;    
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='Completed';
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
        $pdf = PDF::loadview('frontend.management-review.report', compact('managementReview'))
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
        $parent_type = "Action-Item";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $parent_record = $record_number;
        $currentDate = Carbon::now();
        $parent_intiation_date = $currentDate;
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $old_record = ManagementReview::select('id', 'division_id', 'record')->get();
        return view('frontend.forms.action-item', compact('parent_intiation_date','parent_initiator_id','parent_record', 'record_number', 'due_date', 'parent_id', 'parent_type','old_record'));
    }

    public static function managementReviewReport($id)
    {
        $managementReview = ManagementReview::find($id);
        
        if (!empty($managementReview)) {
            $managementReview->originator = User::where('id', $managementReview->initiator_id)->value('name');
            $data = ManagementAuditTrial::where('ManagementReview_id', $id)->get();
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.management-review.auditReport', compact('data', 'managementReview'))
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
    }
    
}
