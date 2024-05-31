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
        Schema::create('i_a_ointment_pakings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ia_id')->nullable();

            for ($i = 1; $i <= 51; $i++) {
                $table->text("ointment_packing_$i")->nullable();
                 $table->text("ointment_packing_remark_$i")->nullable();
            }

            $table->string('ointment_packing_comment')->nullable();
            $table->longText('ointment_packing_attachment')->nullable();
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
        Schema::dropIfExists('i_a_ointment_pakings');
    }
};
