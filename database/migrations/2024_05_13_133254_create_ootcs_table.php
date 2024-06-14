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
        Schema::create('ootcs', function (Blueprint $table) {
            $table->id();
            $table->text('record_number')->nullable();
            $table->text('division_id')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->text('intiation_date')->nullable();
            $table->text('due_date')->nullable();
            $table->text('severity_level')->nullable();
            $table->text('initiator_group')->nullable();
            $table->text('initiator_group_code')->nullable();
            $table->text('initiated_through')->nullable();
            $table->text('oot_details')->nullable();
            $table->text('producct_history')->nullable();
            $table->text('probble_cause')->nullable();
            $table->text('investigation_details')->nullable();
            $table->text('reference')->nullable();
            $table->text('productmaterialname')->nullable();
            $table->text('grade/typeofwater')->nullable();
            $table->text('sampleLocation/Point')->nullable();
            $table->text('market')->nullable();
            $table->text('customer')->nullable();
            $table->text('analyst_name')->nullable();
            $table->text('others')->nullable();
            $table->text('reference_record')->nullable();
            $table->text('specification_procedure_number')->nullable();
            $table->text('specification_limit')->nullable();
            $table->text('Attachment')->nullable(); 
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
        Schema::dropIfExists('ootcs');
    }
};
