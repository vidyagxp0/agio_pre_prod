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
        Schema::table('erratas', function (Blueprint $table) {
            $table->text('department_head_to')->nullable();
            $table->text('document_title')->nullable();
            $table->text('qa_reviewer')->nullable();
            $table->text('reference')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('erratas', function (Blueprint $table) {
            $table->dropColumn(['department_head_to', 'document_title', 'qa_reviewer', 'reference']);
        });
    }
};
