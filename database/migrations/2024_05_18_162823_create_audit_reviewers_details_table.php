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
        Schema::create('audit_reviewers_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deviation_id');
            $table->unsignedBigInteger('user_id');
            $table->longText('reviewer_comment')->nullable();
            $table->longText('reviewer_comment_by')->nullable();
            $table->date('reviewer_comment_on')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_reviewers_details');
    }
};
