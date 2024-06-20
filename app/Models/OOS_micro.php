<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OOS_micro extends Model
{
    use HasFactory;

    protected $table = 'o_o_s__micros';

    public function grids()
    {
        return $this->hasMany(OOS_Micro_grid::class, 'oos_micro_id', 'id');
    }

    //protected $fillable = ['reference_document_gi'];

    protected $casts = [
    'initial_attachment_gi'=>'array',
    'file_attachments_pli'=>'array',
    'supporting_attachment_plic'=>'array',
    'supporting_attachments_plir'=>'array',
    'supporting_attachments_plir'=>'array',
    'attachment_piii'=>'array',
    'attachments_piiqcr'=>'array',
    'additional_testing_attachment_atp'=>'array',
    'attachments_if_any_oosc'=>'array',
    'conclusion_attachment_ocr'=>'array',
    'cq_attachment_OOS_CQ'=>'array',
    'disposition_attachment_BI'=>'array',
    'reopen_attachment'=>'array',
    'attachment_details_cibet'=>'array',
    'attachment_details_cis'=>'array',
    'attachment_details_cimlbwt'=>'array',
    'attachment_details_cima'=>'array',
    'attachment_details_ciem'=>'array',
    'attachment_details_cimst'=>'array',

    'manufacturing_invest_type_piii'=>'array',
    'manufacturing_invst_ref_piii'=>'array',
    're_sampling_ref_no_piii'=>'array',
    'hypo_exp_reference_piii'=>'array',
    'recommended_action_reference_piiqcr'=>'array',
    'invest_ref_piiqcr'=>'array',
    'additional_test_reference_atp'=>'array',
    'action_task_reference_atp'=>'array',
    'capa_ref_no_oosc'=>'array',
    'action_plan_ref_oosc'=>'array',
    'capa_refer_ocr'=>'array',
    'action_task_reference_ocr'=>'array',
    'risk_assessment_ref_ocr'=>'array',
    'field_alert_reference_BI'=>'array',
    'phase_III_inves_reference_BI'=>'array',




    ];

}

