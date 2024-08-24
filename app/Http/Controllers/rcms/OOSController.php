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
        $cft = [];

        $old_records = OOS::select('id', 'division_id', 'record_number')->get();
        
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $division = QMSDivision::where('name', Helpers::getDivisionName(session()->get('division')))->first();
        if ($division) {
            $last_oos = OOS::where('division_id', $division->id)->latest()->first();
            if ($last_oos) {
                $record_number = $last_oos->record_number ? str_pad($last_oos->record_number + 1, 4, '0', STR_PAD_LEFT) : '0001';
                
            } else {
                $record_number = '0001';
            }
        }

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date= $formattedDate->format('Y-m-d');
        // $changeControl = OpenStage::find(1);
        //  if(!empty($changeControl->cft)) $cft = explode(',', $changeControl->cft);
        return view("frontend.OOS.oos_form", compact('due_date', 'record_number', 'old_records', 'cft'));

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
        $cft = [];
        $revised_date = "";
        $data = OOS::find($id);
        // dd($data);
        $old_records = OOS::select('id', 'division_id', 'record_number')->get();
        // $revised_date = Extension::where('parent_id', $id)->where('parent_type', "OOS Chemical")->value('revised_date');
        $data->record_number = str_pad($data->record_number, 4, '0', STR_PAD_LEFT);
        
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $products_details = $data->grids()->where('identifier', 'products_details')->first();
        $instrument_details = $data->grids()->where('identifier', 'instrument_details')->first();
        $info_product_materials = $data->grids()->where('identifier', 'info_product_material')->first();
        $details_stabilities = $data->grids()->where('identifier', 'details_stability')->first();
        $oos_details = $data->grids()->where('identifier', 'oos_detail')->first();
        $checklist_lab_invs = $data->grids()->where('identifier', 'checklist_lab_inv')->first();
        $oos_capas = $data->grids()->where('identifier', 'oos_capa')->first();
        $phase_two_invs = $data->grids()->where('identifier', 'phase_two_inv')->first();
        $oos_conclusions = $data->grids()->where('identifier', 'oos_conclusion')->first();
        $oos_conclusion_reviews = $data->grids()->where('identifier', 'oos_conclusion_review')->first();
        // dd($phase_two_invs);
        return view('frontend.OOS.oos_form_view', 
        compact('data', 'old_records','revised_date','cft' , 'products_details','instrument_details','info_product_materials', 'details_stabilities', 'oos_details', 'checklist_lab_invs', 'oos_capas', 'phase_two_invs', 'oos_conclusions', 'oos_conclusion_reviews'));

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

    public function send_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changestage = OOS::find($id);
            $lastDocument = OOS::find($id);
            // if ($changestage->stage == 1) {
            //     $changestage->stage = "2";
            //     $changestage->status = "Pending Initial Assessment & LabIncident";
            //     $changestage->completed_by_pending_initial_assessment = Auth::user()->name;
            //     $changestage->completed_on_pending_initial_assessment = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_pending_initial_assessment = $request->comment;
            //             $history = new OosAuditTrial();
            //             $history->oos_id = $id;
            //             $history->activity_type = 'Activity Log';
            //             $history->comment = $request->comment;
            //             $history->user_id = Auth::user()->id;
            //             $history->user_name = Auth::user()->name;
            //             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //             $history->origin_state = $lastDocument->status;
            //             $history->action = 'Submit';
            //             $history->change_from = $lastDocument->status;
            //             $history->change_to =   "Pending Initial Assessment & Lab Incident";
            //             $history->action_name = 'Update';
            //             $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // ------------------------------------------------------------------------------------------------------------
            if ($changestage->stage == 1) {
                $changestage->stage = "2";
                $changestage->status = "HOD Primary Review";
                $changestage->Submite_by = Auth::user()->name;
                $changestage->Submite_on = Carbon::now()->format('d-M-Y');
                $changestage->Submite_comment = $request->comment;
                                $history = new OosAuditTrial();
                                $history->oos_id = $id;
                                $history->activity_type = 'Activity Log';
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->id;
                                $history->user_name = Auth::user()->name;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                //$history->action = 'Submit';
                                $history->change_from = $lastDocument->status;
                                $history->change_to =   "HOD Primary Review";
                                $history->action_name = 'Update';
                                $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 2) {
                $changestage->stage = "4";
                $changestage->status = "CQA/QA Head Primary Review";
                $changestage->HOD_Primary_Review_Complete_By = Auth::user()->name;
                $changestage->HOD_Primary_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->HOD_Primary_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Initial Phase I Investigation';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "CQA/QA Head Primary Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            // if ($changestage->stage == 3) {
            //     $changestage->stage = "4";
            //     $changestage->status = "CQA/QA Head Primary Review Complete";
            //     $changestage->CQA_Head_Primary_Review_Complete_By = Auth::user()->name;
            //     $changestage->CQA_Head_Primary_Review_Complete_On = Carbon::now()->format('d-M-Y');
            //     $changestage->CQA_Head_Primary_Review_Complete_Comment = $request->comment;
            //                 $history = new OosAuditTrial();
            //                 $history->oos_id = $id;
            //                 $history->activity_type = 'Activity Log';
            //                 $history->comment = $request->comment;
            //                 $history->user_id = Auth::user()->id;
            //                 $history->user_name = Auth::user()->name;
            //                 $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //                 $history->origin_state = $lastDocument->status;
            //                 //$history->action = 'Assignable Cause Not Found';
            //                 $history->change_from = $lastDocument->status;
            //                 $history->change_to =   "CQA/QA Head Primary Review Complete";
            //                 $history->action_name = 'Update';
            //                 $history->save();

            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            if ($changestage->stage == 6) {
                $changestage->stage = "7";
                $changestage->status = "Phase IA QA Review ";
                $changestage->Phase_IA_HOD_Review_Complete_By = Auth::user()->name;
                $changestage->Phase_IA_HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IA_HOD_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Proposed Hypothesis Experiment';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IA QA Review ";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 7) {
                $changestage->stage = "8";
                $changestage->status = "P-IA CQAH/QAH Review";
                $changestage->Phase_IA_QA_Review_Complete_By = Auth::user()->name;
                $changestage->Phase_IA_QA_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IA_QA_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'No Assignable Cause Found';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-IA CQAH/QAH Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 9) {
                $changestage->stage = "10";
                $changestage->status = "Phase IB HOD Primary Review";
                $changestage->Phase_IB_Investigation_By = Auth::user()->name;
                $changestage->Phase_IB_Investigation_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IB_Investigation_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Full Scale Investigation';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IB HOD Primary Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 10) {
                $changestage->stage = "11";
                $changestage->status = "Phase IB QA Review";
                $changestage->Phase_IB_HOD_Review_Complete_By= Auth::user()->name;
                $changestage->Phase_IB_HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IB_HOD_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'No Assignable Cause Found (No Manufacturing Defect)';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IB QA Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 11) {
                $changestage->stage = "12";
                $changestage->status = "P-IB CQAH/QAH Review";
                $changestage->Phase_IB_QA_Review_Complete_By = Auth::user()->name;
                $changestage->Phase_IB_QA_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IB_QA_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-IB CQAH/QAH Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            // if ($changestage->stage == 11) {
            //     $changestage->stage = "13";
            //     $changestage->status = "Under phase III Investigation";
            //     $changestage->completed_by_under_phaseIII_investigation= Auth::user()->name;
            //     $changestage->completed_on_under_phaseIII_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseIII_investigation = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Phase II A Correction Inconclusive';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Pending Correction";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            if ($changestage->stage == 12) {
                $changestage->stage = "13";
                $changestage->status = "Under Phase-II A Investigation";
                $changestage->P_I_B_Assignable_Cause_Not_Found_By= Auth::user()->name;
                $changestage->P_I_B_Assignable_Cause_Not_Found_On = Carbon::now()->format('d-M-Y');
                $changestage->P_I_B_Assignable_Cause_Not_Found_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Under Phase-II A Investigation';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase-II A Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            
            if($changestage->stage == 14) {
                $changestage->stage = "15";
                $changestage->status = "Phase II A QA Review";
                $changestage->Phase_II_A_HOD_Review_Complete_By= Auth::user()->name;
                $changestage->Phase_II_A_HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_A_HOD_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Approval Completed';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase II A QA Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 15) {
                $changestage->stage = "16";
                $changestage->status = "P-II A QAH/CQAH Review";
                $changestage->Phase_II_A_QA_Review_Complete_By= Auth::user()->name;
                $changestage->Phase_II_A_QA_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_A_QA_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'P-II A QAH/CQAH Review';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-II A QAH/CQAH Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 16) {
                $changestage->stage = "17";
                $changestage->status = "P-II A QAH/CQAH Review";
                $changestage->P_II_A_Assignable_Cause_Not_Found_By= Auth::user()->name;
                $changestage->P_II_A_Assignable_Cause_Not_Found_On = Carbon::now()->format('d-M-Y');
                $changestage->P_II_A_Assignable_Cause_Not_Found_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'P-II A QAH/CQAH Review';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-II A QAH/CQAH Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 17) {
                $changestage->stage = "18";
                $changestage->status = "P-II A QAH/CQAH Review";
                $changestage->Phase_II_B_Investigation_By= Auth::user()->name;
                $changestage->Phase_II_B_Investigation_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_B_Investigation_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'P-II A QAH/CQAH Review';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-II A QAH/CQAH Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 18) {
                $changestage->stage = "19";
                $changestage->status = "P-II A QAH/CQAH Review";
                $changestage->Phase_II_B_HOD_Review_Complete_By= Auth::user()->name;
                $changestage->Phase_II_B_HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_B_HOD_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'P-II A QAH/CQAH Review';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-II A QAH/CQAH Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 19) {
                $changestage->stage = "20";
                $changestage->status = "P-II A QAH/CQAH Review";
                $changestage->Phase_II_B_QA_Review_Complete_By= Auth::user()->name;
                $changestage->Phase_II_B_QA_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_B_QA_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'P-II A QAH/CQAH Review';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-II A QAH/CQAH Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 20) {
                $changestage->stage = "21";
                $changestage->status = "P-II A QAH/CQAH Review";
                $changestage->P_II_B_Assignable_Cause_Not_Found_By= Auth::user()->name;
                $changestage->P_II_B_Assignable_Cause_Not_Found_On = Carbon::now()->format('d-M-Y');
                $changestage->P_II_B_Assignable_Cause_Not_Found_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'P-II A QAH/CQAH Review';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-II A QAH/CQAH Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            // --------------------------------------------------------------------------------------------------------------
            // if ($changestage->stage == 2) {
            //     $changestage->stage = "3";
            //     $changestage->status = "Under Phase I investigation";
            //     $changestage->completed_by_under_phaseI_investigation = Auth::user()->name;
            //     $changestage->completed_on_under_phaseI_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseI_investigation = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Initial Phase I Investigation';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Under Phase I Investigation";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 3) {
            //     $changestage->stage = "5";
            //     $changestage->status = "Under Phase I b Investigation";
            //     $changestage->completed_by_under_phaseIB_investigation = Auth::user()->name;
            //     $changestage->completed_on_under_phaseIB_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseIB_investigation = $request->comment;
            //                 $history = new OosAuditTrial();
            //                 $history->oos_id = $id;
            //                 $history->activity_type = 'Activity Log';
            //                 $history->comment = $request->comment;
            //                 $history->user_id = Auth::user()->id;
            //                 $history->user_name = Auth::user()->name;
            //                 $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //                 $history->origin_state = $lastDocument->status;
            //                 $history->action = 'Assignable Cause Not Found';
            //                 $history->change_from = $lastDocument->status;
            //                 $history->change_to =   "Under Phase I b Investigation";
            //                 $history->action_name = 'Update';
            //                 $history->save();
                        
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 5) {
            //     $changestage->stage = "6";
            //     $changestage->status = "Under Hypothesis Experiment";
            //     $changestage->completed_by_under_hypothesis = Auth::user()->name;
            //     $changestage->completed_on_under_hypothesis = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_hypothesis = $request->comment;
            //             $history = new OosAuditTrial();
            //             $history->oos_id = $id;
            //             $history->activity_type = 'Activity Log';
            //             $history->comment = $request->comment;
            //             $history->user_id = Auth::user()->id;
            //             $history->user_name = Auth::user()->name;
            //             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //             $history->origin_state = $lastDocument->status;
            //             $history->action = 'Proposed Hypothesis Experiment';
            //             $history->change_from = $lastDocument->status;
            //             $history->change_to =   "Under Hypothesis Experiment";
            //             $history->action_name = 'Update';
            //     $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }

            // if ($changestage->stage == 6) {
            //     $changestage->stage = "8";
            //     $changestage->status = "Under Phase II Investigation";
            //     $changestage->completed_by_under_phaseII_investigation = Auth::user()->name;
            //     $changestage->completed_on_under_phaseII_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseII_investigation = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'No Assignable Cause Found';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Under Phase II Investigation";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 8) {
            //     $changestage->stage = "9";
            //     $changestage->status = "under Manufacturing Investigation phase II a";
            //     $changestage->completed_by_under_manufacturing_investigation_phaseIIA = Auth::user()->name;
            //     $changestage->completed_on_under_manufacturing_investigation_phaseIIA = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_manufacturing_investigation_phaseIIA = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Menufacturing Investigation';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "under Manufacturing Investigation phase II a";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 9) {
            //     $changestage->stage = "11";
            //     $changestage->status = "Under phase II b Additional Lab Investigation";
            //     $changestage->completed_by_under_phaseIIB_additional_lab_investigation= Auth::user()->name;
            //     $changestage->completed_on_under_phaseIIB_additional_lab_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseIIB_additional_lab_investigation = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'No Assignable Cause Found (No Menufacturing Defect)';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Under Phase II b Additional Lab Investigation";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 10) {
            //     $changestage->stage = "13";
            //     $changestage->status = "Under phase III Investigation";
            //     $changestage->completed_by_under_phaseIII_investigation= Auth::user()->name;
            //     $changestage->completed_on_under_phaseIII_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseIII_investigation = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Phase II A Correction Inconclusive';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Under phase III Investigation";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 11) {
            //     $changestage->stage = "13";
            //     $changestage->status = "Under phase III Investigation";
            //     $changestage->completed_by_under_phaseIII_investigation= Auth::user()->name;
            //     $changestage->completed_on_under_phaseIII_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseIII_investigation = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Phase IIB Correction Inconclusive';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Under phase III Investigation";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 13) {
            //     $changestage->stage = "14";
            //     $changestage->status = "Pending Final Approval Completed";
            //     $changestage->completed_by_approval_completed= Auth::user()->name;
            //     $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_approval_completed = $request->comment;

            //     $history = new OosAuditTrial();
            //     $history->oos_id = $id;
            //     $history->activity_type = 'Activity Log';
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocument->status;
            //     $history->action = 'Phase II Manufacturing Investigation';
            //     $history->change_from = $lastDocument->status;
            //     $history->change_to =   "Pending Final Approval Completed";
            //     $history->action_name = 'Update';
            //     $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
           
            // if ($changestage->stage == 14) {
            //     $changestage->stage = "15";
            //     $changestage->status = "Close-Done";
            //     $changestage->completed_by_close_done= Auth::user()->name;
            //     $changestage->completed_on_close_done = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_close_done = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Approval Completed';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Close-Done";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
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
            // if ($changestage->stage == 2) {
            //     $changestage->stage = "1";
            //     $changestage->status = "Opened";
            //     $changestage->completed_by_pending_initial_assessment = Auth::user()->name;
            //     $changestage->completed_on_pending_initial_assessment = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_pending_initial_assessment = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Request More Info';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Opened";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // -------------------------------------------------------------------------------------------------------------
            if ($changestage->stage == 2) {
                $changestage->stage = "1";
                $changestage->status = "Opened";
                $changestage->more_info_requiered1_By = Auth::user()->name;
                $changestage->more_info_requiered1_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered1_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Opened";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 4) {
                $changestage->stage = "2";
                $changestage->status = "HOD Primary Review";
                $changestage->more_info_requiered2_By = Auth::user()->name;
                $changestage->more_info_requiered2_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered2_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                   //$history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "HOD Primary Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 5) {
                $changestage->stage = "4";
                $changestage->status = "CQA/QA Head Primary Review";
                $changestage->Request_More_Info3_By = Auth::user()->name;
                $changestage->Request_More_Info3_On = Carbon::now()->format('d-M-Y');
                $changestage->Request_More_Info3_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                   // $history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "CQA/QA Head Primary Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 6) {
                $changestage->stage = "5";
                $changestage->status = "Under Phase-IA Investigation";
                $changestage->more_info_requiered4_By = Auth::user()->name;
                $changestage->more_info_requiered4_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered4_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase-IA Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
           
            if ($changestage->stage == 7) {
                $changestage->stage = "6";
                $changestage->status = "Phase IA HOD Primary Review";
                $changestage->more_info_requiered5_By = Auth::user()->name;
                $changestage->more_info_requiered5_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered5_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //s$history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IA HOD Primary Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 8) {
                $changestage->stage = "7";
                $changestage->status = "Phase IA QA Review";
                $changestage->Request_More_Info6_By = Auth::user()->name;
                $changestage->Request_More_Info6_On = Carbon::now()->format('d-M-Y');
                $changestage->Request_More_Info6_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IA QA Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 9) {
                $changestage->stage = "8";
                $changestage->status = "P-IA CQAH/QAH Review";
                $changestage->more_info_requiered7_By = Auth::user()->name;
                $changestage->more_info_requiered7_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered7_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-IA CQAH/QAH Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 10) {
                $changestage->stage = "9";
                $changestage->status = "Under Phase-IB Investigation";
                $changestage->more_info_requiered8_By= Auth::user()->name;
                $changestage->more_info_requiered8_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered8_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase-IB Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 11) {
                $changestage->stage = "10";
                $changestage->status = "Phase IB HOD Primary Review";
                $changestage->more_info_requiered9_By= Auth::user()->name;
                $changestage->more_info_requiered9_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered9_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IB HOD Primary Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 12) {
                $changestage->stage = "11";
                $changestage->status = "Phase IB QA Review";
                $changestage->Request_More_Info10_By= Auth::user()->name;
                $changestage->Request_More_Info10_By = Carbon::now()->format('d-M-Y');
                $changestage->Request_More_Info10_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IB QA Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 13) {
                $changestage->stage = "12";
                $changestage->status = "P-IB CQAH/QAH Review";
                $changestage->more_info_requiered11_By= Auth::user()->name;
                $changestage->more_info_requiered11_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered11_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-IB CQAH/QAH Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 14) {
                $changestage->stage = "13";
                $changestage->status = "Under Phase-II A Investigation";
                $changestage->more_info_requiered12_By= Auth::user()->name;
                $changestage->more_info_requiered12_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered12_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase-II A Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 15) {
                $changestage->stage = "14";
                $changestage->status = "Phase II A HOD Primary Review";
                $changestage->more_info_requiered13_By= Auth::user()->name;
                $changestage->more_info_requiered13_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered13_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase II A HOD Primary Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 16) {
                $changestage->stage = "15";
                $changestage->status = "Phase II A QA Review";
                $changestage->more_info_requiered14_By= Auth::user()->name;
                $changestage->more_info_requiered14_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered14_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase II A QA Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 17) {
                $changestage->stage = "16";
                $changestage->status = "P-II A QAH/CQAH Review";
                $changestage->Request_More_Info15_By= Auth::user()->name;
                $changestage->Request_More_Info15_On = Carbon::now()->format('d-M-Y');
                $changestage->Request_More_Info15_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-II A QAH/CQAH Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 18) {
                $changestage->stage = "17";
                $changestage->status = "Under Phase-II B Investigation";
                $changestage->more_info_requiered16_By= Auth::user()->name;
                $changestage->more_info_requiered16_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered16_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase-II B Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 19) {
                $changestage->stage = "18";
                $changestage->status = "Phase II B HOD Primary Review";
                $changestage->more_info_requiered17_By= Auth::user()->name;
                $changestage->more_info_requiered17_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered17_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase II B HOD Primary Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 20) {
                $changestage->stage = "19";
                $changestage->status = "Phase II B QA Review";
                $changestage->more_info_requiered18_By= Auth::user()->name;
                $changestage->more_info_requiered18_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered18_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase II B QA Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 21) {
                $changestage->stage = "20";
                $changestage->status = "P-II B QAH/CQAH Review";
                $changestage->Request_More_Info19_By= Auth::user()->name;
                $changestage->Request_More_Info19_On = Carbon::now()->format('d-M-Y');
                $changestage->Request_More_Info19_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-II B QAH/CQAH Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            // -------------------------------------------------------------------------------------------------------------
            // if ($changestage->stage == 3) {
            //     $changestage->stage = "2";
            //     $changestage->status = "Pending Initial Assessment & Lab Incident";
            //     $changestage->completed_by_under_phaseI_investigation = Auth::user()->name;
            //     $changestage->completed_on_under_phaseI_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseI_investigation = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Request More Info';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Pending Initial Assessment & Lab Incident";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 4) {
            //     $changestage->stage = "3";
            //     $changestage->status = "Under Phase I Investigation";
            //     $changestage->completed_by_under_phaseI_investigation = Auth::user()->name;
            //     $changestage->completed_on_under_phaseI_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseI_investigation = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Request More Info';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Under Phase I Investigation";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 5) {
            //     $changestage->stage = "3";
            //     $changestage->status = "Under Phase I Investigation";
            //     $changestage->completed_by_under_phaseI_investigation = Auth::user()->name;
            //     $changestage->completed_on_under_phaseI_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseI_investigation = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Request More Info';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Under Phase I Investigation";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 7) {
            //     $changestage->stage = "6";
            //     $changestage->status = "Under Hypothesis Experient";
            //     $changestage->completed_by_under_hypothesis = Auth::user()->name;
            //     $changestage->completed_on_under_hypothesis = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_hypothesis = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Request More Info';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Under Hypothesis Experient";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }

            // if ($changestage->stage == 8) {
            //     $changestage->stage = "6";
            //     $changestage->status = "Under Hypothesis Experient";
            //     $changestage->completed_by_under_phaseII_investigation = Auth::user()->name;
            //     $changestage->completed_on_under_phaseII_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseII_investigation = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Request More Info';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Under Hypothesis Experient";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 9) {
            //     $changestage->stage = "8";
            //     $changestage->status = "under phase II Investigation";
            //     $changestage->completed_by_under_manufacturing_investigation_phaseIIA = Auth::user()->name;
            //     $changestage->completed_on_under_manufacturing_investigation_phaseIIA = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_manufacturing_investigation_phaseIIA = $request->comment;
                
            //     $history = new OosAuditTrial();
            //     $history->oos_id = $id;
            //     $history->activity_type = 'Activity Log';
            //     $history->comment = $request->comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocument->status;
            //     $history->action = 'Request More Info';
            //     $history->change_from = $lastDocument->status;
            //     $history->change_to =   "under phase II Investigation";
            //     $history->action_name = 'Update';
            //     $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 10) {
            //     $changestage->stage = "9";
            //     $changestage->status = "Under Manufacturing Investigation Phase II a";
            //     $changestage->completed_by_under_manufacturing_investigation_phaseIIA = Auth::user()->name;
            //     $changestage->completed_on_under_manufacturing_investigation_phaseIIA = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_manufacturing_investigation_phaseIIA = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Request More Info';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Under Manufacturing Investigation Phase II a";
            //         $history->action_name = 'Update';
            //         $history->save();
            //         $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 11) {
            //     $changestage->stage = "10";
            //     $changestage->status = "Under Phase II a correction";
            //     $changestage->completed_by_under_phaseIIB_additional_lab_investigation= Auth::user()->name;
            //     $changestage->completed_on_under_phaseIIB_additional_lab_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseIIB_additional_lab_investigation = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Request More Info';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Under Phase II a correction";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 13) {
            //     $changestage->stage = "11";
            //     $changestage->status = "Under phase II b Additional Lab Investigation";
            //     $changestage->completed_by_under_phaseIII_investigation= Auth::user()->name;
            //     $changestage->completed_on_under_phaseIII_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseIII_investigation = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Assignable Cause Not Found';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Under Phase I b Investigation";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 14) {
            //     $changestage->stage = "13";
            //     $changestage->status = "Under Phase III Investigation";
            //     $changestage->completed_by_approval_completed= Auth::user()->name;
            //     $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_approval_completed = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Request More Info';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Under Phase III Investigation";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
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
            // if ($changestage->stage == 3) {
            //     $changestage->stage = "4";
            //     $changestage->status = "Under Phase I Correction";
            //     $changestage->completed_by_under_phaseI_correction= Auth::user()->name;
            //     $changestage->completed_on_under_phaseI_correction = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseI_correction = $request->comment;
            //                 $history = new OosAuditTrial();
            //                 $history->oos_id = $id;
            //                 $history->activity_type = 'Activity Log';
            //                 $history->comment = $request->comment;
            //                 $history->user_id = Auth::user()->id;
            //                 $history->user_name = Auth::user()->name;
            //                 $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //                 $history->origin_state = $lastDocument->status;
            //                 $history->action = 'Assignable Cause Found';
            //                 $history->change_from = $lastDocument->status;
            //                 $history->change_to =   "Under Phase I Correction";
            //                 $history->action_name = 'Update';
            //                 $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // ------------------------------------------------------------------------------------------------------------
            if ($changestage->stage == 1) {
                $changestage->stage = "3";
                $changestage->status = "QA Head Approval";
                $changestage->Opened_to_QA_Head_Approval_By= Auth::user()->name;
                $changestage->Opened_to_QA_Head_Approval_On  = Carbon::now()->format('d-M-Y');
                $changestage->Opened_to_QA_Head_Approval_Comment = $request->comment;
                            $history = new OosAuditTrial();
                            $history->oos_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            //$history->action = 'Assignable Cause Found';
                            $history->change_from = $lastDocument->status;
                            $history->change_to =   "QA Head Approval";
                            $history->action_name = 'Update';
                            $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 2) {
                $changestage->stage = "3";
                $changestage->status = "QA Head Approval";
                $changestage->QA_Head_Approval_By= Auth::user()->name;
                $changestage->QA_Head_Approval_On  = Carbon::now()->format('d-M-Y');
                $changestage->QA_Head_Approval_Comment = $request->comment;
                            $history = new OosAuditTrial();
                            $history->oos_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            //$history->action = 'Assignable Cause Found';
                            $history->change_from = $lastDocument->status;
                            $history->change_to =   "QA Head Approval";
                            $history->action_name = 'Update';
                            $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 4) {
                $changestage->stage = "5";
                $changestage->status = "Under Phase-IA Investigation";
                $changestage->CQA_Head_Primary_Review_Complete_By= Auth::user()->name;
                $changestage->CQA_Head_Primary_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->CQA_Head_Primary_Review_Complete_Comment = $request->comment;
                            $history = new OosAuditTrial();
                            $history->oos_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            //$history->action = 'Assignable Cause Found';
                            $history->change_from = $lastDocument->status;
                            $history->change_to =   "Under Phase-IA Investigation";
                            $history->action_name = 'Update';
                            $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 5) {
                $changestage->stage = "6";
                $changestage->status = "Phase IA HOD Primary Review";
                $changestage->Phase_IA_Investigation_By= Auth::user()->name;
                $changestage->Phase_IA_Investiigation_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IA_Investigation_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Correction Completed';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IA HOD Primary Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
           
            if ($changestage->stage == 8) {
                $changestage->stage = "9";
                $changestage->status = "Under Phase-IB Investigation";
                $changestage->Assignable_Cause_Not_Found_By= Auth::user()->name;
                $changestage->Assignable_Cause_Not_Found_On = Carbon::now()->format('d-M-Y');
                $changestage->Assignable_Cause_Not_Found_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Repeat Analysis COmpleted';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase-IB Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
           
            if ($changestage->stage == 13) {
                $changestage->stage = "14";
                $changestage->status = "Phase II A HOD Primary Review";
                $changestage->Phase_II_A_Investigation_By= Auth::user()->name;
                $changestage->Phase_II_A_Investigation_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_A_Investigation_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    //$history->action = 'Final Approval';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase II A HOD Primary Review";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            //-------------------------------------------------------------------------------------------------------------
            if ($changestage->stage == 4) {
                $changestage->stage = "14";
                $changestage->status = "Pending Final Approval Completed";
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
                $changestage->completed_by_under_repeat_analysis= Auth::user()->name;
                $changestage->completed_on_under_repeat_analysis = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_repeat_analysis = $request->comment;
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
                $changestage->status = "Under PhaseIIA Correction";
                $changestage->completed_by_under_phaseIIA_correction= Auth::user()->name;
                $changestage->completed_on_under_phaseIIA_correction = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseIIA_correction = $request->comment;
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
                $changestage->completed_by_under_batch_disposition= Auth::user()->name;
                $changestage->completed_on_under_batch_disposition = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_batch_disposition = $request->comment;
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

            if ($changestage->stage == 11) {
                $changestage->stage = "12";
                $changestage->status = "Under Batch Disposition";
                $changestage->completed_by_under_batch_disposition= Auth::user()->name;
                $changestage->completed_on_under_batch_disposition = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_batch_disposition = $request->comment;
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
    public function cancel_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $data = OOS::find($id);
            $lastDocument = OOS::find($id);
            // $data->stage = "0";
            // $data->status = "Closed-Cancelled";
            // $data->cancelled_by = Auth::user()->name;
            // $data->cancelled_on = Carbon::now()->format('d-M-Y');
            // $data->comment_cancle = $request->comment;
            //         $history = new OosAuditTrial();
            //         $history->oos_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->previous ="";
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state =  $data->status;
            //         $history->action = 'Closed-Cancelled';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Closed-Cancelled";
            //         $history->action_name = 'Update';
            //         $history->save();
            // $data->update();
            // toastr()->success('Document Sent');
            // return back();
            $data->stage = "0";
            $data->status = "Closed-Cancelled";
            $data->cancelled_by = Auth::user()->name;
            $data->cancelled_on = Carbon::now()->format('d-M-Y');
            $data->cancelled_Comment = $request->comment;

                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous ="";
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state =  $data->status;
                    //$history->action = 'Correction Complete';
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
        $old_records = OOS::select('id', 'division_id', 'record_number')->get();

        if ($request->child_type == "capa") {
            $parent_name = "CAPA";
            $Capachild = OOS::find($id);
            $Capachild->Capachild = $record_number;
            $Capachild->save();

            return view('frontend.forms.capa', compact('parent_id','old_records','record_number', 'parent_record','parent_type', 'record', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'old_records', 'cft'));
        } elseif ($request->child_type == "Action_Item")
         {
            $parent_name = "CAPA";
            $actionchild = OOS::find($id);
            $actionchild->actionchild = $record_number;
            $parent_id = $id;
            $actionchild->save();

            return view('frontend.forms.action-item', compact('parent_short_description','old_records','record_number', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'record', 'due_date', 'parent_id', 'parent_type'));
        }
        else {
            $parent_name = "Root";
            $Rootchild = OOS::find($id);
            $Rootchild->Rootchild = $record_number;
            $Rootchild->save();
            return view('frontend.forms.root-cause-analysis', compact('parent_id','old_records','record_number', 'parent_record','parent_type', 'record', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', ));
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
    
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.OOS.comps.singleReport', compact('data','checklist_lab_invs','phase_two_invs','oos_capas','oos_conclusions','oos_conclusion_reviews'))
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
