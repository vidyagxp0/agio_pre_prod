<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketComplaint extends Model
{
    use HasFactory;
    protected $table='marketcompalints';
    protected $fillable = [
   
        'initiator_group_gi'       
    ];

                  // {{-- -casting --}}

    protected $casts = [

        'if_other_gi' => 'array',
        'repeat_nature_gi' => 'array',
     'description_gi' => 'array',
        'initial_attachment_gi' => 'array',
     'details_of_nature_market_complaint_gi' => 'array',
     'review_of_complaint_sample_gi' => 'array',
     'review_of_control_sample_gi' => 'array',
     'review_of_batch_manufacturing_record_BMR_gi' => 'array',
     'review_of_raw_materials_used_in_batch_manufacturing_gi' => 'array',
     'review_of_Batch_Packing_record_bpr_gi' => 'array',
 'review_of_packing_materials_used_in_batch_packing_gi' => 'array',
        'review_of_analytical_data_gi' => 'array',
     'review_of_training_record_of_concern_persons_gi' => 'array',
     'rev_eq_inst_qual_calib_record_gi' => 'array',
     'review_of_equipment_break_down_and_maintainance_record_gi' => 'array',
     'review_of_past_history_of_product_gi' => 'array',
        
     'conclusion_hodsr' => 'array',
     'probable_root_causes_complaint_hodsr' => 'array',
     'impact_assessment_hodsr' => 'array',
     'corrective_action_hodsr' => 'array',
        'preventive_action_hodsr' => 'array',
     'summary_and_conclusion_hodsr' => 'array',
       'initial_attachment_hodsr' => 'array',
     'comments_if_any_hodsr' => 'array',
        
     'manufacturer_name_address_ca' => 'array',
     'brief_description_of_complaint_ca' => 'array',
     'batch_record_review_observation_ca' => 'array',
     'analytical_data_review_observation_ca' => 'array',
     'retention_sample_review_observation_ca' => 'array',
        
        'stability_study_data_review_ca' => 'array',
     'qms_events_ifany_review_observation_ca' => 'array',
        'repeated_complaints_queries_for_product_ca' => 'array',
        'interpretation_on_complaint_sample_ifrecieved_ca' => 'array',
     'comments_ifany_ca' => 'array',
        'initial_attachment_ca' => 'array',
        'closure_comment_c' => 'array',
        'initial_attachment_c' => 'array',
    ];


    public function marketcomplaintrecord(){
      return $this->hasMany(MarketComplaintGrids::class,'');
    }

}
