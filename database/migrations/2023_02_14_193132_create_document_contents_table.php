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
        Schema::create('document_contents', function (Blueprint $table) {

            // $table->id();
            // $table->string('purpose')->nullable();
            // $table->string('scope')->nullable();
            // $table->string('responsibility')->nullable();
            // $table->string('abbreviation')->nullable();
            // $table->string('defination')->nullable();
            // $table->string('materials_and_equipments')->nullable();
            // $table->string('procedure')->nullable();
            // $table->string('reporting')->nullable();
            // $table->string('reference_text')->nullable();
            // $table->string('references')->nullable();
            // $table->string('ann')->nullable();
            // $table->string('serial_number')->nullable();
            // $table->string('annexure_number')->nullable();
            // $table->string('annexure_data')->nullable();
            // // $table->integer('reporting')->nullable();

            $table->bigIncrements('id');
            $table->bigInteger('document_id');
            $table->longtext('purpose')->nullable();
            $table->longtext('scope')->nullable();
            $table->longtext('responsibility')->nullable();
            $table->longtext('abbreviation')->nullable();
            $table->longtext('defination')->nullable();
            $table->longtext('materials_and_equipments')->nullable();
            $table->longtext('procedure')->nullable();
            $table->longtext('reporting')->nullable();
            $table->longtext('references')->nullable();
            $table->longtext('annexuredata')->nullable();
            $table->longtext('ann')->nullable();
            $table->longtext('distribution')->nullable();
            $table->softDeletes();
            $table->timestamps();
            // $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_contents');
    }
};
