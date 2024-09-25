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
        Schema::table('marketcompalints', function (Blueprint $table) {
            $table->string('complaint_reported_on_gi')->nullable()->after('complainant_gi');
            $table->longText('more_information_required_by')->nullable();
            $table->longText('more_information_required_on')->nullable();
            $table->longText('more_information_required_comment')->nullable();
            $table->longText('cancelled_comment')->nullable()->after('cancelled_on');
            $table->longText('reject_by')->nullable()->after('approve_plan_on');
            $table->longText('reject_on')->nullable();
            $table->longText('reject_comment')->nullable();


        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketcompalints', function (Blueprint $table) {
            //
        });
    }
};
