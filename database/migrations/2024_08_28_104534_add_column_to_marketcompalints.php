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
        Schema::table('marketcompalints', function (Blueprint $table) {
            $table->text('complete_review_Comments')->nullable();
            $table->text('send_cft_by')->nullable();
            $table->text('send_cft_on')->nullable();
            $table->text('send_cft_comment')->nullable();
            $table->text('cft_rev_comp_by')->nullable();
            $table->text('cft_rev_comp_on')->nullable();
            $table->text('cft_rev_comp_comment')->nullable();
            $table->text('qa_cqa_verif_comp_by')->nullable();
            $table->text('qa_cqa_verif_comp_on')->nullable();
            $table->text('QA_cqa_verif_Comments')->nullable();
            $table->text('approve_Comments')->nullable();
            $table->text('send_letter_by')->nullable();
            $table->text('send_letter_on')->nullable();
            $table->text('send_letter_comment')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketcompalints', function (Blueprint $table) {
            //
        });
    }
};
