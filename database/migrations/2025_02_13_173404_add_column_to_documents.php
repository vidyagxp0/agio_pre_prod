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
            $table->longText('file_attach')->nullable();
            $table->longText('attach_cvpd')->nullable();
            $table->longText('attachment_srt')->nullable();
            $table->longText('attachment_spt')->nullable();
            $table->longText('attachment_ehtsr')->nullable();
            $table->longText('attachment_ehtsprt')->nullable();
            $table->longText('attach_comp_nitrogen')->nullable();
            $table->longText('file_attach_qm')->nullable();
            $table->longText('file_attach_vmp')->nullable();
            $table->longText('procumrepo_file_attach')->nullable();

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
