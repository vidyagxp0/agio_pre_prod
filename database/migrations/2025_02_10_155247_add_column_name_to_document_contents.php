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
            $table->Text('generic_pvir')->nullable();
            $table->Text('pvir_product_code')->nullable();
            $table->Text('pvir_std_batch')->nullable();
            $table->Text('pvir_category')->nullable();
            $table->Text('pvir_label_claim')->nullable();
            $table->Text('pvir_market')->nullable();
            $table->Text('pvir_shelf_life')->nullable();
            $table->Text('pvir_bmr_no')->nullable();
            $table->Text('pvir_mfr_no')->nullable();
            $table->longtext('critical_pvir')->nullable();
            $table->longtext('In_process_data_pvir')->nullable();
            $table->longtext('various_stages_pvir')->nullable();
            $table->longtext('deviation_pvir')->nullable();
            $table->longtext('change_controlpvir')->nullable();
            $table->longtext('Summary_pvir')->nullable();
            $table->longtext('conclusion_pvir')->nullable();
            $table->longtext('report_approvalpvir')->nullable();

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
