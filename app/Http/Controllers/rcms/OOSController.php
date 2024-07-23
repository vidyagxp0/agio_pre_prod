<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OOS;
use App\Models\User;
use App\Models\RoleGroup;
use App\Models\Oosgrids;
use App\Models\OosAuditTrial;
use App\Services\Qms\OOSService;
use App\Models\RecordNumber;
use App\Models\Division;
use App\Models\QMSDivision;
use App\Models\Extension;
use App\Models\OOSLaunchExtension;

use Carbon\Carbon;
use Error;
use Helpers;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;

class OOSController extends Controller
{
    public function index()
    {
        $old_record = OOS::select('id', 'division_id', 'record_number')->get();
        
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        return view("frontend.OOS.oos_form", compact('formattedDate', 'due_date', 'old_record', 'record_number'));

    }
    
    public function store(Request $request)
    { 
        // dd($request->all());
        $res = Helpers::getDefaultResponse();
        try {
            
            $oos_record = OOSService::create_oss($request);

            if ($oos_record['status'] == 'error')
            {
                throw new Error($oos_record['message']);
            } 

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
            info('Error in OOSController@store', [
                'message' => $e->getMessage()
            ]);
        }

        return redirect()->route('qms.dashboard');
    }

    public static function show($id)
    {
        $old_record = OOS::select('id', 'division_id', 'record_number')->get();
        $data = OOS::find($id);
        $data->record_number = str_pad($data->record_number, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');

        $info_product_materials = $data->grids()->where('identifier', 'info_product_material')->first();
        $details_stabilities = $data->grids()->where('identifier', 'details_stability')->first();
        $oos_details = $data->grids()->where('identifier', 'oos_detail')->first();
        $instrument_details = $data->grids()->where('identifier', 'instrument_detail')->first();
        $products_details = $data->grids()->where('identifier', 'products_details')->first();
        $checklist_lab_invs = $data->grids()->where('identifier', 'checklist_lab_inv')->first();
        $oos_capas = $data->grids()->where('identifier', 'oos_capa')->first();
        $phase_two_invs = $data->grids()->where('identifier', 'phase_two_inv')->first();
        $oos_conclusions = $data->grids()->where('identifier', 'oos_conclusion')->first();
        $oos_conclusion_reviews = $data->grids()->where('identifier', 'oos_conclusion_review')->first();
        // $revised_date = "";
        // $revised_date = Extension::where('parent_id', $id)->where('parent_type', "OOS Chemical")->value('revised_date');
        $capaExtension = OOSLaunchExtension::where(['oos_id' => $id, "extension_identifier" => "Capa"])->first();
        $qrmExtension = OOSLaunchExtension::where(['oos_id' => $id, "extension_identifier" => "QRM"])->first();
        $investigationExtension = OOSLaunchExtension::where(['oos_id' => $id, "extension_identifier" => "Investigation"])->first();
        $oosExtension = OOSLaunchExtension::where(['oos_id' => $id, "extension_identifier" => "OOS Chemical"])->first();

        return view('frontend.OOS.oos_form_view', 
        compact('data', 'old_record', 'info_product_materials',
         'details_stabilities', 'oos_details','instrument_details','products_details', 'checklist_lab_invs', 
         'oos_capas', 'phase_two_invs', 'oos_conclusions', 'oos_conclusion_reviews','capaExtension',
          'qrmExtension', 'investigationExtension', 'oosExtension'));

    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // if (!$request->short_description) {
        //     toastr()->error("Short description is required");
        //     return redirect()->back();
        // }
        $res = Helpers::getDefaultResponse();

        try {
            
            $oos_record = OOSService::update_oss($request,$id);

            if ($oos_record['status'] == 'error')
            {
                throw new Error($oos_record['message']);
            } 

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
            info('Error in OOSController@store', [
                'message' => $e->getMessage()
            ]);
        }
        toastr()->success('Record is Update Successfully');
        return back();
        // return redirect()->route('qms.dashboard');
        
        
    }

    public function launchExtensionOOS(Request $request, $id){
        $oos = OOS::find($id);
        $getCounter = OOSLaunchExtension::where(['oos_id' => $oos->id,
         'extension_identifier' => "OOS Chemical"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($oos->id != null){
            $data = OOSLaunchExtension::where([
                'oos_id' => $oos->id,
                'extension_identifier' => "OOS Chemical"
            ])->firstOrCreate();

            $data->oos_id = $request->oos_id;
            $data->extension_identifier = $request->extension_identifier;
            $data->counter = $counter;
            $data->oos_proposed_due_date = $request->oos_proposed_due_date;
            $data->oos_extension_justification = $request->oos_extension_justification;
            $data->oos_extension_completed_by = $request->oos_extension_completed_by;
            $data->oos_extension_completed_on = $request->oos_extension_completed_on;
            $data->save();

            toastr()->success('Record is Update Successfully');
            return back();
        }
    }

    public function launchExtensionCapa(Request $request, $id){
        $oos = OOS::find($id);
        $getCounter = OOSLaunchExtension::where(['oos_id' => $oos->id, 'extension_identifier' => "Capa"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($oos->id != null){

            $data = OOSLaunchExtension::where([
                'oos_id' => $oos->id,
                'extension_identifier' => "Capa"
            ])->firstOrCreate();

            $data->oos_id = $request->oos_id;
            $data->extension_identifier = $request->extension_identifier;
            $data->counter = $counter;
            $data->capa_proposed_due_date = $request->capa_proposed_due_date;
            $data->capa_extension_justification = $request->capa_extension_justification;
            $data->capa_extension_completed_by = $request->capa_extension_completed_by;
            $data->capa_extension_completed_on = $request->capa_extension_completed_on;
            $data->save();

            toastr()->success('Record is Update Successfully');
            return back();
        }
    }


    public function launchExtensionQrm(Request $request, $id){
        $oos = Deviation::find($id);
        $getCounter = OOSLaunchExtension::where(['oos_id' => $oos->id, 'extension_identifier' => "QRM"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($oos->id != null){

            $data = OOSLaunchExtension::where([
                'oos_id' => $oos->id,
                'extension_identifier' => "QRM"
            ])->firstOrCreate();

            $data->oos_id = $request->oos_id;
            $data->extension_identifier = $request->extension_identifier;
            $data->counter = $counter;
            $data->qrm_proposed_due_date = $request->qrm_proposed_due_date;
            $data->qrm_extension_justification = $request->qrm_extension_justification;
            $data->qrm_extension_completed_by = $request->qrm_extension_completed_by;
            $data->qrm_extension_completed_on = $request->qrm_extension_completed_on;
            $data->save();

            toastr()->success('Record is Update Successfully');
            return back();
        }
    }

    public function launchExtensionInvestigation(Request $request, $id){
        $oos = Deviation::find($id);
        $getCounter = OOSLaunchExtension::where(['oos_id' => $oos->id, 'extension_identifier' => "Investigation"])->first();
        if($getCounter && $getCounter->counter == null){
            $counter = 1;
        } else {
            $counter = $getCounter ? $getCounter->counter + 1 : 1;
        }
        if($oos->id != null){

            $data = OOSLaunchExtension::where([
                'oos_id' => $oos->id,
                'extension_identifier' => "Investigation"
            ])->firstOrCreate();

            $data->oos_id = $request->oos_id;
            $data->extension_identifier = $request->extension_identifier;
            $data->counter = $counter;
            $data->investigation_proposed_due_date = $request->investigation_proposed_due_date;
            $data->investigation_extension_justification = $request->investigation_extension_justification;
            $data->investigation_extension_completed_by = $request->investigation_extension_completed_by;
            $data->investigation_extension_completed_on = $request->investigation_extension_completed_on;
            $data->save();

            toastr()->success('Record is Update Successfully');
            return back();
        }
    }
    public function send_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changestage = OOS::find($id);
            $lastDocument = OOS::find($id);
            if ($changestage->stage == 1) {
                $changestage->stage = "2";
                $changestage->status = "Pending Initial Assessment & Lab Incident";
                $changestage->completed_by_submit = Auth::user()->name;
                $changestage->completed_on_submit = Carbon::now()->format('d-M-Y');
                $changestage->comment_submit = $request->comment;
                        $history = new OosAuditTrial();
                        $history->oos_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->action = 'Submit';
                        $history->change_from = $lastDocument->status;
                        $history->change_to =   "Pending Initial Assessment & Lab Incident";
                        $history->action_name = 'Update';
                        $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 2) {
                $changestage->stage = "3";
                $changestage->status = "Under Phase I investigation";
                $changestage->completed_by_initial_phaseI_investigation = Auth::user()->name;
                $changestage->completed_on_initial_phaseI_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_initial_phaseI_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Initial Phase I Investigation';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase I Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 3) {
                $changestage->stage = "5";
                $changestage->status = "Under Phase I b Investigation";
                $changestage->completed_by_assignable_cause_not_found = Auth::user()->name;
                $changestage->completed_on_assignable_cause_not_found = Carbon::now()->format('d-M-Y');
                $changestage->comment_assignable_cause_not_found = $request->comment;
                            $history = new OosAuditTrial();
                            $history->oos_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->action = 'Assignable Cause Not Found';
                            $history->change_from = $lastDocument->status;
                            $history->change_to =   "Under Phase I b Investigation";
                            $history->action_name = 'Update';
                            $history->save();
                        
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 5) {
                $changestage->stage = "6";
                $changestage->status = "Under Hypothesis Experiment";
                $changestage->completed_by_proposed_hypothesis_experiment = Auth::user()->name;
                $changestage->completed_on_proposed_hypothesis_experiment = Carbon::now()->format('d-M-Y');
                $changestage->comment_proposed_hypothesis_experiment = $request->comment;
                        $history = new OosAuditTrial();
                        $history->oos_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->action = 'Proposed Hypothesis Experiment';
                        $history->change_from = $lastDocument->status;
                        $history->change_to =   "Under Hypothesis Experiment";
                        $history->action_name = 'Update';
                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 6) {
                $changestage->stage = "8";
                $changestage->status = "Under Phase II Investigation";
                $changestage->completed_by_no_assignable_cause_found = Auth::user()->name;
                $changestage->completed_on_no_assignable_cause_found = Carbon::now()->format('d-M-Y');
                $changestage->comment_no_assignable_cause_found = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'No Assignable Cause Found';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase II Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 8) {
                $changestage->stage = "9";
                $changestage->status = "under Manufacturing Investigation phase II a";
                $changestage->completed_by_manufacturing_investigation = Auth::user()->name;
                $changestage->completed_on_manufacturing_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_manufacturing_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Menufacturing Investigation';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "under Manufacturing Investigation phase II a";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 9) {
                $changestage->stage = "11";
                $changestage->status = "Under phase II b Additional Lab Investigation";
                $changestage->completed_by_no_assignable_manufacturing_defect= Auth::user()->name;
                $changestage->completed_on_no_assignable_manufacturing_defect = Carbon::now()->format('d-M-Y');
                $changestage->comment_no_assignable_manufacturing_defect = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'No Assignable Cause Found (No Menufacturing Defect)';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase II b Additional Lab Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 10) {
                $changestage->stage = "13";
                $changestage->status = "Under phase III Investigation";
                $changestage->completed_by_phaseIIA_correction_inconclusive= Auth::user()->name;
                $changestage->completed_on_phaseIIA_correction_inconclusive = Carbon::now()->format('d-M-Y');
                $changestage->comment_phaseIIA_correction_inconclusive = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase II A Correction Inconclusive';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under phase III Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 11) {
                $changestage->stage = "13";
                $changestage->status = "Under phase III Investigation";
                $changestage->completed_by_phaseIIB_correction_inconclusive= Auth::user()->name;
                $changestage->completed_on_phaseIIB_correction_inconclusive = Carbon::now()->format('d-M-Y');
                $changestage->comment_phaseIIB_correction_inconclusive = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase II B Correction Inconclusive';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under phase III Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 13) {
                $changestage->stage = "14";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_phaseIII_manufacturing_investigation= Auth::user()->name;
                $changestage->completed_on_phaseIII_manufacturing_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_phaseIII_manufacturing_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase III Manufacturing Investigation';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Pending Final Approval Completed";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
           
            if ($changestage->stage == 14) {
                $changestage->stage = "15";
                $changestage->status = "Close-Done";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Approval Completed';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Close-Done";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
   
    public function assignable_send_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changestage = OOS::find($id);
            $lastDocument = OOS::find($id);
            if ($changestage->stage == 3) {
                $changestage->stage = "4";
                $changestage->status = "Under Phase I Correction";
                $changestage->completed_by_assignable_cause_found= Auth::user()->name;
                $changestage->completed_on_assignable_cause_found = Carbon::now()->format('d-M-Y');
                $changestage->comment_assignable_cause_found = $request->comment;
                            $history = new OosAuditTrial();
                            $history->oos_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->action = 'Assignable Cause Found';
                            $history->change_from = $lastDocument->status;
                            $history->change_to =   "Under Phase I Correction";
                            $history->action_name = 'Update';
                            $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 4) {
                $changestage->stage = "14";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_correction_completed= Auth::user()->name;
                $changestage->completed_on_correction_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_correction_completed = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Pending Final Approval Completed";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 6) {
                $changestage->stage = "7";
                $changestage->status = "Under Repeat Analysis";
                $changestage->completed_by_obvious_error_found= Auth::user()->name;
                $changestage->completed_on_obvious_error_found = Carbon::now()->format('d-M-Y');
                $changestage->comment_obvious_error_found = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Obvious Error Found';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Repeat Analysis";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 7) {
                $changestage->stage = "14";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_repeat_analysis_completed= Auth::user()->name;
                $changestage->completed_on_repeat_analysis_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_repeat_analysis_completed = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Repeat Analysis Completed';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Pending Final Approval Completed";
                    $history->action_name = 'Update';
                   $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 9) {
                $changestage->stage = "10";
                $changestage->status = "Under PhaseII A Correction";
                $changestage->completed_by_assignable_manufacturing_defect= Auth::user()->name;
                $changestage->completed_on_assignable_manufacturing_defect = Carbon::now()->format('d-M-Y');
                $changestage->comment_assignable_manufacturing_defect = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Assignable Cause Found (Menufacturing Defect)';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under PhaseIIA Correction";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 10) {
                $changestage->stage = "12";
                $changestage->status = "Under Batch Disposition";
                $changestage->completed_by_no_assignable_manufacturing_defect = Auth::user()->name;
                $changestage->completed_on_no_assignable_manufacturing_defect = Carbon::now()->format('d-M-Y');
                $changestage->comment_no_assignable_manufacturing_defect = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Assignable Cause Not Found ( Manufacturing Defect)';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase I b Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 11) {
                $changestage->stage = "12";
                $changestage->status = "Under Batch Disposition";
                $changestage->completed_by_retesting_resampling= Auth::user()->name;
                $changestage->completed_on_retesting_resampling = Carbon::now()->format('d-M-Y');
                $changestage->comment_retesting_resampling = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Retesting/Resampling';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Batch Disposition";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 12) {
                $changestage->stage = "14";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_batch_disposition= Auth::user()->name;
                $changestage->completed_on_batch_disposition = Carbon::now()->format('d-M-Y');
                $changestage->comment_batch_disposition = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Batch Disposition';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Pending Final Approval Completed";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

     // ========== requestmoreinfo_back_stage ==============
    public function requestmoreinfo_back_stage(Request $request, $id)
     {
        
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
             $changestage = OOS::find($id);
             $lastDocument = OOS::find($id);
             if ($changestage->stage == 2) {
                 $changestage->stage = "1";
                 $changestage->status = "Opened";
                 $changestage->completed_by_submit = Auth::user()->name;
                 $changestage->completed_on_submit = Carbon::now()->format('d-M-Y');
                 $changestage->comment_submit = $request->comment;
                     $history = new OosAuditTrial();
                     $history->oos_id = $id;
                     $history->activity_type = 'Activity Log';
                     $history->comment = $request->comment;
                     $history->user_id = Auth::user()->id;
                     $history->user_name = Auth::user()->name;
                     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                     $history->origin_state = $lastDocument->status;
                     $history->action = 'Request More Info';
                     $history->change_from = $lastDocument->status;
                     $history->change_to =   "Opened";
                     $history->action_name = 'Update';
                     $history->save();
                 $changestage->update();
                 toastr()->success('Document Sent');
                 return back();
             }
             if ($changestage->stage == 3) {
                 $changestage->stage = "2";
                 $changestage->status = "Pending Initial Assessment & Lab Incident";
                 $changestage->completed_by_initial_phaseI_investigation = Auth::user()->name;
                 $changestage->completed_on_initial_phaseI_investigation = Carbon::now()->format('d-M-Y');
                 $changestage->comment_initial_phaseI_investigation = $request->comment;
                     $history = new OosAuditTrial();
                     $history->oos_id = $id;
                     $history->activity_type = 'Activity Log';
                     $history->comment = $request->comment;
                     $history->user_id = Auth::user()->id;
                     $history->user_name = Auth::user()->name;
                     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                     $history->origin_state = $lastDocument->status;
                     $history->action = 'Request More Info';
                     $history->change_from = $lastDocument->status;
                     $history->change_to =   "Pending Initial Assessment & Lab Incident";
                     $history->action_name = 'Update';
                     $history->save();
                 $changestage->update();
                 toastr()->success('Document Sent');
                 return back();
             }
             if ($changestage->stage == 4) {
                 $changestage->stage = "3";
                 $changestage->status = "Under Phase I Investigation";
                 $changestage->completed_by_assignable_cause_found = Auth::user()->name;
                 $changestage->completed_on_assignable_cause_found = Carbon::now()->format('d-M-Y');
                 $changestage->comment_assignable_cause_found = $request->comment;
                     $history = new OosAuditTrial();
                     $history->oos_id = $id;
                     $history->activity_type = 'Activity Log';
                     $history->comment = $request->comment;
                     $history->user_id = Auth::user()->id;
                     $history->user_name = Auth::user()->name;
                     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                     $history->origin_state = $lastDocument->status;
                     $history->action = 'Request More Info';
                     $history->change_from = $lastDocument->status;
                     $history->change_to =   "Under Phase I Investigation";
                     $history->action_name = 'Update';
                     $history->save();
                 $changestage->update();
                 toastr()->success('Document Sent');
                 return back();
             }
             if ($changestage->stage == 5) {
                 $changestage->stage = "3";
                 $changestage->status = "Under Phase I Investigation";
                 $changestage->completed_by_assignable_cause_not_found = Auth::user()->name;
                 $changestage->completed_on_assignable_cause_not_found = Carbon::now()->format('d-M-Y');
                 $changestage->comment_assignable_cause_not_found = $request->comment;
                     $history = new OosAuditTrial();
                     $history->oos_id = $id;
                     $history->activity_type = 'Activity Log';
                     $history->comment = $request->comment;
                     $history->user_id = Auth::user()->id;
                     $history->user_name = Auth::user()->name;
                     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                     $history->origin_state = $lastDocument->status;
                     $history->action = 'Request More Info';
                     $history->change_from = $lastDocument->status;
                     $history->change_to =   "Under Phase I Investigation";
                     $history->action_name = 'Update';
                     $history->save();
                 $changestage->update();
                 toastr()->success('Document Sent');
                 return back();
             }
             if ($changestage->stage == 7) {
                 $changestage->stage = "6";
                 $changestage->status = "Under Hypothesis Experient";
                 $changestage->completed_by_obvious_error_found = Auth::user()->name;
                 $changestage->completed_on_obvious_error_found = Carbon::now()->format('d-M-Y');
                 $changestage->comment_obvious_error_found = $request->comment;
                     $history = new OosAuditTrial();
                     $history->oos_id = $id;
                     $history->activity_type = 'Activity Log';
                     $history->comment = $request->comment;
                     $history->user_id = Auth::user()->id;
                     $history->user_name = Auth::user()->name;
                     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                     $history->origin_state = $lastDocument->status;
                     $history->action = 'Request More Info';
                     $history->change_from = $lastDocument->status;
                     $history->change_to =   "Under Hypothesis Experient";
                     $history->action_name = 'Update';
                     $history->save();
                 $changestage->update();
                 toastr()->success('Document Sent');
                 return back();
             }
 
             if ($changestage->stage == 8) {
                 $changestage->stage = "6";
                 $changestage->status = "Under Hypothesis Experient";
                 $changestage->completed_by_no_assignable_cause_found = Auth::user()->name;
                 $changestage->completed_on_no_assignable_cause_found = Carbon::now()->format('d-M-Y');
                 $changestage->comment_no_assignable_cause_found = $request->comment;
                     $history = new OosAuditTrial();
                     $history->oos_id = $id;
                     $history->activity_type = 'Activity Log';
                     $history->comment = $request->comment;
                     $history->user_id = Auth::user()->id;
                     $history->user_name = Auth::user()->name;
                     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                     $history->origin_state = $lastDocument->status;
                     $history->action = 'Request More Info';
                     $history->change_from = $lastDocument->status;
                     $history->change_to =   "Under Hypothesis Experient";
                     $history->action_name = 'Update';
                     $history->save();
                 $changestage->update();
                 toastr()->success('Document Sent');
                 return back();
             }
             if ($changestage->stage == 9) {
                 $changestage->stage = "8";
                 $changestage->status = "under phase II Investigation";
                 $changestage->completed_by_manufacturing_investigation = Auth::user()->name;
                 $changestage->completed_on_manufacturing_investigation = Carbon::now()->format('d-M-Y');
                 $changestage->comment_manufacturing_investigation = $request->comment;
                 
                 $history = new OosAuditTrial();
                 $history->oos_id = $id;
                 $history->activity_type = 'Activity Log';
                 $history->comment = $request->comment;
                 $history->user_id = Auth::user()->id;
                 $history->user_name = Auth::user()->name;
                 $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                 $history->origin_state = $lastDocument->status;
                 $history->action = 'Request More Info';
                 $history->change_from = $lastDocument->status;
                 $history->change_to =   "under phase II Investigation";
                 $history->action_name = 'Update';
                 $history->save();
                 $changestage->update();
                 toastr()->success('Document Sent');
                 return back();
             }
             if ($changestage->stage == 10) {
                 $changestage->stage = "9";
                 $changestage->status = "Under Manufacturing Investigation Phase II a";
                 $changestage->completed_by_assignable_manufacturing_defect = Auth::user()->name;
                 $changestage->completed_on_assignable_manufacturing_defect = Carbon::now()->format('d-M-Y');
                 $changestage->comment_assignable_manufacturing_defect = $request->comment;
                     $history = new OosAuditTrial();
                     $history->oos_id = $id;
                     $history->activity_type = 'Activity Log';
                     $history->comment = $request->comment;
                     $history->user_id = Auth::user()->id;
                     $history->user_name = Auth::user()->name;
                     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                     $history->origin_state = $lastDocument->status;
                     $history->action = 'Request More Info';
                     $history->change_from = $lastDocument->status;
                     $history->change_to =   "Under Manufacturing Investigation Phase II a";
                     $history->action_name = 'Update';
                     $history->save();
                     $changestage->update();
                 toastr()->success('Document Sent');
                 return back();
             }
             if ($changestage->stage == 11) {
                 $changestage->stage = "9";
                 $changestage->status = "Under Phase II A correction";
                 $changestage->completed_by_assignable_manufacturing_defect = Auth::user()->name;
                 $changestage->completed_on_assignable_manufacturing_defect = Carbon::now()->format('d-M-Y');
                 $changestage->comment_assignable_manufacturing_defect = $request->comment;
                     $history = new OosAuditTrial();
                     $history->oos_id = $id;
                     $history->activity_type = 'Activity Log';
                     $history->comment = $request->comment;
                     $history->user_id = Auth::user()->id;
                     $history->user_name = Auth::user()->name;
                     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                     $history->origin_state = $lastDocument->status;
                     $history->action = 'Request More Info';
                     $history->change_from = $lastDocument->status;
                     $history->change_to =   "Under Phase II a correction";
                     $history->action_name = 'Update';
                     $history->save();
                 $changestage->update();
                 toastr()->success('Document Sent');
                 return back();
             }
             if ($changestage->stage == 13) {
                 $changestage->stage = "11";
                 $changestage->status = "Under phase II b Additional Lab Investigation";
                 $changestage->completed_by_phaseIIB_correction_inconclusive= Auth::user()->name;
                 $changestage->completed_on_phaseIIB_correction_inconclusive = Carbon::now()->format('d-M-Y');
                 $changestage->comment_phaseIIB_correction_inconclusive = $request->comment;
                     $history = new OosAuditTrial();
                     $history->oos_id = $id;
                     $history->activity_type = 'Activity Log';
                     $history->comment = $request->comment;
                     $history->user_id = Auth::user()->id;
                     $history->user_name = Auth::user()->name;
                     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                     $history->origin_state = $lastDocument->status;
                     $history->action = 'Assignable Cause Not Found';
                     $history->change_from = $lastDocument->status;
                     $history->change_to =   "Under Phase I b Investigation";
                     $history->action_name = 'Update';
                     $history->save();
                 $changestage->update();
                 toastr()->success('Document Sent');
                 return back();
             }
             if ($changestage->stage == 14) {
                 $changestage->stage = "13";
                 $changestage->status = "Under Phase III Investigation";
                 $changestage->completed_by_phaseIII_manufacturing_investigation= Auth::user()->name;
                 $changestage->completed_on_phaseIII_manufacturing_investigation = Carbon::now()->format('d-M-Y');
                 $changestage->comment_phaseIII_manufacturing_investigation = $request->comment;
                     $history = new OosAuditTrial();
                     $history->oos_id = $id;
                     $history->activity_type = 'Activity Log';
                     $history->comment = $request->comment;
                     $history->user_id = Auth::user()->id;
                     $history->user_name = Auth::user()->name;
                     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                     $history->origin_state = $lastDocument->status;
                     $history->action = 'Request More Info';
                     $history->change_from = $lastDocument->status;
                     $history->change_to =   "Under Phase III Investigation";
                     $history->action_name = 'Update';
                     $history->save();
                 $changestage->update();
                 toastr()->success('Document Sent');
                 return back();
             }
         } else {
             toastr()->error('E-signature Not match');
             return back();
         }
     }
    public function cancel_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $data = OOS::find($id);
            $lastDocument = OOS::find($id);
            $data->stage = "0";
            $data->status = "Closed-Cancelled";
            $data->cancelled_by = Auth::user()->name;
            $data->cancelled_on = Carbon::now()->format('d-M-Y');
            $data->comment_cancle = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous ="";
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state =  $data->status;
                    $history->action = 'Closed-Cancelled';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Closed-Cancelled";
                    $history->action_name = 'Update';
                    $history->save();
            $data->update();
            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function child(Request $request, $id)
    {
        $cft = [];
        $parent_id = $id;
        $parent_type = "Audit_Program";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $parent_record = OOS::where('id', $id)->value('record_number');
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_division_id = OOS::where('id', $id)->value('division_id');
        $parent_initiator_id = OOS::where('id', $id)->value('initiator_id');
        $parent_intiation_date = OOS::where('id', $id)->value('intiation_date');
        $parent_created_at = OOS::where('id', $id)->value('created_at');
        $parent_short_description = OOS::where('id', $id)->value('description_gi');
        $hod = User::where('role', 4)->get();
        $record = $record_number;
        // dd($record_number);
        $old_record = OOS::select('id', 'division_id', 'record_number')->get();

        if ($request->child_type == "capa") {
            $parent_name = "CAPA";
            $Capachild = OOS::find($id);
            $Capachild->Capachild = $record_number;
            $Capachild->save();

            return view('frontend.forms.capa', compact('parent_id', 'parent_record','parent_type', 'record', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'old_record', 'cft'));
        } elseif ($request->child_type == "Action_Item")
         {
            $parent_name = "CAPA";
            $actionchild = OOS::find($id);
            $actionchild->actionchild = $record_number;
            $parent_id = $id;
            $actionchild->save();

            return view('frontend.forms.action-item', compact('parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'record', 'due_date', 'parent_id', 'parent_type'));
        }
        else {
            $parent_name = "Root";
            $Rootchild = OOS::find($id);
            $Rootchild->Rootchild = $record_number;
            $Rootchild->save();
            return view('frontend.forms.root-cause-analysis', compact('parent_id', 'parent_record','parent_type', 'record', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', ));
        }
    }

    public function AuditTrial($id)
    {
        $audit = OosAuditTrial::where('oos_id', $id)->orderByDesc('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = OOS::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
        return view('frontend.OOS.comps.audit-trial', compact('audit', 'document', 'today'));
    }

    public function auditDetails($id)
    {

        $detail = OosAuditTrial::find($id);

        $detail_data = OosAuditTrial::where('activity_type', $detail->activity_type)->where('oos_id', $detail->id)->latest()->get();

        $doc = OOS::where('id', $detail->oos_id)->first();
        

        $doc->origiator_name = User::find($doc->initiator_id);
        
        return view('frontend.OOS.comps.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
    }
    public static function auditReport($id)
    {
        $doc = OOS::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $data = OOSAuditTrial::where('oos_id', $id)->get();
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.oos.comps.auditReport', compact('data', 'doc'))
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
            return $pdf->stream('OOS-Audit' . $id . '.pdf');
        }
    }
    
    public static function singleReport($id)
    {
        $data = OOS::find($id);
        if (!empty($data)) {
            $data->info_product_materials = $data->grids()->where('identifier', 'info_product_material')->first();
            $data->details_stabilities = $data->grids()->where('identifier', 'details_stability')->first();
            $data->oos_details = $data->grids()->where('identifier', 'oos_detail')->first();
            $checklist_lab_invs = $data->grids()->where('identifier', 'checklist_lab_inv')->first();
            $oos_capas = $data->grids()->where('identifier', 'oos_capa')->first();
            $phase_two_invs = $data->grids()->where('identifier', 'phase_two_inv')->first();
            $oos_conclusions = $data->grids()->where('identifier', 'oos_conclusion')->first();
            $oos_conclusion_reviews = $data->grids()->where('identifier', 'oos_conclusion_review')->first();
            $instrument_details = $data->grids()->where('identifier', 'instrument_detail')->first();
            $products_details = $data->grids()->where('identifier', 'products_details')->first();
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.OOS.comps.singleReport', compact('data','products_details','instrument_details','checklist_lab_invs','phase_two_invs','oos_capas','oos_conclusions','oos_conclusion_reviews'))
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
            return $pdf->stream('OOS Cemical' . $id . '.pdf');
        }
    }
       
}
