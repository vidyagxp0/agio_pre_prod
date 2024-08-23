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
        Schema::table('deviations', function (Blueprint $table) {
            $table->text('Close_by')->nullable();
            $table->text('Close_on')->nullable();
            $table->longText('Close_comment')->nullable();
            $table->text('pending_Cancel_by')->nullable();
            $table->text('pending_Cancel_on')->nullable();
            $table->longText('pending_Cancel_comment')->nullable();
            $table->longText('cancelled_comment')->nullable();
            $table->text('Hod_final_by')->nullable();
            $table->text('Hod_final_on')->nullable();
            $table->longText('Hod_final_comment')->nullable();
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deviations', function (Blueprint $table) {
            //
        });
    }
};
