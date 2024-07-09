<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('o_o_s__micros', function (Blueprint $table) {
            // Drop the column
            $table->dropColumn('reopen_request');
            
        });

        Schema::table('o_o_s__micros', function (Blueprint $table) {
            // Add the column with the new type
            $table->longText('reopen_request')->nullable();
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('o_o_s__micros', function (Blueprint $table) {
           
            $table->dropColumn('reopen_request');
           
        });

        Schema::table('o_o_s__micros', function (Blueprint $table) {
           
            $table->string('reopen_request')->nullable();
            
        });

    }
};
