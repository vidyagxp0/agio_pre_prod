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
        Schema::create('i_a_quality_controls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ia_id')->nullable();

            for ($i = 1; $i <= 84; $i++) {
                $table->text("quality_control_response_$i")->nullable();
                 $table->text("quality_control_remark__$i")->nullable();
            }

            $table->string('quality_control_response_comment')->nullable();
            $table->longText('quality_control_response_attachment')->nullable();
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
        Schema::dropIfExists('i_a_quality_controls');
    }
};
