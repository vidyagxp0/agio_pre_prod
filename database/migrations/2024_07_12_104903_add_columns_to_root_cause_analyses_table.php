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
            $table->text('comments_new1')->nullable();
            $table->text('comments_new2')->nullable();
            $table->text('comments_new3')->nullable();
            $table->text('comments_new4')->nullable();
         
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
            $table->dropColumn([
                'comments_new1','comments_new2','comments_new3','comments_new4'
                
            ]);
        });
    }
};
