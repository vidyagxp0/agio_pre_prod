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
        Schema::create('induction_training_document_numbers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('employee_id');
            $table->string('employee_name')->nullable();
            $table->string('employee_code')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->string('job_role')->nullable();
            $table->string('joining_date')->nullable();
            $table->string('document_number')->nullable();
            $table->string('document_title')->nullable();
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('induction_trainings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('induction_training_document_numbers');
    }
};
