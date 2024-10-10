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
        Schema::table('internal_audits', function (Blueprint $table) {
            $table->text('Description_Deviation_IIIII')->nullable();
            $table->text('Description_Deviation_III')->nullable();
            $table->text('Description_Deviation_IV')->nullable();
            $table->text('Description_Deviation_V')->nullable();
            $table->text('Description_Deviation_VI')->nullable();
            $table->text('Description_DeviationVII')->nullable();
            $table->text('Description_DeviationVIII')->nullable();
            $table->text('Description_DeviationIX')->nullable();
            $table->text('Description_DeviationX')->nullable();
            $table->text('Description_DeviationXI')->nullable();
            $table->text('Description_DeviationXII')->nullable();
            $table->text('Description_DeviationXIII')->nullable();
            $table->text('Description_DeviationXIV')->nullable();
            $table->text('Description_DeviationXV')->nullable();
            $table->text('Description_DeviationXVI')->nullable();
            $table->text('Description_DeviationXVII')->nullable();
            $table->text('Description_DeviationXVIII')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('internal_audits', function (Blueprint $table) {
            //
        });
    }
};
