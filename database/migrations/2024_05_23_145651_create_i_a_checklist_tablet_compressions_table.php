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
        Schema::create('i_a_checklist_tablet_compressions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ia_id')->nullable();
            for ($i = 1; $i <= 50; $i++) {
                $table->text("tablet_compress_response_$i")->nullable();
                 $table->text("tablet_compress_remark_$i")->nullable();
            }

            $table->string('tablet_compress_response_final_comment')->nullable();
            $table->string('supproting_attachment')->nullable();
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
        Schema::dropIfExists('i_a_checklist_tablet_compressions');
    }
};
