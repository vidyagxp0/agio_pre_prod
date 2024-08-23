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
        Schema::table('ootcs', function (Blueprint $table) {
            $table->text('new_stage_reject_P_II_A_QAH_CQAH_Review_by')->nullable();
            $table->text('new_stage_reject_P_II_A_QAH_CQAH_Review_on')->nullable();
            $table->text('new_stage_reject_P_II_A_QAH_CQAH_Review_comment')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_B_Investigation_by')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_B_Investigation_on')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_B_Investigation_comment')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_B_HOD_Primary_Review_by')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_B_HOD_Primary_Review_on')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_B_HOD_Primary_Review_comment')->nullable();
            $table->text('Phase_IB_HOD_Review_Completed_BY')->nullable();
            $table->text('Phase_IB_HOD_Review_Completed_ON')->nullable();
            $table->text('Phase_IB_HOD_Review_Completed_Comment')->nullable();
            $table->text('Phase_IB_QA_Review_Complete_12_comment')->nullable();
            $table->text('Phase_IB_QA_Review_Complete_12_on')->nullable();
            $table->text('Phase_IB_QA_Review_Complete_12_by')->nullable();
            $table->text('P_IB_Assignable_Cause_Found_comment')->nullable();
            $table->text('P_IB_Assignable_Cause_Found_on')->nullable();
            $table->text('P_IB_Assignable_Cause_Found_by')->nullable();
            $table->text('Under_Phase_II_A_Investigation_comment')->nullable();
            $table->text('Under_Phase_II_A_Investigation_on')->nullable();
            $table->text('Under_Phase_II_A_Investigation_by')->nullable();
            $table->text('Phase_II_A_Investigation_by')->nullable();
            $table->text('Phase_II_A_Investigation_on')->nullable();
            $table->text('Phase_II_A_Investigation_comment')->nullable();
            $table->text('Phase_II_A_HOD_Review_Complete_by')->nullable();
            $table->text('Phase_II_A_HOD_Review_Complete_on')->nullable();
            $table->text('Phase_II_A_HOD_Review_Complete_comment')->nullable();
            $table->text('Phase_II_A_QA_Review_Complete_by')->nullable();
            $table->text('Phase_II_A_QA_Review_Complete_on')->nullable();
            $table->text('Phase_II_A_QA_Review_Complete_comment')->nullable();
            $table->text('P_II_A_Assignable_Cause_Found_by')->nullable();
            $table->text('P_II_A_Assignable_Cause_Found_on')->nullable();
            $table->text('P_II_A_Assignable_Cause_Found_comment')->nullable();
            $table->text('P_II_A_Assignable_Cause_Not_Found_by')->nullable();
            $table->text('P_II_A_Assignable_Cause_Not_Found_on')->nullable();
            $table->text('P_II_A_Assignable_Cause_Not_Found_comment')->nullable();
            $table->text('Phase_II_B_Investigation_by')->nullable();
            $table->text('Phase_II_B_Investigation_on')->nullable();
            $table->text('Phase_II_B_Investigation_comment')->nullable();
            $table->text('Phase_II_B_HOD_Review_Complete_by')->nullable();
            $table->text('Phase_II_B_HOD_Review_Complete_on')->nullable();
            $table->text('Phase_II_B_HOD_Review_Complete_comment')->nullable();
            $table->text('Phase_II_B_QA_ReviewComplete_by')->nullable();
            $table->text('Phase_II_B_QA_ReviewComplete_on')->nullable();
            $table->text('Phase_II_B_QA_ReviewComplete_comment')->nullable();
            $table->text('P_II_B_Assignable_Cause_Found_by')->nullable();
            $table->text('P_II_B_Assignable_Cause_Found_on')->nullable();
            $table->text('P_II_B_Assignable_Cause_Found_comment')->nullable();
            $table->text('new_stage_reject_by')->nullable();
            $table->text('new_stage_reject_on')->nullable();
            $table->text('new_stage_reject_comment')->nullable();
            $table->text('new_stage_reject_CQA_by')->nullable();
            $table->text('new_stage_reject__CQA_on')->nullable();
            $table->text('new_stage_reject_CQA_comment')->nullable();
            $table->text('new_stage_reject_HOD_by')->nullable();
            $table->text('new_stage_reject_HOD_on')->nullable();
            $table->text('new_stage_reject_HOD_comment')->nullable();
            $table->text('new_stage_reject_UnderPhaseIA_by')->nullable();
            $table->text('new_stage_reject_UnderPhaseIA_on')->nullable();
            $table->text('new_stage_reject_UnderPhaseIA_comment')->nullable();
            $table->text('new_stage_reject_Phase_IA_HOD_Primary_Review_by')->nullable();
            $table->text('new_stage_reject_Phase_IA_HOD_Primary_Review_on')->nullable();
            $table->text('new_stage_reject_Phase_IA_HOD_Primary_Review_comment')->nullable();
            $table->text('new_stage_rejectUnder_Stage_II_B_Investigation_by')->nullable();
            $table->text('new_stage_rejectUnder_Stage_II_B_Investigation_on')->nullable();
            $table->text('new_stage_rejectUnder_Stage_II_B_Investigation_comment')->nullable();
            $table->text('new_stage_rejectP_IA_CQAH_QAH_Reviewation_by')->nullable();
            $table->text('new_stage_rejectP_IA_CQAH_QAH_Reviewation_on')->nullable();
            $table->text('new_stage_rejectP_IA_CQAH_QAH_Review_comment')->nullable();
            $table->text('new_stage_rejectPhase_IB_QA_Review_by')->nullable();
            $table->text('new_stage_rejectPhase_IB_QA_Review_on')->nullable();
            $table->text('new_stage_rejectPhase_IB_QA_Review_comment')->nullable();
            $table->text('new_stage_rejectPhase_IB_HOD_Primary_Review_by')->nullable();
            $table->text('new_stage_rejectPhase_IB_HOD_Primary_Review_on')->nullable();
            $table->text('new_stage_rejectPhase_IB_HOD_Primary_Reviewcomment')->nullable();
            $table->text('new_stage_rejectUnder_Phase_IB_Investigation_by')->nullable();
            $table->text('new_stage_rejectUnder_Phase_IB_Investigation_on')->nullable();
            $table->text('new_stage_rejectUnder_Phase_IB_Investigation_comment')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_A_Investigation_by')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_A_Investigation_on')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_A_Investigation_comment')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_A_HOD17Investigation_by')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_A_HOD17Investigation_on')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_A_HOD17Investigation_comment')->nullable();
            $table->text('new_stage_rejectUnder_Phase_IA_HOD18Investigation_by')->nullable();
            $table->text('new_stage_rejectUnder_Phase_IA_HOD18Investigation_on')->nullable();
            $table->text('new_stage_rejectUnder_Phase_IA_HOD18Investigation_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ootcs', function (Blueprint $table) {
            //
        });
    }
};
