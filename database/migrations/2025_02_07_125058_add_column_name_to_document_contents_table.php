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
            $table->longtext('study_purpose')->nullable();
            $table->longtext('study_scope')->nullable();
            $table->longtext('responsibilities')->nullable();
            $table->longtext('referencesss')->nullable();
            $table->longtext('assessment')->nullable();
            $table->longtext('strategy')->nullable();
            $table->longtext('summary_and_findings')->nullable();
            $table->longtext('conclusion_and_recommendations')->nullable();
            $table->longtext('study_attachments')->nullable();

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
