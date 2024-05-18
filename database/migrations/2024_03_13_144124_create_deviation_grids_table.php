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
        Schema::create('deviation_grids', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->longText('IDnumber')->nullable();
            $table->longText('facility_name')->nullable();
            $table->string('deviation_grid_id')->nullable();
            $table->longText('Remarks')->nullable();
            $table->longText('SystemName')->nullable();
            $table->longText('Instrument')->nullable();
            $table->longText('Equipment')->nullable();
            $table->longText('facility')->nullable();
            $table->longText('Number')->nullable();
            $table->longText('Document_Remarks')->nullable();
            $table->longText('ReferenceDocumentName')->nullable();
            $table->longText('nameofproduct')->nullable();
            $table->string('ExpiryDate')->nullable();
            $table->longText('Production_Person')->nullable();
            $table->longText('Production_Impect_Assessment')->nullable();
            $table->longText('Production_Comments')->nullable();
            $table->longText('Production_signdate')->nullable();
            $table->longText('Production_Remarks')->nullable();
           // --new---
            $table->longText('Warehouse_Person')->nullable();
            $table->longText('Warehouse_Impect_Assessment')->nullable();
            $table->longText('Warehouse_Comments')->nullable();
            $table->longText('Warehouse_signdate')->nullable();
            $table->longText('Warehouse_Remarks')->nullable();
            $table->longText('Quality_Person')->nullable();
            $table->longText('Quality_Impect_Assessment')->nullable();
            $table->longText('Quality_Comments')->nullable();
            $table->longText('Quality_signdate')->nullable();
            $table->longText('Quality_Remarks')->nullable();
            $table->longText('Assurance_Person')->nullable();
            $table->longText('Assurance_Impect_Assessment')->nullable();
            $table->longText('Assurance_Comments')->nullable();
            $table->longText('Assurance_signdate')->nullable();
            $table->longText('Assurance_Remarks')->nullable();
            $table->longText('Engineering_Person')->nullable();
            $table->longText('Engineering_Impect_Assessment')->nullable();
            $table->longText('Engineering_Comments')->nullable();
            $table->longText('Engineering_signdate')->nullable();
            $table->longText('Engineering_Remarks')->nullable();
            $table->longText('Analytical_Person')->nullable();
            $table->longText('Analytical_Impect_Assessment')->nullable();
            $table->longText('Analytical_Comments')->nullable();
            $table->longText('Analytical_signdate')->nullable();
            $table->longText('Analytical_Remarks')->nullable();
            $table->longText('Process_Person')->nullable();
            $table->longText('Process_Impect_Assessment')->nullable();
            $table->longText('Process_Comments')->nullable();
            $table->longText('Process_signdate')->nullable();
            $table->longText('Process_Remarks')->nullable();
            $table->longText('Technology_Person')->nullable();
            $table->longText('Technology_Impect_Assessment')->nullable();
            $table->longText('Technology_Comments')->nullable();
            $table->longText('Technology_signdate')->nullable();
            $table->longText('Technology_Remarks')->nullable();
            $table->longText('Environment_Person')->nullable();
            $table->longText('Environment_Impect_Assessment')->nullable();
            $table->longText('Environment_Comments')->nullable();
            $table->longText('Environment_signdate')->nullable();
            $table->longText('Environment_Remarks')->nullable();
             $table->longText('Human_Person')->nullable();
            $table->longText('Human_Impect_Assessment')->nullable();
            $table->longText('Human_Comments')->nullable();
            $table->longText('Human_signdate')->nullable();
            $table->longText('Human_Remarks')->nullable();
            $table->longText('Information_Person')->nullable();
            $table->longText('Information_Impect_Assessment')->nullable();
            $table->longText('Information_Comments')->nullable();
            $table->longText('Information_signdate')->nullable();
            $table->longText('Information_Remarks')->nullable();
            $table->longText('Project_Person')->nullable();
            $table->longText('Project_Impect_Assessment')->nullable();
            $table->longText('Project_Comments')->nullable();
            $table->longText('Project_signdate')->nullable();
            $table->longText('Project_Remarks')->nullable();
            $table->longText('Any_Person')->nullable();
            $table->longText('Any_Impect_Assessment')->nullable();
            $table->longText('Any_Comments')->nullable();
            $table->longText('Any_signdate')->nullable();
            $table->longText('Any_Remarks')->nullable();

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
        Schema::dropIfExists('deviation_grids');
    }
};
