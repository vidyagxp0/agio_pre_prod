<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CC;
use App\Models\User;
use App\Services\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CCController extends Controller
{
    public function index(){

        $document = CC::where('initiator_id',Auth::user()->id)->get();
        foreach($document as $data){
            $data->originator = User::where('id',$data->initiator_id)->value('name');
        }
        return view('frontend.change-control.CC',compact('document'));
    }

    public function create(){
        //        return view('frontend.change-control.new-change-control',compact('document'));

    }

    public function store(Request $request)
    {

        $openState = new CC();
        $openState->initiator_id = Auth::user()->id;
        $openState->record = DB::table('record_numbers')->value('counter') + 1;
        $openState->Inititator_Group = $request->initiatorGroup;
        $openState->short_description = $request->short_description;
        $openState->assign_to = $request->assign_to;      
        $openState->due_date = $request->due_date;
        $openState->doc_change = $request->naturechange;
        $openState->If_Others = $request->others;
        $openState->Division_Code = $request->div_code;
        // $openState->current_practice = $request->current_practice;
        // $openState->proposed_change = $request->proposed_change;
        // $openState->reason_change = $request->reason_change;
        // $openState->other_comment = $request->other_comment;
        // $openState->supervisor_comment = $request->supervisor_comment;
        if($request->training_required){
            $openState->training_required = $request->training_required;
        }
        $openState->status = "Opened";
        $openState->stage = 1;
        $openState->save();

         // Retrieve the current counter value
         $counter = DB::table('record_numbers')->value('counter');
         // Generate the record number with leading zeros
         $recordNumber = str_pad($counter, 5, '0', STR_PAD_LEFT);
         // Increment the counter value
         $newCounter = $counter + 1;
         DB::table('record_numbers')->update(['counter' => $newCounter]);
        toastr()->success('Document created');

        DocumentService::update_qms_numbers();

        return redirect()->route('CC.index');
    }

    public function show($id)
    {

        $data = CC::find($id);

            $data->assign_to_name = User::where('id', $data->assign_to)->value('name');
            return view('frontend.change-control.CCview',compact('data'));


    }

    public function update(Request $request,$id)
    {

        $openState = CC::find($id);
        $openState->initiator_id = Auth::user()->id;
        $openState->Inititator_Group = $request->initiatorGroup;
        $openState->short_description = $request->short_description;
        $openState->assign_to = $request->assign_to;        
        $openState->due_date = $request->due_date;
        $openState->doc_change = $request->naturechange;
        $openState->If_Others = $request->others;
        $openState->Division_Code = $request->div_code;
        // $openState->current_practice = $request->current_practice;
        // $openState->proposed_change = $request->proposed_change;
        // $openState->reason_change = $request->reason_change;
        // $openState->other_comment = $request->other_comment;
        // $openState->supervisor_comment = $request->supervisor_comment;
        if($request->training_required){
            $openState->training_required = $request->training_required;
        }

        $openState->save();
        toastr()->success('Document created');

        DocumentService::update_qms_numbers();

        return redirect()->route('CC.index');
    }

    public function destroy($id){

    }

    public function stageChange(Request $request,$id){
        if($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password))
        {
            $changeControl = CC::find($id);
            if($changeControl->stage == 1){
                $changeControl->stage = "2";
                $changeControl->status = "Under Superviser Review";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if($changeControl->stage == 2){
                $changeControl->stage = "3";
                $changeControl->status = "Superviser Review Completed";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if($changeControl->stage == 3){
                $changeControl->stage = "4";
                $changeControl->status = "QA reviewed";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if($changeControl->stage == 4){
                $changeControl->stage = "5";
                $changeControl->status = "CFT Reviewed";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }

            if($changeControl->training_required =="yes"){
                if($changeControl->stage == 5){
                    $changeControl->stage = "6";
                    $changeControl->status = "Training Complete";
                    $changeControl->update();
                    toastr()->success('Document Sent');
                    return back();
                }

            }
            else{
                if($changeControl->stage == 5){
                    $changeControl->stage = "7";
                    $changeControl->status = "Change Implemented";
                    $changeControl->update();
                    toastr()->success('Document Sent');
                    return back();
                }
            }

            if($changeControl->stage == 6){
                $changeControl->stage = "7";
                $changeControl->status = "Change Implemented";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }


            if($changeControl->stage == 7){
                $changeControl->stage = "8";
                $changeControl->status = "QA Final Completed";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if($changeControl->stage == 8){
                $changeControl->stage = "9";
                $changeControl->status = "Closed – Done";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }


        }
        else{
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function stagereject(Request $request,$id){
        if($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password))
        {
            $changeControl = CC::find($id);
            if($changeControl->stage == 2){
                $changeControl->stage = "1";
                $changeControl->status = "Opened";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if($changeControl->stage == 3){
                $changeControl->stage = "2";
                $changeControl->status = "Submit";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if($changeControl->stage == 4){
                $changeControl->stage = "3";
                $changeControl->status = "Supervisor review";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if($changeControl->stage == 5){
                $changeControl->stage = "4";
                $changeControl->status = "QA Review";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if($changeControl->stage == 6){
                $changeControl->stage = "5";
                $changeControl->status = "CFT Review";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if($changeControl->stage == 7){
                $changeControl->stage = "6";
                $changeControl->status = "Training";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if($changeControl->stage == 8){
                $changeControl->stage = "7";
                $changeControl->status = "Change implemented";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if($changeControl->stage == 9){
                $changeControl->stage = "8";
                $changeControl->status = "QA Final Review";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            toastr()->error('States not Defined');
            return back();
        }
        else{
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    // public function child(Request $request,$id){
    //     $cc = CC::find($id);
    //     $parent_record = CC::where('id', $id)->value('record');
    //     $parent_division_id = CC::where('id', $id)->value('division_id');
    //     $parent_initiator_id = CC::where('id', $id)->value('initiator_id');
    //     $parent_intiation_date = CC::where('id', $id)->value('intiation_date');
    //     $parent_short_description = CC::where('id', $id)->value('short_description');


    //     if($request->revision == "Action-Item"){
    //         $cc->originator = User::where('id',$cc->initiator_id)->value('name');
    //         return view('frontend.forms.action-item',compact('parent_short_description','parent_initiator_id','parent_intiation_date','parent_division_id', 'parent_record','cc'));
    //     }
    //     if($request->revision == "Extension"){
    //         $cc->originator = User::where('id',$cc->initiator_id)->value('name');
    //         return view('frontend.forms.extension',compact('parent_short_description','parent_initiator_id','parent_intiation_date','parent_division_id', 'parent_record','cc'));
    //     }
    //     if($request->revision == "New Document"){
    //         $cc->originator = User::where('id',$cc->initiator_id)->value('name');
    //         return redirect()->route('documents.create');
    //     }
    //     else{
    //         toastr()->warning('Not Working');
    //         return back();
    //     }
    // }

}
