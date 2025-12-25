<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditProgram;
use App\Models\RecordNumber;
use App\Models\RoleGroup;
use App\Models\InternalAudit;
use App\Models\User;
use App\Models\AuditProgramGrid;
use Carbon\Carbon;
use PDF;
use Helpers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\AuditProgramAuditTrial;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class AuditProgramController extends Controller
{

    public function auditprogram()
    {
        // $old_record = AuditProgram::select('id', 'division_id', 'record')->get();
        // $record_number = ((RecordNumber::first()->value('counter')) + 1);
         $old_record = AuditProgram::select('id', 'division_id', 'record')->get();
        $lastAi = AuditProgram::orderBy('record', 'desc')->first();
        $record_number = $lastAi ? $lastAi->record + 1 : 1;
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        return view('frontend.forms.audit-program', compact('due_date', 'record_number', 'old_record'));
    }
    public function create(request $request)
    {
        // return $request;
        // if (!$request->short_description) {
        //     toastr()->info("Short Description is required");
        //     return redirect()->back()->withInput();
        // }
        // if (!$request->country) {
        //     toastr()->info("Country is required");
        //     return redirect()->back()->withInput();
        // }
        // if (!$request->state) {
        //     toastr()->info("State is required");
        //     return redirect()->back()->withInput();
        // }
        // if (!$request->City) {
        //     toastr()->info("City is required");
        //     return redirect()->back()->withInput();
        // }
        $data = new AuditProgram();
        // $data->form_type = "audit-program";
     //   $data->record = ((RecordNumber::first()->value('counter')) + 1);
       $data->record = $request->record;
        $data->record_number = $request->record_number;
        $data->initiator_id = Auth::user()->id;
        $data->division_id = $request->division_id;
        $data->division_code = $request->division_code;
        $data->parent_id = $request->parent_id;
        $data->parent_type = $request->parent_type;
        $data->intiation_date = $request->intiation_date;
        $data->short_description = $request->short_description;
        //  dd($data);

        $data->initiated_through = $request->initiated_through;
        $data->initiated_through_req = $request->initiated_through_req;
        $data->repeat = $request->repeat;
        $data->repeat_nature = $request->repeat_nature;
        $data->due_date_extension = $request->due_date_extension;


        $data->Initiator_Group = $request->Initiator_Group;
        $data->initiator_group_code = $request->initiator_group_code;
        $data->assign_to = $request->assign_to;
        $data->due_date = $request->due_date;
        $data->type = $request->type;
        $data->year = $request->year;
        $data->through_req = $request->through_req;
        $data->Months = $request->Months;
        $data->Quarter = $request->Quarter;
        $data->description = $request->description;
        $data->comments = $request->comments;
        $data->related_url = $request->related_url;
        $data->url_description = $request->url_description;
        //$data->suggested_audits = $request->suggested_audits;
        $data->zone = $request->zone;
        $data->country = $request->country;
        $data->City = $request->City;
        $data->state = $request->state;
        $data->severity1_level = $request->severity1_level;
        $data->hod_comment = $request->hod_comment;
        $data->assign_to_department = $request->assign_to_department;
        $data->yearly_other = $request->yearly_other;
        if (!empty($request->hod_attached_File)) {
            $files = [];
            if ($request->hasfile('hod_attached_File')) {
                foreach ($request->file('hod_attached_File') as $file) {
                    $name = $request->name . 'hod_attached_File' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->hod_attached_File = json_encode($files);
        }
        $data->cqa_qa_comment = $request->cqa_qa_comment;
        $data->cqa_qa_review_comment = $request->cqa_qa_review_comment;

        // $data->cqa_qa_Attached_File = $request->cqa_qa_Attached_File;

        if (!empty($request->cqa_qa_review_Attached_File)) {
            $files = [];
            if ($request->hasfile('cqa_qa_review_Attached_File')) {
                foreach ($request->file('cqa_qa_review_Attached_File') as $file) {
                    $name = $request->name . 'cqa_qa_review_Attached_File' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->cqa_qa_review_Attached_File = json_encode($files);
        }


        if (!empty($request->cqa_qa_Attached_File)) {
            $files = [];
            if ($request->hasfile('cqa_qa_Attached_File')) {
                foreach ($request->file('cqa_qa_Attached_File') as $file) {
                    $name = $request->name . 'cqa_qa_Attached_File' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->cqa_qa_Attached_File = json_encode($files);
        }
        $data->comment = $request->comment;
        
        

        $data->status = 'Opened';
        $data->stage = 1;

            if (!empty($request->Attached_File)) {
            $files = [];
            if ($request->hasfile('Attached_File')) {
                foreach ($request->file('Attached_File') as $file) {
                    $name = $request->name . 'Attached_File' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->Attached_File = json_encode($files);
        }

        if (!empty($request->attachments)) {
            $files = [];
            if ($request->hasfile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $name = $request->name . '-attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->attachments = json_encode($files);
        }
        $data->save();

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();



        if (!empty($data->record)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Record Number';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName(session()->get('division')) . "/AP/" . Helpers::year($data->created_at) . "/" . str_pad($data->record, 4, '0', STR_PAD_LEFT);;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }


        if (!empty($data->division_code)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Site/Location Code';
            $history->previous = "Null";
            $history->current = $data->division_code;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }


        if (!empty($data->initiator_id)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($data->initiator_id);
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }


        if (!empty($data->intiation_date)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($data->intiation_date);
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }



        if (!empty($data->short_description)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $data->short_description;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
            if (!empty($data->severity1_level)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Severity Level';
            $history->previous = "Null";
            $history->current = $data->severity1_level;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
          if (!empty($data->initiated_through)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Initiated Through';
            $history->previous = "Null";
            $history->current = $data->initiated_through;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
         if (!empty($data->initiated_through_req)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Others';
            $history->previous = "Null";
            $history->current = $data->initiated_through_req;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }



        if (!empty($data->assign_to)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Assigned to';
            $history->previous = "Null";
            $history->current = $data->assign_to;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($data->due_date)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Date Due';
            $history->previous = "Null";
            $history->current = $data->due_date;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($data->type)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Type';
            $history->previous = "Null";
            $history->current = $data->type;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($data->year)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Initiated through';
            $history->previous = "Null";
            $history->current = $data->year;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($data->Quarter)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Quarter';
            $history->previous = "Null";
            $history->current = $data->Quarter;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($data->description)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Description';
            $history->previous = "Null";
            $history->current = $data->description;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($data->comments)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Comments';
            $history->previous = "Null";
            $history->current = $data->comments;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        
        if (!empty($data->related_url)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Related URl';
            $history->previous = "Null";
            $history->current = $data->related_url;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        if (!empty($data->url_description)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = ' URl,s Description';
            $history->previous = "Null";
            $history->current = $data->url_description;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($data->Initiator_Group)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Initiator Department';
            $history->previous = "Null";
            $history->current = $data->Initiator_Group;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
         if (!empty($data->initiator_group_code)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Initiator Department code';
            $history->previous = "Null";
            $history->current = $data->initiator_group_code;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        if (!empty($data->zone)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Zone';
            $history->previous = "Null";
            $history->current = $data->zone;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($data->country)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Country';
            $history->previous = "Null";
            $history->current = $data->country;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($data->City)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'City';
            $history->previous = "Null";
            $history->current = $data->City;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($data->state)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'State/District';
            $history->previous = "Null";
            $history->current = $data->state;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($data->attachments)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Attached Files';
            $history->previous = "Null";
            $history->current = $data->attachments;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        
        if (!empty($data->assign_to_department)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Assigned To Department';
            $history->previous = "Null";
            $history->current = $data->assign_to_department;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        
        if (!empty($data->year)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Yearly Planner';
            $history->previous = "Null";
            $history->current = $data->year;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        
        if (!empty($data->yearly_other)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Initiated through(Other)';
            $history->previous = "Null";
            $history->current = $data->yearly_other;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        
        if (!empty($data->comment)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Comments';
            $history->previous = "Null";
            $history->current = $data->comment;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        
        if (!empty($data->hod_attached_File)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'HOD/Designee Review Attached Files';
            $history->previous = "Null";
            $history->current = $data->hod_attached_File;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        if (!empty($data->hod_comment)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'HOD/Designee Review Comments';
            $history->previous = "Null";
            $history->current = $data->hod_comment;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        
        if (!empty($data->cqa_qa_comment)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'CQA/QA Approval Comments';
            $history->previous = "Null";
            $history->current = $data->cqa_qa_comment;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($data->cqa_qa_review_comment)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'CQA/QA Review Comment';
            $history->previous = "Null";
            $history->current = $data->cqa_qa_review_comment;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }

        if (!empty($data->cqa_qa_review_Attached_File)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'CQA/QA Review Attachment';
            $history->previous = "Null";
            $history->current = $data->cqa_qa_review_Attached_File;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        
        if (!empty($data->cqa_qa_Attached_File)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'CQA/QA Attached Files';
            $history->previous = "Null";
            $history->current = $data->cqa_qa_Attached_File;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
        
          if (!empty($data->due_date_extension)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Due Date Extension Justification';
            $history->previous = "Null";
            $history->current = $data->due_date_extension;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
            if (!empty($data->Attached_File)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'File Attachment';
            $history->previous = "Null";
            $history->current = $data->Attached_File;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
        }
          if (!empty($data->comment)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Comment';
            $history->previous = "Null";
            $history->current = $data->comment;
            $history->comment ="Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
          
        }
        if (!empty($data->Months)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Months';
            $history->previous = "Null";
            $history->current = $data->Months;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
          
        }
        if (!empty($data->through_req)) {
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'type(Others)';
            $history->previous = "Null";
            $history->current = $data->through_req;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
             $history->change_to= "Opened";
            $history->change_from= "Initiation";
            $history->action_name="Create";
            $history->save();
          
        }


        $audit_program_id = $data->id;
        $newDataMeetingManagement = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'audit_program' ])->firstOrCreate();
        $newDataMeetingManagement->ci_id = $audit_program_id;
        $newDataMeetingManagement->identifier = 'audit_program';
        $newDataMeetingManagement->data = $request->audit_program;
        $newDataMeetingManagement->save();

//-----------------------Audit Program Grid Data sgowing in audit trail --------------------------

        $audit_program_id = $data->id;

        if (!empty($request->audit_program)) {
            // Save the new auditor data
            $newDataMeetingManagement = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'audit_program'])->firstOrNew();
            $newDataMeetingManagement->ci_id = $audit_program_id;
            $newDataMeetingManagement->identifier = 'audit_program';
            $newDataMeetingManagement->data = $request->audit_program;
            $newDataMeetingManagement->save();

            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                'Auditees' => 'Auditees',
                'Due_Date' => 'Date Start',
                'End_date' => 'Date End',
                'Lead_Investigator' => 'Lead Auditor',
                'Comment' => 'Comment',
            ];

            // Track audit trail changes (creation of new data)
            if (is_array($request->audit_program)) {
                $index = 1; // Initialize a counter to ensure correct sequence
                foreach ($request->audit_program as $newAuditor) {
                    // Track changes for each field
                    $fieldsToTrack = ['Auditees', 'Due_Date', 'End_date', 'Lead_Investigator', 'Comment'];
                    foreach ($fieldsToTrack as $field) {
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's new data
                        if ($newValue !== 'Null') {
                            // Log the creation of the new data in the audit trail
                            $auditTrail = new AuditProgramAuditTrial;
                            $auditTrail->AuditProgram_id = $data->id;
                            $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . $index . ' )';
                            $auditTrail->previous = 'Null'; // Since it's new data, there's no previous value
                            $auditTrail->current = $newValue;
                            $auditTrail->comment = "";
                            $auditTrail->user_id = Auth::user()->id;
                            $auditTrail->user_name = Auth::user()->name;
                            $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $auditTrail->origin_state = $data->status;
                            $auditTrail->change_to = "Not Applicable";
                            $auditTrail->change_from = $data->status;
                            $auditTrail->action_name = 'Create'; // Since this is a create operation
                            $auditTrail->save();
                        }
                    }
                    $index++; // Increment the counter after each new auditor entry
                }
            }
        }



//-----------------------------------------------------------------------------

        $audit_program_id = $data->id;
        $newDataMeetingManagement = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'Self_Inspection' ])->firstOrCreate();
        $newDataMeetingManagement->ci_id = $audit_program_id;
        $newDataMeetingManagement->identifier = 'Self_Inspection';
        $newDataMeetingManagement->data = $request->Self_Inspection;
        // // $history->change_to= "Opened";
        // // $history->change_from= "Initiator";
        // // $history->action_name="Create";
        $newDataMeetingManagement->save();


        //---------------------------------------------------------------------------------------------------

        // $audit_program_id = $data->id;

        // if (!empty($request->Self_Inspection)) {
        //     // Save the new auditor data
        //     $newDataMeetingManagement = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'Self_Inspection' ])->firstOrCreate();
        //     $newDataMeetingManagement->ci_id = $audit_program_id;
        //     $newDataMeetingManagement->identifier = 'Self_Inspection';
        //     $newDataMeetingManagement->data = $request->Self_Inspection;
        //     $newDataMeetingManagement->save();

        //     // Define the mapping of field keys to more descriptive names
        //     $fieldNames = [
        //         'department' => 'Department',
        //         'Months' => 'Months',
        //         'Remarked' => 'Remarks',
        //     ];

        //     // Track audit trail changes (creation of new data)
        //     if (is_array($request->Self_Inspection)) {
        //         $index = 1; // Initialize a counter to ensure correct sequence
        //         foreach ($request->Self_Inspection as $newAuditor) {
        //             // Track changes for each field
        //             $fieldsToTrack = ['department', 'Months', 'Remarked'];
        //             foreach ($fieldsToTrack as $field) {
        //                 $newValue = $newAuditor[$field] ?? 'Null';

        //                 // Only proceed if there's new data
        //                 if ($newValue !== 'Null') {
        //                     // Log the creation of the new data in the audit trail
        //                     $auditTrail = new AuditProgramAuditTrial;
        //                     $auditTrail->AuditProgram_id = $data->id;
        //                     $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . $index . ' )';
        //                     $auditTrail->previous = 'Null'; // Since it's new data, there's no previous value
        //                     $auditTrail->current = $newValue;
        //                     $auditTrail->comment = "";
        //                     $auditTrail->user_id = Auth::user()->id;
        //                     $auditTrail->user_name = Auth::user()->name;
        //                     $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //                     $auditTrail->origin_state = $data->status;
        //                     $auditTrail->change_to = "Not Applicable";
        //                     $auditTrail->change_from = $data->status;
        //                     $auditTrail->action_name = 'Create'; // Since this is a create operation
        //                     $auditTrail->save();
        //                 }
        //             }
        //             $index++; // Increment the counter after each new auditor entry
        //         }
        //     }
        // }

        //---------------------------------------------------------------------------------------------------

        $audit_program_id = $data->id;
        $newDataMeetingManagement = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'Self_Inspection_circular' ])->firstOrCreate();
        $newDataMeetingManagement->ci_id = $audit_program_id;
        $newDataMeetingManagement->identifier = 'Self_Inspection_circular';
        $newDataMeetingManagement->data = $request->Self_Inspection_circular;
        // $history->change_to= "Opened";
        // $history->change_from= "Initiator";
        // $history->action_name="Create";
        $newDataMeetingManagement->save();

        // --------------------------------------------------------------------------------------------------------------------------

        // $id_audit = $data->id;

        // if (!empty($request->Self_Inspection_circular)) {
        //     $newDataMeetingManagement = AuditProgramGrid::where(['ci_id' => $id_audit   , 'identifier' => 'Self_Inspection_circular' ])->firstOrCreate();
        //     $newDataMeetingManagement->ci_id = $id_audit    ;
        //     $newDataMeetingManagement->identifier = 'Self_Inspection_circular';
        //     $newDataMeetingManagement->data = $request->Self_Inspection_circular;
        //     $newDataMeetingManagement->save();

        //     $fieldNames = [
        //         'departments' => 'Department',
        //         'info_mfg_date' => 'Audit Date',
        //         'Auditor' => 'Name of Auditors',
        //     ];
        //     if (is_array($request->Self_Inspection_circular)) {
        //         $index = 1;
        //         foreach ($request->Self_Inspection_circular as $newAuditor) {
        //             $fieldsToTrack = ['departments', 'info_mfg_date', 'Auditor'];
        //             foreach ($fieldsToTrack as $field) {
        //                 $newValue = $newAuditor[$field] ?? 'Null';

        //                 if ($newValue !== 'Null') {
        //                     $auditTrail = new AuditProgramAuditTrial;
        //                     $auditTrail->AuditProgram_id = $data->id;
        //                     $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . $index . ' )';
        //                     $auditTrail->previous = 'Null'; 
        //                     $auditTrail->current = $newValue;
        //                     $auditTrail->comment = "";
        //                     $auditTrail->user_id = Auth::user()->id;
        //                     $auditTrail->user_name = Auth::user()->name;
        //                     $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //                     $auditTrail->origin_state = $data->status;
        //                     $auditTrail->change_to = "Not Applicable";
        //                     $auditTrail->change_from = $data->status;
        //                     $auditTrail->action_name = 'Create'; 
        //                     $auditTrail->save();
        //                 }
        //             }
        //             $index++; 
        //         }
        //     }
        // }

        // ------------------------------------------------------------------------------------------------------------------------------

        toastr()->success('Record is created Successfully');

        return redirect('rcms/qms-dashboard');
    }

    public function UpdateAuditProgram(request $request, $id)
    {


        if (!$request->short_description) {
            toastr()->info("Short Description is required");
            return redirect()->back()->withInput();
        }
        $lastDocument = AuditProgram::find($id);
        $data = AuditProgram::find($id);
        // $data->record = ((RecordNumber::first()->value('counter')) + 1);
        $data->initiator_id = Auth::user()->id;
        $data->short_description = $request->short_description;

        $data->initiated_through = $request->initiated_through;
        $data->initiated_through_req = $request->initiated_through_req;
        $data->repeat = $request->repeat;
        $data->repeat_nature = $request->repeat_nature;
        $data->due_date_extension = $request->due_date_extension;

        $data->assign_to = $request->assign_to;
        $data->due_date = $request->due_date;
        $data->Initiator_Group = $request->Initiator_Group;
        $data->initiator_group_code = $request->initiator_group_code;
        $data->type = $request->type;
        $data->year = $request->year;
        $data->through_req = $request->through_req;
        $data->Months = $request->Months;
        $data->Quarter = $request->Quarter;
        $data->description = $request->description; 
        $data->comments = $request->comments;
        $data->related_url = $request->related_url;
        $data->url_description = $request->url_description;
        //$data->suggested_audits = $request->suggested_audits;
        $data->zone = $request->zone;
        $data->country = $request->country;
        $data->City = $request->City;
        $data->state = $request->state;
        $data->severity1_level = $request->severity1_level;
        $data->comment = $request->comment;
        $data->hod_comment = $request->hod_comment;
        // $data->hod_attached_File = $request->hod_attached_File;        
        $data->assign_to_department = $request->assign_to_department;
        $data->yearly_other = $request->yearly_other;
        if (!empty($request->hod_attached_File)) {
            $files = [];
            if ($request->hasfile('hod_attached_File')) {
                foreach ($request->file('hod_attached_File') as $file) {
                    $name = $request->name . 'hod_attached_File' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->hod_attached_File = json_encode($files);
        }
        $data->cqa_qa_comment = $request->cqa_qa_comment;
        $data->cqa_qa_review_comment = $request->cqa_qa_review_comment;

        // $data->cqa_qa_Attached_File = $request->cqa_qa_Attached_File;
        if (!empty($request->cqa_qa_Attached_File)) {
            $files = [];
            if ($request->hasfile('cqa_qa_Attached_File')) {
                foreach ($request->file('cqa_qa_Attached_File') as $file) {
                    $name = $request->name . 'cqa_qa_Attached_File' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->cqa_qa_Attached_File = json_encode($files);
        }

        // $data->cqa_qa_Attached_File = $request->cqa_qa_Attached_File;
        if (!empty($request->cqa_qa_review_Attached_File)) {
            $files = [];
            if ($request->hasfile('cqa_qa_review_Attached_File')) {
                foreach ($request->file('cqa_qa_review_Attached_File') as $file) {
                    $name = $request->name . 'cqa_qa_review_Attached_File' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->cqa_qa_review_Attached_File = json_encode($files);
        }

        
            if (!empty($request->Attached_File)) {
            $files = [];
            if ($request->hasfile('Attached_File')) {
                foreach ($request->file('Attached_File') as $file) {
                    $name = $request->name . 'Attached_File' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->Attached_File = json_encode($files);
        }
        if (!empty($request->attachments)) {
            $files = [];
            if ($request->hasfile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $name = $request->name . 'attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->attachments = json_encode($files);
        }
        $data->update();

        // ------------------------------
        // $data1 = AuditProgramGrid::where('audit_program_id', $data->id)->first();
        // $data1->delete();
        // $data1 = new AuditProgramGrid();
        // $data1->audit_program_id = $data->id;

        // if (!empty($request->serial_number)) {
        //     $data1->serial_number = serialize($request->serial_number);
        // }
        // if (!empty($request->Auditees)) {
        //     $data1->auditor = serialize($request->Auditees);
        // }
        // if (!empty($request->start_date)) {
        //     $data1->start_date = serialize($request->start_date);
        // }
        // if (!empty($request->end_date)) {
        //     $data1->end_date = serialize($request->end_date);
        // }
        // if (!empty($request->lead_investigator)) {
        //     $data1->lead_investigator = serialize($request->lead_investigator);
        // }
       
        // if (!empty($request->comment)) {
        //     $data1->comment = serialize($request->comment);
        // }
        // $data1->save();

        // --------------------

          if($lastDocument->short_description !=$data->short_description || !empty($request->short_description_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Short Description')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Short Description';
            $history->previous =  $lastDocument->short_description;
            $history->current = $data->short_description;
            $history->comment = $request->short_description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
          if($lastDocument->severity1_level !=$data->severity1_level || !empty($request->severity1_level_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Severity level')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Severity level';
            $history->previous =  $lastDocument->severity1_level;
            $history->current = $data->severity1_level;
            $history->comment = $request->severity1_level_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
          if($lastDocument->initiated_through !=$data->initiated_through || !empty($request->initiated_through_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Initiated Through')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Initiated Through';
            $history->previous =  $lastDocument->initiated_through;
            $history->current = $data->initiated_through;
            $history->comment = $request->initiated_through_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if($lastDocument->initiated_through_req !=$data->initiated_through_req || !empty($request->initiated_through_req_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Others')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Others';
            $history->previous =  $lastDocument->initiated_through_req;
            $history->current = $data->initiated_through_req;
            $history->comment = $request->initiated_through_req_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
         if($lastDocument->assign_to !=$data->assign_to || !empty($request->assign_to_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Assigned to')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Assigned to';
            $history->previous =  $lastDocument->assign_to;
            $history->current = $data->assign_to;
            $history->comment = $request->assign_to_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
          if($lastDocument->due_date !=$data->due_date || !empty($request->due_date_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Date Due')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Date Due';
            $history->previous =  $lastDocument->due_date;
            $history->current = $data->due_date;
            $history->comment = $request->due_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
          if($lastDocument->type !=$data->type || !empty($request->type_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Type')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Type';
            $history->previous =  $lastDocument->type;
            $history->current = $data->type;
            $history->comment = $request->type_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
      if($lastDocument->year !=$data->year || !empty($request->year_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Initiated Through')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Initiated Through';
            $history->previous =  $lastDocument->year;
            $history->current = $data->year;
            $history->comment = $request->year_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
         if($lastDocument->Quarter !=$data->Quarter || !empty($request->Quarter_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Quarter')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Quarter';
            $history->previous =  $lastDocument->Quarter;
            $history->current = $data->Quarter;
            $history->comment = $request->Quarter_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
         if($lastDocument->description !=$data->description || !empty($request->description_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Description')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Description';
            $history->previous =  $lastDocument->description;
            $history->current = $data->description;
            $history->comment = $request->description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
         if($lastDocument->comments !=$data->comments || !empty($request->comments_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Comments')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Comments';
            $history->previous =  $lastDocument->comments;
            $history->current = $data->comments;
            $history->comment = $request->comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if($lastDocument->hod_comment !=$data->hod_comment || !empty($request->comments_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'HOD/Designee Review Comments')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'HOD/Designee Review Comments';
            $history->previous =  $lastDocument->hod_comment;
            $history->current = $data->hod_comment;
            $history->comment = $request->comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if($lastDocument->year !=$data->year || !empty($request->comments_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Initiated through')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Initiated through';
            $history->previous =  $lastDocument->year;
            $history->current = $data->year;
            $history->comment = $request->comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        // if($lastDocument->through_req !=$data->through_req || !empty($request->comments_comment)) {
        //     $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
        //                     ->where('activity_type', 'Type(Others)')
        //                     ->exists();
        //     $history = new AuditProgramAuditTrial();
        //     $history->AuditProgram_id = $data->id;
        //     $history->activity_type = 'Type(Others)';
        //     $history->previous =  $lastDocument->through_req;
        //     $history->current = $data->through_req;
        //     $history->comment = $request->comments_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state= $lastDocument->status;
        //     $history->change_to= "Not Applicable";
        //     $history->change_from= $lastDocument->status;
        //     $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
        //     $history->save();
        // }        
        
        if($lastDocument->yearly_other !=$data->yearly_other || !empty($request->comments_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Initiated Through(Others)')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Initiated Through(Others)';
            $history->previous =  $lastDocument->yearly_other;
            $history->current = $data->yearly_other;
            $history->comment = $request->comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
                
        if($lastDocument->Attached_File !=$data->Attached_File || !empty($request->comments_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Attached Files')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Attached Files';
            $history->previous =  $lastDocument->Attached_File;
            $history->current = $data->Attached_File;
            $history->comment = $request->comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
                
        if($lastDocument->hod_attached_File !=$data->hod_attached_File || !empty($request->comments_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'HOD/Designee Review Attached Files')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'HOD/Designee Review Attached Files';
            $history->previous =  $lastDocument->hod_attached_File;
            $history->current = $data->hod_attached_File;
            $history->comment = $request->comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        if($lastDocument->cqa_qa_comment !=$data->cqa_qa_comment || !empty($request->comments_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'CQA/QA Approval Comments')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'CQA/QA Approval Comments';
            $history->previous =  $lastDocument->cqa_qa_comment;
            $history->current = $data->cqa_qa_comment;
            $history->comment = $request->comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }

        if($lastDocument->cqa_qa_review_comment !=$data->cqa_qa_review_comment || !empty($request->comments_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'CQA/QA Review Comment')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'CQA/QA Review Comment';
            $history->previous =  $lastDocument->cqa_qa_review_comment;
            $history->current = $data->cqa_qa_review_comment;
            $history->comment = $request->comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }

        if($lastDocument->cqa_qa_Attached_File !=$data->cqa_qa_Attached_File || !empty($request->comments_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'CQA/QA Attached Files')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'CQA/QA Attached Files';
            $history->previous =  $lastDocument->cqa_qa_Attached_File;
            $history->current = $data->cqa_qa_Attached_File;
            $history->comment = $request->comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }

        if($lastDocument->cqa_qa_review_Attached_File !=$data->cqa_qa_review_Attached_File || !empty($request->comments_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'CQA/QA Review Attachment')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'CQA/QA Review Attachment';
            $history->previous =  $lastDocument->cqa_qa_review_Attached_File;
            $history->current = $data->cqa_qa_review_Attached_File;
            $history->comment = $request->comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }


        if($lastDocument->assign_to_department !=$data->assign_to_department || !empty($request->comments_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Assigned To Department')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Assigned To Department';
            $history->previous =  $lastDocument->assign_to_department;
            $history->current = $data->assign_to_department;
            $history->comment = $request->comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        // if($lastDocument->yearly_other !=$data->yearly_other || !empty($request->comments_comment)) {
        //     $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
        //                     ->where('activity_type', 'Initiated through(Others)')
        //                     ->exists();
        //     $history = new AuditProgramAuditTrial();
        //     $history->AuditProgram_id = $data->id;
        //     $history->activity_type = 'Initiated through(Others)';
        //     $history->previous =  $lastDocument->yearly_other;
        //     $history->current = $data->yearly_other;
        //     $history->comment = $request->comments_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state= $lastDocument->status;
        //     $history->change_to= "Not Applicable";
        //     $history->change_from= $lastDocument->status;
        //     $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
        //     $history->save();
        // }
         if($lastDocument->related_url !=$data->related_url || !empty($request->related_url_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Related Url')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Related Url';
            $history->previous =  $lastDocument->related_url;
            $history->current = $data->related_url;
            $history->comment = $request->related_url_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
    
      if($lastDocument->url_description !=$data->url_description || !empty($request->url_description_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Url Description')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Url Description';
            $history->previous =  $lastDocument->url_description;
            $history->current = $data->url_description;
            $history->comment = $request->url_description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
       if($lastDocument->Initiator_Group !=$data->Initiator_Group || !empty($request->Initiator_Group_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Initiator Department')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Initiator Department';
            $history->previous =  $lastDocument->Initiator_Group;
            $history->current = $data->Initiator_Group;
            $history->comment = $request->Initiator_Group_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
           if($lastDocument->initiator_group_code !=$data->initiator_group_code || !empty($request->initiator_group_code_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Department code')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Initiator Department code';
            $history->previous =  $lastDocument->initiator_group_code;
            $history->current = $data->initiator_group_code;
            $history->comment = $request->initiator_group_code_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
      if($lastDocument->zone !=$data->zone || !empty($request->zone_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Zone')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Zone';
            $history->previous =  $lastDocument->zone;
            $history->current = $data->zone;
            $history->comment = $request->zone_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
         if($lastDocument->country !=$data->country || !empty($request->country_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Country')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Country';
            $history->previous =  $lastDocument->country;
            $history->current = $data->country;
            $history->comment = $request->country_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
         if($lastDocument->City !=$data->City || !empty($request->City_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'City')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'City';
            $history->previous =  $lastDocument->City;
            $history->current = $data->City;
            $history->comment = $request->City_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
       if($lastDocument->state !=$data->state || !empty($request->state_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'State')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'State';
            $history->previous =  $lastDocument->state;
            $history->current = $data->state;
            $history->comment = $request->state_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
         if($lastDocument->attachments !=$data->attachments || !empty($request->attachments_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Attached Files')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Attached Files';
            $history->previous =  $lastDocument->attachments;
            $history->current = $data->attachments;
            $history->comment = $request->attachments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
          if($lastDocument->due_date_extension !=$data->due_date_extension || !empty($request->due_date_extension_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Due Date Extension Justification')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Due Date Extension Justification';
            $history->previous =  $lastDocument->due_date_extension;
            $history->current = $data->due_date_extension;
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
        //   if($lastDocument->Attached_File !=$data->Attached_File || !empty($request->Attached_File_comment)) {
        //     $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
        //                     ->where('activity_type', 'File Attachment')
        //                     ->exists();
        //     $history = new AuditProgramAuditTrial();
        //     $history->AuditProgram_id = $data->id;
        //     $history->activity_type = 'File Attachment';
        //     $history->previous =  $lastDocument->Attached_File;
        //     $history->current = $data->Attached_File;
        //     $history->comment = $request->Attached_File_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state= $lastDocument->status;
        //     $history->change_to= "Not Applicable";
        //     $history->change_from= $lastDocument->status;
        //     $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
        //     $history->save();
        // }
         if($lastDocument->comment !=$data->comment || !empty($request->comment_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Comments')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Comments';
            $history->previous =  $lastDocument->comment;
            $history->current = $data->comment;
            $history->comment = $request->comment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
         if($lastDocument->Months !=$data->Months || !empty($request->Months_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Months')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Months';
            $history->previous =  $lastDocument->Months;
            $history->current = $data->Months;
            $history->comment = $request->Months_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
         if($lastDocument->through_req !=$data->through_req || !empty($request->through_req_comment)) {
            $lastDocumentAuditTrail = AuditProgramAuditTrial::where('AuditProgram_id', $data->id)
                            ->where('activity_type', 'Type(Others)')
                            ->exists();
            $history = new AuditProgramAuditTrial();
            $history->AuditProgram_id = $data->id;
            $history->activity_type = 'Type(Others)';
            $history->previous =  $lastDocument->through_req;
            $history->current = $data->through_req;
            $history->comment = $request->through_req_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state= $lastDocument->status;
            $history->change_to= "Not Applicable";
            $history->change_from= $lastDocument->status;
            $history->action_name=$lastDocumentAuditTrail ? "Update" : "New"; 
            $history->save();
        }
        
        $audit_program_id = $data->id;
        $newDataMeetingManagement = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'audit_program' ])->firstOrCreate();
        $newDataMeetingManagement->ci_id = $audit_program_id;
        $newDataMeetingManagement->identifier = 'audit_program';
        $newDataMeetingManagement->data = $request->audit_program;
        $newDataMeetingManagement->save();
        // $history->change_to= "Opened";
        // $history->change_from= "Initiator";
        // $history->action_name="Create";


        //---------------------update code fo the audit program grid ---------------------

//         $audit_program_id = $data->id;

// if (!empty($request->audit_program)) {
//     // Fetch existing auditor data
//     $existingAuditorShow = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'audit_program'])->first();
//     $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

//     $newDataMeetingManagement = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'audit_program'])->firstOrNew();
//     $newDataMeetingManagement->ci_id = $audit_program_id;
//     $newDataMeetingManagement->identifier = 'audit_program';
//     $newDataMeetingManagement->data = $request->audit_program;

//     $newDataMeetingManagement->update();

//     // Define the mapping of field keys to more descriptive names
//     $fieldNames = [
//         'Auditees' => 'Auditees',
//         'Due_Date' => 'Date Start',
//         'End_date' => 'Date End',
//         'Lead_Investigator' => 'Lead Investigator',
//         'Comment' => 'Comment',
//     ];

//     // Track audit trail changes
//     if (is_array($request->audit_program)) {
//         $entryCounter = 1; // Start a controlled index counter

//         foreach ($request->audit_program as $newAuditor) {
//             $previousAuditor = $existingAuditorData[$entryCounter - 1] ?? [];

//             // Track changes for each field
//             $fieldsToTrack = ['Auditees', 'Due_Date', 'End_date', 'Lead_Investigator', 'Comment'];
//             foreach ($fieldsToTrack as $field) {
//                 $oldValue = $previousAuditor[$field] ?? 'Null';
//                 $newValue = $newAuditor[$field] ?? 'Null';

//                 // Only proceed if there's a change or the data is new
//                 if ($oldValue !== $newValue) {
//                     // Check if this specific change has already been logged in the audit trail
//                     $existingAuditTrail = AuditProgramAuditTrial::where([
//                         ['AuditProgram_id', '=', $data->id],
//                         ['activity_type', '=', $fieldNames[$field] . ' ( ' . $entryCounter . ' )'],
//                         ['previous', '=', $oldValue],
//                         ['current', '=', $newValue]
//                     ])->first();

//                     // Determine if the data is new or updated
//                     $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

//                     // If no existing audit trail record, log the change
//                     if (!$existingAuditTrail) {
//                         $auditTrail = new AuditProgramAuditTrial;
//                         $auditTrail->AuditProgram_id = $data->id;
//                         $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . $entryCounter . ' )';
//                         $auditTrail->previous = $oldValue;
//                         $auditTrail->current = $newValue;
//                         $auditTrail->comment = "";
//                         $auditTrail->user_id = Auth::user()->id;
//                         $auditTrail->user_name = Auth::user()->name;
//                         $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
//                         $auditTrail->origin_state = $data->status;
//                         $auditTrail->change_to = "Not Applicable";
//                         $auditTrail->change_from = $data->status;
//                         $auditTrail->action_name = $actionName;
//                         $auditTrail->save();
//                     }
//                 }
//             }
//             $entryCounter++; // Increment the controlled index after processing each entry
//         }
//     }
// }


        //---------------------------------------------------------------------------------
    
        $audit_program_id = $data->id;
        $newDataMeetingManagement->save();   
        $newDataMeetingManagement = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'Self_Inspection' ])->firstOrCreate();
        $newDataMeetingManagement->ci_id = $audit_program_id;
        $newDataMeetingManagement->identifier = 'Self_Inspection';
        $newDataMeetingManagement->data = $request->Self_Inspection;
        $newDataMeetingManagement->save();
        // $history->change_to= "Opened";
        // $history->change_from= "Initiator";
        // $history->action_name="Create";

        //---------------------------------------------------------------------------------------------------------------------

        // $audit_program_id = $data->id;

        // if (!empty($request->Self_Inspection)) {
        //     // Fetch existing auditor data
        //     $existingAuditorShow = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'Self_Inspection'])->first();
        //     $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

        //     $newDataMeetingManagement = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'Self_Inspection' ])->firstOrCreate();
        //     $newDataMeetingManagement->ci_id = $audit_program_id;
        //     $newDataMeetingManagement->identifier = 'Self_Inspection';
        //     $newDataMeetingManagement->data = $request->Self_Inspection;
        //     //  dd( $newDataMeetingManagement->data);

        //     $newDataMeetingManagement->update();
        //     //dd($product);
        //     // Define the mapping of field keys to more descriptive names
        //     $fieldNames = [
        //         'department' => 'Department',
        //         'Months' => 'Months',
        //         'Remarked' => 'Remarks',
        //     ];

        //     // Track audit trail changes
        //     if (is_array($request->Self_Inspection)) {
        //         foreach ($request->Self_Inspection as $index => $newAuditor) {
        //             $previousAuditor = $existingAuditorData[$index] ?? [];

        //             // Track changes for each field
        //             $fieldsToTrack = ['department', 'Months', 'Remarked'];
        //             foreach ($fieldsToTrack as $field) {
        //                 $oldValue = $previousAuditor[$field] ?? 'Null';
        //                 $newValue = $newAuditor[$field] ?? 'Null';

        //                 // Only proceed if there's a change or the data is new
        //                 if ($oldValue !== $newValue) {
        //                     // Check if this specific change has already been logged in the audit trail
        //                     $existingAuditTrail = AuditProgramAuditTrial::where([
        //                         ['AuditProgram_id', '=', $data->id],
        //                         ['activity_type', '=', $fieldNames[$field] . ' ( ' . ($index + 1) . ')'],
        //                         ['previous', '=', $oldValue],
        //                         ['current', '=', $newValue]
        //                     ])->first();

        //                     // Determine if the data is new or updated
        //                     // $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

        //                     // If no existing audit trail record, log the change
        //                     if (!$existingAuditTrail) {
        //                         $auditTrail = new AuditProgramAuditTrial;
        //                         $auditTrail->AuditProgram_id = $data->id;
        //                         $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
        //                         $auditTrail->previous = $oldValue;
        //                         $auditTrail->current = $newValue;
        //                         $auditTrail->comment = "";
        //                         $auditTrail->user_id = Auth::user()->id;
        //                         $auditTrail->user_name = Auth::user()->name;
        //                         $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //                         $auditTrail->origin_state = $data->status;
        //                         $auditTrail->change_to = "Not Applicable";
        //                         $auditTrail->change_from = $data->status;
        //                         $auditTrail->action_name = "Update"; // Set action to New or Update
        //                         $auditTrail->save();
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }

        //---------------------------------------------------------------------------------------------------------------------

        //  $audit_program_id = $data->id;
        // $newDataMeetingManagement = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'Self_Inspection' ])->firstOrCreate();
        // $newDataMeetingManagement->ci_id = $audit_program_id;
        // $newDataMeetingManagement->identifier = 'Self_Inspection';
        // $newDataMeetingManagement->data = $request->Self_Inspection;
        // // $history->change_to= "Opened";
        // // $history->change_from= "Initiator";
        // // $history->action_name="Create";
    
        // $newDataMeetingManagement->save();

        $audit_program_id = $data->id;
        $newDataMeetingManagement = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'Self_Inspection_circular' ])->firstOrCreate();
        $newDataMeetingManagement->ci_id = $audit_program_id;
        $newDataMeetingManagement->identifier = 'Self_Inspection_circular';
        $newDataMeetingManagement->data = $request->Self_Inspection_circular;
        // $history->change_to= "Opened";
        // $history->change_from= "Initiator";
        // $history->action_name="Create";
    
        $newDataMeetingManagement->save();

        //-------------------------------------------------------------------------------------------------------------------------------

        // $audit_program_id = $data->id;

        // if (!empty($request->Self_Inspection_circular)) {
        //     // Fetch existing auditor data
        //     $existingAuditorShow = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'Self_Inspection_circular'])->first();
        //     $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

        //     $newDataMeetingManagement = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'Self_Inspection_circular' ])->firstOrCreate();
        //     $newDataMeetingManagement->ci_id = $audit_program_id;
        //     $newDataMeetingManagement->identifier = 'Self_Inspection_circular';
        //     $newDataMeetingManagement->data = $request->Self_Inspection_circular;
        //     //  dd( $newDataMeetingManagement->data);

        //     $newDataMeetingManagement->update();
        //     //dd($product);
        //     // Define the mapping of field keys to more descriptive names
        //     $fieldNames = [
        //         'departments' => 'Department',
        //         'info_mfg_date' => 'Audit Date',
        //         'Auditor' => 'Name of Auditors',
        //     ];

        //     // Track audit trail changes
        //     if (is_array($request->Self_Inspection_circular)) {
        //         foreach ($request->Self_Inspection_circular as $index => $newAuditor) {
        //             $previousAuditor = $existingAuditorData[$index] ?? [];

        //             // Track changes for each field
        //             $fieldsToTrack = ['department', 'Months', 'Remarked'];
        //             foreach ($fieldsToTrack as $field) {
        //                 $oldValue = $previousAuditor[$field] ?? 'Null';
        //                 $newValue = $newAuditor[$field] ?? 'Null';

        //                 // Only proceed if there's a change or the data is new
        //                 if ($oldValue !== $newValue) {
        //                     // Check if this specific change has already been logged in the audit trail
        //                     $existingAuditTrail = AuditProgramAuditTrial::where([
        //                         ['AuditProgram_id', '=', $data->id],
        //                         ['activity_type', '=', $fieldNames[$field] . ' ( ' . ($index + 1) . ')'],
        //                         ['previous', '=', $oldValue],
        //                         ['current', '=', $newValue]
        //                     ])->first();

        //                     // Determine if the data is new or updated
        //                     // $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

        //                     // If no existing audit trail record, log the change
        //                     if (!$existingAuditTrail) {
        //                         $auditTrail = new AuditProgramAuditTrial;
        //                         $auditTrail->AuditProgram_id = $data->id;
        //                         $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
        //                         $auditTrail->previous = $oldValue;
        //                         $auditTrail->current = $newValue;
        //                         $auditTrail->comment = "";
        //                         $auditTrail->user_id = Auth::user()->id;
        //                         $auditTrail->user_name = Auth::user()->name;
        //                         $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //                         $auditTrail->origin_state = $data->status;
        //                         $auditTrail->change_to = "Not Applicable";
        //                         $auditTrail->change_from = $data->status;
        //                         $auditTrail->action_name = "Update"; // Set action to New or Update
        //                         $auditTrail->save();
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }

        //---------------------------------------------------------------------------------------------------------------------------------




        toastr()->success('Record is Updated Successfully');
        return back();
    }


    public function AuditProgramShow($id)
    {

        $data = AuditProgram::find($id);
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $AuditProgramGrid = AuditProgramGrid::where('audit_program_id', $id)->first();
        $startdate = [];
        // if($AuditProgramGrid->start_date){
        //     $startdate = unserialize($AuditProgramGrid->start_date);
        // }
        // $enddate = [];
        // if($AuditProgramGrid->end_date){
        //     $enddate = unserialize($AuditProgramGrid->end_date);
        // }
        // $client = new Client();
        // $stateList = $client->get('https://geodata.phplift.net/api/index.php?type=getStates&countryId='.$data->country);
        // $data->stateArr = json_decode($stateList->getBody(), true);
        // $cityList = $client->get('https://geodata.phplift.net/api/index.php?type=getCities&countryId=&stateId='.$data->state);
        // $data->cityArr = json_decode($cityList->getBody(), true); 
        // $countryList = $client->get('https://geodata.phplift.net/api/index.php?type=getCountries');
        // $data->countryArr = json_decode($countryList->getBody(), true);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        $audit_program_id = $data->id;
        $grid_Data4 = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'Self_Inspection' ])->first();
        $grid_Data2 = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'Self_Inspection_circular' ])->first();
        $grid_Data3 = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'audit_program' ])->first();

        return view('frontend.audit-program.view', compact('data', 'due_date','audit_program_id', 'AuditProgramGrid','grid_Data4','grid_Data3','grid_Data2'));
    }


    public function AuditStateChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = AuditProgram::find($id);
            $lastDocument = AuditProgram::find($id);
            
            if ($changeControl->stage == 1) {

                $mandatoryFields = [
                     'assign_to','short_description', 'type', 'year', 'comments', 'comment'
                ];
                
                foreach ($mandatoryFields as $field) {
                    if (!isset($changeControl->$field) || trim($changeControl->$field) === '') {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => "Please fill all required fields of GI and Self Inspection Circular tabs before proceeding. Missing: $field"
                        ]);
                        return redirect()->back()->with('error', 'fill required fields of GI and Self Inspection Circular tabs');
                    }
                }
                
                // If all fields are filled, proceed
                Session::flash('swal', [
                    'type' => 'success',
                    'title' => 'Success',
                    'message' => 'Document Sent'
                ]);


                $changeControl->stage = "2";
                $changeControl->status = "Pending Approval";
                $changeControl->submitted_by = Auth::user()->name;
                $changeControl->submitted_on = Carbon::now()->format('d-M-Y');
                $changeControl->Submitted_comment  = $request->comment;
                $history = new AuditProgramAuditTrial();
                $history->AuditProgram_id = $id;
                $history->activity_type = 'Submit By, Submit On';
                $history->action ='Submit';
                if (is_null($lastDocument->submitted_by) || $lastDocument->submitted_by === '') {
                $history->previous = "Null";
                } else {
                $history->previous = $lastDocument->submitted_by . ' , ' . $lastDocument->submitted_on;
                }
                $history->current = $changeControl->submitted_by . ' , ' . $changeControl->submitted_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage='Submit';
                $history->change_to= "Pending Approval";
                $history->change_from= $lastDocument->status;
                $history->action_name ='Not Applicable';
                if (is_null($lastDocument->submitted_by) || $lastDocument->submitted_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                    $history->save();

                
                // $list = Helpers::getQAHeadUserList($changeControl->division_id);
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "AP", 'history' => "Submit", 'process' => 'Audit Program', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Audit Program, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Submit");
                //                 }
                //             );
                //         }
                // }

                $list = Helpers::getCQAHeadUsersList($changeControl->division_id);
                foreach ($list as $u) {
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $changeControl, 'site' => "AP", 'history' => "Submit", 'process' => 'Audit Program', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $changeControl) {
                                    $message->to($email)
                                    ->subject("Agio Notification: Audit Program, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Submit");
                                }
                            );
                        }
                }

                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 2) {

            //     $mandatoryFields = [
            //         'cqa_qa_comment'
            //    ];
               
            //    foreach ($mandatoryFields as $field) {
            //        if (!isset($changeControl->$field) || trim($changeControl->$field) === '') {
            //            Session::flash('swal', [
            //                'type' => 'warning',
            //                'title' => 'Mandatory Fields!',
            //                'message' => "Please fill all required fields before proceeding. Missing: $field"
            //            ]);
            //            return redirect()->back();
            //        }
            //    }
               
            //    // If all fields are filled, proceed
            //    Session::flash('swal', [
            //        'type' => 'success',
            //        'title' => 'Success',
            //        'message' => 'Document Sent'
            //    ]);
            // dd($changeControl->cqa_qa_comment);

            if (empty($changeControl->cqa_qa_comment))
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => "Please fill all required fields before proceeding. Missing:"
                    ]);

                    return redirect()->back();
                }
                 else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Document Sent'
                    ]);
                }

                $changeControl->stage = "3";
                $changeControl->status = "Pending Audit";
                $changeControl->approved_by = Auth::user()->name;
                $changeControl->approved_on = Carbon::now()->format('d-M-Y');
                $changeControl->approved_comment  = $request->comment;
                    $history = new AuditProgramAuditTrial();
                    $history->AuditProgram_id = $id;
                    $history->activity_type = 'Approve By, Approve On';
                    $history->action ='Approve';
                    if (is_null($lastDocument->approved_by) || $lastDocument->approved_by === '') {
                        $history->previous = "Null";
                        } else {
                        $history->previous = $lastDocument->approved_by . ' , ' . $lastDocument->approved_on;
                        }
                        $history->current = $changeControl->approved_by . ' , ' . $changeControl->approved_on;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage='Approve';
                    $history->change_to= "Pending Audit";
                    $history->change_from= "Pending Approval";
                    $history->action_name ='Not Applicable';
                    if (is_null($lastDocument->approved_by) || $lastDocument->approved_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    $list = Helpers::getCftUserList($changeControl->division_id);
                    foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $changeControl, 'site' => "AP", 'history' => "Approve", 'process' => 'Audit Program', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $changeControl) {
                                        $message->to($email)
                                        ->subject("Agio Notification: Audit Program, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Approve");
                                    }
                                );
                            }
                    }
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
     
            $Internal_Auditchild = InternalAudit::where('parent_id', $id)
                ->where('parent_type', 'Audit_Program')
                ->get();

            $hasPendingChild = false;
            foreach ($Internal_Auditchild as $ext) {
                $status = trim(strtolower($ext->status));
               
                if (!in_array($status, ['closed - done', 'reject', 'cancel'])) {
                    $hasPendingChild = true;
                    break;
                }
            }

            if ($hasPendingChild) {
                Session::flash('swal', [
                    'title' => 'Child Records Pending!',
                    'message' => 'You cannot proceed until all child records are Closed-Done, Rejected, or Cancelled.',
                    'type' => 'warning',
                ]);
                return redirect()->back();
            }

       
            if ($changeControl->stage == 3) {
                $mandatoryFields = ['cqa_qa_review_comment'];

                foreach ($mandatoryFields as $field) {
                    if (!isset($changeControl->$field) || trim($changeControl->$field) === '') {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => "Please fill all required fields before proceeding. Missing: $field"
                        ]);
                        return redirect()->back();
                    }
                }

                
                $changeControl->stage = "4";
                $changeControl->status = "Closed - Done";
                $changeControl->Audit_Completed_By = Auth::user()->name;
                $changeControl->Audit_Completed_On = Carbon::now()->format('d-M-Y');
                $changeControl->Audit_Completed_comment = $request->comment;

                $history = new AuditProgramAuditTrial();
                $history->AuditProgram_id = $id;
                $history->activity_type = 'Audit Completed On, Audit Completed By';
                $history->action = 'Audit Completed';

                if (is_null($lastDocument->Audit_Completed_By) || $lastDocument->Audit_Completed_By === '') {
                    $history->previous = "Null";
                    $history->action_name = 'New';
                } else {
                    $history->previous = $lastDocument->Audit_Completed_By . ' , ' . $lastDocument->Audit_Completed_On;
                    $history->action_name = 'Update';
                }

                $history->current = $changeControl->Audit_Completed_By . ' , ' . $changeControl->Audit_Completed_On;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'Audit Completed';
                $history->change_to = "Closed - Done";
                $history->change_from = $lastDocument->status;
                $history->save();

                $changeControl->update();

                toastr()->success('Document Sent');
                return back();
            }
        } 
        else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
    public function AuditRejectStateChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = AuditProgram::find($id);
            $lastDocument = AuditProgram::find($id);

            if ($changeControl->stage == 2) {
                $changeControl->stage = "1";
                $changeControl->status = "Opened";
                $changeControl->rejected_by = Auth::user()->name;
                $changeControl->rejected_on  = Carbon::now()->format('d-M-Y');
                $changeControl->reject_comment  = $request->comment;
                $history = new AuditProgramAuditTrial();
                $history->AuditProgram_id = $id;
                $history->activity_type = 'More Info Required By, More Info Required On';
                $history->action ='More Info Required';
                if (is_null($lastDocument->rejected_by) || $lastDocument->rejected_by === '') {
                    $history->previous = "Null";
                    } else {
                    $history->previous = $lastDocument->rejected_by . ' , ' . $lastDocument->rejected_on;
                    }
                    $history->current = $changeControl->rejected_by . ' , ' . $changeControl->rejected_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'Rejected';
                $history->change_to= "Opened";
                $history->change_from= $lastDocument->status;
                $history->action_name ='Not Applicable';
                if (is_null($lastDocument->rejected_by) || $lastDocument->rejected_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
                  
                $list = Helpers::getCftUserList($changeControl->division_id);
                foreach ($list as $u) {
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $changeControl, 'site' => "AP", 'history' => "More Info Required", 'process' => 'Audit Program', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $changeControl) {
                                    $message->to($email)
                                    ->subject("Agio Notification: Audit Program, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required");
                                }
                            );
                        }
                }
               
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function AuditProgramCancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = AuditProgram::find($id);
            $lastDocument = AuditProgram::find($id);

            if ($changeControl->stage == 1) {
                $changeControl->stage = "0";
                $changeControl->status = "Closed - Cancelled";
                $changeControl->cancelled_by   = Auth::user()->name;
                $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
                $changeControl->Cancelled_comment  = $request->comment;
                $history = new AuditProgramAuditTrial();
                $history->AuditProgram_id = $id;
                $history->activity_type = 'Cancel By, Cancel On';
                $history->action ='Cancel';
                if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                    $history->previous = "Null";
                    } else {
                    $history->previous = $lastDocument->cancelled_by . ' , ' . $lastDocument->cancelled_on;
                    }
                    $history->current = $changeControl->cancelled_by . ' , ' . $changeControl->cancelled_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'Cancel';
                $history->change_to= "Closed-Cancel ";
                $history->change_from= $lastDocument->status;
                $history->action_name ='Not Applicable';
                if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
                $list = Helpers::getHodUserList($changeControl->division_id);
                    foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $changeControl, 'site' => "AP", 'history' => "Cancel", 'process' => 'Audit Program', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $changeControl) {
                                        $message->to($email)
                                        ->subject("Agio Notification: Audit Program, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Cancel");
                                    }
                                );
                            }
                    }
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 2) {
                $changeControl->stage = "0";
                $changeControl->status = "Closed - Cancelled";
                $changeControl->cancelled_by   = Auth::user()->name;
                $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
                $changeControl->Cancelled_comment  = $request->comment;
                $history = new AuditProgramAuditTrial();
                $history->AuditProgram_id = $id;
                $history->activity_type = 'Cancel By, Cancel On';
                $history->action ='Cancel';
                if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                    $history->previous = "Null";
                    } else {
                    $history->previous = $lastDocument->cancelled_by . ' , ' . $lastDocument->cancelled_on;
                    }
                    $history->current = $changeControl->cancelled_by . ' , ' . $changeControl->cancelled_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'Cancel';
                $history->change_to= "Closed-Cancel ";
                $history->change_from= $lastDocument->status;
                $history->action_name ='Not Applicable';
                if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
                $list = Helpers::getHodUserList($changeControl->division_id);
                    foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $changeControl, 'site' => "AP", 'history' => "Cancel", 'process' => 'Audit Program', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $changeControl) {
                                        $message->to($email)
                                        ->subject("Agio Notification: Audit Program, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Cancel");
                                    }
                                );
                            }
                    }
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
          if ($changeControl->stage == 3) {
    $changeControl->stage = "0";
    $changeControl->status = "Closed - Cancelled";
    $changeControl->cancelled_by = Auth::user()->name;
    $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
    $changeControl->Cancelled_comment = $request->comment;

    $Internal_Auditchild = InternalAudit::where('parent_id', $id)
        ->where('parent_type', 'Audit_Program')
        ->get();

    foreach ($Internal_Auditchild as $child) {
        $child->stage = "0";
        $child->status = "Closed - Cancelled";
        $child->cancelled_by = Auth::user()->name;
        $child->cancelled_on = Carbon::now()->format('d-M-Y');
        $child->save();
    }

    // Save parent cancel history (your existing code)
    $history = new AuditProgramAuditTrial();
    $history->AuditProgram_id = $id;
    $history->activity_type = 'Cancel By, Cancel On';
    $history->action = 'Cancel';
    if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
        $history->previous = "Null";
    } else {
        $history->previous = $lastDocument->cancelled_by . ' , ' . $lastDocument->cancelled_on;
    }
    $history->current = $changeControl->cancelled_by . ' , ' . $changeControl->cancelled_on;
    $history->comment = $request->comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->stage = 'Cancel';
    $history->change_to = "Closed-Cancel ";
    $history->change_from = $lastDocument->status;
    $history->action_name = (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') ? 'New' : 'Update';
    $history->save();

    // Update the parent record
    $changeControl->update();

    // Now update all related InternalAudit children to Closed - Cancelled


    toastr()->success('Document Sent and all related child audits cancelled successfully');
    return back();
}

        }
    }

    // public function AuditProgramTrialShow($id)
    // {
    //      $data= AuditProgram::find($id);
    //     $audit = AuditProgramAuditTrial::where('AuditProgram_id', $id)->orderByDESC('id')->get()->unique('activity_type');
    //     $today = Carbon::now()->format('d-m-y');
    //     $document = AuditProgram::where('id', $id)->first();
    //     $document->initiator = User::where('id', $document->initiator_id)->value('name');

    //     return view('frontend.audit-program.audit-trial', compact('audit', 'document', 'today'));
    // }
    
        public function AuditProgramTrialShow($id)
    {
        $data= AuditProgram::find($id);
        $audit = AuditProgramAuditTrial::where('AuditProgram_id', $id)->orderByDesc('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = AuditProgram::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
        $users = User::all();
        return view('frontend.audit-program.audit-trial', compact('audit', 'document', 'today','data', 'users'));
    }
    // public function auditProgramDetails($id)
    // {
    //     $detail = AuditProgramAuditTrial::find($id);
    //     $detail_data = AuditProgramAuditTrial::where('activity_type', $detail->activity_type)->where('AuditProgram_id', $detail->AuditProgram_id)->latest()->get();
    //     $doc = AuditProgram::where('id', $detail->AuditProgram_id)->first();
    //     $doc->origiator_name = User::find($doc->initiator_id);
    //     return view('frontend.audit-program.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
    // }
    public function child_audit_program(Request $request, $id)
    {
        $parent_id = $id;

        $parent_type = "Audit_Program";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $old_record = InternalAudit::select('id', 'division_id', 'record')->get();
        $parent_division_id = AuditProgram::where('id', $id)->value('division_id');
        if ($request->child_type == "Internal_Audit") {
            return view('frontend.forms.audit', compact('old_record','record_number', 'due_date', 'parent_id', 'parent_type','parent_division_id'));
        }
        if ($request->child_type == "extension") {
            $parent_due_date = "";
            $parent_name = $request->parent_name;
            if ($request->due_date) {
                $parent_due_date = $request->due_date;
            }
            $record_number = ((RecordNumber::first()->value('counter')) + 1);
            $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            return view('frontend.forms.extension', compact('parent_id', 'parent_name', 'record_number', 'parent_due_date','parent_division_id'));
        }
        else {
            $parent_name = $request->parent_name;
            if ($request->due_date) {
                $parent_due_date = $request->due_date;
            }
            $parent_type = "Audit_Program";
            $record_number = ((RecordNumber::first()->value('counter')) + 1);
            $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            return view('frontend.forms.auditee', compact('old_record','record_number', 'due_date', 'parent_id', 'parent_type'));
        }
    }
        public static function singleReport($id)
    {
        $data = AuditProgram::find($id);
        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $AuditProgramGrid = AuditProgramGrid::where('audit_program_id', $id)->first();
              $audit_program_id = $data->id;
            $grid_Data4 = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'Self_Inspection' ])->first();
            $grid_Data2 = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'Self_Inspection_circular' ])->first();
            $grid_Data3 = AuditProgramGrid::where(['ci_id' => $audit_program_id, 'identifier' => 'audit_program' ])->first();

        $startdate = [];
        // if($AuditProgramGrid->start_date){
        //     $startdate = unserialize($AuditProgramGrid->start_date);
        // }
        // $enddate = [];
        // if($AuditProgramGrid->end_date){
        //     $enddate = unserialize($AuditProgramGrid->end_date);
           

              
        // }
            $pdf = PDF::loadview('frontend.audit-program.singleReport', compact('data','AuditProgramGrid','grid_Data4','grid_Data2','grid_Data3'))
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
            
            $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $text = " $pageNumber of $pageCount";
            $font = $fontMetrics->getFont('sans-serif', 'normal');
            $size = 9;
            $width = $fontMetrics->getTextWidth($text, $font, $size);

            $canvas->text(($canvas->get_width() - $width - 110), ($canvas->get_height() - 763), $text, $font, $size);
            });
            return $pdf->stream('Audit-Program' . $id . '.pdf');
        }
    }
    public static function auditReport($id)
    {
        $doc = AuditProgram::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
             $audit = AuditProgramAuditTrial::where('AuditProgram_id', $id)->orderByDesc('id')->get();
            $data = AuditProgramAuditTrial::where('AuditProgram_id', $id)->get();
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.audit-program.auditReport', compact('data', 'doc','audit'))
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
            
            $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $text = " $pageNumber of $pageCount";
            $font = $fontMetrics->getFont('sans-serif', 'normal');
            $size = 9;
            $width = $fontMetrics->getTextWidth($text, $font, $size);

            $canvas->text(($canvas->get_width() - $width - 110), ($canvas->get_height() - 26), $text, $font, $size);
            });
            return $pdf->stream('AuditProgram-AuditTrial' . $id . '.pdf');
        }
    }

    public function audit_trail_filter_audit_program(Request $request, $id)
    {
        // Start query for DeviationAuditTrail
        $query = AuditProgramAuditTrial::query();
        $query->where('AuditProgram_id', $id);
    
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
        // return $audit;
    
        // Render the filtered view and return as JSON
        $responseHtml = view('frontend.audit-program.audit_trail_filter', compact('audit', 'filter_request'))->render();
    
        return response()->json(['html' => $responseHtml]);
    }
    
}
