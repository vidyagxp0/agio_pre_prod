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
        Schema::table('trainer_qualifications', function (Blueprint $table) {
            $table->text('update_complete_by')->nullable();
            $table->text('update_complete_on')->nullable();
            $table->text('update_complete_comment')->nullable();

            $table->text('answer_complete_by')->nullable();
            $table->text('answer_complete_on')->nullable();
            $table->text('answer_complete_comment')->nullable();

            $table->text('evaluation_complete_by')->nullable();
            $table->text('evaluation_complete_on')->nullable();
            $table->text('evaluation_complete_comment')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainer_qualifications', function (Blueprint $table) {
            //
        });
    }
};
