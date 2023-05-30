<?php

namespace App\Imports;

use App\Models\Sparepart;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SparepartImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Sparepart([
            'category_id' => $row['category'],
            'type_id' => $row['type'],
            'name' => $row['name'],
            'slug' => $row['slug'],
            'code' => $row['code'],
            'description' => $row['description'],
        ]);
    }
}
