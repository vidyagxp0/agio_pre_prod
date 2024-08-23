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
        Schema::table('internal_audits', function (Blueprint $table) {
            $table->text('file_attach_add')->nullable();
            $table->text('supproting_attachment')->nullable();
            $table->text('tablet_coating_supporting_attachment')->nullable();
            $table->text('tablet_capsule_packing_attachmen')->nullable();
            $table->text('file_attach_add_1')->nullable();
            $table->text('dispensing_and_manufacturing_attachment')->nullable();
            $table->text('file_attach_add_2')->nullable();
            $table->text('ointment_packing_attachment')->nullable();
            $table->text('engineering_response_attachment')->nullable();
            $table->text('quality_control_response_attachment')->nullable();
            $table->text('checklist_stores_response_attachment')->nullable();
            $table->text('checklist_hr_response_attachment')->nullable();
            $table->text('remark_documentation_name_attachment')->nullable();
            $table->text('remark_injection_packing_attachment')->nullable();
            $table->text('remark_powder_manufacturing_filling_attachment')->nullable();
            $table->text('remark_analytical_research_attachment')->nullable();
            $table->text('remark_formulation_research_development_attachment')->nullable();
            $table->text('auditSheChecklist_attachment_main')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('internal_audits', function (Blueprint $table) {
            //
        });
    }
};
