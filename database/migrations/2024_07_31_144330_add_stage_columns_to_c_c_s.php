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
        Schema::table('c_c_s', function (Blueprint $table) {
            $table->text('RA_review_required_by')->nullable();
            $table->text('RA_review_required_on')->nullable();
            $table->longText('RA_review_required_comment')->nullable();
            
            $table->text('RA_review_completed_by')->nullable();
            $table->text('RA_review_completed_on')->nullable();
            $table->longText('RA_review_completed_comment')->nullable();
            
            $table->text('close_rejected_by')->nullable();
            $table->text('close_rejected_on')->nullable();
            $table->longText('close_rejected_comment')->nullable();
            
            $table->text('approved_by')->nullable();
            $table->text('approved_on')->nullable();
            $table->longText('approved_comment')->nullable();
            
            $table->text('sentFor_final_approval_by')->nullable();
            $table->text('sentFor_final_approval_on')->nullable();
            $table->longText('sentFor_final_approval_comment')->nullable();
            
            $table->text('closure_approved_by')->nullable();
            $table->text('closure_approved_on')->nullable();
            $table->longText('closure_approved_comment')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('c_c_s', function (Blueprint $table) {
            //
        });
    }
};
