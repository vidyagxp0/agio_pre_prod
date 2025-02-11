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
        Schema::table('document_contents', function (Blueprint $table) {
            $table->longtext('pvir_dosage_form')->nullable();
            $table->longtext('pvir_process_validation_interim_report')->nullable();
            $table->longtext('pvir_product_name')->nullable();
            $table->longtext('pvir_report_no')->nullable();
            $table->longtext('pvir_batch_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_contents', function (Blueprint $table) {
            //
        });
    }
};
