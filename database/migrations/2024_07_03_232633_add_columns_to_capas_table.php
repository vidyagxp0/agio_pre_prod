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
        Schema::table('capas', function (Blueprint $table) {

            $table->string('qa_more_info_required_by1')->nullable();
            $table->string('qa_more_info_required_on1')->nullable();
            $table->string('all_actions_completed_by')->nullable();
            $table->string('all_actions_completed_on')->nullable();
            $table->string('plan_proposed_on_comment')->nullable();
            $table->string('plan_approved_on_comment')->nullable();
            $table->string('qa_more_info_required_on1_comment')->nullable();
            $table->string('completed_on_comment')->nullable();
            $table->string('approved_on_comment')->nullable();
            $table->string('all_actions_completed_on_comment')->nullable();
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('capas', function (Blueprint $table) {
            //
        });
    }
};
