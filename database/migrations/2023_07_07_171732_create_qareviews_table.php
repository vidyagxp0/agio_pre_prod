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
        Schema::create('qareviews', function (Blueprint $table) {
            $table->id();
            $table->integer('cc_id');
            $table->text('type_chnage')->nullable();
            $table->text('qa_head')->nullable();
            $table->text('qa_comments')->nullable();
            $table->text('related_records')->nullable();
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
        Schema::dropIfExists('qareviews');
    }
};