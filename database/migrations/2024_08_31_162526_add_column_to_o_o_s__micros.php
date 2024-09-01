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
        Schema::table('o_o_s__micros', function (Blueprint $table) {
            $table->longText('reason_manufacturing_pii')->nullable();
            $table->longText('manufacturing_multi_select')->nullable();
            $table->longText('oos_details_obvious_error')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('o_o_s__micros', function (Blueprint $table) {
            //
        });
    }
};
