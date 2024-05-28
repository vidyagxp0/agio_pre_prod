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
        $department->name = "Calibration Lab ";
        $department->dc = "CLB";
        $department->save();

        $department  = new Department();
        $department->name = "Engineering ";
        $department->dc = "ENG";
        $department->save();

        $department  = new Department();
        $department->name = "Facilities ";
        $department->dc = "FAC";
        $department->save();

        $department  = new Department();
        $department->name = "LAB ";
        $department->dc = "LAB";
        $department->save();

        $department  = new Department();
        $department->name = "Labeling  ";
        $department->dc = "LABL";
        $department->save();

        $department  = new Department();
        $department->name = "Manufacturing ";
        $department->dc = "MANU";
        $department->save();

        $department  = new Department();
        $department->name = "Quality Assurance ";
        $department->dc = "QA";
        $department->save();

        $department  = new Department();
        $department->name = "Quality Control";
        $department->dc = "QC";
        $department->save();

        $department  = new Department();
        $department->name = "Ragulatory Affairs ";
        $department->dc = "RA";
        $department->save();

        $department  = new Department();
        $department->name = "Security ";
        $department->dc = "SCR";
        $department->save();

        $department  = new Department();
        $department->name = "Training ";
        $department->dc = "TR";
        $department->save();

        $department  = new Department();
        $department->name = "IT ";
        $department->dc = "IT";
        $department->save();

        $department  = new Department();
        $department->name = "Application Engineering ";
        $department->dc = "AE";
        $department->save();

        $department  = new Department();
        $department->name = "Trading ";
        $department->dc = "TRD";
        $department->save();

        $department  = new Department();
        $department->name = "Research ";
        $department->dc = "RSCH";
        $department->save();

        $department  = new Department();
        $department->name = "Sales ";
        $department->dc = "SAL";
        $department->save();

        $department  = new Department();
        $department->name = "Finance ";
        $department->dc = "FIN";
        $department->save();

        $department  = new Department();
        $department->name = "Systems ";
        $department->dc = "SYS";
        $department->save();

        $department  = new Department();
        $department->name = "Administrative ";
        $department->dc = "ADM";
        $department->save();

        $department  = new Department();
        $department->name = "M&A ";
        $department->dc = "M&A";
        $department->save();

        $department  = new Department();
        $department->name = "R&D ";
        $department->dc = "R&D";
        $department->save();

        $department  = new Department();
        $department->name = "Human Resource ";
        $department->dc = "HR";
        $department->save();

        $department  = new Department();
        $department->name = "Banking ";
        $department->dc = "BNK";
        $department->save();

        $department  = new Department();
        $department->name = "Marketing ";
        $department->dc = "MRKT";
        $department->save();
    }
}
