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
        Schema::create('change_proposal_justs', function (Blueprint $table) {
            $table->id();
            $table->integer('record')->nullable();
            $table->string('division_code')->nullable();
            $table->string('division_id')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('due_date')->nullable();
            $table->string('Initiator_Group')->nullable();
            $table->text('initiator_group_code_gi')->nullable();
            $table->longText('cpdescription')->nullable();
            $table->longText('impassesment')->nullable();
            $table->text('cpAttachment')->nullable();
            $table->longText('hod_comment')->nullable();
            $table->text('hodAttachment')->nullable();
            $table->longText('qa_comment')->nullable();
            $table->text('qaAttachment')->nullable();
            $table->longText('qa_cqa_head_comment')->nullable();
            $table->text('qa_cqa_head_Attachment')->nullable();
            $table->string('submit_on')->nullable();
            $table->string('submit_by')->nullable();
            $table->longText('submit_comment')->nullable();
            $table->string('HOD_Review_Complete_By')->nullable();
            $table->string('HOD_Review_Complete_On')->nullable();
            $table->longText('HOD_Review_Comments')->nullable();
            $table->string('qa_cqa_Review_Complete_By')->nullable();
            $table->string('qa_cqa__Review_Complete_On')->nullable();
            $table->longText('qa_cqa__Review_Comments')->nullable();
            $table->string('qa_cqa_head_Review_Complete_By')->nullable();
            $table->string('qa_cqa_head_Review_Complete_On')->nullable();
            $table->longText('qa_cqa_head_Review_Comments')->nullable();
             $table->string('cancelled_on')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->string('rejected_on')->nullable();
            $table->string('rejected_by')->nullable();
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
        Schema::dropIfExists('change_proposal_justs');
    }
};
