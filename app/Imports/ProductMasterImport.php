<?php

namespace App\Imports;

use App\Models\ProductMaster;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductMasterImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // safety check (empty row skip)
            if (
                empty($row['product_name']) &&
                empty($row['product_code']) &&
                empty($row['category'])
            ) {
                continue;
            }

            ProductMaster::create([
                'product_name' => $row['product_name'],
                'product_code' => $row['product_code'],
                'category'     => $row['category'],
            ]);
        }
    }
}
