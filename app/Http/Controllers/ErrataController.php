<?php

namespace App\Http\Controllers;

use App\Models\errata;
use App\Models\ErrataAuditTrail;
use App\Models\ErrataGrid;
use App\Models\RoleGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\RecordNumber;
use Illuminate\Support\Facades\Mail;
use App\Models\AddColumnErrataNew;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use App\Models\QMSDivision;
use PDF;
use Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class ErrataController extends Controller
{
    public function index()
    {
        $old_record = errata::select('id', 'division_id', 'record')->get();
        // $showdata = errata::find($id);
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);

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
            'ERRATA' => \App\Models\errata::class,
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



        return view('frontend.errata.errata_new', compact('record_number', 'relatedRecords'));
        // $erratagridnew = ErrataGrid::where('id', $id)->latest()->first();

    }

    public function store(Request $request)
    {

        $data = new errata();
        $data->record = ((RecordNumber::first()->value('counter')) + 1);
        $data->division_id = $request->division_id;
        $data->initiator_id = Auth::user()->id;
        $data->intiation_date = $request->intiation_date;
        $data->initiated_by = $request->initiated_by;
        // new added lines
        $data->department_head_to = $request->department_head_to;
        $data->document_title = $request->document_title;
        $data->qa_reviewer = $request->qa_reviewer;
        //$data->reference  = implode(',', $request->reference);
        $data->reference = $request->reference;
        $data->type = "ERRATA";
        $data->Department = $request->Department;
    //  dd($data->Initiator_Group);
        $data->department_code = $request->department_code;
        $data->document_type = $request->document_type;
        $data->document_type_others = $request->document_type_others;
        $data->short_description = $request->short_description;

        if ($request->input('type_of_error') == 'Other') {
            $data->otherFieldsUser = $request->input('otherFieldsUser');
        } else {
            $data->otherFieldsUser = null; // or handle it accordingly
        }



        $data->Observation_on_Page_No = $request->Observation_on_Page_No;
        $data->brief_description = $request->brief_description;
        $data->type_of_error = $request->type_of_error;

        $data->Correction_Of_Error = $request->Correction_Of_Error;
        $data->Approval_Comment = $request->Approval_Comment;
        $data->HOD_Comment1 = $request->HOD_Comment1;
        $data->QA_Comment1 = $request->QA_Comment1;


        $data->Date_and_time_of_correction = $request->Date_and_time_of_correction ? Carbon::parse($request->Date_and_time_of_correction)->format('d-M-Y') : '';
        $data->QA_Feedbacks = $request->QA_Feedbacks;

        if (!empty($request->QA_Attachments)) {
            $files = [];
            if ($request->hasFile('QA_Attachments')) {
                foreach ($request->file('QA_Attachments') as $file) {
                    $name = $request->name . 'QA_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $files[] = $name;
                }
            }
            $data->QA_Attachments = json_encode($files);
        }

        $data->HOD_Remarks = $request->HOD_Remarks;

        if (!empty($request->HOD_Attachments)) {
            $files = [];
            if ($request->hasFile('HOD_Attachments')) {
                foreach ($request->file('HOD_Attachments') as $file) {
                    $name = $request->name . 'HOD_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $files[] = $name;
                }
            }
            $data->HOD_Attachments = json_encode($files);
        }
        $data->Closure_Comments = $request->Closure_Comments;
        $data->All_Impacting_Documents_Corrected = $request->All_Impacting_Documents_Corrected;
        $data->Remarks = $request->Remarks;

        if (!empty($request->Closure_Attachments)) {
            $files = [];
            if ($request->hasFile('Closure_Attachments')) {
                foreach ($request->file('Closure_Attachments') as $file) {
                    $name = $request->name . 'Closure_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $files[] = $name;
                }
            }
            $data->Closure_Attachments = json_encode($files);
        }

        if (!empty($request->Initiator_Attachments)) {
            $files = [];
            if ($request->hasFile('Initiator_Attachments')) {
                foreach ($request->file('Initiator_Attachments') as $file) {
                    $name = $request->name . 'Initiator_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $files[] = $name;
                }
            }
            $data->Initiator_Attachments = json_encode($files);
        }

        if (!empty($request->Approval_Attachments)) {
            $files = [];
            if ($request->hasFile('Approval_Attachments')) {
                foreach ($request->file('Approval_Attachments') as $file) {
                    $name = $request->name . 'Approval_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $files[] = $name;
                }
            }
            $data->Approval_Attachments = json_encode($files);
        }

        if (!empty($request->HOD_Attachments1)) {
            $files = [];
            if ($request->hasFile('HOD_Attachments1')) {
                foreach ($request->file('HOD_Attachments1') as $file) {
                    $name = $request->name . 'HOD_Attachments1' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $files[] = $name;
                }
            }
            $data->HOD_Attachments1 = json_encode($files);
        }

        if (!empty($request->QA_Attachments1)) {
            $files = [];
            if ($request->hasFile('QA_Attachments1')) {
                foreach ($request->file('QA_Attachments1') as $file) {
                    $name = $request->name . 'QA_Attachments1' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $files[] = $name;
                }
            }
            $data->QA_Attachments1 = json_encode($files);
        }

        $data->status = 'Opened';
        $data->stage = 1;

        $data->save();

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();


        $history = new ErrataAuditTrail();
        $history->errata_id = $data->id;
        $history->activity_type = 'Record Number';
        $history->previous = "Null";
        $history->current = Helpers::getDivisionName(session()->get('division')) . "/ERRATA/" . Helpers::year($data->created_at) . "/" . str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();


        if (!empty($data->division_id)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Site/Location Code';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName($data->division_id);
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->intiation_date)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = "Null";
            $history->current =  Helpers::getdateFormat($data->intiation_date);
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }



        $history = new ErrataAuditTrail();
        $history->errata_id = $data->id;
        $history->activity_type = 'Initiator';
        $history->previous = "Null";
        $history->current = Auth::user()->name;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();


        if (!empty($data->Department)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Department';
            $history->previous = "Null";
            $history->current = $data->Department;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->department_code)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Department Code';
            $history->previous = "Null";
            $history->current = $data->department_code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }


        if (!empty($data->document_type)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Document Type';
            $history->previous = "Null";
            $history->current = $data->document_type;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }


        if (!empty($data->short_description)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $data->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }


        if (!empty($data->reference)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Parent Record Number';
            $history->previous = "Null";
            $history->current =  $data->reference;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->Observation_on_Page_No)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Error Observed on Page No.';
            $history->previous = "Null";
            $history->current = $data->Observation_on_Page_No;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->brief_description)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Brief Description of error';
            $history->previous = "Null";
            $history->current = $data->brief_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->document_title)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Document title';
            $history->previous = "Null";
            $history->current = $data->document_title;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }


        if (!empty($data->type_of_error)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Type Of Error';
            $history->previous = "Null";
            $history->current = $data->type_of_error;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->otherFieldsUser)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Others';
            $history->previous = "Null";
            $history->current = $data->otherFieldsUser;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($data->Correction_Of_Error)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Correction Of Error required';
            $history->previous = "Null";
            $history->current = $data->Correction_Of_Error;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->department_head_to)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Department Head';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($data->department_head_to);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->qa_reviewer)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'QA reviewer';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($data->qa_reviewer);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->HOD_Remarks)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'HOD Initial Comment';
            $history->previous = "Null";
            $history->current = $data->HOD_Remarks;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->HOD_Attachments)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'HOD Initial Attachments';
            $history->previous = "Null";
            $history->current = $data->HOD_Attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->QA_Feedbacks)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'QA/CQA Initial Comment';
            $history->previous = "Null";
            $history->current = $data->QA_Feedbacks;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->QA_Attachments)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'QA/CQA Initial Attachments';
            $history->previous = "Null";
            $history->current = $data->QA_Attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->Approval_Comment)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Approval Comment';
            $history->previous = "Null";
            $history->current = $data->Approval_Comment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->Approval_Attachments)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Approval Attachments';
            $history->previous = "Null";
            $history->current = $data->Approval_Attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->Date_and_time_of_correction)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Date Of Correction of document';
            $history->previous = "Null";
            $history->current = $data->Date_and_time_of_correction;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->All_Impacting_Documents_Corrected)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'All Impacting Documents Corrected';
            $history->previous = "Null";
            $history->current = $data->All_Impacting_Documents_Corrected;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($data->Remarks)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Remarks';
            $history->previous = "Null";
            $history->current = $data->Remarks;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->Initiator_Attachments)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Initiator Attachments';
            $history->previous = "Null";
            $history->current = $data->Initiator_Attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->HOD_Comment1)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'HOD final Review Comment';
            $history->previous = "Null";
            $history->current = $data->HOD_Comment1;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->HOD_Attachments1)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'HOD final Attachments';
            $history->previous = "Null";
            $history->current = $data->HOD_Attachments1;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->QA_Comment1)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'QA Comment';
            $history->previous = "Null";
            $history->current = $data->QA_Comment1;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->QA_Attachments1)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'QA Attachments';
            $history->previous = "Null";
            $history->current = $data->QA_Attachments1;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->Closure_Comments)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Closure Comments';
            $history->previous = "Null";
            $history->current = $data->Closure_Comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->Closure_Attachments)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Closure Attachments';
            $history->previous = "Null";
            $history->current = $data->Closure_Attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        //==================GRID=======================

