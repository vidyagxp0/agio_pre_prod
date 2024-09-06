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
        Schema::table('lab_incidents', function (Blueprint $table) {
            $table->text('name_of_analyst')->nullable();
            $table->text('investigator_data')->nullable();
            $table->text('qc_review_data')->nullable();
            $table->text('other_incidence_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lab_incidents', function (Blueprint $table) {
            //
        });
    }
};
