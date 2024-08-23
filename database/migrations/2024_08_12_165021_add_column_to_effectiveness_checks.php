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
            $table->text('work_complition_by')->nullable();
            $table->text('work_complition_on')->nullable();
            $table->longText('work_complition_comment')->nullable();
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
