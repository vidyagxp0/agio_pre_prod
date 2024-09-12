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
        Schema::table('management_reviews', function (Blueprint $table) {
             $table->text('review_period_monthly')->nullable();
            $table->text('review_period_six_monthly')->nullable();
            $table->text('cft_hod_attach')->nullable();
            $table->text('qa_verification_file')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('management_reviews', function (Blueprint $table) {
            //
        });
    }
};
