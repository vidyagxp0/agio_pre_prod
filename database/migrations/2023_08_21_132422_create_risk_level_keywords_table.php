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
        Schema::create('risk_level_keywords', function (Blueprint $table) {
            $table->id();
            $table->string('keyword');
            $table->enum('risk_level', ['critical', 'minor']); // Assuming risk levels are predefined
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
        Schema::dropIfExists('risk_level_keywords');
    }
};
