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
        Schema::create('o_o_s__micro_audit_trials', function (Blueprint $table) {
                $table->id();
                $table->string('OOS_micro_id');
                $table->string('activity_type')->nullable();
                $table->string('previous')->nullable();
                $table->string('current')->nullable();
                $table->string('comment')->nullable();
                $table->string('user_id')->nullable();
                $table->string('user_name')->nullable();
                $table->string('origin_state')->nullable();
                $table->string('change_to')->nullable();
                $table->string('change_from')->nullable();
                $table->string('action_name')->nullable();
                $table->string('user_role')->nullable();
                $table->string('stage')->nullable();
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
        Schema::dropIfExists('o_o_s__micro_audit_trials');
    }
};