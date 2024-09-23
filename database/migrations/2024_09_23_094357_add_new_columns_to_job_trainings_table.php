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
        Schema::table('job_trainings', function (Blueprint $table) {
            $table->string('delegate')->nullable();
            $table->longText('evaluation_comment')->nullable();
            $table->longText('final_review_comment')->nullable();
            $table->longText('qa_cqa_head_comment')->nullable();
            $table->longText('qa_cqa_comment')->nullable();
            $table->longText('qa_review')->nullable();
            $table->longText('evaluation_attachment')->nullable();
            $table->longText('final_review_attachment')->nullable();
            $table->longText('qa_cqa_head_attachment')->nullable();
            $table->longText('qa_cqa_attachment')->nullable();
            $table->longText('qa_review_attachment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_trainings', function (Blueprint $table) {
            //
        });
    }
};