//         $errata_id = $data->id;

// if (!empty($request->details)) {
//     // Fetch or create the ErrataGrid record
//     $newDataGridErrata = ErrataGrid::where(['e_id' => $errata_id, 'identifier' => 'details'])->firstOrCreate();
//     $newDataGridErrata->e_id = $errata_id;
//     $newDataGridErrata->identifier = 'details';
//     $newDataGridErrata->data = $request->details;
//     $newDataGridErrata->save();

//     // Mapping of field keys to descriptive names
//     $fieldNames = [
//         'ListOfImpactingDocument' => 'List Of Impacting Document (If Any)',
//     ];

//     // Track audit trail changes for new entries
//     if (is_array($request->details)) {
//         $counter = 1;  // Initialize a sequential counter for indexing

//         foreach ($request->details as $newAuditor) {
//             foreach ($fieldNames as $fieldKey => $fieldName) {
//                 $newValue = $newAuditor[$fieldKey] ?? 'Null';

//                 // Log new data entries in the audit trail
//                 if ($newValue !== 'Null') {
//                     $auditTrail = new ErrataAuditTrail;
//                     $auditTrail->errata_id = $errata_id;
//                     $auditTrail->activity_type = $fieldName . ' ( ' . $counter . ')';
//                     $auditTrail->previous = 'Null'; // Since this is new data
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

