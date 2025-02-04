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
            $table->longtext('General_information_gxp')->nullable();
            $table->longtext('Regulatory_compliance_gxp')->nullable();
            $table->longtext('GxP_Assessment_For_Processes')->nullable();
            $table->longtext('Summary_Of_GxP_Assessment')->nullable();
            $table->longtext('Regulatory_Compliance_Scope_gxp')->nullable();
            $table->longtext('Stakeholder_List_gxp')->nullable();
            $table->longtext('References_and_related_documents_gxp')->nullable();
            $table->longtext('Glossary_Of_Terms_gxp')->nullable();

            $table->longtext('Introduction_Initial_Risk')->nullable();
            $table->longtext('Scope_Initial_Risk')->nullable();
            $table->longtext('Responsibility_Initial_Risk')->nullable();
            $table->longtext('Stakeholder_List_Initial_Risk')->nullable();
            $table->longtext('References_and_related_documents_Initial_Risk')->nullable();
            $table->longtext('Glossary_Of_Terms_Initial_Risk')->nullable();

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
