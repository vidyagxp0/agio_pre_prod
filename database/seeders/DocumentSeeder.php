<?php

namespace Database\Seeders;
use App\Models\DocumentType;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $department  = new DocumentType();
        $department->name = "Standard Test Procedure ";
        $department->departmentid = 1;
        $department->typecode = "STP";
        $department->save();

        $department  = new DocumentType();
        $department->name = "Standard Operating Procedure";
        $department->departmentid = 2;
        $department->typecode = "SOP";
        $department->save();

        $department  = new DocumentType();
        $department->name = "Work Instruction";
        $department->departmentid = 3;
        $department->typecode = "WI";
        $department->save();

        $department  = new DocumentType();
        $department->name = "Specification ";
        $department->departmentid = 4;
        $department->typecode = "Spec";
        $department->save();

        $department  = new DocumentType();
        $department->name = "Validation Protocol  ";
        $department->departmentid = 5;
        $department->typecode = "VP";
        $department->save();

        $department  = new DocumentType();
        $department->name = "Process Flow Diagram   ";
        $department->departmentid = 6;
        $department->typecode = "PFD";
        $department->save();

        $department  = new DocumentType();
        $department->name = "Qualification Protocol   ";
        $department->departmentid = 7;
        $department->typecode = "QP";
        $department->save();

        $department  = new DocumentType();
        $department->name = "Standard Operation Procedure for Microbiology   ";
        $department->departmentid = 8;
        $department->typecode = "SOP-M";
        $department->save();

        $department  = new DocumentType();
        $department->name = "Standard Operation Procedure for Chemistry/Wet Chemistry   ";
        $department->departmentid = 9;
        $department->typecode = "SOP-C";
        $department->save(); 
        
        $department  = new DocumentType();
        $department->name = "Standard Operation Procedure for Instrumental/Analytical Tests   ";
        $department->departmentid = 10;
        $department->typecode = "SOP-A";
        $department->save(); 

        $department  = new DocumentType();
        $department->name = "Standard Operation Procedure for Equipment/ Instruments SOP   ";
        $department->departmentid = 11;
        $department->typecode = "SOP-E";
        $department->save(); 

        $department  = new DocumentType();
        $department->name = "Quality Policies   ";
        $department->departmentid = 12;
        $department->typecode = "QP";
        $department->save(); 

        $department  = new DocumentType();
        $department->name = "Method Validation    ";
        $department->departmentid = 13;
        $department->typecode = "MV";
        $department->save(); 

        $department  = new DocumentType();
        $department->name = "Validation Protocol   ";
        $department->departmentid = 14;
        $department->typecode = "VP";
        $department->save(); 

        $department  = new DocumentType();
        $department->name = "Electron   ";
        $department->departmentid = 15;
        $department->typecode = "EIR";
        $department->save(); 
    }
}
