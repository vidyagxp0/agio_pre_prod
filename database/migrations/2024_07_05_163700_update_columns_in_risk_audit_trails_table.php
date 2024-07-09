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
           // Drop the columns
           Schema::table('risk_audit_trails', function (Blueprint $table) {
            $table->dropColumn('activity_type');
            $table->dropColumn('previous');
            $table->dropColumn('current');
            $table->dropColumn('comment');
            $table->dropColumn('user_id');
            $table->dropColumn('user_name');
            $table->dropColumn('origin_state');
            $table->dropColumn('user_role');
            $table->dropColumn('stage');
            $table->dropColumn('change_to');
            $table->dropColumn('change_from');
            $table->dropColumn('action');
            $table->dropColumn('action_name');
        });

        // Re-add the columns with updated types
        Schema::table('risk_audit_trails', function (Blueprint $table) {
            $table->string('activity_type')->nullable();
            $table->longText('previous')->nullable();
            $table->longText('current')->nullable();
            $table->longText('comment')->nullable();
            $table->string('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('origin_state')->nullable();
            $table->string('user_role')->nullable();
            $table->string('stage')->nullable();
            $table->string('change_to')->nullable();
            $table->string('change_from')->nullable();
            $table->string('action')->nullable();
            $table->string('action_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('risk_audit_trails', function (Blueprint $table) {
            $table->dropColumn('activity_type');
            $table->dropColumn('previous');
            $table->dropColumn('current');
            $table->dropColumn('comment');
            $table->dropColumn('user_id');
            $table->dropColumn('user_name');
            $table->dropColumn('origin_state');
            $table->dropColumn('user_role');
            $table->dropColumn('stage');
            $table->dropColumn('change_to');
            $table->dropColumn('change_from');
            $table->dropColumn('action');
            $table->dropColumn('action_name');
        });

        // Re-add the columns with the original types
        Schema::table('risk_audit_trails', function (Blueprint $table) {
            $table->string('activity_type')->nullable();
            $table->string('previous')->nullable();
            $table->string('current')->nullable();
            $table->string('comment')->nullable();
            $table->string('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('origin_state')->nullable();
            $table->string('user_role')->nullable();
            $table->string('stage')->nullable();
            $table->string('change_to')->nullable();
            $table->string('change_from')->nullable();
            $table->string('action')->nullable();
            $table->string('action_name')->nullable();
        });
    }
};
