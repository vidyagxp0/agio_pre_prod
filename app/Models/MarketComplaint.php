<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketComplaint extends Model
{
    use HasFactory;
    protected $fillable = [
        // General Information
        'initiator_id_gi',
        'division_id_gi',
        'initiator_group_gi',
        'intiation_date_gi',
        'due_date_gi',
        'initiator_group_code_gi',
        'record_number_gi',
        'initiated_through_gi',
        'if_other_gi',
        'is_repeat_gi',
        'repeat_nature_gi',
        'description_gi',
        'initial_attachment_gi',
        'complainant_gi',
        'complaint_reported_on_gi',
        'details_of_nature_market_complaint_gi',
        'categorization_of_complaint_gi',
        'review_of_complaint_sample_gi',
        'review_of_control_sample_gi',
        'review_of_batch_manufacturing_record_BMR_gi',
        'review_of_raw_materials_used_in_batch_manufacturing_gi',
        'review_of_Batch_Packing_record_bpr_gi',
        'review_of_packing_materials_used_in_batch_packing_gi',
        'review_of_analytical_data_gi',
        'review_of_training_record_of_concern_persons_gi',
        'rev_eq_inst_qual_calib_record_gi',
        'review_of_equipment_break_down_and_maintainance_record_gi',
        'review_of_past_history_of_product_gi',

        // HOD/Supervisor Review
        'conclusion_hodsr',
        'root_cause_analysis_hodsr',
        'probable_root_causes_complaint_hodsr',
        'impact_assessment_hodsr',
        'corrective_action_hodsr',
        'preventive_action_hodsr',
        'summary_and_conclusion_hodsr',
        'initial_attachment_hodsr',
        'comments_if_any_hodsr',

        // Complaint acknowledgment
        'manufacturer_name_address_ca',
        'complaint_sample_required_ca',
        'complaint_sample_status_ca',
        'brief_description_of_complaint_ca',
        'batch_record_review_observation_ca',
        'analytical_data_review_observation_ca',
        'retention_sample_review_observation_ca',
        'stability_study_data_review_ca',
        'qms_events_ifany_review_observation_ca',
        'repeated_complaints_queries_for_product_ca',
        'interpretation_on_complaint_sample_ifrecieved_ca',
        'comments_ifany_ca',
        'initial_attachment_ca',

        // Closure
        'closure_comment_c',
        'initial_attachment_c',
    ];
}