//                     $counter++; // Increment for each field entry
//                 }
//             }
//         }
//     }
// }


            $data1 = new ErrataGrid();
            $data1->ert_id = $data->id;
            $data1->type = "erata_type";

            if (!empty($request->ListOfImpactingDocument)) {
                $data1->ListOfImpactingDocument = serialize($request->ListOfImpactingDocument);
            }
            $data1->save();

            $data1 = new ErrataGrid();
            $data1->ert_id = $data->id;
            $data1->type = "erata_type";

            $fieldNames = [
                'ListOfImpactingDocument' => 'List Of Impacting Document (If Any)'
            ];

            // Ensure ListOfImpactingDocument is not null and is an array or object
            if (!empty($request->ListOfImpactingDocument) && is_array($request->ListOfImpactingDocument)) {
                foreach ($request->ListOfImpactingDocument as $index => $ListOfImpactingDocument) {
                    // Since this is a new entry, there are no previous details
                    $previousDetails = [
                        'ListOfImpactingDocument' => null,
                    ];

                    // Current fields values from the request
                    $fields = [
                        'ListOfImpactingDocument' => $ListOfImpactingDocument,
                    ];

                    foreach ($fields as $key => $currentValue) {
                        // Log changes for new rows (no previous value to compare)
                        if (!empty($currentValue)) {
                            // Only create an audit trail entry for new values
                            $history = new ErrataAuditTrail();
                            $history->errata_id = $data->id;

                            // Set activity type to include field name and row index using the fieldNames array
                            $history->activity_type = $fieldNames[$key] . ' (' . ($index + 1) . ')';

                            // Since this is a new entry, 'Previous' value is null
                            $history->previous = 'null'; // Previous value or 'null'

                            // Assign 'Current' value, which is the new value
                            $history->current = $currentValue; // New value

                            // Comments and user details
                            $history->comment = 'NA';
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




        // if (is_array($request->details)) {
        //     foreach ($request->details as $index => $detailsAction) {
        //         $lastdetailsAction = $data->details[$index] ?? null;
        //         $currentdetailsAction = $detailsAction['ListOfImpactingDocument'];

        //         // Check if there is a change or an action comment
        //         if ($lastdetailsAction != $currentdetailsAction || !empty($request->action_taken_comment)) {
        //             // Check if an existing audit trail entry already exists for this action
        //             $existingHistory = ErrataAuditTrail::where([
        //                 'errata_id' => $errata_id, // Corrected to use $errata_id
        //                 'activity_type' => "List Of Impacting Document (If Any)" . ' (' . ($index+1) . ')',
        //                 'previous' => $lastdetailsAction,
        //                 'current' => $currentdetailsAction
        //             ])->first();

        //             // If no existing history, create a new entry
        //             if (!$existingHistory) {
        //                 $history = new ErrataAuditTrail();
        //                 $history->errata_id = $errata_id; // Manually setting each attribute
        //                 $history->activity_type = "List Of Impacting Document (If Any)" . ' (' . ($index+1) . ')';
        //                 $history->previous = $lastdetailsAction;
        //                 $history->current = $currentdetailsAction;
        //                 $history->comment = $request->action_taken_comment;
        //                 $history->user_id = Auth::user()->id;
        //                 $history->user_name = Auth::user()->name;
        //                 $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //                 $history->origin_state = $data->status;
        //                 $history->change_to = "Not Applicable";
        //                 $history->change_from = "Not Applicable";
        //                 $history->action_name = "Create";

        //                 // Save the audit trail entry
        //                 $history->save();
        //             }
        //         }
        //     }
        // }

        //================================================================


        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }

    public function show($id)
    {
        $showdata = errata::find($id);

        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $errata_id = $id;
        $errata_ids = $showdata->$id;

        // $grid_Data = ErrataGrid::where(['ert_id' => $errata_id, 'identifier' => 'details'])->first();
        $griddata = ErrataGrid::where('ert_id',$showdata->id)->first();

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
            'ERRATA' => \App\Models\errata::class,
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



        return view('frontend.errata.errata_view', compact('showdata', 'griddata', 'errata_id', 'record_number', 'relatedRecords'));
    }

    public function stageChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $ErrataControl = errata::find($id);
            $lastDocument = errata::find($id);
            // $evaluation = Evaluation::where('cc_id', $id)->first();
            if ($ErrataControl->stage == 1) {

                if (!$ErrataControl->short_description || !$ErrataControl->document_title || !$ErrataControl->type_of_error ) {
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Pls Fill General Tab Field is yet to be filled!',
                        'type' => 'warning',
                    ]);

                    return redirect()->back();
                } else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Opened Stage Completed'
                    ]);
                }

                $ErrataControl->stage = "2";
                $ErrataControl->status = "HOD Review";
                $ErrataControl->submitted_by = Auth::user()->name;
                $ErrataControl->submitted_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'Submitted By, Submittedd On';
                if (is_null($lastDocument->submitted_by) || $lastDocument->submitted_on == '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->submitted_by . ' ,' . $lastDocument->submitted_on;
                }
                $history->action = 'Submit';
                $history->current = $ErrataControl->submitted_by . ',' . $ErrataControl->submitted_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "HOD Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Approved';
                if (is_null($lastDocument->submitted_by) || $lastDocument->submitted_on == '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getHodUserList($ErrataControl->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 try {
                //                     Mail::send(
                //                         'mail.view-mail',
                //                         ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Submit", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                         function ($message) use ($email, $ErrataControl) {
                //                             $message->to($email)
                //                             ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Submit Performed");
                //                         }
                //                     );
                //                 } catch(\Exception $e) {
                //                     info('Error sending mail', [$e]);
                //                 }
                //             }
                //         // }
                //     }


                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 2) {

                if (!$ErrataControl->HOD_Remarks) {
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'HOD Initial Review Tab is yet to be filled!',
                        'type' => 'warning',
                    ]);

                    return redirect()->back();
                } else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'HOD Review Completed'
                    ]);
                }

                $ErrataControl->stage = "3";
                $ErrataControl->status = "QA/CQA Initial Review";
                $ErrataControl->review_completed_by = Auth::user()->name;
                $ErrataControl->review_completed_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->review_completed_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'HOD Initial Review Completed By, HOD Initial Review Completed On';
                if (is_null($lastDocument->review_completed_by) || $lastDocument->review_completed_on == '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->review_completed_by . ' ,' . $lastDocument->review_completed_on;
                }
                $history->action = 'HOD Initial Review Complete';
                $history->current = $ErrataControl->review_completed_by . ',' . $ErrataControl->review_completed_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "QA/CQA Initial Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Approved';
                if (is_null($lastDocument->review_completed_by) || $lastDocument->review_completed_on == '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
                // $list = Helpers::getQAUserList($ErrataControl->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 try {
                //                     Mail::send(
                //                         'mail.view-mail',
                //                         ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "HOD Initial Review Complete", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                         function ($message) use ($email, $ErrataControl) {
                //                             $message->to($email)
                //                             ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Initial Review Complete Performed");
                //                         }
                //                     );
                //                 } catch(\Exception $e) {
                //                     info('Error sending mail', [$e]);
                //                 }
                //             }
                //         // }
                //     }

                    // $list = Helpers::getCQAUsersList($ErrataControl->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "HOD Initial Review Complete", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $ErrataControl) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Initial Review Complete Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }

                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 3) {

                if (!$ErrataControl->QA_Feedbacks) {
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'QA/CQA Initial Review Tab is yet to be filled!',
                        'type' => 'warning',
                    ]);

                    return redirect()->back();
                } else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'QA/CQA Initial Review Completed'
                    ]);
                }

                $ErrataControl->stage = "4";
                $ErrataControl->status = "QA/CQA Approval";
                $ErrataControl->Reviewed_by = Auth::user()->name;
                $ErrataControl->Reviewed_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->Reviewed_commemt = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'Review Completed By, Review Completed On';
                if (is_null($lastDocument->Reviewed_by) || $lastDocument->Reviewed_on == '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->Reviewed_by . ' ,' . $lastDocument->Reviewed_on;
                }
                $history->action = 'Review Complete';
                $history->current = $ErrataControl->Reviewed_by . ',' . $ErrataControl->Reviewed_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "QA/CQA Approval";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Approved';
                if (is_null($lastDocument->Reviewed_by) || $lastDocument->Reviewed_on == '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getQAHeadUserList($ErrataControl->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 try {
                //                     Mail::send(
                //                         'mail.view-mail',
                //                         ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Review Complete", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                         function ($message) use ($email, $ErrataControl) {
                //                             $message->to($email)
                //                             ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review Complete Performed");
                //                         }
                //                     );
                //                 } catch(\Exception $e) {
                //                     info('Error sending mail', [$e]);
                //                 }
                //             }
                //         // }
                //     }

                    // $list = Helpers::getCQAHeadDesignUsersList($ErrataControl->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Review Complete", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $ErrataControl) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review Complete Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }

                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 4) {

                if (!$ErrataControl->Approval_Comment) {
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'QA/CQA Head Designee Approval Tab yet to be filled!',
                        'type' => 'warning',
                    ]);

                    return redirect()->back();
                } else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'QA/CQA Approval Completed'
                    ]);
                }

                $ErrataControl->stage = "5";
                $ErrataControl->status = "Pending Correction";
                $ErrataControl->approved_by = Auth::user()->name;
                $ErrataControl->approved_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->approved_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'Approval Completed By, Approval Completed On';
                if (is_null($lastDocument->approved_by) || $lastDocument->approved_on == '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->approved_by . ' ,' . $lastDocument->approved_on;
                }
                $history->action = 'Approval Complete';
                $history->current = $ErrataControl->approved_by . ',' . $ErrataControl->approved_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Pending Correction";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Approval Complete';
                if (is_null($lastDocument->approved_by) || $lastDocument->approved_on == '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getInitiatorUserList($ErrataControl->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 try {
                //                     Mail::send(
                //                         'mail.view-mail',
                //                         ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Approval Complete", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                         function ($message) use ($email, $ErrataControl) {
                //                             $message->to($email)
                //                             ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Approval Complete Performed");
                //                         }
                //                     );
                //                 } catch(\Exception $e) {
                //                     info('Error sending mail', [$e]);
                //                 }
                //             }
                //         // }
                //     }
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 5) {

                if (!$ErrataControl->Date_and_time_of_correction || !$ErrataControl->All_Impacting_Documents_Corrected) {
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => ' Initiator Update Tab is yet to be filled!',
                        'type' => 'warning',
                    ]);

                    return redirect()->back();
                } else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Pending Correction Completed'
                    ]);
                }

                $ErrataControl->stage = "6";
                $ErrataControl->status = "Pending HOD Review";
                $ErrataControl->correction_completed_by = Auth::user()->name;
                $ErrataControl->correction_completed_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->correction_completed_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'Correction Completed By, Correction Completed On';
                if (is_null($lastDocument->correction_completed_by) || $lastDocument->correction_completed_on == '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->correction_completed_by . ' ,' . $lastDocument->correction_completed_on;
                }
                $history->action = 'Correction Complete';
                $history->current = $ErrataControl->correction_completed_by . ',' . $ErrataControl->correction_completed_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Pending HOD Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Correction Completed';
                if (is_null($lastDocument->correction_completed_by) || $lastDocument->correction_completed_on == '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getHodUserList($ErrataControl->division_id);
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Correction Completed", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $ErrataControl) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Correction Completed Performed");
                //                     }
                //                 );
                //             } catch(\Exception $e) {
                //                 info('Error sending mail', [$e]);
                //             }
                //         }
                //     // }
                // }

                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($ErrataControl->stage == 6) {

                if (!$ErrataControl->HOD_Comment1) {
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
                        'message' => 'Pending HOD Review Completed'
                    ]);
                }


                $ErrataControl->stage = "7";
                $ErrataControl->status = "Pending QA/CQA Head Approval";
                $ErrataControl->hod_review_complete_by = Auth::user()->name;
                $ErrataControl->hod_review_complete_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->hod_review_complete_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'HOD Review Completed By, HOD Review Completed On';
                if (is_null($lastDocument->hod_review_complete_by) || $lastDocument->hod_review_complete_on == '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->hod_review_complete_by . ' ,' . $lastDocument->hod_review_complete_on;
                }
                $history->action = 'HOD Review Complete';
                $history->current = $ErrataControl->hod_review_complete_by . ',' . $ErrataControl->hod_review_complete_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Pending QA/CQA Head Approval";
                $history->change_from = $lastDocument->status;
                $history->stage = 'QA/CQA Head Approval Completed';
                if (is_null($lastDocument->hod_review_complete_by) || $lastDocument->hod_review_complete_on == '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getQAHeadUserList($ErrataControl->division_id);
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "HOD Review Completed", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $ErrataControl) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Review Completed Performed");
                //                     }
                //                 );
                //             } catch(\Exception $e) {
                //                 info('Error sending mail', [$e]);
                //             }
                //         }
                //     // }
                // }

                // $list = Helpers::getCQAHeadDesignUsersList($ErrataControl->division_id);
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "HOD Review Completed", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $ErrataControl) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Review Completed Performed");
                //                     }
                //                 );
                //             } catch(\Exception $e) {
                //                 info('Error sending mail', [$e]);
                //             }
                //         }
                //     // }
                // }

                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($ErrataControl->stage == 7) {

                if (!$ErrataControl->Closure_Comments) {
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => '     QA/CQA Head Designee Closure Approval Tab yet to be filled!',
                        'type' => 'warning',
                    ]);


                    return redirect()->back();
                } else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Pending QA/CQA Head Approval Completed'
                    ]);
                }

                $ErrataControl->stage = "8";
                $ErrataControl->status = "Closed Done";
                $ErrataControl->qa_head_approval_completed_by = Auth::user()->name;
                $ErrataControl->qa_head_approval_completed_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->qa_head_approval_completed_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'QA/CQA Head Approval Completed By, QA/CQA Head Approval Completed On';
                if (is_null($lastDocument->qa_head_approval_completed_by) || $lastDocument->qa_head_approval_completed_on == '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->qa_head_approval_completed_by . ' ,' . $lastDocument->qa_head_approval_completed_on;
                }
                $history->action = 'QA/CQA Head Approval Completed';
                $history->current = $ErrataControl->qa_head_approval_completed_by . ',' . $ErrataControl->qa_head_approval_completed_on;
                $history->comment = $request->comment;
                $history->action = 'QA/CQA Head Approval Completed';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Closed Done";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Closed-Done';
                if (is_null($lastDocument->qa_head_approval_completed_by) || $lastDocument->qa_head_approval_completed_on == '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getQAUserList($ErrataControl->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 try {
                //                     Mail::send(
                //                         'mail.view-mail',
                //                         ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "QA/CQA Head Approval Completed", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                         function ($message) use ($email, $ErrataControl) {
                //                             $message->to($email)
                //                             ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA/CQA Head Approval Completed Performed");
                //                         }
                //                     );
                //                 } catch(\Exception $e) {
                //                     info('Error sending mail', [$e]);
                //                 }
                //             }
                //         // }
                //     }

                    // $list = Helpers::getCQAUsersList($ErrataControl->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "QA/CQA Head Approval Completed", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $ErrataControl) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA/CQA Head Approval Completed Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }

                    // $list = Helpers::getInitiatorUserList($ErrataControl->division_id);
                    // foreach ($list as $u) {
                    //     // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "QA/CQA Head Approval Completed", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                    //                     function ($message) use ($email, $ErrataControl) {
                    //                         $message->to($email)
                    //                         ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA/CQA Head Approval Completed Performed");
                    //                     }
                    //                 );
                    //             } catch(\Exception $e) {
                    //                 info('Error sending mail', [$e]);
                    //             }
                    //         }
                    //     // }
                    // }

                //     $list = Helpers::getHodUserList($ErrataControl->division_id);
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "QA/CQA Head Approval Completed", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $ErrataControl) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA/CQA Head Approval Completed Performed");
                //                     }
                //                 );
                //             } catch(\Exception $e) {
                //                 info('Error sending mail', [$e]);
                //             }
                //         }
                //     // }
                // }


                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            } else {
                toastr()->error('E-signature Not match');
                return back();
            }
        }
    }

    public function stageReject(Request $request, $id)
    {
        // $ErrataControl = errata::find($id);

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $ErrataControl = errata::find($id);
            $lastDocument = errata::find($id);
            if ($ErrataControl->stage == 2) {

                $ErrataControl->stage = "1";
                $ErrataControl->status = "Opened";
                $ErrataControl->reject_by = 'Not Applicable';
                $ErrataControl->reject_on = 'Not Applicable';
                // $deviation->pending_Cancel_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->previous = 'Not Applicable';
                $history->activity_type = 'Not Applicable';

                $history->action = 'Reject';
                $history->current = 'Not Applicable';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Opened";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                // $list = Helpers::getInitiatorUserList($ErrataControl->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 try {
                //                     Mail::send(
                //                         'mail.view-mail',
                //                         ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Reject", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                         function ($message) use ($email, $ErrataControl) {
                //                             $message->to($email)
                //                             ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Reject Performed");
                //                         }
                //                     );
                //                 } catch(\Exception $e) {
                //                     info('Error sending mail', [$e]);
                //                 }
                //             }
                //         // }
                //     }

                $ErrataControl->update();
                return back();
            }
            if ($ErrataControl->stage == 3) {

                $ErrataControl->stage = "2";
                $ErrataControl->status = "HOD Review";
                $ErrataControl->reject_by = 'Not Applicable';
                $ErrataControl->reject_on = 'Not Applicable';
                // $deviation->pending_Cancel_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->previous = 'Not Applicable';
                $history->activity_type = 'Not Applicable';

                $history->action = 'Reject';
                $history->current = 'Not Applicable';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Opened";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                // $list = Helpers::getHodUserList($ErrataControl->division_id);
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Reject", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $ErrataControl) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Reject Performed");
                //                     }
                //                 );
                //             } catch(\Exception $e) {
                //                 info('Error sending mail', [$e]);
                //             }
                //         }
                //     // }
                // }

                $ErrataControl->update();
                return back();
            }
            if ($ErrataControl->stage == 4) {

                $ErrataControl->stage = "3";
                $ErrataControl->status = "A/CQA Initial Review";
                $ErrataControl->reject_by = 'Not Applicable';
                $ErrataControl->reject_on = 'Not Applicable';
                // $deviation->pending_Cancel_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->previous = 'Not Applicable';
                $history->activity_type = 'Not Applicable';

                $history->action = 'Reject';
                $history->current = 'Not Applicable';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Opened";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                // $list = Helpers::getQAUserList($ErrataControl->division_id);
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Reject", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $ErrataControl) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Reject Performed");
                //                     }
                //                 );
                //             } catch(\Exception $e) {
                //                 info('Error sending mail', [$e]);
                //             }
                //         }
                //     // }
                // }

                // $list = Helpers::getCQAUsersList($ErrataControl->division_id);
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Reject", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $ErrataControl) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Reject Performed");
                //                     }
                //                 );
                //             } catch(\Exception $e) {
                //                 info('Error sending mail', [$e]);
                //             }
                //         }
                //     // }
                // }

                $ErrataControl->update();
                return back();
            }
            if ($ErrataControl->stage == 5) {

                $ErrataControl->stage = "4";
                $ErrataControl->status = "QA/CQA Approval";
                $ErrataControl->reject_by = 'Not Applicable';
                $ErrataControl->reject_on = 'Not Applicable';
                // $deviation->pending_Cancel_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->previous = 'Not Applicable';
                $history->activity_type = 'Not Applicable';

                $history->action = 'Reject';
                $history->current = 'Not Applicable';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Opened";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                // $list = Helpers::getQAHeadUserList($ErrataControl->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 try {
                //                     Mail::send(
                //                         'mail.view-mail',
                //                         ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Request More Info", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                         function ($message) use ($email, $ErrataControl) {
                //                             $message->to($email)
                //                             ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Request More Info Performed");
                //                         }
                //                     );
                //                 } catch(\Exception $e) {
                //                     info('Error sending mail', [$e]);
                //                 }
                //             }
                //         // }
                //     }

                $ErrataControl->update();
                return back();
            }
            if ($ErrataControl->stage == 6) {

                $ErrataControl->stage = "5";
                $ErrataControl->status = "Pending Correction";
                $ErrataControl->reject_by = 'Not Applicable';
                $ErrataControl->reject_on = 'Not Applicable';
                // $deviation->pending_Cancel_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->previous = 'Not Applicable';
                $history->activity_type = 'Not Applicable';

                $history->action = 'Request More Info';
                $history->current = 'Not Applicable';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Opened";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                // $list = Helpers::getInitiatorUserList($ErrataControl->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 try {
                //                     Mail::send(
                //                         'mail.view-mail',
                //                         ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Request More Info", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                         function ($message) use ($email, $ErrataControl) {
                //                             $message->to($email)
                //                             ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Request More Info Performed");
                //                         }
                //                     );
                //                 } catch(\Exception $e) {
                //                     info('Error sending mail', [$e]);
                //                 }
                //             }
                //         // }
                //     }

                $ErrataControl->update();
                return back();
            }
            if ($ErrataControl->stage == 7) {
                $ErrataControl->stage = "1";
                $ErrataControl->sent_to_open_state_by = Auth::user()->name;
                $ErrataControl->sent_to_open_state_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->sent_to_open_state_comment = $request->comment;
                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'Send To Opened By, Send To Opened On';
                if (is_null($lastDocument->sent_to_open_state_by) || $lastDocument->sent_to_open_state_on == '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->sent_to_open_state_by . ' ,' . $lastDocument->sent_to_open_state_on;
                }
                $history->action = 'Send To Opened';
                $history->current = $ErrataControl->sent_to_open_state_by . ',' . $ErrataControl->sent_to_open_state_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Opened";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Opened';
                if (is_null($lastDocument->sent_to_open_state_by) || $lastDocument->sent_to_open_state_on == '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getHodUserList($ErrataControl->division_id);
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Send To Opened", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $ErrataControl) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Send To Opened Performed");
                //                     }
                //                 );
                //             } catch(\Exception $e) {
                //                 info('Error sending mail', [$e]);
                //             }
                //         }
                //     // }
                // }

                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 6) {
                $ErrataControl->stage = "5";
                $ErrataControl->status = "Pending QA/CQA Head Approval";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function erratacancelstage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $ErrataControl = errata::find($id);
            $lastDocument = errata::find($id);
            if ($ErrataControl->stage == 1) {
                $ErrataControl->stage = "0";
                $ErrataControl->status = "Closed-Cancelled";
                $ErrataControl->cancel_by = Auth::user()->name;
                $ErrataControl->cancel_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->cancel_comment = $request->comment;

                $ErrataControl->sent_to_open_state_by = Auth::user()->name;
                $ErrataControl->sent_to_open_state_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->sent_to_open_state_comment = $request->comment;
                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'Cancel By, Cancel On';
                if (is_null($lastDocument->cancel_by) || $lastDocument->cancel_on == '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->cancel_by . ' ,' . $lastDocument->cancel_on;
                }
                $history->action = 'Cancel';
                $history->current = $ErrataControl->cancel_by . ',' . $ErrataControl->cancel_on;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Closed-Cancelled";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Opened';
                if (is_null($lastDocument->cancel_by) || $lastDocument->cancel_on == '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getInitiatorUserList($ErrataControl->division_id);
                //     foreach ($list as $u) {
                //         // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //             $email = Helpers::getUserEmail($u->user_id);
                //                 if ($email !== null) {
                //                 try {
                //                     Mail::send(
                //                         'mail.view-mail',
                //                         ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Cancel", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                         function ($message) use ($email, $ErrataControl) {
                //                             $message->to($email)
                //                             ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Cancel Performed");
                //                         }
                //                     );
                //                 } catch(\Exception $e) {
                //                     info('Error sending mail', [$e]);
                //                 }
                //             }
                //         // }
                //     }

                //     $list = Helpers::getHodUserList($ErrataControl->division_id);
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Cancel", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $ErrataControl) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Cancel Performed");
                //                     }
                //                 );
                //             } catch(\Exception $e) {
                //                 info('Error sending mail', [$e]);
                //             }
                //         }
                //     // }
                // }

                // $list = Helpers::getQAUserList($ErrataControl->division_id);
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $ErrataControl->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $ErrataControl, 'site'=>"Errata", 'history' => "Cancel", 'process' => 'Errata', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                     function ($message) use ($email, $ErrataControl) {
                //                         $message->to($email)
                //                         ->subject("Agio Notification: Errata, Record #" . str_pad($ErrataControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Cancel Performed");
                //                     }
                //                 );
                //             } catch(\Exception $e) {
                //                 info('Error sending mail', [$e]);
                //             }
                //         }
                //     // }
                // }

                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 2) {
                $ErrataControl->stage = "0";
                $ErrataControl->status = "Closed-Cancelled";
                $ErrataControl->cancel_by = Auth::user()->name;
                $ErrataControl->cancel_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->cancel_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $ErrataControl->cancel_by;
                $history->comment = $request->comment;
                $history->action = 'Opened';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Opened";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Opened';
                $history->save();

                $ErrataControl->update();
                toastr()->success('Document Cancelled');
            }
            if ($ErrataControl->stage == 3) {
                $ErrataControl->stage = "0";
                $ErrataControl->status = "Closed-Cancelled";
                $ErrataControl->cancel_by = Auth::user()->name;
                $ErrataControl->cancel_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->cancel_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $ErrataControl->cancel_by;
                $history->comment = $request->comment;
                $history->action = 'Closed-Cancelled';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Closed-Cancelled";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Closed-Cancelled';
                $history->save();

                $ErrataControl->update();
                toastr()->success('Document Cancelled');
            }
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $lastData = errata::find($id);
        $data = errata::find($id);
        $data->division_id = $request->division_id;
       // $data->initiator_id = Auth::user()->id;
        $data->intiation_date = $request->intiation_date;
        $data->initiated_by = $request->initiated_by;
        // new added lines
        $data->department_head_to = $request->department_head_to;
        $data->document_title = $request->document_title;
        $data->qa_reviewer = $request->qa_reviewer;
     // $data->reference = implode(',', $request->reference);
        $data->reference = $request->reference;
        // $data->Department = $request->Department;
        // $data->department_code = $request->department_code;
        $data->document_type = $request->document_type;
        $data->document_type_others = $request->document_type_others;
        $data->short_description = $request->short_description;

        if ($request->input('type_of_error') == 'Other') {
            $data->otherFieldsUser = $request->input('otherFieldsUser');
        } else {
            $data->otherFieldsUser = null;
        }

        $data->qa_reviewer = $request->qa_reviewer;
        // $data->reference = $request->reference;
        $data->Observation_on_Page_No = $request->Observation_on_Page_No;
        $data->brief_description = $request->brief_description;
        $data->type_of_error = $request->type_of_error;

        $data->Correction_Of_Error = $request->Correction_Of_Error;
        $data->Approval_Comment = $request->Approval_Comment;
        $data->HOD_Comment1 = $request->HOD_Comment1;
        $data->QA_Comment1 = $request->QA_Comment1;



        if ($request->has('Date_and_time_of_correction') && $request->Date_and_time_of_correction !== null) {
            $data->Date_and_time_of_correction = $request->Date_and_time_of_correction ? Carbon::parse($request->Date_and_time_of_correction)->format('d-M-Y') : '';
        }

        $data->QA_Feedbacks = $request->QA_Feedbacks;

        // if (!empty($request->QA_Attachments)) {
        //     $files = [];
        //     if ($request->hasFile('QA_Attachments')) {
        //         foreach ($request->file('QA_Attachments') as $file) {
        //             $name = $request->name . 'QA_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
        //             $file->move(public_path('upload/'), $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $data->QA_Attachments = json_encode($files);
        // }
        if (!empty($request->QA_Attachments) || !empty($request->deleted_QA_Attachments)) {
            $existingFiles = json_decode($data->QA_Attachments, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_QA_Attachments)) {
                $filesToDelete = explode(',', $request->deleted_QA_Attachments);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('QA_Attachments')) {
                foreach ($request->file('QA_Attachments') as $file) {
                    $name = $request->name . 'QA_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $data->QA_Attachments = json_encode($allFiles);
        }


        // $data->HOD_Remarks = $request->HOD_Remarks;

        // if (!empty($request->HOD_Attachments)) {
        //     $files = [];
        //     if ($request->hasFile('HOD_Attachments')) {
        //         foreach ($request->file('HOD_Attachments') as $file) {
        //             $name = $request->name . 'HOD_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
        //             $file->move(public_path('upload/'), $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $data->HOD_Attachments = json_encode($files);
        // }

        $data->HOD_Remarks = $request->HOD_Remarks;

if (!empty($request->HOD_Attachments) || !empty($request->deleted_HOD_Attachments)) {
    $existingFiles = json_decode($data->HOD_Attachments, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_HOD_Attachments)) {
        $filesToDelete = explode(',', $request->deleted_HOD_Attachments);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new files
    $newFiles = [];
    if ($request->hasFile('HOD_Attachments')) {
        foreach ($request->file('HOD_Attachments') as $file) {
            $name = $request->name . 'HOD_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    // Merge existing and new files
    $allFiles = array_merge($existingFiles, $newFiles);
    $data->HOD_Attachments = json_encode($allFiles);
}

        $data->Closure_Comments = $request->Closure_Comments;
        $data->All_Impacting_Documents_Corrected = $request->All_Impacting_Documents_Corrected;
        $data->Remarks = $request->Remarks;

        // if (!empty($request->Closure_Attachments)) {
        //     $files = [];
        //     if ($request->hasFile('Closure_Attachments')) {
        //         foreach ($request->file('Closure_Attachments') as $file) {
        //             $name = $request->name . 'Closure_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
        //             $file->move(public_path('upload/'), $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $data->Closure_Attachments = json_encode($files);
        // }

        if (!empty($request->Closure_Attachments) || !empty($request->deleted_Closure_Attachments)) {
    $existingFiles = json_decode($data->Closure_Attachments, true) ?? [];

    // Handle deleted files
    if (!empty($request->deleted_Closure_Attachments)) {
        $filesToDelete = explode(',', $request->deleted_Closure_Attachments);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new files
    $newFiles = [];
    if ($request->hasFile('Closure_Attachments')) {
        foreach ($request->file('Closure_Attachments') as $file) {
            $name = $request->name . 'Closure_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    // Merge existing and new files
    $allFiles = array_merge($existingFiles, $newFiles);
    $data->Closure_Attachments = json_encode($allFiles);
}


        // if (!empty($request->Initiator_Attachments)) {
        //     $files = [];
        //     if ($request->hasFile('Initiator_Attachments')) {
        //         foreach ($request->file('Initiator_Attachments') as $file) {
        //             $name = $request->name . 'Initiator_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
        //             $file->move(public_path('upload/'), $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $data->Initiator_Attachments = json_encode($files);
        // }
        if (!empty($request->Initiator_Attachments) || !empty($request->deleted_Initiator_Attachments)) {
            $existingFiles = json_decode($data->Initiator_Attachments, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_Initiator_Attachments)) {
                $filesToDelete = explode(',', $request->deleted_Initiator_Attachments);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('Initiator_Attachments')) {
                foreach ($request->file('Initiator_Attachments') as $file) {
                    $name = $request->name . 'Initiator_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $data->Initiator_Attachments = json_encode($allFiles);
        }



        if (!empty($request->QA_Attachments1)) {
            $files = [];
            if ($request->hasFile('QA_Attachments1')) {
                foreach ($request->file('QA_Attachments1') as $file) {
                    $name = $request->name . 'QA_Attachments1' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $files[] = $name;
                }
            }
            $data->QA_Attachments1 = json_encode($files);
        }

        // if (!empty($request->Approval_Attachments)) {
        //     $files = [];
        //     if ($request->hasFile('Approval_Attachments')) {
        //         foreach ($request->file('Approval_Attachments') as $file) {
        //             $name = $request->name . 'Approval_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
        //             $file->move(public_path('upload/'), $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $data->Approval_Attachments = json_encode($files);
        // }

        if (!empty($request->Approval_Attachments) || !empty($request->deleted_Approval_Attachments)) {
            $existingFiles = json_decode($data->Approval_Attachments, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_Approval_Attachments)) {
                $filesToDelete = explode(',', $request->deleted_Approval_Attachments);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('Approval_Attachments')) {
                foreach ($request->file('Approval_Attachments') as $file) {
                    $name = $request->name . 'Approval_Attachments' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $data->Approval_Attachments = json_encode($allFiles);
        }

        // if (!empty($request->HOD_Attachments1)) {
        //     $files = [];
        //     if ($request->hasFile('HOD_Attachments1')) {
        //         foreach ($request->file('HOD_Attachments1') as $file) {
        //             $name = $request->name . 'HOD_Attachments1' . uniqid() . '.' . $file->getClientOriginalExtension();
        //             $file->move(public_path('upload/'), $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $data->HOD_Attachments1 = json_encode($files);
        // }
        if (!empty($request->HOD_Attachments1) || !empty($request->deleted_HOD_Attachments1)) {
            $existingFiles = json_decode($data->HOD_Attachments1, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_HOD_Attachments1)) {
                $filesToDelete = explode(',', $request->deleted_HOD_Attachments1);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('HOD_Attachments1')) {
                foreach ($request->file('HOD_Attachments1') as $file) {
                    $name = $request->name . 'HOD_Attachments1' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $data->HOD_Attachments1 = json_encode($allFiles);
        }


        $data->update();
        // if($lastData->initiated_by !=$data->initiated_by || !empty($request->initiated_by_comment)) {
        //     $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
        //                     ->where('activity_type', 'Initiated By')
        //                     ->exists();
        //     $history = new ErrataAuditTrail();
        //     $history->errata_id = $data->id;
        //     $history->activity_type = 'Initiated By';
        //     $history->previous =  $lastData->initiated_by;
        //     $history->current = $data->initiated_by;
        //     $history->comment = $request->initiated_by_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state= $lastData->status;
        //     $history->change_to= "Not Applicable";
        //     $history->change_from= $lastData->status;
        //     $history->action_name=$lastDataAuditTrail ? "Update" : "New";
        //     $history->save();
        // }
        if ($lastData->Department != $data->Department || !empty($request->Department_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Department')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Department';
            $history->previous =  Helpers::getFullDepartmentName($lastData->Department);
            $history->current = Helpers::getFullDepartmentName($data->Department);
            $history->comment = $request->Department_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->department_code != $data->department_code || !empty($request->department_code_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Department Code')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Department Code';
            $history->previous =  $lastData->department_code;
            $history->current = $data->department_code;
            $history->comment = $request->department_code_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastData->document_type != $data->document_type || !empty($request->document_type_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Document Type')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Document Type';
            $history->previous =  $lastData->document_type;
            $history->current = $data->document_type;
            $history->comment = $request->document_type_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastData->short_description != $data->short_description || !empty($request->short_description_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Short Description')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Short Description';
            $history->previous =  $lastData->short_description;
            $history->current = $data->short_description;
            $history->comment = $request->short_description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->reference != $data->reference || !empty($request->reference_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Parent Record Number')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Parent Record Number';
            $history->previous =  str_replace(',', ', ', $lastData->reference);
            $history->current = str_replace(',', ', ', $data->reference);
            $history->comment = $request->reference_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }


        if ($lastData->Observation_on_Page_No != $data->Observation_on_Page_No || !empty($request->Observation_on_Page_No_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Error Observed on Page No.')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Error Observed on Page No.';
            $history->previous =  $lastData->Observation_on_Page_No;
            $history->current = $data->Observation_on_Page_No;
            $history->comment = $request->Observation_on_Page_No_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->brief_description != $data->brief_description || !empty($request->brief_description_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Brief Description of error')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Brief Description of error';
            $history->previous =  $lastData->brief_description;
            $history->current = $data->brief_description;
            $history->comment = $request->brief_description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->document_title != $data->document_title || !empty($request->document_title_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Document title')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Document title';
            $history->previous =  $lastData->document_title;
            $history->current = $data->document_title;
            $history->comment = $request->document_title_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->type_of_error != $data->type_of_error || !empty($request->type_of_error_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Type Of Error')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Type Of Error';
            $history->previous =  $lastData->type_of_error;
            $history->current = $data->type_of_error;
            $history->comment = $request->type_of_error_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->otherFieldsUser != $data->otherFieldsUser || !empty($request->otherFieldsUser_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Others')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Others';
            $history->previous =  $lastData->otherFieldsUser;
            $history->current = $data->otherFieldsUser;
            $history->comment = $request->otherFieldsUser_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->Correction_Of_Error != $data->Correction_Of_Error || !empty($request->Correction_Of_Error_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Correction Of Error required')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Correction Of Error required';
            $history->previous =  $lastData->Correction_Of_Error;
            $history->current = $data->Correction_Of_Error;
            $history->comment = $request->Correction_Of_Error_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->department_head_to != $data->department_head_to || !empty($request->department_head_to_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Department Head')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Department Head';
            $history->previous =  Helpers::getInitiatorName($lastData->department_head_to);
            $history->current = Helpers::getInitiatorName($data->department_head_to);
            $history->comment = $request->department_head_to_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->qa_reviewer != $data->qa_reviewer || !empty($request->qa_reviewer_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'QA reviewer')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'QA reviewer';
            $history->previous =  Helpers::getInitiatorName($lastData->qa_reviewer);
            $history->current = Helpers::getInitiatorName($data->qa_reviewer);
            $history->comment = $request->qa_reviewer_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->HOD_Remarks != $data->HOD_Remarks || !empty($request->HOD_Remarks_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'HOD Initial Comment')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'HOD Initial Comment';
            $history->previous =  $lastData->HOD_Remarks;
            $history->current = $data->HOD_Remarks;
            $history->comment = $request->HOD_Remarks_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }
        if ($lastData->HOD_Attachments != $data->HOD_Attachments || !empty($request->HOD_Attachments_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'HOD Initial Attachments')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'HOD Initial Attachments';
            $history->previous =  str_replace(',', ', ', $lastData->HOD_Attachments);
            $history->current = str_replace(',', ', ', $data->HOD_Attachments);
            $history->comment = $request->HOD_Attachments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->QA_Feedbacks != $data->QA_Feedbacks || !empty($request->QA_Feedbacks_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'QA/CQA Initial Comment')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'QA/CQA Initial Comment';
            $history->previous =  $lastData->QA_Feedbacks;
            $history->current = $data->QA_Feedbacks;
            $history->comment = $request->QA_Feedbacks_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->QA_Attachments != $data->QA_Attachments || !empty($request->QA_Attachments_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'QA/CQA Initial Attachments')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'QA/CQA Initial Attachments';
            $history->previous =  str_replace(',', ', ', $lastData->QA_Attachments);
            $history->current = str_replace(',', ', ', $data->QA_Attachments);
            $history->comment = $request->QA_Attachments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->Approval_Comment != $data->Approval_Comment || !empty($request->Approval_Comment_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Approval Comment')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Approval Comment';
            $history->previous =  $lastData->Approval_Comment;
            $history->current = $data->Approval_Comment;
            $history->comment = $request->Approval_Comment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->Approval_Attachments != $data->Approval_Attachments || !empty($request->Approval_Attachments_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Approval Attachments')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Approval Attachments';
            $history->previous =  str_replace(',', ', ', $lastData->Approval_Attachments);
            $history->current = str_replace(',', ', ', $data->Approval_Attachments);
            $history->comment = $request->Approval_Attachments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->Date_and_time_of_correction != $data->Date_and_time_of_correction || !empty($request->Date_and_time_of_correction_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Date Of Correction of document')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Date Of Correction of document';
            $history->previous =  $lastData->Date_and_time_of_correction;
            $history->current = $data->Date_and_time_of_correction;
            $history->comment = $request->Date_and_time_of_correction_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->All_Impacting_Documents_Corrected != $data->All_Impacting_Documents_Corrected || !empty($request->All_Impacting_Documents_Corrected_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'All Impacting Documents Corrected')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'All Impacting Documents Corrected';
            $history->previous =  $lastData->All_Impacting_Documents_Corrected;
            $history->current = $data->All_Impacting_Documents_Corrected;
            $history->comment = $request->All_Impacting_Documents_Corrected_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->Remarks != $data->Remarks || !empty($request->Remarks_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Remarks')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Remarks';
            $history->previous =  $lastData->Remarks;
            $history->current = $data->Remarks;
            $history->comment = $request->Remarks_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->Initiator_Attachments != $data->Initiator_Attachments || !empty($request->Initiator_Attachments_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Initiator Attachments')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Initiator Attachments';
            $history->previous =  str_replace(',', ', ', $lastData->Initiator_Attachments);
            $history->current = str_replace(',', ', ', $data->Initiator_Attachments);
            $history->comment = $request->Initiator_Attachments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->HOD_Comment1 != $data->HOD_Comment1 || !empty($request->HOD_Comment1_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'HOD final Review Comment')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'HOD final Review Comment';
            $history->previous =  $lastData->HOD_Comment1;
            $history->current = $data->HOD_Comment1;
            $history->comment = $request->HOD_Comment1_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->HOD_Attachments1 != $data->HOD_Attachments1 || !empty($request->HOD_Attachments1_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'HOD final Attachments')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'HOD final Attachments';
            $history->previous =  str_replace(',', ', ', $lastData->HOD_Attachments1);
            $history->current = str_replace(',', ', ', $data->HOD_Attachments1);
            $history->comment = $request->HOD_Attachments1_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->QA_Comment1 != $data->QA_Comment1 || !empty($request->QA_Comment1_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'QA Comment')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'QA Comment';
            $history->previous =  $lastData->QA_Comment1;
            $history->current = $data->QA_Comment1;
            $history->comment = $request->QA_Comment1_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->QA_Attachments1 != $data->QA_Attachments1 || !empty($request->QA_Attachments1_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'QA Attachments')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'QA Attachments';
            $history->previous =  str_replace(',', ', ', $lastData->QA_Attachments1);
            $history->current = str_replace(',', ', ', $data->QA_Attachments1);
            $history->comment = $request->QA_Attachments1_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->Closure_Comments != $data->Closure_Comments || !empty($request->Closure_Comments_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Closure Comments')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Closure Comments';
            $history->previous =  $lastData->Closure_Comments;
            $history->current = $data->Closure_Comments;
            $history->comment = $request->Closure_Comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }


        if ($lastData->Closure_Attachments != $data->Closure_Attachments || !empty($request->Closure_Attachments_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Closure Attachments')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Closure Attachments';
            $history->previous =  str_replace(',', ', ', $lastData->Closure_Attachments);
            $history->current = str_replace(',', ', ', $data->Closure_Attachments);
            $history->comment = $request->Closure_Attachments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }

        if ($lastData->details != $data->details || !empty($request->details_comment)) {
            $lastDataAuditTrail = ErrataAuditTrail::where('errata_id', $data->id)
                ->where('activity_type', 'Details')
                ->exists();
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Details';
            $history->previous =  $lastData->details;
            $history->current = $data->details;
            $history->comment = $request->details_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = $lastDataAuditTrail ? "Update" : "New";
            $history->save();
        }




        //==================GRID=======================
//         $errata_id = $data->id;
//         $newDataGridErrata = ErrataGrid::where(['ert_id' => $errata_id, 'identifier' => 'details'])->firstOrCreate();
//         $newDataGridErrata->ert_id = $errata_id;
//         $newDataGridErrata->identifier = 'details';
//         $newDataGridErrata->data = $request->details;
//         $newDataGridErrata->save();

//

            $data1 = ErrataGrid::where('ert_id', $id)->where('type', "erata_type")->first();

            // Safely unserialize and use fallback to empty array if null
            $previousDetails = [
                'ListOfImpactingDocument' => !is_null($data1->ListOfImpactingDocument) ? unserialize($data1->ListOfImpactingDocument) : null
            ];

                // Serialize fields if they are not empty
                if (!empty($request->ListOfImpactingDocument)) {
                    $data1->ListOfImpactingDocument = serialize($request->ListOfImpactingDocument);
                }
                $data1->update();


            // Define the mapping of database fields to the descriptive field names
            $fieldNames = [
                'ListOfImpactingDocument' => 'List Of Impacting Document (If Any)'
            ];

            if (is_array($request->ListOfImpactingDocument) && !empty($request->ListOfImpactingDocument)) {
                foreach ($request->ListOfImpactingDocument as $index => $ListOfImpactingDocument) {

                    $previousValues = [
                        'ListOfImpactingDocument' => isset($previousDetails['ListOfImpactingDocument'][$index]) ? $previousDetails['ListOfImpactingDocument'][$index] : null,
                    ];



                    // Current field values
                    $fields = [
                        'ListOfImpactingDocument' => $ListOfImpactingDocument
                    ];

                    foreach ($fields as $key => $currentValue) {
                        $previousValue = $previousValues[$key] ?? null;

                        // Log changes if the current value is different from the previous one
                        if ($previousValue != $currentValue && !empty($currentValue)) {
                            // Check if an audit trail entry for this specific row and field already exists
                            $existingAudit = ErrataAuditTrail::where('errata_id', $id)
                                ->where('activity_type', $fieldNames[$key] . ' (' . ($index + 1) . ')')
                                ->where('previous', $previousValue)
                                ->where('current', $currentValue)
                                ->exists();

                            // Only create a new audit trail entry if no existing entry matches
                            if (!$existingAudit) {
                                $history = new ErrataAuditTrail();
                                $history->errata_id = $data->id;
                                $history->activity_type = $fieldNames[$key] . ' (' . ($index + 1) . ')';
                                $history->previous = $previousValue; // Use the previous value
                                $history->current = $currentValue; // New value
                                $history->comment = 'NA'; // Use comments if available
                                $history->user_id = Auth::user()->id;
                                $history->user_name = Auth::user()->name;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastData->status;
                                $history->change_to = "Not Applicable"; // Adjust if needed
                                $history->change_from = $lastData->status; // Adjust if needed
                                $history->action_name = "Update";
                                $history->save();
                            }
                        }
                    }
                }
            }





// $errata_id = $data->id;

// // Fetch existing summary response data
// $existingSummaryData = ErrataGrid::where(['ert_id' => $errata_id, 'identifier' => 'details'])->first();

// // Ensure data is an array, decoding if necessary
// $existingSummaryDataArray = is_string($existingSummaryData->data ?? null)
//     ? json_decode($existingSummaryData->data, true)
//     : ($existingSummaryData->data ?? []);

// // Save the new details data
// if (!empty($request->details)) {
//     // Fetch or create the summary record
//     $summaryShow = ErrataGrid::firstOrNew(['e_id' => $errata_id, 'identifier' => 'details']);
//     $summaryShow->e_id = $errata_id;
//     $summaryShow->identifier = 'details';
//     $summaryShow->data = $request->details; // Ensure this is stored as JSON or array based on your setup
//     $summaryShow->save();

//     // Mapping of field keys to descriptive names
//     $fieldNames = [
//         'ListOfImpactingDocument' => 'List Of Impacting Document (If Any)',
//     ];

//     // Track audit trail changes
//     if (is_array($request->details)) {
//         foreach ($request->details as $index => $newAuditor) {
//             // Use corresponding previous data by index, if available
//             $previousAuditor = $existingSummaryDataArray[$index] ?? [];

//             foreach ($fieldNames as $fieldKey => $fieldName) {
//                 $oldValue = $previousAuditor[$fieldKey] ?? 'Null';
//                 $newValue = $newAuditor[$fieldKey] ?? 'Null';

//                 // Proceed if there's a change
//                 if ($oldValue !== $newValue) {
//                     // Check if this change is already logged in the audit trail
//                     $existingAuditTrail = ErrataAuditTrail::where([
//                         ['errata_id', '=', $errata_id],
//                         ['activity_type', '=', $fieldName . ' (' . ($index + 1) . ')'],
//                         ['previous', '=', $oldValue],
//                         ['current', '=', $newValue]
//                     ])->first();

//                     // If no existing audit trail entry, log this change
//                     if (!$existingAuditTrail) {
//                         $auditTrail = new ErrataAuditTrail;
//                         $auditTrail->errata_id = $errata_id;
//                         $auditTrail->activity_type = $fieldName . ' (' . ($index + 1) . ')';
//                         $auditTrail->previous = $oldValue;
//                         $auditTrail->current = $newValue;
//                         $auditTrail->comment = "";
//                         $auditTrail->user_id = Auth::user()->id;
//                         $auditTrail->user_name = Auth::user()->name;
//                         $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
//                         $auditTrail->origin_state = $data->status;
//                         $auditTrail->change_from = $oldValue; // Correctly set to old value
//                         $auditTrail->change_to = $newValue;   // Correctly set to new value
//                         $auditTrail->action_name = "Update";
//                         $auditTrail->save();
//                     }
//                 }
//             }
//         }
//     }
// }

        //================================================================
        toastr()->success("Record is Updated Successfully");
        return back();
    }



    public function singleReports(Request $request, $id)
    {
        $data = errata::find($id);
       // dd($data);
        if (!empty($data)) {
            $grid_Data = ErrataGrid::where('ert_id', $id)->where('type', "erata_type")->first();
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.errata.errata_single_pdf', compact('data', 'grid_Data'))
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
            return $pdf->stream('errata' . $id . '.pdf');
        }
    }

    public function auditTrial($id)

    {
        $audit = ErrataAuditTrail::where('errata_id', $id)->orderByDESC('id')->paginate(5);
        // dd($audit);
        $today = Carbon::now()->format('d-m-y');
        $document = errata::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');

        $users = User::all();
        return view('frontend.errata.errata_audit_trail', compact('audit', 'document', 'today', 'users'));
    }

    public function audit_trail_filter(Request $request, $id)
    {
        // Start query for DeviationAuditTrail
        $query = ErrataAuditTrail::query();
        $query->where('errata_id', $id);

        // Check if typedata is provided
        if ($request->filled('typedata')) {
            switch ($request->typedata) {
                case 'cft_review':
                    // Filter by specific CFT review actions
                    $cft_field = ['CFT Review Complete', 'Not Applicable',];
                    $query->whereIn('action', $cft_field);
                    break;

                case 'stage':
                    // Filter by activity log stage changes
                    $stage = [
                        'Submit',
                        'Review Complete',
                        'Approval Complete',
                        'Correction Complete',
                        'Reject',
                        'Cancel',
                        'Approved',
                        'Correction Completed',
                        'HOD Review Complete',
                        'Sent To Opened State',
                        'QA/CQA Head Approval Completed'
                    ];
                    $query->whereIn('action', $stage); // Ensure correct activity_type value
                    break;

                case 'user_action':
                    // Filter by various user actions
                    $user_action = [
                        'Submit',
                        'Review Complete',
                        'Approval Complete',
                        'Correction Complete',
                        'Reject',
                        'Cancel',
                        'Approved',
                        'Correction Completed',
                        'HOD Review Complete',
                        'Sent To Opened State',
                        'QA/CQA Head Approval Completed'
                    ];
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
        $responseHtml = view('frontend.errata.errata_filter', compact('audit', 'filter_request'))->render();

        return response()->json(['html' => $responseHtml]);
    }

    public function auditDetailsErrata($id)
    {

        $detail = ErrataAuditTrail::find($id);
        
        $detail_data = ErrataAuditTrail::where('activity_type', $detail->activity_type)->where('errata_id', $detail->errata_id)->latest()->get();

        $doc = errata::where('id', $detail->errata_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);
        return view('frontend.errata.errata_audit_inner', compact('detail', 'doc', 'detail_data'));
    }

    public function auditTrailPdf($id)
    {
        $doc = errata::find($id);
        $audit = ErrataAuditTrail::where('errata_id', $id)->paginate(500);
        $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        $data = ErrataAuditTrail::where('errata_id', $doc->id)->orderByDesc('id')->get();
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.errata.errata_audit_trail_pdf', compact('data', 'audit', 'doc'))
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
}
