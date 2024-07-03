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
        Schema::table('cc_cfts', function (Blueprint $table) {
            $table->text('Production_Table_Review')->nullable();
            $table->text('Production_Table_Person')->nullable();
            $table->longtext('Production_Table_Assessment')->nullable();
            $table->longtext('Production_Table_Feedback')->nullable();
            $table->string('Production_Table_Attachment')->nullable();
            $table->text('Production_Table_By')->nullable();
            $table->date('Production_Table_On')->nullable();

            $table->text('Production_Injection_Review')->nullable();
            $table->text('Production_Injection_Person')->nullable();
            $table->longtext('Production_Injection_Assessment')->nullable();
            $table->longtext('Production_Injection_Feedback')->nullable();
            $table->string('Production_Injection_Attachment')->nullable();
            $table->text('Production_Injection_By')->nullable();
            $table->date('Production_Injection_On')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cc_cfts', function (Blueprint $table) {
            //
        });
    }
};
