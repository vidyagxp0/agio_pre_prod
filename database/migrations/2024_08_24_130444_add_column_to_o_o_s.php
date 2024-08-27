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
            $table->text('Submite_by')->nullable();
            $table->text('Submite_on')->nullable();
            $table->text('Submite_comment')->nullable();
            $table->text('cancelled_by')->nullable();
            $table->text('cancelled_on')->nullable();
            $table->text('cancelled_Comment')->nullable();
            $table->text('Opened_to_QA_Head_Approval_By')->nullable();
            $table->text('Opened_to_QA_Head_Approval_On')->nullable();
            $table->text('Opened_to_QA_Head_Approval_Comment')->nullable();
            $table->text('HOD_Primary_Review_Complete_By')->nullable();
            $table->text('HOD_Primary_Review_Complete_On')->nullable();
            $table->text('HOD_Primary_Review_Complete_Comment')->nullable();
            $table->text('QA_Head_Approval_By')->nullable();
            $table->text('QA_Head_Approval_On')->nullable();
            $table->text('QA_Head_Approval_Comment')->nullable();
            $table->text('CQA_Head_Primary_Review_Complete_By')->nullable();
            $table->text('CQA_Head_Primary_Review_Complete_On')->nullable();
            $table->text('CQA_Head_Primary_Review_Complete_Comment')->nullable();
            $table->text('Phase_IA_Investigation_By')->nullable();
            $table->text('Phase_IA_Investiigation_On')->nullable();
            $table->text('Phase_IA_Investigation_Comment')->nullable();
            $table->text('Phase_IA_HOD_Review_Complete_By')->nullable();
            $table->text('Phase_IA_HOD_Review_Complete_On')->nullable();
            $table->text('Phase_IA_HOD_Review_Complete_Comment')->nullable();
            $table->text('Phase_IA_QA_Review_Complete_By')->nullable();
            $table->text('Phase_IA_QA_Review_Complete_On')->nullable();
            $table->text('Phase_IA_QA_Review_Complete_Comment')->nullable();

            $table->text('Assignable_Cause_Not_Found_By')->nullable();
            $table->text('Assignable_Cause_Not_Found_On')->nullable();
            $table->text('Assignable_Cause_Not_Found_Comment')->nullable();

            $table->text('Assignable_Cause_Found_By')->nullable();
            $table->text('Assignable_Cause_Found_On')->nullable();
            $table->text('Assignable_Cause_Found_Comment')->nullable();
            $table->text('Phase_IB_Investigation_By')->nullable();
            $table->text('Phase_IB_Investigation_On')->nullable();
            $table->text('Phase_IB_Investigation_Comment')->nullable();
            $table->text('Phase_IB_HOD_Review_Complete_By')->nullable();
            $table->text('Phase_IB_HOD_Review_Complete_On')->nullable();
            $table->text('Phase_IB_HOD_Review_Complete_Comment')->nullable();
            $table->text('Phase_IB_QA_Review_Complete_By')->nullable();
            $table->text('Phase_IB_QA_Review_Complete_On')->nullable();
            $table->text('Phase_IB_QA_Review_Complete_Comment')->nullable();
            $table->text('P_I_B_Assignable_Cause_Not_Found_By')->nullable();
            $table->text('P_I_B_Assignable_Cause_Not_Found_On')->nullable();
            $table->text('P_I_B_Assignable_Cause_Not_Found_Comment')->nullable();
            $table->text('P_I_B_Assignable_Cause_Found_By')->nullable();
            $table->text('P_I_B_Assignable_Cause_Found_On')->nullable();
            $table->text('P_I_B_Assignable_Cause_Found_Comment')->nullable();
            $table->text('Phase_II_A_Investigation_By')->nullable();
            $table->text('Phase_II_A_Investigation_On')->nullable();
            $table->text('Phase_II_A_Investigation_Comment')->nullable();
            $table->text('Phase_II_A_HOD_Review_Complete_By')->nullable();
            $table->text('Phase_II_A_HOD_Review_Complete_On')->nullable();
            $table->text('Phase_II_A_HOD_Review_Complete_Comment')->nullable();
            $table->text('Phase_II_A_QA_Review_Complete_By')->nullable();
            $table->text('Phase_II_A_QA_Review_Complete_On')->nullable();
            $table->text('Phase_II_A_QA_Review_Complete_Comment')->nullable();
            $table->text('P_II_A_Assignable_Cause_Not_Found_By')->nullable();
            $table->text('P_II_A_Assignable_Cause_Not_Found_On')->nullable();
            $table->text('P_II_A_Assignable_Cause_Not_Found_Comment')->nullable();
            $table->text('P_II_A_Assignable_Cause_Found_By')->nullable();
            $table->text('P_II_A_Assignable_Cause_Found_On')->nullable();
            $table->text('P_II_A_Assignable_Cause_Found_Comment')->nullable();
            $table->text('Phase_II_B_Investigation_By')->nullable();
            $table->text('Phase_II_B_Investigation_On')->nullable();
            $table->text('Phase_II_B_Investigation_Comment')->nullable();
            $table->text('Phase_II_B_HOD_Review_Complete_By')->nullable();
            $table->text('Phase_II_B_HOD_Review_Complete_On')->nullable();
            $table->text('Phase_II_B_HOD_Review_Complete_Comment')->nullable();
            $table->text('Phase_II_B_QA_Review_Complete_By')->nullable();
            $table->text('Phase_II_B_QA_Review_Complete_On')->nullable();
            $table->text('Phase_II_B_QA_Review_Complete_Comment')->nullable();
            $table->text('P_II_B_Assignable_Cause_Not_Found_By')->nullable();
            $table->text('P_II_B_Assignable_Cause_Not_Found_On')->nullable();
            $table->text('P_II_B_Assignable_Cause_Not_Found_Comment')->nullable();
            $table->text('P_II_B_Assignable_Cause_Found_By')->nullable();
            $table->text('P_II_B_Assignable_Cause_Found_On')->nullable();
            $table->text('P_II_B_Assignable_Cause_Found_Comment')->nullable();

            //More Info Requiered
            $table->text('more_info_requiered1_By')->nullable();
            $table->text('more_info_requiered1_On')->nullable();
            $table->text('more_info_requiered1_Comment')->nullable();

            $table->text('more_info_requiered2_By')->nullable();
            $table->text('more_info_requiered2_On')->nullable();
            $table->text('more_info_requiered2_Comment')->nullable();

            $table->text('Request_More_Info3_By')->nullable();
            $table->text('Request_More_Info3_On')->nullable();
            $table->text('Request_More_Info3_Comment')->nullable();

            $table->text('more_info_requiered4_By')->nullable();
            $table->text('more_info_requiered4_On')->nullable();
            $table->text('more_info_requiered4_Comment')->nullable();

            $table->text('more_info_requiered5_By')->nullable();
            $table->text('more_info_requiered5_On')->nullable();
            $table->text('more_info_requiered5_Comment')->nullable();

            $table->text('Request_More_Info6_By')->nullable();
            $table->text('Request_More_Info6_On')->nullable();
            $table->text('Request_More_Info6_Comment')->nullable();

            $table->text('more_info_requiered7_By')->nullable();
            $table->text('more_info_requiered7_On')->nullable();
            $table->text('more_info_requiered7_Comment')->nullable();

            $table->text('more_info_requiered8_By')->nullable();
            $table->text('more_info_requiered8_On')->nullable();
            $table->text('more_info_requiered8_Comment')->nullable();

            $table->text('more_info_requiered9_By')->nullable();
            $table->text('more_info_requiered9_On')->nullable();
            $table->text('more_info_requiered9_Comment')->nullable();

            $table->text('Request_More_Info10_By')->nullable();
            $table->text('Request_More_Info10_On')->nullable();
            $table->text('Request_More_Info10_Comment')->nullable();

            $table->text('more_info_requiered11_By')->nullable();
            $table->text('more_info_requiered11_On')->nullable();
            $table->text('more_info_requiered11_Comment')->nullable();

            $table->text('more_info_requiered12_By')->nullable();
            $table->text('more_info_requiered12_On')->nullable();
            $table->text('more_info_requiered12_Comment')->nullable();

            $table->text('more_info_requiered13_By')->nullable();
            $table->text('more_info_requiered13_On')->nullable();
            $table->text('more_info_requiered13_Comment')->nullable();

            $table->text('more_info_requiered14_By')->nullable();
            $table->text('more_info_requiered14_On')->nullable();
            $table->text('more_info_requiered14_Comment')->nullable();

            $table->text('Request_More_Info15_By')->nullable();
            $table->text('Request_More_Info15_On')->nullable();
            $table->text('Request_More_Info15_Comment')->nullable();

            $table->text('more_info_requiered16_By')->nullable();
            $table->text('more_info_requiered16_On')->nullable();
            $table->text('more_info_requiered16_Comment')->nullable();

            $table->text('more_info_requiered17_By')->nullable();
            $table->text('more_info_requiered17_On')->nullable();
            $table->text('more_info_requiered17_Comment')->nullable();

            $table->text('more_info_requiered18_By')->nullable();
            $table->text('more_info_requiered18_On')->nullable();
            $table->text('more_info_requiered18_Comment')->nullable();

            $table->text('Request_More_Info19_By')->nullable();
            $table->text('Request_More_Info19_On')->nullable();
            $table->text('Request_More_Info19_Comment')->nullable();

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
