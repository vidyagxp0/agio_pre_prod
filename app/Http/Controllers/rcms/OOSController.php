<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OOS;
use App\Models\Oosgrids;

class OOSController extends Controller
{
    public function index()
    {
        return view('frontend.OOS.oos_form');
    }
    
    public function store(Request $request)
    { 

        $input = $request->all();
        $input['stage'] ="1";
        $input['status']="Opened";
        $input['type']="OOS";
        //========== file attechment of all pages ==========
        if (!empty ($request->initial_attachment_gi)) {
            $files = [];
            if ($request->hasfile('initial_attachment_gi')) {
                foreach ($request->file('initial_attachment_gi') as $file) {
                    
                    $name =  'initial_attachment_gi' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['initial_attachment_gi'] = json_encode($files);
        }


        if (!empty ($request->file_attachments_pli)) {
            $files = [];
            if ($request->hasfile('file_attachments_pli')) {
                foreach ($request->file('file_attachments_pli') as $file) {
                    
                    $name =  'file_attachments_pli' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['file_attachments_pli'] = json_encode($files);
        }

        if (!empty ($request->supporting_attachment_plic)) {
            $files = [];
            if ($request->hasfile('supporting_attachment_plic')) {
                foreach ($request->file('supporting_attachment_plic') as $file) {
                    
                    $name =  'supporting_attachment_plic' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['supporting_attachment_plic'] = json_encode($files);
        }

        if (!empty ($request->supporting_attachments_plir)) {
            $files = [];
            if ($request->hasfile('supporting_attachments_plir')) {
                foreach ($request->file('supporting_attachments_plir') as $file) {
                    
                    $name =  'supporting_attachments_plir' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['supporting_attachments_plir'] = json_encode($files);
        }


        if (!empty ($request->file_attachments_pli)) {
            $files = [];
            if ($request->hasfile('file_attachments_pli')) {
                foreach ($request->file('file_attachments_pli') as $file) {
                    
                    $name =  'file_attachments_pli' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['file_attachments_pli'] = json_encode($files);
        }

        if (!empty ($request->attachments_piiqcr)) {
            $files = [];
            if ($request->hasfile('attachments_piiqcr')) {
                foreach ($request->file('attachments_piiqcr') as $file) {
                    
                    $name =  'attachments_piiqcr' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['attachments_piiqcr'] = json_encode($files);
        }

        if (!empty ($request->additional_testing_attachment_atp)) {
            $files = [];
            if ($request->hasfile('additional_testing_attachment_atp')) {
                foreach ($request->file('additional_testing_attachment_atp') as $file) {
                    
                    $name =  'additional_testing_attachment_atp' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['additional_testing_attachment_atp'] = json_encode($files);
        }

        if (!empty ($request->file_attachments_if_any_ooscattach)) {
            $files = [];
            if ($request->hasfile('file_attachments_if_any_ooscattach')) {
                foreach ($request->file('file_attachments_if_any_ooscattach') as $file) {
                    
                    $name =  'file_attachments_if_any_ooscattach' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['file_attachments_if_any_ooscattach'] = json_encode($files);
        }

        if (!empty ($request->conclusion_attachment_ocr)) {
            $files = [];
            if ($request->hasfile('conclusion_attachment_ocr')) {
                foreach ($request->file('conclusion_attachment_ocr') as $file) {
                    
                    $name =  'conclusion_attachment_ocr' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['conclusion_attachment_ocr'] = json_encode($files);
        }


        if (!empty ($request->cq_attachment_ocqr)) {
            $files = [];
            if ($request->hasfile('cq_attachment_ocqr')) {
                foreach ($request->file('cq_attachment_ocqr') as $file) {
                    
                    $name =  'cq_attachment_ocqr' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['cq_attachment_ocqr'] = json_encode($files);
        }


        if (!empty ($request->disposition_attachment_bd)) {
            $files = [];
            if ($request->hasfile('disposition_attachment_bd')) {
                foreach ($request->file('disposition_attachment_bd') as $file) {
                    
                    $name =  'disposition_attachment_bd' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['disposition_attachment_bd'] = json_encode($files);
        }

        if (!empty ($request->reopen_attachment_ro)) {
            $files = [];
            if ($request->hasfile('reopen_attachment_ro')) {
                foreach ($request->file('reopen_attachment_ro') as $file) {
                    
                    $name =  'reopen_attachment_ro' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['reopen_attachment_ro'] = json_encode($files);
        }

        if (!empty ($request->addendum_attachment_uaa)) {
            $files = [];
            if ($request->hasfile('addendum_attachment_uaa')) {
                foreach ($request->file('addendum_attachment_uaa') as $file) {
                    
                    $name =  'addendum_attachment_uaa' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['addendum_attachment_uaa'] = json_encode($files);
        }

        if (!empty ($request->addendum_attachments_uae)) {
            $files = [];
            if ($request->hasfile('addendum_attachments_uae')) {
                foreach ($request->file('addendum_attachments_uae') as $file) {
                    
                    $name =  'addendum_attachments_uae' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['addendum_attachments_uae'] = json_encode($files);
        }

        if (!empty ($request->required_attachment_uar)) {
            $files = [];
            if ($request->hasfile('required_attachment_uar')) {
                foreach ($request->file('required_attachment_uar') as $file) {
                    
                    $name =  'required_attachment_uar' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['required_attachment_uar'] = json_encode($files);
        }

        if (!empty ($request->verification_attachment_uar)) {
            $files = [];
            if ($request->hasfile('verification_attachment_uar')) {
                foreach ($request->file('verification_attachment_uar') as $file) {
                    
                    $name =  'verification_attachment_uar' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['verification_attachment_uar'] = json_encode($files);
        }
        if(!empty ($input)){
            $OosDataRecord = OOS::create($input);
        }
        

        // =========== oos grid start =====================
        if(!empty($OosDataRecord)){
            // ========== identifier_info_product_material ======
            $info_product_code = $request->info_product_code;
            if(isset($info_product_code) && $info_product_code!=''){
                $i=0;
                foreach ($info_product_code as $key => $value1) {
                $ProductData = array(
                'oos_id'=> $OosDataRecord->id,
                'identifier' => $request->identifier_info_product_material[$i],
                'info_batch_no' => $request->info_batch_no[$i],
                'info_mfg_date' => $request->info_mfg_date[$i],
                'info_expiry_date' => $request->info_expiry_date[$i],
                'info_label_claim' => $request->info_label_claim[$i],
                'info_pack_size' => $request->info_pack_size[$i],
                'info_analyst_name' => $request->info_analyst_name[$i],
                'info_others_specify' => $request->info_others_specify[$i],
                'info_process_sample_stage' => $request->info_process_sample_stage[$i]
                ); 
                $ProductDatas = Oosgrids::insert($ProductData);
                $i++;  
                }
            }
           // ========== identifier_details_stability ======
            $stability_study_arnumber = $request->stability_study_arnumber;
            if(isset($stability_study_arnumber) && $stability_study_arnumber!=''){
                 $j=0;
                foreach ($stability_study_arnumber as $key => $value1) {
                $StabilityData = array(
                'oos_id'=> $OosDataRecord->id,
                'identifier' => $request->identifier_details_stability[$j],
                'stability_study_arnumber' => $stability_study_arnumber[$j],
                'stability_study_condition_temprature_rh' => $request->stability_study_condition_temprature_rh[$j],
                'stability_study_Interval' => $request->stability_study_Interval[$j],
                'stability_study_orientation' => $request->stability_study_orientation[$j],
                'stability_study_pack_details' => $request->stability_study_pack_details[$j],
                'stability_study_specification_no' => $request->stability_study_specification_no[$j],
                'stability_study_sample_description' => $request->stability_study_sample_description[$j]
                ); 
                $StabilityDatas = Oosgrids::insert($StabilityData);
                $j++;  
                }
            }
            // // ===========' identifier_oos_detail[$k]=========
            $oos_arnumber = $request->oos_arnumber;
            if(isset($oos_arnumber) && $oos_arnumber!=''){
                    $k=0;
                    foreach ($oos_arnumber as $key => $value1) {
                    $OosDetailData = array(
                    'oos_id'=> $OosDataRecord->id,
                    'identifier' => $request->identifier_oos_detail[$k],
                    'oos_test_name' => $request->oos_test_name[$k],
                    'oos_results_obtained' => $request->oos_results_obtained[$k],
                    'oos_specification_limit' => $request->oos_specification_limit[$k],
                    'oos_details_obvious_error' => $request->oos_details_obvious_error[$k],
                    // 'oos_file_attachment' => $request->oos_file_attachment[$k],
                    'oos_submit_on' => $request->oos_submit_on[$k]
                ); 
                $OosDetailDatas = Oosgrids::insert($OosDetailData);
                $k++;  
                }
            }
            // ========== identifier_oos_capa ==========
            $info_oos_number = $request->info_oos_number;
            if(isset($info_oos_number) && $info_oos_number!=''){
                $n=0;
                foreach ($info_oos_number as $key => $value1) {
                $OosCapaData = array(
                'oos_id'=> $OosDataRecord->id,
                'identifier' => $request->identifier_oos_capa[$n],
                'info_oos_number' =>$request->info_oos_number[$n],
                'info_oos_reported_date' => $request->info_oos_reported_date[$n],
                'info_oos_description' => $request->info_oos_description[$n],
                'info_oos_previous_root_cause' => $request->info_oos_previous_root_cause[$n],
                'info_oos_capa' => $request->info_oos_capa[$n],
                'info_oos_closure_date' => $request->info_oos_closure_date[$n],
                // 'info_oos_capa_requirement' => $request->info_oos_capa_requirement[$n],
                'info_oos_capa_reference_number' => $request->info_oos_capa_reference_number[$n]
                ); 
                $genaralGridInfoDatas = Oosgrids::insert($OosCapaData);
                $n++;  
                }
            }
            // // =============== identifier_oos_conclusion ========
            $summary_results_analysis_detials = $request->summary_results_analysis_detials;
            if(isset($summary_results_analysis_detials) && $summary_results_analysis_detials!=''){
                $l=0;
                foreach ($summary_results_analysis_detials as $key => $value1) {
                $OosConclusionData = array(
                'oos_id'=> $OosDataRecord->id,
                'identifier' => $request->identifier_oos_conclusion[$l],
                'summary_results_analysis_detials' => $summary_results_analysis_detials[$l],
                'summary_results_hypothesis_experimentation_test_pr_no' => $request->summary_results_hypothesis_experimentation_test_pr_no[$l],
                'summary_results' => $request->summary_results[$l],
                'summary_results_analyst_name' => $request->summary_results_analyst_name[$l],
                'summary_results_remarks' => $request->summary_results_remarks[$l]
                ); 
                $OosConclusionDatas = Oosgrids::insert($OosConclusionData);
                $l++;  
                }
            }
            // ============= identifier_oos_conclusion_review ==========
            $conclusion_review_product_name = $request->conclusion_review_product_name;
            if(isset($conclusion_review_product_name) && $conclusion_review_product_name!=''){
                $m=0;
                foreach ($conclusion_review_product_name as $key => $value1) {
                $ConclusionReviewData = array(
                'oos_id'=> $OosDataRecord->id,
                'identifier' => $request->identifier_oos_conclusion_review[$m],
                'conclusion_review_product_name' => $request->conclusion_review_product_name[$m],
                'conclusion_review_batch_no'=>$request->conclusion_review_batch_no[$m],
                'conclusion_review_any_other_information'=>$request->conclusion_review_any_other_information[$m],
                'conclusion_review_action_affecte_batch'=>$request->conclusion_review_action_affecte_batch[$m],
                ); 
                $ConclusionReviewDatas = OosGrids::insert($ConclusionReviewData);
                $m++;  
                }
            }
             // ============= Phase -1  ==========
            //  $questions = $request->question;
            //  if(isset($questions) && $questions!=''){
            //     //  $p=0;
            //      foreach ($questions as $key => $value1) {
            //         $Phase1Data = array(
            //         'oos_id'=> $OosDataRecord->id,
            //         'identifier'=> 'identifier_phase1',
            //         'question' => is_array($questions) ? $questions : [],
            //         //  'response'=> is_array($request->response) ? $request->response : [] ,
            //         // 'remark'=> is_array($request->remark) ? $request->remark : []
            //         ); 
            //         $Phase1Datas = Oosgrids::insert($Phase1Data);
            //         //  $p++;  
            //      }
            //     //  dd($Phase1Data);
                
            //  }
             // ============= Phase -2  ==========
            //  $question = $request->question;
            //  if(isset($question) && $question!=''){
            //      $p=0;
            //      foreach ($question as $key => $value1) {
            //      $Phase1Data = array(
            //      'oos_id'=> $OosDataRecord->id,
            //      'identifier' => $request->identifier_phase1[$p],
            //      'question' => $request->question[$p],
            //      'response'=>$request->response[$p],
            //      'remark'=>$request->remark[$p]
            //      ); 
            //      $Phase1Datas = OosGrids::insert($Phase1Data);
            //      $p++;  
            //      }
            //  }
            toastr()->success("Record is created Successfully");
            return redirect(url('rcms/qms-dashboard'));
        }
        
    }
    public static function show($id)
    {
        $data = OOS::find($id);
        return view('frontend.OOS.oos_form_view', compact('data'));

    }
    public function update(Request $request, $id)
    {
        dd($request->all());
        $id = OOS::find($id);
        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }
    
}
