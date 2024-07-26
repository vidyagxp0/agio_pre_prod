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
            $table->longText('stage_stage_ssfi')->nullable();
            $table->longText('Incident_stability_cond_ssfi')->nullable();
            $table->longText('Incident_interval_ssfi')->nullable();
            $table->longText('test_ssfi')->nullable();
            $table->longText('Incident_date_analysis_ssfi')->nullable();
            $table->longText('Incident_specification_ssfi')->nullable();
            $table->longText('Incident_stp_ssfi')->nullable();
            $table->longText('Incident_date_incidence_ssfi')->nullable();
            $table->longText('closure_incident_c')->nullable();

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
