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
        Schema::table('action_item_histories', function (Blueprint $table) {
            $table->longText('change_to')->nullable();
            $table->longText('change_from')->nullable();
            $table->text('action_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_item_histories', function (Blueprint $table) {
       $table->dropColumn(['change_to','change_from','action_name']);
        });
    }
};
