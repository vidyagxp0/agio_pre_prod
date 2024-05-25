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
        Schema::table('ootcs', function (Blueprint $table) {
            $table->string('action_taken_result')->nullable();
            $table->string('retraining_to_analyst_required')->nullable();
            $table->string('cheklist_part_b_remarks')->nullable();
            $table->string('analysis_on_same_sample')->nullable();
            $table->string('any_other_action')->nullable();
            $table->string('re_analysis_result')->nullable();
            $table->string('reanalysis_result_oot')->nullable();
            $table->string('part_b_comments')->nullable();
            $table->string('supporting_attechment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ootcs', function (Blueprint $table) { 
            $table->dropColumn('action_taken_result')->nullable();
            $table->dropColumn('retraining_to_analyst_required')->nullable();
            $table->dropColumn('cheklist_part_b_remarks')->nullable();
            $table->dropColumn('analysis_on_same_sample')->nullable();
            $table->dropColumn('any_other_action')->nullable();
            $table->dropColumn('re_analysis_result')->nullable();
            $table->dropColumn('reanalysis_result_oot')->nullable();
            $table->dropColumn('part_b_comments')->nullable();
            $table->dropColumn('supporting_attechment')->nullable();
        });
    }
};
