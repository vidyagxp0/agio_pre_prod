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
        Schema::table('effectiveness_checks', function (Blueprint $table) {
            $table->text('closed_cancelled_by')->nullable();
            $table->text('closed_cancelled_on')->nullable();
            $table->text('closed_cancelled_comment')->nullable();
            $table->text('final_moreinfo_by')->nullable();
            $table->text('final_moreinfo_on')->nullable();
            $table->text('final_moreinfo_comment')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('effectiveness_checks', function (Blueprint $table) {
            //
        });
    }
};
