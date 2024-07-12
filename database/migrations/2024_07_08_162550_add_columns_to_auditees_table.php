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
            $table->text('audit_schedule_on_comment')->nullable();
            $table->text('audit_preparation_completed_on_comment')->nullable();
            $table->text('audit_mgr_more_info_reqd_on_comment')->nullable();
            $table->text('audit_observation_submitted_on_comment')->nullable();
            $table->text('audit_lead_more_info_reqd_on_comment')->nullable();
            $table->text('cancelled_on_comment')->nullable();
            $table->text('cancelled_on_comment1')->nullable();
            $table->text('cancelled_on_comment2')->nullable();
            $table->text('cancelled_on_comment3')->nullable();

            $table->text('rejected_on_comment')->nullable();
            $table->text('reject_comment_1')->nullable();
            $table->text('reject_comment_2')->nullable();
            
            
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
            $table->dropColumn(['audit_schedule_on_comment', 'audit_preparation_completed_on_comment', 'audit_mgr_more_info_reqd_on_comment','audit_observation_submitted_on_comment','audit_lead_more_info_reqd_on_comment','cancelled_on_comment','cancelled_on_comment1','cancelled_on_comment2','cancelled_on_comment3','reject_comment_2','reject_comment_1','rejected_on_comment']);
        });
    }
};
