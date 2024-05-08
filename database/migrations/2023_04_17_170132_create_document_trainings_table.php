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
        Schema::create('document_trainings', function (Blueprint $table) {
            $table->id();
            $table->integer('document_id');
            $table->string('trainer');
            $table->string('cbt')->nullable();
            $table->string('type')->nullable();
            $table->longtext('comments')->nullable();
            $table->string('status')->default('Past-due');
            $table->string('training_plan')->nullable();
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
        Schema::dropIfExists('document_trainings');
    }
};
