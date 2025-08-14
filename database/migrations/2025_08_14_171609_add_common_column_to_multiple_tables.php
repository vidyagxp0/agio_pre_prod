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
         Schema::table('c_c_s', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
        Schema::table('action_items', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
        Schema::table('extension_news', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
         Schema::table('resamplings', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
         Schema::table('observations', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
        Schema::table('root_cause_analyses', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
        Schema::table('risk_management', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
         Schema::table('effectiveness_checks', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
         Schema::table('management_reviews', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
         Schema::table('auditees', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
         Schema::table('internal_audits', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
        
         Schema::table('audit_programs', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
         Schema::table('capas', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
        Schema::table('lab_incidents', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
           Schema::table('o_o_s', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
         Schema::table('out_of_calibrations', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
         Schema::table('deviations', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
         Schema::table('marketcompalints', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
          Schema::table('non_conformances', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
         Schema::table('incidents', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
        Schema::table('failure_investigations', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
        Schema::table('erratas', function (Blueprint $table) {
            $table->integer('dashboard_unique_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('multiple_tables', function (Blueprint $table) {
            //
        });
    }
};
