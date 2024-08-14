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
        Schema::table('market_complaint_cfts', function (Blueprint $table) {
            $table->text('Store_Review')->nullable();
            $table->text('Store_person')->nullable();
            $table->text('Store_assessment')->nullable();
            $table->text('Store_feedback')->nullable();
            $table->text('Store_by')->nullable();
            $table->text('Store_on')->nullable();
            $table->text('ResearchDevelopment_attachment')->nullable();
            $table->text('CorporateQualityAssurance_attachment')->nullable();
            $table->text('Microbiology_attachment')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('market_complaint_cfts', function (Blueprint $table) {
            //
        });
    }
};
