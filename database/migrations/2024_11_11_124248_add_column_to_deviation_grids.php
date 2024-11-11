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
        Schema::table('deviation_grids', function (Blueprint $table) {
            $table->text("conclusion")->nullable();
            $table->longtext("attachment")->nullable();
            $table->text("file")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deviation_grids', function (Blueprint $table) {
            //
        });
    }
};
