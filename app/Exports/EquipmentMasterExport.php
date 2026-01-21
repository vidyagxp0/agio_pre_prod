<?php

namespace App\Exports;

use App\Models\EquipmentMaster;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EquipmentMasterExport implements FromCollection, WithHeadings, WithMapping
{
    private $row = 0;

    public function collection()
    {
        return EquipmentMaster::with('department')->get();
    }

    public function map($equipment): array
    {
        return [
            ++$this->row, 
            $equipment->department->name ?? 'N/A',
            $equipment->equipment_name,
            $equipment->equipment_id,
        ];
    }

    public function headings(): array
    {
        return [
            'Sr No',
            'Department Name',
            'Equipment Name',
            'Equipment ID',
        ];
    }
}
