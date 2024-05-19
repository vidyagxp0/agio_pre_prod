<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\MarketComplaint;
use App\Models\MarketComplaintGrids ;
use Illuminate\Support\Facades\Auth;
use App\Models\RecordNumber;
use Illuminate\Http\Request;

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

// Manually assigning each field from the request
        $marketComplaint->initiator_id = Auth::user()->id;
        $marketComplaint->division_id = $request->division_id;
        $marketComplaint->initiator_group = $request->initiator_group;
        $marketComplaint->intiation_date = $request->intiation_date;
        $marketComplaint->due_date = $request->due_date;
        $marketComplaint->initiator_group_code = $request->initiator_group_code_gi;
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

            $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Brain stroming Session'])->firstOrNew();
            $marketrproducts->mc_id = $griddata;
            $marketrproducts->identifier = 'Brain stroming Session';
            $marketrproducts->data = $request->brain_stroming_details;
            $marketrproducts->save();
                // {{ Team Members }}
            $marketrproducts = MarketComplaintGrids::where(['mc_id' => $griddata, 'identifier' => 'Team Members'])->firstOrNew();
            $marketrproducts->mc_id = $griddata;
            $marketrproducts->identifier = 'Team Members';
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
        
           
        

return redirect()->route('marketcomplaint.index')->with('success', 'Market Complaint created successfully.');    
               
    }


    public function show($id)
    {
        $data = MarketComplaint::find($id);
        
    
        if (!$data) {
            // Data not found, you can handle this case as per your application's requirements
            // For example, redirecting to an error page or returning a message
            return redirect()->route('error.page')->with('error', 'Data not found');
        }
    // dd($data);
        $records = MarketComplaint::all(); 
        //  dd($records);
        return view('frontend.market_complaint.market_complaint_view', compact('data', 'records','id'));
    }
    

    // public function LabIncidentShow($id)
    // {

    //     $data = LabIncident::find($id);
    //     $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
    //     $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
    //     $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        
    //     //return view('frontend.labIncident.view', compact('data'));

    //        }







}
