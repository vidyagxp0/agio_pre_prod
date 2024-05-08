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
        Schema::create('qa_approval_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('cc_id');
            $table->text('qa_appro_comments')->nullable();
            $table->text('feedback')->nullable();
            $table->text('tran_attach')->nullable();
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
        Schema::dropIfExists('qa_approval_comments');

  }
};
