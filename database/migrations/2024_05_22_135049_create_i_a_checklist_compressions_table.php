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
        Schema::create('i_a_checklist_compressions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cc_id');
            for ($i = 1; $i <= 59; $i++) {
                $table->text("response_$i")->nullable();
                $table->text("remark_$i")->nullable();
            }

            $table->string('Description_Deviation')->nullable();
            $table->string('file_attach')->nullable();
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
        Schema::dropIfExists('i_a_checklist_compressions');
    }
};
