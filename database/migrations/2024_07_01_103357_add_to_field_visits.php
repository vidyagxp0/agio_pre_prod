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
        Schema::table('field_visits', function (Blueprint $table) {
            $table->text('stage')->nullable();
            $table->text('status')->nullable();
            $table->text('submit_by')->nullable();
            $table->text('submit_on')->nullable();
            $table->longText('submit_comment')->nullable();
            $table->text('pending_review_by')->nullable();
            $table->text('pending_review_on')->nullable();
            $table->longText('pending_review_comment')->nullable();
            $table->text('review_completed_by')->nullable();
            $table->text('review_completed_on')->nullable();
            $table->longText('review_completed_comment')->nullable();
            $table->text('review_completed_more_info_by')->nullable();
            $table->text('review_completed_more_info_on')->nullable();
            $table->longText('review_completed_more_info_comment')->nullable();
            $table->text('close_cancel_by')->nullable();
            $table->text('close_cancel_on')->nullable();
            $table->longText('close_cancel_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('field_visits', function (Blueprint $table) {
            //
        });
    }
};
