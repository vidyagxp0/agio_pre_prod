<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleGroup;
use App\Models\Document;
use App\Models\DocumentRequest;
use App\Models\RecordNumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

use App\Jobs\SendMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\DocumentRequestAuditTrial;
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
        $data->form_type = 'Document Issuance Request';
        
        $data->stage = 1;


       $data->save();

         //////// Audit Trail///////////////

$fields = [

    'Request ID'       => $data->request_id,
    'Request By'       => Helpers::getInitiatorName($data->request_by),
    'Department'       => $data->department,
    // 'Division'         => Helpers::getDivisionName($data->division_id),
    'Initiation Date'  => Helpers::getDateFormat($data->initiation_date),
    'Document'      => Document::where('id', $data->document_id)->value('document_name'),
    'Request To'       => Helpers::getInitiatorName($data->request_to),
    'Number Of Copies' => $data->number_of_copies,
    'Reason'           => $data->reason,
    'Comment'          => $data->comment,

];

foreach ($fields as $field => $value) {

    $audit = new DocumentRequestAuditTrial();

    $audit->document_request_id = $data->id;
    $audit->activity_type = $field;
    $audit->previous = "Null";
    $audit->current = $value;
    $audit->comment = "Not Applicable";

    $audit->user_id = Auth::id();
    $audit->user_name = Auth::user()->name;
    $audit->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

    $audit->origin_state = "Create";
    $audit->change_to = "Created";
    $audit->change_from = "Initiation";
    $audit->action_name = "Create";
    $audit->action = "Create";
    $audit->stage = "Create";

    $audit->save();
}


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

         $lastopenState = DocumentRequest::find($id);

        if (!$data) {
            toastr()->error('Document Request not found');
            return redirect('/documents');
        }

        $data->document_id = $request->document_id;
        $data->request_to = $request->request_to;
        $data->number_of_copies = $request->number_of_copies;
        $data->reason = $request->reason;

        $data->comment = $request->comment;



        // Document
            if ($lastopenState->document_id != $data->document_id || !empty($request->document_id_comment)) {

            $history = new DocumentRequestAuditTrial();

            $history->document_request_id = $id;
            $history->activity_type = 'Document';

            $history->previous = Document::where('id', $lastopenState->document_id)
                ->value('document_name');

            $history->current = Document::where('id', $data->document_id)
                ->value('document_name');

            $history->comment = $request->document_id_comment;
            $history->user_id = Auth::id();
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = is_null($lastopenState->document_id) ? "New" : "Update";

            $history->save();
        }

        // Request To
        if ($lastopenState->request_to != $data->request_to || !empty($request->request_to_comment)) {
            $history = new DocumentRequestAuditTrial();
            $history->document_request_id = $id;
            $history->activity_type = 'Request To';
            $history->previous = Helpers::getInitiatorName($lastopenState->request_to);
            $history->current = Helpers::getInitiatorName($data->request_to);
            $history->comment = $request->request_to_comment;
            $history->user_id = Auth::id();
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = is_null($lastopenState->request_to) ? "New" : "Update";
            $history->save();
        }

        // Number Of Copies
        if ($lastopenState->number_of_copies != $data->number_of_copies || !empty($request->number_of_copies_comment)) {
            $history = new DocumentRequestAuditTrial();
            $history->document_request_id = $id;
            $history->activity_type = 'Number Of Copies';
            $history->previous = $lastopenState->number_of_copies;
            $history->current = $data->number_of_copies;
            $history->comment = $request->number_of_copies_comment;
            $history->user_id = Auth::id();
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = is_null($lastopenState->number_of_copies) ? "New" : "Update";
            $history->save();
        }

        // Reason
        if ($lastopenState->reason != $data->reason || !empty($request->reason_comment)) {
            $history = new DocumentRequestAuditTrial();
            $history->document_request_id = $id;
            $history->activity_type = 'Reason';
            $history->previous = $lastopenState->reason;
            $history->current = $data->reason;
            $history->comment = $request->reason_comment;
            $history->user_id = Auth::id();
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = is_null($lastopenState->reason) ? "New" : "Update";
            $history->save();
        }

        // Comment
        if ($lastopenState->comment != $data->comment || !empty($request->comment_comment)) {
            $history = new DocumentRequestAuditTrial();
            $history->document_request_id = $id;
            $history->activity_type = 'Comment';
            $history->previous = $lastopenState->comment;
            $history->current = $data->comment;
            $history->comment = $request->comment_comment;
            $history->user_id = Auth::id();
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastopenState->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastopenState->status;
            $history->action_name = is_null($lastopenState->comment) ? "New" : "Update";
            $history->save();
        }
                
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

             $mandatoryFields = [
                    'request_to', 'document_id', 'number_of_copies', 
                    'reason'
                ];
                
                foreach ($mandatoryFields as $field) {
                    if (!isset($data->$field) || trim($data->$field) === '') {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => "Please fill all required fields before proceeding. Missing: $field"
                        ]);
                        return redirect()->back();
                    }
                }
                
                // If all fields are filled, proceed
                Session::flash('swal', [
                    'type' => 'success',
                    'title' => 'Success',
                    'message' => 'Document Sent'
                ]);
            
                $data->stage = "2";
                $data->status = "QA Approval";
                $data->submitted_by = Auth::user()->name;
                $data->submitted_on = Carbon::now()->format('d-M-Y');
                $data->submitted_comment = $request->comment;


                    





                ///

                $history = new DocumentRequestAuditTrial();
                $history->document_request_id = $id;
                $history->activity_type = 'Request Sent By, Request Sent On';
                if (is_null($lastDocument->submitted_by) || $lastDocument->submitted_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->submitted_by . ' , ' . $lastDocument->submitted_on;
                }
                $history->current = $data->submitted_by . ' , ' . $data->submitted_on;
                $history->action = 'Request Sent';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "QA Approval";
                $history->change_from = $lastDocument->status;
                $history->stage = 'QA Approval';
                if (is_null($lastDocument->submitted_by) || $lastDocument->submitted_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                 $list = Helpers::getQAUserList($data->division_id);

                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    $DataEmail = [
                                        'data' => $data,
                                        'site' => "Document Issuance Request",
                                        'history' => "Request Sent",
                                        'process' => 'Document Issuance Request',
                                        'comment' => $request->comment,
                                        'user'=> Auth::user()->name
                                    ];

                                    // dd($DataEmail);

                                    SendMail::dispatch($DataEmail, $email, $data, 'Document Issuance Request');

                                } catch (\Exception $e) {
                                    \Log::error('Mail Error: ' . $e->getMessage());
                                }
                            }
                        }

               

                $data->update();
                return back();
            }


            if ($data->stage == 2) {
                

             if (empty($data->comment))
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'QA Approval Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                else {
                    // dd($updateCFT->hod_assessment_comments);
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Document Sent'
                    ]);
                }
                $data->stage = "3";
                $data->status = "Closed - Done";
                $data->completed_by = Auth::user()->name;
                $data->completed_on = Carbon::now()->format('d-M-Y');
                $data->complete_comment = $request->comment;

                $history = new DocumentRequestAuditTrial();
                $history->document_request_id = $id;
                $history->activity_type = 'Approved By, Approved On';
                if (is_null($lastDocument->completed_by) || $lastDocument->completed_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->completed_by . ' , ' . $lastDocument->completed_on;
                }
                $history->current = $data->completed_by . ' , ' . $data->completed_on;
                $history->comment = $request->comment;
                $history->action = 'Approved';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Closed - Done";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Closed - Done';
                if (is_null($lastDocument->completed_by) || $lastDocument->completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();


                 $list = Helpers::getQAUserList($data->division_id);

                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    $DataEmail = [
                                        'data' => $data,
                                        'site' => "Document Issuance Request",
                                        'history' => "Approved",
                                        'process' => 'Document Issuance Request',
                                        'comment' => $request->comment,
                                        'user'=> Auth::user()->name
                                    ];

                                    SendMail::dispatch($DataEmail, $email, $data, 'Document Issuance Request');

                                } catch (\Exception $e) {
                                    \Log::error('Mail Error: ' . $e->getMessage());
                                }
                            }
                        }

                $data->update();
                return back();
            }


        } else {
            toastr()->error('E-signature Not match');
            return back();
        }

    }


       public function docReq_stageBack(Request $request, $id)
    {

        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $data = DocumentRequest::find($id);
            $lastDocument = DocumentRequest::find($id);

            
            if ($data->stage == 2) {
            
                $data->stage = "1";
                $data->status = "QA Approval";
                $data->stagebackfirstby = Auth::user()->name;
                $data->stagebackfirst_on = Carbon::now()->format('d-M-Y');
                $data->stagebackfirst_comment = $request->comment;








                ///

                $history = new DocumentRequestAuditTrial();
                $history->document_request_id = $id;

                 $history->previous = "Not Applicable";
                $history->activity_type = 'Not Applicable';
                $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->action  = "More Information Required";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Request For Print";
                $history->change_from = $lastDocument->status;
                $history->action_name = "Not Applicable";
                $history->stage = 'Request For Print';
              
                $history->save();
                

                 $list = Helpers::getQAUserList($data->division_id);

                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    $DataEmail = [
                                        'data' => $data,
                                        'site' => "Document Issuance Request",
                                        'history' => "More Info Required",
                                        'process' => 'Document Issuance Request',
                                        'comment' => $request->comment,
                                        'user'=> Auth::user()->name
                                    ];

                                    SendMail::dispatch($DataEmail, $email, $data, 'Document Issuance Request');

                                } catch (\Exception $e) {
                                    \Log::error('Mail Error: ' . $e->getMessage());
                                }
                            }
                        }

               

                $data->update();
                return back();
            }
        }    
    }  

    public function docReq_stageCancel(Request $request, $id)
    {

        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $data = DocumentRequest::find($id);
            $lastDocument = DocumentRequest::find($id);

            
            if ($data->stage == 1) {
            
                $data->stage = "0";
                $data->status = "Closed-Cancelled";
                $data->stagecancelfirstby = Auth::user()->name;
                $data->stagecancelfirst_on = Carbon::now()->format('d-M-Y');
                $data->stagecancelfirst_comment = $request->comment;








                ///

                $history = new DocumentRequestAuditTrial();
               

             $history->action = "Cancel";
            $history->document_request_id = $id;
            $history->activity_type = 'Activity Log';
            $history->current = $data->stagecancelfirstby;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Cancelled";
            $history->change_from = $lastDocument->status;
            $history->stage = "Cancelled";
            $history->save();



               

                 $list = Helpers::getQAUserList($data->division_id);

                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    $DataEmail = [
                                        'data' => $data,
                                        'site' => "Document Issuance Request",
                                        'history' => "Cancel",
                                        'process' => 'Document Issuance Request',
                                        'comment' => $request->comment,
                                        'user'=> Auth::user()->name
                                    ];

                                    SendMail::dispatch($DataEmail, $email, $data, 'Document Issuance Request');

                                } catch (\Exception $e) {
                                    \Log::error('Mail Error: ' . $e->getMessage());
                                }
                            }
                        }

               

                $data->update();
                return back();
            }
        }    
    }  

      public function DocumentRequestAuditTrail($id)
    {
       
    $audit = DocumentRequestAuditTrial::where('document_request_id', $id)->orderByDesc('id')->paginate(5);
        //  dd($audit);
        $today = Carbon::now()->format('d-m-y');
        $document = DocumentRequest::where('id', $id)->first();
        // dd($document);/
        $document->initiator = User::where('id', $document->initiator)->value('name');
        $users = User::all();
        // dd($document);
        return view('frontend.documents.requestdoc.auditTrial', compact('audit', 'document', 'today', 'users'));
    }


}
