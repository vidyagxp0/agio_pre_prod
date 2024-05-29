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
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('stage')->nullable();
            $table->string('status')->nullable();
            $table->string('activated_by')->nullable();
            $table->string('activated_on')->nullable();
            $table->string('activated_comment')->nullable();
            $table->string('retired_by')->nullable();
            $table->string('retired_on')->nullable();
            $table->string('retired_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
};
