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
            $table->longText('employee_id')->nullable();
            $table->longText('employee_name')->nullable();
            $table->date('training_date')->nullable();
            $table->longText('topic')->nullable();
            $table->longText('type')->nullable();
            $table->longText('evaluation')->nullable();
            $table->longText('hod_comment')->nullable();
            $table->longText('hod_attachment')->nullable();
            $table->longText('qa_final_comment')->nullable();
            $table->longText('qa_final_attachment')->nullable();

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
