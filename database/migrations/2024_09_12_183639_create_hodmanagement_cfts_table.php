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
        Schema::create('hodmanagement_cfts', function (Blueprint $table) {
              $table->id();
            $table->integer('ManagementReview_id');

            $table->text('hod_Quality_review')->nullable();
            $table->text('hod_Quality_Control_Person')->nullable();
            $table->longtext('hod_Quality_Control_assessment')->nullable();
            $table->longtext('hod_Quality_Control_feedback')->nullable();
            $table->string('hod_Quality_Control_attachment')->nullable();
            $table->text('hod_Quality_Control_by')->nullable();
            $table->date('hod_Quality_Control_on')->nullable();

            $table->text('hod_Quality_Assurance_Review')->nullable();
            $table->text('hod_QualityAssurance_person')->nullable();
            $table->longtext('hod_QualityAssurance_assessment')->nullable();
            $table->longtext('hod_QualityAssurance_feedback')->nullable();
            $table->string('hod_Quality_Assurance_attachment')->nullable();
            $table->text('hod_QualityAssurance_by')->nullable();
            $table->date('hod_QualityAssurance_on')->nullable();

            $table->text('hod_Engineering_review')->nullable();
            $table->text('hod_Engineering_person')->nullable();
            $table->longtext('hod_Engineering_assessment')->nullable();
            $table->longtext('hod_Engineering_feedback')->nullable();
            $table->string('hod_Engineering_attachment')->nullable();
            $table->text('hod_Engineering_by')->nullable();
            $table->date('hod_Engineering_on')->nullable();

            $table->text('hod_Analytical_Development_review')->nullable();
            $table->text('hod_Analytical_Development_person')->nullable();
            $table->longtext('hod_Analytical_Development_assessment')->nullable();
            $table->longtext('hod_Analytical_Development_feedback')->nullable();
            $table->string('hod_Analytical_Development_attachment')->nullable();
            $table->text('hod_Analytical_Development_by')->nullable();
            $table->date('hod_Analytical_Development_on')->nullable();

            $table->text('hod_Technology_transfer_review')->nullable();
            $table->text('hod_Technology_transfer_person')->nullable();
            $table->longtext('hod_Technology_transfer_assessment')->nullable();
            $table->longtext('hod_Technology_transfer_feedback')->nullable();
            $table->string('hod_Technology_transfer_attachment')->nullable();
            $table->text('hod_Technology_transfer_by')->nullable();
            $table->date('hod_Technology_transfer_on')->nullable();

            $table->text('hod_Environment_Health_review')->nullable();
            $table->text('hod_Environment_Health_Safety_person')->nullable();
            $table->longtext('hod_Health_Safety_assessment')->nullable();
            $table->longtext('hod_Health_Safety_feedback')->nullable();
            $table->string('hod_Environment_Health_Safety_attachment')->nullable();
            $table->text('hod_Environment_Health_Safety_by')->nullable();
            $table->date('hod_Environment_Health_Safety_on')->nullable();

            $table->text('hod_Human_Resource_review')->nullable();
            $table->text('hod_Human_Resource_person')->nullable();
            $table->longtext('hod_Human_Resource_assessment')->nullable();
            $table->longtext('hod_Human_Resource_feedback')->nullable();
            $table->longtext('hod_Human_Resource_attachment')->nullable();
            $table->string('hod_Human_Resource_by')->nullable();
            $table->date('hod_Human_Resource_on')->nullable();

            $table->text('hod_Project_management_review')->nullable();
            $table->text('hod_Project_management_person')->nullable();
            $table->longtext('hod_Project_management_feedback')->nullable();
            $table->string('hod_Project_management_attachment')->nullable();
            $table->string('hod_Project_management_by')->nullable();
            $table->date('hod_Project_management_on')->nullable();

            $table->text('hod_Other1_review')->nullable();
            $table->text('hod_Other1_person')->nullable();
            $table->longtext('hod_Other1_feedback')->nullable();
            $table->string('hod_Other1_attachment')->nullable();
            $table->text('hod_Other1_by')->nullable();
            $table->date('hod_Other1_on')->nullable();

            $table->text('hod_Other2_review')->nullable();
            $table->text('hod_Other2_person')->nullable();
            $table->longtext('hod_Other2_feedback')->nullable();
            $table->string('hod_Other2_attachment')->nullable();
            $table->text('hod_Other2_by')->nullable();
            $table->date('hod_Other2_on')->nullable();

            $table->text('hod_Other3_review')->nullable();
            $table->text('hod_Other3_person')->nullable();
            $table->text('hod_Other3_Department_person')->nullable();
            $table->longtext('hod_Other3_Assessment')->nullable();
            $table->longtext('hod_Other3_feedback')->nullable();
            $table->string('hod_Other3_attachment')->nullable();
            $table->text('hod_Other3_by')->nullable();
            $table->date('hod_Other3_on')->nullable();

            $table->text('hod_Other4_review')->nullable();
            $table->text('hod_Other4_person')->nullable();
            $table->string('hod_Other4_Department_person')->nullable();
            $table->longtext('hod_Other4_Assessment')->nullable();
            $table->longtext('Other4_feedback')->nullable();
            $table->string('hod_Other4_attachment')->nullable();
            $table->text('hod_Other4_by')->nullable();
            $table->date('hod_Other4_on')->nullable();

            $table->text('hod_Other5_review')->nullable();
            $table->text('hod_Other5_person')->nullable();
            $table->string('hod_Other5_Department_person')->nullable();
            $table->longtext('hod_Other5_Assessment')->nullable();
            $table->longtext('hod_Other5_feedback')->nullable();
            $table->string('hod_Other5_attachment')->nullable();
            $table->text('hod_Other5_by')->nullable();
            $table->date('hod_Other5_on')->nullable();

            $table->text('hod_Production_Table_Review')->nullable();
            $table->text('hod_Production_Table_Person')->nullable();
            $table->longtext('hod_Production_Table_Assessment')->nullable();
            $table->longtext('hod_Production_Table_Feedback')->nullable();
            $table->string('hod_Production_Table_Attachment')->nullable();
            $table->text('hod_Production_Table_By')->nullable();
            $table->date('hod_Production_Table_On')->nullable();

            $table->text('hod_ProductionLiquid_Review')->nullable();
            $table->text('hod_ProductionLiquid_Comments')->nullable();
            $table->text('hod_ProductionLiquid_person')->nullable();
            $table->longtext('hod_ProductionLiquid_assessment')->nullable();
            $table->longtext('hod_ProductionLiquid_feedback')->nullable();
            $table->string('hod_ProductionLiquid_attachment')->nullable();
            $table->text('hod_ProductionLiquid_by')->nullable();
            $table->date('hod_ProductionLiquid_on')->nullable();

            $table->text('hod_Production_Injection_Review')->nullable();
            $table->text('hod_Production_Injection_Person')->nullable();
            $table->longtext('hod_Production_Injection_Assessment')->nullable();
            $table->longtext('hod_Production_Injection_Feedback')->nullable();
            $table->string('hod_Production_Injection_Attachment')->nullable();
            $table->text('hod_Production_Injection_By')->nullable();
            $table->date('hod_Production_Injection_On')->nullable();

            $table->text('hod_Store_Review')->nullable();
            $table->text('hod_Store_Comments')->nullable();
            $table->text('hod_Store_person')->nullable();
            $table->longtext('hod_Store_assessment')->nullable();
            $table->longtext('hod_Store_feedback')->nullable();
            $table->string('hod_Store_attachment')->nullable();
            $table->text('hod_Store_by')->nullable();
            $table->date('hod_Store_on')->nullable();

            $table->text('hod_ResearchDevelopment_Review')->nullable();
            $table->text('hod_ResearchDevelopment_Comments')->nullable();
            $table->text('hod_ResearchDevelopment_person')->nullable();
            $table->longtext('hod_ResearchDevelopment_assessment')->nullable();
            $table->longtext('hod_ResearchDevelopment_feedback')->nullable();
            $table->string('hod_ResearchDevelopment_attachment')->nullable();
            $table->text('hod_ResearchDevelopment_by')->nullable();
            $table->date('hod_ResearchDevelopment_on')->nullable();

            $table->text('hod_Microbiology_Review')->nullable();
            $table->text('hod_Microbiology_Comments')->nullable();
            $table->text('hod_Microbiology_person')->nullable();
            $table->longtext('hod_Microbiology_assessment')->nullable();
            $table->longtext('hod_Microbiology_feedback')->nullable();
            $table->string('hod_Microbiology_attachment')->nullable();
            $table->text('hod_Microbiology_by')->nullable();
            $table->date('hod_Microbiology_on')->nullable();

            $table->text('hod_RegulatoryAffair_Review')->nullable();
            $table->text('hod_RegulatoryAffair_Comments')->nullable();
            $table->text('hod_RegulatoryAffair_person')->nullable();
            $table->longtext('hod_RegulatoryAffair_assessment')->nullable();
            $table->longtext('hod_RegulatoryAffair_feedback')->nullable();
            $table->string('hod_RegulatoryAffair_attachment')->nullable();
            $table->text('hod_RegulatoryAffair_by')->nullable();
            $table->date('hod_RegulatoryAffair_on')->nullable();

            $table->text('hod_CorporateQualityAssurance_Review')->nullable();
            $table->text('hod_CorporateQualityAssurance_Comments')->nullable();
            $table->text('hod_CorporateQualityAssurance_person')->nullable();
            $table->longtext('hod_CorporateQualityAssurance_assessment')->nullable();
            $table->longtext('hod_CorporateQualityAssurance_feedback')->nullable();
            $table->string('hod_CorporateQualityAssurance_attachment')->nullable();
            $table->text('hod_CorporateQualityAssurance_by')->nullable();
            $table->date('hod_CorporateQualityAssurance_on')->nullable();

            $table->text('hod_ContractGiver_Review')->nullable();
            $table->text('hod_ContractGiver_Comments')->nullable();
            $table->text('hod_ContractGiver_person')->nullable();
            $table->longtext('hod_ContractGiver_assessment')->nullable();
            $table->longtext('hod_ContractGiver_feedback')->nullable();
            $table->string('hod_ContractGiver_attachment')->nullable();
            $table->text('hod_ContractGiver_by')->nullable();
            $table->date('hod_ContractGiver_on')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('hodmanagement_cfts');
    }
};
