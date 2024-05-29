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
            $table->string('Conclusion')->nullable();
            $table->string('Identified_Risk')->nullable();
            $table->string('severity_rate')->nullable();
            $table->string('Occurrence')->nullable();
            $table->string('detection')->nullable();
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
            $table->dropColumn('Conclusion');
            $table->dropColumn('Identified_Risk');
            $table->dropColumn('severity_rate');
            $table->dropColumn('Occurrence');
            $table->dropColumn('detection');
        });
    }
};
