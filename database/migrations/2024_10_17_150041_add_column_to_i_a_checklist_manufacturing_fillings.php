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
        Schema::table('i_a_checklist_manufacturing_fillings', function (Blueprint $table) {
            //
            for ($i = 7; $i <= 8; $i++) {
                $table->text("response_packing_$i")->nullable();
                 $table->text("remark_packing_$i")->nullable();
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
        Schema::table('i_a_checklist_manufacturing_fillings', function (Blueprint $table) {
            //
        });
    }
};
