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
        Schema::create('effectiveness_checks', function (Blueprint $table) {
            $table->id();
            $table->string('is_parent')->default('yes');
            $table->string('parent_record')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->string('division_code')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('parent_type')->nullable();
            $table->string('division_id')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('due_date')->nullable();
            $table->string('record')->nullable();
            $table->string('originator')->nullable();
            $table->longText('short_description')->nullable();
            //$table->string('assign_to')->nullable();
            $table->string('assign_to')->nullable();
            $table->string('Q_A')->nullable();
            $table->string('Quality_Reviewer')->nullable();
            $table->longText('Effectiveness_check_Plan')->nullable();
            $table->longText('Effectiveness_Summary')->nullable();
            $table->longText('Effectiveness_Results')->nullable();
            $table->longText('Effectiveness_check_Attachment')->nullable();
            $table->longText('effect_summary')->nullable();
            $table->longText('Addendum_Comments')->nullable();
            $table->longText('Addendum_Attachment')->nullable();
            $table->longText('Comments')->nullable();
            $table->longText('Attachment')->nullable();
            $table->longText('Attachments')->nullable();
            $table->longText('refer_record')->nullable();
            $table->string('submit_by')->nullable();
            $table->string('submit_on')->nullable();
            $table->string('not_effective_by')->nullable();
            $table->string('not_effective_on')->nullable();
            $table->string('effective_by')->nullable();
            $table->string('effective_on')->nullable();
            $table->string('not_effective_approval_complete_by')->nullable();
            $table->string('not_effective_approval_complete_on')->nullable();
            $table->string('effective_approval_complete_by')->nullable();
            $table->string('effective_approval_complete_on')->nullable();
            $table->string('activity_type')->nullable();
            $table->longText('previous')->nullable();
            $table->longText('current')->nullable();
            $table->longText('comment')->nullable();
            $table->string('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('origin_state')->nullable();
            $table->string('user_role')->nullable();
            $table->string('step')->nullable();
            // $table->string('form_type')->nullable();
            $table->string('status')->default('Opened');
            $table->string('stage')->default(1);

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
        Schema::dropIfExists('effectiveness_checks');
    }
};
