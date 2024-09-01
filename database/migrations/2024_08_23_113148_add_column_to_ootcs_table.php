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
        Schema::table('ootcs', function (Blueprint $table) {
            $table->text('Request_For_Cancellation_By')->nullable();
            $table->text('Request_For_Cancellation_On')->nullable();
            $table->text('Request_For_Cancellation_Comment')->nullable();
            $table->text('correction_data_comment')->nullable();
            $table->text('more_infor_nine_reject_by')->nullable();
            $table->text('more_infor_nine_reject_on')->nullable();
            $table->text('more_infor_nine_reject_comment')->nullable();
            $table->text('fourteen_stage_return_by')->nullable();
            $table->text('fourteen_stage_return_on')->nullable();
            $table->text('fourteen_stage_return_comment')->nullable();
            $table->text('approved_data_completed_by')->nullable();
            $table->text('approved_data_completed_on')->nullable();
            $table->text('approved_data_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ootcs', function (Blueprint $table) {
            //
        });
    }
};
