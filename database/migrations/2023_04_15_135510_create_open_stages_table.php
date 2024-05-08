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
        Schema::create('open_stages', function (Blueprint $table) {
            $table->id();
            $table->integer('initiator_id')->nullable();
            $table->integer('record')->nullable();
            $table->string('title');
            $table->string('version')->nullable();
            $table->string('short_description')->nullable();
            $table->string('type')->nullable();
            $table->integer('assign_to');
            $table->string('cft');
            $table->string('due_date')->nullable();
            $table->string('document_required');
            $table->string('batch')->nullable();
            $table->string('owning_facility')->nullable();
            $table->string('impacted_facilities')->nullable();
            $table->string('owning_department')->nullable();
            $table->string('impacted_department')->nullable();
            $table->string('doc_change_action')->nullable();
            $table->string('doc_change_type')->nullable();
            $table->string('doc_change_summary')->nullable();
            $table->string('doc_change_summary_reason')->nullable();
            $table->string('periodic_review')->default(0);
            $table->string('current_state')->nullable();
            $table->string('proposed_state')->nullable();
            $table->string('justification')->nullable();
            $table->string('equipment_affected')->nullable();
            $table->string('equipment_id')->nullable();
            $table->string('equipment_comment')->nullable();
            $table->string('document_affected')->nullable();
            $table->string('document_comment')->nullable();
            $table->integer('implemented_as_planned')->default(0);
            $table->string('change_evalution')->nullable();
            $table->string('justification_for_reject')->nullable();
            $table->string('status');
            $table->integer('stage');
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
        Schema::dropIfExists('open_stages');
    }
};
