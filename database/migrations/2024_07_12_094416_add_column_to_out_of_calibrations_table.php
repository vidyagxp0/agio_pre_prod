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
        Schema::table('out_of_calibrations', function (Blueprint $table) {
            $table->date('date_of_out_of_calibration')->nullable();
            $table->date('date_of_discovery')->nullable();
            $table->date('last_calibration_date')->nullable();
            $table->text('calibration_frequency')->nullable();
            $table->longtext('supervisor_review')->nullable();
            $table->longtext('section_incharge_review')->nullable();
            $table->longtext('is_repeat_assingablerc_ooc')->nullable();
            $table->longtext('ooc_category')->nullable();
            $table->longtext('stagei_hypthesis_study_ooc')->nullable();
            $table->longtext('justification_for_protocol_study_stageI_ooc')->nullable();
            $table->longtext('plan_of_protocol_stageI_study_hypothesis_study')->nullable();
            $table->longtext('conclusion_of_protocol_stageI_based_study_hypothesis_study_ooc')->nullable();
            $table->longtext('actiontaken_action')->nullable();
            $table->longtext('Initial_Attachment_otherfield')->nullable();
            $table->longtext('User_compiled')->nullable();
            $table->longtext('re_qualification_status')->nullable();
            $table->longtext('calibration_status')->nullable();
            $table->longtext('found_satisfactory')->nullable();
            $table->longtext('OthewrReviewed_ooc')->nullable();
            $table->longtext('service_engineer_report_attachment')->nullable();
            $table->longtext('sample_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('out_of_calibrations', function (Blueprint $table) {
            //
        });
    }
};
