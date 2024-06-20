<?php

namespace App\Http\Controllers;

use App\Models\OOS_micro;
use App\Services\OOSMicroService;

use App\Models\OOS_Micro_grid;
use App\Models\OOSmicroAuditTrail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\RecordNumber;
use App\Models\User;
use App\Models\RoleGroup;
use App\Models\Division;
use App\Models\QMSDivision;
use App\Models\Extension;
use Carbon\Carbon;
use Error;
use Helpers;
use App\Services\FileService;
use PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;

class OOSMicroController extends Controller
{
    public function index()
    {
        $cft = [];

        $old_record = OOS_micro::select('id', 'division_id', 'record')->get();
        
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $division = QMSDivision::where('name', Helpers::getDivisionName(session()->get('division')))->first();
        
        if ($division) {
            $last_oos = OOS_micro::where('division_id', $division->id)->latest()->first();
            if ($last_oos) {
                $record_number = $last_oos->record ? str_pad($last_oos->record + 1, 4, '0', STR_PAD_LEFT) : '0001';
                
            } else {
                $record_number = '0001';
            }
        }

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date= $formattedDate->format('Y-m-d');

        return view('frontend.OOS_Micro.oos_micro', compact('due_date', 'record_number', 'old_record', 'cft'));
    }

     public function store(Request $request){
        $micro = $request->all();

        $file_input_names = [
            'initial_attachment_gi',
            'file_attachments_pli',
            'supporting_attachment_plic',
            'supporting_attachments_plir',
            'attachment_piii',
            'attachments_piiqcr',
            'additional_testing_attachment_atp',
            'attachments_if_any_oosc',
            'conclusion_attachment_ocr',
            'cq_attachment_OOS_CQ',
            'disposition_attachment_BI',
            'reopen_attachment',
            'ua_approval_attachment',
            'ua_Execution_attachments',
            'uar_required_attachment',
            'uav_verification_attachment',
            'attachment_details_cibet',
            'attachment_details_cis',
            'attachment_details_cimlbwt',
            'attachment_details_cima',
            'attachment_details_ciem',
            'attachment_details_cimst',
        ];

        foreach ($file_input_names as $file_input_name)
        {
            $micro[$file_input_name] = FileService::uploadMultipleFiles($request, $file_input_name);
        }

        // ==================== close file attechment ================
        $micro['form_type'] = "OOS Microbiology";
        $micro['status'] = "Opened";
        $micro['stage'] = 1;
        $micro['division_id'] = $request->division_id;
        $OOSmicro = OOS_micro::create($micro);
        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();
        // $oosMicroGrid = $OOSmicro->id;

        $grid_inputs = [
            'info_product_material',
            'details_stability',
            'oos_detail',
            'oos_capa',
            'oos_conclusion',
            'oos_conclusion_review',
            "phase_I_investigation",
            "phase_IB_investigation",
            "analyst_training_proce",
            "sample_receiving_verification_lab",
            "method_procedure_used_during_analysis",
            "Instrument_Equipment_Det",
            "Results_and_Calculat",
            "Training_records_Analyst_Involved",
            "sample_intactness_before_analysis",
            "test_methods_Procedure",
            "Review_of_Media_Buffer_Standards_prep",
            "Checklist_for_Revi_of_Media_Buffer_Stand_prep",
            "check_for_disinfectant_detail",
            "Checklist_for_Review_of_instrument_equip",
            "Checklist_for_Review_of_Training_records_Analyst",
            "Checklist_for_Review_of_sampling_and_Transport",
            "Checklist_Review_of_Test_Method_proced",
            "Checklist_for_Review_Media_prepara_RTU_media",
            "Checklist_Review_Environment_condition_in_test",
            "review_of_instrument_bioburden_and_waters",
            "disinfectant_details_of_bioburden_and_water_test",
            "training_records_analyst_involvedIn_testing_microbial_asssay",
            "sample_intactness_before_analysis",
            "checklist_for_review_of_test_method_IMA",
            "cr_of_media_buffer_st_IMA",
            "CR_of_microbial_cultures_inoculation_IMA",
            "CR_of_Environmental_condition_in_testing_IMA",
            "CR_of_instru_equipment_IMA",
            "disinfectant_details_IMA",
            "CR_of_training_rec_anaylst_in_monitoring_CIEM",
            "Check_for_Sample_details_CIEM",
            "Check_for_comparision_of_results_CIEM",
            "checklist_for_media_dehydrated_CIEM",
            "checklist_for_media_prepara_sterilization_CIEM",
            "CR_of_En_condition_in_testing_CIEMs",
            "check_for_disinfectant_CIEM",
            "checklist_for_fogging_CIEM",
            "CR_of_test_method_CIEM",
            "CR_microbial_isolates_contamination_CIEM",
            "CR_of_instru_equip_CIEM",
            "Ch_Trend_analysis_CIEM",
            "checklist_for_analyst_training_CIMT",
            "checklist_for_comp_results_CIMT",
            "checklist_for_Culture_verification_CIMT",
            "sterilize_accessories_CIMT",
            "checklist_for_intrument_equip_last_CIMT",
            "disinfectant_details_last_CIMT",
            "checklist_for_result_calculation_CIMT",
            "phase_II_OOS_investigation"
        ];

        foreach ($grid_inputs as $grid_input)
        {
            OOSMicroService::store_grid($OOSmicro, $request, $grid_input);
        }

        //=========== Audit Trail -- For Store  =========================//

       
        if (!empty($micro->intiation_date)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = "Null";
            $history->current = $micro->intiation_date;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }

        if (!empty($micro->initiator_group_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Initiator Group';
            $history->previous = "Null";
            $history->current = $micro->initiator_group_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }

        if(!empty($micro->initiator_group_code_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Initiator Group Code';
            $history->previous = "Null";
            $history->current = $micro->initiator_group_code_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        }

        if(!empty($micro->initiated_through_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Initiated Through ?';
            $history->previous = "Null";
            $history->current = $micro->initiated_through_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        }

        if(!empty($micro->is_repeat_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Is Repeat ?';
            $history->previous = "Null";
            $history->current = $micro->is_repeat_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        } if(!empty($micro->repeat_nature_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = "Null";
            $history->current = $micro->repeat_nature_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        } if(!empty($micro->nature_of_change_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Nature of Change';
            $history->previous = "Null";
            $history->current = $micro->nature_of_change_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        } if(!empty($micro->deviation_occured_on_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Deviation Occured On';
            $history->previous = "Null";
            $history->current = $micro->deviation_occured_on_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        }
        if (!empty($micro->description_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Description';
            $history->previous = "Null";
            $history->current = $micro->description_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }

        if (!empty($micro->source_document_type_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Source Document Type';
            $history->previous = "Null";
            $history->current = $micro->source_document_type_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }

        if (!empty($micro->reference_system_document_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Reference System Document';
            $history->previous = "Null";
            $history->current = $micro->reference_system_document_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }
        if (!empty($micro->reference_document_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Reference Document';
            $history->previous = "Null";
            $history->current = $micro->reference_document_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }
        if (!empty($micro->sample_type_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type ='Sample Type';
            $history->previous = "Null";
            $history->current = $micro->sample_type_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }
        if (!empty($micro->product_material_name_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Product/Material Name';
            $history->previous = "Null";
            $history->current = $micro->product_material_name_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }
        if (!empty($micro->market_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Market';
            $history->previous = "Null";
            $history->current = $micro->market_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }


        if (!empty($micro->due_date)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current = $micro->due_date;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }

        if(!empty($micro->severity_level_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Severity Level';
            $history->previous = "Null";
            $history->current = $micro->severity_level_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();

        }

        if (!empty($micro->customer_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Customer';
            $history->previous = "Null";
            $history->current = $micro->customer_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $micro->status;
            $history->save();
        }



        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    //--------------Grid 1-------------------info on product /material-----------------
     }

       public function edit($id){

            $micro_data = OOS_micro::find($id);
            $old_record = OOS_micro::select('id', 'division_id', 'record')->get();
            $record_number = ((RecordNumber::first()->value('counter')) + 1);
            $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            // =========grid data========
            $info_product_materials = $micro_data->grids()->where('identifier', 'info_product_material')->first();
            $details_stabilities = $micro_data->grids()->where('identifier', 'details_stability')->first();
            $oos_details = $micro_data->grids()->where('identifier', 'oos_detail')->first();
            $oos_capas = $micro_data->grids()->where('identifier', 'oos_capa')->first();
            $oos_conclusions = $micro_data->grids()->where('identifier', 'oos_conclusion')->first();
            $oos_conclusion_reviews = $micro_data->grids()->where('identifier', 'oos_conclusion_review')->first();
            
            return view('frontend.OOS_Micro.oos_micro_view',compact('micro_data','record_number','old_record',
             'info_product_materials','details_stabilities','oos_details','oos_capas','oos_conclusions','oos_conclusion_reviews'));
       }
        public function update(Request $request, $id){
            
            $input = $request->all();
            
            $file_input_names = [
            'initial_attachment_gi',
            'file_attachments_pli',
            'supporting_attachment_plic',
            'supporting_attachments_plir',
            'attachment_piii',
            'attachments_piiqcr',
            'additional_testing_attachment_atp',
            'attachments_if_any_oosc',
            'conclusion_attachment_ocr',
            'cq_attachment_OOS_CQ',
            'disposition_attachment_BI',
            'reopen_attachment',
            'ua_approval_attachment',
            'ua_Execution_attachments',
            'uar_required_attachment',
            'uav_verification_attachment',
            'attachment_details_cibet',
            'attachment_details_cis',
            'attachment_details_cimlbwt',
            'attachment_details_cima',
            'attachment_details_ciem',
            'attachment_details_cimst',
            ];
            
            $micro = OOS_micro::find($id);
            $input['due_date'] = isset($request->due_date) ? $request->due_date : $micro['due_date'];
            $input['deviation_occured_on_gi'] = isset($request->deviation_occured_on_gi) ? $request->deviation_occured_on_gi : $micro['deviation_occured_on_gi'];

            $micro->initiator_id = Auth::user()->id;
            
            foreach ($file_input_names as $file_input_name)
            {
                // dd($input[$file_input_name]);
                if (empty($request->file($file_input_name)) && !empty($micro[$file_input_name])) {
                    // If the request does not contain file data but existing data is present, retain the existing data
                    $input[$file_input_name] = $micro[$file_input_name];
                } else {
                    // If the request contains file data or existing data is not present, upload new files
                    $input[$file_input_name] = FileService::uploadMultipleFiles($request, $file_input_name);
                }
            
            }

             // Find the OOS micro record by ID
            $micro->update($input);
            $micro = OOS_micro::with('grids')->find($id);

     //---------------------Audit Trail Update-------------------------------/////////////////
           $OOSmicro = OOS_micro::find($id);

           $lastDocument = OOS_micro::find($id);
          
        if($lastDocument->intiation_date != $micro->intiation_date || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Initiation Date';
            $history->previous = $lastDocument->intiation_date;
            $history->current = $micro->intiation_date;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
         if($lastDocument->due_date != $micro->due_date || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Due Date';
            $history->previous = $lastDocument->due_date;
            $history->current = $micro->due_date;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
         if($lastDocument->severity_level_gi != $micro->severity_level_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Severity Level';
            $history->previous = $lastDocument->severity_level_gi;
            $history->current = $micro->severity_level_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->initiator_group_gi != $micro->initiator_group_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Initiator Group';
            $history->previous = $lastDocument->initiator_group_gi;
            $history->current = $micro->initiator_group_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
         if($lastDocument->initiator_group_code_gi != $micro->initiator_group_code_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Initiator Group Code';
            $history->previous = $lastDocument->initiator_group_code_gi;
            $history->current = $micro->initiator_group_code_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->initiated_through_gi != $micro->initiated_through_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Initiated Through';
            $history->previous = $lastDocument->initiated_through_gi;
            $history->current = $micro->initiated_through_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->if_others_gi != $micro->if_others_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'If Others';
            $history->previous = $lastDocument->if_others_gi;
            $history->current = $micro->if_others_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->is_repeat_gi != $micro->is_repeat_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Is Repeat ?';
            $history->previous = $lastDocument->is_repeat_gi;
            $history->current = $micro->is_repeat_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->repeat_nature_gi != $micro->repeat_nature_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = $lastDocument->repeat_nature_gi;
            $history->current = $micro->repeat_nature_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->nature_of_change_gi != $micro->nature_of_change_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Nature of Change';
            $history->previous = $lastDocument->nature_of_change_gi;
            $history->current = $micro->nature_of_change_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
         if($lastDocument->deviation_occured_on_gi != $micro->deviation_occured_on_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Deviation Occured On';
            $history->previous = $lastDocument->deviation_occured_on_gi;
            $history->current = $micro->deviation_occured_on_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        // $array = [
        //     "description_gi" => "Description"
        // ];

        // foreach ($array as $index => $val) {
        //     $request
        // }
        if($lastDocument->description_gi != $micro->description_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Description';
            $history->previous = $lastDocument->description_gi;
            $history->current = $micro->description_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
         if($lastDocument->source_document_type_gi != $micro->source_document_type_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Source Document Type';
            $history->previous = $lastDocument->source_document_type_gi;
            $history->current = $micro->source_document_type_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->reference_document_gi != $micro->reference_document_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Reference Document';
            $history->previous = $lastDocument->reference_document_gi;
            $history->current = $micro->reference_document_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if($lastDocument->sample_type_gi != $micro->sample_type_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Sample Type';
            $history->previous = $lastDocument->sample_type_gi;
            $history->current = $micro->sample_type_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->product_material_name_gi != $micro->product_material_name_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Product/Material Name';
            $history->previous = $lastDocument->product_material_name_gi;
            $history->current = $micro->product_material_name_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->market_gi != $micro->market_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Market';
            $history->previous = $lastDocument->market_gi;
            $history->current = $micro->market_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if($lastDocument->customer_gi != $micro->customer_gi || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = 'Customer';
            $history->previous = $lastDocument->customer_gi;
            $history->current = $micro->customer_gi;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
 //  Preliminary Lab Investigation

 $Preliminary_Lab_Investigation = [
    'comments_pli' => 'Comments',
    'field_alert_required_pli' => 'Field Alert Required',
    'field_alert_ref_no_pli' => 'Field Alert Ref.No.',
    'justify_if_no_field_alert_pli' => 'Justify if no Field Alert',
    'verification_analysis_required_pli' => 'Verification Analysis Required',
    'verification_analysis_ref_pli' => 'Verification Analysis Ref.',
    'analyst_interview_req_pli' => 'Analyst Interview Req.',
    'analyst_interview_ref_pli' => 'Analyst Interview Ref.',
    'justify_if_no_analyst_int_pli' => 'Justify if no Analyst Int.',
    'phase_i_investigation_required_pli' => 'Phase I Investigation Required',
    'phase_i_investigation_pli' => 'Phase I Investigation ',
    'phase_i_investigation_ref_pli' => 'Phase I Investigation Ref.',
];
    foreach ($Preliminary_Lab_Investigation as $key => $value){

         if($lastDocument->$key != $micro->$key || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = $value;
            $history->previous = $lastDocument->$key;
            $history->current = $micro->$key;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
    }

//Preliminary lab investigation conclusion
$Preliminary_Lab_Investigation_Conclusion = [
    'summary_of_prelim_investiga_plic' => 'Summary of Prelim.Investigation',
    'root_cause_identified_plic' => 'Root Cause Identified',
    'oos_category_root_cause_ident_plic' => 'OOS Category-Root Cause Ident.',
    'oos_category_others_plic' => 'OOS Category(Others)',
    'root_cause_details_plic' => 'Root Cause Details',
    'oos_category_root_cause_plic' => 'OOS Category-Root Cause Ident.',
    'recommended_actions_required_plic' => 'Recommended Actions Required?',
    'recommended_actions_reference_plic' => 'Recommended Actions Reference',
    'capa_required_plic' => 'CAPA Required',
    'reference_capa_no_plic' => 'Reference CAPA No.',
    'delay_justification_for_pi_plic' => 'Delay Justification for P.I.',
];
    foreach($Preliminary_Lab_Investigation_Conclusion as $key => $value){
        if($lastDocument->$key != $micro->$key || !empty($request->comment)){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id =$id;
            $history->activity_type = $value;
            $history->previous = $lastDocument->$key;
            $history->current = $micro->$key;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
    }

//Preliminary lab invst review

$Preliminary_lab_invst_review = [
    'review_comments_plir' => 'Review Comments',
    'phase_ii_inv_required_plir' => 'Phase II Inv. Required?',
];

foreach($Preliminary_lab_invst_review as $key => $value){
    if($lastDocument->$key != $micro->$key || !empty($request->comment)){
        $history =  new OOSmicroAuditTrail();
        $history->OOS_micro_id =$id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current = $micro->$key;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->save();
    }
}

//Phase II Investigation
$Phase_II_Investigation = [
    'qa_approver_comments_piii' => 'QA Approver Comments',
    'manufact_invest_required_piii' => 'Manufact. Invest. Required?',
    'manufacturing_invest_type_piii' => 'Manufacturing Invest. Type',
    'manufacturing_invst_ref_piii' => 'Manufacturing Invst. Ref.',
    're_sampling_required_piii' => 'Re-sampling Required?',
    'audit_comments_piii' => 'Audit Comments',
    're_sampling_ref_no_piii' => 'Re-sampling Ref. No.',
    'hypo_exp_required_piii' => 'Hypo/Exp.Required',
    'hypo_exp_reference_piii' => 'Hypo/Exp. Reference',
];

foreach($Phase_II_Investigation as $key => $value ){
    if($lastDocument->$key != $micro->$key || !empty($request->comment)){
        $history =  new OOSmicroAuditTrail();
        $history->OOS_micro_id =$id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current = $micro->$key;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->save();
    }
}

//Phase II QC REview

$Phase_II_QC_Review = [
    'summary_of_exp_hyp_piiqcr' => 'Summary of Exp./Hyp.',
    'summary_mfg_investigation_piiqcr' => 'Summary Mfg.Investigation',
    'root_casue_identified_piiqcr' => 'Root Cause Identified',
    'oos_category_reason_identified_piiqcr' => 'OOS Category-Reason Identified',
    'others_oos_category_piiqcr' => 'Others (OOS category)',
    'details_of_root_cause_piiqcr' => 'Details of Root Cause',
    'impact_assessment_piiqcr' =>'Impact Assessment',
    'recommended_action_required_piiqcr' => 'Recommended Action Required?',
    'recommended_action_reference_piiqcr' => 'Recommended Action Reference',
    'investi_required_piiqcr' => 'Invest.Required',
    'invest_ref_piiqcr' => 'Invest ref.',
];

foreach($Phase_II_QC_Review as $key => $value){

    if($lastDocument->$key != $micro->$key || !empty($request->comment)){
        $history =  new OOSmicroAuditTrail();
        $history->OOS_micro_id =$id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current = $micro->$key;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->save();
    }
}

// Additional testing Proposal

$Additional_Testing_Proposal = [
    'review_comment_atp' => 'Review Comment',
    'additional_test_proposal_atp' => 'Additional Test Proposal',
    'additional_test_reference_atp' => 'Additional Test Reference',
    'any_other_actions_required_atp' => 'Any Other Actions Required',
    'action_task_reference_atp' => 'Action Task Reference',
];
foreach($Additional_Testing_Proposal as $key => $value){

    if($lastDocument->$key != $micro->$key || !empty($request->comment)){
        $history =  new OOSmicroAuditTrail();
        $history->OOS_micro_id =$id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current = $micro->$key;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->save();
    }
}

$OOS_Conclusion = [
    "conclusion_comments_oosc" => 'Conclusion Comments',
    "specification_limit_oosc" => 'Specification Limit',
    "results_to_be_reported_oosc" => 'Results to be Reported',
    "final_reportable_results_oosc" => 'Final Reportable Results',
    "justifi_for_averaging_results_oosc" => 'Justifi. for Averaging Results',
    "oos_stands_oosc" => 'OOS Stands',
    "capa_req_oosc" => 'CAPA Req.',
    "capa_ref_no_oosc" => 'CAPA Ref No.',
    "justify_if_capa_not_required_oosc" => 'Justify if CAPA not required',
    "action_plan_req_oosc" => 'Action Plan Req.',
    "action_plan_ref_oosc" => 'Action Plan Ref.',
    "justification_for_delay_oosc" => 'Justification for Delay',
];

foreach($OOS_Conclusion as $key => $value){
    if($lastDocument->$key != $micro->$key || !empty($request->comment)){
        $history =  new OOSmicroAuditTrail();
        $history->OOS_micro_id =$id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current = $micro->$key;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->save();
    }
}

//OOS_Conclusion_Review

$OOS_Conclusion_Review = [
    "conclusion_review_comments_ocr" => 'Conclusion Review Comments',
    "action_taken_on_affec_batch_ocr" => 'Action Taken on Affec.batch',
    "capa_req_ocr" => 'CAPA Req.?',
    "capa_refer_ocr" => 'CAPA Refer.',
    "required_action_plan_ocr" => 'Required Action Plan?',
    "required_action_task_ocr" => 'Required Action Task?',
    "action_task_reference_ocr" => 'Action Task Reference',
    "risk_assessment_req_ocr" => 'Risk Assessment Req?',
    "risk_assessment_ref_ocr" => 'Risk Assessment Ref.',
    "justify_if_no_risk_assessment_ocr" => 'Justify if no risk Assessment',
    "qa_approver_ocr" => 'CQ Approver',
];
foreach($OOS_Conclusion_Review as $key => $value){

    if($lastDocument->$key != $micro->$key || !empty($request->comment)){
        $history =  new OOSmicroAuditTrail();
        $history->OOS_micro_id =$id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current = $micro->$key;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->save();
    }
}
//OOS CQ Review

$OOS_CQ_Review = [
    "capa_required_OOS_CQ" => 'CAPA required?',
    "ref_action_plan_OOS_CQ" => 'Ref Action Plan',
    "reference_of_capa_OOS_CQ" => 'Reference of CAPA',
    "cq_review_comments_OOS_CQ" => 'CQ Review Comments',
    "action_plan_requirement_OOS_CQ" => 'Action plan requirement?',
];
foreach($OOS_CQ_Review as $key => $value){

    if($lastDocument->$key != $micro->$key || !empty($request->comment)){
        $history =  new OOSmicroAuditTrail();
        $history->OOS_micro_id =$id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current = $micro->$key;
        $history->comment = $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->save();
    }
}
//  Batch Disposition
        $batchDisposition = [
            'others_BI' => 'Others',
            'oos_category_BI' => 'OOS Category',
            'material_batch_release_BI' => 'Material/Batch Release',
            'other_action_BI' => 'Other Action (Specify)',
            'field_alert_reference_BI' => 'Field Alert Reference',
            'other_parameter_result_BI' => 'Other Parameters Results',
            'trend_of_previous_batches_BI' => 'Trend of Previous Batches',
            'stability_data_BI' => 'Stability Data',
            'process_validation_data_BI' => 'Process Validation Data',
            'method_validation_BI' => 'Method Validation',
            'any_market_complaints_BI' => 'Any Market Complaints',
            'statistical_evaluation_BI' => 'Statistical Evaluation',
            'risk_analysis_for_disposition_BI' => 'Risk Analysis for Disposition',
            'conclusion_BI' => 'Conclusion',
            'phase_III_inves_required_BI' => 'Phase-III Inves.Required?',
            'phase_III_inves_reference_BI' => 'Phase-III Inves.Reference',
            'justify_for_delay_BI' => 'Justify for Delay in Activity',
            'reopen_request'=> 'Other Action (Specify)',
        ];

        foreach ($batchDisposition as $key => $value) {

            if($lastDocument->$key != $micro->$key || !empty($request->comment)){
                $history =  new OOSmicroAuditTrail();
                $history->OOS_micro_id =$id;
                $history->activity_type = $value;
                $history->previous = $lastDocument->$key;
                $history->current = $micro->$key;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
        }

        $oosMicroGrid=$OOSmicro->id;
           
            $grid_inputs = [
                    'info_product_material',
                    'details_stability',
                    'oos_detail',
                    'oos_capa',
                    'oos_conclusion',
                    'oos_conclusion_review',
                    "phase_I_investigation",
                    "analyst_training_proce",
                    "sample_receiving_verification_lab",
                    "method_procedure_used_during_analysis",
                    "Instrument_Equipment_Det",
                    "Results_and_Calculat",
                    "Training_records_Analyst_Involved",
                    "sample_intactness_before_analysis",
                    "test_methods_Procedure",
                    "Review_of_Media_Buffer_Standards_prep",
                    "Checklist_for_Revi_of_Media_Buffer_Stand_prep",
                    "check_for_disinfectant_detail",
                    "Checklist_for_Review_of_instrument_equip",
                    "Checklist_for_Review_of_Training_records_Analyst",
                    "Checklist_for_Review_of_sampling_and_Transport",
                    "Checklist_Review_of_Test_Method_proced",
                    "Checklist_for_Review_Media_prepara_RTU_media",
                    "Checklist_Review_Environment_condition_in_test",
                    "review_of_instrument_bioburden_and_waters",
                    "disinfectant_details_of_bioburden_and_water_test",
                    "training_records_analyst_involvedIn_testing_microbial_asssay",
                    "sample_intactness_before_analysis",
                    "checklist_for_review_of_test_method_IMA",
                    "cr_of_media_buffer_st_IMA",
                    "CR_of_microbial_cultures_inoculation_IMA",
                    "CR_of_Environmental_condition_in_testing_IMA",
                    "CR_of_instru_equipment_IMA",
                    "disinfectant_details_IMA",
                    "CR_of_training_rec_anaylst_in_monitoring_CIEM",
                    "Check_for_Sample_details_CIEM",
                    "Check_for_comparision_of_results_CIEM",
                    "checklist_for_media_dehydrated_CIEM",
                    "checklist_for_media_prepara_sterilization_CIEM",
                    "CR_of_En_condition_in_testing_CIEMs",
                    "check_for_disinfectant_CIEM",
                    "checklist_for_fogging_CIEM",
                    "CR_of_test_method_CIEM",
                    "CR_microbial_isolates_contamination_CIEM",
                    "CR_of_instru_equip_CIEM",
                    "Ch_Trend_analysis_CIEM",
                    "checklist_for_analyst_training_CIMT",
                    "checklist_for_comp_results_CIMT",
                    "checklist_for_Culture_verification_CIMT",
                    "sterilize_accessories_CIMT",
                    "checklist_for_intrument_equip_last_CIMT",
                    "disinfectant_details_last_CIMT",
                    "checklist_for_result_calculation_CIMT",
                    "phase_II_OOS_investigation",
                    "microbial_isolates_bioburden"
                ];

                foreach ($grid_inputs as $grid_input)
                {
                    OOSMicroService::update_grid($micro, $request, $grid_input);
                }
                toastr()->success('Record is Update Successfully');
                return back();

}

// ============= stage change =========

public function send_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changestage = OOS_micro::find($id);
            $lastDocument = OOS_micro::find($id);
            if ($changestage->stage == 1) {
                $changestage->stage = "2";
                $changestage->status = "Pending Initial Assessment & LabIncident";
                $changestage->completed_by_pending_initial_assessment = Auth::user()->name;
                $changestage->completed_on_pending_initial_assessment = Carbon::now()->format('d-M-Y');
                $changestage->comment_pending_initial_assessment = $request->comment;
                                $history = new OOSmicroAuditTrail();
                                $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                            $history = new OOSmicroAuditTrail();
                            $history->oos_micro_id = $id;
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

                $history = new OOSmicroAuditTrail();
                $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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

                $history = new OOSmicroAuditTrail();
                $history->oos_micro_id = $id;
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

                $history = new OOSmicroAuditTrail();
                $history->oos_micro_id = $id;
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
            $changestage = OOS_MICRO::find($id);
            $lastDocument = OOS_MICRO::find($id);
            if ($changestage->stage == 2) {
                $changestage->stage = "1";
                $changestage->status = "Opened";
                $changestage->completed_by_pending_initial_assessment = Auth::user()->name;
                $changestage->completed_on_pending_initial_assessment = Carbon::now()->format('d-M-Y');
                $changestage->comment_pending_initial_assessment = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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

                $history = new OOSmicroAuditTrail();
                $history->oos_micro_id = $id;
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

                $history = new OOSmicroAuditTrail();
                $history->oos_micro_id = $id;
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

                $history = new OOSmicroAuditTrail();
                $history->oos_micro_id = $id;
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

                $history = new OOSmicroAuditTrail();
                $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
            $changestage = OOS_MICRO::find($id);
            $lastDocument = OOS_MICRO::find($id);
            if ($changestage->stage == 3) {
                $changestage->stage = "4";
                $changestage->status = "Under Phase I Correction";
                $changestage->completed_by_under_phaseI_correction= Auth::user()->name;
                $changestage->completed_on_under_phaseI_correction = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseI_correction = $request->comment;
                            $history = new OOSmicroAuditTrail();
                            $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
            $data = OOS_MICRO::find($id);
            $lastDocument = OOS_MICRO::find($id);
            $data->stage = "0";
            $data->status = "Closed-Cancelled";
            $data->cancelled_by = Auth::user()->name;
            $data->cancelled_on = Carbon::now()->format('d-M-Y');
            $data->comment_cancle = $request->comment;

                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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

    public function AuditTrial($id)
    {
        $audit = OOSmicroAuditTrail::where('oos_micro_id', $id)->orderByDesc('id')->paginate(5);

        $today = Carbon::now()->format('d-m-y');
        $document = OOS_MICRO::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
        // dd();
        return view('frontend.OOS_Micro.comps_micro.audit-trial', compact('audit', 'document', 'today'));
    }

    public function auditDetails($id)
    {

        $detail = OOSmicroAuditTrail::find($id);


        $detail_data = OOSmicroAuditTrail::where('activity_type', $detail->activity_type)->where('oos_micro_id', $detail->id)->latest()->get();

        $doc = OOS_MICRO::where('id', $detail->oos_micro_id)->first();

        // dd($doc);
        // $doc->origiator_name = User::find($doc->initiator_id);

        return view('frontend.OOS_Micro.comps_micro.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
    }
    public static function auditReport($id)
    {
        $doc = OOS_MICRO::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $data = OOSmicroAuditTrail::where('oos_micro_id', $id)->get();
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.OOS_Micro.oos_micro_auditReport', compact('data', 'doc'))
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
        $data = OOS_MICRO::find($id);
        if (!empty($data)) {
            $data->info_product_materials = $data->grids()->where('identifier', 'info_product_material')->first();
            $data->details_stabilities = $data->grids()->where('identifier', 'details_stability')->first();
            $data->oos_details = $data->grids()->where('identifier', 'oos_detail')->first();
            $data->checklist_lab_invs = $data->grids()->where('identifier', 'checklist_lab_inv')->first();
            $data->oos_capas = $data->grids()->where('identifier', 'oos_capa')->first();
            $data->phase_two_invs = $data->grids()->where('identifier', 'phase_two_inv')->first();
            $data->oos_conclusions = $data->grids()->where('identifier', 'oos_conclusion')->first();
            $data->oos_conclusion_reviews = $data->grids()->where('identifier', 'oos_conclusion_review')->first();

            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.OOS.comps.singleReport', compact('data'))
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
