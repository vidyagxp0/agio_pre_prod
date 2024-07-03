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
        Schema::table('internal_audit_checklist_grids', function (Blueprint $table) {
            $table->longText('auditSheChecklist_comment')->nullable();
            $table->longText('auditSheChecklist_attachment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('internal_audit_checklist_grids', function (Blueprint $table) {
            //
        });
    }
};
