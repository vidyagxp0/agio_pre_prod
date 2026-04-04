<?php

namespace App\Http\Controllers;

use App\Models\ChangeProposalJust;
use App\Models\ChangeProposalJustGrid;
use App\Models\RecordNumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\RoleGroup;
use Helpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;





use Illuminate\Http\Request;
use Carbon\Carbon;



class ChangeProposalJustController extends Controller
{
    
    public function index()
    {
        
    }

    
    public function create()
    {

     $old_record = ChangeProposalJust::select('id', 'division_id', 'record')->get();
        $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = str_pad($record, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        return view('frontend.changePropaslJust.create', compact('due_date', 'record', 'old_record'));
    }

    
    // public function store(Request $request)
    // {
    
    
    //     if (!$request->cpdescription) {
    //         toastr()->error("Short description is required");
    //         return redirect()->back();
    //     }
    //     $openState = new ChangeProposalJust();
    //     $openState->initiator_id = Auth::user()->id;
    //     $openState->record = DB::table('record')->value('counter') + 1;
    //     $openState->division_code = $request->division_code;
    //     $openState->division_id = $request->division_id;
    //     $openState->cpdescription = $request->cpdescription;
    //     $openState->status = 'Opened';
    //     $openState->stage = 1;

    //     if (!empty($request->cpAttachment)) {
    //         $files = [];
    //         if ($request->hasfile('cpAttachment')) {
    //             foreach ($request->file('cpAttachment') as $file) {
                      
    //                 $name = $request->name . 'cpAttachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
    //                 $file->move('upload/', $name);
    //                 $files[] = $name;
    //             }
            
    //         }
    //         $openState->cpAttachment = json_encode($files);
    //     }
    //     $openState->save();

    //     // $counter = DB::table('record_numbers')->value('counter');
    //     // $recordNumber = str_pad($counter, 5, '0', STR_PAD_LEFT);
    //     // $newCounter = $counter + 1;
    //     // DB::table('record_numbers')->update(['counter' => $newCounter]);


    //     // if (!empty($openState->short_description)) {
    //     // $history = new ActionItemHistory();
    //     // $history->cc_id =   $openState->id;
    //     // $history->activity_type = 'Short Description';
    //     // $history->previous = "Null";
    //     // $history->current =  $openState->short_description;
    //     // $history->comment = "NA";
    //     // $history->user_id = Auth::user()->id;
    //     // $history->user_name = Auth::user()->name;
    //     // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    //     // $history->origin_state = $openState->status;
    //     // $history->change_to = "Opened";
    //     //  $history->change_from = "Initiator";
    //     //  $history->action_name = "store";

    //     // $history->save();
    //     // }
        

    //     toastr()->success('Document created');
    //     return redirect('rcms/qms-dashboard');
    
    // }

    public function store(Request $request)
    {
        if (!$request->cpdescription) {
            toastr()->error("Short description is required");
            return redirect()->back();
        }

        // 🔹 Main Save
        $openState = new ChangeProposalJust();
        $openState->initiator_id = Auth::id();
        $openState->record = DB::table('record_numbers')->value('counter') + 1;
        $openState->division_code = $request->division_code;
        $openState->division_id = $request->division_id;
        $openState->cpdescription = $request->cpdescription;
        $openState->status = 'Opened';
        $openState->stage = 1;

        // 🔹 File Upload
        if ($request->hasFile('cpAttachment')) {
            $files = [];
            foreach ($request->file('cpAttachment') as $file) {
                $name = time() . rand(1,100) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/'), $name);
                $files[] = $name;
            }
            $openState->cpAttachment = json_encode($files);
        }

        $openState->save();

        // =========================
        // 🔹 GRID SAVE
        // =========================
        if ($request->has('change_proposal_grid')) {

            ChangeProposalJustGrid::updateOrCreate(
                [
                    'cpjg_id' => $openState->id,
                    'identifier' => 'change_proposal_grid'
                ],
                [
                    'data' => $request->change_proposal_grid
                ]
            );
        }

        // =========================
        // 🔹 AUDIT TRAIL
        // =========================
        if ($request->has('change_proposal_grid')) {

            $fields = [
                'existing_system' => 'Existing System',
                'proposed_change' => 'Proposed Change',
                'justification' => 'Justification'
            ];
        }

        toastr()->success('Document created');
        return redirect('rcms/qms-dashboard');
    }

  
    public function show($id)
    {

    $data = ChangeProposalJust::find($id);
    $changeProposalGrid = ChangeProposalJustGrid::where('cpjg_id', $id)->where('identifier', 'change_proposal_grid')->first();

    // dd($changeProposalGrid);
        return view('frontend.changePropaslJust.view',compact('data','changeProposalGrid'));

    }

  
    public function edit(ChangeProposalJust $changeProposalJust)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
// dd($request->all());
        $data = ChangeProposalJust::find($id);
        $data->division_code = $request->division_code;

        $data->intiation_date = $request->intiation_date;

        $data->cpdescription = $request->cpdescription;
        $data->hod_comment = $request->hod_comment;
        $data->qa_comment = $request->qa_comment;
        $data->qa_cqa_head_comment = $request->qa_cqa_head_comment;


        if (!empty($request->cpAttachment)) {
            if ($data->cpAttachment) {
                $existingFiles = json_decode($data->cpAttachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = array_values($existingFiles); // Re-index the array to ensure it's a proper array
                }
            }

            if ($request->hasfile('cpAttachment')) {
                foreach ($request->file('cpAttachment') as $file) {
                    $name = $request->name . 'attachment_extension' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
        }

        $data->cpAttachment = !empty($files) ? json_encode(array_values($files)) : null; // Re-index again before encoding

        if (!empty($request->hodAttachment)) {
            if ($data->hodAttachment) {
                $existingFiles = json_decode($data->hodAttachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = array_values($existingFiles); // Re-index the array to ensure it's a proper array
                }
            }

            if ($request->hasfile('hodAttachment')) {
                foreach ($request->file('hodAttachment') as $file) {
                    $name = $request->name . 'attachment_extension' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
        }

        $data->hodAttachment = !empty($files) ? json_encode(array_values($files)) : null; // Re-index again before encoding

         if (!empty($request->qaAttachment)) {
            if ($data->qaAttachment) {
                $existingFiles = json_decode($data->qaAttachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = array_values($existingFiles); // Re-index the array to ensure it's a proper array
                }
            }

            if ($request->hasfile('qaAttachment')) {
                foreach ($request->file('qaAttachment') as $file) {
                    $name = $request->name . 'attachment_extension' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
        }

        $data->qaAttachment = !empty($files) ? json_encode(array_values($files)) : null; // Re-index again before encoding

         if (!empty($request->qa_cqa_head_Attachment)) {
            if ($data->qa_cqa_head_Attachment) {
                $existingFiles = json_decode($data->qa_cqa_head_Attachment, true); // Convert to associative array
                if (is_array($existingFiles)) {
                    $files = array_values($existingFiles); // Re-index the array to ensure it's a proper array
                }
            }

            if ($request->hasfile('qa_cqa_head_Attachment')) {
                foreach ($request->file('qa_cqa_head_Attachment') as $file) {
                    $name = $request->name . 'attachment_extension' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
        }

        $data->qa_cqa_head_Attachment = !empty($files) ? json_encode(array_values($files)) : null; // Re-index again before encoding
  

        $data->update();

        $change_proposal_grid_id = $data->id;
        $changeProposalGridData = ChangeProposalJustGrid::where(['cpjg_id' => $change_proposal_grid_id, 'identifier' => 'change_proposal_grid' ])->firstOrCreate();
        $changeProposalGridData->cpjg_id = $change_proposal_grid_id;
        $changeProposalGridData->identifier = 'change_proposal_grid';
        $changeProposalGridData->data = $request->change_proposal_grid;
        $changeProposalGridData->save();
     

        toastr()->success("Record is updated Successfully");
        return redirect()->back();
    }
        
    
    public function destroy(ChangeProposalJust $changeProposalJust)
    {
        //
    }

     public function sendstage(Request $request, $id)
    {

            if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
                $data = ChangeProposalJust::find($id);
                $lastDocument = ChangeProposalJust::find($id);

                if ($data->stage == 1) {

                    if (empty($data->reviewers) || empty($data->approvers))
                   

                    $data->stage = "2";
                    $data->status = "In Review";
                    $data->submit_by = Auth::user()->name;
                    $data->submit_on = Carbon::now()->format('d-M-Y');
                    $data->submit_comment = $request->comment;

                    // $history = new dataAuditTrail();
                    // $history->extension_id = $id;
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
                    // $history->change_to =   "In Review";
                    // $history->change_from = $lastDocument->status;
                    // $history->stage = 'In Review';
                    // if (is_null($lastDocument->submit_by) || $lastDocument->submit_by === '') {
                    //     $history->action_name = 'New';
                    // } else {
                    //     $history->action_name = 'Update';
                    // }
                    // $history->save();

                    // $list = Helpers::getHodUserList($data->division_id)
                    // ->unique('user_id')
                    // ->values();
                    // foreach ($list as $u) {
                    //         $email = Helpers::getUserEmail($u->user_id);

                    //      if (!empty($email)) {
                    //     try{

                    //             $data = [
                    //                 'data'    => $data,
                    //                 'site'    => "Extension",
                    //                 'history' => "Submit",
                    //                 'process' => 'Extension',
                    //                 'comment' => $request->comment,
                    //                 'user'    => Auth::user()->name
                    //             ];

                    //             SendMail::dispatch(
                    //                 $data,
                    //                 $email,
                    //                 $data,
                    //                 'Extension'
                    //             );

                    //         } catch (\Exception $e) {
                    //             \Log::error('Mail Error: ' . $e->getMessage());
                    //         }
                    //         }
                        
                    // }

                    $data->update();
                    return back();
                }

                if ($data->stage == 2) {
                    
                    $data->stage = "3";
                    $data->status = "In Approved";
                    $data->HOD_Review_Complete_By = Auth::user()->name;
                    $data->HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $data->HOD_Review_Comments = $request->comment;

                    // $history = new dataAuditTrail();
                    // $history->extension_id = $id;
                    // $history->activity_type = 'Review By, Review On';
                    // if (is_null($lastDocument->submit_by_review) || $lastDocument->submit_by_review === '') {
                    //     $history->previous = "Null";
                    // } else {
                    //     $history->previous = $lastDocument->submit_by_review . ' , ' . $lastDocument->submit_on_review;
                    // }
                    // $history->current = $data->submit_by_review . ' , ' . $data->submit_on_review;
                    // $history->comment = $request->comment;
                    // $history->action = 'Review';
                    // $history->user_id = Auth::user()->id;
                    // $history->user_name = Auth::user()->name;
                    // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    // $history->origin_state = $lastDocument->status;
                    // $history->change_to =   "In Approved";
                    // $history->change_from = $lastDocument->status;
                    // $history->stage = 'In Approved';
                    // if (is_null($lastDocument->submit_by_review) || $lastDocument->submit_by_review === '') {
                    //     $history->action_name = 'New';
                    // } else {
                    //     $history->action_name = 'Update';
                    // }
                    // $history->save();

                    // $usersmail = collect()
                    // ->merge(Helpers::getQAApproverUserList($data->division_id))
                    // ->merge(Helpers::getCQAApproverUsersList($data->division_id))
                    // ->unique('user_id')
                    // ->values();
                    // foreach ($usersmail as $u) {
                    //    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                    //        $email = Helpers::getUserEmail($u->user_id);
                    //            if (!empty($email)) {
                    //                 try{

                    //             $data = [
                    //                 'data'    => $data,
                    //                 'site'    => "Extension",
                    //                 'history' => "Review",
                    //                 'process' => 'Extension',
                    //                 'comment' => $request->comment,
                    //                 'user'    => Auth::user()->name
                    //             ];

                    //             SendMail::dispatch(
                    //                 $data,
                    //                 $email,
                    //                 $data,
                    //                 'Extension'
                    //             );

                    //         } catch (\Exception $e) {
                    //             \Log::error('Mail Error: ' . $e->getMessage());
                    //         }
                    //        }
                    //    // }
                    // }


                    $data->update();
                    return back();
                }


            } else {
                toastr()->error('E-signature Not match');
                return back();
            }

    }


    public function moreinfoStateChange(Request $request, $id)
    {
        try {
            if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
                $data = ChangeProposalJust::find($id);
                $lastDocument = ChangeProposalJust::find($id);

                if ($data->stage == 2) {

                    $data->stage = "1";
                    $data->status = "Opened";
                    // $data->more_info_review_by = Auth::user()->name;
                    // $data->more_info_review_on = Carbon::now()->format('d-M-Y');
                    // $data->more_info_review_comment = $request->comment;

                    // $history = new dataAuditTrail();
                    // $history->extension_id = $id;
                    // $history->activity_type = 'Not Applicable';
                    // // if (is_null($lastDocument->more_info_review_by) || $lastDocument->more_info_review_by === '') {
                    // //     $history->previous = "Null";
                    // // } else {
                    // //     $history->previous = $lastDocument->more_info_review_by . ' , ' . $lastDocument->more_info_review_on;
                    // // }
                    // // $history->current = $data->more_info_review_by . ' , ' . $data->more_info_review_on;
                    // $history->previous = 'Not Applicable';
                    // $history->current = 'Not Applicable';
                    // $history->action = 'More Info Required';
                    // $history->comment = $request->comment;
                    // $history->user_id = Auth::user()->id;
                    // $history->user_name = Auth::user()->name;
                    // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    // $history->origin_state = $lastDocument->status;
                    // $history->change_to =   "Opened";
                    // $history->change_from = $lastDocument->status;
                    // $history->stage = 'Opened';
                    // // if (is_null($lastDocument->more_info_review_by) || $lastDocument->more_info_review_by === '') {
                    // //     $history->action_name = 'New';
                    // // } else {
                    // //     $history->action_name = 'Update';
                    // // }
                    // $history->action_name = 'Not Applicable';
                    // $history->save();
                    // $list = Helpers::getInitiatorUserList($data->division_id)->unique('user_id')
                    // ->values();
                    // foreach ($list as $u) {
                    //    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                    //        $email = Helpers::getUserEmail($u->user_id);
                    //            if (!empty($email)) {
                    //               try{

                    //                     $data = [
                    //                         'data'    => $data,
                    //                         'site'    => "Extension",
                    //                         'history' => "More Info Required",
                    //                         'process' => 'Extension',
                    //                         'comment' => $request->comment,
                    //                         'user'    => Auth::user()->name
                    //                     ];

                    //                     SendMail::dispatch(
                    //                         $data,
                    //                         $email,
                    //                         $data,
                    //                         'Extension'
                    //                     );

                    //                 } catch (\Exception $e) {
                    //                     \Log::error('Mail Error: ' . $e->getMessage());
                    //                 }
                    //        }
                    //    // }
                    // }
                    $data->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($data->stage == 3) {


                    $data->stage = "2";
                    $data->status = "In Review";
                    // $data->more_info_inapproved_by = Auth::user()->name;
                    // $data->more_info_inapproved_on = Carbon::now()->format('d-M-Y');
                    // $data->more_info_inapproved_comment = $request->comment;

                    // $history = new dataAuditTrail();
                    // $history->extension_id = $id;
                    // $history->activity_type = 'Not Applicable';
                    // // $history->activity_type = 'More Info Required By, More Info Required On';
                    // // if (is_null($lastDocument->more_info_inapproved_by) || $lastDocument->more_info_inapproved_by === '') {
                    // //     $history->previous = "Null";
                    // // } else {
                    // //     $history->previous = $lastDocument->more_info_inapproved_by . ' , ' . $lastDocument->more_info_inapproved_on;
                    // // }
                    // // $history->current = $data->more_info_inapproved_by . ' , ' . $data->more_info_inapproved_on;
                    // $history->previous = 'Not Applicable';
                    // $history->current = 'Not Applicable';
                    // $history->action = 'More Info Required';
                    // $history->comment = $request->comment;
                    // $history->user_id = Auth::user()->id;
                    // $history->user_name = Auth::user()->name;
                    // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    // $history->origin_state = $lastDocument->status;
                    // $history->change_to =   "In Review";
                    // $history->change_from = $lastDocument->status;
                    // $history->stage = 'In Review';
                    // // if (is_null($lastDocument->more_info_inapproved_by) || $lastDocument->more_info_inapproved_by === '') {
                    // // $history->action_name = 'New';
                    // // } else {
                    // //     $history->action_name = 'Update';
                    // // }
                    // $history->action_name = 'Not Applicable';
                    // $history->save();

                    // $list = Helpers::getHodUserList($data->division_id)->unique('user_id')
                    // ->values();
                    // foreach ($list as $u) {
                    //    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                    //        $email = Helpers::getUserEmail($u->user_id);
                    //            if ($email !== null) {
                    //                try{

                    //                     $data = [
                    //                         'data'    => $data,
                    //                         'site'    => "Extension",
                    //                         'history' => "More Info Required",
                    //                         'process' => 'Extension',
                    //                         'comment' => $request->comment,
                    //                         'user'    => Auth::user()->name
                    //                     ];

                    //                     SendMail::dispatch(
                    //                         $data,
                    //                         $email,
                    //                         $data,
                    //                         'Extension'
                    //                     );

                    //                 } catch (\Exception $e) {
                    //                     \Log::error('Mail Error: ' . $e->getMessage());
                    //                 }
                    //        }
                    //    // }
                    // }
                    $data->update();
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
}
