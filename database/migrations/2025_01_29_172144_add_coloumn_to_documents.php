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
            $table->Text('name_pack_material')->nullable();
            $table->Text('standard_pack')->nullable();
            $table->Text('sampling_plan')->nullable();
            $table->Text('sampling_instruction')->nullable();
            $table->Text('sample_analysis')->nullable()  ;
            $table->Text('control_sample')->nullable();
            $table->Text('safety_precaution')->nullable();
            $table->Text('storage_condition')->nullable();
            $table->Text('approved_vendor')->nullable();
           
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
