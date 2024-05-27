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

    public function cancel_record(Request $request, $id)
    {
        $oos_record = OOS::find($id);

    }

}
