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
        Schema::table('i_a_quality_controls', function (Blueprint $table) {
            //
            for ($i = 85; $i <= 99; $i++) {
                $table->text("quality_control_response_$i")->nullable();
                 $table->text("quality_control_remark__$i")->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('i_a_quality_controls', function (Blueprint $table) {
            //
        });
    }
};
