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
        Schema::create('rootcause_analysis_doc_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('root_id')->nullable();
            $table->string('type')->nullable();
            $table->text('Question')->nullable();
            $table->text('Response')->nullable();
            $table->string('cancelled_by')->nullable();
             $table->string('cancelled_on')->nullable();
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
        Schema::dropIfExists('rootcause_analysis_doc_details');
    }
};
