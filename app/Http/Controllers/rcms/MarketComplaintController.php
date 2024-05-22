<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\MarketComplaint;
use App\Models\MarketComplaintGrids ;
use App\Models\MarketComplaintAuditTrial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\RecordNumber;
use App\Models\RoleGroup;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Helpers;

use Carbon\Carbon;
use PDF;
class MarketComplaintController extends Controller
{
    public function index()
    {
        return view('frontend.market_complaint.market_complaint_new');
    }


    public function store(Request $request)
    {   
// ============================================by using insta====================================

$marketComplaint = new MarketComplaint();


$marketComplaint->status = 'Opened';
$marketComplaint->stage = 1;

// Manually assigning each field from the request
        $marketComplaint->initiator_id = Auth::user()->id;
        $marketComplaint->division_id = $request->division_id;
        $marketComplaint->initiator_group = $request->initiator_group;
        $marketComplaint->intiation_date = $request->intiation_date;
        $marketComplaint->due_date_gi = $request->due_date_gi;
        $marketComplaint->initiator_group_code_gi = $request->initiator_group_code_gi;
        $marketComplaint->record_number =((RecordNumber::first()->value('counter')) + 1);
        $marketComplaint->initiated_through_gi = $request->initiated_through_gi;
        $marketComplaint->if_other_gi = $request->if_other_gi;
        $marketComplaint->is_repeat_gi = $request->is_repeat_gi;
        $marketComplaint->repeat_nature_gi = $request->repeat_nature_gi;
        $marketComplaint->description_gi = $request->description_gi;
        // $marketComplaint->initial_attachment_gi = $request->initial_attachment_gi;
        $marketComplaint->complainant_gi = $request->complainant_gi;
        $marketComplaint->complaint_reported_on_gi = $request->complaint_reported_on_gi;
        $marketComplaint->details_of_nature_market_complaint_gi = $request->details_of_nature_market_complaint_gi;
        $marketComplaint->categorization_of_complaint_gi = $request->categorization_of_complaint_gi;
        $marketComplaint->review_of_complaint_sample_gi = $request->review_of_complaint_sample_gi;
        $marketComplaint->review_of_control_sample_gi = $request->review_of_control_sample_gi;
        $marketComplaint->review_of_batch_manufacturing_record_BMR_gi = $request->review_of_batch_manufacturing_record_BMR_gi;
        $marketComplaint->review_of_raw_materials_used_in_batch_manufacturing_gi = $request->review_of_raw_materials_used_in_batch_manufacturing_gi;
        $marketComplaint->review_of_Batch_Packing_record_bpr_gi = $request->review_of_Batch_Packing_record_bpr_gi;
        $marketComplaint->review_of_packing_materials_used_in_batch_packing_gi = $request->review_of_packing_materials_used_in_batch_packing_gi;
        $marketComplaint->review_of_analytical_data_gi = $request->review_of_analytical_data_gi;
        $marketComplaint->review_of_training_record_of_concern_persons_gi = $request->review_of_training_record_of_concern_persons_gi;
        $marketComplaint->rev_eq_inst_qual_calib_record_gi = $request->rev_eq_inst_qual_calib_record_gi;
        $marketComplaint->review_of_equipment_break_down_and_maintainance_record_gi = $request->review_of_equipment_break_down_and_maintainance_record_gi;
        $marketComplaint->review_of_past_history_of_product_gi = $request->review_of_past_history_of_product_gi;
        $marketComplaint->conclusion_hodsr = $request->conclusion_hodsr;
        $marketComplaint->root_cause_analysis_hodsr = $request->root_cause_analysis_hodsr;
        $marketComplaint->probable_root_causes_complaint_hodsr = $request->probable_root_causes_complaint_hodsr;
        $marketComplaint->impact_assessment_hodsr = $request->impact_assessment_hodsr;
        $marketComplaint->corrective_action_hodsr = $request->corrective_action_hodsr;
        $marketComplaint->preventive_action_hodsr = $request->preventive_action_hodsr;
        $marketComplaint->summary_and_conclusion_hodsr = $request->summary_and_conclusion_hodsr;
        // $marketComplaint->initial_attachment_hodsr = $request->initial_attachment_hodsr;
        $marketComplaint->comments_if_any_hodsr = $request->comments_if_any_hodsr;

        $marketComplaint->manufacturer_name_address_ca = $request->manufacturer_name_address_ca;
        $marketComplaint->complaint_sample_required_ca = $request->complaint_sample_required_ca;
        $marketComplaint->complaint_sample_status_ca = $request->complaint_sample_status_ca;
        $marketComplaint->brief_description_of_complaint_ca = $request->brief_description_of_complaint_ca;
        $marketComplaint->batch_record_review_observation_ca = $request->batch_record_review_observation_ca;
        $marketComplaint->analytical_data_review_observation_ca = $request->analytical_data_review_observation_ca;
        $marketComplaint->retention_sample_review_observation_ca = $request->retention_sample_review_observation_ca;
        $marketComplaint->stability_study_data_review_ca = $request->stability_study_data_review_ca;
        $marketComplaint->qms_events_ifany_review_observation_ca = $request->qms_events_ifany_review_observation_ca;
        $marketComplaint->repeated_complaints_queries_for_product_ca = $request->repeated_complaints_queries_for_product_ca;
        $marketComplaint->interpretation_on_complaint_sample_ifrecieved_ca = $request->interpretation_on_complaint_sample_ifrecieved_ca;
        $marketComplaint->comments_ifany_ca = $request->comments_ifany_ca;
        // $marketComplaint->initial_attachment_ca = $request->initial_attachment_ca;

        // Closure section
        $marketComplaint->closure_comment_c = $request->closure_comment_c;
        // $marketComplaint->initial_attachment_c = $request->initial_attachment_c;



        //  dd($marketComplaint);
        $marketComplaint->form_type="Market Complaint";
//    dd($marketComplaint);
        
//  dd($marketComplaint);
        


// $marketComplaint->save();


        // ====================================intance end
        // $input = $request->all();
        // //  dd($request->all());




        //  MarketComplaint::create($input);
        //  $marketComplaintGrid = new MarketComplaintGrids($input);
        //  $marketComplaintGrid->save();
        //  MarketComplaintGrids::create($input);


            // {{----.File attachemenet   }}


            if (!empty($request->initial_attachment_gi)) {
                $files = [];
                if ($request->hasfile('initial_attachment_gi')) {
                    foreach ($request->file('initial_attachment_gi') as $file) {
                        $name = $request->name . 'initial_attachment_gi' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $marketComplaint->initial_attachment_gi = json_encode($files);
            }



            if (!empty($request->initial_attachment_hodsr)) {
                $files = [];
                if ($request->hasfile('initial_attachment_hodsr')) {
                    foreach ($request->file('initial_attachment_hodsr') as $file) {
                        $name = $request->name . 'initial_attachment_hodsr' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $marketComplaint->initial_attachment_hodsr = json_encode($files);
            }


            if (!empty($request->initial_attachment_ca)) {
                $files = [];
                if ($request->hasfile('initial_attachment_ca')) {
                    foreach ($request->file('initial_attachment_ca') as $file) {
                        $name = $request->name . 'initial_attachment_ca' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $marketComplaint->initial_attachment_ca = json_encode($files);
            }
            if (!empty($request->initial_attachment_c)) {
                $files = [];
                if ($request->hasfile('initial_attachment_c')) {
                    foreach ($request->file('initial_attachment_c') as $file) {
                        $name = $request->name . 'initial_attachment_c' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $marketComplaint->initial_attachment_c = json_encode($files);
            }
            // dd($marketComplaint);

         $marketComplaint->save();
            // dd($marketComplaint);
            // {{-- --produts grid gi  --}}







            // For "Product Details"
            $griddata = $marketComplaint->id;

            $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Product Details'])->firstOrNew();
            $marketrproducts->mc_id = $griddata;
            $marketrproducts->identifier = 'ProductDetails';
            $marketrproducts->data = $request->serial_number_gi;
            $marketrproducts->save();
        // dd($marketrproducts->data);
        //Traceability 
                    // $griddata = $marketComplaint->id;

            $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Traceability'])->firstOrNew();
            $marketrproducts->mc_id = $griddata;
            $marketrproducts->identifier = 'Traceability';
            $marketrproducts->data = $request->trace_ability;
            $marketrproducts->save();

                // {{-- Investing_team --}}
            $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Investing_team'])->firstOrNew();
            $marketrproducts->mc_id = $griddata;
            $marketrproducts->identifier = 'Investing_team';
            $marketrproducts->data = $request->Investing_team;
            $marketrproducts->save();
                // {{-- Brain stroming Session --}}

            $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Brain_stroming_Session'])->firstOrNew();
            $marketrproducts->mc_id = $griddata;
            $marketrproducts->identifier = 'Brain_stroming_Session';
            $marketrproducts->data = $request->brain_stroming_details;
            $marketrproducts->save();
                // {{ Team Members }}
            $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Team_Members'])->firstOrNew();
            $marketrproducts->mc_id = $griddata;
            $marketrproducts->identifier = 'Team_Members';
            $marketrproducts->data = $request->Team_Members ;
            $marketrproducts->save();
                // {{ Report_Approval }}
            $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Report_Approval'])->firstOrNew();
            $marketrproducts->mc_id = $griddata;
            $marketrproducts->identifier = 'Report_Approval';
            $marketrproducts->data = $request->Report_Approval ;
            $marketrproducts->save();

            // {{ Product_MaterialDetails }}
            $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Product_MaterialDetails'])->firstOrNew();
            $marketrproducts->mc_id = $griddata;
            $marketrproducts->identifier = 'Product_MaterialDetails';
            $marketrproducts->data = $request->Product_MaterialDetails ;
            $marketrproducts->save();


                // {{  g}}
            $griddata = $marketComplaint->id;

            // Create MarketComplaintGrids record for Proposal to accomplish investigation
            $investigationData = [
                'Complaint sample Required' => ['csr1' => $request->csr1, 'csr2' => $request->csr2],
                'Additional info. From Complainant' => ['afc1' => $request->afc1, 'afc2' => $request->afc2],
                'Analysis of complaint Sample' => ['acs1' => $request->acs1, 'acs2' => $request->acs2],
                'QRM Approach' => ['qrm1' => $request->qrm1, 'qrm2' => $request->qrm2],
                'Others' => ['oth1' => $request->oth1, 'oth2' => $request->oth2]
            ];
        
            $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Proposal_to_accomplish_investigation'])->firstOrNew();
            $marketrproducts->mc_id = $griddata;
            $marketrproducts->identifier = 'Proposal_to_accomplish_investigation';
            $marketrproducts->data = json_encode($investigationData); // Encode data to JSON
            $marketrproducts->save();
        
           
        

// return redirect()->route('qms-dashboard')->with('success', 'Market Complaint created successfully.');    
return redirect()->to('rcms/qms-dashboard')->with('success', 'Market Complaint created successfully.');    
               
    }


    public function show($id)
    {
            $data = MarketComplaint::find($id);
    $productsgi = MarketComplaintGrids::where('mc_id',$id)->where('identifier','ProductDetails')->first();
    $traceability_gi = MarketComplaintGrids::where('mc_id',$id)->where('identifier','Traceability')->first();
    $investing_team = MarketComplaintGrids::where('mc_id',$id)->where('identifier','Investing_team')->first();
    $brain_stroming_session = MarketComplaintGrids::where('mc_id',$id)->where('identifier','Brain_stroming_Session')->first();
    $team_members = MarketComplaintGrids::where('mc_id',$id)->where('identifier','Team_Members')->first();
    $report_approval = MarketComplaintGrids::where('mc_id',$id)->where('identifier','Report_Approval')->first();
    $product_materialDetails = MarketComplaintGrids::where('mc_id',$id)->where('identifier','Product_MaterialDetails')->first();
    // $productsgi = MarketComplaintGrids::where('mc_id',$id)->where('identifier','ProductDetails')->first();

    $proposal_to_accomplish_investigation = MarketComplaintGrids::where('mc_id', $id)->where('identifier', 'Proposal_to_accomplish_investigation')->first();
    $proposalData = $proposal_to_accomplish_investigation ? json_decode($proposal_to_accomplish_investigation->data, true) : [];


    return view('frontend.market_complaint.market_complaint_view',compact(
        'data','productsgi','traceability_gi','investing_team','brain_stroming_session','team_members','report_approval','product_materialDetails','proposalData'));



        }





public function update(Request $request,$id){

    // $marketComplaint = MarketComplaint::find($id);
    $marketComplaint = MarketComplaint::find($id);
    if (!$marketComplaint) {
        return redirect()->back()->with('error', 'Market Complaint not found.');
    }
    $marketComplaint->if_other_gi = $request->input('if_other_gi');
    $marketComplaint->initiator_group_code_gi = $request->initiator_group_code_gi;
    $marketComplaint->record_number =((RecordNumber::first()->value('counter')) + 1);
    $marketComplaint->initiated_through_gi = $request->initiated_through_gi;
    $marketComplaint->if_other_gi = $request->if_other_gi;
    $marketComplaint->is_repeat_gi = $request->is_repeat_gi;
    $marketComplaint->repeat_nature_gi = $request->repeat_nature_gi;
    $marketComplaint->description_gi = $request->description_gi;
    // $marketComplaint->initial_attachment_gi = $request->initial_attachment_gi;
    $marketComplaint->complainant_gi = $request->complainant_gi;
    $marketComplaint->complaint_reported_on_gi = $request->complaint_reported_on_gi;
    $marketComplaint->details_of_nature_market_complaint_gi = $request->details_of_nature_market_complaint_gi;
    $marketComplaint->categorization_of_complaint_gi = $request->categorization_of_complaint_gi;
    $marketComplaint->review_of_complaint_sample_gi = $request->review_of_complaint_sample_gi;
    $marketComplaint->review_of_control_sample_gi = $request->review_of_control_sample_gi;
    $marketComplaint->review_of_batch_manufacturing_record_BMR_gi = $request->review_of_batch_manufacturing_record_BMR_gi;
    $marketComplaint->review_of_raw_materials_used_in_batch_manufacturing_gi = $request->review_of_raw_materials_used_in_batch_manufacturing_gi;
    $marketComplaint->review_of_Batch_Packing_record_bpr_gi = $request->review_of_Batch_Packing_record_bpr_gi;
    $marketComplaint->review_of_packing_materials_used_in_batch_packing_gi = $request->review_of_packing_materials_used_in_batch_packing_gi;
    $marketComplaint->review_of_analytical_data_gi = $request->review_of_analytical_data_gi;
    $marketComplaint->review_of_training_record_of_concern_persons_gi = $request->review_of_training_record_of_concern_persons_gi;
    $marketComplaint->rev_eq_inst_qual_calib_record_gi = $request->rev_eq_inst_qual_calib_record_gi;
    $marketComplaint->review_of_equipment_break_down_and_maintainance_record_gi = $request->review_of_equipment_break_down_and_maintainance_record_gi;
    $marketComplaint->review_of_past_history_of_product_gi = $request->review_of_past_history_of_product_gi;
    $marketComplaint->conclusion_hodsr = $request->conclusion_hodsr;
    $marketComplaint->root_cause_analysis_hodsr = $request->root_cause_analysis_hodsr;
    $marketComplaint->probable_root_causes_complaint_hodsr = $request->probable_root_causes_complaint_hodsr;
    $marketComplaint->impact_assessment_hodsr = $request->impact_assessment_hodsr;
    $marketComplaint->corrective_action_hodsr = $request->corrective_action_hodsr;
    $marketComplaint->preventive_action_hodsr = $request->preventive_action_hodsr;
    $marketComplaint->summary_and_conclusion_hodsr = $request->summary_and_conclusion_hodsr;
    // $marketComplaint->initial_attachment_hodsr = $request->initial_attachment_hodsr;
    $marketComplaint->comments_if_any_hodsr = $request->comments_if_any_hodsr;

    $marketComplaint->manufacturer_name_address_ca = $request->manufacturer_name_address_ca;
    $marketComplaint->complaint_sample_required_ca = $request->complaint_sample_required_ca;
    $marketComplaint->complaint_sample_status_ca = $request->complaint_sample_status_ca;
    $marketComplaint->brief_description_of_complaint_ca = $request->brief_description_of_complaint_ca;
    $marketComplaint->batch_record_review_observation_ca = $request->batch_record_review_observation_ca;
    $marketComplaint->analytical_data_review_observation_ca = $request->analytical_data_review_observation_ca;
    $marketComplaint->retention_sample_review_observation_ca = $request->retention_sample_review_observation_ca;
    $marketComplaint->stability_study_data_review_ca = $request->stability_study_data_review_ca;
    $marketComplaint->qms_events_ifany_review_observation_ca = $request->qms_events_ifany_review_observation_ca;
    $marketComplaint->repeated_complaints_queries_for_product_ca = $request->repeated_complaints_queries_for_product_ca;
    $marketComplaint->interpretation_on_complaint_sample_ifrecieved_ca = $request->interpretation_on_complaint_sample_ifrecieved_ca;
    $marketComplaint->comments_ifany_ca = $request->comments_ifany_ca;
    // $marketComplaint->initial_attachment_ca = $request->initial_attachment_ca;

    // Closure section
    $marketComplaint->closure_comment_c = $request->closure_comment_c;
    // $marketComplaint->initial_attachment_c = $request->initial_attachment_c;



    
    $marketComplaint->form_type="Market Complaint";
    //    dd($marketComplaint);
    

        // {{----.File attachemenet   }}


        if (!empty($request->initial_attachment_gi)) {
            $files = [];
            if ($request->hasfile('initial_attachment_gi')) {
                foreach ($request->file('initial_attachment_gi') as $file) {
                    $name = $request->name . 'initial_attachment_gi' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $marketComplaint->initial_attachment_gi = json_encode($files);
        }



        if (!empty($request->initial_attachment_hodsr)) {
            $files = [];
            if ($request->hasfile('initial_attachment_hodsr')) {
                foreach ($request->file('initial_attachment_hodsr') as $file) {
                    $name = $request->name . 'initial_attachment_hodsr' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $marketComplaint->initial_attachment_hodsr = json_encode($files);
        }


        if (!empty($request->initial_attachment_ca)) {
            $files = [];
            if ($request->hasfile('initial_attachment_ca')) {
                foreach ($request->file('initial_attachment_ca') as $file) {
                    $name = $request->name . 'initial_attachment_ca' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $marketComplaint->initial_attachment_ca = json_encode($files);
        }
        if (!empty($request->initial_attachment_c)) {
            $files = [];
            if ($request->hasfile('initial_attachment_c')) {
                foreach ($request->file('initial_attachment_c') as $file) {
                    $name = $request->name . 'initial_attachment_c' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $marketComplaint->initial_attachment_c = json_encode($files);
        }
        // dd($marketComplaint);

     $marketComplaint->update();
        // dd($marketComplaint);
        // {{-- --produts grid gi  --}}




            // {{ grid update }}


        // For "Product Details"
        $griddata = $marketComplaint->id;

        $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Product Details'])->firstOrNew();
        $marketrproducts->mc_id = $griddata;
        $marketrproducts->identifier = 'ProductDetails';
        $marketrproducts->data = $request->serial_number_gi;
        $marketrproducts->update();
        // $marketrproducts->save();
// dd($marketrproducts->data);
//Traceability
        // $griddata = $marketComplaint->id;

        $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Traceability'])->firstOrNew();
        $marketrproducts->mc_id = $griddata;
        $marketrproducts->identifier = 'Traceability';
        $marketrproducts->data = $request->trace_ability;
        $marketrproducts->update();

            // {{-- Investing_team --}}
        $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Investing_team'])->firstOrNew();
        $marketrproducts->mc_id = $griddata;
        $marketrproducts->identifier = 'Investing_team';
        $marketrproducts->data = $request->Investing_team;
        $marketrproducts->update();
            // {{-- Brain stroming Session --}}

        $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Brain_stroming_Session'])->firstOrNew();
        $marketrproducts->mc_id = $griddata;
        $marketrproducts->identifier = 'Brain_stroming_Session';
        $marketrproducts->data = $request->brain_stroming_details;
        $marketrproducts->update();
            // {{ Team Members }}
        $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Team_Members'])->firstOrNew();
        $marketrproducts->mc_id = $griddata;
        $marketrproducts->identifier = 'Team_Members';
        $marketrproducts->data = $request->Team_Members ;
        $marketrproducts->update();
            // {{ Report_Approval }}
        $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Report_Approval'])->firstOrNew();
        $marketrproducts->mc_id = $griddata;
        $marketrproducts->identifier = 'Report_Approval';
        $marketrproducts->data = $request->Report_Approval ;
        $marketrproducts->update();

        // {{ Product_MaterialDetails }}
        $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Product_MaterialDetails'])->firstOrNew();
        $marketrproducts->mc_id = $griddata;
        $marketrproducts->identifier = 'Product_MaterialDetails';
        $marketrproducts->data = $request->Product_MaterialDetails ;
        $marketrproducts->update();


            // {{  g}}
        $griddata = $marketComplaint->id;

        // Create MarketComplaintGrids record for Proposal to accomplish investigation
        $investigationData = [
            'Complaint sample Required' => ['csr1' => $request->csr1, 'csr2' => $request->csr2],
            'Additional info. From Complainant' => ['afc1' => $request->afc1, 'afc2' => $request->afc2],
            'Analysis of complaint Sample' => ['acs1' => $request->acs1, 'acs2' => $request->acs2],
            'QRM Approach' => ['qrm1' => $request->qrm1, 'qrm2' => $request->qrm2],
            'Others' => ['oth1' => $request->oth1, 'oth2' => $request->oth2]
        ];
    
        $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Proposal_to_accomplish_investigation'])->firstOrNew();
        $marketrproducts->mc_id = $griddata;
        $marketrproducts->identifier = 'Proposal_to_accomplish_investigation';
        $marketrproducts->data = json_encode($investigationData); // Encode data to JSON
        $marketrproducts->update();
    
       
   


    toastr()->success('Record is updated Successfully');
    return redirect()->back();
    //  return redirect()->route('marketcomplaint.marketcomplaintupdate' ,['id'=> $marketComplaint->id])->with('success', 'Market Complaint updated successfully.');    

}






public function marketComplaintStateChange(Request $request,$id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $labstate = MarketComplaint::find($id);
            $lastDocument =  MarketComplaint::find($id);
            $data = MarketComplaint::find($id);


           if( $labstate->stage == 1){
            $labstate->stage = "2";
            $labstate->submitted_by = Auth::user()->name;
            $labstate->submitted_on = Carbon::now()->format('d-M-Y');
            $labstate->status = "Opened";
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $id;
            $history->activity_type = 'Activity Log';
            $history->current = $labstate->submitted_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage='Submited';
            $history->save();

            $labstate->update();

            return redirect()->back();
           }
           if( $labstate->stage == 2)
           {
            $labstate->stage = "3";
            $labstate->submitted_by = Auth::user()->name;
            $labstate->submitted_on = Carbon::now()->format('d-M-Y');

            $labstate->status ="Supervisor Review";
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $id;
            $history->activity_type = 'Activity Log';
            $history->current = $labstate->submitted_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage='Submited';
            $history->save();



            // dd($labstate->stage);
            $labstate->update();
            return redirect()->back();
           }

           if( $labstate->stage == 3)
           {
            $labstate->stage = "4";
            $labstate->submitted_by = Auth::user()->name;
            $labstate->submitted_on = Carbon::now()->format('d-M-Y');

            $labstate->status ="Investigation and Root Cause Analysis";
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $id;
            $history->activity_type = 'Activity Log';
            $history->current = $labstate->submitted_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage='Submited';
            $history->save();



            $labstate->update();
            return redirect()->back();
           }

           if( $labstate->stage == 4)
           {
            $labstate->stage = "5";
            $labstate->submitted_by = Auth::user()->name;
            $labstate->submitted_on = Carbon::now()->format('d-M-Y');

            $labstate->status ="CAPA Plan";
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $id;
            $history->activity_type = 'Activity Log';
            $history->current = $labstate->submitted_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage='Submited';
            $history->save();



            $labstate->update();
            return redirect()->back();
           }
           
           if( $labstate->stage == 5)
           {
            $labstate->stage = "6";
            $labstate->submitted_by = Auth::user()->name;
            $labstate->submitted_on = Carbon::now()->format('d-M-Y');

            $labstate->status ="Pending Approval";
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $id;
            $history->activity_type = 'Activity Log';
            $history->current = $labstate->submitted_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage='Submited';
            $history->save();



            $labstate->update();
            return redirect()->back();
           }

           if( $labstate->stage == 6)
           {
            $labstate->stage = "7";
            $labstate->submitted_by = Auth::user()->name;
            $labstate->submitted_on = Carbon::now()->format('d-M-Y');

            $labstate->status ="Pending Actions Completion";
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $id;
            $history->activity_type = 'Activity Log';
            $history->current = $labstate->submitted_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage='Submited';
            $history->save();




            $labstate->update();
            return redirect()->back();
           }

           if( $labstate->stage == 7)
           {
            $labstate->stage = "8";
            $labstate->submitted_by = Auth::user()->name;
            $labstate->submitted_on = Carbon::now()->format('d-M-Y');

            $labstate->status ="Pending Response Letter";
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $id;
            $history->activity_type = 'Activity Log';
            $history->current = $labstate->submitted_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage='Submited';
            $history->save();


            $labstate->update();
            return redirect()->back();
           }
           if( $labstate->stage == 8)
           {
            $labstate->stage = "9";
            $labstate->submitted_by = Auth::user()->name;
            $labstate->submitted_on = Carbon::now()->format('d-M-Y');

            $labstate->status ="Closed - Done";
            $history = new MarketComplaintAuditTrial();
            $history->market_id = $id;
            $history->activity_type = 'Activity Log';
            $history->current = $labstate->submitted_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage='Submited';
            $history->save();
           


            $labstate->update();
            return redirect()->back();
           }


        }else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function marketComplaintRejectState(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = MarketComplaint::find($id);

            if ($changeControl->stage == 2) {
                $changeControl->stage = "1";
                $changeControl->status = "Opened";
                $changeControl->update();
                
                return back();
            }
            if ($changeControl->stage == 3) {
                $changeControl->stage = "1";
                $changeControl->status = "Opened";
                $changeControl->update();
                
                return back();
            }

            if ($changeControl->stage == 5) {
                $changeControl->stage = "4";
                $changeControl->status = "CAPA Plan";
                $changeControl->update();
                
                return back();
            }
        }

        // Optionally, handle invalid credentials or other logic
        return back()->withErrors(['Invalid credentials or action not allowed.']);
    }

    public function singleReport(Request $request, $id){

        $data = MarketComplaint::find($id);
        $prductgigrid =MarketComplaintGrids::where(['mc_id' => $id,'identifier' => 'ProductDetails'])->first();
        // $martab_grid =MarketComplaintGrids::where(['mc_id' => $id,'identifier'=> 'Sutability'])->first();




        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.market_complaint.singleReport', compact('data','prductgigrid'))
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
            return $pdf->stream('MarketComplainta' . $id . '.pdf');
        }
        

        return view('frontend.market_complaint.singleReport',compact('data','prductgigrid'));

    }

    public function MarketAuditTrial($id)
    {


        $audit = MarketComplaintAuditTrial::where('market_id', $id)->orderByDESC('id')->get()->unique('activity_type');
        $today = Carbon::now()->format('d-m-y');
        $document = MarketComplaint::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');


return view('frontend.market_complaint.audit-trial',compact('audit', 'document', 'today'));
        
    }


    public function auditDetailsMarket($id)
    {
        $detail = MarketComplaintAuditTrial::find($id);

        $detail_data = MarketComplaintAuditTrial::where('Activity_type', $detail->activity_type)->where('market_id', $detail->market_id)->latest()->get();

        $doc = MarketComplaint::where('id', $detail->market_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);
        return view('frontend.market_complaint.audit-trial-inner', compact('detail', 'doc', 'detail_data'));

    }


    public static function auditReport($id)
    {
        $doc = MarketComplaint::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $data = MarketComplaintAuditTrial::where('market_id', $id)->get();
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.market_complaint.auditReport', compact('data', 'doc'))
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
            return $pdf->stream('Market-AuditTrial' . $id . '.pdf');
        }
    }







}


