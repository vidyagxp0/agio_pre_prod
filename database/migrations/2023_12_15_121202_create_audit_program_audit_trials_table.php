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
        Schema::create('audit_program_audit_trials', function (Blueprint $table) {
            $table->id();
            $table->string('AuditProgram_id');
            $table->string('activity_type');
            $table->longText('previous')->nullable();
            $table->longText('current')->nullable();
            $table->longText('comment')->nullable();
            $table->string('user_id');
            $table->string('user_name');
            $table->string('origin_state')->nullable();
            $table->string('user_role');
            $table->string('change_to')->nullable();
            $table->string('change_from')->nullable();
            $table->longText('through_req')->nullable();
            $table->string('action_name')->nullable();
            $table->string('action')->nullable();
            $table->string('Months')->nullable();
            $table->text('Submitted_comment')->nullable();
            $table->text('approved_comment')->nullable();
            $table->text('reject_comment')->nullable();
            $table->text('Cancelled_comment')->nullable();
            $table->text('Audit_Completed_comment')->nullable();
            $table->string('stage')->nullable();
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
        Schema::dropIfExists('audit_program_audit_trials');
    }
};
