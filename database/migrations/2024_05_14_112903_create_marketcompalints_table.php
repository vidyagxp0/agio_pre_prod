<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketcompalints', function (Blueprint $table) {
            // {{-- --General Information --}}

            $table->id();
            $table->integer('initiator_id')->nullable();
            $table->string('division_id')->nullable();
            $table->string('initiator_group')->nullable();
            $table->string('intiation_date')->nullable();
            $table->date('due_date_gi')->nullable();
            $table->string('initiator_group_code_gi')->nullable();
            $table->string('record_number')->nullable();


            $table->longText('form_type')->nullable();
            $table->string('initiated_through_gi')->nullable();
            $table->longText('if_other_gi')->nullable();
            $table->string('is_repeat_gi')->nullable(); 
            $table->longText('repeat_nature_gi')->nullable();
            $table->longText('description_gi')->nullable();
            $table->longText('initial_attachment_gi')->nullable();
            $table->string('complainant_gi')->nullable(); 
            $table->date('complaint_reported_on_gi')->nullable();
            $table->longText('details_of_nature_market_complaint_gi')->nullable();
            $table->string('categorization_of_complaint_gi')->nullable(); 
            $table->longText('review_of_complaint_sample_gi')->nullable();
            $table->longText('review_of_control_sample_gi')->nullable();
            $table->longText('review_of_batch_manufacturing_record_BMR_gi')->nullable();
            $table->longText('review_of_raw_materials_used_in_batch_manufacturing_gi')->nullable();
            $table->longText('review_of_Batch_Packing_record_bpr_gi')->nullable();
            $table->longText('review_of_packing_materials_used_in_batch_packing_gi')->nullable();
            $table->longText('review_of_analytical_data_gi')->nullable();
            $table->longText('review_of_training_record_of_concern_persons_gi')->nullable();
            $table->longText('rev_eq_inst_qual_calib_record_gi')->nullable();
            $table->longText('review_of_equipment_break_down_and_maintainance_record_gi')->nullable();
            $table->longText('review_of_past_history_of_product_gi')->nullable();

// {{-- -HOD/Supervisor Review --}}

            $table->longText('conclusion_hodsr')->nullable();
            $table->longText('root_cause_analysis_hodsr')->nullable();
            $table->longText('probable_root_causes_complaint_hodsr')->nullable(); 
            $table->longText('impact_assessment_hodsr')->nullable();
            $table->longText('corrective_action_hodsr')->nullable();
            $table->longText('preventive_action_hodsr')->nullable();
            $table->longText('summary_and_conclusion_hodsr')->nullable();
            $table->longText('initial_attachment_hodsr')->nullable(); 
            $table->longText('comments_if_any_hodsr')->nullable();


            // {{-- -Complaint anknowlagement- --}}

            $table->longText('manufacturer_name_address_ca')->nullable();
            $table->string('complaint_sample_required_ca')->nullable();
            $table->text('complaint_sample_status_ca')->nullable();
            $table->longText('brief_description_of_complaint_ca')->nullable();
            $table->longText('batch_record_review_observation_ca')->nullable();
            $table->longText('analytical_data_review_observation_ca')->nullable();
            $table->longText('retention_sample_review_observation_ca')->nullable();
            $table->longText('stability_study_data_review_ca')->nullable();
            $table->longText('qms_events_ifany_review_observation_ca')->nullable();
            $table->longText('repeated_complaints_queries_for_product_ca')->nullable();
            $table->longText('interpretation_on_complaint_sample_ifrecieved_ca')->nullable();
            $table->longText('comments_ifany_ca')->nullable();
            $table->longText('initial_attachment_ca')->nullable(); 

            
        // {{ =--- Closure---- }}

        $table->longText('closure_comment_c')->nullable();
        $table->longText('initial_attachment_c')->nullable();
        $table->string('stage')->nullable();
        $table->string('status')->nullable();
        $table->longText('submitted_by')->nullable();
        $table->longText('submitted_on')->nullable();
        $table->longText('complete_review_by')->nullable();
        $table->longText('complete_review_on')->nullable();
        $table->longText('investigation_completed_by')->nullable();
        $table->longText('investigation_completed_on')->nullable();
        $table->longText('propose_plan_by')->nullable();
        $table->longText('propose_plan_on')->nullable();
        $table->longText('approve_plan_by')->nullable();
        $table->longText('approve_plan_on')->nullable();
        $table->longText('all_capa_closed_by')->nullable();
        $table->longText('all_capa_closed_on')->nullable();
        $table->longText('closed_done_by')->nullable();
        $table->longText('closed_done_on')->nullable();
        $table->longText('cancelled_by')->nullable();
        $table->longText('cancelled_on')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketcompalints');
    }
};
