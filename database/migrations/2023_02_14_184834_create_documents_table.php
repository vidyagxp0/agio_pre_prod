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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->integer('originator_id')->nullable();
            $table->integer('division_id')->nullable();
            $table->integer('process_id')->nullable();
            $table->integer('record')->nullable();
            $table->string('revised')->default('No');
            $table->integer('revised_doc')->default('0');
            $table->longtext('document_name');
            $table->longtext('short_description')->nullable();
            $table->string('due_dateDoc')->nullable();
            $table->longtext('description')->nullable();
            $table->longtext('notify_to')->nullable();
            $table->longtext('reference_record')->nullable();
            $table->longtext('department_id')->nullable();
            $table->longtext('document_type_id')->nullable();
            $table->longtext('document_subtype_id')->nullable();
            $table->longtext('document_language_id')->nullable();
            $table->longtext('keywords')->nullable();
            $table->string('effective_date')->nullable();
            $table->string('next_review_date')->nullable();
            $table->string('review_period')->nullable();
            $table->longtext('attach_draft_doocument')->nullable();
            $table->longtext('attach_effective_docuement')->nullable();
            $table->longtext('reviewers')->nullable();
            $table->longtext('approvers')->nullable();
            $table->longtext('reviewers_group')->nullable();
            $table->longtext('approver_group')->nullable();
            $table->longtext('revision_summary')->nullable();
            $table->string('revision_type')->nullable();
            $table->integer('major')->nullable();
            $table->integer('minor')->nullable();
            $table->longtext('sop_type')->nullable();
            $table->longtext('training_required')->nullable();
            $table->integer('stage')->default(1);
            $table->string('status');
            $table->longtext('document')->nullable();
            $table->string('revision')->default("No");
            $table->string('revision_policy')->nullable();
            $table->string('trainer')->nullable();
            $table->longText('comments')->nullable();
            

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
        Schema::dropIfExists('documents');
    }
};
