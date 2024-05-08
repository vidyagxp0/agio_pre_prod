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
        Schema::create('action_items', function (Blueprint $table) {
            $table->id();
            $table->integer('cc_id')->nullable();
            $table->integer('record')->nullable();
            $table->string('division_id')->nullable();
            // $table->string('division_id')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->string('division_code')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('due_date')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('parent_type')->nullable();
             $table->text('Reference_Recores1')->nullable();
            $table->longText('description')->nullable();
            $table->string('title')->nullable();
            $table->string('dept')->nullable();
            $table->text('hod_preson')->nullable();
            $table->text('file_attach')->nullable();
            $table->string('initiatorGroup')->nullable();
            $table->longText('action_taken')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->longText('comments')->nullable();
            $table->integer('record_number')->nullable();
          //  $table->string('related_records')->nullable();
            $table->text('assign_to')->nullable();
            $table->longText('short_description')->nullable();
            $table->text('departments')->nullable();
            $table->longText('due_date_extension')->nullable();
            $table->text('Support_doc')->nullable();
            $table->longText('qa_comments')->nullable();
            $table->text('submitted_by')->nullable();
            $table->text('submitted_on')->nullable();
            $table->text('cancelled_by')->nullable();
            $table->text('cancelled_on')->nullable();
            $table->text('completed_by')->nullable();
            $table->text('completed_on')->nullable();
            $table->text('more_information_required_by')->nullable();
            $table->text('more_information_required_on')->nullable();
            $table->string('status')->nullable();
            $table->integer('stage')->nullable();
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
        Schema::dropIfExists('action_items');
    }
};
