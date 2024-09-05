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
        Schema::table('capas', function (Blueprint $table) {
            $table->text('hod_final_review')->nullable();
            $table->text('qa_cqa_qa_comments')->nullable();
            $table->text('qah_cq_comments')->nullable();
            $table->string('hod_final_attachment')->nullable();
            $table->string('qa_closure_attachment')->nullable();
            $table->string('qah_cq_attachment')->nullable();





        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('capas', function (Blueprint $table) {
            //
        });
    }
};
