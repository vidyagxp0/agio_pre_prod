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
        Schema::create('i_a_checklist__formulation_researches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ia_id')->nullable();
            for ($i = 1; $i <= 24; $i++) {
                $table->text("response_formulation_research_development_$i")->nullable();
                 $table->text("remark_formulation_research_development_$i")->nullable();
            }
            $table->string('remark_formulation_research_development_comment')->nullable();
            $table->longText('remark_formulation_research_development_attachment')->nullable();
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
        Schema::dropIfExists('i_a_checklist__formulation_researches');
    }
};
