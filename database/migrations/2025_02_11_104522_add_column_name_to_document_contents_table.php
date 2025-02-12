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
        Schema::table('document_contents', function (Blueprint $table) {
            $table->longtext('format_approval')->nullable();
            $table->longtext('format_objective')->nullable();
            $table->longtext('format_scope')->nullable();
            $table->longtext('formatidentification')->nullable();
            $table->longtext('executiontteam')->nullable();
            $table->longtext('formatdocuments')->nullable();
            $table->longtext('revalidationtype')->nullable();
            $table->longtext('RevalidationCriteria')->nullable();
            $table->longtext('generalconsideration')->nullable();
            $table->longtext('precautions')->nullable();
            $table->longtext('calibrationstatus')->nullable();
            $table->longtext('testobservation')->nullable();
            $table->longtext('formatannexure')->nullable();
            $table->longtext('formatdeviation')->nullable();
            $table->longtext('formatcc')->nullable();
            $table->longtext('formatsummary')->nullable();
            $table->longtext('formatconclusion')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_contents', function (Blueprint $table) {
            //
        });
    }
};
