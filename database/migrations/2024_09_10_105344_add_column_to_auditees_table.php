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
        Schema::table('auditees', function (Blueprint $table) {
            // $table->text('audit_details_summary_by')->nullable();
            // $table->text('summary_and_response_com_by')->nullable();
            // $table->text('CFT_Review_Complete_By')->nullable();
            // $table->text('approval_complete_by')->nullable();
            // $table->text('approval_complete_on_comment')->nullable();




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auditees', function (Blueprint $table) {
            //
        });
    }
};
