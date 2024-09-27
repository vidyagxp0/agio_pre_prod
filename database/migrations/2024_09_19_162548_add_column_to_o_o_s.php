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
            $table->longText('result_of_rep_test_IIB')->nullable();
            $table->longText('reason_manufacturing_delay')->nullable();
            $table->longText('Any_other_cause')->nullable();
            $table->longText('rational_for_assingnable')->nullable();



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
