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
        Schema::table('incidents', function (Blueprint $table) {
            $table->longText('hod_more_info_required_by')->nullable();
            $table->longText('hod_more_info_required_on')->nullable();
            $table->longText('hod_more_info_required_comment')->nullable();

            $table->longText('qa_more_info_required_comment')->nullable();

            $table->longText('qah_more_info_required_by')->nullable();
            $table->longText('qah_more_info_required_on')->nullable();
            $table->longText('qah_more_info_required_comment')->nullable();

            $table->longText('initiator_more_info_required_by')->nullable();
            $table->longText('initiator_more_info_required_on')->nullable();
            $table->longText('initiator_more_info_required_comment')->nullable();

            $table->longText('hod_final_more_info_required_by')->nullable();
            $table->longText('hod_final_more_info_required_on')->nullable();
            $table->longText('hod_final_more_info_required_comment')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incidents', function (Blueprint $table) {
            //
        });
    }
};
