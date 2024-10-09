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
        Schema::create('emp_training_quiz_results', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id'); // Assuming you want to track results by user
            $table->unsignedBigInteger('training_id'); // Assuming you want to track results by user
            $table->string('employee_name'); // Pass or Fail
            $table->string('training_type'); // Pass or Fail
            $table->integer('correct_answers'); // Number of correct answers
            $table->integer('incorrect_answers'); // Number of correct answers
            $table->integer('total_questions'); // Total questions attempted
            $table->string('score'); // Calculated score
            $table->string('result'); // Pass or Fail
            $table->integer('attempt_number'); // Pass or Fail
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp_training_quiz_results');
    }
};
