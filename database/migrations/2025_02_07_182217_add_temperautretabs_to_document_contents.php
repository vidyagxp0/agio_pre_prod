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
        Schema::table('document_contents', function (Blueprint $table) {
            //
            $table->longText('ProtocolApproval_TemperMap')->nullable();
            $table->longText('Objective_TemperMap')->nullable();
            $table->longText('Scope_TemperMap')->nullable();
            $table->longText('AreaValidated_TemperMap')->nullable();
            $table->longText('ValidationTeamResponsibilities_TemperMap')->nullable();
            $table->longText('Reference_TemperMap')->nullable();
            $table->longText('DocumentFollowed_TemperMap')->nullable();
            $table->longText('StudyRationale_TemperMap')->nullable();
            $table->longText('Procedure_TemperMap')->nullable();
            $table->longText('CriteriaRevalidation_TemperMap')->nullable();
            $table->longText('MaterialDocumentRequired_TemperMap')->nullable();
            $table->longText('AcceptanceCriteria_TemperMap')->nullable();
            $table->longText('TypeofValidation_TemperMap')->nullable();
            $table->longText('ObservationResult_TemperMap')->nullable();
            $table->longText('Abbreviations_TemperMap')->nullable();
            $table->longText('DeviationAny_TemperMap')->nullable();
            $table->longText('ChangeControl_TemperMap')->nullable();
            $table->longText('Summary_TemperMap')->nullable();
            $table->longText('Conclusion_TemperMap')->nullable();
            $table->longText('AttachmentList_TemperMap')->nullable();
            $table->longText('PostApproval_TemperMap')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_contents', function (Blueprint $table) {
            //
        });
    }
};
