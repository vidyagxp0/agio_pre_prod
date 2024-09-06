<?php

namespace App\Http\Controllers;

use App\Models\Deviation;
use App\Models\extension_new;
use App\Models\extension_new_audit_trail;
use App\Models\ExtensionAuditTrail;
use App\Models\ExtensionNewAuditTrail;
use App\Models\RecordNumber;
use App\Models\RoleGroup;
use App\Models\User;
use Helpers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;

class ExtensionNewController extends Controller
{

    public function index(Request $request){
        $data = "test";
        $record_numbers = (RecordNumber::first()->value('counter')) + 1;
        $record_number = str_pad($record_numbers, 4, '0', STR_PAD_LEFT);
        $reviewers = DB::table('user_roles')
                ->join('users', 'user_roles.user_id', '=', 'users.id')
                ->select('user_roles.q_m_s_processes_id', 'users.id','users.role','users.name') // Include all selected columns in the select statement
                ->where('user_roles.q_m_s_processes_id', 89)
                ->where('user_roles.q_m_s_roles_id', 2)
                ->groupBy('user_roles.q_m_s_processes_id', 'users.id','users.role','users.name') // Include all selected columns in the group by clause
                ->get();
        $approvers = DB::table('user_roles')
                ->join('users', 'user_roles.user_id', '=', 'users.id')
                ->select('user_roles.q_m_s_processes_id', 'users.id','users.role','users.name') // Include all selected columns in the select statement
                ->where('user_roles.q_m_s_processes_id', 89)
                ->where('user_roles.q_m_s_roles_id', 1)
                ->groupBy('user_roles.q_m_s_processes_id', 'users.id','users.role','users.name') // Include all selected columns in the group by clause
                ->get();
       $pre = [
     'DEV' => \App\Models\Deviation::class,
    'AP' => \App\Models\AuditProgram::class,
    'AI' => \App\Models\ActionItem::class,
    'Exte' => \App\Models\extension_new::class,
    'Resam' => \App\Models\Resampling::class,
    'Obse' => \App\Models\Observation::class,
    'RCA' => \App\Models\RootCauseAnalysis::class,
    'RA' => \App\Models\RiskAssessment::class,
    'MR' => \App\Models\ManagementReview::class,
    'EA' => \App\Models\Auditee::class,
    'IA' => \App\Models\InternalAudit::class,
    'CAPA' => \App\Models\Capa::class,
    'CC' => \App\Models\CC::class,
    'ND' => \App\Models\Document::class,
    'Lab' => \App\Models\LabIncident::class,
    'EC' => \App\Models\EffectivenessCheck::class,
    'OOSChe' => \App\Models\OOS::class,
    'OOT' => \App\Models\OOT::class,
    'OOC' => \App\Models\OutOfCalibration::class,
    'MC' => \App\Models\MarketComplaint::class,
    'NC' => \App\Models\NonConformance::class,
    'Incident' => \App\Models\Incident::class,
    'FI' => \App\Models\FailureInvestigation::class,
    'ERRATA' => \App\Models\Errata::class,
    'OOSMicr' => \App\Models\OOS_micro::class,     
    // Add other models as necessary...
];

// Create an empty collection to store the related records
$relatedRecords = collect();

// Loop through each model and get the records, adding the process name to each record
foreach ($pre as $processName => $modelClass) {
    $records = $modelClass::all()->map(function ($record) use ($processName) {
        $record->process_name = $processName; // Attach the process name to each record
        return $record;
    });

    // Merge the records into the collection
    $relatedRecords = $relatedRecords->merge($records);
}

        return View('frontend.extension.extension_new', compact('data', 'reviewers', 'approvers','relatedRecords', 'record_number'));
    }
    public function store(Request $request)
    {
        $request->validate([
        //     'site_location_code' => 'required|string',
        //     'initiator' => 'required|string',
        //     'initiation_date' => 'required|date',
            'short_description' => 'required|string',
        //     'reviewers' => 'required|json',
        //     'approvers' => 'required|json',
        //     'current_due_date' => 'required|date',
        //     'proposed_due_date' => 'required|date',
            // 'description' => 'required|string',
        //     'file_attachment_extension' => 'required|string',
        //     'reviewer_remarks' => 'nullable|string',
        //     'file_attachment_reviewer' => 'nullable|string',
        //     'approver_remarks' => 'nullable|string',
        //     'file_attachment_approver' => 'nullable|string',
        ]);
    
        $extensionNew = new extension_new();
        $extensionNew->type = "Extension";
        $extensionNew->stage = "1";
        $extensionNew->status = "Opened";

        $extensionNew->record_number = DB::table('record_numbers')->value('counter') + 1;
        $extensionNew->site_location_code = $request->site_location_code;
        $extensionNew->initiator = Auth::user()->id;
        $extensionNew->record = $request->record;
        // dd($request->record_number);
        $extensionNew->parent_id = $request->parent_id;
        $extensionNew->parent_type = $request->parent_type;
        $extensionNew->parent_record = $request->parent_record;

        $extensionNew->initiation_date = $request->initiation_date;
        $extensionNew->related_records = implode(',', $request->related_records);
        $extensionNew->short_description = $request->short_description;
        $extensionNew->reviewers = $request->reviewers;
        $extensionNew->approvers = $request->approvers;
        $extensionNew->current_due_date = $request->current_due_date;
        $extensionNew->proposed_due_date = $request->proposed_due_date;
        $extensionNew->description = $request->description;
        $extensionNew->justification_reason = $request->justification_reason;
        $extensionNew->file_attachment_extension = $request->file_attachment_extension;
        $extensionNew->reviewer_remarks = $request->reviewer_remarks;
        $extensionNew->file_attachment_reviewer = $request->file_attachment_reviewer;
        $extensionNew->approver_remarks = $request->approver_remarks;
        $extensionNew->file_attachment_approver = $request->file_attachment_approver;
    
        $counter = DB::table('record_numbers')->value('counter');
        // Generate the record number with leading zeros
        $record_number = str_pad($counter, 5, '0', STR_PAD_LEFT);
        // Increment the counter value
        $newCounter = $counter + 1;
        DB::table('record_numbers')->update(['counter' => $newCounter]);
        
        // if (!empty ($request->file_attachment_extension)) {
        //     $files = [];
        //     if ($request->hasfile('file_attachment_extension')) {
        //         foreach ($request->file('file_attachment_extension') as $file) {
        //             $name = $request->name . 'file_attachment_extension' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }


        //     $extensionNew->file_attachment_extension = json_encode($files);
        // }
        

        if (!empty ($request->file_attachment_reviewer)) {
            $files = [];
            if ($request->hasfile('file_attachment_reviewer')) {
                foreach ($request->file('file_attachment_reviewer') as $file) {
                    $name = $request->name . 'file_attachment_reviewer' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $extensionNew->file_attachment_reviewer = json_encode($files);
        }

        if (!empty ($request->file_attachment_approver)) {
            $files = [];
            if ($request->hasfile('file_attachment_approver')) {
                foreach ($request->file('file_attachment_approver') as $file) {
                    $name = $request->name . 'file_attachment_approver' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $extensionNew->file_attachment_approver = json_encode($files);
        }


        $extensionNew->save();
        if (!empty ($request->record_number)){
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Record Number';
            $history->previous = "Null";
            $history->current = $extensionNew->record_number;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $extensionNew->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->initiator)){
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = $extensionNew->initiator;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $extensionNew->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->short_description)){
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $extensionNew->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $extensionNew->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->current_due_date)){
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Current Due Date (Parent)';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($extensionNew->current_due_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $extensionNew->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->proposed_due_date)){
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Proposed Due Date';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($extensionNew->proposed_due_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $extensionNew->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->description)){
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Description';
            $history->previous = "Null";
            $history->current = $extensionNew->description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $extensionNew->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
          if (!empty ($request->related_records)){
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Related Records';
            $history->previous = "Null";
            $history->current = $extensionNew->related_records;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $extensionNew->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->justification_reason)){
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Justification / Reason';
            $history->previous = "Null";
            $history->current = $extensionNew->justification_reason;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $extensionNew->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty ($request->reviewer_remarks)){
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Reviewer Remarks';
            $history->previous = "Null";
            $history->current = $extensionNew->reviewer_remarks;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $extensionNew->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty ($request->approver_remarks)){
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Approver Remarks';
            $history->previous = "Null";
            $history->current = $extensionNew->approver_remarks;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $extensionNew->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        // return redirect()->back()->with('success', 'Induction training data saved successfully!');
        // return redirect()->route('TMS.index')->with('success', 'Induction training data saved successfully!');
        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));

    }

