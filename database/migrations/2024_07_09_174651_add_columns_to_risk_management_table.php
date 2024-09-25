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
        Schema::table('risk_management', function (Blueprint $table) {
            $table->text('submit_comment')->nullable();
            $table->text('evaluation_complete_comment')->nullable();
            $table->text('action_plan_complete_comment')->nullable();
            $table->text('action_plan_approved_comment')->nullable();
            $table->text('all_actions_completed_comment')->nullable();
            $table->text('risk_eveluation_comment')->nullable();
            $table->text('more_actions_needed_1')->nullable();
            $table->text('more_actions_needed_2')->nullable();
            $table->text('more_actions_needed_3')->nullable();
            $table->text('more_actions_needed_4')->nullable();
            $table->text('more_actions_needed_5')->nullable();
            $table->text('cancel_comment')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('risk_management', function (Blueprint $table) {
            $table->dropColumn([
                'submit_comment', 
                'evaluation_complete_comment', 
                'action_plan_complete_comment', 
                'action_plan_approved_comment', 
                'all_actions_completed_comment', 
                'risk_eveluation_comment', 
                'more_actions_needed_1', 
                'more_actions_needed_2', 
                'more_actions_needed_3', 
                'more_actions_needed_4', 
                'more_actions_needed_5', 
                'cancel_comment'
            ]);
        });
    }
};
