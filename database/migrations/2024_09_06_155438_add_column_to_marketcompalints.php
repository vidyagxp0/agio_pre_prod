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
        Schema::table('marketcompalints', function (Blueprint $table) {
            $table->text('qa_cqa_comments')->nullable();
            $table->text('qa_cqa_attachments')->nullable();
            $table->text('qa_cqa_head_comm')->nullable();
            $table->text('qa_cqa_head_attach')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketcompalints', function (Blueprint $table) {
            //
        });
    }
};
