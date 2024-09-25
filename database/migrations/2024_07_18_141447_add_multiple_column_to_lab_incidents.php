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
        Schema::table('lab_incidents', function (Blueprint $table) {
            $table->longText('parent_type')->nullable()->after('suit_qc_review_to');
            $table->longText('Other_Ref')->nullable();
            $table->longText('assign_to')->nullable();
            $table->longText('stage_SSFI')->nullable();
            $table->longText('stability_condition_SSFI')->nullable();
            $table->longText('interval_SSFI')->nullable();
            $table->longText('test_SSFI')->nullable();
            $table->longText('stage_stage_ssfi')->nullable();
            $table->longText('Incident_stability_cond_ssfi')->nullable();
            $table->longText('Incident_interval_ssfi')->nullable();
            $table->longText('Incident_specification_ssfi')->nullable();
            $table->longText('Incident_stp_ssfi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lab_incidents', function (Blueprint $table) {
            //
        });
    }
};
