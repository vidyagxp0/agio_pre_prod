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
        Schema::table('marketcompalints', function (Blueprint $table) {
            $table->longText('review_of_stability_study_gi')->nullable();
            $table->longText('review_of_product_manu_gi')->nullable();
            $table->longText('additional_inform')->nullable();
            $table->longText('in_case_Invalide_com')->nullable();
            $table->longText('conclusion_pi')->nullable();
            $table->longText('the_probable_root')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketcompalints', function (Blueprint $table) {
            //
        });
    }
};
