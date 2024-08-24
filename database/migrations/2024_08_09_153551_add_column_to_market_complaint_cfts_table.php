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
            $table->text('ProductionLiquid_Review')->nullable()->after('ContractGiver_on');
            $table->text('ProductionLiquid_person')->nullable()->after('ProductionLiquid_Review');
            $table->text('ProductionLiquid_feedback')->nullable()->after('ProductionLiquid_person');
            $table->text('ProductionLiquid_by')->nullable()->after('ProductionLiquid_feedback');
            $table->text('ProductionLiquid_on')->nullable()->after('ProductionLiquid_by');

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
