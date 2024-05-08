<?php

namespace App\Http\Controllers\rcms;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\ActionItem;
use App\Models\CC;
use App\Models\RoleGroup;
use App\Models\ActionItemHistory;
use App\Models\CCStageHistory;
use App\Models\RecordNumber;
use App\Models\CheckEffecVerifi;
use App\Models\RefInfoComments;
use App\Models\Taskdetails;
use App\Models\User;
use Carbon\Carbon;
use PDF;
use Helpers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use App\Models\OpenStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ActionItemController extends Controller
{

    public function showAction()
    {
        $old_record = ActionItem::select('id', 'division_id', 'record')->get();
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        return view('frontend.forms.action-item', compact('due_date', 'record_number','old_record'));
    }
    public function index()
    {
       
        $document = ActionItem::all();
        $old_record = ActionItem::select('id', 'division_id', 'record')->get();
        foreach ($document as $data) {
            $cc = CC::find($data->cc_id);
            $data->originator = User::where('id', $cc->initiator_id)->value('name');
        }
        return view('frontend.action-item.at', compact('document', 'record_number','old_record'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (!$request->short_description) {
            toastr()->error("Short description is required");
            return redirect()->back();
        }
        $openState = new ActionItem();
        $openState->cc_id = $request->ccId;
        $openState->initiator_id = Auth::user()->id;
        $openState->record = DB::table('record_numbers')->value('counter') + 1;
        $openState->parent_id = $request->parent_id;
        $openState->division_code = $request->division_code;
        $openState->parent_type = $request->parent_type;
        $openState->division_id = $request->division_id;
        $openState->parent_id = $request->parent_id;
        $openState->parent_type = $request->parent_type;
        $openState->intiation_date = $request->intiation_date;
        $openState->assign_to = $request->assign_to;
        $openState->due_date = $request->due_date;
         $openState->Reference_Recores1 = implode(',', $request->related_records);
        $openState->short_description = $request->short_description;
        $openState->title = $request->title;
       // $openState->hod_preson = json_encode($request->hod_preson);
        $openState->hod_preson =  implode(',', $request->hod_preson);
        $openState->dept = $request->dept;
        $openState->description = $request->description;
        $openState->departments = $request->departments;
        $openState->initiatorGroup = $request->initiatorGroup;
        $openState->action_taken = $request->action_taken;
        $openState->start_date = $request->start_date;
        $openState->end_date = $request->end_date;
        $openState->comments = $request->comments;
        $openState->due_date_extension= $request->due_date_extension;
        $openState->qa_comments = $request->qa_comments;
        $openState->status = 'Opened';
        $openState->stage = 1;

        if (!empty($request->file_attach)) {
            $files = [];
            if ($request->hasfile('file_attach')) {
                foreach ($request->file('file_attach') as $file) {
                      
                    $name = $request->name . 'file_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            
            }
            $openState->file_attach = json_encode($files);
        }
        if (!empty($request->Support_doc)) {
            $files = [];
            if ($request->hasfile('Support_doc')) {
                foreach ($request->file('Support_doc') as $file) {
                    
                    $name = $request->name . 'Support_doc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            
            $openState->Support_doc = json_encode($files);
            }
        }
        $openState->save();
        $counter = DB::table('record_numbers')->value('counter');
        $recordNumber = str_pad($counter, 5, '0', STR_PAD_LEFT);
        $newCounter = $counter + 1;
        DB::table('record_numbers')->update(['counter' => $newCounter]);
 
        if (!empty($openState->title)) {
        $history = new ActionItemHistory();
        $history->cc_id = $openState->id;
        $history->activity_type = 'Title';
        $history->previous = "Null";
        $history->current =  $openState->title;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $openState->status;
        $history->save();
        }

        if (!empty($openState->dept)) {
        $history = new ActionItemHistory();
        $history->cc_id =  $openState->id;
        $history->activity_type = 'Responsible Department';
        $history->previous = "Null";
        $history->current =  $openState->dept;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $openState->status;
        $history->save();
        }
        
        if (!empty($openState->Reference_Recores1)) {
        $history = new ActionItemHistory();
        $history->cc_id =   $openState->id;
        $history->activity_type = 'Action Item Related Records';
        $history->previous = "Null";
        $history->current =  $openState->Reference_Recores1;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $openState->status;
        $history->save();
        }
        
          
        if (!empty($openState->short_description)) {
        $history = new ActionItemHistory();
        $history->cc_id =   $openState->id;
        $history->activity_type = 'Short Description';
        $history->previous = "Null";
        $history->current =  $openState->short_description;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $openState->status;
        $history->save();
        }
        
        if (!empty($openState->initiatorGroup)) {
            $history = new ActionItemHistory();
            $history->cc_id =   $openState->id;
            $history->activity_type = 'Inititator Group';
            $history->previous = "Null";
            $history->current =  $openState->initiatorGroup;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->save();
            }
            
          
        if (!empty($openState->assign_to)) {
            $history = new ActionItemHistory();
            $history->cc_id =   $openState->id;
            $history->activity_type = 'Assigned To';
            $history->previous = "Null";
            $history->current =  $openState->assign_to;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->save();
            }
        
            if (!empty($openState->description)) {
                $history = new ActionItemHistory();
                $history->cc_id =   $openState->id;
                $history->activity_type = 'Description';
                $history->previous = "Null";
                $history->current =  $openState->description;
                $history->comment = "NA";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $openState->status;
                $history->save();
                }
            
                if (!empty($openState->hod_preson)) {
                    $history = new ActionItemHistory();
                    $history->cc_id =   $openState->id;
                    $history->activity_type = 'HOD Persons';
                    $history->previous = "Null";
                    $history->current =  $openState->hod_preson;
                    $history->comment = "NA";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $openState->status;
                    $history->save();
                    }
                 if (!empty($openState->action_taken)) {
                    $history = new ActionItemHistory();
                    $history->cc_id =   $openState->id;
                    $history->activity_type = 'Action Taken';
                    $history->previous = "Null";
                    $history->current =  $openState->action_taken;
                    $history->comment = "NA";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $openState->status;
                    $history->save();
               }
               if (!empty($openState->start_date)) {
                $history = new ActionItemHistory();
                $history->cc_id =   $openState->id;
                $history->activity_type = 'Actual Start Date';
                $history->previous = "Null";
                $history->current =  $openState->start_date;
                $history->comment = "NA";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $openState->status;
                $history->save();
           }
           if (!empty($openState->end_date)) {
            $history = new ActionItemHistory();
            $history->cc_id =   $openState->id;
            $history->activity_type = 'Actual End Date';
            $history->previous = "Null";
            $history->current =  $openState->end_date;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->save();
       }
       if (!empty($openState->comments)) {
        $history = new ActionItemHistory();
        $history->cc_id =   $openState->id;
        $history->activity_type = 'Comments';
        $history->previous = "Null";
        $history->current =  $openState->comments;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $openState->status;
        $history->save();
   }
        if (!empty($openState->qa_comments)) {
            $history = new ActionItemHistory();
            $history->cc_id =   $openState->id;
            $history->activity_type = 'QA Review Comments';
            $history->previous = "Null";
            $history->current =  $openState->qa_comments;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->save();
        }

        if (!empty($openState->due_date_extension)) {
            $history = new ActionItemHistory();
            $history->cc_id =   $openState->id;
            $history->activity_type = 'Due Date Extension Justification';
            $history->previous = "Null";
            $history->current =  $openState->due_date_extension;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->save();
        }

        if (!empty($openState->file_attach)) {
            $history = new ActionItemHistory();
            $history->cc_id =   $openState->id;
            $history->activity_type = 'File Attachments';
            $history->previous = "Null";
            $history->current =  $openState->file_attach;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->save();
        }
        if (!empty($openState->Support_doc)) {
            $history = new ActionItemHistory();
            $history->cc_id =   $openState->id;
            $history->activity_type = 'Supporting Documents';
            $history->previous = "Null";
            $history->current =  $openState->Support_doc;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $openState->status;
            $history->save();
        }
   
   
                             
       
        toastr()->success('Document created');
        return redirect('rcms/qms-dashboard');
    }

    public function show($id)
    {

        $old_record = ActionItem::select('id', 'division_id', 'record')->get();
        $data = ActionItem::find($id);
        $cc = CC::find($data->cc_id);
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        // $taskdetails = Taskdetails::where('cc_id', $id)->first();
        // $checkeffec = CheckEffecVerifi::where('cc_id', $id)->first();
        // $comments = RefInfoComments::where('cc_id', $id)->first();
        // return $taskdetails;
        return view('frontend.action-item.atView', compact('data', 'cc','old_record'));
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {

        if (!$request->short_description) {
            toastr()->error("Short description is required");
            return redirect()->back();
        }
        $lastopenState = ActionItem::find($id);
        $openState = ActionItem::find($id);
        // $openState->related_records = $request->related_records;
        $openState->Reference_Recores1 = implode(',', $request->related_records);
        $openState->description = $request->description;
        $openState->title = $request->title;
        //$openState->hod_preson = json_encode($request->hod_preson);
        $openState->hod_preson =  implode(',', $request->hod_preson);
        // $openState->hod_preson = $request->hod_preson;
        $openState->dept = $request->dept;
        $openState->initiatorGroup = $request->initiatorGroup;
        $openState->action_taken = $request->action_taken;
        $openState->start_date = $request->start_date;
        $openState->end_date = $request->end_date;
        $openState->comments = $request->comments;
        $openState->qa_comments = $request->qa_comments;
        $openState->due_date_extension= $request->due_date_extension;
        $openState->assign_to = $request->assign_to;
        $openState->departments = $request->departments;

        $openState->short_description = $request->short_description;



        // $openState->status = 'Opened';
        // $openState->stage = 1;

        if (!empty($request->file_attach)) {
            $files = [];
            if ($request->hasfile('file_attach')) {
                foreach ($request->file('file_attach') as $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile) {  
                    $name = $request->name . 'file_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            }
            $openState->file_attach = json_encode($files);
        }

        if (!empty($request->Support_doc)) {
            $files = [];
            if ($request->hasfile('Support_doc')) {
                foreach ($request->file('Support_doc') as $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile) {  
                    $name = $request->name . 'Support_doc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            }
            $openState->Support_doc = json_encode($files);
        }

        
        $openState->update();


        // ----------------Action History--------------

        if ($lastopenState->title != $openState->title || !empty($request->title_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Title';
            $history->previous = $lastopenState->title;
            $history->current = $openState->title;
            $history->comment = $request->title_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }

        if ($lastopenState->dept != $openState->dept || !empty($request->dept_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Responsible Department';
            $history->previous = $lastopenState->dept;
            $history->current = $openState->dept;
            $history->comment = $request->dept_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }  
        if ($lastopenState->assign_to != $openState->assign_to || !empty($request->assign_to_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Assigned To';
            $history->previous = $lastopenState->assign_to;
            $history->current = $openState->assign_to;
            $history->comment = $request->dept_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }  
          
        if ($lastopenState->Reference_Recores1 != $openState->Reference_Recores1 || !empty($request->Reference_Recores1_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Action Item Related Records';
            $history->previous = $lastopenState->Reference_Recores1;
            $history->current = $openState->Reference_Recores1;
            $history->comment = $request->Reference_Recores1_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }

        if ($lastopenState->short_description != $openState->short_description || !empty($request->short_description_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastopenState->short_description;
            $history->current = $openState->short_description;
            $history->comment = $request->short_description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }
        if ($lastopenState->description != $openState->description || !empty($request->description_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Description';
            $history->previous = $lastopenState->description;
            $history->current = $openState->description;
            $history->comment = $request->description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }
        if ($lastopenState->hod_preson != $openState->hod_preson || !empty($request->hod_preson_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'HOD Persons';
            $history->previous = $lastopenState->hod_preson;
            $history->current = $openState->hod_preson;
            $history->comment = $request->hod_preson_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }
        if ($lastopenState->initiatorGroup != $openState->initiatorGroup || !empty($request->initiatorGroup_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;

            $history->activity_type = 'Inititator Group';
            $history->previous = $lastopenState->initiatorGroup;
            $history->current = $openState->initiatorGroup;
            $history->comment = $request->initiatorGroup_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }
        if ($lastopenState->action_taken != $openState->action_taken || !empty($request->action_taken_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Action Taken';
            $history->previous = $lastopenState->action_taken;
            $history->current = $openState->action_taken;
            $history->comment = $request->action_taken_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }
        if ($lastopenState->start_date != $openState->start_date || !empty($request->start_date_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Actual Start Date';
            $history->previous = $lastopenState->start_date;
            $history->current = $openState->start_date;
            $history->comment = $request->start_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }
        if ($lastopenState->end_date != $openState->end_date || !empty($request->end_date_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Actual End Date';
            $history->previous = $lastopenState->end_date;
            $history->current = $openState->end_date;
            $history->comment = $request->end_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }
        if ($lastopenState->comments != $openState->comments || !empty($request->comments_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Comments';
            $history->previous = $lastopenState->comments;
            $history->current = $openState->comments;
            $history->comment = $request->comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }
        if ($lastopenState->qa_comments != $openState->qa_comments || !empty($request->qa_comments_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA Review Comments';
            $history->previous = $lastopenState->qa_comments;
            $history->current = $openState->qa_comments;
            $history->comment = $request->qa_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }
        if ($lastopenState->due_date_extension != $openState->due_date_extension || !empty($request->due_date_extension_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'QA Review Comments';
            $history->previous = $lastopenState->due_date_extension;
            $history->current = $openState->due_date_extension;
            $history->comment = $request->due_date_extension_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }
        if ($lastopenState->file_attach != $openState->file_attach || !empty($request->file_attach_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'File Attachments';
            $history->previous = $lastopenState->file_attach;
            $history->current = $openState->file_attach;
            $history->comment = $request->file_attach_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }
        if ($lastopenState->Support_doc != $openState->Support_doc || !empty($request->Support_doc_comment)) {
            $history = new ActionItemHistory;
            $history->cc_id = $id;
            $history->activity_type = 'Supporting Documents';
            $history->previous = $lastopenState->Support_doc;
            $history->current = $openState->Support_doc;
            $history->comment = $request->Support_doc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->save();
        }
        toastr()->success('Document update');

        return back();
    }

    public function destroy($id)
    {
    }
    public function stageChange(Request $request, $id)
    {
        // return "hii";
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = ActionItem::find($id);
            $lastopenState = ActionItem::find($id);
            $openState = ActionItem::find($id);
            $task = Taskdetails::where('cc_id', $id)->first();
            if ($changeControl->stage == 1) {
                // $rules = [
                //     'action_taken' => 'required|max:255',

                // ];
                // $customMessages = [
                //     'action_taken.required' => 'The action taken field is required.',

                // ];
                // if ($task != null) {
                //     $validator = Validator::make($task->toArray(), $rules, $customMessages);
                    // if ($validator->fails()) {
                    //     $errorMessages = implode('<br>', $validator->errors()->all());
                    //     session()->put('errorMessages', $errorMessages);
                    //     return back();
                    // } else {
                //         $changeControl->stage = '2';
                //         $changeControl->status = 'Work In Progress';
                //         $changeControl->update();
                //         $history = new CCStageHistory();
                //         $history->type = "Action-Item";
                //         $history->doc_id = $id;
                //         $history->user_id = Auth::user()->id;
                //         $history->user_name = Auth::user()->name;
                //         $history->stage_id = $changeControl->stage;
                //         $history->status = $changeControl->status;
                //         $history->save();
                //         toastr()->success('Document Sent');

                //         return back();
                    
                // } else {
                    $changeControl->stage = '2';
                    $changeControl->status = 'Work In Progress';
                    $changeControl->submitted_by = Auth::user()->name;
                    $changeControl->submitted_on = Carbon::now()->format('d-M-Y');;
                        $history = new ActionItemHistory;
                        $history->cc_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->current = $changeControl->submitted_by;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastopenState->status;
                        $history->stage = "Submitted";
                        $history->save();
                    $changeControl->update();
                    $history = new CCStageHistory();
                    $history->type = "Action-Item";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $changeControl->stage;
                    $history->status = $changeControl->status;
                    $history->save();
                //     $list = Helpers::getActionOwnerUserList();
                //     foreach ($list as $u) {
                //         if($u->q_m_s_divisions_id == $openState->division_id){
                //             $email = Helpers::getInitiatorEmail($u->user_id);
                //              if ($email !== null) {
                          
                //               Mail::send(
                //                   'mail.view-mail',
                //                    ['data' => $openState],
                //                 function ($message) use ($email) {
                //                     $message->to($email)
                //                         ->subject("Document is Submitted By ".Auth::user()->name);
                //                 }
                //               );
                //             }
                //      } 
                //   }
                    toastr()->success('Document Sent');

                    return back();
                }
            
            if ($changeControl->stage == 2) {
                $changeControl->stage = '3';
                $changeControl->status = 'Closed-Done';
                $changeControl->completed_by = Auth::user()->name;
                $changeControl->completed_on = Carbon::now()->format('d-M-Y');
                      $history = new ActionItemHistory;
                        $history->cc_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->previous = $lastopenState->completed_by;
                        $history->current = $changeControl->completed_by;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastopenState->status;
                        $history->stage = "Completed";
                        $history->save();
                $changeControl->update();
                $history = new CCStageHistory();
                $history->type = "Action-Item";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
            //     $list = Helpers::getInitiatorUserList();
            //     foreach ($list as $u) {
            //         if($u->q_m_s_divisions_id == $openState->division_id){
            //             $email = Helpers::getInitiatorEmail($u->user_id);
            //              if ($email !== null) {
                      
            //               Mail::send(
            //                   'mail.view-mail',
            //                    ['data' => $openState],
            //                 function ($message) use ($email) {
            //                     $message->to($email)
            //                         ->subject("Document is Send By ".Auth::user()->name);
            //                 }
            //               );
            //             }
            //      } 
            //   }
                toastr()->success('Document Sent');

                return back();
            }
        } else {
            toastr()->error('E-signature Not match');

            return back();
        }
    }

//     public function stagecancel(Request $request, $id)
// {
//     if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
//         $actionItem = ActionItem::find($id);

//         $actionItem->status = "Closed-Cancelled";
//         $actionItem->cancelled_by = Auth::user()->name;
//         $actionItem->cancelled_on = Carbon::now()->format('d-M-Y');
//         $actionItem->update();

//         $history = new ActionItemHistory();
//         $history->type = "Action Item";
//         $history->doc_id = $id;
//         $history->user_id = Auth::user()->id;
//         $history->user_name = Auth::user()->name;
//         $history->status = $actionItem->status;
//         $history->save();

//         toastr()->success('Action Item Cancelled');
//         return back();
//     } else {
//         toastr()->error('E-signature does not match');
//         return back();
//     }
// }

public function actionStageCancel(Request $request, $id)
{
    if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
        $changeControl = ActionItem::find($id);
        $lastopenState = ActionItem::find($id);
        $openState = ActionItem::find($id);

        if ($changeControl->stage == 1) {
            $changeControl->stage = "0";
            $changeControl->status = "Closed-Cancelled";
            $changeControl->cancelled_by = Auth::user()->name;
            $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
                        $history = new ActionItemHistory;
                        $history->cc_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->current = $changeControl->cancelled_by;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastopenState->status;
                        $history->stage = "Cancelled";
                        $history->save();
            $changeControl->update();
            $history = new CCStageHistory();
            $history->type = "Action Item";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $changeControl->stage;
            $history->status = $changeControl->status;
            $history->save();
            // $list = Helpers::getActionOwnerUserList();
            //         foreach ($list as $u) {
            //             if($u->q_m_s_divisions_id == $openState->division_id){
            //                 $email = Helpers::getInitiatorEmail($u->user_id);
            //                  if ($email !== null) {
                          
            //                   Mail::send(
            //                       'mail.view-mail',
            //                        ['data' => $openState],
            //                     function ($message) use ($email) {
            //                         $message->to($email)
            //                             ->subject("Document is Cancel By ".Auth::user()->name);
            //                     }
            //                   );
            //                 }
            //          } 
            //       }
            toastr()->success('Document Sent');
            return redirect('rcms/actionItem/'.$id);
        }

        if ($changeControl->stage == 2) {
            $changeControl->stage = "1";
            $changeControl->status = "Opened";
            $changeControl->more_information_required_by = (string)Auth::user()->name;
            $changeControl->more_information_required_on = Carbon::now()->format('d-M-Y');
                        $history = new ActionItemHistory;
                        $history->cc_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->current = $changeControl->more_information_required_by;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastopenState->status;
                        $history->stage = "More Information Required";
                        $history->save();
            $changeControl->update();
            $history = new CCStageHistory();
            $history->type = "Action Item";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $changeControl->stage;
            $history->status = "More-information Required";
            $history->save();
        //     $list = Helpers::getInitiatorUserList();
        //     foreach ($list as $u) {
        //         if($u->q_m_s_divisions_id == $openState->division_id){
        //             $email = Helpers::getInitiatorEmail($u->user_id);
        //              if ($email !== null) {
                  
        //               Mail::send(
        //                   'mail.view-mail',
        //                    ['data' => $openState],
        //                 function ($message) use ($email) {
        //                     $message->to($email)
        //                         ->subject("Document is Send By ".Auth::user()->name);
        //                 }
        //               );
        //             }
        //      } 
        //   }
            toastr()->success('Document Sent');
            return redirect('rcms/actionItem/'.$id);
        }
    } else {
        toastr()->error('E-signature Not match');
        return back();
    }
}
public function actionItemAuditTrialShow($id)
{
    $audit = ActionItemHistory::where('cc_id', $id)->orderByDESC('id')->get()->unique('activity_type');
    $today = Carbon::now()->format('d-m-y');
    $document = ActionItem::where('id', $id)->first();
    $document->initiator = User::where('id', $document->initiator_id)->value('name');

    return view('frontend.action-item.audit-trial', compact('audit', 'document', 'today'));
}

public function actionItemAuditTrialDetails($id)
{
    $detail = ActionItemHistory::find($id);

    $detail_data = ActionItemHistory::where('activity_type', $detail->activity_type)->where('cc_id', $detail->cc_id)->latest()->get();

    $doc = ActionItem::where('id', $detail->cc_id)->first();

    $doc->origiator_name = User::find($doc->initiator_id);
    return view('frontend.action-item.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
}

public static function singleReport($id)
{
    $data = ActionItem::find($id);
    if (!empty($data)) {
        $data->originator = User::where('id', $data->initiator_id)->value('name');
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.action-item.singleReport', compact('data'))
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
        return $pdf->stream('ActionItem' . $id . '.pdf');
    }
}
public static function auditReport($id)
{
    $doc = ActionItem::find($id);
    if (!empty($doc)) {
        $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        $data = ActionItemHistory::where('cc_id', $id)->get();
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.action-item.auditReport', compact('data', 'doc'))
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
        return $pdf->stream('ActionItem-Audit' . $id . '.pdf');
    }
}
}
