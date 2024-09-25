<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Schema::table('o_o_s__micro_audit_trials', function (Blueprint $table) {
        //     // Drop the column
        //     $table->dropColumn('previous');
        //     $table->dropColumn('current');
        //     $table->dropColumn('comment')->nullable();
        //     $table->dropColumn('origin_state')->nullable();
        //     $table->dropColumn('change_from')->nullable();
        //     $table->dropColumn('change_to')->nullable();
        //     $table->dropColumn('action_name')->nullable();
        //     $table->dropColumn('action')->nullable();
        // });

        Schema::table('o_o_s__micro_audit_trials', function (Blueprint $table) {
            // Add the column with the new type
            // $table->longText('previous')->nullable();
            // $table->longText('current')->nullable();
            // $table->longText('comment')->nullable();
            // $table->longText('origin_state')->nullable();
            // $table->longText('change_from')->nullable();
            // $table->longText('change_to')->nullable();
            // $table->longText('action_name')->nullable();
            // $table->longText('action')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('o_o_s__micro_audit_trials', function (Blueprint $table) {
            // Drop the column with the new type
            // $table->dropColumn('previous');
            // $table->dropColumn('current');
            // $table->dropColumn('comment');
            // $table->dropColumn('origin_state');
            // $table->dropColumn('change_from');
            // $table->dropColumn('change_to');
            // $table->dropColumn('action_name');
            // $table->dropColumn('action');

        });

        // Schema::table('o_o_s__micro_audit_trials', function (Blueprint $table) {
        //     // Add the column with the original type
            
        //     $table->string('previous')->nullable();
        //     $table->string('current')->nullable();
        //     $table->string('comment')->nullable();
        //     $table->string('origin_state')->nullable();
        //     $table->string('change_from')->nullable();
        //     $table->string('change_to')->nullable();
        //     $table->string('action_name')->nullable();
        //     $table->string('action')->nullable();
            
        // });

    }
};
