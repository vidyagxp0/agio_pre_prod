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
            $table->longtext('objective_cvpd')->nullable();
            $table->longtext('scope_cvpd')->nullable();
            $table->longtext('purpose_cvpd')->nullable();
            $table->longtext('responsibilities_cvpd')->nullable();
            $table->longtext('identification_sensitive_product_contamination_cvpd')->nullable();
            $table->longtext('matrix_worstcase_approach_cvpd')->nullable();
            $table->longtext('acceptance_criteria_cvpd')->nullable();
            $table->longtext('list_equipment_internal_surface_cvpd')->nullable();
            $table->longtext('identification_clean_surfaces_cvpd')->nullable();
            $table->longtext('sampling_method_cvpd')->nullable();
            $table->longtext('recovery_studies_cvpd')->nullable();
           

            $table->longtext('calculating_carry_over_cvpd')->nullable();
            $table->longtext('calculating_rinse_analysis_cvpd')->nullable();
            $table->longtext('general_procedure_clean_cvpd')->nullable();
            $table->longtext('analytical_method_validation_cvpd')->nullable();
            $table->longtext('list_cleaning_sop_cvpd')->nullable();
            $table->longtext('clean_validation_exercise_cvpd')->nullable();
            $table->longtext('evaluation_analytical_result_cvpd')->nullable();
            $table->longtext('summary_conclusion_cvpd')->nullable();
            $table->longtext('training_cvpd')->nullable();


            $table->longtext('objective_cvrd')->nullable();
            $table->longtext('scope_cvrd')->nullable();
            $table->longtext('purpose_cvrd')->nullable();
            $table->longtext('responsibilities_cvrd')->nullable();
            $table->longtext('analysis_methodology_cvrd')->nullable();
            $table->longtext('recovery_study_report_cvrd')->nullable();
            $table->longtext('acceptance_critria_cvrd')->nullable();
            $table->longtext('analytical_report_cvrd')->nullable();
            $table->longtext('physical_procedure_conformance_check_cvrd')->nullable();
            $table->longtext('conclusion_cvrd')->nullable();
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
