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
        Schema::table('lab_incidents', function (Blueprint $table) {
            $table->longText('QA_initial_Comments')->nullable();
            $table->longText('pending_update_Comments')->nullable();
            $table->longText('QC_head_hod_secondry_Comments')->nullable();
            $table->longText('QA_secondry_Comments')->nullable();
            $table->longText('QA_Initial_Attachment')->nullable();
            $table->longText('pending_update_Attachment')->nullable();
            $table->longText('QC_headhod_secondery_Attachment')->nullable();
            $table->longText('QA_secondery_Attachment')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lab_incidents', function (Blueprint $table) {
            
        });
    }
};
