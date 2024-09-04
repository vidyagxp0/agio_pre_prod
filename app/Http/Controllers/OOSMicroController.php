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
        $old_records = OOS_micro::select('id', 'division_id', 'record')->get();
        
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $division = QMSDivision::where('name', Helpers::getDivisionName(session()->get('division')))->first();
        
        // if ($division) {
        //     $last_oos = OOS_micro::where('division_id', $division->id)->latest()->first();
        //         if ($last_oos) {
        //             $record_number = $last_oos->record ? str_pad($last_oos->record + 1, 4, '0', STR_PAD_LEFT) : '0001';
        //         } else {
        //             $record_number = '0001';
        //         }
        // }

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date= $formattedDate->format('Y-m-d');

        return view('frontend.OOS_Micro.oos_micro', compact('due_date', 'record_number', 'old_records', 'cft'));
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
        $micro['record_number'] = "$request->record_number";
        $micro['due_date'] = $request->due_date;
        $micro['status'] = "Opened";
        $micro['stage'] = 1;
        $micro['division_id'] = $request->division_id;
        $OOSmicro = OOS_micro::create($micro);
    //    record update
        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();
        // ============ grid store ==========
        $grid_inputs = [
            'info_product_material',
            'details_stability',
            'oos_detail',
            'products_details',
            'instrument_details',
            'oos_capa',
            'oos_conclusion',
            'oos_conclusion_review',
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
        if (!empty($OOSmicro->initiator)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = $OOSmicro->initiator;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($OOSmicro->intiation_date)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Initiation Date';
            $history->previous = "Null";
            $history->current = $OOSmicro->intiation_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($OOSmicro->record)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Record Number';
            $history->previous = "Null";
            $history->current = $OOSmicro->record;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($request->description_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $request->description_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($request->due_date)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current = $request->due_date;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        
        if(!empty($request->severity_level_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Severity Level';
            $history->previous = "Null";
            $history->current = $request->severity_level_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        }
        if (!empty($request->initiator_group_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Initiation Department';
            $history->previous = "Null";
            $history->current = $request->initiator_group_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if(!empty($request->initiator_group_code_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Initiation Department Group Code';
            $history->previous = "Null";
            $history->current = $request->initiator_group_code_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        }
        if(!empty($request->initiated_through_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Initiated Through ?';
            $history->previous = "Null";
            $history->current = $request->initiated_through_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        }
        if(!empty($request->if_others_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'If Others';
            $history->previous = "Null";
            $history->current = $request->if_others_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        }
        if(!empty($request->is_repeat_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Is Repeat ?';
            $history->previous = "Null";
            $history->current = $request->is_repeat_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
             $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        } 
        if(!empty($request->reference_system_document_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Reference System Document';
            $history->previous = "Null";
            $history->current = $request->reference_system_document_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
             $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        } 
        if(!empty($request->reference_document_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Reference Document';
            $history->previous = "Null";
            $history->current = $request->reference_document_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
             $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        } 
        if(!empty($request->repeat_nature_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = "Null";
            $history->current = $request->repeat_nature_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
             $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        } 
        if(!empty($request->nature_of_change_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Nature of Change';
            $history->previous = "Null";
            $history->current = $request->nature_of_change_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
             $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        } 
        if(!empty($request->deviation_occured_on_gi)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'OOS occurred On';
            $history->previous = "Null";
            $history->current = $request->deviation_occured_on_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
             $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        }
        if(!empty($request->oos_observed_on)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'OOS Observed On';
            $history->previous = "Null";
            $history->current = $request->oos_observed_on;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
             $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        }
        if(!empty($request->delay_justification)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Delay Justification';
            $history->previous = "Null";
            $history->current = $request->delay_justification;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
             $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        }
        if(!empty($request->oos_reported_date)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'OOS Reported On';
            $history->previous = "Null";
            $history->current = $request->oos_reported_date;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
             $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        }
        if(!empty($request->immediate_action)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Immediate action';
            $history->previous = "Null";
            $history->current = $request->immediate_action;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
             $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

        }
        // if(!empty($request->initial_attachment_gi)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->activity_type = 'Initial Attachment';
        //     $history->previous = "Null";
        //     $history->current = $request->initial_attachment_gi;
        //     $history->comment = "NA";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $request->status;
        //      $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->save();

        // }
        if (!empty($request->initial_attachment_gi)) {
            // Convert the array to a comma-separated string
            $attachmentString = is_array($request->initial_attachment_gi) 
                ? implode(', ', $request->initial_attachment_gi) 
                : (string)$request->initial_attachment_gi;
        
            // Initialize the history object
            $history = new OOSmicroAuditTrail();
        
            // Populate history object with data
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Initial Attachment';
            $history->previous = "Null";
            $history->current = $attachmentString; // Store as a string
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
        
            // Save history to the database
            $history->save();
        }
        
      
        if (!empty($request->source_document_type_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Source Document Type';
            $history->previous = "Null";
            $history->current = $request->source_document_type_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
             $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
       
        if (!empty($request->sample_type_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type ='Sample Type';
            $history->previous = "Null";
            $history->current = $request->sample_type_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($request->product_material_name_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Product/Material Name';
            $history->previous = "Null";
            $history->current = $request->product_material_name_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
             $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($request->market_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Market';
            $history->previous = "Null";
            $history->current = $request->market_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
             $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($request->customer_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Customer';
            $history->previous = "Null";
            $history->current = $request->customer_gi;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        // TapII
        if (!empty($request->Comments_plidata)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Comments Plidata';
            $history->current = $OOSmicro->Comments_plidata;
            $history->save();
        }
        if (!empty($request->comments_pli)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "'Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Comments';
            $history->current = $OOSmicro->comments_pli;
            $history->save();
        }
        if (!empty($request->field_alert_required_pli)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "'Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Field Alert Required';
            $history->current = $OOSmicro->field_alert_required_pli;
            $history->save();
        }
        // if (!empty($request->field_alert_ref_no_pli)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "'Initiation";
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Field Alert Ref.No.';
        //     $history->current = $OOSmicro->field_alert_ref_no_pli;
        //     $history->save();
        // }
        if (!empty($request->justify_if_no_field_alert_pli)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "'Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Justify If No Field Alert Pli';
            $history->current = $OOSmicro->justify_if_no_field_alert_pli;
            $history->save();
        }
        if (!empty($request->verification_analysis_required_pli)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "'Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Verification Analysis Required';
            $history->current = $OOSmicro->verification_analysis_required_pli;
            $history->save();
        }
        // if (!empty($request->verification_analysis_ref_pli)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "'Initiation";
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Verification Analysis Ref.';
        //     $history->current = $OOSmicro->verification_analysis_ref_pli;
        //     $history->save();
        // }
        if (!empty($request->analyst_interview_req_pli)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "'Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Analyst Interview Req.';
            $history->current = $OOSmicro->analyst_interview_req_pli;
            $history->save();
        }
        // if (!empty($request->analyst_interview_ref_pli)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "'Initiation";
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Analyst Interview Ref.';
        //     $history->current = $OOSmicro->analyst_interview_ref_pli;
        //     $history->save();
        // }
        if (!empty($request->justify_if_no_analyst_int_pli)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "'Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Justify if no Analyst Int';
            $history->current = $request->justify_if_no_analyst_int_pli;
            $history->save();
        }
        if (!empty($request->phase_i_investigation_required_pli)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "'Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Phase I Investigation Required';
            $history->current = $request->phase_i_investigation_required_pli;
            $history->save();
        }
        if (!empty($request->phase_i_investigation_pli)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Phase I Investigation';
            $history->current = $request->phase_i_investigation_pli;
            $history->save();
        }
        // if (!empty($request->phase_i_investigation_ref_pli)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Phase I Investigation Ref.';
        //     $history->current = $request->phase_i_investigation_ref_pli;
        //     $history->save();
        // }
        // if (!empty($request->file_attachments_pli)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'File Attachments';
        //     $history->current = $request->file_attachments_pli;
        //     $history->save();
        // }
        if (!empty($request->file_attachments_pli)) {
            // Convert the array to a comma-separated string
            $attachmentString = is_array($request->file_attachments_pli) 
                ? implode(', ', $request->file_attachments_pli) 
                : (string)$request->file_attachments_pli;
        
            // Initialize the history object
            $history = new OOSmicroAuditTrail();
        
            // Populate history object with data
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'File Attachment';
            $history->previous = "Null";
            $history->current = $attachmentString; // Store as a string
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $request->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
        
            // Save history to the database
            $history->save();
        }
        // TapIV
        if (!empty($request->summary_of_prelim_investiga_plic)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Summary of Preliminary Investigation';
            $history->current = $request->summary_of_prelim_investiga_plic;
            $history->save();
        }
        if (!empty($request->root_cause_identified_plic)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Root Cause Identified';
            $history->current = $request->root_cause_identified_plic;
            $history->save();
        }
        if (!empty($request->oos_category_root_cause_ident_plic)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'OOS Category-Root Cause Ident';
            $history->current = $request->oos_category_root_cause_ident_plic;
            $history->save();
        }
        if (!empty($request->root_cause_details_plic)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Root Cause Details';
            $history->current = $request->root_cause_details_plic;
            $history->save();
        }
        // if (!empty($request->oos_category_others_plic)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Root Cause Details';
        //     $history->current = $request->oos_category_others_plic;
        //     $history->save();
        // }
        if (!empty($request->oos_category_root_cause_plic)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'OOS Category-Root Cause Ident.';
            $history->current = $request->oos_category_root_cause_plic;
            $history->save();
        }
        if (!empty($request->recommended_actions_required_plic)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Recommended Actions Required?';
            $history->current = $request->recommended_actions_required_plic;
            $history->save();
        }
        // if (!empty($request->recommended_actions_reference_plic)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Recommended Actions Reference';
        //     $history->current = $request->recommended_actions_reference_plic;
        //     $history->save();
        // }
        if (!empty($request->supporting_attachment_plic)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Supporting Attachment';
            $history->current = $request->supporting_attachment_plic;
            $history->save();
        }
        if (!empty($request->oos_category_others_plic)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'OOS Category-Root Cause Ident';
            $history->current = $request->oos_category_others_plic;
            $history->save();
        }
        if (!empty($request->capa_required_plic)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'CAPA Required';
            $history->current = $request->capa_required_plic;
            $history->save();
        }
        if (!empty($request->reference_capa_no_plic)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Reference CAPA No';
            $history->current = $request->reference_capa_no_plic;
            $history->save();
        }
        if (!empty($request->delay_justification_for_pi_plic)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Delay Justification for Preliminary Investigation';
            $history->current = $request->delay_justification_for_pi_plic;
            $history->save();
        }
        // TapV5
        if (!empty($request->review_comments_plir)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Review Comments';
            $history->current = $request->review_comments_plir;
            $history->save();
        }
        if (!empty($request->phase_ii_inv_required_plir)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->activity_type = 'Phase II Inv. Required';
            $history->current = $request->phase_ii_inv_required_plir;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            // $history->stage = $OOSmicro->stage;
            $history->change_from = "Initiation";
            $history->change_to =   "Opened";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($request->qa_approver_comments_piii)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'QA Approver Comments';
            $history->current = $request->qa_approver_comments_piii;
            $history->save();
        }
        if (!empty($request->manufact_invest_required_piii)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Manufact. Invest. Required?';
            $history->current = $request->manufact_invest_required_piii;
            $history->save();
        }
        if (!empty($request->reason_manufacturing_pii)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Reason for manufacturing';
            $history->current = $request->reason_manufacturing_pii;
            $history->save();
        }
        if (!empty($request->manufacturing_multi_select)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Manufacturing Invest. Type';
            $history->current = $request->manufacturing_multi_select;
            $history->save();
        }
        // if (!empty($request->manufacturing_invst_ref_piii)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Manufacturing Invst. Ref.';
        //     $history->current = $request->manufacturing_invst_ref_piii;
        //     $history->save();
        // }
        if (!empty($request->re_sampling_required_piii)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Re-sampling Required?';
            $history->current = $request->re_sampling_required_piii;
            $history->save();
        }
        if (!empty($request->audit_comments_piii)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Audit Comments';
            $history->current = $request->audit_comments_piii;
            $history->save();
        }
        // if (!empty($request->re_sampling_ref_no_piii)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation"; 
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Re-sampling Ref. No';
        //     $history->current = $request->re_sampling_ref_no_piii;
        //     $history->save();
        // }
        if (!empty($request->hypo_exp_required_piii)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Hypo/Exp.Required';
            $history->current = $request->hypo_exp_required_piii;
            $history->save();
        }
       
        // if (!empty($request->hypo_exp_reference_piii)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation"; 
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Hypo/Exp. Reference';
        //     $history->current = $request->hypo_exp_reference_piii;
        //     $history->save();
        // }
        if (!empty($request->summary_of_exp_hyp_piiqcr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Summary of Exp./Hyp.';
            $history->current = $request->summary_of_exp_hyp_piiqcr;
            $history->save();
        }
        if (!empty($request->summary_mfg_investigation_piiqcr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Summary Mfg.Investigation';
            $history->current = $request->summary_mfg_investigation_piiqcr;
            $history->save();
        }
        if (!empty($request->root_casue_identified_piiqcr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Root Cause Identified';
            $history->current = $request->root_casue_identified_piiqcr;
            $history->save();
        }
        if (!empty($request->oos_category_reason_identified_piiqcr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'OOS Category-Reason Identified';
            $history->current = $request->oos_category_reason_identified_piiqcr;
            $history->save();
        }
        if (!empty($request->others_oos_category_piiqcr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Others (OOS category)';
            $history->current = $request->others_oos_category_piiqcr;
            $history->save();
        }
        if (!empty($request->oos_details_obvious_error)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Details of Obvious Error';
            $history->current = $request->oos_details_obvious_error;
            $history->save();
        }
        if (!empty($request->details_of_root_cause_piiqcr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Details of Root Cause';
            $history->current = $request->details_of_root_cause_piiqcr;
            $history->save();
        }
        if (!empty($request->impact_assessment_piiqcr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Impact Assessment';
            $history->current = $request->impact_assessment_piiqcr;
            $history->save();
        }
        if (!empty($request->recommended_action_required_piiqcr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Recommended Action Required?';
            $history->current = $request->recommended_action_required_piiqcr;
            $history->save();
        }
        // if (!empty($request->recommended_action_reference_piiqcr)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation"; 
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Recommended Action Reference';
        //     $history->current = $request->recommended_action_reference_piiqcr;
        //     $history->save();
        // }
        if (!empty($request->investi_required_piiqcr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Invest.Required';
            $history->current = $request->investi_required_piiqcr;
            $history->save();
        }
        // if (!empty($request->invest_ref_piiqcr)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation"; 
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Invest ref.';
        //     $history->current = $request->invest_ref_piiqcr;
        //     $history->save();
        // }
        if (!empty($request->review_comment_atp)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Review Comment';
            $history->current = $request->review_comment_atp;
            $history->save();
        }
        if (!empty($request->additional_test_proposal_atp)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Additional Test Proposal';
            $history->current = $request->additional_test_proposal_atp;
            $history->save();
        }
        // if (!empty($request->additional_test_reference_atp)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation"; 
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Additional Test Reference';
        //     $history->current = $request->additional_test_reference_atp;
        //     $history->save();
        // }
        
        if (!empty($request->any_other_actions_required_atp)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Any Other Actions Required';
            $history->current = $request->any_other_actions_required_atp;
            $history->save();
        }
        // if (!empty($request->action_task_reference_atp)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation"; 
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Action Task Reference';
        //     $history->current = $request->action_task_reference_atp;
        //     $history->save();
        // }
        if (!empty($request->conclusion_comments_oosc)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Conclusion Comments';
            $history->current = $request->conclusion_comments_oosc;
            $history->save();
        }
        if (!empty($request->specification_limit_oosc)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Specification Limit';
            $history->current = $request->specification_limit_oosc;
            $history->save();
        }
        if (!empty($request->results_to_be_reported_oosc)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Results to be Reported';
            $history->current = $request->results_to_be_reported_oosc;
            $history->save();
        }
        if (!empty($request->final_reportable_results_oosc)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Final Reportable Results';
            $history->current = $request->final_reportable_results_oosc;
            $history->save();
        }
        if (!empty($request->justifi_for_averaging_results_oosc)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Justifi. for Averaging Results';
            $history->current = $request->justifi_for_averaging_results_oosc;
            $history->save();
        }
        if (!empty($request->oos_stands_oosc)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'OOS Stands';
            $history->current = $request->oos_stands_oosc;
            $history->save();
        }
        if (!empty($request->capa_req_oosc)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'CAPA Req.';
            $history->current = $request->capa_req_oosc;
            $history->save();
        }
        // if (!empty($request->capa_ref_no_oosc)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation"; 
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'CAPA Ref No.';
        //     $history->current = $request->capa_ref_no_oosc;
        //     $history->save();
        // }
        if (!empty($request->justify_if_capa_not_required_oosc)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Justify if CAPA not required';
            $history->current = $request->justify_if_capa_not_required_oosc;
            $history->save();
        }
        if (!empty($request->action_plan_req_oosc)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Action Plan Req.';
            $history->current = $request->action_plan_req_oosc;
            $history->save();
        }
        // if (!empty($request->action_plan_ref_oosc)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation"; 
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Action Plan Ref.';
        //     $history->current = $request->action_plan_ref_oosc;
        //     $history->save();
        // }
        if (!empty($request->justification_for_delay_oosc)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Justification for Delay';
            $history->current = $request->justification_for_delay_oosc;
            $history->save();
        }
        if (!empty($request->conclusion_review_comments_ocr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Conclusion Review Comments';
            $history->current = $request->conclusion_review_comments_ocr;
            $history->save();
        }
        if (!empty($request->action_taken_on_affec_batch_ocr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Action Taken on Affec.batch';
            $history->current = $request->action_taken_on_affec_batch_ocr;
            $history->save();
        }
        if (!empty($request->capa_req_ocr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'CAPA Req.?';
            $history->current = $request->capa_req_ocr;
            $history->save();
        }
        // if (!empty($request->capa_refer_ocr)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation"; 
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'CAPA Refer.';
        //     $history->current = $request->capa_refer_ocr;
        //     $history->save();
        // }
        if (!empty($request->required_action_plan_ocr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Required Action Plan?';
            $history->current = $request->required_action_plan_ocr;
            $history->save();
        }
         if (!empty($request->required_action_task_ocr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Required Action Task?';
            $history->current = $request->required_action_task_ocr;
            $history->save();
        }
        // if (!empty($request->action_task_reference_ocr)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation"; 
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Action Task Reference';
        //     $history->current = $request->action_task_reference_ocr;
        //     $history->save();
        // }
        if (!empty($request->risk_assessment_req_ocr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Risk Assessment Req?';
            $history->current = $request->risk_assessment_req_ocr;
            $history->save();
        }
        // if (!empty($request->risk_assessment_ref_ocr)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation"; 
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Risk Assessment Ref.';
        //     $history->current = $request->risk_assessment_ref_ocr;
        //     $history->save();
        // }
        if (!empty($request->justify_if_no_risk_assessment_ocr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Justify if no risk Assessment';
            $history->current = $request->justify_if_no_risk_assessment_ocr;
            $history->save();
        }
        if (!empty($request->qa_approver_ocr)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'CQ Approver';
            $history->current = $request->qa_approver_ocr;
            $history->save();
        }
        if (!empty($request->capa_required_OOS_CQ)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'CAPA required?';
            $history->current = $request->capa_required_OOS_CQ;
            $history->save();
        }
        if (!empty($request->ref_action_plan_OOS_CQ)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Ref Action Plan';
            $history->current = $request->ref_action_plan_OOS_CQ;
            $history->save();
        }
        if (!empty($request->reference_of_capa_OOS_CQ)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Reference of CAPA';
            $history->current = $request->reference_of_capa_OOS_CQ;
            $history->save();
        }
        if (!empty($request->cq_review_comments_OOS_CQ)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'CQ Review Comments';
            $history->current = $request->cq_review_comments_OOS_CQ;
            $history->save();
        }
        if (!empty($request->action_plan_requirement_OOS_CQ)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Action plan requirement?';
            $history->current = $request->action_plan_requirement_OOS_CQ;
            $history->save();
        }
        if (!empty($request->oos_category_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'OOS Category';
            $history->current = $request->oos_category_BI;
            $history->save();
        }
        if (!empty($request->others_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Others';
            $history->current = $request->others_BI;
            $history->save();
        }
        if (!empty($request->material_batch_release_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Material/Batch Release';
            $history->current = $request->material_batch_release_BI;
            $history->save();
        }
        if (!empty($request->other_action_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Other Action (Specify)';
            $history->current = $request->other_action_BI;
            $history->save();
        }
        // if (!empty($request->field_alert_reference_BI)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation"; 
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Field Alert Reference';
        //     $history->current = $request->field_alert_reference_BI;
        //     $history->save();
        // }
        if (!empty($request->other_parameter_result_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Other Parameters Results';
            $history->current = $request->other_parameter_result_BI;
            $history->save();
        }
        if (!empty($request->trend_of_previous_batches_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Trend of Previous Batches';
            $history->current = $request->trend_of_previous_batches_BI;
            $history->save();
        }
        if (!empty($request->stability_data_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Stability Data';
            $history->current = $request->stability_data_BI;
            $history->save();
        }
        if (!empty($request->process_validation_data_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Process Validation Data';
            $history->current = $request->process_validation_data_BI;
            $history->save();
        }
        if (!empty($request->method_validation_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Method Validation';
            $history->current = $request->method_validation_BI;
            $history->save();
        }
        if (!empty($request->any_market_complaints_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Any Market Complaints';
            $history->current = $request->any_market_complaints_BI;
            $history->save();
        }
        if (!empty($request->statistical_evaluation_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Statistical Evaluation';
            $history->current = $request->statistical_evaluation_BI;
            $history->save();
        }
        if (!empty($request->risk_analysis_for_disposition_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Risk Analysis for Disposition';
            $history->current = $request->risk_analysis_for_disposition_BI;
            $history->save();
        }
        if (!empty($request->conclusion_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Conclusion';
            $history->current = $request->conclusion_BI;
            $history->save();
        }
        if (!empty($request->phase_III_inves_required_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Phase-III Inves.Required?';
            $history->current = $request->phase_III_inves_required_BI;
            $history->save();
        }
        // if (!empty($request->phase_III_inves_reference_BI)){
        //     $history = new OOSmicroAuditTrail();
        //     $history->OOS_micro_id = $OOSmicro->id;
        //     $history->previous = "Null";
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $OOSmicro->status;
        //     $history->stage = $OOSmicro->stage;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation"; 
        //     $history->action_name = 'Create';
        //     $history->activity_type = 'Phase-III Inves.Reference';
        //     $history->current = $request->phase_III_inves_reference_BI;
        //     $history->save();
        // }
        if (!empty($request->justify_for_delay_BI)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Justify for Delay in Activity';
            $history->current = $request->justify_for_delay_BI;
            $history->save();
        }
        if (!empty($request->reopen_request)){
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $OOSmicro->status;
            $history->stage = $OOSmicro->stage;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation"; 
            $history->action_name = 'Create';
            $history->activity_type = 'Other Action (Specify)';
            $history->current = $request->reopen_request;
            $history->save();
        }
        // =============== Audit trail close  ==========================//

        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    //--------------Grid 1-------------------info on product /material-----------------
     }

       public function edit($id){

            $micro_data = OOS_micro::find($id);
            $old_records = OOS_micro::select('id', 'division_id', 'record')->get();
            $record_number = ((RecordNumber::first()->value('counter')) );
            $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            // =========grid data========
            $info_product_materials = $micro_data->grids()->where('identifier', 'info_product_material')->first();
            $products_details = $micro_data->grids()->where('identifier', 'products_details')->first();
            $instrument_details = $micro_data->grids()->where('identifier', 'instrument_details')->first();
            $details_stabilities = $micro_data->grids()->where('identifier', 'details_stability')->first();
            $oos_details = $micro_data->grids()->where('identifier', 'oos_detail')->first();
            $oos_capas = $micro_data->grids()->where('identifier', 'oos_capa')->first();
            $oos_conclusions = $micro_data->grids()->where('identifier', 'oos_conclusion')->first();
            $oos_conclusion_reviews = $micro_data->grids()->where('identifier', 'oos_conclusion_review')->first();
            
            return view('frontend.OOS_Micro.oos_micro_view',compact('micro_data','record_number','old_records',
             'info_product_materials','products_details','instrument_details','details_stabilities','oos_details','oos_capas','oos_conclusions','oos_conclusion_reviews'));
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
                if (empty($request->file($file_input_name)) && !empty($micro[$file_input_name])) {
                    // If the request does not contain file data but existing data is present, retain the existing data
                    $input[$file_input_name] = $micro[$file_input_name];
                } else {
                    // If the request contains file data or existing data is not present, upload new files
                    $input[$file_input_name] = FileService::uploadMultipleFiles($request, $file_input_name);
                }
            
            }

     //---------------------Audit Trail Update-------------------------------/////////////////
     $lastDocument = OOS_micro::find($id);

     $general_information = [
        'description_gi' => 'Short Description',
        // 'record_number' => 'Record Number',
        'initiation_date' => 'Initiation Date',
        'due_date' => 'Due Date',
        'severity_level_gi' => 'Severity Level',
        'initiator_group_gi' => 'Initiation Department',
        'initiator_group_code_gi' => 'Initiation Department Group Code',
        'initiated_through_gi' => 'Initiated Through',
        'if_others_gi' => 'If Others',
        'is_repeat_gi' => 'Is Repeat',
        'repeat_nature_gi' => 'Repeat Nature',
        'nature_of_change_gi' => 'Nature of Change',
        'reference_system_document_gi' => 'Reference System Document',
        'reference_document_gi' => 'Reference Document',
        'deviation_occured_on_gi' => 'Deviation Occurred On',
        'source_document_type_gi' => 'Source Document Type',
        'sample_type_gi' => 'Sample Type',
        'oos_observed_on' => 'OOS Observed On',
        'delay_justification' => 'Delay Justification',
        'oos_reported_date' => 'OOS Reported On',
        'immediate_action' => 'Immediate action',
        'product_material_name_gi' => 'Product/Material Name',
        'market_gi' => 'Market',
        'customer_gi' => 'Customer',
        'initial_attachment_gi'  => 'Initial Attachment'
    ];
    
    foreach ($general_information as $key => $value) {
        // Convert arrays to strings for comparison
        $lastValue = is_array($lastDocument->$key) ? implode(',', $lastDocument->$key) : $lastDocument->$key;
        $requestValue = is_array($request->$key) ? implode(',', $request->$key) : $request->$key;
    
        if ($lastValue != $requestValue) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $id;
            $history->activity_type = $value;
            $history->previous = $lastValue;
            $history->current = $requestValue;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_from = $lastDocument->status;
            $history->change_to =  "Not Applicable";
            if (is_null($lastValue) || $lastValue === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
    }
    
//  Preliminary Lab Investigation

$Preliminary_Lab_Investigation = [
'comments_pli' => 'Comments',
'field_alert_required_pli' => 'Field Alert Required',
// 'field_alert_ref_no_pli' => 'Field Alert Ref.No.',
'justify_if_no_field_alert_pli' => 'Justify if no Field Alert',
'verification_analysis_required_pli' => 'Verification Analysis Required',
// 'verification_analysis_ref_pli'  => 'Verification Analysis Ref.',
// 'analyst_interview_ref_pli' => 'Analyst Interview Ref.',
'analyst_interview_req_pli' => 'Analyst Interview Req.',
'justify_if_no_analyst_int_pli' => 'Justify if no Analyst Int.',
'phase_i_investigation_required_pli' => 'Phase I Investigation Required',
'phase_i_investigation_pli' => 'Phase I Investigation ',
// 'phase_i_investigation_ref_pli' => 'Phase I Investigation Ref.',
];
foreach ($Preliminary_Lab_Investigation as $key => $value){

    if($lastDocument->$key != $request->$key){
        $history =  new OOSmicroAuditTrail();
        $history->OOS_micro_id = $id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current= $request->$key;
        $history->comment= $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_from = $lastDocument->status;
        $history->change_to =  "Not Applicable";
        if (is_null($lastValue) || $lastValue === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
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
// 'recommended_actions_reference_plic' => 'Recommended Actions Reference',
'capa_required_plic' => 'CAPA Required',
'reference_capa_no_plic' => 'Reference CAPA No.',
'delay_justification_for_pi_plic' => 'Delay Justification for P.I.',
];
foreach($Preliminary_Lab_Investigation_Conclusion as $key => $value){
    if($lastDocument->$key != $request->$key){
        $history =  new OOSmicroAuditTrail();
        $history->OOS_micro_id = $id;
        $history->activity_type = $value;
        $history->previous = $lastDocument->$key;
        $history->current= $request->$key;
        $history->comment= $request->comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_from = $lastDocument->status;
        $history->change_to =  "Not Applicable";
        if (is_null($lastValue) || $lastValue === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
        $history->save();
    }
}

//Preliminary lab invst review

$Preliminary_lab_invst_review = [
'review_comments_plir' => 'Review Comments',
'phase_ii_inv_required_plir' => 'Phase II Inv. Required?',
];

foreach($Preliminary_lab_invst_review as $key => $value){
if($lastDocument->$key != $request->$key){
    $history =  new OOSmicroAuditTrail();
    $history->OOS_micro_id = $id;
    $history->activity_type = $value;
    $history->previous = $lastDocument->$key;
    $history->current= $request->$key;
    $history->comment= $request->comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_from = $lastDocument->status;
    $history->change_to =  "Not Applicable";
    if (is_null($lastValue) || $lastValue === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
    $history->save();
}
}

//Phase II Investigation
$Phase_II_Investigation = [
'qa_approver_comments_piii' => 'QA Approver Comments',
'manufact_invest_required_piii' => 'Manufact. Invest. Required?',
'reason_manufacturing_pii' => 'Reason for manufacturing',
'manufacturing_multi_select' => 'Manufacturing Invest. Type',
// 'manufacturing_invest_type_piii' => 'Manufacturing Invest. Type',
// 'manufacturing_invst_ref_piii' => 'Manufacturing Invst. Ref.',
're_sampling_required_piii' => 'Re-sampling Required?',
'audit_comments_piii' => 'Audit Comments',
// 're_sampling_ref_no_piii' => 'Re-sampling Ref. No.',
'hypo_exp_required_piii' => 'Hypo/Exp.Required',
// 'hypo_exp_reference_piii' => 'Hypo/Exp. Reference',
];

foreach($Phase_II_Investigation as $key => $value ){
if($lastDocument->$key != $request->$key){
    $history =  new OOSmicroAuditTrail();
    $history->OOS_micro_id = $id;
    $history->activity_type = $value;
    $history->previous = $lastDocument->$key;
    $history->current= $request->$key;
    $history->comment= $request->comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_from = $lastDocument->status;
    $history->change_to =  "Not Applicable";
    if (is_null($lastValue) || $lastValue === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
    $history->save();
}
}

// //Phase II QC REview

$Phase_II_QC_Review = [
'summary_of_exp_hyp_piiqcr' => 'Summary of Exp./Hyp.',
'summary_mfg_investigation_piiqcr' => 'Summary Mfg.Investigation',
'root_casue_identified_piiqcr' => 'Root Cause Identified',
'oos_category_reason_identified_piiqcr' => 'OOS Category-Reason Identified',
'others_oos_category_piiqcr' => 'Others (OOS category)',
'oos_details_obvious_error' => 'Details of Obvious Error',
'details_of_root_cause_piiqcr' => 'Details of Root Cause',
'impact_assessment_piiqcr' =>'Impact Assessment',
'recommended_action_required_piiqcr' => 'Recommended Action Required?',
// 'recommended_action_reference_piiqcr' => 'Recommended Action Reference',
'investi_required_piiqcr' => 'Invest.Required',
// 'invest_ref_piiqcr' => 'Invest ref.',
];

foreach($Phase_II_QC_Review as $key => $value){

if($lastDocument->$key != $request->$key){
    $history =  new OOSmicroAuditTrail();
    $history->OOS_micro_id = $id;
    $history->activity_type = $value;
    $history->previous = $lastDocument->$key;
    $history->current= $request->$key;
    $history->comment= $request->comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_from = $lastDocument->status;
    $history->change_to =  "Not Applicable";
    if (is_null($lastValue) || $lastValue === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
    $history->save();
}
}

// Additional testing Proposal

$Additional_Testing_Proposal = [
'review_comment_atp' => 'Review Comment',
'additional_test_proposal_atp' => 'Additional Test Proposal',
// 'additional_test_reference_atp' => 'Additional Test Reference',
'any_other_actions_required_atp' => 'Any Other Actions Required',
// 'action_task_reference_atp' => 'Action Task Reference',
];
foreach($Additional_Testing_Proposal as $key => $value){

if($lastDocument->$key != $request->$key){
    $history =  new OOSmicroAuditTrail();
    $history->OOS_micro_id = $id;
    $history->activity_type = $value;
    $history->previous = $lastDocument->$key;
    $history->current= $request->$key;
    $history->comment= $request->comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_from = $lastDocument->status;
    $history->change_to =  "Not Applicable";
    if (is_null($lastValue) || $lastValue === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
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
// "capa_ref_no_oosc" => 'CAPA Ref No.',
"justify_if_capa_not_required_oosc" => 'Justify if CAPA not required',
"action_plan_req_oosc" => 'Action Plan Req.',
// "action_plan_ref_oosc" => 'Action Plan Ref.',
"justification_for_delay_oosc" => 'Justification for Delay',
];

foreach($OOS_Conclusion as $key => $value){
if($lastDocument->$key != $request->$key){
    $history =  new OOSmicroAuditTrail();
    $history->OOS_micro_id = $id;
    $history->activity_type = $value;
    $history->previous = $lastDocument->$key;
    $history->current= $request->$key;
    $history->comment= $request->comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
        $history->change_from = $lastDocument->status;
        $history->change_to =  "Not Applicable";
        if (is_null($lastValue) || $lastValue === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
    $history->save();
}
}

// //OOS_Conclusion_Review

$OOS_Conclusion_Review = [
"conclusion_review_comments_ocr" => 'Conclusion Review Comments',
"action_taken_on_affec_batch_ocr" => 'Action Taken on Affec.batch',
"capa_req_ocr" => 'CAPA Req.?',
// "capa_refer_ocr" => 'CAPA Refer.',
"required_action_plan_ocr" => 'Required Action Plan?',
"required_action_task_ocr" => 'Required Action Task?',
// "action_task_reference_ocr" => 'Action Task Reference',
"risk_assessment_req_ocr" => 'Risk Assessment Req?',
// "risk_assessment_ref_ocr" => 'Risk Assessment Ref.',
"justify_if_no_risk_assessment_ocr" => 'Justify if no risk Assessment',
"qa_approver_ocr" => 'CQ Approver',
];
foreach($OOS_Conclusion_Review as $key => $value){

if($lastDocument->$key != $request->$key){
    $history =  new OOSmicroAuditTrail();
    $history->OOS_micro_id = $id;
    $history->activity_type = $value;
    $history->previous = $lastDocument->$key;
    $history->current= $request->$key;
    $history->comment= $request->comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
        $history->change_from = $lastDocument->status;
        $history->change_to =  "Not Applicable";
        if (is_null($lastValue) || $lastValue === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
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

if($lastDocument->$key != $request->$key){
    $history =  new OOSmicroAuditTrail();
    $history->OOS_micro_id = $id;
    $history->activity_type = $value;
    $history->previous = $lastDocument->$key;
    $history->current= $request->$key;
    $history->comment= $request->comment;
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_from = $lastDocument->status;
    $history->change_to =  "Not Applicable";
    if (is_null($lastValue) || $lastValue === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
    $history->save();
}
}
//  Batch Disposition
    $batchDisposition = [
        'others_BI' => 'Others',
        'oos_category_BI' => 'OOS Category',
        'material_batch_release_BI' => 'Material/Batch Release',
        'other_action_BI' => 'Other Action (Specify)',
        // 'field_alert_reference_BI' => 'Field Alert Reference',
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
       // 'phase_III_inves_reference_BI' => 'Phase-III Inves.Reference',
        'justify_for_delay_BI' => 'Justify for Delay in Activity',
        'reopen_request'=> 'Other Action (Specify)',
    ];

    foreach ($batchDisposition as $key => $value) {

        if($lastDocument->$key != $request->$key){
            $history =  new OOSmicroAuditTrail();
            $history->OOS_micro_id = $id;
            $history->activity_type = $value;
            $history->previous = $lastDocument->$key;
            $history->current= $request->$key;
            $history->comment= $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_from = $lastDocument->status;
            $history->change_to =  "Not Applicable";
            if (is_null($lastValue) || $lastValue === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
    }


    // =========================== Audit Trail Update ===============================// 
    
    // Find the OOS micro record by ID
        $micro->update($input);
        $micro = OOS_micro::with('grids')->find($id);  
            $grid_inputs = [
                    'info_product_material',
                    'details_stability',
                    'products_details',
                    'instrument_details',
                    'oos_detail',
                    'oos_capa',
                    'oos_conclusion',
                    'oos_conclusion_review',
                    // "phase_I_investigation",
                    'phase_IB_investigation',
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

// =============workflow stage change =========

    public function send_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changestage = OOS_micro::find($id);
            $lastDocument = OOS_micro::find($id);
            if ($changestage->stage == 1) {
                $changestage->stage = "2";
                $changestage->status = "HOD Primary Review";
                $changestage->Submite_by = Auth::user()->name;
                $changestage->Submite_on = Carbon::now()->format('d-M-Y');
                $changestage->Submite_comment = $request->comment;
                                $history = new OOSmicroAuditTrail();
                                $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
            //                 $history = new OOSmicroAuditTrail();
            //                 $history->oos_micro_id = $id;
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
                $changestage->stage = "7";
                $changestage->status = "Phase IA QA Review ";
                $changestage->Phase_IA_HOD_Review_Complete_By = Auth::user()->name;
                $changestage->Phase_IA_HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IA_HOD_Review_Complete_Comment = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Phase IA QA Review Complete By    ,   Phase IA QA Review Complete On';
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
                    $history->action = 'Phase IA QA Review Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "P-IA CQAH/QAH Review";
                    $history->current = $changestage->Phase_IA_QA_Review_Complete_By . ' , ' . $changestage->Phase_IA_QA_Review_Complete_On;
                    if (is_null($lastDocument->Phase_IA_QA_Review_Complete_By) || $lastDocument->Phase_IA_QA_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
            //         $history = new OOSmicroAuditTrail();
            //         $history->oos_micro_id = $id;
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
                $changestage->stage = "13";
                $changestage->status = "Under Phase-II A Investigation";
                $changestage->P_I_B_Assignable_Cause_Not_Found_By= Auth::user()->name;
                $changestage->P_I_B_Assignable_Cause_Not_Found_On = Carbon::now()->format('d-M-Y');
                $changestage->P_I_B_Assignable_Cause_Not_Found_Comment = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            
            if($changestage->stage == 14) {
                $changestage->stage = "15";
                $changestage->status = "Phase II A CQA/QA Review";
                $changestage->Phase_II_A_HOD_Review_Complete_By= Auth::user()->name;
                $changestage->Phase_II_A_HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_A_HOD_Review_Complete_Comment = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Phase II A HOD ReviewComplete By    ,   Phase II A HOD ReviewComplete On';
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 16) {
                $changestage->stage = "17";
                $changestage->status = "Under Phase-II B Investigation";
                $changestage->P_II_A_Assignable_Cause_Not_Found_By= Auth::user()->name;
                $changestage->P_II_A_Assignable_Cause_Not_Found_On = Carbon::now()->format('d-M-Y');
                $changestage->P_II_A_Assignable_Cause_Not_Found_Comment = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 18) {
                $changestage->stage = "19";
                $changestage->status = "Phase II B QA/CQA Review";
                $changestage->Phase_II_B_HOD_Review_Complete_By= Auth::user()->name;
                $changestage->Phase_II_B_HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_B_HOD_Review_Complete_Comment = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 19) {
                $changestage->stage = "20";
                $changestage->status = "P-II B QAH/CQAH Review";
                $changestage->Phase_II_B_QA_Review_Complete_By= Auth::user()->name;
                $changestage->Phase_II_B_QA_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_B_QA_Review_Complete_Comment = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 20) {
                $changestage->stage = "21";
                $changestage->status = "Closed - Done";
                $changestage->P_II_B_Assignable_Cause_Not_Found_By= Auth::user()->name;
                $changestage->P_II_B_Assignable_Cause_Not_Found_On = Carbon::now()->format('d-M-Y');
                $changestage->P_II_B_Assignable_Cause_Not_Found_Comment = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                $changestage->more_info_requiered1_By = Auth::user()->name;
                $changestage->more_info_requiered1_On = Carbon::now()->format('d-M-Y');
                $changestage->more_info_requiered1_Comment = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
            if ($changestage->stage == 1) {
                $changestage->stage = "3";
                $changestage->status = "QA Head Approval";
                $changestage->Opened_to_QA_Head_Approval_By= Auth::user()->name;
                $changestage->Opened_to_QA_Head_Approval_On  = Carbon::now()->format('d-M-Y');
                $changestage->Opened_to_QA_Head_Approval_Comment = $request->comment;
                            $history = new OOSmicroAuditTrail();
                            $history->oos_micro_id = $id;
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
                            $history = new OOSmicroAuditTrail();
                            $history->oos_micro_id = $id;
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
                            $history = new OOSmicroAuditTrail();
                            $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
            $data = OOS_MICRO::find($id);
            $lastDocument = OOS_MICRO::find($id);
            $data->stage = "0";
            $data->status = "Closed-Cancelled";
            $data->cancelled_by = Auth::user()->name;
            $data->cancelled_on = Carbon::now()->format('d-M-Y');
            $data->cancelled_Comment = $request->comment;

                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
            $data = OOS_MICRO::find($id);
            $changestage = OOS_MICRO::find($id);
            $lastDocument = OOS_MICRO::find($id);
            $data->stage = "23";
            $data->status = "Closed-Done";
            $data->Assignable_Cause_Found_By = Auth::user()->name;
            $data->Assignable_Cause_Found_On = Carbon::now()->format('d-M-Y');
            $data->Assignable_Cause_Found_Comment = $request->comment;

            $history = new OOSmicroAuditTrail();
            $history->oos_micro_id = $id;
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
            $data->update();
            toastr()->success('Document Sent');
            return back();
        }
    }

    public function Done_One_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $data = OOS_MICRO::find($id);
            $changestage = OOS_MICRO::find($id);
            $lastDocument = OOS_MICRO::find($id);
            $data->stage = "24";
            $data->status = "Closed-Done";
            $data->P_I_B_Assignable_Cause_Found_By = Auth::user()->name;
            $data->P_I_B_Assignable_Cause_Found_On = Carbon::now()->format('d-M-Y');
            $data->P_I_B_Assignable_Cause_Found_Comment = $request->comment;

            $history = new OOSmicroAuditTrail();
            $history->oos_micro_id = $id;
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
            $data->update();
            toastr()->success('Document Sent');
            return back();
        }
    }

    public function Done_Two_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $data = OOS_MICRO::find($id);
            $changestage = OOS_MICRO::find($id);
            $lastDocument = OOS_MICRO::find($id);
            $data->stage = "25";
            $data->status = "Closed-Done";
            $data->P_II_A_Assignable_Cause_Found_By = Auth::user()->name;
            $data->P_II_A_Assignable_Cause_Found_On = Carbon::now()->format('d-M-Y');
            $data->P_II_A_Assignable_Cause_Found_Comment = $request->comment;

            $history = new OOSmicroAuditTrail();
            $history->oos_micro_id = $id;
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
            $data->update();
            toastr()->success('Document Sent');
            return back();
        }
    }

   
    public function child(Request $request, $id)
    {
        $cft = [];
        $parent_id = $id;
        $parent_type = "OOS Micro";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $parent_record = OOS_MICRO::where('id', $id)->value('record');
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_division_id = OOS_MICRO::where('id', $id)->value('division_id');
        $parent_initiator_id = OOS_MICRO::where('id', $id)->value('initiator_id');
        $parent_intiation_date = OOS_MICRO::where('id', $id)->value('intiation_date');
        $parent_created_at = OOS_MICRO::where('id', $id)->value('created_at');
        $parent_short_description = OOS_MICRO::where('id', $id)->value('description_gi');
        $hod = User::where('role', 4)->get();
        // dd($record_number);
        $old_records = OOS_MICRO::select('id', 'division_id', 'record')->get();

        if ($request->child_type == "capa") {
            $parent_name = "CAPA";
            $Capachild = OOS_MICRO::find($id);
            $Capachild->Capachild = $record;
            $Capachild->save();
         return view('frontend.forms.capa', compact('parent_id','record_number', 'parent_record','parent_type', 'record',
          'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date',
           'parent_name', 'parent_division_id', 'parent_record', 'old_records', 'cft'));
        } elseif ($request->child_type == "Action_Item")
         {
            $parent_name = "CAPA";
            $actionchild = OOS_MICRO::find($id);
            $actionchild->actionchild = $record;
            $parent_id = $id;
            $actionchild->save();

            return view('frontend.action-item.action-item', compact('parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id',
             'parent_record', 'record', 'due_date', 'parent_id', 'parent_type', 'old_records'));
        }
        elseif ($request->child_type == "Resampling")
         {
            $parent_name = "CAPA";
            $actionchild = OOS_MICRO::find($id);
            $actionchild->actionchild = $record_number;
            $parent_id = $id;
            $actionchild->save();

            return view('frontend.resampling.resapling_create', compact('parent_short_description','old_records','record_number', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'record', 'due_date', 'parent_id', 'parent_type'));
        }
        elseif ($request->child_type == "Extension")
        {
           $parent_name = "CAPA";
           $actionchild = OOS_MICRO::find($id);
           $actionchild->actionchild = $record_number;
           $parent_id = $id;
           $actionchild->save();

           return view('frontend.extension.extension_new', compact('parent_short_description','old_records','record_number', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'record', 'due_date', 'parent_id', 'parent_type'));
       }
        else {
            $parent_name = "Root";
            $Rootchild = OOS_MICRO::find($id);
            $Rootchild->Rootchild = $record;
            $Rootchild->save();
            return view('frontend.forms.root-cause-analysis', compact('parent_id','record_number', 'parent_record','parent_type', 'record', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record'));
        }
    }
// ================= close workflow ===================
    public function AuditTrial($id)
    {
        $audit = OOSmicroAuditTrail::where('oos_micro_id', $id)->orderByDesc('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = OOS_MICRO::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
        return view('frontend.OOS_Micro.comps_micro.audit-trial', compact('audit', 'document', 'today'));
    }

    public function auditDetails($id)
    {
        $detail = OOSmicroAuditTrail::find($id);
        $detail_data = OOSmicroAuditTrail::where('activity_type', $detail->activity_type)->where('id', $detail->id)->latest()->get();
        $doc = OOS_MICRO::where('id', $detail->OOS_micro_id)->first();
        $doc->origiator_name = User::find($doc->initiator_id);
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
            
            $pdf = PDF::loadview('frontend.OOS_Micro.comps_micro.auditReport', compact('data', 'doc'))
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
            $products_details = $data->grids()->where('identifier', 'products_details')->first();
            $instrument_details = $data->grids()->where('identifier', 'instrument_details')->first();
            $data->oos_details = $data->grids()->where('identifier', 'oos_detail')->first();
            $checklist_lab_invs = $data->grids()->where('identifier', 'checklist_lab_inv')->first();
            $oos_capas = $data->grids()->where('identifier', 'oos_capa')->first();
            $phase_two_invs = $data->grids()->where('identifier', 'phase_two_inv')->first();
            $oos_conclusions = $data->grids()->where('identifier', 'oos_conclusion')->first();
            $oos_conclusion_reviews = $data->grids()->where('identifier', 'oos_conclusion_review')->first();
            
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
           $pdf = PDF::loadview('frontend.OOS_Micro.comps_micro.singleReport', 
            compact('data','checklist_lab_invs','products_details','instrument_details','phase_two_invs','oos_capas','oos_conclusions','oos_conclusion_reviews'))
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
            return $pdf->stream('OOS Micro' . $id . '.pdf');
        }
    }


}
