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
                $table->text('QualificationProtocol_data_filed')->nullable();
                $table->text('QualificationReport_data_filed')->nullable();
                $table->text('Otherdata_data_filed')->nullable();
                $table->text('compressed_air_sys_protocol')->nullable();
                $table->text('compressed_air_sys_report')->nullable();
                $table->text('new_attachment_data_filed')->nullable();
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
