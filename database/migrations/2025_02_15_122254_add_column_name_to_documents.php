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
            $table->longtext('product_name_rawmstp')->nullable();
            $table->longtext('rawmaterials_testing')->nullable();
            $table->longtext('packingmaterial_specification')->nullable();
            $table->longtext('master_specification')->nullable();
            $table->longtext('mfpstp_specification')->nullable();
            $table->longtext('product_name_mstp')->nullable();
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
