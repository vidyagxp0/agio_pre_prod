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
        Schema::table('cc_cfts', function (Blueprint $table) {
            $table->text('RA_data_person')->nullable();
            $table->text('QA_CQA_person')->nullable();
            $table->text('qa_final_comments')->nullable();
            $table->text('qa_final_attach')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cc_cfts', function (Blueprint $table) {
            //
        });
    }
};
