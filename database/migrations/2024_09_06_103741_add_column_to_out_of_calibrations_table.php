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
        Schema::table('out_of_calibrations', function (Blueprint $table) {
            $table->text('initial_attachment_qahead_ooc')->nullable();
            $table->text('qaheadremarks')->nullable();
            $table->text('phase_IA_HODREMARKS')->nullable();
            $table->text('attachments_hodIAHODPRIMARYREVIEW_ooc')->nullable();
            $table->text('qaHremarksnewfield')->nullable();
            $table->text('initial_attachment_qah_post_ooc')->nullable();
            $table->text('attachments_hodIBBBHODPRIMARYREVIEW_ooc')->nullable();
            $table->text('phase_IB_HODREMARKS')->nullable();
            $table->text('attachments_QAIBBBREVIEW_ooc')->nullable();
            $table->text('phase_IB_qareviewREMARKS')->nullable();
            $table->text('qPIBaHremarksnewfield')->nullable();
            $table->text('Pib_attachements')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('out_of_calibrations', function (Blueprint $table) {
            //
        });
    }
};
