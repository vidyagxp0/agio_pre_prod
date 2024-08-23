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
        Schema::table('risk_managment_cfts', function (Blueprint $table) {
            $table->text('RA_Review')->nullable();
            $table->text('RA_Comments')->nullable();
            $table->text('RA_person')->nullable();
            $table->text('RA_assessment')->nullable();
            $table->text('RA_feedback')->nullable();
            $table->text('RA_attachment')->nullable();
            $table->text('RA_by')->nullable();
            $table->text('RA_on')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('risk_managment_cfts', function (Blueprint $table) {
            //
        });
    }
};
