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
        Schema::table('root_cause_analyses', function (Blueprint $table) {
            $table->text('ack_comments')->nullable();
            $table->string('HOD_Review_Complete_By')->nullable();
            $table->string('HOD_Review_Complete_On')->nullable();
            $table->text('HOD_Review_Complete_Comment')->nullable();
            $table->string('QQQA_Review_Complete_By')->nullable();
            $table->string('QQQA_Review_Complete_On')->nullable();
            $table->text('QAQQ_Review_Complete_comment')->nullable();
            $table->string('HOD_Final_Review_Complete_By')->nullable();
            $table->string('HOD_Final_Review_Complete_On')->nullable();
            $table->text('HOD_Final_Review_Complete_Comment')->nullable();
            $table->string('Final_QA_Review_Complete_By')->nullable();
            $table->string('Final_QA_Review_Complete_On')->nullable();
            $table->text('Final_QA_Review_Complete_Comment')->nullable();
            $table->text('evalution_Closure_comment')->nullable();
            $table->string('More_Info_ack_by')->nullable();
            $table->string('More_Info_ack_on')->nullable();
            $table->text('More_Info_ack_comment')->nullable();
            $table->string('More_Info_hrc_by')->nullable();
            $table->string('More_Info_hrc_on')->nullable();
            $table->text('More_Info_hrc_comment')->nullable();
            $table->string('More_Info_qac_by')->nullable();
            $table->string('More_Info_qac_on')->nullable();
            $table->text('More_Info_qac_comment')->nullable();
            $table->string('More_Info_sub_by')->nullable();
            $table->string('More_Info_sub_on')->nullable();
            $table->text('More_Info_sub_comment')->nullable();
            $table->string('More_Info_hfr_by')->nullable();
            $table->string('More_Info_hfr_on')->nullable();
            $table->text('More_Info_hfr_comment')->nullable();
            $table->text('qA_review_complete_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('root_cause_analyses', function (Blueprint $table) {
            //
        });
    }
};
