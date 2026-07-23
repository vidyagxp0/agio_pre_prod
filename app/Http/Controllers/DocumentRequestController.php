<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Document;
use App\Models\DocumentRequest;
use App\Models\RecordNumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PDF;
use Helpers;

class DocumentRequestController extends Controller
{
    public function create()
    {
        $documents = Document::select('id', 'document_number')
            ->orderBy('document_number', 'asc')
            ->get();

        $lastRecord = DocumentRequest::orderBy('record','desc')->first();

        $record = $lastRecord ? $lastRecord->record + 1 : 1;

        return view(
            'frontend.documents.requestdoc.create_req',
            compact('documents', 'record')
        );
    }

    public function store(Request $request)
    {
        $lastRecord = DocumentRequest::orderBy('record', 'desc')->first();

        $record = $lastRecord ? $lastRecord->record + 1 : 1;

        $initiationDate = Carbon::now();

        $requestId =
            $initiationDate->format('dmy')
            . '-T'
            . str_pad($record, 3, '0', STR_PAD_LEFT);

        $data = new DocumentRequest();

        $data->record = $record;
        $data->request_id = $requestId;
        $data->request_by = Auth::id();
        $data->department = Helpers::getUserDepartmentFromDB(
            Auth::user()->departmentid
        );
        $data->division_id = session()->get('division');
        $data->initiation_date = $initiationDate->format('Y-m-d');
        $data->document_id = $request->document_id;
        $data->request_to = $request->request_to;
        $data->number_of_copies = $request->number_of_copies;
        $data->reason = $request->reason;
        $data->comment = $request->comment;
        $data->status = 'Opened';
        $data->stage = 1;

        $data->save();

        toastr()->success('Document Request created successfully');

        return redirect('/documents');
    }
    
    public function show($id)
    {
        $data = DocumentRequest::find($id);

        if (!$data) {
            toastr()->error('Document request not found');
            return redirect()->back();
        }

        $documents = Document::orderBy('id', 'desc')->get();


        return view('frontend.documents.requestdoc.view_req', compact('data', 'documents')
        );
    }

    public function update(Request $request, $id)
    {
        $data = DocumentRequest::find($id);

        if (!$data) {
            toastr()->error('Document Request not found');
            return redirect('/documents');
        }

        $data->document_id = $request->document_id;
        $data->request_to = $request->request_to;
        $data->number_of_copies = $request->number_of_copies;
        $data->reason = $request->reason;

        $data->comment = $request->comment;


        $data->save();

        toastr()->success('Document Request updated successfully');

        return redirect()->back();
    }

    public function docReq_sendstage(Request $request, $id)
    {

        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $data = DocumentRequest::find($id);
            $lastDocument = DocumentRequest::find($id);

            
            if ($data->stage == 1) {
            
                $data->stage = "2";
                $data->status = "QA Approval";
                $data->submitted_by = Auth::user()->name;
                $data->submitted_on = Carbon::now()->format('d-M-Y');
                $data->submitted_comment = $request->comment;

                // $history = new ChangeProposalAuditTrial();
                // $history->cpjg_id = $id;
                // $history->activity_type = 'Submit By, Submit On';
                // if (is_null($lastDocument->submit_by) || $lastDocument->submit_by === '') {
                //     $history->previous = "Null";
                // } else {
                //     $history->previous = $lastDocument->submit_by . ' , ' . $lastDocument->submit_on;
                // }
                // $history->current = $data->submit_by . ' , ' . $data->submit_on;
                // $history->action = 'Submit';
                // $history->comment = $request->comment;
                // $history->user_id = Auth::user()->id;
                // $history->user_name = Auth::user()->name;
                // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                // $history->origin_state = $lastDocument->status;
                // $history->change_to =   "QA Approval";
                // $history->change_from = $lastDocument->status;
                // $history->stage = 'QA Approval';
                // if (is_null($lastDocument->submit_by) || $lastDocument->submit_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                // $history->save();

                $data->update();
                return back();
            }


            if ($data->stage == 2) {
                
                $data->stage = "3";
                $data->status = "Closed - Done";
                $data->completed_by = Auth::user()->name;
                $data->completed_on = Carbon::now()->format('d-M-Y');
                $data->complete_comment = $request->comment;

                // $history = new ChangeProposalAuditTrial();
                // $history->cpjg_id = $id;
                // $history->activity_type = 'QA/CQA Head/Designee Approval Complete By, QA/CQA Head/Designee Approval Complete On';
                // if (is_null($lastDocument->completed_by) || $lastDocument->completed_by === '') {
                //     $history->previous = "Null";
                // } else {
                //     $history->previous = $lastDocument->completed_by . ' , ' . $lastDocument->completed_on;
                // }
                // $history->current = $data->completed_by . ' , ' . $data->completed_on;
                // $history->comment = $request->comment;
                // $history->action = 'Approved';
                // $history->user_id = Auth::user()->id;
                // $history->user_name = Auth::user()->name;
                // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                // $history->origin_state = $lastDocument->status;
                // $history->change_to =   "Closed - Done";
                // $history->change_from = $lastDocument->status;
                // $history->stage = 'Closed - Done';
                // if (is_null($lastDocument->completed_by) || $lastDocument->completed_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                // $history->save();

                $data->update();
                return back();
            }


        } else {
            toastr()->error('E-signature Not match');
            return back();
        }

    }

}
