<?php

namespace App\Services\Qms;

use App\Models\OOS;
use App\Models\Oosgrids;
use App\Models\OosAuditTrial;
use App\Models\RoleGroup;
use App\Models\RecordNumber;
use Helpers;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OOSService
{
    public $oos;

    public function __construct(OOS $oos) {
        $this->oos = $oos;
    }

    public static function create_oss(Request $request)
    {
        $res = Helpers::getDefaultResponse();

        try {

            $input = $request->all();
            
            $input['form_type'] = "OOS Chemical";
            $input['status'] = 'Opened';
            $input['stage'] = 1;
            $input['record_number'] = ((RecordNumber::first()->value('counter')) + 1);

            $file_input_names = [
                'initial_attachment_gi',
                'file_attachments_pli',
                'file_attachments_pII',
                'supporting_attachment_plic',
                'supporting_attachments_plir',
                'attachments_piiqcr',
                'additional_testing_attachment_atp',
                'file_attachments_if_any_ooscattach',
                'conclusion_attachment_ocr',
                'cq_attachment_ocqr',
                'disposition_attachment_bd',
                'reopen_attachment_ro',
                'addendum_attachment_uaa',
                'addendum_attachments_uae',
                'required_attachment_uar',
                'verification_attachment_uar',
                'hod_attachment1',
                'hod_attachment2',
                'hod_attachment3',
                'hod_attachment4',
                'hod_attachment5',
                'QA_Head_attachment1',
                'QA_Head_attachment2',
                'QA_Head_attachment3',
                'QA_Head_attachment4',
                'QA_Head_attachment5',
                'QA_Head_primary_attachment1',
                'QA_Head_primary_attachment2',
                'QA_Head_primary_attachment3',
                'QA_Head_primary_attachment4',
                'QA_Head_primary_attachment5',
                'provide_attachment1',
                'provide_attachment2',
                'provide_attachment3',
                'provide_attachment4',
                'provide_attachment5',
            ];

            foreach ($file_input_names as $file_input_name)
            {
                $input[$file_input_name] = FileService::uploadMultipleFiles($request, $file_input_name);
            }

            $oos = OOS::create($input);
            $record = RecordNumber::first();
            $record->counter = ((RecordNumber::first()->value('counter')) + 1);
            $record->update();

            $grid_inputs = [
                'info_product_material',
                'details_stability',
                'oos_detail',
                'checklist_lab_inv',
                'checklist_IB_inv',
                'oos_capa',
                'phase_two_inv',
                'phase_two_inv1',
                'ph_meter',
                'Viscometer',
                'Melting_Point',
                'Dis_solution',
                'HPLC_GC',
                'General_Checklist',
                'kF_Potentionmeter',
                'RM_PM',
                'analyst_training_procedure',
                'Training_records_Analyst_Involved1',
                'sample_intactness_before_analysis1',
                'test_methods_Procedure1',
                'Review_of_Media_Buffer_Standards_prep1',
                'Checklist_for_Revi_of_Media_Buffer_Stand_prep1',
                'ccheck_for_disinfectant_detail1',
                'Checklist_for_Review_of_instrument_equip1',
                'Checklist_for_Review_of_Training_records_Analyst1',
                'Checklist_for_Review_of_sampling_and_Transport1',
                'Checklist_Review_of_Test_Method_proceds1',
                'Checklist_for_Review_Media_prepara_RTU_medias1',
                'Checklist_Review_Environment_condition_in_tests1',
                'review_of_instrument_bioburden_and_waters1',
                'disinfectant_details_of_bioburden_and_water_tests1',
                'training_records_analyst_involvedIn_testing_microbial_asssays1',
                'sample_intactness_before_analysis22',
                'checklist_for_review_of_test_method_IMA1',
                'cr_of_media_buffer_st_IMA1',
                'CR_of_microbial_cultures_inoculation_IMA1',
                'CR_of_Environmental_condition_in_testing_IMA1',
                'CR_of_instru_equipment_IMA1',
                'disinfectant_details_IMA1',
                'CR_of_training_rec_anaylst_in_monitoring_CIEM1',
                'Check_for_Sample_details_CIEM1',
                'Check_for_comparision_of_results_CIEM1',
                'checklist_for_media_dehydrated_CIEM1',
                'checklist_for_media_prepara_sterilization_CIEM1',
                'CR_of_En_condition_in_testing_CIEM1',
                'check_for_disinfectant_CIEM1',
                'checklist_for_fogging_CIEM1',
                'CR_of_test_method_CIEM1',
                'CR_microbial_isolates_contamination_CIEM1',
                'CR_of_instru_equip_CIEM1',
                'Ch_Trend_analysis_CIEM1',
                'checklist_for_analyst_training_CIMT2',
                'checklist_for_comp_results_CIMT2',
                'checklist_for_Culture_verification_CIMT2',
                'sterilize_accessories_CIMT2',
                'checklist_for_intrument_equip_last_CIMT2',
                'disinfectant_details_last_CIMT2',
                'checklist_for_result_calculation_CIMT2',
                'oos_conclusion',
                'oos_conclusion_review',
                'products_details',
                'instrument_detail',
            ];

            foreach ($grid_inputs as $grid_input)
            {
                self::store_grid($oos, $request, $grid_input);
            }

            // ============ OOS Chemical: Start  Audit Trail ==================
            if(!empty($request->initiator_id)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->activity_type = 'Initiator';
                $history->current = $request->initiator_id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->save();
            }
            if(!empty($request->record)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->activity_type = 'Record Number';
                $history->current = $request->record;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->save();
            }
            if(!empty($request->intiation_date)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->activity_type = 'Initiation Date';
                $history->current = $request->intiation_date;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->save();
            }
            if(!empty($request->description_gi)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->activity_type = 'Short Description';
                $history->current = $request->description_gi;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->save();
            }
            if (!empty($request->initiator_group)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Initiation department Group
';
                $history->current = $request->initiator_group;
                $history->save();
            }
            if (!empty($request->initiator_group_code)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Initiation department Code';
                $history->current = $request->initiator_group_code;
                $history->save();
            }
            if (!empty($request->if_others_gi)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'If Others';
                $history->current = $request->if_others_gi;
                $history->save();
            }
            if (!empty($request->is_repeat_gi)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Is Repeat';
                $history->current = $request->is_repeat_gi;
                $history->save();
            }
            if (!empty($request->repeat_nature)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Repeat Nature';
                $history->current = $request->repeat_nature;
                $history->save();
            }
            if (!empty($request->nature_of_change_gi)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Nature Of Change';
                $history->current = $request->nature_of_change_gi;
                $history->save();
            }
            if (!empty($request->deviation_occured_on_gi)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'OOS occurred On';
                $history->current = $request->deviation_occured_on_gi;
                $history->save();
            }
            if (!empty($request->oos_observed_on)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'OOS Observed On';
                $history->current = $request->oos_observed_on;
                $history->save();
            }
            if (!empty($request->source_document_type_gi)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Source Document Type';
                $history->current = $request->source_document_type_gi;
                $history->save();
            }
            if (!empty($request->reference_system_document_gi)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Reference System Document';
                $history->current = $request->reference_system_document_gi;
                $history->save();
            }
            if (!empty($request->reference_document)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Reference document';
                $history->current = $request->reference_document;
                $history->save();
            }
            if (!empty($request->delay_justification)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Delay Justification';
                $history->current = $request->delay_justification;
                $history->save();
            }   
            if (!empty($request->oos_reported_date)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'OOS Reported On';
                $history->current = $request->oos_reported_date;
                $history->save();
            }   
            if (!empty($request->immediate_action)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Immediate Action';
                $history->current = $request->immediate_action;
                $history->save();
            }         
            if (!empty($request->sample_type_gi)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Sample Type';
                $history->current = $request->sample_type_gi;
                $history->save();
            }
            if (!empty($request->product_material_name_gi)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Product / Material Name';
                $history->current = $request->product_material_name_gi;
                $history->save();
            }
            if (!empty($request->market_gi)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Market';
                $history->current = $request->market_gi;
                $history->save();
            }
            if (!empty($request->customer_gi)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Customer';
                $history->current = $oos->customer_gi;
                $history->save();
            }
            if (!empty($request->specification_details)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Specification Details';
                $history->current = $oos->specification_details;
                $history->save();
            }
            if (!empty($request->STP_details)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'STP Details';
                $history->current = $oos->STP_details;
                $history->save();
            }
            if (!empty($request->manufacture_vendor)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Manufacture/Vendor';
                $history->current = $oos->manufacture_vendor;
                $history->save();
            }

            
            //HOD 1
            if (!empty($request->QA_Head_remark1)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'CQA/QA Head Remark';
                $history->current = $oos->QA_Head_remark1;
                $history->save();
            }
             //HOD 1
             if (!empty($request->QA_Head_primary_remark1)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'CQA/QA Head Primary Remark';
                $history->current = $oos->QA_Head_primary_remark1;
                $history->save();
            }
            // TapII
            if (!empty($request->Comments_plidata)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Comments';
                $history->current = $oos->Comments_plidata;
                $history->save();
            }
            if (!empty($request->justify_if_no_field_alert_pli)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Justify if no Field Alert';
                $history->current = $oos->justify_if_no_field_alert_pli;
                $history->save();
            }
            if (!empty($request->justify_if_no_analyst_int_pli)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Justify if no Analyst Int.';
                $history->current = $request->justify_if_no_analyst_int_pli;
                $history->save();
            }
            if (!empty($request->phase_i_investigation_pli)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Phase I Investigation';
                $history->current = $request->phase_i_investigation_pli;
                $history->save();
            }
            if (!empty($request->phase_i_investigation_ref_pli)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Phase I Investigation Ref';
                $history->current = $request->phase_i_investigation_ref_pli;
                $history->save();
            }
            // TapIV
            if (!empty($request->summary_of_prelim_investiga_plic)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Summary of Preliminary Investigation';
                $history->current = $request->summary_of_prelim_investiga_plic;
                $history->save();
            }
            if (!empty($request->root_cause_identified_plic)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Root Cause Identified';
                $history->current = $request->root_cause_identified_plic;
                $history->save();
            }
            if (!empty($request->oos_category_root_cause_ident_plic)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'OOS Category-Root Cause Ident';
                $history->current = $request->oos_category_root_cause_ident_plic;
                $history->save();
            }
            if (!empty($request->root_cause_details_plic)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Root Cause Details';
                $history->current = $request->root_cause_details_plic;
                $history->save();
            }
            if (!empty($request->oos_category_others_plic)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'OOS Category (Others)';
                $history->current = $request->oos_category_others_plic;
                $history->save();
            }
            if (!empty($request->Description_Deviation)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'OOS Category-Root Cause Ident.';
                $history->current = $request->Description_Deviation;
                $history->save();
            }            
            if (!empty($request->capa_required_plic)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'CAPA Required';
                $history->current = $request->capa_required_plic;
                $history->save();
            }
            if (!empty($request->reference_capa_no_plic)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Reference CAPA No';
                $history->current = $request->reference_capa_no_plic;
                $history->save();
            }
            if (!empty($request->delay_justification_for_pi_plic)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Delay Justification for Preliminary Investigation';
                $history->current = $request->delay_justification_for_pi_plic;
                $history->save();
            }
            // TapV5
            if (!empty($request->review_comments_plir)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Review Comments';
                $history->current = $request->review_comments_plir;
                $history->save();
            }
            if (!empty($request->phase_ii_inv_required_plir)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Phase II Inv. Required';
                $history->current = $request->phase_ii_inv_required_plir;
                $history->save();
            }
            if (!empty($request->phase_ib_inv_required_plir)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Phase IB Inv. Required?';
                $history->current = $request->phase_ib_inv_required_plir;
                $history->save();
            }

            //Phase IA HOD Primary Remark
            if (!empty($request->hod_remark2)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Phase IA HOD Primary Remark';
                $history->current = $request->hod_remark2;
                $history->save();
            }

             //Phase IA CQA/QA Remark
             if (!empty($request->QA_Head_remark2)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Phase IA CQA/QA Remark';
                $history->current = $request->QA_Head_remark2;
                $history->save();
            }

            //P-IA CQAH/QAH Primary Remark
            if (!empty($request->QA_Head_primary_remark2)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'P-IA CQAH/QAH Primary Remark';
                $history->current = $request->QA_Head_primary_remark2;
                $history->save();
            }

            //P-IA CQAH/QAH Primary Remark
            if (!empty($request->outcome_phase_IA)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Outcome of Phase IA investigation';
                $history->current = $request->outcome_phase_IA;
                $history->save();
            }

            if (!empty($request->reason_for_proceeding)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Reason for proceeding to Phase IB investigation';
                $history->current = $request->reason_for_proceeding;
                $history->save();
            }

            if (!empty($request->summaryy_of_review)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Summary of Review';
                $history->current = $request->summaryy_of_review;
                $history->save();
            }

            if (!empty($request->Probable_cause_iden)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Probable Cause Identification';
                $history->current = $request->Probable_cause_iden;
                $history->save();
            }
            if (!empty($request->proposal_for_hypothesis_IB)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Proposal for Phase IB hypothesis';
                $history->current = $request->proposal_for_hypothesis_IB;
                $history->save();
            }

            if (!empty($request->proposal_for_hypothesis_others)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Others';
                $history->current = $request->proposal_for_hypothesis_others;
                $history->save();
            }
            if (!empty($request->details_of_result)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Details of results (Including original OOS results for side by side comparison)';
                $history->current = $request->details_of_result;
                $history->save();
            }

            if (!empty($request->Probable_Cause_Identified)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Probable Cause Identified in Phase IB investigation';
                $history->current = $request->Probable_Cause_Identified;
                $history->save();
            }

            if (!empty($request->Any_other_Comments)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Any other Comments/ Probable Cause Evidence';
                $history->current = $request->Any_other_Comments;
                $history->save();
            }

            if (!empty($request->Proposal_for_Hypothesis)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Proposal for Hypothesis testing to confirm Probable Cause identified';
                $history->current = $request->Proposal_for_Hypothesis;
                $history->save();
            }

            if (!empty($request->Summary_of_Hypothesis)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Summary of Hypothesis';
                $history->current = $request->Summary_of_Hypothesis;
                $history->save();
            }

            if (!empty($request->Assignable_Cause)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Assignable Cause';
                $history->current = $request->Assignable_Cause;
                $history->save();
            }

            if (!empty($request->Types_of_assignable)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Types of assignable cause';
                $history->current = $request->Types_of_assignable;
                $history->save();
            }

            if (!empty($request->Types_of_assignable_others)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Others1';
                $history->current = $request->Types_of_assignable_others;
                $history->save();
            }

            if (!empty($request->Evaluation_Timeline)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Evaluation of Phase IB investigation Timeline';
                $history->current = $request->Evaluation_Timeline;
                $history->save();
            }

            if (!empty($request->timeline_met)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Is Phase IB investigation timeline met';
                $history->current = $request->timeline_met;
                $history->save();
            }

            if (!empty($request->timeline_extension)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'If No, Justify for timeline extension';
                $history->current = $request->timeline_extension;
                $history->save();
            }

            if (!empty($request->CAPA_applicable)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'CAPA applicable';
                $history->current = $request->CAPA_applicable;
                $history->save();
            }

            if (!empty($request->Repeat_testing_plan)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Repeat testing plan';
                $history->current = $request->Repeat_testing_plan;
                $history->save();
            }

            if (!empty($request->Repeat_analysis_method)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Repeat analysis method/resampling';
                $history->current = $request->Repeat_analysis_method;
                $history->save();
            }

            if (!empty($request->Details_repeat_analysis)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Details of repeat analysis';
                $history->current = $request->Details_repeat_analysis;
                $history->save();
            }

            if (!empty($request->Impact_assessment1)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Impact assessment';
                $history->current = $request->Impact_assessment1;
                $history->save();
            }

            if (!empty($request->Conclusion1)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Conclusion';
                $history->current = $request->Conclusion1;
                $history->save();
            }

            //Phase IB HOD Primary Remark
            if (!empty($request->hod_remark3)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Phase IB HOD Primary Remark';
                $history->current = $request->hod_remark3;
                $history->save();
            }

            //Phase IB CQA/QA Remark
            if (!empty($request->QA_Head_remark3)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Phase IB CQA/QA Remark';
                $history->current = $request->QA_Head_remark3;
                $history->save();
            }

             //P-IB CQAH/QAH Remark
             if (!empty($request->QA_Head_primary_remark3)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'P-IB CQAH/QAH Remark';
                $history->current = $request->QA_Head_primary_remark3;
                $history->save();
            }

            // TapVI6
            if (!empty($request->qa_approver_comments_piii)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'QA Approver Comments';
                $history->current = $request->qa_approver_comments_piii;
                $history->save();
            }
            if (!empty($request->reason_manufacturing_piii)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Reason for manufacturing';
                $history->current = $request->reason_manufacturing_piii;
                $history->save();
            }    
           
            if (!empty($request->manufact_invest_required_piii)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Manufact. Invest. Required?';
                $history->current = $request->manufact_invest_required_piii;
                $history->save();
            }
            if (!empty($request->manufacturing_invest_type_piii)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Manufacturing Invest. Type';
                $history->current = $request->manufacturing_invest_type_piii;
            } 
            if (!empty($request->audit_comments_piii)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Audit Comments';
                $history->current = $request->audit_comments_piii;
                $history->save();
            }
            if (!empty($request->hypo_exp_required_piii)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Hypo/Exp. Required';
                $history->current = $request->hypo_exp_required_piii;
                $history->save();
            }
            if (!empty($request->hypo_exp_reference_piii)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Hypo/Exp. Reference';
                $history->current = $request->hypo_exp_reference_piii;
                $history->save();
            }
            // TapVIII8
            if (!empty($request->summary_of_exp_hyp_piiqcr)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Summary of Exp./Hyp.';
                $history->current = $request->summary_of_exp_hyp_piiqcr;
                $history->save();
            }
            if (!empty($request->summary_mfg_investigation_piiqcr)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Summary Mfg. Investigation';
                $history->current = $request->summary_mfg_investigation_piiqcr;
                $history->save();
            }
            if (!empty($request->root_casue_identified_piiqcr)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Root Casue Identified';
                $history->current = $request->root_casue_identified_piiqcr;
                $history->save();
            }
            if (!empty($request->oos_category_reason_identified_piiqcr)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'OOS Category-Reason identified';
                $history->current = $request->oos_category_reason_identified_piiqcr;
                $history->save();
            }
            
            if (!empty($request->others_oos_category_piiqcr)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Others (OOS category)';
                $history->current = $request->others_oos_category_piiqcr;
                $history->save();
            }
            if (!empty($request->oos_details_obvious_error)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Details of Obvious Error';
                $history->current = $request->oos_details_obvious_error;
                $history->save();
            }
            if (!empty($request->details_of_root_cause_piiqcr)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Details of Root Cause';
                $history->current = $request->details_of_root_cause_piiqcr;
                $history->save();
            }
            if (!empty($request->impact_assessment_piiqcr)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Impact Assessment.';
                $history->current = $request->impact_assessment_piiqcr;
                $history->save();
            }

            if (!empty($request->capa_required_iia)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'CAPA Required';
                $history->current = $request->capa_required_iia;
                $history->save();
            }
            // ======= Additional Testing Proposal ============
            if (!empty($request->review_comment_atp)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Review Comment Atp.';
                $history->current = $request->review_comment_atp;
                $history->save();
            }
            if (!empty($request->additional_test_proposal_atp)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Additional Test Proposal Atp.';
                $history->current = $request->additional_test_proposal_atp;
                $history->save();
            }
            if (!empty($request->additional_test_reference_atp)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Additional Test Comment';
                $history->current = $request->additional_test_reference_atp;
                $history->save();
            }
            if (!empty($request->any_other_actions_required_atp)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Any Other Actions Required';
                $history->current = $request->any_other_actions_required_atp;
                $history->save();
            }
            // =============== OOS Conclusion  =====================
            if (!empty($request->conclusion_comments_oosc)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Conclusion Comments.';
                $history->current = $request->conclusion_comments_oosc;
                $history->save();
            }
            if (!empty($request->specification_limit_oosc)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Specification Limit.';
                $history->current = $request->specification_limit_oosc;
                $history->save();
            }
            if (!empty($request->results_to_be_reported_oosc)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Results to be Reported.';
                $history->current = $request->results_to_be_reported_oosc;
                $history->save();
            }
            if (!empty($request->final_reportable_results_oosc)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Final Reportable Results.';
                $history->current = $request->final_reportable_results_oosc;
                $history->save();
            } 
            if (!empty($request->justifi_for_averaging_results_oosc)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Justifi. for Averaging Results.';
                $history->current = $request->justifi_for_averaging_results_oosc;
                $history->save();
            } 
            if (!empty($request->oos_stands_oosc)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'OOS Stands.';
                $history->current = $request->oos_stands_oosc;
                $history->save();
            }
            if (!empty($request->capa_req_oosc)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'CAPA Req.';
                $history->current = $request->capa_req_oosc;
                $history->save();
            }            
            if (!empty($request->capa_ref_no_oosc)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'CAPA Ref No.';
                $history->current = $request->capa_ref_no_oosc;
                $history->save();
            }            
            if (!empty($request->reference_record)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'CAPA Ref No.';
                $history->current = $request->reference_record;
                $history->save();
            }
            if (!empty($request->justify_if_capa_not_required_oosc)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Justify if CAPA not required.';
                $history->current = $request->justify_if_capa_not_required_oosc;
                $history->save();
            } 
            if (!empty($request->action_plan_req_oosc)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Action Item Req.';
                $history->current = $request->action_plan_req_oosc;
                $history->save();
            }
            if (!empty($request->justification_for_delay_oosc)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = ' Justification for Delay.';
                $history->current = $request->justification_for_delay_oosc;
                $history->save();
            }
            // ========= OOS Conclusion Review ==============
            if (!empty($request->conclusion_review_comments_ocr)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = ' Conclusion Review Comments.';
                $history->current = $request->conclusion_review_comments_ocr;
                $history->save();
            }
            if (!empty($request->action_taken_on_affec_batch_ocr)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = ' Action Taken on Affec.batch.';
                $history->current = $request->action_taken_on_affec_batch_ocr;
                $history->save();
            }
            if (!empty($request->capa_req_ocr)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = ' CAPA Req.';
                $history->current = $request->capa_req_ocr;
                $history->save();
            }
            if (!empty($request->justify_if_no_risk_assessment_ocr)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Justify if No Risk Assessment';
                $history->current = $request->justify_if_no_risk_assessment_ocr;
                $history->save();
            }
            if (!empty($request->cq_approver)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'CQ Approver';
                $history->current = $request->cq_approver;
                $history->save();
            }
            // =========== CQ Review Comments ==========
            if (!empty($request->cq_review_comments_ocqr)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'CQ Review comments';
                $history->current = $request->cq_review_comments_ocqr;
                $history->save();
            }
            //==========  Batch Disposition =============
            if (!empty($request->Field_alert_QA_initial_approval)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'FAR (Field alert)';
                $history->current = $request->Field_alert_QA_initial_approval;
                $history->save();
            }   
            
            if (!empty($request->phase_iib_inv_required_plir)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Phase IIB Inv. Required?';
                $history->current = $request->phase_iib_inv_required_plir;
                $history->save();
            }   
            //Phase II A HOD Primary Remark
            if (!empty($request->hod_remark4)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Phase II A HOD Primary Remark';
                $history->current = $request->hod_remark4;
                $history->save();
            }   

            //Phase II A CQA/QA Remark
            if (!empty($request->QA_Head_remark4)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Phase II A CQA/QA Remark';
                $history->current = $request->QA_Head_remark4;
                $history->save();
            }  
            
            //P-II A QAH/CQAH Remark
            if (!empty($request->QA_Head_primary_remark4)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'P-II A QAH/CQAH Remark';
                $history->current = $request->QA_Head_primary_remark4;
                $history->save();
            } 
            
             //Phase IIB Investigation
             if (!empty($request->Laboratory_Investigation_Hypothesis)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Laboratory Investigation Hypothesis details';
                $history->current = $request->Laboratory_Investigation_Hypothesis;
                $history->save();
            } 

            if (!empty($request->Outcome_of_Laboratory)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Outcome of Laboratory Investigation';
                $history->current = $request->Outcome_of_Laboratory;
                $history->save();
            } 

            if (!empty($request->Evaluation_IIB)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Evaluation';
                $history->current = $request->Evaluation_IIB;
                $history->save();
            } 

            if (!empty($request->Assignable_Cause111)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Assignable Cause';
                $history->current = $request->Assignable_Cause111;
                $history->save();
            }

            if (!empty($request->If_assignable_cause)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'If assignable cause identified perform re-testing';
                $history->current = $request->If_assignable_cause;
                $history->save();
            }

            if (!empty($request->If_assignable_error)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'If assignable error is not identified proceed as per Phase III investigation';
                $history->current = $request->If_assignable_error;
                $history->save();
            }

            //Phase II B HOD Primary Remark
            if (!empty($request->hod_remark5)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Phase II B HOD Primary Remark';
                $history->current = $request->hod_remark5;
                $history->save();
            }

             //Phase II B CQA/QA Remark
             if (!empty($request->QA_Head_remark5)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Phase II B CQA/QA Remark';
                $history->current = $request->QA_Head_remark5;
                $history->save();
            }

            if (!empty($request->oos_category_bd)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'OOS Category';
                $history->current = $request->oos_category_bd;
                $history->save();
            }
            if (!empty($request->others_bd)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Other';
                $history->current = $request->others_bd;
                $history->save();
                
            }
            if (!empty($request->material_batch_release_bd)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Material batch release bd';
                $history->current = $request->material_batch_release_bd;
                $history->save();
            }
            if (!empty($request->other_action_bd)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Other Action';
                $history->current = $request->other_action_bd;
                $history->save();
            }
            if (!empty($request->other_parameters_results_bd)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Other Parameters Results';
                $history->current = $request->other_parameters_results_bd;
                $history->save();
            }
            if (!empty($request->trend_of_previous_batches_bd)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Trend of Previous Batches';
                $history->current = $request->trend_of_previous_batches_bd;
                $history->save();
            }
            if (!empty($request->stability_data_bd)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Stability Data';
                $history->current = $request->stability_data_bd;
                $history->save();
            }
            if (!empty($request->process_validation_data_bd)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Process Validation Data';
                $history->current = $request->process_validation_data_bd;
                $history->save();
            }
            if (!empty($request->method_validation_bd)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Method Validation';
                $history->current = $request->method_validation_bd;
                $history->save();
            }
            if (!empty($request->any_market_complaints_bd)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Any Market Complaints';
                $history->current = $request->any_market_complaints_bd;
                $history->save();
            }
            
            if (!empty($request->statistical_evaluation_bd)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Statistical Evaluation Bd';
                $history->current = $request->statistical_evaluation_bd;
                $history->save();
            }
            
            if (!empty($request->risk_analysis_disposition_bd)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Risk Analysis for Disposition';
                $history->current = $request->risk_analysis_disposition_bd;
                $history->save();
            }
            
            if (!empty($request->conclusion_bd)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Conclusion bd';
                $history->current = $request->conclusion_bd;
                $history->save();
            }
            if (!empty($request->justify_for_delay_in_activity_bd)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Justify for Delay in Activity';
                $history->current = $request->justify_for_delay_in_activity_bd;
                $history->save();
            }
            // =============== QA Head/Designee Approval ==========
            if (!empty($request->reopen_approval_comments_uaa)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = "Null";
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Approval Comments ';
                $history->current = $request->reopen_approval_comments_uaa;
                $history->save();
            }
               
            $res['body'] = $oos;

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }

        return $res;
        
    }

    public static function store_grid(OOS $oos, Request $request, $identifier)
    {
        $res = Helpers::getDefaultResponse();
        
        try {

            $oos_grid = Oosgrids::where([ 'identifier' => $identifier, 'oos_id' => $oos->id  ])->firstOrNew();
            $oos_grid->oos_id = $oos->id;
            $oos_grid->identifier = $identifier;
            $oos_grid->data = $request->$identifier;
            $oos_grid->save();
            
        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
            info('Error in OOSService@store_grid', [
                'message' => $e->getMessage()
            ]);
        }

        return $res;
    }
    
    public static function update_oss(Request $request, $id)
    {
        $res = Helpers::getDefaultResponse();

        try {

            $input = $request->all();

             // ===================== update(Audit Trail) ===========
            // $lastOosRecod = OOS::find($id);
            $lastOosRecod = OOS::where('id', $id)->first();
            
            if ($lastOosRecod->description_gi != $request->description_gi){
                // dd($lastOosRecod->description_gi);
                $history = new OosAuditTrial;
                $history->oos_id = $lastOosRecod->id;
                $history->activity_type = 'Short Description';
                $history->previous = $lastOosRecod->description_gi;
                $history->current = $request->description_gi;
                $history->comment = "Null";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->change_to =   "Not Applicable";
                $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->description_gi) || $lastOosRecod->description_gi === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->initiator_group != $request->initiator_group){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->initiator_group;
                $history->activity_type = 'Initiation department Group';
                $history->current = $request->initiator_group;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
                // $history->action_name = 'update';
                if (is_null($lastOosRecod->initiator_group) || $lastOosRecod->initiator_group === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->initiator_group_code != $request->initiator_group_code){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->initiator_group_code;
                $history->activity_type = 'Initiation department Code';
                $history->current = $request->initiator_group_code;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->initiator_group_code) || $lastOosRecod->initiator_group_code === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                $history->save();
            }
            if ($lastOosRecod->if_others_gi != $request->if_others_gi){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->if_others_gi;
                $history->activity_type = 'If Others';
                $history->current = $request->if_others_gi;
                $history->save();
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->if_others_gi) || $lastOosRecod->if_others_gi === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
            }
            if ($lastOosRecod->is_repeat_gi != $request->is_repeat_gi){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->is_repeat_gi;
                $history->activity_type = 'Is Repeat';
                $history->current = $request->is_repeat_gi;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->is_repeat_gi) || $lastOosRecod->is_repeat_gi === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->repeat_nature != $request->repeat_nature){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->repeat_nature;
                $history->activity_type = 'Repeat Nature';
                $history->current = $request->repeat_nature;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->repeat_nature) || $lastOosRecod->repeat_nature === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->nature_of_change_gi != $request->nature_of_change_gi){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->nature_of_change_gi;
                $history->activity_type = 'Nature Of Change';
                $history->current = $request->nature_of_change_gi;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->nature_of_change_gi) || $lastOosRecod->nature_of_change_gi === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->deviation_occured_on_gi != $request->deviation_occured_on_gi){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->deviation_occured_on_gi;
                $history->activity_type = 'OOS occurred On';
                $history->current = $request->deviation_occured_on_gi;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->deviation_occured_on_gi) || $lastOosRecod->deviation_occured_on_gi === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->source_document_type_gi != $request->source_document_type_gi){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->source_document_type_gi;
                $history->activity_type = 'Source Document Type';
                $history->current = $request->source_document_type_gi;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->source_document_type_gi) || $lastOosRecod->source_document_type_gi === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->sample_type_gi != $request->sample_type_gi){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->sample_type_gi;
                $history->activity_type = 'Sample Type';
                $history->current = $request->sample_type_gi;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->sample_type_gi) || $lastOosRecod->sample_type_gi === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->product_material_name_gi != $request->product_material_name_gi){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->product_material_name_gi;
                $history->activity_type = 'Product / Material Name';
                $history->current = $request->product_material_name_gi;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->product_material_name_gi) || $lastOosRecod->product_material_name_gi === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->market_gi != $request->market_gi){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->market_gi;
                $history->activity_type = 'Market';
                $history->current = $request->market_gi;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->market_gi) || $lastOosRecod->market_gi === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->customer_gi != $request->customer_gi){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->customer_gi;
                $history->activity_type = 'Customer';
                $history->current = $lastOosRecod->customer_gi;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->customer_gi) || $lastOosRecod->customer_gi === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->specification_details != $request->specification_details){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->specification_details;
                $history->activity_type = 'Specification Details';
                $history->current = $lastOosRecod->specification_details;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->specification_details) || $lastOosRecod->specification_details === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->STP_details != $request->STP_details){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->STP_details;
                $history->activity_type = 'STP Details';
                $history->current = $lastOosRecod->STP_details;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->STP_details) || $lastOosRecod->STP_details === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->manufacture_vendor != $request->manufacture_vendor){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->manufacture_vendor;
                $history->activity_type = 'Manufacture/Vendor';
                $history->current = $lastOosRecod->manufacture_vendor;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->manufacture_vendor) || $lastOosRecod->manufacture_vendor === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            //HOD 1
            if ($lastOosRecod->hod_remark1 != $request->hod_remark1){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->hod_remark1;
                $history->activity_type = 'HOD Remark';
                $history->current = $lastOosRecod->hod_remark1;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->hod_remark1) || $lastOosRecod->hod_remark1 === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            //CQA/QA Head Remark
            if ($lastOosRecod->QA_Head_remark1 != $request->QA_Head_remark1){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->QA_Head_remark1;
                $history->activity_type = 'CQA/QA Head Remark';
                $history->current = $lastOosRecod->QA_Head_remark1;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->QA_Head_remark1) || $lastOosRecod->QA_Head_remark1 === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            //CQA/QA Head Primary Remark
            if ($lastOosRecod->QA_Head_primary_remark1 != $request->QA_Head_primary_remark1){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->QA_Head_primary_remark1;
                $history->activity_type = 'CQA/QA Head Primary Remark';
                $history->current = $lastOosRecod->QA_Head_primary_remark1;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->QA_Head_primary_remark1) || $lastOosRecod->QA_Head_primary_remark1 === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            // TapII
            if ($lastOosRecod->Comments_plidata != $request->Comments_plidata){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->Comments_plidata;
                $history->activity_type = 'Comments';
                $history->current = $lastOosRecod->Comments_plidata;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->Comments_plidata) || $lastOosRecod->Comments_plidata === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->justify_if_no_field_alert_pli != $request->justify_if_no_field_alert_pli){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->justify_if_no_field_alert_pli;
                $history->activity_type = 'Justify if no Field Alert';
                $history->current = $lastOosRecod->justify_if_no_field_alert_pli;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->justify_if_no_field_alert_pli) || $lastOosRecod->justify_if_no_field_alert_pli === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->justify_if_no_analyst_int_pli != $request->justify_if_no_analyst_int_pli){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->justify_if_no_analyst_int_pli;
                $history->activity_type = 'Justify if no Analyst Int.';
                $history->current = $request->justify_if_no_analyst_int_pli;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->justify_if_no_analyst_int_pli) || $lastOosRecod->justify_if_no_analyst_int_pli === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->phase_i_investigation_pli != $request->phase_i_investigation_pli){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->phase_i_investigation_pli;
                $history->activity_type = 'Phase I Investigation';
                $history->current = $request->phase_i_investigation_pli;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->phase_i_investigation_pli) || $lastOosRecod->phase_i_investigation_pli === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            // if ($lastOosRecod->phase_i_investigation_ref_pli != $request->phase_i_investigation_ref_pli){
            //     $history = new OosAuditTrial();
            //     $history->oos_id = $lastOosRecod->id;
            //     $history->previous = $lastOosRecod->phase_i_investigation_ref_pli;
            //     $history->activity_type = 'Phase I Investigation Ref';
            //     $history->current = $request->phase_i_investigation_ref_pli;
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastOosRecod->status;
            //     $history->stage = $lastOosRecod->stage;
            //     $history->change_to =   "Opened";
            //     $history->change_from = $lastOosRecod->status;
            //    if (is_null($lastOosRecod->phase_i_investigation_ref_pli) || $lastOosRecod->phase_i_investigation_ref_pli === '') {
            //         $history->action_name = "New";
            //     } else {
            //         $history->action_name = "Update";
            //     }
            //     $history->save();
            // }
            // TapIV
            if ($lastOosRecod->summary_of_prelim_investiga_plic != $request->summary_of_prelim_investiga_plic){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->summary_of_prelim_investiga_plic;
                $history->activity_type = 'Summary of Preliminary Investigation';
                $history->current = $request->summary_of_prelim_investiga_plic;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->summary_of_prelim_investiga_plic) || $lastOosRecod->summary_of_prelim_investiga_plic === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->root_cause_identified_plic != $request->root_cause_identified_plic){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->root_cause_identified_plic;
                $history->activity_type = 'Root Cause Identified';
                $history->current = $request->root_cause_identified_plic;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->root_cause_identified_plic) || $lastOosRecod->root_cause_identified_plic === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->oos_category_root_cause_ident_plic != $request->oos_category_root_cause_ident_plic){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->oos_category_root_cause_ident_plic;
                $history->activity_type = 'OOS Category-Root Cause Ident';
                $history->current = $request->oos_category_root_cause_ident_plic;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->oos_category_root_cause_ident_plic) || $lastOosRecod->oos_category_root_cause_ident_plic === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->root_cause_details_plic != $request->root_cause_details_plic){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->root_cause_details_plic;
                $history->activity_type = 'Root Cause Details';
                $history->current = $request->root_cause_details_plic;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->root_cause_details_plic) || $lastOosRecod->root_cause_details_plic === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            
            if ($lastOosRecod->oos_category_others_plic != $request->oos_category_others_plic){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->oos_category_others_plic;
                $history->activity_type = 'OOS Category (Others)';
                $history->current = $request->oos_category_others_plic;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->oos_category_others_plic) || $lastOosRecod->oos_category_others_plic === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->capa_required_plic != $request->capa_required_plic){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->capa_required_plic;
                $history->activity_type = 'CAPA Required';
                $history->current = $request->capa_required_plic;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->capa_required_plic) || $lastOosRecod->capa_required_plic === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            // if ($lastOosRecod->reference_capa_no_plic != $request->reference_capa_no_plic){
            //     $history = new OosAuditTrial();
            //     $history->oos_id = $lastOosRecod->id;
            //     $history->previous = $lastOosRecod->reference_capa_no_plic;
            //     $history->activity_type = 'Reference CAPA No';
            //     $history->current = $request->reference_capa_no_plic;
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastOosRecod->status;
            //     $history->stage = $lastOosRecod->stage;
            //     $history->change_to =   "Opened";
            //     $history->change_from = $lastOosRecod->status;
            //    if (is_null($lastOosRecod->reference_capa_no_plic) || $lastOosRecod->reference_capa_no_plic === '') {
            //         $history->action_name = "New";
            //     } else {
            //         $history->action_name = "Update";
            //     }
            //     $history->save();
            // }
            if ($lastOosRecod->delay_justification_for_pi_plic != $request->delay_justification_for_pi_plic){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->delay_justification_for_pi_plic;
                $history->activity_type = 'Delay Justification for Preliminary Investigation';
                $history->current = $request->delay_justification_for_pi_plic;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->delay_justification_for_pi_plic) || $lastOosRecod->delay_justification_for_pi_plic === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            // TapV5
            if ($lastOosRecod->review_comments_plir != $request->review_comments_plir){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->review_comments_plir;                
                $history->activity_type = 'Review Comments';
                $history->current = $request->review_comments_plir;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->review_comments_plir) || $lastOosRecod->review_comments_plir === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->phase_ii_inv_required_plir != $request->phase_ii_inv_required_plir){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->phase_ii_inv_required_plir;
                $history->activity_type = 'Phase II Inv. Required';
                $history->current = $request->phase_ii_inv_required_plir;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->phase_ii_inv_required_plir) || $lastOosRecod->phase_ii_inv_required_plir === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->phase_ib_inv_required_plir != $request->phase_ib_inv_required_plir){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->phase_ib_inv_required_plir;
                $history->activity_type = 'Phase IB Inv. Required?';
                $history->current = $request->phase_ib_inv_required_plir;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->phase_ib_inv_required_plir) || $lastOosRecod->phase_ib_inv_required_plir === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            //Phase IA HOD Primary Remark
            if ($lastOosRecod->hod_remark2 != $request->hod_remark2){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->hod_remark2;
                $history->activity_type = 'Phase IA HOD Primary Remark';
                $history->current = $request->hod_remark2;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->hod_remark2) || $lastOosRecod->hod_remark2 === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            //Phase IA CQA/QA Remark
            if ($lastOosRecod->QA_Head_remark2 != $request->QA_Head_remark2){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->QA_Head_remark2;
                $history->activity_type = 'Phase IA CQA/QA Remark';
                $history->current = $request->QA_Head_remark2;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->QA_Head_remark2) || $lastOosRecod->QA_Head_remark2 === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

             //P-IA CQAH/QAH Primary Remark
             if ($lastOosRecod->QA_Head_primary_remark2 != $request->QA_Head_primary_remark2){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->QA_Head_primary_remark2;
                $history->activity_type = 'P-IA CQAH/QAH Primary Remark';
                $history->current = $request->QA_Head_primary_remark2;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->QA_Head_primary_remark2) || $lastOosRecod->QA_Head_primary_remark2 === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

                //Phase IB Investigation
                if ($lastOosRecod->outcome_phase_IA != $request->outcome_phase_IA){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->outcome_phase_IA;
                    $history->activity_type = 'Outcome of Phase IA investigation';
                    $history->current = $request->outcome_phase_IA;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->outcome_phase_IA) || $lastOosRecod->outcome_phase_IA === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->reason_for_proceeding != $request->reason_for_proceeding){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->reason_for_proceeding;
                    $history->activity_type = 'Reason for proceeding to Phase IB investigation';
                    $history->current = $request->reason_for_proceeding;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->reason_for_proceeding) || $lastOosRecod->reason_for_proceeding === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->summaryy_of_review != $request->summaryy_of_review){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->summaryy_of_review;
                    $history->activity_type = 'Summary of Review';
                    $history->current = $request->summaryy_of_review;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->summaryy_of_review) || $lastOosRecod->summaryy_of_review === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->Probable_cause_iden != $request->Probable_cause_iden){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->Probable_cause_iden;
                    $history->activity_type = 'Probable Cause Identification';
                    $history->current = $request->Probable_cause_iden;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->Probable_cause_iden) || $lastOosRecod->Probable_cause_iden === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->proposal_for_hypothesis_IB != $request->proposal_for_hypothesis_IB){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->proposal_for_hypothesis_IB;
                    $history->activity_type = 'Proposal for Phase IB hypothesis';
                    $history->current = $request->proposal_for_hypothesis_IB;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->proposal_for_hypothesis_IB) || $lastOosRecod->proposal_for_hypothesis_IB === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->proposal_for_hypothesis_others != $request->proposal_for_hypothesis_others){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->proposal_for_hypothesis_others;
                    $history->activity_type = 'Others';
                    $history->current = $request->proposal_for_hypothesis_others;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->proposal_for_hypothesis_others) || $lastOosRecod->proposal_for_hypothesis_others === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->details_of_result != $request->details_of_result){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->details_of_result;
                    $history->activity_type = 'Details of results (Including original OOS results for side by side comparison)';
                    $history->current = $request->details_of_result;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->details_of_result) || $lastOosRecod->details_of_result === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->Probable_Cause_Identified != $request->Probable_Cause_Identified){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->Probable_Cause_Identified;
                    $history->activity_type = 'Probable Cause Identified in Phase IB investigation';
                    $history->current = $request->Probable_Cause_Identified;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->Probable_Cause_Identified) || $lastOosRecod->Probable_Cause_Identified === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->Any_other_Comments != $request->Any_other_Comments){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->Any_other_Comments;
                    $history->activity_type = 'Any other Comments/ Probable Cause Evidence';
                    $history->current = $request->Any_other_Comments;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->Any_other_Comments) || $lastOosRecod->Any_other_Comments === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->Proposal_for_Hypothesis != $request->Proposal_for_Hypothesis){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->Proposal_for_Hypothesis;
                    $history->activity_type = 'Proposal for Hypothesis testing to confirm Probable Cause identified';
                    $history->current = $request->Proposal_for_Hypothesis;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->Proposal_for_Hypothesis) || $lastOosRecod->Proposal_for_Hypothesis === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->Summary_of_Hypothesis != $request->Summary_of_Hypothesis){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->Summary_of_Hypothesis;
                    $history->activity_type = 'Summary of Hypothesis';
                    $history->current = $request->Summary_of_Hypothesis;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->Summary_of_Hypothesis) || $lastOosRecod->Summary_of_Hypothesis === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->Assignable_Cause != $request->Assignable_Cause){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->Assignable_Cause;
                    $history->activity_type = 'Assignable Cause';
                    $history->current = $request->Assignable_Cause;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->Assignable_Cause) || $lastOosRecod->Assignable_Cause === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->Types_of_assignable != $request->Types_of_assignable){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->Types_of_assignable;
                    $history->activity_type = 'Types of assignable cause';
                    $history->current = $request->Types_of_assignable;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->Types_of_assignable) || $lastOosRecod->Types_of_assignable === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->Types_of_assignable_others != $request->Types_of_assignable_others){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->Types_of_assignable_others;
                    $history->activity_type = 'Others1';
                    $history->current = $request->Types_of_assignable_others;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->Types_of_assignable_others) || $lastOosRecod->Types_of_assignable_others === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->Evaluation_Timeline != $request->Evaluation_Timeline){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->Evaluation_Timeline;
                    $history->activity_type = 'Evaluation of Phase IB investigation Timeline';
                    $history->current = $request->Evaluation_Timeline;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->Evaluation_Timeline) || $lastOosRecod->Evaluation_Timeline === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->timeline_met != $request->timeline_met){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->timeline_met;
                    $history->activity_type = 'Is Phase IB investigation timeline met';
                    $history->current = $request->timeline_met;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->timeline_met) || $lastOosRecod->timeline_met === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->timeline_extension != $request->timeline_extension){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->timeline_extension;
                    $history->activity_type = 'If No, Justify for timeline extension';
                    $history->current = $request->timeline_extension;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->timeline_extension) || $lastOosRecod->timeline_extension === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->CAPA_applicable != $request->CAPA_applicable){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->CAPA_applicable;
                    $history->activity_type = 'CAPA applicable';
                    $history->current = $request->CAPA_applicable;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->CAPA_applicable) || $lastOosRecod->CAPA_applicable === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->Repeat_testing_plan != $request->Repeat_testing_plan){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->Repeat_testing_plan;
                    $history->activity_type = 'Repeat testing plan';
                    $history->current = $request->Repeat_testing_plan;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->Repeat_testing_plan) || $lastOosRecod->Repeat_testing_plan === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->Repeat_analysis_method != $request->Repeat_analysis_method){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->Repeat_analysis_method;
                    $history->activity_type = 'Repeat analysis method/resampling';
                    $history->current = $request->Repeat_analysis_method;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->Repeat_analysis_method) || $lastOosRecod->Repeat_analysis_method === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->Details_repeat_analysis != $request->Details_repeat_analysis){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->Details_repeat_analysis;
                    $history->activity_type = 'Details of repeat analysis';
                    $history->current = $request->Details_repeat_analysis;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->Details_repeat_analysis) || $lastOosRecod->Details_repeat_analysis === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->Impact_assessment1 != $request->Impact_assessment1){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->Impact_assessment1;
                    $history->activity_type = 'Impact assessment';
                    $history->current = $request->Impact_assessment1;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->Impact_assessment1) || $lastOosRecod->Impact_assessment1 === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->Conclusion1 != $request->Conclusion1){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->Conclusion1;
                    $history->activity_type = 'Conclusion';
                    $history->current = $request->Conclusion1;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->Conclusion1) || $lastOosRecod->Conclusion1 === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->hod_remark3 != $request->hod_remark3){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->hod_remark3;
                    $history->activity_type = 'Phase IB HOD Primary Remark';
                    $history->current = $request->hod_remark3;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->hod_remark3) || $lastOosRecod->hod_remark3 === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->QA_Head_remark3 != $request->QA_Head_remark3){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->QA_Head_remark3;
                    $history->activity_type = 'Phase IB CQA/QA Remark';
                    $history->current = $request->QA_Head_remark3;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->QA_Head_remark3) || $lastOosRecod->QA_Head_remark3 === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

                if ($lastOosRecod->QA_Head_primary_remark3 != $request->QA_Head_primary_remark3){
                    $history = new OosAuditTrial();
                    $history->oos_id = $lastOosRecod->id;
                    $history->previous = $lastOosRecod->QA_Head_primary_remark3;
                    $history->activity_type = 'P-IB CQAH/QAH Remark';
                    $history->current = $request->QA_Head_primary_remark3;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastOosRecod->status;
                    $history->stage = $lastOosRecod->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->QA_Head_primary_remark3) || $lastOosRecod->QA_Head_primary_remark3 === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }
                    $history->save();
                }

            // TapVI6
            if ($lastOosRecod->qa_approver_comments_piii != $request->qa_approver_comments_piii){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->qa_approver_comments_piii;
                $history->activity_type = 'QA Approver Comments';
                $history->current = $request->qa_approver_comments_piii;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->qa_approver_comments_piii) || $lastOosRecod->qa_approver_comments_piii === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->reason_manufacturing_piii != $request->reason_manufacturing_piii){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->reason_manufacturing_piii;
                $history->activity_type = 'Reason for manufacturing';
                $history->current = $request->reason_manufacturing_piii;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->reason_manufacturing_piii) || $lastOosRecod->reason_manufacturing_piii === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->manufact_invest_required_piii != $request->manufact_invest_required_piii){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->manufact_invest_required_piii;
                $history->activity_type = 'Manufact. Invest. Required?';
                $history->current = $request->manufact_invest_required_piii;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->manufact_invest_required_piii) || $lastOosRecod->manufact_invest_required_piii === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->manufacturing_invest_type_piii != $request->manufacturing_invest_type_piii){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->manufacturing_invest_type_piii;
                $history->activity_type = 'Manufacturing Invest. Type';
                $history->current = $request->manufacturing_invest_type_piii;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->manufacturing_invest_type_piii) || $lastOosRecod->manufacturing_invest_type_piii === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
            }
            if ($lastOosRecod->audit_comments_piii != $request->audit_comments_piii){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->audit_comments_piii;
                $history->activity_type = 'Audit Comments';
                $history->current = $request->audit_comments_piii;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiator";
               if (is_null($lastOosRecod->audit_comments_piii) || $lastOosRecod->audit_comments_piii === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->hypo_exp_required_piii != $request->hypo_exp_required_piii){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->hypo_exp_required_piii;
                $history->activity_type = 'Hypo/Exp. Required';
                $history->current = $request->hypo_exp_required_piii;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->hypo_exp_required_piii) || $lastOosRecod->hypo_exp_required_piii === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            // if ($lastOosRecod->hypo_exp_reference_piii != $request->hypo_exp_reference_piii){
            //     $history = new OosAuditTrial();
            //     $history->oos_id = $lastOosRecod->id;
            //     $history->previous = $lastOosRecod->hypo_exp_reference_piii;
            //     $history->activity_type = 'Hypo/Exp. Reference';
            //     $history->current = $request->hypo_exp_reference_piii;
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastOosRecod->status;
            //     $history->stage = $lastOosRecod->stage;
            //     $history->change_to =   "Opened";
            //     $history->change_from = $lastOosRecod->status;
            //    if (is_null($lastOosRecod->hypo_exp_reference_piii) || $lastOosRecod->hypo_exp_reference_piii === '') {
            //         $history->action_name = "New";
            //     } else {
            //         $history->action_name = "Update";
            //     }
            //     $history->save();
            // }
            // TapVIII8
            if ($lastOosRecod->summary_of_exp_hyp_piiqcr != $request->summary_of_exp_hyp_piiqcr){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->summary_of_exp_hyp_piiqcr;
                $history->activity_type = 'Summary of Exp./Hyp.';
                $history->current = $request->summary_of_exp_hyp_piiqcr;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->summary_of_exp_hyp_piiqcr) || $lastOosRecod->summary_of_exp_hyp_piiqcr === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->summary_mfg_investigation_piiqcr != $request->summary_mfg_investigation_piiqcr){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->summary_mfg_investigation_piiqcr;
                $history->activity_type = 'Summary Mfg. Investigation';
                $history->current = $request->summary_mfg_investigation_piiqcr;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->summary_mfg_investigation_piiqcr) || $lastOosRecod->summary_mfg_investigation_piiqcr === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            // if ($lastOosRecod->reference_system_document_gi != $request->reference_system_document_gi){
            //     $history = new OosAuditTrial();
            //     $history->oos_id = $lastOosRecod->id;
            //     $history->previous = $lastOosRecod->reference_system_document_gi;
            //     $history->activity_type = 'Reference System Document';
            //     $history->current = $request->reference_system_document_gi;
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastOosRecod->status;
            //     $history->stage = $lastOosRecod->stage;
            //     $history->change_to =   "Opened";
            //     $history->change_from = $lastOosRecod->status;
            //    if (is_null($lastOosRecod->reference_system_document_gi) || $lastOosRecod->reference_system_document_gi === '') {
            //         $history->action_name = "New";
            //     } else {
            //         $history->action_name = "Update";
            //     }
            //     $history->save();
            // }
            if ($lastOosRecod->oos_observed_on != $request->oos_observed_on){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->oos_observed_on;
                $history->activity_type = 'OOS Observed On';
                $history->current = $request->oos_observed_on;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->oos_observed_on) || $lastOosRecod->oos_observed_on === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->root_casue_identified_piiqcr != $request->root_casue_identified_piiqcr){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->root_casue_identified_piiqcr;
                $history->activity_type = 'Root Casue Identified';
                $history->current = $request->root_casue_identified_piiqcr;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->root_casue_identified_piiqcr) || $lastOosRecod->root_casue_identified_piiqcr === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            // if ($lastOosRecod->reference_document != $request->reference_document){
            //     $history = new OosAuditTrial();
            //     $history->oos_id = $lastOosRecod->id;
            //     $history->previous = $lastOosRecod->reference_document;
            //     $history->activity_type = 'Reference document';
            //     $history->current = $request->reference_document;
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastOosRecod->status;
            //     $history->stage = $lastOosRecod->stage;
            //     $history->change_to =   "Opened";
            //     $history->change_from = $lastOosRecod->status;
            //    if (is_null($lastOosRecod->reference_document) || $lastOosRecod->reference_document === '') {
            //         $history->action_name = "New";
            //     } else {
            //         $history->action_name = "Update";
            //     }
            //     $history->save();
            // }
            if ($lastOosRecod->oos_category_reason_identified_piiqcr != $request->oos_category_reason_identified_piiqcr){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->oos_category_reason_identified_piiqcr;
                $history->activity_type = 'OOS Category-Reason identified';
                $history->current = $request->oos_category_reason_identified_piiqcr;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->oos_category_reason_identified_piiqcr) || $lastOosRecod->oos_category_reason_identified_piiqcr === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            
            if ($lastOosRecod->others_oos_category_piiqcr != $request->others_oos_category_piiqcr){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->others_oos_category_piiqcr;
                $history->activity_type = 'Others (OOS category)';
                $history->current = $request->others_oos_category_piiqcr;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->others_oos_category_piiqcr) || $lastOosRecod->others_oos_category_piiqcr === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->oos_details_obvious_error != $request->oos_details_obvious_error){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->oos_details_obvious_error;
                $history->activity_type = 'Details of Obvious Error';
                $history->current = $request->oos_details_obvious_error;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->oos_details_obvious_error) || $lastOosRecod->oos_details_obvious_error === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->delay_justification != $request->delay_justification){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->delay_justification;
                $history->activity_type = 'Delay Justification';
                $history->current = $request->delay_justification;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->delay_justification) || $lastOosRecod->delay_justification === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->oos_reported_date != $request->oos_reported_date){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->oos_reported_date;
                $history->activity_type = 'OOS Reported On';
                $history->current = $request->oos_reported_date;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->oos_reported_date) || $lastOosRecod->oos_reported_date === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->immediate_action != $request->immediate_action){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->immediate_action;
                $history->activity_type = 'Immediate Action';
                $history->current = $request->immediate_action;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->immediate_action) || $lastOosRecod->immediate_action === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->Description_Deviation != $request->Description_Deviation){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->Description_Deviation;
                $history->activity_type = 'OOS Category-Root Cause Ident.';
                $history->current = $request->Description_Deviation;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->Description_Deviation) || $lastOosRecod->Description_Deviation === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->details_of_root_cause_piiqcr != $request->details_of_root_cause_piiqcr){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->details_of_root_cause_piiqcr;
                $history->activity_type = 'Details of Root Cause';
                $history->current = $request->details_of_root_cause_piiqcr;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->details_of_root_cause_piiqcr) || $lastOosRecod->details_of_root_cause_piiqcr === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->impact_assessment_piiqcr != $request->impact_assessment_piiqcr){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->impact_assessment_piiqcr;
                $history->activity_type = 'Impact Assessment.';
                $history->current = $request->impact_assessment_piiqcr;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->impact_assessment_piiqcr) || $lastOosRecod->impact_assessment_piiqcr === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->capa_required_iia != $request->capa_required_iia){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->capa_required_iia;
                $history->activity_type = 'CAPA Required';
                $history->current = $request->capa_required_iia;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->capa_required_iia) || $lastOosRecod->capa_required_iia === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }


            // ======= Additional Testing Proposal ============
            if ($lastOosRecod->review_comment_atp != $request->review_comment_atp){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->review_comment_atp;
                $history->activity_type = 'Review Comment Atp.';
                $history->current = $request->review_comment_atp;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->review_comment_atp) || $lastOosRecod->review_comment_atp === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->additional_test_proposal_atp != $request->additional_test_proposal_atp){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->additional_test_proposal_atp;
                $history->activity_type = 'Additional Test Proposal Atp.';
                $history->current = $request->additional_test_proposal_atp;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->additional_test_proposal_atp) || $lastOosRecod->additional_test_proposal_atp === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            // if ($lastOosRecod->additional_test_reference_atp != $request->additional_test_reference_atp){
            //     $history = new OosAuditTrial();
            //     $history->oos_id = $lastOosRecod->id;
            //     $history->previous = $lastOosRecod->additional_test_reference_atp;
            //     $history->activity_type = 'Additional Test Comment.';
            //     $history->current = $request->additional_test_reference_atp;
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastOosRecod->status;
            //     $history->stage = $lastOosRecod->stage;
            //     $history->change_to =   "Opened";
            //     $history->change_from = $lastOosRecod->status;
            //    if (is_null($lastOosRecod->additional_test_reference_atp) || $lastOosRecod->additional_test_reference_atp === '') {
            //         $history->action_name = "New";
            //     } else {
            //         $history->action_name = "Update";
            //     }
            //     $history->save();
            // }
            if ($lastOosRecod->any_other_actions_required_atp != $request->any_other_actions_required_atp){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->any_other_actions_required_atp;
                $history->activity_type = 'Any Other Actions Required';
                $history->current = $request->any_other_actions_required_atp;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->any_other_actions_required_atp) || $lastOosRecod->any_other_actions_required_atp === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            // =============== OOS Conclusion  =====================
            if ($lastOosRecod->conclusion_comments_oosc != $request->conclusion_comments_oosc){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->conclusion_comments_oosc;
                $history->activity_type = 'Conclusion Comments.';
                $history->current = $request->conclusion_comments_oosc;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->conclusion_comments_oosc) || $lastOosRecod->conclusion_comments_oosc === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->specification_limit_oosc != $request->specification_limit_oosc){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->specification_limit_oosc;
                $history->activity_type = 'Specification Limit.';
                $history->current = $request->specification_limit_oosc;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->specification_limit_oosc) || $lastOosRecod->specification_limit_oosc === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->results_to_be_reported_oosc != $request->results_to_be_reported_oosc){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->results_to_be_reported_oosc;
                $history->activity_type = 'Results to be Reported.';
                $history->current = $request->results_to_be_reported_oosc;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->results_to_be_reported_oosc) || $lastOosRecod->results_to_be_reported_oosc === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->final_reportable_results_oosc != $request->final_reportable_results_oosc){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->final_reportable_results_oosc;
                $history->activity_type = 'Final Reportable Results.';
                $history->current = $request->final_reportable_results_oosc;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->final_reportable_results_oosc) || $lastOosRecod->final_reportable_results_oosc === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            } 
            if ($lastOosRecod->justifi_for_averaging_results_oosc != $request->justifi_for_averaging_results_oosc){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->justifi_for_averaging_results_oosc;
                $history->activity_type = 'Justifi. for Averaging Results.';
                $history->current = $request->justifi_for_averaging_results_oosc;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->justifi_for_averaging_results_oosc) || $lastOosRecod->justifi_for_averaging_results_oosc === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            } 
            if ($lastOosRecod->oos_stands_oosc != $request->oos_stands_oosc){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->oos_stands_oosc;
                $history->activity_type = 'OOS Stands.';
                $history->current = $request->oos_stands_oosc;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->oos_stands_oosc) || $lastOosRecod->oos_stands_oosc === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->capa_req_oosc != $request->capa_req_oosc){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->capa_req_oosc;
                $history->activity_type = 'CAPA Req.';
                $history->current = $request->capa_req_oosc;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->capa_req_oosc) || $lastOosRecod->capa_req_oosc === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            // if ($lastOosRecod->capa_ref_no_oosc != $request->capa_ref_no_oosc){
            //     $history = new OosAuditTrial();
            //     $history->oos_id = $lastOosRecod->id;
            //     $history->previous = $lastOosRecod->capa_ref_no_oosc;
            //     $history->activity_type = 'CAPA Ref No.';
            //     $history->current = $request->capa_ref_no_oosc;
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastOosRecod->status;
            //     $history->stage = $lastOosRecod->stage;
            //     $history->change_to =   "Opened";
            //     $history->change_from = $lastOosRecod->status;
            //    if (is_null($lastOosRecod->capa_ref_no_oosc) || $lastOosRecod->capa_ref_no_oosc === '') {
            //         $history->action_name = "New";
            //     } else {
            //         $history->action_name = "Update";
            //     }
            //     $history->save();
            // }
            if ($lastOosRecod->Field_alert_QA_initial_approval != $request->Field_alert_QA_initial_approval){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->Field_alert_QA_initial_approval;
                $history->activity_type = 'FAR (Field alert)';
                $history->current = $request->Field_alert_QA_initial_approval;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->Field_alert_QA_initial_approval) || $lastOosRecod->Field_alert_QA_initial_approval === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->phase_iib_inv_required_plir != $request->phase_iib_inv_required_plir){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->phase_iib_inv_required_plir;
                $history->activity_type = 'Phase IIB Inv. Required?';
                $history->current = $request->phase_iib_inv_required_plir;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->phase_iib_inv_required_plir) || $lastOosRecod->phase_iib_inv_required_plir === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->hod_remark4 != $request->hod_remark4){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->hod_remark4;
                $history->activity_type = 'Phase II A HOD Primary Remark';
                $history->current = $request->hod_remark4;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->hod_remark4) || $lastOosRecod->hod_remark4 === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->QA_Head_remark4 != $request->QA_Head_remark4){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->QA_Head_remark4;
                $history->activity_type = 'Phase II A CQA/QA Remark';
                $history->current = $request->QA_Head_remark4;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->QA_Head_remark4) || $lastOosRecod->QA_Head_remark4 === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->QA_Head_primary_remark4 != $request->QA_Head_primary_remark4){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->QA_Head_primary_remark4;
                $history->activity_type = 'P-II A QAH/CQAH Remark';
                $history->current = $request->QA_Head_primary_remark4;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->QA_Head_primary_remark4) || $lastOosRecod->QA_Head_primary_remark4 === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->Laboratory_Investigation_Hypothesis != $request->Laboratory_Investigation_Hypothesis){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->Laboratory_Investigation_Hypothesis;
                $history->activity_type = 'Laboratory Investigation Hypothesis details';
                $history->current = $request->Laboratory_Investigation_Hypothesis;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->Laboratory_Investigation_Hypothesis) || $lastOosRecod->Laboratory_Investigation_Hypothesis === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->Outcome_of_Laboratory != $request->Outcome_of_Laboratory){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->Outcome_of_Laboratory;
                $history->activity_type = 'Outcome of Laboratory Investigation';
                $history->current = $request->Outcome_of_Laboratory;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->Outcome_of_Laboratory) || $lastOosRecod->Outcome_of_Laboratory === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->Evaluation_IIB != $request->Evaluation_IIB){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->Evaluation_IIB;
                $history->activity_type = 'Evaluation';
                $history->current = $request->Evaluation_IIB;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->Evaluation_IIB) || $lastOosRecod->Evaluation_IIB === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->Assignable_Cause111 != $request->Assignable_Cause111){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->Assignable_Cause111;
                $history->activity_type = 'Assignable Cause';
                $history->current = $request->Assignable_Cause111;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->Assignable_Cause111) || $lastOosRecod->Assignable_Cause111 === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->hod_remark5 != $request->hod_remark5){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->hod_remark5;
                $history->activity_type = 'Phase II B HOD Primary Remark';
                $history->current = $request->hod_remark5;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->hod_remark5) || $lastOosRecod->hod_remark5 === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }


            if ($lastOosRecod->QA_Head_remark5 != $request->QA_Head_remark5){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->QA_Head_remark5;
                $history->activity_type = 'Phase II B CQA/QA Remark';
                $history->current = $request->QA_Head_remark5;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->QA_Head_remark5) || $lastOosRecod->QA_Head_remark5 === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->If_assignable_cause != $request->If_assignable_cause){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->If_assignable_cause;
                $history->activity_type = 'If assignable cause identified perform re-testing';
                $history->current = $request->If_assignable_cause;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->If_assignable_cause) || $lastOosRecod->If_assignable_cause === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }

            if ($lastOosRecod->If_assignable_error != $request->If_assignable_error){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->If_assignable_error;
                $history->activity_type = 'If assignable error is not identified proceed as per Phase III investigation';
                $history->current = $request->If_assignable_error;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->If_assignable_error) || $lastOosRecod->If_assignable_error === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            // if ($lastOosRecod->reference_record != $request->reference_record){
            //     $history = new OosAuditTrial();
            //     $history->oos_id = $lastOosRecod->id;
            //     $history->previous = $lastOosRecod->reference_record;
            //     $history->activity_type = 'CAPA Ref No.';
            //     $history->current = $request->reference_record;
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastOosRecod->status;
            //     $history->stage = $lastOosRecod->stage;
            //     $history->change_to =   "Opened";
            //     $history->change_from = $lastOosRecod->status;
            //    if (is_null($lastOosRecod->reference_record) || $lastOosRecod->reference_record === '') {
            //         $history->action_name = "New";
            //     } else {
            //         $history->action_name = "Update";
            //     }
            //     $history->save();
            // }
            if ($lastOosRecod->justify_if_capa_not_required_oosc != $request->justify_if_capa_not_required_oosc){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->justify_if_capa_not_required_oosc;
                $history->activity_type = 'Justify if CAPA not required.';
                $history->current = $request->justify_if_capa_not_required_oosc;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
                if (is_null($lastOosRecod->justify_if_capa_not_required_oosc) || $lastOosRecod->justify_if_capa_not_required_oosc === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            } 
            if ($lastOosRecod->action_plan_req_oosc != $request->action_plan_req_oosc){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->action_plan_req_oosc;
                $history->activity_type = 'Action Item Req.';
                $history->current = $request->action_plan_req_oosc;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->action_plan_req_oosc) || $lastOosRecod->action_plan_req_oosc === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->justification_for_delay_oosc != $request->justification_for_delay_oosc){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->justification_for_delay_oosc;
                $history->activity_type = ' Justification for Delay.';
                $history->current = $request->justification_for_delay_oosc;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->justification_for_delay_oosc) || $lastOosRecod->justification_for_delay_oosc === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            // ========= OOS Conclusion Review ==============
            if ($lastOosRecod->conclusion_review_comments_ocr != $request->conclusion_review_comments_ocr){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->conclusion_review_comments_ocr;                
                $history->activity_type = ' Conclusion Review Comments.';
                $history->current = $request->conclusion_review_comments_ocr;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->conclusion_review_comments_ocr) || $lastOosRecod->conclusion_review_comments_ocr === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->action_taken_on_affec_batch_ocr != $request->action_taken_on_affec_batch_ocr){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->action_taken_on_affec_batch_ocr;
                $history->activity_type = 'Action Taken on Affec.batch.';
                $history->current = $request->action_taken_on_affec_batch_ocr;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->action_taken_on_affec_batch_ocr) || $lastOosRecod->action_taken_on_affec_batch_ocr === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->capa_req_ocr != $request->capa_req_ocr){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->capa_req_ocr;
                $history->activity_type = 'CAPA Req.';
                $history->current = $request->capa_req_ocr;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->capa_req_ocr) || $lastOosRecod->capa_req_ocr === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->justify_if_no_risk_assessment_ocr != $request->justify_if_no_risk_assessment_ocr){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->justify_if_no_risk_assessment_ocr;
                $history->activity_type = 'Justify if No Risk Assessment';
                $history->current = $request->justify_if_no_risk_assessment_ocr;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->justify_if_no_risk_assessment_ocr) || $lastOosRecod->justify_if_no_risk_assessment_ocr === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->cq_approver != $request->cq_approver){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->cq_approver;
                $history->activity_type = 'CQ Approver';
                $history->current = $request->cq_approver;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->cq_approver) || $lastOosRecod->cq_approver === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            // =========== CQ Review Comments ==========
            if ($lastOosRecod->cq_review_comments_ocqr != $request->cq_review_comments_ocqr){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->cq_review_comments_ocqr;
                $history->activity_type = 'CQ Review comments';
                $history->current = $request->cq_review_comments_ocqr;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiator";
               if (is_null($lastOosRecod->cq_review_comments_ocqr) || $lastOosRecod->cq_review_comments_ocqr === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            //==========  Batch Disposition =============
            if ($lastOosRecod->oos_category_bd != $request->oos_category_bd){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->oos_category_bd;
                $history->activity_type = 'OOS Category';
                $history->current = $request->oos_category_bd;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->oos_category_bd) || $lastOosRecod->oos_category_bd === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->others_bd != $request->others_bd){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->others_bd;
                $history->activity_type = 'Other';
                $history->current = $request->others_bd;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->others_bd) || $lastOosRecod->others_bd === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
                
            }
            if ($lastOosRecod->material_batch_release_bd != $request->material_batch_release_bd){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->material_batch_release_bd;
                $history->activity_type = 'Material batch release bd';
                $history->current = $request->material_batch_release_bd;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->material_batch_release_bd) || $lastOosRecod->material_batch_release_bd === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->other_action_bd != $request->other_action_bd){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->other_action_bd;
                $history->activity_type = 'Other Action';
                $history->current = $request->other_action_bd;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->other_action_bd) || $lastOosRecod->other_action_bd === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->other_parameters_results_bd != $request->other_parameters_results_bd){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->other_parameters_results_bd;
                $history->activity_type = 'Other Parameters Results';
                $history->current = $request->other_parameters_results_bd;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->other_parameters_results_bd) || $lastOosRecod->other_parameters_results_bd === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->trend_of_previous_batches_bd != $request->trend_of_previous_batches_bd){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->trend_of_previous_batches_bd;
                $history->activity_type = 'Trend of Previous Batches';
                $history->current = $request->trend_of_previous_batches_bd;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->trend_of_previous_batches_bd) || $lastOosRecod->trend_of_previous_batches_bd === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->stability_data_bd != $request->stability_data_bd){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->stability_data_bd;
                $history->activity_type = 'Stability Data';
                $history->current = $request->stability_data_bd;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->stability_data_bd) || $lastOosRecod->stability_data_bd === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->process_validation_data_bd != $request->process_validation_data_bd){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->process_validation_data_bd;
                $history->activity_type = 'Process Validation Data';
                $history->current = $request->process_validation_data_bd;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->process_validation_data_bd) || $lastOosRecod->process_validation_data_bd === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->method_validation_bd != $request->method_validation_bd){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->method_validation_bd;
                $history->activity_type = 'Method Validation';
                $history->current = $request->method_validation_bd;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->method_validation_bd) || $lastOosRecod->method_validation_bd === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->any_market_complaints_bd != $request->any_market_complaints_bd){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->any_market_complaints_bd;
                $history->activity_type = 'Any Market Complaints';
                $history->current = $request->any_market_complaints_bd;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->any_market_complaints_bd) || $lastOosRecod->any_market_complaints_bd === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            
            if ($lastOosRecod->statistical_evaluation_bd != $request->statistical_evaluation_bd){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->statistical_evaluation_bd;
                $history->activity_type = 'Statistical Evaluation Bd';
                $history->current = $request->statistical_evaluation_bd;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->statistical_evaluation_bd) || $lastOosRecod->statistical_evaluation_bd === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            
            if ($lastOosRecod->risk_analysis_disposition_bd != $request->risk_analysis_disposition_bd){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->risk_analysis_disposition_bd;
                $history->activity_type = 'Risk Analysis for Disposition';
                $history->current = $request->risk_analysis_disposition_bd;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->risk_analysis_disposition_bd) || $lastOosRecod->risk_analysis_disposition_bd === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            
            if ($lastOosRecod->conclusion_bd != $request->conclusion_bd){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->conclusion_bd;
                $history->activity_type = 'Conclusion bd';
                $history->current = $request->conclusion_bd;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->conclusion_bd) || $lastOosRecod->conclusion_bd === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
            if ($lastOosRecod->justify_for_delay_in_activity_bd != $request->justify_for_delay_in_activity_bd){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->justify_for_delay_in_activity_bd;
               if (is_null($lastOosRecod->justify_for_delay_in_activity_bd) || $lastOosRecod->justify_for_delay_in_activity_bd === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->activity_type = 'Justify for Delay in Activity';
                $history->current = $request->justify_for_delay_in_activity_bd;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
                $history->save();
            }
            // =============== QA Head/Designee Approval ==========
            if ($lastOosRecod->reopen_approval_comments_uaa != $request->reopen_approval_comments_uaa){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->reopen_approval_comments_uaa;
                $history->activity_type = 'Approval Comments ';
                $history->current = $request->reopen_approval_comments_uaa;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->reopen_approval_comments_uaa) || $lastOosRecod->reopen_approval_comments_uaa === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
        
// ============ audit trail update close =================
            $oos = OOS::findOrFail($id);

            $input['due_date'] = isset($request->due_date) ? $request->due_date : $oos['due_date'];
            $input['deviation_occured_on_gi'] = isset($request->deviation_occured_on_gi) ? $request->deviation_occured_on_gi : $oos['deviation_occured_on_gi'];

            $file_input_names = [
                'initial_attachment_gi',
                'file_attachments_pli',
                'file_attachments_pII',
                'supporting_attachment_plic',
                'supporting_attachments_plir',
                'attachments_piiqcr',
                'additional_testing_attachment_atp',
                'file_attachments_if_any_ooscattach',
                'conclusion_attachment_ocr',
                'cq_attachment_ocqr',
                'disposition_attachment_bd',
                'reopen_attachment_ro',
                'addendum_attachment_uaa',
                'addendum_attachments_uae',
                'required_attachment_uar',
                'verification_attachment_uar',
                'hod_attachment1',
                'hod_attachment2',
                'hod_attachment3',
                'hod_attachment4',
                'hod_attachment5',
                'QA_Head_attachment1',
                'QA_Head_attachment2',
                'QA_Head_attachment3',
                'QA_Head_attachment4',
                'QA_Head_attachment5',
                'QA_Head_primary_attachment1',
                'QA_Head_primary_attachment2',
                'QA_Head_primary_attachment3',
                'QA_Head_primary_attachment4',
                'QA_Head_primary_attachment5',
                'provide_attachment1',
                'provide_attachment2',
                'provide_attachment3',
                'provide_attachment4',
                'provide_attachment5',
            ];
            
            foreach ($file_input_names as $file_input_name)
            {
                // dd($input[$file_input_name]);
                if (empty($request->file($file_input_name)) && !empty($oos[$file_input_name])) {
                    // If the request does not contain file data but existing data is present, retain the existing data
                    $input[$file_input_name] = $oos[$file_input_name];
                } else {
                    // If the request contains file data or existing data is not present, upload new files
                    $input[$file_input_name] = FileService::uploadMultipleFiles($request, $file_input_name);
                }
            
            }

             // Find the OOS record by ID

            $oos->update($input);

            $grid_inputs = [
                'info_product_material',
                'details_stability',
                'oos_detail',
                'checklist_lab_inv',
                'checklist_IB_inv',
                'oos_capa',
                'phase_two_inv',
                'phase_two_inv1',
                'ph_meter',
                'Viscometer',
                'Melting_Point',
                'Dis_solution',
                'HPLC_GC',
                'General_Checklist',
                'kF_Potentionmeter',
                'RM_PM',
                'analyst_training_procedure',
                'Training_records_Analyst_Involved1',
                'sample_intactness_before_analysis1',
                'test_methods_Procedure1',
                'Review_of_Media_Buffer_Standards_prep1',
                'Checklist_for_Revi_of_Media_Buffer_Stand_prep1',
                'ccheck_for_disinfectant_detail1',
                'Checklist_for_Review_of_instrument_equip1',
                'Checklist_for_Review_of_Training_records_Analyst1',
                'Checklist_for_Review_of_sampling_and_Transport1',
                'Checklist_Review_of_Test_Method_proceds1',
                'Checklist_for_Review_Media_prepara_RTU_medias1',
                'Checklist_Review_Environment_condition_in_tests1',
                'review_of_instrument_bioburden_and_waters1',
                'disinfectant_details_of_bioburden_and_water_tests1',
                'training_records_analyst_involvedIn_testing_microbial_asssays1',
                'sample_intactness_before_analysis22',
                'checklist_for_review_of_test_method_IMA1',
                'cr_of_media_buffer_st_IMA1',
                'CR_of_microbial_cultures_inoculation_IMA1',
                'CR_of_Environmental_condition_in_testing_IMA1',
                'CR_of_instru_equipment_IMA1',
                'disinfectant_details_IMA1',
                'CR_of_training_rec_anaylst_in_monitoring_CIEM1',
                'Check_for_Sample_details_CIEM1',
                'Check_for_comparision_of_results_CIEM1',
                'checklist_for_media_dehydrated_CIEM1',
                'checklist_for_media_prepara_sterilization_CIEM1',
                'CR_of_En_condition_in_testing_CIEM1',
                'check_for_disinfectant_CIEM1',
                'checklist_for_fogging_CIEM1',
                'CR_of_test_method_CIEM1',
                'CR_microbial_isolates_contamination_CIEM1',
                'CR_of_instru_equip_CIEM1',
                'Ch_Trend_analysis_CIEM1',
                'checklist_for_analyst_training_CIMT2',
                'checklist_for_comp_results_CIMT2',
                'checklist_for_Culture_verification_CIMT2',
                'sterilize_accessories_CIMT2',
                'checklist_for_intrument_equip_last_CIMT2',
                'disinfectant_details_last_CIMT2',
                'checklist_for_result_calculation_CIMT2',
                'oos_conclusion',
                'oos_conclusion_review',
                'products_details',
                'instrument_detail',
            ];

            foreach ($grid_inputs as $grid_input)
            {
                self::update_grid($oos, $request, $grid_input);
            }

           
           
        //    update audit trail
            $res['body'] = $oos;

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }

        return $res;
        
    }

    public static function update_grid(OOS $oos, Request $request, $identifier)
    {
        $res = Helpers::getDefaultResponse();
        
        try {

            $oos_grid = Oosgrids::where([ 'identifier' => $identifier, 'oos_id' => $oos->id  ])->firstOrNew();
            $oos_grid->oos_id = $oos->id;
            $oos_grid->identifier = $identifier;
            $oos_grid->data = $request->$identifier;
            $oos_grid->update();
            
        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
            info('Error in OOSService@update_grid', [
                'message' => $e->getMessage()
            ]);
        }

        return $res;
    }

}