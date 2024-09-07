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
        Schema::table('o_o_s', function (Blueprint $table) {
            $table->longtext('QA_Head_attachment1')->nullable();
            $table->longtext('QA_Head_attachment2')->nullable();
            $table->longtext('QA_Head_attachment3')->nullable();
            $table->longtext('QA_Head_attachment4')->nullable();
            $table->longtext('QA_Head_attachment5')->nullable();
            $table->longtext('QA_Head_primary_attachment1')->nullable();
            $table->longtext('QA_Head_primary_attachment2')->nullable();
            $table->longtext('QA_Head_primary_attachment3')->nullable();
            $table->longtext('QA_Head_primary_attachment4')->nullable();
            $table->longtext('QA_Head_primary_attachment5')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('o_o_s', function (Blueprint $table) {
            //
        });
    }
};
