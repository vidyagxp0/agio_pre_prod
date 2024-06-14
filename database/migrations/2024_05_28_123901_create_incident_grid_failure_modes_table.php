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
        Schema::create('incident_grid_failure_modes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incident_id')->nullable();
            $table->string('identifier')->nullable();
            $table->longtext('data')->nullable();
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
        Schema::dropIfExists('incident_grid_failure_modes');
    }
};
