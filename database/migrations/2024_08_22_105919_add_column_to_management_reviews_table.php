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
        Schema::table('management_reviews', function (Blueprint $table) {
            $table->text('qaHeadReviewComplete_By')->nullable();
            $table->text('qaHeadReviewComplete_On')->nullable();
            $table->text('qaHeadReviewComplete_Comment')->nullable();
            $table->text('meeting_summary_by')->nullable();
            $table->text('meeting_summary_on')->nullable();
            $table->text('meeting_summary_comment')->nullable();
            $table->text('ALLAICompleteby_by')->nullable();
            $table->text('ALLAICompleteby_on')->nullable();
            $table->text('ALLAICompleteby_comment')->nullable();
            $table->text('hodFinaleReviewComplete_by')->nullable();
            $table->text('hodFinaleReviewComplete_on')->nullable();
            $table->text('hodFinaleReviewComplete_comment')->nullable();
            $table->text('QAVerificationComplete_by')->nullable();
            $table->text('QAVerificationComplete_On')->nullable();
            $table->text('QAVerificationComplete_Comment')->nullable();
            $table->text('Approved_by')->nullable();
            $table->text('Approved_on')->nullable();
            $table->text('Approved_comment')->nullable();
            $table->text('ReturnActivityOpenedstage_By')->nullable();
            $table->text('ReturnActivityOpenedstage_On')->nullable();
            $table->text('ReturnActivityOpenedstage_Comment')->nullable();
            $table->text('requireactivitydepartment_by')->nullable();
            $table->text('requireactivitydepartment_on')->nullable();
            $table->text('requireactivitydepartment_comment')->nullable();
            $table->text('requireactivityHODdepartment_by')->nullable();
            $table->text('requireactivityHODdepartment_on')->nullable();
            $table->text('requireactivityHODdepartment_comment')->nullable();
            $table->text('requireactivityQAdepartment_by')->nullable();
            $table->text('requireactivityQAdepartment_on')->nullable();
            $table->text('requireactivityQAdepartment_comment')->nullable();






            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('management_reviews', function (Blueprint $table) {
            //
        });
    }
};
