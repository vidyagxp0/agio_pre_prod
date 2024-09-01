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
        Schema::table('out_of_calibrations', function (Blueprint $table) {
            $table->text('new_stage_reject_P_II_A_QAH_CQAH_Review_by')->nullable();
            $table->text('new_stage_reject_P_II_A_QAH_CQAH_Review_on')->nullable();
            $table->text('new_stage_reject_P_II_A_QAH_CQAH_Review_comment')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_B_Investigation_by')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_B_Investigation_on')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_B_Investigation_comment')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_B_HOD_Primary_Review_by')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_B_HOD_Primary_Review_on')->nullable();
            $table->text('new_stage_rejectUnder_Phase_II_B_HOD_Primary_Review_comment')->nullable();
            


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('out_of_calibrations', function (Blueprint $table) {
            //
        });
    }
};
