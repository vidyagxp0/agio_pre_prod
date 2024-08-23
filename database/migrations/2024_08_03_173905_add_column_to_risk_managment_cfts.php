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
            $table->text('ProductionLiquid_Review')->nullable();
            $table->text('ProductionLiquid_person')->nullable();
            $table->text('ProductionLiquid_assessment')->nullable();
            $table->text('ProductionLiquid_feedback')->nullable();
            $table->text('ProductionLiquid_by')->nullable();
            $table->text('ProductionLiquid_on')->nullable();
            $table->text('Store_Review')->nullable();
            $table->text('Store_person')->nullable();
            $table->text('Store_assessment')->nullable();
            $table->text('Store_feedback')->nullable();
            $table->text('Store_by')->nullable();
            $table->text('Store_on')->nullable();
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
            $table->dropColumn('ProductionLiquid_Review')->nullable();
            $table->dropColumn('ProductionLiquid_person')->nullable();
            $table->dropColumn('ProductionLiquid_assessment')->nullable();
            $table->dropColumn('ProductionLiquid_feedback')->nullable();
            $table->dropColumn('ProductionLiquid_by')->nullable();
            $table->dropColumn('ProductionLiquid_on')->nullable();
            $table->dropColumn('Store_Review')->nullable();
            $table->dropColumn('Store_person')->nullable();
            $table->dropColumn('Store_assessment')->nullable();
            $table->dropColumn('Store_feedback')->nullable();
            $table->dropColumn('Store_by')->nullable();
            $table->dropColumn('Store_on')->nullable();
        });
    }
};
