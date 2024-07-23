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
        Schema::table('ootcs', function (Blueprint $table) {
            $table->text('delay_justification')->nullable();
            $table->text('oot_observed_on')->nullable();
            $table->text('oot_report_on')->nullable();
            $table->text('immediate_action')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ootcs', function (Blueprint $table) {
            $table->dropColumn('delay_justification')->nullable();
            $table->dropColumn('oot_observed_on')->nullable();
            $table->dropColumn('oot_report_on')->nullable();
            $table->dropColumn('immediate_action')->nullable();
        });
    }
};
