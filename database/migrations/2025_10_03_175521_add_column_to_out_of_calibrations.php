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
        Schema::table('out_of_calibrations', function (Blueprint $table) {
               $table->string('stagethird_more_by')->nullable();
                $table->string('stagethird_more_on')->nullable();
                $table->Text('stagethird_more_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('out_of_calibrations', function (Blueprint $table) {
            //
        });
    }
};
