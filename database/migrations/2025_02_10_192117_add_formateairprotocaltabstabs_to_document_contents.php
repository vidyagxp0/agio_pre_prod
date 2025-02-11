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
            //
            $table->longText('Protocolapproval_FoCompAaNirogenkp')->nullable();
            $table->longText('Objective_FoCompAaNirogenkp')->nullable();
            $table->longText('Purpose_FoCompAaNirogenkp')->nullable();
            $table->longText('Scope_FoCompAaNirogenkp')->nullable();
            $table->longText('ExcutionTeamResp_FoCompAaNirogenkp')->nullable();
            $table->longText('Abbreviations_FoCompAaNirogenkp')->nullable();
            $table->longText('EquipmentSystemIde_FoCompAaNirogenkp')->nullable();
            $table->longText('DocumentFollowed_FoCompAaNirogenkp')->nullable();
            $table->longText('GenralConsPre_FoCompAaNirogenkp')->nullable();
            $table->longText('RevalidCrite_FoCompAaNirogenkp')->nullable();
            $table->longText('Precautions_FoCompAaNirogenkp')->nullable();
            $table->longText('RevalidProcess_FoCompAaNirogenkp')->nullable();
            $table->longText('AcceptanceCrite_FoCompAaNirogenkp')->nullable();
            $table->longText('Annexure_FoCompAaNirogenkp')->nullable();
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
