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
        Schema::create('risk_assessments', function (Blueprint $table) {
            $table->id();
            $table->integer('cc_id');
            $table->text('risk_identification')->nullable();
            $table->string('division_id')->nullable();
            $table->text('severity')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('parent_type')->nullable();
            $table->text('Occurance')->nullable();
            $table->text('Detection')->nullable();
            $table->text('RPN')->nullable();
            $table->text('risk_evaluation')->nullable();
            $table->text('migration_action')->nullable();
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
        Schema::dropIfExists('risk_assessments');
    }
};
