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
            $table->string('ProductionLiquid_attachment')->nullable();
            $table->string('Microbiology_attachment')->nullable();
            $table->string('ContractGiver_attachment')->nullable();
            $table->string('Store_attachment')->nullable();
            $table->string('ResearchDevelopment_attachment')->nullable();
            $table->string('RegulatoryAffair_attachment')->nullable();
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
