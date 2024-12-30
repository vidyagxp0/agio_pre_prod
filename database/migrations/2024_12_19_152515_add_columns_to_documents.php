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
        Schema::table('documents', function (Blueprint $table) {
            $table->text("master_copy_number")->nullable();
            $table->text("controlled_copy_number")->nullable();
            $table->text("display_copy_number")->nullable();
            $table->longtext("master_user_department")->nullable();
            $table->longtext("controlled_user_department")->nullable();
            $table->longtext("display_user_department")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            //
        });
    }
};
