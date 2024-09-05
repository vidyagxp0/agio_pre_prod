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
            for ($i = 1; $i <= 16; $i++) {
                $table->string("attachment_$i")->nullable()->after("remark_$i");
            }
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
            for ($i = 1; $i <= 16; $i++) {
                $table->dropColumn("attachment_$i");
            }
        });
    }
};
