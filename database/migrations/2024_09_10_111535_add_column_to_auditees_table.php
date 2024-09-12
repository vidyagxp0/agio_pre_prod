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
        Schema::table('auditees', function (Blueprint $table) {
            // $table->text('audit_details_summary_on')->nullable();
            // $table->text('audit_details_summary_on_comment')->nullable();
            // $table->text('summary_and_response_com_on')->nullable();
            // $table->text('summary_and_response_com_on_comment')->nullable();
            // $table->text('more_info_req_crc_by')->nullable();
            // $table->text('more_info_req_crc_on')->nullable();
            // $table->text('more_info_req_crc_on_comment')->nullable();
            // $table->text('CFT_Review_Complete_On')->nullable();
            // $table->text('approval_complete_on')->nullable();
            // $table->text('cft_review_not_req_by')->nullable();
            // $table->text('cft_review_not_req_on')->nullable();
            // $table->text('cft_review_not_req_on_comment')->nullable();
            // $table->text('send_to_opened_by')->nullable();
            // $table->text('send_to_opened_on')->nullable();
            // $table->text('send_to_opened_comment')->nullable();
            // $table->text('more_info_req_by')->nullable();
            // $table->text('more_info_req_on')->nullable();
            // $table->text('more_info_req_on_comment')->nullable();















        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auditees', function (Blueprint $table) {
            //
        });
    }
};
