<?php

namespace App\Exports;
use App\Models\EquipmentMaster;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EquipmentMasterExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
            return EquipmentMaster::select('sno','name','equipment_name','equipment_id')->get();
   
    }
    public function headings(): array
    {
        return [
            'Sno',
            'Department Name',
            'Equipment Name',
            'Equipment ID',
        ];
        
    }
     public function map($equipment): array
    {
        return [
            $equipment->sno,
            $equipment->department->name ?? '',
            $equipment->equipment_name,
            $equipment->equipment_id,
        ];
    }
}
