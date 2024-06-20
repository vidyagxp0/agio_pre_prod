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
        Schema::table('c_c_s', function (Blueprint $table) {
            $table->string('hod_to_initiator_by')->nullable();
            $table->string('hod_to_initiator_on')->nullable();
            $table->string('hod_to_initiator_comment')->nullable();

            $table->string('QA_initialTo_HOD_by')->nullable();
            $table->string('QA_initialTo_HOD_on')->nullable();
            $table->string('QA_initialTo_HOD_comment')->nullable();

            $table->string('cft_to_qaInitial_by')->nullable();
            $table->string('cft_to_qaInitial_on')->nullable();
            $table->string('cft_to_qaInitial_comment')->nullable();

            $table->string('qa_final_to_initiator_by')->nullable();
            $table->string('qa_final_to_initiator_on')->nullable();
            $table->string('qa_final_to_initiator_comment')->nullable();

            $table->string('qa_final_to_HOD_by')->nullable();
            $table->string('qa_final_to_HOD_on')->nullable();
            $table->string('qa_final_to_HOD_comment')->nullable();

            $table->string('qa_final_to_qainital_by')->nullable();
            $table->string('qa_final_to_qainital_on')->nullable();
            $table->string('qa_final_to_qainital_comment')->nullable();

            $table->string('qa_head_to_qaFinal_by')->nullable();
            $table->string('qa_head_to_qaFinal_on')->nullable();
            $table->string('qa_head_to_qaFinal_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('c_c_s', function (Blueprint $table) {
            //
        });
    }
};
