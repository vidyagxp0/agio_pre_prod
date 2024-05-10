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
        Schema::create('oot_grids', function (Blueprint $table) {
            $table->id();
            $table->integer('oot_id')->nullable();
            $table->string('identifier')->nullable();
            // General Information =>Info On Product/Material
            $table->string('info_product_item')->nullable();
            $table->string('info_product_lot_batch')->nullable();
            $table->string('info_product_arnumber')->nullable();
            $table->date('info_product_mfg_date')->nullable();
            $table->date('info_expiry_date')->nullable();
            $table->string('info_label_claim')->nullable();
           // General Information => Details Of Stability Study 
            $table->string('stability_study_arnumber')->nullable();
            $table->string('stability_study_condition_temprature_rh')->nullable();
            $table->string('stability_study_Interval')->nullable();
            $table->string('stability_study_orientation')->nullable();
            $table->string('stability_study_pack_details')->nullable();
            // General Information => => OOT Results
            $table->string('oot_results_arnumber')->nullable();
            $table->string('oot_results_test_name')->nullable();
            $table->string('oot_results_obtained')->nullable();
            $table->string('oot_results_previous_interval_details')->nullable();
            $table->string('oot_results_difference_of_results')->nullable();
            $table->string('oot_results_trend_limit')->nullable();
           //  Under Preliminary Lab Investigation => Preliminary Laboratory Investigation
           $table->string('preliminary_question')->nullable();
           $table->string('preliminary_response')->nullable();
           $table->string('preliminary_remarks')->nullable();
           // Preliminary Lab Investigation Review => Summary Of Earlier OTT And CAPA
           $table->string('summary_earlier_ootnumber')->nullable();
           $table->date('summary_earlier_reported_date')->nullable();
           $table->string('summary_earlier_description')->nullable();
           $table->string('summary_earlier_previous_root_cause')->nullable();
           $table->string('summary_earlier_capa')->nullable();
           $table->date('summary_earlier_closure_date')->nullable();
           //  OOT Conclusion => Summary Of OOT Test Results 
           $table->string('summary_results_initial_analysis')->nullable();
           $table->string('summary_results_phase_one_investigation')->nullable();
           $table->string('summary_results_retesting_correction_assignable_cause')->nullable();
           $table->string('summary_results_hypothesis_experimentation')->nullable();
           $table->string('summary_results_additional_testing')->nullable();
           $table->string('summary_results_hypothesis_experiment_refrence')->nullable();
           $table->string('summary_results')->nullable();
           $table->string('summary_results_analyst_name')->nullable();
           $table->string('summary_results_remarks')->nullable();
           //  OOT Conclusion Review => Impacted Product/Material
           $table->string('impacted_product_name')->nullable();
           $table->string('impacted_product_batch_no')->nullable();
           $table->string('impacted_product_any_other_information')->nullable();
           $table->string('impacted_product_action_affecte_batch')->nullable();
          //Signatures 
           $table->string('signatures_submitted_by')->nullable();
           $table->string('signatures_submitted_on')->nullable();
           $table->timestamps();
        });
        //
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
