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
        Schema::table('audit_programs', function (Blueprint $table) {
            $table->text('hod_comment')->nullable();
            $table->text('hod_attached_File')->nullable();
            $table->text('cqa_qa_comment')->nullable();
            $table->text('cqa_qa_Attached_File')->nullable();
            $table->text('assign_to_department')->nullable();
            $table->text('yearly_other')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('audit_programs', function (Blueprint $table) {
            //
        });
    }
};
