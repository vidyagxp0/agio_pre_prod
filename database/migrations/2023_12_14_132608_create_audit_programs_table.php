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
        Schema::create('audit_programs', function (Blueprint $table) {
            $table->id();
            $table->integer('record')->nullable();
            // $table->integer('initiator_id')->nullable();
            $table->string('division_id')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->string('division_code')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('Initiator_Group')->nullable();
            $table->string('initiator_group_code')->nullable();
            $table->string('due_date')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('parent_type')->nullable();
            $table->text('short_description')->nullable();
            $table->text('assign_to')->nullable();
            // $table->string('due_date')->nullable();
            $table->string('type')->nullable();
            $table->string('year')->nullable();
            $table->string('Quarter')->nullable();
            $table->text('description')->nullable();

            $table->text('initiated_through')->nullable();
            $table->text('initiated_through_req')->nullable();
            $table->text('repeat')->nullable();
            $table->text('repeat_nature')->nullable();
            $table->text('due_date_extension')->nullable();


            $table->text('comments')->nullable();
            $table->text('attachments')->nullable();
            $table->text('related_url')->nullable();
            $table->text('url_description')->nullable();
            //$table->text('suggested_audits')->nullable();
            $table->string('zone')->nullable();
            $table->string('country')->nullable();
            $table->string('City')->nullable();
            $table->string('state')->nullable();
            $table->string('severity1_level')->nullable();
            $table->string('status')->nullable();
            $table->integer('stage')->nullable();
            $table->string('submitted_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('submitted_on')->nullable();
            $table->string('approved_on')->nullable();
            $table->string('Audit_Completed_By')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->string('cancelled_on')->nullable();
            $table->string('rejected_by')->nullable();
            $table->string('rejected_on')->nullable();
            // $table->string('form_type')->nullable();
            $table->string('Audit_Completed_On')->nullable();
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
        Schema::dropIfExists('audit_programs');
    }
};
