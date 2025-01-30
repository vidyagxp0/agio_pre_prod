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
            $table->longText('cas_no_row_material')->nullable();
            $table->longText('molecular_formula_row_material')->nullable();
            $table->longText('molecular_weight_row_material')->nullable();
            $table->longText('storage_condition_row_material')->nullable();
            $table->longText('retest_period_row_material')->nullable();
            $table->longText('sampling_procedure_row_material')->nullable();
            $table->longText('item_code_row_material')->nullable();
            $table->longText('sample_quantity_row_material')->nullable();
            $table->longText('reserve_sample_quantity_row_material')->nullable();
            $table->longText('retest_sample_quantity_row_material')->nullable();
            $table->longText('sampling_instructions_row_material')->nullable();
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
