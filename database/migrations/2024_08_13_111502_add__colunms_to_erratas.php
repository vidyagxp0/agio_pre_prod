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
        Schema::table('erratas', function (Blueprint $table) {
            $table->text('Reviewed_by')->nullable();
            $table->text('Reviewed_on')->nullable();
            $table->text('Reviewed_commemt')->nullable();
            $table->text('approved_by')->nullable();
            $table->text('approved_on')->nullable();
            $table->text('approved_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('erratas', function (Blueprint $table) {
            //
        });
    }
};
