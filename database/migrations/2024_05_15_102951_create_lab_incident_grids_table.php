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
        Schema::create('lab_incident_grids', function (Blueprint $table) {
            $table->id();
            $table->integer('lab_incidents_id');
            $table->string('identifier')->nullable();
            $table->string('sr_no_IIR_GI')->nullable();
            $table->string('name_of_product_IIR_GI')->nullable();
            $table->string('b_no_IIR_GI')->nullable();
            $table->string('remarks_IIR_GI')->nullable();
            $table->string('sr_no_SSFI')->nullable();
            $table->string('name_of_product_SSFI')->nullable();
            $table->string('b_no_SSFI')->nullable();
            $table->string('remarks_SSFI')->nullable();
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
        Schema::dropIfExists('lab_incident_grids');
    }
};
