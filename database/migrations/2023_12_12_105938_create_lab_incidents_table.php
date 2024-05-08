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
        Schema::create('lab_incidents', function (Blueprint $table) {
            $table->id();
            $table->integer('record')->nullable();
            $table->string('form_type')->nullable();
            $table->string('division_id')->nullable();
            // $table->integer('initiator_id')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->string('division_code')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('due_date')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('parent_type')->nullable();
            $table->string('short_desc')->nullable();
            $table->string('severity_level2')->nullable();
            $table->string('Initiator_Group')->nullable();
            $table->longtext('Incident_Category_others')->nullable();

            $table->string('initiator_group_code')->nullable();
            $table->string('Other_Ref')->nullable();
            // $table->string('due_date')->nullable();
            $table->date('effect_check_date')->nullable();
            $table->date('occurance_date')->nullable();
            $table->string('due_date_extension')->nullable();
            $table->integer('assign_to')->nullable();
            $table->string('Incident_Category')->nullable();
            $table->string('Invocation_Type')->nullable();
            $table->text('Initial_Attachment')->nullable();
            $table->text('Incident_Details')->nullable();
            $table->text('Document_Details')->nullable();
            $table->text('Instrument_Details')->nullable();
            $table->text('Involved_Personnel')->nullable();
            $table->text('Product_Details')->nullable();
            $table->text('Supervisor_Review_Comments')->nullable();
            $table->text('Attachments')->nullable();
            $table->text('Cancelation_Remarks')->nullable();
            $table->text('Inv_Attachment')->nullable();
            $table->text('Investigation_Details')->nullable();
            $table->text('Action_Taken')->nullable();
            $table->text('Root_Cause')->nullable();
            $table->text('Currective_Action')->nullable();
            $table->text('Preventive_Action')->nullable();
            $table->text('Corrective_Preventive_Action')->nullable();
            $table->text('CAPA_Attachment')->nullable();
            $table->text('QA_Review_Comments')->nullable();
            $table->text('QA_Head_Attachment')->nullable();
            $table->longtext('QA_Head')->nullable();
            $table->string('Effectiveness_Check')->nullable();
            $table->date('effectivess_check_creation_date')->nullable();
            $table->string('Incident_Type')->nullable();
            $table->longtext('Conclusion')->nullable();
            $table->string('status')->nullable();
            $table->integer('stage')->nullable();

            $table->string('submitted_by')->nullable();
            $table->string('incident_review_completed_by')->nullable();
            $table->string('investigation_completed_by')->nullable();
            $table->string('inv_andCAPA_review_comp_by')->nullable();
            $table->string('qA_review_completed_by')->nullable();
            $table->string('qA_head_approval_completed_by')->nullable();
            $table->string('cancelled_by')->nullable();

            $table->string('submitted_on')->nullable();
            $table->string('incident_review_completed_on')->nullable();
            $table->string('investigation_completed_on')->nullable();
            $table->string('inv_andCAPA_review_comp_on')->nullable();
            $table->string('qA_review_completed_on')->nullable();
            $table->string('qA_head_approval_completed_on')->nullable();
            $table->string('review_completed_by')->nullable();
            $table->string('review_completed_on')->nullable();
            $table->string('all_activities_completed_by')->nullable();
            $table->string('all_activities_completed_on')->nullable();
            // $table->string('cancelled_by')->nullable();
            $table->string('cancelled_on')->nullable();
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
        Schema::dropIfExists('lab_incidents');
    }
};
