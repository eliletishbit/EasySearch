<?php
namespace App\Imports;

use App\Models\ExcelRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new ExcelRow([
            'nom' => $row['nom'] ?? null,
            'email' => $row['email'] ?? null,
            'telephone' => $row['telephone'] ?? null,
        ]);
    }
    
}
