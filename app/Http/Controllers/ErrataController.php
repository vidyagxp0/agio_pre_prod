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
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use PDF;
class ErrataController extends Controller
{
    public function index($id)
    {
        $old_record = errata::select('id', 'division_id', 'record')->get();
        // $showdata = errata::find($id);
        $record_number = ((errata::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        return view('frontend.errata.errata_new', compact('old_record'));
        // $erratagridnew = ErrataGrid::where('id', $id)->latest()->first();

    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = new errata();
        $data->record_no = $request->record_no;
        $data->division_id = $request->division_id;
        $data->initiator_id = Auth::user()->id;
        $data->intiation_date = $request->intiation_date;
        $data->initiated_by = $request->initiated_by;
        $data->Department = $request->Department;
        $data->department_code = $request->department_code;
        $data->document_type = $request->document_type;
        $data->short_description = $request->short_description;
        // $data->reference_document = !empty($request->reference_document) ? implode(',', $request->reference_document) : '';

        $data->reference_document = is_array($request->reference_document)
            ? implode(',', $request->reference_document)
            : $request->reference_document;
        $data->Observation_on_Page_No = $request->Observation_on_Page_No;
        $data->brief_description = $request->brief_description;
        $data->type_of_error = $request->type_of_error;
        // $data->details = !empty($request->details) ? implode(',', $request->details) : '';

        // $data->details = $request->details;
        $data->Date_and_time_of_correction = $request->Date_and_time_of_correction ? Carbon::parse($request->Date_and_time_of_correction)->format('d-M-Y H:i') : '';
        $data->QA_Feedbacks = $request->QA_Feedbacks;
        if (!empty($request->QA_Attachments)) {
            $files = [];
            if ($request->hasfile('QA_Attachments')) {
                foreach ($request->file('QA_Attachments') as $file) {
                    $name = $request->name . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $data->QA_Attachments = json_encode($files);
        }

        $data->HOD_Remarks = $request->HOD_Remarks;

        if (!empty($request->HOD_Attachments)) {
            $files = [];
            if ($request->hasfile('HOD_Attachments')) {
                foreach ($request->file('HOD_Attachments') as $file) {
                    $name = $request->name . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
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
            if ($request->hasfile('Closure_Attachments')) {
                foreach ($request->file('Closure_Attachments') as $file) {
                    $name = $request->name . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->Closure_Attachments = json_encode($files);
        }



        $data->status = 'Opened';
        $data->stage = 1;
        $data->save();

        if (!empty($data->initiated_by)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Initiated By';
            $history->previous = "Null";
            $history->current = $data->initiated_by;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

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
            $history->change_from = "Initiator";
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
            $history->change_from = "Initiator";
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
            $history->change_from = "Initiator";
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
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }


        if (!empty($data->reference_document)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Reference Documents';
            $history->previous = "Null";
            $history->current = $data->reference_document;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->Observation_on_Page_No)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Error Observed on Page';
            $history->previous = "Null";
            $history->current = $data->Observation_on_Page_No;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->brief_description)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Brief Description';
            $history->previous = "Null";
            $history->current = $data->brief_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
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
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->Date_and_time_of_correction)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'Date And Time of Correction';
            $history->previous = "Null";
            $history->current = $data->Date_and_time_of_correction;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->HOD_Remarks)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'HOD Remarks';
            $history->previous = "Null";
            $history->current = $data->HOD_Remarks;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->HOD_Attachments)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'HOD Attachments';
            $history->previous = "Null";
            $history->current = $data->HOD_Attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->QA_Feedbacks)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'QA Feedbacks';
            $history->previous = "Null";
            $history->current = $data->QA_Feedbacks;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($data->QA_Attachments)) {
            $history = new ErrataAuditTrail();
            $history->errata_id = $data->id;
            $history->activity_type = 'QA Attachment';
            $history->previous = "Null";
            $history->current = $data->QA_Attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiator";
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
            $history->change_from = "Initiator";
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
            $history->change_from = "Initiator";
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
            $history->change_from = "Initiator";
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
            $history->change_from = "Initiator";
            $history->action_name = 'Create';
            $history->save();
        }
        //==================GRID=======================
        $errata_id = $data->id;
        $newDataGridErrata = ErrataGrid::where(['e_id' => $errata_id, 'identifier' => 'details'])->firstOrCreate();
        $newDataGridErrata->e_id = $errata_id;
        $newDataGridErrata->identifier = 'details';
        $newDataGridErrata->data = $request->details;
        $newDataGridErrata->save();
        //================================================================

        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }

    public function show($id)
    {
        $showdata = errata::find($id);
        // dd($showdata);
        $errata_id = $id;
        $grid_Data = ErrataGrid::where(['e_id' => $errata_id, 'identifier' => 'details'])->first();
        return view('frontend.errata.errata_view', compact('showdata', 'grid_Data', 'errata_id'));
    }

    public function stageChange(Request $request, $id)
    {
        // dd($request->all());
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $ErrataControl = errata::find($id);
            $lastDocument = errata::find($id);
            // $evaluation = Evaluation::where('cc_id', $id)->first();
            if ($ErrataControl->stage == 1) {
                $ErrataControl->stage = "2";
                $ErrataControl->status = "Pending Review";
                $ErrataControl->submitted_by = Auth::user()->name;
                $ErrataControl->submitted_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $ErrataControl->submitted_by;
                $history->comment = $request->comment;
                $history->action = 'Review Complete';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Pending Review";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Submit';
                $history->stage = 'Plan Approved';
                $history->save();

                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 2) {
                $ErrataControl->stage = "3";
                $ErrataControl->status = "Pending Correction";
                $ErrataControl->review_completed_by = Auth::user()->name;
                $ErrataControl->review_completed_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->review_completed_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $ErrataControl->review_completed_by;
                $history->comment = $request->comment;
                $history->action = 'Correction Complete';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Pending Correction";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Correction Completed';
                $history->action_name = 'Update';
                $history->save();

                // $ErrataControl->status = "Pending Correction";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 3) {
                $ErrataControl->stage = "4";
                $ErrataControl->status = "Pending HOD Review";
                $ErrataControl->correction_completed_by = Auth::user()->name;
                $ErrataControl->correction_completed_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->correction_completed_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $ErrataControl->correction_completed_by;
                $history->comment = $request->comment;
                $history->action = 'HOD Review Complete';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Pending HOD Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'HOD Review Completed';
                $history->action_name = 'Update';
                $history->save();

                // $ErrataControl->status = "Pending HOD Review";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($ErrataControl->stage == 4) {
                $ErrataControl->stage = "5";
                $ErrataControl->status = "Pending QA Head Approval";
                $ErrataControl->hod_review_complete_by = Auth::user()->name;
                $ErrataControl->hod_review_complete_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->hod_review_complete_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $ErrataControl->hod_review_complete_by;
                $history->comment = $request->comment;
                $history->action = 'QA Head Approval Complete';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Pending QA Head Approval";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Update';
                $history->stage = 'QA Head Approval Completed';
                $history->save();

                // $ErrataControl->status = "Pending QA Head Approval";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($ErrataControl->stage == 5) {
                $ErrataControl->stage = "6";
                $ErrataControl->status = "Closed Done";
                $ErrataControl->qa_head_approval_completed_by = Auth::user()->name;
                $ErrataControl->qa_head_approval_completed_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->qa_head_approval_completed_comment = $request->comment;

                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $ErrataControl->qa_head_approval_completed_by;
                $history->comment = $request->comment;
                $history->action = 'Closed-Done';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Closed Done";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Update';
                $history->stage = 'Closed-Done';
                $history->save();


                // $ErrataControl->status = "Closed-Done";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
          else {
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
                $ErrataControl->reject_by = Auth::user()->name;
                $ErrataControl->reject_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->reject_comment = $request->comment;

                $ErrataControl->status = "Opened";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 3) {
                $ErrataControl->stage = "2";
                $ErrataControl->status = "Pending Review";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 4) {
                $ErrataControl->stage = "3";
                // $ErrataControl->sent_to_open_state_by = Auth::user()->name;
                // $ErrataControl->sent_to_open_state_on = Carbon::now()->format('d-M-Y');
                // $ErrataControl->sent_to_open_state_comment = $request->comment;
                $ErrataControl->status = "Pending Correction";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($ErrataControl->stage == 5) {
                $ErrataControl->stage = "1";
                $ErrataControl->sent_to_open_state_by = Auth::user()->name;
                $ErrataControl->sent_to_open_state_on = Carbon::now()->format('d-M-Y');
                $ErrataControl->sent_to_open_state_comment = $request->comment;
                $history = new ErrataAuditTrail();
                $history->errata_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $ErrataControl->sent_to_open_state_by;
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
                toastr()->success('Document Sent');
                return back();

        }
            if ($ErrataControl->stage == 6) {
                $ErrataControl->stage = "5";
                $ErrataControl->status = "Pending QA Head Approval";
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
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password))
        {
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
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $ErrataControl->sent_to_open_state_by;
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
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 2)
            {
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
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $ErrataControl->sent_to_open_state_by;
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
            if ($ErrataControl->stage == 3)
            {
                $ErrataControl->stage = "0";
                $ErrataControl->status = "Closed-Cancelled";
                $ErrataControl->update();
                toastr()->success('Document Cancelled');
            }
            return back();
        }
        else
            {
                toastr()->error('E-signature Not match');
                return back();
            }
        }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $lastData = errata::find($id);
        $data = errata::find($id);
        $data->record_no = $request->record_no;
        $data->division_id = $request->division_id;
        $data->initiator_id = Auth::user()->id;
        $data->intiation_date = $request->intiation_date;
        $data->initiated_by = $request->initiated_by;
        $data->Department = $request->Department;
        $data->department_code = $request->department_code;
        $data->document_type = $request->document_type;
        $data->short_description = $request->short_description;
        $data->reference_document = is_array($request->reference_document)
            ? implode(',', $request->reference_document)
            : $request->reference_document;
        $data->Observation_on_Page_No = $request->Observation_on_Page_No;
        $data->brief_description = $request->brief_description;
        $data->type_of_error = $request->type_of_error;
        // $data->details = $request->details;
        $data->Date_and_time_of_correction = $request->Date_and_time_of_correction ? Carbon::parse($request->Date_and_time_of_correction)->format('d-M-Y H:i') : '';
        $data->QA_Feedbacks = $request->QA_Feedbacks;


        if (!empty($request->QA_Attachments)) {
            $files = [];
            if ($request->hasfile('QA_Attachments')) {
                foreach ($request->file('QA_Attachments') as $file) {
                    $name = $request->name . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $data->QA_Attachments = json_encode($files);
        }


        $data->HOD_Remarks = $request->HOD_Remarks;

        if (!empty($request->HOD_Attachments)) {
            $files = [];
            if ($request->hasfile('HOD_Attachments')) {
                foreach ($request->file('HOD_Attachments') as $file) {
                    $name = $request->name . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
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
            if ($request->hasfile('Closure_Attachments')) {
                foreach ($request->file('Closure_Attachments') as $file) {
                    $name = $request->name . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->Closure_Attachments = json_encode($files);
        }

        $data->update();

        if ($lastData->initiated_by != $data->initiated_by || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'Initiated By';
            $history->previous = $lastData->initiated_by;
            $history->current = $data->initiated_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->Department != $data->Department || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'Department';
            $history->previous = $lastData->Department;
            $history->current = $data->Department;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->department_code != $data->department_code || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'Department Code';
            $history->previous = $lastData->department_code;
            $history->current = $data->department_code;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->document_type != $data->document_type || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'Document Type';
            $history->previous = $lastData->document_type;
            $history->current = $data->document_type;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->short_description != $data->short_description || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastData->short_description;
            $history->current = $data->short_description;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->reference_document != $data->reference_document || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'Reference Documents';
            $history->previous = $lastData->reference_document;
            $history->current = $data->reference_document;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->Observation_on_Page_No != $data->Observation_on_Page_No || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'Observation on Page No';
            $history->previous = $lastData->Observation_on_Page_No;
            $history->current = $data->Observation_on_Page_No;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->brief_description != $data->brief_description || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'Brief Description';
            $history->previous = $lastData->brief_description;
            $history->current = $data->brief_description;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->type_of_error != $data->type_of_error || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'Type Of Error';
            $history->previous = $lastData->type_of_error;
            $history->current = $data->type_of_error;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->details != $data->details || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'Details';
            $history->previous = $lastData->details;
            $history->current = $data->details;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->Date_and_time_of_correction != $data->Date_and_time_of_correction || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'Date And Time of Correction';
            $history->previous = $lastData->Date_and_time_of_correction;
            $history->current = $data->Date_and_time_of_correction;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->QA_Feedbacks != $data->QA_Feedbacks || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'QA Feedbacks';
            $history->previous = $lastData->QA_Feedbacks;
            $history->current = $data->QA_Feedbacks;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->QA_Attachments != $data->QA_Attachments || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'QA Attachment';
            $history->previous = $lastData->QA_Attachments;
            $history->current = $data->QA_Attachments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->HOD_Remarks != $data->HOD_Remarks || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'HOD Remarks';
            $history->previous = $lastData->HOD_Remarks;
            $history->current = $data->HOD_Remarks;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->HOD_Attachments != $data->HOD_Attachments || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'HOD Attachments';
            $history->previous = $lastData->HOD_Attachments;
            $history->current = $data->HOD_Attachments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->Closure_Comments != $data->Closure_Comments || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'Closure Comments';
            $history->previous = $lastData->Closure_Comments;
            $history->current = $data->Closure_Comments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->All_Impacting_Documents_Corrected != $data->All_Impacting_Documents_Corrected || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'All Impacting Documents Corrected';
            $history->previous = $lastData->All_Impacting_Documents_Corrected;
            $history->current = $data->All_Impacting_Documents_Corrected;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->Remarks != $data->Remarks || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'Remarks';
            $history->previous = $lastData->Remarks;
            $history->current = $data->Remarks;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        if ($lastData->Closure_Attachments != $data->Closure_Attachments || !empty ($request->comment)) {
            // return 'history';
            $history = new ErrataAuditTrail;
            $history->errata_id = $id;
            $history->activity_type = 'Closure Attachments';
            $history->previous = $lastData->Closure_Attachments;
            $history->current = $data->Closure_Attachments;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastData->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastData->status;
            $history->action_name = 'Update';
            $history->save();
        }

        //==================GRID=======================
        $errata_id = $data->id;
        $newDataGridErrata = ErrataGrid::where(['e_id' => $errata_id, 'identifier' => 'details'])->firstOrCreate();
        $newDataGridErrata->e_id = $errata_id;
        $newDataGridErrata->identifier = 'details';
        $newDataGridErrata->data = $request->details;
        $newDataGridErrata->save();
        //================================================================
        toastr()->success("Record is created Successfully");
        return back();
    }

    public function singleReports(Request $request, $id){
        $data = errata::find($id);
        $grid_Data = ErrataGrid::where(['e_id' => $id, 'identifier' => 'details'])->first();
        if (!empty($data)) {
            $data->data = ErrataGrid::where('e_id', $id)->where('identifier', "details")->first();
            // $data->Instruments_Details = ErrataGrid::where('e_id', $id)->where('type', "Instruments_Details")->first();
            // $data->Material_Details = Erratagrid::where('e_id', $id)->where('type', "Material_Details")->first();
            // dd($data->all());
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.errata.errata_single_pdf', compact('data','grid_Data'))
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
        $today = Carbon::now()->format('d-m-y');
        $document = errata::where('id', $id)->first();
        $document->originator = User::where('id', $document->initiator_id)->value('name');

        return view('frontend.errata.errata_audit_trail', compact('audit', 'document', 'today'));
    }

    public function auditDetailsErrata($id)
    {

        $detail = ErrataAuditTrail::find($id);

        $detail_data = ErrataAuditTrail::where('activity_type', $detail->activity_type)->where('errata_id', $detail->errata_id)->latest()->get();

        $doc = errata::where('id', $detail->errata_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);
        return view('frontend.errata.errata_audit_inner', compact('detail', 'doc', 'detail_data'));
    }

    public function auditTrailPdf($id){
        $doc = errata::find($id);
        $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        $data = ErrataAuditTrail::where('errata_id', $doc->id)->orderByDesc('id')->get();
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.errata.errata_audit_trail_pdf', compact('data', 'doc'))
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
