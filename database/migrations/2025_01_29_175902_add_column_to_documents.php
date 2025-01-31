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
            $table->longText('generic_name')->nullable(); // Generic Name
            $table->longText('brand_name')->nullable(); // Brand Name
            $table->longText('label_claim')->nullable(); // Label Claim
            $table->longText('product_code')->nullable(); // Product Code
            $table->longText('storage_condition')->nullable(); // Storage Condition
            $table->longText('sample_quantity')->nullable(); // Sample Quantity for Analysis
            $table->longText('reserve_sample')->nullable(); // Reserve Sample Quantity
            $table->longText('custom_sample')->nullable(); // Custom Sample
            $table->longText('reference')->nullable(); // Reference
            $table->longText('sampling_instructions')->nullable();
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
