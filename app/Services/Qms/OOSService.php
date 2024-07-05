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
                'oos_capa',
                'phase_two_inv',
                'oos_conclusion',
                'oos_conclusion_review'
            ];

            foreach ($grid_inputs as $grid_input)
            {
                self::store_grid($oos, $request, $grid_input);
            }

            // ============ OOS Chemical: Start  Audit Trail ==================
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
            if (!empty($request->initiator_Group)){
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
                $history->activity_type = 'initiator Group';
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
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Initiator Group Code';
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
            if (!empty($request->repeat_nature_gi)){
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
                $history->stage = $oos->stage;
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
                $history->stage = $oos->stage;
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
                $history->stage = $oos->stage;
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
                $history->stage = $oos->stage;
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
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiation";
                $history->action_name = 'Create';
                $history->activity_type = 'Manufacturing Invest. Type';
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
                $history->activity_type = 'manufacturing_invest_type_piii';
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
                $history->activity_type = 'additional Test Reference Atp.';
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
                $history->activity_type = 'Any Other Actions Required Atp.';
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
                $history->activity_type = 'Other Action bd';
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
                $history->activity_type = 'Risk Analysis Disposition_bd';
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
                $history->activity_type = 'Justify for delay in activity';
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
            if ($lastOosRecod->initiator_Group != $request->initiator_Group){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->initiator_Group;
                $history->activity_type = 'initiator Group';
                $history->current = $request->initiator_Group;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
                // $history->action_name = 'update';
                if (is_null($lastOosRecod->initiator_Group) || $lastOosRecod->initiator_Group === '') {
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
                $history->activity_type = 'Initiator Group Code';
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
                $history->activity_type = 'Deviation Occured On';
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
            // TapII
            if ($lastOosRecod->Comments_plidata != $request->Comments_plidata){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->Comments_plidata;
                $history->activity_type = 'Comments Plidata';
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
                $history->activity_type = 'Justify If No Field Alert Pli';
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
                $history->activity_type = 'Justify if no Analyst Int';
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
            if ($lastOosRecod->phase_i_investigation_ref_pli != $request->phase_i_investigation_ref_pli){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->phase_i_investigation_ref_pli;
                $history->activity_type = 'Phase I Investigation Ref';
                $history->current = $request->phase_i_investigation_ref_pli;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->phase_i_investigation_ref_pli) || $lastOosRecod->phase_i_investigation_ref_pli === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
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
                $history->activity_type = 'OOS Category Others';
                $history->current = $request->root_cause_details_plic;
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
            if ($lastOosRecod->oos_category_others_plic != $request->oos_category_others_plic){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->oos_category_others_plic;
                $history->activity_type = 'Root Cause Details';
                $history->current = $request->oos_category_others_plic;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->description_gi) || $lastOosRecod->description_gi === '') {
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
                $history->activity_type = 'OOS Category-Root Cause Ident';
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
            if ($lastOosRecod->reference_capa_no_plic != $request->reference_capa_no_plic){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->reference_capa_no_plic;
                $history->activity_type = 'Reference CAPA No';
                $history->current = $request->reference_capa_no_plic;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->reference_capa_no_plic) || $lastOosRecod->reference_capa_no_plic === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
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
            if ($lastOosRecod->qa_approver_comments_piii != $request->qa_approver_comments_piii){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->qa_approver_comments_piii;
                $history->activity_type = 'Manufact. Invest. Required?';
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
            if ($lastOosRecod->manufact_invest_required_piii != $request->manufact_invest_required_piii){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->manufact_invest_required_piii;
                $history->activity_type = ' Manufacturing Invest. Type';
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
                $history->activity_type = 'manufacturing invest type_piii';
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
            if ($lastOosRecod->hypo_exp_reference_piii != $request->hypo_exp_reference_piii){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->hypo_exp_reference_piii;
                $history->activity_type = 'Hypo/Exp. Reference';
                $history->current = $request->hypo_exp_reference_piii;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->hypo_exp_reference_piii) || $lastOosRecod->hypo_exp_reference_piii === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
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
            if ($lastOosRecod->nature_of_change_gi != $request->nature_of_change_gi){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->nature_of_change_gi;
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
               if (is_null($lastOosRecod->nature_of_change_gi) || $lastOosRecod->nature_of_change_gi === '') {
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
            if ($lastOosRecod->additional_test_reference_atp != $request->additional_test_reference_atp){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->additional_test_reference_atp;
                $history->activity_type = 'additional Test Reference Atp.';
                $history->current = $request->additional_test_reference_atp;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->additional_test_reference_atp) || $lastOosRecod->additional_test_reference_atp === '') {
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
                $history->activity_type = 'Any Other Actions Required Atp.';
                $history->current = $request->any_other_actions_required_atp;
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
            
            if ($lastOosRecod->reference_record != $request->reference_record){
                $history = new OosAuditTrial();
                $history->oos_id = $lastOosRecod->id;
                $history->previous = $lastOosRecod->reference_record;
                $history->activity_type = 'CAPA Ref No.';
                $history->current = $request->reference_record;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastOosRecod->status;
                $history->stage = $lastOosRecod->stage;
                $history->change_to =   "Opened";
                $history->change_from = $lastOosRecod->status;
               if (is_null($lastOosRecod->reference_record) || $lastOosRecod->reference_record === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }
                $history->save();
            }
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
                $history->activity_type = 'Other Action bd';
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
                $history->activity_type = 'Risk Analysis Disposition_bd';
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
                $history->activity_type = 'Justify for delay in activity';
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
                'oos_capa',
                'phase_two_inv',
                'oos_conclusion',
                'oos_conclusion_review'
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