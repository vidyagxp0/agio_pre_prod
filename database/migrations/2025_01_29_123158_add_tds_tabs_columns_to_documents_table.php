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
        Schema::table('documents', function (Blueprint $table) {
            $table->longText('product_material_name')->nullable();
            $table->longText('tds_no')->nullable();
            $table->longText('Reference_Standard')->nullable();
            $table->longText('batch_no')->nullable();
            $table->longText('ar_no')->nullable();
            $table->longText('mfg_date')->nullable();
            $table->longText('exp_date')->nullable();
            $table->longText('analysis_start_date')->nullable();
            $table->longText('analysis_completion_date')->nullable();
            $table->longText('specification_no')->nullable();
            $table->longText('tds_remark')->nullable();
            $table->longText('name_of_material_sample')->nullable();
            $table->longText('sample_reconcilation_batchNo')->nullable();
            $table->longText('sample_reconcilation_arNo')->nullable();
            $table->longText('sample_quatity_received')->nullable();
            $table->longText('total_quantity_consumed')->nullable();
            $table->longText('balance_quantity')->nullable();
            $table->longText('balance_quantity_destructed')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            //
        });
    }
};
