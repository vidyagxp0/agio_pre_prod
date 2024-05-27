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
        Schema::table('ootcs', function (Blueprint $table) {
            $table->string('last_due_date')->nullable();
            $table->string('progress_justification_delay')->nullable();
            $table->string('tentative_clousure_date')->nullable();
            $table->string('remarks_by_qa_department')->nullable();
            $table->string('conclusion_attechment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ootcs', function (Blueprint $table) {
            
            $table->dropColumn('last_due_date')->nullable();
            $table->dropColumn('progress_justification_delay')->nullable();
            $table->dropColumn('tentative_clousure_date')->nullable();
            $table->dropColumn('remarks_by_qa_department')->nullable();
            $table->dropColumn('conclusion_attechment')->nullable();
        });
    }
};
