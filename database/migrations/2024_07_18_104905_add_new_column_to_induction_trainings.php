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
            $table->string('department')->nullable()->after('name_employee');
            $table->string('location')->nullable()->after('department');
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
            //
        });
    }
};
