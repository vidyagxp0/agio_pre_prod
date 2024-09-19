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
        Schema::table('o_o_s', function (Blueprint $table) {
            $table->longtext('analyst_interview_pli')->nullable();
            $table->longtext('Any_other_batches')->nullable();
            $table->longtext('details_of_trend')->nullable();
            $table->longtext('root_cause_identified_pia')->nullable();
            $table->longtext('is_repeat_assingable_pia')->nullable();
            $table->longtext('result_of_repeat')->nullable();
            $table->longtext('impact_assesment_pia')->nullable();
            $table->longtext('resampling_required_ib')->nullable();
            $table->longtext('repeat_testing_ib')->nullable();
            $table->longtext('production_person_ib')->nullable();
            $table->longtext('escalation_required')->nullable();
            $table->longtext('notification_ib')->nullable();
            $table->longtext('justification_ib')->nullable();
            $table->longtext('checklist_outcome_iia')->nullable();
            $table->longtext('production_head_person')->nullable();
            $table->longtext('Summary_Of_Inv_IIB')->nullable();
            $table->longtext('capa_required_IIB')->nullable();
            $table->longtext('reference_capa_IIB')->nullable();
            $table->longtext('resampling_req_IIB')->nullable();
            $table->longtext('Repeat_testing_IIB')->nullable();
            $table->longtext('phase_IIB_attachment')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('o_o_s', function (Blueprint $table) {
            //
        });
    }
};
