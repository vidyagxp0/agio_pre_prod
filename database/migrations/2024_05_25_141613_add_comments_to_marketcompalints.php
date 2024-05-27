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
        Schema::table('marketcompalints', function (Blueprint $table) {
            $table->string('investigation_completed_comment')->nullable();
            $table->string('propose_plan_comment')->nullable();
            $table->string('approve_plan_comment')->nullable();
            $table->string('all_capa_closed_comment')->nullable();
            $table->string('closed_done_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketcompalints', function (Blueprint $table) {
            //
        });
    }
};
