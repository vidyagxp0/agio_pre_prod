<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('change_proposal_justs', function (Blueprint $table) {
            $table->string('Complete_By')->nullable();
            $table->string('Complete_On')->nullable();
            $table->string('Complete_Comments')->nullable();
            $table->integer('dashboard_unique_id')->nullable();
            $table->string('department')->nullable();
        });
    }

    
    public function down()
    {
        Schema::table('change_proposal_justs', function (Blueprint $table) {
            //
        });
    }
};
