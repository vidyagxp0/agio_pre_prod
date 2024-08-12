auditSheChecklist_comment_main<?php

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
        Schema::table('internal_audits', function (Blueprint $table) {
            $table->text('sheduled_audit_comment')->nullable();
            $table->text('cancel_1_comment')->nullable();
            $table->text('more_info_1_comment')->nullable();
            $table->text('acknowledge_commnet')->nullable();
            $table->text('cancel_2_comment')->nullable();
            $table->text('more_info_2_comment')->nullable();
            $table->text('issue_report_comment')->nullable();
            $table->text('cancel_3_comment')->nullable();
            $table->text('more_info_3_comment')->nullable();
            $table->text('capa_plan_comment')->nullable();
            $table->text('no_capa_plan_required_comment')->nullable();
            $table->text('response_reviewd_comment')->nullable();
            $table->text('more_info_2_by')->nullable();
            $table->text('more_info_2_on')->nullable();
            $table->text('more_info_3_by')->nullable();
            $table->text('more_info_3_on')->nullable();
            $table->text('cancelled_1_by')->nullable();
            $table->text('cancelled_1_on')->nullable();  
            $table->text('cancelled_2_by')->nullable();
            $table->text('cancelled_2_on')->nullable();
            $table->text('no_capa_plan_by')->nullable();
            $table->text('no_capa_plan_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('internal_audits', function (Blueprint $table) {
            //
        });
    }
};
