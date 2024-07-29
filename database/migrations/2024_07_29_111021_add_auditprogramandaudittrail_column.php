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
            $table->longText('through_req')->nullable();
            $table->string('Months')->nullable();
        });
        Schema::table('audit_program_grids', function (Blueprint $table) {
            $table->longText('through_req')->nullable();
            $table->string('Months')->nullable();
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
            $table->dropColumn('through_req')->nullable();
            $table->dropColumn('Months')->nullable();
        });
    }
};
