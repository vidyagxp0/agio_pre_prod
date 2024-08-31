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
        Schema::table('cc_cfts', function (Blueprint $table) {
            $table->text('hod_assessment_comments')->nullable();
            $table->text('hod_assessment_attachment')->nullable();
            $table->text('hod_final_review_comment')->nullable();
            $table->text('hod_final_review_attach')->nullable();
            $table->text('qa_cqa_comments')->nullable();
            $table->text('qa_cqa_attach')->nullable();
            $table->text('intial_update_comments')->nullable();
            $table->text('intial_update_attach')->nullable();
            $table->text('implementation_verification_comments')->nullable();
            $table->text('implementation_verification_attachment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cc_cfts', function (Blueprint $table) {
            //
        });
    }
};
