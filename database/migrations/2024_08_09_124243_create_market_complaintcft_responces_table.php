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
        Schema::create('market_complaintcft_responces', function (Blueprint $table) {
            $table->id();
            $table->string('mc_id');
            $table->string('cft_user_id')->comment('user_id')->nullable();
            $table->string('cft_stage')->nullable();
            $table->string('status')->nullable();
            $table->string('comment')->nullable();
            $table->date('completed_on')->nullable();
            $table->integer('is_required')->default(0);
            $table->text('deleted_at')->nullable();
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
        Schema::dropIfExists('market_complaintcft_responces');
    }
};
