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
          Schema::table('risk_management', function (Blueprint $table) {
         $table->Text('hod_more_info_by')->nullable();
        $table->Text('hod_more_info_on')->nullable();
        $table->Text('hod_more_info_comment')->nullable();

        $table->Text('Qa_review_more_info_by')->nullable();
        $table->Text('Qa_review_more_info_on')->nullable();
        $table->Text('Qa_review_more_info_comment')->nullable();


         $table->Text('cft_review_more_info_by')->nullable();
        $table->Text('cft_review_more_info_on')->nullable();
        $table->Text('cft_review_more_info_comment')->nullable();
         });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
