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
        Schema::create('additional_information', function (Blueprint $table) {
            $table->id();
            $table->string('cc_id');
            $table->string('goup_review')->nullable();
            $table->string('Production')->nullable();
            $table->string('Production_Person')->nullable();
            $table->string('Quality_Approver')->nullable();
            $table->string('Quality_Approver_Person')->nullable();
            $table->string('Microbiology')->nullable();
            $table->string('Microbiology_Person')->nullable();
            $table->string('bd_domestic')->nullable();
            $table->string('Bd_Person')->nullable();
            $table->text('additional_attachments')->nullable();
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
        Schema::dropIfExists('additional_information');
    }
};