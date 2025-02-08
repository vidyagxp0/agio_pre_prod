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
            $table->longtext('generic_prvp')->nullable();
            $table->longtext('prvp_product_code')->nullable();
            $table->longtext('prvp_std_batch')->nullable();
            $table->longtext('prvp_category')->nullable();
            $table->longtext('prvp_label_claim')->nullable();
            $table->longtext('prvp_market')->nullable();
            $table->longtext('prvp_shelf_life')->nullable();

            $table->longtext('prvp_bmr_no')->nullable();
            $table->longtext('prvp_mfr_no')->nullable();
            $table->longtext('prvp_purpose')->nullable();
            $table->longtext('prvp_scope')->nullable();
            $table->longtext('reason_validation')->nullable();
            $table->longtext('validation_po_prvp')->nullable();
            $table->longtext('description_sop_prvp')->nullable();
            $table->longtext('prvp_procedure')->nullable();

            $table->longtext('responsibilityprvp')->nullable();
            $table->longtext('prvp_rawmaterial')->nullable();
            $table->longtext('pripackmaterial')->nullable();
            $table->longtext('equipCaliQuali')->nullable();
            $table->longtext('rationale_critical')->nullable();
            $table->longtext('general_instrument')->nullable();
            $table->longtext('process_flow')->nullable();
            $table->longtext('diagrammatic')->nullable();

            $table->longtext('critical_process')->nullable();
            $table->longtext('product_acceptance')->nullable();
            $table->longtext('holdtime_study')->nullable();
            $table->longtext('cleaning_validation')->nullable();
            $table->longtext('stability_study')->nullable();
            $table->longtext('deviation')->nullable();
            $table->longtext('change_control')->nullable();
            $table->longtext('summary_prvp')->nullable();
            $table->longtext('conclusion_prvp')->nullable();
            $table->longtext('training_prvp')->nullable();

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
