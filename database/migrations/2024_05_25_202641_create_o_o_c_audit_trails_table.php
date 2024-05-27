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
       Schema::create('o_o_c_audit_trails', function (Blueprint $table) {
            $table->id();
            $table->string('ooc_id');
            $table->string('activity_type');
            $table->longText('previous')->nullable();
            $table->string('stage')->nullable();
            $table->longText('current')->nullable();
            $table->longText('comment')->nullable();
            $table->text('action_name')->nullable();
            $table->text('change_from')->nullable();
            $table->text('change_to')->nullable();
            $table->string('user_id');
            $table->string('user_name');
            $table->string('origin_state');
            $table->string('user_role');
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
        Schema::dropIfExists('o_o_c_audit_trails');
    }
};
