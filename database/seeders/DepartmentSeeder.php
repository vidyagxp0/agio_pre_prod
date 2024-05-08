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
        $department->name = "Quality Assurance ";
        $department->dc = "QA";
        $department->save();

        $department  = new Department();
        $department->name = "Quality Control";
        $department->dc = "QC";
        $department->save();

        $department  = new Department();
        $department->name = "Production";
        $department->dc = "Prod";
        $department->save();

        $department  = new Department();
        $department->name = "Accounting Manager";
        $department->dc = "AM";
        $department->save();
    }
}
