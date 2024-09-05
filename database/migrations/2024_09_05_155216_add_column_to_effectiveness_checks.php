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
        Schema::table('effectiveness_checks', function (Blueprint $table) {
            $table->text('acknowledge_comment')->nullable();
            $table->longText('acknowledge_Attachment')->nullable();
            $table->text('qa_cqa_approval_comment')->nullable();
            $table->longText('qa_cqa_approval_Attachment')->nullable();
            $table->text('qa_cqa_review_comment')->nullable();
            $table->longText('qa_cqa_review_Attachment')->nullable();
            $table->text('more_info_effective_by')->nullable();
            $table->text('more_info_effective_on')->nullable();
            $table->longText('more_info_effective_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('effectiveness_checks', function (Blueprint $table) {
            //
        });
    }
};
