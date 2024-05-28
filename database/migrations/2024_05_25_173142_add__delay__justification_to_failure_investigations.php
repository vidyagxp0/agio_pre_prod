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
        Schema::table('failure_investigations', function (Blueprint $table) {
            $table->string('Delay_Justification')->nullable();
            $table->string('Discription_Event')->nullable();
            $table->string('objective')->nullable();
            $table->string('scope')->nullable();
            $table->string('imidiate_action')->nullable();
            $table->string('investigation_approach')->nullable();

            $table->longtext('attention_issues')->nullable();
            $table->longtext('attention_actions')->nullable();
            $table->longtext('attention_remarks')->nullable();

            $table->longtext('understanding_issues')->nullable();
            $table->longtext('understanding_actions')->nullable();
            $table->longtext('understanding_remarks')->nullable();

            $table->longtext('procedural_issues')->nullable();
            $table->longtext('procedural_actions')->nullable();
            $table->longtext('procedural_remarks')->nullable();

            $table->longtext('behavioiral_issues')->nullable();
            $table->longtext('behavioiral_actions')->nullable();
            $table->longtext('behavioiral_remarks')->nullable();

            $table->longtext('skill_issues')->nullable();
            $table->longtext('skill_actions')->nullable();
            $table->longtext('skill_remarks')->nullable();

            $table->longtext('what_will_be')->nullable();
            $table->longtext('what_will_not_be')->nullable();
            $table->longtext('what_rationable')->nullable();
            $table->longtext('where_will_be')->nullable();
            $table->longtext('where_will_not_be')->nullable();
            $table->longtext('where_rationable')->nullable();
            $table->longtext('when_will_be')->nullable();
            $table->longtext('when_will_not_be')->nullable();
            $table->longtext('when_rationable')->nullable();
            $table->longtext('coverage_will_be')->nullable();
            $table->longtext('coverage_will_not_be')->nullable();
            $table->longtext('coverage_rationable')->nullable();
            $table->longtext('who_will_be')->nullable();
            $table->longtext('who_will_not_be')->nullable();
            $table->longtext('who_rationable')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('failure_investigations', function (Blueprint $table) {
            //
        });
    }
};
