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
        Schema::create('i_a_dispencing_manufacturings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ia_id')->nullable();
            for ($i = 1; $i <= 66; $i++) {
                $table->text("dispensing_and_manufacturing_$i")->nullable();
                 $table->text("dispensing_and_manufacturing_remark_$i")->nullable();
            }

            $table->string('dispensing_and_manufacturing_comment')->nullable();
            $table->string('dispensing_and_manufacturing_attachment')->nullable();
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
        Schema::dropIfExists('i_a_dispencing_manufacturings');
    }
};
