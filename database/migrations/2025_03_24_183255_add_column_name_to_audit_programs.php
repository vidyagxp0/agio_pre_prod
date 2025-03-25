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
        Schema::table('audit_programs', function (Blueprint $table) {
            $table->longText('cqa_qa_review_comment')->nullable();
            $table->longText('cqa_qa_review_Attached_File')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('audit_programs', function (Blueprint $table) {
            //
        });
    }
};
