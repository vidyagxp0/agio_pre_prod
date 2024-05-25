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
        Schema::create('incident_investigation_report', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('lab_incidents_id');
            $table->integer('labincident_id')->default(0);
            $table->string('identifier');
            $table->longText('data')->nullable(); // Column to store serialized data.
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
        Schema::dropIfExists('incident_investigation_report');
    }
};
