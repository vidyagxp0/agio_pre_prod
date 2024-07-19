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
        Schema::table('failure_investigation_grids', function (Blueprint $table) {
            $table->longtext('datatype')->after('facility')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('failure_investigation_grids', function (Blueprint $table) {
            $table->dropColumn('datatype');
        });
    }
};
