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
            //
            $table->longText('Purpose_PaVaReKp')->nullable();
            $table->longText('Scope_PaVaReKp')->nullable();
            $table->longText('BatchDetails_PaVaReKp')->nullable();
            $table->longText('ReferenceDocument_PaVaReKp')->nullable();
            $table->longText('PackingMaterialApprovalVendDeat_PaVaReKp')->nullable();
            $table->longText('UsedEquipmentCalibrationQualiSta_PaVaReKp')->nullable();
            $table->longText('ResultOfPacking_PaVaReKp')->nullable();
            $table->longText('CriticalProcessParameters_PaVaReKp')->nullable();
            $table->longText('yield_PaVaReKp')->nullable();
            $table->longText('HoldTimeStudy_PaVaReKp')->nullable();
            $table->longText('CleaningValidation_PaVaReKp')->nullable();
            $table->longText('StabilityStudy_PaVaReKp')->nullable();
            $table->longText('DeviationIfAny_PaVaReKp')->nullable();
            $table->longText('ChangeControlifany_PaVaReKp')->nullable();
            $table->longText('Summary_PaVaReKp')->nullable();
            $table->longText('Conclusion_PaVaReKp')->nullable();
            $table->longText('ProposedParameters_PaVaReKp')->nullable();
            $table->longText('ReportApproval_PaVaReKp')->nullable();

            $table->string('generic_PacValRep')->nullable();
            $table->string('PacValRep_product_code')->nullable();
            $table->string('PacValRep_std_batch')->nullable();
            $table->string('PacValRep_category')->nullable();
            $table->string('PacValRep_label_claim')->nullable();
            $table->string('PacValRep_market')->nullable();
            $table->string('PacValRep_shelf_life')->nullable();
            $table->string('PacValRep_bmr_no')->nullable();
            $table->string('PacValRep_mpr_no')->nullable();
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
