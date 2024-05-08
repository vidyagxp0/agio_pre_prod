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
        Schema::create('change_control_stages', function (Blueprint $table) {
            $table->id();
            $table->integer('change_control_id');
            $table->integer('user_id');
            $table->string('role');
            $table->integer('stage');
            $table->string('stageName');
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('change_control_stages');
    }
};
