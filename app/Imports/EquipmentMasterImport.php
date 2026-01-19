<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\EquipmentMaster;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EquipmentMasterImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $department = Department::whereRaw(
            'LOWER(TRIM(name)) = ?',
            [strtolower(trim($row['department_name']))]
        )->first();

        if (!$department) {
            return null; 
        }

        return new EquipmentMaster([
          
            'department_id'  => $department->id,
            'equipment_name' => $row['equipment_name'],
            'equipment_id'   => $row['equipment_id'],
        ]);
    }
}
