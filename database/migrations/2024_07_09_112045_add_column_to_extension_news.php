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
        Schema::table('extension_news', function (Blueprint $table) {
            $table->text('send_cqa_by')->nullable();
            $table->text('send_cqa_on')->nullable();
            $table->text('send_cqa_comment')->nullable();    
            $table->text('cqa_approval_by')->nullable();
            $table->text('cqa_approval_on')->nullable();
            $table->text('cqa_approval_comment')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extension_news', function (Blueprint $table) {
            //
        });
    }
};
