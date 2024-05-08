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
        Schema::create('print_controls', function (Blueprint $table) {
            $table->id();
            $table->string('role_id');
            $table->string('daily')->nullable();
            $table->string('weekly')->nullable();
            $table->string('monthly')->nullable();
            $table->string('quatarly')->nullable();
            $table->string('yearly')->nullable();
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
        Schema::dropIfExists('print_controls');
    }
};
