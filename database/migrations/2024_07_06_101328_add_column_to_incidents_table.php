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
        Schema::table('incidents', function (Blueprint $table) {
            $table->text('equipment_name')->nullabe();
            $table->text('product_quality_imapct')->nullable();
            $table->text('process_performance_impact')->nullable();
            $table->text('yield_impact')->nullable();
            $table->text('gmp_impact')->nullable();
            $table->text('additionl_testing_required')->nullable();
            $table->text('any_similar_incident_in_past')->nullable();
            $table->text('classification_by_qa')->nullable();
            $table->text('capa_require')->nullable();
            $table->text('deviation_required')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incidents', function (Blueprint $table) {
            $table->dropColumn('equipment_name')->nullabe();
            $table->dropColumn('instrument name')->nullable();
            $table->dropColumn('facility name')->nullable();
            $table->dropColumn('product_quality_imapct')->nullable();
            $table->dropColumn('process_performance_impact')->nullable();
            $table->dropColumn('yield_impact')->nullable();
            $table->dropColumn('gmp_impact')->nullable();
            $table->dropColumn('additionl_testing_required')->nullable();
            $table->dropColumn('any_similar_incident_in_past')->nullable();
            $table->dropColumn('classification_by_qa')->nullable();
            $table->dropColumn('capa_required')->nullable();
            $table->dropColumn('deviation_required')->nullable();
        });
    }
};
