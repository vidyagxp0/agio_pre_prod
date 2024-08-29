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
        Schema::table('change_control_comments', function (Blueprint $table) {
            $table->text('initiator_update_complete_by')->nullable();
            $table->text('initiator_update_complete_on')->nullable();
            $table->text('initiator_update_complete_comment')->nullable();

            $table->text('HOD_finalReview_complete_by')->nullable();
            $table->text('HOD_finalReview_complete_on')->nullable();
            $table->text('HOD_finalReview_complete_comment')->nullable();
            $table->text('send_for_final_qa_head_approval_comment')->nullable();
            $table->text('send_for_final_qa_head_approval')->nullable();
            $table->text('send_for_final_qa_head_approval_on')->nullable();

            $table->text('closure_approved_by')->nullable();
            $table->text('closure_approved_on')->nullable();
            $table->text('closure_approved_comment')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('change_control_comments');
    }
};
