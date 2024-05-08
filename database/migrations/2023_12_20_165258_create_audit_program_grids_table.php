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
        Schema::create('audit_program_grids', function (Blueprint $table) {
            $table->id();
            $table->text('serial_number')->nullable();
            $table->bigInteger('audit_program_id')->nullable();
            $table->text('auditor')->nullable();
            $table->text('start_date')->nullable();
            $table->text('end_date')->nullable();
            $table->text('lead_investigator')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('audit_program_grids');
    }
};
