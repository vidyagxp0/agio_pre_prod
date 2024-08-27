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
        Schema::table('incidents', function (Blueprint $table) {
            $table->Text('HOD_Initial_Review_Complete_On')->nullable();
            $table->Text('HOD_Initial_Review_Complete_By')->nullable();
            $table->Text('HOD_Initial_Review_Comments')->nullable();
            $table->Text('more_info_req_by')->nullable();
            $table->Text('more_info_req_on')->nullable();
            $table->Text('more_info_req_cmt')->nullable();
            $table->Text('Hod_Cancelled_by')->nullable();
            $table->Text('Hod_Cancelled_on')->nullable();
            $table->Text('Hod_Cancelled_cmt')->nullable();
            $table->Text('Qa_more_info_req_by')->nullable();
            $table->Text('Qa_more_info_req_on')->nullable();
            $table->Text('Qa_more_info_req_cmt')->nullable();
            $table->Text('Pending_Review_Complete_By')->nullable();
            $table->Text('Pending_Review_Complete_On')->nullable();
            $table->Text('Pending_Review_Comments')->nullable();  
            $table->Text('Pending_more_info_req_by')->nullable();
            $table->Text('Pending_more_info_req_on')->nullable();
            $table->Text('Pending_more_info_req_cmt')->nullable();
            $table->Text('Hod_Final_Review_Complete_By')->nullable();
            $table->Text('Hod_Final_Review_Complete_On')->nullable();
            $table->Text('Hod_Final_Review_Comments')->nullable();
            
            $table->text('Cancelled_cmt')->nullable();
            $table->text('Hod_more_info_req_on')->nullable();
            $table->Text('Hod_more_info_req_cmt')->nullable();      
            $table->text('approved_more_info_req_by')->nullable();
            $table->text('approved_more_info_req_on')->nullable();
            $table->Text('approved_more_info_req_cmt')->nullable();
         
            $table->text('Qa_final_more_info_req_by')->nullable();
            $table->text('Qa_final_more_info_req_on')->nullable();
            $table->Text('Qa_final_more_info_req_cmt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incidents', function (Blueprint $table) {
            //
        });
    }
};
