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
        Schema::table('change_proposal_justs', function (Blueprint $table) {
            $table->string('more_info_by_qa_head_review')->nullable();
            $table->string('more_info_qa_head_review_on')->nullable();
            $table->string('more_info_qa_head_comment')->nullable();
            $table->string('more_info_review_by')->nullable();
            $table->string('more_info_review_on')->nullable();
            $table->string('more_info_review_comment')->nullable();
            $table->string('more_info_by_qa_review')->nullable();
            $table->string('more_info_qa_review_on')->nullable();
            $table->string('more_info_qa_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('change_proposal_justs', function (Blueprint $table) {
            //
        });
    }
};
