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
        Schema::table('trainings', function (Blueprint $table) {
            $table->longText('training_attachment')->nullable();
            $table->longText('classRoom_training')->nullable();
            $table->longText('assessment_required')->nullable();
            $table->longText('training_end_date')->nullable();
            $table->longText('training_start_date')->nullable();
            $table->longText('desc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_contents', function (Blueprint $table) {
            Schema::dropIfExists('training_attachment');
            Schema::dropIfExists('classRoom_training');
            Schema::dropIfExists('assessment_required');
            Schema::dropIfExists('training_end_date');
            Schema::dropIfExists('training_start_date');
            Schema::dropIfExists('desc');
        });

    }
};
