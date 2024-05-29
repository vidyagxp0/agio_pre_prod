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
            $table->integer('stage')->nullable();
            $table->string('status')->nullable();
            $table->string('sbmitted_by')->nullable();
            $table->string('sbmitted_on')->nullable();
            $table->string('sbmitted_comment')->nullable();
            $table->string('qualified_by')->nullable();
            $table->string('qualified_on')->nullable();
            $table->string('qualified_comment')->nullable();
            $table->string('rejected_by')->nullable();
            $table->string('rejected_on')->nullable();
            $table->string('rejected_comment')->nullable();
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
