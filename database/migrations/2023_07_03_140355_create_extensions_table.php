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
        Schema::create('extensions', function (Blueprint $table) {
            $table->id();
            $table->integer('cc_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->text('parent_type')->nullable();
            $table->text('record')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->text('intiation_date')->nullable();
            $table->text('due_date')->nullable();
            $table->text('revised_date')->nullable();
            $table->string('division_id')->nullable();
            $table->text('short_description')->nullable();
            $table->text('justification')->nullable();
            $table->text('extention_attachment')->nullable();
            $table->text('closure_attachments')->nullable();
            $table->text('approver1')->nullable();
            $table->text('approver_comments')->nullable();
            $table->string('type')->nullable();
            $table->text('initiated_if_other')->nullable();

            $table->text('refrence_record')->nullable();
            $table->string('initiated_through')->nullable();
            $table->string('submitted_on')->nullable();
            $table->string('cancelled_on')->nullable();
            $table->string('submitted_by')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->string('ext_approved_by')->nullable();
            $table->string('ext_approved_on')->nullable();
            $table->string('more_information_required_by')->nullable();
            $table->string('more_information_required_on')->nullable();
            $table->string('rejected_by')->nullable();
            $table->string('rejected_on')->nullable();

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
        Schema::dropIfExists('extensions');
    }
};
