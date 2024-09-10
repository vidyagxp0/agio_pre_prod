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
            $table->text('initiated_through_capas_ooc_IB')->nullable();
            $table->text('initiated_through_capa_prevent_ooc_IB')->nullable();
            $table->text('initiated_through_capa_corrective_ooc_IB')->nullable();
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
