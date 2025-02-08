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
        Schema::table('document_contents', function (Blueprint $table) {
            $table->longtext('htsp_purpose')->nullable();
            $table->longtext('htsp_scope')->nullable();
            $table->longtext('htsp_responsibility')->nullable();
            $table->longtext('htsp_description_of_sop')->nullable();
            $table->longtext('htsp_specifications')->nullable();
            $table->longtext('htsp_sampling_analysis')->nullable();
            $table->longtext('htsp_environmental_conditions')->nullable();
            $table->longtext('htsp_sample_quantity_calculation')->nullable();
            $table->longtext('htsp_deviation')->nullable();
            $table->longtext('htsp_summary')->nullable();
            $table->longtext('htsp_conclusion')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_contents', function (Blueprint $table) {
            //
        });
    }
};
