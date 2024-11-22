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
        Schema::table('trainer_qualifications', function (Blueprint $table) {
            
            $table->longText('description')->nullable();
            $table->longText('trainer_acknowledge_comment')->nullable();
            $table->longText('trainer_acknowledge_attachments')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->longText('start_time')->nullable();
            $table->longText('end_time')->nullable();
            $table->longText('pending_training_comment')->nullable();
            $table->longText('pending_training_attachments')->nullable();
            $table->longText('evaluation_by_hod')->nullable();
            $table->longText('evaluation_criteria_hod')->nullable();
            $table->longText('evaluation_by_qa')->nullable();
            $table->longText('evaluation_criteria_qa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainer_qualifications', function (Blueprint $table) {
            //
        });
    }
};
