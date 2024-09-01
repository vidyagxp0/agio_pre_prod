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
            $table->text('store_attachment')->nullable();
            $table->text('RegulatoryAffair_attechment')->nullable();
            $table->text('ProductionLiquid_attachment')->nullable();
            $table->text('ContractGiver_attachment')->nullable();

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
