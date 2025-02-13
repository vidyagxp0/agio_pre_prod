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
            $table->longtext('product_name_fpstp')->nullable();
            $table->longtext('fpstp_testfield')->nullable();
            $table->longtext('product_name_ipstp')->nullable();
            $table->longtext('ipstp_testfield')->nullable();
            $table->longtext('product_name_cvstp')->nullable();
            $table->longtext('cvstp_testfield')->nullable();

            $table->longtext('product_name_rawmstp')->nullable();
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
        Schema::table('document_contents', function (Blueprint $table) {
            //
        });
    }
};
