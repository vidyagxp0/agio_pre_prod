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
        Schema::create('job_trainings', function (Blueprint $table) {
            $table->id();
           
                $table->string('name')->nullable();
                $table->string('department')->nullable();
                $table->string('location')->nullable();
                $table->string('hod')->nullable();

                // $table->date('startdate')->nullable();
                // $table->date('enddate')->nullable();
    
    
    
                for($i=1; $i<=5 ; $i++)
               {
               
                $table->longText("subject_$i")->nullable();
                $table->longText("type_of_training_$i")->nullable();
                $table->longText("reference_document_no_$i")->nullable();
                $table->longText("trainee_name_$i")->nullable();
                $table->longText("trainer_$i")->nullable();

                $table->date("startdate_$i")->nullable();
                $table->date("enddate_$i")->nullable();
    
               }
    
             
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
        Schema::dropIfExists('job_trainings');
    }
};
