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
        Schema::create('internal_audit_stage_histories', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('doc_id');
            $table->integer('user_id');
            $table->string('user_name');
            $table->string('stage_id');
            $table->string('status');
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
        Schema::dropIfExists('internal_audit_stage_histories');
    }
};
