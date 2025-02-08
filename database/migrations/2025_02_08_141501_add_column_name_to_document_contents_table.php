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
        Schema::table('document_contents', function (Blueprint $table) {
            $table->longtext('stprotocol_purpose')->nullable();
            $table->longtext('stprotocol_scope')->nullable();
            $table->longtext('stresponsibility')->nullable();
            $table->longtext('stdefination')->nullable();
            $table->longtext('streferences')->nullable();
            $table->longtext('stbackground')->nullable();
            $table->longtext('stassessment')->nullable();
            $table->longtext('ststrategy')->nullable();
            $table->longtext('stsummary')->nullable();
            $table->longtext('stconclusion')->nullable();
            $table->longtext('stannexure')->nullable();
            $table->longtext('Referencedocunum')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_contents', function (Blueprint $table) {
            //
        });
    }
};
