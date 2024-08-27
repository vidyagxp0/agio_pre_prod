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
            $table->text('ProductionLiquid_assessment')->nullable()->after('ProductionLiquid_by');


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
            $table->dropColumn('ProductionLiquid_assessment')->nullable();

        });
    }
};
