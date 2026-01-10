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
        Schema::table('i_a_checklist_engineerings', function (Blueprint $table) {
            for ($i = 1; $i <= 15; $i++) {
                $table->text("building_response_$i")->nullable();
                 $table->text("building_remark_$i")->nullable();
            }
             for ($i = 1; $i <= 5; $i++) {
                $table->text("hvac_response_$i")->nullable();
                 $table->text("hvac_remark_$i")->nullable();
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
        Schema::table('i_a_checklist_engineerings', function (Blueprint $table) {
            //
        });
    }
};
