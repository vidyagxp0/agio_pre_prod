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
            //

            $table->text('submit_by')->nullable();
            $table->text('submit_on')->nullable();
            $table->text('submit_comment')->nullable();

            $table->text('accept_JD_Complete_by')->nullable();
            $table->text('accept_JD_Complete_on')->nullable();
            $table->text('accept_JD_Complete_comment')->nullable();

            $table->text('accept_by')->nullable();
            $table->text('accept_on')->nullable();
            $table->text('accept_comment')->nullable();

            $table->text('approval_Complete_by')->nullable();
            $table->text('approval_Complete_on')->nullable();
            $table->text('approval_Complete_comment')->nullable();

            $table->text('send_to_QA_by')->nullable();
            $table->text('send_to_QA_on')->nullable();
            $table->text('send_to_QA_comment')->nullable();

            $table->text('closure_by')->nullable();
            $table->text('closure_on')->nullable();
            $table->text('closure_comment')->nullable();

            
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
