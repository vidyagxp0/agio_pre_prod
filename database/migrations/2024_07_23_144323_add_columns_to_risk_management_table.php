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
        Schema::table('risk_management', function (Blueprint $table) {
            $table->text('risk_level')->nullable();
            
            $table->text('risk_level_2')->nullable();
            $table->longtext('purpose')->nullable();
            
            $table->longtext('scope')->nullable();
            $table->longtext('reason_for_revision')->nullable();
            $table->longtext('Brief_description')->nullable();
            $table->longtext('document_used_risk')->nullable();
            $table->longtext('risk_level3')->nullable();
            
            $table->longtext('risk_attachment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('risk_management', function (Blueprint $table) {
            

            $table->dropColumn([
                        'risk_attachment',  'purpose','scope','reason_for_revision','Brief_description','document_used_risk','risk_level3','risk_level_2','risk_level']);
        });
    }
};
