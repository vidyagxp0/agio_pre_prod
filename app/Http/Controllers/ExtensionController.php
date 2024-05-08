<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CC;
use App\Models\Extension;
use App\Models\User;
use App\Services\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ExtensionController extends Controller
{
    public function index(){
        $document = Extension::all();

        foreach($document as $data){
            $cc = CC::find($data->cc_id);
            $data->originator = User::where('id',$cc->initiator_id)->value('name');
        }
        return view('frontend.extension.extension',compact('document'));
    }

    public function create(){
        //
    }

    public function store(Request $request){

        $openState = new Extension();
        $openState->cc_id = $request->cc_id;
        $openState->record = DB::table('record_numbers')->value('counter') + 1;
        $openState->short_description = $request->short_description;
        $openState->justification = $request->justification;
        $openState->type = $request->type;
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

        return redirect()->route('extension.index');
    }

    public function show($id){

        $data = Extension::find($id);
        $cc = CC::find($data->cc_id);

        return view('frontend.extension.View',compact('data','cc'));


    }

    public function edit($id){

    }

    public function update(Request $request, $id){
        $openState = Extension::find($id);
        $openState->short_description = $request->short_description;
        $openState->justification = $request->justification;
        $openState->type = $request->type;

        $openState->save();
        toastr()->success('Document update');

        DocumentService::update_qms_numbers();

        return back();
    }

    public function destroy($id){

    }

    public function stageChange(Request $request,$id){
        if($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password))
        {
            $changeControl = Extension::find($id);
            if($changeControl->stage == 1){
                $changeControl->stage = "2";
                $changeControl->status = "Submitted";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if($changeControl->stage == 2){
                $changeControl->stage = "3";
                $changeControl->status = "Work in progress";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if($changeControl->stage == 3){
                $changeControl->stage = "4";
                $changeControl->status = "Complete";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if($changeControl->stage == 4){
                $changeControl->stage = "5";
                $changeControl->status = "Closed-Done";
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
}
