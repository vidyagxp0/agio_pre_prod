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
            $table->longText('ForComANiGasProtocolfile_attach')->nullable();
            $table->longText('PacValRepfile_attach')->nullable();
            $table->longText('HolTimSutRepfile_attach')->nullable();
            $table->longText('TemMapProCumRepfile_attach')->nullable();
            $table->longText('billMatrial')->nullable();
            $table->longText('batchManufacturingBmr')->nullable();
            $table->longText('MasterFormulaRecordBMR')->nullable();
            $table->longText('MasterPackingRecord')->nullable();
            $table->longText('SiteMasterFileatt')->nullable();
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
