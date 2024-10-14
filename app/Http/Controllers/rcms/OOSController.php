<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\ActionItem;
use App\Models\Capa;
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
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;



class OOSController extends Controller
{
    public function index()
    {
        $cft = [];

        $old_records = OOS::select('id', 'division_id', 'record_number')->get();
        $old_record = ActionItem::select('id', 'division_id', 'record')->get();
        $capa_record = Capa::select('id', 'division_id', 'record')->get();
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $division = QMSDivision::where('name', Helpers::getDivisionName(session()->get('division')))->first();

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date= $formattedDate->format('Y-m-d');
        // $changeControl = OpenStage::find(1);
        //  if(!empty($changeControl->cft)) $cft = explode(',', $changeControl->cft);
        return view("frontend.OOS.oos_form", compact('due_date', 'record_number', 'old_records', 'cft','old_record','capa_record'));

    }
    
    public function store(Request $request)
    { 
        $res = Helpers::getDefaultResponse();
        try {
            
            $oos_record = OOSService::create_oss($request);
            // dd($request->capa_ref_no_oosc);

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

        $old_records = OOS::select('id', 'division_id', 'record_number')->get();
        $old_record = ActionItem::select('id', 'division_id', 'record')->get();
        $capa_record = Capa::select('id', 'division_id', 'record')->get();
        // $revised_date = Extension::where('parent_id', $id)->where('parent_type', "OOS Chemical")->value('revised_date');
        $record_number = str_pad($data->record_number, 4, '0', STR_PAD_LEFT);
        
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $products_details = $data->grids()->where('identifier', 'products_details')->first();
        $instrument_detail = $data->grids()->where('identifier', 'instrument_detail')->first();
        $info_product_materials = $data->grids()->where('identifier', 'info_product_material')->first();
        $details_stabilities = $data->grids()->where('identifier', 'details_stability')->first();
        $oos_details = $data->grids()->where('identifier', 'oos_detail')->first();
        $checklist_lab_invs = $data->grids()->where('identifier', 'checklist_lab_inv')->first();
        $checklist_IB_invs = $data->grids()->where('identifier', 'checklist_IB_inv')->first();
        $oos_capas = $data->grids()->where('identifier', 'oos_capa')->first();
        $phase_two_invs = $data->grids()->where('identifier', 'phase_two_inv')->first();
        $ph_meters = $data->grids()->where('identifier', 'ph_meter')->first();
        $phase_two_invss = $data->grids()->where('identifier', 'phase_two_inv1')->first();

        $Viscometers = $data->grids()->where('identifier', 'Viscometer')->first();
        $Melting_Points = $data->grids()->where('identifier', 'Melting_Point')->first();
        $Dis_solutions = $data->grids()->where('identifier', 'Dis_solution')->first();
        $HPLC_GCs = $data->grids()->where('identifier', 'HPLC_GC')->first();
        $General_Checklists = $data->grids()->where('identifier', 'General_Checklist')->first();
        $kF_Potentionmeters = $data->grids()->where('identifier', 'kF_Potentionmeter')->first();
        $RM_PMs = $data->grids()->where('identifier', 'RM_PM')->first();
        $check_analyst_training_procedures = $data->grids()->where('identifier', 'analyst_training_procedure')->first();

        $Training_records_Analyst_Involveds = $data->grids()->where('identifier', 'Training_records_Analyst_Involved1')->first();
        $sample_intactness_before_analysis = $data->grids()->where('identifier', 'sample_intactness_before_analysis1')->first();
        $test_methods_Procedures = $data->grids()->where('identifier', 'test_methods_Procedure1')->first();
        $Review_of_Media_Buffer_Standards_prepar = $data->grids()->where('identifier', 'Review_of_Media_Buffer_Standards_prep1')->first();
        $Checklist_for_Revi_of_Media_Buffer_Stand_preps = $data->grids()->where('identifier', 'Checklist_for_Revi_of_Media_Buffer_Stand_prep1')->first();
        $check_for_disinfectant_details = $data->grids()->where('identifier', 'ccheck_for_disinfectant_detail1')->first();
        $Checklist_for_Review_of_instrument_equips = $data->grids()->where('identifier', 'Checklist_for_Review_of_instrument_equip1')->first();
        $Checklist_for_Review_of_Training_records_Analysts = $data->grids()->where('identifier', 'Checklist_for_Review_of_Training_records_Analyst1')->first();
        $Checklist_for_Review_of_sampling_and_Transports = $data->grids()->where('identifier', 'Checklist_for_Review_of_sampling_and_Transport1')->first();
        $Checklist_Review_of_Test_Method_proceds = $data->grids()->where('identifier', 'Checklist_Review_of_Test_Method_proceds1')->first();
        $Checklist_for_Review_Media_prepara_RTU_medias = $data->grids()->where('identifier', 'Checklist_for_Review_Media_prepara_RTU_medias1')->first();
        $Checklist_Review_Environment_condition_in_tests = $data->grids()->where('identifier', 'Checklist_Review_Environment_condition_in_tests1')->first();
        $review_of_instrument_bioburden_and_waters = $data->grids()->where('identifier', 'review_of_instrument_bioburden_and_waters1')->first();
        $disinfectant_details_of_bioburden_and_water_tests = $data->grids()->where('identifier', 'disinfectant_details_of_bioburden_and_water_tests1')->first();

        $training_records_analyst_involvedIn_testing_microbial_asssays = $data->grids()->where('identifier', 'training_records_analyst_involvedIn_testing_microbial_asssays1')->first();
        $sample_intactness_before_analysis2 = $data->grids()->where('identifier', 'sample_intactness_before_analysis22')->first();
        $checklist_for_review_of_test_method_IMAs = $data->grids()->where('identifier', 'checklist_for_review_of_test_method_IMA1')->first();
        $cr_of_media_buffe_rst_IMAs = $data->grids()->where('identifier', 'cr_of_media_buffer_st_IMA1')->first();
        $CR_of_microbial_cultures_inoculation_IMAs = $data->grids()->where('identifier', 'CR_of_microbial_cultures_inoculation_IMA1')->first();
        $CR_of_Environmental_condition_in_testing_IMAs = $data->grids()->where('identifier', 'CR_of_Environmental_condition_in_testing_IMA1')->first();
        $CR_of_instru_equipment_IMAs = $data->grids()->where('identifier', 'CR_of_instru_equipment_IMA1')->first();
        $disinfectant_details_IMAs = $data->grids()->where('identifier', 'disinfectant_details_IMA1')->first();

        $CR_of_training_rec_anaylst_in_monitoring_CIEMs = $data->grids()->where('identifier', 'CR_of_training_rec_anaylst_in_monitoring_CIEM1')->first();
        $Check_for_Sample_details_CIEMs = $data->grids()->where('identifier', 'Check_for_Sample_details_CIEM1')->first();
        $Check_for_comparision_of_results_CIEMs = $data->grids()->where('identifier', 'Check_for_comparision_of_results_CIEM1')->first();
        $checklist_for_media_dehydrated_CIEMs = $data->grids()->where('identifier', 'checklist_for_media_dehydrated_CIEM1')->first();
        $checklist_for_media_prepara_sterilization_CIEMs = $data->grids()->where('identifier', 'checklist_for_media_prepara_sterilization_CIEM1')->first();
        $CR_of_En_condition_in_testing_CIEMs = $data->grids()->where('identifier', 'CR_of_En_condition_in_testing_CIEM1')->first();
        $check_for_disinfectant_CIEMs = $data->grids()->where('identifier', 'check_for_disinfectant_CIEM1')->first();
        $checklist_for_fogging_CIEMs = $data->grids()->where('identifier', 'checklist_for_fogging_CIEM1')->first();
        $CR_of_test_method_CIEMs = $data->grids()->where('identifier', 'CR_of_test_method_CIEM1')->first();
        $CR_microbial_isolates_contamination_CIEMs = $data->grids()->where('identifier', 'CR_microbial_isolates_contamination_CIEM1')->first();
        $CR_of_instru_equip_CIEMs = $data->grids()->where('identifier', 'CR_of_instru_equip_CIEM1')->first();
        $Ch_Trend_analysis_CIEMs = $data->grids()->where('identifier', 'Ch_Trend_analysis_CIEM1')->first();

        $checklist_for_analyst_training_CIMTs = $data->grids()->where('identifier', 'checklist_for_analyst_training_CIMT2')->first();
        $checklist_for_comp_results_CIMTs = $data->grids()->where('identifier', 'checklist_for_comp_results_CIMT2')->first();
        $checklist_for_Culture_verification_CIMTs = $data->grids()->where('identifier', 'checklist_for_Culture_verification_CIMT2')->first();
        $sterilize_accessories_CIMTs = $data->grids()->where('identifier', 'sterilize_accessories_CIMT2')->first();
        $checklist_for_intrument_equip_last_CIMTs = $data->grids()->where('identifier', 'checklist_for_intrument_equip_last_CIMT2')->first();
        $disinfectant_details_last_CIMTs = $data->grids()->where('identifier', 'disinfectant_details_last_CIMT2')->first();
        $checklist_for_result_calculation_CIMTs = $data->grids()->where('identifier', 'checklist_for_result_calculation_CIMT2')->first();

        $check_sample_receiving_vars = $data->grids()->where('identifier', 'sample_receiving_var')->first();
        $check_method_procedure_during_analysis = $data->grids()->where('identifier', 'method_used_during_analysis')->first();
        $check_Instrument_Equipment_Details = $data->grids()->where('identifier', 'instrument_equipment_detailss')->first();
        $Results_and_Calculation = $data->grids()->where('identifier', 'result_and_calculation')->first();

        $oos_conclusion = $data->grids()->where('identifier', 'oos_conclusion')->first();
        $oos_conclusion_review = $data->grids()->where('identifier', 'oos_conclusion_review')->first();
        // dd($phase_two_invs);
        return view('frontend.OOS.oos_form_view', 
        compact('data', 'old_records','capa_record','check_method_procedure_during_analysis','Results_and_Calculation','check_Instrument_Equipment_Details','check_sample_receiving_vars','old_record','revised_date','phase_two_invss','checklist_for_result_calculation_CIMTs','disinfectant_details_last_CIMTs','checklist_for_intrument_equip_last_CIMTs','sterilize_accessories_CIMTs','checklist_for_Culture_verification_CIMTs','checklist_for_comp_results_CIMTs','checklist_for_analyst_training_CIMTs','Ch_Trend_analysis_CIEMs','CR_of_instru_equip_CIEMs','CR_microbial_isolates_contamination_CIEMs','CR_of_test_method_CIEMs','checklist_for_fogging_CIEMs','check_for_disinfectant_CIEMs','CR_of_En_condition_in_testing_CIEMs','checklist_for_media_prepara_sterilization_CIEMs','checklist_for_media_dehydrated_CIEMs','Check_for_comparision_of_results_CIEMs','Check_for_Sample_details_CIEMs','CR_of_training_rec_anaylst_in_monitoring_CIEMs','cft','disinfectant_details_IMAs','CR_of_instru_equipment_IMAs','CR_of_Environmental_condition_in_testing_IMAs','CR_of_microbial_cultures_inoculation_IMAs','cr_of_media_buffe_rst_IMAs','checklist_for_review_of_test_method_IMAs','sample_intactness_before_analysis2','training_records_analyst_involvedIn_testing_microbial_asssays','disinfectant_details_of_bioburden_and_water_tests','review_of_instrument_bioburden_and_waters','Checklist_Review_Environment_condition_in_tests','Checklist_for_Review_Media_prepara_RTU_medias','Checklist_Review_of_Test_Method_proceds','Checklist_for_Review_of_sampling_and_Transports','Checklist_for_Review_of_Training_records_Analysts','Checklist_for_Review_of_instrument_equips','check_for_disinfectant_details','Checklist_for_Revi_of_Media_Buffer_Stand_preps','Review_of_Media_Buffer_Standards_prepar','test_methods_Procedures','sample_intactness_before_analysis','record_number','ph_meters','Viscometers','Melting_Points','Dis_solutions','HPLC_GCs','General_Checklists','kF_Potentionmeters','RM_PMs','check_analyst_training_procedures','Training_records_Analyst_Involveds', 'products_details','instrument_detail','info_product_materials', 'details_stabilities', 'oos_details', 'checklist_lab_invs', 'oos_capas', 'phase_two_invs', 'oos_conclusion', 'oos_conclusion_review','checklist_IB_invs'));

    }

    public function update(Request $request, $id)
    {
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
            if ($changestage->stage == 1) {
                $changestage->stage = "2";
                $changestage->status = "HOD Primary Review";
                $changestage->Submite_by = Auth::user()->name;
                $changestage->Submite_on = Carbon::now()->format('d-M-Y');
                $changestage->Submite_comment = $request->comment;
                                $history = new OosAuditTrial();
                                $history->oos_id = $id;
                                $history->activity_type = 'Submitted By    ,   Submitted On';
                                if (is_null($lastDocument->Submite_by) || $lastDocument->Submite_by === '') {
                                    $history->previous = "Null";
                                } else {
                                    $history->previous = $lastDocument->Submite_by . ' , ' . $lastDocument->Submite_on;
                                }
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->id;
                                $history->user_name = Auth::user()->name;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                //$history->action = 'Submit';
                                $history->change_from = $lastDocument->status;
                                $history->change_to =   "HOD Primary Review";
                                $history->current = $changestage->Submite_by . ' , ' . $changestage->Submite_on;
                                if (is_null($lastDocument->Submite_by) || $lastDocument->Submite_by === '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->action = 'Submit';
                                $history->save();

                                
                                // $list = Helpers::getHodUserList($changestage->division_id);
                                // foreach ($list as $u) {
                                //    $email = Helpers::getUserEmail($u->user_id);
                                //        if ($email !== null) {
                                //        Mail::send(
                                //            'mail.view-mail',
                                //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                                //            function ($message) use ($email, $changestage) {
                                //                $message->to($email)
                                //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                                //            }
                                //        );
                                //    }
                                // }
                               
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 2) {
                if (!$changestage->hod_remark1) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'HOD Remarks is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for QA/CQA initial review state',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "4";
                $changestage->status = "CQA/QA Head Primary Review";
                $changestage->HOD_Primary_Review_Complete_By = Auth::user()->name;
                $changestage->HOD_Primary_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->HOD_Primary_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'HOD Primary Review Complete By    ,   HOD Primary Review Complete On';
                    if (is_null($lastDocument->HOD_Primary_Review_Complete_By) || $lastDocument->HOD_Primary_Review_Complete_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->HOD_Primary_Review_Complete_By . ' , ' . $lastDocument->HOD_Primary_Review_Complete_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'HOD Primary Review Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "CQA/QA Head Primary Review";
                    $history->current = $changestage->HOD_Primary_Review_Complete_By . ' , ' . $changestage->HOD_Primary_Review_Complete_On;
                    if (is_null($lastDocument->HOD_Primary_Review_Complete_By) || $lastDocument->HOD_Primary_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getQAUserList($changestage->division_id);
                    //             foreach ($list as $u) {
                    //                $email = Helpers::getUserEmail($u->user_id);
                    //                    if ($email !== null) {
                    //                    Mail::send(
                    //                        'mail.view-mail',
                    //                        ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                        function ($message) use ($email, $changestage) {
                    //                            $message->to($email)
                    //                            ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //                        }
                    //                    );
                    //                }
                    //             }
                    
                    //             $list = Helpers::getCQAUsersList($changestage->division_id);
                    //             foreach ($list as $u) {
                    //                $email = Helpers::getUserEmail($u->user_id);
                    //                    if ($email !== null) {
                    //                    Mail::send(
                    //                        'mail.view-mail',
                    //                        ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                        function ($message) use ($email, $changestage) {
                    //                            $message->to($email)
                    //                            ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //                        }
                    //                    );
                    //                }
                    //             }

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
            //                   $history->activity_type = 'More Information Required By    ,  More Information Required On';
                  
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
                if (!$changestage->hod_remark2) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Phase IA HOD Primary Remark is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "7";
                $changestage->status = "Phase IA QA/CQA Review ";
                $changestage->Phase_IA_HOD_Review_Complete_By = Auth::user()->name;
                $changestage->Phase_IA_HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IA_HOD_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Phase IA HOD Review Complete By    ,   Phase IA HOD Review Complete On';
                    if (is_null($lastDocument->Phase_IA_HOD_Review_Complete_By) || $lastDocument->Phase_IA_HOD_Review_Complete_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Phase_IA_HOD_Review_Complete_By . ' , ' . $lastDocument->Phase_IA_HOD_Review_Complete_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase IA HOD Review Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IA QA Review ";
                    $history->current = $changestage->Phase_IA_HOD_Review_Complete_By . ' , ' . $changestage->Phase_IA_HOD_Review_Complete_On;
                    if (is_null($lastDocument->Phase_IA_HOD_Review_Complete_By) || $lastDocument->Phase_IA_HOD_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getQAUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 7) {
                if (!$changestage->QA_Head_remark2) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Phase IA CQA/QA Remark is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "8";
                $changestage->status = "P-IA CQAH/QAH Review";
                $changestage->Phase_IA_QA_Review_Complete_By = Auth::user()->name;
                $changestage->Phase_IA_QA_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IA_QA_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Phase IA QA/CQA Review Complete By    ,   Phase IA QA/CQA Review Complete On';
                    if (is_null($lastDocument->Phase_IA_QA_Review_Complete_By) || $lastDocument->Phase_IA_QA_Review_Complete_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Phase_IA_QA_Review_Complete_By . ' , ' . $lastDocument->Phase_IA_QA_Review_Complete_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase IA QA/CQA Review Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-IA CQAH/QAH Review";
                    $history->current = $changestage->Phase_IA_QA_Review_Complete_By . ' , ' . $changestage->Phase_IA_QA_Review_Complete_On;
                    if (is_null($lastDocument->Phase_IA_QA_Review_Complete_By) || $lastDocument->Phase_IA_QA_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                //     $list = Helpers::getCQAUsersList($changestage->division_id);
                //     foreach ($list as $u) {
                //        $email = Helpers::getUserEmail($u->user_id);
                //            if ($email !== null) {
                //            Mail::send(
                //                'mail.view-mail',
                //                ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                function ($message) use ($email, $changestage) {
                //                    $message->to($email)
                //                    ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                //                }
                //            );
                //        }
                //     }
                //     $list = Helpers::getQAHeadUserList($changestage->division_id);
                //     foreach ($list as $u) {
                //        $email = Helpers::getUserEmail($u->user_id);
                //            if ($email !== null) {
                //            Mail::send(
                //                'mail.view-mail',
                //                ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                //                function ($message) use ($email, $changestage) {
                //                    $message->to($email)
                //                    ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                //                }
                //            );
                //        }
                //     }
                // $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 9) {
                if (!$changestage->outcome_phase_IA) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Outcome of Phase IA investigation is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "10";
                $changestage->status = "Phase IB HOD Primary Review";
                $changestage->Phase_IB_Investigation_By = Auth::user()->name;
                $changestage->Phase_IB_Investigation_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IB_Investigation_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Phase IB Investigation By    ,   Phase IB Investigation On';
                    if (is_null($lastDocument->Phase_IB_Investigation_By) || $lastDocument->Phase_IB_Investigation_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Phase_IB_Investigation_By . ' , ' . $lastDocument->Phase_IB_Investigation_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase IB Investigation';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IB HOD Primary Review";
                    $history->current = $changestage->Phase_IB_Investigation_By . ' , ' . $changestage->Phase_IB_Investigation_On;
                    if (is_null($lastDocument->Phase_IB_Investigation_By) || $lastDocument->Phase_IB_Investigation_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                   
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 10) {
                if (!$changestage->hod_remark3) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Phase IB HOD Primary Remark* is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "11";
                $changestage->status = "Phase IB QA Review";
                $changestage->Phase_IB_HOD_Review_Complete_By= Auth::user()->name;
                $changestage->Phase_IB_HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IB_HOD_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Phase IB HOD Review Complete By    ,   Phase IB HOD Review Complete On';
                    if (is_null($lastDocument->Phase_IB_HOD_Review_Complete_By) || $lastDocument->Phase_IB_HOD_Review_Complete_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Phase_IB_HOD_Review_Complete_By . ' , ' . $lastDocument->Phase_IB_HOD_Review_Complete_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase IB HOD Review Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IB QA Review";
                    $history->current = $changestage->Phase_IB_HOD_Review_Complete_By . ' , ' . $changestage->Phase_IB_HOD_Review_Complete_On;
                    if (is_null($lastDocument->Phase_IB_HOD_Review_Complete_By) || $lastDocument->Phase_IB_HOD_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getQAUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 11) {
                if (!$changestage->QA_Head_remark3) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Phase IB CQA/QA Remark is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "12";
                $changestage->status = "P-IB CQAH/QAH Review";
                $changestage->Phase_IB_QA_Review_Complete_By = Auth::user()->name;
                $changestage->Phase_IB_QA_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IB_QA_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Phase IB QA Review Complete By    ,   Phase IB QA Review Complete On';
                    if (is_null($lastDocument->Phase_IB_QA_Review_Complete_By) || $lastDocument->Phase_IB_QA_Review_Complete_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Phase_IB_QA_Review_Complete_By . ' , ' . $lastDocument->Phase_IB_QA_Review_Complete_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase IB QA Review Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-IB CQAH/QAH Review";
                    $history->current = $changestage->Phase_IB_QA_Review_Complete_By . ' , ' . $changestage->Phase_IB_QA_Review_Complete_On;
                    if (is_null($lastDocument->Phase_IB_QA_Review_Complete_By) || $lastDocument->Phase_IB_QA_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getQAHeadUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                   
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
            //           $history->activity_type = 'More Information Required By    ,  More Information Required On';
                   
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
                if (!$changestage->QA_Head_primary_remark3) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'P-IB CQAH/QAH Remark is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "13";
                $changestage->status = "Under Phase-II A Investigation";
                $changestage->P_I_B_Assignable_Cause_Not_Found_By= Auth::user()->name;
                $changestage->P_I_B_Assignable_Cause_Not_Found_On = Carbon::now()->format('d-M-Y');
                $changestage->P_I_B_Assignable_Cause_Not_Found_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'P I B Assignable Cause Not Found By    ,   P I B Assignable Cause Not Found On';
                    if (is_null($lastDocument->P_I_B_Assignable_Cause_Not_Found_By) || $lastDocument->P_I_B_Assignable_Cause_Not_Found_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->P_I_B_Assignable_Cause_Not_Found_By . ' , ' . $lastDocument->P_I_B_Assignable_Cause_Not_Found_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'P I B Assignable Cause Not Found';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase-II A Investigation";
                    $history->current = $changestage->P_I_B_Assignable_Cause_Not_Found_By . ' , ' . $changestage->P_I_B_Assignable_Cause_Not_Found_On;
                    if (is_null($lastDocument->P_I_B_Assignable_Cause_Not_Found_By) || $lastDocument->P_I_B_Assignable_Cause_Not_Found_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getProductionUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                   
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            
            if($changestage->stage == 14) {
                if (!$changestage->hod_remark4) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Phase II A HOD Primary Remark is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "15";
                $changestage->status = "Phase II A CQA/QA Review";
                $changestage->Phase_II_A_HOD_Review_Complete_By= Auth::user()->name;
                $changestage->Phase_II_A_HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_A_HOD_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Phase II A HOD Review Complete By    ,   Phase II A HOD Review Complete On';
                    if (is_null($lastDocument->Phase_II_A_HOD_Review_Complete_By) || $lastDocument->Phase_II_A_HOD_Review_Complete_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Phase_II_A_HOD_Review_Complete_By . ' , ' . $lastDocument->Phase_II_A_HOD_Review_Complete_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase II A HOD Review Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase II A CQA/QA Review";
                    $history->current = $changestage->Phase_II_A_HOD_Review_Complete_By . ' , ' . $changestage->Phase_II_A_HOD_Review_Complete_On;
                    if (is_null($lastDocument->Phase_II_A_HOD_Review_Complete_By) || $lastDocument->Phase_II_A_HOD_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getQAUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 15) {
                if (!$changestage->QA_Head_remark4) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Phase II A CQA/QA Remark is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "16";
                $changestage->status = "P-II A QAH/CQAH Review";
                $changestage->Phase_II_A_QA_Review_Complete_By= Auth::user()->name;
                $changestage->Phase_II_A_QA_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_A_QA_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Phase II A CQA/QA Review Complete By    ,   Phase II A CQA/QA Review Complete On';
                    if (is_null($lastDocument->Phase_II_A_QA_Review_Complete_By) || $lastDocument->Phase_II_A_QA_Review_Complete_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Phase_II_A_QA_Review_Complete_By . ' , ' . $lastDocument->Phase_II_A_QA_Review_Complete_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase II A CQA/QA Review Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-II A QAH/CQAH Review";
                    $history->current = $changestage->Phase_II_A_QA_Review_Complete_By . ' , ' . $changestage->Phase_II_A_QA_Review_Complete_On;
                    if (is_null($lastDocument->Phase_II_A_QA_Review_Complete_By) || $lastDocument->Phase_II_A_QA_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getQAHeadUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                   
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 16) {
                if (!$changestage->QA_Head_primary_remark4) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'P-II A QAH/CQAH Remark is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "17";
                $changestage->status = "Under Phase-II B Investigation";
                $changestage->P_II_A_Assignable_Cause_Not_Found_By= Auth::user()->name;
                $changestage->P_II_A_Assignable_Cause_Not_Found_On = Carbon::now()->format('d-M-Y');
                $changestage->P_II_A_Assignable_Cause_Not_Found_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'P II A Assignable Cause Not Found By    ,   P II A Assignable Cause Not Found On';
                    if (is_null($lastDocument->P_II_A_Assignable_Cause_Not_Found_By) || $lastDocument->P_II_A_Assignable_Cause_Not_Found_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->P_II_A_Assignable_Cause_Not_Found_By . ' , ' . $lastDocument->P_II_A_Assignable_Cause_Not_Found_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'P II A Assignable Cause Not Found';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase-II B Investigation";
                    $history->current = $changestage->P_II_A_Assignable_Cause_Not_Found_By . ' , ' . $changestage->P_II_A_Assignable_Cause_Not_Found_On;
                    if (is_null($lastDocument->P_II_A_Assignable_Cause_Not_Found_By) || $lastDocument->P_II_A_Assignable_Cause_Not_Found_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getInitiatorUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 17) {
                $changestage->stage = "18";
                $changestage->status = "Phase II B HOD Primary Review";
                $changestage->Phase_II_B_Investigation_By= Auth::user()->name;
                $changestage->Phase_II_B_Investigation_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_B_Investigation_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Phase II B Investigation By    ,   Phase II B Investigation On';
                    if (is_null($lastDocument->Phase_II_B_Investigation_By) || $lastDocument->Phase_II_B_Investigation_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Phase_II_B_Investigation_By . ' , ' . $lastDocument->Phase_II_B_Investigation_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                     $history->action = 'Phase II B Investigation';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase II B HOD Primary Review";
                    $history->current = $changestage->Phase_II_B_Investigation_By . ' , ' . $changestage->Phase_II_B_Investigation_On;
                    if (is_null($lastDocument->Phase_II_B_Investigation_By) || $lastDocument->Phase_II_B_Investigation_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getHodUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                   
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 18) {
                if (!$changestage->hod_remark5) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Phase II B HOD Primary Remark is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "19";
                $changestage->status = "Phase II B QA/CQA Review";
                $changestage->Phase_II_B_HOD_Review_Complete_By= Auth::user()->name;
                $changestage->Phase_II_B_HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_B_HOD_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Phase II B HOD Review Complete By    ,   Phase II B HOD Review Complete On';
                    if (is_null($lastDocument->Phase_II_B_HOD_Review_Complete_By) || $lastDocument->Phase_II_B_HOD_Review_Complete_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Phase_II_B_HOD_Review_Complete_By . ' , ' . $lastDocument->Phase_II_B_HOD_Review_Complete_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase II B HOD Review Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase II B QA/CQA Review";
                    $history->current = $changestage->Phase_II_B_HOD_Review_Complete_By . ' , ' . $changestage->Phase_II_B_HOD_Review_Complete_On;
                    if (is_null($lastDocument->Phase_II_B_HOD_Review_Complete_By) || $lastDocument->Phase_II_B_HOD_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getQAUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 19) {
                if (!$changestage->QA_Head_remark5) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Phase II B CQA/QA Remark is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "20";
                $changestage->status = "P-II B CQAH/QAH Review";
                $changestage->Phase_II_B_QA_Review_Complete_By= Auth::user()->name;
                $changestage->Phase_II_B_QA_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_B_QA_Review_Complete_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Phase II B QA Review Complete By    ,   Phase II B QA Review Complete On';
                    if (is_null($lastDocument->Phase_II_B_QA_Review_Complete_By) || $lastDocument->Phase_II_B_QA_Review_Complete_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Phase_II_B_QA_Review_Complete_By . ' , ' . $lastDocument->Phase_II_B_QA_Review_Complete_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase II B QA Review Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-II B QAH/CQAH Review";
                    $history->current = $changestage->Phase_II_B_QA_Review_Complete_By . ' , ' . $changestage->Phase_II_B_QA_Review_Complete_On;
                    if (is_null($lastDocument->Phase_II_B_QA_Review_Complete_By) || $lastDocument->Phase_II_B_QA_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getQAHeadUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                   
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 20) {
                if (!$changestage->reopen_approval_comments_uaa) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Approval Comments is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "21";
                $changestage->status = "Closed - Done";
                $changestage->P_II_B_Assignable_Cause_Not_Found_By= Auth::user()->name;
                $changestage->P_II_B_Assignable_Cause_Not_Found_On = Carbon::now()->format('d-M-Y');
                $changestage->P_II_B_Assignable_Cause_Not_Found_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'P II B Assignable Cause Not Found By    ,   P II B Assignable Cause Not Found On';
                    if (is_null($lastDocument->P_II_B_Assignable_Cause_Not_Found_By) || $lastDocument->P_II_B_Assignable_Cause_Not_Found_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->P_II_B_Assignable_Cause_Not_Found_By . ' , ' . $lastDocument->P_II_B_Assignable_Cause_Not_Found_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'P II B Assignable Cause Not Found';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   " Closed - Done";
                    $history->current = $changestage->P_II_B_Assignable_Cause_Not_Found_By . ' , ' . $changestage->P_II_B_Assignable_Cause_Not_Found_On;
                    if (is_null($lastDocument->P_II_B_Assignable_Cause_Not_Found_By) || $lastDocument->P_II_B_Assignable_Cause_Not_Found_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getQAUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }

                    // $list = Helpers::getInitiatorUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getHodUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 21) {
                $changestage->stage = "22";
                $changestage->status = "Closed - Done";
                $changestage->P_III_Investigation_Applicable_By = Auth::user()->name;
                $changestage->P_III_Investigation_Applicable_On = Carbon::now()->format('d-M-Y');
                $changestage->P_III_Investigation_Applicable_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Closed - Done By    ,   Closed - Done On';
                    if (is_null($lastDocument->P_III_Investigation_Applicable_By) || $lastDocument->P_III_Investigation_Applicable_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->P_III_Investigation_Applicable_By . ' , ' . $lastDocument->P_III_Investigation_Applicable_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'P III Investigation Applicable';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Closed - Done";
                    $history->current = $changestage->P_III_Investigation_Applicable_By . ' , ' . $changestage->P_III_Investigation_Applicable_On;
                    if (is_null($lastDocument->P_III_Investigation_Applicable_By) || $lastDocument->P_III_Investigation_Applicable_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            // --------------------------------------------------------------------------------------------------------------
            
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
                    $history->activity_type = 'More Information Required By    ,  More Information Required On';
                    if (is_null($lastDocument->more_info_requiered1_By) || $lastDocument->more_info_requiered1_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_requiered1_By . ' , ' . $lastDocument->more_info_requiered1_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'More Information Required';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Opened";
                    $history->current = $changestage->more_info_requiered1_By . ' , ' . $changestage->more_info_requiered1_On;
                    if (is_null($lastDocument->more_info_requiered1_By) || $lastDocument->more_info_requiered1_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getInitiatorUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    
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
                    $history->activity_type = 'More Information Required By    ,  More Information Required On';
                    if (is_null($lastDocument->more_info_requiered2_By) || $lastDocument->more_info_requiered2_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_requiered2_By . ' , ' . $lastDocument->more_info_requiered2_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'More Information Required';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "HOD Primary Review";
                    $history->current = $changestage->more_info_requiered2_By . ' , ' . $changestage->more_info_requiered2_On;
                    if (is_null($lastDocument->more_info_requiered2_By) || $lastDocument->more_info_requiered2_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getHodUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                   
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
                    $history->activity_type = 'Request More Info By    ,  Request More Info On';
                    if (is_null($lastDocument->Request_More_Info3_By) || $lastDocument->Request_More_Info3_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Request_More_Info3_By . ' , ' . $lastDocument->Request_More_Info3_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "CQA/QA Head Primary Review";
                    $history->current = $changestage->Request_More_Info3_By . ' , ' . $changestage->Request_More_Info3_On;
                    if (is_null($lastDocument->Request_More_Info3_By) || $lastDocument->Request_More_Info3_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getQAUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
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
                    $history->activity_type = 'More Information Required By    ,  More Information Required On';
                    if (is_null($lastDocument->more_info_requiered4_By) || $lastDocument->more_info_requiered4_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_requiered4_By . ' , ' . $lastDocument->more_info_requiered4_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'More Information Required';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase-IA Investigation";
                    $history->current = $changestage->more_info_requiered4_By . ' , ' . $changestage->more_info_requiered4_On;
                    if (is_null($lastDocument->more_info_requiered4_By) || $lastDocument->more_info_requiered4_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getInitiatorUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
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
                    $history->activity_type = 'More Information Required By    ,  More Information Required On';
                    if (is_null($lastDocument->more_info_requiered5_By) || $lastDocument->more_info_requiered5_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_requiered5_By . ' , ' . $lastDocument->more_info_requiered5_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'More Information Required';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IA HOD Primary Review";
                    $history->current = $changestage->more_info_requiered5_By . ' , ' . $changestage->more_info_requiered5_On;
                    if (is_null($lastDocument->more_info_requiered5_By) || $lastDocument->more_info_requiered5_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getHodUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                   
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
                    $history->activity_type = 'Request More Info By    ,  Request More Info On';
                    if (is_null($lastDocument->Request_More_Info6_By) || $lastDocument->Request_More_Info6_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Request_More_Info6_By . ' , ' . $lastDocument->Request_More_Info6_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IA QA Review";
                    $history->current = $changestage->Request_More_Info6_By . ' , ' . $changestage->Request_More_Info6_On;
                    if (is_null($lastDocument->Request_More_Info6_By) || $lastDocument->Request_More_Info6_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                   
                    // $list = Helpers::getQAUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                   
                   
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
                    $history->activity_type = 'More Information Required By    ,  More Information Required On';
                    if (is_null($lastDocument->more_info_requiered7_By) || $lastDocument->more_info_requiered7_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_requiered7_By . ' , ' . $lastDocument->more_info_requiered7_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'More Information Required';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-IA CQAH/QAH Review";
                    $history->current = $changestage->more_info_requiered7_By . ' , ' . $changestage->more_info_requiered7_On;
                    if (is_null($lastDocument->more_info_requiered7_By) || $lastDocument->more_info_requiered7_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getQAHeadUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                   
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
                    $history->activity_type = 'More Information Required By    ,  More Information Required On';
                    if (is_null($lastDocument->more_info_requiered8_By) || $lastDocument->more_info_requiered8_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_requiered8_By . ' , ' . $lastDocument->more_info_requiered8_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'More Information Required';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase-IB Investigation";
                    $history->current = $changestage->more_info_requiered8_By . ' , ' . $changestage->more_info_requiered8_On;
                    if (is_null($lastDocument->more_info_requiered8_By) || $lastDocument->more_info_requiered8_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getInitiatorUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                  
                   
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
                    $history->activity_type = 'More Information Required By    ,  More Information Required On';
                    if (is_null($lastDocument->more_info_requiered9_By) || $lastDocument->more_info_requiered9_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_requiered9_By . ' , ' . $lastDocument->more_info_requiered9_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'More Information Required';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IB HOD Primary Review";
                    $history->current = $changestage->more_info_requiered9_By . ' , ' . $changestage->more_info_requiered9_On;
                    if (is_null($lastDocument->more_info_requiered9_By) || $lastDocument->more_info_requiered9_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getInitiatorUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                   
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 12) {
                $changestage->stage = "11";
                $changestage->status = "Phase IB QA Review";
                $changestage->Request_More_Info10_By= Auth::user()->name;
                $changestage->Request_More_Info10_On = Carbon::now()->format('d-M-Y');
                $changestage->Request_More_Info10_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                    $history->activity_type = 'Request More Info By    ,  Request More Info On';
                    if (is_null($lastDocument->Request_More_Info10_By) || $lastDocument->Request_More_Info10_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Request_More_Info10_By . ' , ' . $lastDocument->Request_More_Info10_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IB QA Review";
                    $history->current = $changestage->Request_More_Info10_By . ' , ' . $changestage->Request_More_Info10_On;
                    if (is_null($lastDocument->Request_More_Info10_By) || $lastDocument->Request_More_Info10_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getHodUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                  
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
                    $history->activity_type = 'More Information Required By    ,  More Information Required On';
                    if (is_null($lastDocument->more_info_requiered11_By) || $lastDocument->more_info_requiered11_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_requiered11_By . ' , ' . $lastDocument->more_info_requiered11_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'More Information Required';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-IB CQAH/QAH Review";
                    $history->current = $changestage->more_info_requiered11_By . ' , ' . $changestage->more_info_requiered11_On;
                    if (is_null($lastDocument->more_info_requiered11_By) || $lastDocument->more_info_requiered11_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getQAUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
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
                    $history->activity_type = 'More Information Required By    ,  More Information Required On';
                    if (is_null($lastDocument->more_info_requiered12_By) || $lastDocument->more_info_requiered12_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_requiered12_By . ' , ' . $lastDocument->more_info_requiered12_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'More Information Required';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase-II A Investigation";
                    $history->current = $changestage->more_info_requiered12_By . ' , ' . $changestage->more_info_requiered12_On;
                    if (is_null($lastDocument->more_info_requiered12_By) || $lastDocument->more_info_requiered12_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
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
                    $history->activity_type = 'More Information Required By    ,  More Information Required On';
                    if (is_null($lastDocument->more_info_requiered13_By) || $lastDocument->more_info_requiered13_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_requiered13_By . ' , ' . $lastDocument->more_info_requiered13_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'More Information Required';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase II A HOD Primary Review";
                    $history->current = $changestage->more_info_requiered13_By . ' , ' . $changestage->more_info_requiered13_On;
                    if (is_null($lastDocument->more_info_requiered13_By) || $lastDocument->more_info_requiered13_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getProductionUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    
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
                    $history->activity_type = 'Request More Info By    ,  Request More Info On';
                    if (is_null($lastDocument->more_info_requiered14_By) || $lastDocument->more_info_requiered14_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_requiered14_By . ' , ' . $lastDocument->more_info_requiered14_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase II A QA Review";
                    $history->current = $changestage->more_info_requiered14_By . ' , ' . $changestage->more_info_requiered14_On;
                    if (is_null($lastDocument->more_info_requiered14_By) || $lastDocument->more_info_requiered14_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getQAUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
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
                    $history->activity_type = 'More Information Required By    ,  More Information Required On';
                    if (is_null($lastDocument->Request_More_Info15_By) || $lastDocument->Request_More_Info15_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Request_More_Info15_By . ' , ' . $lastDocument->Request_More_Info15_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'More Information Required';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-II A QAH/CQAH Review";
                    $history->current = $changestage->Request_More_Info15_By . ' , ' . $changestage->Request_More_Info15_On;
                    if (is_null($lastDocument->Request_More_Info15_By) || $lastDocument->Request_More_Info15_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getQAHeadUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    
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
                    $history->activity_type = 'More Information Required By    ,  More Information Required On';
                    if (is_null($lastDocument->more_info_requiered16_By) || $lastDocument->more_info_requiered16_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_requiered16_By . ' , ' . $lastDocument->more_info_requiered16_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'More Information Required';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase-II B Investigation";
                    $history->current = $changestage->more_info_requiered16_By . ' , ' . $changestage->more_info_requiered16_On;
                    if (is_null($lastDocument->more_info_requiered16_By) || $lastDocument->more_info_requiered16_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getInitiatorUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    
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
                     $history->activity_type = 'More Information Required By    ,  More Information Required On';
                    if (is_null($lastDocument->more_info_requiered17_By) || $lastDocument->more_info_requiered17_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_requiered17_By . ' , ' . $lastDocument->more_info_requiered17_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'More Information Required';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase II B HOD Primary Review";
                    $history->current = $changestage->more_info_requiered17_By . ' , ' . $changestage->more_info_requiered17_On;
                    if (is_null($lastDocument->more_info_requiered17_By) || $lastDocument->more_info_requiered17_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getHodUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                   
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
                     $history->activity_type = 'More Information Required By    ,  More Information Required On';
                    if (is_null($lastDocument->more_info_requiered18_By) || $lastDocument->more_info_requiered18_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->more_info_requiered18_By . ' , ' . $lastDocument->more_info_requiered18_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'More Information Required';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase II B QA Review";
                    $history->current = $changestage->more_info_requiered18_By . ' , ' . $changestage->more_info_requiered18_On;
                    if (is_null($lastDocument->more_info_requiered18_By) || $lastDocument->more_info_requiered18_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getCQAUsersList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                    // $list = Helpers::getQAUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                
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
                     $history->activity_type = 'Request More Info By    ,  Request More Info On';
                    if (is_null($lastDocument->Request_More_Info19_By) || $lastDocument->Request_More_Info19_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Request_More_Info19_By . ' , ' . $lastDocument->Request_More_Info19_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-II B QAH/CQAH Review";
                    $history->current = $changestage->Request_More_Info19_By . ' , ' . $changestage->Request_More_Info19_On;
                    if (is_null($lastDocument->Request_More_Info19_By) || $lastDocument->Request_More_Info19_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            // -------------------------------------------------------------------------------------------------------------
           
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
                // if (!$changestage->QA_Head_remark1) {
                //     // Flash message for warning (field not filled)
                //     Session::flash('swal', [
                //         'title' => 'Mandatory Fields Required!',
                //         'message' => 'CQA/QA Head Remark is yet to be filled!',
                //         'type' => 'warning',  // Type can be success, error, warning, info, etc.
                //     ]);
            
                //     return redirect()->back();
                // } else {
                //     // Flash message for success (when the form is filled correctly)
                //     Session::flash('swal', [
                //         'title' => 'Success!',
                //         'message' => 'Sent for Next Stage',
                //         'type' => 'success',
                //     ]);
                // }
                $changestage->stage = "3";
                $changestage->status = "QA Head Approval";
                $changestage->Opened_to_QA_Head_Approval_By= Auth::user()->name;
                $changestage->Opened_to_QA_Head_Approval_On  = Carbon::now()->format('d-M-Y');
                $changestage->Opened_to_QA_Head_Approval_Comment = $request->comment;
                            $history = new OosAuditTrial();
                            $history->oos_id = $id;
                              $history->activity_type = 'QA Head Approval By    ,  QA Head Approval On';
                            if (is_null($lastDocument->Opened_to_QA_Head_Approval_By) || $lastDocument->Opened_to_QA_Head_Approval_By === '') {
                                $history->previous = "Null";
                            } else {
                                $history->previous = $lastDocument->Opened_to_QA_Head_Approval_By . ' , ' . $lastDocument->Opened_to_QA_Head_Approval_On;
                            }
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->action = 'QA Head Approval';
                            $history->change_from = $lastDocument->status;
                            $history->change_to =   "QA Head Approval";
                            $history->current = $changestage->Opened_to_QA_Head_Approval_By . ' , ' . $changestage->Opened_to_QA_Head_Approval_On;
                            if (is_null($lastDocument->Opened_to_QA_Head_Approval_By) || $lastDocument->Opened_to_QA_Head_Approval_By === '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                            $history->save();
                    //         $list = Helpers::getQAUserList($changestage->division_id);
                    //         foreach ($list as $u) {
                    //            $email = Helpers::getUserEmail($u->user_id);
                    //                if ($email !== null) {
                    //                Mail::send(
                    //                    'mail.view-mail',
                    //                    ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //                    function ($message) use ($email, $changestage) {
                    //                        $message->to($email)
                    //                        ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //                    }
                    //                );
                    //            }
                    //         }
                    //         $list = Helpers::getQAHeadUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 2) {
                // if (!$changestage->QA_Head_remark1) {
                //     // Flash message for warning (field not filled)
                //     Session::flash('swal', [
                //         'title' => 'Mandatory Fields Required!',
                //         'message' => 'CQA/QA Head Remark is yet to be filled!',
                //         'type' => 'warning',  // Type can be success, error, warning, info, etc.
                //     ]);
            
                //     return redirect()->back();
                // } else {
                //     // Flash message for success (when the form is filled correctly)
                //     Session::flash('swal', [
                //         'title' => 'Success!',
                //         'message' => 'Sent for Next Stage',
                //         'type' => 'success',
                //     ]);
                // }
                $changestage->stage = "3";
                $changestage->status = "QA Head Approval";
                $changestage->QA_Head_Approval_By= Auth::user()->name;
                $changestage->QA_Head_Approval_On  = Carbon::now()->format('d-M-Y');
                $changestage->QA_Head_Approval_Comment = $request->comment;
                            $history = new OosAuditTrial();
                            $history->oos_id = $id;
                              $history->activity_type = 'QA Head Approval By    ,  QA Head Approval On';
                    if (is_null($lastDocument->QA_Head_Approval_By) || $lastDocument->QA_Head_Approval_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->QA_Head_Approval_By . ' , ' . $lastDocument->QA_Head_Approval_On;
                    }
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->action = 'QA Head Approval';
                            $history->change_from = $lastDocument->status;
                            $history->change_to =   "QA Head Approval";
                            $history->current = $changestage->QA_Head_Approval_By . ' , ' . $changestage->QA_Head_Approval_On;
                            if (is_null($lastDocument->QA_Head_Approval_By) || $lastDocument->QA_Head_Approval_By === '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                            $history->save();
                            // $list = Helpers::getQAUserList($changestage->division_id);
                            // foreach ($list as $u) {
                            //    $email = Helpers::getUserEmail($u->user_id);
                            //        if ($email !== null) {
                            //        Mail::send(
                            //            'mail.view-mail',
                            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                            //            function ($message) use ($email, $changestage) {
                            //                $message->to($email)
                            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                            //            }
                            //        );
                            //    }
                            // }
                            // $list = Helpers::getQAHeadUserList($changestage->division_id);
                            //     foreach ($list as $u) {
                            //     $email = Helpers::getUserEmail($u->user_id);
                            //         if ($email !== null) {
                            //         Mail::send(
                            //             'mail.view-mail',
                            //             ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                            //             function ($message) use ($email, $changestage) {
                            //                 $message->to($email)
                            //                 ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                            //             }
                            //         );
                            //     }
                            //     }
                           
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 4) {
                if (!$changestage->QA_Head_primary_remark1) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'CQA/QA Head Remark is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "5";
                $changestage->status = "Under Phase-IA Investigation";
                $changestage->CQA_Head_Primary_Review_Complete_By= Auth::user()->name;
                $changestage->CQA_Head_Primary_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->CQA_Head_Primary_Review_Complete_Comment = $request->comment;
                            $history = new OosAuditTrial();
                            $history->oos_id = $id;
                              $history->activity_type = 'CQA Head Primary Review Complete By    ,  CQA Head Primary Review Complete On';
                    if (is_null($lastDocument->CQA_Head_Primary_Review_Complete_By) || $lastDocument->CQA_Head_Primary_Review_Complete_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->CQA_Head_Primary_Review_Complete_By . ' , ' . $lastDocument->CQA_Head_Primary_Review_Complete_On;
                    }
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->action = 'CQA Head Primary Review Complete';
                            $history->change_from = $lastDocument->status;
                            $history->change_to =   "Under Phase-IA Investigation";
                            $history->current = $changestage->CQA_Head_Primary_Review_Complete_By . ' , ' . $changestage->CQA_Head_Primary_Review_Complete_On;
                            if (is_null($lastDocument->CQA_Head_Primary_Review_Complete_By) || $lastDocument->CQA_Head_Primary_Review_Complete_By === '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                            $history->save();
                            // $list = Helpers::getQAUserList($changestage->division_id);
                            // foreach ($list as $u) {
                            //    $email = Helpers::getUserEmail($u->user_id);
                            //        if ($email !== null) {
                            //        Mail::send(
                            //            'mail.view-mail',
                            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                            //            function ($message) use ($email, $changestage) {
                            //                $message->to($email)
                            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                            //            }
                            //        );
                            //    }
                            // }
                            // $list = Helpers::getCQAUsersList($changestage->division_id);
                            // foreach ($list as $u) {
                            //    $email = Helpers::getUserEmail($u->user_id);
                            //        if ($email !== null) {
                            //        Mail::send(
                            //            'mail.view-mail',
                            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                            //            function ($message) use ($email, $changestage) {
                            //                $message->to($email)
                            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                            //            }
                            //        );
                            //    }
                            // }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 5) {
                if (!$changestage->Comments_plidata) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Comment is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "6";
                $changestage->status = "Phase IA HOD Primary Review";
                $changestage->Phase_IA_Investigation_By= Auth::user()->name;
                $changestage->Phase_IA_Investiigation_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IA_Investigation_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                      $history->activity_type = 'Phase IA Investigation By    , Phase IA Investigation On';
                    if (is_null($lastDocument->Phase_IA_Investigation_By) || $lastDocument->Phase_IA_Investigation_By === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->Phase_IA_Investigation_By . ' , ' . $lastDocument->Phase_IA_Investiigation_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase IA Investigation';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase IA HOD Primary Review";
                    $history->current = $changestage->Phase_IA_Investigation_By . ' , ' . $changestage->Phase_IA_Investiigation_On;
                    if (is_null($lastDocument->Phase_IA_Investigation_By) || $lastDocument->Phase_IA_Investigation_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getInitiatorUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
           
            if ($changestage->stage == 8) {
                if (!$changestage->QA_Head_primary_remark2) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'P-IA CQAH/QAH Primary Remark is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);
            
                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Next Stage',
                        'type' => 'success',
                    ]);
                }
                $changestage->stage = "9";
                $changestage->status = "Under Phase-IB Investigation";
                $changestage->Assignable_Cause_Not_Found_By= Auth::user()->name;
                $changestage->Assignable_Cause_Not_Found_On = Carbon::now()->format('d-M-Y');
                $changestage->Assignable_Cause_Not_Found_Comment = $request->comment;
                    $history = new OosAuditTrial();
                    $history->oos_id = $id;
                      $history->activity_type = 'Assignable Cause Not Found By    ,  Assignable Cause Not Found On';
                    if (is_null($lastDocument->Assignable_Cause_Not_Found_By) || $lastDocument->Assignable_Cause_Not_Found_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Assignable_Cause_Not_Found_By . ' , ' . $lastDocument->Assignable_Cause_Not_Found_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Assignable Cause Not Found';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase-IB Investigation";
                    $history->current = $changestage->Assignable_Cause_Not_Found_By . ' , ' . $changestage->Assignable_Cause_Not_Found_On;
                    if (is_null($lastDocument->Assignable_Cause_Not_Found_By) || $lastDocument->Assignable_Cause_Not_Found_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    // $list = Helpers::getInitiatorUserList($changestage->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getUserEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changestage) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }
                   
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
                      $history->activity_type = 'Phase II A Investigation By    ,  Phase II A Investigation On';
                    if (is_null($lastDocument->Phase_II_A_Investigation_By) || $lastDocument->Phase_II_A_Investigation_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->Phase_II_A_Investigation_By . ' , ' . $lastDocument->Phase_II_A_Investigation_On;
                    }
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase II A Investigation';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Phase II A HOD Primary Review";
                    $history->current = $changestage->Phase_II_A_Investigation_By . ' , ' . $changestage->Phase_II_A_Investigation_On;
                    if (is_null($lastDocument->Phase_II_A_Investigation_By) || $lastDocument->Phase_II_A_Investigation_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
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
                      $history->activity_type = 'Cancel By    ,  Cancel On';
                    if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->cancelled_by . ' , ' . $lastDocument->cancelled_on;
                    }
                    $history->previous ="";
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state =  $data->status;
                    $history->action = 'Cancel';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Closed-Cancelled";
                    $history->current = $data->cancelled_by . ' , ' . $data->cancelled_on;
                    if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
            $data->update();
            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function Done_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $data = OOS::find($id);
            $changestage = OOS::find($id);
            $lastDocument = OOS::find($id);
            $data->stage = "23";
            $data->status = "Closed-Done";
            $data->Assignable_Cause_Found_By = Auth::user()->name;
            $data->Assignable_Cause_Found_On = Carbon::now()->format('d-M-Y');
            $data->Assignable_Cause_Found_Comment = $request->comment;

            $history = new OosAuditTrial();
            $history->oos_id = $id;
            $history->activity_type = 'Assignable Cause Found By    ,   Assignable Cause Found On';
            if (is_null($lastDocument->Assignable_Cause_Found_By) || $lastDocument->Assignable_Cause_Found_By === '') {
                $history->previous = "Null";
            } else {
                $history->previous = $lastDocument->Assignable_Cause_Found_By . ' , ' . $lastDocument->Assignable_Cause_Found_On;
            }
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->action = 'Assignable Cause Found';
            $history->change_from = $lastDocument->status;
            $history->change_to =   "Closed - Done";
            $history->current = $changestage->Assignable_Cause_Found_By . ' , ' . $changestage->Assignable_Cause_Found_On;
            if (is_null($lastDocument->Assignable_Cause_Found_By) || $lastDocument->Assignable_Cause_Found_By === '') {
                $history->action_name = 'New';
            } else {
                $history->action_name = 'Update';
            }
            $history->save();
            // $list = Helpers::getQAUserList($changestage->division_id);
            // foreach ($list as $u) {
            //    $email = Helpers::getUserEmail($u->user_id);
            //        if ($email !== null) {
            //        Mail::send(
            //            'mail.view-mail',
            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //            function ($message) use ($email, $changestage) {
            //                $message->to($email)
            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
            //            }
            //        );
            //    }
            // }
            // $list = Helpers::getCQAUsersList($changestage->division_id);
            // foreach ($list as $u) {
            //    $email = Helpers::getUserEmail($u->user_id);
            //        if ($email !== null) {
            //        Mail::send(
            //            'mail.view-mail',
            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //            function ($message) use ($email, $changestage) {
            //                $message->to($email)
            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
            //            }
            //        );
            //    }
            // }
            // $list = Helpers::getInitiatorUserList($changestage->division_id);
            // foreach ($list as $u) {
            //    $email = Helpers::getUserEmail($u->user_id);
            //        if ($email !== null) {
            //        Mail::send(
            //            'mail.view-mail',
            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //            function ($message) use ($email, $changestage) {
            //                $message->to($email)
            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
            //            }
            //        );
            //    }
            // }
            // $list = Helpers::getHodUserList($changestage->division_id);
            // foreach ($list as $u) {
            //    $email = Helpers::getUserEmail($u->user_id);
            //        if ($email !== null) {
            //        Mail::send(
            //            'mail.view-mail',
            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //            function ($message) use ($email, $changestage) {
            //                $message->to($email)
            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
            //            }
            //        );
            //    }
            // }
          
            $data->update();
            toastr()->success('Document Sent');
            return back();
        }
    }

    public function Done_One_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $data = OOS::find($id);
            $changestage = OOS::find($id);
            $lastDocument = OOS::find($id);
            $data->stage = "24";
            $data->status = "Closed-Done";
            $data->P_I_B_Assignable_Cause_Found_By = Auth::user()->name;
            $data->P_I_B_Assignable_Cause_Found_On = Carbon::now()->format('d-M-Y');
            $data->P_I_B_Assignable_Cause_Found_Comment = $request->comment;

            $history = new OosAuditTrial();
            $history->oos_id = $id;
            $history->activity_type = 'P-IB Assignable Cause Found By    ,   P-IB Assignable Cause Found On';
            if (is_null($lastDocument->P_I_B_Assignable_Cause_Found_By) || $lastDocument->P_I_B_Assignable_Cause_Found_By === '') {
                $history->previous = "Null";
            } else {
                $history->previous = $lastDocument->P_I_B_Assignable_Cause_Found_By . ' , ' . $lastDocument->P_I_B_Assignable_Cause_Found_On;
            }
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->action = 'P-IB Assignable Cause Found';
            $history->change_from = $lastDocument->status;
            $history->change_to =   "Closed - Done";
            $history->current = $changestage->P_I_B_Assignable_Cause_Found_By . ' , ' . $changestage->P_I_B_Assignable_Cause_Found_On;
            if (is_null($lastDocument->P_I_B_Assignable_Cause_Found_By) || $lastDocument->P_I_B_Assignable_Cause_Found_By === '') {
                $history->action_name = 'New';
            } else {
                $history->action_name = 'Update';
            }
            $history->save();
            // $list = Helpers::getQAUserList($changestage->division_id);
            // foreach ($list as $u) {
            //    $email = Helpers::getUserEmail($u->user_id);
            //        if ($email !== null) {
            //        Mail::send(
            //            'mail.view-mail',
            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //            function ($message) use ($email, $changestage) {
            //                $message->to($email)
            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
            //            }
            //        );
            //    }
            // }
            // $list = Helpers::getCQAUsersList($changestage->division_id);
            // foreach ($list as $u) {
            //    $email = Helpers::getUserEmail($u->user_id);
            //        if ($email !== null) {
            //        Mail::send(
            //            'mail.view-mail',
            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //            function ($message) use ($email, $changestage) {
            //                $message->to($email)
            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
            //            }
            //        );
            //    }
            // }
            // $list = Helpers::getInitiatorUserList($changestage->division_id);
            // foreach ($list as $u) {
            //    $email = Helpers::getUserEmail($u->user_id);
            //        if ($email !== null) {
            //        Mail::send(
            //            'mail.view-mail',
            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //            function ($message) use ($email, $changestage) {
            //                $message->to($email)
            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
            //            }
            //        );
            //    }
            // }
            // $list = Helpers::getHodUserList($changestage->division_id);
            // foreach ($list as $u) {
            //    $email = Helpers::getUserEmail($u->user_id);
            //        if ($email !== null) {
            //        Mail::send(
            //            'mail.view-mail',
            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //            function ($message) use ($email, $changestage) {
            //                $message->to($email)
            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
            //            }
            //        );
            //    }
            // }
          
            $data->update();
            toastr()->success('Document Sent');
            return back();
        }
    }

    public function Done_Two_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $data = OOS::find($id);
            $changestage = OOS::find($id);
            $lastDocument = OOS::find($id);
            $data->stage = "25";
            $data->status = "Closed-Done";
            $data->P_II_A_Assignable_Cause_Found_By = Auth::user()->name;
            $data->P_II_A_Assignable_Cause_Found_On = Carbon::now()->format('d-M-Y');
            $data->P_II_A_Assignable_Cause_Found_Comment = $request->comment;

            $history = new OosAuditTrial();
            $history->oos_id = $id;
            $history->activity_type = 'P-II A Assignable Cause Found By    ,   P-II A Assignable Cause Found On';
            if (is_null($lastDocument->P_II_A_Assignable_Cause_Found_By) || $lastDocument->P_II_A_Assignable_Cause_Found_By === '') {
                $history->previous = "Null";
            } else {
                $history->previous = $lastDocument->P_II_A_Assignable_Cause_Found_By . ' , ' . $lastDocument->P_II_A_Assignable_Cause_Found_On;
            }
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->action = 'P-II A Assignable Cause Found';
            $history->change_from = $lastDocument->status;
            $history->change_to =   "Closed - Done";
            $history->current = $changestage->P_II_A_Assignable_Cause_Found_By . ' , ' . $changestage->P_II_A_Assignable_Cause_Found_On;
            if (is_null($lastDocument->P_II_A_Assignable_Cause_Found_By) || $lastDocument->P_II_A_Assignable_Cause_Found_By === '') {
                $history->action_name = 'New';
            } else {
                $history->action_name = 'Update';
            }
            $history->save();
            // $list = Helpers::getQAUserList($changestage->division_id);
            // foreach ($list as $u) {
            //    $email = Helpers::getUserEmail($u->user_id);
            //        if ($email !== null) {
            //        Mail::send(
            //            'mail.view-mail',
            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //            function ($message) use ($email, $changestage) {
            //                $message->to($email)
            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
            //            }
            //        );
            //    }
            // }
            // $list = Helpers::getCQAUsersList($changestage->division_id);
            // foreach ($list as $u) {
            //    $email = Helpers::getUserEmail($u->user_id);
            //        if ($email !== null) {
            //        Mail::send(
            //            'mail.view-mail',
            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //            function ($message) use ($email, $changestage) {
            //                $message->to($email)
            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
            //            }
            //        );
            //    }
            // }
            // $list = Helpers::getInitiatorUserList($changestage->division_id);
            // foreach ($list as $u) {
            //    $email = Helpers::getUserEmail($u->user_id);
            //        if ($email !== null) {
            //        Mail::send(
            //            'mail.view-mail',
            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //            function ($message) use ($email, $changestage) {
            //                $message->to($email)
            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
            //            }
            //        );
            //    }
            // }
            // $list = Helpers::getHodUserList($changestage->division_id);
            // foreach ($list as $u) {
            //    $email = Helpers::getUserEmail($u->user_id);
            //        if ($email !== null) {
            //        Mail::send(
            //            'mail.view-mail',
            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //            function ($message) use ($email, $changestage) {
            //                $message->to($email)
            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
            //            }
            //        );
            //    }
            // }
            // $list = Helpers::getProductionUserList($changestage->division_id);
            // foreach ($list as $u) {
            //    $email = Helpers::getUserEmail($u->user_id);
            //        if ($email !== null) {
            //        Mail::send(
            //            'mail.view-mail',
            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //            function ($message) use ($email, $changestage) {
            //                $message->to($email)
            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
            //            }
            //        );
            //    }
            // }
            // $list = Helpers::getProductionHeadUserList($changestage->division_id);
            // foreach ($list as $u) {
            //    $email = Helpers::getUserEmail($u->user_id);
            //        if ($email !== null) {
            //        Mail::send(
            //            'mail.view-mail',
            //            ['data' => $changestage, 'site' => "OOS/OOT", 'history' => "Review", 'process' => 'OOS/OOT', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //            function ($message) use ($email, $changestage) {
            //                $message->to($email)
            //                ->subject("Agio Notification: OOS/OOT, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
            //            }
            //        );
            //    }
            // }
            $data->update();
            toastr()->success('Document Sent');
            return back();
        }
    }
    public function child(Request $request, $id)
    {
        $cft = [];
        $parent_id = $id;
        $parent_type = "OOS Chemical";
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
            // $p_record = RootCauseAnalysis::find($id);
            $data_record = Helpers::getDivisionName($actionchild->division_id ) . '/' . 'OOS/OOT' .'/' . date('Y') .'/' . str_pad($actionchild->record, 4, '0', STR_PAD_LEFT);    
            $parentRecord = OOS::where('id', $id)->value('record');
            $actionchild->actionchild = $record_number;
            $parent_id = $id;
            $actionchild->save();

            return view('frontend.action-item.action-item', compact('parentRecord','parent_short_description','old_records','record_number', 'data_record', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'record', 'due_date', 'parent_id', 'parent_type'));
        }
        elseif ($request->child_type == "Resampling")
         {
            $parent_name = "CAPA";
            $actionchild = OOS::find($id);
            $actionchild->actionchild = $record_number;
            $relatedRecords = Helpers::getAllRelatedRecords();
            $parent_id = $id;
            $actionchild->save();

            return view('frontend.resampling.resapling_create', compact('relatedRecords','parent_short_description','old_records','record_number', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'record', 'due_date', 'parent_id', 'parent_type'));
        }
        elseif ($request->child_type == "Extension")
        {
           $parent_name = "CAPA";
           $actionchild = OOS::find($id);
           $actionchild->actionchild = $record_number;
           $parent_id = $id;
           $relatedRecords = Helpers::getAllRelatedRecords();
           $data=OOS::find($id);
           $extension_record = Helpers::getDivisionName($data->division_id ) . '/' . 'OOS/OOT' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);

           $actionchild->save();

           return view('frontend.extension.extension_new', compact('relatedRecords','extension_record', 'parent_short_description','old_records','record_number', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'record', 'due_date', 'parent_id', 'parent_type'));
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
        $users = User::all();
        return view('frontend.OOS.comps.audit-trial', compact('audit', 'document', 'today','users'));
    }

//     public function audit_trail_filter(Request $request, $id)
// {
//     // Start query for OosAuditTrial
//     $query = OosAuditTrial::query();
//     $query->where('deviation_id', $id);

//     // Check if typedata is provided
//     if ($request->filled('typedata')) {
//         switch ($request->typedata) {
//             case 'cft_review':
//                 // Filter by specific CFT review actions
//                 $cft_field = [];
//                 $query->whereIn('action', $cft_field);
//                 break;

//             case 'stage':
//                 // Filter by activity log stage changes
//                 $stage=[  'Submit', 'HOD Review Complete', 'QA/CQA Initial Review Complete','Request For Cancellation',
//                     'CFT Review Complete', 'QA/CQA Final Assessment Complete', 'Approved','Send to Initiator','Send to HOD','Send to QA/CQA Initial Review','Send to Pending Initiator Update',
//                     'QA/CQA Final Review Complete', 'Rejected', 'Initiator Updated Complete',
//                     'HOD Final Review Complete', 'More Info Required', 'Cancel','Implementation verification Complete','Closure Approved'];
//                 $query->whereIn('action', $stage); // Ensure correct activity_type value
//                 break;

//             case 'user_action':
//                 // Filter by various user actions
//                 $user_action = [  'Submit', 'HOD Review Complete', 'QA/CQA Initial Review Complete','Request For Cancellation',
//                     'CFT Review Complete', 'QA/CQA Final Assessment Complete', 'Approved','Send to Initiator','Send to HOD','Send to QA/CQA Initial Review','Send to Pending Initiator Update',
//                     'QA/CQA Final Review Complete', 'Rejected', 'Initiator Updated Complete',
//                     'HOD Final Review Complete', 'More Info Required', 'Cancel','Implementation verification Complete','Closure Approved'];
//                 $query->whereIn('action', $user_action);
//                 break;
//                  case 'notification':
//                 // Filter by various user actions
//                 $notification = [];
//                 $query->whereIn('action', $notification);
//                 break;
//                  case 'business':
//                 // Filter by various user actions
//                 $business = [];
//                 $query->whereIn('action', $business);
//                 break;

//             default:
//                 break;
//         }
//     }

//     // Apply additional filters
//     if ($request->filled('user')) {
//         $query->where('user_id', $request->user);
//     }

//     if ($request->filled('from_date')) {
//         $query->whereDate('created_at', '>=', $request->from_date);
//     }

//     if ($request->filled('to_date')) {
//         $query->whereDate('created_at', '<=', $request->to_date);
//     }

//     // Get the filtered results
//     $audit = $query->orderByDesc('id')->get();

//     // Flag for filter request
//     $filter_request = true;

//     // Render the filtered view and return as JSON
//     $responseHtml = view('frontend.rcms.OOS.OOS_filter', compact('audit', 'filter_request'))->render();

//     return response()->json(['html' => $responseHtml]);
// }

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
            $record_number = ((RecordNumber::first()->value('counter')) + 1);
            $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            $data->info_product_materials = $data->grids()->where('identifier', 'info_product_material')->first();
            $data->details_stabilities = $data->grids()->where('identifier', 'details_stability')->first();
            $data->oos_details = $data->grids()->where('identifier', 'oos_detail')->first();
            $products_details = $data->grids()->where('identifier', 'products_details')->first();
            $instrument_details = $data->grids()->where('identifier', 'instrument_detail')->first();
            $phase_two_invss = $data->grids()->where('identifier', 'phase_two_inv1')->first();

            $checklist_lab_invs = $data->grids()->where('identifier', 'checklist_lab_inv')->first();
            $checklist_IB_invs = $data->grids()->where('identifier', 'checklist_IB_inv')->first();
            $oos_capas = $data->grids()->where('identifier', 'oos_capa')->first();
            $phase_two_invs = $data->grids()->where('identifier', 'phase_two_inv')->first();
            $ph_meters = $data->grids()->where('identifier', 'ph_meter')->first();
            $Viscometers = $data->grids()->where('identifier', 'Viscometer')->first();
            $Melting_Points = $data->grids()->where('identifier', 'Melting_Point')->first();
            $Dis_solutions = $data->grids()->where('identifier', 'Dis_solution')->first();
            $HPLC_GCs = $data->grids()->where('identifier', 'HPLC_GC')->first();
            $General_Checklists = $data->grids()->where('identifier', 'General_Checklist')->first();
            $kF_Potentionmeters = $data->grids()->where('identifier', 'kF_Potentionmeter')->first();
            $RM_PMs = $data->grids()->where('identifier', 'RM_PM')->first();
            
            $check_analyst_training_procedures = $data->grids()->where('identifier', 'analyst_training_procedure')->first();
            $Training_records_Analyst_Involveds = $data->grids()->where('identifier', 'Training_records_Analyst_Involved1')->first();
            $sample_intactness_before_analysis = $data->grids()->where('identifier', 'sample_intactness_before_analysis1')->first();
            $test_methods_Procedures = $data->grids()->where('identifier', 'test_methods_Procedure1')->first();
            $Review_of_Media_Buffer_Standards_prepar = $data->grids()->where('identifier', 'Review_of_Media_Buffer_Standards_prep1')->first();
            $Checklist_for_Revi_of_Media_Buffer_Stand_preps = $data->grids()->where('identifier', 'Checklist_for_Revi_of_Media_Buffer_Stand_prep1')->first();
            $check_for_disinfectant_details = $data->grids()->where('identifier', 'ccheck_for_disinfectant_detail1')->first();
            $Checklist_for_Review_of_instrument_equips = $data->grids()->where('identifier', 'Checklist_for_Review_of_instrument_equip1')->first();
            $Checklist_for_Review_of_Training_records_Analysts = $data->grids()->where('identifier', 'Checklist_for_Review_of_Training_records_Analyst1')->first();
            $Checklist_for_Review_of_sampling_and_Transports = $data->grids()->where('identifier', 'Checklist_for_Review_of_sampling_and_Transport1')->first();
            $Checklist_Review_of_Test_Method_proceds = $data->grids()->where('identifier', 'Checklist_Review_of_Test_Method_proceds1')->first();
            $Checklist_for_Review_Media_prepara_RTU_medias = $data->grids()->where('identifier', 'Checklist_for_Review_Media_prepara_RTU_medias1')->first();
            $Checklist_Review_Environment_condition_in_tests = $data->grids()->where('identifier', 'Checklist_Review_Environment_condition_in_tests1')->first();
            $review_of_instrument_bioburden_and_waters = $data->grids()->where('identifier', 'review_of_instrument_bioburden_and_waters1')->first();
            $disinfectant_details_of_bioburden_and_water_tests = $data->grids()->where('identifier', 'disinfectant_details_of_bioburden_and_water_tests1')->first();

            $training_records_analyst_involvedIn_testing_microbial_asssays = $data->grids()->where('identifier', 'training_records_analyst_involvedIn_testing_microbial_asssays1')->first();
            $sample_intactness_before_analysis2 = $data->grids()->where('identifier', 'sample_intactness_before_analysis22')->first();
            $checklist_for_review_of_test_method_IMAs = $data->grids()->where('identifier', 'checklist_for_review_of_test_method_IMA1')->first();
            $cr_of_media_buffe_rst_IMAs = $data->grids()->where('identifier', 'cr_of_media_buffer_st_IMA1')->first();
            $CR_of_microbial_cultures_inoculation_IMAs = $data->grids()->where('identifier', 'CR_of_microbial_cultures_inoculation_IMA1')->first();
            $CR_of_Environmental_condition_in_testing_IMAs = $data->grids()->where('identifier', 'CR_of_Environmental_condition_in_testing_IMA1')->first();
            $CR_of_instru_equipment_IMAs = $data->grids()->where('identifier', 'CR_of_instru_equipment_IMA1')->first();
            $disinfectant_details_IMAs = $data->grids()->where('identifier', 'disinfectant_details_IMA1')->first();

            $CR_of_training_rec_anaylst_in_monitoring_CIEMs = $data->grids()->where('identifier', 'CR_of_training_rec_anaylst_in_monitoring_CIEM1')->first();
            $Check_for_Sample_details_CIEMs = $data->grids()->where('identifier', 'Check_for_Sample_details_CIEM1')->first();
            $Check_for_comparision_of_results_CIEMs = $data->grids()->where('identifier', 'Check_for_comparision_of_results_CIEM1')->first();
            $checklist_for_media_dehydrated_CIEMs = $data->grids()->where('identifier', 'checklist_for_media_dehydrated_CIEM1')->first();
            $checklist_for_media_prepara_sterilization_CIEMs = $data->grids()->where('identifier', 'checklist_for_media_prepara_sterilization_CIEM1')->first();
            $CR_of_En_condition_in_testing_CIEMs = $data->grids()->where('identifier', 'CR_of_En_condition_in_testing_CIEM1')->first();
            $check_for_disinfectant_CIEMs = $data->grids()->where('identifier', 'check_for_disinfectant_CIEM1')->first();
            $checklist_for_fogging_CIEMs = $data->grids()->where('identifier', 'checklist_for_fogging_CIEM1')->first();
            $CR_of_test_method_CIEMs = $data->grids()->where('identifier', 'CR_of_test_method_CIEM1')->first();
            $CR_microbial_isolates_contamination_CIEMs = $data->grids()->where('identifier', 'CR_microbial_isolates_contamination_CIEM1')->first();
            $CR_of_instru_equip_CIEMs = $data->grids()->where('identifier', 'CR_of_instru_equip_CIEM1')->first();
            $Ch_Trend_analysis_CIEMs = $data->grids()->where('identifier', 'Ch_Trend_analysis_CIEM1')->first();

            $checklist_for_analyst_training_CIMTs = $data->grids()->where('identifier', 'checklist_for_analyst_training_CIMT2')->first();
            $checklist_for_comp_results_CIMTs = $data->grids()->where('identifier', 'checklist_for_comp_results_CIMT2')->first();
            $checklist_for_Culture_verification_CIMTs = $data->grids()->where('identifier', 'checklist_for_Culture_verification_CIMT2')->first();
            $sterilize_accessories_CIMTs = $data->grids()->where('identifier', 'sterilize_accessories_CIMT2')->first();
            $checklist_for_intrument_equip_last_CIMTs = $data->grids()->where('identifier', 'checklist_for_intrument_equip_last_CIMT2')->first();
            $disinfectant_details_last_CIMTs = $data->grids()->where('identifier', 'disinfectant_details_last_CIMT2')->first();
            $checklist_for_result_calculation_CIMTs = $data->grids()->where('identifier', 'checklist_for_result_calculation_CIMT2')->first();

            $check_sample_receiving_vars = $data->grids()->where('identifier', 'sample_receiving_var')->first();
            $check_method_procedure_during_analysis = $data->grids()->where('identifier', 'method_used_during_analysis')->first();
            $check_Instrument_Equipment_Details = $data->grids()->where('identifier', 'instrument_equipment_detailss')->first();
            $Results_and_Calculation = $data->grids()->where('identifier', 'result_and_calculation')->first();
    

            $oos_conclusion = $data->grids()->where('identifier', 'oos_conclusion')->first();
            $oos_conclusion_review = $data->grids()->where('identifier', 'oos_conclusion_review')->first();
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.OOS.comps.singleReport', compact('data','Results_and_Calculation','check_Instrument_Equipment_Details','check_method_procedure_during_analysis','check_sample_receiving_vars','record_number','phase_two_invss','instrument_details','products_details','checklist_for_result_calculation_CIMTs','disinfectant_details_last_CIMTs','checklist_for_intrument_equip_last_CIMTs','sterilize_accessories_CIMTs','checklist_for_Culture_verification_CIMTs','checklist_for_comp_results_CIMTs','checklist_for_analyst_training_CIMTs','Ch_Trend_analysis_CIEMs','CR_of_instru_equip_CIEMs','CR_microbial_isolates_contamination_CIEMs','CR_of_test_method_CIEMs','checklist_for_fogging_CIEMs','check_for_disinfectant_CIEMs','CR_of_En_condition_in_testing_CIEMs','checklist_for_media_prepara_sterilization_CIEMs','checklist_for_media_dehydrated_CIEMs','Check_for_comparision_of_results_CIEMs','Check_for_Sample_details_CIEMs','CR_of_training_rec_anaylst_in_monitoring_CIEMs','disinfectant_details_IMAs','CR_of_instru_equipment_IMAs','CR_of_Environmental_condition_in_testing_IMAs','CR_of_microbial_cultures_inoculation_IMAs','cr_of_media_buffe_rst_IMAs','checklist_for_review_of_test_method_IMAs','sample_intactness_before_analysis2','training_records_analyst_involvedIn_testing_microbial_asssays','disinfectant_details_of_bioburden_and_water_tests','review_of_instrument_bioburden_and_waters','Checklist_Review_Environment_condition_in_tests','Checklist_for_Review_Media_prepara_RTU_medias','Checklist_Review_of_Test_Method_proceds','Checklist_for_Review_of_sampling_and_Transports','Checklist_for_Review_of_Training_records_Analysts','Checklist_for_Review_of_instrument_equips','check_for_disinfectant_details','Checklist_for_Revi_of_Media_Buffer_Stand_preps','Review_of_Media_Buffer_Standards_prepar','test_methods_Procedures','sample_intactness_before_analysis','Viscometers','Melting_Points','Dis_solutions','HPLC_GCs','General_Checklists','kF_Potentionmeters','check_analyst_training_procedures','Training_records_Analyst_Involveds','checklist_lab_invs','ph_meters','RM_PMs','checklist_IB_invs','phase_two_invs','oos_capas','oos_conclusion','oos_conclusion_review'))
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
