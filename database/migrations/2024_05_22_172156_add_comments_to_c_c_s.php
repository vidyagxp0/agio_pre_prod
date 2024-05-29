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
        Schema::table('c_c_s', function (Blueprint $table) {
            $table->text('submit_by')->nullable()->after('other_comment');
            $table->text('submit_on')->nullable()->after('submit_by');
            $table->longText('submit_comment')->nullable()->after('submit_on');

            $table->text('hod_review_by')->nullable()->after('submit_comment');
            $table->text('hod_review_on')->nullable()->after('hod_review_by');
            $table->longText('hod_review_comment')->nullable()->after('hod_review_on');

            $table->text('QA_initial_review_by')->nullable()->after('hod_review_comment');
            $table->text('QA_initial_review_on')->nullable()->after('QA_initial_review_by');
            $table->longText('QA_initial_review_comment')->nullable()->after('QA_initial_review_on');

            $table->text('pending_RA_review_by')->nullable()->after('QA_initial_review_comment');
            $table->text('pending_RA_review_on')->nullable()->after('pending_RA_review_by');
            $table->longText('pending_RA_review_comment')->nullable()->after('pending_RA_review_on');

            $table->text('cft_review_by')->nullable()->after('pending_RA_review_comment');
            $table->text('cft_review_on')->nullable()->after('cft_review_by');
            $table->longText('cft_review_comment')->nullable()->after('cft_review_on');

            $table->text('QA_final_review_by')->nullable()->after('cft_review_comment');
            $table->text('QA_final_review_on')->nullable()->after('QA_final_review_by');
            $table->longText('QA_final_review_comment')->nullable()->after('QA_final_review_on');

            $table->text('QA_head_approval_by')->nullable()->after('QA_final_review_comment');
            $table->text('QA_head_approval_on')->nullable()->after('QA_head_approval_by');
            $table->longText('QA_head_approval_comment')->nullable()->after('QA_head_approval_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('c_c_s', function (Blueprint $table) {
            //
        });
    }
};
