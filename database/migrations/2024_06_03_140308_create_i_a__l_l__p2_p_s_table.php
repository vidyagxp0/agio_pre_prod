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
        Schema::create('i_a__l_l__p2_p_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ia_id')->nullable();
            $table->string('checklist_number')->nullable();
            for ($i = 1; $i <= 170; $i++) {
                $table->text("checklist_LL_P2P_response_$i")->nullable();
                 $table->text("checklist_LL_P2P_remark_$i")->nullable();
            }


            $table->string('checklist_LL_P2P_response_comment')->nullable();
            $table->longText('checklist_LL_P2P_response_attachment')->nullable();
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
        Schema::dropIfExists('i_a__l_l__p2_p_s');
    }
};
