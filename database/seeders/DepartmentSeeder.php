<?php

namespace Database\Seeders;

use App\Models\Department;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $department  = new Department();
        $department->name = "Corporate Quality Assurance";
        $department->dc = "CQA";
        $department->save();

        $department  = new Department();
        $department->name = "Quality Control (Microbiology department)";
        $department->dc = "QM";
        $department->save();

        $department  = new Department();
        $department->name = "Engineering";
        $department->dc = "EN";
        $department->save();

        $department  = new Department();
        $department->name = "Store";
        $department->dc = "ST";
        $department->save();

        $department  = new Department();
        $department->name = "Production Injectable";
        $department->dc = "PI";
        $department->save();

        $department  = new Department();
        $department->name = "Production External";
        $department->dc = "PE";
        $department->save();

        $department  = new Department();
        $department->name = "Production Tablet,Powder and Capsule";
        $department->dc = "PT";
        $department->save();

        $department  = new Department();
        $department->name = "Quality Assurance";
        $department->dc = "QA";
        $department->save();

        $department  = new Department();
        $department->name = "Quality Control";
        $department->dc = "QC";
        $department->save();

        $department  = new Department();
        $department->name = "Regulatory Affairs";
        $department->dc = "RA";
        $department->save();

        $department  = new Department();
        $department->name = "Packaging Development /Artwork";
        $department->dc = "PD";
        $department->save();

        $department  = new Department();
        $department->name = "Artwork";
        $department->dc = "AW";
        $department->save();

        $department  = new Department();
        $department->name = "Research & Development";
        $department->dc = "R&D";
        $department->save();

        $department  = new Department();
        $department->name = "Human Resource";
        $department->dc = "HR";
        $department->save();

        $department  = new Department();
        $department->name = "Marketing";
        $department->dc = "MK";
        $department->save();

        $department  = new Department();
        $department->name = "Analytical research and Development Laboratory";
        $department->dc = "AL";
        $department->save();

        $department  = new Department(); 
        $department->name = "Information Technology";
        $department->dc = "IT";
        $department->save();

        $department  = new Department();
        $department->name = "Safety";
        $department->dc = "SA";
        $department->save();

        $department  = new Department();
        $department->name = "Purchase Department";
        $department->dc = "PU";
        $department->save();
    
    }
}
