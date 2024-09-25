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
        Schema::table('labincident_tab_sec', function (Blueprint $table) {
            $table->dropColumn(['stage_stage_ssfi', 'Incident_stability_cond_ssfi', 'Incident_interval_ssfi','test_ssfi','Incident_date_analysis_ssfi','Incident_specification_ssfi','Incident_stp_ssfi','Incident_date_incidence_ssfi','closure_incident_c']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('labincident_tab_sec', function (Blueprint $table) {
            //
        });
    }
};
