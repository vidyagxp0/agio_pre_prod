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
            $table->longtext('pvpattachement')->nullable();
            $table->longtext('htspattachement')->nullable();
            $table->longtext('afqpattachement')->nullable();
            $table->longtext('afqrattachement')->nullable();
            $table->longtext('afursattachement')->nullable();
            $table->longtext('aqpattachement')->nullable();
            $table->longtext('aqrattachement')->nullable();
            $table->longtext('pfmfattachement')->nullable();
            $table->longtext('rfmfattachement')->nullable();
            $table->longtext('annex_XVI_per_qualif_attachment')->nullable();
            $table->longtext('annex_XVII_valid_summ_attachment')->nullable();
            $table->longtext('annex_XVIII_trac_matri_attachment')->nullable();
            $table->longtext('annex_XIX_syst_retir_attachment')->nullable();
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
