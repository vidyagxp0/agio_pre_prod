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
        Schema::table('action_items', function (Blueprint $table) {
            $table->text('submitted_comment')->nullable();
            $table->text('more_info_requ_comment')->nullable();
            $table->text('cancelled_comment')->nullable();
            $table->text('completed_comment')->nullable();
           
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_items', function (Blueprint $table) {
            $table->dropColumn(['submitted_comment','more_info_requ_comment','cancelled_comment','completed_comment']);
        });
    }
};
