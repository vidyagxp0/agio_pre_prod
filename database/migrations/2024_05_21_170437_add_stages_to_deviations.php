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
        Schema::table('deviations', function (Blueprint $table) {
            $table->text('QA_head_approved_by')->nullable()->after('QA_Final_Review_Comments');
            $table->text('QA_head_approved_on')->nullable()->after('QA_head_approved_by');
            $table->longText('QA_head_approved_comment')->nullable()->after('QA_head_approved_on');
            
            $table->text('pending_initiator_approved_by')->nullable()->after('QA_head_approved_comment');
            $table->text('pending_initiator_approved_on')->nullable()->after('pending_initiator_approved_by');
            $table->longText('pending_initiator_approved_comment')->nullable()->after('pending_initiator_approved_on');
            
            $table->text('QA_final_approved_by')->nullable()->after('pending_initiator_approved_comment');
            $table->text('QA_final_approved_on')->nullable()->after('QA_final_approved_by');
            $table->longText('QA_final_approved_comment')->nullable()->after('QA_final_approved_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deviations', function (Blueprint $table) {
            //
        });
    }
};
