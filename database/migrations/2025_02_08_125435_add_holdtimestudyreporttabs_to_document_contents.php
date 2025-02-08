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
            
            $table->longText('Purpose_HoTiStRe')->nullable();
            $table->longText('Scope_HoTiStRe')->nullable();
            $table->longText('BatchDetails_HoTiStRe')->nullable();
            $table->longText('ReferenceDocument_HoTiStRe')->nullable();
            $table->longText('ResultBulkStage_HoTiStRe')->nullable();
            $table->longText('DeviationIfAny_HoTiStRe')->nullable();
            $table->longText('Summary_HoTiStRe')->nullable();
            $table->longText('Conclusion_HoTiStRe')->nullable();
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
