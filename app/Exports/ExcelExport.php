<?php
namespace App\Exports;

use App\Models\ExcelRow;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return ExcelRow::all();
    }

    public function headings(): array
    {
        return [
            'nom',
            'email',
            'telephone',
           
        ];
    }
}
