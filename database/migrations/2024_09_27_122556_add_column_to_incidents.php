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
            $table->text('QAH_Designee_Approval_Complete_By')->nullable();
            $table->text('QAH_Designee_Approval_Complete_On')->nullable();
            $table->longText('QAH_Designee_Approval_Complete_Comments')->nullable();

            $table->text('QAH_Designee_More_Info_Required_by')->nullable();
            $table->text('QAH_Designee_More_Info_Required_on')->nullable();
            $table->longText('QAH_Designee_More_Info_Required_comments')->nullable();
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
