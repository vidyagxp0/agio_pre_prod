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
        Schema::create('extension_news', function (Blueprint $table) {
            $table->id();
            $table->string('record_number')->nullable();
            $table->string('site_location_code')->nullable();
            $table->string('initiator')->nullable();
            $table->string('initiation_date')->nullable();
            $table->string('short_description')->nullable();
            $table->string('reviewers')->nullable(); 
            $table->string('approvers')->nullable(); 
            $table->string('current_due_date')->nullable();
            $table->string('proposed_due_date')->nullable();
            $table->string('description')->nullable();
            $table->longText('file_attachment_extension')->nullable();
            $table->string('reviewer_remarks')->nullable();
            $table->longText('file_attachment_reviewer')->nullable();
            $table->string('approver_remarks')->nullable();
            $table->longText('file_attachment_approver')->nullable();
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
        Schema::dropIfExists('extension_news');
    }
};
