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
        Schema::table('extension_news', function (Blueprint $table) {
            $table->string('more_info_review_by')->nullable();
            $table->string('more_info_review_on')->nullable();
            $table->string('more_info_review_comment')->nullable();

            $table->string('more_info_inapproved_by')->nullable();
            $table->string('more_info_inapproved_on')->nullable();
            $table->string('more_info_inapproved_comment')->nullable();

            $table->string('reject_by')->nullable();
            $table->string('reject_on')->nullable();
            $table->string('reject_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extension_news', function (Blueprint $table) {
            //
        });
    }
};
