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
        Schema::table('ootcs', function (Blueprint $table) { 
            $table->string('status')->nullable();
            $table->string('stage')->nullable();
            $table->string('comments')->nullable();
            $table->string('refrence_record')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ootcs', function (Blueprint $table) {
            
            $table->dropColumn('status')->nullable();
            $table->dropColumn('stage')->nullable();
            $table->dropColumn('comments')->nullable();
            $table->dropColumn('refrence_record')->nullable();
        });
    }
};
