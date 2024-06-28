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
        Schema::table('failure_investigations', function (Blueprint $table) {
            $table->text('hodToInitiator_by')->nullable();
            $table->text('hodToInitiator_on')->nullable();
            $table->longText('hodToInitiator_comment')->nullable();

            $table->text('qaInitialToHod_by')->nullable();
            $table->text('qaInitialToHod_on')->nullable();
            $table->longText('qaInitialToHod_comment')->nullable();

            $table->text('cftToQaInital_by')->nullable();
            $table->text('cftToQaInital_on')->nullable();
            $table->longText('cftToQaInital_comment')->nullable();

            $table->text('qaHeadToQaFinal_by')->nullable();
            $table->text('qaHeadToQaFinal_on')->nullable();
            $table->longText('qaHeadToQaFinal_comment')->nullable();

            $table->text('pendigInitatorToQAHead_by')->nullable();
            $table->text('pendigInitatorToQAHead_on')->nullable();
            $table->longText('pendigInitatorToQAHead_comment')->nullable();

            $table->text('QaFinalToInitiatorUpdate_by')->nullable();
            $table->text('QaFinalToInitiatorUpdate_on')->nullable();
            $table->longText('QaFinalToInitiatorUpdate_comment')->nullable();

            /****************** QA to Initial,HOD,Initiator ****************/
            $table->text('QAFinalToInitiator_by')->nullable();
            $table->text('QAFinalToInitiator_on')->nullable();
            $table->longText('QAFinalToInitiator_comment')->nullable();

            $table->text('QAFinalToHod_by')->nullable();
            $table->text('QAFinalToHod_on')->nullable();
            $table->longText('QAFinalToHod_comment')->nullable();

            $table->text('QAFinalToQaInitial_by')->nullable();
            $table->text('QAFinalToQaInitial_on')->nullable();
            $table->longText('QAFinalToQaInitial_comment')->nullable();

            /****************** Pending Initiator to Initial,HOD,Initiator ****************/
            $table->text('pendingInitiatorToInitiator_by')->nullable();
            $table->text('pendingInitiatorToInitiator_on')->nullable();
            $table->longText('pendingInitiatorToInitiator_comment')->nullable();

            $table->text('pendingInitiatorToHod_by')->nullable();
            $table->text('pendingInitiatorToHod_on')->nullable();
            $table->longText('pendingInitiatorToHod_comment')->nullable();

            $table->text('pendingInitiatorToQaInitial_by')->nullable();
            $table->text('pendingInitiatorToQaInitial_on')->nullable();
            $table->longText('pendingInitiatorToQaInitial_comment')->nullable();

            /****************** QA Final to Initial,HOD,Initiator,Pending initiator ****************/
            $table->text('QAFinalApprovalToInitiator_by')->nullable();
            $table->text('QAFinalApprovalToInitiator_on')->nullable();
            $table->longText('QAFinalApprovalToInitiator_comment')->nullable();

            $table->text('QAFinalApprovalToHod_by')->nullable();
            $table->text('QAFinalApprovalToHod_on')->nullable();
            $table->longText('QAFinalApprovalToHod_comment')->nullable();

            $table->text('QAFinalApprovalToQaInitial_by')->nullable();
            $table->text('QAFinalApprovalToQaInitial_on')->nullable();
            $table->longText('QAFinalApprovalToQaInitial_comment')->nullable();

            $table->text('QAFinalApprovalToPendingInitator_by')->nullable();
            $table->text('QAFinalApprovalToPendingInitator_on')->nullable();
            $table->longText('QAFinalApprovalToPendingInitato_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('failure_investigations', function (Blueprint $table) {
            //
        });
    }
};
