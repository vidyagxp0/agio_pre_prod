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
            $table->Text('generic_name_cvs')->nullable();
            $table->Text('brand_name_cvs')->nullable();
            $table->Text('label_claim_cvs')->nullable();
            $table->Text('product_code_cvs')->nullable();
            $table->Text('storage_condition_cvs')->nullable();
            $table->Text('sample_quantity_cvs')->nullable();
            $table->Text('reserve_sample_cvs')->nullable();
            $table->Text('custom_sample_cvs')->nullable();
            $table->Text('reference_cvs')->nullable();
            $table->Text('sampling_instructions_cvs')->nullable();
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
