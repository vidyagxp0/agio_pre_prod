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
        Schema::table('job_descriptions', function (Blueprint $table) {
            $table->longText('qa_review')->nullable();
            $table->longText('qa_review_attachment')->nullable();
            $table->longText('qa_cqa_comment')->nullable();
            $table->longText('qa_cqa_attachment')->nullable();
            $table->longText('responsible_person_comment')->nullable();
            $table->longText('responsible_person_attachment')->nullable();
            $table->longText('respected_department_comment')->nullable();
            $table->longText('respected_department_attachment')->nullable();
            $table->longText('final_review_comment')->nullable();
            $table->longText('final_review_attachment')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_descriptions', function (Blueprint $table) {
            //
        });
    }
};
