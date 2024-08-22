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
        Schema::table('risk_managment_cfts', function (Blueprint $table) {
            $table->text('ResearchDevelopment_Review')->nullable();
            $table->text('ResearchDevelopment_person')->nullable();
            $table->text('ResearchDevelopment_assessment')->nullable();
            $table->text('ResearchDevelopment_feedback')->nullable();
            $table->text('ResearchDevelopment_by')->nullable();
            $table->text('ResearchDevelopment_on')->nullable();
            $table->text('RegulatoryAffair_Review')->nullable();
            $table->text('RegulatoryAffair_person')->nullable();
            $table->text('RegulatoryAffair_assessment')->nullable();
            $table->text('RegulatoryAffair_feedback')->nullable();
            $table->text('RegulatoryAffair_by')->nullable();
            $table->text('RegulatoryAffair_on')->nullable();
            $table->text('Microbiology_Review')->nullable();
            $table->text('Microbiology_person')->nullable();
            $table->text('Microbiology_assessment')->nullable();
            $table->text('Microbiology_feedback')->nullable();
            $table->text('Microbiology_by')->nullable();
            $table->text('Microbiology_on')->nullable();
            $table->text('CorporateQualityAssurance_Review')->nullable();
            $table->text('CorporateQualityAssurance_person')->nullable();
            $table->text('CorporateQualityAssurance_assessment')->nullable();
            $table->text('CorporateQualityAssurance_feedback')->nullable();
            $table->text('CorporateQualityAssurance_by')->nullable();
            $table->text('CorporateQualityAssurance_on')->nullable();
            $table->text('ContractGiver_Review')->nullable();
            $table->text('ContractGiver_person')->nullable();
            $table->text('ContractGiver_assessment')->nullable();
            $table->text('ContractGiver_feedback')->nullable();
            $table->text('ContractGiver_by')->nullable();
            $table->text('ContractGiver_on')->nullable();
            $table->text('is_required')->nullable();
            $table->text('status')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('risk_managment_cfts', function (Blueprint $table) {
            $table->dropColumn('ResearchDevelopment_Review')->nullable();
            $table->dropColumn('ResearchDevelopment_person')->nullable();
            $table->dropColumn('ResearchDevelopment_assessment')->nullable();
            $table->dropColumn('ResearchDevelopment_feedback')->nullable();
            $table->dropColumn('ResearchDevelopment_by')->nullable();
            $table->dropColumn('ResearchDevelopment_on')->nullable();
            $table->dropColumn('RegulatoryAffair_Review')->nullable();
            $table->dropColumn('RegulatoryAffair_person')->nullable();
            $table->dropColumn('RegulatoryAffair_assessment')->nullable();
            $table->dropColumn('ResearchDevelopment_feedback')->nullable();
            $table->dropColumn('ResearchDevelopment_by')->nullable();
            $table->dropColumn('ResearchDevelopment_on')->nullable();
            $table->dropColumn('RegulatoryAffair_Review')->nullable();
            $table->dropColumn('RegulatoryAffair_person')->nullable();
            $table->dropColumn('RegulatoryAffair_assessment')->nullable();
            $table->dropColumn('RegulatoryAffair_feedback')->nullable();
            $table->dropColumn('RegulatoryAffair_by')->nullable();
            $table->dropColumn('RegulatoryAffair_on')->nullable();
            $table->dropColumn('Microbiology_Review')->nullable();
            $table->dropColumn('Microbiology_person')->nullable();
            $table->dropColumn('Microbiology_assessment')->nullable();
            $table->dropColumn('Microbiology_feedback')->nullable();
            $table->dropColumn('Microbiology_by')->nullable();
            $table->dropColumn('Microbiology_on')->nullable();
            $table->dropColumn('CorporateQualityAssurance_Review')->nullable();
            $table->dropColumn('CorporateQualityAssurance_person')->nullable();
            $table->dropColumn('CorporateQualityAssurance_assessment')->nullable();
            $table->dropColumn('CorporateQualityAssurance_feedback')->nullable();
            $table->dropColumn('CorporateQualityAssurance_by')->nullable();
            $table->dropColumn('CorporateQualityAssurance_on')->nullable();
            $table->dropColumn('ContractGiver_Review')->nullable();
            $table->dropColumn('ContractGiver_person')->nullable();
            $table->dropColumn('ContractGiver_assessment')->nullable();
            $table->dropColumn('ContractGiver_feedback')->nullable();
            $table->dropColumn('ContractGiver_by')->nullable();
            $table->dropColumn('ContractGiver_on')->nullable();
        });
    }
};
