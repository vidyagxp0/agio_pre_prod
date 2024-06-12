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
        Schema::create('checklist__capsules', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('ia_id')->nullable();
            for ($i = 1; $i <= 50; $i++) {
                $table->text("capsule_response_$i")->nullable();
                 $table->text("capsule_remark_$i")->nullable();
            }

            $table->string('Description_Deviation')->nullable();
            $table->longText('file_attach')->nullable();
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
        Schema::dropIfExists('checklist__capsules');
    }
};
