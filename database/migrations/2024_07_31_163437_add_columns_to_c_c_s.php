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
        Schema::table('c_c_s', function (Blueprint $table) {
            $table->text('QaClouseToPostImplementationBy')->nullable();
            $table->text('QaClouseToPostImplementationOn')->nullable();
            $table->longText('QaClouseToPostImplementationComment')->nullable();
            
            $table->text('postImplementationToQaHeadBy')->nullable();
            $table->text('postImplementationToQaHeadOn')->nullable();
            $table->longText('postImplementationToQaHeadComment')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('c_c_s', function (Blueprint $table) {
            //
        });
    }
};
