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
            //

            Schema::table('root_cause_analyses', function (Blueprint $table) {
                $table->longText('objective')->nullable();
                $table->longText('scope')->nullable();
                $table->longText('problem_statement_rca')->nullable();
                $table->longText('requirement')->nullable();
                $table->longText('immediate_action')->nullable();
                $table->longText('investigation_team')->nullable();
                $table->longText('investigation_tool')->nullable();
                $table->longText('root_cause')->nullable();
                $table->longText('impact_risk_assessment')->nullable();
                $table->longText('capa')->nullable();
                $table->longText('root_cause_description_rca')->nullable();
                $table->longText('investigation_summary_rca')->nullable();
                $table->longText('root_cause_initial_attachment_rca')->nullable();
                $table->longText('qa_reviewer')->nullable();
                $table->longText('add_filed')->nullable();
                
            });
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
            $table->dropColumn([
                'objective', 
                'scope', 
                'problem_statement_rca', 
                'requirement', 
                'immediate_action', 
                'investigation_team', 
                'investigation_tool', 
                'root_cause', 
                'impact_risk_assessment', 
                'capa', 
                'root_cause_description_rca', 
                'investigation_summary_rca', 
                'root_cause_initial_attachment_rca',
                'qa_reviewer',
                'add_filed'
            ]);
        });
    }
};
