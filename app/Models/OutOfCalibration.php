<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutOfCalibration extends Model
{
    use HasFactory;

    protected $table = 'out_of_calibrations';
    protected $fillable = [
        'record',
        'assign_to',
        'form_type',
        'division_id',
        'initiator_id',
        'division_code',
        'intiation_date',
        'due_date',
        'Initiator_Group',
        'initiator_group_code',
        'initiated_through',
        'initiated_if_other',
        'is_repeat_ooc',
        'Repeat_Nature',
        'description_ooc',
        'initial_attachment_ooc',
        'ooc_due_date',
        'Delay_Justification_for_Reporting',
        'HOD_Remarks',
        'attachments_hod_ooc',
        'Immediate_Action_ooc',
        'Preliminary_Investigation_ooc',
        'qa_comments_ooc',
        'qa_comments_description_ooc',
        'is_repeat_assingable_ooc',
        'protocol_based_study_hypthesis_study_ooc',
        'justification_for_protocol_study_hypothesis_study_ooc',
        'plan_of_protocol_study_hypothesis_study',
        'conclusion_of_protocol_based_study_hypothesis_study_ooc',
        'analysis_remarks_stage_ooc',
        'calibration_results_stage_ooc',
        'is_repeat_result_naturey_ooc',
        'review_of_calibration_results_of_analyst_ooc',
        'attachments_stage_ooc',
        'results_criteria_stage_ooc',
        'is_repeat_stae_ooc',
        'qa_comments_stage_ooc',
        'additional_remarks_stage_ooc',
        'is_repeat_stageii_ooc',
        'is_repeat_stage_instrument_ooc',
        'is_repeat_proposed_stage_ooc',
        'initial_attachment_stageii_ooc',
        'is_repeat_compiled_stageii_ooc',
        'is_repeat_realease_stageii_ooc',
        'initiated_throug_stageii_ooc',
        'initiated_through_stageii_ooc',
        'is_repeat_reanalysis_stageii_ooc',
        'initiated_through_stageii_cause_failure_ooc',
        'is_repeat_capas_ooc',
        'initiated_through_capas_ooc',
        'initiated_through_capa_prevent_ooc',
        'initiated_through_capa_corrective_ooc',
        'initial_attachment_capa_ooc',
        'initiated_through_capa_ooc',
        'initial_attachment_capa_post_ooc',
        'short_description_closure_ooc',
        'initial_attachment_closure_ooc',
        'document_code_closure_ooc',
        'remarks_closure_ooc',
        'initiated_through_closure_ooc',
        'initiated_through_hodreview_ooc',
        'initial_attachment_hodreview_ooc',
        'initiated_through_rootcause_ooc',
        'initiated_through_impact_closure_ooc'
    ];
    
}
