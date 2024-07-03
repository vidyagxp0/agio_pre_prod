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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('assigned_to')->nullable();
            $table->string('start_date')->nullable();
            $table->string('joining_date')->nullable();
            $table->string('employee_id')->nullable();
            // $table->string('employee_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('department')->nullable();
            $table->string('job_title')->nullable();
            $table->longText('attached_cv')->nullable();
            $table->longText('certification')->nullable();
            $table->string('zone')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('site_name')->nullable();
            $table->string('building')->nullable();
            $table->string('floor')->nullable();
            $table->string('room')->nullable();
            $table->longText('picture')->nullable();
            $table->longText('specimen_signature')->nullable();
            $table->string('hod')->nullable();
            $table->string('designee')->nullable();
            $table->longText('comment')->nullable();
            $table->longText('file_attachment')->nullable();

            $table->string('external_comment')->nullable();
            $table->longText('external_attachment')->nullable();

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
        Schema::dropIfExists('employees');
    }
};
