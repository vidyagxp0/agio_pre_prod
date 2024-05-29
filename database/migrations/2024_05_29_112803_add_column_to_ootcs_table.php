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
        Schema::table('ootcs', function (Blueprint $table) {
            $table->text('pli_finaly_validity_check')->nullable();
            $table->text('finaly_validity_check')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ootcs', function (Blueprint $table) {
            $table->dropColumn('pli_finaly_validity_check')->nullable();
            $table->dropColumn('finaly_validity_check')->nullable();
        });
    }
};
