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
            $table->longtext('eqp_approval')->nullable();
            $table->longtext('eqp_objective')->nullable();
            $table->longtext('eqp_scope')->nullable();
            $table->longtext('eqpresponsibility')->nullable();
            $table->longtext('eqpdetails')->nullable();
            $table->longtext('eqpsampling')->nullable();
            $table->longtext('Samplingprocedure')->nullable();
            $table->longtext('AcceptenceCriteria')->nullable();
            $table->longtext('EnvironmentalConditions')->nullable();
            $table->longtext('eqpdetailsdeviation')->nullable();
            $table->longtext('eqpdetailschangecontrol')->nullable();
            $table->longtext('eqpdetailssummary')->nullable();
            $table->longtext('eqpdetailsconclusion')->nullable();
            $table->longtext('eqpdetailstraining')->nullable();

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
