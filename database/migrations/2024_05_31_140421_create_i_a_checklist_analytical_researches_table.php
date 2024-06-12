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
        Schema::create('i_a_checklist_analytical_researches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ia_id')->nullable();
            for ($i = 1; $i <= 26; $i++) {
                $table->text("response_analytical_research_development_$i")->nullable();
                 $table->text("remark_analytical_research_development_$i")->nullable();
            }
            $table->string('remark_analytical_research_comment')->nullable();
            $table->longText('remark_analytical_research_attachment')->nullable();
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
        Schema::dropIfExists('i_a_checklist_analytical_researches');
    }
};
