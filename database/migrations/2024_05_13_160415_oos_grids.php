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
        Schema::create('oos_grids', function (Blueprint $table) {
            $table->id();
            $table->integer('oos_id')->nullable();
            $table->string('identifier')->nullable();
            // General Information =>Info On Product/Material
            $table->string('info_product_code')->nullable();
            $table->string('info_batch_no')->nullable();
            $table->string('info_product_arnumber')->nullable();
            $table->date('info_mfg_date')->nullable();
            $table->date('info_expiry_date')->nullable();
            $table->string('info_label_claim')->nullable();
            $table->string('info_pack_size')->nullable();
            $table->string('info_analyst_name')->nullable();
            $table->string('info_others_specify')->nullable();
            $table->string('info_process_sample_stage')->nullable();
            $table->string('info_packing_material_type')->nullable();
            $table->string('info_stability_for')->nullable();
           // General Information => Details of Stability Study
            $table->string('stability_study_arnumber')->nullable();
            $table->string('stability_study_condition_temprature_rh')->nullable();
            $table->string('stability_study_Interval')->nullable();
            $table->string('stability_study_orientation')->nullable();
            $table->string('stability_study_pack_details')->nullable();
            $table->string('stability_study_specification_no')->nullable();
            $table->string('stability_study_sample_description')->nullable();
            // General Information => => OOS Details 
            $table->string('oos_arnumber')->nullable();
            $table->string('oos_test_name')->nullable();
            $table->string('oos_results_obtained')->nullable();
            $table->string('oos_specification_limit')->nullable();
            $table->string('oos_details_obvious_error')->nullable();
            $table->string('oot_file_attachment')->nullable();
            $table->string('oos_submit_by')->nullable();
            $table->string('oot_submit_on')->nullable();
         //  Preliminary Lab Investigation => PHASE- I B INVESTIGATION REPORT
            $table->string('preliminary_phase1_question')->nullable();
            $table->string('preliminary_phase1_response')->nullable();
            $table->string('preliminary_phase1_remarks')->nullable();
        //   Preliminary Lab Invstigation Review => Info. On Product/ Material

           $table->string('info_oos_number')->nullable();
        //    OOS Reported Date	
        //    $table->date('summary_earlier_reported_date')->nullable();
        //    $table->string('summary_earlier_description')->nullable();
        //    $table->string('summary_earlier_previous_root_cause')->nullable();
        //    $table->string('summary_earlier_capa')->nullable();
        //    $table->date('summary_earlier_closure_date')->nullable();
        //    //  OOT Conclusion => Summary Of OOT Test Results 
        //    $table->string('summary_results_initial_analysis')->nullable();
        //    $table->string('summary_results_phase_one_investigation')->nullable();
        //    $table->string('summary_results_retesting_correction_assignable_cause')->nullable();
        //    $table->string('summary_results_hypothesis_experimentation')->nullable();
        //    $table->string('summary_results_additional_testing')->nullable();
        //    $table->string('summary_results_hypothesis_experiment_refrence')->nullable();
        //    $table->string('summary_results')->nullable();
        //    $table->string('summary_results_analyst_name')->nullable();
        //    $table->string('summary_results_remarks')->nullable();
        //    //  OOT Conclusion Review => Impacted Product/Material
        //    $table->string('impacted_product_name')->nullable();
        //    $table->string('impacted_product_batch_no')->nullable();
        //    $table->string('impacted_product_any_other_information')->nullable();
        //    $table->string('impacted_product_action_affecte_batch')->nullable();
        //   //Signatures 
        //    $table->string('signatures_submitted_by')->nullable();
        //    $table->string('signatures_submitted_on')->nullable();
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
        //
    }
};
