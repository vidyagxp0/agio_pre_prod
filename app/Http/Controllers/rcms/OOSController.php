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
        return view('frontend.OOS.oos_form');
    }
    
    public function store(Request $request)
    { 

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
        $data = OOS::find($id);
        $info_product_materials = $data->grids()->where('identifier', 'info_product_material')->first();
        $details_stabilities = $data->grids()->where('identifier', 'details_stability')->first();
        $oos_details = $data->grids()->where('identifier', 'oos_detail')->first();
        $checklist_lab_invs = $data->grids()->where('identifier', 'checklist_lab_inv')->first();
        $oos_capas = $data->grids()->where('identifier', 'oos_capa')->first();
        $phase_two_invs = $data->grids()->where('identifier', 'phase_two_inv')->first();
        $oos_conclusions = $data->grids()->where('identifier', 'oos_conclusion')->first();
        $oos_conclusion_reviews = $data->grids()->where('identifier', 'oos_conclusion_review')->first();
        
        return view('frontend.OOS.oos_form_view', 
        compact('data', 'info_product_materials', 'details_stabilities', 'oos_details', 'checklist_lab_invs', 'oos_capas', 'phase_two_invs', 'oos_conclusions', 'oos_conclusion_reviews'));

    }

    public function update(Request $request, $id)
    {
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

        return redirect()->route('qms.dashboard');
        
        // toastr()->success("Record is created Successfully");
        // return redirect(url('rcms/qms-dashboard'));
    }

    public function send_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changestage = OOS::find($id);
            $lastDocument = OOS::find($id);
            if ($changestage->stage == 1) {
                $changestage->stage = "2";
                $changestage->status = "Pending Initial Assessment & LabIncident";
                $changestage->completed_by_pending_initial_assessment = Auth::user()->name;
                $changestage->completed_on_pending_initial_assessment = Carbon::now()->format('d-M-Y');
                $changestage->comment_pending_initial_assessment = $request->comment;
                                $history = new OosAuditTrial();
                                $history->oos_id = $id;
                                $history->activity_type = 'Activity Log';
                                $history->current = $changestage->completed_by_pending_initial_assessment;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->id;
                                $history->user_name = Auth::user()->name;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = "Completed";
                                $history->save();
                            //     $list = Helpers::getLeadAuditeeUserList();
                            //     foreach ($list as $u) {
                            //         if($u->q_m_s_divisions_id == $changestage->division_id){
                            //             $email = Helpers::getInitiatorEmail($u->user_id);
                            //              if ($email !== null) {
                                      
                            //               Mail::send(
                            //                   'mail.view-mail',
                            //                    ['data' => $changestage],
                            //                 function ($message) use ($email) {
                            //                     $message->to($email)
                            //                         ->subject("Document sent ".Auth::user()->name);
                            //                 }
                            //               );
                            //             }
                            //      } 
                            //   }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 2) {
                $changestage->stage = "3";
                $changestage->status = "Under Phase I investigation";
                $changestage->completed_by_under_phaseI_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseI_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseI_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIB_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Lab Supervisor";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 3) {
                $changestage->stage = "5";
                $changestage->status = "Under Phase I b Investigation";
                $changestage->completed_by_under_phaseIB_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseIB_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseIB_investigation = $request->comment;
                            $history = new OosAuditTrial();
                            $history->oos_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changestage->completed_by_under_phaseIB_investigation;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Lab Supervisor";
                            $history->save();
                        
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 5) {
                $changestage->stage = "6";
                $changestage->status = "Under Hypothesis Experient";
                $changestage->completed_by_under_hypothesis = Auth::user()->name;
                $changestage->completed_on_under_hypothesis = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_hypothesis = $request->comment;

                $history = new OosAuditTrial();
                $history->oos_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->completed_by_under_hypothesis;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Final Approval";
                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 6) {
                $changestage->stage = "8";
                $changestage->status = "under phase II Investigation";
                $changestage->completed_by_under_phaseII_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseII_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseII_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseII_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Under Phase II investigation";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 8) {
                $changestage->stage = "9";
                $changestage->status = "under Manufacturing Investigation phase II a";
                $changestage->completed_by_under_manufacturing_investigation_phaseIIA = Auth::user()->name;
                $changestage->completed_on_under_manufacturing_investigation_phaseIIA = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_manufacturing_investigation_phaseIIA = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_manufacturing_investigation_phaseIIA;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Under Manufacturing Phase II b Additional Lab Investigation";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 9) {
                $changestage->stage = "11";
                $changestage->status = "Under phase II b Additional Lab Investigation";
                $changestage->completed_by_under_phaseIIB_additional_lab_investigation= Auth::user()->name;
                $changestage->completed_on_under_phaseIIB_additional_lab_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseIIB_additional_lab_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_manufacturing_investigation_phaseIIA;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Under Manufacturing Phase II b Additional Lab Investigation";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 11) {
                $changestage->stage = "13";
                $changestage->status = "Under phase III Investigation";
                $changestage->completed_by_under_phaseIII_investigation= Auth::user()->name;
                $changestage->completed_on_under_phaseIII_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseIII_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIII_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Under Manufacturing Phase II b Additional Lab Investigation";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 13) {
                $changestage->stage = "14";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;

                $history = new OosAuditTrial();
                $history->oos_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->completed_by_under_phaseIII_investigation;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Approval Completed";
                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
           
            if ($changestage->stage == 14) {
                $changestage->stage = "15";
                $changestage->status = "Close-Done";
                $changestage->completed_by_close_done= Auth::user()->name;
                $changestage->completed_on_close_done = Carbon::now()->format('d-M-Y');
                $changestage->comment_close_done = $request->comment;
                
                $history = new OosAuditTrial();
                $history->oos_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->completed_by_under_phaseIII_investigation;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Close-Done";
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
                $changestage->completed_by_pending_initial_assessment = Auth::user()->name;
                $changestage->completed_on_pending_initial_assessment = Carbon::now()->format('d-M-Y');
                $changestage->comment_pending_initial_assessment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_pending_initial_assessment;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Completed";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 3) {
                $changestage->stage = "2";
                $changestage->status = "Pending Initial Assessment & Lab Incident";
                $changestage->completed_by_under_phaseI_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseI_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseI_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIB_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Lab Supervisor";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 4) {
                $changestage->stage = "3";
                $changestage->status = "Under Phase I Investigation";
                $changestage->completed_by_under_phaseI_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseI_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseI_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIB_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Lab Supervisor";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 5) {
                $changestage->stage = "3";
                $changestage->status = "Under Phase I b Investigation";
                $changestage->status = "Under Phase I Investigation";
                $changestage->completed_by_under_phaseI_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseI_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseI_investigation = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIB_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Lab Supervisor";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 6) {
                $changestage->stage = "5";
                $changestage->status = "Under Hypothesis Experient";
                $changestage->completed_by_under_hypothesis = Auth::user()->name;
                $changestage->completed_on_under_hypothesis = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_hypothesis = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_hypothesis;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Final Approval";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 8) {
                $changestage->stage = "6";
                $changestage->status = "Under Hypothesis Experiment";
                $changestage->completed_by_under_phaseII_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseII_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseII_investigation = $request->comment;
                
                $history = new OosAuditTrial();
                $history->oos_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->completed_by_under_phaseII_investigation;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Under Phase II investigation";
                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 9) {
                $changestage->stage = "8";
                $changestage->status = "under phase II Investigation";
                $changestage->completed_by_under_manufacturing_investigation_phaseIIA = Auth::user()->name;
                $changestage->completed_on_under_manufacturing_investigation_phaseIIA = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_manufacturing_investigation_phaseIIA = $request->comment;
                
                $history = new OosAuditTrial();
                $history->oos_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->completed_by_under_manufacturing_investigation_phaseIIA;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Under Manufacturing Phase II b Additional Lab Investigation";
                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 11) {
                $changestage->stage = "9";
                $changestage->status = "Under Manufacturing Phase II b Additional Lab Investigation";
                $changestage->completed_by_under_phaseIIB_additional_lab_investigation= Auth::user()->name;
                $changestage->completed_on_under_phaseIIB_additional_lab_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseIIB_additional_lab_investigation = $request->comment;
                
                $history = new OosAuditTrial();
                $history->oos_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->completed_by_under_manufacturing_investigation_phaseIIA;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Under Manufacturing Phase II b Additional Lab Investigation";
                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 13) {
                $changestage->stage = "11";
                $changestage->status = "Under phase II b Additional Lab Investigation";
                $changestage->completed_by_under_phaseIII_investigation= Auth::user()->name;
                $changestage->completed_on_under_phaseIII_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseIII_investigation = $request->comment;
                
                $history = new OosAuditTrial();
                $history->oos_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->completed_by_under_phaseIII_investigation;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Under Manufacturing Phase II b Additional Lab Investigation";
                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 14) {
                $changestage->stage = "13";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIII_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Approval Completed";
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
                $changestage->completed_by_under_phaseI_correction= Auth::user()->name;
                $changestage->completed_on_under_phaseI_correction = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseI_correction = $request->comment;
                            $history = new OosAuditTrial();
                            $history->oos_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changestage->completed_by_under_phaseI_correction;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Lab Supervisor";
                            $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 4) {
                $changestage->stage = "14";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIII_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Approval Completed";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 6) {
                $changestage->stage = "7";
                $changestage->status = "Under Repeat Analysis";
                $changestage->completed_by_under_repeat_analysis= Auth::user()->name;
                $changestage->completed_on_under_repeat_analysis = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_repeat_analysis = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_repeat_analysis;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Under Repeat Analysis";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 7) {
                $changestage->stage = "14";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIII_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Approval Completed";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 9) {
                $changestage->stage = "10";
                $changestage->status = "Under PhaseIIA Correction";
                $changestage->completed_by_under_phaseIIA_correction= Auth::user()->name;
                $changestage->completed_on_under_phaseIIA_correction = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseIIA_correction = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIIA_correction;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Approval Completed";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 10) {
                $changestage->stage = "12";
                $changestage->status = "Under Batch Disposition";
                $changestage->completed_by_under_batch_disposition= Auth::user()->name;
                $changestage->completed_on_under_batch_disposition = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_batch_disposition = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_batch_disposition;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Approval Completed";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 11) {
                $changestage->stage = "12";
                $changestage->status = "Under Batch Disposition";
                $changestage->completed_by_under_batch_disposition= Auth::user()->name;
                $changestage->completed_on_under_batch_disposition = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_batch_disposition = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_batch_disposition;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Approval Completed";
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 12) {
                $changestage->stage = "14";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $changestage->completed_by_under_phaseIII_investigation;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = "Approval Completed";
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
                    $history->current = $data->cancelled_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state =  $data->status;
                    $history->stage = 'Cancelled';
                    $history->save();
            $data->update();
            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function reject_stage(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $capa = Capa::find($id);
            $lastDocument = Capa::find($id);


            if ($capa->stage == 2) {
                $capa->stage = "1";
                $capa->status = "Opened";
                // $capa->rejected_by = Auth::user()->name;
                // $capa->rejected_on = Carbon::now()->format('d-M-Y');
                $capa->update();
                $history = new CapaHistory();
                $history->type = "Capa";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $capa->stage;
                $history->status = "Opened";
                // $list = Helpers::getInitiatorUserList();
                // foreach ($list as $u) {
                //     if($u->q_m_s_divisions_id == $capa->division_id){
                //     $email = Helpers::getInitiatorEmail($u->user_id);
                //     if ($email !== null) {
                       
                //         Mail::send(
                //             'mail.view-mail',
                //             ['data' => $capa],
                //             function ($message) use ($email) {
                //                 $message->to($email)
                //                     ->subject("More Info Required ".Auth::user()->name);
                //             }
                //         );
                //       }
                //     } 
                // }
                $history->save();

                toastr()->success('Document Sent');
                return back();
            }
            if ($capa->stage == 3) {
                $capa->stage = "2";
                $capa->status = "Pending CAPA Plan";
                $capa->qa_more_info_required_by = Auth::user()->name;
                $capa->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                        $history = new CapaAuditTrial();
                        $history->capa_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->current = $capa->qa_more_info_required_by;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->stage = 'Qa More Info Required';
                        $history->save();   
                $capa->update();
                $history = new CapaHistory();
                $history->type = "Capa";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $capa->stage;
                $history->status = "Pending CAPA Plan<";
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    // public function cancel_record(Request $request, $id)
    // {
    //     $oos_record = OOS::find($id);
    // }

    public function AuditTrial($id)
    {
         $audit = OosAuditTrial::where('oos_id', $id)->orderByDESC('id')->get()->unique('activity_type');
         $today = Carbon::now()->format('d-m-y');
         $document = OOS::where('id', $id)->first();
         $document->initiator = User::where('id', $document->initiator_id)->value('name');

        return view('frontend.OOS.comps.audit-trial', compact('audit', 'document', 'today'));
    }

    public function auditDetails($id)
    {

        $detail = OosAuditTrial::find($id);

        $detail_data = OosAuditTrial::where('activity_type', $detail->activity_type)->where('oos_id', $detail->id)->latest()->get();

        $doc = OOS::where('id', $detail->id)->first();

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
    // public function child_change_control(Request $request, $id)
    // {
    //     $cft =[];
    //     $parent_id = $id;
    //     $parent_type = "Audit_Program";
    //     $record_number = ((RecordNumber::first()->value('counter')) + 1);
    //     $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
    //     $currentDate = Carbon::now();
    //     $formattedDate = $currentDate->addDays(30);
    //     $due_date= $formattedDate->format('d-M-Y');
    //     $parent_record = Capa::where('id', $id)->value('record');
    //     $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
    //     $parent_division_id = Capa::where('id', $id)->value('division_id');
    //     $parent_initiator_id = Capa::where('id', $id)->value('initiator_id');
    //     $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
    //     $parent_short_description = Capa::where('id', $id)->value('short_description');
    //     $hod = User::where('role', 4)->get();
    //     $pre = CC::all();
    //     $changeControl = OpenStage::find(1);
    //     if(!empty($changeControl->cft)) $cft = explode(',', $changeControl->cft);
    //     // return $capa_data;
    //     if ($request->child_type == "Change_control") {
    //         return view('frontend.change-control.new-change-control', compact('cft','pre','hod','parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id', 'parent_record', 'record_number', 'due_date', 'parent_id', 'parent_type'));
    //     }
    //     if ($request->child_type == "extension") {
    //         $parent_due_date = "";
    //         $parent_id = $id;
    //         $parent_name = $request->parent_name;
    //         if ($request->due_date) {
    //             $parent_due_date = $request->due_date;
    //         }

    //         $record_number = ((RecordNumber::first()->value('counter')) + 1);
    //         $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
    //         return view('frontend.forms.extension', compact('parent_id', 'parent_name', 'record_number', 'parent_due_date'));
    //     }
    //     $old_record = Capa::select('id', 'division_id', 'record')->get();
    //     if ($request->child_type == "Action_Item") {
    //         $parent_name = "CAPA";

    //         return view('frontend.forms.action-item', compact('old_record','parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'record_number', 'due_date', 'parent_id', 'parent_type'));
    //     } else {
    //         return view('frontend.forms.effectiveness-check', compact('old_record','parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id', 'parent_record', 'record_number', 'due_date', 'parent_id', 'parent_type'));
    //     }
    // }

    
    public static function singleReport($id)
    {
        $data = OOS::find($id);
        if (!empty($data)) {
            $data->Product_Details = CapaGrid::where('capa_id', $id)->where('type', "Product_Details")->first();
            $data->Instruments_Details = CapaGrid::where('capa_id', $id)->where('type', "Instruments_Details")->first();
            $data->Material_Details = CapaGrid::where('capa_id', $id)->where('type', "Material_Details")->first();
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.capa.singleReport', compact('data'))
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
            return $pdf->stream('CAPA' . $id . '.pdf');
        }
    }

    
}
