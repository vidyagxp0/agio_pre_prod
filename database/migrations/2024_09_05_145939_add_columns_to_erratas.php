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
        Schema::table('erratas', function (Blueprint $table) {
            $table->longText('Correction_Of_Error')->nullable();
            $table->longText('Initiator_Attachments')->nullable();
            $table->longText('Approval_Comment')->nullable();
            $table->longText('Approval_Attachments')->nullable();
            $table->longText('HOD_Comment1')->nullable();
            $table->longText('HOD_Attachments1')->nullable();
            $table->longText('QA_Comment1')->nullable();
            $table->longText('QA_Attachments1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('erratas', function (Blueprint $table) {
            //
        });
    }
};
