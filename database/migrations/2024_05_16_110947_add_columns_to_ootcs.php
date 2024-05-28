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
            $table->string('r_d_comments_part_b')->nullable();
            $table->string('a_d_l_comments')->nullable();
            $table->string('regulatory_comments')->nullable();
            $table->string('manufacturing_comments')->nullable();
            $table->string('technical_commitee_comments')->nullable();
            $table->string('supporting_documents')->nullable();
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
            $table->dropColumn('r_d_comments_part_b')->nullable();
            $table->dropColumn('a_d_l_comments')->nullable();
            $table->dropColumn('regulatory_comments')->nullable();
            $table->dropColumn('manufacturing_comments')->nullable();
            $table->dropColumn('technical_commitee_comments')->nullable();
            $table->dropColumn('supporting_documents')->nullable();

        });
    }
};
