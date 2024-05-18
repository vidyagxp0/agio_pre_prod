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
        Schema::create('launch_extensions', function (Blueprint $table) {
            $table->id();
            $table->text('dev_proposed_due_date')->nullable();
            $table->string('dev_extension_justification')->nullable();
            $table->string('dev_extension_completed_by')->nullable();
            $table->text('dev_completed_on')->nullable();

            $table->text('capa_proposed_due_date')->nullable();
            $table->string('capa_extension_justification')->nullable();
            $table->string('capa_extension_completed_by')->nullable();
            $table->text('capa_completed_on')->nullable();

            $table->text('investigation_proposed_due_date')->nullable();
            $table->string('investigation_extension_justification')->nullable();
            $table->string('investigation_extension_completed_by')->nullable();
            $table->text('investigation_completed_on')->nullable();

            $table->text('qrm_proposed_due_date')->nullable();
            $table->string('qrm_extension_justification')->nullable();
            $table->string('qrm_extension_completed_by')->nullable();
            $table->text('qrm_completed_on')->nullable();


            $table->string('dev_effective_check_plan')->nullable();
            $table->string('dev_effective_proposed_by')->nullable();
            $table->text('dev_effective_proposed_on')->nullable();
            $table->string('dev_effective_closure_comment')->nullable();
            $table->text('dev_next_review_date')->nullable();
            $table->string('dev_effective_check_closed_by')->nullable();
            $table->text('dev_effective_check_closed_on')->nullable();

            $table->string('capa_effective_check_plan')->nullable();
            $table->string('capa_effective_proposed_by')->nullable();
            $table->text('capa_effective_proposed_on')->nullable();
            $table->string('capa_effective_closure_comment')->nullable();
            $table->text('capa_next_review_date')->nullable();
            $table->string('capa_effective_check_closed_by')->nullable();
            $table->text('capa_effective_check_closed_on')->nullable();

            $table->string('investigation_effective_check_plan')->nullable();
            $table->string('investigation_effective_proposed_by')->nullable();
            $table->text('investigation_effective_proposed_on')->nullable();
            $table->string('investigation_effective_closure_comment')->nullable();
            $table->text('investigation_next_review_date')->nullable();
            $table->string('investigation_effective_check_closed_by')->nullable();
            $table->text('investigation_effective_check_closed_on')->nullable();

            $table->string('qrm_effective_check_plan')->nullable();
            $table->string('qrm_effective_proposed_by')->nullable();
            $table->text('qrm_effective_proposed_on')->nullable();
            $table->string('qrm_effective_closure_comment')->nullable();
            $table->text('qrm_next_review_date')->nullable();
            $table->string('qrm_effective_check_closed_by')->nullable();
            $table->text('qrm_effective_check_closed_on')->nullable();

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
        Schema::dropIfExists('launch_extensions');
    }
};
