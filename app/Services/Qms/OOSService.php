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

            // TODO: Audit Trail
            // if(!empty($oos)){
                if(!empty($request->description_gi)){
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
                    $history->change_from = "Initiator";
                    $history->action_name = 'Create';
                    $history->activity_type = 'Short Description';
                    $history->current = $request->description_gi;
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->stage = $oos->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiator";
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
                    $history->stage = $oos->stage;
                    $history->change_to =   "Opened";
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
                    $history->change_from = "Initiator";
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
            $oos = OOS::findOrFail($id);
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

            // TODO: Audit Trail
            $lastOosRecod = OOS::findOrFail($id);
            if(!empty($lastOosRecod))
            {
            if(!empty($request->description_gi)){
                $history = new OosAuditTrial();
                $history->oos_id = $oos->id;
                $history->previous = $lastOosRecod->description_gi;
                $history->comment = "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $oos->status;
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
                $history->activity_type = 'Short Description';
                $history->current = $request->description_gi;
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
                $history->activity_type = 'Source Document Type';
                $history->current = $request->source_document_type_gi;
                $history->save();
            }
            // if (!empty($request->reference_system_document_gi)){
            //     $history = new OosAuditTrial();
            //     $history->oos_id = $oos->id;
            //     $history->previous = "Null";
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $oos->status;
            //     $history->stage = $oos->stage;
            //     $history->change_to =   "Opened";
            //     $history->change_from = "Initiator";
            //     $history->action_name = 'Create';
            //     $history->activity_type = 'Reference System Document';
            //     $history->current = $request->reference_system_document_gi;
            //     $history->save();
            // }
            // if (!empty($request->reference_document)){
            //     $history = new OosAuditTrial();
            //     $history->oos_id = $oos->id;
            //     $history->previous = "Null";
            //     $history->comment = "Not Applicable";
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $oos->status;
            //     $history->stage = $oos->stage;
            //     $history->change_to =   "Opened";
            //     $history->change_from = "Initiator";
            //     $history->action_name = 'Create';
            //     $history->activity_type = 'Reference Document';
            //     $history->current = $request->reference_document;
            //     $history->save();
            // }
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiator";
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
                $history->stage = $oos->stage;
                $history->change_to =   "Opened";
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
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
                $history->change_from = "Initiator";
                $history->action_name = 'Create';
                $history->activity_type = 'Impact Assessment.';
                $history->current = $request->impact_assessment_piiqcr;
                $history->save();
            }
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