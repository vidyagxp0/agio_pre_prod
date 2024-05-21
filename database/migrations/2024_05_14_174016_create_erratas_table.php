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
        Schema::create('erratas', function (Blueprint $table) {
            $table->id();
            $table->integer('record_no')->nullable();
            $table->string('division_id')->nullable();
            $table->longText('initiator_id')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('initiated_by')->nullable();
            $table->string('Department')->nullable();
            $table->string('department_code')->nullable();
            $table->string('document_type')->nullable();
            $table->longText('short_description')->nullable();
            $table->string('reference_document')->nullable();
            $table->longText('Observation_on_Page_No')->nullable();
            $table->longText('brief_description')->nullable();
            $table->string('type_of_error')->nullable();
            $table->longtext('details')->nullable();
            $table->date('Date_and_time_of_correction')->nullable();
            $table->longText('QA_Feedbacks')->nullable();
            $table->string('QA_Attachments')->nullable();
            // $table->string('file_path')->nullable();
            $table->longText('HOD_Remarks')->nullable();
            $table->string('HOD_Attachments')->nullable();
            $table->string('Closure_Comments')->nullable();
            $table->string('All_Impacting_Documents_Corrected')->nullable();
            $table->longText('Remarks')->nullable();
            $table->string('Closure_Attachments')->nullable();
            $table->string('stage')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('erratas');
    }
};
