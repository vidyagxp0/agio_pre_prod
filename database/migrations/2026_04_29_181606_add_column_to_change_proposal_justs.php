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
        Schema::table('change_proposal_justs', function (Blueprint $table) {
            $table->string('hod_cancelled_by')->nullable();
            $table->string('hod_cancelled_on')->nullable();
            $table->string('hod_cancel_comment')->nullable();
            $table->string('reject_comment')->nullable()->after('rejected_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('change_proposal_justs', function (Blueprint $table) {
            //
        });
    }
};
