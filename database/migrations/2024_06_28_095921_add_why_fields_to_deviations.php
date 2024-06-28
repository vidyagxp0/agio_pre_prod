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
        Schema::table('deviations', function (Blueprint $table) {
            $table->integer('days')->nullable();
            $table->longText('how_much')->nullable();
            $table->longText('how')->nullable();
            $table->longText('who')->nullable();
            $table->longText('when_when')->nullable();
            $table->longText('where_where')->nullable();
	        $table->longText('why_why')->nullable();
            $table->longText('what')->nullable();
            $table->integer('Hod_person_to')->nullable();
            $table->integer('Approver_to')->nullable();
            $table->longText('CancellationQA')->nullable();
            $table->longText('Detail_Of_Root_Cause')->nullable();
            $table->integer('Reviewer_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deviations', function (Blueprint $table) {
            //
        });
    }
};
