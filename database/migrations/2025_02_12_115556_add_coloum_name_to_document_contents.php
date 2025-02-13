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
            $table->longtext('annex_I_gxp_attachment')->nullable();
            $table->longtext('annex_II_risk_attachment')->nullable();
            $table->longtext('annex_III_eres_attachment')->nullable();
            $table->longtext('annex_IV_plan_attachment')->nullable();
            $table->longtext('annex_V_user_attachment')->nullable();
            $table->longtext('annex_VI_req_attachment')->nullable();
            $table->longtext('annex_VII_fun_attachment')->nullable();
            $table->longtext('annex_VIII_tech_attachment')->nullable();
            $table->longtext('annex_IX_risk_attachment')->nullable();
            $table->longtext('annex_X_design_attachment')->nullable();

            $table->longtext('annex_XI_confi_attachment')->nullable();
            $table->longtext('annex_XII_qua_proto_attachment')->nullable();
            $table->longtext('annex_XIII_unit_integ_attachment')->nullable();
            $table->longtext('annex_XIV_data_migra_attachment')->nullable();
            $table->longtext('annex_XV_data_qualif_attachment')->nullable();
            // $table->longtext('annex_XVI_per_qualif_attachment')->nullable();
            // $table->longtext('annex_XVII_valid_summ_attachment')->nullable();
            // $table->longtext('annex_XVIII_trac_matri_attachment')->nullable();
            // $table->longtext('annex_XIX_syst_retir_attachment')->nullable();

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
