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
        Schema::table('deviations', function (Blueprint $table) {
            $table->string('capa_number')->nullable();
            $table->string('department_capa')->nullable();
            $table->string('source_of_capa')->nullable();
            $table->string('capa_others')->nullable();
            $table->string('source_doc')->nullable();
            $table->longText('Description_of_Discrepancy')->nullable();
            $table->longText('capa_root_cause')->nullable();
            $table->longText('Immediate_Action_Take')->nullable();
            $table->longText('Corrective_Action_Details')->nullable();
            $table->longText('Preventive_Action_Details')->nullable();
            $table->string('capa_completed_date')->nullable();
            $table->longText('Interim_Control')->nullable();
            $table->longText('Corrective_Action_Taken')->nullable();
            $table->longText('Preventive_action_Taken')->nullable();
            $table->longText('CAPA_Closure_Comments')->nullable();
            $table->longText('CAPA_Closure_attachment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deviation', function (Blueprint $table) {
            //
        });
    }
};
