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
        Schema::create('add_column_errata_news', function (Blueprint $table) {
            $table->id();
            $table->integer('erratanew_id')->nullable();
            $table->text('department_head_to')->nullable();
            $table->text('document_title')->nullable();
            // $table->text('custom_value')->nullable();
            $table->text('qa_reviewer')->nullable();
            $table->text('reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_column_errata_news');
    }
};
