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
        Schema::create('observations', function (Blueprint $table) {
            $table->id();
            $table->integer('record')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->string('division_code')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('due_date')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('parent_type')->nullable();
            $table->text('short_description')->nullable();
            $table->text('assign_to')->nullable();
            $table->string('grading')->nullable();
            $table->text('category_observation')->nullable();
            $table->string('reference_guideline')->nullable();
            $table->text('description')->nullable();
            $table->text('attach_files1')->nullable();
            $table->string('recomendation_capa_date_due')->nullable();
            $table->text('non_compliance')->nullable();
            $table->text('recommend_action')->nullable();
            $table->text('related_observations')->nullable();
            $table->string('date_Response_due2')->nullable();
            $table->string('capa_date_due')->nullable();
            $table->integer('assign_to2')->nullable();
            $table->integer('cro_vendor')->nullable();
            $table->text('comments')->nullable();
            $table->text('impact')->nullable();
            $table->text('impact_analysis')->nullable();
            $table->text('severity_rate')->nullable();
            $table->text('occurrence')->nullable();
            $table->text('detection')->nullable();
            $table->text('analysisRPN')->nullable();
            $table->string('actual_start_date')->nullable();
            $table->string('actual_end_date')->nullable();
            $table->text('action_taken')->nullable();
            $table->string('date_response_due1')->nullable();
            $table->string('response_date')->nullable();
            $table->text('attach_files2')->nullable();
            $table->text('related_url')->nullable();
            $table->text('response_summary')->nullable();
            $table->string('Completed_By')->nullable();
            $table->string('completed_on')->nullable();
            $table->string('QA_Approved_By')->nullable();
            $table->string('QA_Approved_on')->nullable();
            $table->string('Final_Approval_By')->nullable();
            $table->string('Final_Approval_on')->nullable();
            $table->string('status')->nullable();
            $table->integer('stage')->nullable();
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
        Schema::dropIfExists('observations');
    }
};
