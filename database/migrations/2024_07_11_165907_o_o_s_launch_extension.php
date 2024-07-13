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
        Schema::create('oos_launch_extensions', function (Blueprint $table) {
            $table->id();
            $table->integer('oos_id')->nullable();
            $table->longtext('extension_identifier')->nullable();
            $table->longtext('oos_proposed_due_date')->nullable();
            $table->longtext('oos_extension_justification')->nullable();
            $table->longtext('oos_extension_completed_by')->nullable();
            $table->longtext('oos_extension_completed_on')->nullable();
            $table->longtext('capa_proposed_due_date')->nullable();
            $table->longtext('capa_extension_justification')->nullable();
            $table->longtext('capa_extension_completed_by')->nullable();
            $table->longtext('capa_extension_completed_on')->nullable();
            $table->longtext('qrm_proposed_due_date')->nullable();
            $table->longtext('qrm_extension_justification')->nullable();
            $table->longtext('qrm_extension_completed_by')->nullable();
            $table->longtext('qrm_extension_completed_on')->nullable();

            $table->longtext('investigation_proposed_due_date')->nullable();
            $table->longtext('investigation_extension_justification')->nullable();
            $table->longtext('investigation_extension_completed_by')->nullable();
            $table->longtext('investigation_extension_completed_on')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
