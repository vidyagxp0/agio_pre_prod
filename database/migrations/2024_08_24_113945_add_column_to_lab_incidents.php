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
            $table->text('more_info_req_1_by')->nullable();
            $table->text('more_info_req_1_on')->nullable();
            $table->text('more_info_req_1_comment')->nullable();
            $table->text('more_info_req_2_by')->nullable();
            $table->text('more_info_req_2_on')->nullable();
            $table->text('more_info_req_2_comment')->nullable();
            $table->text('more_info_req_3_by')->nullable();
            $table->text('more_info_req_3_on')->nullable();
            $table->text('more_info_req_3_comment')->nullable();
            $table->text('more_info_req_4_by')->nullable();
            $table->text('more_info_req_4_on')->nullable();
            $table->text('more_info_req_4_comment')->nullable();
            $table->text('more_info_req_5_by')->nullable();
            $table->text('more_info_req_5_on')->nullable();
            $table->text('more_info_req_5_comment')->nullable();
            $table->text('more_info_req_6_by')->nullable();
            $table->text('more_info_req_6_on')->nullable();
            $table->text('more_info_req_6_comment')->nullable();
            $table->text('more_info_req_7_by')->nullable();
            $table->text('more_info_req_7_on')->nullable();
            $table->text('more_info_req_7_comment')->nullable();
            
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
            //
        });
    }
};
