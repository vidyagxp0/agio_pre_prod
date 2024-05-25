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
        Schema::table('ootcs', function (Blueprint $table) {
            $table->string('grade_typeofwater')->nullable();
            $table->string('sampleLocation_Point')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::Drop('ootcs', function (Blueprint $table) {

            $table->dropColumn('grade_typeofwater')->nullable();
            $table->dropColumn('sampleLocation_Point')->nullable();
            
        });
    }
};
