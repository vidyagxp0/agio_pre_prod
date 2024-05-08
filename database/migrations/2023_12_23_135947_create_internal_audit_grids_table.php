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
        Schema::create('internal_audit_grids', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('audit_id')->nullable();
            $table->string('type')->nullable();
            $table->text('area_of_audit')->nullable();
            $table->text('start_date')->nullable();
            $table->text('start_time')->nullable();
            $table->text('end_date')->nullable();
            $table->text('end_time')->nullable();
            $table->text('auditor')->nullable();
            $table->text('auditee')->nullable();
            $table->text('remark')->nullable();
            $table->text('observation_id')->nullable();
            $table->text('date')->nullable();
            $table->text('observation_description')->nullable();
            $table->text('severity_level')->nullable();
            $table->text('area')->nullable();
            $table->text('observation_category')->nullable();
            $table->text('capa_required')->nullable();
            $table->text('auditee_response')->nullable();
            $table->text('auditor_review_on_response')->nullable();
            $table->text('qa_comment')->nullable();
            $table->text('capa_details')->nullable();
            $table->text('capa_due_date')->nullable();
            $table->text('capa_owner')->nullable();
            $table->text('action_taken')->nullable();
            $table->text('capa_completion_date')->nullable();
            $table->text('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internal_audit_grids');
    }
};
