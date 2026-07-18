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
        Schema::table('document_distribution_grid', function (Blueprint $table) {
            $table->longText('destructed_by')->nullable();
            $table->longText('destruction_date')->nullable();
            $table->longText('destructed_copies')->nullable();
            $table->longText('destruction_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_distribution_grid', function (Blueprint $table) {
            //
        });
    }
};
