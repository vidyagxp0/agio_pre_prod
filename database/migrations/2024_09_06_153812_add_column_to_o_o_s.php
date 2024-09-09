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
            $table->longtext('outcome_phase_IA')->nullable();
            $table->longtext('reason_for_proceeding')->nullable();
            $table->longtext('summaryy_of_review')->nullable();
            $table->text('Probable_cause_iden')->nullable();
            $table->text('proposal_for_hypothesis_IB')->nullable();
            $table->longtext('proposal_for_hypothesis_others')->nullable();
            $table->longtext('details_of_result')->nullable();
            $table->longtext('Probable_Cause_Identified')->nullable();
            $table->longtext('Any_other_Comments')->nullable();
            $table->longtext('Proposal_for_Hypothesis')->nullable();
            $table->longtext('Summary_of_Hypothesis')->nullable();
            $table->longtext('Assignable_Cause')->nullable();
            $table->longtext('Types_of_assignable')->nullable();
            $table->longtext('Types_of_assignable_others')->nullable();
            $table->longtext('Evaluation_Timeline')->nullable();
            $table->longtext('timeline_met')->nullable();
            $table->longtext('timeline_extension')->nullable();
            $table->longtext('Repeat_testing_plan')->nullable();
            $table->longtext('Repeat_analysis_method')->nullable();
            $table->longtext('Details_repeat_analysis')->nullable();
            $table->longtext('Impact_assessment1')->nullable();
            $table->longtext('Conclusion1')->nullable();
            $table->longtext('CAPA_applicable')->nullable();


            $table->longtext('Laboratory_Investigation_Hypothesis')->nullable();
            $table->longtext('Outcome_of_Laboratory')->nullable();
            $table->longtext('Evaluation_IIB')->nullable();
            $table->longtext('Assignable_Cause111')->nullable();
            $table->longtext('If_assignable_cause')->nullable();
            $table->longtext('If_assignable_error')->nullable();
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
