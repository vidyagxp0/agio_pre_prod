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
        Schema::table('root_cause_analyses', function (Blueprint $table) {
            $table->Longtext('hod_final_comments')->nullable();
            $table->Longtext('qa_final_comments')->nullable();
            $table->Longtext('qah_final_comments')->nullable();
            $table->text('qah_final_attachments')->nullable();
            $table->text('qa_final_attachments')->nullable();
            $table->text('hod_final_attachments')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('root_cause_analyses', function (Blueprint $table) {
            //
        });
    }
};