    public function show(Request $request,$id){
        $extensionNew = extension_new::find($id);
        $count = extension_new::where('parent_type' , 'LabIncident')->get()->count();
             $pre = [
    'DEV' => \App\Models\Deviation::class,
    'AP' => \App\Models\AuditProgram::class,
    'AI' => \App\Models\ActionItem::class,
    'Exte' => \App\Models\extension_new::class,
    'Resam' => \App\Models\Resampling::class,
    'Obse' => \App\Models\Observation::class,
    'RCA' => \App\Models\RootCauseAnalysis::class,
    'RA' => \App\Models\RiskAssessment::class,
    'MR' => \App\Models\ManagementReview::class,
    'EA' => \App\Models\Auditee::class,
    'IA' => \App\Models\InternalAudit::class,
    'CAPA' => \App\Models\Capa::class,
    'CC' => \App\Models\CC::class,
    'ND' => \App\Models\Document::class,
    'Lab' => \App\Models\LabIncident::class,
    'EC' => \App\Models\EffectivenessCheck::class,
    'OOSChe' => \App\Models\OOS::class,
    'OOT' => \App\Models\OOT::class,
    'OOC' => \App\Models\OutOfCalibration::class,
    'MC' => \App\Models\MarketComplaint::class,
    'NC' => \App\Models\NonConformance::class,
    'Incident' => \App\Models\Incident::class,
    'FI' => \App\Models\FailureInvestigation::class,
    'ERRATA' => \App\Models\Errata::class,
    'OOSMicr' => \App\Models\OOS_micro::class,   
    // Add other models as necessary...
];

// Create an empty collection to store the related records
$relatedRecords = collect();

// Loop through each model and get the records, adding the process name to each record
foreach ($pre as $processName => $modelClass) {
    $records = $modelClass::all()->map(function ($record) use ($processName) {
        $record->process_name = $processName; // Attach the process name to each record
        return $record;
    });

    // Merge the records into the collection
    $relatedRecords = $relatedRecords->merge($records);
}

        $reviewers = DB::table('user_roles')
                ->join('users', 'user_roles.user_id', '=', 'users.id')
                ->select('user_roles.q_m_s_processes_id', 'users.id','users.role','users.name') // Include all selected columns in the select statement
                ->where('user_roles.q_m_s_processes_id', 89)
                ->where('user_roles.q_m_s_roles_id', 2)
                ->groupBy('user_roles.q_m_s_processes_id', 'users.id','users.role','users.name') // Include all selected columns in the group by clause
                ->get();
        $approvers = DB::table('user_roles')
                ->join('users', 'user_roles.user_id', '=', 'users.id')
                ->select('user_roles.q_m_s_processes_id', 'users.id','users.role','users.name') // Include all selected columns in the select statement
                ->where('user_roles.q_m_s_processes_id', 89)
                ->where('user_roles.q_m_s_roles_id', 1)
                ->groupBy('user_roles.q_m_s_processes_id', 'users.id','users.role','users.name') // Include all selected columns in the group by clause
                ->get();
        return view('frontend.extension.extension_view', compact('extensionNew','reviewers','approvers','count','relatedRecords'));

    }

