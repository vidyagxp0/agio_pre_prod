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
        $marketComplaint->initial_attachment_gi = $request->initial_attachment_gi;
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
        $marketComplaint->initial_attachment_hodsr = $request->initial_attachment_hodsr;
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
        $marketComplaint->initial_attachment_ca = $request->initial_attachment_ca;

        // Closure section
        $marketComplaint->closure_comment_c = $request->closure_comment_c;
        $marketComplaint->initial_attachment_c = $request->initial_attachment_c;

        $marketComplaint->form_type="Market Complaint";
    //    dd($marketComplaint);
        
//  dd($marketComplaint);
        $marketComplaint->save();


//dd($marketComplaint);


        // ====================================intance end
        // $input = $request->all();
        // //  dd($request->all());




        //  MarketComplaint::create($input);
        //  $marketComplaintGrid = new MarketComplaintGrids($input);
        //  $marketComplaintGrid->save();
        //  MarketComplaintGrids::create($input);


            // {{----.File attachemenet   }}


            $request->validate([
                'initial_attachment_gi.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            ]);
        
            $filePaths = [];
        
            if ($request->hasFile('initial_attachment_gi')) {
                foreach ($request->file('initial_attachment_gi') as $file) {
                    $fileName = time().'_'.$file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads', $fileName, 'public');
                    $filePaths[] = $fileName;
                }
            }
        
            $marketComplaint = new MarketComplaint();
            $marketComplaint->initial_attachment_gi = json_encode($filePaths);
            // Save other fields as needed
            $marketComplaint->save();
        




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

        if (!empty ($request->initial_attachment_hodsr)) {
            $files = [];
            if ($request->hasfile('initial_attachment_hodsr')) {
                foreach ($request->file('initial_attachment_hodsr') as $file) {
                    
                    $name =  'initial_attachment_hodsr' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['initial_attachment_hodsr'] = json_encode($files);
        }

        if (!empty ($request->initial_attachment_ca)) {
            $files = [];
            if ($request->hasfile('initial_attachment_ca')) {
                foreach ($request->file('initial_attachment_ca') as $file) {
                    
                    $name =  'initial_attachment_ca' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['initial_attachment_ca'] = json_encode($files);
        }


        if (!empty ($request->initial_attachment_c)) {
            $files = [];
            if ($request->hasfile('initial_attachment_c')) {
                foreach ($request->file('initial_attachment_c') as $file) {
                    
                    $name =  'initial_attachment_c' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['initial_attachment_c'] = json_encode($files);
        }

        
            // {{-- --produts grid gi  --}}



         $request->validate([
            // 'investigation_report_gi' => 'required|string|unique:incident_investigation_report,investigation_report_gi',
            'info_product_name' => 'required',
            'info_batch_no' => 'required',
            'info_mfg_date' => 'required',
            'info_expiry_date' => 'required',
            'info_batch_size' => 'required',
            'info_pack_size' => 'required',
            'info_dispatch_quantity' => 'required',
            'info_remarks' => 'required',
           

        ]);
        $concatenatedData = '';

        // Adding null checks and fixing potential typos in array keys
        $concatenatedData .= !empty($request->input('info_product_name')) ? $request->input('info_product_name')[0] . ' ' : '';
        $concatenatedData .= !empty($request->input('info_batch_no')) ? $request->input('info_batch_no')[0] . ' ' : '';
        $concatenatedData .= !empty($request->input('info_mfg_date')) ? $request->input('info_mfg_date')[0] . ' ' : ''; // Assuming 'info_mfg_date' is the correct input name
        $concatenatedData .= !empty($request->input('info_expiry_date')) ? $request->input('info_expiry_date')[0] . ' ' : '';
        $concatenatedData .= !empty($request->input('info_batch_size')) ? $request->input('info_batch_size')[0] . ' ' : '';
        $concatenatedData .= !empty($request->input('info_pack_size')) ? $request->input('info_pack_size')[0] . ' ' : '';
        $concatenatedData .= !empty($request->input('info_dispatch_quantity')) ? $request->input('info_dispatch_quantity')[0] . ' ' : '';
        $concatenatedData .= !empty($request->input('info_remarks')) ? $request->input('info_remarks')[0] . ' ' : '';
        
        $concatenatedData = trim($concatenatedData);
        $identifers = 'Product Details'. uniqid();
        
        $report1 = new MarketComplaintGrids();
        $report1->identifers = $identifers; // Ensure this is 'identifiers' if that is the correct column name
        $report1->data = $concatenatedData;
        $report1->save();

            // {{-- ---Traceability grid gi  --}}



            $request->validate([
                // 'investigation_report_gi' => 'required|string|unique:incident_investigation_report,investigation_report_gi',
                'product_name_tr' => 'required',
                'batch_no_tr' => 'required',
                'manufacturing_location_tr' => 'required',
                'remarks_tr' => 'required',
                
    
            ]);

            $concatenatedData = '';

            // Adding null checks and fixing potential typos in array keys
            $concatenatedData .= !empty($request->input('product_name_tr')) ? $request->input('product_name_tr')[0] . ' ' : '';
            $concatenatedData .= !empty($request->input('batch_no_tr')) ? $request->input('batch_no_tr')[0] . ' ' : '';
            $concatenatedData .= !empty($request->input('manufacturing_location_tr')) ? $request->input('manufacturing_location_tr')[0] . ' ' : ''; // Assuming 'info_mfg_date' is the correct input name
            $concatenatedData .= !empty($request->input('remarks_tr')) ? $request->input('remarks_tr')[0] . ' ' : '';
            
            $concatenatedData = trim($concatenatedData);
            $identifers = 'Traceability '. uniqid();
            
            $report2 = new MarketComplaintGrids();
            $report2->identifers = $identifers; // Ensure this is 'identifiers' if that is the correct column name
            $report2->data = $concatenatedData;
    
        $report2->save();

                // {{-- --Investingation Team gi- --}}

                $request->validate([
                    // 'investigation_report_gi' => 'required|string|unique:incident_investigation_report,investigation_report_gi',
                    'name_inv_tem' => 'required',
                    'department_inv_tem' => 'required',
                    'remarks_inv_tem' => 'required',
                    
        
                ]);
    
                $concatenatedData = '';
    
                // Adding null checks and fixing potential typos in array keys
                $concatenatedData .= !empty($request->input('name_inv_tem')) ? $request->input('name_inv_tem')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('department_inv_tem')) ? $request->input('department_inv_tem')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('remarks_inv_tem')) ? $request->input('remarks_inv_tem')[0] . ' ' : ''; // Assuming 'info_mfg_date' is the correct input name
                
                $concatenatedData = trim($concatenatedData);
                $identifers = 'Investingation Team '. uniqid();
                
                $report_itgi = new MarketComplaintGrids();
                $report_itgi->identifers = $identifers; // Ensure this is 'identifiers' if that is the correct column name
                $report_itgi->data = $concatenatedData;
        
            $report_itgi->save();




                        //  {{-- --Brain stroming Session/Discussion with Concered Person gi --}}



                        $request->validate([
                            // 'investigation_report_gi' => 'required|string|unique:incident_investigation_report,investigation_report_gi',
                            'possiblity_bssd' => 'required',
                            'factscontrols_bssd' => 'required',
                            'probable_cause_bssd' => 'required',
                            'remarks_bssd' => 'required',
                            
                
                        ]);
            
                        $concatenatedData = '';
            
                        // Adding null checks and fixing potential typos in array keys
                        $concatenatedData .= !empty($request->input('possiblity_bssd')) ? $request->input('possiblity_bssd')[0] . ' ' : '';
                        $concatenatedData .= !empty($request->input('factscontrols_bssd')) ? $request->input('factscontrols_bssd')[0] . ' ' : '';
                        $concatenatedData .= !empty($request->input('probable_cause_bssd')) ? $request->input('probable_cause_bssd')[0] . ' ' : ''; // Assuming 'info_mfg_date' is the correct input name
                        $concatenatedData .= !empty($request->input('remarks_bssd')) ? $request->input('remarks_bssd')[0] . ' ' : ''; // Assuming 'info_mfg_date' is the correct input name
                        
                        $concatenatedData = trim($concatenatedData);    
                        $identifers = 'Brain stroming Session/Discussion with Concered Person'. uniqid();
                        
                        $report_bssd = new MarketComplaintGrids();
                        $report_bssd->identifers = $identifers; // Ensure this is 'identifiers' if that is the correct column name
                        $report_bssd->data = $concatenatedData;
                
                    $report_bssd->save();
        

        
                // {{-- -HOD   Team Members  --}}


                $request->validate([
                    // 'investigation_report_gi' => 'required|string|unique:incident_investigation_report,investigation_report_gi',
                    'names_tm' => 'required',
                    'department_tm' => 'required',
                    'sign_tm' => 'required',
                    'date_tm' => 'required',
                    
        
                ]);
    
                $concatenatedData = '';
    
                // Adding null checks and fixing potential typos in array keys
                $concatenatedData .= !empty($request->input('names_tm')) ? $request->input('names_tm')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('department_tm')) ? $request->input('department_tm')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('sign_tm')) ? $request->input('sign_tm')[0] . ' ' : ''; // Assuming 'info_mfg_date' is the correct input name
                $concatenatedData .= !empty($request->input('date_tm')) ? $request->input('date_tm')[0] . ' ' : '';
                
                $concatenatedData = trim($concatenatedData);
                $identifers = 'Team Members  '. uniqid();
                
                $report3 = new MarketComplaintGrids();
                $report3->identifers = $identifers; // Ensure this is 'identifiers' if that is the correct column name
                $report3->data = $concatenatedData;
        
                 $report3->save();



                   // {{-- -HOD   Report Approval --}}


                $request->validate([
                    // 'investigation_report_gi' => 'required|string|unique:incident_investigation_report,investigation_report_gi',
                    'names_rrv' => 'required',
                    'department_rrv' => 'required',
                    'sign_rrv' => 'required',
                    'date_rrv' => 'required',
                    
        
                ]);
    
                $concatenatedData = '';
    
                // Adding null checks and fixing potential typos in array keys
                $concatenatedData .= !empty($request->input('names_rrv')) ? $request->input('names_rrv')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('department_rrv')) ? $request->input('department_rrv')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('sign_rrv')) ? $request->input('sign_rrv')[0] . ' ' : ''; // Assuming 'info_mfg_date' is the correct input name
                $concatenatedData .= !empty($request->input('date_rrv')) ? $request->input('date_rrv')[0] . ' ' : '';
                
                $concatenatedData = trim($concatenatedData);
                $identifers = 'Report Approval  '. uniqid();
                
                $report4 = new MarketComplaintGrids();
                $report4->identifers = $identifers; // Ensure this is 'identifiers' if that is the correct column name
                $report4->data = $concatenatedData;
        
                 $report4->save();
            

                  // {{-- Complaint Acknowledgement    Product/Material Details--}}


                  $request->validate([
                    // 'investigation_report_gi' => 'required|string|unique:incident_investigation_report,investigation_report_gi',
                    'product_name_pmd' => 'required',
                    'batch_no_pmd' => 'required',
                    'mfg_date_pmd' => 'required',
                    'expiry_date_pmd' => 'required',
                    'batch_size_pmd' => 'required',
                    'pack_profile_pmd' => 'required',
                    'released_quantity_pmd' => 'required',
                    'remarks_pmd' => 'required',

                    
        
                ]);
    
                $concatenatedData = '';
    
                // Adding null checks and fixing potential typos in array keys
                $concatenatedData .= !empty($request->input('product_name_pmd')) ? $request->input('product_name_pmd')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('batch_no_pmd')) ? $request->input('batch_no_pmd')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('mfg_date_pmd')) ? $request->input('mfg_date_pmd')[0] . ' ' : ''; // Assuming 'info_mfg_date' is the correct input name
                $concatenatedData .= !empty($request->input('expiry_date_pmd')) ? $request->input('expiry_date_pmd')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('batch_size_pmd')) ? $request->input('batch_size_pmd')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('pack_profile_pmd')) ? $request->input('pack_profile_pmd')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('released_quantity_pmd')) ? $request->input('released_quantity_pmd')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('remarks_pmd')) ? $request->input('remarks_pmd')[0] . ' ' : '';
                
                $concatenatedData = trim($concatenatedData);
                $identifers = 'Report Approval  '. uniqid();
                
                $report4 = new MarketComplaintGrids();
                $report4->identifers = $identifers; // Ensure this is 'identifiers' if that is the correct column name
                $report4->data = $concatenatedData;
        
                 $report4->save();


                //  {{-- -Proposal to accomplish investigation  complete ack--}}

              $request->validate([
                    // 'investigation_report_gi' => 'required|string|unique:incident_investigation_report,investigation_report_gi',
                    'csr1' => 'required',
                    'csr2' => 'required',
                    'afc1' => 'required',
                    'acs1' => 'required',
                    'acs2' => 'required',
                    'qrm1' => 'required',
                    'qrm2' => 'required',
                    'oth1' => 'required',
                    'oth2' => 'required',

                    
        
                ]);
    
                $concatenatedData = '';
     
                // Adding null checks and fixing potential typos in array keys
                $concatenatedData .= !empty($request->input('csr1')) ? $request->input('csr1')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('csr2')) ? $request->input('csr2')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('afc1')) ? $request->input('afc1')[0] . ' ' : ''; // Assuming 'info_mfg_date' is the correct input name
                $concatenatedData .= !empty($request->input('acs1')) ? $request->input('acs1')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('acs2')) ? $request->input('acs2')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('qrm1')) ? $request->input('qrm1')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('qrm2')) ? $request->input('qrm2')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('oth1')) ? $request->input('oth1')[0] . ' ' : '';
                $concatenatedData .= !empty($request->input('oth2')) ? $request->input('oth2')[0] . ' ' : '';
                
                $concatenatedData = trim($concatenatedData);
                $identifers = 'Report Approval  '. uniqid();
                
                $report4 = new MarketComplaintGrids();
                $report4->identifers = $identifers; // Ensure this is 'identifiers' if that is the correct column name
                $report4->data = $concatenatedData;
        
                 $report4->save();





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
