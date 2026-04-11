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
        Schema::create('change_proposal_just_grids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cpjg_id')->constrained('change_proposal_justs')->cascadeOnDelete();
            $table->string('identifier')->nullable();
            $table->longText('data')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('change_proposal_just_grids');
    }
};
