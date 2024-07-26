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
            $table->dropColumn(['parent_type', 'Other_Ref', 'assign_to','stage_SSFI','stability_condition_SSFI','interval_SSFI','test_SSFI']);
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
            //ADD COULMN
           
          



        });
    }
};
