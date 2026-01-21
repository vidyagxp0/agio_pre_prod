<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\ProductMaster;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductMasterExport implements FromCollection ,WithHeadings,WithMapping
{
    private $row = 0;

    public function collection()
    {
        return ProductMaster::all();
    }
    public function map($equipment): array
    {
        return [
            ++$this->row, 
            $equipment->product_name ?? 'N/A',
            $equipment->product_code,
            $equipment->category
        ];
    }

    public function headings(): array
    {
        return [
            'Sr No',
            'Product Name',
            'Product Code',
            'Category',
        ];
    }
}
