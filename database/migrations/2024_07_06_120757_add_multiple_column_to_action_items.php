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
        Schema::table('action_items', function (Blueprint $table) {
            $table->longText('acknowledgement_by')->nullable();
            $table->longText('acknowledgement_on')->nullable();
            $table->longText('acknowledgement_comment')->nullable();
            $table->longText('work_completion_by')->nullable();
            $table->longText('work_completion_on')->nullable();
            $table->longText('work_completion_comment')->nullable();
            $table->longText('related_records')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_items', function (Blueprint $table) {
            //
        });
    }
};
