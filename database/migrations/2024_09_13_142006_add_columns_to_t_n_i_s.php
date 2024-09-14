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
        Schema::table('t_n_i_s', function (Blueprint $table) {
            $table->text('division_id')->nullable();
            $table->text('initiator_id')->nullable();
            $table->text('initiation_date')->nullable();
            $table->text('departments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_n_i_s', function (Blueprint $table) {
            //
        });
    }
};
