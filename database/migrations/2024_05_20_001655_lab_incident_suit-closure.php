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
        Schema::create('labincident_tab_sec', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('lab_incidents_id');
            $table->integer('lab_incident_id')->nullable();
            $table->longText('involved_ssfi')->nullable();
            $table->string('stage_stage_ssfi')->nullable();
            $table->string('Incident_stability_cond_ssfi')->nullable();
            $table->string('Incident_interval_ssfi')->nullable();
            $table->string('test_ssfi')->nullable();
            $table->string('Incident_date_analysis_ssfi')->nullable();
            $table->string('Incident_specification_ssfi')->nullable();
            $table->string('Incident_stp_ssfi')->nullable();
            $table->string('Incident_date_incidence_ssfi')->nullable();
            $table->longText('Description_incidence_ssfi')->nullable();
            $table->longText('Detail_investigation_ssfi')->nullable();
            $table->longText('proposed_corrective_ssfi')->nullable();
            $table->longText('root_cause_ssfi')->nullable();
            $table->longText('incident_summary_ssfi')->nullable();
            $table->longText('system_suitable_attachments')->nullable();
            $table->string('closure_incident_c')->nullable();
            $table->longText('affected_document_closure')->nullable();
            $table->longText('qc_hear_remark_c')->nullable();
            $table->longText('qa_hear_remark_c')->nullable();
            $table->longText('closure_attachment_c')->nullable();

            $table->timestamps();
        });
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
