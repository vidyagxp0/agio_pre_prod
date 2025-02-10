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
            $table->longtext('pvp_purpose')->nullable();
            $table->longtext('pvp_scope')->nullable();
            $table->longtext('reasonfor_validationpvp')->nullable();
            $table->longtext('pvp_responsibility')->nullable();
            $table->longtext('pvp_validationpvp')->nullable();
            $table->longtext('descriptionsop_pvp')->nullable();
            $table->longtext('packingmaterial_pvp')->nullable();
            $table->longtext('equipment_pvp')->nullable();
            $table->longtext('rationale_pvp')->nullable();
            $table->longtext('sampling_pvp')->nullable();
            $table->longtext('critical_pvp')->nullable();
            $table->longtext('product_acceptancepvp')->nullable();
            $table->longtext('Holdtime_pvp')->nullable();
            $table->longtext('cleaning_validationpvp')->nullable();
            $table->longtext('Stability_studypvp')->nullable();
            $table->longtext('Deviation_pvp')->nullable();
            $table->longtext('Change_controlpvp')->nullable();
            $table->longtext('Summary_pvp')->nullable();
            $table->longtext('Conclusion_pvp')->nullable();
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
