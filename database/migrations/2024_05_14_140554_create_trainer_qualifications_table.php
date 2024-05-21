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
        Schema::create('trainer_qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('record_number')->nullable();
            $table->string('site_code')->nullable();
            $table->string('initiator')->nullable();
            $table->string('date_of_initiation')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('due_date')->nullable();
            $table->longText('short_description')->nullable();
            $table->string('trainer_name')->nullable();
            $table->string('qualification')->nullable();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('experience')->nullable();
            $table->string('external_agencies')->nullable();
            $table->string('trainer')->nullable();
            $table->string('evaluation_criteria_1')->nullable();
            $table->string('evaluation_criteria_2')->nullable();
            $table->string('evaluation_criteria_3')->nullable();
            $table->string('evaluation_criteria_4')->nullable();
            $table->string('evaluation_criteria_5')->nullable();
            $table->string('evaluation_criteria_6')->nullable();
            $table->string('evaluation_criteria_7')->nullable();
            $table->string('evaluation_criteria_8')->nullable();
            $table->longText('qualification_comments')->nullable();
            $table->longText('initial_attachment')->nullable();
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
        Schema::dropIfExists('trainer_qualifications');
    }
};
