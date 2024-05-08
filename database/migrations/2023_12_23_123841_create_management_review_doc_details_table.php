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
        Schema::create('management_review_doc_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('review_id')->nullable();
            $table->string('type')->nullable();
            $table->text('date')->nullable();
            $table->text('topic')->nullable();
            $table->text('responsible')->nullable();
            $table->text('start_time')->nullable();
            $table->text('end_time')->nullable();
            $table->text('comment')->nullable();
            $table->text('invited_Person')->nullable();
            $table->text('designee')->nullable();
            $table->text('department')->nullable();
            $table->text('meeting_Attended')->nullable();
            $table->text('designee_Name')->nullable();
            $table->text('designee_Department')->nullable();
            $table->text('remarks')->nullable();
            $table->text('monitoring')->nullable();
            $table->text('measurement')->nullable();
            $table->text('analysis')->nullable();
            $table->text('evaluation')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('site')->nullable();
            $table->text('responsible_person')->nullable();
            $table->text('current_status')->nullable();
            $table->text('remark')->nullable();
            $table->text('date_due')->nullable();
            $table->text('date_closed')->nullable();
            $table->text('Details')->nullable();
            $table->text('capa_type')->nullable();
            $table->text('site2')->nullable();
            $table->text('responsible_person2')->nullable();
            $table->text('current_status2')->nullable();
            $table->text('date_closed2')->nullable();
            $table->text('remark2')->nullable();
        
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
        Schema::dropIfExists('management_review_doc_details');
    }
};
