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
    //    record update
        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();
        // ============ grid store ==========
        $grid_inputs = [
            'info_product_material',
            'details_stability',
            'oos_detail',
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
        
        if (!empty($request->description_gi)) {
            $history = new OOSmicroAuditTrail();
            $history->OOS_micro_id = $OOSmicro->id;
            $history->activity_type = 'Description';
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
            $history->activity_type = 'Initiator Group';
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
            $history->activity_type = 'Initiator Group Code';
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
            $history->activity_type = 'Deviation Occured On';
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
            $history->activity_type = 'OOS Category Others';
            $history->current = $request->root_cause_details_plic;
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
            $history->activity_type = 'Root Cause Details';
            $history->current = $request->oos_category_others_plic;
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
       
        // =============== Audit trail close  ==========================//

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
        'initiation_date' => 'Initiation Date',
        'due_date' => 'Due Date',
        'severity_level_gi' => 'Severity Level',
        'initiator_group_gi' => 'Initiator Group',
        'initiator_group_code_gi' => 'Initiator Group Code',
        'initiated_through_gi' => 'Initiated Through',
        'if_others_gi' => 'If Others',
        'is_repeat_gi' => 'Is Repeat',
        'repeat_nature_gi' => 'Repeat Nature',
        'nature_of_change_gi' => 'Nature of Change',
        'reference_system_document_gi' => 'Reference System Document',
        'deviation_occured_on_gi' => 'Deviation Occurred On',
        'source_document_type_gi' => 'Source Document Type',
        'sample_type_gi' => 'Sample Type',
        'product_material_name_gi' => 'Product/Material Name',
        'market_gi' => 'Market',
        'customer_gi' => 'Customer'
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
'justify_if_no_field_alert_pli' => 'Justify if no Field Alert',
'verification_analysis_required_pli' => 'Verification Analysis Required',
'analyst_interview_req_pli' => 'Analyst Interview Req.',
'justify_if_no_analyst_int_pli' => 'Justify if no Analyst Int.',
'phase_i_investigation_required_pli' => 'Phase I Investigation Required',
'phase_i_investigation_pli' => 'Phase I Investigation ',
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
'capa_required_plic' => 'CAPA Required',
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
                $changestage->status = "Pending Initial Assessment & LabIncident";
                $changestage->completed_by_pending_initial_assessment = Auth::user()->name;
                $changestage->completed_on_pending_initial_assessment = Carbon::now()->format('d-M-Y');
                $changestage->comment_pending_initial_assessment = $request->comment;
                                $history = new OOSmicroAuditTrail();
                                $history->oos_micro_id = $id;
                                $history->activity_type = 'Activity Log';
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->id;
                                $history->user_name = Auth::user()->name;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->action = 'Submit';
                                $history->change_from = $lastDocument->status;
                                $history->change_to =   "Pending Initial Assessment & LabIncident";
                                $history->action_name = 'Update';
                                $history->save();
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
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Initial Phase I Investigation';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase I Investigation";
                    $history->action_name = 'Update';
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
            if ($changestage->stage == 5) {
                $changestage->stage = "6";
                $changestage->status = "Under Hypothesis Experient";
                $changestage->completed_by_under_hypothesis = Auth::user()->name;
                $changestage->completed_on_under_hypothesis = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_hypothesis = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Proposed Hypothesis Experiment';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Hypothesis Experient";
                    $history->action_name = 'Update';
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
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'No Assignable Cause Found';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "under phase II Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 8) {
                $changestage->stage = "9";
                $changestage->status = "Under Full Scale Investigation Phase II";
                $changestage->completed_by_under_manufacturing_investigation_phaseIIA = Auth::user()->name;
                $changestage->completed_on_under_manufacturing_investigation_phaseIIA = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_manufacturing_investigation_phaseIIA = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Full Scale Investigation';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Full Scale Investigation Phase II";
                    $history->action_name = 'Update';
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
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'No Assignable Cause Found (No Manufacturing Defect)';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under phase II b Additional Lab Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 10) {
                $changestage->stage = "13";
                $changestage->status = "Pending Final Approval";
                $changestage->completed_by_under_batch_disposition= Auth::user()->name;
                $changestage->completed_on_under_batch_disposition = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_batch_disposition = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Pending Final Approval";
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
            //         $history = new OOSmicroAuditTrail();
            //         $history->oos_micro_id = $id;
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
            if ($changestage->stage == 11) {
                $changestage->stage = "13";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Phase II A Correction Inconclusive';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Pending Final Approval";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            
            if($changestage->stage == 13) {
                $changestage->stage = "14";
                $changestage->status = "Close-Done";
                $changestage->completed_by_close_done= Auth::user()->name;
                $changestage->completed_on_close_done = Carbon::now()->format('d-M-Y');
                $changestage->comment_close_done = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Approval Completed';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Close-Done";
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
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Opened";
                    $history->action_name = 'Update';
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
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Pending Initial Assessment & Lab Incident";
                    $history->action_name = 'Update';
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
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase I Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 5) {
                $changestage->stage = "3";
                $changestage->status = "Under Phase I b Investigation";
                $changestage->completed_by_under_phaseI_investigation = Auth::user()->name;
                $changestage->completed_on_under_phaseI_investigation = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_phaseI_investigation = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Phase I Investigation";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
           
            if ($changestage->stage == 7) {
                $changestage->stage = "6";
                $changestage->status = "Under Hypothesis Experient";
                $changestage->completed_by_under_hypothesis = Auth::user()->name;
                $changestage->completed_on_under_hypothesis = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_hypothesis = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Hypothesis Experient";
                    $history->action_name = 'Update';
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
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Pending Correction";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 9) {
                $changestage->stage = "6";
                $changestage->status = "Under Hypothesis Experiment";
                $changestage->completed_by_under_manufacturing_investigation_phaseIIA = Auth::user()->name;
                $changestage->completed_on_under_manufacturing_investigation_phaseIIA = Carbon::now()->format('d-M-Y');
                $changestage->comment_under_manufacturing_investigation_phaseIIA = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Hypothesis Experiment";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            // if ($changestage->stage == 11) {
            //     $changestage->stage = "9";
            //     $changestage->status = "Under Manufacturing Phase II b Additional Lab Investigation";
            //     $changestage->completed_by_under_phaseIIB_additional_lab_investigation= Auth::user()->name;
            //     $changestage->completed_on_under_phaseIIB_additional_lab_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseIIB_additional_lab_investigation = $request->comment;
            //         $history = new OOSmicroAuditTrail();
            //         $history->oos_micro_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Correction Complete';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Pending Correction";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            // if ($changestage->stage == 13) {
            //     $changestage->stage = "9";
            //     $changestage->status = "Under phase II b Additional Lab Investigation";
            //     $changestage->completed_by_under_phaseIII_investigation= Auth::user()->name;
            //     $changestage->completed_on_under_phaseIII_investigation = Carbon::now()->format('d-M-Y');
            //     $changestage->comment_under_phaseIII_investigation = $request->comment;
            //         $history = new OOSmicroAuditTrail();
            //         $history->oos_micro_id = $id;
            //         $history->activity_type = 'Activity Log';
            //         $history->comment = $request->comment;
            //         $history->user_id = Auth::user()->id;
            //         $history->user_name = Auth::user()->name;
            //         $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //         $history->origin_state = $lastDocument->status;
            //         $history->action = 'Correction Complete';
            //         $history->change_from = $lastDocument->status;
            //         $history->change_to =   "Pending Correction";
            //         $history->action_name = 'Update';
            //         $history->save();
            //     $changestage->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            if ($changestage->stage == 13) {
                $changestage->stage = "9";
                $changestage->status = "Under Full Scale Investigation Phase II";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Request More Info';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Full Scale Investigation Phase II";
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
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->action = 'Assignable Cause Found';
                            $history->change_from = $lastDocument->status;
                            $history->change_to =   "Under Phase I Correction";
                            $history->action_name = 'Update';
                            $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 4) {
                $changestage->stage = "13";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Correction Completed';
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
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
                $changestage->stage = "13";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Repeat Analysis COmpleted';
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Assignable Cause Found (Manufacturing Defect)';
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Under Batch Disposition";
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
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Pending Correction";
                    $history->action_name = 'Update';
                    $history->save();
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 12) {
                $changestage->stage = "13";
                $changestage->status = "Pending Final Approval Completed";
                $changestage->completed_by_approval_completed= Auth::user()->name;
                $changestage->completed_on_approval_completed = Carbon::now()->format('d-M-Y');
                $changestage->comment_approval_completed = $request->comment;
                    $history = new OOSmicroAuditTrail();
                    $history->oos_micro_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->action = 'Final Approval';
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
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state =  $data->status;
                    $history->action = 'Correction Complete';
                    $history->change_from = $lastDocument->status;
                    $history->change_to =   "Pending Correction";
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
        $old_record = OOS_MICRO::select('id', 'division_id', 'record')->get();

        if ($request->child_type == "capa") {
            $parent_name = "CAPA";
            $Capachild = OOS_MICRO::find($id);
            $Capachild->Capachild = $record;
            $Capachild->save();

            return view('frontend.forms.capa', compact('parent_id', 'parent_record','parent_type', 'record', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'old_record', 'cft'));
        } elseif ($request->child_type == "Action_Item")
         {
            $parent_name = "CAPA";
            $actionchild = OOS_MICRO::find($id);
            $actionchild->actionchild = $record;
            $parent_id = $id;
            $actionchild->save();

            return view('frontend.action-item.action-item', compact('parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id',
             'parent_record', 'record', 'due_date', 'parent_id', 'parent_type', 'old_record'));
        }
        else {
            $parent_name = "Root";
            $Rootchild = OOS_MICRO::find($id);
            $Rootchild->Rootchild = $record;
            $Rootchild->save();
            return view('frontend.forms.root-cause-analysis', compact('parent_id', 'parent_record','parent_type', 'record', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record'));
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
            compact('data','checklist_lab_invs','phase_two_invs','oos_capas','oos_conclusions','oos_conclusion_reviews'))
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
