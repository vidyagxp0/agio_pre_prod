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
        Schema::create('i_a_checklist_manufacturing_fillings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ia_id')->nullable();
            for ($i = 1; $i <= 44; $i++) {
                $table->text("response_powder_manufacturing_filling_$i")->nullable();
                 $table->text("remark_powder_manufacturing_filling_$i")->nullable();
            }
            for ($i = 1; $i <= 3; $i++) {
                $table->text("response_packing_$i")->nullable();
                 $table->text("remark_packing_$i")->nullable();
            }
            $table->string('remark_powder_manufacturing_filling_comment')->nullable();
            $table->longText('remark_powder_manufacturing_filling_attachment')->nullable();
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
        Schema::dropIfExists('i_a_checklist_manufacturing_fillings');
    }
};
