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
            $table->longtext('equipment_objective')->nullable();
            $table->longtext('equipment_scope')->nullable();
            $table->longtext('equipment_purpose')->nullable();
            $table->longtext('euipmentresponsibility')->nullable();
            $table->longtext('eqpAnalyticalReport')->nullable();
            $table->longtext('eqpdeviation')->nullable();
            $table->longtext('eqpchangecontrol')->nullable();
            $table->longtext('eqpsummary')->nullable();
            $table->longtext('eqpconclusion')->nullable();
            $table->longtext('eqpreportapproval')->nullable();

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
