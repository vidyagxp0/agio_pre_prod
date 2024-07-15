<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('o_o_s', function (Blueprint $table) {
            $table->longtext('oos_observed_on')->nullable();
            $table->longtext('delay_justification')->nullable();
            $table->longtext('oos_reported_date')->nullable();
            $table->longtext('immediate_action')->nullable();

        });
    }

    public function down()
    {
        Schema::table('o_o_s', function (Blueprint $table) {
            

        });
    }

};
