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
        Schema::table('document_contents', function (Blueprint $table) {
            $table->Text('generic_pvr')->nullable();
            $table->Text('product_code_pvr')->nullable();
            $table->Text('std_batch_pvr')->nullable();
            $table->Text('category_pvr')->nullable();
            $table->Text('label_claim_pvr')->nullable();
            $table->Text('market_pvr')->nullable();
            $table->Text('shelf_life_pvr')->nullable();
            $table->Text('bmr_no_pvr')->nullable();
            $table->Text('mfr_no_pvr')->nullable();

            $table->longtext('purpose_pvr')->nullable();
            $table->longtext('scope_pvr')->nullable();
            $table->longtext('batchdetail_pvr')->nullable();
            $table->longtext('active_raw_material_pvr')->nullable();
            $table->longtext('primary_packingmaterial_pvr')->nullable();

            $table->longtext('used_equipment_calibration_pvr')->nullable();
            $table->longtext('result_of_intermediate_pvr')->nullable();
            $table->longtext('result_of_finished_product_pvr')->nullable();
            $table->longtext('result_of_packing_finished_pvr')->nullable();
            $table->longtext('criticalprocess_parameter_pvr')->nullable();
            $table->longtext('yield_at_various_stage_pvr')->nullable();
            $table->longtext('hold_time_study_pvr')->nullable();
            $table->longtext('cleaningvalidation_pvr')->nullable();
            $table->longtext('stability_study_pvr')->nullable();
            $table->longtext('deviation_if_any_pvr')->nullable();

            $table->longtext('changecontrol_pvr')->nullable();
            $table->longtext('summary_pvr')->nullable();
            $table->longtext('conclusion_pvr')->nullable();
            $table->longtext('proposed_parameter_upcoming_batch_pvr')->nullable();
            $table->longtext('report_approval_pvr')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_contents', function (Blueprint $table) {
            //
        });
    }
};
