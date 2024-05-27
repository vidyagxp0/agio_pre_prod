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
        Schema::table('c_c_s', function (Blueprint $table) {
            $table->string('qa_more_info_required_by')->nullable();
            $table->string('qa_more_info_required_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('c_c_s', function (Blueprint $table) {
            //
        });
    }
};
