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


            $table->longText('Protocolapproval_FoCompAaNirogenkp')->nullable();
            $table->longText('Objective_FoCompAaNirogenkp')->nullable();
            $table->longText('Purpose_FoCompAaNirogenkp')->nullable();
            $table->longText('Scope_FoCompAaNirogenkp')->nullable();
            $table->longText('ExcutionTeamResp_FoCompAaNirogenkp')->nullable();
            $table->longText('Abbreviations_FoCompAaNirogenkp')->nullable();
            $table->longText('EquipmentSystemIde_FoCompAaNirogenkp')->nullable();
            $table->longText('DocumentFollowed_FoCompAaNirogenkp')->nullable();
            $table->longText('GenralConsPre_FoCompAaNirogenkp')->nullable();
            $table->longText('RevalidCrite_FoCompAaNirogenkp')->nullable();
            $table->longText('Precautions_FoCompAaNirogenkp')->nullable();
            $table->longText('RevalidProcess_FoCompAaNirogenkp')->nullable();
            $table->longText('AcceptanceCrite_FoCompAaNirogenkp')->nullable();
            $table->longText('Annexure_FoCompAaNirogenkp')->nullable();


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
