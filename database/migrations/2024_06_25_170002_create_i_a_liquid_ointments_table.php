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
        Schema::create('i_a_liquid_ointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ia_id')->nullable();
            for ($i = 1; $i <= 50; $i++) {
                $table->text("liquid_ointments_response_$i")->nullable();
                 $table->text("liquid_ointments_remark_$i")->nullable();
            }

            $table->string('Description_oinments_comment')->nullable();
            $table->longText('file_attach_ointments')->nullable();
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
        Schema::dropIfExists('i_a_liquid_ointments');
    }
};
