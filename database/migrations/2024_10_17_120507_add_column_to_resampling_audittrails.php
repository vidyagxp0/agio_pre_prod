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
        Schema::table('resampling_audittrails', function (Blueprint $table) {
            $table->text('role_name')->nullable();
            $table->text('mailUserId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resampling_audittrails', function (Blueprint $table) {
            //
        });
    }
};
