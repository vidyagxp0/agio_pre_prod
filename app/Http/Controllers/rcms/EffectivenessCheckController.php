<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\CC;
use App\Models\CCStageHistory;
use App\Models\EffectivenessCheck;
use App\Models\RecordNumber;
use App\Models\User;
use App\Models\EffectivenessCheckAuditTrail;
use App\Models\RoleGroup;
use Carbon\Carbon;
use PDF;
use Helpers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class EffectivenessCheckController extends Controller
{

    public function effectiveness_check()
    {
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        return view('frontend.forms.effectiveness-check', compact('due_date', 'record_number'));
    }

    public function index()
    {
        $table = [];

        $datas = EffectivenessCheck::get();
        $datas1 = EffectivenessCheck::get();
        $datas2 = EffectivenessCheck::get();

        foreach ($datas as $data) {
            array_push($table, [
                "id" => $data->name ? $data->name  : "-",
                "type" => $data->name ? $data->name  : "-",
                "name" => $data->name ? $data->name  : "-",
                "address" => "",
                "role" => "",
                "phone" => "",
            ]);
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $openState = new EffectivenessCheck();
        // $openState->form_type = "effectiveness-check";
        $openState->is_parent = "No";
        $openState->division_id = $request->division_id;
        $openState->intiation_date = $request->intiation_date;
        $openState->initiator_id = Auth::user()->id;
        // $openState->parent_record = CC::where('id', $request->cc_id)->value('id');
        
        $openState->parent_record = $request->parent_record;
        $openState->parent_type = $request->parent_type;
        $openState->parent_id = $request->parent_id;

        $openState->record = DB::table('record_numbers')->value('counter') + 1;
        $openState->originator = CC::where('id', $request->cc_id)->value('initiator_id');
        $openState->assign_to = $request->assign_to;
        $openState->due_date = $request->due_date;
        $openState->short_description = $request->short_description;
        $openState->Effectiveness_check_Plan = $request->Effectiveness_check_Plan;
        $openState->Effectiveness_Summary = $request->Effectiveness_Summary;
        $openState->effect_summary = $request->effect_summary;
        $openState->Quality_Reviewer = $request->Quality_Reviewer;
        $openState->Effectiveness_Results = $request->Effectiveness_Results;
        $openState->Addendum_Comments = $request->Addendum_Comments;
       // $openState->Cancellation_Category = $request->Cancellation_Category;
        //$openState->Effectiveness_check_Attachment = $request->Effectiveness_check_Attachment;

        if (!empty($request->Effectiveness_check_Attachment)) {
            $files = [];
            if ($request->hasfile('Effectiveness_check_Attachment')) {
                foreach ($request->file('Effectiveness_check_Attachment') as $file) {
                    $name = $request->name . 'Effectiveness_check_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $openState->Effectiveness_check_Attachment = json_encode($files);
        }

      //  $openState->Addendum_Attachment = $request->Addendum_Attachment;
        if (!empty($request->Addendum_Attachment)) {
            $files = [];
            if ($request->hasfile('Addendum_Attachment')) {
                foreach ($request->file('Addendum_Attachment') as $file) {
                    $name = $request->name . 'Addendum_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $openState->Addendum_Attachment = json_encode($files);
        }
       // $openState->Attachment = $request->Attachment;
        if (!empty($request->Attachment)) {
            $files = [];
            if ($request->hasfile('Attachment')) {
                foreach ($request->file('Attachment') as $file) {
                    $name = $request->name . 'Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $openState->Attachment = json_encode($files);
        }
        if (!empty($request->Attachments)) {
            $files = [];
            if ($request->hasfile('Attachments')) {
                foreach ($request->file('Attachments') as $file) {
                    $name = $request->name . 'Attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $openState->Attachments = json_encode($files);
        }
       // $openState->refer_record = $request->refer_record;
       if (!empty($request->refer_record)) {
        $files = [];
        if ($request->hasfile('refer_record')) {
            foreach ($request->file('refer_record') as $file) {
                $name = $request->name . 'refer_record' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] = $name;
            }
        }

            $openState->refer_record = json_encode($files);
        }
        $openState->Comments = $request->Comments;
        $openState->status = "Opened";
        $openState->stage = 1;
        $openState->save();


        $counter = DB::table('record_numbers')->value('counter');
        $recordNumber = str_pad($counter, 5, '0', STR_PAD_LEFT);
        $newCounter = $counter + 1;
        DB::table('record_numbers')->update(['counter' => $newCounter]);

        if (!empty ($request->assign_to)){
            $history = new EffectivenessCheckAuditTrail();
            $history->extension_id = $openState->id;
            $history->activity_type = 'Assigned To';
            $history->previous = "Null";
            $history->current = $openState->assign_to;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
       if (!empty ($request->short_description)){
            $history = new EffectivenessCheckAuditTrail();
            $history->extension_id = $openState->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $openState->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Effectiveness_check_Plan)){
            $history = new EffectivenessCheckAuditTrail();
            $history->extension_id = $openState->id;
            $history->activity_type = 'Effectiveness check Plan';
            $history->previous = "Null";
            $history->current = $openState->Effectiveness_check_Plan;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Effectiveness_Summary)){
            $history = new EffectivenessCheckAuditTrail();
            $history->extension_id = $openState->id;
            $history->activity_type = 'Effectiveness Summary';
            $history->previous = "Null";
            $history->current = $openState->Effectiveness_Summary;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->effect_summary)){
            $history = new EffectivenessCheckAuditTrail();
            $history->extension_id = $openState->id;
            $history->activity_type = 'Effectiveness Summary';
            $history->previous = "Null";
            $history->current = $openState->effect_summary;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Quality_Reviewer)){
            $history = new EffectivenessCheckAuditTrail();
            $history->extension_id = $openState->id;
            $history->activity_type = 'Quality Reviewer';
            $history->previous = "Null";
            $history->current = $openState->Quality_Reviewer;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Effectiveness_Results)){
            $history = new EffectivenessCheckAuditTrail();
            $history->extension_id = $openState->id;
            $history->activity_type = 'Effectiveness Results';
            $history->previous = "Null";
            $history->current = $openState->Effectiveness_Results;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Addendum_Comments)){
            $history = new EffectivenessCheckAuditTrail();
            $history->extension_id = $openState->id;
            $history->activity_type = 'Addendum Comments';
            $history->previous = "Null";
            $history->current = $openState->Addendum_Comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Effectiveness_check_Attachment)){
            $history = new EffectivenessCheckAuditTrail();
            $history->extension_id = $openState->id;
            $history->activity_type = 'Effectiveness check Attachment';
            $history->previous = "Null";
            $history->current = $openState->Effectiveness_check_Attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Addendum_Attachment)){
            $history = new EffectivenessCheckAuditTrail();
            $history->extension_id = $openState->id;
            $history->activity_type = 'Addendum Attachment';
            $history->previous = "Null";
            $history->current = $openState->Addendum_Attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Attachment)){
            $history = new EffectivenessCheckAuditTrail();
            $history->extension_id = $openState->id;
            $history->activity_type = 'Attachment';
            $history->previous = "Null";
            $history->current = $openState->Attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->Attachments)){
            $history = new EffectivenessCheckAuditTrail();
            $history->extension_id = $openState->id;
            $history->activity_type = 'Attachments';
            $history->previous = "Null";
            $history->current = $openState->Attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->refer_record)){
            $history = new EffectivenessCheckAuditTrail();
            $history->extension_id = $openState->id;
            $history->activity_type = 'Reference Records';
            $history->previous = "Null";
            $history->current = $openState->refer_record;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        toastr()->success('Record created succesfully');
        return redirect('rcms/qms-dashboard');
    }

    public function show($id)
    {
        $data = EffectivenessCheck::find($id);
        return view('frontend.effectivenessCheck.view', compact('data'));
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $lastopenState = EffectivenessCheck::find($id);
        $openState =  EffectivenessCheck::find($id);
        $openState->assign_to = $request->assign_to;
        $openState->due_date = $request->due_date;
        $openState->short_description = $request->short_description;
        $openState->Effectiveness_check_Plan = $request->Effectiveness_check_Plan;
        $openState->Quality_Reviewer = $request->Quality_Reviewer;
        $openState->Effectiveness_Summary = $request->Effectiveness_Summary;
        $openState->effect_summary = $request->effect_summary;
        $openState->Effectiveness_Results = $request->Effectiveness_Results;
        $openState->Addendum_Comments = $request->Addendum_Comments;
     //   $openState->Cancellation_Category = $request->Cancellation_Category;
        //$openState->Effectiveness_check_Attachment = $request->Effectiveness_check_Attachment;

        if (!empty($request->Effectiveness_check_Attachment)) {
            $files = [];
            if ($request->hasfile('Effectiveness_check_Attachment')) {
                foreach ($request->file('Effectiveness_check_Attachment') as $file) {
                    $name = $request->name . 'Effectiveness_check_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $openState->Effectiveness_check_Attachment = json_encode($files);
        }

       // $openState->Addendum_Attachment = $request->Addendum_Attachment;
        if (!empty($request->Addendum_Attachment)) {
            $files = [];
            if ($request->hasfile('Addendum_Attachment')) {
                foreach ($request->file('Addendum_Attachment') as $file) {
                    $name = $request->name . 'Addendum_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $openState->Addendum_Attachment = json_encode($files);
        }
     //   $openState->Attachment = $request->Attachment;
        if (!empty($request->Attachment)) {
            $files = [];
            if ($request->hasfile('Attachment')) {
                foreach ($request->file('Attachment') as $file) {
                    $name = $request->name . 'Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $openState->Attachment = json_encode($files);
        }
        if (!empty($request->Attachments)) {
            $files = [];
            if ($request->hasfile('Attachments')) {
                foreach ($request->file('Attachments') as $file) {
                    $name = $request->name . 'Attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $openState->Attachments = json_encode($files);
        }
        if (!empty($request->refer_record)) {
            $files = [];
            if ($request->hasfile('refer_record')) {
                foreach ($request->file('refer_record') as $file) {
                    $name = $request->name . 'refer_record' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
    
            $openState->refer_record = json_encode($files);
        }
        $openState->Comments = $request->Comments;
        $openState->update();

        if ($lastopenState->assign_to != $openState->assign_to || !empty ($request->comment)) {
            // return 'history';
            $history = new EffectivenessCheckAuditTrail;
            $history->extension_id = $id;
            $history->activity_type = 'Assigned To';
             $history->previous = $lastopenState->assign_to;
            $history->current = $openState->assign_to;
            $history->comment = $openState->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastopenState->short_description != $openState->short_description || !empty ($request->comment)) {
            // return 'history';
            $history = new EffectivenessCheckAuditTrail;
            $history->extension_id = $id;
            $history->activity_type = 'Short Description';
             $history->previous = $lastopenState->short_description;
            $history->current = $openState->short_description;
            $history->comment = $openState->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastopenState->Effectiveness_check_Plan != $openState->Effectiveness_check_Plan || !empty ($request->comment)) {
            // return 'history';
            $history = new EffectivenessCheckAuditTrail;
            $history->extension_id = $id;
            $history->activity_type = 'Effectiveness check Plan';
             $history->previous = $lastopenState->Effectiveness_check_Plan;
            $history->current = $openState->Effectiveness_check_Plan;
            $history->comment = $openState->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastopenState->Effectiveness_Summary != $openState->Effectiveness_Summary || !empty ($request->comment)) {
            // return 'history';
            $history = new EffectivenessCheckAuditTrail;
            $history->extension_id = $id;
            $history->activity_type = 'Effectiveness Summary';
             $history->previous = $lastopenState->Effectiveness_Summary;
            $history->current = $openState->Effectiveness_Summary;
            $history->comment = $openState->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastopenState->effect_summary != $openState->effect_summary || !empty ($request->comment)) {
            // return 'history';
            $history = new EffectivenessCheckAuditTrail;
            $history->extension_id = $id;
            $history->activity_type = 'Effectiveness Summary';
             $history->previous = $lastopenState->effect_summary;
            $history->current = $openState->effect_summary;
            $history->comment = $openState->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastopenState->Quality_Reviewer != $openState->Quality_Reviewer || !empty ($request->comment)) {
            // return 'history';
            $history = new EffectivenessCheckAuditTrail;
            $history->extension_id = $id;
            $history->activity_type = 'Quality Reviewer';
             $history->previous = $lastopenState->Quality_Reviewer;
            $history->current = $openState->Quality_Reviewer;
            $history->comment = $openState->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastopenState->Effectiveness_Results != $openState->Effectiveness_Results || !empty ($request->comment)) {
            // return 'history';
            $history = new EffectivenessCheckAuditTrail;
            $history->extension_id = $id;
            $history->activity_type = 'Effectiveness Results';
             $history->previous = $lastopenState->Effectiveness_Results;
            $history->current = $openState->Effectiveness_Results;
            $history->comment = $openState->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastopenState->Addendum_Comments != $openState->Addendum_Comments || !empty ($request->comment)) {
            // return 'history';
            $history = new EffectivenessCheckAuditTrail;
            $history->extension_id = $id;
            $history->activity_type = 'Addendum Comments';
             $history->previous = $lastopenState->Addendum_Comments;
            $history->current = $openState->Addendum_Comments;
            $history->comment = $openState->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastopenState->Effectiveness_check_Attachment != $openState->Effectiveness_check_Attachment || !empty ($request->comment)) {
            // return 'history';
            $history = new EffectivenessCheckAuditTrail;
            $history->extension_id = $id;
            $history->activity_type = 'Effectiveness check Attachment';
             $history->previous = $lastopenState->Effectiveness_check_Attachment;
            $history->current = $openState->Effectiveness_check_Attachment;
            $history->comment = $openState->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastopenState->Addendum_Attachment != $openState->Addendum_Attachment || !empty ($request->comment)) {
            // return 'history';
            $history = new EffectivenessCheckAuditTrail;
            $history->extension_id = $id;
            $history->activity_type = 'Addendum Attachment';
             $history->previous = $lastopenState->Addendum_Attachment;
            $history->current = $openState->Addendum_Attachment;
            $history->comment = $openState->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastopenState->Attachment != $openState->Attachment || !empty ($request->comment)) {
            // return 'history';
            $history = new EffectivenessCheckAuditTrail;
            $history->extension_id = $id;
            $history->activity_type = 'Attachment';
             $history->previous = $lastopenState->Attachment;
            $history->current = $openState->Attachment;
            $history->comment = $openState->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastopenState->Attachments != $openState->Attachments || !empty ($request->comment)) {
            // return 'history';
            $history = new EffectivenessCheckAuditTrail;
            $history->extension_id = $id;
            $history->activity_type = 'Attachments';
             $history->previous = $lastopenState->Attachments;
            $history->current = $openState->Attachments;
            $history->comment = $openState->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastopenState->refer_record != $openState->refer_record || !empty ($request->comment)) {
            // return 'history';
            $history = new EffectivenessCheckAuditTrail;
            $history->extension_id = $id;
            $history->activity_type = 'Reference Records';
             $history->previous = $lastopenState->refer_record;
            $history->current = $openState->refer_record;
            $history->comment = $openState->submit_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = "Update";
            $history->save();
        }
        toastr()->success('Record Updated succesfully');
        return back();
    }

    public function destroy($id)
    {
    }


    public function stageChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = EffectivenessCheck::find($id);
            $lastopenState = EffectivenessCheck::find($id);
            if ($changeControl->stage == 1) {
                // $rules = [
                //     'Addendum_Comments' => 'required|max:255',
                // ];
                // $customMessages = [
                //     'Addendum_Comments.required' => 'The Addendum Comments field is required.',
                // ];
                // $validator = Validator::make($request->all(), $rules, $customMessages); // Corrected to use $request->all()
                // if ($validator->fails()) {
                //     $errorMessages = implode('<br>', $validator->errors()->all());
                //     session()->put('errorMessages', $errorMessages);
                //     return back();
                // } else {
                    $changeControl->stage = '2';
                    $changeControl->status = 'Pending Effectiveness Check';
                    $changeControl->submit_by = Auth::user()->name;
                    $changeControl->submit_on = Carbon::now()->format('d-M-Y');
            
                    $history = new EffectivenessCheckAuditTrail();
                    $history->extension_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->current = $changeControl->submit_by; // Corrected variable name here
                    $history->comment = $request->comment;
                    $history->action = 'Submit'; // Corrected typo
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastopenState->status; // Corrected variable name here
                    $history->change_to = "Pending Effectiveness Check";
                    $history->change_from = $lastopenState->status; // Corrected variable name here
                    $history->action_name = 'Not Applicable';
                    $history->stage = '2';
                    $history->save();
            
                    // $list = Helpers::getQAUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $changeControl->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             Mail::send(
                    //                 'mail.view-mail',
                    //                 ['data' => $changeControl],
                    //                 function ($message) use ($email) {
                    //                     $message->to($email)
                    //                         ->subject("Document is Submitted By " . Auth::user()->name);
                    //                 }
                    //             );
                    //         }
                    //     }
                    // }
            
                    $changeControl->update();
                    $history = new CCStageHistory();
                    $history->type = "Effectiveness-Check";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->status = $changeControl->status;
                    $history->save();
                    toastr()->success('Document Sent');
            
                    return back();
                // }
            }
            
            if ($changeControl->stage == 2) {
                // $rules = [
                //     'Comments' => 'required|max:255',

                // ];
                // $customMessages = [
                //     'Comments.required' => 'The  Comments field is required.',

                // ];
                // $validator = Validator::make($changeControl->toArray(), $rules, $customMessages);
                // if ($validator->fails()) {
                //     $errorMessages = implode('<br>', $validator->errors()->all());
                //     session()->put('errorMessages', $errorMessages);
                //     return back();
                // } else {
                    $changeControl->stage = '3';
                    $changeControl->status = 'QA Approval-Effective';
                    $changeControl->effective_by =  Auth::user()->name;
                    $changeControl->effective_on = Carbon::now()->format('d-M-Y');
                            // $history = new EffectivenessCheckAuditTrail();
                            // $history->parent_id = $id;
                            // $history->activity_type = 'Activity Log';
                            // $history->previous = "";
                            // $history->current = $changeControl->effective_by;
                            // $history->comment = $request->comment;
                            // $history->user_id = Auth::user()->id;
                            // $history->user_name = Auth::user()->name;
                            // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            // $history->origin_state = $lastopenState->status;
                            // $history->step = 'Effective';
                            // $history->save();

                            $history = new EffectivenessCheckAuditTrail();
                            $history->extension_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->previous = "";
                            $history->current = $changeControl->submitted_by;
                            $history->comment = $request->comment;
                            $history->action = 'Effective';
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastopenState->status;
                            $history->change_to =   "QA Approval-Effective";
                            $history->change_from = $lastopenState->status;
                            $history->action_name = 'Not Applicable';
                            $history->stage = '3';
                            $history->save();
                            
                //     $list = Helpers:: getQAUserList();
                //     foreach ($list as $u) {
                //         if($u->q_m_s_divisions_id == $changeControl->division_id){
                //             $email = Helpers::getInitiatorEmail($u->user_id);
                //              if ($email !== null) {
                          
                //               Mail::send(
                //                   'mail.view-mail',
                //                    ['data' => $changeControl],
                //                 function ($message) use ($email) {
                //                     $message->to($email)
                //                         ->subject("Document is Send By ".Auth::user()->name);
                //                 }
                //               );
                //             }
                //      } 
                //   }
           
                    $changeControl->update();
                    $history = new CCStageHistory();
                    $history->type = "Effectiveness-Check";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->status = $changeControl->status;
                    $history->save();
                    toastr()->success('Document Sent');

                    return back();
                
                // }
            }
            if ($changeControl->stage == 3) {
                $changeControl->stage = '4';
                $changeControl->status = 'Closed – Effective';
                $changeControl->effective_approval_complete_by =  Auth::user()->name;
                $changeControl->effective_approval_complete_on = Carbon::now()->format('d-M-Y');
                            // $history = new EffectivenessCheckAuditTrail();
                            // $history->parent_id = $id;
                            // $history->activity_type = 'Activity Log';
                            // $history->previous = "";
                            // $history->current = $changeControl->effective_approval_complete_by;
                            // $history->comment = $request->comment;
                            // $history->user_id = Auth::user()->id;
                            // $history->user_name = Auth::user()->name;
                            // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            // $history->origin_state = $lastopenState->status;
                            // $history->step = 'Effective Approval Complete';
                            // $history->save();

                            $history = new EffectivenessCheckAuditTrail();
                            $history->extension_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->previous = "";
                            $history->current = $changeControl->submit_by; // Corrected variable name here
                            $history->comment = $request->comment;
                            $history->action = 'Effective Approval Completed'; // Corrected typo
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastopenState->status; // Corrected variable name here
                            $history->change_to = "Closed – Effective";
                            $history->change_from = $lastopenState->status; // Corrected variable name here
                            $history->action_name = 'Not Applicable';
                            $history->stage = '2';
                            $history->save();

                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Effectiveness-Check";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                toastr()->success('Document Sent');

                return back();
            }
            
        } else {
            toastr()->error('E-signature Not match');

            return back();
        }
    } 

    public function reject(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = EffectivenessCheck::find($id);
            $lastopenState = EffectivenessCheck::find($id);
            if ($changeControl->stage == 2) {
                $changeControl->stage = '5';
                $changeControl->status = 'QA Approval-Not Effective';
                $changeControl->not_effective_by =  Auth::user()->name;
                $changeControl->not_effective_on = Carbon::now()->format('d-M-Y');
                            // $history = new EffectivenessCheck();
                            // $history->parent_id = $id;
                            // $history->activity_type = 'Activity Log';
                            // $history->previous = "";
                            // $history->current = $changeControl->not_effective_by;
                            // $history->comment = $request->comment;
                            // $history->user_id = Auth::user()->id;
                            // $history->user_name = Auth::user()->name;
                            // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            // $history->origin_state = $lastopenState->status;
                            // $history->step = 'Not Effective';
                            // $history->save();
                            
                            $history = new EffectivenessCheckAuditTrail();
                            $history->extension_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->previous = "";
                            $history->current = $changeControl->submit_by; // Corrected variable name here
                            $history->comment = $request->comment;
                            $history->action = 'Not Effective'; // Corrected typo
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastopenState->status; // Corrected variable name here
                            $history->change_to = "QA Approval-Not Effective";
                            $history->change_from = $lastopenState->status; // Corrected variable name here
                            $history->action_name = 'Not Applicable';
                            $history->stage = '2';
                            $history->save();
                            
                //     $list = Helpers:: getQAUserList();
                //     foreach ($list as $u) {
                //         if($u->q_m_s_divisions_id == $changeControl->division_id){
                //             $email = Helpers::getInitiatorEmail($u->user_id);
                //              if ($email !== null) {
                          
                //               Mail::send(
                //                   'mail.view-mail',
                //                    ['data' =>  $changeControl],
                //                 function ($message) use ($email) {
                //                     $message->to($email)
                //                         ->subject("Document is Send By ".Auth::user()->name);
                //                 }
                //               );
                //             }
                //      } 
                //   }
           
                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Effectiveness-Check";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = "Reject";
                $history->save();
                toastr()->success('Document Sent');

                return back();
            }

            if ($changeControl->stage == 5) {
                $changeControl->stage = '6';
                $changeControl->status = 'Closed – Not Effective';
                $changeControl->not_effective_approval_complete_by =  Auth::user()->name;
                $changeControl->not_effective_approval_complete_on = Carbon::now()->format('d-M-Y');
                        // $history = new EffectivenessCheck();
                        // $history->parent_id = $id;
                        // $history->activity_type = 'Activity Log';
                        // $history->previous = "";
                        // $history->current = $changeControl->not_effective_approval_complete_by;
                        // $history->comment = $request->comment;
                        // $history->user_id = Auth::user()->id;
                        // $history->user_name = Auth::user()->name;
                        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        // $history->origin_state = $lastopenState->status;
                        // $history->step = 'Not Effective Approval Complete';
                        // $history->save();
                        
                        $history = new EffectivenessCheckAuditTrail();
                        $history->extension_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->current = $changeControl->submit_by; // Corrected variable name here
                        $history->comment = $request->comment;
                        $history->action = 'Not Effective Approval Completed'; // Corrected typo
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastopenState->status; // Corrected variable name here
                        $history->change_to = "Closed – Not Effective";
                        $history->change_from = $lastopenState->status; // Corrected variable name here
                        $history->action_name = 'Not Applicable';
                        $history->stage = '6';
                        $history->save();
                        
                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Effectiveness-Check";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                toastr()->success('Document Sent');

                return back();
            }
        } else {
            toastr()->error('E-signature Not match');

            return back();
        }
    }

    public function cancel(Request $request, $id) {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = EffectivenessCheck::find($id);
            $lastopenState = EffectivenessCheck::find($id);

            if ($changeControl->stage == 3) {
                $changeControl->stage = '2';
                $changeControl->status = 'Check Effectiveness';


                $history = new EffectivenessCheckAuditTrail();
                $history->extension_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->submit_by; // Corrected variable name here
                $history->comment = $request->comment;
                $history->action = 'More Information Required'; // Corrected typo
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastopenState->status; // Corrected variable name here
                $history->change_to = "Check Effectiveness";
                $history->change_from = $lastopenState->status; // Corrected variable name here
                $history->action_name = 'Not Applicable';
                $history->stage = '6';
                $history->save();

                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Effectiveness-Check";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = "Reject";
                $history->save();
                toastr()->success('Document Sent');

                return back();
            }

            if ($changeControl->stage == 5) {
                $changeControl->stage = '2';
                $changeControl->status = 'Check Effectiveness';

                $history = new EffectivenessCheckAuditTrail();
                $history->extension_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->submit_by; // Corrected variable name here
                $history->comment = $request->comment;
                $history->action = 'More Information Required'; // Corrected typo
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastopenState->status; // Corrected variable name here
                $history->change_to = "Check Effectiveness";
                $history->change_from = $lastopenState->status; // Corrected variable name here
                $history->action_name = 'Not Applicable';
                $history->stage = '6';
                $history->save();


                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Effectiveness-Check";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                toastr()->success('Document Sent');

                return back();
            }
        } else {
            toastr()->error('E-signature Not match');

            return back();
        }
    }
    public function effectiveAuditTrialShow($id)
    {
        $audit = EffectivenessCheckAuditTrail::where('extension_id', $id)->orderByDESC('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = EffectivenessCheck::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
    
        return view('frontend.effectivenessCheck.audit-trial', compact('audit', 'document', 'today'));
    }
    public function effectiveAuditTrialDetails($id)
    {
      $detail = EffectivenessCheck::find($id);

       $detail_data = EffectivenessCheck::where('activity_type', $detail->activity_type)->where('parent_id', $detail->parent_id)->latest()->get();

       $doc = EffectivenessCheck::where('id', $detail->parent_id)->first();

     $doc->origiator_name = User::find($doc->initiator_id);
      return view('frontend.effectivenessCheck.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
   } 
   
public static function singleReport($id)
{
    $data = EffectivenessCheck::find($id);
    if (!empty($data)) {
        $data->originator = User::where('id', $data->initiator_id)->value('name');
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.effectivenessCheck.singleReport', compact('data'))
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
        return $pdf->stream('effectivenessCheck' . $id . '.pdf');
    }
}
public static function auditReport($id)
{
    $doc = EffectivenessCheck::find($id);
    if (!empty($doc)) {
        $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        $data = EffectivenessCheck::where('parent_id', $id)->get();
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.effectivenessCheck.auditReport', compact('data', 'doc'))
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
        return $pdf->stream('effectivenessCheck-Audit' . $id . '.pdf');
    }
}

}
