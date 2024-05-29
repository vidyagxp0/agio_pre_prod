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
        Schema::create('i_a__quality_controls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ia_id')->nullable();
            for ($i = 1; $i <= 92; $i++) {
                $table->text("qualitycontrol_response_$i")->nullable();
                 $table->text("qualitycontrol_remark_$i")->nullable();
            }

            $table->string('qualitycontrol_Description_Deviation')->nullable();
            $table->longText('qualitycontrol_file_attach')->nullable();
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
        Schema::dropIfExists('i_a__quality_controls');
    }
};
