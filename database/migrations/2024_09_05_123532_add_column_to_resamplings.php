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
        Schema::table('resamplings', function (Blueprint $table) {
            $table->longtext('qa_head')->nullable();
            $table->longtext('qa_remark')->nullable();  
            $table->longtext('if_others')->nullable();  
            $table->longtext('sampled_by')->nullable();  
          
       
       
       
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resamplings', function (Blueprint $table) {
            //
        });
    }
};
