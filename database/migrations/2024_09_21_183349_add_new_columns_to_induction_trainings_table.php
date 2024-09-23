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
        Schema::table('induction_trainings', function (Blueprint $table) {
            $table->longText('evaluation_comment')->nullable();
            $table->longText('hr_head_comment')->nullable();
            $table->longText('qa_final_comment')->nullable();
            $table->longText('hr_final_comment')->nullable();
            $table->longText('evaluation_attachment')->nullable();
            $table->longText('hr_head_attachment')->nullable();
            $table->longText('qa_final_attachment')->nullable();
            $table->longText('hr_final_attachment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('induction_trainings', function (Blueprint $table) {
            //
        });
    }
};
