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
        Schema::create('change_closures', function (Blueprint $table) {
            $table->id();
            $table->integer('cc_id');
            $table->string('sno')->nullable();
            $table->longText('affected_document')->nullable();
            $table->longText('doc_name')->nullable();
            $table->longText('doc_no')->nullable();
            $table->longText('version_no')->nullable();
            $table->longText('implementation_date')->nullable();
            $table->longText('new_doc_no')->nullable();
            $table->longText('new_version_no')->nullable();
            $table->longText('qa_closure_comments')->nullable();
            $table->text('attach_list')->nullable();
            $table->text('effective_check')->nullable();
            $table->date('effective_check_date')->nullable();
            $table->text('Effectiveness_checker')->nullable();
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
        Schema::dropIfExists('change_closures');
    }
};
