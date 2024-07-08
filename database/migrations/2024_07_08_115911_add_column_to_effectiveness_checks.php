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
        Schema::table('effectiveness_checks', function (Blueprint $table) {
            $table->text('effectiveness_check_complete_by')->nullable();
            $table->text('effectiveness_check_complete_on')->nullable();
            $table->longText('effectiveness_check_complete_comment')->nullable();
            $table->text('effectiveness_check_complete_moreinfo_by')->nullable();
            $table->text('effectiveness_check_complete_moreinfo_on')->nullable();
            $table->longText('effectiveness_check_complete_moreinfo_comment')->nullable();
            $table->text('hod_review_complete_by')->nullable();
            $table->text('hod_review_complete_on')->nullable();
            $table->longText('hod_review_complete_comment')->nullable();
            $table->text('hod_review_complete_moreinfo_by')->nullable();
            $table->text('hod_review_complete_moreinfo_on')->nullable();
            $table->longText('hod_review_complete_moreinfo_comment')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('effectiveness_checks', function (Blueprint $table) {
            //
        });
    }
};
