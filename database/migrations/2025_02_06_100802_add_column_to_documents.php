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
            $table->Text('generic_name_inps')->nullable();
            $table->Text('brand_name_inps')->nullable();
            $table->Text('label_claim_inps')->nullable();
            $table->Text('product_code_inps')->nullable();
            $table->Text('storage_condition_inps')->nullable();
            $table->Text('sample_quantity_inps')->nullable();
            $table->Text('reserve_sample_inps')->nullable();
            $table->Text('custom_sample_inps')->nullable();
            $table->Text('reference_inps')->nullable();
            $table->Text('sampling_instructions_inps')->nullable();
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
