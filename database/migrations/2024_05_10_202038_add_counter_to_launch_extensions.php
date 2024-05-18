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
        Schema::table('launch_extensions', function (Blueprint $table) {
            $table->integer('counter')->default('0')->nullable()->after('extension_identifier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('launch_extensions', function (Blueprint $table) {
            //
        });
    }
};
