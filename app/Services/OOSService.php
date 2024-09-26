<?php

namespace App\Services;

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
            $input['record_number'] = ((RecordNumber::first()->value('counter')) + 1);
            $input['form_type'] = "OOS Chemical";
            $input['status'] = 'Opened';
            $input['stage'] = 1;
           
           
            
            $file_input_names = [
                'initial_attachment_gi',
                'file_attachments_pli',
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

            $grid_inputs = [
                'info_product_material',
                'details_stability',
                'oos_detail',
                'checklist_lab_inv',
                'checklist_IB_inv',
                'oos_capa',
                'phase_two_inv',
                'ph_meter',
                'phase_two_inv1',
                'Viscometer',
                'Melting_Point',
                'Dis_solution',
                'HPLC_GC',
                'General_Checklist',
                'kF_Potentionmeter',
                'RM_PM',
                'analyst_training_procedure',
                'sample_receiving_var',
                'method_used_during_analysis',
                'instrument_equipment_detailss',
                'result_and_calculation',
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

            // TODO: Audit Trail

            
            $history = new OosAuditTrial();
            $history->oos_id = $oos->id;
            $history->previous = "Null";
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $oos->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->activity_type = 'Short Description';
            $history->current = $request->description_gi;
            $history->save();

                if(!empty($request->description_gi)){
                    $history = new OosAuditTrial();
                    $history->oos_id = $oos->id;
                    $history->previous = "Null";
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $oos->status;
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Short Description';
                    $history->current = $request->description_gi;
                    $history->save();
                }
               
                if (!empty($request->initiator)){
                    $history = new OosAuditTrial();
                    $history->oos_id = $oos->id;
                    $history->previous = "Null";
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $oos->status;
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Initiator';
                    $history->current = $request->initiator;
                    $history->save();
                }
                if (!empty($request->record_number)){
                    $history = new OosAuditTrial();
                    $history->oos_id = $oos->id;
                    $history->previous = "Null";
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $oos->status;
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Record Number';
                    $history->current = $request->record_number;
                    $history->save();
                }
                if (!empty($request->due_date)){
                    $history = new OosAuditTrial();
                    $history->oos_id = $oos->id;
                    $history->previous = "Null";
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $oos->status;
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Due Date';
                    $history->current = $request->due_date;
                    $history->save();
                }

                if (!empty($request->initiator_Group)){
                    $history = new OosAuditTrial();
                    $history->oos_id = $oos->id;
                    $history->previous = "Null";
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $oos->status;
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Initiation department Group';
                    $history->current = $request->initiator_Group;
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Is Repeat';
                    $history->current = $request->is_repeat_gi;
                    $history->save();
                }
                if (!empty($request->repeat_nature_gi)){
                    $history = new OosAuditTrial();
                    $history->oos_id = $oos->id;
                    $history->previous = "Null";
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $oos->status;
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Deviation Occured On';
                    $history->current = $request->deviation_occured_on_gi;
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Reference Document';
                    $history->current = $request->reference_document;
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Customer';
                    $history->current = $oos->customer_gi;
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Comments Plidata';
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Justify If No Field Alert Pli';
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Justify if no Analyst Int';
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'OOS Category Others';
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Root Cause Details';
                    $history->current = $request->oos_category_others_plic;
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'OOS Category-Root Cause Ident';
                    $history->current = $request->oos_category_others_plic;
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Phase II Inv. Required';
                    $history->current = $request->phase_ii_inv_required_plir;
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'QA Approver Comments';
                    $history->current = $request->qa_approver_comments_piii;
                    $history->save();
                }
                if (!empty($request->qa_approver_comments_piii)){
                    $history = new OosAuditTrial();
                    $history->oos_id = $oos->id;
                    $history->previous = "Null";
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $oos->status;
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Manufact. Invest. Required?';
                    $history->current = $request->qa_approver_comments_piii;
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = ' Manufacturing Invest. Type';
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'manufacturing_invest_type_piii';
                    $history->current = $request->manufacturing_invest_type_piii;
                } if (!empty($request->audit_comments_piii)){
                    $history = new OosAuditTrial();
                    $history->oos_id = $oos->id;
                    $history->previous = "Null";
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $oos->status;
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Others (OOS category)';
                    $history->current = $request->others_oos_category_piiqcr;
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
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Impact Assessment.';
                    $history->current = $request->impact_assessment_piiqcr;
                    $history->save();
                }
            // }

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

            $input['status'] = 'Opened';
            $input['stage'] = 1;

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

            
            $oos = OOS::findOrFail($id); // Find the OOS record by ID

           
             // update Audit Trial
            
            $oos->update($input);

            $grid_inputs = [
                'info_product_material',
                'details_stability',
                'oos_detail',
                'checklist_lab_inv',
                'checklist_IB_inv',
                'oos_capa',
                'phase_two_inv',
                'ph_meter',
                'phase_two_inv1',
                'Viscometer',
                'Melting_Point',
                'Dis_solution',
                'HPLC_GC',
                'General_Checklist',
                'kF_Potentionmeter',
                'RM_PM',
                'analyst_training_procedure',
                'sample_receiving_var',
                'method_used_during_analysis',
                'instrument_equipment_detailss',
                'result_and_calculation',
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
                'instrument_detail'
            ];

            foreach ($grid_inputs as $grid_input)
            {
                self::update_grid($oos, $request, $grid_input);
            }

            // TODO: Audit Trail

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