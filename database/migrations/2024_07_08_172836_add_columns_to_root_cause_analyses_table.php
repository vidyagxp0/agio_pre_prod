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
        Schema::table('root_cause_analyses', function (Blueprint $table) {
            $table->text('comment_3')->nullable();
            $table->text('reject_1')->nullable();
            $table->text('cancel_comment')->nullable();
            $table->text('reject_3')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('root_cause_analyses', function (Blueprint $table) {
            $table->dropColumn(['comment_3', 'reject_3', 'reject_1','cancel_comment']);
        });
    }
};
