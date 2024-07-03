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
        Schema::table('incidents', function (Blueprint $table) {
            $table->text('department_capa')->nullable();
            $table->text('source_of_capa')->nullable();
            $table->longText('capa_others')->nullable();
            $table->longText('source_doc')->nullable();
            $table->longText('Description_of_Discrepancy')->nullable();
            $table->text('capa_root_cause')->nullable();
            $table->text('Immediate_Action_Take')->nullable();
            $table->text('Corrective_Action_Details')->nullable();
            $table->longText('Preventive_Action_Details')->nullable();
            $table->text('capa_completed_date')->nullable();
            $table->text('Interim_Control')->nullable();
            $table->text('Corrective_Action_Taken')->nullable();
            $table->text('Preventive_action_Taken')->nullable();
            $table->text('CAPA_Closure_Comments')->nullable();
            $table->text('CAPA_Closure_attachment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incidents', function (Blueprint $table) {
            $table->dropColumn('department_capa')->nullable();
            $table->dropColumn('source_of_capa')->nullable();
            $table->dropColumn('capa_others')->nullable();
            $table->dropColumn('source_doc')->nullable();
            $table->dropColumn('Description_of_Discrepancy')->nullable();
            $table->dropColumn('capa_root_cause')->nullable();
            $table->dropColumn('Immediate_Action_Take')->nullable();
            $table->dropColumn('Corrective_Action_Details')->nullable();
            $table->dropColumn('Preventive_Action_Details')->nullable();
            $table->dropColumn('capa_completed_date')->nullable();
            $table->dropColumn('Interim_Control')->nullable();
            $table->dropColumn('Corrective_Action_Taken')->nullable();
            $table->dropColumn('Preventive_action_Taken')->nullable();
            $table->dropColumn('CAPA_Closure_Comments')->nullable();
            $table->dropColumn('CAPA_Closure_attachment')->nullable();

        });
    }
};
