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
        Schema::table('job_trainings', function (Blueprint $table) {
            $table->string('name_employee')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('new_department')->nullable();
            $table->string('designation')->nullable();
            $table->string('qualification')->nullable();
            $table->string('experience_if_any')->nullable();
            $table->string('date_joining')->nullable();
            $table->string('revision_purpose')->nullable();
            $table->string('experience_with_agio')->nullable();
            $table->string('evaluation_required')->nullable();
            $table->string('total_experience')->nullable();
            $table->string('job_description_no')->nullable();
            $table->string('effective_date')->nullable();
            $table->string('reason_for_revision')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_trainings', function (Blueprint $table) {
            //
        });
    }
};
