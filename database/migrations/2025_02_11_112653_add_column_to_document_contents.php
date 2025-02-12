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
            $table->String('product_name_ssp')->nullable();
            $table->String('protocol_no_ssp')->nullable();
            $table->String('brand_name_ssp')->nullable();
            $table->String('generic_name_ssp')->nullable();
            $table->String('label_claim_ssp')->nullable();

            $table->String('fg_code_ssp')->nullable();
            $table->String('pack_size_ssp')->nullable();
            $table->String('shelf_life_ssp')->nullable();
            $table->String('market_ssp')->nullable();
            $table->String('storage_condition_ssp')->nullable();

            $table->String('purpose_ssp')->nullable();
            $table->String('specify_ssp')->nullable();
            $table->String('scope_ssp')->nullable();
            $table->Text('documentrefrence_ssp')->nullable();
            $table->String('reason_stability_ssp')->nullable();
            $table->Text('remark_if_any_ssp')->nullable();
            $table->Text('stability_data_ssp')->nullable();
            $table->Text('general_inst_ssp')->nullable();

            $table->String('stability_proto_ssp')->nullable();
            $table->String('proto_no_ssp')->nullable();
            $table->String('product_ssp')->nullable();
            $table->String('batchnumber_ssp')->nullable();
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