    public function update(Request $request,$id){

        $extensionNew = extension_new::find($id);
        $extensionNew->site_location_code = $request->site_location_code;
        $extensionNew->initiator = Auth::user()->id;
        $lastDocument = extension_new::find($id);
        

        // dd($request->initiator);
        $extensionNew->initiation_date = $request->initiation_date;
        $extensionNew->related_records = implode(',', $request->related_records);
        $extensionNew->short_description = $request->short_description;
        $extensionNew->reviewers = $request->reviewers;
        $extensionNew->approvers = $request->approvers;
        $extensionNew->current_due_date = $request->current_due_date;
        $extensionNew->proposed_due_date = $request->proposed_due_date;
        $extensionNew->description = $request->description;
        $extensionNew->justification_reason = $request->justification_reason;
        // $extensionNew->file_attachment_extension = $request->file_attachment_extension;
        $extensionNew->reviewer_remarks = $request->reviewer_remarks;
        $extensionNew->file_attachment_reviewer = $request->file_attachment_reviewer;
        $extensionNew->approver_remarks = $request->approver_remarks;
        $extensionNew->file_attachment_approver = $request->file_attachment_approver;
        
        // if (!empty ($request->file_attachment_extension)) {
        //     $files = [];
        //     if ($request->hasfile('file_attachment_extension')) {
        //         foreach ($request->file('file_attachment_extension') as $file) {
        //             $name = $request->name . 'file_attachment_extension' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }


        //     $extensionNew->file_attachment_extension = json_encode($files);
        // }

        $files = is_array($request->existing_attach_files_c) ? $request->existing_attach_files_c : null;

        if (!empty($request->file_attachment_extension)) {
            if ($extensionNew->file_attachment_extension) {
                $existingFiles = json_decode($extensionNew->file_attachment_extension, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = $existingFiles;
                }
            }

            if ($request->hasfile('file_attachment_extension')) {
                foreach ($request->file('file_attachment_extension') as $file) {
                    $name = $request->name . 'file_attachment_extension' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
        }
        $extensionNew->file_attachment_extension = !empty($files) ? json_encode($files) : null;
        // if (!empty ($request->file_attachment_reviewer)) {
        //     $files = [];
        //     if ($request->hasfile('file_attachment_reviewer')) {
        //         foreach ($request->file('file_attachment_reviewer') as $file) {
        //             $name = $request->name . 'file_attachment_reviewer' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }


        //     $extensionNew->file_attachment_reviewer = json_encode($files);
        // }

        if (!empty($request->file_attachment_reviewer)) {
            $files = [];
            if ($request->hasfile('file_attachment_reviewer')) {
                foreach ($request->file('file_attachment_reviewer') as $file) {
                    $name = 'HOD' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $extensionNew->file_attachment_reviewer = json_encode($files);
        }

        // if (!empty ($request->file_attachment_approver)) {
        //     $files = [];
        //     if ($request->hasfile('file_attachment_approver')) {
        //         foreach ($request->file('file_attachment_approver') as $file) {
        //             $name = $request->name . 'file_attachment_approver' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }


        //     $extensionNew->file_attachment_approver = json_encode($files);
        // }

        if (!empty($request->file_attachment_approver)) {
            $files = [];
            if ($request->hasfile('file_attachment_approver')) {
                foreach ($request->file('file_attachment_approver') as $file) {
                    $name = 'QA' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $extensionNew->file_attachment_approver = json_encode($files);
        }

        $extensionNew->save();

        if ($lastDocument->short_description != $extensionNew->short_description ) {
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastDocument->short_description;
            $history->current = $extensionNew->short_description;
            $history->comment = $request->short_description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->short_description) || $lastDocument->short_description === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
           
        }
        
      
        if ($lastDocument->reviewers != $extensionNew->reviewers ) {
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'HOD review';
            $history->previous = $lastDocument->reviewers;
            $history->current = $extensionNew->reviewers;
            $history->comment = $request->reviewers_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->reviewers) || $lastDocument->reviewers === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
           
        }
        
      
        if ($lastDocument->approvers != $extensionNew->approvers ) {
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'QA approval';
            $history->previous = $lastDocument->approvers;
            $history->current = $extensionNew->approvers;
            $history->comment = $request->approvers_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->approvers) || $lastDocument->approvers === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
           
        }
        
      
        if ($lastDocument->current_due_date != $extensionNew->current_due_date ) {
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Current Due Date (Parent)';
            $history->previous = Helpers::getdateFormat($lastDocument->current_due_date);
            $history->current = Helpers::getdateFormat($extensionNew->current_due_date);
            $history->comment = $request->current_due_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->current_due_date) || $lastDocument->current_due_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
           
        }
        
      
        if ($lastDocument->proposed_due_date != $extensionNew->proposed_due_date ) {
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Proposed Due Date';
            $history->previous = Helpers::getdateFormat($lastDocument->proposed_due_date);
            $history->current = Helpers::getdateFormat($extensionNew->proposed_due_date);
            $history->comment = $request->proposed_due_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->proposed_due_date) || $lastDocument->proposed_due_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
           
        }
         if ($lastDocument->related_records != $extensionNew->related_records ) {
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Related Record';
            $history->previous = $lastDocument->related_records;
            $history->current = $extensionNew->related_records;
            $history->comment = $request->related_records_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->related_records) || $lastDocument->related_records === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
           
        }
        
        
      
        if ($lastDocument->description != $extensionNew->description ) {
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Description';
            $history->previous = $lastDocument->description;
            $history->current = $extensionNew->description;
            $history->comment = $request->short_description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->description) || $lastDocument->description === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
           
        }
        
      
        if ($lastDocument->justification_reason != $extensionNew->justification_reason ) {
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Justification / Reason';
            $history->previous = $lastDocument->justification_reason;
            $history->current = $extensionNew->justification_reason;
            $history->comment = $request->justification_reason_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->justification_reason) || $lastDocument->justification_reason === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
           
        }
        
      
        if ($lastDocument->file_attachment_extension != $extensionNew->file_attachment_extension ) {
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'Attachments';
            $history->previous = $lastDocument->file_attachment_extension;
            $history->current = $extensionNew->file_attachment_extension;
            $history->comment = $request->short_description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->file_attachment_extension) || $lastDocument->file_attachment_extension === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
           
        }
        
      
        if ($lastDocument->reviewer_remarks != $extensionNew->reviewer_remarks ) {
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'HOD Remarks';
            $history->previous = $lastDocument->reviewer_remarks;
            $history->current = $extensionNew->reviewer_remarks;
            $history->comment = $request->reviewer_remarks_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->reviewer_remarks) || $lastDocument->reviewer_remarks === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
           
        }
        
      
        if ($lastDocument->file_attachment_reviewer != $extensionNew->file_attachment_reviewer ) {
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'HOD Attachment';
            $history->previous = $lastDocument->file_attachment_reviewer;
            $history->current = $extensionNew->file_attachment_reviewer;
            $history->comment = $request->short_description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->file_attachment_reviewer) || $lastDocument->file_attachment_reviewer === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
           
        }
        
      
        if ($lastDocument->approver_remarks != $extensionNew->approver_remarks ) {
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'QA Remarks';
            $history->previous = $lastDocument->approver_remarks;
            $history->current = $extensionNew->approver_remarks;
            $history->comment = $request->approver_remarks_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->approver_remarks) || $lastDocument->approver_remarks === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
           
        }
        
      
        if ($lastDocument->file_attachment_approver != $extensionNew->file_attachment_approver ) {
            $history = new ExtensionNewAuditTrail();
            $history->extension_id = $extensionNew->id;
            $history->activity_type = 'QA Attachment';
            $history->previous = $lastDocument->file_attachment_approver;
            $history->current = $extensionNew->file_attachment_approver;
            $history->comment = $request->file_attachment_approver_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->file_attachment_approver) || $lastDocument->file_attachment_approver === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
           
        }
        
      
        toastr()->success("Record is created Successfully");
        return redirect()->back();
    }

    public function reject(Request $request,$id){
        try {
            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $extensionNew = extension_new::find($id);
                $lastDocument = extension_new::find($id);

                if ($extensionNew->stage == 1) {

                    $extensionNew->stage = "0";
                    $extensionNew->status = "Closed Cancelled";
                    $extensionNew->reject_by = Auth::user()->name;
                    $extensionNew->reject_on = Carbon::now()->format('d-M-Y');
                    $extensionNew->reject_comment = $request->comment;

                    $history = new ExtensionNewAuditTrail();
                    $history->extension_id = $id;
                    $history->activity_type = 'Cancel By, Cancel On';
                    if (is_null($lastDocument->reject_by) || $lastDocument->reject_by === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->reject_by . ' , ' . $lastDocument->reject_on;
                    }
                    $history->current = $extensionNew->reject_by . ' , ' . $extensionNew->reject_on;
                    $history->action='Cancel';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Closed - Cancelled";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Closed - Cancelled';
                    if (is_null($lastDocument->reject_by) || $lastDocument->reject_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    
                    $extensionNew->update();
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
    public function moreinfoStateChange(Request $request,$id){
        try {
            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $extensionNew = extension_new::find($id);
                $lastDocument = extension_new::find($id);

                if ($extensionNew->stage == 2) {

                    $extensionNew->stage = "1";
                    $extensionNew->status = "Opened";
                    $extensionNew->more_info_review_by = Auth::user()->name;
                    $extensionNew->more_info_review_on = Carbon::now()->format('d-M-Y');
                    $extensionNew->more_info_review_comment = $request->comment;

                    $history = new ExtensionNewAuditTrail();
                    $history->extension_id = $id;
                    $history->activity_type = 'More Info Required By, More Info Required On';
                    if (is_null($lastDocument->more_info_review_by) || $lastDocument->more_info_review_by === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_review_by . ' , ' . $lastDocument->more_info_review_on;
                    }
                    $history->current = $extensionNew->more_info_review_by . ' , ' . $extensionNew->more_info_review_on;
                    $history->action='More Info Required';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "In Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'In Review';
                    if (is_null($lastDocument->more_info_review_by) || $lastDocument->more_info_review_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    
                    $extensionNew->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($extensionNew->stage == 3) {


                    $extensionNew->stage = "2";
                    $extensionNew->status = "In Review";
                    $extensionNew->more_info_inapproved_by = Auth::user()->name;
                    $extensionNew->more_info_inapproved_on = Carbon::now()->format('d-M-Y');
                    $extensionNew->more_info_inapproved_comment = $request->comment;

                    $history = new ExtensionNewAuditTrail();
                    $history->extension_id = $id;
                    $history->activity_type = 'More Info Required By, More Info Required On';
                    if (is_null($lastDocument->more_info_inapproved_by) || $lastDocument->more_info_inapproved_by === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_inapproved_by . ' , ' . $lastDocument->more_info_inapproved_on;
                    }
                    $history->current = $extensionNew->more_info_inapproved_by . ' , ' . $extensionNew->more_info_inapproved_on;
                    $history->action='More Info Required';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "In Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'In Review';
                    if (is_null($lastDocument->more_info_inapproved_by) || $lastDocument->more_info_inapproved_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();

                    $extensionNew->update();
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
    public function sendstage(Request $request,$id){
        try {
            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $extensionNew = extension_new::find($id);
                $lastDocument = extension_new::find($id);

                if ($extensionNew->stage == 1) {

                    $extensionNew->stage = "2";
                    $extensionNew->status = "In Review";
                    $extensionNew->submit_by = Auth::user()->name;
                    $extensionNew->submit_on = Carbon::now()->format('d-M-Y');
                    $extensionNew->submit_comment = $request->comment;

                    $history = new ExtensionNewAuditTrail();
                    $history->extension_id = $id;
                    $history->activity_type = 'Submit By, Submit On';
                    if (is_null($lastDocument->submit_by) || $lastDocument->submit_by === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->submit_by . ' , ' . $lastDocument->submit_on;
                    }
                    $history->current = $extensionNew->submit_by . ' , ' . $extensionNew->submit_on;
                    $history->action='Submit';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "In Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'In Review';
                    if (is_null($lastDocument->submit_by) || $lastDocument->submit_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();


                    // $list = Helpers::getHodUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $extensionNew->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {

                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $extensionNew],
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
                    //     if ($u->q_m_s_divisions_id == $extensionNew->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {

                    //             Mail::send(
                    //                 'mail.Categorymail',
                    //                 ['data' => $extensionNew],
                    //                 function ($message) use ($email) {
                    //                     $message->to($email)
                    //                         ->subject("Activity Performed By " . Auth::user()->name);
                    //                 }
                    //             );
                    //         }
                    //     }
                    // }
                    // dd($extensionNew);
                    $extensionNew->update();
                    return back();
                }
                if ($extensionNew->stage == 2) {
                    $extensionNew->stage = "3";
                    $extensionNew->status = "In Approved";
                    $extensionNew->submit_by_review = Auth::user()->name;
                    $extensionNew->submit_on_review = Carbon::now()->format('d-M-Y');
                    $extensionNew->submit_comment_review = $request->comment;

                    $history = new ExtensionNewAuditTrail();
                    $history->extension_id = $id;
                    // $history->activity_type = 'Activity Log';
                    $history->activity_type = 'Review By, Review On';
                    if (is_null($lastDocument->submit_by_review) || $lastDocument->submit_by_review === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->submit_by_review . ' , ' . $lastDocument->submit_on_review;
                    }
                    $history->current = $extensionNew->submit_by_review . ' , ' . $extensionNew->submit_on_review;
                    $history->comment = $request->comment;
                    $history->action= 'Review';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "In Approved";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'In Approved';
                    if (is_null($lastDocument->submit_by_review) || $lastDocument->submit_by_review === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();

                    // dd($history->action);
                    // $list = Helpers::getQAUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $extensionNew->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $extensionNew],
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
                    $extensionNew->update();
                    toastr()->success('Document Sent');
                    return back();
                }      
             
                if ($extensionNew->stage == 3) {

                    $extensionNew->stage = "4";
                    $extensionNew->status = "Closed - Reject";


                    $extensionNew->submit_by_inapproved = Auth::user()->name;
                    $extensionNew->submit_on_inapproved = Carbon::now()->format('d-M-Y');
                    $extensionNew->submit_commen_inapproved = $request->comment;

                    $history = new ExtensionNewAuditTrail();
                    $history->extension_id = $id;
                    $history->activity_type = 'Reject By, Reject On';
                    if (is_null($lastDocument->submit_by_inapproved) || $lastDocument->submit_by_inapproved === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->submit_by_inapproved . ' , ' . $lastDocument->submit_on_inapproved;
                    }
                    $history->current = $extensionNew->submit_by_inapproved . ' , ' . $extensionNew->submit_on_inapproved;
                    $history->action= 'Reject';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->change_to =   "Closed - Reject";
                    $history->change_from = $lastDocument->status;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = 'Closed - Reject';
                    if (is_null($lastDocument->submit_by_inapproved) || $lastDocument->submit_by_inapproved === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getQAUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $extensionNew->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $extensionNew],
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
                    $extensionNew->update();
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
public function sendCQA(Request $request,$id)
{
    try {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $extensionNew = extension_new::find($id);
            $lastDocument = extension_new::find($id);

            if ($extensionNew->stage == 3) {

                $extensionNew->stage = "5";
                $extensionNew->status = "In CQA Approval";


                $extensionNew->send_cqa_by = Auth::user()->name;
                $extensionNew->send_cqa_on = Carbon::now()->format('d-M-Y');
                $extensionNew->send_cqa_comment = $request->comment;

                $history = new ExtensionNewAuditTrail();
                $history->deviation_id = $id;
                $history->activity_type = ' Send for CQA By,  Send for CQA On';
                    if (is_null($lastDocument->send_cqa_by) || $lastDocument->send_cqa_by === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->send_cqa_by . ' , ' . $lastDocument->send_cqa_on;
                    }
                    $history->current = $extensionNew->send_cqa_by . ' , ' . $extensionNew->send_cqa_on;
                $history->action= ' Send for CQA';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->change_to ="In CQA Approval";
                $history->change_from = $lastDocument->status;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'In CQA Approval';
                if (is_null($lastDocument->send_cqa_by) || $lastDocument->send_cqa_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
                // $list = Helpers::getQAUserList();
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $extensionNew->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $extensionNew],
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
                $extensionNew->update();
                toastr()->success('Document Sent');
                return back();
            }
           
            if ($extensionNew->stage == 5) {

                $extensionNew->stage = "6";
                $extensionNew->status = "Closed - Done";


                $extensionNew->cqa_approval_by = Auth::user()->name;
                $extensionNew->cqa_approval_on = Carbon::now()->format('d-M-Y');
                $extensionNew->cqa_approval_comment = $request->comment;

                $history = new ExtensionNewAuditTrail();
                $history->extension_id = $id;
                $history->activity_type = 'CQA Approval Complete By, CQA Approval Complete On';
                    if (is_null($lastDocument->cqa_approval_by) || $lastDocument->cqa_approval_by === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->cqa_approval_by . ' , ' . $lastDocument->cqa_approval_on;
                    }
                    $history->current = $extensionNew->cqa_approval_by . ' , ' . $extensionNew->cqa_approval_on;
                $history->action= 'CQA Approval Complete';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->change_to =   "Closed - Done";
                $history->change_from = $lastDocument->status;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'Closed - Done';
                if (is_null($lastDocument->cqa_approval_by) || $lastDocument->cqa_approval_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
                // $list = Helpers::getQAUserList();
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $extensionNew->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $extensionNew],
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
                $extensionNew->update();
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
public static function sendApproved(Request $request,$id)
{
    try {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $extensionNew = extension_new::find($id);
            $lastDocument = extension_new::find($id);

            if ($extensionNew->stage == 3) {

                    $extensionNew->stage = "6";
                    $extensionNew->status = "Closed - Done";


                    $extensionNew->submit_by_approved = Auth::user()->name;
                    $extensionNew->submit_on_approved = Carbon::now()->format('d-M-Y');
                    $extensionNew->submit_comment_approved = $request->comment;

                    $history = new ExtensionNewAuditTrail();
                    $history->extension_id = $id;
                    $history->activity_type = 'Approved By, Approved On';
                        if (is_null($lastDocument->cqa_approval_by) || $lastDocument->cqa_approval_by === '') {
                            $history->previous = "Null";
                        } else {
                            $history->previous = $lastDocument->cqa_approval_by . ' , ' . $lastDocument->cqa_approval_on;
                        }
                        $history->current = $extensionNew->cqa_approval_by . ' , ' . $extensionNew->cqa_approval_on;
                    $history->action= 'Approved';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->change_to =   "Closed - Done";
                    $history->change_from = $lastDocument->status;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = 'Closed - Done';
                    if (is_null($lastDocument->cqa_approval_by) || $lastDocument->cqa_approval_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();

                    $extensionNew->update();
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
    
    public static function singleReport($id)
    {
        $data = extension_new::find($id);
        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.extension.singleReportNew', compact('data'))
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
            return $pdf->stream('Extension' . $id . '.pdf');
        }
    }
    public function extensionNewAuditTrail($id)
    {
        $audit = ExtensionNewAuditTrail::where('extension_id', $id)->orderByDesc('id')->paginate(5);
        // dd($audit);
        $today = Carbon::now()->format('d-m-y');
        $document = extension_new::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator)->value('name');
        
       // dd($document);
        return view('frontend.extension.audit_trailNew', compact('audit', 'document', 'today'));
    }

    public static function auditReport($id)
    {
        $doc = extension_new::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $data = ExtensionNewAuditTrail::where('extension_id', $id)->get();
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.extension.auditReport', compact('data', 'doc'))
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
            return $pdf->stream('Extension-Audit' . $id . '.pdf');
        }
    }
}
