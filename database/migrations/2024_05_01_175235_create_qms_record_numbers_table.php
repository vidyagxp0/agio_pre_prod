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
        Schema::create('qms_record_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('record_number')->nullable();
            $table->integer('recordable_id')->default(0);
            $table->string('recordable_type')->nullable();
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
        Schema::dropIfExists('qms_record_numbers');
    }
};
