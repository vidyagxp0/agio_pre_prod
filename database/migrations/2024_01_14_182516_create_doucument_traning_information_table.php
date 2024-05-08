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
        Schema::create('doucument_traning_information', function (Blueprint $table) {
            $table->id();
           // $table->string('is_training')->nullable();
            $table->string('originator_id')->nullable();
            $table->string('division_id')->nullable();
            $table->string('process_id')->nullable();
            //$table->string('training_required')->nullable();
            $table->string('trainer')->nullable();
            $table->string('test')->nullable();
            $table->string('reporting')->nullable();

        //    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doucument_traning_information');
    }
};
