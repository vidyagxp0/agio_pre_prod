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
        Schema::table('action_items', function (Blueprint $table) {
            $table->text('qa_varification_by')->nullable();
            $table->text('qa_varification_on')->nullable();
            $table->text('qa_varification_comment')->nullable();
            $table->text('more_Acknowledgement_by')->nullable();
            $table->text('more_Acknowledgement_on')->nullable();
            $table->text('more_Acknowledgement_comment')->nullable();
            $table->text('more_work_completion_by')->nullable();
            $table->text('more_work_completion_on')->nullable();
            $table->text('more_work_completion_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_items', function (Blueprint $table) {
            //
        });
    }
};
