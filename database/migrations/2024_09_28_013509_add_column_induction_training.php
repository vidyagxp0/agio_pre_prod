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
        Schema::table('induction_trainings', function (Blueprint $table) {
            $table->integer('attempt_count')->default(3); // Change 'string' and options as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('induction_trainings', function (Blueprint $table) {
            $table->dropColumn('attempt_count');
        });
    }
};
