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
        Schema::create('oot_checklists', function (Blueprint $table) {
            $table->id();
            $table->text('p_l_irequired')->nullable();
            $table->text('responce_one')->nullable();
            $table->text('responce_two')->nullable();
            $table->text('responce_three')->nullable();
            $table->text('responce_four')->nullable();
            $table->text('responce_five')->nullable();
            $table->text('responce_six')->nullable();
            $table->text('responce_seven')->nullable();
            $table->text('responce_eight')->nullable();
            $table->text('responce_nine')->nullable();
            $table->text('responce_ten')->nullable();
            $table->text('responce_eleven')->nullable();
            $table->text('responce_twele')->nullable();
            $table->text('responce_thrteen')->nullable();
            $table->text('responce_fourteen')->nullable();
            $table->text('responce_fifteen')->nullable();
            $table->text('responce_sixteen')->nullable();
            $table->text('responce_seventeen')->nullable();
            $table->text('responce_eighteen')->nullable();
            $table->text('responce_ninteen')->nullable();
            $table->text('responce_twenty')->nullable();
            $table->text('responce_twenty_one')->nullable();
            $table->text('responce_twenty_two')->nullable();
            $table->text('responce_twenty_three')->nullable();
            $table->text('responce_twenty_four')->nullable();
            $table->text('responce_twenty_five')->nullable();
            $table->text('responce_twenty_six')->nullable();
            $table->text('responce_twenty_seven')->nullable();
            $table->text('responce_twenty_eight')->nullable();
            $table->text('responce_twenty_nine')->nullable();
            $table->text('responce_thirty')->nullable();
            $table->text('responce_thirty_one')->nullable();
            $table->text('responce_thirty_two')->nullable();
            $table->text('responce_thirty_three')->nullable();
            $table->text('responce_thirty_four')->nullable();

            
            $table->longText('remark_one')->nullable();
            $table->text('remark_two')->nullable();
            $table->text('remark_three')->nullable();
            $table->text('remark_four')->nullable();
            $table->text('remark_five')->nullable();
            $table->text('remark_six')->nullable();
            $table->text('remark_seven')->nullable();
            $table->text('remark_eight')->nullable();
            $table->text('remark_nine')->nullable();
            $table->text('remark_ten')->nullable();
            $table->text('remark_eleven')->nullable();
            $table->text('remark_twele')->nullable();
            $table->text('remark_thrteen')->nullable();
            $table->text('remark_fourteen')->nullable();
            $table->text('remark_fifteen')->nullable();
            $table->text('remark_sixteen')->nullable();
            $table->text('remark_seventeen')->nullable();
            $table->text('remark_eighteen')->nullable();
            $table->text('remark_ninteen')->nullable();
            $table->text('remark_twenty')->nullable();
            $table->text('remark_twenty_one')->nullable();
            $table->text('remark_twenty_two')->nullable();
            $table->text('remark_twenty_three')->nullable();
            $table->text('remark_twenty_four')->nullable();
            $table->text('remark_twenty_five')->nullable();
            $table->text('remark_twenty_six')->nullable();
            $table->text('remark_twenty_seven')->nullable();
            $table->text('remark_twenty_eight')->nullable();
            $table->text('remark_twenty_nine')->nullable();
            $table->text('remark_thirty')->nullable();
            $table->text('remark_thirty_one')->nullable();
            $table->text('remark_thirty_two')->nullable();
            $table->text('remark_thirty_three')->nullable();
            $table->text('remark_thirty_four')->nullable();  
            $table->text('l_e_i_oot')->nullable();
            $table->text('elaborate_the_reson')->nullable(); 
            $table->text('in_charge')->nullable();
            $table->text('pli_head_designee')->nullable();
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
        Schema::dropIfExists('oot_checklists');
    }
};
