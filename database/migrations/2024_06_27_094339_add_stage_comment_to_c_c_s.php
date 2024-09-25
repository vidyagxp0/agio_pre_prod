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
            $table->text('cancelled_by')->nullable();
            $table->text('cancelled_on')->nullable();
            $table->longText('cancelled_comment')->nullable();

            $table->text('QaHeadPreapprovalToQaFinal_by')->nullable();
            $table->text('QaHeadPreapprovalToQaFinal_on')->nullable();
            $table->longText('QaHeadPreapprovalToQaFinal_comment')->nullable();

            $table->text('QaHeadAapprovalToPreapproval_by')->nullable();
            $table->text('QaHeadAapprovalToPreapproval_on')->nullable();
            $table->longText('QaHeadAapprovalToPreapproval_comment')->nullable();

            $table->text('cftNotRequired_by')->nullable();
            $table->text('cftNotRequired_on')->nullable();
            $table->longText('cftNotRequired_comment')->nullable();
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
