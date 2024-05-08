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
        Schema::create('q_m_s_divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('status')->length(2)->default(0);
            $table->timestamps();


        });
        // Schema::create('q_m_s_divisions', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->timestamps();


        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q_m_s_divisions');
    }
};
