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
        Schema::table('o_o_s', function (Blueprint $table) {
            $table->longtext('specification_details')->nullable();
            $table->longtext('STP_details')->nullable();
            $table->longtext('manufacture_vendor')->nullable();
            $table->text('phase_ib_inv_required_plir')->nullable();
            $table->text('phase_iib_inv_required_plir')->nullable();
            $table->longtext('capa_required_iia')->nullable();
            $table->longtext('reference_capa_no_iia')->nullable();
            $table->longtext('hod_remark1')->nullable();
            $table->longtext('hod_remark2')->nullable();
            $table->longtext('hod_remark3')->nullable();
            $table->longtext('hod_remark4')->nullable();
            $table->longtext('hod_remark5')->nullable();
            $table->longtext('hod_attachment1')->nullable();
            $table->longtext('hod_attachment2')->nullable();
            $table->longtext('hod_attachment3')->nullable();
            $table->longtext('hod_attachment4')->nullable();
            $table->longtext('hod_attachment5')->nullable();
            $table->longtext('QA_Head_remark1')->nullable();
            $table->longtext('QA_Head_remark2')->nullable();
            $table->longtext('QA_Head_remark3')->nullable();
            $table->longtext('QA_Head_remark4')->nullable();
            $table->longtext('QA_Head_remark5')->nullable(); 
            $table->longtext('QA_Head_primary_remark1')->nullable();
            $table->longtext('QA_Head_primary_remark2')->nullable();
            $table->longtext('QA_Head_primary_remark3')->nullable();
            $table->longtext('QA_Head_primary_remark4')->nullable();
            $table->longtext('QA_Head_primary_remark5')->nullable();
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('o_o_s', function (Blueprint $table) {
            //
        });
    }
};
