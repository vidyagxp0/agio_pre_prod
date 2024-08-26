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
        Schema::table('risk_management', function (Blueprint $table) {
            $table->text('CFT_Review_Complete_By')->nullable();
            $table->text('CFT_Review_Complete_On')->nullable();
            $table->text('CFT_Review_Comments')->nullable();
            $table->text('QA_Final_Review_Complete_By')->nullable();
            $table->text('QA_Final_Review_Complete_On')->nullable();
            $table->text('QA_Final_Review_Comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('risk_management', function (Blueprint $table) {
            //
        });
    }
};
