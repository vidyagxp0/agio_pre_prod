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
        Schema::create('risk_assesment_cft_responces', function (Blueprint $table) {
            $table->id();
            $table->string('risk_id');
            $table->string('cft_user_id')->comment('user_id');
            $table->string('cft_stage')->nullable();
            $table->string('status')->nullable();
            $table->string('comment')->nullable();
            $table->date('completed_on')->nullable();
            $table->integer('is_required')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risk_assesment_cft_responces');
    }
};
