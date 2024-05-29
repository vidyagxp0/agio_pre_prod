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
        Schema::create('induction_trainings', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->nullable();
            $table->string('name_employee')->nullable();
            $table->string('department_location')->nullable();
            $table->string('designation')->nullable();
            $table->string('qualification')->nullable();
            $table->string('experience_if_any')->nullable();
            $table->date('date_joining')->nullable();

            for ($i = 1; $i <= 16; $i++) {
                $table->string("document_number_$i")->nullable();
                $table->date("training_date_$i")->nullable();
                $table->text("remark_$i")->nullable();
            }
            
            // Document Details
            $table->string('trainee_name')->nullable();
            $table->string('hr_name')->nullable();

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
        Schema::dropIfExists('induction_trainings');
    }
};
