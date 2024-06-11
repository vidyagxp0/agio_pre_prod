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
            $table->string('submit_by')->nullable();
            $table->string('submit_on')->nullable();
            $table->string('submit_comment')->nullable();
            $table->string('submit_by_review')->nullable();
            $table->string('submit_on_review')->nullable();
            $table->string('submit_comment_review')->nullable();
            $table->string('submit_by_inapproved')->nullable();
            $table->string('submit_on_inapproved')->nullable();
            $table->string('submit_commen_inapproved')->nullable();
            $table->string('submit_by_approved')->nullable();
            $table->string('submit_on_approved')->nullable();
            $table->string('submit_comment_approved')->nullable();
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
